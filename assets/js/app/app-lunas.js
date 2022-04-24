define([
    "jQuery",
    "jQueryUI",
    "bootstrap", 
    "highchart",
    "sidebar",
    "jqvalidate",  
    "datatables",
     "select2",
     "moment",
    "datatablesBootstrap",
    "bootstrapDatepicker",
    "bootstrapDaterangepicker",
   
    ], function (
    $,
    jQueryUI,
    bootstrapDatepicker,
    bootstrap, 
    highchart,
    jqvalidate,  
    sidebar,
    datatables,
    moment,
    datatablesBootstrap,
    bootstrapDaterangepicker,
    
    ) {
    return {  
        table:null,
        init: function () { 
            App.initFunc();
            App.initTable();
            App.searchTable(); 
            App.resetSearch(); 
            App.initConfirm();
            App.initDatePicker(); 
            $(".loading").hide();
        }, 
        initTable : function(){  
            var periode_start = $('#periode_start').val();
            var periode_end   = $('#periode_end').val();
         
            $("#konfirmasi").attr("disabled", true);
              $('.select2').select2();
              $('.datepicker').datepicker({
                defaultViewDate: '',
                uiLibrary: 'bootstrap4',
                format: 'dd-mm-yyyy',
            });
            
            var suburl = $('#suburl').val();
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+suburl+"/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                  
                    { "data": "id_pelanggan" }, 
                    { "data": "jumlah_cicilan" }, 
                    { "data": "jumlah_bayar" }, 
                    { "data": "keterangan" }, 
        
                ],
                "columnDefs": [{
                  "targets": [4], // Download
                  "visible": true,
                  "searchable": true,
                  "bSortable": false
              }],
               "order": [[0, 'desc']]          
            });

    
        
        },
        
   
        initDatePicker : function(){   
          var valueSet1 = function(start, end, label) {
            $('#daterange-btn span').html(start.format('DD MMM YYYY') + ' - ' + end.format('DD MMM YYYY'));
          };

          var optionSet1 = {
            startDate: moment().subtract(6, 'days'),
            endDate: moment(),
            minDate: '01/01/2015',
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
              '10 hari terakhir': [moment().subtract(10, 'days'), moment()],
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
          $('#periode_start').val(moment().subtract(6, 'days').format('DD-MM-YYYY'));
          $('#periode_end').val(moment().format('DD-MM-YYYY'));
          $('#daterange-btn').daterangepicker(optionSet1, valueSet1);
          $('#reportrange').on('show.daterangepicker', function() {
            console.log("show event fired");
          });
          $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
              $('#periode_start').val(picker.startDate.format('DD-MM-YYYY'));
              $('#periode_end').val(picker.endDate.format('DD-MM-YYYY'));
              
            

           
          }); 

           
       
      },
            
        searchTable:function(){ 
            $('#filter').on('click', function () {
              
                var pelanggan   = $("#pelanggan").val();
                var start_date   = $("#periode_start").val();
                var end_date   = $("#periode_end").val();
                console.log(start_date);
                App.table.column(1).search(pelanggan,true,true);
                App.table.column(2).search(start_date,true,true);
                App.table.column(3).search(end_date,true,true);
                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () { 
                $("#no_akad").val('');
                $("#pelanggan").find("option:selected").removeAttr("selected");
                $("#pelanggan").val("");
                $("#pelanggan").change();
                $("#cicilan").find("option:selected").removeAttr("selected");
                $("#cicilan").val("");
                $("#cicilan").change();
                $("#pelanggan").val('');
                $("#dari_tgl").val('');
                $("#sampai_tgl").val('');
                App.table.search( '' ).columns().search( '' ).draw();
            
            });
          
        },  
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
        }
    
    }
});