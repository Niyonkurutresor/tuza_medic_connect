<script id="adminDashboardTemplate" type="text/x-jsrender">

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
        <td class="text-center">
        <span class="badge bg-light-danger">{{:appointment_count}}</span>
    </td>
    <td class="text-center text-muted fw-bold">
        <span class="badge bg-light-info">
            {{:registered}}
        </span>
    </td>
</tr>





</script>
