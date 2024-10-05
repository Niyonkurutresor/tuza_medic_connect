<script id="visitsPrescriptionTblTemplate" type="text/x-jsrender">
    <tr>
        <td class="text-break text-wrap">{{:name}}</td>
        <td class="text-break text-wrap">{{:frequency}}</td>
        <td class="text-break text-wrap">{{:duration}}</td>
        <td class="text-center">
        <div class="d-flex justify-content-center">
        <a href="#" data-id="{{:id}}" class="btn px-1 text-primary fs-3 edit-prescription-btn" title="Edit">
                        <i class="fa-solid fa-pen-to-square"></i>
    </a>
        <a href="#" data-id="{{:id}}" class="delete-visit-prescription-btn btn px-1 text-danger fs-3 " title="Delete">
                       <i class="fa-solid fa-trash"></i>
    </a>
    </div>
    </td>
    </tr>


</script>
