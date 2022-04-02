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
    table: null,
    init: function () {
      App.initFunc();
      App.initTable();
      App.searchTable();
      App.resetSearch();
      App.initConfirm();
      $(".loading").hide();
    },
    initTable: function () {
      $("#konfirmasi").attr("disabled", true);
      $(".select2").select2();
      $(".datepicker").datepicker({
        defaultViewDate: "",
        uiLibrary: "bootstrap4",
        format: "dd-mm-yyyy",
      });

      var suburl = $("#suburl").val();
      App.table = $("#table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: App.baseUrl + suburl + "/dataList",
          dataType: "json",
          type: "POST",
        },
        columns: [
          { data: "id" },
          { data: "id_invoice" },
          { data: "id_pelanggan" },
          { data: "nama" },
          { data: "cicilan" },
          { data: "jumlah_bayar" },
          { data: "tgl_bayar" },
          { data: "keterangan" },
          { data: "aksi" },
        ],
        order: [[0, "desc"]],
      });
      $("#form-dana").validate({ 
        rules: {
            jumlah_dana: {
                required: true
            },
    

        },
        messages: {
            jumlah_dana: {
                required: "Jumlah Bayar Harus di isi"
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

    searchTable: function () {
      $("#filter").on("click", function () {
        console.log("SEARCH");
        var no_akad = $("#no_akad").val();
        var pelanggan = $("#pelanggan").val();
        var lama_cicilan = $("#lama_cicilan").val();
        var dari_tgl = $("#dari_tgl").val();
        var sampai_tgl = $("#sampai_tgl").val();
        App.table.column(1).search(no_akad, true, true);
        App.table.column(2).search(pelanggan, true, true);
        App.table.column(3).search(lama_cicilan, true, true);
        App.table.column(4).search(dari_tgl, true, true);
        App.table.column(5).search(sampai_tgl, true, true);
        App.table.draw();
      });
    },
    resetSearch: function () {
      $("#reset").on("click", function () {
        $("#no_akad").val("");
        $("#pelanggan").find("option:selected").removeAttr("selected");
        $("#pelanggan").val("");
        $("#pelanggan").change();
        $("#lama_cicilan").find("option:selected").removeAttr("selected");
        $("#lama_cicilan").val("");
        $("#lama_cicilan").change();
        $("#pelanggan").val("");
        $("#dari_tgl").val("");
        $("#sampai_tgl").val("");
        App.table.search("").columns().search("").draw();
      });
    },
    initConfirm: function () {
      $("#table tbody").on("click", ".delete", function () {
        var url = $(this).attr("url");
        App.confirm("Apakah anda yakin ingin menghapus data ini?", function () {
          $.ajax({
            method: "GET",
            url: url,
          }).done(function (msg) {
            App.table.ajax.reload(null, true);
          });
        });
      });
    },
  };
});
