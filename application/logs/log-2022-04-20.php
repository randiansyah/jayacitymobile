<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-20 00:01:29 --> Query error: Unknown column 'notification.tipe' in 'where clause' - Invalid query: SELECT `angsuran`.*, `k`.`nama`, `k`.`email`, `k`.`no_hp`, `p`.`nama` as `namaPelanggan`, `p`.`email` as `emailPelanggan`, `p`.`no_telp` as `telpPelanggan`, `t`.`nama_barang`, `t`.`imei1`
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan` = `angsuran`.`id_pelanggan`
JOIN `transaksi` as `t` ON `t`.`id_invoice` = `angsuran`.`id_invoice`
JOIN `notification` as `n` ON `n`.`id_merek` = `t`.`merek`
JOIN `karyawan` as `k` ON `k`.`id` = `n`.`id_karyawan`
WHERE `angsuran`.`status` = 0
AND `angsuran`.`tgl_jatuh_tempo` >= '2022-04-20 00:00:00'
AND `angsuran`.`tgl_jatuh_tempo` <= '2022-04-20 23:59:59'
AND `notification`.`tipe` = 1
ERROR - 2022-04-20 00:03:23 --> Query error: Unknown column 'typenya' in 'where clause' - Invalid query: SELECT `angsuran`.*, `k`.`nama`, `k`.`email`, `k`.`no_hp`, `p`.`nama` as `namaPelanggan`, `p`.`email` as `emailPelanggan`, `p`.`no_telp` as `telpPelanggan`, `t`.`nama_barang`, `t`.`imei1`, `n`.`tipe` as `typenya`
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan` = `angsuran`.`id_pelanggan`
JOIN `transaksi` as `t` ON `t`.`id_invoice` = `angsuran`.`id_invoice`
JOIN `notification` as `n` ON `n`.`id_merek` = `t`.`merek`
JOIN `karyawan` as `k` ON `k`.`id` = `n`.`id_karyawan`
WHERE `angsuran`.`status` = 0
AND `angsuran`.`tgl_jatuh_tempo` >= '2022-04-20 00:00:00'
AND `angsuran`.`tgl_jatuh_tempo` <= '2022-04-20 23:59:59'
AND `typenya` = 1
ERROR - 2022-04-20 00:10:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp1\htdocs\git1\jayacitymobile\application\controllers\Setoran_angsuran.php 327
