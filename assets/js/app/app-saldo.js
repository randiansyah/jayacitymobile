define([
    "jQuery",
    "jqvalidate",
    "bootstrap", 
    "bootstrapDatepicker",
    "sidebar",
    "datatables",
    "datatablesBootstrap",
    "select2",
    ], function (
    $,
    jqvalidate,
    bootstrap,
    bootstrapDatepicker,
    sidebar,
    datatables,
    datatablesBootstrap,
    select2,
    ){ 
    return {
        table:null,
        init: function () {  
            App.initFunc();
            App.initEvent();
            App.initConfirm();
            App.searchTable();
            App.resetSearch();
            $('.select2').select2();
            $(".loading").hide();
        },
        initEvent : function(){
            App.table = $('#table').DataTable({
                "language": {
                    "search": "Cari",
                    "lengthMenu": "Tampilkan _MENU_ baris per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang ditampilkan ",
                    "infoFiltered": "(pencarian dari _MAX_ total records)",
                    "paginate": {
                        "first":      "Pertama",
                        "last":       "Terakhir",
                        "next":       "Selanjutnya",
                        "previous":   "Sebelum"
                    },
                },
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"finace/listSaldo",
                    "dataType": "json",
                    "type": "POST",
                    
                },
               "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "amount" },
                    { "data": "description" },
                    { "data": "type" },
                    // { "data": "created_at" },
                    { "data": "action", "orderable": false }
                ]      
            }); 
        }, 

        searchTable:function(){ 
            $('#search').click(function(event) {
                type       = $("#type").val();
                App.table.column(1).search(type,true,true);
                App.table.draw();
            });
        },

        resetSearch:function(){
            $('#reset').on( 'click', function () {
                $("#type").val("");

                App.table.search( '' ).columns().search( '' ).draw();
            });
        },

        initConfirm :function(){
            $('#table tbody').on( 'click', '.delete', function () {
                var url = $(this).attr("url");
                App.confirm("Apakah Anda Yakin Untuk delete Ini?",function(){
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