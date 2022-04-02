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
            App.searchTable();
            App.resetSearch();
            App.initEvent();
            App.initConfirm();
            $(".loading").hide();
        },
        initTable: function () {
            $("#konfirmasi").attr("disabled", true);
            $('.select2').select2();
            $('.datepicker').datepicker({
                defaultViewDate: '',
                uiLibrary: 'bootstrap4',
                format: 'dd-mm-yyyy',
            });
            $('.timepicker1').timepicker({
                maxHours: 24,
                showMeridian: false,
                defaultTime: false
            });

            var suburl = $('#suburl').val();
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": App.baseUrl + suburl + "/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "nomor_akad" },
                    { "data": "id_invoice" },
                    { "data": "nama" },
                    { "data": "tgl_akad" },
                    { "data": "lama_cicilan" },
                    { "data": "harga_jual" },
                    { "data": "bunga" },
                    { "data": "total" },
                    { "data": "terbayar" },
                    { "data": "sisa_pembayaran" },
                    { "data": "aksi" }



                ],
                "order": [[0, 'desc']]
            });

        },

        initEvent: function () {
            $( ".jumlah_bayar" ).keyup(function() {
                var value = $(this).val();
                var convert = value.replaceAll('.', '');
                var convert1 = convert.replace('Rp ', '');
 
                var total = $('.total').val();
                var sisa = (convert1 - total);
                  //convert 
                  var number_string = sisa.toString(),
                  sisa = number_string.length % 3,
                  rupiah = number_string.substr(0, sisa),
                  ribuan = number_string.substr(sisa).match(/\d{3}/g);
              if (ribuan) {
                  separator = sisa ? '.' : '';
                  rupiah += separator + ribuan.join('.');
    
              }
 
                $('.sisa').val('Rp. '+rupiah);
               });
            $('.btn-sisa').on('click', function () {
                  const total = $(this).data('total');
           

                //convert rupiah
                var number_string1 = total.toString(),
                sisa1 = number_string1.length % 3,
                rupiah1 = number_string1.substr(0, sisa1),
                ribuan1 = number_string1.substr(sisa1).match(/\d{3}/g);
            if (ribuan1) {
                separator1 = sisa1 ? '.' : '';
                rupiah1 += separator1 + ribuan1.join('.');
  
            }

         

                $('.jumlah_bayar').val('Rp. '+rupiah1);
                $('.sisa').val('Rp. 0');
 
            });
            $('.btn-buy').on('click', function () {
                // get data from button edit
                const id = $(this).data('id');
                const denda = $(this).data('denda');
                const diskon = $(this).data('diskon');
                const total = $(this).data('total');
                const teller = $(this).data('teller');
                const keterangan = $(this).data('keterangan');

                 //convert denda
                 var number_string = denda.toString(),
                 sisa = number_string.length % 3,
                 rupiah = number_string.substr(0, sisa),
                 ribuan = number_string.substr(sisa).match(/\d{3}/g);
             if (ribuan) {
                 separator = sisa ? '.' : '';
                 rupiah += separator + ribuan.join('.');
   
             }

                //convert rupiah
                var number_string1 = total.toString(),
                sisa1 = number_string1.length % 3,
                rupiah1 = number_string1.substr(0, sisa1),
                ribuan1 = number_string1.substr(sisa1).match(/\d{3}/g);
            if (ribuan1) {
                separator1 = sisa1 ? '.' : '';
                rupiah1 += separator1 + ribuan1.join('.');
  
            }

              //convert diskonm
              var number_string2 = diskon.toString(),
              sisa2 = number_string2.length % 3,
              rupiah2 = number_string2.substr(0, sisa2),
              ribuan2 = number_string2.substr(sisa2).match(/\d{3}/g);
          if (ribuan2) {
              separator2 = sisa2 ? '.' : '';
              rupiah2 += separator2 + ribuan2.join('.');

          }

            
                $('.id_angsuran').val(id);
                $('.teller').val(teller);
                $('.denda').val('Rp. '+rupiah);
                $('.keterangan').val(keterangan);
                $('.diskon').val('Rp. '+rupiah2);

                $('#buyModal').modal('show');
            });

        },
        searchTable: function () {
            $('#filter').on('click', function () {
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
            $('#reset').on('click', function () {
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