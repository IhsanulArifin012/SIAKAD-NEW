-- Mengubah kolom kd_jurusan menjadi nullable
-- Digunakan untuk sistem yang tidak memerlukan jurusan (seperti SD)

ALTER TABLE `tbl_kelas` MODIFY `kd_jurusan` VARCHAR(50) NULL;
