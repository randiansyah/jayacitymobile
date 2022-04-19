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
                "ajax": {
                    "url": App.baseUrl + suburl + "/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "nomor_akad" },
                    { "data": "id_invoice" },
                    { "data": "id_pelanggan" },
                    { "data": "nama" },
                    { "data": "tgl_akad" },
                    { "data": "lama_cicilan" },
               
                    { "data": "harga_jual" },
                    { "data": "uang_muka" },
                    { "data": "bunga" },
                    { "data": "aksi" },
                ],
                "columnDefs": [{
                    "targets": [10], // Download
                    "visible": true,
                    "searchable": true,
                    "bSortable": false
                }
        
            ],
                "order": [[0, 'DESC']]
            });

            $("#form-akad").validate({
                rules: {
                    id_invoice: {
                        required: true
                    },
                    tgl_akad: {
                        required: true
                    },
                    nomor_akad: {
                        required: true
                    },
                    harga_jual: {
                        required: true
                    },
                    uang_muka: {
                        required: true
                    },
                    lama_cicilan: {
                        required: true
                    },
                    tgl_jatuh_tempo: {
                        required: true
                    },


                },
                messages: {
                    id_invoice: {
                        required: "Invoice harus diisi"
                    },
                    tgl_akad: {
                        required: "Tgl Akad harus diisi"
                    },
                    nomor_akad: {
                        required: "Nomor akad harus diisi"
                    },
                    harga_jual: {
                        required: "Harga Jual harus diisi"
                    },
                    uang_muka: {
                        required: "Harga Jual harus diisi"
                    },
                    admin: {
                        required: "Harga Admin harus diisi"
                    },
                    lama_cicilan: {
                        required: "Lama cicilan harus dipilih"
                    },
                    tgl_jatuh_tempo: {
                        required: "Tgl Jatuh Tempo harus dipilih"
                    },


                },
                debug: true,

                errorPlacement: function (error, element) {
                    var name = element.attr('name');
                    var errorSelector = '.form-control-feedback[for="' + name + '"]';
                    var $element = $(errorSelector);
                    if ($element.length) {
                        $(errorSelector).html(error.html());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
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
            $('#option_bunga').on('change', function () {
                var option_bunga = $("#option_bunga").val();
                if(option_bunga == 1){
                    $("#bungaOption").show();
                    $("#bungaFlat").hide();
                    $("#bunga").val("");
                }else {
                    $("#bungaOption").hide();
                    $("#bungaFlat").show();
                    $("#bungaManual").val("");
                }
              


            });
            // $("#arama").on("keyup", function(event) {
            //     var i = event.keyCode;
            //     if ((i >= 48 && i <= 57) || (i >= 96 && i <= 105)) {
            //       $("#arama").off("keyup");
            //       console.log("Number pressed. Stopping...");
            //     } else {
            //       console.log("Non-number pressed.");
            //     }
            //   });
            $("#simulasi_table").hide();
            $("#bungaFlat").hide();
            $("#bungaOption").hide();
            $('#simulasi').on('click', function () {
                var harga_jual = $("#harga_jual").val();
                var lama_cicilan = $("#lama_cicilan").val();
                var uang_muka = $("#uang_muka").val();
                //option bunga
                var bungaFlat = $("#bunga").val();
                var bungaManual = $("#bungaManual").val();

                var convert = harga_jual.replaceAll('.', '');
                var convert1 = convert.replace('Rp ', '');

                var uang_mukaC1 = uang_muka.replaceAll('.', ''); 
                var uang_mukaC2 = uang_mukaC1.replace('Rp ', '');
                
                var totalDp = convert1 - uang_mukaC2;


                var pokok = totalDp / lama_cicilan;

                if(bungaFlat > 1){
                    var bunga = parseFloat($("#bunga").val()) / 100;
                    var total_bunga = (totalDp * bunga) / lama_cicilan;
                    var total_angsuran = (pokok + total_bunga);
                }else {
                    var bunga = $("#bungaManual").val();
                    var convertBunga = bunga.replaceAll('.', '');
                    var convertBunga1 = convertBunga.replace('Rp ', '');
                    var total_bunga = parseInt(convertBunga1);
                    var total_angsuran = (pokok + total_bunga);
                }

             
                var pokokB = Math.round(pokok);
                var total_angsuranB = Math.round(total_angsuran);
                var bungaB = Math.round(total_bunga);
             
              
                //convert pokok
                var number_string = pokokB.toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                //convert bunga
                var number_string1 = bungaB.toString(),
                    sisa1 = number_string1.length % 3,
                    rupiah1 = number_string1.substr(0, sisa1),
                    ribuan1 = number_string1.substr(sisa1).match(/\d{3}/g);
                if (ribuan1) {
                    separator1 = sisa1 ? '.' : '';
                    rupiah1 += separator1 + ribuan1.join('.');
                }

                //convert total angsuran
                var number_string2 = total_angsuranB.toString(),
                    sisa2 = number_string2.length % 3,
                    rupiah2 = number_string2.substr(0, sisa2),
                    ribuan2 = number_string2.substr(sisa2).match(/\d{3}/g);
                if (ribuan2) {
                    separator2 = sisa2 ? '.' : '';
                    rupiah2 += separator2 + ribuan2.join('.');
                }


                //angsuran pokok
                $("#simulasi_pokok").val(rupiah);
                $("#simulasi_bunga").val(rupiah1);
                $("#simulasi_angsuran").val(rupiah2);

                //   alert(pokok);
                $("#simulasi_table").show();

            });

     

            $('#search').on('click', function () {
                $("#konfirmasi").attr("disabled", false);
                console.log("SEARCH");
                var id_pelanggan = $("#id_invoice").val();
                console.log("SEARCH");
                $.ajax({
                    url: App.baseUrl + 'Akad/dataPelanggan/' + id_pelanggan,
                    type: 'GET',
                    //  data : { id_pelanggan:$("#pelanggan").val()},
                    success: function (data) {

                        $('#dataPelanggan').html(data);

                    }

                });


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