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
            App.initEvent();
            $(".loading").hide();
        }, 
        initTable : function(){  
            $("#konfirmasi").attr("disabled", true);
              $('.select2').select2();
              $('.datepicker').datepicker({
                //defaultViewDate: '01/01/2019',
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
                    { "data": "kode" },
                    { "data": "nama" },
                    { "data": "tempat_tgl_lahir" },
                    { "data": "NIK" },
                    { "data": "pekerjaan" },
                    { "data": "no_hp" },
                    { "data": "status" },
                    { "data": "cetak" },
                       
                ],
               "order": [[0, 'desc']]          
            });

            $("#surat-akad").validate({ 
                rules: {
                    nama_pk: {
                        required: true
                    },
                  
                },
                messages: {
                    nama_pk: {
                        required: "nama harus diisi"
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
         searchTable:function(){ 
            $('#filter').on('click', function () {
                console.log("SEARCH");
                var no_akad   = $("#no_akad").val();
                var pelanggan   = $("#pelanggan").val();
                var lama_cicilan   = $("#lama_cicilan").val();
                var dari_tgl   = $("#dari_tgl").val();
                var sampai_tgl   = $("#sampai_tgl").val();
                App.table.column(1).search(no_akad,true,true);
                App.table.column(2).search(pelanggan,true,true);
                App.table.column(3).search(lama_cicilan,true,true);
                App.table.column(4).search(dari_tgl,true,true);
                App.table.column(5).search(sampai_tgl,true,true);
                App.table.draw();
                
            }); 

            $('#search').on('click', function () {
                $("#konfirmasi").attr("disabled", false);
                console.log("SEARCH");
                var id_pelanggan = $("#id_invoice").val();
                console.log("SEARCH");
                   $.ajax({
                 url: App.baseUrl+'Akad/dataPelanggan/'+id_pelanggan,
                 type : 'GET',
               //  data : { id_pelanggan:$("#pelanggan").val()},
                 success:function(data){
         
                $('#dataPelanggan').html(data);
                      
                 }
                 
                });
               
                
            }); 
        },
        initEvent:function(){
        $("#nama_pk").keyup(function(){
    var nama         = $("input[name='nama_pk']").val();
        $("#nama_pk1").val(nama);

        });
        $('#nama_pk1').trigger("keyup");  
        //
        $(".cicilan").keyup(function(){
            var nama         = $("input[name='cicilan']").val();
                $("#cicilan1").val(nama);
                $("#cicilan2").val(nama);
                $("#cicilan3").val(nama);
                $("#cicilan4").val(nama);
                });
                $('.cicilan').trigger("keyup"); 
                //
                $(".besaran_terbilang").keyup(function(){
                    var nama         = $("input[name='besaran_terbilang']").val();
                        $("#besaran_terbilang2").val(nama);
                        
                        });
                        $('.besaran_terbilang').trigger("keyup"); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () { 
                $("#no_akad").val('');
                $("#pelanggan").find("option:selected").removeAttr("selected");
                $("#pelanggan").val("");
                $("#pelanggan").change();
                $("#lama_cicilan").find("option:selected").removeAttr("selected");
                $("#lama_cicilan").val("");
                $("#lama_cicilan").change();
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