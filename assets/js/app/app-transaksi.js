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
                    { "data": "id_invoice" },
                    { "data": "id_pelanggan" },
                    { "data": "nama" },
                    { "data": "nama_barang" },
                    { "data": "harga_jual" },
                    { "data": "id_cicilan" },
                    { "data": "tgl_jatuh_tempo" },
                    { "data": "status" }

                   
                   
                ],
               "order": [[0, 'desc']]          
            });
            
            $("#form-transaksi").validate({ 
                rules: {
                    no_invoice: {
                        required: true
                    },
                    pelanggan: {
                        required: true
                    },
                    tgl_beli: {
                        required: true
                    },
                    nama_barang: {
                        required: true
                    },
                    merek: {
                        required: true
                    },
                    tipe: {
                        required: true
                    },
                    warna: {
                        required: true
                    },
                    sn: {
                        required: true
                    },
                    imei1: {
                        required: true
                    },
                    imei2: {
                        required: true
                    },
                    lainnya: {
                        required: true
                    },
                    keterangan: {
                        required: true
                    },
                    admin: {
                        required: true
                    },
                    harga_partai: {
                        required: true
                    },
                    harga_jual: {
                        required: true
                    },
                    harga_retail: {
                        required: true
                    },
                    lama_cicilan: {
                        required: true
                    },
                    tgl_jatuh_tempo: {
                        required: true
                    },
                    nama_toko: {
                        required: true
                    },


                },
                messages: {
                    no_invoice: {
                        required: "Invoice harus diisi"
                    },
                    pelanggan: {
                        required: "Pelanggan harus diisi"
                    },
                    tgl_beli: {
                        required: "Tgl Beli harus diisi"
                    },
                    nama_barang: {
                        required: "Nama Barang harus diisi"
                    },
                    merek: {
                        required: "Merek harus diisi"
                    },
                    tipe: {
                        required: "Tipe harus diisi"
                    },
                    warna: {
                        required: "Warna harus diisi"
                    },
                    sn: {
                        required: "Sn harus diisi"
                    },
                    imei1: {
                        required: "Imei1 harus diisi"
                    },
                    imei2: {
                        required: "Imei2 harus diisi"
                    },
                    lainnya: {
                        required: "Lainnya harus diisi"
                    },
                    keterangan: {
                        required: "Keterangan harus diisi"
                    },
                    admin: {
                        required: "Harga Admin harus diisi"
                    },
                    harga_partai: {
                        required: "Harga Partai harus diisi"
                    },
                    harga_retail: {
                        required: "Harga Retail harus diisi"
                    },
                    harga_jual: {
                        required: "Harga Jual harus diisi"
                    },
                    lama_cicilan: {
                        required: "Lama cicilan harus dipilih"
                    },
                    tgl_jatuh_tempo: {
                        required: "Tgl Jatuh Tempo harus dipilih"
                    },
                    nama_toko: {
                        required: "Nama Toko harus diisi"
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
            $('#search').on('click', function () {
                console.log("SEARCH");
                var invoice   = $("#invoice").val();
                var pelanggan   = $("#pelanggan").val();
                var lama_cicilan   = $("#lama_cicilan").val();
                var tgl_jatuh_tempo   = $("#tgl_jatuh_tempo").val();
                App.table.column(1).search(invoice,true,true);
                App.table.column(2).search(pelanggan,true,true);
                App.table.column(3).search(lama_cicilan,true,true);
                App.table.column(4).search(tgl_jatuh_tempo,true,true);
                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () { 
                console.log("RESET");
                $("#invoice").val('');
                $("#pelanggan").find("option:selected").removeAttr("selected");
                $("#pelanggan").val("");
                $("#pelanggan").change();
                $("#lama_cicilan").find("option:selected").removeAttr("selected");
                $("#lama_cicilan").val("");
                $("#lama_cicilan").change();
                $("#pelanggan").val('');
                $("#tgl_jatuh_tempo").val('');
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