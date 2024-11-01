jQuery.noConflict()(function($) {
    "use strict";


    //Select Tab
    $('.tmpray--fill-namaz').show();
    $('.tmpray--select-method').hide();

    $(".tmpray-ui-choose li").on('click', function () {
        if($(this).attr('id')== 'fill'){
            $('.tmpray--fill-namaz').show();
            $('.tmpray--select-method').hide();
            $(this).addClass('selected');
            $(this).siblings('#method').removeClass('selected');

        } else {
            $('.tmpray--fill-namaz').hide();
            $('.tmpray--select-method').show();
            $(this).addClass('selected');
            $(this).siblings('#fill').removeClass('selected');
        }
    });

    //Fill/Add Namaz time
    //Excel To JSON
    $("#tmpray--file_upload").on('change', function () {
        //Reference the FileUpload element.
        var fileUpload = $("#tmpray--file_upload")[0];
        //Validate whether File is valid Excel file.
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();

                //For Browsers other than IE.
                if (reader.readAsBinaryString) {

                    reader.onload = function (e) {

                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.

                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file.");
        }

    });
    function ProcessExcel(data) {
        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });

        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];

        //Read all rows from First Sheet into an JSON array.
        var excelRows = getArray(XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]), $("#tmpray--month_title").val());
        $.ajax({
            type: 'POST',
            url: namazTime.ajaxurl,
            data : {
                action : 'tmpray_process_namaz',
                namaz : excelRows
            },
            success: function(response){
                $("#tmpray--namaz_data").val(response);
                jsonEditorInit('tmpray--table_container', 'Textarea1', 'result_container', 'tmpray--table_to_json_btn', response ,'tmpray--file_upload', 'tmpray--namaz_data');
            },
            error: function(response){
            }
        });
    }
    var current = new Date();

    $('#tmpray--month_title option:eq('+current.getMonth()+')').prop('selected', true);



    //Table




    $("#tmpray--month_title").on('change', function () {
        $.ajax({
            type: 'POST',
            url: namazTime.ajaxurl,
            data : {
                action : 'tmpray_get_json_namaz',
                title : $("#tmpray--month_title").val()
            },
            success: function(response){
                jsonEditorInit('tmpray--table_container', 'Textarea1', 'result_container', 'tmpray--table_to_json_btn', response ,'tmpray--file_upload', 'tmpray--namaz_data');
            },
            error: function(response){
            }
        });
        $.ajax({
            type: 'POST',
            url: namazTime.ajaxurl,
            data : {
                action : 'tmpray_get_days_in_month',
                title : $("#tmpray--month_title").val()
            },
            success: function(response){
                $('#tmpray--table_dates').html(response);
            },
            error: function(response){
            }
        });

    });

    //Save Data
    $('#tmpray--table_to_json_btn').on('click', function(){
        $("#tmpray--namaz_data").val(JSON.stringify(makeJson()));
        var fillmethod = $('ul.tmpray-ui-choose li.selected').attr('id');
        $.ajax({
            type: 'POST',
            url: namazTime.ajaxurl,
            data : {
                action : 'tmpray_save_namaz_time',
                title: $("#tmpray--month_title").val(),
                content : $("#tmpray--namaz_data").val(),
                fillmethod: fillmethod
            },
            success: function(response){
                tmpray_success_function();
            },
            error: function(response){
                tmpray_error_function();
            }
        });
    });

    $('.tmpray-ui-choose').ui_choose();

    jsonEditorInit('tmpray--table_container', 'Textarea1', 'result_container', 'tmpray--table_to_json_btn', $.trim($("#tmpray--json-data-textarea").val()) ,'tmpray--file_upload', 'tmpray--namaz_data');


    function tmpray_general_function(month_title){
        $.ajax({
            type: 'POST',
            url: namazTime.ajaxurl,
            data : {
                action : 'tmpray_get_json_namaz',
                title : month_title
            },
            success: function(response){
                jsonEditorInit('tmpray--table_container', 'Textarea1', 'result_container', 'tmpray--table_to_json_btn', response ,'tmpray--file_upload', 'tmpray--namaz_data');
            },
            error: function(response){
            }
        });
    }


    $('#tmpray--shortcode-single-show').on('click', function(){
        var title = $('#tmpray--shortcodes-single-title-check').prop('checked');
        var fajr = $('#tmpray--shortcodes-fajr-check').prop('checked');
        var sunrise = $('#tmpray--shortcodes-sunrise-check').prop('checked');
        var dhuhr = $('#tmpray--shortcodes-dhuhr-check').prop('checked');
        var asr = $('#tmpray--shortcodes-asr-check').prop('checked');
        var maghrib = $('#tmpray--shortcodes-maghrib-check').prop('checked');
        var isha = $('#tmpray--shortcodes-isha-check').prop('checked');
        $.ajax({
            type: 'POST',
            url: namazTime.ajaxurl,
            data : {
                action : 'tmpray_show_shortcode_single',
                title: title,
                fajr: fajr,
                sunrise: sunrise,
                dhuhr: dhuhr,
                asr: asr,
                maghrib: maghrib,
                isha: isha,
                pref: $("#tmpray--shortcodes-single-pref").val(),
                suf: $("#tmpray--shortcodes-single-suf").val()
            },
            success: function(response){
                $('#tmpray--shortcode-single-name').html(response);
            },
            error: function(response){
            }
        });
    });

    $('#tmpray--shortcode-all-show').on('click', function(){
        var title = $('#tmpray--shortcodes-title-check').prop('checked');
        $.ajax({
            type: 'POST',
            url: namazTime.ajaxurl,
            data : {
                action : 'tmpray_show_shortcode_all',
                title: title,
                pref: $("#tmpray--shortcodes-pref").val(),
                suf: $("#tmpray--shortcodes-suf").val()
            },
            success: function(response){
                $('#tmpray--shortcode-all-name').html(response);
            },
            error: function(response){
            }
        });
    });
    
    var getDaysInMonth = function(month,year) {
        return new Date(year, month, 0).getDate();
    };

    //Method on Change
    $("#tmpray--method").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--asr").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--midnight").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--higher-latitudes").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--tuning-times-fajr").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--tuning-times-sunrise").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--tuning-times-dhuhr").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--tuning-times-asr").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--tuning-times-maghrib").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--tuning-times-isha").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--timezone").on('change', function () {
        tmpray_update_table();
    });
    $("#tmpray--latitude").change( function () {
        tmpray_update_table();
    });
    $("#tmpray--longitude").change( function () {
        tmpray_update_table();
    });


    $('.tmpray--city').geocomplete({
        location: false
    }).bind('geocode:result',function (e, result) {
        $('#tmpray--longitude').val(result.geometry.viewport.ga.j);
        $('#tmpray--latitude').val(result.geometry.viewport.na.j);
        tmpray_update_table();
    });


    //Method save
    $("#tmpray--method-save").on('click', function () {
        var method = $("#tmpray--method").val();
        var asr = $("#tmpray--asr").val();
        var midnight = $("#tmpray--midnight").val();
        var higherlatitudes = $("#tmpray--higher-latitudes").val();
        var fajrtune  = $("#tmpray--tuning-times-fajr").val();
        var sunrisetune  = $("#tmpray--tuning-times-sunrise").val();
        var dhuhrtune  = $("#tmpray--tuning-times-dhuhr").val();
        var asrtune = $("#tmpray--tuning-times-asr").val();
        var maghribtune = $("#tmpray--tuning-times-maghrib").val();
        var ishatune = $("#tmpray--tuning-times-isha").val();
        var latitude = $("#tmpray--latitude").val();
        var longitude = $("#tmpray--longitude").val();
        var timezone = $("#tmpray--timezone").val();
        var city = $("#tmpray--city").val();
        var fillmethod = $('ul.tmpray-ui-choose li.selected').attr('id');

        $.ajax({
            type: 'POST',
            url: namazTime.ajaxurl,
            data : {
                action : 'tmpray_method_namaz',
                method : method,
                fillmethod: fillmethod,
                asr : asr,
                midnight : midnight,
                higherlatitudes : higherlatitudes,
                fajrtune  : fajrtune,
                sunrisetune  : sunrisetune,
                dhuhrtune  : dhuhrtune,
                asrtune : asrtune,
                maghribtune : maghribtune,
                ishatune : ishatune,
                latitude : latitude,
                longitude : longitude,
                timezone : timezone,
                city : city
            },
            success: function(response){
                tmpray_method_success_function();
            },
            error: function(response){
                tmpray_method_error_function();
            }
        });

        tmpray_update_table();

    });

    $('#tmpray--table-month_title option:eq('+current.getMonth()+')').prop('selected', true);
    function tmpray_update_table() {
        var method = $("#tmpray--method").val();
        var asr = $("#tmpray--asr").val();
        var midnight = $("#tmpray--midnight").val();
        var higherlatitudes = $("#tmpray--higher-latitudes").val();
        var fajrtune  = parseInt($("#tmpray--tuning-times-fajr").val());
        var sunrisetune  = parseInt($("#tmpray--tuning-times-sunrise").val());
        var dhuhrtune  = parseInt($("#tmpray--tuning-times-dhuhr").val());
        var asrtune = parseInt($("#tmpray--tuning-times-asr").val());
        var maghribtune = $("#tmpray--tuning-times-maghrib").val();
        var ishatune = $("#tmpray--tuning-times-isha").val();
        var latitude = $("#tmpray--latitude").val();
        var longitude = $("#tmpray--longitude").val();
        var timezone = $("#tmpray--timezone").val();
        var namaztimes = new PrayTimes();
        var month = parseInt($("#tmpray--table-month_title").val());
        var d = new Date();


        namaztimes.setMethod(method);
        namaztimes.adjust({asr:asr, highLats:higherlatitudes, midnight:midnight});
        namaztimes.tune({fajr: fajrtune, sunrise: sunrisetune, dhuhr: dhuhrtune, asr: asrtune, maghrib: maghribtune, isha: ishatune});
        var daysinmonth = getDaysInMonth(month, d.getFullYear());

        var html = '';
        html +='<thead><th>Day</th><th>Fajr</th><th>Sunrise</th><th>Dhuhr</th><th>Asr</th><th>Maghrib</th><th>Isha</th></thead>';
        for(var i = 1; i <= daysinmonth; i++){
            var namazz = namaztimes.getTimes([d.getFullYear(), month, i], [latitude, longitude], timezone);
            html += '<tr><td>' + i + '</td><td>' + namazz.fajr + '</td><td>' + namazz.sunrise + '</td><td>' + namazz.dhuhr + '</td><td>' + namazz.asr + '</td><td>' + namazz.maghrib + '</td><td>' + namazz.isha + '</td></tr>';

            $('#tmpray--table-result').html(html);
        }
    }
    function tmpray_success_function() {
        $("#tmpray--saved").show('slow');
        setTimeout(function() { $("#tmpray--saved").hide('slow'); }, 2000);
    }

    function tmpray_error_function() {
        $("#tmpray--error").show('slow');
        setTimeout(function() { $("#tmpray--error").hide('slow'); }, 2000);
    }

    function tmpray_method_success_function() {
        $("#tmpray--method-saved").show('slow');
        setTimeout(function() { $("#tmpray--method-saved").hide('slow'); }, 2000);
    }

    function tmpray_method_error_function() {
        $("#tmpray--method-error").show('slow');
        setTimeout(function() { $("#tmpray--method-error").hide('slow'); }, 2000);
    }

    $("#tmpray--table-month_title").on('change', function () {
        tmpray_update_table()
    });

    tmpray_update_table();

});