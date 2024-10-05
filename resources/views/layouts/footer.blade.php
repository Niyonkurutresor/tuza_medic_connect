<footer class="border-top w-100 pt-4 mt-7">
    <div class="d-flex justify-content-md-between">
        <p class="fs-6 text-gray-600">{{ __('messages.all_rights_reserved_©') }} {{ \Carbon\Carbon::now()->year }}
            <a href="#" class="text-decoration-none">{{ getAppName() }}</a>
        </p>
        @if(config('app.footer_version_show'))
        <span class="text-muted align-content-end">{{ version() }}</span>
        @endif
    </div>
</footer>
