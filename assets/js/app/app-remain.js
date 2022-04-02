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
            App.initEvent();
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
                "paging":   false,
                "ajax":{
                    "url": App.baseUrl+suburl+"/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "total" },
                    { "data": "terbayar" },
                    {"data": "aksi"}

                   
                   
                ],
                 
            });

    

    
        
        },
       
        initEvent:function(){
            $(".bayar").keyup(function(){
                var id          = $(this).attr("id-tr");
              //  var bayar1 = $("#bayar").val();
              //  var bayar         =  $("input[name='bayar[]']").eq(id).val();
      
             // console.log(id);
            // console.log(bayar);
                //console.log(qty*kon + " " +unit);
                //var price       = parseFloat($("input[name='d_price[]']").eq(id).val());
                //var t_nilai     = parseFloat($("input[name='inp_order_total']").val());
                // var t_old       = parseFloat($("#inp_order_total_old").val());
                // var t_sum       = parseFloat($("#inp_order_total_sum").val());
                
                //t_nilai         = t_old - t_sum + (qty * price);
            //    $("input[name='d_qk[]']").eq(id).val(qty*kon + " " +unit);
                //$("input[name='inp_order_total']").val(t_nilai);
                $("input[name='sisa[]']").val(bayar);
                // $("#inp_order_total_sum").val((qty * price));
            }); 

            $('.bayar').trigger("keyup"); 

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