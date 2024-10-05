<script id="doctorDashboardTemplate" type="text/x-jsrender">
<tr>
    <td>
       <div class="d-flex align-items-center">
            <div class="image image-circle image-mini me-3">
                <img src="{{:image}}" alt="user" class="">
            </div>
            <div class="d-flex flex-column">
                <a href="{{:route}}"
                   class="text-primary-800 mb-1 fs-6 text-decoration-none">
                    {{:name}}</a>
                <span class="text-muted fw-bold d-block">{{:email}}</span>
            </div>
       </div>
    </td>
    <td class="text-start">
        <span class="badge bg-light-success">{{:patientId}}</span>
    </td>
    <td class="mb-1 fs-6 text-muted fw-bold text-center">
        <div class="badge bg-light-info">
            <div class="mb-2">{{:from_time}} {{:from_time_type}} - {{:to_time}} {{:to_time_type}}</div>
            <div class="">{{:date}}</div>
        </div>
    </td>
</tr>






</script>
