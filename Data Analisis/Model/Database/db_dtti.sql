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

/*Table structure for table `tb_detil_ibadah` */

DROP TABLE IF EXISTS `tb_detil_ibadah`;

CREATE TABLE `tb_detil_ibadah` (
  `id_dtl_ibd` int(20) NOT NULL AUTO_INCREMENT,
  `id_ibd` int(20) NOT NULL,
  `prd_awl` date NOT NULL COMMENT 'periode awal tgl',
  `prd_akr` date NOT NULL COMMENT 'periode akhir tgl',
  PRIMARY KEY (`id_dtl_ibd`),
  KEY `FK_tb_detil_ibadah` (`id_ibd`),
  CONSTRAINT `FK_tb_detil_ibadah` FOREIGN KEY (`id_ibd`) REFERENCES `tb_ibadah` (`id_ibd`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_ibadah` */

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

/*Table structure for table `tb_detil_jabatan` */

DROP TABLE IF EXISTS `tb_detil_jabatan`;

CREATE TABLE `tb_detil_jabatan` (
  `id_dtl_jbt` int(20) NOT NULL AUTO_INCREMENT,
  `id_jbtn` int(20) NOT NULL,
  `id_divisi` int(20) NOT NULL,
  PRIMARY KEY (`id_dtl_jbt`),
  KEY `FK_tb_detil_jabatan` (`id_divisi`),
  KEY `FK_tb_detil_jabatan2` (`id_jbtn`),
  CONSTRAINT `FK_tb_detil_jabatan` FOREIGN KEY (`id_divisi`) REFERENCES `tb_divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_detil_jabatan2` FOREIGN KEY (`id_jbtn`) REFERENCES `tb_jabatan` (`id_jbtn`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detil_jabatan` */

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

/*Table structure for table `tb_ibadah` */

DROP TABLE IF EXISTS `tb_ibadah`;

CREATE TABLE `tb_ibadah` (
  `id_ibd` int(11) NOT NULL AUTO_INCREMENT,
  `jns_ibd` enum('tahajud','tadarus','shadaqoh','shaum sunat') NOT NULL,
  `tgt_ibd` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ibd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_ibadah` */

insert  into `tb_ibadah`(`id_ibd`,`jns_ibd`,`tgt_ibd`) values (1,'shadaqoh',30),(2,'shaum sunat',8),(3,'tadarus',30),(4,'tahajud',30);

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
  `id_jbtn` int(20) NOT NULL AUTO_INCREMENT,
  `nma_jbt` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jbtn`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id_jbtn`,`nma_jbt`) values (0,''),(1,'Direktur'),(3,'Kepala'),(4,'Staff Administartif'),(5,'Staff Keuangan'),(6,'Staff Event Organize'),(7,'Supervisor'),(8,'Manajer'),(9,'Staff Sales Excecuti'),(10,'Staff Telemarketing'),(11,'Staff Operasional Ma'),(12,'Staff Customer Servi');

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

/*Table structure for table `tb_komisaris` */

DROP TABLE IF EXISTS `tb_komisaris`;

CREATE TABLE `tb_komisaris` (
  `id_komisaris` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgna` int(11) DEFAULT NULL,
  `jns_komisaris` enum('komisaris','komisaris utama') DEFAULT NULL,
  PRIMARY KEY (`id_komisaris`),
  KEY `FK_tb_komisaris` (`id_pgna`),
  CONSTRAINT `FK_tb_komisaris` FOREIGN KEY (`id_pgna`) REFERENCES `tb_pengguna` (`id_pgna`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_komisaris` */

/*Table structure for table `tb_muhasabah` */

DROP TABLE IF EXISTS `tb_muhasabah`;

CREATE TABLE `tb_muhasabah` (
  `id_mhb` int(20) NOT NULL AUTO_INCREMENT,
  `id_ibd` int(20) NOT NULL,
  `id_pgw` int(20) NOT NULL,
  `tgl_ibd` date NOT NULL,
  PRIMARY KEY (`id_mhb`),
  KEY `FK_tb_muhasabah` (`id_ibd`),
  KEY `FK_tb_muhasabah2` (`id_pgw`),
  CONSTRAINT `FK_tb_muhasabah` FOREIGN KEY (`id_ibd`) REFERENCES `tb_detil_ibadah` (`id_ibd`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_muhasabah2` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_muhasabah` */

/*Table structure for table `tb_pegawai` */

DROP TABLE IF EXISTS `tb_pegawai`;

CREATE TABLE `tb_pegawai` (
  `id_pgw` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgna` int(20) DEFAULT NULL,
  `id_dtl_jbt` int(100) DEFAULT NULL,
  `nik_pgw` varchar(30) DEFAULT NULL,
  `no_peg_pgw` int(30) NOT NULL COMMENT 'nomor presensi',
  `no_akun_pgw` int(30) DEFAULT NULL COMMENT 'nomor akun presensi',
  PRIMARY KEY (`id_pgw`),
  UNIQUE KEY `no_abs_pgw` (`no_peg_pgw`),
  UNIQUE KEY `no_abs_pgw_2` (`no_peg_pgw`),
  UNIQUE KEY `nik_pgw` (`nik_pgw`),
  KEY `FK_tb_pegawai` (`id_dtl_jbt`),
  KEY `FK_tb_pegawai2` (`id_pgna`),
  CONSTRAINT `FK_tb_pegawai2` FOREIGN KEY (`id_pgna`) REFERENCES `tb_pengguna` (`id_pgna`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_dtl_jbt`) REFERENCES `tb_detil_jabatan` (`id_dtl_jbt`) ON DELETE CASCADE ON UPDATE CASCADE
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

/*Table structure for table `tb_pengguna` */

DROP TABLE IF EXISTS `tb_pengguna`;

CREATE TABLE `tb_pengguna` (
  `id_pgna` int(20) NOT NULL AUTO_INCREMENT,
  `no_ktp_agt` varchar(40) DEFAULT NULL,
  `npwp_agt` varchar(30) DEFAULT NULL,
  `nma_lkp_agt` varchar(100) NOT NULL,
  `email_agt` varchar(50) NOT NULL,
  `almt_agt` text NOT NULL,
  `jk_agt` enum('L','P') NOT NULL,
  `stat_agt` enum('menikah','belum menikah') NOT NULL,
  `lev_usr_agt` enum('admin','user','special user') NOT NULL,
  `uname_agt` varchar(20) NOT NULL,
  `pass_agt` varchar(20) NOT NULL,
  `photo_agt` varchar(100) DEFAULT NULL,
  `tmp_lhr_agt` varchar(50) NOT NULL,
  `tgl_lhr_agt` date NOT NULL,
  `hp_agt` varchar(15) NOT NULL,
  `telp_agt` varchar(15) DEFAULT NULL,
  `gol_drh_agt` enum('A','B','O','AB') DEFAULT NULL,
  `nma_psg_agt` varchar(100) DEFAULT NULL,
  `pc_ktp_agt` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pgna`),
  UNIQUE KEY `npwp_agt` (`npwp_agt`),
  UNIQUE KEY `no_ktp_agt` (`no_ktp_agt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengguna` */

/*Table structure for table `tb_presensi` */

DROP TABLE IF EXISTS `tb_presensi`;

CREATE TABLE `tb_presensi` (
  `id_prs` int(20) NOT NULL AUTO_INCREMENT COMMENT 'no absensi',
  `id_pgw` int(20) NOT NULL COMMENT 'no akun absensii',
  `tgl_prs` date NOT NULL COMMENT 'tanggal presensi',
  `jm_msk_prs` time DEFAULT NULL COMMENT 'jam masuk',
  `jm_klr_prs` time DEFAULT NULL COMMENT 'jam keluar',
  `tlt_prs` time DEFAULT NULL COMMENT 'telat ',
  `plg_awl_prs` time DEFAULT NULL COMMENT 'pulang awal ',
  `stat_prs` enum('hadir','sakit','ijin','alpha','cuti','libur') NOT NULL COMMENT 'status presensi',
  `wkt_krj` time DEFAULT NULL COMMENT 'waktu kerja',
  `lma_hdr` time DEFAULT NULL COMMENT 'lama hadir',
  `ket_prs` text COMMENT 'keterangan',
  PRIMARY KEY (`id_prs`),
  KEY `FK_tb_presensi` (`id_pgw`),
  CONSTRAINT `FK_tb_presensi` FOREIGN KEY (`id_pgw`) REFERENCES `tb_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE
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
