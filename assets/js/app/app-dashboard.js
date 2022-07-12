define([
    "jQuery",
    "jQueryUI",
    "bootstrap", 
    "highchart",
    "sidebar",
    "jqvalidate",  
    "datatables",
     "select2",
     "moment",
    "datatablesBootstrap",
    "bootstrapDatepicker",
    "bootstrapDaterangepicker",
], function (
    $,
    jQueryUI,
    bootstrapDatepicker,
    bootstrap, 
    highchart,
    jqvalidate,  
    sidebar,
    datatables,
    moment,
    datatablesBootstrap,
    bootstrapDaterangepicker,
) {
  return {
      table: null,
      init: function () {
          App.initFunc();
          App.initTable();
          App.initDatePicker();
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
          var periode_start = $('#periode_start').val();
           var periode_end   = $('#periode_end').val();
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

        var options_sale = {
            chart: {
                renderTo: "sale_count",
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

           function load_daily_transaction_chart() {
            $.ajax({
                type: "POST",
                url: App.baseUrl + "dashboard/transaction_chart",
                data: {
                    periode_start: periode_start,
                    periode_end  : periode_end,
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

        function load_daily_sale_chart() {
            $.ajax({
                type: "POST",
                url: App.baseUrl + "dashboard/sale_chart",
                data: {
                    periode_start: periode_start,
                    periode_end  : periode_end,
                },
                success: function (data) {
                    var objek_JSON = jQuery.parseJSON(data);

                    $.each(objek_JSON, function (index, nilai) {
                        if (index == "date") {
                            options_sale.xAxis.categories = nilai;
                        }
                        if (index == "total") {
                            options_sale.series[0].name = "Transaksi";
                            options_sale.series[0].data = nilai;
                        }
                    });
                    chart = new Highcharts.Chart(options_sale);
                },
            }); 
        }
        load_daily_sale_chart();
         
      },
      
      
      initDatePicker : function(){   
        var valueSet1 = function(start, end, label) {
          $('#daterange-btn span').html(start.format('DD MMM YYYY') + ' - ' + end.format('DD MMM YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(6, 'days'),
          endDate: moment(),
          minDate: '01/01/2015',
          maxDate: moment(),
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            '3 hari terakhir': [moment().subtract(2, 'days'), moment()],
            '10 hari terakhir': [moment().subtract(10, 'days'), moment()],
            '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
            'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },

          opens: 'left',
          format: 'DD/MM/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
            monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            firstDay: 1
          }
        };

        $('#daterange-btn span').html(moment().subtract(6, 'days').format('DD MMM YYYY') + ' - ' + moment().format('DD MMM YYYY'));
        $('#periode_start').val(moment().subtract(6, 'days').format('YYYY-MM-DD'));
        $('#periode_end').val(moment().format('YYYY-MM-DD'));
        $('#daterange-btn').daterangepicker(optionSet1, valueSet1);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
            $('#periode_start').val(picker.startDate.format('YYYY-MM-DD'));
            $('#periode_end').val(picker.endDate.format('YYYY-MM-DD'));
            var periode_start = picker.startDate.format('YYYY-MM-DD');
            var periode_end = picker.endDate.format('YYYY-MM-DD');
             
            if (periode_start != '' && periode_end != '') {
                var fromDate = $('#periode_start').val();
                var EndDate =  $('#periode_end').val();
            } else {
                var fromDate = picker.startDate.format('YYYY-MM-DD');
                var EndDate = picker.endDate.format('YYYY-MM-DD');
            }
            
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
            var options_sale = {
                chart: {
                    renderTo: "sale_count",
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
            $.ajax({
                type: "POST",
                url: App.baseUrl + "dashboard/transaction_chart",
                data: {
                    periode_start: fromDate,
                    periode_end  : EndDate,
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

            $.ajax({
                type: "POST",
                url: App.baseUrl + "dashboard/sale_chart",
                data: {
                    periode_start: fromDate,
                    periode_end  : EndDate,
                },
                success: function (data) {
                    var objek_JSON = jQuery.parseJSON(data);

                    $.each(objek_JSON, function (index, nilai) {
                        if (index == "date") {
                            options_sale.xAxis.categories = nilai;
                        }
                        if (index == "total") {
                            options_sale.series[0].name = "Transaksi";
                            options_sale.series[0].data = nilai;
                        }
                    });
                    chart = new Highcharts.Chart(options_sale);
                },
            });
        }); 
     
      



        
     
    },

 
 
  }
});