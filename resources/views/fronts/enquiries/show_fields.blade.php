<div class="row">
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.web.name') }}:</label>
        <span class="fs-4 text-gray-800">{{$enquiry->name}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.web.email') }}:</label>
        <span class="fs-4 text-gray-800">{{$enquiry->email}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-0 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.web.phone') }}:</label>
        <span
            class="fs-4 text-gray-800">{{!empty($enquiry->phone) ? $enquiry->phone : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.web.subject') }}:</label>
        <span class="fs-4 text-gray-800">{{$enquiry->subject}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.web.message') }}:</label>
        <span class="fs-4 text-gray-800">{{$enquiry->message}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.registered_on') }}:</label>
        <span class="fs-4 text-gray-800" title="{{\Carbon\Carbon::parse($enquiry->created_at)->isoFormat('DD MMM YYYY')}}">
                                    {{\Carbon\Carbon::parse($enquiry->created_at)->diffForHumans()}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column">
        <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.last_updated') }}:</label>
        <span class="fs-4 text-gray-800" title="{{\Carbon\Carbon::parse($enquiry->updated_at)->isoFormat('DD MMM YYYY')}}">
                                    {{\Carbon\Carbon::parse($enquiry->updated_at)->diffForHumans()}}</span>
    </div>
</div>
