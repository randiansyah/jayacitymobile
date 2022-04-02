define([
    "jQuery",
    "jQueryUI",
    "bootstrap", 
    "highchart",
    "sidebar",
    "jqvalidate",  
    "moment",
    "datatables",
    "select2",
    "datatablesBootstrap",
    "bootstrapDaterangepicker",
    "bootstrapDatepicker",
    ], function (
    $,
    jQueryUI,
    bootstrapDatepicker,
    bootstrapDaterangepicker,
    bootstrap, 
    highchart,
    moment,
    jqvalidate,  
    sidebar,
    datatables,
    datatablesBootstrap,
    ) {
    return {  
        table:null,
        init: function () { 
            App.initFunc();
            App.initTable();
            App.initDatePicker();
            // App.searchTable(); 
            // App.resetSearch(); 
            App.initConfirm();
            $(".loading").hide();
        }, 
        initTable : function(){  
            $("#konfirmasi").attr("disabled", true);
              $('.select2').select2();
              $('.datepicker').datepicker({
                //defaultViewDate: '01/01/2019',
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd',
            });
            var suburl = $('#suburl').val();
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'Bfrtip',
                "buttons": [
                   'pdf', 'print'
                ],
                "ajax":{
                    "url": App.baseUrl+suburl+"/dataIncome",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (data) {
                        data.id = $('#id').val();
                        data.periode_start = $('#periode_start').val();
                        data.periode_end = $('#periode_end').val();
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "amount" },
                    { "data": "description" },
                    { "data": "type" },
                    { "data": "created_at" }
                ],
               "order": [[0, 'desc']]          
            });
           
        
        },           
        //  searchTable:function(){ 
        //     $('#filter').on('click', function () {
        //         console.log("SEARCH");
        //         var dari_tgl   = $("#dari_tgl").val();
        //         var sampai_tgl   = $("#sampai_tgl").val();
        //         App.table.column(1).search(dari_tgl,true,true);
        //         App.table.column(2).search(sampai_tgl,true,true);
        //         App.table.draw();
                
        //     }); 
        // },
        // resetSearch:function(){
        //     $('#reset').on( 'click', function () { 
        //         $("#dari_tgl").val('');
        //         $("#sampai_tgl").val('');
        //         App.table.search( '' ).columns().search( '' ).draw();
            
        //     });
          
        // },  
        initConfirm :function(){
            $('#table tbody').on( 'click', '.delete', function () {
                var url = $(this).attr("url");
                App.confirm("Apakah anda yakin ingin menghapus data ini?",function(){
                   $.ajax({
                      method: "GET",
                      url: url
                    }).done(function( msg ) {
                        App.table.ajax.reload(null,true);
                    });        
                })
            });
        },

        initDatePicker: function () {


            var valueSet1 = function (start, end, label) {
                $('#daterange-btn span').html(start.format('DD MMM YYYY') + ' - ' + end.format('DD MMM YYYY'));
            };
  
            var optionSet1 = {
                startDate: moment().subtract(6, 'days'),
                endDate: moment(),
                minDate: '01/01/2020',
                maxDate: moment(),
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    '3 hari terakhir': [moment().subtract(2, 'days'), moment()],
                    '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
  
                opens: 'left',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
                    monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                    firstDay: 1
                }
            };
  
            $('#daterange-btn span').html(moment().subtract(6, 'days').format('DD MMM YYYY') + ' - ' + moment().format('DD MMM YYYY'));
            $('#periode_start').val(moment().subtract(6, 'days').format('YYYY-MM-DD'));
            $('#periode_end').val(moment().format('YYYY-MM-DD'));
            $('#daterange-btn').daterangepicker(optionSet1, valueSet1);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#daterange-btn').on('apply.daterangepicker', function (ev, picker) {
                $('#periode_start').val(picker.startDate.format('YYYY-MM-DD'));
                $('#periode_end').val(picker.endDate.format('YYYY-MM-DD'));
  
                var periode_start = $('#periode_start').val();
                var periode_end = $('#periode_end').val();
  
                App.table.column(1).search(periode_start, true, true);
                App.table.column(2).search(periode_end, true, true);
                App.table.draw();
  
                var uri = '';
                var uri_rincian = '';
                // buat export csv
                //uri+= '';
  
  
                var suburl = $('#suburl').val();
                uri = '/' + periode_start + '/' + periode_end;
                var url = App.baseUrl+suburl+"/export_income" + uri;

                $('#print-pdf').click(function () {
                    window.open(App.baseUrl + suburl + '/export_income' + uri);
                 })
  
  
                // $('#print-pdf-rincian').attr({href  : url_rincian});
  
  
            });
            $('#daterange-btn').on('cancel.daterangepicker', function (ev, picker) {
               
            });
        },
    }
});