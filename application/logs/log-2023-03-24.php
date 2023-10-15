<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-03-24 17:40:22 --> Severity: Notice --> Undefined variable: nama_pengaju C:\xampp\htdocs\doflaland25feb2023\crm\application\controllers\Akuntan.php 532
ERROR - 2023-03-24 17:40:22 --> Severity: Notice --> Undefined variable: id_jenis_pengajuan C:\xampp\htdocs\doflaland25feb2023\crm\application\controllers\Akuntan.php 533
ERROR - 2023-03-24 17:40:22 --> Severity: Notice --> Undefined variable: j_rp C:\xampp\htdocs\doflaland25feb2023\crm\application\controllers\Akuntan.php 535
ERROR - 2023-03-24 17:40:22 --> Severity: Notice --> Undefined variable: j_unit C:\xampp\htdocs\doflaland25feb2023\crm\application\controllers\Akuntan.php 536
ERROR - 2023-03-24 17:40:22 --> Severity: Notice --> Undefined variable: j_hari C:\xampp\htdocs\doflaland25feb2023\crm\application\controllers\Akuntan.php 537
ERROR - 2023-03-24 17:40:22 --> Query error: Column 'nama_pengaju' cannot be null - Invalid query: INSERT INTO `stagging_pengajuan` (`nama_pengaju`, `id_jenis_pengajuan`, `tanggal_pengajuan`, `j_rp`, `j_unit`, `j_hari`, `tanggal_awal`, `tanggal_ahkir`, `keterangan_pengajuan`) VALUES (NULL, NULL, '2023-03-24', NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2023-03-24 18:40:10 --> Severity: Parsing Error --> syntax error, unexpected 'echo' (T_ECHO) C:\xampp\htdocs\doflaland25feb2023\crm\application\controllers\Akuntan.php 680
ERROR - 2023-03-24 18:40:11 --> Severity: Parsing Error --> syntax error, unexpected 'echo' (T_ECHO) C:\xampp\htdocs\doflaland25feb2023\crm\application\controllers\Akuntan.php 680
ERROR - 2023-03-24 18:53:43 --> Severity: Parsing Error --> syntax error, unexpected '.' C:\xampp\htdocs\doflaland25feb2023\crm\application\views\input_kartu_hutang\content.php 62
ERROR - 2023-03-24 19:00:44 --> Query error: Unknown column 'kontak_konsumen' in 'field list' - Invalid query: UPDATE `input_nama_crm` SET `nama_konsumen` = 'qwerty', `kontak_konsumen` = '12345678', `id_categori` = '2'
WHERE `id_krtp` = '4'
