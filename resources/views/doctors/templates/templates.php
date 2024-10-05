<script id="qualificationTemplateData" type="text/x-jsrender">
    <tr>
     <td>{{:id}}</td>
     <td>{{:degree}}</td>
    <td>{{:university}}</td>
    <td>{{:year}}</td>
    <td class="text-center">
     <a data-id="{{:id}}" class="btn edit-btn-qualification btn-icon px-1 fs-3 text-primary" data-bs-toggle="tooltip" title="Edit">
                        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a  data-id="{{:id}}" class="delete-btn-qualification btn btn-icon px-1 fs-3 text-danger" data-bs-toggle="tooltip" title="Delete">
                        <i class="fa-solid fa-trash"></i>
    </a>
    </td>
    </tr>
</script>

<script id="sessionTemplateData" type="text/x-jsrender">
            <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
            <div class="fw-bold ms-5">
                <div class=" fs-7 mb-1"><?php echo __('messages.doctor_session.session_time_in_minutes') ?> :
                    <span class="fs-7 text-gray-400 text-uppercase">{{:time}}</span>
                </div>
                <div class="fs-7 text-gray-400"><?php echo __('messages.doctor_session.morning_session') ?> :
                    <a href="#">
    {{:morningSessionStart}} To {{:morningSessionEnd}}</a>
                </div>
                <div class="fs-7 text-gray-400"><?php echo __('messages.doctor_session.evening_session') ?> :
                    <a href="#">
    {{:eveningSessionStart}} To {{:eveningSessionEnd}}</a>
                </div>
            </div>


</script>
