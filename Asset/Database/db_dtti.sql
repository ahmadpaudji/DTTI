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
  CONSTRAINT `FK_tb_detil_informal2` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_detil_informal` FOREIGN KEY (`id_pnd_informal`) REFERENCES `tb_informal` (`id_pnd_informal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_informal` */

/*Table structure for table `tb_detil_jabatan` */

DROP TABLE IF EXISTS `tb_detil_jabatan`;

CREATE TABLE `tb_detil_jabatan` (
  `id_dtl_jbt` int(20) NOT NULL AUTO_INCREMENT,
  `id_jbtn` int(20) NOT NULL,
  `id_divisi` int(20) NOT NULL,
  PRIMARY KEY (`id_dtl_jbt`),
  KEY `FK_tb_detil_jabatan` (`id_divisi`),
  CONSTRAINT `FK_tb_detil_jabatan2` FOREIGN KEY (`id_dtl_jbt`) REFERENCES `tb_jabatan` (`id_jbtn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_detil_jabatan` FOREIGN KEY (`id_divisi`) REFERENCES `tb_divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_jabatan` */

/*Table structure for table `tb_divisi` */

DROP TABLE IF EXISTS `tb_divisi`;

CREATE TABLE `tb_divisi` (
  `id_divisi` int(20) NOT NULL AUTO_INCREMENT,
  `nma_divisi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_divisi` */

insert  into `tb_divisi`(`id_divisi`,`nma_divisi`) values (1,'Direksi'),(2,'Komisaris'),(3,'Sekretariat'),(4,'Operasional'),(5,'Program'),(6,'Marketing');

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

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `id_jbtn` int(20) NOT NULL AUTO_INCREMENT,
  `nma_jbt` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jbtn`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id_jbtn`,`nma_jbt`) values (0,''),(1,'Direktur'),(2,'Komisaris'),(3,'Kepala'),(4,'Staff Administartif'),(5,'Staff Keuangan'),(6,'Staff Event Organize'),(7,'Supervisor'),(8,'Manajer'),(9,'Staff Sales Excecuti'),(10,'Staff Telemarketing'),(11,'Staff Operasional Ma'),(12,'Staff Customer Servi');

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

/*Table structure for table `tb_pegawai` */

DROP TABLE IF EXISTS `tb_pegawai`;

CREATE TABLE `tb_pegawai` (
  `id_pgw` int(100) NOT NULL AUTO_INCREMENT,
  `id_dtl_jbt` int(100) DEFAULT NULL,
  `no_abs_pgw` int(30) NOT NULL COMMENT 'nomor absen',
  `nik_pgw` int(20) DEFAULT NULL,
  `no_ktp_pgw` varchar(50) DEFAULT NULL,
  `npwp_pgw` varchar(50) DEFAULT NULL,
  `nma_lkp_pgw` varchar(100) NOT NULL COMMENT 'nama lengkap',
  `tgl_lhr_pgw` date DEFAULT NULL,
  `tmp_lhr_pgw` varchar(50) NOT NULL,
  `almt_pgw` text COMMENT 'alamat rumah',
  `telp_pgw` int(15) DEFAULT NULL COMMENT 'telpon rumah',
  `hp_pgw` int(15) NOT NULL,
  `gol_drh_pgw` enum('A','B','O','AB') NOT NULL,
  `nma_psg_pgw` varchar(100) DEFAULT NULL COMMENT 'nama pasangan',
  `jk_pgw` enum('L','P') NOT NULL,
  `stat_pgw` enum('Menikah','Belum Menikah') NOT NULL COMMENT 'status',
  `mail_pgw` varchar(30) DEFAULT NULL COMMENT 'nama email',
  `uname` varchar(20) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `lev_usr` enum('Administrator','User','Super User') NOT NULL COMMENT 'level user',
  `photo_pgw` varchar(100) DEFAULT NULL COMMENT 'gambar',
  `pc_ktp_pgw` varchar(100) DEFAULT NULL COMMENT 'gambar ktp',
  PRIMARY KEY (`id_pgw`,`no_abs_pgw`),
  KEY `FK_tb_pegawai` (`id_dtl_jbt`),
  CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_dtl_jbt`) REFERENCES `tb_detil_jabatan` (`id_dtl_jbt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pegawai` */

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
  CONSTRAINT `FK_tb_rek_bank2` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_rek_bank` FOREIGN KEY (`id_bank`) REFERENCES `tb_bank` (`id_bank`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
