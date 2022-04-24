define([
    "jQuery",
    "jQueryUI",
    "bootstrap", 
    "highchart",
    "sidebar",
    "select2",
    "datatables",
    "datatablesBootstrap",
    ], function (
    $,
    jQueryUI,
    bootstrap, 
    highchart,
    sidebar ,
    datatables,
    datatablesBootstrap
    ) {
    return {  
        table:null,
        init: function () { 
        	App.initFunc();
            App.initEvent();   
            App.initConfirm();
            $(".loading").hide();
		}, 
        initEvent : function(){  
            $('.select2').select2();
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
                    { "data": "cicilan" },
                    { "data": "nama_barang" },  
                    { "data": "text" },
                    { "data": "status" },

                ],
                "columnDefs": [{
                    "targets": [5], 
                    "visible": true,
                    "searchable": false,
                    "bSortable": false
                }],   
                "order":[[0, 'DESC']]    
            });
            
         
            
        },
        initConfirm :function(){
            $('#table tbody').on( 'click', '.terima', function () {
                var url = $(this).attr("url");
                App.confirm("Setujui penangguhan?",function(){
                   $.ajax({
                      method: "GET",
                      url: url
                    }).done(function( msg ) {
                        App.table.ajax.reload(null,true);
                    });        
                })
            });
            $('#table tbody').on( 'click', '.tolak', function () {
                var url = $(this).attr("url");
                App.confirm("Tolak penangguhan?",function(){
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