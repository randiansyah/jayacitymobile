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
                    { "data": "id_akad" },
                    { "data": "id_invoice" }, 
                    { "data": "id_pelanggan" }, 
                    { "data": "cicilan" }, 
                    { "data": "jumlah_cicilan" }, 
                    { "data": "jumlah_bayar" }, 
                    { "data": "tgl_bayar" },
                    { "data": "aksi" }, 
                ],
                "columnDefs": [{
                    "targets": [8], // Download
                    "visible": true,
                    "searchable": true,
                    "bSortable": false
                }
        
        
            ],
               "order": [[0, 'desc']]          
            });

    
        
        },
       
            
        searchTable:function(){ 
            $('#filter').on('click', function () {
                console.log("SEARCH");
                var status   = $("#status").val();
                var pelanggan   = $("#pelanggan").val();
                var cicilan   = $("#cicilan").val();
                var dari_tgl   = $("#dari_tgl").val();
                var sampai_tgl   = $("#sampai_tgl").val();
                App.table.column(1).search(status,true,true);
                App.table.column(2).search(pelanggan,true,true);
                App.table.column(3).search(cicilan,true,true);
                App.table.column(4).search(dari_tgl,true,true);
                App.table.column(5).search(sampai_tgl,true,true);
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