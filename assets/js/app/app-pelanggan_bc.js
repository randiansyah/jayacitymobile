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
                    "url": App.baseUrl+"customer/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "id_pelanggan" },
                    { "data": "nama" },
                    { "data": "ktp" },
                    { "data": "email" },
                    { "data": "jenis_kelamin" },
                    { "data": "no_telp" },
                    { "data": "alamat_sekarang" },
                    { "data": "action" }
                ]      
            });
            $("#form-pelanggan").validate({ 
                rules: {
                    jenis_kelamin: {
                        required: true
                    },
                    nama: {
                        required: true
                    },
                },
                messages: {
                    jenis_kelamin: {
                        required: "Jenis Kelamin harus diisi"
                    },
                    nama: {
                        required: "Nama harus diisi"
                    },

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