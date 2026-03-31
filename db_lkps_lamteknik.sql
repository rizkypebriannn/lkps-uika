-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Mar 2026 pada 08.12
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lkps_lamteknik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `beban_kerja_dosens`
--

CREATE TABLE `beban_kerja_dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `is_dtps` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  `sks_ps_diakreditasi` double NOT NULL DEFAULT 0,
  `sks_ps_lain_dalam_pt` double NOT NULL DEFAULT 0,
  `sks_ps_lain_luar_pt` double NOT NULL DEFAULT 0,
  `sks_penelitian` double NOT NULL DEFAULT 0,
  `sks_pkm` double NOT NULL DEFAULT 0,
  `sks_tugas_tambahan` double NOT NULL DEFAULT 0,
  `sks_jumlah` double NOT NULL DEFAULT 0,
  `sks_rata_rata` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `beban_kerja_dosens`
--

INSERT INTO `beban_kerja_dosens` (`id`, `prodi_id`, `nama_dosen`, `is_dtps`, `sks_ps_diakreditasi`, `sks_ps_lain_dalam_pt`, `sks_ps_lain_luar_pt`, `sks_penelitian`, `sks_pkm`, `sks_tugas_tambahan`, `sks_jumlah`, `sks_rata_rata`, `created_at`, `updated_at`) VALUES
(1, 3, 'Rifki adi nugraha', 'Ya', 3, 0, 0, 3, 3, 2, 11, 5.5, '2026-03-26 07:08:00', '2026-03-26 07:08:00'),
(2, 3, 'budi susanto', 'Ya', 3, 3, 0, 3, 2, 0, 11, 5.5, '2026-03-26 07:09:09', '2026-03-26 07:09:09'),
(3, 3, 'Dava Pratama', 'Ya', 9, 3, 0, 3, 2, 0, 17, 8.5, '2026-03-26 07:10:03', '2026-03-26 07:10:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin.ilmulingkungan@uikabogor.ac.id|127.0.0.1', 'i:1;', 1774854999),
('laravel-cache-admin.ilmulingkungan@uikabogor.ac.id|127.0.0.1:timer', 'i:1774854999;', 1774854999);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `capstone_designs`
--

CREATE TABLE `capstone_designs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `mk_pendukung` varchar(255) NOT NULL,
  `sks_pendukung` int(11) NOT NULL,
  `mk_capstone` varchar(255) NOT NULL,
  `sks_capstone` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `cakupan_bahasan` varchar(255) NOT NULL,
  `has_panduan` tinyint(1) NOT NULL DEFAULT 0,
  `has_cpl_rumusan` tinyint(1) NOT NULL DEFAULT 0,
  `has_standar_keteknikan` tinyint(1) NOT NULL DEFAULT 0,
  `has_bukti_sahih` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `capstone_designs`
--

INSERT INTO `capstone_designs` (`id`, `prodi_id`, `mk_pendukung`, `sks_pendukung`, `mk_capstone`, `sks_capstone`, `semester`, `cakupan_bahasan`, `has_panduan`, `has_cpl_rumusan`, `has_standar_keteknikan`, `has_bukti_sahih`, `created_at`, `updated_at`) VALUES
(1, 1, 'Metodologi Penelitian, Praktikum Terpadu', 4, 'Tugas Akhir / Capstone Design', 4, '8', 'Perancangan rekayasa komprehensif memecahkan masalah kompleks', 1, 1, 1, 1, '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(2, 2, 'Metodologi Penelitian, Praktikum Terpadu', 4, 'Tugas Akhir / Capstone Design', 4, '8', 'Perancangan rekayasa komprehensif memecahkan masalah kompleks', 1, 1, 1, 1, '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(3, 3, 'Metodologi Penelitian, Praktikum Terpadu', 4, 'Tugas Akhir / Capstone Design', 4, '8', 'Perancangan rekayasa komprehensif memecahkan masalah kompleks', 1, 1, 1, 1, '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(6, 6, 'Metodologi Penelitian, Praktikum Terpadu', 4, 'Tugas Akhir / Capstone Design', 4, '8', 'Perancangan rekayasa komprehensif memecahkan masalah kompleks', 1, 1, 1, 1, '2026-03-23 07:46:33', '2026-03-23 07:46:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_k3ls`
--

CREATE TABLE `dokumen_k3ls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dokumen` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `riwayat_pengesahan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_pembelajarans`
--

CREATE TABLE `dokumen_pembelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `mata_kuliah` varchar(255) NOT NULL,
  `bobot_sks` int(11) NOT NULL,
  `konversi_teori` int(11) NOT NULL DEFAULT 0,
  `konversi_praktik` int(11) NOT NULL DEFAULT 0,
  `dokumen_rps` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokumen_pembelajarans`
--

INSERT INTO `dokumen_pembelajarans` (`id`, `prodi_id`, `mata_kuliah`, `bobot_sks`, `konversi_teori`, `konversi_praktik`, `dokumen_rps`, `created_at`, `updated_at`) VALUES
(1, 3, 'kalkulus', 3, 3, 0, NULL, '2026-03-26 07:03:57', '2026-03-26 07:03:57'),
(2, 3, 'kalkulus 2', 3, 3, 0, NULL, '2026-03-26 07:04:25', '2026-03-26 07:04:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_spmis`
--

CREATE TABLE `dokumen_spmis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dokumen` varchar(255) NOT NULL,
  `nomor_dokumen` varchar(255) NOT NULL,
  `tanggal_dokumen` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester` int(11) NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `is_mk_kompetensi` tinyint(1) NOT NULL DEFAULT 0,
  `sks_kuliah` int(11) NOT NULL DEFAULT 0,
  `sks_seminar` int(11) NOT NULL DEFAULT 0,
  `sks_praktikum` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas_k3ls`
--

CREATE TABLE `fasilitas_k3ls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_sarana` varchar(255) NOT NULL,
  `fungsi` varchar(255) NOT NULL,
  `jumlah_unit` int(11) NOT NULL DEFAULT 0,
  `kondisi` enum('Terawat','Tidak Terawat') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `integrasi_pembelajarans`
--

CREATE TABLE `integrasi_pembelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `judul_kegiatan` varchar(255) NOT NULL,
  `mata_kuliah` varchar(255) NOT NULL,
  `bentuk_integrasi` varchar(255) NOT NULL,
  `tahun_ts2` varchar(255) DEFAULT NULL,
  `tahun_ts1` varchar(255) DEFAULT NULL,
  `tahun_ts` varchar(255) DEFAULT NULL,
  `kesesuaian_peta_jalan` enum('Sesuai','Tidak Sesuai') NOT NULL,
  `bukti_sahih` varchar(255) DEFAULT NULL,
  `kesesuaian_rps` enum('Sesuai','Tidak Sesuai') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `integrasi_pembelajarans`
--

INSERT INTO `integrasi_pembelajarans` (`id`, `prodi_id`, `nama_dosen`, `judul_kegiatan`, `mata_kuliah`, `bentuk_integrasi`, `tahun_ts2`, `tahun_ts1`, `tahun_ts`, `kesesuaian_peta_jalan`, `bukti_sahih`, `kesesuaian_rps`, `created_at`, `updated_at`) VALUES
(1, 2, 'Rifki adi nugraha', 'Deteksi penyakit menggunakan model Fuzzy', 'Sistem embeded', 'Materi Perkuliahan', '2022', '2023', '2024', 'Sesuai', 'http://daoh', 'Sesuai', '2026-03-25 00:20:34', '2026-03-25 00:20:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ipk_lulusans`
--

CREATE TABLE `ipk_lulusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_lulus` enum('TS-2','TS-1','TS') NOT NULL,
  `jumlah_lulusan` int(11) NOT NULL DEFAULT 0,
  `ipk_min` decimal(3,2) NOT NULL DEFAULT 0.00,
  `ipk_rata` decimal(3,2) NOT NULL DEFAULT 0.00,
  `ipk_maks` decimal(3,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jumlah_mahasiswas`
--

CREATE TABLE `jumlah_mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `program_studi` varchar(255) NOT NULL,
  `is_diakreditasi` enum('Ya','Tidak') NOT NULL,
  `aktif_ts2` int(11) NOT NULL DEFAULT 0,
  `aktif_ts1` int(11) NOT NULL DEFAULT 0,
  `aktif_ts` int(11) NOT NULL DEFAULT 0,
  `asing_ft_ts2` int(11) NOT NULL DEFAULT 0,
  `asing_ft_ts1` int(11) NOT NULL DEFAULT 0,
  `asing_ft_ts` int(11) NOT NULL DEFAULT 0,
  `asing_pt_ts2` int(11) NOT NULL DEFAULT 0,
  `asing_pt_ts1` int(11) NOT NULL DEFAULT 0,
  `asing_pt_ts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karya_ilmiah_dtps`
--

CREATE TABLE `karya_ilmiah_dtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_publikasi` varchar(255) NOT NULL,
  `jumlah_ts2` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts1` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts` int(11) NOT NULL DEFAULT 0,
  `jumlah_total` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `karya_ilmiah_dtps`
--

INSERT INTO `karya_ilmiah_dtps` (`id`, `prodi_id`, `jenis_publikasi`, `jumlah_ts2`, `jumlah_ts1`, `jumlah_ts`, `jumlah_total`, `created_at`, `updated_at`) VALUES
(1, 5, 'Jurnal internasional', 3, 1, 5, 9, '2026-03-30 00:21:08', '2026-03-30 00:21:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karya_ilmiah_sitasis`
--

CREATE TABLE `karya_ilmiah_sitasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dtps` varchar(255) NOT NULL,
  `judul_artikel` text NOT NULL,
  `jumlah_sitasi` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepuasan_pengguna_lulusans`
--

CREATE TABLE `kepuasan_pengguna_lulusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_kemampuan` varchar(255) NOT NULL,
  `sangat_baik` double NOT NULL DEFAULT 0,
  `baik` double NOT NULL DEFAULT 0,
  `cukup` double NOT NULL DEFAULT 0,
  `kurang` double NOT NULL DEFAULT 0,
  `rencana_tindak_lanjut` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerjasama_pendidikans`
--

CREATE TABLE `kerjasama_pendidikans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `lembaga_mitra` varchar(255) NOT NULL,
  `tingkat` enum('Internasional','Nasional','Lokal/Wilayah') NOT NULL,
  `judul_kegiatan` varchar(255) NOT NULL,
  `manfaat` text NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `status_kerjasama` varchar(255) NOT NULL,
  `bukti_kerjasama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kerjasama_pendidikans`
--

INSERT INTO `kerjasama_pendidikans` (`id`, `prodi_id`, `lembaga_mitra`, `tingkat`, `judul_kegiatan`, `manfaat`, `tanggal_awal`, `tanggal_akhir`, `durasi`, `status_kerjasama`, `bukti_kerjasama`, `created_at`, `updated_at`) VALUES
(1, 3, 'Brin', 'Nasional', 'p', 'p', '2026-03-30', '2026-06-29', 1, 'AKTIF', 'http://4234', '2026-03-23 09:10:14', '2026-03-23 09:10:14'),
(2, 3, 'PT Indocement Tbk', 'Lokal/Wilayah', 'Kerja Praktek', 'Relasi', '2025-06-01', '2026-03-31', 1, 'AKTIF', NULL, '2026-03-30 20:16:46', '2026-03-30 20:16:46'),
(3, 3, 'Kominfo', 'Nasional', 'dasd', 'dsamdm', '2024-03-31', '2026-03-31', 1, 'AKTIF', 'http://4234', '2026-03-30 20:18:44', '2026-03-30 20:18:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerjasama_penelitians`
--

CREATE TABLE `kerjasama_penelitians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `lembaga_mitra` varchar(255) NOT NULL,
  `tingkat` enum('Internasional','Nasional','Lokal/Wilayah') NOT NULL,
  `judul_kegiatan` varchar(255) NOT NULL,
  `manfaat` text NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `status_kerjasama` varchar(255) NOT NULL,
  `bukti_kerjasama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kerjasama_penelitians`
--

INSERT INTO `kerjasama_penelitians` (`id`, `prodi_id`, `lembaga_mitra`, `tingkat`, `judul_kegiatan`, `manfaat`, `tanggal_awal`, `tanggal_akhir`, `durasi`, `status_kerjasama`, `bukti_kerjasama`, `created_at`, `updated_at`) VALUES
(1, 3, '34', 'Internasional', 'daskd', 'ldamsdn', '2026-04-06', '2026-08-24', 1, 'aktif', 'http://4234', '2026-03-23 09:11:04', '2026-03-23 09:11:04'),
(2, 3, 'Brin', 'Nasional', 'dasldm', 'dmas,md', '2025-12-04', '2026-03-23', 1, 'AKTIF', 'http://4234', '2026-03-30 20:19:47', '2026-03-30 20:19:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerjasama_pengabdians`
--

CREATE TABLE `kerjasama_pengabdians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `lembaga_mitra` varchar(255) NOT NULL,
  `tingkat` enum('Internasional','Nasional','Lokal/Wilayah') NOT NULL,
  `judul_kegiatan` varchar(255) NOT NULL,
  `manfaat` text NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `status_kerjasama` varchar(255) NOT NULL,
  `bukti_kerjasama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kerjasama_pengabdians`
--

INSERT INTO `kerjasama_pengabdians` (`id`, `prodi_id`, `lembaga_mitra`, `tingkat`, `judul_kegiatan`, `manfaat`, `tanggal_awal`, `tanggal_akhir`, `durasi`, `status_kerjasama`, `bukti_kerjasama`, `created_at`, `updated_at`) VALUES
(1, 3, 'Desa Galuga', 'Lokal/Wilayah', 'dasdn', 'dlmasnd', '2026-03-30', '2026-06-15', 1, 'sel', 'http://4234', '2026-03-23 09:11:51', '2026-03-23 09:11:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kesesuaian_bidang_kerjas`
--

CREATE TABLE `kesesuaian_bidang_kerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_lulus` varchar(255) NOT NULL,
  `jumlah_lulusan` int(11) NOT NULL DEFAULT 0,
  `jumlah_lulusan_terlacak` int(11) NOT NULL DEFAULT 0,
  `kesesuaian_rendah` int(11) NOT NULL DEFAULT 0,
  `kesesuaian_sedang` int(11) NOT NULL DEFAULT 0,
  `kesesuaian_tinggi` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangans`
--

CREATE TABLE `keuangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `dana_operasional_mhs` bigint(20) NOT NULL DEFAULT 0,
  `dana_penelitian_dtps` bigint(20) NOT NULL DEFAULT 0,
  `dana_pkm_dtps` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kinerja_dtps`
--

CREATE TABLE `kinerja_dtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dtps` varchar(255) NOT NULL,
  `jumlah_ts2` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts1` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts` int(11) NOT NULL DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `jumlah_publikasi` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurikulums`
--

CREATE TABLE `kurikulums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `semester` int(11) NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `is_mk_kompetensi` tinyint(1) NOT NULL DEFAULT 0,
  `sks_kuliah` int(11) NOT NULL DEFAULT 0,
  `sks_seminar` int(11) NOT NULL DEFAULT 0,
  `sks_praktikum` int(11) NOT NULL DEFAULT 0,
  `konversi_kredit_jam` varchar(255) DEFAULT NULL,
  `dokumen_rps` varchar(255) DEFAULT NULL,
  `unit_penyelenggara` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kurikulums`
--

INSERT INTO `kurikulums` (`id`, `prodi_id`, `semester`, `kode_mk`, `nama_mk`, `is_mk_kompetensi`, `sks_kuliah`, `sks_seminar`, `sks_praktikum`, `konversi_kredit_jam`, `dokumen_rps`, `unit_penyelenggara`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'TIF032', 'keamanan Informasi', 1, 2, 0, 1, NULL, 'http://rwer', 'Prodi', '2026-03-26 07:26:04', '2026-03-26 07:26:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `luaran_buku_isbns`
--

CREATE TABLE `luaran_buku_isbns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `judul_luaran` text NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `luaran_hki_bagian2s`
--

CREATE TABLE `luaran_hki_bagian2s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `luaran_penelitian_pkm` text NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_hki` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `luaran_hki_bagian3s`
--

CREATE TABLE `luaran_hki_bagian3s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `luaran_penelitian` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `nomor_sertifikat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `luaran_hki_bagian4s`
--

CREATE TABLE `luaran_hki_bagian4s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `luaran_penelitian` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_isbn` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `luaran_hki_hak_ciptas`
--

CREATE TABLE `luaran_hki_hak_ciptas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `judul_luaran` text NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `luaran_hki_mahasiswas`
--

CREATE TABLE `luaran_hki_mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `luaran_penelitian` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Registered','Granted','Komersial') NOT NULL,
  `nomor_registrasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `luaran_hki_patens`
--

CREATE TABLE `luaran_hki_patens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `judul_luaran` text NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_paten` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `luaran_teknologi_produks`
--

CREATE TABLE `luaran_teknologi_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `judul_luaran` text NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `program_studi` varchar(255) NOT NULL,
  `aktif_ts2` int(11) NOT NULL DEFAULT 0,
  `aktif_ts1` int(11) NOT NULL DEFAULT 0,
  `aktif_ts` int(11) NOT NULL DEFAULT 0,
  `asing_ft_ts2` int(11) NOT NULL DEFAULT 0,
  `asing_ft_ts1` int(11) NOT NULL DEFAULT 0,
  `asing_ft_ts` int(11) NOT NULL DEFAULT 0,
  `asing_pt_ts2` int(11) NOT NULL DEFAULT 0,
  `asing_pt_ts1` int(11) NOT NULL DEFAULT 0,
  `asing_pt_ts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `masa_studi_lulusans`
--

CREATE TABLE `masa_studi_lulusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_masuk` enum('TS-7','TS-6','TS-5','TS-4','TS-3','TS-2','TS-1','TS') NOT NULL,
  `jumlah_masuk` int(11) NOT NULL DEFAULT 0,
  `lulus_3_5` int(11) DEFAULT 0,
  `lulus_4_5` int(11) DEFAULT 0,
  `lulus_5_5` int(11) DEFAULT 0,
  `lulus_6_5` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul_basic_sciences`
--

CREATE TABLE `matkul_basic_sciences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_mata_kuliah` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `jumlah_sks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `matkul_basic_sciences`
--

INSERT INTO `matkul_basic_sciences` (`id`, `prodi_id`, `nama_mata_kuliah`, `semester`, `jumlah_sks`, `created_at`, `updated_at`) VALUES
(1, 3, 'kalkulus 1', '1', 3, '2026-03-25 00:09:28', '2026-03-25 00:09:28'),
(2, 3, 'matematika diskrit', '2', 2, '2026-03-25 00:10:05', '2026-03-25 00:10:05'),
(3, 3, 'Kalkulus 2', '2', 3, '2026-03-25 00:10:39', '2026-03-25 00:10:39'),
(4, 3, 'struktur data dan algoritma', '3', 3, '2026-03-25 00:12:20', '2026-03-25 00:12:20'),
(5, 3, 'Statistika probabilitas', '2', 2, '2026-03-25 00:12:48', '2026-03-25 00:12:48'),
(6, 3, 'basis data', '2', 3, '2026-03-25 00:13:13', '2026-03-25 00:13:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_21_152733_create_dosens_table', 1),
(5, '2026_02_21_152740_create_kurikulums_table', 1),
(6, '2026_02_21_155313_create_mahasiswas_table', 1),
(7, '2026_02_25_032620_create_visi_misis_table', 1),
(8, '2026_02_26_062023_create_kerjasama_pendidikans_table', 1),
(9, '2026_02_26_063058_create_kerjasama_penelitians_table', 1),
(10, '2026_02_26_064138_create_kerjasama_pengabdians_table', 1),
(11, '2026_02_26_065403_create_penggunaan_danas_table', 1),
(12, '2026_02_26_162729_create_dokumen_pembelajarans_table', 1),
(13, '2026_02_26_164949_create_integrasi_pembelajarans_table', 1),
(14, '2026_02_27_062940_create_matkul_basic_sciences_table', 1),
(15, '2026_02_27_064206_create_prodis_table', 1),
(16, '2026_02_27_073707_create_capstone_designs_table', 1),
(17, '2026_02_27_130639_create_penelitian_dtps_table', 1),
(18, '2026_02_27_131617_create_pkm_dtps_table', 1),
(19, '2026_02_27_133703_create_profil_dosens_table', 1),
(20, '2026_02_27_135913_create_tenaga_kependidikans_table', 1),
(21, '2026_02_27_141934_create_beban_kerja_dosens_table', 1),
(22, '2026_02_28_064224_create_publikasi_ilmiah_dtps_table', 1),
(23, '2026_02_28_070114_create_karya_ilmiah_dtps_table', 1),
(24, '2026_02_28_071510_create_luaran_hki_patens_table', 1),
(25, '2026_02_28_072823_create_luaran_hki_hak_ciptas_table', 1),
(26, '2026_02_28_073951_create_luaran_teknologi_produks_table', 1),
(27, '2026_02_28_154101_create_luaran_buku_isbns_table', 1),
(28, '2026_02_28_155525_create_produk_jasa_dtps_table', 1),
(29, '2026_02_28_161009_create_kinerja_dtps_table', 1),
(30, '2026_03_01_080156_create_karya_ilmiah_sitasis_table', 1),
(31, '2026_03_01_081516_create_pengakuan_dtps_table', 1),
(32, '2026_03_01_090224_create_pembimbing_lapangans_table', 1),
(33, '2026_03_02_121604_create_prasarana_peralatans_table', 1),
(34, '2026_03_02_123441_create_dokumen_k3ls_table', 1),
(35, '2026_03_02_124727_create_fasilitas_k3ls_table', 1),
(36, '2026_03_02_125857_create_jumlah_mahasiswas_table', 1),
(37, '2026_03_02_131138_create_ipk_lulusans_table', 1),
(38, '2026_03_03_072803_create_prestasi_akademiks_table', 1),
(39, '2026_03_03_074256_create_prestasi_non_akademiks_table', 1),
(40, '2026_03_03_075549_create_masa_studi_lulusans_table', 1),
(41, '2026_03_03_082608_create_publikasi_ilmiah_mahasiswas_table', 1),
(42, '2026_03_04_035051_create_publikasi_mahasiswa_terapans_table', 1),
(43, '2026_03_04_040229_create_luaran_hki_mahasiswas_table', 1),
(44, '2026_03_06_150139_create_luaran_hki_bagian2s_table', 1),
(45, '2026_03_07_043629_create_luaran_hki_bagian3s_table', 1),
(46, '2026_03_07_050140_create_luaran_hki_bagian4s_table', 1),
(47, '2026_03_07_051936_create_produk_jasa_mahasiswas_table', 1),
(48, '2026_03_07_053252_create_waktu_tunggu_lulusans_table', 1),
(49, '2026_03_07_054627_create_kesesuaian_bidang_kerjas_table', 1),
(50, '2026_03_08_072902_create_tempat_kerja_lulusans_table', 1),
(51, '2026_03_08_074208_create_kepuasan_pengguna_lulusans_table', 1),
(52, '2026_03_08_080123_create_penelitian_dtps_mahasiswas_table', 1),
(53, '2026_03_08_081438_create_penelitian_dtps_rujukans_table', 1),
(54, '2026_03_08_082504_create_pkm_dtps_mahasiswas_table', 1),
(55, '2026_03_08_083527_create_dokumen_spmis_table', 1),
(56, '2026_03_08_091320_create_pelaksanaan_spmis_table', 1),
(57, '2026_03_23_160057_create_keuangans_table', 2),
(58, '2026_03_25_072222_add_scoring_fields_to_visi_misis_table', 3),
(59, '2026_03_30_064224_add_role_to_users_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaksanaan_spmis`
--

CREATE TABLE `pelaksanaan_spmis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `link_dokumen` varchar(255) NOT NULL,
  `link_laporan_audit` varchar(255) DEFAULT NULL,
  `link_laporan_rtm` varchar(255) DEFAULT NULL,
  `link_dokumen_peningkatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembimbing_lapangans`
--

CREATE TABLE `pembimbing_lapangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `industri` varchar(255) NOT NULL,
  `bidang_keinsinyuran` varchar(255) NOT NULL,
  `pengalaman_kerja` int(11) NOT NULL,
  `pendidikan_tinggi` varchar(255) NOT NULL,
  `kategori_sip` enum('IPM','IPU') NOT NULL,
  `nomor_sip` varchar(255) NOT NULL,
  `tanggal_berakhir_sip` date NOT NULL,
  `jumlah_bimbingan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penelitian_dtps`
--

CREATE TABLE `penelitian_dtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `sumber_pembiayaan` varchar(255) NOT NULL,
  `jumlah_ts2` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts1` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penelitian_dtps_mahasiswas`
--

CREATE TABLE `penelitian_dtps_mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `tema_penelitian` varchar(255) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `judul_kegiatan` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penelitian_dtps_rujukans`
--

CREATE TABLE `penelitian_dtps_rujukans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `tema_penelitian` varchar(255) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `judul_tesis` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengakuan_dtps`
--

CREATE TABLE `pengakuan_dtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dtps` varchar(255) NOT NULL,
  `bidang_keahlian` varchar(255) NOT NULL,
  `rekognisi` varchar(255) NOT NULL,
  `bukti_pendukung` varchar(255) NOT NULL,
  `tingkat` enum('Wilayah','Nasional','Internasional') NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan_danas`
--

CREATE TABLE `penggunaan_danas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_penggunaan` varchar(255) NOT NULL,
  `upps_ts2` double NOT NULL DEFAULT 0,
  `upps_ts1` double NOT NULL DEFAULT 0,
  `upps_ts` double NOT NULL DEFAULT 0,
  `ps_ts2` double NOT NULL DEFAULT 0,
  `ps_ts1` double NOT NULL DEFAULT 0,
  `ps_ts` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pkm_dtps`
--

CREATE TABLE `pkm_dtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `sumber_pembiayaan` varchar(255) NOT NULL,
  `jumlah_ts2` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts1` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pkm_dtps_mahasiswas`
--

CREATE TABLE `pkm_dtps_mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `tema_pkm` varchar(255) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `judul_kegiatan` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prasarana_peralatans`
--

CREATE TABLE `prasarana_peralatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_prasarana` varchar(255) NOT NULL,
  `jumlah_prasarana` int(11) NOT NULL,
  `nama_sarana` varchar(255) NOT NULL,
  `standar_minimal` int(11) NOT NULL,
  `dimiliki_upps` int(11) NOT NULL,
  `kepemilikan` enum('Sendiri','Sewa') NOT NULL,
  `kondisi` enum('Terawat','Tidak Terawat') NOT NULL,
  `logbook` enum('Ada','Tidak Ada') DEFAULT NULL,
  `waktu_penggunaan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi_akademiks`
--

CREATE TABLE `prestasi_akademiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `waktu_perolehan` date NOT NULL,
  `tingkat` enum('Lokal/Wilayah','Nasional','Internasional') NOT NULL,
  `prestasi_dicapai` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi_non_akademiks`
--

CREATE TABLE `prestasi_non_akademiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `waktu_perolehan` date NOT NULL,
  `tingkat` enum('Lokal/Wilayah','Nasional','Internasional') NOT NULL,
  `prestasi_dicapai` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prodis`
--

INSERT INTO `prodis` (`id`, `nama_prodi`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Sipil', '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(2, 'Teknik Mesin', '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(3, 'Teknik Elektro', '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(4, 'Teknik Informatika', '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(5, 'Sistem Informasi', '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(6, 'Ilmu Lingkungan', '2026-03-23 07:46:33', '2026-03-23 07:46:33'),
(7, 'Rekayasa Pertanian dan Biosistem', '2026-03-23 07:46:33', '2026-03-23 07:46:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_jasa_dtps`
--

CREATE TABLE `produk_jasa_dtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dtps` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_jasa_mahasiswas`
--

CREATE TABLE `produk_jasa_mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `nama_produk_jasa` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_dosens`
--

CREATE TABLE `profil_dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `nidn_nidk` varchar(255) DEFAULT NULL,
  `kategori_dosen` enum('Dosen Tetap','Dosen Tidak Tetap','Dosen Industri') NOT NULL,
  `pendidikan_s1` varchar(255) DEFAULT NULL,
  `pendidikan_s2` varchar(255) DEFAULT NULL,
  `pendidikan_s3` varchar(255) DEFAULT NULL,
  `bidang_keahlian` varchar(255) NOT NULL,
  `perusahaan_industri` varchar(255) DEFAULT NULL,
  `kesesuaian_kompetensi` enum('V','-') NOT NULL DEFAULT 'V',
  `jabatan_akademik` enum('Tenaga Pengajar','Asisten Ahli','Lektor','Lektor Kepala','Guru Besar','-') NOT NULL DEFAULT '-',
  `sertifikat_pendidik` varchar(255) DEFAULT NULL,
  `sertifikat_kompetensi` varchar(255) DEFAULT NULL,
  `sertifikat_keinsinyuran` enum('IPM','IPU','-') NOT NULL DEFAULT '-',
  `matkul_ps_diakreditasi` text DEFAULT NULL,
  `kesesuaian_matkul` enum('V','-') NOT NULL DEFAULT 'V',
  `matkul_ps_lain` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profil_dosens`
--

INSERT INTO `profil_dosens` (`id`, `prodi_id`, `nama_dosen`, `nidn_nidk`, `kategori_dosen`, `pendidikan_s1`, `pendidikan_s2`, `pendidikan_s3`, `bidang_keahlian`, `perusahaan_industri`, `kesesuaian_kompetensi`, `jabatan_akademik`, `sertifikat_pendidik`, `sertifikat_kompetensi`, `sertifikat_keinsinyuran`, `matkul_ps_diakreditasi`, `kesesuaian_matkul`, `matkul_ps_lain`, `created_at`, `updated_at`) VALUES
(1, 3, 'Rifki adi nugraha', '227779', 'Dosen Tetap', 'Universitas IBN Khaldun', 'ui', 'ub', 'teknik', NULL, 'V', 'Lektor', '4433999', 'ccna', 'IPM', 'kalkuus', 'V', NULL, '2026-03-23 09:12:48', '2026-03-23 09:12:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `publikasi_ilmiah_dtps`
--

CREATE TABLE `publikasi_ilmiah_dtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_publikasi` varchar(255) NOT NULL,
  `jumlah_ts2` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts1` int(11) NOT NULL DEFAULT 0,
  `jumlah_ts` int(11) NOT NULL DEFAULT 0,
  `jumlah_total` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `publikasi_ilmiah_dtps`
--

INSERT INTO `publikasi_ilmiah_dtps` (`id`, `prodi_id`, `jenis_publikasi`, `jumlah_ts2`, `jumlah_ts1`, `jumlah_ts`, `jumlah_total`, `created_at`, `updated_at`) VALUES
(1, 3, 'Jurnal internasional', 3, 1, 1, 5, '2026-03-26 07:40:06', '2026-03-26 07:40:06'),
(2, 5, 'Prosiding seminar nasional', 2, 4, 6, 12, '2026-03-30 00:21:50', '2026-03-30 00:21:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `publikasi_ilmiah_mahasiswas`
--

CREATE TABLE `publikasi_ilmiah_mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `media_publikasi` varchar(255) NOT NULL,
  `ts_2` int(11) NOT NULL DEFAULT 0,
  `ts_1` int(11) NOT NULL DEFAULT 0,
  `ts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `publikasi_mahasiswa_terapans`
--

CREATE TABLE `publikasi_mahasiswa_terapans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_publikasi` varchar(255) NOT NULL,
  `ts_2` int(11) NOT NULL DEFAULT 0,
  `ts_1` int(11) NOT NULL DEFAULT 0,
  `ts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('b5I9e09AW2sj9oipbtjgjNS5Ca8mhtgO1dmYoHvV', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibG5iZUxpVk9UeGhwQWV0RFZzeXZ2MUxUVmJVVFFCOWJnb2xhWG02YyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sa3BzL3Zpc2ktbWlzaSI7czo1OiJyb3V0ZSI7czoxNToidmlzaV9taXNpLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1774856751),
('CB8rg3OaiBZ4p7YLg63eSGbiRPUwjR4gNE6l93pd', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMGg2d1QxaDZnSkhCbXh2M3lyajNXR1dBMkVYSkNLeFI0eVZmOVhSOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1774936674),
('f3tgZXevQjXXTHwp3MmPAIHIwzbwitFSzAS8rUla', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaWVHZGNxR1hZNUJqS3REMW9QUUFJcGs3ajJBbUJsQldYNlVaY1dKMyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xrcHMvdmlzaS1taXNpIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sa3BzL3Zpc2ktbWlzaSI7czo1OiJyb3V0ZSI7czoxNToidmlzaV9taXNpLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774934178);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat_kerja_lulusans`
--

CREATE TABLE `tempat_kerja_lulusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_lulus` varchar(255) NOT NULL,
  `jumlah_lulusan` int(11) NOT NULL DEFAULT 0,
  `jumlah_tanggapan` int(11) NOT NULL DEFAULT 0,
  `jumlah_terlacak` int(11) NOT NULL DEFAULT 0,
  `tingkat_lokal` int(11) NOT NULL DEFAULT 0,
  `tingkat_nasional` int(11) NOT NULL DEFAULT 0,
  `tingkat_multinasional` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tenaga_kependidikans`
--

CREATE TABLE `tenaga_kependidikans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_tenaga_kependidikan` varchar(255) NOT NULL,
  `pendidikan_terakhir` enum('S3','S2','S1','D4','D3','D2','D1','SMA/SMK') NOT NULL,
  `sertifikat_kompetensi` varchar(255) DEFAULT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin_prodi',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `prodi_id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin Teknik Sipil', 'admin.sipil@uikabogor.ac.id', 'admin_prodi', '2026-03-23 07:46:34', '$2y$12$7KoAc.PcQrycgZiAwYQWouHt7.hDLmW9SQgWVHCRZaztd6DOTyj4a', 'bpoSbTQORj', '2026-03-23 07:46:34', '2026-03-23 07:46:34'),
(2, 2, 'Admin Teknik Mesin', 'admin.mesin@uikabogor.ac.id', 'admin_prodi', '2026-03-23 07:46:35', '$2y$12$cKxcfXYfyilxhaJYZtkApO1I6imTgg7hUjo8gALdwAup5koNTtakm', '4GEREOLYhu', '2026-03-23 07:46:35', '2026-03-23 07:46:35'),
(3, 3, 'Admin Teknik Elektro', 'admin.elektro@uikabogor.ac.id', 'admin_prodi', '2026-03-23 07:46:35', '$2y$12$/LiX4a5zzbwmNanNPvymHOb/VodkYPveBRyu0XZHI/CA.vygPZUZ2', '853whkyBZ2BFYSMBRYy49eHAs8NSNfL9LZaSCDJW3mjEcjz5hoxJWiGhqIkX', '2026-03-23 07:46:35', '2026-03-23 07:46:35'),
(4, 4, 'Admin Teknik Informatika', 'admin.informatika@uikabogor.ac.id', 'admin_prodi', '2026-03-23 07:46:35', '$2y$12$GDSVVcZi0xWapb8Vf8k2Ge20DevwSv0cjy/nQ6ovC5hClRZtp3pa6', '8eLFHPypzuAGrWLmJnOlxrLQSw75cFM7hIVEkOFPkbYi7o7pcl44LiPFwcd4', '2026-03-23 07:46:35', '2026-03-23 07:46:35'),
(5, 5, 'Admin Sistem Informasi', 'admin.sistem-informasi@uikabogor.ac.id', 'admin_prodi', '2026-03-23 07:46:36', '$2y$12$0tDIobgU6x9yYzVeBAmMcuL5h5QSCFDBAp4G68RzQfnKPCzCLz4dC', 'R8FIX4o3dR4sH5DJsy6GeyjUlsW3jYol0ezx48JLy00PIfl8F9tQ8jKJnsNv', '2026-03-23 07:46:36', '2026-03-23 07:46:36'),
(6, 6, 'Admin Ilmu Lingkungan', 'admin.ilmu-lingkungan@uikabogor.ac.id', 'admin_prodi', '2026-03-23 07:46:36', '$2y$12$Qq3wjH8QOddQ4mujAhEWyOoV5GxTkb4vJI16B1PWaEPXK7f8rMWLq', 'x0IfRw6yUoFgXcve8ATC8fD8C6Tjefj9iCXYAeBMJfKpDyuP6WP0FuoLFVgS', '2026-03-23 07:46:36', '2026-03-23 07:46:36'),
(7, 7, 'Admin Rekayasa Pertanian dan Biosistem', 'admin.rekayasa-pertanian-dan-biosistem@uikabogor.ac.id', 'admin_prodi', '2026-03-23 07:46:36', '$2y$12$7qca7BaN92cxo6MAPsmWaOXd2XMrlVfXXGbSRJmhmKttG3iNZCmF2', '22HTFFKyRGzyv2QIzmBfMlormLiVaSThBwmLHDCKgYCc45ZVMLRJeD25M4Nf', '2026-03-23 07:46:36', '2026-03-23 07:46:36'),
(8, NULL, 'Super Admin Fakultas', 'admin.fakultas@uikabogor.ac.id', 'gpm', '2026-03-23 07:46:37', '$2y$12$RV.2z6Zg7WpomNEJHMnqMO4lN84rsxYJUUKuPAl68bCd.6yVXHL2W', 'LozaV9lUlPksO0UrvDPFW2707OiiiHfw0x7DbselKI4flrEyDftV2RBqhCwt', '2026-03-23 07:46:37', '2026-03-23 07:46:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visi_misis`
--

CREATE TABLE `visi_misis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_vmts` enum('VMTS PT','VMTS UPPS','Visi Keilmuan PS') NOT NULL,
  `pernyataan` text NOT NULL,
  `no_sk` varchar(255) DEFAULT NULL,
  `link_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_linear_pt` tinyint(1) NOT NULL DEFAULT 0,
  `is_sesuai_renstra` tinyint(1) NOT NULL DEFAULT 0,
  `is_sesuai_kurikulum` tinyint(1) NOT NULL DEFAULT 0,
  `is_tinjau_berkala` tinyint(1) NOT NULL DEFAULT 0,
  `libatkan_internal` tinyint(1) NOT NULL DEFAULT 0,
  `libatkan_eksternal_lengkap` tinyint(1) NOT NULL DEFAULT 0,
  `is_sosialisasi_menyeluruh` tinyint(1) NOT NULL DEFAULT 0,
  `has_pencapaian_konkret` tinyint(1) NOT NULL DEFAULT 0,
  `is_berkelanjutan` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `visi_misis`
--

INSERT INTO `visi_misis` (`id`, `prodi_id`, `jenis_vmts`, `pernyataan`, `no_sk`, `link_dokumen`, `created_at`, `updated_at`, `is_linear_pt`, `is_sesuai_renstra`, `is_sesuai_kurikulum`, `is_tinjau_berkala`, `libatkan_internal`, `libatkan_eksternal_lengkap`, `is_sosialisasi_menyeluruh`, `has_pencapaian_konkret`, `is_berkelanjutan`) VALUES
(1, 2, 'VMTS PT', 'dasdasd', '0152/lamteknik/2202', 'https://423y23g', '2026-03-25 00:36:48', '2026-03-25 00:36:48', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 3, 'Visi Keilmuan PS', 'dasdkak', '0152/lamteknik/2202', 'https://423y23g', '2026-03-30 20:14:59', '2026-03-30 20:14:59', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu_tunggu_lulusans`
--

CREATE TABLE `waktu_tunggu_lulusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_lulus` varchar(255) NOT NULL,
  `jumlah_lulusan` int(11) NOT NULL DEFAULT 0,
  `jumlah_lulusan_terlacak` int(11) NOT NULL DEFAULT 0,
  `wt_kurang_3_bulan` int(11) NOT NULL DEFAULT 0,
  `wt_antara_3_18_bulan` int(11) NOT NULL DEFAULT 0,
  `wt_lebih_18_bulan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `beban_kerja_dosens`
--
ALTER TABLE `beban_kerja_dosens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `capstone_designs`
--
ALTER TABLE `capstone_designs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen_k3ls`
--
ALTER TABLE `dokumen_k3ls`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen_pembelajarans`
--
ALTER TABLE `dokumen_pembelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen_spmis`
--
ALTER TABLE `dokumen_spmis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `fasilitas_k3ls`
--
ALTER TABLE `fasilitas_k3ls`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `integrasi_pembelajarans`
--
ALTER TABLE `integrasi_pembelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ipk_lulusans`
--
ALTER TABLE `ipk_lulusans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jumlah_mahasiswas`
--
ALTER TABLE `jumlah_mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karya_ilmiah_dtps`
--
ALTER TABLE `karya_ilmiah_dtps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karya_ilmiah_sitasis`
--
ALTER TABLE `karya_ilmiah_sitasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kepuasan_pengguna_lulusans`
--
ALTER TABLE `kepuasan_pengguna_lulusans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kerjasama_pendidikans`
--
ALTER TABLE `kerjasama_pendidikans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kerjasama_penelitians`
--
ALTER TABLE `kerjasama_penelitians`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kerjasama_pengabdians`
--
ALTER TABLE `kerjasama_pengabdians`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kesesuaian_bidang_kerjas`
--
ALTER TABLE `kesesuaian_bidang_kerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keuangans`
--
ALTER TABLE `keuangans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kinerja_dtps`
--
ALTER TABLE `kinerja_dtps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kurikulums`
--
ALTER TABLE `kurikulums`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `luaran_buku_isbns`
--
ALTER TABLE `luaran_buku_isbns`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `luaran_hki_bagian2s`
--
ALTER TABLE `luaran_hki_bagian2s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `luaran_hki_bagian2s_prodi_id_foreign` (`prodi_id`);

--
-- Indeks untuk tabel `luaran_hki_bagian3s`
--
ALTER TABLE `luaran_hki_bagian3s`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `luaran_hki_bagian4s`
--
ALTER TABLE `luaran_hki_bagian4s`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `luaran_hki_hak_ciptas`
--
ALTER TABLE `luaran_hki_hak_ciptas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `luaran_hki_mahasiswas`
--
ALTER TABLE `luaran_hki_mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `luaran_hki_patens`
--
ALTER TABLE `luaran_hki_patens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `luaran_teknologi_produks`
--
ALTER TABLE `luaran_teknologi_produks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `masa_studi_lulusans`
--
ALTER TABLE `masa_studi_lulusans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `matkul_basic_sciences`
--
ALTER TABLE `matkul_basic_sciences`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelaksanaan_spmis`
--
ALTER TABLE `pelaksanaan_spmis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembimbing_lapangans`
--
ALTER TABLE `pembimbing_lapangans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penelitian_dtps`
--
ALTER TABLE `penelitian_dtps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penelitian_dtps_mahasiswas`
--
ALTER TABLE `penelitian_dtps_mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penelitian_dtps_rujukans`
--
ALTER TABLE `penelitian_dtps_rujukans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengakuan_dtps`
--
ALTER TABLE `pengakuan_dtps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penggunaan_danas`
--
ALTER TABLE `penggunaan_danas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pkm_dtps`
--
ALTER TABLE `pkm_dtps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pkm_dtps_mahasiswas`
--
ALTER TABLE `pkm_dtps_mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prasarana_peralatans`
--
ALTER TABLE `prasarana_peralatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prestasi_akademiks`
--
ALTER TABLE `prestasi_akademiks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prestasi_non_akademiks`
--
ALTER TABLE `prestasi_non_akademiks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk_jasa_dtps`
--
ALTER TABLE `produk_jasa_dtps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk_jasa_mahasiswas`
--
ALTER TABLE `produk_jasa_mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil_dosens`
--
ALTER TABLE `profil_dosens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_dosens_prodi_id_foreign` (`prodi_id`);

--
-- Indeks untuk tabel `publikasi_ilmiah_dtps`
--
ALTER TABLE `publikasi_ilmiah_dtps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `publikasi_ilmiah_mahasiswas`
--
ALTER TABLE `publikasi_ilmiah_mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `publikasi_mahasiswa_terapans`
--
ALTER TABLE `publikasi_mahasiswa_terapans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tempat_kerja_lulusans`
--
ALTER TABLE `tempat_kerja_lulusans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tenaga_kependidikans`
--
ALTER TABLE `tenaga_kependidikans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `visi_misis`
--
ALTER TABLE `visi_misis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `waktu_tunggu_lulusans`
--
ALTER TABLE `waktu_tunggu_lulusans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `beban_kerja_dosens`
--
ALTER TABLE `beban_kerja_dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `capstone_designs`
--
ALTER TABLE `capstone_designs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `dokumen_k3ls`
--
ALTER TABLE `dokumen_k3ls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokumen_pembelajarans`
--
ALTER TABLE `dokumen_pembelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dokumen_spmis`
--
ALTER TABLE `dokumen_spmis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fasilitas_k3ls`
--
ALTER TABLE `fasilitas_k3ls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `integrasi_pembelajarans`
--
ALTER TABLE `integrasi_pembelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ipk_lulusans`
--
ALTER TABLE `ipk_lulusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jumlah_mahasiswas`
--
ALTER TABLE `jumlah_mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karya_ilmiah_dtps`
--
ALTER TABLE `karya_ilmiah_dtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `karya_ilmiah_sitasis`
--
ALTER TABLE `karya_ilmiah_sitasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kepuasan_pengguna_lulusans`
--
ALTER TABLE `kepuasan_pengguna_lulusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kerjasama_pendidikans`
--
ALTER TABLE `kerjasama_pendidikans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kerjasama_penelitians`
--
ALTER TABLE `kerjasama_penelitians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kerjasama_pengabdians`
--
ALTER TABLE `kerjasama_pengabdians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kesesuaian_bidang_kerjas`
--
ALTER TABLE `kesesuaian_bidang_kerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keuangans`
--
ALTER TABLE `keuangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kinerja_dtps`
--
ALTER TABLE `kinerja_dtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kurikulums`
--
ALTER TABLE `kurikulums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `luaran_buku_isbns`
--
ALTER TABLE `luaran_buku_isbns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `luaran_hki_bagian2s`
--
ALTER TABLE `luaran_hki_bagian2s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `luaran_hki_bagian3s`
--
ALTER TABLE `luaran_hki_bagian3s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `luaran_hki_bagian4s`
--
ALTER TABLE `luaran_hki_bagian4s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `luaran_hki_hak_ciptas`
--
ALTER TABLE `luaran_hki_hak_ciptas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `luaran_hki_mahasiswas`
--
ALTER TABLE `luaran_hki_mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `luaran_hki_patens`
--
ALTER TABLE `luaran_hki_patens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `luaran_teknologi_produks`
--
ALTER TABLE `luaran_teknologi_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `masa_studi_lulusans`
--
ALTER TABLE `masa_studi_lulusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `matkul_basic_sciences`
--
ALTER TABLE `matkul_basic_sciences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `pelaksanaan_spmis`
--
ALTER TABLE `pelaksanaan_spmis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembimbing_lapangans`
--
ALTER TABLE `pembimbing_lapangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penelitian_dtps`
--
ALTER TABLE `penelitian_dtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penelitian_dtps_mahasiswas`
--
ALTER TABLE `penelitian_dtps_mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penelitian_dtps_rujukans`
--
ALTER TABLE `penelitian_dtps_rujukans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengakuan_dtps`
--
ALTER TABLE `pengakuan_dtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penggunaan_danas`
--
ALTER TABLE `penggunaan_danas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pkm_dtps`
--
ALTER TABLE `pkm_dtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pkm_dtps_mahasiswas`
--
ALTER TABLE `pkm_dtps_mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prasarana_peralatans`
--
ALTER TABLE `prasarana_peralatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasi_akademiks`
--
ALTER TABLE `prestasi_akademiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasi_non_akademiks`
--
ALTER TABLE `prestasi_non_akademiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produk_jasa_dtps`
--
ALTER TABLE `produk_jasa_dtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk_jasa_mahasiswas`
--
ALTER TABLE `produk_jasa_mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profil_dosens`
--
ALTER TABLE `profil_dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `publikasi_ilmiah_dtps`
--
ALTER TABLE `publikasi_ilmiah_dtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `publikasi_ilmiah_mahasiswas`
--
ALTER TABLE `publikasi_ilmiah_mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `publikasi_mahasiswa_terapans`
--
ALTER TABLE `publikasi_mahasiswa_terapans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tempat_kerja_lulusans`
--
ALTER TABLE `tempat_kerja_lulusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tenaga_kependidikans`
--
ALTER TABLE `tenaga_kependidikans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `visi_misis`
--
ALTER TABLE `visi_misis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `waktu_tunggu_lulusans`
--
ALTER TABLE `waktu_tunggu_lulusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `luaran_hki_bagian2s`
--
ALTER TABLE `luaran_hki_bagian2s`
  ADD CONSTRAINT `luaran_hki_bagian2s_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `profil_dosens`
--
ALTER TABLE `profil_dosens`
  ADD CONSTRAINT `profil_dosens_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
