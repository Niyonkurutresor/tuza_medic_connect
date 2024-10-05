<div class="me-4 dropdown my-1 ms-auto" wire:ignore>
    <a href="javascript:void(0)" class="btn btn-flex btn-light fw-bolder" id="filterBtn">
        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                          fill="#000000"/>
												</g>
											</svg>
										</span>
        {{__('messages.common.filter')}}
    </a>
    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
         id="filter">
        <div class="px-7 py-5">
            <div class="fs-5 text-dark fw-bolder">{{__('messages.common.filter_option')}}</div>
        </div>
        <div class="separator border-gray-200"></div>
            <div class="px-7 py-5">
                <div class="mb-10">
                    <label class="form-label fw-bold">{{__('messages.doctor.status')}}</label>
                    <div>
                        {{ Form::select('status', $status, null, ['class' => 'form-control form-control-solid form-select',                                           'data-control'=>"select2", 'id' => 'servicesStatus']) }}
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" id="serviceResetFilter"
                            class="btn btn-sm btn-light btn-active-light-primary me-2">{{__('messages.common.reset')}}</button>
                    <button type="submit" class="btn btn-sm btn-primary">{{__('messages.common.apply')}}</button>
                </div>
            </div>
    </div>
</div>
