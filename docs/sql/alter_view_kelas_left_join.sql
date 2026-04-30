-- Mengubah view_kelas menggunakan LEFT JOIN agar data dengan jurusan NULL tetap tampil
-- Digunakan untuk sistem yang tidak memerlukan jurusan (seperti SD)

DROP VIEW IF EXISTS `view_kelas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kelas` AS 
SELECT 
    `tk`.`kd_kelas` AS `kd_kelas`, 
    `tk`.`nama_kelas` AS `nama_kelas`, 
    `tk`.`kd_tingkatan` AS `kd_tingkatan`, 
    `tk`.`kd_jurusan` AS `kd_jurusan`, 
    `ttk`.`nama_tingkatan` AS `nama_tingkatan`, 
    `tj`.`nama_jurusan` AS `nama_jurusan` 
FROM 
    (`tbl_kelas` `tk` 
    JOIN `tbl_tingkatan_kelas` `ttk` ON `tk`.`kd_tingkatan` = `ttk`.`kd_tingkatan`) 
    LEFT JOIN `tbl_jurusan` `tj` ON `tk`.`kd_jurusan` = `tj`.`kd_jurusan`;
