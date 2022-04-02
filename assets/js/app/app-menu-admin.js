define([
    "jQuery",
    "jQueryUI",
    "bootstrap", 
    "highchart",
    "sidebar",
    "datatables",
    "select2",
    "jqvalidate", 
    "datatablesBootstrap",
    ], function (
    $,
    jQueryUI,
    bootstrap, 
    highchart,
    sidebar,
    jqvalidate, 
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
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"menu/dataList_admin",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "url" },
                    { "data": "parent_id" },
                    { "data": "sequence" },
                    { "data": "icon" },
                    { "data": "action" }
                ]      
            });
          
            $("#form").validate({ 
                rules: {
                    menu_name: {
                        required: true
                    },
                    icon: {
                        required: true
                    },
                    parent_id: {
                        required: true
                    },
                    url: {
                        required: true
                    }
                },
                messages: {
                    menu_name: {
                        required: "Nama Menu harus diisi"
                    },
                    icon: {
                        required: "Icon harus diisi"
                    },
                    parent_id: {
                        required: "Induk harus dipilih"
                    },
                    url: {
                        required: "Url harus diisi"
                    }
                }, 
                debug:true,
                
                errorPlacement: function(error, element) {
                    var name = element.attr('name');
                    var errorSelector = '.form-control-feedback[for="' + name + '"]';
                    var $element = $(errorSelector);
                    if ($element.length) { 
                        $(errorSelector).html(error.html());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler : function(form) { 
                    form.submit();
                }                
            });
             $("#kurir_type").select2({
                placeholder: "Pilih Jenis Kategori",
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