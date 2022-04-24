<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-21 06:43:35 --> Query error: Unknown column 'a' in 'field list' - Invalid query: SELECT `brand`.*, `a`.`tgl_jatuh_tempo`, COUNT(a) as jumlah
FROM `brand`
JOIN `transaksi` as `s` ON `s`.`merek`=`brand`.`id`
JOIN `angsuran` as `a` ON `a`.`id_invoice`=`s`.`id_invoice`
WHERE `a`.`status` = 0
AND `a`.`tgl_jatuh_tempo` <= '2022-04-21 00:00:00'
GROUP BY `id`
ORDER BY `id` ASC
 LIMIT 10
ERROR - 2022-04-21 06:52:42 --> 404 Page Not Found: Laporan_tunggakan/2
ERROR - 2022-04-21 07:07:55 --> Severity: error --> Exception: Too few arguments to function tunggakan_brand::view(), 0 passed in E:\xampp72\htdocs\git\jayacitymobile\system\core\CodeIgniter.php on line 532 and exactly 1 expected E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 88
ERROR - 2022-04-21 07:08:38 --> Severity: error --> Exception: Too few arguments to function tunggakan_brand::view(), 0 passed in E:\xampp72\htdocs\git\jayacitymobile\system\core\CodeIgniter.php on line 532 and exactly 1 expected E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 88
ERROR - 2022-04-21 07:08:43 --> Severity: error --> Exception: Too few arguments to function tunggakan_brand::view(), 0 passed in E:\xampp72\htdocs\git\jayacitymobile\system\core\CodeIgniter.php on line 532 and exactly 1 expected E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 88
ERROR - 2022-04-21 07:08:55 --> Severity: error --> Exception: Too few arguments to function tunggakan_brand::view(), 0 passed in E:\xampp72\htdocs\git\jayacitymobile\system\core\CodeIgniter.php on line 532 and exactly 1 expected E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 88
ERROR - 2022-04-21 07:09:01 --> Severity: error --> Exception: Too few arguments to function tunggakan_brand::view(), 0 passed in E:\xampp72\htdocs\git\jayacitymobile\system\core\CodeIgniter.php on line 532 and exactly 1 expected E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 88
ERROR - 2022-04-21 07:19:33 --> Query error: Incorrect parameter count in the call to native function 'DATEDIFF' - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), `s`.`merek`, CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE `s`.`merek` = '2'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:19:35 --> Query error: Incorrect parameter count in the call to native function 'DATEDIFF' - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), `s`.`merek`, CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE `s`.`merek` = '2'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `jumlah_bayar` ASC
 LIMIT 10
ERROR - 2022-04-21 07:19:41 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:19:41 --> Query error: Incorrect parameter count in the call to native function 'DATEDIFF' - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), `s`.`merek`, CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE `s`.`merek` = '2'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ERROR - 2022-04-21 07:20:09 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:20:22 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:20:24 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:20:27 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:20:29 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:20:32 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:20:34 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:21:17 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-18'
AND `tgl_jatuh_tempo` <= '2022-04-18'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:21:28 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:21:32 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:21:40 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:22:09 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:22:17 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:23:07 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:23:10 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:24:04 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:24:10 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `s`.`merek` = '2'
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:24:16 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:24:47 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:24:47 --> Severity: Notice --> Undefined variable: id E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 135
ERROR - 2022-04-21 07:24:49 --> Severity: Notice --> Undefined variable: id E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 135
ERROR - 2022-04-21 07:25:01 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:25:06 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:25:58 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:26:10 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:27:12 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:27:14 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:30:47 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*
FROM `angsuran`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
OR  id_pelanggan  LIKE '%153%' ESCAPE '!' 
ERROR - 2022-04-21 07:30:49 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*
FROM `angsuran`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
OR  id_pelanggan  LIKE '%153%' ESCAPE '!' 
ERROR - 2022-04-21 07:30:51 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*
FROM `angsuran`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
OR  id_pelanggan  LIKE '%153%' ESCAPE '!' 
ERROR - 2022-04-21 07:30:58 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:31:17 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:31:23 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:31:45 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:31:48 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:31:55 --> 404 Page Not Found: Git/jayacitymobile
ERROR - 2022-04-21 07:32:03 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:32:10 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:32:21 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:32:25 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:33:18 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih, `angsuran`.`id_pelanggan`
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:33:26 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih, `angsuran`.`id_pelanggan`
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
JOIN `brand` as `b` ON `b`.`id`=`s`.`merek`
WHERE  id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:34:34 --> Query error: Unknown column 's.id_pelanggan' in 'where clause' - Invalid query: SELECT `angsuran`.*
FROM `angsuran`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
OR  s.id_pelanggan  LIKE '%153%' ESCAPE '!' 
ERROR - 2022-04-21 07:34:42 --> Query error: Unknown column 's.id_pelanggan' in 'where clause' - Invalid query: SELECT `angsuran`.*
FROM `angsuran`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
OR  s.id_pelanggan  LIKE '%153%' ESCAPE '!' 
ERROR - 2022-04-21 07:34:48 --> Query error: Unknown column 's.id_pelanggan' in 'where clause' - Invalid query: SELECT `angsuran`.*
FROM `angsuran`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
OR  s.id_pelanggan  LIKE '%155%' ESCAPE '!' 
ERROR - 2022-04-21 07:35:00 --> Query error: Unknown column 's.id_pelanggan' in 'where clause' - Invalid query: SELECT `angsuran`.*
FROM `angsuran`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
OR  s.id_pelanggan  LIKE '%153%' ESCAPE '!' 
ERROR - 2022-04-21 07:35:30 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:35:41 --> Severity: error --> Exception: Too few arguments to function tunggakan_brand::dataList_brand(), 0 passed in E:\xampp72\htdocs\git\jayacitymobile\system\core\CodeIgniter.php on line 532 and exactly 1 expected E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 105
ERROR - 2022-04-21 07:35:46 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:36:08 --> Query error: Unknown column 's.id_pelanggan' in 'field list' - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih, `s`.`id_pelanggan`
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:36:23 --> Query error: Unknown column 's.id_pelanggan' in 'field list' - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih, `s`.`id_pelanggan`
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
WHERE `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:38:04 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:39:14 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:39:19 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:39:34 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:39:40 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:41:09 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:41:12 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:41:23 --> Query error: Column 'id_pelanggan' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:41:33 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:43:56 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:44:26 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:45:00 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:46:01 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:46:29 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:47:44 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:47:47 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_invoice`=`angsuran`.`id_invoice`
WHERE  angsuran.id_pelanggan  LIKE '%155%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:47:57 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:51:15 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_pelanggan`=`angsuran`.`id_pelanggan`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:51:27 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:51:52 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:51:55 --> 404 Page Not Found: Git/jayacitymobile
ERROR - 2022-04-21 07:52:05 --> 404 Page Not Found: Git/jayacitymobile
ERROR - 2022-04-21 07:52:12 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:52:13 --> 404 Page Not Found: Git/jayacitymobile
ERROR - 2022-04-21 07:52:17 --> 404 Page Not Found: Git/jayacitymobile
ERROR - 2022-04-21 07:52:19 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:52:21 --> 404 Page Not Found: Git/jayacitymobile
ERROR - 2022-04-21 07:52:25 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:52:27 --> 404 Page Not Found: Git/jayacitymobile
ERROR - 2022-04-21 07:52:29 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\tunggakan_brand.php 120
ERROR - 2022-04-21 07:52:54 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_pelanggan`=`angsuran`.`id_pelanggan`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
ORDER BY `id_angsuran` DESC
 LIMIT 10
ERROR - 2022-04-21 07:58:39 --> Query error: Column 'tgl_jatuh_tempo' in where clause is ambiguous - Invalid query: SELECT `angsuran`.*, DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih
FROM `angsuran`
JOIN `pelanggan` as `p` ON `p`.`id_pelanggan`=`angsuran`.`id_pelanggan`
JOIN `transaksi` as `s` ON `s`.`id_pelanggan`=`angsuran`.`id_pelanggan`
WHERE  angsuran.id_pelanggan  LIKE '%153%' ESCAPE '!' 
AND `tgl_jatuh_tempo` >= '2022-04-15'
AND `tgl_jatuh_tempo` <= '2022-04-21'
AND `angsuran`.`status` =0 AND `angsuran`.`tgl_jatuh_tempo` < now() + interval 3 day
 LIMIT 10
ERROR - 2022-04-21 08:04:33 --> Severity: Notice --> Undefined variable: brand_name E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\laporan_brand\list_detail_v.php 4
ERROR - 2022-04-21 08:04:33 --> Severity: Notice --> Trying to get property 'name' of non-object E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\laporan_brand\list_detail_v.php 4
ERROR - 2022-04-21 09:42:28 --> Severity: Notice --> Undefined property: stdClass::$jumlah_cicilan E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\angsuran\bayar_v.php 361
ERROR - 2022-04-21 09:42:48 --> Severity: Notice --> Undefined property: stdClass::$jumlah_cicilan E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\angsuran\bayar_v.php 360
ERROR - 2022-04-21 09:43:26 --> Severity: Notice --> Undefined property: stdClass::$jumlah_cicilan E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\angsuran\bayar_v.php 361
ERROR - 2022-04-21 09:44:17 --> Severity: Notice --> Undefined property: stdClass::$jumlah_cicilan E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\angsuran\bayar_v.php 361
ERROR - 2022-04-21 09:46:12 --> Severity: Notice --> Undefined property: stdClass::$jumlah_cicilan E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\angsuran\bayar_v.php 361
ERROR - 2022-04-21 09:46:47 --> Severity: Notice --> Undefined property: stdClass::$jumlah_cicilan E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\angsuran\bayar_v.php 361
ERROR - 2022-04-21 11:50:04 --> Severity: Notice --> Undefined index: user E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\angsuran\bayar_v.php 339
ERROR - 2022-04-21 11:50:04 --> Severity: Notice --> Trying to get property 'id' of non-object E:\xampp72\htdocs\git\jayacitymobile\application\views\admin\angsuran\bayar_v.php 339
ERROR - 2022-04-21 13:09:46 --> Severity: error --> Exception: Too few arguments to function Laporan_pembayaran_model::getCountAllBy(), 6 passed in E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php on line 51 and exactly 7 expected E:\xampp72\htdocs\git\jayacitymobile\application\models\Laporan_pembayaran_model.php 121
ERROR - 2022-04-21 13:09:48 --> Severity: error --> Exception: Too few arguments to function Laporan_pembayaran_model::getCountAllBy(), 6 passed in E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php on line 51 and exactly 7 expected E:\xampp72\htdocs\git\jayacitymobile\application\models\Laporan_pembayaran_model.php 121
ERROR - 2022-04-21 13:16:31 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 69
ERROR - 2022-04-21 13:16:31 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 75
ERROR - 2022-04-21 13:16:33 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 69
ERROR - 2022-04-21 13:16:33 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 75
ERROR - 2022-04-21 13:16:38 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 69
ERROR - 2022-04-21 13:16:38 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 75
ERROR - 2022-04-21 13:16:51 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 69
ERROR - 2022-04-21 13:16:51 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 75
ERROR - 2022-04-21 13:16:54 --> Severity: Notice --> Undefined index:  E:\xampp72\htdocs\git\jayacitymobile\application\controllers\Laporan_pembayaran.php 43
