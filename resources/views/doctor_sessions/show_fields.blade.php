<!-- Created At Field -->
<div class="form-group">
    {{ Form::label('created_at', __('models/doctorSessions.fields.created_at').':') }}
    <p>{{ $doctorSession->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {{ Form::label('updated_at', __('models/doctorSessions.fields.updated_at').':') }}
    <p>{{ $doctorSession->updated_at }}</p>
</div>

