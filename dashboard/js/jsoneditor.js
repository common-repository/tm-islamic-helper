var

    // Map over jQuery in case of overwrite
    _jQuery = window.jQuery,

    // Map over the $ in case of overwrite
    _$ = window.$;
jQuery.noConflict = function( deep ) {
    if ( window.$ === jQuery ) {
        window.$ = _$;
    }

    if ( deep && window.jQuery === jQuery ) {
        window.jQuery = _jQuery;
    }
    return jQuery;
};

"use strict";

    var counter_id;
    var gbl_table_container_id;
    var gbl_json_input_container_id;
    var gbl_json_output_container_id;
    var gbl_table_to_json_btn_id;
    var gbl_fileUpload;
    var gpl_data;
    var gbl_namaz_xlsx;
    var max_counter;
    var obj_clicked_row = {};
    var obj_clicked_col = {};

    function jsonEditorInit(table_container_id, json_input_container_id, json_output_container_id,  table_to_json_btn_id, data ,fileUpload,namaz_xlsx) {

        gbl_table_container_id = table_container_id;
        gbl_json_input_container_id = json_input_container_id;
        gbl_json_output_container_id = json_output_container_id;
        gbl_table_to_json_btn_id  =table_to_json_btn_id;
        gbl_fileUpload = fileUpload;
        gbl_namaz_xlsx = namaz_xlsx;
        gpl_data = data;
        try {
            json_arr = JSON.parse(data);
        } catch(e) {
            return;
        }

        jQuery('#' + table_container_id ).html(makeTable(json_arr));
        jQuery('.json_table').addClass('table table-bordered table-striped table-hover table-sm');
        jQuery('.json_table thead').addClass('thead-dark');
    }

jQuery(function() {
    jQuery(document).on('contextmenu', "#json_table_1 td,th", function(e){

            counter_id = jQuery(e.target).closest("tr").attr("counter-id");
            current_counter_id = jQuery(e.currentTarget).attr("counter-id")
            obj_clicked_col[current_counter_id] = jQuery(this).index();
            obj_clicked_row[current_counter_id] = jQuery(this).closest('tr').index();

            console.log('target:', e.target);

            console.log('Col: ' + obj_clicked_col[current_counter_id]);
            console.log('Row: ' + obj_clicked_row[current_counter_id]);
            console.log('Counter id: '+counter_id);
            console.log("table depth: " + $(this).parents('table').length);
        });
    });


    function addTable(){

        clicked_col = obj_clicked_col[counter_id];
        clicked_row = obj_clicked_row[counter_id];

        max_counter++;

        table_template =`<table class = "json_table" counter-id="${max_counter}" id="json_table_${max_counter}">
                        <thead>
                            <tr>
                                <th><div contenteditable="false"></div></th>
                            </tr>
                        </thead>
                        <tbody counter-id="jq{max_counter}" id="json_table_body_${max_counter}">
                            <tr counter-id="${max_counter}">
                                <td counter-id="${max_counter}" td_attr="value">
                                    <div contenteditable="true">1</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>`;

        cell = $(`#json_table_${counter_id} tr[counter-id=${counter_id}]`).eq(clicked_row+1).find(`td[counter-id=${counter_id}]`).eq(clicked_col)
        $(cell).html(table_template);
        $(cell).attr('td_attr','array');

        $(`#json_table_${max_counter}`).addClass('table table-bordered table-striped table-hover table-sm');

    }


    function makeTable(obj_for_table, counter = 1){

        var table_html = jQuery.parseHTML( `<table class = "json_table" counter-id = ${counter} id = "json_table_${counter}"></table>` );
        var i= 0;
        var header_names = {};
        var local_counter = counter;
        var td_attr;

        jQuery.each(obj_for_table, function(level1_k, level1_v){
            jQuery.each(level1_v, function(k, v){
                //console.log('Second Level: ' , key, value);
                if(jQuery.type(v) == 'object'){

                    value = makeTable( JSON.parse(  "[" + JSON.stringify(v) + "]" ), counter+1 );
                    counter++;
                    max_counter = counter;
                    td_attr = 'obj';
                }
                else if(jQuery.type(v) == 'array'){
                    value = makeTable( v, counter+1 );
                    counter++;
                    max_counter = counter;
                    td_attr = 'array';
                }
                else
                {
                    value = "<div contenteditable=true>" + v + "</div>";
                    td_attr = 'value';
                }
                //console.log(v,$.type(v));

                if(typeof(header_names[k]) == "undefined" ){
                    header_names[k] = i;
                    insertColumn(table_html, k, local_counter);
                    i++;
                }

                var cell = jQuery(table_html).find('tr').last().find('td').eq(header_names[k]);
                jQuery(cell).attr('td_attr',td_attr);
                jQuery(cell).attr('counter-id',local_counter);  //counter id at cell level
                jQuery(cell).html(value);

            });

            //td_list = '<td><div contenteditable=true></div></td>'.repeat(i);
            td_list = `<td counter-id = ${local_counter} ><div contenteditable=true></div></td>`.repeat(i); //counter id at cell level
            jQuery(table_html).append( `<tr counter-id = ${local_counter}>' ${td_list} '</tr>`);
        });

        jQuery(table_html).find('tr').last().remove();

        jQuery(table_html).find('td').each(function(td_i,td_v){
            if(jQuery(td_v).attr('td_attr') == undefined){
                jQuery(td_v).attr('td_attr','value');
            }
        });

        return table_html;

    }


    function insertColumn(table_ref, header_name, counter) {

        if( !jQuery(table_ref).find('tr').first().length ){
            //var thead = `<thead  counter-id = ${counter} id = "json_table_header_${counter}"><tr counter-id = ${counter}><th><div contenteditable=true> ${header_name} </div></th></tr></thead>`;
            //var tbody = `<tbody  counter-id = ${counter} id = "json_table_body_${counter}"><tr counter-id = ${counter}><td><div contenteditable=true></div></td></tr></tbody>`;
            var thead = `<thead  counter-id = ${counter} id = "json_table_header_${counter}"><tr counter-id = ${counter}><th counter-id = ${counter} > <div contenteditable=false> ${header_name} </div> </th></tr></thead>`; //counter id at cell level
            var tbody = `<tbody  counter-id = ${counter} id = "json_table_body_${counter}"><tr counter-id = ${counter}><td counter-id = ${counter} ><div contenteditable=true></div></td></tr></tbody>` //counter id at cell level


            jQuery(table_ref).append(thead);
            jQuery(table_ref).append(tbody);
        }

        else
        {
            jQuery(table_ref).find('tr').each(function(){
                //$(this).append('<td><div contenteditable=true></div></td>');
                jQuery(this).append(`<td counter-id = ${counter} ><div contenteditable=true></div></td>`); //counter id at cell level
            })
        }
        var inserted_td = jQuery(table_ref).find('tr').first().find('td').last();

        jQuery(inserted_td).html(header_name);
        //$(inserted_td).replaceWith('<th>' + $(inserted_td).html() + '</th>');
        jQuery(inserted_td).replaceWith(`<th counter-id = ${counter}><div contenteditable=false>` + jQuery(inserted_td).html() + `</div></th>`); //counter id at cell level

    }


    function makeJson(counter=1){

        var header = [];
        var data = [];


        jQuery('#json_table_header_'+ counter + ' th').each(function(i, v){
            header[i] = jQuery(this).text().trim();
        });
        //console.log('header: ', header, counter);
        var row_finder = `#json_table_body_${counter} tr[counter-id=${counter}]`;
        jQuery(row_finder).each(function(row_i, row_v){

            var obj = {};
            //console.log('Outer loop id, value: ', row_i, row_v);

            jQuery(header).each(function(header_i, header_value){

                var cell = jQuery(row_v).children('td').eq(header_i);
                var td_attr = jQuery(cell).attr('td_attr');
                var inner_text = jQuery(cell).children('div').text().trim();
                var inner_table = jQuery(cell).find('table');

                switch(td_attr){
                    case 'value':
                        if(inner_text != "" && inner_text != null ){
                            obj[header_value] = inner_text;
                        }else{
                            obj[header_value] = inner_text;
                        }
                        break;

                    case 'obj':
                    case 'array':
                        obj[header_value] = makeJson( $(inner_table).attr('counter-id') );
                        break;

                    case null:
                    case 'sss':
                    case undefined:

                        break;

                    default:
                        obj[header_value] = "unknown value";
                        break;
                }
                //console.log('value of td_attr: ', td_attr);

            });
            //console.log('data value: ', data);
            data.push(obj);
        });

        //return JSON.stringify(data);
        return data;
    }


