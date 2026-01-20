-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 05:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_absensi`
--

CREATE TABLE `tbl_absensi` (
  `id` int(11) NOT NULL,
  `jadwal` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kehadiran` varchar(10) NOT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id`, `jadwal`, `siswa`, `tanggal`, `kehadiran`, `catatan`) VALUES
(5, 6, 1, '2025-08-11', 'Hadir', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berita`
--

CREATE TABLE `tbl_berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT 'Admin',
  `kategori` varchar(100) DEFAULT 'Umum',
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_berita`
--

INSERT INTO `tbl_berita` (`id_berita`, `judul`, `slug`, `isi`, `gambar`, `penulis`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES
(7, 'Siswa UPTD SMPN 14 Pematangsiantar Laksanakan Gladi Resik ANBK', 'siswa-uptd-smpn-14-pematangsiantar-laksanakan-gladi-resik-anbk', 'Pematangsiantar – Suasana ruang kelas UPTD SMP Negeri 14 Pematangsiantar tampak berbeda pada hari ini. Para siswa duduk berhadapan dengan laptop masing-masing, mengikuti gladi resik Asesmen Nasional Berbasis Komputer (ANBK) yang digelar sekolah. Kegiatan ini dipandu langsung oleh guru pengawas serta panitia yang bertugas memastikan seluruh perangkat dan jaringan berjalan lancar.\n\nGladi resik ANBK bertujuan untuk melatih siswa agar lebih siap menghadapi pelaksanaan ANBK sesungguhnya. Selain itu, kegiatan ini juga menjadi sarana uji coba perangkat komputer, aplikasi asesmen, serta kesiapan jaringan internet di sekolah.\n\nKepala SMPN 14 Pematangsiantar melalui guru yang mendampingi menyampaikan bahwa gladi resik ini penting agar siswa tidak lagi canggung saat hari pelaksanaan tiba. “Kami ingin memastikan seluruh peserta memahami tata cara mengerjakan soal berbasis komputer, sehingga pada saat pelaksanaan nanti mereka lebih tenang dan fokus,” ujarnya.\n\nDengan diadakannya gladi resik ini, SMPN 14 Pematangsiantar berharap seluruh siswa dapat mengikuti ANBK dengan baik serta memperoleh hasil yang maksimal sebagai gambaran mutu pendidikan sekolah.', '68a6f587bd11e.jpeg', 'Admin', 'Umum', '2025-08-19', '2025-08-21 10:31:35', '2025-08-22 06:40:59'),
(8, 'Pembagian Hadiah Lomba HUT RI ke-80 di UPTD SMPN 14 Pematangsiantar', 'pembagian-hadiah-lomba-hut-ri-ke-80-di-uptd-smpn-14-pematangsiantar', 'Pada pagi hari ini, Jumat, 22 Agustus 2025, UPTD SMPN 14 Pematangsiantar melaksanakan kegiatan pembagian hadiah kepada para pemenang lomba dalam rangka memperingati Hari Ulang Tahun Kemerdekaan Republik Indonesia ke-80. Acara berlangsung di halaman sekolah dengan penuh semangat kebersamaan.\r\n\r\nGuru-guru turut hadir mendampingi jalannya acara sekaligus menyerahkan hadiah kepada para perwakilan siswa yang berhasil meraih kemenangan pada berbagai cabang perlombaan. Penyerahan hadiah dilakukan secara bergantian oleh para guru, sementara jalannya acara dipandu dengan antusias oleh salah seorang guru yang bertindak sebagai pembawa acara.\r\n\r\nSuasana semakin meriah dengan tepuk tangan dan sorak sorai siswa yang memberikan dukungan kepada teman-temannya. Kegiatan ini menjadi bentuk penghargaan sekolah atas kreativitas, sportivitas, serta kebersamaan siswa dalam menyemarakkan HUT RI ke-80.', '68a813c440f7e.jpeg', 'Admin', 'Umum', '2025-08-22', '2025-08-22 06:52:52', '2025-08-22 06:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ekskul`
--

CREATE TABLE `tbl_ekskul` (
  `id_ekskul` int(11) NOT NULL,
  `nama_ekskul` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `pembina_putra` varchar(100) DEFAULT NULL,
  `pembina_putri` varchar(100) DEFAULT NULL,
  `pelatih` varchar(100) DEFAULT NULL,
  `hari` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ekskul`
--

INSERT INTO `tbl_ekskul` (`id_ekskul`, `nama_ekskul`, `keterangan`, `pembina_putra`, `pembina_putri`, `pelatih`, `hari`, `created_at`) VALUES
(1, 'Pramuka', 'Pramuka adalah salah satu ekskul seru di sekolah yang nggak cuma bikin kita aktif, tapi juga melatih disiplin dan kemandirian. Kegiatannya beragam, mulai dari belajar tali-temali, baris-berbaris, mendirikan tenda, penjelajahan, permainan kelompok, sampai perkemahan. Kadang juga ada kegiatan sosial seperti bakti lingkungan dan membantu masyarakat.\r\n\r\nLewat pramuka, siswa bisa belajar kerja sama, kepemimpinan, tanggung jawab, dan peduli sekitar. Manfaatnya banyak banget: bikin lebih mandiri, berani, kreatif, dan siap menghadapi tantangan. Jadi, ikut pramuka itu bukan sekadar aktivitas, tapi pengalaman berharga yang bikin karakter makin kuat.', '', '', '', 'Setiap hari sabtu, sepulang sekolah.', '2025-08-22 08:08:45'),
(3, 'Seni Tari', 'Ekskul Seni Tari jadi wadah buat siswa yang suka mengekspresikan diri lewat gerakan indah dan penuh makna. Kegiatannya biasanya meliputi latihan tarian tradisional, kreasi modern, sampai persiapan tampil di acara sekolah maupun lomba. Selain itu, siswa juga diajarkan soal kekompakan, irama, ekspresi, dan penghayatan dalam setiap tarian.\r\n\r\nManfaat ikut seni tari nggak cuma bisa melestarikan budaya, tapi juga melatih percaya diri, kreativitas, dan kekompakan tim. Dengan ikut ekskul ini, siswa bisa menyalurkan bakat sekaligus mengasah kemampuan seni yang bikin pengalaman sekolah jadi lebih berwarna.', '', '', 'Santa Sinaga', 'Setiap hari rabu, sepulang sekolah', '2025-08-22 08:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ekskul_foto`
--

CREATE TABLE `tbl_ekskul_foto` (
  `id_foto` int(11) NOT NULL,
  `id_ekskul` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ekskul_foto`
--

INSERT INTO `tbl_ekskul_foto` (`id_foto`, `id_ekskul`, `nama_file`) VALUES
(1, 3, '1755850750_68a827fe505e1.jpeg'),
(2, 3, '1755850750_68a827fe540d1.jpeg'),
(3, 3, '1755850750_68a827fe563ec.jpeg'),
(4, 1, '1755851559_68a82b271364a.jpeg'),
(5, 1, '1755851559_68a82b2719d19.jpeg'),
(6, 1, '1755851559_68a82b271d102.jpeg'),
(7, 1, '1755851559_68a82b271e730.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer`
--

CREATE TABLE `tbl_footer` (
  `id` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `maps` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_footer`
--

INSERT INTO `tbl_footer` (`id`, `alamat`, `phone`, `email`, `maps`, `foto`) VALUES
(1, 'Jl. Tj. Pinggir, Kec. Siantar Martoba, Kota Pematangsiantar, Sumatera Utara, 21138', '012345678910', 'smpn14pematangsiantar@email.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.334133238255!2d99.06537737497061!3d3.004463696971533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303183f91af189f7%3A0xa2f5f10fc9c99e71!2sSMP%20NEGERI%2014%20PEMATANGSIANTAR!5e0!3m2!1sid!2s', '2916-.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(125) NOT NULL,
  `tgl_lahir` varchar(125) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `foto` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_guru`
--

INSERT INTO `tbl_guru` (`id`, `nip`, `nama`, `jabatan`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `kontak`, `agama`, `foto`) VALUES
(1, '197306131999031003', 'Romel B. Sinaga', 'Kepala Sekolah', '1973-06-13', 'Laki-laki', '', '', 'Protestan', 'default.png'),
(2, '197906012007012006', 'Juni Anna Nasution', 'Wakil Kepala Sekolah', '1970-06-01', 'Perempuan', '', '', 'Islam', 'default.png'),
(3, '197902022014102002', 'Lamminar Sianturi', 'Guru B. Inggris', '1979-02-02', 'Perempuan', 'Jln. Bunga Lawang', '', 'Protestan', 'default.png'),
(4, '199004282023212024', 'Ima Friska Dona Sinaga', 'Guru Agama Katolik', '1990-04-28', 'Perempuan', 'Jln. Tanjung Pinggir', '', 'Katolik', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `mapel` int(11) NOT NULL,
  `guru` int(11) DEFAULT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id`, `hari`, `jam_mulai`, `jam_selesai`, `mapel`, `guru`, `kelas`) VALUES
(1, 'Senin', '07:30:00', '08:10:00', 1, 3, 1),
(4, 'Senin', '08:10:00', '08:55:00', 2, 4, 1),
(5, 'Selasa', '07:30:00', '08:10:00', 2, 4, 2),
(6, 'Senin', '07:30:00', '08:10:00', 2, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `wali_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id`, `kelas`, `wali_kelas`) VALUES
(1, 'VII', NULL),
(2, 'VIII', NULL),
(3, 'IX', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai_ujian`
--

CREATE TABLE `tbl_nilai_ujian` (
  `id` int(11) NOT NULL,
  `no_ujian` char(7) NOT NULL,
  `pelajaran` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `nilai_ujian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nilai_ujian`
--

INSERT INTO `tbl_nilai_ujian` (`id`, `no_ujian`, `pelajaran`, `kelas`, `nilai_ujian`) VALUES
(1, 'UTS-002', 'Seni', 'VII', 70),
(2, 'UTS-002', 'Bahasa Inggris', 'VII', 80),
(3, 'UTS-003', 'Sejarah', 'IX', 55),
(4, 'UTS-004', 'Bahasa Inggris II', '', 90),
(5, 'UTS-004', 'Seni II', '', 80),
(6, 'UTS-004', 'Sejarah II', '', 85),
(7, 'UTS-004', 'Bahasa Inggris II', '', 90),
(8, 'UTS-004', 'Seni II', '', 80),
(9, 'UTS-004', 'Sejarah II', '', 85),
(10, 'UTS-005', 'Sejarah III', 'IX', 75),
(11, 'UTS-005', 'Seni III', 'IX', 65),
(12, 'UTS-005', 'Bahasa Inggris III', 'IX', 70),
(13, 'UTS-006', 'Bahasa Inggris II', 'VIII', 60),
(14, 'UTS-006', 'Seni II', 'VIII', 60),
(15, 'UTS-006', 'Sejarah II', 'VIII', 55),
(16, 'UTS-007', 'Seni', 'VII', 65),
(17, 'UTS-007', 'Bahasa Inggris', 'VII', 70),
(18, 'UTS-007', 'Sejarah', 'VII', 75),
(19, 'UTS-008', 'Seni', 'VII', 70),
(20, 'UTS-008', 'Bahasa Inggris', 'VII', 75),
(21, 'UTS-008', 'Sejarah', 'VII', 80),
(26, 'UTS-010', 'Bahasa Inggris', 'VII', 75),
(27, 'UTS-010', 'Sejarah', 'VII', 80),
(28, 'UTS-011', 'Seni', 'VII', 75),
(29, 'UTS-011', 'Bahasa Inggris', 'VII', 80),
(30, 'UTS-011', 'Sejarah', 'VII', 85),
(31, 'UTS-012', 'Seni', 'VII', 75),
(32, 'UTS-012', 'Bahasa Inggris', 'VII', 80),
(33, 'UTS-012', 'Sejarah', 'VII', 85),
(34, 'UTS-009', 'Seni', '', 80),
(35, 'UTS-009', 'Bahasa Inggris', '', 85),
(36, 'UTS-009', 'Sejarah', '', 75);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelajaran`
--

CREATE TABLE `tbl_pelajaran` (
  `id` int(11) NOT NULL,
  `pelajaran` varchar(50) NOT NULL,
  `guru` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pelajaran`
--

INSERT INTO `tbl_pelajaran` (`id`, `pelajaran`, `guru`) VALUES
(1, 'Bahasa Inggris', 'Lamminar Sianturi'),
(2, 'Agama Katolik', 'Ima Friska Dona Sinaga');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sekolah`
--

CREATE TABLE `tbl_sekolah` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `npsn` varchar(125) NOT NULL,
  `alamat` text NOT NULL,
  `akreditasi` char(1) NOT NULL,
  `kurikulum` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `sambutan` text NOT NULL,
  `ucapan` text NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sekolah`
--

INSERT INTO `tbl_sekolah` (`id`, `nama`, `npsn`, `alamat`, `akreditasi`, `kurikulum`, `email`, `visi`, `misi`, `sambutan`, `ucapan`, `gambar`) VALUES
(1, 'SMPN 14 Pematangsiantar', '70011747', 'Jl. Tanjung Pinggir, Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara, Indonesia, 21138', 'A', 'Kurikulum 2013,Kurikulum Merdeka', 'smpn14pematangsiantar@email.com', 'Berkualitas Religius, Terampil dan Berkarakter.', '1. Mewujudkan warga sekolah yang beriman dan bertaqwa.\r\n2. Melaksanakan pengembangan  profesionalisme guru.\r\n3. Meningkatkan SDM di lingkungan sekolah berbasis IPTEK.\r\n4. Meningkatkan kreatifitas dan inovasi pembelajaran.\r\n5. Meningkatkan prestasi akademik dan non akademik.\r\n6. Melaksanakan pembelajaran dan bimbingan secara efektif dan edisien.\r\n7. Melaksanakan manajemen sekolah yang transparan dan akuntabel.\r\n8. Membina dan menumbuhkan budaya disiplin berkarakter.\r\n9. Meningkatkan budi pekerti luhur, cerdas dan mandiri serta berwawasan nasional.\r\n10. Mewujudkan sekolah 7K (Keamanan, Ketertiban, Kebersihan, Keindahan, Kesehatan, Kerapian, dan Kekeluargaan).', 'UPTD SMPN 14 Pematangsiantar resmi berdiri pada 22 Juli 2021 melalui SK Pendirian Nomor 420/2085/PP/2021. Berlokasi di Jalan Tanjung Pinggir, sekolah ini hadir untuk memperluas akses dan pemerataan pendidikan di Kota Pematangsiantar. Sejak awal, SMPN 14 berada di bawah naungan Kementerian Pendidikan dan Kebudayaan serta Dinas Pendidikan Kota Pematangsiantar. Dengan menerapkan kurikulum yang relevan saat ini, sekolah ini berkomitmen menjadi lembaga pendidikan yang unggul, modern, dan adaptif terhadap perkembangan zaman.', 'Selamat Datang di Website Resmi UPTD SMPN 14 Pematangsiantar', '2576-smpn-14-pematangsiantar.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(128) NOT NULL,
  `nisn` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `tgl_lahir` varchar(125) NOT NULL,
  `agama` varchar(125) NOT NULL,
  `jenis_kelamin` varchar(125) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `kelas` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id`, `nis`, `nisn`, `nama`, `tgl_lahir`, `agama`, `jenis_kelamin`, `alamat`, `kelas`, `foto`) VALUES
(1, '1526371', '3674282', 'Steffie', '2013-12-09', 'Hindu', 'Perempuan', 'Jalan Mawar', 3, '5116-steffie.jpeg'),
(3, '6354216', '6521633', 'Lebron', '2012-11-15', 'Buddha', 'Laki-laki', 'Jalan Surabaya', 3, '1311-lebron.jpg'),
(4, '1526372', '3674283', 'Janice Olivia', '2014-04-05', 'Hindu', 'Perempuan', 'Jalan Anggrek', 1, '728-janice-olivia.jpeg'),
(6, '1526374', '3674285', 'Matthew', '2012-01-01', 'Protestan', 'Laki-laki', 'Jalan Bandung', 3, '8615-matthew.jpg'),
(8, '1526375', '3674286', 'Rama', '2013-03-14', 'Islam', 'Laki-laki', 'Jalan Mawar', 2, 'default.png'),
(9, '1526376', '3674287', 'Desmond', '2013-11-14', 'Buddha', 'Laki-laki', 'Jalan Anggrek', 1, 'default.png'),
(10, '1526377', '3674288', 'Tania', '2014-04-24', 'Hindu', 'Perempuan', 'Jalan Singosari', 1, 'default.png'),
(11, '1526377', '3674288', 'Grace', '2014-04-24', 'Protestan', 'Perempuan', 'Jalan Sriwijaya', 2, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ujian`
--

CREATE TABLE `tbl_ujian` (
  `no_ujian` char(7) NOT NULL,
  `tgl_ujian` date NOT NULL,
  `nis` varchar(100) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `total_nilai` int(11) NOT NULL,
  `nilai_terendah` int(11) NOT NULL,
  `nilai_tertinggi` int(11) NOT NULL,
  `nilai_rata2` int(11) NOT NULL,
  `hasil_ujian` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ujian`
--

INSERT INTO `tbl_ujian` (`no_ujian`, `tgl_ujian`, `nis`, `nama`, `nisn`, `kelas`, `total_nilai`, `nilai_terendah`, `nilai_tertinggi`, `nilai_rata2`, `hasil_ujian`) VALUES
('UTS-002', '2025-08-07', '1526372', 'Janice Olivia', '3674283', 'VII', 150, 70, 80, 75, 'LULUS'),
('UTS-003', '2025-08-07', '1526371', 'Steffie', '3674282', 'IX', 55, 55, 55, 55, 'GAGAL'),
('UTS-004', '2025-08-11', '6354216', 'Lebron', '6521633', 'VIII', 255, 80, 90, 85, 'LULUS'),
('UTS-005', '2025-08-11', '1526374', 'Matthew', '3674285', 'IX', 210, 65, 75, 70, 'LULUS'),
('UTS-006', '2025-08-11', '1526375', 'Rama', '3674286', 'VIII', 175, 55, 60, 58, 'GAGAL'),
('UTS-007', '2025-08-11', '1526376', 'Desmond', '3674287', 'VII', 210, 65, 75, 70, 'LULUS'),
('UTS-008', '2025-08-11', '1526377', 'Tania', '3674288', 'VII', 225, 70, 80, 75, 'LULUS'),
('UTS-009', '2025-08-13', '1526371', 'Steffie', '3674282', 'IX', 240, 75, 85, 80, 'LULUS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `nama`, `alamat`, `jabatan`, `foto`) VALUES
(1, 'admin', '$2y$10$b11IOAycOMGcgRlZFDxsFOzole3O/vBu3VXoiEHKFbH1T28JRnx1O', 'Andrew', 'Jalan Bali', 'operator', '790-admin.jpg'),
(2, 'GuruKelas', '$2y$10$kOHTekxqSoLulqcbYF3UWOGSbSel.YG4cpvSgPwHdlekR6cDGgPRu', 'Audrey', 'Jalan Bunga Bakung', 'guru', '412-gurukelas.jpeg'),
(3, 'operator', '$2y$10$L8Tg1ZEfy/rYicl40ggC2eHSO6n7HF0e34Wnu6l5hgaqVbrL10vTO', 'Chris', 'Jalan Merdeka', 'operator', '8823-operator.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal` (`jadwal`),
  ADD KEY `siswa` (`siswa`);

--
-- Indexes for table `tbl_berita`
--
ALTER TABLE `tbl_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `tbl_ekskul`
--
ALTER TABLE `tbl_ekskul`
  ADD PRIMARY KEY (`id_ekskul`);

--
-- Indexes for table `tbl_ekskul_foto`
--
ALTER TABLE `tbl_ekskul_foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_ekskul` (`id_ekskul`);

--
-- Indexes for table `tbl_footer`
--
ALTER TABLE `tbl_footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapel` (`mapel`),
  ADD KEY `kelas` (`kelas`),
  ADD KEY `fk_jadwal_guru` (`guru`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wali_kelas_2` (`wali_kelas`),
  ADD KEY `wali_kelas` (`wali_kelas`);

--
-- Indexes for table `tbl_nilai_ujian`
--
ALTER TABLE `tbl_nilai_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pelajaran`
--
ALTER TABLE `tbl_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas` (`kelas`),
  ADD KEY `kelas_2` (`kelas`);

--
-- Indexes for table `tbl_ujian`
--
ALTER TABLE `tbl_ujian`
  ADD PRIMARY KEY (`no_ujian`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_berita`
--
ALTER TABLE `tbl_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_ekskul`
--
ALTER TABLE `tbl_ekskul`
  MODIFY `id_ekskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ekskul_foto`
--
ALTER TABLE `tbl_ekskul_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_footer`
--
ALTER TABLE `tbl_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_nilai_ujian`
--
ALTER TABLE `tbl_nilai_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_pelajaran`
--
ALTER TABLE `tbl_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD CONSTRAINT `tbl_absensi_ibfk_1` FOREIGN KEY (`jadwal`) REFERENCES `tbl_jadwal` (`id`),
  ADD CONSTRAINT `tbl_absensi_ibfk_2` FOREIGN KEY (`siswa`) REFERENCES `tbl_siswa` (`id`);

--
-- Constraints for table `tbl_ekskul_foto`
--
ALTER TABLE `tbl_ekskul_foto`
  ADD CONSTRAINT `tbl_ekskul_foto_ibfk_1` FOREIGN KEY (`id_ekskul`) REFERENCES `tbl_ekskul` (`id_ekskul`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD CONSTRAINT `fk_jadwal_guru` FOREIGN KEY (`guru`) REFERENCES `tbl_guru` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_jadwal_ibfk_2` FOREIGN KEY (`guru`) REFERENCES `tbl_guru` (`id`),
  ADD CONSTRAINT `tbl_jadwal_ibfk_3` FOREIGN KEY (`kelas`) REFERENCES `tbl_kelas` (`id`);

--
-- Constraints for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD CONSTRAINT `tbl_kelas_ibfk_1` FOREIGN KEY (`wali_kelas`) REFERENCES `tbl_guru` (`id`);

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `tbl_kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
