/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
  `id_anggota` varchar(50) NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `No_hp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Foto` varchar(250) NOT NULL,
  `foto_ktp` varchar(250) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `email` (`email`),
  KEY `anggota_ibfk_1` (`id_user`),
  CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tanggal_publish` date NOT NULL,
  `gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori` (`kategori`),
  CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_berita` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `history_trans`;
CREATE TABLE `history_trans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_trans` varchar(100) NOT NULL,
  `pemasukan` double NOT NULL,
  `pengeluaran` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `history_trans_ibfk_1` (`id_trans`),
  CONSTRAINT `history_trans_ibfk_1` FOREIGN KEY (`id_trans`) REFERENCES `transaksi` (`id_trans`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `iuran`;
CREATE TABLE `iuran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jumlah` double NOT NULL,
  `tanggal_iuran` date NOT NULL,
  `Keterangan` text NOT NULL,
  `nama_iuran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `iuran_detail`;
CREATE TABLE `iuran_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_anggota` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `jumlah` double NOT NULL,
  `tanggal_iuran` date NOT NULL,
  `Keterangan` text NOT NULL,
  `nama_iuran` varchar(255) DEFAULT NULL,
  `id_iuran` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `simpanan_ibfk_1` (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `kas_keluar`;
CREATE TABLE `kas_keluar` (
  `id_kas` varchar(50) NOT NULL,
  `nama_kas` varchar(200) NOT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `kas_masuk`;
CREATE TABLE `kas_masuk` (
  `id_kas` varchar(50) NOT NULL,
  `nama_kas` varchar(200) NOT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `kategori_berita`;
CREATE TABLE `kategori_berita` (
  `id_kategori` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `simpanan`;
CREATE TABLE `simpanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_anggota` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `angsuran` int NOT NULL,
  `jumlah` double NOT NULL,
  `tanggal_simpan` date NOT NULL,
  `Keterangan` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `simpanan_ibfk_1` (`id_anggota`),
  CONSTRAINT `simpanan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_trans` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_kas` varchar(200) NOT NULL,
  `kas_masuk` varchar(200) NOT NULL,
  `kas_keluar` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` double NOT NULL,
  PRIMARY KEY (`id_trans`),
  KEY `transaksi_ibfk_1` (`kas_keluar`),
  KEY `transaksi_ibfk_2` (`kas_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int NOT NULL,
  `is_active` int NOT NULL,
  `date_created` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE `user_access_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE `user_sub_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_id` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO `anggota` (`id_anggota`, `id_user`, `nama`, `jenis_kelamin`, `alamat`, `pekerjaan`, `No_hp`, `email`, `Foto`, `foto_ktp`, `status`) VALUES
('A001', 2, 'Herri', 'L', 'Komplek Wisma Buana Indah III Blok C4, Kelurahan Korong Gadang, Kecamatan Kuranji', 'Dosen', '081266326515', 'herri_63@gmail.com', 'Screenshot_2024-11-26_142345.png', '453406019_1535349753727032_8753759341138900035_n.jpg', 1);
INSERT INTO `anggota` (`id_anggota`, `id_user`, `nama`, `jenis_kelamin`, `alamat`, `pekerjaan`, `No_hp`, `email`, `Foto`, `foto_ktp`, `status`) VALUES
('A002', 3, 'Munzir Busniah', 'L', 'rimbo data', 'Pegawai Negeri Sipil', 'Jl.Biologi Raya B/III/01/24, Kom.Unand, Kelurahan ', 'MunzirBusniah@gmail.com', '', '', 1);
INSERT INTO `anggota` (`id_anggota`, `id_user`, `nama`, `jenis_kelamin`, `alamat`, `pekerjaan`, `No_hp`, `email`, `Foto`, `foto_ktp`, `status`) VALUES
('A003', 4, 'Rozidateno Putri Hanida', 'P', 'Jl.Bariang II nomor 75, Kelurahan Anduring, Kecamatan Kuranji, Padang', 'Dosen', '082274682738', 'Rozidatenoputrihanida@gmail.com', '', '', 1);
INSERT INTO `anggota` (`id_anggota`, `id_user`, `nama`, `jenis_kelamin`, `alamat`, `pekerjaan`, `No_hp`, `email`, `Foto`, `foto_ktp`, `status`) VALUES
('A004', 5, 'Wellyalina', 'P', 'Komplek Jondul Rawang Blok VV no.2, Kelurahan Rawang, Kecamatan Padang Selatan, Padang.', 'Karyawan Swasta', '081270540415', 'Wellyalina@gmail.com', '', '', 0),
('A005', 6, 'Rahmi Awalinaa', 'P', 'Perumahan Permata Blok G 21, Kelurahan Surau Gadang, Kecamatan Naggalo, Padang', 'Ibu Rumah Tangga', '081270762183', 'Rahmiawalina@gmail.com', '', '', 1),
('A007', 8, 'Sudarmoko', 'L', 'Perumahan Bukit Belimbing, Kelurahan Kuranji, Kecamatan Kuranji, Padang', 'dosen', '081270540415', 'sudarmoko@gmail.com', '', '', 1),
('A008', 9, 'Revi Marta', 'L', 'Jl.Prof M.Yamin, Kelurahan Koto, Kecamatan Talawi, Padang', 'Dosen', '083123232322', 'revimarta@gmail.com', '', '', 0),
('A009', 10, 'Didi Rahmadi', 'L', 'Jl.Berlian, Kelurahan Pengambiran, Kecamatan Lubuk Begalung, Padang', 'Dosen', '081266326515', 'didirahmadi@gmail.com', '', '', 1),
('A010', 11, 'Harry Efendi', 'L', 'Jalan Apel nomor 355, Kelurahan Kuranji, Kecamatan Kuranji, Padang.', 'Dosen', '082286238015', 'harryefendi@gmail.com', '', '', 1),
('A011', 12, 'Jauharry', 'L', 'Sawah Padang, Kelurahan Sawah Padang, Kecamatan Payakumbuh selatan,  Payakumbuh', 'dosen', '082288196528', 'jauharry@gmail.com', '', '', 1),
('A012', 13, 'Yunarti', 'L', 'Jawa Gadut, Kelurahan Limau Manis, Kecamatan Pauh, Padang.', 'Pegawai Negeri Sipil', '082388245447', 'yunarti@gmail.com', '', '', 1),
('A013', 14, 'Lathifa Arief', 'L', '', '', '', 'lathifaarief@gmail.com', '', '', 1),
('A015', 16, 'satria rahmat putra1', 'L', 'Jl.Rimbo Data Rt.03 Rw.01, Kelurahan Banda Buek, Kecamatan Lubuk Kilangan, Padang', 'mahasiswa', '08312323232', 'satriarahmatputra27@gmail.com', 'sat12.jpg', 'satria2_00023.jpg', 1);

INSERT INTO `berita` (`id`, `judul`, `isi`, `kategori`, `tanggal_publish`, `gambar`) VALUES
(41, 'Donasi Bagi Siapa Saja Yang Ingin Menyalurkan Bantuan', 'Sebagai lembaga usaha yang juga memiliki misi sosial, KMDM membuka donasi bagi siapa saja yang ingin menyalurkan bantuan. .\r\n\r\nDavid Gilbert, yang pernah meneliti di Padang, berdonasi untuk mahasiswa UNAND dan masyarakat Padang yang terdampak wabah covid-19 melalui PRT KMDM. Terimakasih David sudah mempercayakannya pada PRT KMDM.\r\n\r\nDavid adalah salah satu orang baik tapi dunia butuh lebih banyak orang baik untuk bisa #salingmenyehatkan dan #salingmembahagiakan\r\n', 'K001', '2020-10-07', '1.PNG');
INSERT INTO `berita` (`id`, `judul`, `isi`, `kategori`, `tanggal_publish`, `gambar`) VALUES
(42, '5 tips pengelolaan sampah di rumah', 'Untuk Bapak-Ibu / Sahabat Sehat yang lagi hobi-hobinya masak dan berberes rumah di bulan Ramadhan ini, pasti memproduksi jumlah sampah yang lebih banyak dari biasanya. Baik itu sampah sisa makanan, plastik dan kertas bekas maupun yg lainnya. .\r\n\r\nJika tidak dikelola dg baik, penumpukan sampah akan menyebabkan lingkungan kotor dan mengganggu. Karna itu, sampah harus dikelola dengan baik dan bijak. .\r\n\r\nUntuk itu, kami menyarankan Bapak-Ibu dan Sahabat Sehat untuk menerapkan 5 tips pengelolaan sampah di rumah agar sampah-sampah tersebut tidak mengganggu keluarga Anda lagi. Tetap jaga kesehatan dan #salingmenyehatkan yaa????\r\n', 'K001', '2020-10-07', '2.PNG');
INSERT INTO `berita` (`id`, `judul`, `isi`, `kategori`, `tanggal_publish`, `gambar`) VALUES
(43, 'solusi belanja online(Ibu Hasmi)', 'Luar biasa support dari ibu Hasmi. Sudah 3 minggu berlangganan dan juga aktif menyebarkan PRT KMDM ke grup wa komplek. Beliau bilang, PRT bisa jadi solusi belanja online di tengah kondisi wabah corona ini. Terimakasih ibu Hasmi ', 'K001', '2020-10-07', '3.PNG');
INSERT INTO `berita` (`id`, `judul`, `isi`, `kategori`, `tanggal_publish`, `gambar`) VALUES
(44, 'Tips Menyimpan Bahan Makanan Agar Tetap Segar Dan Tahan Lama', 'Nah, untuk Bapak-Ibu atau Sahabat Sehat yang barusan order bahan pangan PRT atau pun yang ingin tau tips menyimpan bahan makanan agar tetap segar dan tahan lama, bisa nih baca-baca tips ala Koperasi MDM. Simple dan praktis kok ????\r\n\r\nTetap jaga kesehatan dan #salingmenyehatkan ????\r\n', 'K001', '2020-10-07', '4.PNG'),
(45, 'Selama pandemi covid-19, PRT telah membantu lebih dari 70 Keluarga Di Kota Padang', 'Selama pandemi covid-19, PRT telah membantu lebih dari 70 Keluarga di seluruh kecamatan di Kota Padang untuk memenuhi kebutuhan dapur mereka setiap minggu. Minggu ini, kami membuka PO PRT ke-8.\r\n.\r\nPasar Rabu Tani diselenggarakan setiap hari Rabu untuk mendistribusikan bahan pangan yang telah di order. PRT juga menyediakan jasa delivery agar lebih memudahkan pemenuhan kebutuhan pangan Keluarga dan mengoptimalkan PSBB.\r\n.\r\nBersama 40-an mitra yang menyuplai bahan pangan mulai dari sayuran, buah-buahan, seafood, dan kebutuhan pangan dasar lainnya, kami berkomitmen untuk menyediakan produk yang ramah lingungan dan bebas dari bahan kimia berbahaya.\r\n.\r\n.\r\nPRT juga siap membantu Keluarga Anda memenuhi kebutuhan pangan atau pun yang ingin mengembangkan usaha. Silakan klik linknya di browser Anda ya.. .\r\n\r\nUntuk ikut PO di tinyurl.com/POPasarRabuTani\r\ndan Mendaftarkan produk di bit.ly/daftarjadimitraKMDM\r\n', 'K001', '2020-10-07', '5_.PNG'),
(46, 'Pasar Rabu Tani', 'Pasar Rabu Tani itu.....', 'K003', '2020-10-07', '7.PNG'),
(47, 'Sudah siap menuju New Normal?', 'Sudah siap menuju New Normal?\r\npasarrabutani.com\r\n.\r\n.\r\n#pandemi\r\n#newnormal\r\n#pasarrabutani\r\n#KMDM\r\n#covid19\r\n#pasaronline\r\n#ketahananpangan\r\n#padang\r\n', 'K001', '2020-10-07', '11.PNG'),
(48, 'Lebaran Ala KoperasiMDM', 'Meskipun belum ada kepastian tentang kapan pandemi covid-19 ini berakhir, Anda tetap bisa berbahagia dan saling membahagiakan di hari lebaran tahun ini kok. Cek paket berbagi kebahagiaannya di slide ke 2 yaa ????', 'K001', '2020-10-07', '13.PNG'),
(49, 'MEMBANGKITKAN GAIRAH UMKM UNTUK BERKOPERASI DI ERA NEW NORMAL', 'Koperasi Mandiri Dan Merdeka (KMDM) bekerja sama dengan Lembaga Penelitian dan Pengabdian Masyarakat (LPPM) Universitas Andalas mempersembahkan kepada Rakyat Indonesia dalam rangka memperingati Hari UMKM Internasional. Seminar Nasional: _MEMBANGKITKAN GAIRAH UMKM UNTUK BERKOPERASI DI ERA NEW NORMAL_.\r\n\r\nMenghadirkan:\r\n1. Prof. Dr. Yuliandri, SH, MH. (Rektor UNAND).\r\n2. Dr.-ing. Ir. Uyung Gatot S. Dinata, MT. (Ketua LPPM UNAND).\r\n3. Prof. Dr. Ir. Helmi, M.Sc. (Tim Ahli KMDM).\r\n4. Suroto (Ketua AKSES Indonesia).\r\n5. Bagus Rachman, SE. M.Ec. (Asisten Deputi Penyuluhan, Kementerian Koperasi dan UKM).\r\n6. Erita Lubeek (Owner Salero Minang & Tour di Belanda).\r\n7. Allan Arthur (Founder Rimbun Espresso & Brew Bar). *Moderator:* Dr. Henny Herwina, S.Si. M.Sc. (Direktur KMDM Broadcasting Network). Acara ini akan diselenggarakan pada *Sabtu, 27 Juni 2020, Pukul 09:00 - 12:00 WIB*, melalui zoom dan disiarkan langsung melalui youtube KMDM.\r\n\r\nUntuk pendaftaran calon peserta\r\nsila mengisi formulir di tautan berikut: https://tinyurl.com/SEMINARNASIONALUMKM\r\n\r\nUntuk informasi selanjutnya, kontak Amie (WA +6282390635585). \r\n\r\n#salingmenyehatkan #salingmembahagiakan\r\n#koperasi #umkm\r\n#koperasimdm\r\n', 'K002', '2020-10-07', '8.PNG'),
(50, 'KOPERASI UNTUK KEBANGKITAN EKONOMI KERAKYATANb', 'PANDEMII, KOPERASI DAN AGENDA DEMOKRATISASI EKONOMI \r\n\r\n\r\nMasyarakat awam pada umumnya sulit membedakan koperasi dan jenis badan usaha lainnya. Masalah ini secara paradigmatik menyebabkan orientasi pembentukkan koperasi, regulasi dan kebijakan yang tidak tepat. \r\n\r\nSeperti perusahaan pada umumnya, koperasi memang jalankan bisnis yang dapat dikembangkan di semua sektor. Dari sektor pertanian, pabrikasi, keuangan, perdagangan, bisnis basis platform dan termasuk seharusnya di sektor layanan publik. \r\n\r\nKoperasi adalah badan usaha yang berbasis orang ( people-based) dan merupakan bentuk dari bangun perusahaan dan berbeda secara mendasar dibandingkan dengan bisnis berbasis modal ( capital-based). \r\n\r\nLebih luas dari itu, Bung Hatta malahan menyebut koperasi sebagai lawan tanding dari kapitalisme secara fundamental ( Hatta, 1951).\r\n\r\nKetidakpahaman masyarakat ini menyebabkan banyak orang terkecoh atau bahkan tertipu oleh koperasi abal-abal. Seperti misalnya investasi bodong bentuk koperasi, rentenir berbaju koperasi, koperasi yang dibentuk pemerintah secara topdown  seperti misalnya KUD di masa Orde Baru dan lain sebagainya. \r\n\r\nPerbedaannya padahal sangat mendasar. Koperasi itu dibandingkan dengan korporasi atau badan usaha milik pemerintah adalah menempatkan manusia itu sebagai subyek yang supreme, atau utama di atas modal (material). \r\n\r\nDi koperasi, orang ditempatkan sebagai subyek dalam menentukan pengambilan keputusan, bukan modal seperti dalam korporasi. Ini dalam praktek diwujudkan dalam bentuk asas satu orang satu suara, dimana  setiap orang diakui persamaan haknya.  Jadi berapapun modal orang itu di koperasi tidaklah menjadi dasar pengambilan keputusan koperasi. Setiap orang diakui persamaan haknya. \r\n\r\nPraktek paling nyata kekinian adalah di koperasi Klub Sepak Bola FC Barcelona, Spanyol yang saat ini sedang heboh. Para pemilik/ anggota dan juga fansnya sebanyak kurang lebih 170 ribu orang itu sampai memiliki kekuatan untuk mengambil keputusan atas mosi tidak percaya terhadap presiden klubnya. Ini karena setiap orang dihargai persamaan haknya di perusahaan. Ini juga terjadi dalam praktek koperasi yang genuine di seluruh  belahan dunia. \r\n\r\nKoperasi memang mencari keuntungan, tapi bukan dimaknai sebagai berorientasi pada mengejar keuntungan ( profit oriented) semata bagi investornya seperti  pada perusahaan didorong-investor ( investor driven), melainkan bagi kepentingan mengejar manfaat ( benefit oriented) bagi seluruh pihak termasuk bagi suplier, pekerja, dan bahkan konsumennya. \r\n\r\nKelembagaan Koperasi\r\n\r\nJenis kelembagaan koperasi itu secara umum hingga saat ini ada empat jenis. Pertama,  konsumen-pemilik (consumer-owner) yang diwakili oleh misalnya koperasi konsumen  NTUC Fair Price yang kuasai pangsa pasar hingga 68 persen pasar ritel di Singapura dan dimiliki kurang lebih 800 ribu warga Singapura. \r\n\r\nKedua, koperasi produsen/ pekerja-pemilik yang diwakili oleh misalnya Koperasi pekerja Mondragon ( Mondragon Worker Co-op) di Spanyol yang jadi perusahaan terbesar di Basque dengan jumlah pekerja-pemilik hingga 80 ribu. \r\n\r\nKetiga adalah koperasi multipihak yang diwakili oleh misalnya model koperasi I Co-op Korea yang menghubungkan kepemilikkan di tangan produsen, pekerja dan konsumennya secara bersama, baik bisnis di sektor produksi dan konsumsinya. Saat ini setidaknya I Co-op memiliki  713 jaringan toko yang dimiliki bersama secara multipihak. \r\n\r\nSaat ini juga sedang marak dikembangkan dengan pesat koperasi basis platform, seperti misalnya Stocksy di Vancouver Canada yang menginvitasi kepemilikkan bukan hanya kepada para potografer tapi juga para konsumenya untuk memiliki bisnis platformnya. \r\n\r\nKe empat, koperasi publik, jenis koperasi ini memberikan layanan jasa dan distribusi barang publik seperti misalnya Koperasi Group Health Cooperative ( GHC) yang merupakan jaringan rumah sakit terbesar di Washington yang dimiliki oleh para pasien, investor dan lain sebagainya secara bersama. Demikian juga group koperasi perusahaan listrik National Rural Electricity Cooperative Association(NRECA) di Amerika Serikat yang beroperasi di seluruh negara bagian.  \r\n\r\nKesempatan Pandemi\r\n\r\nDimasa Pandemi saat ini, kalau kita mau konsisten dan ingin ciptakan pertumbuhan ekonomi yang berkeadilan maka koperasi bisa menjadi angin segar bagi kita. Ini semua akan terjadi kalau kita ingin menjalankan visi sesuai sistem ekonomi yang diamatkan UUD dan juga hargai gotong royong dan Pancasila. \r\n\r\nKesenjangan sosial ekonomi yang parah saat ini, kerusakan lingkungan akibat motif  eksploitasi untuk semata profit, dan bentuk penindasan kemanusiaan di dalam bisnis keseharian mustinya segera diakhiri dengan model perusahaan koperasi atau setidaknya perusahaan yang berada dalam kendali orang banyak secara demokratik seperti misalnya perusahaan yang membagi saham pada buruhnya dalam model ESOP ( employee share ownership proggrame) yang belum lama ini gencar dikampanyekan oleh salah satu calon presiden Amerika Serikat, Benie Sanders yang mendapat apresiasi luas kelompok milenial. \r\n\r\nPandemi ini adalah kesempatan yang baik untuk masyarakat bahwa hidup sehari hari kita ternyata tidak bisa lagi digantungkan nasibnya pada segelintir orang pemilik modal. \r\n\r\nKoperasi adalah praktek paling nyata demokrasi dapat bekerja dalam ruang hidup keseharian. Koperasi juga terbukti dalam setiap krisis ekonomi yang terjadi di negara-negara yang kuat justru mampu berfungsi sebagai rompi pengaman masyarakat ketika korporasi swasta kapitalis tumbang. \r\n\r\nPenelitian serius ILO tahun 2010 juga menyatakan bahwa banyak koperasi justru bertumbuh positif karena kesadaran masyarakat yang menganggap penting untuk mengontrol investasi mereka di tangan mereka sendiri ketika korporasi besar berbasis modal  mulai  tumbang dan hanya andalkan bantuan talangan pemerintah ( bailout). \r\n\r\nApalagi di masa pandemi saat ini, dimana seharusnya ekonomi tetap bisa diamankan tapi  karena korporasi besar swasta kapitalis sudah buru buru memecat karyawannya karena omset perusahaan menurun, lalu daya beli masyarakat jadi semakin lemah dan dampaknya menghantam kondisi ekonomi kita jadi terkoreksi negatif hingga 5,2 persen di kwartal pertama. Dimana diperkirakan akan menjadi krisis ekonomi di kwartal selanjutnya. Dimana kodisi ini akan diperparah karena skema yang dikembangkan dalam Program Pemulihan Ekonomi Nasional ( PEN) ternyata hanya lebih banyak berikan keuntungan bagi pengusaha besar kapitalis. \r\n\r\nMasyarakat harusnya juga mulai sadar, dengan adanya pandemi ini mereka perlu menggairahkan kerjasama bukan bersaing, untuk membangun bisnis di berbagai sektor. \r\n\r\nIni adalah justru jadi kesempatan yang baik ketika importasi terhambat harusnya sektor ekonomi domestik dan lokal terutama pangan dan energi terbarukan dikembangkan. Kita bisa sudahi importasi pangan berlebihan yang selama ini terus merebut kesadaran kita.\r\n\r\nData Biro Pusat Statistik (BPS) terbaru yang menyatakan ekonomi pertanian tetap tumbuh 16 persen pada kwartal II mustinya diikuti dengan pengembangan kelembagaan petani agar mereka tidak terpuruk terus diterkam mafia kartel pangan yang bersembunyi dibalik keistimewaan import pangan. \r\n\r\nPerkembangan Teknologi\r\n\r\nPerkembangan teknologi terutama teknologi informasi memang berkembang sangat pesat saat ini. Koperasi juga harus mengembangkan inovasi basis teknologi dan adaptif. \r\n\r\nTapi teknologi itu sifatnya tidak teknikal saja melainkan teknologis. Jadi bukan hanya berfungsi teknis memperlancar cara kerja atau bergeraknya sebuah arus barang atau transaksi. Melainkan juga mengatur pola perhubungan antara kondisi sosio kulutur masyarakat, manajemen dan juga alat seperti teknologi informasi seperti yang sedang berkembang pesat saat ini. Ini tentu harus disesuaikan dengan tingkat kebutuhan riil anggotanya. \r\n\r\nJadi teknologi bagi koperasi itu adalah penting dan banyak inovasi berbasis teknologi yang dikembangkan oleh koperasi itu mampu menjawab kebutuhan masyarakat. Seperti misalnya ditemukanya layanan ATM yang mulanya dikembangkan oleh Koperasi Kredit di Canada. Ini karena anggota koperasi membutuhkan layanan individual yang tidak mungkin ditemukan awalnya oleh bank konvensional karena basis mereka bukan orang pribadi melainkan korporasi. \r\n\r\nItu kenapa Koperasi Kredit di Canada misalnya, jadi bank of the year dan satu koperasi saja seperti Koperasi Desjardin bisa empat kali lipat asetnya dibandingkan Bank BRI kita. \r\n\r\nPerubahan Kebijakan \r\n\r\nKoperasi itu adalah self-regulated organization, atau perusahaan yang diatur oleh mereka sendiri yang diturunkan dari nilai-nilai dan prinsip utama mereka. Jadi pemerintah itu baiknya hanya menjadi regulator yang baik dan merekognisi praktek berkoperasi yang terbaik di masyarakat dan berikan kebijakan afirmatif. \r\n\r\nDari sejak jaman Kolonial Hindia Belanda sampai saat ini kita masih mewarisi mental ini. Pemerintah justru berperilaku sebagai creator and destroyer bagi pengembangan koperasi.  Konsep baru dari pola lama didorong namun tidak berksesuaian dengan kebutuhan riil dan mengoposisi kepentingan anggota yang akhirnya membuat kondisi koperasi kita malah terpuruk. Contoh paling nyata adalah KUD di masa Orde Baru.\r\n\r\nParadigma masyarakat dalam melihat koperasi ini perlu dirombak total. Jangan sandingkan koperasi sebagai usaha yang lemah, kecil atau gurem. Tapi koperasi itu bentuk badan usaha yang skalanya bisa bisa kecil atau besar. Pemerintah bisa menjadi promotor utamanya. \r\n\r\nNah, bagaimana caranya? rombak seluruh UU koperasi dan UU  sektoral yang selama telah mengkerdilkan koperasi dengan mensubordinasi, mediskriminasi dan bahkan mengeliminasi koperasi. \r\n\r\nContohnya adalah UU BUMN misalnya, UU ini harus dibongkar atau diuji materi ke Mahkamah Konstitusi karena telah melecehkan Koperasi dan UUD 1945 dengan tempatkan koperasi sebagai hanya penerima dana karitas ( CSR), harusnya koperasi itu diberikan peluang untuk jadi badan hukum. Jangan dipaksa jadi Perseroan semua. \r\n\r\nApakah contohnya di dunia ini ada? Saya berikan contoh ke Amerika Serikat yang kita tuduh sebagai negara kapitalis, disana koperasi itu kelola listrik dari bisnis infrastrukturnya sampai dengan distribusinya. Namanya National Rural Electricity Cooperative Association ( NRECA) yang beroperasi di seluruh negara bagian. \r\n\r\nAndai PLN itu dikoperasikan, maka akan ada 80 juta orang pelanggannya yang sekaligus bisa jadi pemilik yang akan turut selamatkan PLN yang kondisinya sampai hari ini kembang kempis dan dan selalu andalkan kenaikan tarif yang selalu menekan masyarakat kecil. Melalui sistem koperasi proses desntralisasi listrik juga akan terjadi. \r\n\r\nContoh lain, rumah sakit terbesar di kota Washington itu adalah koperasi Group Health Cooperative ( GHC). Di negara lain juga banyak. Dan ini juga berkembang di berbagai sektor bukan hanya keuangan. \r\n\r\nItu baru contoh subordinasi. Contoh diskriminasi dan bahkan eliminasi koperasi itu cukup banyak. Contoh lainya UU Rumah Sakit yang wajibkan koperasi berbadan hukum Perseroan. UU BI yang tidak merekognisi koperasi dan jadikan koperasi kerdil terlempar jauh dari sektor keuangan modern. UU Rumah Sakit yang wajibkan badan hukum rumah sakit privat wajib berbentuk Perseroan. Jadi apa salah dan dosa koperasi itu sebetulnya? \r\n\r\nKita berharap Kemenkop dan UKM agar ada fungsinya untuk membongkar semuanya dan berikan tindakan afirmatif untuk memecah kebekuan. Jangan tunduk dan malah menjadi penyokong  kebijakan-kebijakan yang merugikan koperasi. Seperti misalnya soal KUR yang gencet koperasi, pajak koperasi yang harusnya diberikan pembebasan ( tax free) karena sebagai hak moralnya. Secara sistem koperasi itu sudah jalankan salah satu prinsip pajak itu sendiri, yaitu ciptakan keadilan ekonomi. \r\n\r\nBagaimana peranan AKSES?\r\n\r\nAKSES akan tetap fokus pada fungsinya sebagai organisasi think thank dan kaderisasi kepemimpinan. Ini adalah misi organisasi kami ini. Jadi AKSES akan berusaha untuk terus melakukan advokasi regulasi, kebijakan maupun melakukan promosi bagi pengembangan demokrasi ekonomi dan koperasi. \r\n\r\nAKSES dan organisasi mitra startegisnya seperti Induk Koperasi Usaha Rakyat ( INKUR), Induk Koperasi Kredit ( INKOPDIT) hari ini juga sedang mempromosikan pola spin off atau pemekaran koperasi sektor riil di bawah.   Dalam waktu dekat ini juga akan menjalin kerjasama juga untuk kembangkan piloting untuk model ESOP ( employee share ownership programme) atau kepemilikkan saham buruh kerjasama dengan mitra strategis.\r\n\r\nJakarta, 6 Oktober 2020\r\n\r\nSUROTO\r\nKetua AKSES ( Asosiasi Kader Sosio-Ekonomi Strategis)\r\n', 'K002', '2020-10-07', '16.jpg');

INSERT INTO `history_trans` (`id`, `id_trans`, `pemasukan`, `pengeluaran`) VALUES
(12, 'T001', 0, 1185000);
INSERT INTO `history_trans` (`id`, `id_trans`, `pemasukan`, `pengeluaran`) VALUES
(13, 'T002', 0, 320000);
INSERT INTO `history_trans` (`id`, `id_trans`, `pemasukan`, `pengeluaran`) VALUES
(14, 'T003', 0, 2500000);
INSERT INTO `history_trans` (`id`, `id_trans`, `pemasukan`, `pengeluaran`) VALUES
(15, 'T004', 522000, 0),
(16, 'T005', 312000, 0),
(17, 'T006', 1215000, 0),
(18, 'T007', 1500000, 0),
(19, 'T008', 0, 2000000),
(20, 'T009', 570000, 0),
(21, 'T010', 970000, 0),
(22, 'T011', 900000, 0),
(23, 'T012', 0, 1500000),
(24, 'T013', 880000, 0),
(25, 'T014', 1320000, 0),
(26, 'T015', 500000, 0),
(27, 'T016', 0, 834000),
(28, 'T017', 0, 200000),
(29, 'T018', 3454545, 0);

INSERT INTO `iuran` (`id`, `jumlah`, `tanggal_iuran`, `Keterangan`, `nama_iuran`) VALUES
(41, 500000, '2020-08-12', '-', NULL);
INSERT INTO `iuran` (`id`, `jumlah`, `tanggal_iuran`, `Keterangan`, `nama_iuran`) VALUES
(42, 300000, '2020-08-25', '-', NULL);
INSERT INTO `iuran` (`id`, `jumlah`, `tanggal_iuran`, `Keterangan`, `nama_iuran`) VALUES
(43, 200000, '2020-08-31', '-', NULL);
INSERT INTO `iuran` (`id`, `jumlah`, `tanggal_iuran`, `Keterangan`, `nama_iuran`) VALUES
(44, 600000, '2020-09-16', '-', NULL),
(45, 400000, '2020-09-23', '-', NULL),
(46, 1000000, '2020-09-02', '-', NULL),
(47, 1000000, '2020-08-12', '-', NULL),
(48, 1000000, '2020-10-12', '-', NULL),
(49, 1000000, '2020-10-05', '-', NULL),
(50, 1000000, '2020-09-15', '-', NULL),
(51, 1000000, '2020-09-08', '-', NULL),
(52, 1000000, '2020-09-01', '-', NULL),
(53, 350000, '2020-10-18', '-', NULL),
(54, 300000, '2020-10-18', '-', NULL),
(55, 100000, '2024-12-02', 'utang', NULL),
(56, 100000, '2024-12-02', 'utang', NULL),
(57, 100000, '2025-01-02', '', NULL),
(58, 34234, '2025-01-02', '', NULL),
(59, 2334234324, '2025-01-02', '', NULL),
(60, 6787878, '2025-01-04', '', NULL),
(61, 100000, '2025-01-31', '', NULL),
(62, 100000, '2025-01-02', '', NULL),
(63, 100000, '2025-01-31', '', NULL),
(64, 100000, '2025-01-30', '', NULL);



INSERT INTO `kas_keluar` (`id_kas`, `nama_kas`) VALUES
('KSL001', 'Pembelian Peralatan');
INSERT INTO `kas_keluar` (`id_kas`, `nama_kas`) VALUES
('KSL002', 'Gaji Karyawan');
INSERT INTO `kas_keluar` (`id_kas`, `nama_kas`) VALUES
('KSL003', 'Listrik Dan Air');
INSERT INTO `kas_keluar` (`id_kas`, `nama_kas`) VALUES
('KSL004', 'Pemsanan Produk PRT'),
('KSL005', 'beli meja');

INSERT INTO `kas_masuk` (`id_kas`, `nama_kas`) VALUES
('KSM001', 'Hasil Penjualan');
INSERT INTO `kas_masuk` (`id_kas`, `nama_kas`) VALUES
('KSM002', 'Pembayaran Piutang');
INSERT INTO `kas_masuk` (`id_kas`, `nama_kas`) VALUES
('KSM003', 'Lainnya');
INSERT INTO `kas_masuk` (`id_kas`, `nama_kas`) VALUES
('KSM004', '5345435');

INSERT INTO `kategori_berita` (`id_kategori`, `kategori`) VALUES
('K001', 'Berita Kegiatan');
INSERT INTO `kategori_berita` (`id_kategori`, `kategori`) VALUES
('K002', 'Kopdarling');
INSERT INTO `kategori_berita` (`id_kategori`, `kategori`) VALUES
('K003', 'Kopsan');

INSERT INTO `simpanan` (`id`, `id_anggota`, `angsuran`, `jumlah`, `tanggal_simpan`, `Keterangan`) VALUES
(41, 'A001', 1, 500000, '2020-08-12', '-');
INSERT INTO `simpanan` (`id`, `id_anggota`, `angsuran`, `jumlah`, `tanggal_simpan`, `Keterangan`) VALUES
(42, 'A001', 2, 300000, '2020-08-25', '-');
INSERT INTO `simpanan` (`id`, `id_anggota`, `angsuran`, `jumlah`, `tanggal_simpan`, `Keterangan`) VALUES
(43, 'A001', 3, 200000, '2020-08-31', '-');
INSERT INTO `simpanan` (`id`, `id_anggota`, `angsuran`, `jumlah`, `tanggal_simpan`, `Keterangan`) VALUES
(44, 'A002', 1, 600000, '2020-09-16', '-'),
(45, 'A002', 2, 400000, '2020-09-23', '-'),
(46, 'A003', 1, 1000000, '2020-09-02', '-'),
(47, 'A007', 1, 1000000, '2020-08-12', '-'),
(48, 'A008', 1, 1000000, '2020-10-12', '-'),
(49, 'A009', 1, 1000000, '2020-10-05', '-'),
(50, 'A010', 1, 1000000, '2020-09-15', '-'),
(51, 'A011', 1, 1000000, '2020-09-08', '-'),
(52, 'A012', 1, 1000000, '2020-09-01', '-'),
(53, 'A015', 1, 350000, '2020-10-18', '-'),
(54, 'A015', 2, 300000, '2020-10-18', '-'),
(55, 'A001', 4, 100000, '2024-12-02', 'utang'),
(56, 'A001', 5, 100000, '2024-12-02', 'utang'),
(57, 'A001', 6, 100000, '2025-01-02', ''),
(58, 'A001', 7, 34234, '2025-01-02', ''),
(59, 'A001', 8, 2334234324, '2025-01-02', ''),
(60, 'A001', 9, 6787878, '2025-01-04', ''),
(61, 'A001', 10, 100000, '2025-01-31', ''),
(62, 'A001', 11, 100000, '2025-01-02', ''),
(63, 'A001', 12, 100000, '2025-01-31', ''),
(64, 'A001', 13, 100000, '2025-01-30', '');

INSERT INTO `transaksi` (`id_trans`, `tanggal`, `jenis_kas`, `kas_masuk`, `kas_keluar`, `keterangan`, `jumlah`) VALUES
('T001', '2020-09-02', 'Kas Keluar', '-', 'Pembelian Peralatan', 'Beli Kulkas', 1185000);
INSERT INTO `transaksi` (`id_trans`, `tanggal`, `jenis_kas`, `kas_masuk`, `kas_keluar`, `keterangan`, `jumlah`) VALUES
('T002', '2020-09-02', 'Kas Keluar', '-', 'Pembelian Peralatan', 'Beli Rak Produk', 320000);
INSERT INTO `transaksi` (`id_trans`, `tanggal`, `jenis_kas`, `kas_masuk`, `kas_keluar`, `keterangan`, `jumlah`) VALUES
('T003', '2020-09-02', 'Kas Keluar', '-', 'Pemsanan Produk PRT', 'Pemesanan Produk Sembako ', 2500000);
INSERT INTO `transaksi` (`id_trans`, `tanggal`, `jenis_kas`, `kas_masuk`, `kas_keluar`, `keterangan`, `jumlah`) VALUES
('T004', '2020-09-04', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan produk sembako', 522000),
('T005', '2020-09-04', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan produk sembako', 312000),
('T006', '2020-09-04', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan produk sembako', 1215000),
('T007', '2020-09-04', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan produk sembako', 1500000),
('T008', '2020-09-04', 'Kas Keluar', '-', 'Pemsanan Produk PRT', 'Pemesanan Produk Sembako ', 2000000),
('T009', '2020-09-09', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan produk sembako', 570000),
('T010', '2020-09-09', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan Produk Sembako ', 970000),
('T011', '2020-09-09', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan produk sembako', 900000),
('T012', '2020-09-09', 'Kas Keluar', '-', 'Pemsanan Produk PRT', 'Pemesanan Produk Sembako ', 1500000),
('T013', '2020-09-11', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan Produk Sembako ', 880000),
('T014', '2020-09-11', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan produk sembako', 1320000),
('T015', '2020-09-11', 'Kas Masuk', 'Hasil Penjualan', '-', 'Penjualan produk sembako', 500000),
('T016', '2020-09-19', 'Kas Keluar', '-', 'Listrik Dan Air', 'Pembayaran Listrik Dan Air Bulan September', 834000),
('T017', '2020-10-30', 'Kas Keluar', '-', 'Listrik Dan Air', '-', 200000),
('T018', '2024-10-23', 'Kas Masuk', 'Hasil Penjualan', '-', '34545', 3454545);

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin KMDM', 'admin@gmail.com', 'default.png', '$2y$10$7CcsUBRRElCb7Ap50xEwG.jjxp9OgRM9dpu2kiaeuArSCQuAiDlIi', 1, 1, 1598943893);
INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'Herri', 'herri_63@gmail.com', 'default.png', '$2y$10$DwiDp7feubR9nRfYqbRDtee2jbPLm3.7UQa0heCrAmbiW7WtD5rBq', 2, 1, 1602224673);
INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'Munzir Busniah', 'MunzirBusniah@gmail.com', 'default.png', '$2y$10$ZFJiaDp8tiBCdrqM.IZtG.U6ZGB735k2s7qi7SiHtzeYYK9zniKJK', 2, 1, 1602224714);
INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(4, 'Rozidateno Putri Hanida', 'Rozidatenoputrihanida@gmail.com', 'default.png', '$2y$10$kybbiEb/dgelBXpSWU8OKOyNeBugsiSVW0qrNrE1nniJ9QNNjlxBi', 2, 1, 1602224769),
(5, 'Wellyalina', 'Wellyalina@gmail.com', 'default.png', '$2y$10$cJZwUGwH8gz9KWxn.Xi4ZOscsELoZfyOFnMFgnDRC2yWTbHA1FUmu', 2, 0, 1602224812),
(6, 'Rahmi Awalinaa', 'Rahmiawalina@gmail.com', 'default.png', '$2y$10$XavtCsyt1KjjYgACOa6V7u/ZNsFekhMr9TOKLqHRD.ZeL6sTYFhmG', 2, 1, 1602227227),
(8, 'Sudarmoko', 'sudarmoko@gmail.com', 'default.png', '$2y$10$tLtOERTCYjWL4fdkD4U/TuJNwCjOzCb7Zl751l0HDz.8uRCVNCWUW', 2, 1, 1602418675),
(9, 'Revi Marta', 'revimarta@gmail.com', 'default.png', '$2y$10$iolqlibXMMw3u15.lSJOaezWZrOEonygB1Vk3szqKiF8GathvZgAS', 2, 0, 1602418711),
(10, 'Didi Rahmadi', 'didirahmadi@gmail.com', 'default.png', '$2y$10$1g/0A2s6BcoJedW/lPBHkO7u4IvUI2uA9qtlGgMFObah9UYr4docS', 2, 1, 1602418741),
(11, 'Harry Efendi', 'harryefendi@gmail.com', 'default.png', '$2y$10$jWZkvCAtKhIiX3JXOSYC6uPNdGfFN/O3uM0te1ZNjQP.QbRzZ1kPy', 2, 1, 1602418768),
(12, 'Jauharry', 'jauharry@gmail.com', 'default.png', '$2y$10$Qd680jSVWw6ORiUGx6zhUeHDaxKXphjUDqmLnqnXHDjLRyJ.0fxDa', 2, 1, 1602420610),
(13, 'Yunarti', 'yunarti@gmail.com', 'default.png', '$2y$10$REHez/tLSy7ib/mJ4fTayOCEx9e8GmOFP0WIIJzjHwrGFChwrkQD6', 2, 1, 1602420637),
(14, 'Lathifa Arief', 'lathifaarief@gmail.com', 'default.png', '$2y$10$HgrpNmoJHU2JZ3Pc9dyRGeQWkWAVnEbDYZOmpgyXUxjiz3jIffAVa', 2, 1, 1602420674),
(16, 'satria rahmat putra1', 'satriarahmatputra27@gmail.com', 'default.png', '$2y$10$nfPYb0TYnKdPnTW0/8HuXep17X51csJIpc9qUnW71NCbCYqOtDb.K', 2, 1, 1602983971);

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(3, 2, 2);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(4, 1, 3);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(5, 1, 5),
(6, 1, 6),
(7, 2, 7),
(8, 1, 8),
(9, 1, 9),
(11, 2, 11),
(12, 1, 1),
(13, 2, 1);

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin');
INSERT INTO `user_menu` (`id`, `menu`) VALUES
(2, 'User');
INSERT INTO `user_menu` (`id`, `menu`) VALUES
(3, 'Menu');
INSERT INTO `user_menu` (`id`, `menu`) VALUES
(5, 'Berita'),
(6, 'Anggota'),
(7, 'Simpananuser'),
(8, 'Master_trans'),
(9, 'Laporan'),
(11, 'coba_anggota'),
(12, 'Iuran Pembayaran');

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator');
INSERT INTO `user_role` (`id`, `role`) VALUES
(2, 'anggota');


INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-users', 1);
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1);
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(5, 3, 'SubMenu Management', 'menu/submenu', 'fas fa-fw fa-folder', 1);
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(7, 5, 'Kelola Berita', 'berita', 'far fa-newspaper', 1),
(8, 6, 'Kelola Anggota', 'anggota', 'fas fa-user-friends', 1),
(9, 5, 'Kategori', 'berita/index_kategori', 'far fa-newspaper', 1),
(10, 7, 'Simpanan', 'Simpananuser', 'fas fa-fw fa-folder', 1),
(11, 6, 'Simpanan Anggota', 'simpanan', 'fas fa-user-friends', 1),
(12, 8, 'Kas Masuk', 'master_trans/index_kas_masuk', 'fas fa-money-check-alt', 1),
(13, 8, 'Kas Keluar', 'master_trans/index_kas_keluar', 'fas fa-money-check-alt', 1),
(14, 8, 'Transaksi', 'master_trans/index_trans', 'fas fa-money-check-alt', 1),
(15, 9, 'Rekap Bulanan', 'Laporan', 'fas fa-print', 1),
(16, 9, 'Rekap Tahunan', 'laporan/rekap', 'fas fa-print', 1),
(17, 3, 'User Access', 'menu/index_user_acc', 'fas fa-fw fa-folder', 1),
(18, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(20, 6, 'Reset Akun Anggota', 'anggota/akun_index', 'fas fa-fw fa-folder', 1),
(21, 11, 'sub_coba', 'berita/kategori', 'fas fa-fw fa-folder', 1),
(22, 6, 'Iuran Pembayaran', 'iuran', 'fas fa-user-friends', 1);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;