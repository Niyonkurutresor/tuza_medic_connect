@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard') }}
@endsection
@section('content')
    <div class="container-fluid">
        {{-- <div class="d-flex flex-column"> --}}
            <div class="row ">
               <div class="col">
                  <div class="row">
                     <div class="col-xl-4">
                      <div class="row">
                        <livewire:patient-dashboard-table />
                      </div>
                     </div>
                     <div class="col-xl-8">
                        <livewire:patient-dashboard-sidebar-table />
                     </div>
                     <div class="card-body">
                         {{ Form::hidden('patient_chart_data', json_encode($patientAllAppointment, true), ['id' => 'patientChartData']) }}
                     </div>
                  </div>
            </div>
            </div>
        {{-- </div> --}}
    </div>
    @include('generate_patient_smart_cards/components/show_card')
@endsection
