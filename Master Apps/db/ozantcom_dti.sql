-- MySQL dump 10.13  Distrib 5.5.34, for Linux (x86_64)
--
-- Host: localhost    Database: ozantcom_dti
-- ------------------------------------------------------
-- Server version	5.5.34-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_akun`
--

DROP TABLE IF EXISTS `tb_akun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_akun` (
  `no_akun_pgw` int(20) NOT NULL COMMENT 'nomor akun absen',
  `id_pgw` int(20) NOT NULL,
  PRIMARY KEY (`no_akun_pgw`),
  KEY `FK_tb_akun` (`id_pgw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_akun`
--

LOCK TABLES `tb_akun` WRITE;
/*!40000 ALTER TABLE `tb_akun` DISABLE KEYS */;
INSERT INTO `tb_akun` (`no_akun_pgw`, `id_pgw`) VALUES (19,1),(1,2),(20,3),(14,4),(6,5),(5,6),(21,7),(11,8),(3,9),(17,10),(16,11),(18,12),(13,13),(23,14),(9,15),(25,16),(4,17),(10,18),(12,19),(24,20),(7,21),(2,22),(22,23),(8,24);
/*!40000 ALTER TABLE `tb_akun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_anak`
--

DROP TABLE IF EXISTS `tb_anak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_anak` (
  `id_anak` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `no_urut_anak` enum('1','2','3','4','5','6','7','8','9','10','11') NOT NULL,
  `nma_anak` varchar(100) NOT NULL,
  `jk_anak` enum('L','P') NOT NULL,
  `tmp_lhr_anak` varchar(100) DEFAULT NULL,
  `tgl_lhr_anak` date DEFAULT NULL,
  PRIMARY KEY (`id_anak`),
  KEY `FK_tb_anak` (`id_pgw`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_anak`
--

LOCK TABLES `tb_anak` WRITE;
/*!40000 ALTER TABLE `tb_anak` DISABLE KEYS */;
INSERT INTO `tb_anak` (`id_anak`, `id_pgw`, `no_urut_anak`, `nma_anak`, `jk_anak`, `tmp_lhr_anak`, `tgl_lhr_anak`) VALUES (1,1,'1','Muhammad Aqil Syafiq','L','Bandung','2007-01-10'),(2,1,'2','Qolbi Tsani Maulida Izzaty Salami Haris','P','Bandung Barat','2012-09-02'),(3,1,'3','Masih dalam kandungan','P','Bandung Barat','2015-05-05'),(4,2,'1','Kafhaya Ghaliya Lakhiesa','P','Cimahi','2009-09-07'),(5,2,'2','Keyshara Khedira Terafugia','P','Cimahi','2013-06-15'),(6,3,'1','Farras Jasmine Shakylla Adi Putri','P','Bandung','2006-04-21'),(7,3,'2','Falisha Jeehan Shakufa Adi Putri','P','Bandung','2007-09-01'),(8,4,'1','Tsurayya Permata Karimah','P','Garut','2009-01-11'),(9,4,'2','Afifa Permata Zahira','P','Garut','2014-05-01'),(10,5,'1','Agit Bagja Nugraha','L','Bandung','1990-08-20'),(11,7,'1','Fadhil Adilahputra','L','Bandung','2007-10-25'),(12,7,'2','Fierkhan Nailhaq Adilahputra','L','Bandung','2012-09-10'),(13,9,'1','Muhammad Ghairan Farist Al Fathan','L','Bontang','2005-04-17'),(14,9,'2','Ahmad Ghani Yarist Al Firdaus','L','Bandung','2009-10-01'),(15,9,'3','Ahmad Ghibran Karis Al Faqih','L','Cimahi','2014-12-18'),(16,11,'1','Fauzy Halim Fitra Rahman','L','Cimahi','2011-03-18'),(17,12,'1','Faiq Muhammad Tsaqif','L','Bandung','2007-10-08'),(18,12,'2','Fayya Elfreda Raudh Janh','P','Bandung','2012-11-23'),(19,13,'1','Hamizan Huwaidi','L','Bandung','2012-03-03'),(20,14,'1','Salamah Raudhatul Jannah','P','Bandung','2008-02-27'),(21,14,'2','Muhammad Dzulfikar Abdul Aziz','L','Bandung','2012-05-07'),(22,15,'1','Muadz Jamaludin Hamid','L','Bandung','2008-03-15'),(23,15,'2','Muhammad Athian Hamid','L','Bandung','2009-05-19'),(24,16,'1','Tsaqib Yaseer El-Haq','L','Bandung','2006-02-16'),(25,16,'2','Tsabit Yasykur El-Haq','L','Bandung','2007-10-19'),(26,16,'3','Tsaqif Yashdiq El-Haq','L','Bandung','2009-05-27'),(27,17,'1','Awliya Rahadatul \'Aisy','P','Cianjur','2009-10-18'),(28,17,'2','Muhammad Fathir Dzikrullah','L','Cianjur','2013-03-04'),(29,18,'1','M. Langit Arkan Ginanjar','L','Ciamis','2011-06-11'),(30,20,'1','Muhammad Firzatullah .H','L','Cimahi','2001-06-07'),(31,21,'1','Muhammad Salman Arvansyah','L','Bandung','2009-04-19'),(32,22,'1','Annisa Rahma Fauzia','P','Bandung','2003-10-19'),(33,22,'2','Azmi Rahman Hafiyyan','L','Bandung','2008-05-27'),(34,22,'3','Nadiyya Rahma Fauzia','P','Bandung','2009-12-30'),(35,22,'4','Hasna Rahma Shaliha','P','Bandung','2011-04-10'),(36,23,'1','M. Rafi Idzwan Maulana Al-Farisi','L','Bandung','2002-12-22'),(37,23,'2','M. Rasyid Falih Al-Farisi','L','Bandung','2006-09-19'),(38,23,'3','Raisya Fatimah Al-Farisi','P','Bandung','2013-04-09'),(39,24,'1','Azkia Malikah Zaeni','P','Bandung','2010-02-22'),(40,24,'2','Balqis Nabilla Zaeni','P','Bandung','2012-07-31');
/*!40000 ALTER TABLE `tb_anak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bank`
--

DROP TABLE IF EXISTS `tb_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bank` (
  `id_bank` int(20) NOT NULL AUTO_INCREMENT,
  `sktn_bank` varchar(20) NOT NULL,
  `nma_bank` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bank`
--

LOCK TABLES `tb_bank` WRITE;
/*!40000 ALTER TABLE `tb_bank` DISABLE KEYS */;
INSERT INTO `tb_bank` (`id_bank`, `sktn_bank`, `nma_bank`) VALUES (1,'BMI','Bank Mu\'amalat Indonesia'),(2,'BNIS','Bank Negara Indonesia Syari\'ah'),(3,'BNI','Bank Negara Indonesia'),(4,'BCA','Bank Central Asia'),(5,'BMT','Bank Darut Tauhid'),(6,'BJB','Bank Jawa Barat'),(7,'MLT','Bank Muamalat'),(18,'MDR','Bank Mandiri');
/*!40000 ALTER TABLE `tb_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_detil_formal`
--

DROP TABLE IF EXISTS `tb_detil_formal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  KEY `FK_tb_detil_formal` (`id_pnd_formal`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_detil_formal`
--

LOCK TABLES `tb_detil_formal` WRITE;
/*!40000 ALTER TABLE `tb_detil_formal` DISABLE KEYS */;
INSERT INTO `tb_detil_formal` (`id_dtl_formal`, `id_pnd_formal`, `id_pgw`, `nma_dtl_formal`, `thn_dtl_formal`, `stat_dtl_formal`, `pc_ijzh`) VALUES (1,1,1,'Pertiwi Cikalongwetan Kab. Bandung',1983,'lulus',NULL),(2,2,1,'MIN Ciawitali Cikalongwetan Kab. Bandung',1984,'lulus',NULL),(3,3,1,'Mts Al-Huda Cikalongwetan Kab. Bandung',1990,'lulus',NULL),(4,4,1,'MAN 1 Pacet Kab. Cianjur',1993,'lulus',NULL),(5,9,1,'IAIN Sunan Gunung Djati Bandung',1995,'lulus',NULL),(6,2,4,'SDN Julang II Bogor',1989,'lulus',NULL),(7,3,4,'SMP Negeri 5 Bogor',1994,'lulus',NULL),(8,2,6,'SDN Cipondok',1999,'lulus',NULL),(9,3,6,'SMPN 1 Rajapolah',2004,'lulus',NULL),(10,4,6,'SMAN 1 Ciawi Tasikmalaya',2007,'lulus',NULL),(11,2,8,'SD Pengadilan 3 Tasikmalaya',1988,'lulus',NULL),(12,3,8,'SMPN 1 Tasikmalaya',1994,'lulus',NULL),(13,4,8,'SMUN 5 Tasikmalaya',1996,'lulus',NULL),(14,2,9,'SD YPVDP (Vidatra) PT. BADAK LNG Co. Bontang',1988,'lulus',NULL),(15,3,9,'SMP YPVDP (Vidatra) PT. BADAK LNG Co. Bontang',1994,'lulus',NULL),(16,4,9,'SMA YPVDP (Vidatra) PT. BADAK LNG Co. Bontang',1996,'lulus',NULL),(17,9,9,'S1 Teknik Elektro UNJANI',2010,'lulus',NULL);
/*!40000 ALTER TABLE `tb_detil_formal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_detil_informal`
--

DROP TABLE IF EXISTS `tb_detil_informal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_detil_informal` (
  `id_dtl_informal` int(20) NOT NULL AUTO_INCREMENT,
  `id_pnd_informal` int(20) NOT NULL,
  `id_pgw` int(20) NOT NULL,
  `nma_dtl_informal` varchar(100) NOT NULL COMMENT 'nama pendidikan informal',
  `pc_srtkt` varchar(100) NOT NULL COMMENT 'photocopy sertifikat',
  PRIMARY KEY (`id_dtl_informal`),
  KEY `FK_tb_detil_informal` (`id_pnd_informal`),
  KEY `FK_tb_detil_informal2` (`id_pgw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_detil_informal`
--

LOCK TABLES `tb_detil_informal` WRITE;
/*!40000 ALTER TABLE `tb_detil_informal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_detil_informal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_detil_pelatihan`
--

DROP TABLE IF EXISTS `tb_detil_pelatihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_detil_pelatihan` (
  `id_dtl_lth` int(20) NOT NULL AUTO_INCREMENT,
  `id_lth` int(20) NOT NULL,
  `id_pgw` int(20) NOT NULL,
  PRIMARY KEY (`id_dtl_lth`),
  KEY `FK_tb_detil_pelatihan` (`id_lth`),
  KEY `FK_tb_detil_pelatihan2` (`id_pgw`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_detil_pelatihan`
--

LOCK TABLES `tb_detil_pelatihan` WRITE;
/*!40000 ALTER TABLE `tb_detil_pelatihan` DISABLE KEYS */;
INSERT INTO `tb_detil_pelatihan` (`id_dtl_lth`, `id_lth`, `id_pgw`) VALUES (1,1,10),(2,1,3),(3,1,5),(4,1,7);
/*!40000 ALTER TABLE `tb_detil_pelatihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_detil_sppd`
--

DROP TABLE IF EXISTS `tb_detil_sppd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_detil_sppd` (
  `id_dtl_sppd` int(11) NOT NULL AUTO_INCREMENT,
  `id_sppd` int(11) NOT NULL,
  `id_pgw` int(11) NOT NULL,
  PRIMARY KEY (`id_dtl_sppd`),
  KEY `FK_tb_detil_sppd` (`id_pgw`),
  KEY `FK_tb_detil_sppd2` (`id_sppd`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_detil_sppd`
--

LOCK TABLES `tb_detil_sppd` WRITE;
/*!40000 ALTER TABLE `tb_detil_sppd` DISABLE KEYS */;
INSERT INTO `tb_detil_sppd` (`id_dtl_sppd`, `id_sppd`, `id_pgw`) VALUES (1,1,3),(2,1,1),(3,1,5),(4,1,7),(5,1,10),(6,2,3),(7,2,1),(8,2,2),(9,2,5),(10,3,10),(11,3,1),(12,3,4),(13,3,6);
/*!40000 ALTER TABLE `tb_detil_sppd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_formal`
--

DROP TABLE IF EXISTS `tb_formal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_formal` (
  `id_pnd_formal` int(20) NOT NULL AUTO_INCREMENT,
  `skt_pnd_formal` varchar(5) NOT NULL COMMENT 'singkatan',
  `nma_pnd_formal` varchar(30) NOT NULL COMMENT 'nama lengkap',
  PRIMARY KEY (`id_pnd_formal`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_formal`
--

LOCK TABLES `tb_formal` WRITE;
/*!40000 ALTER TABLE `tb_formal` DISABLE KEYS */;
INSERT INTO `tb_formal` (`id_pnd_formal`, `skt_pnd_formal`, `nma_pnd_formal`) VALUES (1,'TK','Taman Kanak'),(2,'SD','Sekolah Dasar'),(3,'SMP ','Sekolah Menengah Pertama'),(4,'SMA','Sekolah Menengah Atas'),(5,'SMK','Sekolah Menengah Kejuruan'),(6,'D1','Diploma 1'),(7,'D2','Diploma 2'),(8,'D3','Diploma 3'),(9,'S1','Sarjana'),(10,'S2','Master '),(11,'S3','Doktor ');
/*!40000 ALTER TABLE `tb_formal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_informal`
--

DROP TABLE IF EXISTS `tb_informal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_informal` (
  `id_pnd_informal` int(20) NOT NULL AUTO_INCREMENT,
  `nma_pnd_informal` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pnd_informal`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_informal`
--

LOCK TABLES `tb_informal` WRITE;
/*!40000 ALTER TABLE `tb_informal` DISABLE KEYS */;
INSERT INTO `tb_informal` (`id_pnd_informal`, `nma_pnd_informal`) VALUES (1,'Kursus'),(2,'Pelatihan'),(3,'Seminar'),(4,'Sertifikasi');
/*!40000 ALTER TABLE `tb_informal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_izin_absen`
--

DROP TABLE IF EXISTS `tb_izin_absen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_izin_absen` (
  `id_abs` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `tgl_pjn_abs` date NOT NULL COMMENT 'tangal pengajuan ijin presensi',
  `als_abs` text NOT NULL COMMENT 'alasan ',
  `jns_abs` enum('cuti','ijin','sakit') DEFAULT NULL COMMENT 'jenis ijin',
  `wkt_abs_awl` date NOT NULL COMMENT 'tanggal ijin',
  `wkt_abs_akr` date NOT NULL COMMENT 'akhir ijin ',
  `stat_abs` enum('N','Y','T') NOT NULL DEFAULT 'N' COMMENT 'status konfirmasi absensi',
  `apprv_abs` varchar(100) DEFAULT NULL COMMENT 'yang approve absensi',
  `jbt_abs` varchar(50) DEFAULT NULL COMMENT 'jabatan approve absensi',
  `bukti_abs` varchar(100) DEFAULT NULL COMMENT 'dokumen bukti',
  PRIMARY KEY (`id_abs`),
  KEY `FK_tb_izin_absen` (`id_pgw`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_izin_absen`
--

LOCK TABLES `tb_izin_absen` WRITE;
/*!40000 ALTER TABLE `tb_izin_absen` DISABLE KEYS */;
INSERT INTO `tb_izin_absen` (`id_abs`, `id_pgw`, `tgl_pjn_abs`, `als_abs`, `jns_abs`, `wkt_abs_awl`, `wkt_abs_akr`, `stat_abs`, `apprv_abs`, `jbt_abs`, `bukti_abs`) VALUES (1,7,'2014-11-07','Sakit gigi','sakit','2014-11-08','2014-11-08','Y','Abdul Rohim','direksi(direktur operasional)',NULL),(2,1,'2014-12-02','cobaaa','cuti','2014-12-11','2014-12-16','N',NULL,NULL,'images/izin/02122014021645.jpg'),(3,1,'2014-12-02','cobaaa','cuti','2014-12-11','2014-12-16','N',NULL,NULL,'images/izin/02122014021742.jpg'),(4,1,'2014-12-02','awdawd','cuti','2014-12-03','2014-12-05','N',NULL,NULL,'images/izin/02122014022543.jpg'),(5,10,'2015-01-16','Sakit Gigi','sakit','2015-01-17','2015-01-17','Y','Ahmad Haris Mufti','sekretariat(kepala)',NULL);
/*!40000 ALTER TABLE `tb_izin_absen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jabatan`
--

DROP TABLE IF EXISTS `tb_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_jabatan` (
  `id_jbtn` int(11) NOT NULL AUTO_INCREMENT,
  `div_jbtn` enum('komisaris','direksi','operasional','marketing','program','sekretariat') NOT NULL,
  `nma_jbtn` enum('komisaris utama','komisaris','kepala','direktur utama','direktur operasional','direktur marketing','manajer','staff administrasi','staff keuangan','staff event organizer','staff logistik','staff desain program','staff program alumni','staff sales executive','staff telemarketing','staff operasional marketing','staff customer relation','sv management event','sv logistik pengadaan','sv desain program','sv program alumni','sv ops marketing','sv marketing communication','sv adm & keuangan','staff driver','staff operasional sekretariat','staff marketing communication') NOT NULL,
  PRIMARY KEY (`id_jbtn`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jabatan`
--

LOCK TABLES `tb_jabatan` WRITE;
/*!40000 ALTER TABLE `tb_jabatan` DISABLE KEYS */;
INSERT INTO `tb_jabatan` (`id_jbtn`, `div_jbtn`, `nma_jbtn`) VALUES (1,'komisaris','komisaris'),(2,'komisaris','komisaris utama'),(3,'sekretariat','kepala'),(4,'direksi','direktur marketing'),(5,'direksi','direktur operasional'),(6,'direksi','direktur utama'),(7,'marketing','manajer'),(8,'operasional','manajer'),(9,'program','manajer'),(10,'operasional','sv management event'),(11,'operasional','sv logistik pengadaan'),(12,'program','sv desain program'),(13,'program','sv program alumni'),(14,'marketing','sv ops marketing'),(15,'marketing','sv marketing communication'),(16,'sekretariat','staff keuangan'),(17,'sekretariat','staff administrasi'),(18,'marketing','staff telemarketing'),(19,'marketing','staff operasional marketing'),(20,'marketing','staff sales executive'),(21,'program','staff program alumni'),(22,'program','staff desain program'),(23,'operasional','staff logistik'),(24,'operasional','staff event organizer'),(25,'sekretariat','sv adm & keuangan'),(26,'sekretariat','staff driver'),(27,'sekretariat','staff operasional sekretariat'),(28,'marketing','staff marketing communication');
/*!40000 ALTER TABLE `tb_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kendaraan_motor`
--

DROP TABLE IF EXISTS `tb_kendaraan_motor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_kendaraan_motor` (
  `id_kdr_mtr` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `merk_kdr_mtr` varchar(50) NOT NULL,
  `nopol_kdr_mtr` varchar(10) NOT NULL COMMENT 'nomor plat',
  `stat_kdr_mtr` enum('sudah','belum') NOT NULL COMMENT 'status stiker',
  PRIMARY KEY (`id_kdr_mtr`),
  KEY `FK_tb_kendaraan_motor` (`id_pgw`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kendaraan_motor`
--

LOCK TABLES `tb_kendaraan_motor` WRITE;
/*!40000 ALTER TABLE `tb_kendaraan_motor` DISABLE KEYS */;
INSERT INTO `tb_kendaraan_motor` (`id_kdr_mtr`, `id_pgw`, `merk_kdr_mtr`, `nopol_kdr_mtr`, `stat_kdr_mtr`) VALUES (1,1,'Honda New Supra Fit','D 5482 UV','belum'),(2,2,'Vario Teqhno','D 4883 SAA','belum'),(3,3,'Vario Teqhno','D 3704 KP','belum'),(4,4,'Yamaha Mio','Z 4368 DV','belum'),(5,5,'Vario','D 6025 FT','belum'),(6,7,'Supra Fit','D 3770 DM','belum'),(7,8,'Tiger 2000','D 3869 BY','belum'),(8,9,'Honda New Supra Fit','D 5897 SK','belum'),(9,11,'Sky Wave','D 6280 FO','belum'),(10,12,'Supra X 125 R','D 4910 SY','belum'),(11,14,'Supra Fit','D 6351 DS','belum'),(12,15,'Byson','D 6490 VAP','belum'),(13,16,'Karisma X','D 5814 DU','belum'),(14,20,'Honda New Supra 125 DD','D 6905 TB','belum'),(15,21,'Yamaha Mio','F 5282 WX','belum'),(16,22,'Vario','D 2380 ZT','belum'),(17,23,'Vario Teqhno','D 5716 UAY','belum'),(18,24,'Supra X 125','BE 8229 CJ','belum');
/*!40000 ALTER TABLE `tb_kendaraan_motor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_last_upload`
--

DROP TABLE IF EXISTS `tb_last_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_last_upload` (
  `id_last_upload` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_last_upload`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_last_upload`
--

LOCK TABLES `tb_last_upload` WRITE;
/*!40000 ALTER TABLE `tb_last_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_last_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_muhasabah`
--

DROP TABLE IF EXISTS `tb_muhasabah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_muhasabah` (
  `id_mhb` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `tgl_mhb` date NOT NULL COMMENT 'tangggal muhasabah',
  `alq_mhb` enum('Y','T') NOT NULL DEFAULT 'T' COMMENT 'baca quran',
  `thj_mhb` enum('Y','T') NOT NULL DEFAULT 'T' COMMENT 'tahajud',
  `sdq_mhb` enum('Y','T') NOT NULL DEFAULT 'T' COMMENT 'shadaqah',
  `psa_mhb` enum('Y','T') NOT NULL DEFAULT 'T' COMMENT 'puasa sunat',
  PRIMARY KEY (`id_mhb`),
  KEY `FK_tb_muhasabah2` (`id_pgw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_muhasabah`
--

LOCK TABLES `tb_muhasabah` WRITE;
/*!40000 ALTER TABLE `tb_muhasabah` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_muhasabah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_muhasabah_divisi`
--

DROP TABLE IF EXISTS `tb_muhasabah_divisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_muhasabah_divisi` (
  `id_mhb_div` int(11) NOT NULL AUTO_INCREMENT,
  `div_jbtn` varchar(300) NOT NULL,
  `periode_mhb_div` date NOT NULL,
  `kpi_mhb_div` float NOT NULL,
  PRIMARY KEY (`id_mhb_div`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_muhasabah_divisi`
--

LOCK TABLES `tb_muhasabah_divisi` WRITE;
/*!40000 ALTER TABLE `tb_muhasabah_divisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_muhasabah_divisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_muhasabah_pegawai`
--

DROP TABLE IF EXISTS `tb_muhasabah_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_muhasabah_pegawai` (
  `id_mhb_pgw` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `periode_mhb_pgw` date NOT NULL,
  `kpi_mhb_pgw` float NOT NULL,
  PRIMARY KEY (`id_mhb_pgw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_muhasabah_pegawai`
--

LOCK TABLES `tb_muhasabah_pegawai` WRITE;
/*!40000 ALTER TABLE `tb_muhasabah_pegawai` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_muhasabah_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_muhasabah_perusahaan`
--

DROP TABLE IF EXISTS `tb_muhasabah_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_muhasabah_perusahaan` (
  `id_mhb_prs` int(11) NOT NULL AUTO_INCREMENT,
  `periode_mhb_prs` date NOT NULL,
  `kpi_mhb_prs` float NOT NULL,
  PRIMARY KEY (`id_mhb_prs`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_muhasabah_perusahaan`
--

LOCK TABLES `tb_muhasabah_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_muhasabah_perusahaan` DISABLE KEYS */;
INSERT INTO `tb_muhasabah_perusahaan` (`id_mhb_prs`, `periode_mhb_prs`, `kpi_mhb_prs`) VALUES (1,'2014-10-01',0);
/*!40000 ALTER TABLE `tb_muhasabah_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_notif`
--

DROP TABLE IF EXISTS `tb_notif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_notif` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) DEFAULT NULL,
  `id_jbtn` int(11) NOT NULL DEFAULT '0',
  `waktu_notif` datetime NOT NULL COMMENT 'waktu tgl dan jam',
  `ket_notif` varchar(100) NOT NULL COMMENT 'keterangan',
  `status_notif` enum('y','n','t') NOT NULL COMMENT 'status baca',
  `jenis_notif` enum('peringatan','izin','sppd','pelatihan') NOT NULL,
  PRIMARY KEY (`id_notif`),
  KEY `FK_tb_notif` (`id_pgw`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_notif`
--

LOCK TABLES `tb_notif` WRITE;
/*!40000 ALTER TABLE `tb_notif` DISABLE KEYS */;
INSERT INTO `tb_notif` (`id_notif`, `id_pgw`, `id_jbtn`, `waktu_notif`, `ket_notif`, `status_notif`, `jenis_notif`) VALUES (1,7,0,'2014-11-07 16:46:08','Pengajuan izin.','n','izin'),(2,3,0,'2014-11-07 17:30:09','Pengajuan SPPD.','t','sppd'),(3,1,0,'2014-12-02 14:16:46','Pengajuan izin.','n','izin'),(4,1,0,'2014-12-02 14:17:42','Pengajuan izin.','n','izin'),(5,1,0,'2014-12-02 14:25:43','Pengajuan izin.','n','izin'),(6,3,0,'2014-12-19 08:20:49','Pengajuan SPPD.','t','sppd'),(7,10,0,'2015-01-16 19:41:52','Pengajuan izin.','y','izin'),(8,10,0,'2015-01-16 19:43:21','Pengajuan SPPD.','y','sppd'),(9,10,0,'2015-01-16 19:44:07','Pengajuan pelatihan.','y','pelatihan');
/*!40000 ALTER TABLE `tb_notif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pegawai`
--

DROP TABLE IF EXISTS `tb_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  KEY `FK_tb_pegawai` (`id_jbtn`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pegawai`
--

LOCK TABLES `tb_pegawai` WRITE;
/*!40000 ALTER TABLE `tb_pegawai` DISABLE KEYS */;
INSERT INTO `tb_pegawai` (`id_pgw`, `id_jbtn`, `nik_pgw`, `no_ktp_pgw`, `npwp_pgw`, `nma_lkp_pgw`, `email_pgw`, `almt_pgw`, `jk_pgw`, `stat_pgw`, `lev_usr_pgw`, `uname_pgw`, `pass_pgw`, `photo_pgw`, `tmp_lhr_pgw`, `tgl_lhr_pgw`, `hp_pgw`, `telp_pgw`, `gol_drh_pgw`, `nma_psg_pgw`, `pc_ktp_pgw`, `stat_akt_pgw`) VALUES (1,3,'13006','3217041907760004','681442927421000','Ahmad Haris Mufti','harisftp@gmail.com','Grand Kolmas Village Kav. 7\nJl. Kolonel Masturi KM 6,5 Kp. Jambudipa RT. 04/RW. 03 Desa Jambudipa Kec. Cisarua Kab. Bandung Barat 40551','L','menikah','admin','haris','d2ba025e61ccc275fcb8c40a805b4728',NULL,'Bandung','1976-07-19','081322749241','','O','Cucu Sumiati Muhtar','images/ktp/13012015092840.jpg','Y'),(2,5,'13003','3277021709790013','438763848422000','Abdul Rohim','Abunezbu@gmail.com','Kp. Ciputri Kel. Cimindi \nRT. 07/ RW. 05 Kec. Cimahi Tengah Kota Cimahi','L','menikah','special user','Abro','c9a25548240aa929ee771af4774229cd',NULL,'Bandung','1979-09-17','087824032274','081321635474','O','Siti Maryam Nursyamdiantini ','images/ktp/14012015110610.jpg','Y'),(3,16,'13020','3273181102820004','681442984423000','Adi Kusnaedi','adikusna@gmail.com','Jl. Cigadung Pesantren No. 55 RT. 05/ RW. 06 Kel. Cigadung Kec. Cibeunying Kaler Dago Bandung 40191','L','menikah','user','Adi','e10adc3949ba59abbe56e057f20f883e',NULL,'Bandung','1982-02-11','02291510407','02293394522','AB','Silvia','images/ktp/14012015110720.jpg','Y'),(4,24,'13014','3205173007820002','000000000000000','Andri Permata Surya','andrips@yahoo.com','Jl. Julang No. 20 RT. 03/ RW. 02 kel. Tanah Sareal Kec. Tanah Sareal Kota Bogor','L','menikah','user','Andri','c602f74e2b18d52d9e29564214e37cc0',NULL,'Bandung','1982-07-30','087770810797','','A','Santy Susanty','images/ktp/14012015110757.jpg','Y'),(5,27,'13024','3273011908660000','000000000000001','Asep Suparman','asep_lp2es@yahoo.com','Jl. Sindang Sirna II RT. 07/ RW. 06 Karang Setra Bandung','L','menikah','user','Asep','3d08ae1636a9515c5492a8914dd4a7fd',NULL,'Bandung','1966-08-19','081910103573','','A','Neng Marlina','images/ktp/16012015104536.jpg','Y'),(6,19,'14029','3206351007910001','000000000000002','Asep Tatang Mukti Ali','aseptatangmuktiali@gmail.com','Kp. Gandok RT. 02/ RW. 03 Desa Karangresik Kec. Jamanis Kab. Tasikmalaya 46175','L','belum menikah','user','Ali','b26a19f2c290e0987d8aa229a240b33c',NULL,'Tasikmalaya','1991-07-10','089604556853','','B','','images/ktp/16012015105018.jpg','Y'),(7,8,'13007','3217061307810009','264409384421000','Budi Permana','budi.permana@lp2es.com','Jl. Cilame RT. 02/ RW. 06 No. 40 Kab. Bandung Barat','L','menikah','user','Budi','e10adc3949ba59abbe56e057f20f883e',NULL,'Bogor','1981-07-13','085659645545','02270622953','O','Mila Cahya Kusumawati','images/ktp/16012015105059.jpg','Y'),(8,15,'13009','3278022806800005','000000000000004','Dadang Hermansyah','hermansyah_dadang@yahoo.com','Jl. Dr. Sukarjo 95A Tasikmalaya','L','belum menikah','user','Dadang','6f5862e74cf24dd11c69ab33044ca570',NULL,'Tasikmalaya','1980-06-28','085223010031','','B','','images/ktp/16012015105133.jpg','Y'),(9,4,'13002','3277032212800017','249817768421000','Doddy Ekapriades Topan','doddy.et@gmail.com','Jl. Nusa Indah II BLK no.9 BLOK C komp. Cihanjuang Indah RT.04 RW.17 Kelurahan Cibabat, Kecamatan Cimahi Utara Kota Cimahi 40513','L','menikah','special user','Doddy','f85c093a3df2857627f5992e88119e36',NULL,'Bontang','1980-12-22','0818642563','0226643812','O','Dewi Puspita','images/ktp/16012015105209.jpg','Y'),(10,17,'13028','3273076706900001','000000000000005','Evi Heryati','epi.kibum@yahoo.com','Jl. Sukagalih Gg. Mandalika RT. 05/ RW. 06 Kel. Cipedes Kec. Sukajadi Kota Bandung','P','belum menikah','user','Evi','d2ba025e61ccc275fcb8c40a805b4728',NULL,'Bandung','1990-10-27','083820806539','','O','','images/ktp/16012015105235.jpg','Y'),(11,12,'13011','3277033012820006','258086909428000','Faozan Rahman','faozan.R@gmail.com','Jl. Cihanjuang No. 41 RT. 01/ RW. 19 Kel. Cibabat Kec. Cimahi Utara Kota Cimahi','L','menikah','user','Ozan','1c3e099b52bf7475f1996f46d85574ba',NULL,'Bandung','1982-12-30','081321250748','','A','Selyani Fitria Sumantri','images/ktp/16012015105412.jpg','Y'),(12,25,'14027','3277033101770007','248576555421000','Farid Ma\'ruf','faridmrf@yahoo.com','Komp. Griya Pasantren Indah Blok E/13 Cimahi 40513','L','menikah','user','Farid','944f14e73ef613dde91caa20c5a3316b',NULL,'Indramayu','1977-01-31','08122082335','6632268','O','Dwi Syaifina Fibriyani','images/ktp/16012015105455.jpg','Y'),(13,18,'13018','3273024703850008','248982316445000','Ida Widiawati','revalieda_2524@yahoo.com','Jl. Bangbayang Cihaur No. 58/157C RT. 001/ RW. 008 Desa Dago Kec. Coblong Kota Bandung','P','menikah','user','Ida','0179ad2b99c6f09a96b0397b05ff7f67',NULL,'Bandung','1985-03-07','085220082237','','O','Hendy Sumadi','images/ktp/16012015105523.jpg','Y'),(14,23,'13022','3204331801780001','882112014444000','M. Kholil Wildan','kholilwildan@gmail.com','Kp. Paninggalan RT. 03/ RW. 07 Desa Biru Kec. Majalaya Kab. Bandung','L','menikah','user','Kholil','d937d71c881914b026a2b9b7b41bf7c0',NULL,'Brebes','1978-01-18','081312329552','','B','Aan Andrianifah','images/ktp/16012015105552.jpg','Y'),(15,14,'13008','3204003112810000','000000000000008','Marhaban Syaiful Hamid','marhabansh@gmail.com','Perum. Hegarmanah Indah RT. 01/ RW. 10 Desa Hegarmanah','L','menikah','user','Aban','7af5249884b72b5d55f832991659024e',NULL,'Bandung','1981-12-31','08121940345','','O','Iseu Siti Aisyah','images/ktp/16012015105628.jpg','Y'),(16,24,'13023','3273010103800001','000000000000009','Nano Taryono','ntar.dt@gmail.com','Jl. Sarimanah I No. 167 Sarijadi Bandung','L','menikah','user','Nano','997bb80b933192b7173c7a425515c1cf',NULL,'Bandung','1980-03-01','087822845194','0222016392','O','Rifka Riyani Nur','images/ktp/16012015105723.jpg','Y'),(17,18,'13017','3203124808810000','681442992406000','Nenah Susanti Musthofa','nenahsusantidt@gmail.com','Jl. Gegerkalong Girang Gg. Gegersuni III No. 74B RT. 07/ RW. 03 Bandung','P','menikah','user','Nenah','e70ac355d13ce7fda12e764a0a3ebbf5',NULL,'Cianjur','1982-04-05','081572010452','','O','Denden Muhamad','images/ktp/16012015105759.jpg','Y'),(18,18,'13021','3277025910800018','000000000000011','Onni Rohaeni','onni.rohaeni@gmail.com','Jl. H. Basuki III No. 98 RT. 004/ RW. 010 Kel. Bonong Kec. Batununggal Bandung','P','menikah','user','Onni','aa68eab2d4728b498996af5fe8036e10',NULL,'Bandung','1980-10-19','081221175656','','O','Yandi Ginanjar','images/ktp/16012015105831.jpg','Y'),(19,18,'13026','1050045209825001','000000000000012','Ratnawati Karim','tehratnawatikarim@gmail.com','Jl. Rajawali Timur No. 108/78 40182','P','belum menikah','user','Ratna','fadb7dbdf3ef3a504cefa73c85f36b84',NULL,'Bandung','1982-09-12','081321527947','','O','','images/ktp/16012015105910.jpg','Y'),(20,10,'13013','0000000000000006','000000000000013','Sukirno','abufirza.100375@gmail.com','Perumnas Cijerah 2 Blok 10/114 RT. 03/ RW. 19 Kel. Melong Cimahi 40534','L','menikah','user','Ukir','623373a2e5a31d803559e67c16627c2b',NULL,'Bandung','1975-03-10','082119307004','','O','','images/ktp/16012015110000.jpg','Y'),(21,7,'13005','3272050905820001','894673649405000','Sulestiono','sulestiono82@gmail.com','Komp. Jayaraksa Jl. Tribrata Blok G No. 6 RT. 03/ RW. 06 Kec. Baros Kotamadya Sukabumi','L','menikah','user','Tio','eea0194f3a0d92fb7fd926dd5a995d4f',NULL,'Sukabumi','1982-05-09','085353530775','','B','Dewi Puspitasari','images/ktp/16012015110033.jpg','Y'),(22,6,'13001','3273020309770000','882112030423000','Tomy Satyagraha','tomysgraha1@gmail.com','Dago Asri I No. B-18 A Rt.006/009 Kel Dago Kec Coblong','L','menikah','special user','Tomy','d2ba025e61ccc275fcb8c40a805b4728',NULL,'Bandung','1977-09-03','081573201977','','B','Irma','images/ktp/16012015110104.jpg','Y'),(23,11,'13010','3217021301790004','894671676421000','Yunus Al-Farisi','yunusdt@gmail.com','Jl. Ciwaruga No. 15 RT. 01/ RW. 06 Kel. Ciwaruga Kec. Parongpong Kab. Bandung Barat','L','menikah','user','Yunus','63577fdc3f01ffdc692fd1da78d1d2d5',NULL,'Tegal','1979-01-13','081322222096','','O','Lia Fauziyah','images/ktp/16012015110148.jpg','Y'),(24,20,'13015','1871130503850005','000000000000014','Zaeni Muslim','zaenimu@gmail.com','Komplek Bukit Rahma Permai Jl. Ganesa XI No. D89 Kel. Cilame Kec. Ngamprah Kab. Bandung Barat','L','menikah','user','Zen','6dcbd6b56db2e7aac6817595e94771a3',NULL,'Bandar Lampung','1985-03-05','081320903936','','B','','images/ktp/16012015110237.jpg','Y');
/*!40000 ALTER TABLE `tb_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pelatihan`
--

DROP TABLE IF EXISTS `tb_pelatihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pelatihan` (
  `id_lth` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `tgl_pjn_lth` date NOT NULL COMMENT 'tanggal pengajuan',
  `nma_pju_lth` varchar(100) NOT NULL COMMENT 'nama pengaju pelatihan',
  `nma_lth` varchar(100) NOT NULL COMMENT 'nama pelatihan',
  `waktu_lth_awal` date NOT NULL,
  `waktu_lth_akhir` date NOT NULL,
  `tmp_lth` varchar(100) NOT NULL COMMENT 'tempat pelatihan',
  `stat_lth` enum('N','Y','T') NOT NULL DEFAULT 'N',
  `apprv_lth` varchar(100) DEFAULT NULL,
  `jbt_apprv_lth` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_lth`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pelatihan`
--

LOCK TABLES `tb_pelatihan` WRITE;
/*!40000 ALTER TABLE `tb_pelatihan` DISABLE KEYS */;
INSERT INTO `tb_pelatihan` (`id_lth`, `id_pgw`, `tgl_pjn_lth`, `nma_pju_lth`, `nma_lth`, `waktu_lth_awal`, `waktu_lth_akhir`, `tmp_lth`, `stat_lth`, `apprv_lth`, `jbt_apprv_lth`) VALUES (1,10,'2015-01-16','Evi Heryati','Public Speaking','2015-01-17','2015-01-17','Jalan Lodaya, Bandung','Y','Ahmad Haris Mufti','sekretariat(kepala)');
/*!40000 ALTER TABLE `tb_pelatihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pelatihan_perusahaan`
--

DROP TABLE IF EXISTS `tb_pelatihan_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pelatihan_perusahaan` (
  `id_lth_prs` int(11) NOT NULL AUTO_INCREMENT,
  `periode_lth_prs` date NOT NULL,
  `kpi_lth_prs` float NOT NULL,
  PRIMARY KEY (`id_lth_prs`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pelatihan_perusahaan`
--

LOCK TABLES `tb_pelatihan_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_pelatihan_perusahaan` DISABLE KEYS */;
INSERT INTO `tb_pelatihan_perusahaan` (`id_lth_prs`, `periode_lth_prs`, `kpi_lth_prs`) VALUES (1,'2014-10-01',0),(2,'2014-10-01',0),(3,'2014-10-01',0),(4,'2014-10-01',0),(5,'2014-10-01',0);
/*!40000 ALTER TABLE `tb_pelatihan_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pengalaman_kerja`
--

DROP TABLE IF EXISTS `tb_pengalaman_kerja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pengalaman_kerja` (
  `id_pgl_krj` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `jbtn_pgl_krj` varchar(100) NOT NULL,
  `satuan_pgl_krj` enum('hari','minggu','bulan','tahun') NOT NULL,
  `durasi_pgl_krj` float NOT NULL,
  PRIMARY KEY (`id_pgl_krj`),
  KEY `FK_tb_pengalaman_kerja` (`id_pgw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pengalaman_kerja`
--

LOCK TABLES `tb_pengalaman_kerja` WRITE;
/*!40000 ALTER TABLE `tb_pengalaman_kerja` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pengalaman_kerja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_presensi`
--

DROP TABLE IF EXISTS `tb_presensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  KEY `FK_tb_presensi` (`no_akun_pgw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_presensi`
--

LOCK TABLES `tb_presensi` WRITE;
/*!40000 ALTER TABLE `tb_presensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_presensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_presensi_divisi`
--

DROP TABLE IF EXISTS `tb_presensi_divisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_presensi_divisi` (
  `id_presensi_divisi` int(11) NOT NULL AUTO_INCREMENT,
  `div_jbtn` varchar(50) NOT NULL,
  `awal_periode_presensi_divisi` date NOT NULL,
  `akhir_periode_presensi_divisi` date NOT NULL,
  `alpha_presensi_divisi` float NOT NULL DEFAULT '0',
  `ijin_presensi_divisi` float NOT NULL DEFAULT '0',
  `hadir_presensi_divisi` float NOT NULL DEFAULT '0',
  `sakit_presensi_divisi` float NOT NULL DEFAULT '0',
  `cuti_presensi_divisi` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_presensi_divisi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_presensi_divisi`
--

LOCK TABLES `tb_presensi_divisi` WRITE;
/*!40000 ALTER TABLE `tb_presensi_divisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_presensi_divisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_presensi_pegawai`
--

DROP TABLE IF EXISTS `tb_presensi_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_presensi_pegawai` (
  `id_presensi_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `awal_periode_presensi_pegawai` date NOT NULL,
  `akhir_periode_presensi_pegawai` date NOT NULL,
  `alpha_presensi_pegawai` float NOT NULL DEFAULT '0',
  `ijin_presensi_pegawai` float NOT NULL DEFAULT '0',
  `hadir_presensi_pegawai` float NOT NULL DEFAULT '0',
  `sakit_presensi_pegawai` float NOT NULL DEFAULT '0',
  `cuti_presensi_pegawai` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_presensi_pegawai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_presensi_pegawai`
--

LOCK TABLES `tb_presensi_pegawai` WRITE;
/*!40000 ALTER TABLE `tb_presensi_pegawai` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_presensi_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_presensi_perusahaan`
--

DROP TABLE IF EXISTS `tb_presensi_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_presensi_perusahaan` (
  `id_presensi_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `awal_periode_presensi_perusahaan` date NOT NULL,
  `akhir_periode_presensi_perusahaan` date NOT NULL,
  `alpha_presensi_perusahaan` float NOT NULL DEFAULT '0',
  `sakit_presensi_perusahaan` float NOT NULL DEFAULT '0',
  `hadir_presensi_perusahaan` float NOT NULL DEFAULT '0',
  `ijin_presensi_perusahaan` float NOT NULL DEFAULT '0',
  `cuti_presensi_perusahaan` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_presensi_perusahaan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_presensi_perusahaan`
--

LOCK TABLES `tb_presensi_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_presensi_perusahaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_presensi_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_punishment`
--

DROP TABLE IF EXISTS `tb_punishment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_punishment` (
  `id_pun` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `tgl_pun` date DEFAULT NULL COMMENT 'tanggal pengajuan',
  `jns_pun` enum('SP1','SP2','SP3') NOT NULL COMMENT 'jenis',
  `surat_pun` varchar(30) NOT NULL COMMENT 'surat lampiran',
  `ket_pun` varchar(100) DEFAULT NULL COMMENT 'keterangan',
  PRIMARY KEY (`id_pun`),
  KEY `FK_tb_punishment` (`id_pgw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_punishment`
--

LOCK TABLES `tb_punishment` WRITE;
/*!40000 ALTER TABLE `tb_punishment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_punishment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_rek_bank`
--

DROP TABLE IF EXISTS `tb_rek_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_rek_bank` (
  `id_dtl_bank` int(20) NOT NULL AUTO_INCREMENT,
  `id_bank` int(20) NOT NULL,
  `id_pgw` int(20) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  PRIMARY KEY (`id_dtl_bank`),
  KEY `FK_tb_rek_bank` (`id_bank`),
  KEY `FK_tb_rek_bank2` (`id_pgw`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_rek_bank`
--

LOCK TABLES `tb_rek_bank` WRITE;
/*!40000 ALTER TABLE `tb_rek_bank` DISABLE KEYS */;
INSERT INTO `tb_rek_bank` (`id_dtl_bank`, `id_bank`, `id_pgw`, `no_rek`) VALUES (1,1,1,'1140004977'),(2,1,2,'1709197948'),(3,1,3,'933945227'),(4,1,4,'1140004975'),(5,1,5,'1140005030'),(6,1,6,'1140004973'),(7,1,7,'0000000000'),(8,1,8,'1140002887'),(9,4,9,'2332496493'),(10,1,10,'1140004974'),(11,1,11,'1010002294'),(12,1,12,'0291457087'),(13,1,13,'0349580937'),(14,1,14,'1140004972'),(15,1,15,'1140001755'),(16,1,16,'1140000421'),(17,1,17,'0351589448'),(18,1,18,'0349437591'),(19,1,19,'8258017717'),(20,1,20,'1140004733'),(21,1,21,'1140001502'),(22,1,22,'1140002570'),(23,1,23,'9225146920'),(24,1,24,'1140004976');
/*!40000 ALTER TABLE `tb_rek_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_reward`
--

DROP TABLE IF EXISTS `tb_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_reward` (
  `id_reward` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `tgl_reward` date NOT NULL,
  `jns_reward` enum('teladan','khusus') NOT NULL,
  `ket_reward` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_reward`),
  KEY `FK_tb_reward` (`id_pgw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_reward`
--

LOCK TABLES `tb_reward` WRITE;
/*!40000 ALTER TABLE `tb_reward` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sim`
--

DROP TABLE IF EXISTS `tb_sim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_sim` (
  `id_sim` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `jns_sim` enum('A','B','B1','B2','C') NOT NULL,
  `no_sim` varchar(50) NOT NULL,
  `pc_sim` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sim`),
  KEY `FK_tb_sim` (`id_pgw`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sim`
--

LOCK TABLES `tb_sim` WRITE;
/*!40000 ALTER TABLE `tb_sim` DISABLE KEYS */;
INSERT INTO `tb_sim` (`id_sim`, `id_pgw`, `jns_sim`, `no_sim`, `pc_sim`) VALUES (1,1,'C','760713313087',NULL),(2,9,'C','801213312207',NULL),(3,4,'C','820713241201',NULL),(4,11,'C','821213312198',NULL),(5,12,'C','770113315728',NULL),(6,21,'C','820513260556',NULL),(7,23,'C','790113312208',NULL);
/*!40000 ALTER TABLE `tb_sim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sppd`
--

DROP TABLE IF EXISTS `tb_sppd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_sppd` (
  `id_sppd` int(11) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(11) NOT NULL,
  `tgl_pju_sppd` date NOT NULL COMMENT 'tanggal pengajuan',
  `tgl_plk_sppd` date NOT NULL COMMENT 'tanggal pelaksanaan sppsd',
  `nma_kga_sppd` varchar(100) NOT NULL COMMENT 'nama tamu yg dikunjungi',
  `posisi_kga_sppd` varchar(50) DEFAULT NULL COMMENT 'posisi atau jabatan tamu',
  `jns_tmp_sppd` enum('perusahaan','instansi','organisasi','lembaga','sekolah','kampus') NOT NULL COMMENT 'jenis tempat dituju',
  `nma_tmp_sppd` varchar(50) NOT NULL COMMENT 'nama tempat ',
  `almt_tmp_sppd` text NOT NULL,
  `bdg_phn_sppd` varchar(50) DEFAULT NULL COMMENT 'bidang perusahaan / instansi',
  `tlp_kga_sppd` varchar(15) NOT NULL COMMENT 'telpon tamu',
  `agenda_sppd` text NOT NULL,
  `apprv_sppd` enum('N','Y','T') DEFAULT 'N' COMMENT 'status dikonfirmasi',
  `tgl_apprv_sppd` date DEFAULT NULL COMMENT 'tanggal dikonfirmasi ',
  `nma_apprv_sppd` varchar(100) DEFAULT NULL COMMENT 'nama yang konfirmasi',
  `jbtn_apprv_sppd` varchar(100) DEFAULT NULL COMMENT 'jabatan yang konfirmasi',
  `stat_kunj` enum('N','Y','T') NOT NULL DEFAULT 'N',
  `lampiran` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_sppd`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sppd`
--

LOCK TABLES `tb_sppd` WRITE;
/*!40000 ALTER TABLE `tb_sppd` DISABLE KEYS */;
INSERT INTO `tb_sppd` (`id_sppd`, `id_pgw`, `tgl_pju_sppd`, `tgl_plk_sppd`, `nma_kga_sppd`, `posisi_kga_sppd`, `jns_tmp_sppd`, `nma_tmp_sppd`, `almt_tmp_sppd`, `bdg_phn_sppd`, `tlp_kga_sppd`, `agenda_sppd`, `apprv_sppd`, `tgl_apprv_sppd`, `nma_apprv_sppd`, `jbtn_apprv_sppd`, `stat_kunj`, `lampiran`) VALUES (1,3,'2014-11-07','2014-11-08','Bambang','Direktur Utama','instansi','PT.OzanSoft','Jalan TItiran No.2 Bandung','Software House','085752225126','Rapat Koordinasi Proyek S.I SDM DTI','Y','2014-11-10','Ahmad Haris Mufti','sekretariat(kepala)','N',''),(2,3,'2014-12-19','2014-12-20','Paudji','Direktur','instansi','PT. Ozansoft','Jl. Titiran','Telekomunikasi','0223212323','Meeting','Y','2014-12-19','Ahmad Haris Mufti','sekretariat(kepala)','N',NULL),(3,10,'2015-01-16','2015-01-17','Ahmad Paudji','Direktur','instansi','PT.Ozansoft','Jalan Titiran No.2 Bandung','Teknologi Informasi','085752225126','Melakukan negoisi harga pembangunan software','Y','2015-01-19','Ahmad Haris Mufti','sekretariat(kepala)','N',NULL);
/*!40000 ALTER TABLE `tb_sppd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tanggal_libur`
--

DROP TABLE IF EXISTS `tb_tanggal_libur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tanggal_libur` (
  `id_libur` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_libur` date NOT NULL,
  `nama_libur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_libur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tanggal_libur`
--

LOCK TABLES `tb_tanggal_libur` WRITE;
/*!40000 ALTER TABLE `tb_tanggal_libur` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_tanggal_libur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usaha_aktifitas`
--

DROP TABLE IF EXISTS `tb_usaha_aktifitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_usaha_aktifitas` (
  `id_ush_akt` int(20) NOT NULL AUTO_INCREMENT,
  `id_pgw` int(20) NOT NULL,
  `jns_ush_akt` enum('peternakan','produksi','properti','agensi','politik','ormas') NOT NULL,
  `nma_ush_akt` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ush_akt`),
  KEY `FK_tb_usaha_aktifitas` (`id_pgw`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usaha_aktifitas`
--

LOCK TABLES `tb_usaha_aktifitas` WRITE;
/*!40000 ALTER TABLE `tb_usaha_aktifitas` DISABLE KEYS */;
INSERT INTO `tb_usaha_aktifitas` (`id_ush_akt`, `id_pgw`, `jns_ush_akt`, `nma_ush_akt`) VALUES (1,1,'agensi','Umroh dan Haji Reguler & Plus'),(2,1,'agensi','Hormon Tanaman Tani Unggul'),(3,1,'agensi','Jamur Kuping');
/*!40000 ALTER TABLE `tb_usaha_aktifitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ozantcom_dti'
--

--
-- Dumping routines for database 'ozantcom_dti'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-27 17:59:09
