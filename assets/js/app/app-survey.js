define([
    "jQuery",
    "jQueryUI",
    "bootstrap", 
    "highchart",
    "sidebar",
    "jqvalidate",  
    "datatables",
     "select2",
    "datatablesBootstrap",
    "bootstrapDatepicker",
    ], function (
    $,
    jQueryUI,
    bootstrapDatepicker,
    bootstrap, 
    highchart,
    jqvalidate,  
    sidebar,
    datatables,
    datatablesBootstrap
    ) {
    return {  
        table:null,
        init: function () { 
            App.initFunc();
            App.initTable();
            App.searchTable(); 
            App.resetSearch(); 
            App.initConfirm();
            $(".loading").hide();
        }, 
        initTable : function(){   
            $('.select2').select2();
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"Hasil_survey/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "id_pelanggan" },
                    { "data": "nama" },
                    { "data": "ktp" },
                    { "data": "tanggal" },
                     { "data": "status" },
                    { "data": "action" }
                ],
                "order": [[ 0, "DESC" ]]       
            });

             $('.datepicker').datepicker({
                //defaultViewDate: '01/01/2019',
                uiLibrary: 'bootstrap4',
                format: 'dd-mm-yyyy',
            });

          
         
            
        },
        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH");
                var nama  = $("#nama").val();
                var ktp   = $("#ktp").val();
                var status   = $("#status").val();
                App.table.column(1).search(nama,true,true);
                App.table.column(2).search(ktp,true,true);
                App.table.column(3).search(status,true,true);
            
                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
          $('#reset').on( 'click', function () {       
            console.log("reset");
          $("#nama").val('');
          $("#ktp").val('');
                App.table.search( '' ).columns().search( '' ).draw();
            });
        },
        initConfirm :function(){
            $('#table tbody').on( 'click', '.delete', function () {
                var url = $(this).attr("url");
                App.confirm("Hapus Data?",function(){
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