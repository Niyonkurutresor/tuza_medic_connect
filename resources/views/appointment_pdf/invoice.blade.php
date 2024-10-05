<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>{{ getAppName() }} </title>
    <style>
        @font-face {
            font-family: "Poppins";
            src: url("/theme/fonts/Poppins-Regular.ttf")format(truetype);
            font-style: normal;
            font-weight: 400;
            font-display: swap;
        }
        .text-center {
            text-align: center !important;
        }
        .text-end {
            text-align: end !important;
        }
        .custom-font-family {
            font-family: DejaVu Sans, Poppins, "Helvetica", Arial, "Liberation Sans", sans-serif !important;
        }
        .w-100 {
            width: 100%;
        }
        .w-50 {
            width: 50%;
        }
        .verticalLine {
            height: 100px;
            border-right: 1px solid  #D9D9D9;

            position: absolute;
            right: 50%;
        }
        .border-bottom {
            border-bottom: 1px solid rgb(139, 135, 135);
        }
        .bg-gray {
            background-color:  #F4F4F4;
            ;
        }
        .font-color {
            color : #5E5E5E;
            ;

        }
        .p-2 {
            padding: 6px;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        body,h1,h3 {
            font-family: "Poppins", sans-serif !important;
            font-size: 0.875rem !important;
            font-weight: lighter !important;
            line-height: normal!important;
        }
        h1 {
            font-size:26px!important;
        }
        .fw-bold {
            font-weight:bold !important;
        }
    </style>
</head>

<body>
    <div>
        <table class="table w-100">
            <tbody>
                <tr>
                    <td class="w-50 text-center">
                        <img src="{{ getAppLogo() }}" style="width:70px;margin-left:70%;margin-bottom:40px;">
                        </img>
                    </td>
                    <h1 style="margin-right:100%;margin-top:10px;">InfyCare</h1>
                </tr>
            </tbody>
        </table>
        <div class="border-bottom">
            <table class="table w-100">
                <tr>
                    <td class="w-50 verticalLine">
                        <table class="table w-100 ">
                            <tbody>
                                <tr>
                                    <th>Doctor Name:</th>
                                    <td class="font-color">{{ $datas->doctor->user->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Doctor Email:</th>
                                    <td class="font-color">{{ $datas->doctor->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Services:</th>
                                    <td class="font-color">{{ $datas->services->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="w-50">
                        <table class="table w-100 " style="padding-left:50px;">
                            <tbody>
                                <tr>
                                    <th>Patient Name:</th>
                                    <td class="font-color">{{ $datas->patient->user->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Patient Email:</th>
                                    <td class="font-color">{{ $datas->patient->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td class="font-color">{{ \App\Models\Appointment::PAYMENT_METHOD[$datas->payment_method] }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Status:</th>
                                    <td class="font-color">{{ \App\Models\Appointment::PAYMENT_TYPE[$datas->payment_type] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <table class="table w-100">
            <tr>
                <td class="w-50 text-end">
                    <table class="table" style="margin-left:auto;margin-top:20px;width:50%;">
                        <tr>
                            <th>Appointment Date:</th>
                        </tr>
                        <tr>
                            <td class="font-color">{{\Carbon\Carbon::parse($datas->date)->isoFormat('MMM DD, YYYY')}}</td>
                        </tr>
                    </table>
                </td>
                <td class="w-50">
                    <table class="table" style="margin-left:50px;margin-top:20px;width:50%;">
                        <tr>
                            <th>Appointment Time:</th>
                        </tr>
                        <tr>
                            <td class="font-color">{{ $datas->from_time }} {{ $datas->from_time_type }} To {{ $datas->to_time }}
                                {{ $datas->to_time_type }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="table w-100">
            <tr>
                <td class="w-50" style="padding-right:50px;">
                    <div class="bg-gray p-2" style="margin-top:10px;">
                        <p class="mb-0 font-color">Invoice Amount In Words</p>
                        <p class="mb-0">{{ getAmountToWord($datas->payable_amount) }}</p>
                    </div>
                </td>
                <td class="w-50" style="padding-left:50px;">
                    <table class="table w-100">
                        <tbody>
                            <tr>
                                <th style="padding-left:10px">Amount:</th>
                            </tr>
                            <tr class="font-color">
                                <td  style="padding-left:10px">Charge:</td>
                                <td class="custom-font-family text-end " style="padding-right: 20px">
                                    {{ getCurrencyIcon() . $datas->services->charges }}</td>
                            </tr>
                            <tr class="font-color">
                                <td  style="padding-left:10px">Extra Charge:</td>
                                <td class="custom-font-family text-end " style="padding-right: 20px">
                                    {{ getCurrencyIcon() . $datas->payable_amount - $datas->services->charges }}</td>
                            </tr>
                            <tr class="bg-gray">
                                <th class="" style="padding-left:10px">Payable Amount:</th>
                                <td class="custom-font-family text-end" style="padding-right: 20px">
                                    {{ getCurrencyFormat(getCurrencyCode(), $datas->payable_amount) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <div>
            @if ($datas->description)
                <h3 class="fw-bold">Description:</h3>
                <p class="content1 w-10">
                    {!! nl2br($datas->description) !!}
                </p>
            @endif
        </div>
</body>


</html>
