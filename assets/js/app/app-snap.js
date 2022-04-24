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
    "bootstrapTimepicker",
], function (
    $,
    jQueryUI,
    bootstrapDatepicker,
    bootstrap,
    highchart,
    jqvalidate,
    sidebar,
    datatables,
    datatablesBootstrap,
    bootstrapTimepicker,
) {
    return {
        table: null,
        init: function () {
            App.initFunc();
            App.initTable();
     
           
            App.initEvent();

            $(".loading").hide();
        },
        initTable: function () {
       

        },

        initEvent: function () {

            $('input[type="checkbox"]').change(function()
      {

    var total = 0;
    var id = "";
    $.each($("input[name='type']:checked"), function(){
        total += parseInt($(this).val());
        id += $(this).data('id') + ",";
    });
    $('.id_angsuran').val(id);
    $('.jumlah').val(total);
    $('.text').val(total);
         //convert rupiah
         var number_string1 = total.toString(),
         sisa1 = number_string1.length % 3,
         rupiah1 = number_string1.substr(0, sisa1),
         ribuan1 = number_string1.substr(sisa1).match(/\d{3}/g);
     if (ribuan1) {
         separator1 = sisa1 ? '.' : '';
         rupiah1 += separator1 + ribuan1.join('.');

     }
     $('.text').val('Rp. '+rupiah1);
    
      });
            
         

        },
    
  
     

    }
});