<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href="{{ 'assets/css/smart-card-pdf.css' }}" rel="stylesheet" type="text/css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <title>{{ getAppName() }} </title>
    <style>
        .card .card-header {
            background-color: {{ $datas->smartPatientCard->header_color }};
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="mt-5">
            <div class="card-detail d-flex align-items-center justify-content-center border border-dark mx-auto"
                style="border-radius: 23px">
                <div class="card" id="card">
                    <div class="card-header smart-card-header d-flex align-items-center"
                        style="display: flex;border-top-left-radius: 20px; flex;border-top-right-radius: 20px;">
                        <div class="w-50 ms-3 my-2 mb-1" style="display: flex; flex-direction: row; ">
                            <div class="logo me-1 float-start">
                                <img src="{{ $logo }}" alt="logo" class="img-fluid smart_card__pdf_logo" />
                            </div>
                            <h4 class="text-white mb-0 fw-bold mt-2" style="width: 550px">{{ $clinic_name }}</h4>
                        </div>
                        <div class="flex-1 text-end w-75 ms-auto">
                            <address class="text-white fs-12 mb-0">
                                <p class="mb-0">
                                    {{ $address_one }}
                                </p>
                            </address>
                        </div>
                    </div>

                    <div class="card-body header_color">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <div class="d-flex">
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="card-img me-3">
                                                    <img src="{{ $datas->profile }}" alt="profile-img"
                                                        class="object-fit-cover" id="card_profilePicture"
                                                        width="110px" />
                                                </div>
                                            </td>
                                            <td class="patient-detail">
                                                <div class="card-body">
                                                    <div class="">

                                                        <table class="table table-borderless patient-desc mb-0">
                                                            <tr>
                                                                <td class="pe-3">Name:</td>
                                                                <td id="card_name" style="word-break: break-word">
                                                                    {{ $datas->user->full_name }}</td>
                                                            </tr>
                                                            <tr id="card_show_email"
                                                                class="{{ $datas->smartPatientCard->show_email == 0 ? 'd-none' : '' }}">
                                                                <td class="pe-3">Email:</td>
                                                                <td style="word-break: break-word">
                                                                    {{ $datas->user->email }}</td>
                                                            </tr>
                                                            <tr id="card_show_phone"
                                                                class="{{ $datas->smartPatientCard->show_phone == 0 || $datas->user->contact == null ? 'd-none' : '' }}">
                                                                <td class="pe-3">Contact:</td>
                                                                <td>{{ $datas->user->contact }}</td>
                                                            </tr>
                                                            <tr id="card_show_dob"
                                                                class="{{ $datas->smartPatientCard->show_dob == 0 || $datas->user->dob == null ? 'd-none' : '' }}">
                                                                <td class="pe-3">D.O.B:</td>
                                                                <td>{{ $datas->user->dob }}</td>
                                                            </tr>
                                                            <tr id="card_show_blood_group"
                                                                class="{{ $datas->smartPatientCard->show_blood_group == 0 || $datas->user->blood_group == null ? 'd-none' : '' }}">
                                                                <td class="pe-3 blood_group">Blood Group:</td>
                                                                <td>{{ !empty($datas->user->blood_group) ? \App\Models\Patient::BLOOD_GROUP_ARRAY[$datas->user->blood_group] : __('messages.common.n/a') }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-end mb-5 ms-5">
                                                    <div class="qr-code mt-4">
                                                        <img
                                                            src="data:image/png;base64,{{ base64_encode(QrCode::size(90)->generate(route('patient_show') . '/' . $datas->patient_unique_id)) }}">

                                                    </div>
                                                </div>
                                                <h6 class="text-start mb-3 patient_unique_id {{ $datas->smartPatientCard->show_patient_unique_id == 0 ? 'd-none' : '' }}"
                                                    id="card_show_patient_unique_id">
                                                    ID:{{ $datas->patient_unique_id }}
                                                </h6>
                                            </td>
                                        </tr>
                                    </table>
                                    @if (!empty($datas->address->address1))
                                        <table>
                                            <tr
                                                class="{{ $datas->smartPatientCard->show_address == 0 || $datas->address->address1 == null ? 'd-none' : '' }} address-text">
                                                <td>
                                                    <div class="mb-0 me-3">Address:</div>
                                                </td>
                                                <td>
                                                    <address class="mb-0" id="card-address">
                                                        {{ $datas->address->address1 }}
                                                        {{ $datas->address->address2 }}
                                                    </address>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>





</html>
