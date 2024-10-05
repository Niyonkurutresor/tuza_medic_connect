<?php

namespace App\Http\Controllers;

use App\Models\AppointmentGoogleCalendar;
use App\Models\GoogleCalendarIntegration;
use App\Models\GoogleCalendarList;
use App\Models\Setting;
use App\Repositories\GoogleCalendarRepository;
use Carbon\Carbon;
use Flash;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Laracasts\Flash\Flash as FlashFlash;
use Google\Service;

/**
 * Class GoogleCalendarController
 */
class GoogleCalendarController extends AppBaseController
{
    public $client;

    public function __construct()
    {
        $name = config('app.google_oauth_path');

        if (empty($name)) {
            return;
        }

        $this->client = new Google_Client();
        // Set the application name, this is included in the User-Agent HTTP header.
        $this->client->setApplicationName(config('app.name'));
        // Set the authentication credentials we downloaded from Google.
        $this->client->setAuthConfig(resource_path('google-oath/'.config('app.google_oauth_path')));
        // Setting offline here means we can pull data from the venue's calendar when they are not actively using the site.
        $this->client->setAccessType('offline');
        // This will include any other scopes (Google APIs) previously granted by the venue
        $this->client->setIncludeGrantedScopes(true);
        // Set this to force to consent form to display.
        $this->client->setApprovalPrompt('force');
        // Add the Google Calendar scope to the request.
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
    }

    public function oauth(): RedirectResponse
    {
        if($this->client == null){
            return redirect()->back();
        }
        $authUrl = $this->client->createAuthUrl();
        $filteredUrl = filter_var($authUrl, FILTER_SANITIZE_URL);

        return redirect($filteredUrl);
    }

    public function fetchCalendarListAndSyncToDB()
    {
        $gcHelper = new Google_Service_Calendar($this->client);
        // Use the Google Client calendar service. This gives us methods for interacting
        // with the Google Calendar API
        $calendarList = $gcHelper->calendarList->listCalendarList();

        $googleCalendarList = [];
        foreach ($calendarList->getItems() as $calendarListEntry) {
            if ($calendarListEntry->accessRole == 'owner') {
                $googleCalendarList[] = GoogleCalendarList::create([
                    'user_id' => getLogInUserId(),
                    'calendar_name' => $calendarListEntry['summary'],
                    'google_calendar_id' => $calendarListEntry['id'],
                    'meta' => json_encode($calendarListEntry),
                ]);
            }
        }

        return $googleCalendarList;
    }

    public function redirect(Request $request): RedirectResponse
    {
        try {
            $accessToken = $this->client->fetchAccessTokenWithAuthCode($request->get('code'));

            $exists = GoogleCalendarIntegration::whereUserId(getLogInUserId())->exists();

            if ($exists) {
                GoogleCalendarIntegration::whereUserId(getLogInUserId())->delete();
                GoogleCalendarList::whereUserId(getLogInUserId())->delete();
            }

            $googleCalendarIntegration = GoogleCalendarIntegration::create([
                'user_id' => getLogInUserId(),
                'access_token' => $accessToken['access_token'],
                'last_used_at' => Carbon::now(),
                'meta' => json_encode($accessToken),
            ]);

            $this->client->setAccessToken($accessToken);
            $calendarLists = $this->fetchCalendarListAndSyncToDB();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        // store token to DB here
        // google_access_token
        // - user_id
        // - access_token
        // meta (json)
        // last_used_at
        // we must need to generate new token within hr, as access token is valid for hr

        Flash::success(__('messages.flash.google_calendar_connect'));

        if (getLogInUser()->hasRole('doctor')) {
            return redirect(route('doctors.googleCalendar.index'));
        } elseif (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.googleCalendar.index'));
        }
    }

    public function show($eventId)
    {
        $accessToken = $this->getAccessToken();
        if ($accessToken) {
            $this->client->setAccessToken($accessToken);

            $service = new Google_Service_Calendar($this->client);
            $event = $service->events->get('primary', $eventId);

            if (! $event) {
                return response()->json(['status' => 'error', 'message' => __('messages.flash.something_went_wrong')]);
            }

            return response()->json(['status' => 'success', 'data' => $event]);
        } else {
            return redirect()->route('oauthCallback');
        }
    }

    public function update(Request $request, $eventId)
    {
        $accessToken = $this->getAccessToken();
        if ($accessToken) {
            $this->client->setAccessToken($accessToken);
            $service = new Google_Service_Calendar($this->client);

            $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();

            $eventDuration = 30; //minutes

            if ($request->has('end_date')) {
                $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();
            } else {
                $endDateTime = Carbon::parse($request->start_date)->addMinutes($eventDuration)->toRfc3339String();
            }

            // retrieve the event from the API.
            $event = $service->events->get('primary', $eventId);

            $event->setSummary($request->title);

            $event->setDescription($request->description);

            //start time
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);

            //end time
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);

            $updatedEvent = $service->events->update('primary', $event->getId(), $event);

            if (! $updatedEvent) {
                return response()->json(['status' => 'error', 'message' => __('messages.flash.something_went_wrong')]);
            }

            return response()->json(['status' => 'success', 'data' => $updatedEvent]);
        } else {
            return redirect()->route('oauthCallback');
        }
    }

    public function destroy($eventId): RedirectResponse
    {
        $accessToken = $this->getAccessToken();
        if ($accessToken) {
            $this->client->setAccessToken($accessToken);
            $service = new Google_Service_Calendar($this->client);

            $service->events->delete('primary', $eventId);
        } else {
            return redirect()->route('oauthCallback');
        }
    }

    public function googleCalendar(): View
    {
        $data['googleCalendarIntegrationExists'] = GoogleCalendarIntegration::whereUserId(getLogInUserId())->exists();
        $data['googleCalendarLists'] = \App\Models\GoogleCalendarList::with('appointmentGoogleCalendar')
            ->whereUserId(getLogInUserId())
            ->get();

        $data['checkTimeZone'] = getLogInUser();
        $logo = Setting::where('key', 'logo')->pluck('value');

        return view('connect_google_calendar.index', compact('data', 'logo'));
    }

    public function appointmentGoogleCalendarStore(Request $request)
    {
        $appointmentGoogleCalendars = AppointmentGoogleCalendar::whereUserId(getLogInUserId())->get();
        foreach ($appointmentGoogleCalendars as $appointmentGoogleCalendar) {
            $appointmentGoogleCalendar->delete();
        }
        $input = $request->all();

        $googleCalendarIds = $input['google_calendar'];
        foreach ($googleCalendarIds as $googleCalendarId) {
            $googleCalendarListId = GoogleCalendarList::find($googleCalendarId)->google_calendar_id;
            $data = [
                'user_id' => getLogInUserId(),
                'google_calendar_list_id' => $googleCalendarId,
                'google_calendar_id' => $googleCalendarListId,
            ];
            AppointmentGoogleCalendar::create($data);
        }

        return $this->sendSuccess(__('messages.flash.calender_added'));
    }

    public function disconnectGoogleCalendar(): RedirectResponse
    {
        AppointmentGoogleCalendar::whereUserId(getLogInUserId())->delete();
        GoogleCalendarIntegration::whereUserId(getLogInUserId())->delete();
        GoogleCalendarList::whereUserId(getLogInUserId())->delete();

        Flash::success(__('messages.flash.google_calendar_disconnect'));

        if (getLogInUser()->hasRole('doctor')) {
            return redirect(route('doctors.googleCalendar.index'));
        } elseif (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.googleCalendar.index'));
        }
    }

    public function syncGoogleCalendarList()
    {
        /** @var GoogleCalendarRepository $repo */
        $repo = App::make(GoogleCalendarRepository::class);

        $repo->syncCalendarList(getLogInUser());

        return $this->sendSuccess(__('messages.flash.google_calendar_update'));
    }
}
