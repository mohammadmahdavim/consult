'use strict';
$(document).ready(function () {

    $('input[id="date-picker-shamsi"]').datepicker({
        dateFormat: "yy/mm/dd",
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-new"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-2"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-3"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-4"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-5"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-6"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-7"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-8"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('input[id="date-picker-shamsi-9"]').datepicker({
        dateFormat: "yy/mm/dd",
           showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });


    $('input[name="date-picker-shamsi-list"]').datepicker({
        dateFormat: "yy/mm/dd",
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });

    $('input[name="date-picker-shamsi-limited"]').datepicker({
        dateFormat: "yy/mm/dd",
        showOtherMonths: true,
        selectOtherMonths: true,
        minDate: 0,
        maxDate: "+14D"
    });

    $('input[id="single-date-picker"]').daterangepicker({
        opens: 'left',
        singleDatePicker: true,
        showDropdowns: true,
        "locale": {
            "format": "YYYY/MM/DD",
            "separator": " - ",
            "applyLabel": "اعمال",
            "cancelLabel": "انصراف",
            "fromLabel": "از",
            "toLabel": "تا",
            "customRangeLabel": "سفارشی",
            "weekLabel": "هف",
            "daysOfWeek": [
                "ی",
                "د",
                "س",
                "چ",
                "پ",
                "ج",
                "ش"
            ],
            "monthNames": [
                "ژانویه",
                "فوریه",
                "مارس",
                "آوریل",
                "می",
                "ژوئن",
                "جولای",
                "آگوست",
                "سپتامبر",
                "اکتبر",
                "نوامبر",
                "دسامبر"
            ],
            "firstDay": 6
        }
    });

    $('input[name="simple-date-range-picker"]').daterangepicker({
        opens: 'left',
        "locale": {
            "format": "YYYY/MM/DD",
            "separator": " - ",
            "applyLabel": "اعمال",
            "cancelLabel": "انصراف",
            "fromLabel": "از",
            "toLabel": "تا",
            "customRangeLabel": "سفارشی",
            "weekLabel": "هف",
            "daysOfWeek": [
                "ی",
                "د",
                "س",
                "چ",
                "پ",
                "ج",
                "ش"
            ],
            "monthNames": [
                "ژانویه",
                "فوریه",
                "مارس",
                "آوریل",
                "می",
                "ژوئن",
                "جولای",
                "آگوست",
                "سپتامبر",
                "اکتبر",
                "نوامبر",
                "دسامبر"
            ],
            "firstDay": 6
        }
    });

    $('input[name="simple-date-range-picker-callback"]').daterangepicker(
        {
            "locale": {
                "format": "YYYY/MM/DD",
                "separator": " - ",
                "applyLabel": "اعمال",
                "cancelLabel": "انصراف",
                "fromLabel": "از",
                "toLabel": "تا",
                "customRangeLabel": "سفارشی",
                "weekLabel": "هف",
                "daysOfWeek": [
                    "ی",
                    "د",
                    "س",
                    "چ",
                    "پ",
                    "ج",
                    "ش"
                ],
                "monthNames": [
                    "ژانویه",
                    "فوریه",
                    "مارس",
                    "آوریل",
                    "می",
                    "ژوئن",
                    "جولای",
                    "آگوست",
                    "سپتامبر",
                    "اکتبر",
                    "نوامبر",
                    "دسامبر"
                ],
                "firstDay": 6
            }
        },
        function (start, end, label) {
            swal("یک تاریخ جدید انتخاب شد", start.format('YYYY/MM/DD') + ' تا ' + end.format('YYYY/MM/DD'), "success", {button: 'باشه'});
        }
    );

    $('input[name="datetimes"]').daterangepicker({
        opens: 'left',
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        "locale": {
            format: 'M/DD hh:mm A',
            "separator": " - ",
            "applyLabel": "اعمال",
            "cancelLabel": "انصراف",
            "fromLabel": "از",
            "toLabel": "تا",
            "customRangeLabel": "سفارشی",
            "weekLabel": "هف",
            "daysOfWeek": [
                "ی",
                "د",
                "س",
                "چ",
                "پ",
                "ج",
                "ش"
            ],
            "monthNames": [
                "ژانویه",
                "فوریه",
                "مارس",
                "آوریل",
                "می",
                "ژوئن",
                "جولای",
                "آگوست",
                "سپتامبر",
                "اکتبر",
                "نوامبر",
                "دسامبر"
            ],
            "firstDay": 6
        }
    });

    /**
     * datefilter
     */
    var datefilter = $('input[name="datefilter"]');
    datefilter.daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
        "locale": {
            "format": "YYYY/MM/DD",
            "separator": " - ",
            "applyLabel": "اعمال",
            "cancelLabel": "پاک کردن",
            "fromLabel": "از",
            "toLabel": "تا",
            "customRangeLabel": "سفارشی",
            "weekLabel": "هف",
            "daysOfWeek": [
                "ی",
                "د",
                "س",
                "چ",
                "پ",
                "ج",
                "ش"
            ],
            "monthNames": [
                "ژانویه",
                "فوریه",
                "مارس",
                "آوریل",
                "می",
                "ژوئن",
                "جولای",
                "آگوست",
                "سپتامبر",
                "اکتبر",
                "نوامبر",
                "دسامبر"
            ],
            "firstDay": 6
        }
    });

    datefilter.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });

    $('input.create-event-datepicker').daterangepicker({
        opens: 'left',
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        "locale": {
            "format": "YYYY/MM/DD",
            "separator": " - ",
            "applyLabel": "اعمال",
            "cancelLabel": "انصراف",
            "fromLabel": "از",
            "toLabel": "تا",
            "customRangeLabel": "سفارشی",
            "weekLabel": "هف",
            "daysOfWeek": [
                "ی",
                "د",
                "س",
                "چ",
                "پ",
                "ج",
                "ش"
            ],
            "monthNames": [
                "ژانویه",
                "فوریه",
                "مارس",
                "آوریل",
                "می",
                "ژوئن",
                "جولای",
                "آگوست",
                "سپتامبر",
                "اکتبر",
                "نوامبر",
                "دسامبر"
            ],
            "firstDay": 6
        }
    })
        .on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY/MM/DD'));
        });

});
