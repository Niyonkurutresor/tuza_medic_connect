<div>
    <div class="listing-skeleton">
        <div class="card">
            <div class="card-content">
                <div class="d-flex flex-column flex-lg-row justify-content-between">
                    <div class="search-box pulsate mb-3 mb-lg-0">
                    </div>
                    @if (Request::is('admin/doctors/*') || Request::is('admin/patients/*'))
                        <div class="d-flex flex-wrap">
                            <div class="date-box pulsate mb-3 mb-lg-0">
                                <!-- Content for the first div -->
                            </div>
                            <div class="filter-box pulsate mb-3 ms-0 ms-lg-2">
                                <!-- Content for the second div -->
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-wrap">
                            <div class="col-lg-4 col-md-6 listing pulsate mb-3">
                            </div>
                            <div class="filter-box pulsate mb-3 ms-0 ms-lg-2">
                            </div>
                            <div class="filter-box pulsate mb-3 ms-0 ms-lg-2">
                            </div>
                            <div class="date-box pulsate mb-3 mb-lg-0">
                            </div>
                            <div class="add-button-box-lg pulsate ms-0 ms-lg-2">
                            </div>
                        </div>
                    @endif
                </div>

            </div>
            <div class="card-content my-5">
                <div class="table pulsate">
                </div>
                <div class="row">
                    @for ($i = 1; $i <= 28; $i++)
                        <div class="col-3 mb-5">
                            <div class="column-box pulsate">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
