<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-04-13 03:31:02 --> Severity: Notice --> Undefined variable: id_krtp C:\xampp\htdocs\doflalandprojectapril\crm\application\controllers\Crm.php 207
ERROR - 2023-04-13 03:31:14 --> Severity: Notice --> Undefined variable: id_krtp C:\xampp\htdocs\doflalandprojectapril\crm\application\controllers\Crm.php 207
ERROR - 2023-04-13 03:41:33 --> Severity: Notice --> Undefined variable: id_krtp C:\xampp\htdocs\doflalandprojectapril\crm\application\controllers\Crm.php 207
ERROR - 2023-04-13 03:42:39 --> Severity: Notice --> Undefined variable: id_krtp C:\xampp\htdocs\doflalandprojectapril\crm\application\controllers\Crm.php 207
ERROR - 2023-04-13 04:39:25 --> Query error: Unknown column 'input_nama_crm.id' in 'order clause' - Invalid query: SELECT *
FROM `input_nama_crm`
JOIN `sales` ON `input_nama_crm`.`id_sales` = `sales`.`id`
WHERE `sales`.`id` IS NULL
ORDER BY `input_nama_crm`.`id` ASC
ERROR - 2023-04-13 04:39:29 --> Query error: Unknown column 'input_nama_crm.id' in 'order clause' - Invalid query: SELECT *
FROM `input_nama_crm`
JOIN `sales` ON `input_nama_crm`.`id_sales` = `sales`.`id`
WHERE `sales`.`id` IS NULL
ORDER BY `input_nama_crm`.`id` ASC
ERROR - 2023-04-13 04:43:26 --> Query error: Not unique table/alias: 'input_nama_crm' - Invalid query: SELECT *
FROM `input_nama_crm`
JOIN `input_nama_crm` ON `sales`.`id` = `input_nama_crm`.`id_sales`
WHERE `input_nama_crm`.`id_sales` = '4'
ORDER BY `input_nama_crm`.`id_krtp` ASC
ERROR - 2023-04-13 04:43:29 --> Query error: Not unique table/alias: 'input_nama_crm' - Invalid query: SELECT *
FROM `input_nama_crm`
JOIN `input_nama_crm` ON `sales`.`id` = `input_nama_crm`.`id_sales`
WHERE `input_nama_crm`.`id_sales` = '3'
ORDER BY `input_nama_crm`.`id_krtp` ASC
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'nama_konsumen' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 21
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'ketertarikan_rumah' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 31
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'tanggal_data_masuk' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 40
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'kontak' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 51
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'block' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 60
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'sumber_data' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 69
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'alamat' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 80
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'tipe' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 89
ERROR - 2023-04-13 09:21:29 --> Severity: Notice --> Trying to get property 'nama_kategori' of non-object C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:22:53 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:23:11 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:23:38 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:23:46 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:25:13 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:25:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 132
ERROR - 2023-04-13 09:26:04 --> Query error: Not unique table/alias: 'dbs_crm' - Invalid query: SELECT *
FROM `dbs_crm`
JOIN `dbs_crm` ON `dbs_crm`.`id_konsumen` = `input_nama_crm`.`id_krtp`
WHERE `dbs_crm`.`id_konsumen` = '751'
ERROR - 2023-04-13 09:26:37 --> Query error: Not unique table/alias: 'dbs_crm' - Invalid query: SELECT *
FROM `dbs_crm`
JOIN `dbs_crm` ON `input_nama_crm`.`id_krtp` = `dbs_crm`.`id_konsumen`
WHERE `dbs_crm`.`id_konsumen` = '751'
ERROR - 2023-04-13 09:27:15 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:27:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 132
ERROR - 2023-04-13 09:27:30 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:29:25 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
ERROR - 2023-04-13 09:29:26 --> Severity: Notice --> Undefined property: stdClass::$nama_kategori C:\xampp\htdocs\doflalandprojectapril\crm\application\views\data_konsumen_by_status\detail_konsumen.php 98
