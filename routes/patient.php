<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorSessionController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\LiveConsultationController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientVisitController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartPatientCardsController;
use App\Http\Controllers\GeneratePatientSmartCardsController;
use App\Http\Controllers\PatientQrCodeController;
//store
Route::prefix('patients')->name('patients.')->middleware('auth', 'xss', 'checkUserStatus', 'role:patient')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'patientDashboard'])->name('dashboard');
    Route::get('/dashboard-patients',
        [DashboardController::class, 'getPatientList'])->name('patientData.dashboard');

    Route::resource('appointments', AppointmentController::class)->except(['index', 'edit', 'update']);
    Route::get('appointment-pdf/{id}',
        [AppointmentController::class, 'appointmentPdf'])->name('appointmentPdf');
    Route::get('appointments', [PatientAppointmentController::class, 'index'])->name('patient-appointments-index');

    Route::get('doctor-session-time',
        [DoctorSessionController::class, 'getDoctorSession'])->name('doctor-session-time');
    Route::get('get-service', [ServiceController::class, 'getService'])->name('get-service');
    Route::get('get-charge', [ServiceController::class, 'getCharge'])->name('get-charge');

    //        Route::get('appointment-cancel', [AppointmentController::class, 'cancelStatus'])->name('cancel-status');
    Route::get('patient-appointments-calendar',
        [AppointmentController::class, 'patientAppointmentCalendar'])->name('appointments.calendar');
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('appointment-cancel', [AppointmentController::class, 'cancelStatus'])->name('cancel-status');
    Route::get('doctors/{doctor}', [UserController::class, 'show'])->name('doctor.detail');
    Route::get('appointments/{appointment}',
        [AppointmentController::class, 'show'])->name('appointment.detail');
    Route::post('appointment-payment',
        [AppointmentController::class, 'appointmentPayment'])->name('appointment-payment');

    Route::get('patient-visits', [PatientVisitController::class, 'index'])->name('patient.visits.index');
    Route::get('patient-visits/{patientVisit}',
        [PatientVisitController::class, 'show'])->name('patient.visits.show');

    Route::get('connect-google-calendar',
        [GoogleCalendarController::class, 'googleCalendar'])->name('googleCalendar.index');
    Route::get('disconnect-google-calendar',
        [GoogleCalendarController::class, 'disconnectGoogleCalendar'])->name('disconnectCalendar.destroy');
    Route::post('appointment-google-calendar', [
        GoogleCalendarController::class, 'appointmentGoogleCalendarStore',
    ])->name('appointmentGoogleCalendar.store');

    Route::resource('reviews', ReviewController::class)->except(['delete', 'create']);

    Route::resource('live-consultations', LiveConsultationController::class);
    Route::get('live-consultation/{liveConsultation}/start',
        [LiveConsultationController::class, 'getLiveStatus'])->name('live.consultation.get.live.status');

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
    Route::get('smart_card-pdf/{id}',[GeneratePatientSmartCardsController::class, 'smartCardPdf'])->name('patients.smartCardPdf');
});
