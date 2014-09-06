/*
SQLyog Ultimate v8.55 
MySQL - 5.6.17 : Database - db_dtti
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_akun` */

DROP TABLE IF EXISTS `tb_akun`;

CREATE TABLE `tb_akun` (
  `no_akun_pgw` int(20) NOT NULL COMMENT 'nomor akun absen',
  `id_pgw` int(20) NOT NULL,
  PRIMARY KEY (`no_akun_pgw`),
  KEY `FK_tb_akun` (`id_pgw`),
  CONSTRAINT `FK_tb_akun` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_akun` */

/*Table structure for table `tb_anak` */

DROP TABLE IF EXISTS `tb_anak`;

CREATE TABLE `tb_anak` (
  `id_anak` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `no_urut_anak` enum('1','2','3','4','5','6','7','8','9','10','11') NOT NULL,
  `nma_anak` varchar(100) NOT NULL,
  `jk_anak` enum('L','P') NOT NULL,
  `tmp_lhr_anak` varchar(100) DEFAULT NULL,
  `tgl_lhr_anak` date DEFAULT NULL,
  PRIMARY KEY (`id_anak`),
  KEY `FK_tb_anak` (`id_pgw`),
  CONSTRAINT `FK_tb_anak` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_anak` */

/*Table structure for table `tb_bank` */

DROP TABLE IF EXISTS `tb_bank`;

CREATE TABLE `tb_bank` (
  `id_bank` int(20) NOT NULL AUTO_INCREMENT,
  `sktn_bank` varchar(20) NOT NULL,
  `nma_bank` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_bank` */

insert  into `tb_bank`(`id_bank`,`sktn_bank`,`nma_bank`) values (1,'BNI','Bank Negara Indonesia'),(2,'BRI ','Bank Rakyat Indonesia'),(3,'MDR','Bank Mandiri'),(4,'BCA','Bank Central Asia'),(5,'BMT','Bank Darut Tauhid'),(6,'BJB','Bank Jawa Barat'),(7,'MLT','Bank Muamalat');

/*Table structure for table `tb_cuti` */

DROP TABLE IF EXISTS `tb_cuti`;

CREATE TABLE `tb_cuti` (
  `id_cuti` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `almt_cuti` text NOT NULL,
  `thn_cuti` year(4) NOT NULL COMMENT 'tahun periode cuti',
  `tgl_pjn_cuti` datetime NOT NULL COMMENT 'tanggal pengajuan cuti ',
  `sisa_sbm_cuti` int(20) NOT NULL DEFAULT '30' COMMENT 'sisa cuti sebelumnya',
  `tgl_mli_cuti` date NOT NULL,
  `tgl_akr_cuti` date NOT NULL,
  `tgl_krj_cuti` date NOT NULL COMMENT 'tanggal mulai kerja',
  `jml_cuti` int(20) NOT NULL DEFAULT '0' COMMENT 'maksimal 3',
  `total_cuti` int(20) DEFAULT '0' COMMENT 'total keseluruhan cuti yang telah diambil',
  `sisa_cuti` int(20) NOT NULL DEFAULT '0',
  `alasan_cuti` varchar(50) NOT NULL,
  `catatan_cuti` text,
  `stat_cuti` enum('Y','T','N') NOT NULL DEFAULT 'N' COMMENT 'status',
  `apprv_cuti` varchar(100) NOT NULL COMMENT 'yang approve cuti',
  `apprv_jbtn_cuti` varchar(50) NOT NULL COMMENT 'jabatan approver cuti',
  PRIMARY KEY (`id_cuti`),
  KEY `FK_tb_cuti` (`id_pgw`),
  CONSTRAINT `FK_tb_cuti` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_cuti` */

/*Table structure for table `tb_detil_formal` */

DROP TABLE IF EXISTS `tb_detil_formal`;

CREATE TABLE `tb_detil_formal` (
  `id_dtl_formal` int(20) NOT NULL AUTO_INCREMENT,
  `id_pnd_formal` int(20) NOT NULL,
  `id_pgw` int(20) NOT NULL,
  `nma_dtl_formal` varchar(100) NOT NULL,
  `thn_dtl_formal` int(5) NOT NULL,
  `stat_dtl_formal` enum('lulus','belum lulus') NOT NULL COMMENT 'status pendidikan',
  `pc_ijzh` varchar(100) DEFAULT NULL COMMENT 'photocopy ijazah',
  PRIMARY KEY (`id_dtl_formal`),
  KEY `FK_tb_detil_formal2` (`id_pgw`),
  KEY `FK_tb_detil_formal` (`id_pnd_formal`),
  CONSTRAINT `FK_tb_detil_formal` FOREIGN KEY (`id_pnd_formal`) REFERENCES `tb_formal` (`id_pnd_formal`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_detil_formal2` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_formal` */

/*Table structure for table `tb_detil_informal` */

DROP TABLE IF EXISTS `tb_detil_informal`;

CREATE TABLE `tb_detil_informal` (
  `id_dtl_informal` int(20) NOT NULL AUTO_INCREMENT,
  `id_pnd_informal` int(20) NOT NULL,
  `id_pgw` int(20) NOT NULL,
  `nma_dtl_informal` varchar(100) NOT NULL COMMENT 'nama pendidikan informal',
  `pc_srtkt` varchar(100) NOT NULL COMMENT 'photocopy sertifikat',
  PRIMARY KEY (`id_dtl_informal`),
  KEY `FK_tb_detil_informal` (`id_pnd_informal`),
  KEY `FK_tb_detil_informal2` (`id_pgw`),
  CONSTRAINT `FK_tb_detil_informal` FOREIGN KEY (`id_pnd_informal`) REFERENCES `tb_informal` (`id_pnd_informal`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_detil_informal2` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_informal` */

/*Table structure for table `tb_detil_pelatihan` */

DROP TABLE IF EXISTS `tb_detil_pelatihan`;

CREATE TABLE `tb_detil_pelatihan` (
  `id_dtl_lth` int(20) NOT NULL AUTO_INCREMENT,
  `id_lth` int(20) NOT NULL,
  `id_pgw` int(20) NOT NULL,
  PRIMARY KEY (`id_dtl_lth`),
  KEY `FK_tb_detil_pelatihan` (`id_lth`),
  KEY `FK_tb_detil_pelatihan2` (`id_pgw`),
  CONSTRAINT `FK_tb_detil_pelatihan` FOREIGN KEY (`id_lth`) REFERENCES `tb_pelatihan` (`id_lth`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_detil_pelatihan2` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_pelatihan` */

/*Table structure for table `tb_formal` */

DROP TABLE IF EXISTS `tb_formal`;

CREATE TABLE `tb_formal` (
  `id_pnd_formal` int(20) NOT NULL AUTO_INCREMENT,
  `skt_pnd_formal` varchar(5) NOT NULL COMMENT 'singkatan',
  `nma_pnd_formal` varchar(30) NOT NULL COMMENT 'nama lengkap',
  PRIMARY KEY (`id_pnd_formal`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tb_formal` */

insert  into `tb_formal`(`id_pnd_formal`,`skt_pnd_formal`,`nma_pnd_formal`) values (1,'TK','Taman Kanak'),(2,'SD','Sekolah Dasar'),(3,'SMP ','Sekolah Menengah Pertama'),(4,'SMA','Sekolah Menengah Atas'),(5,'SMK','Sekolah Menengah Kejuruan'),(6,'D1','Diploma 1'),(7,'D2','Diploma 2'),(8,'D3','Diploma 3'),(9,'S1','Sarjana'),(10,'S2','Master '),(11,'S3','Doktor ');

/*Table structure for table `tb_informal` */

DROP TABLE IF EXISTS `tb_informal`;

CREATE TABLE `tb_informal` (
  `id_pnd_informal` int(20) NOT NULL AUTO_INCREMENT,
  `nma_pnd_informal` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pnd_informal`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_informal` */

insert  into `tb_informal`(`id_pnd_informal`,`nma_pnd_informal`) values (1,'Kursus'),(2,'Pelatihan'),(3,'Seminar'),(4,'Sertifikasi');

/*Table structure for table `tb_izin_absen` */

DROP TABLE IF EXISTS `tb_izin_absen`;

CREATE TABLE `tb_izin_absen` (
  `id_abs` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `tgl_pjn_abs` date NOT NULL COMMENT 'tangal pengajuan ijin presensi',
  `als_abs` text NOT NULL COMMENT 'alasan ',
  `puk_awl_abs` time DEFAULT NULL COMMENT 'jam mulai ijin',
  `puk_akr_abs` time DEFAULT NULL COMMENT 'jam akhir ijin',
  `wkt_abs` date NOT NULL COMMENT 'waktu ijin ',
  `ctn_abs` text NOT NULL COMMENT 'catatan',
  `stat_abs` enum('N','Y','T') NOT NULL DEFAULT 'N' COMMENT 'status konfirmasi absensi',
  `apprv_abs` varchar(100) DEFAULT NULL COMMENT 'yang approve absensi',
  `jbt_abs` varchar(50) DEFAULT NULL COMMENT 'jabatan approve absensi',
  PRIMARY KEY (`id_abs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_izin_absen` */

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `id_jbtn` int(11) NOT NULL AUTO_INCREMENT,
  `div_jbtn` enum('komisaris','direksi','operasional','marketing','program','sekretariat') NOT NULL,
  `nma_jbtn` enum('komisaris utama','komisaris','kepala','direktur utama','direktur operasional','direktur marketing','manajer','staff administrasi','staff keuangan','staff event organizer','staff logistik','staff desain program','staff program alumni','staff sales executive','staff telemarketing','staff operasional marketing','staff customer relation','sv management event','sv logistik pengadaan','sv desain program','sv program alumni','sv ops marketing','sv marketing communication') NOT NULL,
  PRIMARY KEY (`id_jbtn`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id_jbtn`,`div_jbtn`,`nma_jbtn`) values (1,'komisaris','komisaris'),(2,'komisaris','komisaris utama'),(3,'sekretariat','kepala'),(4,'direksi','direktur marketing'),(5,'direksi','direktur operasional'),(6,'direksi','direktur utama'),(7,'marketing','manajer'),(8,'operasional','manajer'),(9,'program','manajer'),(10,'operasional','sv management event'),(11,'operasional','sv logistik pengadaan'),(12,'program','sv desain program'),(13,'program','sv program alumni'),(14,'marketing','sv ops marketing'),(15,'marketing','sv marketing communication'),(16,'sekretariat','staff keuangan'),(17,'sekretariat','staff administrasi'),(18,'marketing','staff telemarketing'),(19,'marketing','staff operasional marketing'),(20,'marketing','staff sales executive'),(21,'program','staff program alumni'),(22,'program','staff desain program'),(23,'operasional','staff logistik'),(24,'operasional','staff event organizer');

/*Table structure for table `tb_kendaraan_motor` */

DROP TABLE IF EXISTS `tb_kendaraan_motor`;

CREATE TABLE `tb_kendaraan_motor` (
  `id_kdr_mtr` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `merk_kdr_mtr` varchar(50) NOT NULL,
  `nopol_kdr_mtr` varchar(10) NOT NULL COMMENT 'nomor plat',
  `stat_kdr_mtr` enum('sudah','belum') NOT NULL COMMENT 'status stiker',
  PRIMARY KEY (`id_kdr_mtr`),
  KEY `FK_tb_kendaraan_motor` (`id_pgw`),
  CONSTRAINT `FK_tb_kendaraan_motor` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kendaraan_motor` */

/*Table structure for table `tb_muhasabah` */

DROP TABLE IF EXISTS `tb_muhasabah`;

CREATE TABLE `tb_muhasabah` (
  `id_mhb` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `tgl_mhb` date NOT NULL COMMENT 'tangggal muhasabah',
  `alq_mhb` enum('Y','T') NOT NULL DEFAULT 'T' COMMENT 'baca quran',
  `thj_mhb` enum('Y','T') NOT NULL DEFAULT 'T' COMMENT 'tahajud',
  `sdq_mhb` enum('Y','T') NOT NULL DEFAULT 'T' COMMENT 'shadaqah',
  `psa_mhb` enum('Y','T') NOT NULL DEFAULT 'T' COMMENT 'puasa sunat',
  PRIMARY KEY (`id_mhb`),
  KEY `FK_tb_muhasabah2` (`id_pgw`),
  CONSTRAINT `FK_tb_muhasabah2` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_muhasabah` */

/*Table structure for table `tb_pegawai` */

DROP TABLE IF EXISTS `tb_pegawai`;

CREATE TABLE `tb_pegawai` (
  `id_pgw` int(20) NOT NULL AUTO_INCREMENT,
  `id_jbtn` int(100) DEFAULT NULL,
  `nik_pgw` varchar(30) DEFAULT NULL,
  `no_ktp_pgw` varchar(40) DEFAULT NULL,
  `npwp_pgw` varchar(30) DEFAULT NULL,
  `nma_lkp_pgw` varchar(100) NOT NULL,
  `email_pgw` varchar(50) NOT NULL,
  `almt_pgw` text NOT NULL,
  `jk_pgw` enum('L','P') NOT NULL,
  `stat_pgw` enum('menikah','belum menikah') NOT NULL,
  `lev_usr_pgw` enum('admin','user','special user') NOT NULL,
  `uname_pgw` varchar(20) NOT NULL,
  `pass_pgw` varchar(20) NOT NULL,
  `photo_pgw` varchar(100) DEFAULT NULL,
  `tmp_lhr_pgw` varchar(50) NOT NULL,
  `tgl_lhr_pgw` date NOT NULL,
  `hp_pgw` varchar(15) NOT NULL,
  `telp_pgw` varchar(15) DEFAULT NULL,
  `gol_drh_pgw` enum('A','B','O','AB') DEFAULT NULL,
  `nma_psg_pgw` varchar(100) DEFAULT NULL,
  `pc_ktp_pgw` varchar(100) DEFAULT NULL,
  `stat_akt_pgw` enum('Y','T') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_pgw`),
  UNIQUE KEY `nik_pgw` (`nik_pgw`),
  UNIQUE KEY `no_ktp_pgw` (`no_ktp_pgw`),
  UNIQUE KEY `npwp_pgw` (`npwp_pgw`),
  KEY `FK_tb_pegawai` (`id_jbtn`),
  CONSTRAINT `FK_tb_pegawai` FOREIGN KEY (`id_jbtn`) REFERENCES `tb_jabatan` (`id_jbtn`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pegawai` */

/*Table structure for table `tb_pelatihan` */

DROP TABLE IF EXISTS `tb_pelatihan`;

CREATE TABLE `tb_pelatihan` (
  `id_lth` int(20) NOT NULL AUTO_INCREMENT,
  `tgl_pjn_lth` date NOT NULL COMMENT 'tanggal pengajuan',
  `nma_pju_lth` varchar(100) NOT NULL COMMENT 'nama pengaju pelatihan',
  `nma_lth` varchar(100) NOT NULL COMMENT 'nama pelatihan',
  `waktu_lth` datetime NOT NULL,
  `tmp_lth` varchar(100) NOT NULL COMMENT 'tempat pelatihan',
  `stat_lth` enum('N','Y','T') NOT NULL DEFAULT 'N',
  `apprv_lth` varchar(100) DEFAULT NULL,
  `jbt_apprv_lth` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_lth`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelatihan` */

/*Table structure for table `tb_pengalaman_kerja` */

DROP TABLE IF EXISTS `tb_pengalaman_kerja`;

CREATE TABLE `tb_pengalaman_kerja` (
  `id_pgl_krj` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `jbtn_pgl_krj` varchar(100) NOT NULL,
  `satuan_pgl_krj` enum('hari','minggu','bulan','tahun') NOT NULL,
  `durasi_pgl_krj` float NOT NULL,
  PRIMARY KEY (`id_pgl_krj`),
  KEY `FK_tb_pengalaman_kerja` (`id_pgw`),
  CONSTRAINT `FK_tb_pengalaman_kerja` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengalaman_kerja` */

/*Table structure for table `tb_presensi` */

DROP TABLE IF EXISTS `tb_presensi`;

CREATE TABLE `tb_presensi` (
  `id_prs` int(20) NOT NULL AUTO_INCREMENT COMMENT 'no absensi',
  `no_akun_pgw` int(20) NOT NULL COMMENT 'no akun absensii',
  `tgl_prs` date NOT NULL COMMENT 'tanggal presensi',
  `jm_msk_prs` time NOT NULL COMMENT 'jam masuk',
  `jm_klr_prs` time DEFAULT NULL COMMENT 'jam keluar',
  `tlt_prs` time DEFAULT NULL COMMENT 'telat ',
  `stat_prs` enum('hadir','sakit','ijin','alpha','cuti','libur') NOT NULL COMMENT 'status presensi',
  `wkt_krj` time DEFAULT NULL COMMENT 'waktu kerja',
  `bukti_prs` varchar(100) DEFAULT NULL COMMENT 'bukti presensi',
  PRIMARY KEY (`id_prs`),
  KEY `FK_tb_presensi` (`no_akun_pgw`),
  CONSTRAINT `FK_tb_presensi` FOREIGN KEY (`no_akun_pgw`) REFERENCES `tb_akun` (`no_akun_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_presensi` */

/*Table structure for table `tb_rek_bank` */

DROP TABLE IF EXISTS `tb_rek_bank`;

CREATE TABLE `tb_rek_bank` (
  `id_dtl_bank` int(20) NOT NULL AUTO_INCREMENT,
  `id_bank` int(20) NOT NULL,
  `id_pgw` int(20) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  PRIMARY KEY (`id_dtl_bank`),
  KEY `FK_tb_rek_bank` (`id_bank`),
  KEY `FK_tb_rek_bank2` (`id_pgw`),
  CONSTRAINT `FK_tb_rek_bank` FOREIGN KEY (`id_bank`) REFERENCES `tb_bank` (`id_bank`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tb_rek_bank2` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_rek_bank` */

/*Table structure for table `tb_sim` */

DROP TABLE IF EXISTS `tb_sim`;

CREATE TABLE `tb_sim` (
  `id_sim` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `jns_sim` enum('A','B','B1','B2','C') NOT NULL,
  `no_sim` varchar(50) NOT NULL,
  `pc_sim` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sim`),
  KEY `FK_tb_sim` (`id_pgw`),
  CONSTRAINT `tb_sim_ibfk_1` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_sim` */

/*Table structure for table `tb_usaha_aktifitas` */

DROP TABLE IF EXISTS `tb_usaha_aktifitas`;

CREATE TABLE `tb_usaha_aktifitas` (
  `id_ush_akt` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `jns_ush_akt` enum('peternakan','produksi','properti','agensi','politik','ormas') NOT NULL,
  `nma_ush_akt` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ush_akt`),
  KEY `FK_tb_usaha_aktifitas` (`id_pgw`),
  CONSTRAINT `FK_tb_usaha_aktifitas` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_usaha_aktifitas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;