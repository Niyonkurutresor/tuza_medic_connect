<?php

namespace App\Repositories;

use App\Models\AppointmentGoogleCalendar;
use App\Models\GoogleCalendarIntegration;
use App\Models\GoogleCalendarList;
use App\Models\User;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class GoogleCalendarRepository
 */
class GoogleCalendarRepository
{
    public $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        // Set the application name, this is included in the User-Agent HTTP header.
        $this->client->setApplicationName(config('app.name'));
        // Set the authentication credentials we downloaded from Google.

        if (config('app.google_oauth_path') != '') {
            $this->client->setAuthConfig(resource_path('google-oath/'.config('app.google_oauth_path')));
        }
        // Setting offline here means we can pull data from the venue's calendar when they are not actively using the site.
        $this->client->setAccessType('offline');
        // This will include any other scopes (Google APIs) previously granted by the venue
        $this->client->setIncludeGrantedScopes(true);
        // Set this to force to consent form to display.
        $this->client->setApprovalPrompt('force');
        // Add the Google Calendar scope to the request.
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
    }

    public function store($appointment, $accessToken, $meta)
    {
        $date = $appointment['date'];
        $timezone = $appointment->doctor->user->time_zone;
        $timeZone = isset(User::TIME_ZONE_ARRAY[$timezone]) ? User::TIME_ZONE_ARRAY[$timezone] : null;
        $startTime = date('H:i', strtotime($appointment['from_time'].' '.$appointment['from_time_type']));
        $endTime = date('H:i', strtotime($appointment['to_time'].' '.$appointment['to_time_type']));
        $startDateTime = Carbon::parse($date.' '.$startTime, $timeZone)->toRfc3339String();
        $endDateTime = Carbon::parse($date.' '.$endTime, $timeZone)->toRfc3339String();

        $results = [];
        if ($accessToken) {
            $this->client->setAccessToken($accessToken);
            $service = new Google_Service_Calendar($this->client);

            foreach ($meta['lists'] as $calendarId) {
                $event = new Google_Service_Calendar_Event([
                    'summary' => $meta['name'],
                    'description' => isset($appointment['description']) ? $appointment['description'] : $meta['description'],
                    'start' => ['dateTime' => $startDateTime],
                    'end' => ['dateTime' => $endDateTime],
                    'reminders' => ['useDefault' => true],
                ]);

                // Google Meet integration code
                //            $conference = new \Google_Service_Calendar_ConferenceData();
                //            $conferenceRequest = new \Google_Service_Calendar_CreateConferenceRequest();
                //            $conferenceRequest->setRequestId('randomString123'); // update here the string code
                //            $conference->setCreateRequest($conferenceRequest);
                //            $event->setConferenceData($conference);

                $data = $service->events->insert($calendarId, $event);
                $data['google_calendar_id'] = $calendarId;
                $results[] = $data;
            }

            return $results;
        } else {
            return $results;
        }
    }

    public function getAccessToken($user)
    {
        $accessToken = json_decode($user->gCredentials->meta, true);

        try {
            // Refresh the token if it's expired.
            $this->client->setAccessToken($accessToken);
            if ($this->client->isAccessTokenExpired()) {
                Log::info('expired');
                $accessToken = $this->client->fetchAccessTokenWithRefreshToken($accessToken['refresh_token']);

                $calendarRecord = GoogleCalendarIntegration::whereUserId($user->id)->first();
                $calendarRecord->update([
                    'access_token' => $accessToken['access_token'],
                    'meta' => json_encode($accessToken),
                    'last_used_at' => Carbon::now(),
                ]);
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $accessToken['access_token'];
    }

    public function syncCalendarList($user): array
    {
        $this->getAccessToken($user);

        $gcHelper = new Google_Service_Calendar($this->client);
        // Use the Google Client calendar service. This gives us methods for interacting
        // with the Google Calendar API
        $calendarList = $gcHelper->calendarList->listCalendarList();

        $googleCalendarList = [];

        $existingCalendars = GoogleCalendarList::whereUserId(Auth::id())
            ->pluck('google_calendar_id', 'google_calendar_id')
            ->toArray();

        foreach ($calendarList->getItems() as $calendarListEntry) {
            if ($calendarListEntry->accessRole == 'owner') {
                $exists = GoogleCalendarList::whereUserId(getLogInUserId())
                    ->where('google_calendar_id', $calendarListEntry['id'])
                    ->first();

                unset($existingCalendars[$calendarListEntry['id']]);

                if (! $exists) {
                    $googleCalendarList[] = GoogleCalendarList::create([
                        'user_id' => getLogInUserId(),
                        'calendar_name' => $calendarListEntry['summary'],
                        'google_calendar_id' => $calendarListEntry['id'],
                        'meta' => json_encode($calendarListEntry),
                    ]);
                }
            }
        }

        AppointmentGoogleCalendar::whereIn('google_calendar_id', $existingCalendars)->delete();
        GoogleCalendarList::whereIn('google_calendar_id', $existingCalendars)->delete();

        return $googleCalendarList;
    }

    public function destroy($events)
    {
        foreach ($events as $event) {
            $accessToken = $this->getAccessToken($event->user);

            if ($accessToken) {
                $this->client->setAccessToken($accessToken);
                $service = new Google_Service_Calendar($this->client);

                $service->events->delete($event->google_calendar_id, $event->google_event_id);
            } else {
                return redirect()->route('oauthCallback');
            }
        }
    }
}
