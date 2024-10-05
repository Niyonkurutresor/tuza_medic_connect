<div class="row gx-10 mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('display_name', __('messages.common.name').':', ['class' => 'required fs-5 fw-bolder form-label mb-2']) }}
        {{ Form::text('display_name', (isset($selectedPermissions))?$role->display_name:'', ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.role.role'), 'required']) }}
    </div>
</div>
<div class="row">
        <div class="row">
    <div class="col-md-6 mb-5">
        <label class="fs-5 fw-bolder form-label mb-2">{{__('messages.role.role_permissions')}}</label>
    </div>
    <div class="col-md-6 mb-5">
        <span class="fs-5 fw-bolder form-label mb-2"> {{__('messages.role.select_all_permissions')}}</span>
        <label class="form-check form-check-custom form-check-sm form-check-solid float-end">
            <input class="form-check-input allPermissionCheck" type="checkbox" value="" id="checkAllPermission"/>
        </label>
    </div>
        @foreach($permissions['permissions'] as $permission)
        <div class="col-lg-6 mb-5">
            <span>  {{$permission->display_name}}</span>
            <label class="form-check form-check-sm form-check-custom form-check-solid float-end">
                <input class="form-check-input permission"
                       {{isset($selectedPermissions[$permission->id]) == $permission->id ?'checked':''}} type="checkbox"
                       value="{{$permission->id}}" name="permission_id[]"/>
            </label>
        </div>
        @endforeach
    </div>
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2 my-1']) }}
        <a href="{{route('roles.index')}}" type="reset"
           class="btn btn-light btn-active-light-primary my-1">{{__('messages.common.discard')}}</a>
    </div>
</div>
