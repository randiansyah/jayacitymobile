<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-03-24 17:31:25 --> Severity: Warning --> Error while sending QUERY packet. PID=30462 /home/u1669490/public_html/system/database/drivers/mysqli/mysqli_driver.php 305
ERROR - 2022-03-24 17:31:25 --> Query error: MySQL server has gone away - Invalid query: SELECT *
FROM `menu`
WHERE `url` = 'dashboard'
AND `is_deleted` = '0'
ERROR - 2022-03-24 17:36:57 --> Severity: Warning --> Error while sending QUERY packet. PID=24289 /home/u1669490/public_html/system/database/drivers/mysqli/mysqli_driver.php 305
ERROR - 2022-03-24 17:36:57 --> Query error: MySQL server has gone away - Invalid query: SELECT *
FROM `menu`
WHERE `url` = 'user'
AND `is_deleted` = '0'
ERROR - 2022-03-24 17:45:42 --> Query error: Table 'u1669490_sample.users' doesn't exist - Invalid query: SELECT `users`.*, `users`.`id` as `id`, `users`.`id` as `user_id`
FROM `users`
WHERE `users`.`id` = '1'
ORDER BY `users`.`id` DESC
 LIMIT 1
ERROR - 2022-03-24 17:45:47 --> Query error: Table 'u1669490_sample.users' doesn't exist - Invalid query: SELECT `users`.*, `users`.`id` as `id`, `users`.`id` as `user_id`
FROM `users`
WHERE `users`.`id` = '1'
ORDER BY `users`.`id` DESC
 LIMIT 1
ERROR - 2022-03-24 17:45:52 --> Query error: Table 'u1669490_sample.users' doesn't exist - Invalid query: SELECT `users`.*, `users`.`id` as `id`, `users`.`id` as `user_id`
FROM `users`
WHERE `users`.`id` = '1'
ORDER BY `users`.`id` DESC
 LIMIT 1
ERROR - 2022-03-24 17:46:05 --> Query error: Table 'u1669490_sample.users' doesn't exist - Invalid query: SELECT `users`.*, `users`.`id` as `id`, `users`.`id` as `user_id`
FROM `users`
WHERE `users`.`id` = '1'
ORDER BY `users`.`id` DESC
 LIMIT 1
ERROR - 2022-03-24 17:51:08 --> Query error: Table 'u1669490_sample.angsuran_titipan' doesn't exist - Invalid query: SELECT `angsuran_titipan`.*, SUM(angsuran_titipan.jumlah_bayar) as total
FROM `angsuran_titipan`
WHERE `created_on` >= '2022-03-01'
AND `created_on` <= '2022-03-31'
ERROR - 2022-03-24 17:52:11 --> Query error: Table 'u1669490_sample.angsuran' doesn't exist - Invalid query: SELECT `angsuran`.*, SUM(angsuran.jumlah_bayar) as total
FROM `angsuran`
WHERE `created_on` >= '2022-03-01'
AND `created_on` <= '2022-03-31'
ERROR - 2022-03-24 17:53:13 --> Query error: Table 'u1669490_sample.angsuran' doesn't exist - Invalid query: SELECT `angsuran`.*, SUM(angsuran.jumlah_bayar) as total
FROM `angsuran`
WHERE `created_on` >= '2022-03-01'
AND `created_on` <= '2022-03-31'
ERROR - 2022-03-24 17:57:29 --> Severity: Warning --> Error while sending QUERY packet. PID=37252 /home/u1669490/public_html/system/database/drivers/mysqli/mysqli_driver.php 305
ERROR - 2022-03-24 17:57:29 --> Query error: MySQL server has gone away - Invalid query: SELECT *
FROM `menu`
WHERE `url` = 'dashboard'
AND `is_deleted` = '0'
ERROR - 2022-03-24 18:01:59 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 18:02:21 --> 404 Page Not Found: Faviconpng/index
ERROR - 2022-03-24 18:02:51 --> 404 Page Not Found: Faviconpng/index
ERROR - 2022-03-24 18:10:38 --> Query error: Table 'u1669490_sample.template_email' doesn't exist - Invalid query: SELECT *
FROM `template_email`
ERROR - 2022-03-24 18:13:17 --> Severity: Notice --> Undefined variable: data /home/u1669490/public_html/application/controllers/Rekening_bank.php 131
ERROR - 2022-03-24 18:18:03 --> Query error: Table 'u1669490_sample.transaksi' doesn't exist - Invalid query: SELECT *
FROM `transaksi`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`transaksi`.`id_pelanggan`
WHERE `id_invoice` = 'M0002'
ERROR - 2022-03-24 18:18:05 --> Query error: Table 'u1669490_sample.transaksi' doesn't exist - Invalid query: SELECT *
FROM `transaksi`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`transaksi`.`id_pelanggan`
WHERE `id_invoice` = 'M0002'
ERROR - 2022-03-24 18:18:09 --> Query error: Table 'u1669490_sample.transaksi' doesn't exist - Invalid query: SELECT *
FROM `transaksi`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`transaksi`.`id_pelanggan`
WHERE `id_invoice` = 'M0002'
ERROR - 2022-03-24 18:18:19 --> Severity: Notice --> Undefined index:  /home/u1669490/public_html/application/controllers/Remaining_payment.php 47
ERROR - 2022-03-24 18:18:19 --> Query error: Table 'u1669490_sample.transaksi' doesn't exist - Invalid query: SELECT *
FROM `transaksi`
JOIN `pelanggan` ON `pelanggan`.`id_pelanggan`=`transaksi`.`id_pelanggan`
WHERE `id_invoice` = 'M0002'
ERROR - 2022-03-24 19:03:42 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:03:50 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:03:50 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:03:50 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:03:50 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:03:50 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:03:57 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:03:57 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:03:57 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:03:57 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:03:57 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:04:02 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:04:02 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:04:02 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:04:02 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:04:02 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:04:09 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:04:15 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:04:24 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:04:24 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:04:24 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:04:24 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:04:24 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:05:50 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:05:54 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:06:00 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:06:04 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:06:04 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:06:04 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:06:04 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:06:04 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:06:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:06:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:06:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:06:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:06:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:06:17 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:06:17 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:06:17 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:06:17 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:06:17 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:06:19 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:13:03 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:13:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:13:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:13:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:13:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:13:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:13:31 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:20:32 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:25:45 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:26:10 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:26:24 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:26:34 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:27:19 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:28:01 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:28:05 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 456
ERROR - 2022-03-24 19:28:05 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 457
ERROR - 2022-03-24 19:28:05 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 458
ERROR - 2022-03-24 19:28:05 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 459
ERROR - 2022-03-24 19:28:05 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /home/u1669490/public_html/application/controllers/Customer.php 460
ERROR - 2022-03-24 19:28:10 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:31:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:36:57 --> Severity: Notice --> Undefined variable: data /home/u1669490/public_html/application/controllers/Customer.php 535
ERROR - 2022-03-24 19:37:00 --> Severity: Notice --> Undefined variable: data /home/u1669490/public_html/application/controllers/Customer.php 535
ERROR - 2022-03-24 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 19:38:20 --> Severity: Warning --> Invalid argument supplied for foreach() /home/u1669490/public_html/application/views/admin/pelanggan/list_v.php 15
ERROR - 2022-03-24 23:11:20 --> 404 Page Not Found: Z0f76a1d14fd21a8fb5fd0d03e0fdc3d3cedae52f/index
