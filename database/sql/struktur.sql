
CREATE DATABASE IF NOT EXISTS inventaris_lab_2401020023
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE inventaris_lab_2401020023;

CREATE TABLE ruang (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nama_ruang VARCHAR(100) NOT NULL,

    PRIMARY KEY (id),
    UNIQUE KEY uq_nama_ruang (nama_ruang)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

CREATE TABLE inventaris (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    kode_barang CHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    nomor_aset VARCHAR(30) NOT NULL,
    tahun_perolehan SMALLINT UNSIGNED NOT NULL,
    ruang_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    PRIMARY KEY (id),
    UNIQUE KEY uq_kode_barang (kode_barang),
    UNIQUE KEY uq_nomor_aset (nomor_aset),

    CONSTRAINT chk_tahun_perolehan
        CHECK (tahun_perolehan BETWEEN 2000 AND 2026),

    CONSTRAINT fk_inventaris_ruang
        FOREIGN KEY (ruang_id)
        REFERENCES ruang(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
