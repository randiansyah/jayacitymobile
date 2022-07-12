<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-07-06 06:59:51 --> Query error: Unknown column 'total' in 'field list' - Invalid query: SELECT sum(total) AS total,tgl_akad
     FROM angsuran_titipan WHERE  DATE_FORMAT(tgl_akad,'%Y-%m-%d') >= '2022-06-30'
      AND DATE_FORMAT(tgl_akad,'%Y-%m-%d') <= '2022-07-06' GROUP BY 
      DATE(tgl_akad) ORDER BY tgl_akad ASC
ERROR - 2022-07-06 07:00:06 --> Query error: Unknown column 'total' in 'field list' - Invalid query: SELECT sum(total) AS total,tgl_akad
     FROM angsuran_titipan WHERE  DATE_FORMAT(tgl_akad,'%Y-%m-%d') >= '2022-06-30'
      AND DATE_FORMAT(tgl_akad,'%Y-%m-%d') <= '2022-07-06' GROUP BY 
      DATE(tgl_akad) ORDER BY tgl_akad ASC
ERROR - 2022-07-06 07:00:09 --> Query error: Unknown column 'total' in 'field list' - Invalid query: SELECT sum(total) AS total,tgl_akad
     FROM angsuran_titipan WHERE  DATE_FORMAT(tgl_akad,'%Y-%m-%d') >= ''
      AND DATE_FORMAT(tgl_akad,'%Y-%m-%d') <= '' GROUP BY 
      DATE(tgl_akad) ORDER BY tgl_akad ASC
