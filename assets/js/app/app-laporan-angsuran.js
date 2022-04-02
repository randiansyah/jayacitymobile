define([
    "jQuery",
    "jQueryUI",
    "bootstrap", 
    "sidebar",
    "datatables",
    "bootstrapDatepicker",
    "select2",
    "datatablesBootstrap"
    ], function (
    $,
    jQueryUI,
    bootstrap, 
    sidebar ,
    datatables,
    bootstrapDatepicker,
    datatablesBootstrap
    ) {
    return {  
        table:null,

        init: function () { 
            App.initFunc();
            App.initEvent();  
            App.searchTable();
            App.resetSearch(); 
            App.initConfirm();
            $(".loading").hide();
		}, 

        initEvent : function(){  
            $('.select2').select2();
       

        },
        
        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH");
                var periode_start  = $("#periode_start").val();
                var periode_end  = $("#periode_end").val();
                App.table.column(1).search(periode_start,true,true);
                App.table.column(2).search(periode_end,true,true);
                App.table.draw();
                
            }); 
        },

        resetSearch:function(){
          $('#reset').on( 'click', function () {       
          $("#periode_start").val('');
          $("#periode_end").val('');

                App.table.search( '' ).columns().search( '' ).draw();
            });
        },

        initConfirm :function(){
            $('#table tbody').on( 'click', '.delete', function () {
                var url = $(this).attr("url");
                App.confirm("Apakah Data ini mau di nonaktifkan ?",function(){
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
