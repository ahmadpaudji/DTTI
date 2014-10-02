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

insert  into `tb_akun`(`no_akun_pgw`,`id_pgw`) values (1,1),(7,7),(9,9),(28,28),(85,35);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_anak` */

insert  into `tb_anak`(`id_anak`,`id_pgw`,`no_urut_anak`,`nma_anak`,`jk_anak`,`tmp_lhr_anak`,`tgl_lhr_anak`) values (1,1,'3','asd','P','ssff','2014-09-16'),(2,1,'1','awda','P','dadadw','2014-09-09'),(3,7,'2','qes','P','zzx','2014-09-19'),(4,9,'7','Azka','L','ss','2014-09-16'),(5,1,'7','jjjjj','P','asda','2014-09-17');

/*Table structure for table `tb_bank` */

DROP TABLE IF EXISTS `tb_bank`;

CREATE TABLE `tb_bank` (
  `id_bank` int(20) NOT NULL AUTO_INCREMENT,
  `sktn_bank` varchar(20) NOT NULL,
  `nma_bank` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `tb_bank` */

insert  into `tb_bank`(`id_bank`,`sktn_bank`,`nma_bank`) values (1,'BNI','Bank Negadra Inia'),(2,'BRI ','Bank Rakyat Indonesia'),(3,'MDR','Bank Mandiri'),(4,'BCA','Bank Central Asia'),(5,'BMT','Bank Darut Tauhid'),(6,'BJB','Bank Jawa Barat'),(7,'MLT','Bank Muamalat'),(18,'MDR','Bank Mandiri'),(19,'awd','asd');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_formal` */

insert  into `tb_detil_formal`(`id_dtl_formal`,`id_pnd_formal`,`id_pgw`,`nma_dtl_formal`,`thn_dtl_formal`,`stat_dtl_formal`,`pc_ijzh`) values (1,3,1,'awd',2011,'lulus','images/ijazah/13092014011908.jpg'),(2,8,9,'d33',1112,'lulus','images/ijazah/21092014095840.jpg'),(3,6,9,'sqqa',1111,'lulus',NULL),(4,4,9,'saz',2222,'belum lulus',NULL),(5,1,1,'Gaq',2015,'lulus','images/ijazah/13092014011509.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_informal` */

insert  into `tb_detil_informal`(`id_dtl_informal`,`id_pnd_informal`,`id_pgw`,`nma_dtl_informal`,`pc_srtkt`) values (1,2,7,'asd','images/ijazah/21092014100246.jpg');

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

/*Table structure for table `tb_detil_sppd` */

DROP TABLE IF EXISTS `tb_detil_sppd`;

CREATE TABLE `tb_detil_sppd` (
  `id_dtl_sppd` int(11) NOT NULL AUTO_INCREMENT,
  `id_sppd` int(11) NOT NULL,
  `id_pgw` int(11) NOT NULL,
  `status_dtl_sppd` enum('pengaju','sdm') NOT NULL DEFAULT 'sdm' COMMENT 'status pengaju atau sdm',
  PRIMARY KEY (`id_dtl_sppd`),
  KEY `FK_tb_detil_sppd` (`id_pgw`),
  KEY `FK_tb_detil_sppd2` (`id_sppd`),
  CONSTRAINT `FK_tb_detil_sppd` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_detil_sppd2` FOREIGN KEY (`id_sppd`) REFERENCES `tb_sppd` (`id_sppd`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_sppd` */

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
  `jns_abs` enum('cuti','ijin','sakit','libur') DEFAULT NULL COMMENT 'jenis ijin',
  `wkt_abs_awl` date NOT NULL COMMENT 'tanggal ijin',
  `wkt_abs_akr` date NOT NULL COMMENT 'akhir ijin ',
  `stat_abs` enum('N','Y','T') NOT NULL DEFAULT 'N' COMMENT 'status konfirmasi absensi',
  `apprv_abs` varchar(100) DEFAULT NULL COMMENT 'yang approve absensi',
  `jbt_abs` varchar(50) DEFAULT NULL COMMENT 'jabatan approve absensi',
  `bukti_abs` varchar(100) DEFAULT NULL COMMENT 'dokumen bukti',
  PRIMARY KEY (`id_abs`),
  KEY `FK_tb_izin_absen` (`id_pgw`),
  CONSTRAINT `FK_tb_izin_absen` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kendaraan_motor` */

insert  into `tb_kendaraan_motor`(`id_kdr_mtr`,`id_pgw`,`merk_kdr_mtr`,`nopol_kdr_mtr`,`stat_kdr_mtr`) values (1,7,'Yamaha','A 6291 FS','belum'),(2,1,'Yamaha','A 6291 FA','sudah');

/*Table structure for table `tb_last_upload` */

DROP TABLE IF EXISTS `tb_last_upload`;

CREATE TABLE `tb_last_upload` (
  `id_last_upload` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_last_upload`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `tb_last_upload` */

insert  into `tb_last_upload`(`id_last_upload`,`tanggal`) values (2,'2014-09-18'),(3,'2014-09-21'),(4,'2014-09-21'),(5,'2014-09-21'),(6,'2014-09-21'),(7,'2014-09-21'),(8,'2014-09-21'),(9,'2014-09-21'),(10,'2014-09-21'),(11,'2014-09-21'),(12,'2014-09-21'),(13,'2014-09-21'),(14,'2014-09-24'),(15,'2014-09-24'),(16,'2014-09-25'),(17,'2014-09-25'),(18,'2014-09-25'),(19,'2014-09-25'),(20,'2014-09-25'),(21,'2014-09-25'),(22,'2014-09-25'),(23,'2014-09-25'),(24,'2014-09-25'),(25,'2014-09-25'),(26,'2014-09-25'),(27,'2014-09-25'),(28,'2014-09-25'),(29,'2014-09-28'),(30,'2014-09-28'),(31,'2014-09-28'),(32,'2014-09-28'),(33,'2014-09-28');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_muhasabah` */

insert  into `tb_muhasabah`(`id_mhb`,`id_pgw`,`tgl_mhb`,`alq_mhb`,`thj_mhb`,`sdq_mhb`,`psa_mhb`) values (1,1,'2014-08-25','Y','Y','Y','T'),(2,1,'2014-08-28','T','T','T','Y'),(3,7,'2014-09-29','Y','T','Y','Y'),(4,7,'2014-09-25','T','Y','T','Y'),(5,1,'2014-09-23','Y','Y','Y','T');

/*Table structure for table `tb_notif` */

DROP TABLE IF EXISTS `tb_notif`;

CREATE TABLE `tb_notif` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) DEFAULT NULL,
  `waktu_notif` datetime NOT NULL COMMENT 'waktu tgl dan jam',
  `ket_notif` varchar(100) NOT NULL COMMENT 'keterangan',
  `status_notif` enum('y','n') NOT NULL COMMENT 'status baca',
  PRIMARY KEY (`id_notif`),
  KEY `FK_tb_notif` (`id_pgw`),
  CONSTRAINT `FK_tb_notif` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_notif` */

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
  `pass_pgw` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pegawai` */

insert  into `tb_pegawai`(`id_pgw`,`id_jbtn`,`nik_pgw`,`no_ktp_pgw`,`npwp_pgw`,`nma_lkp_pgw`,`email_pgw`,`almt_pgw`,`jk_pgw`,`stat_pgw`,`lev_usr_pgw`,`uname_pgw`,`pass_pgw`,`photo_pgw`,`tmp_lhr_pgw`,`tgl_lhr_pgw`,`hp_pgw`,`telp_pgw`,`gol_drh_pgw`,`nma_psg_pgw`,`pc_ktp_pgw`,`stat_akt_pgw`) values (1,1,'10111078','2222222222222225','333355555555555','Handoyo','dyo.99123@gmail.com','Bandung','L','menikah','admin','hxline','f5bb0c8de146c67b44babbf4e6584cc0','images/1/1.jpg','Serang','1994-05-18','087871942562','','O','','images/ktp/13092014125338.jpg','Y'),(7,4,'1212','1414','1515','Arlan','arlan@gmail.com','Serang','L','menikah','user','arlan','f5bb0c8de146c67b44babbf4e6584cc0','images/7/7.jpg','Serang','2014-09-11','0818820406','','B','',NULL,'Y'),(9,17,'22222','33333','44444','Hello','hai@galau.com','Entah','P','belum menikah','special user','hai','f5bb0c8de146c67b44babbf4e6584cc0',NULL,'Dimana','2014-09-11','1423414124','','AB','',NULL,'Y'),(28,1,'123123','2312312332132323','321323123123345','awdawd','awdwd@adaw.fhh','Alamat','L','menikah','admin','awdaw','4297f44b13955235245b2497399d7a93',NULL,'awddawd','2014-09-16','12312342354','','B','awdawd','images/ktp/12092014113135.jpg','Y'),(35,1,'82345','2353453465645656','634623423543523','awdad','dyo.9913@gmail.com','Alamat','L','belum menikah','admin','asd','f4554d49369223771b7a7037c7b7a890',NULL,'awdwd','2014-10-09','23453656456','','A','',NULL,'Y');

/*Table structure for table `tb_pelatihan` */

DROP TABLE IF EXISTS `tb_pelatihan`;

CREATE TABLE `tb_pelatihan` (
  `id_lth` int(20) NOT NULL AUTO_INCREMENT,
  `tgl_pjn_lth` date NOT NULL COMMENT 'tanggal pengajuan',
  `nma_pju_lth` varchar(100) NOT NULL COMMENT 'nama pengaju pelatihan',
  `nma_lth` varchar(100) NOT NULL COMMENT 'nama pelatihan',
  `waktu_lth_awal` date NOT NULL COMMENT 'tanggal awal',
  `waktu_lth_akhir` date NOT NULL COMMENT 'tangal berakhir',
  `tmp_lth` varchar(100) NOT NULL COMMENT 'tempat pelatihan',
  `stat_lth` enum('N','Y','T') NOT NULL DEFAULT 'N',
  `apprv_lth` varchar(100) DEFAULT NULL,
  `jbt_apprv_lth` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_lth`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelatihan` */

insert  into `tb_pelatihan`(`id_lth`,`tgl_pjn_lth`,`nma_pju_lth`,`nma_lth`,`waktu_lth_awal`,`waktu_lth_akhir`,`tmp_lth`,`stat_lth`,`apprv_lth`,`jbt_apprv_lth`) values (1,'2014-09-22','Handoyo','Cobaa','2014-09-23','0000-00-00','dadf','Y','Handoyo','komisaris(komisaris)'),(2,'2014-09-22','Handoyo','Coba Lagi','2014-09-24','0000-00-00','Bandung','T','Handoyo','komisaris(komisaris)'),(3,'2014-09-22','Handoyo','asdeee','2014-09-15','0000-00-00','fadw','N',NULL,NULL);

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
  `jm_msk_prs` time DEFAULT NULL COMMENT 'jam masuk',
  `jm_klr_prs` time DEFAULT NULL COMMENT 'jam keluar',
  `tlt_prs` time DEFAULT NULL COMMENT 'telat ',
  `stat_prs` enum('hadir','sakit','ijin','alpha','cuti','libur','tugas') NOT NULL COMMENT 'status presensi',
  `wkt_krj` time DEFAULT NULL COMMENT 'waktu kerja',
  PRIMARY KEY (`id_prs`),
  KEY `FK_tb_presensi` (`no_akun_pgw`),
  CONSTRAINT `FK_tb_presensi` FOREIGN KEY (`no_akun_pgw`) REFERENCES `tb_akun` (`no_akun_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tb_presensi` */

insert  into `tb_presensi`(`id_prs`,`no_akun_pgw`,`tgl_prs`,`jm_msk_prs`,`jm_klr_prs`,`tlt_prs`,`stat_prs`,`wkt_krj`) values (1,1,'2014-08-27','10:24:00','16:51:00','09:54:00','hadir','13:27:00'),(2,7,'2014-08-27','06:53:00','17:19:00','00:00:00','hadir','17:26:00'),(3,9,'2014-08-27',NULL,NULL,NULL,'alpha',NULL),(4,28,'2014-08-27',NULL,NULL,NULL,'alpha',NULL),(6,1,'2014-08-28',NULL,NULL,NULL,'libur',NULL),(7,7,'2014-08-28',NULL,NULL,NULL,'libur',NULL),(8,9,'2014-08-28',NULL,NULL,NULL,'libur',NULL),(9,28,'2014-08-28',NULL,NULL,NULL,'libur',NULL),(11,1,'2014-08-29',NULL,NULL,NULL,'alpha',NULL),(12,7,'2014-08-29',NULL,NULL,NULL,'alpha',NULL),(13,9,'2014-08-29',NULL,NULL,NULL,'alpha',NULL),(14,28,'2014-08-29',NULL,NULL,NULL,'alpha',NULL),(16,1,'2014-08-30',NULL,NULL,NULL,'libur',NULL),(17,7,'2014-08-30',NULL,NULL,NULL,'libur',NULL),(18,9,'2014-08-30',NULL,NULL,NULL,'libur',NULL),(19,28,'2014-08-30',NULL,NULL,NULL,'libur',NULL),(21,1,'2014-08-31',NULL,NULL,NULL,'libur',NULL),(22,7,'2014-08-31',NULL,NULL,NULL,'libur',NULL),(23,9,'2014-08-31',NULL,NULL,NULL,'libur',NULL),(24,28,'2014-08-31',NULL,NULL,NULL,'libur',NULL);

/*Table structure for table `tb_punishment` */

DROP TABLE IF EXISTS `tb_punishment`;

CREATE TABLE `tb_punishment` (
  `id_pun` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `tgl_pun` date DEFAULT NULL COMMENT 'tanggal pengajuan',
  `jns_pun` enum('SP1','SP2','SP3') NOT NULL COMMENT 'jenis',
  `surat_pun` varchar(30) NOT NULL COMMENT 'surat lampiran',
  `ket_pun` varchar(100) DEFAULT NULL COMMENT 'keterangan',
  PRIMARY KEY (`id_pun`),
  KEY `FK_tb_punishment` (`id_pgw`),
  CONSTRAINT `FK_tb_punishment` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_punishment` */

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_rek_bank` */

insert  into `tb_rek_bank`(`id_dtl_bank`,`id_bank`,`id_pgw`,`no_rek`) values (1,1,1,'02221233'),(2,2,9,'221212'),(3,5,1,'1777774234'),(4,4,1,'124234234');

/*Table structure for table `tb_reward` */

DROP TABLE IF EXISTS `tb_reward`;

CREATE TABLE `tb_reward` (
  `id_reward` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `jns_reward` enum('teladan','khusus') NOT NULL,
  `ket_reward` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_reward`),
  KEY `FK_tb_reward` (`id_pgw`),
  CONSTRAINT `FK_tb_reward` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_reward` */

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_sim` */

insert  into `tb_sim`(`id_sim`,`id_pgw`,`jns_sim`,`no_sim`,`pc_sim`) values (1,1,'C','675463333333','images/sim/13092014010020.jpg'),(7,1,'A','656555555552','images/sim/13092014123021.jpg');

/*Table structure for table `tb_sppd` */

DROP TABLE IF EXISTS `tb_sppd`;

CREATE TABLE `tb_sppd` (
  `id_sppd` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pju_sppd` date NOT NULL COMMENT 'tanggal pengajuan',
  `tgl_plk_sppd` date NOT NULL COMMENT 'tanggal pelaksanaan sppsd',
  `nma_kga_sppd` varchar(100) NOT NULL COMMENT 'nama tamu yg dikunjungi',
  `posisi_kga_sppd` varchar(50) DEFAULT NULL COMMENT 'posisi atau jabatan tamu',
  `jns_tmp_sppd` enum('perusahaan','instansi','organisasi','lembaga','sekolah','kampus') NOT NULL COMMENT 'jenis tempat dituju',
  `nma_tmp_sppd` varchar(50) NOT NULL COMMENT 'nama tempat ',
  `bdg_phn_sppd` varchar(50) DEFAULT NULL COMMENT 'bidang perusahaan / instansi',
  `tlp_kga_sppd` varchar(15) NOT NULL COMMENT 'telpon tamu',
  `agenda_sppd` text NOT NULL,
  `apprv_sppd` enum('N','Y','T') DEFAULT NULL COMMENT 'status dikonfirmasi',
  `tgl_apprv_sppd` date DEFAULT NULL COMMENT 'tanggal dikonfirmasi ',
  `nma_apprv_sppd` varchar(100) DEFAULT NULL COMMENT 'nama yang konfirmasi',
  `jbtn_apprv_sppd` varchar(100) DEFAULT NULL COMMENT 'jabatan yang konfirmasi',
  PRIMARY KEY (`id_sppd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_sppd` */

/*Table structure for table `tb_tanggal_libur` */

DROP TABLE IF EXISTS `tb_tanggal_libur`;

CREATE TABLE `tb_tanggal_libur` (
  `id_libur` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_libur` date NOT NULL,
  `nama_libur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_libur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_tanggal_libur` */

insert  into `tb_tanggal_libur`(`id_libur`,`tgl_libur`,`nama_libur`) values (1,'2014-08-30','Libur'),(2,'2014-08-31','Libur'),(3,'2014-08-28','Pergi');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_usaha_aktifitas` */

insert  into `tb_usaha_aktifitas`(`id_ush_akt`,`id_pgw`,`jns_ush_akt`,`nma_ush_akt`) values (1,7,'peternakan','travel');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
