document.addEventListener('turbo:load', loadPatientTransactionTable)

let patientTransactionTableName = '#patientTransactionsTable'

function loadPatientTransactionTable () {

    if (!$(patientTransactionTableName).length) {
        return
    }
    let patientTransactionTbl = $(patientTransactionTableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'desc']],
        ajax: {
            url: route('patients.transactions'),
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '50%',
            },
            {
                'targets': [1],
                'width': '18%',
            },
            {
                'targets': [3],
                'orderable': false,
                'searchable': false,
                'className': 'text-center',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<span class="badge badge-light-info">${moment.parseZone(
                        row.created_at).format('Do MMM, Y h:mm A')}</span>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (row.type == manuallyMethod){
                        return manually;
                    }
                    if (row.type == stripeMethod){
                        return stripe;
                    }
                    if (row.type == paystckMethod){
                        return paystck;
                    }
                    if (row.type == paypalMethod){
                        return paypal;
                    }
                    if (row.type == razorpayMethod){
                        return razorpay;
                    }
                    if (row.type == authorizeMethod){
                        return authorize;
                    }
                    if (row.type == paytmMethod){
                        return paytm;
                    }
                    return '';
                },
                name: 'type',
            },
            {
                data: function (row) {
                    return currencyIcon + ' ' + getFormattedPrice(row.amount);
                },
                name: 'amount',
            },
            {
                data: function (row) {
                    let patientTransactionData = [
                        {
                            'id': row.id,
                            'showUrl': route('patients.transactions.show',
                                row.id),
                        },
                    ]

                    return prepareTemplateRender('#transactionsTemplate',
                        patientTransactionData)
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(patientTransactionTbl)




    document.addEventListener('turbo:load', loadTransactionFilterDate)

function loadTransactionFilterDate () {
    if (!$('#transactionDateFilter').length) {
        return
    }

    let appointmentStart = moment().startOf('week')
    let appointmentEnd = moment().endOf('week')

    function cb (start, end) {
        $('#transactionDateFilter').val(
            start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'))
    }

  let transactionDatePicker =  $('#transactionDateFilter').daterangepicker({
        startDate: appointmentStart,
        endDate: appointmentEnd,
        opens: 'left',
        showDropdowns: true,
        locale: {
            customRangeLabel: Lang.get('js.custom'),
            applyLabel:Lang.get('js.apply'),
            cancelLabel: Lang.get('js.cancel'),
            fromLabel:Lang.get('js.from'),
            toLabel: Lang.get('js.to'),
            monthNames: [
                Lang.get('js.jan'),
                Lang.get('js.feb'),
                Lang.get('js.mar'),
                Lang.get('js.apr'),
                Lang.get('js.may'),
                Lang.get('js.jun'),
                Lang.get('js.jul'),
                Lang.get('js.aug'),
                Lang.get('js.sep'),
                Lang.get('js.oct'),
                Lang.get('js.nov'),
                Lang.get('js.dec')
            ],

            daysOfWeek: [
                Lang.get('js.sun'),
                Lang.get('js.mon'),
                Lang.get('js.tue'),
                Lang.get('js.wed'),
                Lang.get('js.thu'),
                Lang.get('js.fri'),
                Lang.get('js.sat')],
        },
        ranges: {
            [Lang.get('js.today')]: [moment(), moment()],
            [Lang.get('js.yesterday')]: [
                moment().subtract(1, 'days'),
                moment().subtract(1, 'days')],
            [Lang.get('js.this_week')]: [moment().startOf('week'), moment().endOf('week')],
            [Lang.get('js.last_30_days')]: [moment().subtract(29, 'days'), moment()],
            [Lang.get('js.this_month')]: [moment().startOf('month'), moment().endOf('month')],
            [Lang.get('js.last_month')]: [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')],
        },
    }, cb)

    cb(appointmentStart, appointmentEnd)


    transactionDatePicker.on("apply.daterangepicker", function (ev, picker) {
        Livewire.dispatch("changeDateFilter", { date: $(this).val(),});
    });
}





}
listenClick('.transaction-statusbar', function (event) {
    let recordId = $(event.currentTarget).attr('data-id')
    let acceptPaymentUserId = currentLoginUserId;

    $.ajax({
        type: 'PUT',
        url: route('transaction.status'),
        data: {id: recordId, acceptPaymentUserId: acceptPaymentUserId},
        success: function (result) {

            if (result.success) {
                Livewire.dispatch('refresh')
                displaySuccessMessage(Lang.get('js.status_update'))
            }
        },
        error: function error(result) {
            Livewire.dispatch('refresh')
            displayErrorMessage(result.responseJSON.message);
        },
    })
})
