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
      table: null,
      init: function () {
          App.initFunc();
          App.initTable();
          App.searchTable();
          App.resetSearch();
          App.initConfirm();
          App.initEvent();
          $(".loading").hide();
      },
      initTable: function () {
          $("#konfirmasi").attr("disabled", true);
          $('.select2').select2();
          $('.datepicker').datepicker({
              defaultViewDate: '',
              inline: true,
              sideBySide: true,
              uiLibrary: 'bootstrap4',
              format: 'dd-mm-yyyy',
          });

          var suburl = $('#suburl').val();
          App.table = $('#table_tunggakan').DataTable({
              "processing": true,
              "serverSide": true,
              "bPaginate": "5",
              "bLengthChange": false,
              "bFilter": true,
              "bInfo": false,
              "ajax": {
                  "url": App.baseUrl + suburl + "/dataList_tunggakan",
                  "dataType": "json",
                  "type": "POST",
              },
              "columns": [
                  {"data": "id_pelanggan"},
                  {"data": "cicilan"},
                  {"data": "tgl_jatuh_tempo"},
                  {"data": "selisih"},

              ],


          });


      },

      initEvent: function () {
          $(".select2").select2();
          //var periode_start = $('#periode_start').val();
          //  var periode_end   = $('#periode_end').val();
          //product chart
          var options_transaction = {
              chart: {
                  renderTo: "transaction_count",
                  defaultSeriesType: "areaspline",
              },

              credits: {enabled: false},
              title: {
                  text: false,
              },
              xAxis: {
                  enabled: true,
              },
              yAxis: {
                  title: {
                      enabled: false,
                  },

                  labels: {
                      formatter: function () {
                          return Highcharts.numberFormat(this.value, 0, ",", ".");
                      },
                  },
              },

              plotOptions: {
                  areaspline: {
                      fillOpacity: 0.3,
                  },
                  line: {
                      dataLabels: {
                          enabled: true,
                          formatter: function () {
                              return Highcharts.numberFormat(this.value, 2, ",", ".");
                          },
                      },
                      enableMouseTracking: false,
                  },
              },

              series: [
                  {
                      showInLegend: false,
                  },
              ],
          };

          var options_dana_titipan = {
              chart: {
                  renderTo: "dana_titipan",
                  defaultSeriesType: "areaspline",
              },

              credits: {enabled: false},
              title: {
                  text: false,
              },
              xAxis: {
                  enabled: true,
              },
              yAxis: {
                  title: {
                      enabled: false,
                  },

                  labels: {
                      formatter: function () {
                          return Highcharts.numberFormat(this.value, 0, ",", ".");
                      },
                  },
              },

              plotOptions: {
                  areaspline: {
                      fillOpacity: 0.3,
                  },
                  line: {
                      dataLabels: {
                          enabled: true,
                          formatter: function () {
                              return Highcharts.numberFormat(this.value, 2, ",", ".");
                          },
                      },
                      enableMouseTracking: false,
                  },
              },

              series: [
                  {
                      showInLegend: false,
                  },
              ],
          };

          function load_dana_titipan() {
              $.ajax({
                  type: "POST",
                  url: App.baseUrl + "dashboard/dana_titipan_chart",
                  data: {
                      //periode_start: periode_start,
                      // periode_end  : periode_end,
                  },
                  success: function (data) {
                      var objek_JSON = jQuery.parseJSON(data);

                      $.each(objek_JSON, function (index, nilai) {
                          if (index == "date") {
                              options_dana_titipan.xAxis.categories = nilai;
                          }
                          if (index == "total") {
                              options_dana_titipan.series[0].name = "Transaksi";
                              options_dana_titipan.series[0].data = nilai;
                          }
                      });
                      chart = new Highcharts.Chart(options_dana_titipan);
                  },
              });
          }
          load_dana_titipan();


          function load_daily_transaction_chart() {
              $.ajax({
                  type: "POST",
                  url: App.baseUrl + "dashboard/transaction_chart",
                  data: {
                      //periode_start: periode_start,
                      // periode_end  : periode_end,
                  },
                  success: function (data) {
                      var objek_JSON = jQuery.parseJSON(data);

                      $.each(objek_JSON, function (index, nilai) {
                          if (index == "date") {
                              options_transaction.xAxis.categories = nilai;
                          }
                          if (index == "total") {
                              options_transaction.series[0].name = "Transaksi";
                              options_transaction.series[0].data = nilai;
                          }
                      });
                      chart = new Highcharts.Chart(options_transaction);
                  },
              });
          }
          load_daily_transaction_chart();
      },

      searchTable: function () {
          $('#filter').on('click', function () {
              console.log("SEARCH");
              var status = $("#status").val();
              var pelanggan = $("#pelanggan").val();
              var cicilan = $("#cicilan").val();
              var dari_tgl = $("#dari_tgl").val();
              var sampai_tgl = $("#sampai_tgl").val();
              App.table.column(1).search(status, true, true);
              App.table.column(2).search(pelanggan, true, true);
              App.table.column(3).search(cicilan, true, true);
              App.table.column(4).search(dari_tgl, true, true);
              App.table.column(5).search(sampai_tgl, true, true);
              App.table.draw();

          });
      },
      resetSearch: function () {
          $('#reset').on('click', function () {
              $("#no_akad").val('');
              $("#pelanggan").find("option:selected").removeAttr("selected");
              $("#pelanggan").val("");
              $("#pelanggan").change();
              $("#cicilan").find("option:selected").removeAttr("selected");
              $("#cicilan").val("");
              $("#cicilan").change();
              $("#pelanggan").val('');
              $("#dari_tgl").val('');
              $("#sampai_tgl").val('');
              App.table.search('').columns().search('').draw();

          });

      },
      initConfirm: function () {
          $('#table tbody').on('click', '.delete', function () {
              var url = $(this).attr("url");
              App.confirm("Apakah anda yakin ingin menghapus data ini?", function () {
                  $.ajax({
                      method: "GET",
                      url: url
                  }).done(function (msg) {
                      App.table.ajax.reload(null, true);
                  });
              })
          });
      }
  }
});