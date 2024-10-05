
@php
$str =  explode("\\",$row->medicineBill->model_type)[2];
$str= preg_replace('/(?<=\\w)(?=[A-Z])/'," $1", $str);
@endphp
{{ $str }}
