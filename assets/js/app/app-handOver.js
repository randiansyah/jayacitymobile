define([
    "jQuery",
    "jQueryUI",
    "bootstrap", 
    "highchart",
    "sidebar",
    "datatables",
    "datatablesBootstrap",
    "select2"
    ], function (
    $,
    jQueryUI,
    bootstrap, 
    highchart,
    sidebar ,
    datatables,
    datatablesBootstrap,
    select2
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
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"Hand_over/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "id_pelanggan" },
                    { "data": "image" },
                    { "data": "created_at" },
                    { "data": "action" }
                ],
                "order": [[ 2, "desc" ]]     
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