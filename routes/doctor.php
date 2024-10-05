<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorSessionController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\HolidayContoller;
use App\Http\Controllers\LiveConsultationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartPatientCardsController;
use App\Http\Controllers\GeneratePatientSmartCardsController;
use App\Http\Controllers\PatientQrCodeController;

Route::prefix('doctors')->name('doctors.')->middleware('auth', 'xss', 'checkUserStatus', 'role:doctor')->group(function () {

    Route::get('/patients-detail/{patient}', [PatientController::class, 'show'])->name('patient.detail');

    //doctor dashboard route
    Route::get('/dashboard', [DashboardController::class, 'doctorDashboard'])->name('dashboard');
    Route::get('/doctor-dashboard',
        [DashboardController::class, 'getDoctorAppointment'])->name('appointment.dashboard');

    // Doctor Session Routes
    Route::resource('appointments', AppointmentController::class)->except(['index', 'edit', 'update']);

    Route::get('doctor-session-time',
        [DoctorSessionController::class, 'getDoctorSession'])->name('doctor-session-time');
    Route::resource('doctor-sessions', DoctorSessionController::class);
    Route::get('get-slot-by-gap', [DoctorSessionController::class, 'getSlotByGap'])->name('get.slot.by.gap');
    Route::get('doctor-schedule-edit',[DoctorSessionController::class, 'doctorScheduleEdit'])->name('doctor.schedule.edit');

    //Doctor Appointment route
    Route::get('appointments', [AppointmentController::class, 'doctorAppointment'])->name('appointments');
    Route::get('appointments-calendar',
        [AppointmentController::class, 'doctorAppointmentCalendar'])->name('appointments.calendar');
    Route::get('appointments/{appointment}',
        [AppointmentController::class, 'appointmentDetail'])->name('appointment.detail');
    Route::get('appointment-pdf/{id}',
        [AppointmentController::class, 'appointmentPdf'])->name('appointmentPdf');

    //Visit route
    Route::resource('visits', VisitController::class);
    Route::post('add-problem', [VisitController::class, 'addProblem'])->name('visits.add.problem');
    Route::post('delete-problem/{problem}',
        [VisitController::class, 'deleteProblem'])->name('visits.delete.problem');
    Route::post('add-observation', [VisitController::class, 'addObservation'])->name('visits.add.observation');
    Route::post('delete-observation/{observation}',
        [VisitController::class, 'deleteObservation'])->name('visits.delete.observation');
    Route::post('add-note', [VisitController::class, 'addNote'])->name('visits.add.note');
    Route::post('delete-note/{note}', [VisitController::class, 'deleteNote'])->name('visits.delete.note');
    Route::post('add-prescription', [VisitController::class, 'addPrescription'])->name('visits.add.prescription');
    Route::post('delete-prescription/{prescription}',
        [VisitController::class, 'deletePrescription'])->name('visits.delete.prescription');
    Route::get('edit-prescription/{prescription}',
        [VisitController::class, 'editPrescription'])->name('visits.edit.prescription');

    Route::post('appointments/{appointment}',
        [AppointmentController::class, 'changeStatus'])->name('change-status');
    Route::post('appointments-payment/{id}',
        [AppointmentController::class, 'changePaymentStatus'])->name('change-payment-status');
    Route::get('patient-appointments',
        [PatientController::class, 'patientAppointment'])->name('patients.appointment');
    Route::get('appointments/{appointment}',
        [AppointmentController::class, 'show'])->name('appointment.detail');
    Route::get('doctors/{doctor}', [UserController::class, 'show'])->name('doctors.detail');
    Route::get('doctors-appointment',
        [UserController::class, 'doctorAppointment'])->name('doctors.appointment');

    Route::get('connect-google-calendar',
        [GoogleCalendarController::class, 'googleCalendar'])->name('googleCalendar.index');
    Route::get('disconnect-google-calendar',
        [GoogleCalendarController::class, 'disconnectGoogleCalendar'])->name('disconnectCalendar.destroy');
    Route::post('appointment-google-calendar', [
        GoogleCalendarController::class, 'appointmentGoogleCalendarStore',
    ])->name('appointmentGoogleCalendar.store');

    //Zoom Route
    Route::resource('live-consultations', LiveConsultationController::class);
    Route::get('live-consultation-list',
        [LiveConsultationController::class, 'getTypeNumber'])->name('live.consultation.list');
    Route::post('live-consultation/change-status',
        [LiveConsultationController::class, 'getChangeStatus'])->name('live.consultation.change.status');
    Route::get('live-consultation/{liveConsultation}/start',
        [LiveConsultationController::class, 'getLiveStatus'])->name('live.consultation.get.live.status');
    Route::get('live-consultation/{liveConsultation}',
        [LiveConsultationController::class, 'show'])->name('live.consultation.show');
    Route::get('user-zoom-credential/{userZoomCredential}/fetch',
        [LiveConsultationController::class, 'zoomCredential'])->name('zoom.credential');
    Route::post('user-zoom-credential',
        [LiveConsultationController::class, 'zoomCredentialCreate'])->name('zoom.credential.create');

    //Transactions route
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    //Holiday Route
    Route::get('holidays', [HolidayContoller::class, 'holiday'])->name('holiday');
    Route::get('holidays/create', [HolidayContoller::class, 'doctorCreate'])->name('holiday-create');
    Route::post('holidays/create', [HolidayContoller::class, 'doctorStore'])->name('holiday-store');
    Route::delete('holidays/delete/{holiday}', [HolidayContoller::class, 'doctorDestroy'])->name('holiday-destroy');

    // Route for Prescription
    Route::resource('prescriptions', PrescriptionController::class)->except('create', 'edit', 'index');
    Route::get('appointments/{appointmentId}/prescription-create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::get('appointments/{appointmentId}/prescription-edit/{prescription}', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
    Route::post('prescription-medicine', [PrescriptionController::class, 'prescreptionMedicineStore'])->name('prescription.medicine.store');
    Route::post('prescriptions/{prescription}/active-deactive', [PrescriptionController::class, 'activeDeactiveStatus'])->name('prescription.status');
    Route::get('prescription-medicine-show/{id}', [PrescriptionController::class, 'prescriptionMedicineShowFunction'])->name('prescription.medicine.show');
    Route::get('prescription-pdf/{id}', [PrescriptionController::class, 'convertToPDF'])->name('prescriptions.pdf');

    //smart patient cardsd
    Route::resource('smart-patient-cards', SmartPatientCardsController::class);
    Route::put('card-status/{id}', [SmartPatientCardsController::class, 'changeCardStatus'])->name('card.status');

    Route::resource('generate-patient-smart-cards', GeneratePatientSmartCardsController::class);
    Route::get('card-detail/{id}', [GeneratePatientSmartCardsController::class, 'cardDelail'])->name('card.detail');
    Route::get('card-qr-code/{id}', [GeneratePatientSmartCardsController::class, 'cardQr'])->name('card.qr');
    Route::get('smart_card-pdf/{id}',[GeneratePatientSmartCardsController::class, 'smartCardPdf'])->name('doctors.smartCardPdf');
});
