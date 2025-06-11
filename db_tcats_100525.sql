/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ukomggf` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ukomggf`;

/*Table structure for table `about` */

DROP TABLE IF EXISTS `about`;

CREATE TABLE `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul` varchar(100) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `about` */

insert  into `about`(`id`,`modul`,`url_id`,`title_id`,`content_id`,`url_en`,`title_en`,`content_en`,`urutan`,`publish`) values 
(1,'','welcome-to','Welcome','<p>okelah</p>','mimpi','Mimpi','<p>kalau begitu</p>\r\n<p>&nbsp;</p>',4,0),
(8,'','mengapa','mengapa lagi','<p>jadinya</p>','begini','begini','<p>program salbut</p>',1,1),
(2,'','about-me-keren','About me keren','<p><img src=\"http://localhost/newmvc/userfiles/satuinspirasi.com/file/media/source/BDE 5015.jpg\" alt=\"BDE 5015\" width=\"437\" height=\"207\" /> s</p>\r\n<p><span style=\"font-size: 12pt;\">MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET</span></p>\r\n<p><span style=\"font-size: 12pt;\">MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET</span></p>\r\n<p><span style=\"font-size: 12pt;\">MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET</span></p>\r\n<p><span style=\"font-size: 12pt;\">MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET</span></p>\r\n<table style=\"height: 277px;\" width=\"496\">\r\n<tbody>\r\n<tr>\r\n<td>MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;</td>\r\n<td>MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;MENGAPA BEGINI YA AKU KHAN GAK TAU BISA BEGINI LOH INI UDAH KEREN BANGET&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<table style=\"height: 21px;\" width=\"492\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p>KEREN BANGET</p>\r\n<p>LAGI KEREN</p>\r\n</td>\r\n<td>kERE BANGET COY OKEH LAH</td>\r\n</tr>\r\n</tbody>\r\n</table>','about-me-keren','','',3,0),
(3,'','privacynya','Privacynya','<p>Kontent privacy</p>','privacynya','','',2,1);

/*Table structure for table `app_category` */

DROP TABLE IF EXISTS `app_category`;

CREATE TABLE `app_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `grup` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `publish` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_category` */

insert  into `app_category`(`id`,`title`,`grup`,`created_date`,`created_by`,`modified_date`,`modified_by`,`publish`) values 
(1,'Pertanian 1','KEDOKTERAN','2022-03-29 20:21:01',1,'2024-06-06 09:55:30',6,0),
(2,'Pertanian 2','KEDOKTERAN','2022-03-29 20:21:14',1,'2024-06-06 09:55:26',6,0),
(3,'Pertanian 3','FARMASI','2022-03-29 20:21:43',1,'2022-08-19 07:40:33',1,0),
(4,'Pertanian 4','FARMASI','2022-03-29 20:21:55',1,'2024-07-06 09:33:20',6,1),
(6,'PROFESI NERS','KEPERAWATAN','2022-03-29 20:22:36',1,'2022-03-29 20:23:05',1,0),
(7,'S1 KEBIDANAN','KEBIDANAN','2022-03-29 20:23:37',1,'0000-00-00 00:00:00',0,0),
(8,'PROFESI BIDAN','KEBIDANAN','2022-03-29 20:23:51',1,'0000-00-00 00:00:00',0,0),
(9,'S1 KESMAS','KESEHATAN MASYARAKAT','2022-03-29 20:24:09',1,'0000-00-00 00:00:00',0,0),
(10,'KELAS 10 FARMASI','SMA SEDERAJAT','2022-03-29 20:24:38',1,'2022-03-29 20:29:27',1,0),
(11,'SMK XI FARMASI','SMA SEDERAJAT','2022-03-29 20:24:57',1,'0000-00-00 00:00:00',0,0),
(12,'SMA XII FARMASI','SMA SEDERAJAT','2022-03-29 20:25:08',1,'0000-00-00 00:00:00',0,0),
(13,'SMA X IPA','SMA SEDERAJAT','2022-03-29 20:25:21',1,'0000-00-00 00:00:00',0,0),
(15,'SMA XII IPA','SMA SEDERAJAT','2022-03-29 20:25:38',1,'0000-00-00 00:00:00',0,0),
(25,'FLUTTER','SMA SEDERAJAT','2024-06-04 10:26:30',1,'2024-06-04 10:43:39',1,0),
(26,'KELAS INTENSIF','FARMASI','2024-06-10 19:21:21',6,'2024-06-14 14:37:58',6,1),
(27,'Masuk Apoteker','FARMASI','2024-06-12 21:35:11',6,'0000-00-00 00:00:00',0,1),
(28,'BUKU PREDIKSI UKMPPAI 2024','FARMASI','2024-06-18 21:35:59',6,'0000-00-00 00:00:00',0,1),
(29,'KISI-KISI UKMPPAI AGUSTUS 2024','FARMASI','2024-08-01 21:13:14',6,'0000-00-00 00:00:00',0,1);

/*Table structure for table `app_competency_excel` */

DROP TABLE IF EXISTS `app_competency_excel`;

CREATE TABLE `app_competency_excel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `excel_log_id` int(11) NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `course_sub_id` int(11) NOT NULL,
  `kompetensi` varchar(255) NOT NULL,
  `kkm_total` int(11) NOT NULL,
  `jadwal` date NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `excel_log_id` (`excel_log_id`),
  CONSTRAINT `app_competency_excel_ibfk_1` FOREIGN KEY (`excel_log_id`) REFERENCES `app_competency_excel_log` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_competency_excel` */

insert  into `app_competency_excel`(`id`,`excel_log_id`,`indeks`,`nama`,`course_sub_id`,`kompetensi`,`kkm_total`,`jadwal`,`created_at`,`created_by`) values 
(1,1,'1807210206940003','David Andi S',9,'Irrigation Fresh Pineapple Plantation',70,'2024-02-26','2025-03-20 11:50:28',240),
(2,1,'1807211410890002','Kabul Budiawan',9,'Irrigation Fresh Pineapple Plantation',70,'2024-02-26','2025-03-20 11:50:28',240);

/*Table structure for table `app_competency_excel_detail` */

DROP TABLE IF EXISTS `app_competency_excel_detail`;

CREATE TABLE `app_competency_excel_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `competency_excel_id` int(11) NOT NULL,
  `kompetensi_indeks` int(11) NOT NULL,
  `kompetensi` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL,
  `kkm` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competency_excel_id` (`competency_excel_id`),
  CONSTRAINT `app_competency_excel_detail_ibfk_1` FOREIGN KEY (`competency_excel_id`) REFERENCES `app_competency_excel` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_competency_excel_detail` */

insert  into `app_competency_excel_detail`(`id`,`competency_excel_id`,`kompetensi_indeks`,`kompetensi`,`nilai`,`kkm`) values 
(1,1,0,'Set-up Engine dan Pompa Sumber Air',80,70),
(2,1,1,'Instalasi Pipa Irigasi',100,70),
(3,1,2,'Instalasi Irigator dan Gun Sprinkler',80,70),
(4,1,3,'Mengoperasikan Engine dan Pompa Irigasi',100,70),
(5,1,4,'Mengoperasikan Unit Irrigator dan Gun Sprinkle',80,70),
(6,1,5,'Melakukan Pengecekan Hasil Kerja Secara Berkala',40,70),
(7,1,6,'Melakukan 5R pada Peralatan dan Engine Irigasi',80,70),
(8,1,7,'Mematikan Pompa Engine',80,70),
(9,1,8,'Troubleshooting',60,70),
(10,1,9,'Laporan HasilKerjaIrigasi',100,70),
(11,2,0,'Set-up Engine dan Pompa Sumber Air',80,70),
(12,2,1,'Instalasi Pipa Irigasi',60,70),
(13,2,2,'Instalasi Irigator dan Gun Sprinkler',60,70),
(14,2,3,'Mengoperasikan Engine dan Pompa Irigasi',40,70),
(15,2,4,'Mengoperasikan Unit Irrigator dan Gun Sprinkle',80,70),
(16,2,5,'Melakukan Pengecekan Hasil Kerja Secara Berkala',80,70),
(17,2,6,'Melakukan 5R pada Peralatan dan Engine Irigasi',40,70),
(18,2,7,'Mematikan Pompa Engine',60,70),
(19,2,8,'Troubleshooting',60,70),
(20,2,9,'Laporan HasilKerjaIrigasi',80,70);

/*Table structure for table `app_competency_excel_log` */

DROP TABLE IF EXISTS `app_competency_excel_log`;

CREATE TABLE `app_competency_excel_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_hash` varchar(200) NOT NULL,
  `course_sub_id` int(11) NOT NULL,
  `kompetensi` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_competency_excel_log` */

insert  into `app_competency_excel_log`(`id`,`file_hash`,`course_sub_id`,`kompetensi`,`created_at`,`created_by`) values 
(1,'80adb3096e74bf107a110eb70d013d17',9,'Irrigation Fresh Pineapple Plantation','2025-03-20 11:50:28',240);

/*Table structure for table `app_course` */

DROP TABLE IF EXISTS `app_course`;

CREATE TABLE `app_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `publish` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_course` */

insert  into `app_course`(`id`,`title`,`thumbnail`,`category_id`,`content`,`image`,`created_date`,`created_by`,`modified_date`,`modified_by`,`publish`) values 
(13,'Water Management','67da299ae435a.jpg',0,'','','2025-03-19 09:15:17',240,'2025-03-19 09:19:06',240,0);

/*Table structure for table `app_course_material` */

DROP TABLE IF EXISTS `app_course_material`;

CREATE TABLE `app_course_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `course_sub_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(10) NOT NULL COMMENT 'video;text;quiz',
  `quiz_id` int(11) NOT NULL,
  `quiz_type` varchar(13) NOT NULL COMMENT 'prestest, posttest',
  `video_name` varchar(100) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `video_embed_url` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_free` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `course_sub_id` (`course_sub_id`),
  CONSTRAINT `app_course_material_ibfk_2` FOREIGN KEY (`course_sub_id`) REFERENCES `app_course_sub` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_course_material` */

insert  into `app_course_material`(`id`,`title`,`course_sub_id`,`content`,`type`,`quiz_id`,`quiz_type`,`video_name`,`video_url`,`video_embed_url`,`created_date`,`created_by`,`modified_date`,`modified_by`,`is_free`) values 
(204,'',3,'','quiz',2,'pretest','','','','2024-09-23 09:10:02',0,'2025-01-10 13:27:22',0,1),
(205,'',3,'','quiz',2,'posttest','','','','2024-09-23 09:10:02',0,'2025-01-10 13:27:22',0,1),
(206,'',4,'','quiz',2,'pretest','','','','2024-09-30 05:05:50',0,'2025-01-10 13:27:29',0,1),
(207,'',4,'','quiz',2,'posttest','','','','2024-09-30 05:05:50',0,'2025-01-10 13:27:29',0,1),
(210,'',6,'','quiz',2,'pretest','','','','2024-11-27 09:38:56',0,'2025-01-10 13:26:19',0,1),
(211,'',6,'','quiz',2,'posttest','','','','2024-11-27 09:38:56',0,'2025-01-10 13:26:19',0,1),
(212,'',7,'','quiz',2,'pretest','','','','2024-11-28 15:05:45',0,'2025-01-10 13:27:07',0,1),
(213,'',7,'','quiz',2,'posttest','','','','2024-11-28 15:05:45',0,'2025-01-10 13:27:07',0,1),
(214,'',8,'','quiz',2,'pretest','','','','2025-01-10 08:27:07',0,'2025-01-10 09:47:38',0,1),
(215,'',8,'','quiz',2,'posttest','','','','2025-01-10 08:27:07',0,'2025-01-10 09:47:38',0,1),
(218,'',9,'','quiz',3,'pretest','','','','2025-03-19 09:47:32',0,'2025-03-20 11:58:57',0,1),
(219,'',9,'','quiz',3,'posttest','','','','2025-03-19 09:47:32',0,'2025-03-20 11:58:57',0,1),
(220,'',11,'','quiz',4,'pretest','','','','2025-03-19 13:18:23',0,'2025-03-20 11:58:41',0,1),
(221,'',11,'','quiz',4,'posttest','','','','2025-03-19 13:18:23',0,'2025-03-20 11:58:41',0,1),
(222,'',12,'','quiz',3,'pretest','','','','2025-03-19 13:44:31',0,'2025-03-20 11:59:06',0,1),
(223,'',12,'','quiz',3,'posttest','','','','2025-03-19 13:44:31',0,'2025-03-20 11:59:06',0,1);

/*Table structure for table `app_course_sub` */

DROP TABLE IF EXISTS `app_course_sub`;

CREATE TABLE `app_course_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `allow_class` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_free` int(11) NOT NULL DEFAULT 0,
  `publish` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_course_sub` */

insert  into `app_course_sub`(`id`,`title`,`image`,`course_id`,`content`,`allow_class`,`created_date`,`created_by`,`modified_date`,`modified_by`,`is_free`,`publish`) values 
(3,'Program Uji Kompetensi  Irigasi Tahap 1','66f3baec6116d.png',3,'<p><br />Program Uji Kompetensi Irigasi untuk Pelaksana Plantation Komoditas Processed Pineapple -<br />Target Peserta:</p>\r\n<ol>\r\n<li>Operator Engine Irrigator</li>\r\n<li>Operator Irrigator</li>\r\n</ol>\r\n<p>Unit Kompetensi yang akan dibahas adalah:</p>\r\n<ul>\r\n<li>Setup Engine dan Pompa Sumber Air</li>\r\n<li>Instalasi Pipa Irigasi</li>\r\n<li>Instalasi Irrigator dan Gun Sprinker</li>\r\n<li>Mengoperasikan Engine dan Pompa Irigasi</li>\r\n<li>Mengoperasikan Unit Irrigator dan Gun Sprinkler</li>\r\n<li>Melakukan pengujian hasil kerja secara berkala</li>\r\n<li>Melakukan 5R pada Peralatan dan Engine Irigasi</li>\r\n<li>Mematikan Pompa Engine dan Trouble Shooting</li>\r\n<li>Pelaporan Hasil Kerja Irigasi</li>\r\n</ul>\r\n<p><br />Metode Pengembangan</p>\r\n<ul>\r\n<li>Pelatihan</li>\r\n<li>Assesment Kompetensi<br /><br /></li>\r\n</ul>\r\n<p>Waktu</p>\r\n<ul>\r\n<li>Pengembangan 2 x 8 Jam (2 Hari Kerja Efektif)</li>\r\n</ul>','','2022-05-14 21:46:38',1,'2025-01-10 13:27:22',1,1,1),
(4,'Program Uji Kompetensi  Irigasi Tahap 2','66f9cdbb6c0b7.png',3,'<p><br />Program Uji Kompetensi Irigasi untuk Pelaksana Plantation Komoditas Processed Pineapple -<br />Target Peserta:</p>\r\n<ol>\r\n<li>Operator Engine Irrigator</li>\r\n<li>Operator Irrigator</li>\r\n</ol>\r\n<p>Unit Kompetensi yang akan dibahas adalah:</p>\r\n<ul>\r\n<li>Setup Engine dan Pompa Sumber Air</li>\r\n<li>Instalasi Pipa Irigasi</li>\r\n<li>Instalasi Irrigator dan Gun Sprinker</li>\r\n<li>Mengoperasikan Engine dan Pompa Irigasi</li>\r\n<li>Mengoperasikan Unit Irrigator dan Gun Sprinkler</li>\r\n<li>Melakukan pengujian hasil kerja secara berkala</li>\r\n<li>Melakukan 5R pada Peralatan dan Engine Irigasi</li>\r\n<li>Mematikan Pompa Engine dan Trouble Shooting</li>\r\n<li>Pelaporan Hasil Kerja Irigasi</li>\r\n</ul>\r\n<p><br />Metode Pengembangan</p>\r\n<ul>\r\n<li>Pelatihan</li>\r\n<li>Assesment Kompetensi<br /><br /></li>\r\n</ul>\r\n<p>Waktu</p>\r\n<ul>\r\n<li>Pengembangan 2 x 8 Jam (2 Hari Kerja Efektif)</li>\r\n</ul>','','2024-09-30 04:59:23',1,'2025-01-10 13:27:29',1,0,1),
(6,'aaaaa','6746864048fce.png',5,'<p>asasdfasdfds</p>','','2024-11-27 09:38:56',1,'2025-01-10 13:26:19',1,0,1),
(7,'babang tampang','67482458b2fb3.png',12,'<p>aleka</p>','','2024-11-28 15:05:44',1,'2025-01-10 13:27:07',1,0,1),
(8,'Test AJa Apa Mereka>','67808a4a5a6b0.png',6,'<p>isinya ya test aja</p>','','2025-01-10 08:27:07',240,'2025-01-10 09:47:38',1,0,1),
(9,'Irrigation Fresh Pineapple Plantation','67dba0919348e.jpg',13,'<p>Kompetensi <strong data-start=\"15\" data-end=\"29\">Irrigation</strong> mencakup keterampilan dalam menyiapkan dan mengoperasikan sistem irigasi secara efektif. Kompetensi ini meliputi pemasangan mesin dan pompa air, instalasi pipa serta irigator, pengoperasian unit irigasi, pengecekan berkala, penerapan 5R, pemadaman sistem, troubleshooting, dan pelaporan hasil kerja untuk memastikan efisiensi serta keberlanjutan irigasi.</p>','','2025-03-19 09:21:24',240,'2025-03-20 11:58:57',240,0,1),
(11,'Irrigation Banana Plantation','67dba0814e45c.jpg',13,'<p>Kompetensi <strong data-start=\"15\" data-end=\"29\">Irrigation</strong> mencakup keterampilan dalam menyiapkan dan mengoperasikan sistem irigasi secara efektif. Kompetensi ini meliputi pemasangan mesin dan pompa air, instalasi pipa serta irigator, pengoperasian unit irigasi, pengecekan berkala, penerapan 5R, pemadaman sistem, troubleshooting, dan pelaporan hasil kerja untuk memastikan efisiensi serta keberlanjutan irigasi.</p>','','2025-03-19 13:18:23',240,'2025-03-20 11:58:41',240,0,1),
(12,'Irrigation Processed Pineapple Plantation','67dba09acb82e.jpg',13,'<p>Kompetensi <strong data-start=\"15\" data-end=\"29\">Irrigation</strong> mencakup keterampilan dalam menyiapkan dan mengoperasikan sistem irigasi secara efektif. Kompetensi ini meliputi pemasangan mesin dan pompa air, instalasi pipa serta irigator, pengoperasian unit irigasi, pengecekan berkala, penerapan 5R, pemadaman sistem, troubleshooting, dan pelaporan hasil kerja untuk memastikan efisiensi serta keberlanjutan irigasi.</p>','','2025-03-19 13:44:31',240,'2025-03-20 11:59:06',240,0,1);

/*Table structure for table `app_decoration` */

DROP TABLE IF EXISTS `app_decoration`;

CREATE TABLE `app_decoration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `basename` varchar(20) NOT NULL,
  `extension` varchar(4) NOT NULL,
  `namatampilan` varchar(20) NOT NULL,
  `maxdimension` varchar(20) NOT NULL,
  `maxfilesize` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `caption` text NOT NULL,
  `usecaption` int(11) NOT NULL COMMENT '1: Title saja,2:Title + Ket',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_decoration` */

insert  into `app_decoration`(`id`,`type`,`basename`,`extension`,`namatampilan`,`maxdimension`,`maxfilesize`,`urutan`,`caption`,`usecaption`) values 
(1,'logo','logo','jpeg','Logo','max;300;300',5000000,1,'',0),
(9,'slide','slide1','jpg','Slide 1','max;400;200',5000000,1,'https://quizroom.id/a',0),
(10,'slide','slide2','jpg','Slide 2','max;400;200',5000000,1,'https://websuka.com',0),
(11,'slide','slide3','jpg','Slide 3','max;400;200',5000000,1,'https://google.com',0);

/*Table structure for table `app_firebase_auth` */

DROP TABLE IF EXISTS `app_firebase_auth`;

CREATE TABLE `app_firebase_auth` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `picture` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `app_firebase_auth` */

insert  into `app_firebase_auth`(`id`,`picture`,`name`,`email`,`provider`,`created_date`,`member_id`) values 
(27,'https://lh3.googleusercontent.com/a-/AFdZucoyGQLShCMXD1fecG_XWzkFhM8dC2VqMd0RfvIVD_c=s96-c','Mohammad Romli','roemly@gmail.com','google.com','2022-09-12 01:01:20',2743),
(28,'https://lh3.googleusercontent.com/a-/AFdZucrsQwkwhhSFIowaspRQAOoQKjFwksmVk5TWnaXg=s96-c','Feri Handika Manurung','handikaferi0@gmail.com','google.com','2022-09-12 21:23:29',0);

/*Table structure for table `app_firebase_token` */

DROP TABLE IF EXISTS `app_firebase_token`;

CREATE TABLE `app_firebase_token` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `platform` varchar(7) NOT NULL COMMENT 'ios/android',
  `last_active` datetime NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `app_firebase_token` */

/*Table structure for table `app_log_payment` */

DROP TABLE IF EXISTS `app_log_payment`;

CREATE TABLE `app_log_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_payment_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `created_date` datetime NOT NULL,
  `action` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `app_log_payment` */

insert  into `app_log_payment`(`id`,`order_payment_id`,`data`,`created_date`,`action`) values 
(104,0,'{\"transaction_time\":\"2022-09-12 01:02:14\",\"transaction_status\":\"pending\",\"transaction_id\":\"13d07178-d0de-4805-bfc7-df770a54c24a\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"f4ef05e9294f4b5e3b176a341810467fe53945b18a13ac0009249d2ff5f4248e417cf5ef342a13f61a14ea9d3867f994741e2cbdbe14dd8b1b2ef55a2364ef34\",\"payment_type\":\"gopay\",\"order_id\":\"65\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-12 01:02:15','notification'),
(105,0,'{\"transaction_time\":\"2022-09-12 01:02:14\",\"transaction_status\":\"settlement\",\"transaction_id\":\"13d07178-d0de-4805-bfc7-df770a54c24a\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"5e960fdbefd4be3d748f5f035c25e4344e79e82923af9abbd7850c96da873826ad2c9ede098048018536c2e58abe10510c4c4ec80038c60ba3f3ff048b7d0732\",\"settlement_time\":\"2022-09-12 01:02:21\",\"payment_type\":\"gopay\",\"order_id\":\"65\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-12 01:02:21','notification'),
(106,0,'{\"transaction_time\":\"2022-09-11 22:49:25\",\"transaction_status\":\"settlement\",\"transaction_id\":\"0f8ca838-03ec-4522-b282-2677c72956d1\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"3441d2d96d43185c983e258166a7f4bf644c257cfac1f9e5ad05c98a04a3b86a5bfc20735f9d0bade3d1168eeff4d289c2ccc16bcc7eb30f2de1a6aa72c06426\",\"settlement_time\":\"2022-09-12 18:52:37\",\"payment_type\":\"credit_card\",\"order_id\":\"57\",\"merchant_id\":\"G882472699\",\"masked_card\":\"48111111-1114\",\"gross_amount\":\"600000.00\",\"fraud_status\":\"accept\",\"eci\":\"05\",\"currency\":\"IDR\",\"channel_response_message\":\"Approved\",\"channel_response_code\":\"00\",\"card_type\":\"credit\",\"bank\":\"mandiri\",\"approval_code\":\"1662911379339\"}','2022-09-12 18:52:44','notification'),
(107,0,'{\"va_numbers\":[{\"va_number\":\"726998749127953345\",\"bank\":\"bri\"}],\"transaction_time\":\"2022-09-12 21:25:50\",\"transaction_status\":\"pending\",\"transaction_id\":\"d02cfec4-902f-4d40-a589-d930b7572d36\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"85264e74e60b6f3fc7a0318b0869076d831d4fd6fdc9c4601aa202ec55c93021b507d2b3d3b06b8a47253dc7226d976d9aab30d4bfc7a5d74fc186b067d73398\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"66\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-12 21:25:51','notification'),
(108,0,'{\"va_numbers\":[{\"va_number\":\"9887269953782834\",\"bank\":\"bni\"}],\"transaction_time\":\"2022-09-12 21:28:41\",\"transaction_status\":\"pending\",\"transaction_id\":\"ff8a5a30-d6f3-48ae-ac92-6506b565e917\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"23695e1116fd9838a6f00a967a3857eb39391a57b282c64f8922a7dadc4e836f4075091d913339ae76ee74a589dc3051bdddd5e635df2be5016711c2cc75a512\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"67\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-12 21:28:42','notification'),
(109,0,'{\"transaction_time\":\"2022-09-12 21:29:57\",\"transaction_status\":\"pending\",\"transaction_id\":\"94f77229-5507-4a46-a25a-f25ac689a91e\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"24f67babc5b2a403629189ff3c7edca71df2a3c4e9a4499404e6d35c31e0a1ff967e98e804a255bdc3ca4e843940ea4e8992b972808dd281ca4465300745de5a\",\"payment_type\":\"shopeepay\",\"order_id\":\"68\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-12 21:29:58','notification'),
(110,0,'{\"transaction_time\":\"2022-09-12 21:30:24\",\"transaction_status\":\"pending\",\"transaction_id\":\"8566a18b-06c6-4b72-bd48-fb1f1cb47362\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"6e9eeecae2656ba1d89d5f5287035bfd65fdd59ef19c39819b3bbb2bf153636969cbfa65c98cee35244d980f6b9fc9ed95acf488061e9237da06c18814ea1ca5\",\"payment_type\":\"gopay\",\"order_id\":\"69\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-12 21:30:25','notification'),
(111,0,'{\"transaction_time\":\"2022-09-12 21:29:57\",\"transaction_status\":\"expire\",\"transaction_id\":\"94f77229-5507-4a46-a25a-f25ac689a91e\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"f317d94760eab738ae0dfefa403d4a08a2029d9c77de85503c25e6d283efb9014d769789b6dac88580405b6724738b73376d55a9b0b4e867d81fa7ff5a430575\",\"payment_type\":\"shopeepay\",\"order_id\":\"68\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-12 21:35:49','notification'),
(112,0,'{\"transaction_time\":\"2022-09-12 21:30:24\",\"transaction_status\":\"expire\",\"transaction_id\":\"8566a18b-06c6-4b72-bd48-fb1f1cb47362\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"1bedb6c6dd2eaccb56890337f80813711cc44290a2610b589de6beabb250057d2e83640193fcf034e16f596dd8be616280a3d5b45608642994d0a0accb8f6ceb\",\"payment_type\":\"gopay\",\"order_id\":\"69\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-12 21:45:47','notification'),
(113,0,'{\"va_numbers\":[{\"va_number\":\"726998749127953345\",\"bank\":\"bri\"}],\"transaction_time\":\"2022-09-12 21:25:50\",\"transaction_status\":\"expire\",\"transaction_id\":\"d02cfec4-902f-4d40-a589-d930b7572d36\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"65b489241d34cde68d8a1f2229c796e102f23e32825e9ec918ddacfec2c230d97a3dec9999cd29d6407948e53d3f8f38961f2c3ff9cd9bbd7a742d4ff8affe2d\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"66\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-13 21:25:53','notification'),
(114,0,'{\"va_numbers\":[{\"va_number\":\"9887269953782834\",\"bank\":\"bni\"}],\"transaction_time\":\"2022-09-12 21:28:41\",\"transaction_status\":\"expire\",\"transaction_id\":\"ff8a5a30-d6f3-48ae-ac92-6506b565e917\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"b88968aa77218e7df76eb2262101cb89c9cae29978677fa1c0ff3dd614cf4c2a39f5548dfe95d8f8fc9a16b1042331a3a2675faed695f86cd1436e102d62074e\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"67\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-09-13 21:29:18','notification'),
(115,0,'{\"transaction_time\":\"2022-10-19 16:44:11\",\"transaction_status\":\"pending\",\"transaction_id\":\"979700f1-792c-4e60-82c8-b69414b4641a\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"0da130f6804c39e997fbf93fe4f933faf5ebff6692659304da17e8b6110ae70a56a1b5028f50fe8376505a86cd50626d931fc7c3dae3e6051e1691a882736b4a\",\"payment_type\":\"gopay\",\"order_id\":\"75\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"250000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-10-19 16:44:11','notification'),
(116,0,'{\"transaction_time\":\"2022-10-19 16:44:11\",\"transaction_status\":\"expire\",\"transaction_id\":\"979700f1-792c-4e60-82c8-b69414b4641a\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"3e1e804a515453f625ef8fad6ca7ecb57ac292258386c18e21bd3baf27eaf6d28280bd4a1e9cf3d487e9e57410212bce55ce8ddd87f827ea4ebf502a0d11b9fa\",\"payment_type\":\"gopay\",\"order_id\":\"75\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"250000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-10-19 16:59:37','notification'),
(117,0,'{\"transaction_time\":\"2022-12-09 11:12:48\",\"transaction_status\":\"pending\",\"transaction_id\":\"8f36c5a2-ae6e-47b4-92ca-38e7253ef849\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"ce1d6e841be716c34b185423c0fb1f225002ee4fe7515f2e5de0e916c5337fc75d97f5df28268d93183a602f2a6f6d6780f535e501e3cab5e8656456e7272940\",\"payment_type\":\"gopay\",\"order_id\":\"77\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"250000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-12-09 11:12:49','notification'),
(118,0,'{\"transaction_time\":\"2022-12-09 11:12:48\",\"transaction_status\":\"settlement\",\"transaction_id\":\"8f36c5a2-ae6e-47b4-92ca-38e7253ef849\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"eb9038528b5f2497895e55e98e42539be77c4f1dc2149466ed369db02c1339e1c8c8b1fc163757fc43a7f06b4c42ac9486a1e2b1520575fad2a477a63ef68449\",\"settlement_time\":\"2022-12-09 11:12:56\",\"payment_type\":\"gopay\",\"order_id\":\"77\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"250000.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}','2022-12-09 11:12:57','notification'),
(119,0,'{\"transaction_time\":\"2023-01-15 17:05:06\",\"transaction_status\":\"pending\",\"transaction_id\":\"3ca3ac08-7ae1-4245-9cec-e9f8b1e80e98\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"9589834f5d1ac813a02027ea0f05d3ebd1f72cf1bdccb99cb9f51bd237b6fb2889e6b09d42e3e74ce284008426d583949c45bfa633a8a07aa64489d77a96848f\",\"payment_type\":\"echannel\",\"order_id\":\"80\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"250000.00\",\"fraud_status\":\"accept\",\"expire_time\":\"2023-01-16 17:05:06\",\"currency\":\"IDR\",\"biller_code\":\"70012\",\"bill_key\":\"14768732998\"}','2023-01-15 17:05:08','notification'),
(120,0,'{\"transaction_time\":\"2023-01-15 17:05:06\",\"transaction_status\":\"expire\",\"transaction_id\":\"3ca3ac08-7ae1-4245-9cec-e9f8b1e80e98\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"1ed60f1135cf094f0393109a72564a3efe265cf6d50e5d0da9e7094f7a947759779a401cdcccf123a655e3297aaad576a4f59ada2e723dc85335d7521a97b51b\",\"payment_type\":\"echannel\",\"order_id\":\"80\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"250000.00\",\"fraud_status\":\"accept\",\"expire_time\":\"2023-01-16 17:05:06\",\"currency\":\"IDR\",\"biller_code\":\"70012\",\"bill_key\":\"14768732998\"}','2023-01-16 17:13:45','notification'),
(121,0,'{\"va_numbers\":[{\"va_number\":\"124124974173579631\",\"bank\":\"bri\"}],\"transaction_time\":\"2023-02-10 09:19:00\",\"transaction_status\":\"pending\",\"transaction_id\":\"6503ce18-4799-4439-937f-ad5ea425543c\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"41bbbba4c5c480729d4623a879b10632f5b987e3b76044237bbee519bd6c662b2c27d009884af96f006b7804d58326c6e53bd3d2ddd634e81f7d5443c7cc371e\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"84\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"2000000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2023-02-11 09:19:00\",\"currency\":\"IDR\"}','2023-02-10 09:19:02','notification'),
(122,0,'{\"va_numbers\":[{\"va_number\":\"124124974173579631\",\"bank\":\"bri\"}],\"transaction_time\":\"2023-02-10 09:19:00\",\"transaction_status\":\"expire\",\"transaction_id\":\"6503ce18-4799-4439-937f-ad5ea425543c\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"1608da0e25438afde334bc02a86ec754acb51b52dd587a9d29dc93614a19da60ec8fa6ee370e062860b5fd23c5fd4af6accb079fe834990c331f8ca0a130a973\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"84\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"2000000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2023-02-11 09:19:00\",\"currency\":\"IDR\"}','2023-02-11 09:19:04','notification'),
(123,0,'{\"va_numbers\":[{\"va_number\":\"8578143418305003\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-01-24 19:40:42\",\"transaction_status\":\"pending\",\"transaction_id\":\"b38fb4d6-26b2-4c30-9553-c6fafd2377db\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"7de2bc5964d50b12cf5c07b53fa950185fe9b38aeebac8681866fb4ad21055e13e389d2eef81ae6f37e949b9b0b21be437a449dae5193e23a10ff8143d7d0088\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"117\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-01-25 19:40:42\",\"currency\":\"IDR\"}','2024-01-24 19:40:44','notification'),
(124,0,'{\"va_numbers\":[{\"va_number\":\"8578143418305003\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-01-24 19:40:42\",\"transaction_status\":\"expire\",\"transaction_id\":\"b38fb4d6-26b2-4c30-9553-c6fafd2377db\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"6fb95e358f9751d89fb89bb5eca74b49a2f68d8497ef9973e889e687529847606cfb61d3bda9fab833ceb6fe5f14eb8cc3073f8db8947e67b97d6f26dc0e672b\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"117\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"1500000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-01-25 19:40:42\",\"currency\":\"IDR\"}','2024-01-25 19:41:46','notification'),
(125,0,'{\"transaction_time\":\"2024-02-03 16:33:01\",\"transaction_status\":\"pending\",\"transaction_id\":\"da560e13-76ad-45ee-a1f4-e90ea007386d\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"025e61f2127e962a8bc5f852276df2ecc84a3505637fbfac64b91a200f14c78556cdf4f506fce77beafc43ca25cd42870c5e1a11b6739e911ddb3c4106865061\",\"payment_type\":\"gopay\",\"order_id\":\"118\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"10000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-02-03 16:48:01\",\"currency\":\"IDR\"}','2024-02-03 16:33:03','notification'),
(126,0,'{\"transaction_time\":\"2024-02-03 16:33:01\",\"transaction_status\":\"expire\",\"transaction_id\":\"da560e13-76ad-45ee-a1f4-e90ea007386d\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"50ed9bc69d5a3f119868ea71b3fd80118c68fdf2e7bccddcc6dd4d2f726b65c22b1e4cc975009d064e9c310b62324c4702f4b796babf7afa6076ca48736e5b87\",\"payment_type\":\"gopay\",\"order_id\":\"118\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"10000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-02-03 16:48:01\",\"currency\":\"IDR\"}','2024-02-03 16:49:05','notification'),
(127,0,'{\"va_numbers\":[{\"va_number\":\"8578069658927572\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-04-02 08:48:20\",\"transaction_status\":\"pending\",\"transaction_id\":\"f0b2b373-a214-4d4f-9293-a985aa87430b\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"fab84165ba6e24d298dfb36fe8784c6f7ddc13b7980c596bd3bd1e6a2e43fa2b6f9dde3df1a2bf4038a4c8fa13fe809c144a08dbcc642697cc07941d005c0020\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"134\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600086.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-03 08:48:20\",\"currency\":\"IDR\"}','2024-04-02 08:48:21','notification'),
(128,0,'{\"transaction_type\":\"off-us\",\"transaction_time\":\"2024-04-02 08:49:08\",\"transaction_status\":\"pending\",\"transaction_id\":\"b74a8fd6-2b11-4f6b-bcbf-a905c4d326f8\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"69395126142d01156cdb77fe26e01ead9e59576e3c66a63164fa37b018465e02d7c7a6a48617eb88184f9f8ae5a3a9396fffc84f63382f80c910fe329d4e5b50\",\"payment_type\":\"qris\",\"order_id\":\"135\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600086.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-02 09:04:08\",\"currency\":\"IDR\"}','2024-04-02 08:49:09','notification'),
(129,0,'{\"transaction_type\":\"off-us\",\"transaction_time\":\"2024-04-02 08:49:08\",\"transaction_status\":\"expire\",\"transaction_id\":\"b74a8fd6-2b11-4f6b-bcbf-a905c4d326f8\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"f5963d8e2bc19a733acb0d52560ef4107314126d304bef25f49e653f949cdcf779b8af0c2aa3d6a8660d9cc8d2c526c0efcd518a0d2179926b76458f0a6f56bb\",\"payment_type\":\"qris\",\"order_id\":\"135\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600086.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-02 09:04:08\",\"currency\":\"IDR\"}','2024-04-02 09:05:10','notification'),
(130,0,'{\"va_numbers\":[{\"va_number\":\"8578401697619657\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-04-03 03:13:28\",\"transaction_status\":\"pending\",\"transaction_id\":\"fcde2f15-1301-4700-95f6-ceb4a6e1bb57\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"2f81b93eb4053d3d89e44b2d08eef15ce6b08d3874c350d047215d9c8690e1d70e8c2f636d6a476025d4ae97f1ec85b87891dbd5e07f3559fab0846a533985e4\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"138\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600088.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-04 03:13:28\",\"currency\":\"IDR\"}','2024-04-03 03:13:29','notification'),
(131,0,'{\"transaction_time\":\"2024-04-03 03:14:15\",\"transaction_status\":\"pending\",\"transaction_id\":\"5ca0923f-86eb-4e7c-9651-8b263d589d72\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"6faf74b24ef143a990696ffdaac13ffe918ce08e65aaf114b65048bffc2e763324c571cc8a5cc662e5d0d4ed67ee762df8df0bc238230cd54b9c3b605a27b48e\",\"payment_type\":\"gopay\",\"order_id\":\"139\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600088.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-03 03:29:15\",\"currency\":\"IDR\"}','2024-04-03 03:14:16','notification'),
(132,0,'{\"transaction_type\":\"off-us\",\"transaction_time\":\"2024-04-03 03:14:38\",\"transaction_status\":\"pending\",\"transaction_id\":\"3f66b011-4f8e-46c4-85c1-b318b4dc534d\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"9dff831a9096ac02494876f3ee0ff58c24daaea88b9b06e84269f4ac3892567a44dfcf5fee9ead665ef21d35a1acef816b691dcaa7001dbdbf81321ca3a3468a\",\"payment_type\":\"qris\",\"order_id\":\"140\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600088.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-03 03:29:37\",\"currency\":\"IDR\"}','2024-04-03 03:14:39','notification'),
(133,0,'{\"va_numbers\":[{\"va_number\":\"124120814931765974\",\"bank\":\"bri\"}],\"transaction_time\":\"2024-04-03 03:15:34\",\"transaction_status\":\"pending\",\"transaction_id\":\"976e1d87-be9e-4a31-8c2f-ec34648f646e\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"b8bbde4bfe3e57245a42bdc4217e225a00f194791faad521f320ccc8d6d2447815f040a297b338d0c4b95c93342e2817883d3034e591f7b16df1e89272f7e840\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"141\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"2000089.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-04 03:15:34\",\"currency\":\"IDR\"}','2024-04-03 03:15:35','notification'),
(134,0,'{\"va_numbers\":[{\"va_number\":\"8578639571306957\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-04-03 03:16:02\",\"transaction_status\":\"pending\",\"transaction_id\":\"0081c3b4-11fe-4f07-b655-f1cf8a5afa0f\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"c28765dd065a2a67b52c15f281749e6832a74e3352cbd23d768b4d88feb28cc7f4726a2d09178e167742b2eeee6f233bddf1403ed1cb3e30649f75beb87910ce\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"142\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"10090.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-04 03:16:02\",\"currency\":\"IDR\"}','2024-04-03 03:16:03','notification'),
(135,0,'{\"transaction_time\":\"2024-04-03 03:17:00\",\"transaction_status\":\"pending\",\"transaction_id\":\"a1d8f286-87a6-4c4a-9a41-f0405815c167\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"a65e6016013f3f843af945b567470190b596517c2437b8deaaae63ca554a60d6ced91eb92e2cfc4c03639a6631530b07daae2f9de908603cbbb42dcd218fee80\",\"payment_type\":\"gopay\",\"order_id\":\"143\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"10090.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-03 03:32:00\",\"currency\":\"IDR\"}','2024-04-03 03:17:02','notification'),
(136,0,'{\"transaction_time\":\"2024-04-03 03:14:15\",\"transaction_status\":\"expire\",\"transaction_id\":\"5ca0923f-86eb-4e7c-9651-8b263d589d72\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"6cf88b28eed5edaf82d8e0e7e386d5fcf0d3fa3c5a126135de32257b9c39c90ddd4aca87b1626afa0f876a7f0a84b3ccb06486712bd5c5790b0cef1db37e59be\",\"payment_type\":\"gopay\",\"order_id\":\"139\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600088.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-03 03:29:15\",\"currency\":\"IDR\"}','2024-04-03 03:30:20','notification'),
(137,0,'{\"transaction_type\":\"off-us\",\"transaction_time\":\"2024-04-03 03:14:38\",\"transaction_status\":\"expire\",\"transaction_id\":\"3f66b011-4f8e-46c4-85c1-b318b4dc534d\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"8cb30a488c72c628d6a3f6003ccd1ac3f6e0fe8c92b14a40f3ed1eb5be51f3a3819c63939db85e312d95b6f661499bd017e548e04d11af126c7feb58d38ef324\",\"payment_type\":\"qris\",\"order_id\":\"140\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600088.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-03 03:29:37\",\"currency\":\"IDR\"}','2024-04-03 03:30:40','notification'),
(138,0,'{\"transaction_time\":\"2024-04-03 03:17:00\",\"transaction_status\":\"expire\",\"transaction_id\":\"a1d8f286-87a6-4c4a-9a41-f0405815c167\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"cb57a6655b2eecf45fdd51d47698a8c796d36d8aadd258b3a6d49ea34acee17b4516c9b8a002ce98406abec03f06e1ac581dcc05f7268e49a102b30e780a17cd\",\"payment_type\":\"gopay\",\"order_id\":\"143\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"10090.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-03 03:32:00\",\"currency\":\"IDR\"}','2024-04-03 03:33:05','notification'),
(139,0,'{\"va_numbers\":[{\"va_number\":\"8578069658927572\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-04-02 08:48:20\",\"transaction_status\":\"expire\",\"transaction_id\":\"f0b2b373-a214-4d4f-9293-a985aa87430b\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"58d519c55960c76171a7540f5ce89bf2a90f02820108d924f1484a73291476ed1257376571ae728560edb3ff85b6f7968ad0a189d661cc5b9511120cb9f7ca04\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"134\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600086.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-03 08:48:20\",\"currency\":\"IDR\"}','2024-04-03 08:49:25','notification'),
(140,0,'{\"va_numbers\":[{\"va_number\":\"8578401697619657\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-04-03 03:13:28\",\"transaction_status\":\"expire\",\"transaction_id\":\"fcde2f15-1301-4700-95f6-ceb4a6e1bb57\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"ad5b638e7f739c4d3bf6baa4096ead099780d400fc049014d030984e6884983ed3578b7c1c22e4df4a437753c3b4e156cf0e1889eaffd05fe0a831155ffcad53\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"138\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600088.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-04 03:13:28\",\"currency\":\"IDR\"}','2024-04-04 03:14:31','notification'),
(141,0,'{\"va_numbers\":[{\"va_number\":\"124120814931765974\",\"bank\":\"bri\"}],\"transaction_time\":\"2024-04-03 03:15:34\",\"transaction_status\":\"expire\",\"transaction_id\":\"976e1d87-be9e-4a31-8c2f-ec34648f646e\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"b56a17f2390df3b3b13fd89afc5851e7fb61a0549aeb416a82b855808bfb8c461519a5874e65eeab7d3ae439f192e4b0e0317617dc6ed9c7dbbf9d02be98807e\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"141\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"2000089.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-04 03:15:34\",\"currency\":\"IDR\"}','2024-04-04 03:16:36','notification'),
(142,0,'{\"va_numbers\":[{\"va_number\":\"8578639571306957\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-04-03 03:16:02\",\"transaction_status\":\"expire\",\"transaction_id\":\"0081c3b4-11fe-4f07-b655-f1cf8a5afa0f\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"30be3d4d1863a90d0e615a77d8453316e29279c3b50bdedef8bd1fb2bfc3231312700683c74e3ea7fbbc6217e1899268619614fa460e017bc4f0eaadf4dae84a\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"142\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"10090.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-04-04 03:16:02\",\"currency\":\"IDR\"}','2024-04-04 03:17:05','notification'),
(143,0,'{\"transaction_type\":\"off-us\",\"transaction_time\":\"2024-05-10 10:20:29\",\"transaction_status\":\"pending\",\"transaction_id\":\"f587bd77-cbae-4738-963f-e0e04a8caa62\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"37c77a1dddfee7981702bcc06ed085f204461d71a5f9542df0ee18059b4d97d95f9633c7ed9d8c2e75c2aac72b5d60ce9b4163eb2be5543a11bdf11812564fea\",\"payment_type\":\"qris\",\"order_id\":\"144\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"10092.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-05-10 10:35:29\",\"currency\":\"IDR\"}','2024-05-10 10:20:31','notification'),
(144,0,'{\"transaction_type\":\"off-us\",\"transaction_time\":\"2024-05-10 10:20:29\",\"transaction_status\":\"expire\",\"transaction_id\":\"f587bd77-cbae-4738-963f-e0e04a8caa62\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"23c3e2aa3d489bf5f3a687c7a686b10a785505e7ef3f24133a9129701771f0b96248745cb8501652b4c346d1c9522e6f5e898cff91c654d8a6d4296028f90722\",\"payment_type\":\"qris\",\"order_id\":\"144\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"10092.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-05-10 10:35:29\",\"currency\":\"IDR\"}','2024-05-10 10:36:34','notification'),
(145,0,'{\"transaction_time\":\"2024-05-14 15:58:22\",\"transaction_status\":\"pending\",\"transaction_id\":\"cfe301d0-f730-4912-ba19-18e312f852e6\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"f3410bfbd2b2ae2fb2804ac1fb40e483b0fdc6c652a8fef6dbddc458cc91e3f0e151453d39df26ffc1646a2d3c52eb78540650249d985810a0d8b0636ca626b7\",\"payment_type\":\"gopay\",\"order_id\":\"147\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600095.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-05-14 16:13:22\",\"currency\":\"IDR\"}','2024-05-14 15:58:23','notification'),
(146,0,'{\"transaction_time\":\"2024-05-14 15:58:22\",\"transaction_status\":\"expire\",\"transaction_id\":\"cfe301d0-f730-4912-ba19-18e312f852e6\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"f2457989866e9cf76bfe3b76f6420b6961d3913570ed94b554afe77ac078d9fedc0f7305cd44d890c0886e64a02e499ecdc26fa7a1a3f1173dce03047f8cec38\",\"payment_type\":\"gopay\",\"order_id\":\"147\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600095.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-05-14 16:13:22\",\"currency\":\"IDR\"}','2024-05-14 16:14:28','notification'),
(147,0,'{\"va_numbers\":[{\"va_number\":\"8578508249385694\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-05-29 14:14:36\",\"transaction_status\":\"pending\",\"transaction_id\":\"ab0f9746-b514-42a6-b1ec-ba6e77295cec\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"7c8bb52c199dba5d909b8d7b1d0c51b750daadf7e490842491a3ea2ff4e4b10886f97e03af11261253d2a2ff107dcbf9567184f7e027c6d203218b5ba7ea7319\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"151\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600102.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-05-30 14:14:36\",\"currency\":\"IDR\"}','2024-05-29 14:14:36','notification'),
(148,0,'{\"transaction_type\":\"off-us\",\"transaction_time\":\"2024-05-29 14:15:54\",\"transaction_status\":\"pending\",\"transaction_id\":\"bfb4d8d1-4d21-40e0-9fdc-3d992f87b1ae\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"35e07f4bda092e83f22c9a284628dea4a621e2000c8eff6ed0d35bbbf47d16fe18903f0fa1ee65d4388f083d60232b15b2ecf7f09d3c36026bad5315eb2f680f\",\"payment_type\":\"qris\",\"order_id\":\"152\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600102.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-05-29 14:30:54\",\"currency\":\"IDR\"}','2024-05-29 14:15:56','notification'),
(149,0,'{\"transaction_type\":\"off-us\",\"transaction_time\":\"2024-05-29 14:15:54\",\"transaction_status\":\"expire\",\"transaction_id\":\"bfb4d8d1-4d21-40e0-9fdc-3d992f87b1ae\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"ccbb5d8fceeb9f10077aa84aa7a36f961922b14d4b6e9eb6037a190bbf6f922b9a2568f6ad3b7c697abef1aeadf6d6e6f1427cdf9322fdf8e707aa9cd8bde9b3\",\"payment_type\":\"qris\",\"order_id\":\"152\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600102.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-05-29 14:30:54\",\"currency\":\"IDR\"}','2024-05-29 14:31:59','notification'),
(150,0,'{\"va_numbers\":[{\"va_number\":\"8578508249385694\",\"bank\":\"bni\"}],\"transaction_time\":\"2024-05-29 14:14:36\",\"transaction_status\":\"expire\",\"transaction_id\":\"ab0f9746-b514-42a6-b1ec-ba6e77295cec\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"202\",\"signature_key\":\"17ee5655a0e8fc359c69f9f5689201a7a3a7b7c41f70b99e93cd5447011e2af42ec7281888c42b8eaf39feb500e4c947c3db704068ccd9eb46ad203d32423dd5\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"151\",\"merchant_id\":\"G882472699\",\"gross_amount\":\"600102.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2024-05-30 14:14:36\",\"currency\":\"IDR\"}','2024-05-30 14:15:39','notification');

/*Table structure for table `app_notifikasi` */

DROP TABLE IF EXISTS `app_notifikasi`;

CREATE TABLE `app_notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `app_notifikasi` */

insert  into `app_notifikasi`(`id`,`member_id`,`title`,`subtitle`,`created_date`) values 
(1,2304,'info','pembayaran berhasil','0000-00-00 00:00:00'),
(2,2304,'oke bos','mantap','0000-00-00 00:00:00');

/*Table structure for table `app_notifikasi_read` */

DROP TABLE IF EXISTS `app_notifikasi_read`;

CREATE TABLE `app_notifikasi_read` (
  `member_id` int(11) NOT NULL,
  `last_notifikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

/*Data for the table `app_notifikasi_read` */

/*Table structure for table `app_order` */

DROP TABLE IF EXISTS `app_order`;

CREATE TABLE `app_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` datetime NOT NULL,
  `is_paid` int(11) NOT NULL,
  `payment` varchar(30) NOT NULL,
  `payment_date` datetime NOT NULL,
  `subtotal` int(11) NOT NULL,
  `unique_nominal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `expired_date` date NOT NULL,
  `log_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `app_order` */

insert  into `app_order`(`id`,`member_id`,`product_id`,`title`,`subtitle`,`content`,`created_date`,`is_paid`,`payment`,`payment_date`,`subtotal`,`unique_nominal`,`total`,`category_id`,`time_limit`,`expired_date`,`log_id`) values 
(99,2304,5,'Paket Kedokteran 1 Bulan','10 x Pertemuan','<p>aaaaa</p>','2024-05-29 11:44:15',1,'','2024-05-29 11:44:15',0,0,0,1,1,'2024-06-29',0),
(102,881,4,'Paket Profesi Apoteker 1 Bulan','16 x Pertemuan','<p><strong>Anda akan mendapatkan berbagai fitur</strong></p>\r\n<p>asdfasdfsadf</p>\r\n<p><strong>asdfasdf</strong></p>\r\n<p><strong>asdfasdfadfadf</strong></p>\r\n<p>&nbsp;</p>','2024-05-29 14:14:22',1,'','2024-05-29 14:16:48',600000,102,600102,4,1,'2024-06-29',0),
(103,2304,4,'Paket Profesi Apoteker 1 Bulan','16 x Pertemuan','<p><strong>Anda akan mendapatkan berbagai fitur</strong></p>\r\n<p>asdfasdfsadf</p>\r\n<p><strong>asdfasdf</strong></p>\r\n<p><strong>asdfasdfadfadf</strong></p>\r\n<p>&nbsp;</p>','2024-05-29 14:37:31',1,'','2024-05-29 14:37:39',600000,103,600103,4,1,'2024-06-29',0),
(104,2304,7,'Paket Profesi Apoteker 5 Bulan','Apoteker','<p>belajar menjadi apoteker</p>','2024-05-31 14:41:34',1,'','2024-06-06 19:27:50',2000000,104,2000104,4,5,'2024-11-06',0),
(106,2304,6,'Paket Kedokteran 3 Bulan','Berlangganan','<p>OKE LAH ss</p>','2024-06-04 14:25:41',0,'','0000-00-00 00:00:00',1500000,106,1500106,1,3,'0000-00-00',0),
(107,3378,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 17:27:56',1,'','2024-06-06 17:27:56',0,0,0,4,1,'2024-07-06',0),
(108,3605,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:28:08',1,'','2024-06-06 19:27:08',0,0,0,4,1,'2024-07-06',0),
(109,3589,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:32:31',1,'','2024-06-06 19:27:25',0,0,0,4,1,'2024-07-06',0),
(110,3460,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:35:57',1,'','2024-06-06 19:27:32',0,0,0,4,1,'2024-07-06',0),
(111,3615,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:36:54',1,'','2024-06-06 19:27:38',0,0,0,4,1,'2024-07-06',0),
(112,3612,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:41:39',1,'','2024-06-06 19:28:12',0,0,0,4,1,'2024-07-06',0),
(113,3612,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:41:39',1,'','2024-06-06 20:15:03',0,0,0,4,1,'2024-07-06',0),
(114,3510,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:42:32',1,'','2024-06-06 19:29:15',0,0,0,4,1,'2024-07-06',0),
(115,3480,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:43:58',1,'','2024-06-06 19:38:23',0,0,0,4,1,'2024-07-06',0),
(116,3456,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:44:47',1,'','2024-06-06 19:29:00',0,0,0,4,1,'2024-07-06',0),
(117,3574,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 18:46:08',1,'','2024-06-06 19:28:53',0,0,0,4,1,'2024-07-06',0),
(118,3462,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:15:19',1,'','2024-06-06 19:28:45',0,0,0,4,1,'2024-07-06',0),
(119,3489,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:28:20',1,'','2024-06-06 20:16:21',0,0,0,4,1,'2024-07-06',0),
(120,3629,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:39:40',1,'','2024-06-06 20:16:19',0,0,0,4,1,'2024-07-06',0),
(121,3492,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:43:09',1,'','2024-06-06 20:16:18',0,0,0,4,1,'2024-07-06',0),
(122,3458,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:43:16',1,'','2024-06-06 20:16:16',0,0,0,4,1,'2024-07-06',0),
(123,3618,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:46:15',1,'','2024-06-06 20:16:14',0,0,0,4,1,'2024-07-06',0),
(124,3620,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:46:49',1,'','2024-06-06 20:16:13',0,0,0,4,1,'2024-07-06',0),
(125,3490,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:50:11',1,'','2024-06-06 20:16:12',0,0,0,4,1,'2024-07-06',0),
(126,3455,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:50:58',1,'','2024-06-06 20:16:10',0,0,0,4,1,'2024-07-06',0),
(127,3525,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:54:08',1,'','2024-06-06 20:16:09',0,0,0,4,1,'2024-07-06',0),
(128,3443,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 19:56:48',1,'','2024-06-06 20:16:07',0,0,0,4,1,'2024-07-06',0),
(129,3457,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:04:57',1,'','2024-06-06 20:16:06',0,0,0,4,1,'2024-07-06',0),
(130,3599,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:12:54',1,'','2024-06-06 20:15:26',0,0,0,4,1,'2024-07-06',0),
(131,3575,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:13:32',1,'','2024-06-06 20:15:14',0,0,0,4,1,'2024-07-06',0),
(132,3526,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:23:57',1,'','2024-06-06 20:48:24',0,0,0,4,1,'2024-07-06',0),
(133,3621,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:26:51',1,'','2024-06-06 20:48:26',0,0,0,4,1,'2024-07-06',0),
(134,3491,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:45:19',1,'','2024-06-06 20:48:27',0,0,0,4,1,'2024-07-06',0),
(135,3590,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:45:44',1,'','2024-06-06 20:55:05',0,0,0,4,1,'2024-07-06',0),
(136,3591,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:45:48',1,'','2024-06-06 20:55:00',0,0,0,4,1,'2024-07-06',0),
(137,3592,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:46:09',1,'','2024-06-06 20:55:01',0,0,0,4,1,'2024-07-06',0),
(138,3547,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:50:43',1,'','2024-06-06 20:55:03',0,0,0,4,1,'2024-07-06',0),
(139,3624,7,'Paket Profesi Apoteker 5 Bulan','Apoteker','<p>belajar menjadi apoteker</p>','2024-06-06 20:51:40',0,'','0000-00-00 00:00:00',2000000,139,2000139,4,5,'0000-00-00',0),
(140,3626,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:55:56',1,'','2024-06-07 13:02:22',0,0,0,4,1,'2024-07-07',0),
(141,3425,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:57:50',1,'','2024-06-07 13:02:20',0,0,0,4,1,'2024-07-07',0),
(142,3624,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 20:58:17',1,'','2024-06-07 13:02:20',0,0,0,4,1,'2024-07-07',0),
(143,3637,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 21:09:20',1,'','2024-06-07 13:02:20',0,0,0,4,1,'2024-07-07',0),
(144,3438,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 21:12:45',1,'','2024-06-07 13:02:18',0,0,0,4,1,'2024-07-07',0),
(145,3622,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 21:22:31',1,'','2024-06-07 13:02:11',0,0,0,4,1,'2024-07-07',0),
(146,3463,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 21:24:31',1,'','2024-06-07 13:02:11',0,0,0,4,1,'2024-07-07',0),
(147,3523,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 21:34:27',1,'','2024-06-06 22:02:30',0,0,0,4,1,'2024-07-06',0),
(148,3471,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 21:41:57',1,'','2024-06-07 13:01:39',0,0,0,4,1,'2024-07-07',0),
(149,3496,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 21:42:57',1,'','2024-06-07 13:01:26',0,0,0,4,1,'2024-07-07',0),
(150,3642,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 21:48:16',1,'','2024-06-07 13:01:14',0,0,0,4,1,'2024-07-07',0),
(151,3494,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 22:24:56',1,'','2024-06-07 13:00:38',0,0,0,4,1,'2024-07-07',0),
(152,3501,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 22:25:14',1,'','2024-06-06 22:25:14',0,0,0,4,1,'2024-07-06',0),
(153,3433,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 22:34:11',1,'','2024-06-06 22:34:11',0,0,0,4,1,'2024-07-06',0),
(154,3441,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 22:43:42',1,'','2024-06-07 13:00:28',0,0,0,4,1,'2024-07-07',0),
(155,3593,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 22:50:04',1,'','2024-06-07 13:00:18',0,0,0,4,1,'2024-07-07',0),
(156,3519,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-06 23:22:40',1,'','2024-06-07 13:00:08',0,0,0,4,1,'2024-07-07',0),
(157,3487,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 00:03:02',1,'','2024-06-07 12:59:54',0,0,0,4,1,'2024-07-07',0),
(158,3617,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 00:24:41',1,'','2024-06-07 12:59:42',0,0,0,4,1,'2024-07-07',0),
(159,3548,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 00:44:11',1,'','2024-06-07 12:59:34',0,0,0,4,1,'2024-07-07',0),
(160,3562,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 02:24:51',1,'','2024-06-07 12:59:06',0,0,0,4,1,'2024-07-07',0),
(161,3623,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 06:06:56',1,'','2024-06-07 12:58:48',0,0,0,4,1,'2024-07-07',0),
(162,3486,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 07:59:36',1,'','2024-06-07 12:58:55',0,0,0,4,1,'2024-07-07',0),
(163,3621,4,'Paket Profesi Apoteker 1 Bulan','16 x Pertemuan','<p><strong>Anda akan mendapatkan berbagai fitur</strong></p>\r\n<p>asdfasdfsadf</p>\r\n<p><strong>asdfasdf</strong></p>\r\n<p><strong>asdfasdfadfadf</strong></p>\r\n<p>&nbsp;</p>','2024-06-07 08:04:26',0,'','0000-00-00 00:00:00',600000,163,600163,4,1,'0000-00-00',0),
(164,3501,8,'Vidio pembelajaran gratis','Vidio pembelajaran gratis','<p><img src=\"/cbt/userfiles/file/quiz/media/source//dir_/daftar kelas tatap muka ukai oktbr -2024.png\" alt=\"daftar kelas tatap muka ukai oktbr -2024\" /><img src=\"/cbt/userfiles/file/quiz/media/source//dir_/daftar kelas tatap muka ukai oktbr -2024.png\" alt=\"daftar kelas tatap muka ukai oktbr -2024\" /></p>','2024-06-07 08:54:15',0,'','0000-00-00 00:00:00',10000,164,10164,4,2,'0000-00-00',0),
(165,3646,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 13:28:56',1,'','2024-06-07 13:28:56',0,0,0,4,1,'2024-07-07',0),
(166,3532,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 15:17:35',1,'','2024-06-07 15:17:35',0,0,0,4,1,'2024-07-07',0),
(167,3537,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 15:17:38',1,'','2024-06-07 15:17:38',0,0,0,4,1,'2024-07-07',0),
(168,3481,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 16:12:11',1,'','2024-06-07 16:12:11',0,0,0,4,1,'2024-07-07',0),
(169,3649,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 17:15:18',1,'','2024-06-07 17:15:18',0,0,0,4,1,'2024-07-07',0),
(170,3634,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 17:22:35',1,'','2024-06-07 17:22:35',0,0,0,4,1,'2024-07-07',0),
(171,3571,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 17:36:15',1,'','2024-06-07 17:36:15',0,0,0,4,1,'2024-07-07',0),
(172,3648,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 18:19:51',1,'','2024-06-07 18:19:51',0,0,0,4,1,'2024-07-07',0),
(173,3646,8,'Vidio pembelajaran gratis','Vidio pembelajaran gratis','<p><img src=\"/cbt/userfiles/file/quiz/media/source//dir_/daftar kelas tatap muka ukai oktbr -2024.png\" alt=\"daftar kelas tatap muka ukai oktbr -2024\" /><img src=\"/cbt/userfiles/file/quiz/media/source//dir_/daftar kelas tatap muka ukai oktbr -2024.png\" alt=\"daftar kelas tatap muka ukai oktbr -2024\" /></p>','2024-06-07 20:28:40',0,'','0000-00-00 00:00:00',10000,173,10173,4,2,'0000-00-00',0),
(174,2743,4,'Paket Profesi Apoteker 1 Bulan','16 x Pertemuan','<p><strong>Anda akan mendapatkan berbagai fitur</strong></p>\r\n<p>asdfasdfsadf</p>\r\n<p><strong>asdfasdf</strong></p>\r\n<p><strong>asdfasdfadfadf</strong></p>\r\n<p>&nbsp;</p>','2024-06-07 23:19:06',0,'','0000-00-00 00:00:00',600000,174,600174,4,1,'0000-00-00',0),
(175,2743,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-07 23:21:09',1,'','2024-06-07 23:21:09',0,0,0,4,1,'2024-07-07',0),
(176,3494,4,'Paket Profesi Apoteker 1 Bulan','16 x Pertemuan','<p><strong>Anda akan mendapatkan berbagai fitur</strong></p>\r\n<p>asdfasdfsadf</p>\r\n<p><strong>asdfasdf</strong></p>\r\n<p><strong>asdfasdfadfadf</strong></p>\r\n<p>&nbsp;</p>','2024-06-07 23:41:28',0,'','0000-00-00 00:00:00',600000,176,600176,4,1,'0000-00-00',0),
(177,3565,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-08 01:14:21',1,'','2024-06-08 01:14:21',0,0,0,4,1,'2024-07-08',0),
(178,3608,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-09 00:55:59',1,'','2024-06-09 00:55:59',0,0,0,4,1,'2024-07-09',0),
(179,3503,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-10 09:24:48',1,'','2024-06-10 09:24:48',0,0,0,4,1,'2024-07-10',0),
(181,881,11,'INTENSIF APOTEKER AGUSTUS 2024','Pembahasan 1000 soal','<p>Khusus Mahasiswa Intensif</p>','2024-06-10 20:49:02',1,'','2024-06-10 20:49:02',0,0,0,4,2,'2024-08-10',0),
(182,881,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-10 20:50:34',1,'','2024-06-10 20:50:34',0,0,0,4,1,'2024-07-10',0),
(183,3444,11,'INTENSIF APOTEKER AGUSTUS 2024','Pembahasan 1000 soal','<p>Khusus Mahasiswa Intensif</p>','2024-06-11 09:48:15',1,'','2024-06-11 09:51:08',1000000,183,1000183,4,2,'2024-08-11',0),
(184,3444,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-11 09:51:49',1,'','2024-06-11 09:51:49',0,0,0,4,1,'2024-07-11',0),
(185,3547,11,'INTENSIF APOTEKER AGUSTUS 2024','Pembahasan 1000 soal','<p>Khusus Mahasiswa Intensif</p>','2024-06-11 15:06:48',0,'','0000-00-00 00:00:00',1000000,185,1000185,4,2,'0000-00-00',0),
(186,3550,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-11 19:23:39',1,'','2024-06-11 19:23:39',0,0,0,4,1,'2024-07-11',0),
(187,3551,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-12 09:35:19',1,'','2024-06-12 09:35:19',0,0,0,4,1,'2024-07-12',0),
(188,3578,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-12 13:46:17',1,'','2024-06-12 13:46:17',0,0,0,4,1,'2024-07-12',0),
(189,3653,10,'KISI-KISI TO NAS MAHASISWA BIMBEL WIFI UKAI','KISI-KISI TO NAS UKAI AGUSTU 2024','<p>Berisi 2 paket soal CBT</p>\r\n<p>Berisi Pembahasan soal</p>\r\n<p>Bersi vidio pembahasan soal</p>\r\n<p>Hanya khusus 1 akun yang order</p>','2024-06-12 22:37:56',1,'','2024-06-12 22:37:56',0,0,0,4,1,'2024-07-12',0),
(190,3654,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-06-13 10:47:49',1,'','2024-06-13 11:03:46',150000,190,150190,27,1,'2024-07-13',0),
(191,3653,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-06-13 11:48:11',1,'','2024-06-13 12:10:37',150000,191,150191,27,1,'2024-07-13',0),
(192,3604,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-06-13 13:35:28',1,'','2024-06-13 19:19:02',150000,192,150192,27,1,'2024-07-13',0),
(193,881,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-06-13 22:00:24',1,'','2024-06-13 22:01:03',150000,193,150193,27,1,'2024-07-13',0),
(194,881,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-14 14:54:26',1,'','2024-06-14 14:57:48',2100000,194,2100194,26,1,'2024-07-14',0),
(195,3471,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-17 14:34:12',1,'','2024-07-14 18:44:45',2100000,195,2100195,26,1,'2024-08-14',0),
(196,3488,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-18 19:17:35',1,'','2024-06-18 19:19:07',2100000,196,2100196,26,1,'2024-07-18',0),
(197,3655,14,'Premium','1000 soal','<p>Prediksi soal dengan keabsahan kemiripan 60-80%</p>','2024-06-18 22:22:59',1,'','2024-06-19 17:05:59',350000,197,350197,28,2,'2024-08-19',0),
(199,3657,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-19 09:06:56',1,'','2024-06-19 09:09:14',2100000,199,2100199,26,1,'2024-07-19',0),
(200,3532,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-19 19:50:48',1,'','2024-06-19 19:52:13',2100000,200,2100200,26,1,'2024-07-19',0),
(201,3537,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-19 19:51:41',1,'','2024-06-19 19:52:46',2100000,201,2100201,26,1,'2024-07-19',0),
(203,881,14,'Premium','1000 soal','<p>Prediksi soal dengan keabsahan kemiripan 60-80%</p>','2024-06-20 22:38:27',1,'','2024-06-20 22:39:36',350000,203,350203,28,2,'2024-08-20',0),
(204,3419,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-21 21:56:15',1,'','2024-07-07 21:10:58',2100000,204,2100204,26,1,'2024-08-07',0),
(205,3419,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-22 12:21:43',0,'','0000-00-00 00:00:00',2100000,205,2100205,26,1,'0000-00-00',0),
(206,2304,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-06-22 18:25:00',0,'','0000-00-00 00:00:00',150000,206,150206,27,1,'0000-00-00',0),
(207,3419,14,'Premium','1000 soal','<p>Prediksi soal dengan keabsahan kemiripan 60-80%</p>','2024-06-23 10:44:58',0,'','0000-00-00 00:00:00',350000,207,350207,28,2,'0000-00-00',0),
(208,1472,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-24 13:12:51',0,'','0000-00-00 00:00:00',2100000,208,2100208,26,1,'0000-00-00',0),
(209,3660,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-24 16:35:09',1,'','2024-06-24 16:35:47',2100000,209,2100209,26,1,'2024-07-24',0),
(210,3658,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-24 16:39:43',1,'','2024-06-24 16:41:38',2100000,210,2100210,26,1,'2024-07-24',0),
(211,3519,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-06-28 22:54:32',0,'','0000-00-00 00:00:00',150000,211,150211,27,1,'0000-00-00',0),
(212,3519,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-06-28 22:56:19',1,'','2024-07-05 18:01:44',2100000,212,2100212,26,1,'2024-08-05',0),
(213,3562,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-01 14:07:33',1,'','2024-07-05 18:01:25',2100000,213,2100213,26,1,'2024-08-05',0),
(214,3590,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-01 14:36:02',1,'','2024-07-01 17:05:50',2100000,214,2100214,26,1,'2024-08-01',0),
(215,3589,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-01 14:36:32',1,'','2024-07-01 17:07:07',2100000,215,2100215,26,1,'2024-08-01',0),
(216,3091,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-07-01 17:29:14',0,'','0000-00-00 00:00:00',150000,216,150216,27,1,'0000-00-00',0),
(217,3666,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-03 22:18:09',1,'','2024-07-04 19:18:03',2100000,217,2100217,26,1,'2024-08-04',0),
(218,3451,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-05 17:17:05',0,'','0000-00-00 00:00:00',2100000,218,2100218,26,1,'0000-00-00',0),
(219,3516,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-05 18:33:39',1,'','2024-07-05 18:40:32',2100000,219,2100219,26,1,'2024-08-05',0),
(220,3423,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-05 21:26:55',0,'','0000-00-00 00:00:00',2100000,220,2100220,26,1,'0000-00-00',0),
(221,3518,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-06 14:09:21',0,'','0000-00-00 00:00:00',2100000,221,2100221,26,1,'0000-00-00',0),
(222,3518,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-06 14:10:04',0,'','0000-00-00 00:00:00',1750000,222,1750222,4,1,'0000-00-00',0),
(223,3559,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-06 16:11:36',1,'','2024-07-07 21:10:16',2100000,223,2100223,26,1,'2024-08-07',0),
(224,3582,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-06 19:25:28',0,'','0000-00-00 00:00:00',1750000,224,1750224,4,1,'0000-00-00',0),
(225,3623,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-07 01:05:28',0,'','0000-00-00 00:00:00',1750000,225,1750225,4,1,'0000-00-00',0),
(226,3462,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-07 05:13:48',0,'','0000-00-00 00:00:00',1750000,226,1750226,4,1,'0000-00-00',0),
(227,3458,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-07 14:04:50',0,'','0000-00-00 00:00:00',1750000,227,1750227,4,1,'0000-00-00',0),
(228,3463,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-07 18:09:59',0,'','0000-00-00 00:00:00',1750000,228,1750228,4,1,'0000-00-00',0),
(229,3519,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-07 18:13:47',0,'','0000-00-00 00:00:00',1750000,229,1750229,4,1,'0000-00-00',0),
(230,3463,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-07-07 19:43:49',0,'','0000-00-00 00:00:00',150000,230,150230,27,1,'0000-00-00',0),
(231,3463,14,'Premium','1000 soal','<p>Prediksi soal dengan keabsahan kemiripan 60-80%</p>','2024-07-07 19:45:26',0,'','0000-00-00 00:00:00',350000,231,350231,28,2,'0000-00-00',0),
(232,3463,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-07 19:51:29',1,'','2024-07-07 21:10:02',2100000,232,2100232,26,1,'2024-08-07',0),
(233,3462,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-07 21:33:00',1,'','2024-07-07 21:35:33',2100000,233,2100233,26,1,'2024-08-07',0),
(234,3523,14,'Premium','1000 soal','<p>Prediksi soal dengan keabsahan kemiripan 60-80%</p>','2024-07-07 23:12:15',0,'','0000-00-00 00:00:00',350000,234,350234,28,2,'0000-00-00',0),
(235,3523,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-07-07 23:13:57',0,'','0000-00-00 00:00:00',150000,235,150235,27,1,'0000-00-00',0),
(236,3523,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-07 23:14:39',0,'','0000-00-00 00:00:00',1750000,236,1750236,4,1,'0000-00-00',0),
(237,3471,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-08 01:59:24',0,'','0000-00-00 00:00:00',1750000,237,1750237,4,1,'0000-00-00',0),
(238,3582,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-08 06:17:06',0,'','0000-00-00 00:00:00',1750000,238,1750238,4,1,'0000-00-00',0),
(239,3462,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-08 09:08:40',0,'','0000-00-00 00:00:00',1750000,239,1750239,4,1,'0000-00-00',0),
(240,3523,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-08 09:08:54',1,'','2024-07-14 18:44:48',2100000,240,2100240,26,1,'2024-08-14',0),
(241,3516,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-10 21:52:58',0,'','0000-00-00 00:00:00',1750000,241,1750241,4,1,'0000-00-00',0),
(242,3516,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-11 15:04:14',0,'','0000-00-00 00:00:00',1750000,242,1750242,4,1,'0000-00-00',0),
(243,3523,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-11 23:54:20',0,'','0000-00-00 00:00:00',1750000,243,1750243,4,1,'0000-00-00',0),
(244,3516,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-12 20:20:05',0,'','0000-00-00 00:00:00',1750000,244,1750244,4,1,'0000-00-00',0),
(245,3667,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-13 02:18:33',1,'','2024-07-14 18:44:47',2100000,245,2100245,26,1,'2024-08-14',0),
(246,0,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-14 18:31:00',0,'','0000-00-00 00:00:00',2100000,246,2100246,26,1,'0000-00-00',0),
(247,3490,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-14 18:44:20',1,'','2024-07-14 18:44:43',2100000,247,2100247,26,1,'2024-08-14',0),
(248,3585,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-15 00:27:55',0,'','0000-00-00 00:00:00',1750000,248,1750248,4,1,'0000-00-00',0),
(249,3481,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-15 16:36:53',0,'','0000-00-00 00:00:00',1750000,249,1750249,4,1,'0000-00-00',0),
(250,3488,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-19 00:00:13',0,'','0000-00-00 00:00:00',1750000,250,1750250,4,1,'0000-00-00',0),
(251,3507,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-21 18:32:25',0,'','0000-00-00 00:00:00',1750000,251,1750251,4,1,'0000-00-00',0),
(252,2743,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-22 19:50:58',0,'','0000-00-00 00:00:00',1750000,252,1750252,4,1,'0000-00-00',0),
(253,3679,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-23 11:49:33',1,'','2024-07-23 11:54:29',1750000,253,1750253,4,1,'2024-08-23',0),
(254,3679,13,'INTENSIF WIFI UKAI','ALUMNI','<p>KUIS MATERI &amp; VIDIO</p>','2024-07-23 13:18:37',0,'','0000-00-00 00:00:00',2100000,254,2100254,26,1,'0000-00-00',0),
(255,3679,14,'Premium','1000 soal','<p>Prediksi soal dengan keabsahan kemiripan 60-80%</p>','2024-07-23 13:18:48',0,'','0000-00-00 00:00:00',350000,255,350255,28,2,'0000-00-00',0),
(256,3679,12,'Belajar mandiri','Masuk Apoteker','<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','2024-07-27 10:42:35',0,'','0000-00-00 00:00:00',150000,256,150256,27,1,'0000-00-00',0),
(257,3518,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-28 14:44:02',0,'','0000-00-00 00:00:00',1750000,257,1750257,4,1,'0000-00-00',0),
(258,3584,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-29 14:05:57',0,'','0000-00-00 00:00:00',1750000,258,1750258,4,1,'0000-00-00',0),
(259,3471,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-29 16:16:22',0,'','0000-00-00 00:00:00',1750000,259,1750259,4,1,'0000-00-00',0),
(260,3584,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-30 11:57:17',0,'','0000-00-00 00:00:00',1750000,260,1750260,4,1,'0000-00-00',0),
(261,3244,15,'KELAS MATERI','Vidio Pembahasan dan Latihan','<p>CBT + VIDIO PEMBAHASAN</p>','2024-07-30 17:50:45',0,'','0000-00-00 00:00:00',1750000,261,1750261,4,1,'0000-00-00',0),
(262,3452,16,'Soal Super','100  membantu ujian','<p>Vidio Pembahasan + Latihan soal</p>','2024-08-01 21:25:57',1,'','2024-08-01 21:26:26',2100000,262,2100262,29,1,'2024-09-01',0),
(263,3685,16,'Soal Super','100  membantu ujian','<p>Vidio Pembahasan + Latihan soal</p>','2024-08-13 16:45:40',0,'','0000-00-00 00:00:00',2100000,263,2100263,29,1,'0000-00-00',0),
(264,3679,14,'Premium','1000 soal','<p>Prediksi soal dengan keabsahan kemiripan 60-80%</p>','2024-09-23 11:53:52',1,'','2024-09-23 11:55:27',350000,264,350264,28,2,'2024-11-23',0);

/*Table structure for table `app_order_payment` */

DROP TABLE IF EXISTS `app_order_payment`;

CREATE TABLE `app_order_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `is_paid` int(11) NOT NULL,
  `payment` varchar(30) NOT NULL,
  `payment_date` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `app_order_payment` */

insert  into `app_order_payment`(`id`,`order_id`,`created_date`,`is_paid`,`payment`,`payment_date`,`total`,`log_id`) values 
(129,59,'2024-03-17 11:24:54',0,'','0000-00-00 00:00:00',1500059,0),
(130,60,'2024-03-17 18:40:48',0,'','0000-00-00 00:00:00',600060,0),
(131,60,'2024-03-17 20:07:52',0,'','0000-00-00 00:00:00',600060,0),
(132,64,'2024-03-19 04:17:45',0,'','0000-00-00 00:00:00',600064,0),
(133,86,'2024-04-02 08:47:42',0,'','0000-00-00 00:00:00',600086,0),
(134,86,'2024-04-02 08:48:06',0,'','0000-00-00 00:00:00',600086,0),
(135,86,'2024-04-02 08:48:55',0,'','0000-00-00 00:00:00',600086,0),
(136,86,'2024-04-02 08:52:44',0,'','0000-00-00 00:00:00',600086,0),
(137,87,'2024-04-02 08:52:53',0,'','0000-00-00 00:00:00',10087,0),
(138,88,'2024-04-03 03:13:14',0,'','0000-00-00 00:00:00',600088,0),
(139,88,'2024-04-03 03:14:09',0,'','0000-00-00 00:00:00',600088,0),
(140,88,'2024-04-03 03:14:30',0,'','0000-00-00 00:00:00',600088,0),
(141,89,'2024-04-03 03:15:15',0,'','0000-00-00 00:00:00',2000089,0),
(142,90,'2024-04-03 03:15:53',0,'','0000-00-00 00:00:00',10090,0),
(143,90,'2024-04-03 03:16:27',0,'','0000-00-00 00:00:00',10090,0),
(144,92,'2024-05-10 10:20:21',0,'','0000-00-00 00:00:00',10092,0),
(145,93,'2024-05-13 10:16:35',0,'','0000-00-00 00:00:00',0,0),
(146,94,'2024-05-13 10:16:48',0,'','0000-00-00 00:00:00',600094,0),
(147,95,'2024-05-14 15:58:13',0,'','0000-00-00 00:00:00',600095,0),
(148,96,'2024-05-16 17:19:49',0,'','0000-00-00 00:00:00',2000096,0),
(149,97,'2024-05-16 17:19:57',0,'','0000-00-00 00:00:00',10097,0),
(150,98,'2024-05-27 22:29:47',0,'','0000-00-00 00:00:00',600098,0),
(151,102,'2024-05-29 14:14:22',0,'','0000-00-00 00:00:00',600102,0),
(152,102,'2024-05-29 14:15:40',0,'','0000-00-00 00:00:00',600102,0),
(153,102,'2024-05-29 14:16:30',0,'','0000-00-00 00:00:00',600102,0);

/*Table structure for table `app_product` */

DROP TABLE IF EXISTS `app_product`;

CREATE TABLE `app_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `content_short` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_promo` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL COMMENT '0=>unlimited,time_limit>0 = expired bulan',
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `publish` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_product` */

insert  into `app_product`(`id`,`title`,`subtitle`,`image`,`category_id`,`content`,`content_short`,`created_date`,`created_by`,`price`,`price_promo`,`time_limit`,`modified_date`,`modified_by`,`publish`) values 
(12,'Belajar mandiri','Masuk Apoteker','',27,'<p>Kerjakan soal, baca pembahasan kemudian lihat vidio pembahasan</p>','','2024-06-12 21:37:06',6,150000,500000,1,'2024-08-01 21:11:52',6,0),
(13,'INTENSIF WIFI UKAI','ALUMNI','',26,'<p>KUIS MATERI &amp; VIDIO</p>','','2024-06-14 14:50:10',6,2100000,3500000,1,'2024-08-01 21:11:59',6,0),
(14,'Premium','1000 soal','',28,'<p>Prediksi soal dengan keabsahan kemiripan 60-80%</p>','','2024-06-18 21:38:30',6,350000,650000,2,'0000-00-00 00:00:00',0,1),
(15,'KELAS MATERI','Vidio Pembahasan dan Latihan','',4,'<p>CBT + VIDIO PEMBAHASAN</p>','','2024-07-06 09:37:09',6,1750000,1900000,1,'2024-08-01 21:12:11',6,0),
(16,'Soal Super','100  membantu ujian','',29,'<p>Vidio Pembahasan + Latihan soal</p>','','2024-08-01 21:25:47',6,2100000,2500000,1,'0000-00-00 00:00:00',0,1);

/*Table structure for table `app_quiz_done` */

DROP TABLE IF EXISTS `app_quiz_done`;

CREATE TABLE `app_quiz_done` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `member_code` varchar(30) DEFAULT NULL,
  `member_class` text DEFAULT NULL,
  `member_fullname` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `start_time_real` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `check_point` datetime DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `answer_temp` text DEFAULT NULL COMMENT 'fungsinya untuk autosave',
  `schedule_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `course_material_id` int(11) NOT NULL,
  `course_material_id_void` int(11) NOT NULL,
  `quiz_duration` int(11) DEFAULT NULL,
  `quiz_title_id` varchar(255) DEFAULT NULL,
  `quiz_code` varchar(20) DEFAULT NULL,
  `benar` int(11) DEFAULT NULL,
  `salah` int(11) DEFAULT NULL,
  `tidak_jawab` int(11) DEFAULT NULL,
  `score_master` int(11) NOT NULL,
  `kkm` int(11) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `score_complex` decimal(5,2) DEFAULT NULL,
  `score_essay` decimal(5,2) DEFAULT NULL,
  `is_done` int(11) DEFAULT 0,
  `ip_address` varchar(50) DEFAULT NULL,
  `browser_key` text DEFAULT NULL,
  `is_listening` int(11) NOT NULL,
  `acak` text DEFAULT NULL,
  `acak_pilihan` text DEFAULT NULL,
  `custom_score` tinyint(4) DEFAULT NULL,
  `poin_benar` int(11) DEFAULT NULL,
  `poin_salah` int(11) DEFAULT NULL,
  `poin_kosong` int(11) DEFAULT NULL,
  `poin_A` int(11) DEFAULT NULL,
  `poin_B` int(11) DEFAULT NULL,
  `poin_C` int(11) DEFAULT NULL,
  `poin_D` int(11) DEFAULT NULL,
  `poin_E` int(11) DEFAULT NULL,
  `poin_F` int(11) DEFAULT NULL,
  `poin_G` int(11) DEFAULT NULL,
  `poin_H` int(11) DEFAULT NULL,
  `poin_I` int(11) DEFAULT NULL,
  `poin_J` int(11) DEFAULT NULL,
  `ragu` text DEFAULT NULL,
  `bahas_log` datetime DEFAULT NULL,
  `is_void` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ujian_kunci` (`schedule_id`,`member_id`) USING BTREE,
  UNIQUE KEY `ujian_token_index` (`token`),
  KEY `ujian_quiz_index` (`quiz_id`),
  KEY `ujian_class_index` (`member_class`(200)) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_quiz_done` */

insert  into `app_quiz_done`(`id`,`token`,`uniqid`,`member_id`,`member_code`,`member_class`,`member_fullname`,`start_time`,`start_time_real`,`end_time`,`check_point`,`answer`,`answer_temp`,`schedule_id`,`quiz_id`,`course_material_id`,`course_material_id_void`,`quiz_duration`,`quiz_title_id`,`quiz_code`,`benar`,`salah`,`tidak_jawab`,`score_master`,`kkm`,`score`,`score_complex`,`score_essay`,`is_done`,`ip_address`,`browser_key`,`is_listening`,`acak`,`acak_pilihan`,`custom_score`,`poin_benar`,`poin_salah`,`poin_kosong`,`poin_A`,`poin_B`,`poin_C`,`poin_D`,`poin_E`,`poin_F`,`poin_G`,`poin_H`,`poin_I`,`poin_J`,`ragu`,`bahas_log`,`is_void`) values 
(34,'6a7cdd4ab8a34354a516efa13ba3dcc2',NULL,5,'rajaqr2','','rajaqr2','2025-01-10 13:29:34','2025-01-10 13:29:34','2025-01-10 13:29:41','2025-01-10 13:29:41','{\"1\":\"E\",\"2\":\"D\"}','{\"1\":\"E\",\"2\":\"D\"}',NULL,2,204,0,90,'Test','Test',0,2,0,100,70,0.00,0.00,0.00,1,'114.10.47.50','',0,'1,2','{\"1\":[\"C\",\"E\",\"A\",\"D\",\"B\"],\"2\":[\"C\",\"B\",\"D\",\"A\",\"E\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,0),
(35,'void_1715dbff18bdbdb0388751cd6b2981c6',NULL,5,'rajaqr2','','rajaqr2','2025-01-10 13:29:49','2025-01-10 13:29:49','2025-01-10 13:29:56','2025-01-10 13:29:56','{\"1\":\"A\",\"2\":\"B\"}','{\"1\":\"A\",\"2\":\"B\"}',NULL,2,0,205,90,'Test','Test',0,2,0,100,70,0.00,0.00,0.00,1,'114.10.47.50','',0,'2,1','{\"1\":[\"B\",\"D\",\"A\",\"C\",\"E\"],\"2\":[\"C\",\"A\",\"E\",\"D\",\"B\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,1),
(36,'dce88c770fef81887528833dd47e27f3',NULL,2,'1001','Production','Alex rudianto','2025-01-10 13:34:16','2025-01-10 13:34:16','2025-01-10 13:35:14','2025-01-10 13:35:14','{\"1\":\"A\",\"2\":\"E\"}','{\"1\":\"A\",\"2\":\"E\"}',NULL,2,214,0,90,'Test','Test',0,2,0,100,70,0.00,0.00,0.00,1,'103.144.211.162','',0,'2,1','{\"1\":[\"A\",\"B\",\"E\",\"D\",\"C\"],\"2\":[\"B\",\"A\",\"D\",\"E\",\"C\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,0),
(37,'void_f4f4b32139f36d7ae29bf8ce8628051c',NULL,2,'1001','Production','Alex rudianto','2025-01-10 13:35:47','2025-01-10 13:35:47','2025-01-10 13:36:04','2025-01-10 13:36:04','{\"1\":\"D\",\"2\":\"A\"}','{\"1\":\"D\",\"2\":\"A\"}',NULL,2,0,215,90,'Test','Test',1,1,0,100,70,50.00,0.00,0.00,1,'114.5.200.251','',0,'2,1','{\"1\":[\"A\",\"E\",\"D\",\"C\",\"B\"],\"2\":[\"C\",\"E\",\"A\",\"D\",\"B\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,1),
(38,'void_dd160f2a394923935d011da3ab59d6aa',NULL,5,'rajaqr2','','rajaqr2','2025-01-10 13:36:24','2025-01-10 13:36:24','2025-01-10 13:36:31','2025-01-10 13:36:31','{\"1\":\"A\",\"2\":\"B\"}','{\"1\":\"A\",\"2\":\"B\"}',NULL,2,0,205,90,'Test','Test',0,2,0,100,70,0.00,0.00,0.00,1,'114.10.47.50','',0,'2,1','{\"1\":[\"B\",\"E\",\"C\",\"A\",\"D\"],\"2\":[\"B\",\"A\",\"D\",\"E\",\"C\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,1),
(39,'void_c5df3089cc19ee80b20f780183259510',NULL,2,'1001','Production','Alex rudianto','2025-01-10 13:38:32','2025-01-10 13:38:32','2025-01-10 13:38:48','2025-01-10 13:38:48','{\"1\":\"C\",\"2\":\"A\"}','{\"1\":\"C\",\"2\":\"A\"}',NULL,2,0,215,90,'Test','Test',2,0,0,100,70,100.00,0.00,0.00,1,'103.144.211.162','',0,'2,1','{\"1\":[\"D\",\"B\",\"E\",\"A\",\"C\"],\"2\":[\"D\",\"C\",\"A\",\"B\",\"E\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,1),
(40,'1e6db99ee654c187d72f5c5a4d74dd08',NULL,5,'rajaqr2','','rajaqr2','2025-01-10 13:59:48','2025-01-10 13:59:48','2025-01-10 15:31:06','2025-01-10 15:31:06','{\"1\":null,\"2\":null}','{\"1\":null,\"2\":null}',NULL,2,205,0,90,'Test','Test',0,0,2,100,70,0.00,0.00,0.00,1,'114.10.47.50','',0,'2,1','{\"1\":[\"C\",\"B\",\"D\",\"E\",\"A\"],\"2\":[\"A\",\"D\",\"B\",\"E\",\"C\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,0),
(41,'58370acd5317d176caa15073266aad55',NULL,2,'1001','Production','Alex rudianto','2025-01-10 14:30:56','2025-01-10 14:30:56','2025-01-10 14:31:04','2025-01-10 14:31:04','{\"1\":\"A\",\"2\":\"C\"}','{\"1\":\"A\",\"2\":\"C\"}',NULL,2,215,0,90,'Test','Test',2,0,0,100,70,200.00,0.00,0.00,1,'114.5.200.251','',0,'1,2','{\"1\":[\"A\",\"C\",\"E\",\"D\",\"B\"],\"2\":[\"B\",\"A\",\"E\",\"C\",\"D\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,0),
(42,'ce375410224eb75eedab16d612683c1b',NULL,2,'1001','Production','Alex rudianto','2025-03-19 12:04:41','2025-03-19 12:04:41','2025-03-19 12:06:48','2025-03-19 12:06:48','{\"1\":\"A\",\"2\":\"A\",\"3\":\"B\",\"4\":\"D\",\"5\":\"D\",\"6\":\"B\",\"7\":\"B\",\"8\":\"C\",\"9\":\"D\",\"10\":\"C\",\"11\":\"D\",\"12\":\"B\",\"13\":\"B\",\"14\":\"A\",\"15\":\"A\",\"16\":\"B\",\"17\":\"D\",\"18\":\"D\",\"19\":\"D\",\"20\":\"A\",\"21\":\"B\",\"22\":\"C\",\"23\":\"D\",\"24\":\"D\",\"25\":\"A\",\"26\":\"C\",\"27\":\"D\",\"28\":\"B\",\"29\":\"D\",\"30\":\"C\",\"31\":\"B\",\"32\":\"C\",\"33\":\"B\",\"34\":\"B\",\"35\":\"C\",\"36\":\"C\",\"37\":\"A\",\"38\":\"D\",\"39\":\"B\",\"40\":\"C\",\"41\":\"C\",\"42\":\"B\",\"43\":\"C\",\"44\":\"C\",\"45\":\"D\",\"46\":\"A\",\"47\":\"C\",\"48\":\"B\",\"49\":\"A\",\"50\":\"C\"}','{\"1\":\"A\",\"2\":\"A\",\"3\":\"B\",\"4\":\"D\",\"5\":\"D\",\"6\":\"B\",\"7\":\"B\",\"8\":\"C\",\"9\":\"D\",\"10\":\"C\",\"11\":\"D\",\"12\":\"B\",\"13\":\"B\",\"14\":\"A\",\"15\":\"A\",\"16\":\"B\",\"17\":\"D\",\"18\":\"D\",\"19\":\"D\",\"20\":\"A\",\"21\":\"B\",\"22\":\"C\",\"23\":\"D\",\"24\":\"D\",\"25\":\"A\",\"26\":\"C\",\"27\":\"D\",\"28\":\"B\",\"29\":\"D\",\"30\":\"C\",\"31\":\"B\",\"32\":\"C\",\"33\":\"B\",\"34\":\"B\",\"35\":\"C\",\"36\":\"C\",\"37\":\"A\",\"38\":\"D\",\"39\":\"B\",\"40\":\"C\",\"41\":\"C\",\"42\":\"B\",\"43\":\"C\",\"44\":\"C\",\"45\":\"D\",\"46\":\"A\",\"47\":\"C\",\"48\":\"B\",\"49\":\"A\",\"50\":\"C\"}',NULL,3,218,0,90,'Pineapple Irrigation','Pineapple-Irrigation',14,36,0,100,70,128.00,0.00,0.00,1,'114.5.200.251','',0,'11,47,38,13,39,19,30,7,22,24,25,21,37,31,27,43,44,41,23,29,34,52,18,40,46,6,49,15,33,42,32,17,3,26,51,35,5,8,10,28,9,50,45,12,14,36,4,48,20,16','{\"3\":[\"A\",\"C\",\"D\",\"E\",\"B\"],\"4\":[\"E\",\"D\",\"A\",\"C\",\"B\"],\"5\":[\"E\",\"B\",\"C\",\"A\",\"D\"],\"6\":[\"A\",\"B\",\"D\",\"C\",\"E\"],\"7\":[\"E\",\"D\",\"A\",\"B\",\"C\"],\"8\":[\"E\",\"A\",\"C\",\"D\",\"B\"],\"9\":[\"A\",\"D\",\"E\",\"B\",\"C\"],\"10\":[\"A\",\"C\",\"E\",\"B\",\"D\"],\"11\":[\"D\",\"E\",\"A\",\"C\",\"B\"],\"12\":[\"E\",\"D\",\"B\",\"C\",\"A\"],\"13\":[\"A\",\"E\",\"B\",\"D\",\"C\"],\"14\":[\"A\",\"B\",\"E\",\"D\",\"C\"],\"15\":[\"C\",\"A\",\"B\",\"D\",\"E\"],\"16\":[\"B\",\"D\",\"C\",\"A\",\"E\"],\"17\":[\"E\",\"D\",\"A\",\"B\",\"C\"],\"18\":[\"E\",\"C\",\"D\",\"B\",\"A\"],\"19\":[\"D\",\"E\",\"B\",\"A\",\"C\"],\"20\":[\"C\",\"D\",\"B\",\"A\",\"E\"],\"21\":[\"A\",\"E\",\"C\",\"D\",\"B\"],\"22\":[\"A\",\"C\",\"E\",\"B\",\"D\"],\"23\":[\"A\",\"E\",\"B\",\"D\",\"C\"],\"24\":[\"B\",\"D\",\"A\",\"C\",\"E\"],\"25\":[\"B\",\"A\",\"C\",\"E\",\"D\"],\"26\":[\"C\",\"E\",\"A\",\"B\",\"D\"],\"27\":[\"B\",\"E\",\"D\",\"A\",\"C\"],\"28\":[\"A\",\"B\",\"D\",\"E\",\"C\"],\"29\":[\"B\",\"D\",\"E\",\"A\",\"C\"],\"30\":[\"D\",\"C\",\"A\",\"E\",\"B\"],\"31\":[\"C\",\"E\",\"B\",\"D\",\"A\"],\"32\":[\"A\",\"D\",\"B\",\"E\",\"C\"],\"33\":[\"A\",\"B\",\"D\",\"E\",\"C\"],\"34\":[\"C\",\"E\",\"A\",\"D\",\"B\"],\"35\":[\"A\",\"E\",\"B\",\"C\",\"D\"],\"36\":[\"B\",\"D\",\"E\",\"A\",\"C\"],\"37\":[\"D\",\"E\",\"A\",\"B\",\"C\"],\"38\":[\"A\",\"E\",\"D\",\"B\",\"C\"],\"39\":[\"C\",\"A\",\"D\",\"E\",\"B\"],\"40\":[\"C\",\"A\",\"E\",\"D\",\"B\"],\"41\":[\"B\",\"E\",\"A\",\"D\",\"C\"],\"42\":[\"E\",\"A\",\"C\",\"D\",\"B\"],\"43\":[\"A\",\"C\",\"E\",\"B\",\"D\"],\"44\":[\"C\",\"A\",\"B\",\"D\",\"E\"],\"45\":[\"E\",\"D\",\"B\",\"C\",\"A\"],\"46\":[\"C\",\"D\",\"A\",\"B\",\"E\"],\"47\":[\"D\",\"A\",\"E\",\"C\",\"B\"],\"48\":[\"A\",\"E\",\"D\",\"B\",\"C\"],\"49\":[\"E\",\"C\",\"B\",\"D\",\"A\"],\"50\":[\"A\",\"E\",\"B\",\"D\",\"C\"],\"51\":[\"E\",\"D\",\"B\",\"C\",\"A\"],\"52\":[\"E\",\"B\",\"D\",\"C\",\"A\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,0),
(43,'void_eea1c338f329dc15728906d6406d0c46',NULL,2,'1001','Production','Alex rudianto','2025-03-19 13:08:32','2025-03-19 13:08:32','2025-03-19 13:13:31','2025-03-19 13:13:31','{\"1\":\"B\",\"2\":\"C\",\"3\":\"A\",\"4\":\"D\",\"5\":\"D\",\"6\":\"B\",\"7\":\"C\",\"8\":\"D\",\"9\":\"A\",\"10\":\"A\",\"11\":\"A\",\"12\":\"D\",\"13\":\"D\",\"14\":\"A\",\"15\":\"D\",\"16\":\"D\",\"17\":\"A\",\"18\":\"D\",\"19\":\"D\",\"20\":\"D\",\"21\":\"A\",\"22\":\"B\",\"23\":\"B\",\"24\":\"D\",\"25\":\"D\",\"26\":\"D\",\"27\":\"C\",\"28\":\"A\",\"29\":\"A\",\"30\":\"A\",\"31\":\"C\",\"32\":\"C\",\"33\":\"B\",\"34\":\"B\",\"35\":\"B\",\"36\":\"C\",\"37\":\"C\",\"38\":\"B\",\"39\":\"B\",\"40\":\"A\",\"41\":\"C\",\"42\":\"A\",\"43\":\"C\",\"44\":\"D\",\"45\":\"D\",\"46\":\"D\",\"47\":\"D\",\"48\":\"D\",\"49\":\"D\",\"50\":\"A\"}','{\"1\":\"B\",\"2\":\"C\",\"3\":\"A\",\"4\":\"D\",\"5\":\"D\",\"6\":\"B\",\"7\":\"C\",\"8\":\"D\",\"9\":\"A\",\"10\":\"A\",\"11\":\"A\",\"12\":\"D\",\"13\":\"D\",\"14\":\"A\",\"15\":\"D\",\"16\":\"D\",\"17\":\"A\",\"18\":\"D\",\"19\":\"D\",\"20\":\"D\",\"21\":\"A\",\"22\":\"B\",\"23\":\"B\",\"24\":\"D\",\"25\":\"D\",\"26\":\"D\",\"27\":\"C\",\"28\":\"A\",\"29\":\"A\",\"30\":\"A\",\"31\":\"C\",\"32\":\"C\",\"33\":\"B\",\"34\":\"B\",\"35\":\"B\",\"36\":\"C\",\"37\":\"C\",\"38\":\"B\",\"39\":\"B\",\"40\":\"A\",\"41\":\"C\",\"42\":\"A\",\"43\":\"C\",\"44\":\"D\",\"45\":\"D\",\"46\":\"D\",\"47\":\"D\",\"48\":\"D\",\"49\":\"D\",\"50\":\"A\"}',NULL,3,0,219,90,'Pineapple Irrigation','Pineapple-Irrigation',43,7,0,100,70,86.00,0.00,0.00,1,'114.5.200.251','',0,'3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52','{\"3\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"4\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"5\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"6\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"7\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"8\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"9\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"10\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"11\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"12\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"13\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"14\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"15\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"16\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"17\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"18\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"19\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"20\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"21\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"22\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"23\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"24\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"25\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"26\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"27\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"28\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"29\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"30\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"31\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"32\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"33\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"34\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"35\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"36\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"37\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"38\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"39\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"40\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"41\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"42\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"43\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"44\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"45\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"46\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"47\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"48\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"49\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"50\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"51\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"52\":[\"A\",\"B\",\"C\",\"D\",\"E\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,1),
(44,'d93270744cf7f356b081f4876c91eb54',NULL,37,'1001','Production','Alex Ruddin','2025-03-19 13:19:03','2025-03-19 13:19:03','2025-03-19 13:22:37','2025-03-19 13:22:37','{\"1\":\"B\",\"2\":\"C\",\"3\":\"A\",\"4\":\"D\",\"5\":\"D\",\"6\":\"B\",\"7\":\"C\",\"8\":\"D\",\"9\":\"A\",\"10\":\"A\",\"11\":\"A\",\"12\":\"D\",\"13\":\"D\",\"14\":\"A\",\"15\":\"D\",\"16\":\"D\",\"17\":\"A\",\"18\":\"D\",\"19\":\"D\",\"20\":\"D\",\"21\":\"A\",\"22\":\"B\",\"23\":\"B\",\"24\":\"D\",\"25\":\"D\",\"26\":\"D\",\"27\":\"C\",\"28\":\"B\",\"29\":\"A\",\"30\":\"B\",\"31\":\"C\",\"32\":\"C\",\"33\":\"D\",\"34\":\"B\",\"35\":\"B\",\"36\":\"C\",\"37\":\"D\",\"38\":\"D\",\"39\":\"C\",\"40\":\"C\",\"41\":\"D\",\"42\":\"D\",\"43\":\"B\",\"44\":\"C\",\"45\":\"D\",\"46\":\"D\",\"47\":\"D\",\"48\":\"D\",\"49\":\"C\",\"50\":\"A\"}','{\"1\":\"B\",\"2\":\"C\",\"3\":\"A\",\"4\":\"D\",\"5\":\"D\",\"6\":\"B\",\"7\":\"C\",\"8\":\"D\",\"9\":\"A\",\"10\":\"A\",\"11\":\"A\",\"12\":\"D\",\"13\":\"D\",\"14\":\"A\",\"15\":\"D\",\"16\":\"D\",\"17\":\"A\",\"18\":\"D\",\"19\":\"D\",\"20\":\"D\",\"21\":\"A\",\"22\":\"B\",\"23\":\"B\",\"24\":\"D\",\"25\":\"D\",\"26\":\"D\",\"27\":\"C\",\"28\":\"B\",\"29\":\"A\",\"30\":\"B\",\"31\":\"C\",\"32\":\"C\",\"33\":\"D\",\"34\":\"B\",\"35\":\"B\",\"36\":\"C\",\"37\":\"D\",\"38\":\"D\",\"39\":\"C\",\"40\":\"C\",\"41\":\"D\",\"42\":\"D\",\"43\":\"B\",\"44\":\"C\",\"45\":\"D\",\"46\":\"D\",\"47\":\"D\",\"48\":\"D\",\"49\":\"C\",\"50\":\"A\"}',NULL,3,218,0,90,'Pineapple Irrigation','Pineapple-Irrigation',42,8,0,100,70,84.00,0.00,0.00,1,'114.5.200.251','',0,'3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52','{\"3\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"4\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"5\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"6\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"7\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"8\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"9\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"10\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"11\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"12\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"13\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"14\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"15\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"16\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"17\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"18\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"19\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"20\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"21\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"22\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"23\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"24\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"25\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"26\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"27\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"28\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"29\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"30\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"31\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"32\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"33\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"34\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"35\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"36\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"37\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"38\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"39\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"40\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"41\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"42\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"43\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"44\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"45\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"46\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"47\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"48\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"49\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"50\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"51\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"52\":[\"A\",\"B\",\"C\",\"D\",\"E\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,0),
(45,'2894d30218b959dfb103537b4a67b28e',NULL,37,'1001','Production','Alex Ruddin','2025-03-19 13:28:19','2025-03-19 13:28:19','2025-03-19 13:35:31','2025-03-19 13:35:31','{\"1\":\"D\",\"2\":\"C\",\"3\":\"A\",\"4\":\"D\",\"5\":\"D\",\"6\":\"B\",\"7\":\"C\",\"8\":\"D\",\"9\":\"A\",\"10\":\"A\",\"11\":\"A\",\"12\":\"D\",\"13\":\"D\",\"14\":\"A\",\"15\":\"D\",\"16\":\"D\",\"17\":\"A\",\"18\":\"D\",\"19\":\"D\",\"20\":\"D\",\"21\":\"A\",\"22\":\"B\",\"23\":\"B\",\"24\":\"D\",\"25\":\"D\",\"26\":\"D\",\"27\":\"C\",\"28\":\"B\",\"29\":\"A\",\"30\":\"B\",\"31\":\"C\",\"32\":\"C\",\"33\":\"D\",\"34\":\"B\",\"35\":\"B\",\"36\":\"C\",\"37\":\"C\",\"38\":\"D\",\"39\":\"B\",\"40\":\"A\",\"41\":\"C\",\"42\":\"A\",\"43\":\"B\",\"44\":\"B\",\"45\":\"D\",\"46\":\"D\",\"47\":\"D\",\"48\":\"A\",\"49\":\"D\",\"50\":\"A\"}','{\"1\":\"D\",\"2\":\"C\",\"3\":\"A\",\"4\":\"D\",\"5\":\"D\",\"6\":\"B\",\"7\":\"C\",\"8\":\"D\",\"9\":\"A\",\"10\":\"A\",\"11\":\"A\",\"12\":\"D\",\"13\":\"D\",\"14\":\"A\",\"15\":\"D\",\"16\":\"D\",\"17\":\"A\",\"18\":\"D\",\"19\":\"D\",\"20\":\"D\",\"21\":\"A\",\"22\":\"B\",\"23\":\"B\",\"24\":\"D\",\"25\":\"D\",\"26\":\"D\",\"27\":\"C\",\"28\":\"B\",\"29\":\"A\",\"30\":\"B\",\"31\":\"C\",\"32\":\"C\",\"33\":\"D\",\"34\":\"B\",\"35\":\"B\",\"36\":\"C\",\"37\":\"C\",\"38\":\"D\",\"39\":\"B\",\"40\":\"A\",\"41\":\"C\",\"42\":\"A\",\"43\":\"B\",\"44\":\"B\",\"45\":\"D\",\"46\":\"D\",\"47\":\"D\",\"48\":\"A\",\"49\":\"D\",\"50\":\"A\"}',NULL,3,219,0,90,'Pineapple Irrigation','Pineapple-Irrigation',49,1,0,100,70,980.00,0.00,0.00,1,'103.144.211.162','',0,'3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52','{\"3\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"4\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"5\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"6\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"7\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"8\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"9\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"10\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"11\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"12\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"13\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"14\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"15\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"16\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"17\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"18\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"19\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"20\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"21\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"22\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"23\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"24\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"25\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"26\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"27\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"28\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"29\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"30\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"31\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"32\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"33\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"34\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"35\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"36\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"37\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"38\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"39\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"40\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"41\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"42\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"43\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"44\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"45\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"46\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"47\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"48\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"49\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"50\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"51\":[\"A\",\"B\",\"C\",\"D\",\"E\"],\"52\":[\"A\",\"B\",\"C\",\"D\",\"E\"]}',3,0,0,0,0,0,0,0,0,0,0,0,0,0,'null',NULL,0);

/*Table structure for table `app_quiz_done_complex` */

DROP TABLE IF EXISTS `app_quiz_done_complex`;

CREATE TABLE `app_quiz_done_complex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz_done` bigint(11) NOT NULL,
  `answer` text NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `tidak_jawab` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_quiz_done` (`id_quiz_done`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_quiz_done_complex` */

/*Table structure for table `app_quiz_done_essay` */

DROP TABLE IF EXISTS `app_quiz_done_essay`;

CREATE TABLE `app_quiz_done_essay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz_done` bigint(11) NOT NULL,
  `id_quiz_essay` int(11) NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `score_persen` decimal(5,2) NOT NULL,
  `is_done` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_quiz_done_id_quiz_essay` (`id_quiz_done`,`id_quiz_essay`),
  KEY `id_quiz_essay` (`id_quiz_essay`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_quiz_done_essay` */

/*Table structure for table `app_quiz_done_kd` */

DROP TABLE IF EXISTS `app_quiz_done_kd`;

CREATE TABLE `app_quiz_done_kd` (
  `id_quiz_done` int(11) NOT NULL,
  `id_quiz_kd` int(11) NOT NULL,
  `nama_kd` varchar(255) NOT NULL,
  `score` decimal(6,2) NOT NULL,
  `score_max` decimal(6,2) NOT NULL,
  `kkm` decimal(6,2) NOT NULL,
  UNIQUE KEY `id_quiz_done_id_quiz_kd` (`id_quiz_done`,`id_quiz_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_quiz_done_kd` */

insert  into `app_quiz_done_kd`(`id_quiz_done`,`id_quiz_kd`,`nama_kd`,`score`,`score_max`,`kkm`) values 
(34,1,'kom1',0.00,50.00,0.00),
(34,2,'kom2',0.00,50.00,0.00),
(35,1,'kom1',0.00,50.00,0.00),
(35,2,'kom2',0.00,50.00,0.00),
(36,1,'kom1',0.00,50.00,0.00),
(36,2,'kom2',0.00,50.00,0.00),
(37,1,'kom1',50.00,50.00,0.00),
(37,2,'kom2',0.00,50.00,0.00),
(38,1,'kom1',0.00,50.00,0.00),
(38,2,'kom2',0.00,50.00,0.00),
(39,1,'kom1',50.00,50.00,0.00),
(39,2,'kom2',50.00,50.00,0.00),
(40,1,'kom1',0.00,100.00,0.00),
(40,2,'kom2',0.00,100.00,0.00),
(41,1,'kom1',100.00,100.00,0.00),
(41,2,'kom2',100.00,100.00,0.00),
(42,3,'Set-up Engine dan Pompa Sumber Air',6.00,10.00,0.00),
(42,4,'Instalasi Pipa Irigasi',4.00,10.00,0.00),
(42,5,'Instalasi Irigator dan Gun Sprinkler',2.00,10.00,0.00),
(42,6,'Mengoperasikan Engine dan Pompa Irigasi',4.00,10.00,0.00),
(42,7,'Mengoperasikan Unit Irrigator dan Gun Sprinkle',0.00,10.00,0.00),
(42,8,'Melakukan Pengecekan Hasil Kerja Secara Berkala',6.00,10.00,0.00),
(42,9,'Melakukan 5R pada Peralatan dan Engine Irigasi',2.00,10.00,0.00),
(42,10,'Mematikan Pompa  Engine',2.00,10.00,0.00),
(42,11,'Troubleshooting',0.00,10.00,0.00),
(42,12,'Laporan HasilKerjaIrigasi',2.00,10.00,0.00),
(42,13,'Set-up Engine dan Pompa Sumber Air',60.00,100.00,0.00),
(42,14,'Instalasi Pipa Irigasi',40.00,100.00,0.00),
(43,3,'Set-up Engine dan Pompa Sumber Air',10.00,10.00,0.00),
(43,4,'Instalasi Pipa Irigasi',10.00,10.00,0.00),
(43,5,'Instalasi Irigator dan Gun Sprinkler',10.00,10.00,0.00),
(43,6,'Mengoperasikan Engine dan Pompa Irigasi',10.00,10.00,0.00),
(43,7,'Mengoperasikan Unit Irrigator dan Gun Sprinkle',10.00,10.00,0.00),
(43,8,'Melakukan Pengecekan Hasil Kerja Secara Berkala',6.00,10.00,0.00),
(43,9,'Melakukan 5R pada Peralatan dan Engine Irigasi',8.00,10.00,0.00),
(43,10,'Mematikan Pompa  Engine',8.00,10.00,0.00),
(43,11,'Troubleshooting',6.00,10.00,0.00),
(43,12,'Laporan HasilKerjaIrigasi',8.00,10.00,0.00),
(44,3,'Set-up Engine dan Pompa Sumber Air',10.00,10.00,0.00),
(44,4,'Instalasi Pipa Irigasi',10.00,10.00,0.00),
(44,5,'Instalasi Irigator dan Gun Sprinkler',10.00,10.00,0.00),
(44,6,'Mengoperasikan Engine dan Pompa Irigasi',10.00,10.00,0.00),
(44,7,'Mengoperasikan Unit Irrigator dan Gun Sprinkle',10.00,10.00,0.00),
(44,8,'Melakukan Pengecekan Hasil Kerja Secara Berkala',10.00,10.00,0.00),
(44,9,'Melakukan 5R pada Peralatan dan Engine Irigasi',10.00,10.00,0.00),
(44,10,'Mematikan Pompa  Engine',4.00,10.00,0.00),
(44,11,'Troubleshooting',4.00,10.00,0.00),
(44,12,'Laporan HasilKerjaIrigasi',6.00,10.00,0.00),
(45,3,'Set-up Engine dan Pompa Sumber Air',80.00,100.00,0.00),
(45,4,'Instalasi Pipa Irigasi',100.00,100.00,0.00),
(45,5,'Instalasi Irigator dan Gun Sprinkler',100.00,100.00,0.00),
(45,6,'Mengoperasikan Engine dan Pompa Irigasi',100.00,100.00,0.00),
(45,7,'Mengoperasikan Unit Irrigator dan Gun Sprinkle',100.00,100.00,0.00),
(45,8,'Melakukan Pengecekan Hasil Kerja Secara Berkala',100.00,100.00,0.00),
(45,9,'Melakukan 5R pada Peralatan dan Engine Irigasi',100.00,100.00,0.00),
(45,10,'Mematikan Pompa  Engine',100.00,100.00,0.00),
(45,11,'Troubleshooting',100.00,100.00,0.00),
(45,12,'Laporan HasilKerjaIrigasi',100.00,100.00,0.00);

/*Table structure for table `app_quiz_done_kd_essay` */

DROP TABLE IF EXISTS `app_quiz_done_kd_essay`;

CREATE TABLE `app_quiz_done_kd_essay` (
  `id_quiz_done` int(11) NOT NULL,
  `id_quiz_kd` int(11) NOT NULL,
  `nama_kd` varchar(255) NOT NULL,
  `score` decimal(6,2) NOT NULL,
  `score_max` decimal(6,2) NOT NULL,
  `kkm` decimal(6,2) NOT NULL,
  UNIQUE KEY `id_quiz_done_id_quiz_kd` (`id_quiz_done`,`id_quiz_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_quiz_done_kd_essay` */

/*Table structure for table `app_quiz_done_paket` */

DROP TABLE IF EXISTS `app_quiz_done_paket`;

CREATE TABLE `app_quiz_done_paket` (
  `quiz_done_id` bigint(11) NOT NULL,
  `pg` text NOT NULL,
  `essay` text NOT NULL,
  `complex` text NOT NULL,
  KEY `quiz_done_id` (`quiz_done_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_quiz_done_paket` */

insert  into `app_quiz_done_paket`(`quiz_done_id`,`pg`,`essay`,`complex`) values 
(34,'1,2','',''),
(35,'2,1','',''),
(36,'2,1','',''),
(37,'2,1','',''),
(38,'2,1','',''),
(39,'2,1','',''),
(40,'2,1','',''),
(41,'1,2','',''),
(42,'11,47,38,13,39,19,30,7,22,24,25,21,37,31,27,43,44,41,23,29,34,52,18,40,46,6,49,15,33,42,32,17,3,26,51,35,5,8,10,28,9,50,45,12,14,36,4,48,20,16','',''),
(43,'3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52','',''),
(44,'3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52','',''),
(45,'3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52','','');

/*Table structure for table `app_quiz_request` */

DROP TABLE IF EXISTS `app_quiz_request`;

CREATE TABLE `app_quiz_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT 0,
  `course_material_id` int(11) DEFAULT 0,
  `quiz_done_id` bigint(11) DEFAULT 0 COMMENT 'quiz_done_id failed',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `approved_by` int(11) DEFAULT 0,
  `approved_at` datetime DEFAULT '0000-00-00 00:00:00',
  `disapprove_by` int(11) DEFAULT 0,
  `disapprove_at` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `quiz_done_id_course_material_id` (`quiz_done_id`,`course_material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `app_quiz_request` */

insert  into `app_quiz_request`(`id`,`member_id`,`course_material_id`,`quiz_done_id`,`created_at`,`approved_by`,`approved_at`,`disapprove_by`,`disapprove_at`) values 
(143,5,205,35,'2025-01-10 13:36:04',1,'2025-01-10 13:36:16',0,'0000-00-00 00:00:00'),
(144,2,215,37,'2025-01-10 13:36:21',240,'2025-01-10 13:36:37',0,'0000-00-00 00:00:00'),
(145,5,205,38,'2025-01-10 13:36:36',1,'2025-01-10 13:36:40',0,'0000-00-00 00:00:00'),
(146,2,215,39,'2025-01-10 14:30:40',240,'2025-01-10 14:30:44',0,'0000-00-00 00:00:00'),
(147,2,219,43,'2025-03-19 13:14:41',240,'2025-03-19 13:14:46',0,'0000-00-00 00:00:00');

/*Table structure for table `app_register` */

DROP TABLE IF EXISTS `app_register`;

CREATE TABLE `app_register` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `wa` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `app_register` */

/*Table structure for table `application` */

DROP TABLE IF EXISTS `application`;

CREATE TABLE `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `application` */

insert  into `application`(`id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`tanggal`,`url_id`,`url_en`,`urutan`) values 
(1,'flow-switch-539e8c214b30e.jpg','Flow Switch','<p>Lorem ipsum Lorem ipsumLorem ipsum Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsum<br /><br /></p>','Flow Switch','<p>Lorem ipsum Lorem ipsumLorem ipsum Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsum</p>','2014-05-10','flow-switch','flow-switch',2),
(2,'pressure-539e8c6bdfef3.jpg','Tekanan','<p>Browsing disini cukup menyenangkan sekali. hore aku bisa membaut produk ku sendiri</p>','Pressure','','2014-05-10','tekanan','pressure',4),
(3,'level-switch-539e8c4cd4b44.jpg','Level Switch','<p>Lorem ipsum</p>','Level Switch','<p>Lorem ipsum</p>','2014-05-15','level-switch','level-switch',1),
(4,'temperature-53a359a738b26.jpg','Suhu','<p>Lorem</p>','Temperature','<p>Lorem</p>','2014-05-16','suhu','temperature',3);

/*Table structure for table `block_single_page` */

DROP TABLE IF EXISTS `block_single_page`;

CREATE TABLE `block_single_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul` varchar(100) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `block_single_page` */

insert  into `block_single_page`(`id`,`modul`,`url_id`,`title_id`,`content_id`,`url_en`,`title_en`,`content_en`,`urutan`) values 
(1,'about','about-us','Tentang Kami','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<p>&nbsp;</p>','about-us','About us','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<p>&nbsp;</p>',1),
(2,'summary','summary-about-us','Tentang Kami','<p title=\"jquery-checkbox-examples\">Ada banyak variasi tulisan Lorem Ipsum yang tersedia, tapi kebanyakan sudah mengalami perubahan bentuk, entah karena unsur humor atau kalimat yang diacak hingga nampak sangat tidak masuk akal</p>','summary-about-us','About us','<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text</p>',1),
(15,'contact_footer','contact-us','hubungi kami','<p>Contact us lah</p>','contact-us','contact-us','<p>plesase contact us</p>',0),
(13,'inquiry_atas','','Feel Free to drop us online','<p>Lorem ipsum to do something</p>','','Feel Free to drop us online','<p>lorem ipsum bro</p>',0),
(14,'quickorder','','PROFIL','<p>Lorem ipsum to do something</p>','','PROFILE','<p>lorem ipsum bro</p>',0);

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `summary_id` text NOT NULL,
  `summary_en` text NOT NULL,
  `meta_description_id` varchar(160) NOT NULL,
  `meta_description_en` varchar(160) NOT NULL,
  `tanggal` datetime NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `publish` int(11) NOT NULL,
  `click` int(11) NOT NULL,
  `publisher` varchar(40) NOT NULL,
  `rating` varchar(2) NOT NULL,
  `rating_half` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `blog` */

insert  into `blog`(`id`,`cat_id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`summary_id`,`summary_en`,`meta_description_id`,`meta_description_en`,`tanggal`,`url_id`,`url_en`,`urutan`,`publish`,`click`,`publisher`,`rating`,`rating_half`) values 
(13,16,'model-1753032_1280-585206b225d52.jpg','Wujudkan Kesadaran Lingkungan Melalui Penguatan Pendidikan Karakter','<p>Jakarta, Kemendikbud --- Menteri Pendidikan dan Kebudayaan (Mendikbud) Muhadjir Effendy mengatakan, kesadaran akan lingkungan dan wacana tentang Sustainable Development Goals (SDGs) atau Tujuan Pembangunan Berkelanjutan perlu diberikan kepada para siswa. Seluruh elemen pendidikan perlu menjalankan apa yang disebut sebagai Education for Sustainable Development (ESD). &ldquo;Pendidikan berbasis lingkungan atau pendidikan berbasis keunggulan lokal ini juga sedang kita bangun melalui gerakan Penguatan Pendidikan Karakter (PPK),&rdquo; ujar Mendikbud.<br />&nbsp;<br />Hal tersebut dikemukakannya saat menghadiri acara pemberian penghargaan Adiwiyata Nasional tahun 2016 di Kantor Kementerian Lingkungan Hidup dan Kehutanan, Jakarta (13/12/2016). Sebanyak 489 sekolah mendapatkan Penghargaan Adiwiyata Nasional pada tahun 2016. Adiwiyata merupakan penghargaan yang diberikan kepada sekolah-sekolah yang dinilai telah menjalankan pendidikan lingkungan hidup dan mewujudkan lingkungan sekolah yang peduli dan berbudaya lingkungan hidup.<br />&nbsp;<br />Dalam gerakan Penguatan Pendidikan Karakter (PPK), tutur Mendikbud, semua warga sekolah harus mampu mengintegrasikan, memperdalam, memperluas, sekaligus menyelaraskan semua hal yang berkaitan dengan pendidikan karakter. Pengintegrasian dilakukan pada kegiatan kelas, luar kelas di sekolah, dan luar sekolah (masyarakat/komunitas). Selain itu juga dilakukan perpaduan pada kegiatan intrakurikuler, kokurikuler, dan ekstrakurikuler, serta pelibatan secara serempak warga sekolah, keluarga, dan masyarakat.<br />&nbsp;<br />Mendikbud mengatakan, pendidikan berbasis lingkungan juga membutuhkan kepemimpinan kepala sekolah yang menjadikan sekolahnya sebagai wahana pendidikan lingkungan bagi siswa-siswanya yang menghabiskan banyak waktu di sekolah. Apabila siswa menjalani hari-harinya dengan pembiasaan kepedulian terhadap lingkungan, maka karakter cinta lingkungan akan mengakar pada dirinya.<br />&nbsp;<br />&ldquo;Dari kepala sekolah dan guru yang berdaya, serta didukung masyarakat yang peduli dan mau terlibat, maka akan tumbuh generasi muda yang kontributif terhadap lingkungan di sekitarnya juga terhadap masa depan bumi dan umat manusia,&rdquo; kata Mendikbud.<br />&nbsp;<br />Ia juga menuturkan, dalam praktiknya, PPK mensyaratkan guru-guru yang tidak kaku, melainkan guru-guru yang mampu mengembangkan kurikulum dan menyesuaikannya dengan konteks lokal. &ldquo;Menyesuaikan kurikulum dengan konteks lokal tak sekadar hanya menambahkan muatan konten lokal, namun juga termasuk memanfaatkan segala kekuataan dan kenyataan lingkungan sekitar sebagai media pendidikan bagi siswa,&rdquo; tuturnya.<br />&nbsp;<br />Pada acara pemberian penghargaan Adiwiyata Nasional tahun 2016 itu, Mendikbud juga memberikan apresiasi yang tinggi kepada perwakilan sekolah yang meraih Piagam Adiwiyata Nasional, kampung yang meraih Penghargaan Kampung Iklim, serta para peserta lomba poster lingkungan. Ia mengajak semua pihak untuk terus memperjuangan pendidikan untuk mendukung pembangunan yang berkelanjutan dan berkemajuan.<br />&nbsp;<br />&ldquo;Tujuan pendidikan karakter adalah untuk membangun nilai-nilai kebangsaan, relijius, gotong royong, kemandirian, dan integritas secara masif. Melalui nilai-nilai tersebut saya yakin pendidikan kecintaan pada lingkungan juga akan semakin meningkat,&rdquo; ujarnya.<br />&nbsp;<br />Program Adiwiyata sebagai upaya pelaksanaan pendidikan lingkungan hidup telah dilaksanakan sejak tahun 1975. Pada tahun 1996 disepakati kerja sama pertama antara Departemen Pendidikan Nasional dan Kementerian Negara Lingkungan Hidup, yang diperbaharui pada tahun 2005 dan tahun 2010. Di tahun 2006, ditandatangani nota kesepahaman antara Menteri Negara Lingkungan Hidup dan Menteri Pendidikan Nasional yang bertujuan untuk mewujudkan sekolah yang peduli dan berbudaya lingkungan hidup melalui kegiatan pembinaan, penilaian, dan pemberian penghargaan Adiwiyata kepada sekolah. (Desliana Maulipaksi)</p>','','','<p>Menteri Pendidikan dan Kebudayaan (Mendikbud) Muhadjir Effendy mengatakan, kesadaran akan lingkungan dan wacana tentang Sustainable Development Goals (SDGs) atau Tujuan Pembangunan Berkelanjutan perlu diberikan kepada para siswa. Seluruh elemen pendidikan perlu</p>','','Menteri Pendidikan dan Kebudayaan (Mendikbud) Muhadjir Effendy mengatakan, kesadaran akan lingkungan dan wacana tentang Sustainable Development Goals (SDGs)','','2017-01-02 20:10:52','wujudkan-kesadaran-lingkungan-melalui-penguatan-pendidikan-karakter','',0,1,825,'Muhammad Romli','2',0),
(14,16,'event-1597531_1280-585207365ecb0.jpg','Tingkatkan Mutu Pendidikan, Kemendikbud Sosialisasikan Hasil Penelitian melalui Seminar','<p>Jakarta, Kemendikbud --- Kementerian Pendidikan dan Kebudayaan (Kemendikbud) melalui Badan Penelitian dan Pengembangan (Balitbang) menyelenggarakan \"Seminar Hasil Penilaian Pendidikan untuk Kebijakan\", di Hotel Atlet Century Park, Jakarta (14/12/2016). Seminar tersebut bertujuan menyosialisasikan hasil penelitian yang sudah dilakukan oleh Pusat Penilaian Pendidikan (Puspendik), dan menjaring usulan kebijakan dalam meningkatkan mutu pendidikan.<br />&nbsp;<br />Menteri Pendidikan dan Kebudayaan (Mendikbud), Muhadjir Effendy saat membuka seminar menyampaikan tentang pentingnya peran penelitian di Kemendikbud dalam mendukung perumusan, perencanaan, dan implementasi kebijakan di bidang pendidikan.<br />&nbsp;<br />&ldquo;Semakin efisien kerja penelitian dalam menopang itu (kebijakan pendidikan), maka akan semakin baiklah kerja Kemendikbud,&rdquo; ujar Mendikbud.<br />&nbsp; <br />Muhadjir juga mengingatkan agar dalam melakukan penelitian kita harus fokus. Karena penelitian yang tidak memiliki kaitan dengan kebijakan yang diambil, hanya akan membuang waktu, tenaga, dan pikiran.<br />&nbsp;<br />Sebelumnya, Kepala Badan Penelitian dan Pengembangan (Balitbang) Kemendikbud, Totok Suprayitno berharap dari seminar ini didapatkan usulan yang bisa membatu dalam menyusun rumusan kebijakan.<br />&nbsp;<br />&ldquo;Harapan kami setelah seminar ini, maka pihak-pihak terkait yang menjadi pemangku kepentingan utama dari pendidikan bisa menindaklanjuti berupa perbaikan-perbaikan berupa hasil empiris yang didapatkan dari hasil penilaian ini,&rdquo; kata Totok saat menyampaikan laporan pelaksanaan seminar.<br />&nbsp;<br />Dalam seminar ini, menghadirkan beberapa pembicara baik dari internal maupun eksternal di luar Kemendikbud, di antaranya adalah Nizam dan Rahmawati dari Puspendik, serta Ray Philpot dari Australian Council for Educational Research (ACER). Diikuti sebanyak 127 peserta yang berasal dari berbagai kalangan yang memiliki keterkaitan di bidang pendidikan, seperti kepala dinas pendidikan, dekan, kepala sekolah, dan praktisi pendidikan. (Aji Shahwin)</p>','','','<p>Kementerian Pendidikan dan Kebudayaan (Kemendikbud) melalui Badan Penelitian dan Pengembangan (Balitbang) menyelenggarakan \"Seminar Hasil Penilaian Pendidikan untuk Kebijakan\", di Hotel Atlet Century Park, Jakarta (14/12/2016). Seminar tersebut bertujuan</p>','','ciamik lah cincau kriting','','2017-03-02 20:11:04','tingkatkan-mutu-pendidikan-kemendikbud-sosialisasikan-hasil-penelitian-melalui-seminar','',0,1,775,'Muhammad Romli','1',0),
(17,18,'quizroom18ebaru-5b7969bfb3224.png','Software Ujian Online berbasis komputer','<p class=\"western\" align=\"center\"><span style=\"font-size: large;\"><strong>SOFTWARE UJIAN SEKOLAH </strong></span></p>\r\n<p class=\"western\" align=\"center\"><span style=\"font-size: large;\"><strong>BERBASIS KOMPUTER</strong></span></p>\r\n<p class=\"western\" align=\"justify\"><strong>PENDAHULUAN</strong></p>\r\n<p class=\"western\" align=\"justify\">Pelaksanaan Ujian Nasional Berbasis Komputer(UNBK)merupakan keseriusan pemerintah indonesia memanfaatkan teknologi untuk dunia pendidikan, Dan hal ini juga menuntut setiap sekolah-sekolah di daerah untuk turut serta berpikir kreatif untuk memanfaatkan teknologi untuk mengefisienkan waktu dan mengurangi pengeluaran dalam prosesnya.</p>\r\n<p class=\"western\" align=\"justify\">Untuk melaksanakan ujian sekolah berbasis komputer maka dibutuhkan biaya persiapan yang sangat besar untuk jaringan dan komputer siswa.</p>\r\n<p class=\"western\" align=\"left\">Untuk menjawab kebutuhan sekolah dalam melaksanakan ujian sekolah berbasis komputer kami menawarkan software ujian sekolah berbasis komputer dengan nama <a>Quizroom</a>&nbsp;beserta spesifikasi yang kami jelaskan dibawah ini.</p>\r\n<p class=\"western\" align=\"left\">&nbsp;</p>\r\n<p class=\"western\" align=\"left\"><strong>TENTANG SOFTWARE</strong></p>\r\n<p class=\"western\" align=\"justify\">Software Quizroom menggunakan teknologi web sehingga memiliki keunggulan mampu berjalan di jaringan Intranet(Offline) maupun Internet(Online) dengan mudah dan pemasangan di komputer client juga sangat mudah cukup menggunakan media browser seperti mozilla firefox, Chrome.</p>\r\n<p class=\"western\" align=\"justify\">Software ini bisa berjalan dengan baik dengan spesifikasi perangkat keras (<em>Hardware</em>) minimum sebagai berikut :</p>\r\n<ul>\r\n<li class=\"western\">OS Windows 7 / Ubuntu 16 / Debian 7</li>\r\n<li class=\"western\">Memory min 4GB</li>\r\n<li class=\"western\">Hardisk min 40GB</li>\r\n<li class=\"western\">Processor Core I5</li>\r\n</ul>\r\n<p class=\"western\" align=\"left\"><strong>KEUNGGULAN</strong></p>\r\n<ul>\r\n<li class=\"western\">Program Berbasis Web bisa berjalan Intranet Maupun Internet</li>\r\n<li class=\"western\">Desain Interface Ujian mirip dengan UNBK.</li>\r\n<li class=\"western\">Bisa import soal dari Microsoft Office Word (*.docx)</li>\r\n<li class=\"western\">Bisa menggunakan Smartphone.</li>\r\n<li class=\"western\">Siswa yang menggunakan PC/Laptop tidak bisa membuka halaman yang lain kecuali halaman ujian(Optional menggunakan browser khusus).</li>\r\n<li class=\"western\">Penjadwalan bisa menggunakan mode pengurangan durasi jika terlambat(Optional).</li>\r\n<li class=\"western\">Hasil ujian langsung bisa di unduh dalam bentuk excel.</li>\r\n<li class=\"western\">Siswa hanya bisa melaksanakan ujian dari 1 perangkat dan 1 browser (Security)</li>\r\n<li class=\"western\">Urutan soal dan pilihan ganda bisa diacak(optional).</li>\r\n<li class=\"western\">Soal bisa menggunakan VIDEO dan MP3.</li>\r\n<li class=\"western\">Software sangat ringan dengan Spesifikasi diatas 1 Server bisa menangani &gt; 100 Client bersamaan menggunakan LAN</li>\r\n</ul>\r\n<p><strong>SPESIFIKASI SOFTWARE</strong></p>\r\n<ol>\r\n<li><strong>Halaman Siswa</strong><br />\r\n<ul>\r\n<li>Ujian bisa dilakukan dengan mengisi Kode Peserta dan Kode Soal</li>\r\n<li>Terdapat navigasi untuk berpindah pindah soal dengan tanda warna jika soal telah dijawab</li>\r\n<li>Durasi habis otomatis menutup ujian.</li>\r\n<li>Pada saat peserta sedang ujian, kemudian browser tidak sengaja ditutup oleh peserta, maka ketika browser dibuka kembali otomatis membuka soal dengan jawaban sebelumnya</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Halaman Admin</strong></p>\r\n<ul>\r\n<li>Menu User &ndash; Mengola user yang bisa login kedalam halaman admin.</li>\r\n<li>Menu Peserta - Mengelola data siswa (Download &amp; Import Excel)</li>\r\n<li>Menu Master Soal\r\n<ul>\r\n<li>\r\n<p class=\"western\" align=\"left\">Setiap paket soal tidak dibatasi jumlah soal yang bisa dibuat.</p>\r\n</li>\r\n<li>\r\n<p class=\"western\" align=\"left\">Setiap soal bisa terdiri dari 2 pilihan sampai 5 pilihan jawaban.</p>\r\n</li>\r\n<li>\r\n<p class=\"western\" align=\"left\">Posisi soal bisa di acak(optional).</p>\r\n</li>\r\n<li>\r\n<p class=\"western\" align=\"left\">Selain soal bisa di acak pilihan ganda(A,B,C,D,E) bisa diacak (optional)</p>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>Menu Jadwalkan Ujian\r\n<ul>\r\n<li>\r\n<p class=\"western\" align=\"left\">Penjadwalan ujian dibuat persoal dan pertanggal.</p>\r\n</li>\r\n<li>\r\n<p class=\"western\" align=\"left\">Terdapat fitur pengurangan durasi jika siswa terlambat(optional).</p>\r\n</li>\r\n<li>\r\n<p class=\"western\" align=\"left\">Ujian bisa ditentukan untuk kelas tertentu saja maupun untuk semua kelas sekaligus.</p>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>Menu Ujian Realtime\r\n<ul>\r\n<li>Admin bisa memonitoring peserta ujian yang sedang aktif.</li>\r\n<li>Terdapat fitur Membatalkan ujian yang sedang berlangsung.</li>\r\n<li>Disediakan fitur pindah perangkat jika terjadi masalah dengan perangkat ketika ujian</li>\r\n</ul>\r\n</li>\r\n<li>Menu Hasil Ujian\r\n<ul>\r\n<li>\r\n<p class=\"western\" align=\"left\">Admin bisa melihat data peserta yang sudah melaksanakan ujian.</p>\r\n</li>\r\n<li>\r\n<p class=\"western\" align=\"left\">Terdapat fitur download data peserta dalam bentuk excel untuk memudahkan proses selanjutnya.</p>\r\n</li>\r\n<li>\r\n<p class=\"western\" align=\"left\">Terdapat fitur Analisa Soal (Tingkat kesulitan soal) dan Analisa Jawaban Siswa (dalam bentuk warna ).</p>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ol>','','','<p class=\"western\" align=\"justify\">Pelaksanaan Ujian Nasional Berbasis Komputer(UNBK)merupakan keseriusan pemerintah indonesia memanfaatkan teknologi untuk dunia pendidikan, Dan hal ini juga menuntut setiap sekolah-sekolah di daerah untuk turut serta berpikir kreatif untuk memanfaatkan teknologi untuk mengefisienkan waktu dan mengurangi pengeluaran dalam prosesnya.</p>\r\n<p class=\"western\" align=\"justify\">Untuk melaksanakan ujian sekolah berbasis komputer maka dibutuhkan biaya persiapan yang sangat besar untuk jaringan dan komputer siswa.</p>\r\n<p class=\"western\" align=\"left\">Untuk menjawab kebutuhan sekolah dalam melaksanakan ujian sekolah berbasis komputer kami menawarkan software ujian sekolah berbasis komputer dengan nama&nbsp;<a href=\"/\">Quizroom</a>&nbsp;beserta spesifikasi yang kami jelaskan dibawah ini.</p>\r\n<p>&nbsp;</p>','','Aplikasi ujian online atau Software CBT kebutuhan sekolah saat ini','','2018-08-19 20:01:43','software-ujian-online-berbasis-komputer','',0,1,3303,'Muhammad Romli','5',0),
(18,18,'Screenshot from 2018-08-19 19-58-46-5b79fef0a1a82.png','Perhatikan 5 hal dalam pembuatan ujian online','<p>Perkembangan dunia IT yang sangat pesat membuat kemudahan yang dulunya sangat sulit salah satunya adalah&nbsp;Ujian Online. dengan adanya aplikasi ujian online guru tidak perlu susah untuk melakukan koreksi dan penilaian hasil ujian. bayangkan saja jika 1 orang memakan waktu 5 menit dalam koreksi jawaban bayangkan saja jika ada 10 orang maka waktu yang dibutuhkan adalah 50menit, sedangkan kita sendiri tahu kalau dalam 1 kelas biasanya kurang lebih ada 30 siswa jadi butuh waktu 150Menit untuk melakukan koreksi jawaban siswa.&nbsp;dengan ujian online&nbsp;pengoreksian dilakukan secara otomatis oleh software ujian online. jadi guru&nbsp;bisa&nbsp;mempergunakan waktunya dengan baik.&nbsp;</p>\r\n<p>Dengan adanya solusi baru&nbsp;tidak lepas dengan masalah baru. ujian online merupakan sarana ujian menggunakan media komputer maupun smartphone yang berisi teks, gambar, suara mp3, maupun video.&nbsp;konten yang disediakan akan disajikan dimedia ujian siswa akan tampil dengan cepat dan ada yang tampil dengan lambat nah hal ini merupakan masalah baru yang jangan sampai diabaikan karena akan&nbsp;membuat ujian tidak maksimal atau bisa membuat ujian gagal dilakukan secara serentak karena tiba tiba server mati atau terlalu lambat munculnya soal di perangkat yang digunakan siswa.</p>\r\n<p>Tulisan ini bertujuan untuk memberikan informasi terkait dengan&nbsp;solusi dari permasalahan diatas berdasarkan pengalaman dilapangan.</p>\r\n<p>1.&nbsp;Gambar Soal</p>\r\n<p>Gambar merupakan hal yang sepele namun dampaknya sangat luar biasa. yang perlu diperhatikan adalah ukuran gambar tersebut. bayangkan saja jika 1 gambar pada 1 soal berukuran 1 MB, jika ada 10 soal maka ukuran&nbsp;1 paket soal menjadi 10MB sekali tampil di perangkat siswa. jika ada 10 Siswa yang mengakses bersamaan maka&nbsp; 10MB x 100 Siswa = 1000MB&nbsp; / 1GB data transfer yang melewati jaringan nah angka tersebut cukup besar dan bisa membuat jaringan jadi lambat karena proses distribusi paket data yang cukup besar. nah bayangkan saja jika gambar yang dipasang di soal diambil dari smartphone yang saat ini ukuran 1 foto bisa sampai 4MB bayangkan saja 1 soal bernilai 4MB maka 1 paket soal jadi 40MB, jika 40MB x 100 Siswa = 4000MB/ 4GB, dan ini adalah angka yang cukup mengerikan menurut saya jika tidak diperhatikan.</p>\r\n<p>Solusinya adalah untuk gambar harus di kecilkan ukurannya terlebih dahulu sebelum di inputkan kedalam soal.</p>\r\n<p>2. Video dan Suara</p>\r\n<p>Barusan sudah kita bahas tentang gambar dan ini berlaku juga untuk video dan suara, ukuran video dan suara sangatlah besar jika anda memiliki perangkat jaringan yang kurang memadai bisa di kondisikan untuk persesi yang melakukan ujian di batasi jumlahnya.</p>\r\n<p>3. Perangkat jaringan</p>\r\n<p>Di poin 1 dan 2 kita bahasa di sisi pembuatan soal berikutnya kita bahas faktor eksternal.</p>\r\n<p>JIka anda melaksanakan ujian online di intranet pastikan anda memiliki perangkat jaringan yang bisa melayani jumlah paket data yang cukup besar. mulai dari spesifikasi perangkat :</p>\r\n<ul>\r\n<li>Komputer server termasuk didalamnya motherboard, processor, lan card</li>\r\n<li>Kabel lan</li>\r\n<li>Router</li>\r\n<li>Switch / Hub</li>\r\n<li>Wifi</li>\r\n</ul>\r\n<p>Untuk spesifikasi&nbsp; bisa anda langsung konsultasikan dengan penyedia perangkat yang anda percaya</p>\r\n<p>4. Internet&nbsp;</p>\r\n<p>Jika anda melaksanakan ujian online langsung menggunakan internet pastikan bandwith cukup besar untuk bisa melayani jumlah siswa yang akan melaksanakan ujian. dan hal yang penting juga spesifikasi komputer yang kita pakai menjadi server online harus disesuaikan dengan kebutuhan jumlah siswa yang melakukan ujian online.</p>\r\n<p>5. TIM IT</p>\r\n<p>Jika anda memiliki tim IT anda akan mendapatkan dukungan yang baik jika terjadi trouble. sebaliknya jika anda tidak memiliki tim IT dipastikan akan sangat berat bagi anda jika ada&nbsp;trouble.</p>\r\n<p>&nbsp;</p>\r\n<p>Begitulah kira kira hal hal yang perlu diperhatikan dalam melaksanakan ujian online. disetiap hal selalu ada solusi baru dan ada masalah baru, namun jangan jadikan masalah menjadi hambatan melaikan&nbsp;dicari solusinya demi masa depan yang lebih baik.</p>','','','<p>Perkembangan dunia IT yang sangat pesat membuat kemudahan yang dulunya sangat sulit salah satunya adalah&nbsp;Ujian Online. dengan adanya aplikasi ujian online guru tidak perlu susah untuk melakukan koreksi dan penilaian hasil ujian. bayangkan saja jika 1 orang memakan waktu 5 menit dalam koreksi jawaban bayangkan saja jika ada 10 orang maka waktu yang dibutuhkan adalah 50menit, sedangkan kita sendiri tahu kalau dalam 1 kelas biasanya kurang lebih ada 30 siswa jadi butuh waktu 150Menit untuk melakukan koreksi jawaban siswa. dalam hal ini ..</p>','','','','2018-08-20 06:36:16','perhatikan-5-hal-dalam-pembuatan-ujian-online','',0,1,853,'Muhammad Romli','5',0),
(19,18,'neonbrand-686471-unsplash-5b7a420cb3884.jpg','Pilihan browser untuk ujian online','<p>Aplikasi ujian online berbasis web&nbsp;tidak akan lepas dari peran web browser sebagai media utama untuk menampilkan halaman ujian. dengan banyaknya versi browser yang bisa anda pilih membuat sedikit bingung mana browser yang bagus.</p>\r\n<p>Berikut pilihan browser yang bisa anda pilih berdasarkan&nbsp;www.toptenreviews.com</p>\r\n<p>1. Firefox Browser</p>\r\n<p>2. Chrome browser</p>\r\n<p>3. Safari</p>\r\n<p>4.&nbsp;Opera</p>\r\n<p>5. Internet Explorer</p>\r\n<p>6. Maxthon</p>\r\n<p>7. Sea Monkey</p>\r\n<p>8. Avant Browser</p>\r\n<p>Dari sekian banyak browser diatas pilihan terbanyak yang digunakan user adalah chrome dan firefox.&nbsp;</p>\r\n<p>&nbsp;</p>','','','<p>Aplikasi ujian online berbasis web&nbsp;tidak akan lepas dari peran web browser sebagai media utama untuk menampilkan halaman ujian. dengan banyaknya versi browser yang bisa anda pilih membuat sedikit bingung mana browser yang bagus..</p>','','Aplikasi ujian online berbasis web tidak akan lepas dari peran web browser sebagai media utama untuk menampilkan halaman ujian. dengan banyaknya versi browser ','','2018-08-21 11:22:33','pilihan-browser-untuk-ujian-online','',0,1,1066,'Muhammad Romli','5',1),
(20,18,'maria-imelda-768860-unsplash-5b7a43ee4058c.jpg','Software CBT Gratis VS Berbayar','<p>Banyak orang mencoba untuk menggunakan aplikasi ujian yang gratis dan banyak pula orang yang menggunakan software aplikasi ujian yang berbayar.&nbsp;manakah yang terbaik untuk anda? anda sendiri yang menentukan namun anda perlu mengetahui beberapa hal perbedaan diantara keduanya.</p>\r\n<p>Berikut perbedaan penggunaan software aplikasi ujian gratis dan berbayar menurut penulis:</p>\r\n<p>Gratis:</p>\r\n<ul>\r\n<li>Butuh skill teknis IT yang tinggi.</li>\r\n<li>Tidak ada support yang bisa diandalkan pas pada waktu dibutuhkan.</li>\r\n<li>Butuh waktu lebih lama untuk mempersiapkan dari awal.</li>\r\n<li>Perkembangan software&nbsp;yang tidak jelas karena tidak ada dana untuk tersebut.&nbsp;</li>\r\n</ul>\r\n<p>Berbayar:</p>\r\n<ul>\r\n<li>Skill teknis IT cukup standart karena akan di dukung oleh pengembang software.</li>\r\n<li>Jika ada masalah anda tidak akan sungkan untuk meminta bantuan support.</li>\r\n<li>Waktu yang dipersiapkan lebih singkat dengan dukungan support dan dokumentasi.</li>\r\n<li>Perkembangan software jelas karena ada dana untuk pengembangan.</li>\r\n</ul>\r\n<p>Semua pilihan ditangan anda tidak ada&nbsp;yang salah bagi anda yang menggunakan software aplikasi ujian yang gratis.</p>','','','<p>Banyak orang mencoba untuk menggunakan aplikasi ujian yang gratis dan banyak pula orang yang menggunakan software aplikasi ujian yang berbayar.&nbsp;manakah yang terbaik untuk anda? anda sendiri yang menentukan namun anda perlu mengetahui beberapa hal perbedaan diantara keduanya&nbsp;</p>','','','','2018-08-22 11:30:38','software-cbt-gratis-vs-berbayar','',0,1,1675,'Muhammad Romli','5',0),
(21,18,'whoislimos-265482-unsplash-5b7a85d39d808.jpg','Kriteria sekolah siap ujian online','<p>Banyak pertimbangan bagi pihak sekolah untuk melaksanakan ujian online secara mandiri&nbsp;mulai dari kesiapan guru untuk menyiapkan soal dalam bentuk digital, perangkat jaringan,&nbsp;lab komputer dan tentu saja koneksi internet.</p>\r\n<p>Tidak memulai maka tidak akan ada aksi berikutnya. seperti juga ujian online, selama kita tidak berani untuk membuat keputusan dan memaksa semua perangkat sekolah untuk mengadakan ujian online, maka hal itu tidak akan pernah terjadi.</p>\r\n<p>Langkah awal adalah menyiapkan software ujian online terlebih dahulu bisa menggunakan yang berbayar maupun yang gratis, namun jika mendengar kata gratis rasanya kurang ada tekanan kewajiban untuk pribadi agar terpaksa melaksanakan ujian online. mungkin lebih baik menggunakan yang berbayar karena akan disupport dengan baik sehingga untuk masalah masalah persiapan diawal akan jauh lebih mudah diselesaikan karena akan dibantu oleh pakarnya.</p>\r\n<p>Selanjutnya siapkan server untuk ujian online,&nbsp; jika&nbsp;tidak memiliki server yang sesuai kita bisa menggunakan fasilitas sewa hosting dengan biaya tahunan dengan spesifikasi yang disesuaikan dengan kebutuhan jumlah peserta ujian setiap sesi, keunggulannya kita tidak perlu capek capek shutdown komputer karena akan nyala 24 jam.</p>\r\n<p>Persiapan berikutya adalah perangkat komputer client yang terhubung internet, nah untuk masalah ini banyak sekolah yang masih baru terkendala karena biaya yang cukup mahal setiap unitnya. untuk solusinya bisa menggunakan smarpthone siswa dengan fasilitas internet pribadi dari siswa sehingga biaya untuk client nyaris NOL.</p>\r\n<p>Persiapan persiapan diatas&nbsp;jika sudah teratasi maka bisa dikatakan sekolah anda sudah sangat siap untuk melaksanakan ujian online secara mandiri.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp; &nbsp;</p>','','','<p>Banyak pertimbangan bagi pihak sekolah untuk melaksanakan ujian online secara mandiri&nbsp;mulai dari kesiapan guru untuk menyiapkan soal dalam bentuk digital, perangkat jaringan,&nbsp;lab komputer dan tentu saja...</p>','','','','2018-08-23 16:11:47','kriteria-sekolah-siap-ujian-online','',0,1,637,'Muhammad Romli','5',0),
(22,19,'quizroom-logo2-5b7e1de62ea8e.png','Promo agustus diskon 50 untuk pembelian aplikasi ujian online','<p>Agustus akan segera berakhir&nbsp;segera daftarkan sekolah anda untuk mendapatkan promo diskon 50% untuk licensi software quizoom mandiri offline.</p>\r\n<p>Perlu anda ketahui software quizroom&nbsp;memiliki fitur unggulan sebagai berikut:</p>\r\n<ul>\r\n<li class=\"western\">Program Berbasis Web bisa berjalan Intranet Maupun Internet</li>\r\n<li class=\"western\">Desain Interface Ujian mirip dengan UNBK.</li>\r\n<li class=\"western\">Bisa import soal dari Microsoft Office Word (*.docx)</li>\r\n<li class=\"western\">Upload soal langsung dari Microsofoft Office word menggunakan fitur create blog</li>\r\n<li class=\"western\">Bisa menggunakan Smartphone.</li>\r\n<li class=\"western\">Siswa yang menggunakan PC/Laptop tidak bisa membuka halaman yang lain kecuali halaman ujian(Optional menggunakan browser khusus).</li>\r\n<li class=\"western\">Penjadwalan bisa menggunakan mode pengurangan durasi jika terlambat(Optional).</li>\r\n<li class=\"western\">Hasil ujian langsung bisa di unduh dalam bentuk excel.</li>\r\n<li class=\"western\">Siswa hanya bisa melaksanakan ujian dari 1 perangkat dan 1 browser (Security)</li>\r\n<li class=\"western\">Urutan soal dan pilihan ganda bisa diacak(optional).</li>\r\n<li class=\"western\">Soal bisa menggunakan VIDEO dan MP3.</li>\r\n<li class=\"western\">Software sangat ringan dengan Spesifikasi diatas 1 Server bisa menangani &gt; 100 Client bersamaan menggunakan LAN</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Silahkan kontak:&nbsp;</p>\r\n<p>Romli</p>\r\n<p>WA 08179388230</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','','','<p>Dapatkan segera aplikasi ujian online dengan diskon 50%&nbsp;</p>','','Agustus akan segera berakhir segera daftarkan sekolah anda untuk mendapatkan promo diskon 50 untuk licensi software quizoom mandiri offline.','','2018-08-24 09:38:34','promo-agustus-diskon-50-untuk-pembelian-aplikasi-ujian-online','',0,1,838,'Muhammad Romli','5',0),
(23,19,'','Promo Aplikasi Ujian Gratis 6 Bulan','<p>Untuk memeriahkan agustus yang bersamaan dengan Asean Games 2018. Quizroom memberikan licensi gratis untuk 2 instansi tercepat yang&nbsp;mendaftar untuk mendapatkan promo 6 bulan gratis. dengan cara segera daftarkan sekolah atau lembaga pendidikan anda secepat mungkin pada tanggal 27 Agustus 2018 untuk mendapatkan promo 6 bulan aplikasi ujian gratis tanpa biaya sepeserpun.</p>\r\n<p>Silahkan isi kontak anda di <a href=\"/kontak.html\">https://quizroom.id/kontak.html</a></p>\r\n<p>2 Instansi pertama akan mendapatkan kesempatan gratis selama 6 bulan.</p>\r\n<p>&nbsp;</p>','','','<p>Untuk memeriahkan agustus yang bersamaan dengan Asean Games 2018. Quizroom memberikan licensi gratis untuk 2 instansi tercepat yang&nbsp;mendaftar untuk mendapatkan promo 6 bulan gratis.</p>','','','','2018-08-27 10:22:10','promo-aplikasi-ujian-gratis-6-bulan','',0,1,913,'Muhammad Romli','1',0),
(24,18,'Microsoft-Word-2013-5b9097b437582.png','Input soal ujian online mengunakan Microsoft Office Word','<p>Aplikasi ujian online sudah menjadi kebutuhan bagi&nbsp;guru guru saat ini karena kemudahan untuk melakukan koreksi pada hasil jawaban siswa.&nbsp; namun ada proses awal yang harus disiapkan oleh setiap guru sebelum memulai ujian online yaitu melakukan input soal.&nbsp; untuk melakukan input soal ada 3 cara yang dilakukan&nbsp;bersesuaian dengan&nbsp;teknologi yang digunakan saat ini.</p>\r\n<p>A. Input Manual</p>\r\n<p>Input&nbsp;soal manual ini merupakan cara biasa yang dilakukan oleh setiap aplikasi ujian online dengan menggunakan fitur aplikasi tersebut. cara kerjanya setiap soal yang akan dinputkan harus diketik secara manual di&nbsp;aplikasi tersebut dan untuk setiap gambar yang dipasang di setiap soal harus&nbsp;diupload satu per satu kemudian baru dipasangkan dengan soal yang akan dimunculkan gambarnya.</p>\r\n<p>Cara ini tergolong memakan waktu dan tidak mudah bagi para pemula sehingga cara ini akan sedikit membuat para guru&nbsp;kerepotan karena harus mempelajari cara untuk mengoperasikan cara input secara manual, cara upload gambar, cara mengecilkan ukuran , mengkonversi rumus equation menjadi gambar. sehingga pekerjaa untuk satu paket soal bisa memakan waktu yang sangat lama.&nbsp;&nbsp;</p>\r\n<p><br />B. Import export</p>\r\n<p>Cara ini lebih disukai daripada cara input secara manual karena guru akan dengan mudah memasukkan soal. namun ada 2 cara untuk melakukan input soal yaitu :</p>\r\n<ul>\r\n<li>Microsoft Office Excel , salah satu caranya menggunakan Excel sehingga soal tinggal di copy paste ke excel kemudian jika menggunakan gambar maka nama gambarnya dipasang di excel tersebut dan nantinya baru semua gambarnya diupload secara bersamaaan, namun&nbsp;&nbsp;yang merepotkan adalah di excel&nbsp;pengolahan gambar tetap manual.</li>\r\n<li>Microsoft Office Word, cara ini tergolong lebih mudah dari pada manual dan excel karena untuk pengolahan gambarnya lebih mudah langsung dilakukan di lembar kerja Microsoft Office Word . semua permasalahan terkait format teks, ukuran gambar, rumus equation semuanya terselesaikan dengan sangat mudah.</li>\r\n</ul>\r\n<p>Namun cara import export memiliki cara yang sedikit agak ribet&nbsp; karena jika&nbsp;ingin mengupdate salah satu butir soal maka harus melakukan import&nbsp;lagi dari awal untuk semua soal.</p>\r\n<p><br />C. Create blog</p>\r\n<p>Nah fitur yang paling mudah adalah create blog milik&nbsp;Microsoft Office Word, yang perlu dilakukan hanya setting akun untuk alamat posting soal kita. dan cara ini sangat disukai oleh para guru yang melakukan input soal karena selain caranya sangat mudah untuk mengelola soal jika ada salah ketik atau salah kunci jawaban dengan cukup mudah tinggal posting soal kita sebagai blog.</p>\r\n<p>Untuk fitur fitur yang saya jelaskan diatas semuanya tersedia&nbsp;di aplikasi ujian online Quizroom CBT. tinggal ada mau memakai yang mana tergantu pilihan anda dan kebiasaan anda dalam melakukan input soal.&nbsp;</p>\r\n<p>&nbsp;</p>','','','<p>Aplikasi ujian online sudah menjadi kebutuhan bagi&nbsp;guru guru saat ini karena kemudahan untuk melakukan koreksi pada hasil jawaban siswa.&nbsp; namun&nbsp;</p>','','','','2018-09-06 09:57:56','input-soal-ujian-online-mengunakan-microsoft-office-word','',0,1,2620,'Muhammad Romli','5',0);

/*Table structure for table `blog_category` */

DROP TABLE IF EXISTS `blog_category`;

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `description_id` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `blog_category` */

insert  into `blog_category`(`id`,`parent`,`name_id`,`description_id`,`urutan`,`name_en`,`description_en`,`filename`,`url_id`,`url_en`) values 
(16,0,'Berita','Berita yang berhubungan dengan ujian sekolah berbasis komputer',4,'','','','berita',''),
(17,0,'Tips','Tips tips menggunakan software ujian sekolah berbasis komputer',2,'','','','tips',''),
(18,0,'Artikel','Quizroom - Artikel tentang aplikasi ujian online',1,'','','','artikel',''),
(19,0,'Promo','Promo - Aplikasi ujian online ',0,'','','','promo','');

/*Table structure for table `blog_newsletter` */

DROP TABLE IF EXISTS `blog_newsletter`;

CREATE TABLE `blog_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `newsletter_email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `blog_newsletter` */

insert  into `blog_newsletter`(`id`,`email`,`tanggal`) values 
(1,'roemly@gmail.com','2015-01-01 00:14:47'),
(2,'jayadi@gmail.com','2015-01-01 19:14:09');

/*Table structure for table `brand` */

DROP TABLE IF EXISTS `brand`;

CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `brand` */

insert  into `brand`(`id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`tanggal`,`url_id`,`url_en`,`urutan`) values 
(18,'6-53b412bf40830.jpg','member 6','','member 6','','2014-07-02','member-6','member-6',2),
(19,'7-53b412cca5fd4.jpg','member 7','','member 7','','2014-07-02','member-7','member-7',1),
(17,'5-53b412b03d6de.jpg','member 5','','member 5','','2014-07-02','member-5','member-5',3),
(16,'4-53b4129f77418.jpg','member 4','','member 4','','2014-07-02','member-4','member-4',4),
(15,'3-53b412896b7f2.jpg','member 3','','member 3','','2014-07-02','member-3','member-3',5),
(14,'2-53b4105baba46.jpg','member 2','','member 2','','2014-07-02','member-2','member-2',6),
(13,'1-53b4104fcde26.jpg','member 1','','member 1','','2014-07-02','member-1','member-1',7);

/*Table structure for table `catalog` */

DROP TABLE IF EXISTS `catalog`;

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `ispromo` int(11) NOT NULL,
  `islaris` int(11) NOT NULL,
  `isnew` int(11) NOT NULL,
  `issold` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 0,
  `id_brand` int(11) NOT NULL,
  `id_label` varchar(255) NOT NULL,
  `id_color` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title_id` varchar(255) NOT NULL DEFAULT '',
  `title_en` varchar(255) NOT NULL,
  `weight` decimal(6,2) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `short_desc_id` text NOT NULL,
  `long_desc_id` text NOT NULL,
  `short_desc_en` text NOT NULL,
  `long_desc_en` text NOT NULL,
  `harga` int(13) NOT NULL,
  `harga_jual` int(13) NOT NULL,
  `stock` int(11) NOT NULL,
  `diskon` varchar(50) NOT NULL,
  `tag` varchar(500) NOT NULL,
  `urutan` int(11) NOT NULL,
  `thumb` text NOT NULL,
  `attribut_tambahan` text NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `uniqid` varchar(30) NOT NULL,
  `id_link` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `catalog` */

insert  into `catalog`(`id`,`code`,`ispromo`,`islaris`,`isnew`,`issold`,`cat_id`,`id_brand`,`id_label`,`id_color`,`tanggal`,`title_id`,`title_en`,`weight`,`publish`,`short_desc_id`,`long_desc_id`,`short_desc_en`,`long_desc_en`,`harga`,`harga_jual`,`stock`,`diskon`,`tag`,`urutan`,`thumb`,`attribut_tambahan`,`url_id`,`url_en`,`uniqid`,`id_link`) values 
(2,'',0,0,0,0,0,0,'','','2020-09-07 18:14:31','Makadam 5/7','',0.00,1,'<p>Lorem&nbsp; ipsum</p>','<p>Dolor sit amet</p>','','',0,0,0,'','',1,'5f561887e5851.jpg','','makadam-57','','5f5616174991b',0),
(3,'',0,0,0,0,0,0,'','','2020-09-07 19:09:16','Makadam Jumbo','',0.00,1,'<p>Lorem ipsum</p>','<p>Lorem</p>','','',0,0,0,'','',2,'5f5622ec6985b.jpg','','makadam-jumbo','','5f5622ec6908b',0),
(4,'',0,0,0,0,0,0,'','','2020-09-07 19:11:45','Pasir','',0.00,1,'<p>Lorem ipsum</p>','<p>Lorem ipsum</p>','','',0,0,0,'','',3,'5f5623812bbaf.jpg','','pasir','','5f5623812b3df',0);

/*Table structure for table `catalog_attribut` */

DROP TABLE IF EXISTS `catalog_attribut`;

CREATE TABLE `catalog_attribut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_catalog` int(11) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `catalog_attribut` */

insert  into `catalog_attribut`(`id`,`id_catalog`,`title_id`,`stock`,`urutan`) values 
(1,1,'XL',2,1),
(2,1,'L',9,2),
(3,1,'M',7,3),
(6,65,'L',4,1),
(7,65,'XL',0,2),
(8,65,'M',0,3),
(11,66,'L',5,1),
(12,66,'XL',6,2),
(13,66,'M',0,3),
(16,67,'L',0,1),
(17,67,'XL',0,2),
(18,67,'M',0,3),
(19,67,'',0,4),
(20,67,'',0,5),
(21,67,'',0,6),
(22,1,'S',4,4),
(23,68,'XL',0,1),
(24,68,'M',0,2),
(25,68,'',0,3),
(26,68,'',0,4),
(27,68,'',0,5),
(28,69,'XL',45,1),
(29,69,'M',30,2),
(30,69,'S',15,3),
(31,69,'',0,4),
(32,69,'',0,5),
(33,70,'XL',45,1),
(34,70,'M',30,2),
(35,70,'S',15,3),
(39,71,'XL',45,1),
(40,71,'M',30,2),
(41,71,'S',15,3),
(42,1,'XL',10,1);

/*Table structure for table `catalog_brand` */

DROP TABLE IF EXISTS `catalog_brand`;

CREATE TABLE `catalog_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `catalog_brand` */

/*Table structure for table `catalog_category` */

DROP TABLE IF EXISTS `catalog_category`;

CREATE TABLE `catalog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `description_id` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `catalog_category` */

/*Table structure for table `catalog_color` */

DROP TABLE IF EXISTS `catalog_color`;

CREATE TABLE `catalog_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `description_id` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `catalog_color` */

/*Table structure for table `catalog_label` */

DROP TABLE IF EXISTS `catalog_label`;

CREATE TABLE `catalog_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `description_id` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `catalog_label` */

/*Table structure for table `catalog_link` */

DROP TABLE IF EXISTS `catalog_link`;

CREATE TABLE `catalog_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_catalog` int(11) NOT NULL,
  `uniqid` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `catalog_link` */

insert  into `catalog_link`(`id`,`id_catalog`,`uniqid`) values 
(1,1,'5750b121a223d'),
(2,69,'5751980e1d3d4');

/*Table structure for table `catalog_order` */

DROP TABLE IF EXISTS `catalog_order`;

CREATE TABLE `catalog_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `handphone` varchar(30) NOT NULL,
  `chat` text NOT NULL COMMENT 'json BB,WA,YM',
  `alamat` text NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `provinsi` int(11) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `handphone_penerima` varchar(30) NOT NULL,
  `chat_penerima` text NOT NULL COMMENT 'json BB,WA,YM',
  `alamat_penerima` text NOT NULL,
  `kecamatan_penerima` varchar(50) NOT NULL,
  `kota_penerima` varchar(50) NOT NULL,
  `provinsi_penerima` int(11) NOT NULL,
  `kode_pos_penerima` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `catalog_order` */

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `description_id` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `category` */

insert  into `category`(`id`,`parent`,`name_id`,`description_id`,`urutan`,`name_en`,`description_en`,`filename`,`url_id`,`url_en`) values 
(1,11,'Level','<p>lorem ipsum</p>',5,'Level','<p>lorem ipsum</p>','level-53a0a46673305.png','level','level'),
(2,0,'Tekanan','',6,'Pressure','','pressure-53a0a470a1002.png','tekanan','pressure'),
(5,4,'Temperature','<p>testing testing</p>',3,'Temperature','<p>test test</p>','temperature-53a09d492d2b6.png','temperature','temperature'),
(6,10,'Pressure Gauge','',8,'Pressure Gauge','','0','pressure-gauge','pressure-gauge'),
(7,8,'Pressure Switch','',10,'Pressure Switch','','0','pressure-switch','pressure-switch'),
(8,6,'Pressure Transmitter','',9,'Pressure Transmitter','','0','pressure-transmitter','pressure-transmitter'),
(9,2,'Pressure Gauge with Electrical Contact','',11,'Pressure Gauge with Electrical Contact','','0','pressure-gauge-with-electrical-contact','pressure-gauge-with-electrical-contact'),
(10,2,'Pressure Diaphragm Seal','',7,'Pressure Gauge Differential','','0','pressure-diaphragm-seal','pressure-gauge-differential'),
(11,5,'Katup','<p>Valve</p>',4,'Valve','<p>Valve</p>','valve-53a0a44bbd37e.png','katup','valve'),
(12,0,'Seal','<p>lkjlkjlkj</p>',1,'Seal','<p>khlkhkj</p>','Seal-53a12b74ec1d9.png','seal','seal');

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title_id` varchar(255) NOT NULL DEFAULT '',
  `title_en` varchar(255) NOT NULL,
  `map` text NOT NULL,
  `desc_atas_id` text NOT NULL,
  `desc_atas_en` text NOT NULL,
  `desc_samping_id` text NOT NULL,
  `desc_samping_en` text NOT NULL,
  `address_id` text NOT NULL,
  `address_en` text NOT NULL,
  `telp` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tag` varchar(500) NOT NULL,
  `urutan` int(11) NOT NULL,
  `thumb` text NOT NULL,
  `gallery_title` text NOT NULL,
  `gallery_desc` text NOT NULL,
  `attribut_tambahan` text NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `contact` */

insert  into `contact`(`id`,`tanggal`,`title_id`,`title_en`,`map`,`desc_atas_id`,`desc_atas_en`,`desc_samping_id`,`desc_samping_en`,`address_id`,`address_en`,`telp`,`fax`,`email`,`tag`,`urutan`,`thumb`,`gallery_title`,`gallery_desc`,`attribut_tambahan`,`url_id`,`url_en`) values 
(12,'2014-05-25 15:41:27','anaroka','lksjdlk','','','','','','<p>testing alamat baru</p>','<p>testing alaman en</p>','999','9','tester@gmail.com','',2,'','','','','anaroka','lksjdlk'),
(14,'2014-05-25 16:08:54','jagoan negon','','','','','','','','','','','','',4,'539c9d355e608.jpg','','','','jagoan-negon','jagoan-negon'),
(17,'2014-06-01 22:00:35','Judul Portofolio','Title Portofolio','','','','','','','','','','','',3,'538b4029e8b28.jpg:538b402a09dc1.jpg:538b402a09f8c.jpg','','','','judul-portofolio','title-portofolio'),
(18,'2014-07-05 07:38:19','iuoiuoiuo','uoi','uoiu','<p>oiu</p>','<p>ou</p>','<p>oiu</p>','<p>oiu</p>','<p>uoi</p>','','uoiu','iiuoi','uoi@ya.com','',5,'53b748fac65eb.jpg:53b748fac66fc.jpg','uj:uoiu','ououoiuoi:oiu:ououoiuoi:oiu','','iuoiuoiuo','uoi'),
(19,'2014-07-05 07:47:52','Pusat - Surabaya','Head - Surabaya',' <iframe width=\"100%\" height=\"180\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/maps?source=embed&amp;msid=207252500814404613616.0004dbcb6e23f7b275953&amp;msa=0&amp;ie=UTF8&amp;ll=51.504175,-0.097504&amp;spn=0.020836,0.066047&amp;t=m&amp;z=15&amp;output=embed\"></iframe>','<h1>Head Office Surabaya</h1>\r\n<p>Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>\r\n<p>&nbsp;</p>','<h1>Head Office Surabaya</h1>\r\n<p>En Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>\r\n<p>&nbsp;</p>','<h1>Address</h1>\r\n<p>Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>','<h1>Address</h1>\r\n<p>En En Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>','<h3>PT. Indosafe Pratama</h3>\r\n<p>Sentra Eropa I, Balikpapan Baru, Block AA-4 No. 30<br />Balikpapan 76114<br />East Kalimantan - Indonesia</p>','','(+62 542) 878618, 878619','(+62 542) 873450','info@indosafepratama.com','',1,'53b7e29280e40.jpg:53b74b37c7384.jpg:53b74b37c74dc.jpg:53b7e2927c8ff.jpg','Guest Room:Gudang:Meeting Room:Tampak Luar','Balik Papan:Balikpapan:Surabaya:Surabaya','','pusat---surabaya','head---surabaya'),
(20,'2014-07-11 04:37:52','iuhikyiu','yiuy','iy','<p>iu</p>','<p>yi</p>','<p>yi</p>','<p>uyi</p>','<p>uyi</p>','<p>uyi</p>','888','888','tester@gmail.com','',6,'53bf07afcb7e0.jpg','panjat','pinang','','iuhikyiu','yiuy');

/*Table structure for table `contact_footer` */

DROP TABLE IF EXISTS `contact_footer`;

CREATE TABLE `contact_footer` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `desc_atas_id` text NOT NULL,
  `desc_atas_en` text NOT NULL,
  `desc_samping_id` text NOT NULL,
  `desc_samping_en` text NOT NULL,
  `address_id` text NOT NULL,
  `address_en` text NOT NULL,
  `telp` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tag` varchar(500) NOT NULL,
  `urutan` int(11) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `contact_footer` */

insert  into `contact_footer`(`id`,`tanggal`,`title_id`,`title_en`,`desc_atas_id`,`desc_atas_en`,`desc_samping_id`,`desc_samping_en`,`address_id`,`address_en`,`telp`,`fax`,`email`,`tag`,`urutan`,`url_id`,`url_en`) values 
(1,'2014-07-05 07:47:52','HUBUNGI KAMI','CONTACT US','<p>Segera contact kami untuk mendapatkan informasi tentang jasa training kami</p>','<p>En Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>\r\n<p>&nbsp;</p>','<h1>Address</h1>\r\n<p>Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>','<h1>Address</h1>\r\n<p>En En Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>','Sentra Eropa I, Balikpapan Baru, Block AA-4 No.30 Balikpapan 76114 Kalimantan Timur - Indonesia','Sentra Eropa I, Balikpapan Baru, Block AA-4 No.30 Balikpapan 76114 East Kalimantan - Indonesia','(+62 542) 878618, 878619','(+62 542) 873450','info@indosafepratama.com','',11,'hubungi-kami','contact-us');

/*Table structure for table `counter` */

DROP TABLE IF EXISTS `counter`;

CREATE TABLE `counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitor` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kunjungan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `counter` */

insert  into `counter`(`id`,`visitor`,`tanggal`,`kunjungan`) values 
(40,'f4b16b65103938e37973df3b8dfb0305','2014-02-10 18:11:03',40),
(41,'bf63a4388830a66cef96507a23713c81','2014-02-10 18:18:40',31),
(42,'4fb22ebfc644615f152aa69164bdcbc7','2014-02-10 18:49:04',17),
(43,'416dd9f230ec3e33f209235f06f950d4','2014-02-10 18:51:44',27),
(44,'9ae6be684686bd09105a3d8fd31b857d','2014-02-10 19:36:23',20),
(45,'058d935ee44e502cbbc043dfce95637d','2014-02-10 19:36:59',17),
(46,'dc7bc821a998abe0bcea448e6737e10c','2014-02-10 19:43:15',4);

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT 0,
  `name_id` varchar(200) DEFAULT NULL,
  `name_en` varchar(200) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `publish` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1407 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `country` */

insert  into `country`(`id`,`parent`,`name_id`,`name_en`,`url_id`,`url_en`,`level`,`publish`) values 
(1,0,'United States of America','','united-states-of-america','',1,1),
(2,0,'Canada','','canada','',1,1),
(3,0,'United Kingdom','','united-kingdom','',1,1),
(4,0,'Australia','','australia','',1,1),
(5,0,'Japan','','japan','',1,1),
(6,0,'France','','france','',1,1),
(7,0,'Germany','','germany','',1,1),
(8,0,'Sweden','','sweden','',1,1),
(9,0,'New Zealand','','new-zealand','',1,1),
(10,0,'Italy','','italy','',1,1),
(11,0,'Argentina','','argentina','',1,1),
(12,0,'Austria','','austria','',1,1),
(13,0,'Belgium','','belgium','',1,1),
(14,0,'Brazil','','brazil','',1,1),
(15,0,'China','','china','',1,1),
(16,0,'Hong Kong','','hong-kong','',1,1),
(17,0,'Jawa timur','','indonesia','',1,1),
(18,0,'India','','india','',1,1),
(19,0,'Israel','','israel','',1,1),
(20,0,'Malaysia','','malaysia','',1,1),
(21,0,'Mexico','','mexico','',1,1),
(22,0,'Netherlands','','netherlands','',1,1),
(23,0,'Norway','','norway','',1,1),
(24,0,'Philippines','','philippines','',1,1),
(25,0,'Portugal','','portugal','',1,1),
(26,0,'Switzerland','','switzerland','',1,1),
(27,0,'Thailand','','thailand','',1,1),
(28,0,'Turkey','','turkey','',1,1),
(29,0,'United Arab Emirates','','united-arab-emirates','',1,1),
(30,0,'Pakistan','','pakistan','',1,1),
(31,0,'Luxembourg','','luxembourg','',1,1),
(32,0,'Bermuda','','bermuda','',1,1),
(33,0,'Cayman Islands','','cayman-islands','',1,1),
(34,0,'San Marino','','san-marino','',1,1),
(35,0,'Denmark','','denmark','',1,1),
(36,0,'Iceland','','iceland','',1,1),
(37,0,'Ireland','','ireland','',1,1),
(38,0,'Aruba','','aruba','',1,1),
(39,0,'Finland','','finland','',1,1),
(40,0,'Monaco','','monaco','',1,1),
(41,0,'Liechtenstein','','liechtenstein','',1,1),
(42,0,'Jersey','','jersey','',1,1),
(43,0,'Taiwan','','taiwan','',1,1),
(44,0,'Faroe Islands','','faroe-islands','',1,1),
(45,0,'Spain','','spain','',1,1),
(46,0,'Qatar','','qatar','',1,1),
(47,0,'Guam','','guam','',1,1),
(48,0,'Isle Of Man','','isle-of-man','',1,1),
(49,0,'Greece','','greece','',1,1),
(50,0,'Greenland','','greenland','',1,1),
(51,0,'Guernsey','','guernsey','',1,1),
(52,0,'Macau','','macau','',1,1),
(53,0,'Cyprus','','cyprus','',1,1),
(54,0,'Andorra','','andorra','',1,1),
(55,0,'Kuwait','','kuwait','',1,1),
(56,0,'Slovenia','','slovenia','',1,1),
(57,0,'Brunei','','brunei','',1,1),
(58,0,'Korea, South','','korea-south','',1,1),
(59,0,'Malta','','malta','',1,1),
(60,0,'French Polynesia','','french-polynesia','',1,1),
(61,0,'Gibraltar','','gibraltar','',1,1),
(62,0,'Virgin Islands','','virgin-islands','',1,1),
(63,0,'Bahrain','','bahrain','',1,1),
(64,0,'Puerto Rico','','puerto-rico','',1,1),
(65,0,'Bahamas','','bahamas','',1,1),
(66,0,'British Virgin Is.','','british-virgin-is','',1,1),
(67,0,'Barbados','','barbados','',1,1),
(68,0,'Czech Republic','','czech-republic','',1,1),
(69,0,'New Caledonia','','new-caledonia','',1,1),
(70,0,'Martinique','','martinique','',1,1),
(71,0,'Hungary','','hungary','',1,1),
(72,0,'Slovakia','','slovakia','',1,1),
(73,0,'Oman','','oman','',1,1),
(74,0,'Uruguay','','uruguay','',1,1),
(75,0,'N. Mariana Islands','','n-mariana-islands','',1,1),
(76,0,'Estonia','','estonia','',1,1),
(77,0,'Saudi Arabia','','saudi-arabia','',1,1),
(78,0,'Lithuania','','lithuania','',1,1),
(79,0,'Mauritius','','mauritius','',1,1),
(80,0,'Netherlands Antilles','','netherlands-antilles','',1,1),
(81,0,'Poland','','poland','',1,1),
(82,0,'Antigua & Barbuda','','antigua--barbuda','',1,1),
(83,0,'South Africa','','south-africa','',1,1),
(84,0,'Croatia','','croatia','',1,1),
(85,0,'Latvia','','latvia','',1,1),
(86,0,'Chile','','chile','',1,1),
(87,0,'Turks & Caicos Is','','turks--caicos-is','',1,1),
(88,0,'Trinidad & Tobago','','trinidad--tobago','',1,1),
(89,0,'Costa Rica','','costa-rica','',1,1),
(90,0,'Botswana','','botswana','',1,1),
(91,0,'Palau','','palau','',1,1),
(92,0,'Russia','','russia','',1,1),
(93,0,'Saint Kitts & Nevis','','saint-kitts--nevis','',1,1),
(94,0,'Anguilla','','anguilla','',1,1),
(95,0,'French Guiana','','french-guiana','',1,1),
(96,0,'American Samoa','','american-samoa','',1,1),
(97,0,'Guadeloupe','','guadeloupe','',1,1),
(98,0,'Seychelles','','seychelles','',1,1),
(99,0,'Bulgaria','','bulgaria','',1,1),
(100,0,'Namibia','','namibia','',1,1),
(101,0,'Iran','','iran','',1,1),
(102,0,'Romania','','romania','',1,1),
(103,0,'St Pierre & Miquelon','','st-pierre--miquelon','',1,1),
(104,0,'Tunisia','','tunisia','',1,1),
(105,0,'Macedonia','','macedonia','',1,1),
(106,0,'Libya','','libya','',1,1),
(107,0,'Colombia','','colombia','',1,1),
(108,0,'Kazakhstan','','kazakhstan','',1,1),
(109,0,'Panama','','panama','',1,1),
(110,0,'Belarus','','belarus','',1,1),
(111,0,'Bosnia & Herzegovina','','bosnia--herzegovina','',1,1),
(112,0,'Algeria','','algeria','',1,1),
(113,0,'Dominican Republic','','dominican-republic','',1,1),
(114,0,'Fiji','','fiji','',1,1),
(115,0,'Reunion','','reunion','',1,1),
(116,0,'Turkmenistan','','turkmenistan','',1,1),
(117,0,'Samoa','','samoa','',1,1),
(118,0,'Gabon','','gabon','',1,1),
(119,0,'Dominica','','dominica','',1,1),
(120,0,'Saint Lucia','','saint-lucia','',1,1),
(121,0,'Ukraine','','ukraine','',1,1),
(122,0,'Peru','','peru','',1,1),
(123,0,'Cook Islands','','cook-islands','',1,1),
(124,0,'Grenada','','grenada','',1,1),
(125,0,'Nauru','','nauru','',1,1),
(126,0,'Belize','','belize','',1,1),
(127,0,'Swaziland','','swaziland','',1,1),
(128,0,'El Salvador','','el-salvador','',1,1),
(129,0,'Lebanon','','lebanon','',1,1),
(130,0,'Venezuela','','venezuela','',1,1),
(131,0,'Paraguay','','paraguay','',1,1),
(132,0,'Albania','','albania','',1,1),
(133,0,'Jordan','','jordan','',1,1),
(134,0,'Guatemala','','guatemala','',1,1),
(135,0,'Egypt','','egypt','',1,1),
(136,0,'Guyana','','guyana','',1,1),
(137,0,'Morocco','','morocco','',1,1),
(138,0,'Suriname','','suriname','',1,1),
(139,0,'Jamaica','','jamaica','',1,1),
(140,0,'Maldives','','maldives','',1,1),
(141,0,'Sri Lanka','','sri-lanka','',1,1),
(142,0,'Wallis And Futuna','','wallis-and-futuna','',1,1),
(143,0,'Armenia','','armenia','',1,1),
(144,0,'Azerbaijan','','azerbaijan','',1,1),
(145,0,'Montserrat','','montserrat','',1,1),
(146,0,'Ecuador','','ecuador','',1,1),
(147,0,'Syria','','syria','',1,1),
(148,0,'Lesotho','','lesotho','',1,1),
(149,0,'Cuba','','cuba','',1,1),
(150,0,'Saint Vincent & The Grenadines','','saint-vincent--the-grenadines','',1,1),
(151,0,'Vanuatu','','vanuatu','',1,1),
(152,0,'Equatorial Guinea','','equatorial-guinea','',1,1),
(153,0,'Honduras','','honduras','',1,1),
(154,0,'Mayotte','','mayotte','',1,1),
(155,0,'Georgia','','georgia','',1,1),
(156,0,'Saint Helena','','saint-helena','',1,1),
(157,0,'Vietnam','','vietnam','',1,1),
(158,0,'Bolivia','','bolivia','',1,1),
(159,0,'Nicaragua','','nicaragua','',1,1),
(160,0,'Ghana','','ghana','',1,1),
(161,0,'Papua New Guinea','','papua-new-guinea','',1,1),
(162,0,'Serbia','','serbia','',1,1),
(163,0,'Tonga','','tonga','',1,1),
(164,0,'Guinea','','guinea','',1,1),
(165,0,'Micronesia, Fed. St.','','micronesia-fed-st','',1,1),
(166,0,'Angola','','angola','',1,1),
(167,0,'Bangladesh','','bangladesh','',1,1),
(168,0,'Cambodia','','cambodia','',1,1),
(169,0,'Sudan','','sudan','',1,1),
(170,0,'Zimbabwe','','zimbabwe','',1,1),
(171,0,'Burma','','burma','',1,1),
(172,0,'Cameroon','','cameroon','',1,1),
(173,0,'Mauritania','','mauritania','',1,1),
(174,0,'Moldova','','moldova','',1,1),
(175,0,'Mongolia','','mongolia','',1,1),
(176,0,'Gambia','','gambia','',1,1),
(177,0,'Laos','','laos','',1,1),
(178,0,'Solomon Islands','','solomon-islands','',1,1),
(179,0,'Uzbekistan','','uzbekistan','',1,1),
(180,0,'Haiti','','haiti','',1,1),
(181,0,'Kyrgyzstan','','kyrgyzstan','',1,1),
(182,0,'Marshall Islands','','marshall-islands','',1,1),
(183,0,'Senegal','','senegal','',1,1),
(184,0,'Iraq','','iraq','',1,1),
(185,0,'Togo','','togo','',1,1),
(186,0,'Cape Verde','','cape-verde','',1,1),
(187,0,'Cote D\'ivoire','','','',1,1),
(188,0,'Nepal','','nepal','',1,1),
(189,0,'Uganda','','uganda','',1,1),
(190,0,'Bhutan','','bhutan','',1,1),
(191,0,'Djibouti','','djibouti','',1,1),
(192,0,'Korea, North','','korea-north','',1,1),
(193,0,'Rwanda','','rwanda','',1,1),
(194,0,'Chad','','chad','',1,1),
(195,0,'Mozambique','','mozambique','',1,1),
(196,0,'Sao Tome & Principe','','sao-tome--principe','',1,1),
(197,0,'Benin','','benin','',1,1),
(198,0,'Burkina Faso','','burkina-faso','',1,1),
(199,0,'Central African Rep.','','central-african-rep','',1,1),
(200,0,'Tuvalu','','tuvalu','',1,1),
(201,0,'Kenya','','kenya','',1,1),
(202,0,'Liberia','','liberia','',1,1),
(203,0,'Tajikistan','','tajikistan','',1,1),
(204,0,'Mali','','mali','',1,1),
(205,0,'Nigeria','','nigeria','',1,1),
(206,0,'Guinea-Bissau','','guinea-bissau','',1,1),
(207,0,'Kiribati','','kiribati','',1,1),
(208,0,'Madagascar','','madagascar','',1,1),
(209,0,'Niger','','niger','',1,1),
(210,0,'West Bank','','west-bank','',1,1),
(211,0,'Yemen','','yemen','',1,1),
(212,0,'Zambia','','zambia','',1,1),
(213,0,'Afghanistan','','afghanistan','',1,1),
(214,0,'Comoros','','comoros','',1,1),
(215,0,'Congo, Dem. Rep.','','congo-dem-rep','',1,1),
(216,0,'Congo, Repub. Of The','','congo-repub-of-the','',1,1),
(217,0,'Eritrea','','eritrea','',1,1),
(218,0,'Ethiopia','','ethiopia','',1,1),
(219,0,'Burundi','','burundi','',1,1),
(220,0,'Gaza Strip','','gaza-strip','',1,1),
(221,0,'Malawi','','malawi','',1,1),
(222,0,'Tanzania','','tanzania','',1,1),
(223,0,'East Timor','','east-timor','',1,1),
(224,0,'Sierra Leone','','sierra-leone','',1,1),
(225,0,'Somalia','','somalia','',1,1),
(226,0,'Western Saharas','','western-sahara','',1,1),
(227,1,'California','','california','',2,1),
(228,1,'Texas','','texas','',2,1),
(229,1,'New York','','new-york','',2,1),
(230,1,'Florida','','florida','',2,1),
(231,1,'Illinois','','illinois','',2,1),
(232,1,'Pennsylvania','','pennsylvania','',2,1),
(233,1,'Ohio','','ohio','',2,1),
(234,1,'Michigan','','michigan','',2,1),
(235,1,'New Jersey','','new-jersey','',2,1),
(236,1,'Georgia','','georgia1','',2,1),
(237,1,'North Carolina','','north-carolina','',2,1),
(238,1,'Virginia','','virginia','',2,1),
(239,1,'Massachusetts','','massachusetts','',2,1),
(240,1,'Indiana','','indiana','',2,1),
(241,1,'Washington','','washington','',2,1),
(242,1,'Tennessee','','tennessee','',2,1),
(243,1,'Missouri','','missouri','',2,1),
(244,1,'Wisconsin','','wisconsin','',2,1),
(245,1,'Maryland','','maryland','',2,1),
(246,1,'Arizona','','arizona','',2,1),
(247,1,'Minnesota','','minnesota','',2,1),
(248,1,'Louisiana','','louisiana','',2,1),
(249,1,'Alabama','','alabama','',2,1),
(250,1,'Colorado','','colorado','',2,1),
(251,1,'Kentucky','','kentucky','',2,1),
(252,1,'South Carolina','','south-carolina','',2,1),
(253,1,'Oklahoma','','oklahoma','',2,1),
(254,1,'Oregon','','oregon','',2,1),
(255,1,'Connecticut','','connecticut','',2,1),
(256,1,'Iowa','','iowa','',2,1),
(257,1,'Mississippi','','mississippi','',2,1),
(258,1,'Kansas','','kansas','',2,1),
(259,1,'Arkansas','','arkansas','',2,1),
(260,1,'Utah','','utah','',2,1),
(261,1,'Nevada','','nevada','',2,1),
(262,1,'New Mexico','','new-mexico','',2,1),
(263,1,'West Virginia','','west-virginia','',2,1),
(264,1,'Nebraska','','nebraska','',2,1),
(265,1,'Idaho','','idaho','',2,1),
(266,1,'Maine','','maine','',2,1),
(267,1,'New Hampshire','','new-hampshire','',2,1),
(268,1,'Hawaii','','hawaii','',2,1),
(269,1,'Rhode Island','','rhode-island','',2,1),
(270,1,'Montana','','montana','',2,1),
(271,1,'Delaware','','delaware','',2,1),
(272,1,'South Dakota','','south-dakota','',2,1),
(273,1,'North Dakota','','north-dakota','',2,1),
(274,1,'Alaska','','alaska','',2,1),
(275,1,'Vermont','','vermont','',2,1),
(276,1,'District of Columbia','','district-of-columbia','',2,1),
(277,1,'Wyoming','','wyoming','',2,1),
(278,2,'Ontario','','ontario','',2,1),
(279,2,'Quebec','','quebec','',2,1),
(280,2,'British Columbia','','british-columbia','',2,1),
(281,2,'Alberta','','alberta','',2,1),
(282,2,'Manitoba','','manitoba','',2,1),
(283,2,'Saskatchewan','','saskatchewan','',2,1),
(284,2,'Nova Scotia','','nova-scotia','',2,1),
(285,2,'New Brunswick','','new-brunswick','',2,1),
(286,2,'Newfoundland and Labrador','','newfoundland-and-labrador','',2,1),
(287,2,'Prince Edward Island','','prince-edward-island','',2,1),
(288,2,'Northwest Territories','','northwest-territories','',2,1),
(289,2,'Yukon','','yukon','',2,1),
(290,2,'Nunavut','','nunavut','',2,1),
(291,3,'United Kingdom','','united-kingdom1','',2,1),
(292,4,'Australia','','australia1','',2,1),
(293,5,'Japan','','japan1','',2,1),
(294,6,'France','','france1','',2,1),
(295,7,'Germany','','germany1','',2,1),
(296,8,'Sweden','','sweden1','',2,1),
(297,9,'New Zealand','','new-zealand1','',2,1),
(298,10,'Italy','','italy1','',2,1),
(299,11,'Argentina','','argentina1','',2,1),
(300,12,'Austria','','austria1','',2,1),
(301,13,'Belgium','','belgium1','',2,1),
(302,14,'Brazil','','brazil1','',2,1),
(303,15,'China','','china1','',2,1),
(304,16,'Hong Kong','','hong-kong1','',2,1),
(305,17,'Surabaya','','indonesia1','',2,1),
(306,18,'India','','india1','',2,1),
(307,19,'Israel','','israel1','',2,1),
(308,20,'Malaysia','','malaysia1','',2,1),
(309,21,'Mexico','','mexico1','',2,1),
(310,22,'Netherlands','','netherlands1','',2,1),
(311,23,'Norway','','norway1','',2,1),
(312,24,'Philippines','','philippines1','',2,1),
(313,25,'Portugal','','portugal1','',2,1),
(314,26,'Switzerland','','switzerland1','',2,1),
(315,27,'Thailand','','thailand1','',2,1),
(316,28,'Turkey','','turkey1','',2,1),
(317,29,'United Arab Emirates','','united-arab-emirates1','',2,1),
(318,30,'Pakistan','','pakistan1','',2,1),
(319,31,'Luxembourg','','luxembourg1','',2,1),
(320,32,'Bermuda','','bermuda1','',2,1),
(321,33,'Cayman Islands','','cayman-islands1','',2,1),
(322,34,'San Marino','','san-marino1','',2,1),
(323,35,'Denmark','','denmark1','',2,1),
(324,36,'Iceland','','iceland1','',2,1),
(325,37,'Ireland','','ireland1','',2,1),
(326,38,'Aruba','','aruba1','',2,1),
(327,39,'Finland','','finland1','',2,1),
(328,40,'Monaco','','monaco1','',2,1),
(329,41,'Liechtenstein','','liechtenstein1','',2,1),
(330,42,'Jersey','','jersey1','',2,1),
(331,43,'Taiwan','','taiwan1','',2,1),
(332,44,'Faroe Islands','','faroe-islands1','',2,1),
(333,45,'Spain','','spain1','',2,1),
(334,46,'Qatar','','qatar1','',2,1),
(335,47,'Guam','','guam1','',2,1),
(336,48,'Isle Of Man','','isle-of-man1','',2,1),
(337,49,'Greece','','greece1','',2,1),
(338,50,'Greenland','','greenland1','',2,1),
(339,51,'Guernsey','','guernsey1','',2,1),
(340,52,'Macau','','macau1','',2,1),
(341,53,'Cyprus','','cyprus1','',2,1),
(342,54,'Andorra','','andorra1','',2,1),
(343,55,'Kuwait','','kuwait1','',2,1),
(344,56,'Slovenia','','slovenia1','',2,1),
(345,57,'Brunei','','brunei1','',2,1),
(346,58,'Korea, South','','korea-south1','',2,1),
(347,59,'Malta','','malta1','',2,1),
(348,60,'French Polynesia','','french-polynesia1','',2,1),
(349,61,'Gibraltar','','gibraltar1','',2,1),
(350,62,'Virgin Islands','','virgin-islands1','',2,1),
(351,63,'Bahrain','','bahrain1','',2,1),
(352,64,'Puerto Rico','','puerto-rico1','',2,1),
(353,65,'Bahamas','','bahamas1','',2,1),
(354,66,'British Virgin Is.','','british-virgin-is1','',2,1),
(355,67,'Barbados','','barbados1','',2,1),
(356,68,'Czech Republic','','czech-republic1','',2,1),
(357,69,'New Caledonia','','new-caledonia1','',2,1),
(358,70,'Martinique','','martinique1','',2,1),
(359,71,'Hungary','','hungary1','',2,1),
(360,72,'Slovakia','','slovakia1','',2,1),
(361,73,'Oman','','oman1','',2,1),
(362,74,'Uruguay','','uruguay1','',2,1),
(363,75,'N. Mariana Islands','','n-mariana-islands1','',2,1),
(364,76,'Estonia','','estonia1','',2,1),
(365,77,'Saudi Arabia','','saudi-arabia1','',2,1),
(366,78,'Lithuania','','lithuania1','',2,1),
(367,79,'Mauritius','','mauritius1','',2,1),
(368,80,'Netherlands Antilles','','netherlands-antilles1','',2,1),
(369,81,'Poland','','poland1','',2,1),
(370,82,'Antigua & Barbuda','','antigua--barbuda1','',2,1),
(371,83,'South Africa','','south-africa1','',2,1),
(372,84,'Croatia','','croatia1','',2,1),
(373,85,'Latvia','','latvia1','',2,1),
(374,86,'Chile','','chile1','',2,1),
(375,87,'Turks & Caicos Is','','turks--caicos-is1','',2,1),
(376,88,'Trinidad & Tobago','','trinidad--tobago1','',2,1),
(377,89,'Costa Rica','','costa-rica1','',2,1),
(378,90,'Botswana','','botswana1','',2,1),
(379,91,'Palau','','palau1','',2,1),
(380,92,'Russia','','russia1','',2,1),
(381,93,'Saint Kitts & Nevis','','saint-kitts--nevis1','',2,1),
(382,94,'Anguilla','','anguilla1','',2,1),
(383,95,'French Guiana','','french-guiana1','',2,1),
(384,96,'American Samoa','','american-samoa1','',2,1),
(385,97,'Guadeloupe','','guadeloupe1','',2,1),
(386,98,'Seychelles','','seychelles1','',2,1),
(387,99,'Bulgaria','','bulgaria1','',2,1),
(388,100,'Namibia','','namibia1','',2,1),
(389,101,'Iran','','iran1','',2,1),
(390,102,'Romania','','romania1','',2,1),
(391,103,'St Pierre & Miquelon','','st-pierre--miquelon1','',2,1),
(392,104,'Tunisia','','tunisia1','',2,1),
(393,105,'Macedonia','','macedonia1','',2,1),
(394,106,'Libya','','libya1','',2,1),
(395,107,'Colombia','','colombia1','',2,1),
(396,108,'Kazakhstan','','kazakhstan1','',2,1),
(397,109,'Panama','','panama1','',2,1),
(398,110,'Belarus','','belarus1','',2,1),
(399,111,'Bosnia & Herzegovina','','bosnia--herzegovina1','',2,1),
(400,112,'Algeria','','algeria1','',2,1),
(401,113,'Dominican Republic','','dominican-republic1','',2,1),
(402,114,'Fiji','','fiji1','',2,1),
(403,115,'Reunion','','reunion1','',2,1),
(404,116,'Turkmenistan','','turkmenistan1','',2,1),
(405,117,'Samoa','','samoa1','',2,1),
(406,118,'Gabon','','gabon1','',2,1),
(407,119,'Dominica','','dominica1','',2,1),
(408,120,'Saint Lucia','','saint-lucia1','',2,1),
(409,121,'Ukraine','','ukraine1','',2,1),
(410,122,'Peru','','peru1','',2,1),
(411,123,'Cook Islands','','cook-islands1','',2,1),
(412,124,'Grenada','','grenada1','',2,1),
(413,125,'Nauru','','nauru1','',2,1),
(414,126,'Belize','','belize1','',2,1),
(415,127,'Swaziland','','swaziland1','',2,1),
(416,128,'El Salvador','','el-salvador1','',2,1),
(417,129,'Lebanon','','lebanon1','',2,1),
(418,130,'Venezuela','','venezuela1','',2,1),
(419,131,'Paraguay','','paraguay1','',2,1),
(420,132,'Albania','','albania1','',2,1),
(421,133,'Jordan','','jordan1','',2,1),
(422,134,'Guatemala','','guatemala1','',2,1),
(423,135,'Egypt','','egypt1','',2,1),
(424,136,'Guyana','','guyana1','',2,1),
(425,137,'Morocco','','morocco1','',2,1),
(426,138,'Suriname','','suriname1','',2,1),
(427,139,'Jamaica','','jamaica1','',2,1),
(428,140,'Maldives','','maldives1','',2,1),
(429,141,'Sri Lanka','','sri-lanka1','',2,1),
(430,142,'Wallis And Futuna','','wallis-and-futuna1','',2,1),
(431,143,'Armenia','','armenia1','',2,1),
(432,144,'Azerbaijan','','azerbaijan1','',2,1),
(433,145,'Montserrat','','montserrat1','',2,1),
(434,146,'Ecuador','','ecuador1','',2,1),
(435,147,'Syria','','syria1','',2,1),
(436,148,'Lesotho','','lesotho1','',2,1),
(437,149,'Cuba','','cuba1','',2,1),
(438,150,'Saint Vincent & The Grenadines','','saint-vincent--the-grenadines1','',2,1),
(439,151,'Vanuatu','','vanuatu1','',2,1),
(440,152,'Equatorial Guinea','','equatorial-guinea1','',2,1),
(441,153,'Honduras','','honduras1','',2,1),
(442,154,'Mayotte','','mayotte1','',2,1),
(443,155,'Georgia','','georgia2','',2,1),
(444,156,'Saint Helena','','saint-helena1','',2,1),
(445,157,'Vietnam','','vietnam1','',2,1),
(446,158,'Bolivia','','bolivia1','',2,1),
(447,159,'Nicaragua','','nicaragua1','',2,1),
(448,160,'Ghana','','ghana1','',2,1),
(449,161,'Papua New Guinea','','papua-new-guinea1','',2,1),
(450,162,'Serbia','','serbia1','',2,1),
(451,163,'Tonga','','tonga1','',2,1),
(452,164,'Guinea','','guinea1','',2,1),
(453,165,'Micronesia, Fed. St.','','micronesia-fed-st1','',2,1),
(454,166,'Angola','','angola1','',2,1),
(455,167,'Bangladesh','','bangladesh1','',2,1),
(456,168,'Cambodia','','cambodia1','',2,1),
(457,169,'Sudan','','sudan1','',2,1),
(458,170,'Zimbabwe','','zimbabwe1','',2,1),
(459,171,'Burma','','burma1','',2,1),
(460,172,'Cameroon','','cameroon1','',2,1),
(461,173,'Mauritania','','mauritania1','',2,1),
(462,174,'Moldova','','moldova1','',2,1),
(463,175,'Mongolia','','mongolia1','',2,1),
(464,176,'Gambia','','gambia1','',2,1),
(465,177,'Laos','','laos1','',2,1),
(466,178,'Solomon Islands','','solomon-islands1','',2,1),
(467,179,'Uzbekistan','','uzbekistan1','',2,1),
(468,180,'Haiti','','haiti1','',2,1),
(469,181,'Kyrgyzstan','','kyrgyzstan1','',2,1),
(470,182,'Marshall Islands','','marshall-islands1','',2,1),
(471,183,'Senegal','','senegal1','',2,1),
(472,184,'Iraq','','iraq1','',2,1),
(473,185,'Togo','','togo1','',2,1),
(474,186,'Cape Verde','','cape-verde1','',2,1),
(475,187,'Cote D\'ivoire','','','',2,1),
(476,188,'Nepal','','nepal1','',2,1),
(477,189,'Uganda','','uganda1','',2,1),
(478,190,'Bhutan','','bhutan1','',2,1),
(479,191,'Djibouti','','djibouti1','',2,1),
(480,192,'Korea, North','','korea-north1','',2,1),
(481,193,'Rwanda','','rwanda1','',2,1),
(482,194,'Chad','','chad1','',2,1),
(483,195,'Mozambique','','mozambique1','',2,1),
(484,196,'Sao Tome & Principe','','sao-tome--principe1','',2,1),
(485,197,'Benin','','benin1','',2,1),
(486,198,'Burkina Faso','','burkina-faso1','',2,1),
(487,199,'Central African Rep.','','central-african-rep1','',2,1),
(488,200,'Tuvalu','','tuvalu1','',2,1),
(489,201,'Kenya','','kenya1','',2,1),
(490,202,'Liberia','','liberia1','',2,1),
(491,203,'Tajikistan','','tajikistan1','',2,1),
(492,204,'Mali','','mali1','',2,1),
(493,205,'Nigeria','','nigeria1','',2,1),
(494,206,'Guinea-Bissau','','guinea-bissau1','',2,1),
(495,207,'Kiribati','','kiribati1','',2,1),
(496,208,'Madagascar','','madagascar1','',2,1),
(497,209,'Niger','','niger1','',2,1),
(498,210,'West Bank','','west-bank1','',2,1),
(499,211,'Yemen','','yemen1','',2,1),
(500,212,'Zambia','','zambia1','',2,1),
(501,213,'Afghanistan','','afghanistan1','',2,1),
(502,214,'Comoros','','comoros1','',2,1),
(503,215,'Congo, Dem. Rep.','','congo-dem-rep1','',2,1),
(504,216,'Congo, Repub. Of The','','congo-repub-of-the1','',2,1),
(505,217,'Eritrea','','eritrea1','',2,1),
(506,218,'Ethiopia','','ethiopia1','',2,1),
(507,219,'Burundi','','burundi1','',2,1),
(508,220,'Gaza Strip','','gaza-strip1','',2,1),
(509,221,'Malawi','','malawi1','',2,1),
(510,222,'Tanzania','','tanzania1','',2,1),
(511,223,'East Timor','','east-timor1','',2,1),
(512,224,'Sierra Leone','','sierra-leone1','',2,1),
(513,225,'Somalia','','somalia1','',2,1),
(514,226,'Western Sahara','','western-sahara1','',2,1),
(515,227,'Bakersfield','','bakersfield','',3,1),
(516,227,'Chico','','chico','',3,1),
(517,227,'Fresno','','fresno','',3,1),
(518,227,'Humboldt County','','humboldt-county','',3,1),
(519,227,'Imperial County','','imperial-county','',3,1),
(520,227,'Inland Empire','','inland-empire','',3,1),
(521,227,'Long Beach','','long-beach','',3,1),
(522,227,'Los Angeles','','los-angeles','',3,1),
(523,227,'Mendocino','','mendocino','',3,1),
(524,227,'Merced','','merced','',3,1),
(525,227,'Modesto','','modesto','',3,1),
(526,227,'Monterey','','monterey','',3,1),
(527,227,'North Bay','','north-bay','',3,1),
(528,227,'Oakland/East Bay','','oaklandeast-bay','',3,1),
(529,227,'Orange County','','orange-county','',3,1),
(530,227,'Palm Springs','','palm-springs','',3,1),
(531,227,'Palmdale','','palmdale','',3,1),
(532,227,'Redding','','redding','',3,1),
(533,227,'Sacramento','','sacramento','',3,1),
(534,227,'San Diego','','san-diego','',3,1),
(535,227,'San Fernando Valley','','san-fernando-valley','',3,1),
(536,227,'San Francisco','','san-francisco','',3,1),
(537,227,'San Gabriel Valley','','san-gabriel-valley','',3,1),
(538,227,'San Jose','','san-jose','',3,1),
(539,227,'San Luis Obispo','','san-luis-obispo','',3,1),
(540,227,'San Mateo','','san-mateo','',3,1),
(541,227,'Santa Barbara','','santa-barbara','',3,1),
(542,227,'Santa Cruz','','santa-cruz','',3,1),
(543,227,'Santa Maria','','santa-maria','',3,1),
(544,227,'Siskiyou','','siskiyou','',3,1),
(545,227,'Stockton','','stockton','',3,1),
(546,227,'Susanville','','susanville','',3,1),
(547,227,'Upstate California','','upstate-california','',3,1),
(548,227,'Ventura','','ventura','',3,1),
(549,227,'Visalia','','visalia','',3,1),
(550,228,'Abilene','','abilene','',3,1),
(551,228,'Amarillo','','amarillo','',3,1),
(552,228,'Austin','','austin','',3,1),
(553,228,'Beaumont','','beaumont','',3,1),
(554,228,'Brownsville','','brownsville','',3,1),
(555,228,'College Station','','college-station','',3,1),
(556,228,'Corpus Christi','','corpus-christi','',3,1),
(557,228,'Dallas','','dallas','',3,1),
(558,228,'Del Rio','','del-rio','',3,1),
(559,228,'Denton','','denton','',3,1),
(560,228,'El Paso','','el-paso','',3,1),
(561,228,'Fort Worth','','fort-worth','',3,1),
(562,228,'Galveston','','galveston','',3,1),
(563,228,'Houston','','houston','',3,1),
(564,228,'Huntsville','','huntsville','',3,1),
(565,228,'Killeen','','killeen','',3,1),
(566,228,'Laredo','','laredo','',3,1),
(567,228,'Lubbock','','lubbock','',3,1),
(568,228,'Mcallen','','mcallen','',3,1),
(569,228,'Mid Cities','','mid-cities','',3,1),
(570,228,'Odessa','','odessa','',3,1),
(571,228,'San Antonio','','san-antonio','',3,1),
(572,228,'San Marcos','','san-marcos','',3,1),
(573,228,'Texarkana','','texarkana','',3,1),
(574,228,'Texomaland','','texomaland','',3,1),
(575,228,'Tyler','','tyler','',3,1),
(576,228,'Victoria','','victoria','',3,1),
(577,228,'Waco','','waco','',3,1),
(578,228,'Wichita Falls','','wichita-falls','',3,1),
(579,229,'Albany','','albany','',3,1),
(580,229,'Binghamton','','binghamton','',3,1),
(581,229,'Bronx','','bronx','',3,1),
(582,229,'Brooklyn','','brooklyn','',3,1),
(583,229,'Buffalo','','buffalo','',3,1),
(584,229,'Catskills','','catskills','',3,1),
(585,229,'Chautauqua','','chautauqua','',3,1),
(586,229,'Elmira','','elmira','',3,1),
(587,229,'Fairfield','','fairfield','',3,1),
(588,229,'Finger Lakes','','finger-lakes','',3,1),
(589,229,'Glens Falls','','glens-falls','',3,1),
(590,229,'Hudson Valley','','hudson-valley','',3,1),
(591,229,'Ithaca','','ithaca','',3,1),
(592,229,'Long Island','','long-island','',3,1),
(593,229,'Manhattan','','manhattan','',3,1),
(594,229,'New York City','','new-york-city','',3,1),
(595,229,'Oneonta','','oneonta','',3,1),
(596,229,'Plattsburgh','','plattsburgh','',3,1),
(597,229,'Potsdam','','potsdam','',3,1),
(598,229,'Queens','','queens','',3,1),
(599,229,'Rochester','','rochester','',3,1),
(600,229,'Staten Island','','staten-island','',3,1),
(601,229,'Syracuse','','syracuse','',3,1),
(602,229,'Twin Tiers','','twin-tiers','',3,1),
(603,229,'Utica','','utica','',3,1),
(604,229,'Watertown','','watertown','',3,1),
(605,229,'Westchester','','westchester','',3,1),
(606,230,'Daytona','','daytona','',3,1),
(607,230,'Fort Myers','','fort-myers','',3,1),
(608,230,'Ft. Lauderdale','','ft-lauderdale','',3,1),
(609,230,'Gainesville','','gainesville','',3,1),
(610,230,'Jacksonville','','jacksonville','',3,1),
(611,230,'Keys','','keys','',3,1),
(612,230,'Lakeland','','lakeland','',3,1),
(613,230,'Miami','','miami','',3,1),
(614,230,'Ocala','','ocala','',3,1),
(615,230,'Okaloosa','','okaloosa','',3,1),
(616,230,'Orlando','','orlando','',3,1),
(617,230,'Panama City','','panama-city','',3,1),
(618,230,'Pensacola','','pensacola','',3,1),
(619,230,'Sarasota','','sarasota','',3,1),
(620,230,'Space Coast','','space-coast','',3,1),
(621,230,'St. Augustine','','st-augustine','',3,1),
(622,230,'Tallahassee','','tallahassee','',3,1),
(623,230,'Tampa','','tampa','',3,1),
(624,230,'Treasure Coast','','treasure-coast','',3,1),
(625,230,'West Palm Beach','','west-palm-beach','',3,1),
(626,231,'Bloomington','','bloomington','',3,1),
(627,231,'Carbondale','','carbondale','',3,1),
(628,231,'Chambana','','chambana','',3,1),
(629,231,'Chicago','','chicago','',3,1),
(630,231,'Decatur','','decatur','',3,1),
(631,231,'La Salle County','','la-salle-county','',3,1),
(632,231,'Mattoon','','mattoon','',3,1),
(633,231,'Peoria','','peoria','',3,1),
(634,231,'Rockford','','rockford','',3,1),
(635,231,'Springfield','','springfield','',3,1),
(636,231,'Western Illinois','','western-illinois','',3,1),
(637,232,'Allentown','','allentown','',3,1),
(638,232,'Altoona','','altoona','',3,1),
(639,232,'Cumberland Valley','','cumberland-valley','',3,1),
(640,232,'Erie','','erie','',3,1),
(641,232,'Harrisburg','','harrisburg','',3,1),
(642,232,'Lancaster','','lancaster','',3,1),
(643,232,'Meadville','','meadville','',3,1),
(644,232,'Philadelphia','','philadelphia','',3,1),
(645,232,'Pittsburgh','','pittsburgh','',3,1),
(646,232,'Poconos','','poconos','',3,1),
(647,232,'Reading','','reading','',3,1),
(648,232,'Scranton','','scranton','',3,1),
(649,232,'State College','','state-college','',3,1),
(650,232,'Williamsport','','williamsport','',3,1),
(651,232,'York','','york','',3,1),
(652,233,'Akron','','akron','',3,1),
(653,233,'Ashtabula','','ashtabula','',3,1),
(654,233,'Athens','','athens','',3,1),
(655,233,'Chillicothe','','chillicothe','',3,1),
(656,233,'Cincinnati','','cincinnati','',3,1),
(657,233,'Cleveland','','cleveland','',3,1),
(658,233,'Columbus','','columbus','',3,1),
(659,233,'Dayton','','dayton','',3,1),
(660,233,'Huntington/Ashland','','huntingtonashland','',3,1),
(661,233,'Lima/Findlay','','limafindlay','',3,1),
(662,233,'Mansfield','','mansfield','',3,1),
(663,233,'Sandusky','','sandusky','',3,1),
(664,233,'Toledo','','toledo','',3,1),
(665,233,'Tuscarawas County','','tuscarawas-county','',3,1),
(666,233,'Youngstown','','youngstown','',3,1),
(667,233,'Zanesville/Cambridge','','zanesvillecambridge','',3,1),
(668,234,'Ann Arbor','','ann-arbor','',3,1),
(669,234,'Battle Creek','','battle-creek','',3,1),
(670,234,'Central Michigan','','central-michigan','',3,1),
(671,234,'Detroit','','detroit','',3,1),
(672,234,'Flint','','flint','',3,1),
(673,234,'Grand Rapids','','grand-rapids','',3,1),
(674,234,'Holland','','holland','',3,1),
(675,234,'Jackson','','jackson','',3,1),
(676,234,'Kalamazoo','','kalamazoo','',3,1),
(677,234,'Lansing','','lansing','',3,1),
(678,234,'Monroe','','monroe','',3,1),
(679,234,'Muskegon','','muskegon','',3,1),
(680,234,'Northern Michigan','','northern-michigan','',3,1),
(681,234,'Port Huron','','port-huron','',3,1),
(682,234,'Saginaw','','saginaw','',3,1),
(683,234,'Southwest Michigan','','southwest-michigan','',3,1),
(684,234,'Upper Peninsula','','upper-peninsula','',3,1),
(685,235,'Central Jersey','','central-jersey','',3,1),
(686,235,'Jersey Shore','','jersey-shore','',3,1),
(687,235,'New Jersey','','new-jersey1','',3,1),
(688,235,'North Jersey','','north-jersey','',3,1),
(689,235,'South Jersey','','south-jersey','',3,1),
(690,236,'Albany','','albany1','',3,1),
(691,236,'Athens','','athens1','',3,1),
(692,236,'Atlanta','','atlanta','',3,1),
(693,236,'Augusta','','augusta','',3,1),
(694,236,'Brunswick','','brunswick','',3,1),
(695,236,'Columbus','','columbus1','',3,1),
(696,236,'Macon','','macon','',3,1),
(697,236,'Northwest Georgia','','northwest-georgia','',3,1),
(698,236,'Savannah','','savannah','',3,1),
(699,236,'Statesboro','','statesboro','',3,1),
(700,236,'Valdosta','','valdosta','',3,1),
(701,237,'Asheville','','asheville','',3,1),
(702,237,'Boone','','boone','',3,1),
(703,237,'Charlotte','','charlotte','',3,1),
(704,237,'Eastern North Carolina','','eastern-north-carolina','',3,1),
(705,237,'Fayetteville','','fayetteville','',3,1),
(706,237,'Greensboro','','greensboro','',3,1),
(707,237,'Hickory','','hickory','',3,1),
(708,237,'Outer Banks','','outer-banks','',3,1),
(709,237,'Raleigh-Durham','','raleigh-durham','',3,1),
(710,237,'Wilmington','','wilmington','',3,1),
(711,237,'Winston Salem','','winston-salem','',3,1),
(712,238,'Charlottesville','','charlottesville','',3,1),
(713,238,'Chesapeake','','chesapeake','',3,1),
(714,238,'Danville','','danville','',3,1),
(715,238,'Fredericksburg','','fredericksburg','',3,1),
(716,238,'Hampton','','hampton','',3,1),
(717,238,'Harrisonburg','','harrisonburg','',3,1),
(718,238,'Lynchburg','','lynchburg','',3,1),
(719,238,'New River Valley','','new-river-valley','',3,1),
(720,238,'Newport News','','newport-news','',3,1),
(721,238,'Norfolk','','norfolk','',3,1),
(722,238,'Portsmouth','','portsmouth','',3,1),
(723,238,'Richmond','','richmond','',3,1),
(724,238,'Roanoke','','roanoke','',3,1),
(725,238,'Southwest Virginia','','southwest-virginia','',3,1),
(726,238,'Suffolk','','suffolk','',3,1),
(727,238,'Virginia Beach','','virginia-beach','',3,1),
(728,239,'Boston','','boston','',3,1),
(729,239,'Cape Cod','','cape-cod','',3,1),
(730,239,'South Coast','','south-coast','',3,1),
(731,239,'Springfield','','springfield1','',3,1),
(732,239,'Worcester','','worcester','',3,1),
(733,240,'Bloomington','','bloomington1','',3,1),
(734,240,'Evansville','','evansville','',3,1),
(735,240,'Ft Wayne','','ft-wayne','',3,1),
(736,240,'Indianapolis','','indianapolis','',3,1),
(737,240,'Kokomo','','kokomo','',3,1),
(738,240,'Lafayette','','lafayette','',3,1),
(739,240,'Muncie','','muncie','',3,1),
(740,240,'Richmond','','richmond1','',3,1),
(741,240,'South Bend','','south-bend','',3,1),
(742,240,'Terre Haute','','terre-haute','',3,1),
(743,241,'Bellingham','','bellingham','',3,1),
(744,241,'Everett','','everett','',3,1),
(745,241,'Moses Lake','','moses-lake','',3,1),
(746,241,'Mt. Vernon','','mt-vernon','',3,1),
(747,241,'Olympia','','olympia','',3,1),
(748,241,'Pullman','','pullman','',3,1),
(749,241,'Seattle','','seattle','',3,1),
(750,241,'Spokane / Coeur D\'alene','','','',3,1),
(751,241,'Tacoma','','tacoma','',3,1),
(752,241,'Tri-Cities','','tri-cities','',3,1),
(753,241,'Wenatchee','','wenatchee','',3,1),
(754,241,'Yakima','','yakima','',3,1),
(755,242,'Chattanooga','','chattanooga','',3,1),
(756,242,'Clarksville','','clarksville','',3,1),
(757,242,'Cookeville','','cookeville','',3,1),
(758,242,'Knoxville','','knoxville','',3,1),
(759,242,'Memphis','','memphis','',3,1),
(760,242,'Nashville','','nashville','',3,1),
(761,242,'Tri-Cities','','tri-cities1','',3,1),
(762,243,'Columbia / Jeff City','','columbia--jeff-city','',3,1),
(763,243,'Joplin','','joplin','',3,1),
(764,243,'Kansas City','','kansas-city','',3,1),
(765,243,'Kirksville','','kirksville','',3,1),
(766,243,'Lake Of The Ozarks','','lake-of-the-ozarks','',3,1),
(767,243,'Southeast Missouri','','southeast-missouri','',3,1),
(768,243,'Springfield','','springfield2','',3,1),
(769,243,'St. Joseph','','st-joseph','',3,1),
(770,243,'St. Louis','','st-louis','',3,1),
(771,244,'Appleton','','appleton','',3,1),
(772,244,'Eau Claire','','eau-claire','',3,1),
(773,244,'Green Bay','','green-bay','',3,1),
(774,244,'Janesville','','janesville','',3,1),
(775,244,'La Crosse','','la-crosse','',3,1),
(776,244,'Madison','','madison','',3,1),
(777,244,'Milwaukee','','milwaukee','',3,1),
(778,244,'Racine','','racine','',3,1),
(779,244,'Sheboygan','','sheboygan','',3,1),
(780,244,'Wausau','','wausau','',3,1),
(781,245,'Annapolis','','annapolis','',3,1),
(782,245,'Baltimore','','baltimore','',3,1),
(783,245,'Cumberland Valley','','cumberland-valley1','',3,1),
(784,245,'Eastern Shore','','eastern-shore','',3,1),
(785,245,'Frederick','','frederick','',3,1),
(786,245,'Western Maryland','','western-maryland','',3,1),
(787,246,'Flagstaff/Sedona','','flagstaffsedona','',3,1),
(788,246,'Mohave County','','mohave-county','',3,1),
(789,246,'Phoenix','','phoenix','',3,1),
(790,246,'Prescott','','prescott','',3,1),
(791,246,'Show Low','','show-low','',3,1),
(792,246,'Sierra Vista','','sierra-vista','',3,1),
(793,246,'Tucson','','tucson','',3,1),
(794,246,'Yuma','','yuma','',3,1),
(795,247,'Bemidji','','bemidji','',3,1),
(796,247,'Brainerd','','brainerd','',3,1),
(797,247,'Duluth','','duluth','',3,1),
(798,247,'Mankato','','mankato','',3,1),
(799,247,'Minneapolis','','minneapolis','',3,1),
(800,247,'Rochester','','rochester1','',3,1),
(801,247,'St. Cloud','','st-cloud','',3,1),
(802,248,'Alexandria','','alexandria','',3,1),
(803,248,'Baton Rouge','','baton-rouge','',3,1),
(804,248,'Houma','','houma','',3,1),
(805,248,'Lafayette','','lafayette1','',3,1),
(806,248,'Lake Charles','','lake-charles','',3,1),
(807,248,'Monroe','','monroe1','',3,1),
(808,248,'New Orleans','','new-orleans','',3,1),
(809,248,'Shreveport','','shreveport','',3,1),
(810,249,'Auburn','','auburn','',3,1),
(811,249,'Birmingham','','birmingham','',3,1),
(812,249,'Dothan','','dothan','',3,1),
(813,249,'Gadsden','','gadsden','',3,1),
(814,249,'Huntsville','','huntsville1','',3,1),
(815,249,'Mobile','','mobile','',3,1),
(816,249,'Montgomery','','montgomery','',3,1),
(817,249,'Muscle Shoals','','muscle-shoals','',3,1),
(818,249,'Tuscaloosa','','tuscaloosa','',3,1),
(819,250,'Boulder','','boulder','',3,1),
(820,250,'Colorado Springs','','colorado-springs','',3,1),
(821,250,'Denver','','denver','',3,1),
(822,250,'Fort Collins','','fort-collins','',3,1),
(823,250,'Pueblo','','pueblo','',3,1),
(824,250,'Rockies','','rockies','',3,1),
(825,250,'Western Slope','','western-slope','',3,1),
(826,251,'Bowling Green','','bowling-green','',3,1),
(827,251,'Eastern Kentucky','','eastern-kentucky','',3,1),
(828,251,'Lexington','','lexington','',3,1),
(829,251,'Louisville','','louisville','',3,1),
(830,251,'Owensboro','','owensboro','',3,1),
(831,251,'Western Kentucky','','western-kentucky','',3,1),
(832,252,'Charleston','','charleston','',3,1),
(833,252,'Columbia','','columbia','',3,1),
(834,252,'Florence','','florence','',3,1),
(835,252,'Greenville','','greenville','',3,1),
(836,252,'Hilton Head','','hilton-head','',3,1),
(837,252,'Myrtle Beach','','myrtle-beach','',3,1),
(838,253,'Lawton','','lawton','',3,1),
(839,253,'Oklahoma City','','oklahoma-city','',3,1),
(840,253,'Stillwater','','stillwater','',3,1),
(841,253,'Tulsa','','tulsa','',3,1),
(842,254,'Bend','','bend','',3,1),
(843,254,'Corvallis','','corvallis','',3,1),
(844,254,'East Oregon','','east-oregon','',3,1),
(845,254,'Eugene','','eugene','',3,1),
(846,254,'Klamath Falls','','klamath-falls','',3,1),
(847,254,'Medford','','medford','',3,1),
(848,254,'Oregon Coast','','oregon-coast','',3,1),
(849,254,'Portland','','portland','',3,1),
(850,254,'Roseburg','','roseburg','',3,1),
(851,254,'Salem','','salem','',3,1),
(852,255,'Eastern Connecticut','','eastern-connecticut','',3,1),
(853,255,'Hartford','','hartford','',3,1),
(854,255,'New Haven','','new-haven','',3,1),
(855,255,'Northwest Connecticut','','northwest-connecticut','',3,1),
(856,256,'Ames','','ames','',3,1),
(857,256,'Cedar Rapids','','cedar-rapids','',3,1),
(858,256,'Des Moines','','des-moines','',3,1),
(859,256,'Dubuque','','dubuque','',3,1),
(860,256,'Fort Dodge','','fort-dodge','',3,1),
(861,256,'Iowa City','','iowa-city','',3,1),
(862,256,'Mason City','','mason-city','',3,1),
(863,256,'Ottumwa','','ottumwa','',3,1),
(864,256,'Quad Cities','','quad-cities','',3,1),
(865,256,'Sioux City','','sioux-city','',3,1),
(866,256,'Waterloo','','waterloo','',3,1),
(867,257,'Biloxi','','biloxi','',3,1),
(868,257,'Hattiesburg','','hattiesburg','',3,1),
(869,257,'Jackson','','jackson1','',3,1),
(870,257,'Meridian','','meridian','',3,1),
(871,257,'Natchez','','natchez','',3,1),
(872,257,'North Mississippi','','north-mississippi','',3,1),
(873,258,'Lawrence','','lawrence','',3,1),
(874,258,'Manhattan','','manhattan1','',3,1),
(875,258,'Salina','','salina','',3,1),
(876,258,'Topeka','','topeka','',3,1),
(877,258,'Wichita','','wichita','',3,1),
(878,259,'Fayetteville','','fayetteville1','',3,1),
(879,259,'Fort Smith','','fort-smith','',3,1),
(880,259,'Jonesboro','','jonesboro','',3,1),
(881,259,'Little Rock','','little-rock','',3,1),
(882,260,'Logan','','logan','',3,1),
(883,260,'Ogden','','ogden','',3,1),
(884,260,'Provo','','provo','',3,1),
(885,260,'Salt Lake City','','salt-lake-city','',3,1),
(886,260,'St. George','','st-george','',3,1),
(887,261,'Elko','','elko','',3,1),
(888,261,'Las Vegas','','las-vegas','',3,1),
(889,261,'Reno/Tahoe','','renotahoe','',3,1),
(890,262,'Albuquerque','','albuquerque','',3,1),
(891,262,'Clovis / Portales','','clovis--portales','',3,1),
(892,262,'Farmington','','farmington','',3,1),
(893,262,'Las Cruces','','las-cruces','',3,1),
(894,262,'Roswell / Carlsbad','','roswell--carlsbad','',3,1),
(895,262,'Santa Fe','','santa-fe','',3,1),
(896,263,'Charleston','','charleston1','',3,1),
(897,263,'Huntington','','huntington','',3,1),
(898,263,'Martinsburg','','martinsburg','',3,1),
(899,263,'Morgantown','','morgantown','',3,1),
(900,263,'Parkersburg','','parkersburg','',3,1),
(901,263,'Southern West Virginia','','southern-west-virginia','',3,1),
(902,263,'Wheeling','','wheeling','',3,1),
(903,264,'Grand Island','','grand-island','',3,1),
(904,264,'Lincoln','','lincoln','',3,1),
(905,264,'North Platte','','north-platte','',3,1),
(906,264,'Omaha','','omaha','',3,1),
(907,264,'Scottsbluff','','scottsbluff','',3,1),
(908,265,'Boise','','boise','',3,1),
(909,265,'East Idaho','','east-idaho','',3,1),
(910,265,'Lewiston','','lewiston','',3,1),
(911,265,'Twin Falls','','twin-falls','',3,1),
(912,266,'Maine','','maine1','',3,1),
(913,267,'New Hampshire','','new-hampshire1','',3,1),
(914,268,'Big Island','','big-island','',3,1),
(915,268,'Honolulu','','honolulu','',3,1),
(916,268,'Kauai','','kauai','',3,1),
(917,268,'Maui','','maui','',3,1),
(918,269,'Providence','','providence','',3,1),
(919,270,'Billings','','billings','',3,1),
(920,270,'Bozeman','','bozeman','',3,1),
(921,270,'Butte','','butte','',3,1),
(922,270,'Great Falls','','great-falls','',3,1),
(923,270,'Helena','','helena','',3,1),
(924,270,'Kalispell','','kalispell','',3,1),
(925,270,'Missoula','','missoula','',3,1),
(926,271,'Delaware','','delaware1','',3,1),
(927,272,'Aberdeen','','aberdeen','',3,1),
(928,272,'Pierre','','pierre','',3,1),
(929,272,'Rapid City','','rapid-city','',3,1),
(930,272,'Sioux Falls','','sioux-falls','',3,1),
(931,272,'South Dakota','','south-dakota1','',3,1),
(932,273,'Bismarck','','bismarck','',3,1),
(933,273,'Fargo, Nd','','fargo-nd','',3,1),
(934,273,'Grand Forks','','grand-forks','',3,1),
(935,273,'Minot','','minot','',3,1),
(936,273,'North Dakota','','north-dakota1','',3,1),
(937,274,'Anchorage','','anchorage','',3,1),
(938,274,'Fairbanks','','fairbanks','',3,1),
(939,274,'Juneau','','juneau','',3,1),
(940,274,'Kenai Peninsula','','kenai-peninsula','',3,1),
(941,275,'Vermont','','vermont1','',3,1),
(942,276,'Northern Virginia','','northern-virginia','',3,1),
(943,276,'Southern Maryland','','southern-maryland','',3,1),
(944,276,'Washington D.C.','','washington-dc','',3,1),
(945,277,'Wyoming','','wyoming1','',3,1),
(946,278,'Barrie','','barrie','',3,1),
(947,278,'Belleville','','belleville','',3,1),
(948,278,'Brantford','','brantford','',3,1),
(949,278,'Chatham','','chatham','',3,1),
(950,278,'Cornwall','','cornwall','',3,1),
(951,278,'Guelph','','guelph','',3,1),
(952,278,'Hamilton','','hamilton','',3,1),
(953,278,'Kingston','','kingston','',3,1),
(954,278,'Kitchener','','kitchener','',3,1),
(955,278,'London','','london','',3,1),
(956,278,'Niagara','','niagara','',3,1),
(957,278,'Ottawa','','ottawa','',3,1),
(958,278,'Owen Sound','','owen-sound','',3,1),
(959,278,'Peterborough','','peterborough','',3,1),
(960,278,'Sarnia','','sarnia','',3,1),
(961,278,'Sault Ste Marie','','sault-ste-marie','',3,1),
(962,278,'Sudbury','','sudbury','',3,1),
(963,278,'Thunder Bay','','thunder-bay','',3,1),
(964,278,'Toronto','','toronto','',3,1),
(965,278,'Windsor','','windsor','',3,1),
(966,279,'Montreal','','montreal','',3,1),
(967,279,'Quebec City','','quebec-city','',3,1),
(968,279,'Saguenay','','saguenay','',3,1),
(969,279,'Sherbrooke','','sherbrooke','',3,1),
(970,279,'Trois-Rivieres','','trois-rivieres','',3,1),
(971,280,'Abbotsford','','abbotsford','',3,1),
(972,280,'Cariboo','','cariboo','',3,1),
(973,280,'Comox Valley','','comox-valley','',3,1),
(974,280,'Cranbrook','','cranbrook','',3,1),
(975,280,'Kamloops','','kamloops','',3,1),
(976,280,'Kelowna','','kelowna','',3,1),
(977,280,'Nanaimo','','nanaimo','',3,1),
(978,280,'Peace River Country','','peace-river-country','',3,1),
(979,280,'Prince George','','prince-george','',3,1),
(980,280,'Skeena','','skeena','',3,1),
(981,280,'Sunshine Coast','','sunshine-coast','',3,1),
(982,280,'Vancouver','','vancouver','',3,1),
(983,280,'Victoria','','victoria1','',3,1),
(984,280,'Whistler','','whistler','',3,1),
(985,281,'Calgary','','calgary','',3,1),
(986,281,'Edmonton','','edmonton','',3,1),
(987,281,'Ft Mcmurray','','ft-mcmurray','',3,1),
(988,281,'Lethbridge','','lethbridge','',3,1),
(989,281,'Medicine Hat','','medicine-hat','',3,1),
(990,281,'Red Deer','','red-deer','',3,1),
(991,282,'Winnipeg','','winnipeg','',3,1),
(992,283,'Regina','','regina','',3,1),
(993,283,'Saskatoon','','saskatoon','',3,1),
(994,284,'Halifax','','halifax','',3,1),
(995,285,'New Brunswick','','new-brunswick1','',3,1),
(996,286,'St. John\'s','','','',3,1),
(997,287,'Prince Edward Island','','prince-edward-island1','',3,1),
(998,288,'Yellowknife','','yellowknife','',3,1),
(999,289,'Whitehorse','','whitehorse','',3,1),
(1000,290,'Nunavut','','nunavut1','',3,1),
(1001,291,'Aberdeen','','aberdeen1','',3,1),
(1002,291,'Bath','','bath','',3,1),
(1003,291,'Belfast','','belfast','',3,1),
(1004,291,'Birmingham','','birmingham1','',3,1),
(1005,291,'Brighton','','brighton','',3,1),
(1006,291,'Bristol','','bristol','',3,1),
(1007,291,'Cambridge','','cambridge','',3,1),
(1008,291,'Devon','','devon','',3,1),
(1009,291,'East Midlands','','east-midlands','',3,1),
(1010,291,'Eastanglia','','eastanglia','',3,1),
(1011,291,'Edinburgh','','edinburgh','',3,1),
(1012,291,'Essex','','essex','',3,1),
(1013,291,'Glasgow','','glasgow','',3,1),
(1014,291,'Hampshire','','hampshire','',3,1),
(1015,291,'Kent','','kent','',3,1),
(1016,291,'Leeds','','leeds','',3,1),
(1017,291,'Liverpool','','liverpool','',3,1),
(1018,291,'London','','london1','',3,1),
(1019,291,'Manchester','','manchester','',3,1),
(1020,291,'Newcastle','','newcastle','',3,1),
(1021,291,'Oxford','','oxford','',3,1),
(1022,291,'Sheffield','','sheffield','',3,1),
(1023,291,'Wales','','wales','',3,1),
(1024,292,'Adelaide','','adelaide','',3,1),
(1025,292,'Brisbane','','brisbane','',3,1),
(1026,292,'Cairns','','cairns','',3,1),
(1027,292,'Canberra','','canberra','',3,1),
(1028,292,'Darwin','','darwin','',3,1),
(1029,292,'Gold Coast','','gold-coast','',3,1),
(1030,292,'Hobart','','hobart','',3,1),
(1031,292,'Melbourne','','melbourne','',3,1),
(1032,292,'Newcastle','','newcastle1','',3,1),
(1033,292,'Perth','','perth','',3,1),
(1034,292,'Sydney','','sydney','',3,1),
(1035,293,'Fukuoka','','fukuoka','',3,1),
(1036,293,'Hiroshima','','hiroshima','',3,1),
(1037,293,'Nagoya','','nagoya','',3,1),
(1038,293,'Okinawa','','okinawa','',3,1),
(1039,293,'Osaka-Kobe-Kyoto','','osaka-kobe-kyoto','',3,1),
(1040,293,'Sapporo','','sapporo','',3,1),
(1041,293,'Sendai','','sendai','',3,1),
(1042,293,'Tokyo','','tokyo','',3,1),
(1043,294,'Bordeaux','','bordeaux','',3,1),
(1044,294,'Bretagne','','bretagne','',3,1),
(1045,294,'Corse','','corse','',3,1),
(1046,294,'Départements D\'outre Mer','','','',3,1),
(1047,294,'Grenoble','','grenoble','',3,1),
(1048,294,'Lille','','lille','',3,1),
(1049,294,'Loire','','loire','',3,1),
(1050,294,'Lyon','','lyon','',3,1),
(1051,294,'Marseille','','marseille','',3,1),
(1052,294,'Montpellier','','montpellier','',3,1),
(1053,294,'Nice','','nice','',3,1),
(1054,294,'Normandie','','normandie','',3,1),
(1055,294,'Paris','','paris','',3,1),
(1056,294,'Strasbourg','','strasbourg','',3,1),
(1057,294,'Toulouse','','toulouse','',3,1),
(1058,295,'Berlin','','berlin','',3,1),
(1059,295,'Bremen','','bremen','',3,1),
(1060,295,'Düsseldorf','','dsseldorf','',3,1),
(1061,295,'Dresden','','dresden','',3,1),
(1062,295,'Essen','','essen','',3,1),
(1063,295,'Frankfurt','','frankfurt','',3,1),
(1064,295,'Hamburg','','hamburg','',3,1),
(1065,295,'Hannover','','hannover','',3,1),
(1066,295,'Heidelberg','','heidelberg','',3,1),
(1067,295,'Kaiserslautern','','kaiserslautern','',3,1),
(1068,295,'Karlsruhe','','karlsruhe','',3,1),
(1069,295,'Köln','','kln','',3,1),
(1070,295,'Kiel','','kiel','',3,1),
(1071,295,'Lübeck','','lbeck','',3,1),
(1072,295,'Leipzig','','leipzig','',3,1),
(1073,295,'Mannheim','','mannheim','',3,1),
(1074,295,'München','','mnchen','',3,1),
(1075,295,'Nürnberg','','nrnberg','',3,1),
(1076,295,'Rostock','','rostock','',3,1),
(1077,295,'Schwerin','','schwerin','',3,1),
(1078,295,'Stuttgart','','stuttgart','',3,1),
(1079,296,'Gothenburg','','gothenburg','',3,1),
(1080,296,'Malmo','','malmo','',3,1),
(1081,296,'Stockholm','','stockholm','',3,1),
(1082,297,'Auckland','','auckland','',3,1),
(1083,297,'Christchurch','','christchurch','',3,1),
(1084,297,'Dunedin','','dunedin','',3,1),
(1085,297,'Wellington','','wellington','',3,1),
(1086,298,'Bologna','','bologna','',3,1),
(1087,298,'Calabria','','calabria','',3,1),
(1088,298,'Firenze','','firenze','',3,1),
(1089,298,'Forli-Cesena','','forli-cesena','',3,1),
(1090,298,'Genova','','genova','',3,1),
(1091,298,'Milano','','milano','',3,1),
(1092,298,'Napoli','','napoli','',3,1),
(1093,298,'Perugia','','perugia','',3,1),
(1094,298,'Roma','','roma','',3,1),
(1095,298,'Sardegna','','sardegna','',3,1),
(1096,298,'Sicilia','','sicilia','',3,1),
(1097,298,'Torino','','torino','',3,1),
(1098,298,'Venezia','','venezia','',3,1),
(1099,299,'Buenos Aires','','buenos-aires','',3,1),
(1100,299,'Cordoba','','cordoba','',3,1),
(1101,299,'Laplata','','laplata','',3,1),
(1102,299,'Mendoza','','mendoza','',3,1),
(1103,299,'Rosario','','rosario','',3,1),
(1104,299,'South Argentina','','south-argentina','',3,1),
(1105,299,'Tucuman','','tucuman','',3,1),
(1106,300,'Wien','','wien','',3,1),
(1107,301,'Antwerp','','antwerp','',3,1),
(1108,301,'Brussel','','brussel','',3,1),
(1109,301,'Charleroi','','charleroi','',3,1),
(1110,301,'Ghent','','ghent','',3,1),
(1111,301,'Liege','','liege','',3,1),
(1112,302,'Bahia','','bahia','',3,1),
(1113,302,'Belem','','belem','',3,1),
(1114,302,'Belo Horizonte','','belo-horizonte','',3,1),
(1115,302,'Brasilia','','brasilia','',3,1),
(1116,302,'Curitiba','','curitiba','',3,1),
(1117,302,'Fortaleza','','fortaleza','',3,1),
(1118,302,'Manaus','','manaus','',3,1),
(1119,302,'Porto Alegre','','porto-alegre','',3,1),
(1120,302,'Recife','','recife','',3,1),
(1121,302,'Rio De Janeiro','','rio-de-janeiro','',3,1),
(1122,302,'Salvador','','salvador','',3,1),
(1123,302,'São Paulo','','so-paulo','',3,1),
(1124,303,'Beijing','','beijing','',3,1),
(1125,303,'Chengdu','','chengdu','',3,1),
(1126,303,'Chongqing','','chongqing','',3,1),
(1127,303,'Dalian','','dalian','',3,1),
(1128,303,'Guangzhou','','guangzhou','',3,1),
(1129,303,'Hangzhou','','hangzhou','',3,1),
(1130,303,'Nanjing','','nanjing','',3,1),
(1131,303,'Shanghai','','shanghai','',3,1),
(1132,303,'Shenyang','','shenyang','',3,1),
(1133,303,'Shenzhen','','shenzhen','',3,1),
(1134,303,'Wuhan','','wuhan','',3,1),
(1135,303,'Xi\'an','','','',3,1),
(1136,304,'Hong Kong','','hong-kong2','',3,1),
(1137,305,'Jakarta','','jakarta','',3,1),
(1138,305,'Ngagel','','ngagel','',3,1),
(1139,305,'Bandung','','bandung','',3,1),
(1140,305,'Bali','','bali','',3,1),
(1141,306,'Ahmedabad','','ahmedabad','',3,1),
(1142,306,'Bangalore','','bangalore','',3,1),
(1143,306,'Bhubaneswar','','bhubaneswar','',3,1),
(1144,306,'Chandigarh','','chandigarh','',3,1),
(1145,306,'Chennai','','chennai','',3,1),
(1146,306,'Delhi','','delhi','',3,1),
(1147,306,'Goa','','goa','',3,1),
(1148,306,'Hyderabad','','hyderabad','',3,1),
(1149,306,'Indore','','indore','',3,1),
(1150,306,'Jaipur','','jaipur','',3,1),
(1151,306,'Kerala','','kerala','',3,1),
(1152,306,'Kolkata','','kolkata','',3,1),
(1153,306,'Lucknow','','lucknow','',3,1),
(1154,306,'Mumbai','','mumbai','',3,1),
(1155,306,'Pune','','pune','',3,1),
(1156,306,'Surat','','surat','',3,1),
(1157,307,'Haifa','','haifa','',3,1),
(1158,307,'Jerusalem','','jerusalem','',3,1),
(1159,307,'Telaviv','','telaviv','',3,1),
(1160,307,'Westbank','','westbank','',3,1),
(1161,308,'Ipoh','','ipoh','',3,1),
(1162,308,'Johor Bahru','','johor-bahru','',3,1),
(1163,308,'Kuala Lumpur','','kuala-lumpur','',3,1),
(1164,308,'Kuching','','kuching','',3,1),
(1165,308,'Malaysia','','malaysia2','',3,1),
(1166,308,'Penang','','penang','',3,1),
(1167,309,'Acapulco','','acapulco','',3,1),
(1168,309,'Baja California','','baja-california','',3,1),
(1169,309,'Chihuahua','','chihuahua','',3,1),
(1170,309,'Ciudad Juárez','','ciudad-jurez','',3,1),
(1171,309,'Df','','df','',3,1),
(1172,309,'Guadalajara','','guadalajara','',3,1),
(1173,309,'Guanajuato','','guanajuato','',3,1),
(1174,309,'Hermosillo','','hermosillo','',3,1),
(1175,309,'Mazatlán','','mazatln','',3,1),
(1176,309,'Monterrey','','monterrey','',3,1),
(1177,309,'Oaxaca','','oaxaca','',3,1),
(1178,309,'Puebla','','puebla','',3,1),
(1179,309,'Puerto Vallarta','','puerto-vallarta','',3,1),
(1180,309,'Tijuana','','tijuana','',3,1),
(1181,309,'Vera Cruz','','vera-cruz','',3,1),
(1182,309,'Yucatán','','yucatn','',3,1),
(1183,310,'Amsterdam','','amsterdam','',3,1),
(1184,310,'Den Haag','','den-haag','',3,1),
(1185,310,'Eindhoven','','eindhoven','',3,1),
(1186,310,'Rotterdam','','rotterdam','',3,1),
(1187,310,'Utrecht','','utrecht','',3,1),
(1188,311,'Oslo','','oslo','',3,1),
(1189,312,'Cebu','','cebu','',3,1),
(1190,312,'Davao','','davao','',3,1),
(1191,312,'Manila','','manila','',3,1),
(1192,312,'Pampanga','','pampanga','',3,1),
(1193,313,'Faro / Algarve','','faro--algarve','',3,1),
(1194,313,'Lisboa','','lisboa','',3,1),
(1195,313,'Porto','','porto','',3,1),
(1196,314,'Basel','','basel','',3,1),
(1197,314,'Bern','','bern','',3,1),
(1198,314,'Genf','','genf','',3,1),
(1199,314,'Lausanne','','lausanne','',3,1),
(1200,314,'Zürich','','zrich','',3,1),
(1201,315,'Bangkok','','bangkok','',3,1),
(1202,315,'Changmai','','changmai','',3,1),
(1203,315,'Changrai','','changrai','',3,1),
(1204,315,'Pattaya','','pattaya','',3,1),
(1205,315,'Other Thailand','','other-thailand','',3,1),
(1206,316,'Istanbul','','istanbul','',3,1),
(1207,317,'Abudhabi','','abudhabi','',3,1),
(1208,317,'Dubai','','dubai','',3,1),
(1209,317,'Sharjah','','sharjah','',3,1),
(1210,318,'Pakistan','','pakistan2','',3,1),
(1211,319,'Luxembourg','','luxembourg2','',3,1),
(1212,320,'Bermuda','','bermuda2','',3,1),
(1213,321,'Cayman Islands','','cayman-islands2','',3,1),
(1214,322,'San Marino','','san-marino2','',3,1),
(1215,323,'Denmark','','denmark2','',3,1),
(1216,324,'Iceland','','iceland2','',3,1),
(1217,325,'Ireland','','ireland2','',3,1),
(1218,326,'Aruba','','aruba2','',3,1),
(1219,327,'Finland','','finland2','',3,1),
(1220,328,'Monaco','','monaco2','',3,1),
(1221,329,'Liechtenstein','','liechtenstein2','',3,1),
(1222,330,'Jersey','','jersey2','',3,1),
(1223,331,'Taiwan','','taiwan2','',3,1),
(1224,332,'Faroe Islands','','faroe-islands2','',3,1),
(1225,333,'Spain','','spain2','',3,1),
(1226,334,'Qatar','','qatar2','',3,1),
(1227,335,'Guam','','guam2','',3,1),
(1228,336,'Isle Of Man','','isle-of-man2','',3,1),
(1229,337,'Greece','','greece2','',3,1),
(1230,338,'Greenland','','greenland2','',3,1),
(1231,339,'Guernsey','','guernsey2','',3,1),
(1232,340,'Macau','','macau2','',3,1),
(1233,341,'Cyprus','','cyprus2','',3,1),
(1234,342,'Andorra','','andorra2','',3,1),
(1235,343,'Kuwait','','kuwait2','',3,1),
(1236,344,'Slovenia','','slovenia2','',3,1),
(1237,345,'Brunei','','brunei2','',3,1),
(1238,346,'Korea, South','','korea-south2','',3,1),
(1239,347,'Malta','','malta2','',3,1),
(1240,348,'French Polynesia','','french-polynesia2','',3,1),
(1241,349,'Gibraltar','','gibraltar2','',3,1),
(1242,350,'Virgin Islands','','virgin-islands2','',3,1),
(1243,351,'Bahrain','','bahrain2','',3,1),
(1244,352,'Puerto Rico','','puerto-rico2','',3,1),
(1245,353,'Bahamas','','bahamas2','',3,1),
(1246,354,'British Virgin Is.','','british-virgin-is2','',3,1),
(1247,355,'Barbados','','barbados2','',3,1),
(1248,356,'Czech Republic','','czech-republic2','',3,1),
(1249,357,'New Caledonia','','new-caledonia2','',3,1),
(1250,358,'Martinique','','martinique2','',3,1),
(1251,359,'Hungary','','hungary2','',3,1),
(1252,360,'Slovakia','','slovakia2','',3,1),
(1253,361,'Oman','','oman2','',3,1),
(1254,362,'Uruguay','','uruguay2','',3,1),
(1255,363,'N. Mariana Islands','','n-mariana-islands2','',3,1),
(1256,364,'Estonia','','estonia2','',3,1),
(1257,365,'Saudi Arabia','','saudi-arabia2','',3,1),
(1258,366,'Lithuania','','lithuania2','',3,1),
(1259,367,'Mauritius','','mauritius2','',3,1),
(1260,368,'Netherlands Antilles','','netherlands-antilles2','',3,1),
(1261,369,'Poland','','poland2','',3,1),
(1262,370,'Antigua & Barbuda','','antigua--barbuda2','',3,1),
(1263,371,'South Africa','','south-africa2','',3,1),
(1264,372,'Croatia','','croatia2','',3,1),
(1265,373,'Latvia','','latvia2','',3,1),
(1266,374,'Chile','','chile2','',3,1),
(1267,375,'Turks & Caicos Is','','turks--caicos-is2','',3,1),
(1268,376,'Trinidad & Tobago','','trinidad--tobago2','',3,1),
(1269,377,'Costa Rica','','costa-rica2','',3,1),
(1270,378,'Botswana','','botswana2','',3,1),
(1271,379,'Palau','','palau2','',3,1),
(1272,380,'Russia','','russia2','',3,1),
(1273,381,'Saint Kitts & Nevis','','saint-kitts--nevis2','',3,1),
(1274,382,'Anguilla','','anguilla2','',3,1),
(1275,383,'French Guiana','','french-guiana2','',3,1),
(1276,384,'American Samoa','','american-samoa2','',3,1),
(1277,385,'Guadeloupe','','guadeloupe2','',3,1),
(1278,386,'Seychelles','','seychelles2','',3,1),
(1279,387,'Bulgaria','','bulgaria2','',3,1),
(1280,388,'Namibia','','namibia2','',3,1),
(1281,389,'Iran','','iran2','',3,1),
(1282,390,'Romania','','romania2','',3,1),
(1283,391,'St Pierre & Miquelon','','st-pierre--miquelon2','',3,1),
(1284,392,'Tunisia','','tunisia2','',3,1),
(1285,393,'Macedonia','','macedonia2','',3,1),
(1286,394,'Libya','','libya2','',3,1),
(1287,395,'Colombia','','colombia2','',3,1),
(1288,396,'Kazakhstan','','kazakhstan2','',3,1),
(1289,397,'Panama','','panama2','',3,1),
(1290,398,'Belarus','','belarus2','',3,1),
(1291,399,'Bosnia & Herzegovina','','bosnia--herzegovina2','',3,1),
(1292,400,'Algeria','','algeria2','',3,1),
(1293,401,'Dominican Republic','','dominican-republic2','',3,1),
(1294,402,'Fiji','','fiji2','',3,1),
(1295,403,'Reunion','','reunion2','',3,1),
(1296,404,'Turkmenistan','','turkmenistan2','',3,1),
(1297,405,'Samoa','','samoa2','',3,1),
(1298,406,'Gabon','','gabon2','',3,1),
(1299,407,'Dominica','','dominica2','',3,1),
(1300,408,'Saint Lucia','','saint-lucia2','',3,1),
(1301,409,'Ukraine','','ukraine2','',3,1),
(1302,410,'Peru','','peru2','',3,1),
(1303,411,'Cook Islands','','cook-islands2','',3,1),
(1304,412,'Grenada','','grenada2','',3,1),
(1305,413,'Nauru','','nauru2','',3,1),
(1306,414,'Belize','','belize2','',3,1),
(1307,415,'Swaziland','','swaziland2','',3,1),
(1308,416,'El Salvador','','el-salvador2','',3,1),
(1309,417,'Lebanon','','lebanon2','',3,1),
(1310,418,'Venezuela','','venezuela2','',3,1),
(1311,419,'Paraguay','','paraguay2','',3,1),
(1312,420,'Albania','','albania2','',3,1),
(1313,421,'Jordan','','jordan2','',3,1),
(1314,422,'Guatemala','','guatemala2','',3,1),
(1315,423,'Egypt','','egypt2','',3,1),
(1316,424,'Guyana','','guyana2','',3,1),
(1317,425,'Morocco','','morocco2','',3,1),
(1318,426,'Suriname','','suriname2','',3,1),
(1319,427,'Jamaica','','jamaica2','',3,1),
(1320,428,'Maldives','','maldives2','',3,1),
(1321,429,'Sri Lanka','','sri-lanka2','',3,1),
(1322,430,'Wallis And Futuna','','wallis-and-futuna2','',3,1),
(1323,431,'Armenia','','armenia2','',3,1),
(1324,432,'Azerbaijan','','azerbaijan2','',3,1),
(1325,433,'Montserrat','','montserrat2','',3,1),
(1326,434,'Ecuador','','ecuador2','',3,1),
(1327,435,'Syria','','syria2','',3,1),
(1328,436,'Lesotho','','lesotho2','',3,1),
(1329,437,'Cuba','','cuba2','',3,1),
(1330,438,'Saint Vincent & The Grenadines','','saint-vincent--the-grenadines2','',3,1),
(1331,439,'Vanuatu','','vanuatu2','',3,1),
(1332,440,'Equatorial Guinea','','equatorial-guinea2','',3,1),
(1333,441,'Honduras','','honduras2','',3,1),
(1334,442,'Mayotte','','mayotte2','',3,1),
(1335,443,'Georgia','','georgia3','',3,1),
(1336,444,'Saint Helena','','saint-helena2','',3,1),
(1337,445,'Vietnam','','vietnam2','',3,1),
(1338,446,'Bolivia','','bolivia2','',3,1),
(1339,447,'Nicaragua','','nicaragua2','',3,1),
(1340,448,'Ghana','','ghana2','',3,1),
(1341,449,'Papua New Guinea','','papua-new-guinea2','',3,1),
(1342,450,'Serbia','','serbia2','',3,1),
(1343,451,'Tonga','','tonga2','',3,1),
(1344,452,'Guinea','','guinea2','',3,1),
(1345,453,'Micronesia, Fed. St.','','micronesia-fed-st2','',3,1),
(1346,454,'Angola','','angola2','',3,1),
(1347,455,'Bangladesh','','bangladesh2','',3,1),
(1348,456,'Cambodia','','cambodia2','',3,1),
(1349,457,'Sudan','','sudan2','',3,1),
(1350,458,'Zimbabwe','','zimbabwe2','',3,1),
(1351,459,'Burma','','burma2','',3,1),
(1352,460,'Cameroon','','cameroon2','',3,1),
(1353,461,'Mauritania','','mauritania2','',3,1),
(1354,462,'Moldova','','moldova2','',3,1),
(1355,463,'Mongolia','','mongolia2','',3,1),
(1356,464,'Gambia','','gambia2','',3,1),
(1357,465,'Laos','','laos2','',3,1),
(1358,466,'Solomon Islands','','solomon-islands2','',3,1),
(1359,467,'Uzbekistan','','uzbekistan2','',3,1),
(1360,468,'Haiti','','haiti2','',3,1),
(1361,469,'Kyrgyzstan','','kyrgyzstan2','',3,1),
(1362,470,'Marshall Islands','','marshall-islands2','',3,1),
(1363,471,'Senegal','','senegal2','',3,1),
(1364,472,'Iraq','','iraq2','',3,1),
(1365,473,'Togo','','togo2','',3,1),
(1366,474,'Cape Verde','','cape-verde2','',3,1),
(1367,475,'Cote D\'ivoire','','','',3,1),
(1368,476,'Nepal','','nepal2','',3,1),
(1369,477,'Uganda','','uganda2','',3,1),
(1370,478,'Bhutan','','bhutan2','',3,1),
(1371,479,'Djibouti','','djibouti2','',3,1),
(1372,480,'Korea, North','','korea-north2','',3,1),
(1373,481,'Rwanda','','rwanda2','',3,1),
(1374,482,'Chad','','chad2','',3,1),
(1375,483,'Mozambique','','mozambique2','',3,1),
(1376,484,'Sao Tome & Principe','','sao-tome--principe2','',3,1),
(1377,485,'Benin','','benin2','',3,1),
(1378,486,'Burkina Faso','','burkina-faso2','',3,1),
(1379,487,'Central African Rep.','','central-african-rep2','',3,1),
(1380,488,'Tuvalu','','tuvalu2','',3,1),
(1381,489,'Kenya','','kenya2','',3,1),
(1382,490,'Liberia','','liberia2','',3,1),
(1383,491,'Tajikistan','','tajikistan2','',3,1),
(1384,492,'Mali','','mali2','',3,1),
(1385,493,'Nigeria','','nigeria2','',3,1),
(1386,494,'Guinea-Bissau','','guinea-bissau2','',3,1),
(1387,495,'Kiribati','','kiribati2','',3,1),
(1388,496,'Madagascar','','madagascar2','',3,1),
(1389,497,'Niger','','niger2','',3,1),
(1390,498,'West Bank','','west-bank2','',3,1),
(1391,499,'Yemen','','yemen2','',3,1),
(1392,500,'Zambia','','zambia2','',3,1),
(1393,501,'Afghanistan','','afghanistan2','',3,1),
(1394,502,'Comoros','','comoros2','',3,1),
(1395,503,'Congo, Dem. Rep.','','congo-dem-rep2','',3,1),
(1396,504,'Congo, Repub. Of The','','congo-repub-of-the2','',3,1),
(1397,505,'Eritrea','','eritrea2','',3,1),
(1398,506,'Ethiopia','','ethiopia2','',3,1),
(1399,507,'Burundi','','burundi2','',3,1),
(1400,508,'Gaza Strip','','gaza-strip2','',3,1),
(1401,509,'Malawi','','malawi2','',3,1),
(1402,510,'Tanzania','','tanzania2','',3,1),
(1403,511,'East Timor','','east-timor2','',3,1),
(1404,512,'Sierra Leone','','sierra-leone2','',3,1),
(1405,513,'Somalia','','somalia2','',3,1),
(1406,514,'Western Sahara','','western-sahara2','',3,1);

/*Table structure for table `decoration` */

DROP TABLE IF EXISTS `decoration`;

CREATE TABLE `decoration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `basename` varchar(20) NOT NULL,
  `extension` varchar(4) NOT NULL,
  `namatampilan` varchar(20) NOT NULL,
  `maxdimension` varchar(20) NOT NULL,
  `maxfilesize` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `caption` text NOT NULL,
  `usecaption` int(11) NOT NULL COMMENT '1: Title saja,2:Title + Ket',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `decoration` */

insert  into `decoration`(`id`,`type`,`basename`,`extension`,`namatampilan`,`maxdimension`,`maxfilesize`,`urutan`,`caption`,`usecaption`) values 
(1,'logo','logo','png','Logo','max;300;300',5000000,1,'',0),
(7,'favicon','favicon','png','Favicon','fixed;20;20',5000000,2,'',0),
(8,'logo_instansi','logo_instansi','png','Logo Footer','max;400;200',5000000,1,'',0);

/*Table structure for table `footer_block_layout` */

DROP TABLE IF EXISTS `footer_block_layout`;

CREATE TABLE `footer_block_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `isfull` int(11) DEFAULT NULL COMMENT 'container-fluid',
  `style` text DEFAULT NULL COMMENT 'css',
  `thumbnail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `footer_block_layout` */

insert  into `footer_block_layout`(`id`,`id_menu`,`parent`,`name_id`,`urutan`,`type`,`isfull`,`style`,`thumbnail`) values 
(2,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL);

/*Table structure for table `footer_layout` */

DROP TABLE IF EXISTS `footer_layout`;

CREATE TABLE `footer_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `id_block` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT 0,
  `name_id` varchar(200) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `isfull` int(11) DEFAULT NULL COMMENT 'container-fluid',
  `style` text DEFAULT NULL COMMENT 'css',
  `thumbnail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `footer_layout` */

insert  into `footer_layout`(`id`,`id_menu`,`id_block`,`parent`,`name_id`,`block`,`urutan`,`value`,`type`,`isfull`,`style`,`thumbnail`) values 
(1,NULL,2,0,'1 Column [100%]','col_12',3,NULL,'col',NULL,NULL,NULL);

/*Table structure for table `footer_layout_item` */

DROP TABLE IF EXISTS `footer_layout_item`;

CREATE TABLE `footer_layout_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_layout` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `footer_layout_item` */

insert  into `footer_layout_item`(`id`,`id_layout`,`parent`,`name_id`,`block`,`urutan`,`value`,`position`) values 
(1,1,NULL,'Sub Judul   Deskripsi','single_page',2,'',1);

/*Table structure for table `formulir` */

DROP TABLE IF EXISTS `formulir`;

CREATE TABLE `formulir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_panggilan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `asal_instansi` varchar(200) NOT NULL,
  `sekolah_asal` varchar(100) NOT NULL,
  `sekolah_jenjang` int(11) NOT NULL,
  `nomor_hp` varchar(30) NOT NULL,
  `nomor_hp_ortu` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `info` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `masa_program` int(11) NOT NULL,
  `pola_hari` text NOT NULL,
  `nominal` int(11) NOT NULL COMMENT 'Biaya Paket',
  `nominal_unik` int(11) NOT NULL,
  `nominal_total` int(11) NOT NULL,
  `nominal_up` int(11) NOT NULL COMMENT 'Nominal Uang Pendaftaran',
  `status_aktif` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `is_paid` int(11) NOT NULL,
  `quiz_class` varchar(100) NOT NULL,
  `quiz_jurusan` varchar(100) NOT NULL,
  `quiz_ruang` varchar(100) NOT NULL,
  `quiz_member_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `formulir` */

/*Table structure for table `formulir_log` */

DROP TABLE IF EXISTS `formulir_log`;

CREATE TABLE `formulir_log` (
  `id` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_panggilan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `sekolah_asal` varchar(100) NOT NULL,
  `sekolah_jenjang` int(11) NOT NULL,
  `nomor_hp` varchar(30) NOT NULL,
  `nomor_hp_ortu` varchar(30) NOT NULL,
  `info` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `masa_program` int(11) NOT NULL,
  `pola_hari` text NOT NULL,
  `nominal` int(11) NOT NULL,
  `status_aktif` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `formulir_log` */

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `summary_id` text NOT NULL,
  `summary_en` text NOT NULL,
  `hot1` int(11) NOT NULL,
  `hot2` int(11) NOT NULL,
  `hot3` int(11) NOT NULL,
  `hot4` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `gallery` */

insert  into `gallery`(`id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`tanggal`,`url_id`,`url_en`,`urutan`,`cat_id`,`summary_id`,`summary_en`,`hot1`,`hot2`,`hot3`,`hot4`) values 
(1,'alumni kelas vip-6086f760f0c97.jpg','Foto Galeri','','','','2020-09-07','foto-galeri','',0,24,'','',0,0,0,0),
(2,'3-6086f7b371f35.jpg','Foto Galeri','','','','2021-04-27','foto-galeri','',0,24,'','',0,0,0,0),
(3,'_MCP2770-6088fdbfab1eb.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(4,'ALUMNI WIFI UKAI 1-6088fdce119bf.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(5,'ALUMNI WIFI UKAI 2-6088fde0f20e2.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(6,'ALUMNI WIFI UKAI 3-6088fdf6082b6.JPG','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(7,'ALUMNI WIFI UKAI 4-6088fe04500de.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(8,'ALUMNI WIFI UKAI 5-6088fe148447e.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(9,'ALUMNI WIFI UKAI ANG SUDAH BEKERJA-6088fe29536d2.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(10,'DSC09350-6088fe3aae206.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(11,'DSC09819-6088fe495dbd5.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(12,'DSC09823-6088fe5b85d96.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(13,'DSC09827-6088fe69e314f.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(14,'IMG_20210319_085105-6088fe73e678a.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(15,'kelas vip 2-608900188ae11.jpg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0),
(16,'WhatsApp Image 2021-03-19 at 175858-6088fe9c45e53.jpeg','Foto Galeri','','','','2021-04-28','foto-galeri','',0,24,'','',0,0,0,0);

/*Table structure for table `gallery_category` */

DROP TABLE IF EXISTS `gallery_category`;

CREATE TABLE `gallery_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `description_id` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `gallery_category` */

insert  into `gallery_category`(`id`,`parent`,`name_id`,`description_id`,`urutan`,`name_en`,`description_en`,`filename`,`url_id`,`url_en`) values 
(24,0,'Foto Galeri',NULL,0,'','','','foto-galeri','');

/*Table structure for table `gallery_header` */

DROP TABLE IF EXISTS `gallery_header`;

CREATE TABLE `gallery_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `desc_atas_id` text NOT NULL,
  `desc_atas_en` text NOT NULL,
  `desc_samping_id` text NOT NULL,
  `desc_samping_en` text NOT NULL,
  `address_id` text NOT NULL,
  `address_en` text NOT NULL,
  `telp` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tag` varchar(500) NOT NULL,
  `urutan` int(11) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `gallery_header` */

insert  into `gallery_header`(`id`,`tanggal`,`title_id`,`title_en`,`desc_atas_id`,`desc_atas_en`,`desc_samping_id`,`desc_samping_en`,`address_id`,`address_en`,`telp`,`fax`,`email`,`tag`,`urutan`,`url_id`,`url_en`) values 
(1,'2014-07-05 07:47:52','Documentation  gallery','Documentation  gallery','a creative media agency that believes in the power of creative ideas and great design','Documentation amp; gallery</p><p>a creative media agency that believes in the power of creative ideas and great design','<h1>Address</h1>\r\n<p>Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>','<h1>Address</h1>\r\n<p>En En Maecenas vehicula condimentum consequat. Ut suscipit ipsum eget leotero convallis feugiat upsoyut fermentum leo auctor consequat turpis aturo nisipe</p>','','','','','','',11,'documentation--gallery','documentation--gallery');

/*Table structure for table `header_block_layout` */

DROP TABLE IF EXISTS `header_block_layout`;

CREATE TABLE `header_block_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `isfull` int(11) NOT NULL COMMENT 'container-fluid',
  `style` text NOT NULL COMMENT 'css',
  `thumbnail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `header_block_layout` */

/*Table structure for table `header_layout` */

DROP TABLE IF EXISTS `header_layout`;

CREATE TABLE `header_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_block` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `block` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(30) NOT NULL,
  `isfull` int(11) NOT NULL COMMENT 'container-fluid',
  `style` text NOT NULL COMMENT 'css',
  `thumbnail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `header_layout` */

/*Table structure for table `header_layout_item` */

DROP TABLE IF EXISTS `header_layout_item`;

CREATE TABLE `header_layout_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_layout` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `block` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `value` text NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `header_layout_item` */

/*Table structure for table `inbox` */

DROP TABLE IF EXISTS `inbox`;

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `inbox` */

insert  into `inbox`(`id`,`email`,`name`,`company`,`message`,`tanggal`,`address`,`phone`) values 
(2,'rohmanartim@yahoo.co.id','rohman','','tes','2014-11-07 07:08:04','','03178643203'),
(3,'rohmanartim@yahoo.co.id','rohman','','tes','2014-11-07 07:21:42','','03178643203'),
(4,'rohmanartim@yahoo.co.id','rohman','','tes','2014-11-07 07:26:46','','03178643203'),
(5,'rohmanartim@yahoo.co.id','rohman','','tes','2014-11-07 07:30:41','','03178643203'),
(6,'ssssssssssssssssssssss@ddd.vom','aadc','','sssssssss','2014-11-07 18:00:25','','ssssssssss'),
(7,'roemly@gmail.com','roemly','','testing','2014-11-07 18:22:35','','0811'),
(8,'roemly@gmail.com','roemly','','okeh','2014-11-07 18:24:51','','081793882330'),
(9,'tester@gmail.com','testing','','testing','2014-11-09 10:52:18','','08179388230'),
(10,'tester@gmail.com','testing','','testing','2014-11-09 11:05:27','','08179388230'),
(11,'roemly.dolar@gmail.com','romli','','keren','2014-11-09 11:08:06','','081793882330'),
(12,'roemly.dolar@gmail.com','romli','','keren','2014-11-09 11:09:56','','081793882330'),
(13,'roemly.dolar@gmail.com','romli','','keren','2014-11-09 11:18:57','','081793882330'),
(14,'andreasguritno@yahoo.com','Andreas','','test again','2014-11-09 23:09:36','','test'),
(15,'emailku@yahoo.com','Namaku','','pesanku','2014-11-09 23:11:10','','010101010'),
(16,'emailku@yahoo.com','Namaku','','pesanku','2014-11-09 23:19:30','','010101010'),
(17,'mydalbo@gmail.com','jmi','','test','2014-11-16 22:31:32','','087842250722'),
(18,'info@premierudyog.org','param vir singh','','Dear sir,We wish to introduce ourselves as manufacturers of complete range of Conveyor Belt Fasteners Plate Type,Oval Belt Fasteners  Elevator Buckets Bolt,Steel Belt Lacings  Conveyor Components for domestic and International markets as per IS 10288:1982 for Joining rubber conveyor belts used in Minings,Coal,Ores,Cement,Steel,Thermal,Fertilizer,Paper,Chemical,Sugar plants,Quarrying,Road constructions,Stone Crusshing,Ports,Sand,Salt, Rice Mill Machinery, Food,Paint ,Wood Laminations,Pigment,Foundry,Glass,Refactory,Recycling and Waste management sectors etc as follows:1.CONVEYOR BELT FASTENERS . No.12.CONVEYOR BELT FASTENERS . No.1 1/2.3.CONVEYOR BELT FASTENERS . No. 2.4.CONVEYOR BELT FASTENERS . No 2 1/2.5. CONVEYOR BELT FASTENERS . No. 3 .6.OVAL BELT FASTENERS : 3/8X1 1/2 , 3/8X2, 5/16X11/4, 1/4X17.ELEVATOR BUCKET BOLTS : 5/16X1-11/4-11/2, 3/8 X11/2,1/4X1.M12 ,M108.EURO BOLTS as per DIN 15237 :M12 ,M10 ,M 8.8.GRIP WELL FASTENERS9.BOLT TIGTENING KEY10.BOLT BREAKERS11.BELT LEATHER PUNCHES13.CARDED HOOK CLIPPER TYPE BELT FASTENERS14.ELEVATOR BUCKETSWe are already supplying our CONVEYOR BELT FASTENERS to National Fertilizer Ltd.,DCM Engg,KSB Foundry Divn,Arvind Casting,Una,Ultra Tech Cements,Orissa,J K Cement Group,Malabar Cements Ltd,Wonder Cements,Keshav Cements, Murli Cement Group,Dalmia Cement Group,Mysore Paper Mills,SUMAN GROUP Phosphate  Fertilizers.. HNG Float Glass Ltd,Glass Manufacturer in Kenya and various steel plants in India and abroad i .e Lloyad Steels,Wardha,Essar Steels,Jindal Stainless steels ,Surya Roshni Steels,Orissa.Udupi Power Corporation Limited(LANCO GROUP)  T-REX INTERNATIONAL RUBBER in Netherland,Ocean Conveyor Co in UAE,Salt Co. in Dammam, Metal Recycling Co.in Kuwait , Screening  Agreggate Co. in Ierland,Conveyor Manitainace group in Beharin,Indonasia, UAE,Quarry  Crusshers, Robbins Tunnelling and Trenchless Technology etc and various other InternationalProjects. We are registered Vendor of MORMUGAO PORT TRUST-GOA  GUJRAT NARMADA FERTILIZER CORPN.We are ISO : 9001:2008 certified company.Further we wish to inform you that we can manufacture and supply anysheet metal press component as per drawing and specifications as wehave our in house well equipped Tool Room along with Production Press Shop.Please visit our website : http://www.premierudyog.org  for details of our product range.With regards.Param vir singh.M/s.Premier udyog,11069/1,Street No.- 8,Partap Nagar,Industrial Area-B,Ludhiana-141003.India.Phones:91-161-2537541,3021941.Fax: 91-161-2545377.Cell:098140 26062.E.Mail:pmv598@gmail.com,info@premierudyog.org','2014-11-26 05:07:29','','+919814026062'),
(19,'emxtgosn@gmail.com','Donna','','Hi, my name is Donna and I am the marketing manager at StarSEO Marketing. I was just looking at your website and see that your website has the potential to become very popular. I just want to tell you, In case you didnt already know... There is a website network which already has more than 16 million users, and most of the users are interested in niches like yours. By getting your website on this network you have a chance to get your site more popular than you can imagine. It is free to sign up and you can find out more about it here: http://cmyad.co/i/5i1w - Now, let me ask you... Do you need your site to be successful to maintain your way of life? Do you need targeted traffic who are interested in the services and products you offer? Are looking for exposure, to increase sales, and to quickly develop awareness for your website? If your answer is YES, you can achieve these things only if you get your site on the network I am talking about. This traffic service advertises you to thousands, while also giving you a chance to test the service before paying anything at all. All the popular blogs are using this service to boost their traffic and ad revenue Why arent you? And what is better than traffic? Its recurring traffic Thats how running a successful site works... Heres to your success Read more here: http://qa.juststicky.com/yourls/275g','2014-12-27 17:24:33','','Donna'),
(20,'roemly@gmail.com','asdf','','sdf','2015-04-23 21:46:51','','asdfasdfd'),
(21,'roemly@yahoo.com','romli','','testing','2015-05-22 06:40:39','','08179388230'),
(22,'roemly@gmail.com','romli','','testing','2015-05-22 06:41:02','','08179388230'),
(23,'roemly@gmail.com','romli','','testing','2015-05-22 06:59:05','','08179388230'),
(24,'roemly@gmail.com','romli','','testing','2015-05-22 07:00:31','','08179388230'),
(25,'unevendownlink2a@rediffmail.com','Kent','','Media buying is the 1 most effective way to generate meaningful traffic - but unfortunately the large media companies that serve these ads - the same ads you see on the sites you browse all day, charge you 100s or even 1000s per day to buy their traffic since they only sell in large volumes  Fox Media Solutions is an adexchange partner with these many major networks and we split up the costs between the many other customers we have in your niche - all seeing a TON more visitors to their many music, real estate, sports, web hosting, travel/tourism, gambling, and other niches.  We think websuka.com can get a lot more exposure from buying and driving traffic using http://foxmediasolutions.com/traffic-plans.html the same way all of these other successful websites have been doing for so long  If youre looking to boost your traffic to websuka.com, you have t check out http://foxmediasolutions.com/traffic-plans.html  Heres to your success and quick website growth Kent Fox Media Solutions','2015-05-25 00:16:28','','123456'),
(26,'','xswqiabchz','','ETkYxC  <a href=http://hlkpasirrmmp.com/>hlkpasirrmmp</a>, [url=http://ehlmwtwsniuv.com/]ehlmwtwsniuv[/url], [link=http://xedmbstfqctx.com/]xedmbstfqctx[/link], http://hdcurrjpzntr.com/','2015-05-25 17:46:16','','APjhsEOPhbbpjN');

/*Table structure for table `laboratorium` */

DROP TABLE IF EXISTS `laboratorium`;

CREATE TABLE `laboratorium` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `tanggal_expired` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `laboratorium` */

insert  into `laboratorium`(`id`,`tanggal`,`tanggal_expired`,`title`,`content`,`created_date`,`created_by`,`modified_date`,`modified_by`) values 
(6,'0000-00-00','0000-00-00','Nilai Darah','<h3>HEMATOLOGI</h3>\r\n<table cellspacing=\"0\" cellpadding=\"7\">\r\n<tbody>\r\n<tr valign=\"top\">\r\n<td>\r\n<p><strong>NO</strong></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><strong>PENGUJIAN</strong></p>\r\n</td>\r\n<td>\r\n<p><strong>NILAI RUJUKAN</strong></p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>1</p>\r\n</td>\r\n<td>\r\n<p>Erythrocyte count</p>\r\n</td>\r\n<td>\r\n<p>4.2-5.9 xl06 pL (4.2-5.9 x 1012 cells/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"12\">\r\n<p>2</p>\r\n</td>\r\n<td>\r\n<p>Erythrocyte sedimentation rate</p>\r\n</td>\r\n<td>\r\n<p>Male: 0-15 mm/h</p>\r\n<p>Female: 0-20 mm/h</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>3</p>\r\n</td>\r\n<td>\r\n<p>Erythropoietin</p>\r\n</td>\r\n<td>\r\n<p>less than 30 mU/mL (30 U/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>4</p>\r\n</td>\r\n<td>\r\n<p>Haptoglobin serum</p>\r\n</td>\r\n<td>\r\n<p>50-150 mg/dL (500-1500 mg/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"12\">\r\n<p>5</p>\r\n</td>\r\n<td>\r\n<p>Hematocrit</p>\r\n</td>\r\n<td>\r\n<p>Male: 41%-51%</p>\r\n<p>Female: 36%-47%</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"11\">\r\n<p>6</p>\r\n</td>\r\n<td>\r\n<p>Hemoglobin,</p>\r\n</td>\r\n<td>\r\n<p>Male: 14-17 g/d L (140-170 g/L)</p>\r\n<p>Female: 12-16 g/dL (120-160 g/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>7</p>\r\n</td>\r\n<td>\r\n<p>Mean corpuscular hemoglobin (MCH)</p>\r\n</td>\r\n<td>\r\n<p>28-32 pg</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"11\">\r\n<p>8</p>\r\n</td>\r\n<td>\r\n<p>Mean corpuscular hemoglobin concentration (MCHc)</p>\r\n</td>\r\n<td>\r\n<p>32-36 g/dL (320-360 g/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>9</p>\r\n</td>\r\n<td>\r\n<p>Mean corpuscular volume (MCV)</p>\r\n</td>\r\n<td>\r\n<p>80-100 f L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"11\">\r\n<p>10</p>\r\n</td>\r\n<td>\r\n<p>Reticulocyte count</p>\r\n</td>\r\n<td>\r\n<p>0.5%-1.5% of erythrocytes; absolute: 23,000- 90,000 cells/pL (23-90 xl09/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>11</p>\r\n</td>\r\n<td>\r\n<p>Leukocyte count</p>\r\n</td>\r\n<td>\r\n<p>4000-10,000/pL (4.0-10 xl09/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>12</p>\r\n</td>\r\n<td>\r\n<p>Platelet count</p>\r\n</td>\r\n<td>\r\n<p>150,000-350,OOO/pL (150-350 xl09/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>13</p>\r\n</td>\r\n<td>\r\n<p>Bleeding time</p>\r\n</td>\r\n<td>\r\n<p>Less than 10 min</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>14</p>\r\n</td>\r\n<td>\r\n<p>Activated partial thromboplastin time</p>\r\n</td>\r\n<td>\r\n<p>25-35 s</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>15</p>\r\n</td>\r\n<td>\r\n<p>Prothrombin time</p>\r\n</td>\r\n<td>\r\n<p>11-13 s</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>16</p>\r\n</td>\r\n<td>\r\n<p>D-Dimer</p>\r\n</td>\r\n<td>\r\n<p>less than 0.5 pg/mL (500 mg/L)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"3\" valign=\"top\">\r\n<p>Iron studies</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>17</p>\r\n</td>\r\n<td>\r\n<p>Ferritin</p>\r\n</td>\r\n<td>\r\n<p>15-200 ng/m L (15-200 mg/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>18</p>\r\n</td>\r\n<td>\r\n<p>Iron serum</p>\r\n</td>\r\n<td>\r\n<p>60-160 pg/dL (11-29 pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>19</p>\r\n</td>\r\n<td>\r\n<p>T\'BC</p>\r\n</td>\r\n<td>\r\n<p>250-460 pg/dL (45-82 pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>20</p>\r\n</td>\r\n<td>\r\n<p>Transferrin saturation</p>\r\n</td>\r\n<td>\r\n<p>20%-50%</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h2>&nbsp;</h2>\r\n<h3>BLOOD CHEMISTRY ANALISYS</h3>\r\n<table cellspacing=\"0\" cellpadding=\"7\">\r\n<tbody>\r\n<tr valign=\"top\">\r\n<td>\r\n<p><strong>NO</strong></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><strong>PENGUJIAN</strong></p>\r\n</td>\r\n<td>\r\n<p><strong>NILAI RUJUKAN</strong></p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>1</p>\r\n</td>\r\n<td>\r\n<p>Albumin serum</p>\r\n</td>\r\n<td>\r\n<p>3.5-5.5 g/dL (35-55 g/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>2</p>\r\n</td>\r\n<td>\r\n<p>a-Fetoprotein</p>\r\n</td>\r\n<td>\r\n<p>0-20 ng/mL (0-20 pg/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>3</p>\r\n</td>\r\n<td>\r\n<p>Aminotransferase, alanine (ALT) / SG PT</p>\r\n</td>\r\n<td>\r\n<p>0-35 U/L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>4</p>\r\n</td>\r\n<td>\r\n<p>Aminotransferase, aspartate (AST) / SGOT</p>\r\n</td>\r\n<td>\r\n<p>0-35 U/L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>5</p>\r\n</td>\r\n<td>\r\n<p>Ammonia plasma</p>\r\n</td>\r\n<td>\r\n<p>40-80 pg/dL (23-47 pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>6</p>\r\n</td>\r\n<td>\r\n<p>Amylase, serum</p>\r\n</td>\r\n<td>\r\n<p>0-130 U/L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>7</p>\r\n</td>\r\n<td>\r\n<p>Antinudear antibody (ANA)</p>\r\n</td>\r\n<td>\r\n<p>positive: titer &gt; 1:160</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>8</p>\r\n</td>\r\n<td>\r\n<p>Bicarbonate serum</p>\r\n</td>\r\n<td>\r\n<p>23-28 meq/L (23-28 mmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"22\">\r\n<p>9</p>\r\n</td>\r\n<td>\r\n<p>Bilirubin serum</p>\r\n</td>\r\n<td>\r\n<p>Total: 0.3-1.2 mg/dL (5.1-20.5 pmol/L)</p>\r\n<p>Direct: 0-0.3 mg/dL (0-5.1 pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>10</p>\r\n</td>\r\n<td>\r\n<p>Blood urea nitrogen (BUN)</p>\r\n</td>\r\n<td>\r\n<p>8-20 mg/dL (2.9-7.1 mmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>11</p>\r\n</td>\r\n<td>\r\n<p>Cholesterol, plasma Total</p>\r\n</td>\r\n<td>\r\n<p>150-199 mg/dL (3.88-5.15 mmol/L), desirable</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"5\">\r\n<p>12</p>\r\n</td>\r\n<td>\r\n<p>Low-density lipoprotein (LDL)</p>\r\n</td>\r\n<td>\r\n<p>Less than orequal to 130mg/dL(3.36 mmol/L), desirable</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>13</p>\r\n</td>\r\n<td>\r\n<p>High-density lipoprotein (HDL)</p>\r\n</td>\r\n<td>\r\n<p>Greater than or equal to40 mg/dL (1.04 mmol/L), desirable</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>14</p>\r\n</td>\r\n<td>\r\n<p>Complement serum C3</p>\r\n</td>\r\n<td>\r\n<p>55-120 mg/dL (550-1200 mg/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>15</p>\r\n</td>\r\n<td>\r\n<p>Total (CH50)</p>\r\n</td>\r\n<td>\r\n<p>37-55 U/mL (37-55 kU/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>16</p>\r\n</td>\r\n<td>\r\n<p>Creatine kinase, serum</p>\r\n</td>\r\n<td>\r\n<p>30-170 U/L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>17</p>\r\n</td>\r\n<td>\r\n<p>Creatinine serum</p>\r\n</td>\r\n<td>\r\n<p>0.7-1.3 mg/dL (61.9-115 pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"49\">\r\n<p>18</p>\r\n</td>\r\n<td>\r\n<p>Electrolytes, serum</p>\r\n</td>\r\n<td>\r\n<ul>\r\n<li>\r\n<p>Sodium 136-145 meq/L (136-145 mmol/L)</p>\r\n</li>\r\n<li>\r\n<p>Potassium 3.5-5.0 meq/L (3.5-5.0 mmol/L)</p>\r\n</li>\r\n<li>\r\n<p>Chloride 98-106 meq/L (98-106 mmol/L)</p>\r\n</li>\r\n<li>\r\n<p>Magnesium 1.5-2.4 mg/dL (0.62-0.99 mmol/L)</p>\r\n</li>\r\n<li>\r\n<p>Phosphorus 3-4.5 mg/dL (0.97-1.45 mmol/L)</p>\r\n</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>19</p>\r\n</td>\r\n<td>\r\n<p>Fibrinogen, plasma</p>\r\n</td>\r\n<td>\r\n<p>150-350 mg/dL (1.5-3.5 g/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>20</p>\r\n</td>\r\n<td>\r\n<p>Glucose, plasma</p>\r\n</td>\r\n<td>\r\n<p>Fasting, 70-100 mg/dL (3.9-5.6 mmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>21</p>\r\n</td>\r\n<td>\r\n<p>y-Glutamyltransferase, serum</p>\r\n</td>\r\n<td>\r\n<p>0-30 U/L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"2\">\r\n<p>22</p>\r\n</td>\r\n<td>\r\n<p>Homocysteine</p>\r\n</td>\r\n<td>\r\n<p>Male: 4-16 pmol/L female: 3-14 pmol/L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"55\">\r\n<p>23</p>\r\n</td>\r\n<td>\r\n<p>Immunoglobulins</p>\r\n</td>\r\n<td>\r\n<ul>\r\n<li>\r\n<p>IgG: 640-1430 mg/dL (6.4-14.3 g/L)</p>\r\n</li>\r\n<li>\r\n<p>IgA: 70-300 mg/dL (0.7-3.0 g/L)</p>\r\n</li>\r\n<li>\r\n<p>IgM: 20-140 mg/dL (0.2-1.4 g/L)</p>\r\n</li>\r\n<li>\r\n<p>IgD: Less than 8 mg/dL (80 mg/L)</p>\r\n</li>\r\n<li>\r\n<p>IgE: 0.01-0.04 mg/dL (0.1-0.4 mg/L)</p>\r\n</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>24</p>\r\n</td>\r\n<td>\r\n<p>Lactate dehydrogenase</p>\r\n</td>\r\n<td>\r\n<p>60-100 U/L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>25</p>\r\n</td>\r\n<td>\r\n<p>Lactic acid, venous blood</p>\r\n</td>\r\n<td>\r\n<p>6-16 mg/dL (0.67-1.8 mmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>26</p>\r\n</td>\r\n<td>\r\n<p>Lipase, serum</p>\r\n</td>\r\n<td>\r\n<p>Less than 95 U/L</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"33\">\r\n<p>27</p>\r\n</td>\r\n<td>\r\n<p>Protein, serum</p>\r\n</td>\r\n<td>\r\n<ul>\r\n<li>\r\n<p>Total: 6.0-7.8 g/dL (60-78 g/L)</p>\r\n</li>\r\n<li>\r\n<p>Albumin: 3.5-5.5 g/dL (35-55 g/L)</p>\r\n</li>\r\n<li>\r\n<p>Globulins: 2.5-S.5 g/dL (25-35 g/L)</p>\r\n</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>28</p>\r\n</td>\r\n<td>\r\n<p>Prostate-specific antigen, serum</p>\r\n</td>\r\n<td>\r\n<p>optimal less than 4 ng/mL</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>29</p>\r\n</td>\r\n<td>\r\n<p>Rheumatoid factor</p>\r\n</td>\r\n<td>\r\n<p>less than 40 U/mL (less than 40 kU/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>30</p>\r\n</td>\r\n<td>\r\n<p>Transferrin saturation</p>\r\n</td>\r\n<td>\r\n<p>20%-50%</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>31</p>\r\n</td>\r\n<td>\r\n<p>Triglycerides</p>\r\n</td>\r\n<td>\r\n<p>Less than 250 mg/dL (2.82 mmol/L), desirable</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"16\">\r\n<p>32</p>\r\n</td>\r\n<td>\r\n<p>Troponins, serum</p>\r\n</td>\r\n<td>\r\n<p>Troponin 1: 0-0.5 ng/mL (0-0.5 pg/L)</p>\r\n<p>Troponin T:0-0.10 ng/mL (0-0.10 pg/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>33</p>\r\n</td>\r\n<td>\r\n<p>Uric acid</p>\r\n</td>\r\n<td>\r\n<p>2.5-8 mg/dL (0.15-0.47 mmol/L)</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>','2020-10-30 22:03:35',6,'2021-09-19 20:14:26',1),
(7,'0000-00-00','0000-00-00','Nilai Urine Paru Jantung','<h3>ARTERIAL BLOOD GAS ANALYSIS</h3>\r\n<table cellspacing=\"0\" cellpadding=\"7\"><colgroup><col /><col /><col /></colgroup>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>NO</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>PENGUJIAN</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>NILAI RUJUKAN</strong></span></p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>1</p>\r\n</td>\r\n<td>\r\n<p>pH</p>\r\n</td>\r\n<td>\r\n<p>7.38-7.44</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>2</p>\r\n</td>\r\n<td>\r\n<p>PCO2</p>\r\n</td>\r\n<td>\r\n<p>35-45 mm Hg</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>3</p>\r\n</td>\r\n<td>\r\n<p>PO2</p>\r\n</td>\r\n<td>\r\n<p>80-100 mm Hg</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>4</p>\r\n</td>\r\n<td>\r\n<p>Oxygen saturation</p>\r\n</td>\r\n<td>\r\n<p>95% or greater</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>5</p>\r\n</td>\r\n<td>\r\n<p>Bicarbonate</p>\r\n</td>\r\n<td>\r\n<p>23-28 meq/L (23-28 mmol/L)</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3><br />URINE</h3>\r\n<table cellspacing=\"0\" cellpadding=\"7\"><colgroup><col /><col /><col /></colgroup>\r\n<tbody>\r\n<tr valign=\"top\">\r\n<td>\r\n<p><span style=\"color: #000000;\"><strong>NO</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>PENGUJIAN</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>NILAI RUJUKAN</strong></span></p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>1</p>\r\n</td>\r\n<td>\r\n<p>Albumin-creatinine ratio</p>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"12\">\r\n<p>2</p>\r\n</td>\r\n<td>\r\n<p>Creatinine</p>\r\n</td>\r\n<td>\r\n<p>15-25 mg/kg per 24 h (133-221 mmol/kg per</p>\r\n<p>24 h)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"24\">\r\n<p>3</p>\r\n</td>\r\n<td>\r\n<p>Calcium</p>\r\n</td>\r\n<td>\r\n<p>100-300 mg/24 h (2.5-7.5 mmol/24h) on unrestricted diet</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"5\">\r\n<p>4</p>\r\n</td>\r\n<td>\r\n<p>Creatinine dearance</p>\r\n</td>\r\n<td>\r\n<p>90-140 m L/min (0.09-0.14 L/min)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"11\">\r\n<p>5</p>\r\n</td>\r\n<td>\r\n<p>5-Hydroxyindoleacetic acid (5-</p>\r\n<p>HIAA)</p>\r\n</td>\r\n<td>\r\n<p>2-9 mg/24 h (10.4-46.8 pmol/24 h)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"8\">\r\n<p>6</p>\r\n</td>\r\n<td>\r\n<p>Protein-creatinine ratio</p>\r\n</td>\r\n<td>\r\n<p>&lt; 0.2 mg/mg</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"28\">\r\n<p>7</p>\r\n</td>\r\n<td>\r\n<p>Sodium</p>\r\n</td>\r\n<td>\r\n<p>100-260 meq/24 h (100-260 mmol/24 h) (varies with intake)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"23\">\r\n<p>8</p>\r\n</td>\r\n<td>\r\n<p>Uric acid</p>\r\n</td>\r\n<td>\r\n<p>250-750 mg/24 h (1.48-4.43 mmol/24 h) (varies with diet)</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p class=\"western\"><br /><br /></p>\r\n<p>&nbsp;</p>\r\n<h3>PULMONARY</h3>\r\n<table cellspacing=\"0\" cellpadding=\"7\"><colgroup><col /><col /><col /></colgroup>\r\n<tbody>\r\n<tr valign=\"top\">\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>NO</strong></span></p>\r\n<p align=\"center\">&nbsp;</p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>PENGUJIAN</strong></span></p>\r\n<p align=\"center\">&nbsp;</p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>NILAI RUJUKAN</strong></span></p>\r\n<p align=\"center\">&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"12\">\r\n<p>1</p>\r\n</td>\r\n<td>\r\n<p>Forced expiratory volume in 1 second (FEV1)</p>\r\n</td>\r\n<td>\r\n<p>&gt; 80% predicted</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>2</p>\r\n</td>\r\n<td>\r\n<p>Forced vital capacity (FVC)</p>\r\n</td>\r\n<td>\r\n<p>&gt; 80% predicted</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>3</p>\r\n</td>\r\n<td>\r\n<p>FEV1/FVC</p>\r\n</td>\r\n<td>\r\n<p>Greater than 75% (0.75)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>4</p>\r\n</td>\r\n<td>\r\n<p>Cell count</p>\r\n</td>\r\n<td>\r\n<p>0-5 cells/pL (0-5 xl06cells/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"36\">\r\n<p>5</p>\r\n</td>\r\n<td>\r\n<p>Glucose</p>\r\n</td>\r\n<td>\r\n<p align=\"justify\">40-80 mg/dL (2.5-4.4 mmol/L); less than 40% of Ssimultaneous plasma concentration is abnormal</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>6</p>\r\n</td>\r\n<td>\r\n<p>Pressure (opening)</p>\r\n</td>\r\n<td>\r\n<p>70-200 cm H2O</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>7</p>\r\n</td>\r\n<td>\r\n<p>Protein</p>\r\n</td>\r\n<td>\r\n<p>15-60 mg/dL(150-600 mg/L)</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<h3>HEMODYNAMIC</h3>\r\n<table cellspacing=\"0\" cellpadding=\"7\"><colgroup><col /><col /><col /></colgroup>\r\n<tbody>\r\n<tr valign=\"top\">\r\n<td>\r\n<p><span style=\"color: #000000;\"><strong>NO</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>PENGUJIAN</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>NILAI RUJUKAN</strong></span></p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>1</p>\r\n</td>\r\n<td>\r\n<p>Cardiac index</p>\r\n</td>\r\n<td>\r\n<p>2.5-4.2 L/min/m2</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p><sup>2</sup></p>\r\n</td>\r\n<td>\r\n<p>Left ventricular ejection fraction</p>\r\n</td>\r\n<td>\r\n<p>45%-70%</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"30\">\r\n<p>3</p>\r\n</td>\r\n<td>\r\n<p>Pulmonary artery pressure</p>\r\n</td>\r\n<td>\r\n<p>Systolic: 20-25 mm Hg</p>\r\n<p>Diastolic: 5-10 mm Hg</p>\r\n<p>Mean: 9-16 mm Hg</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>4</p>\r\n</td>\r\n<td>\r\n<p>Pulmonary capillary wedge</p>\r\n</td>\r\n<td>\r\n<p>6-12 mm Hg</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"1\">\r\n<p>5</p>\r\n</td>\r\n<td>\r\n<p>Right atrium</p>\r\n</td>\r\n<td>\r\n<p>mean 0-5 mm Hg</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"11\">\r\n<p>6</p>\r\n</td>\r\n<td>\r\n<p>Right ventricle</p>\r\n</td>\r\n<td>\r\n<p>Systolic: 20-25 mm Hg</p>\r\n<p>Diastolic: 0-5 mm Hg</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3>&nbsp;</h3>\r\n<h3>VITAL SIGN</h3>\r\n<table cellspacing=\"0\" cellpadding=\"7\">\r\n<tbody>\r\n<tr valign=\"top\">\r\n<td>\r\n<p><span style=\"color: #000000;\"><strong>NO</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>PENGUJIAN</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>NILAI RUJUKAN</strong></span></p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>1</p>\r\n</td>\r\n<td>\r\n<p>Blood Pressure</p>\r\n</td>\r\n<td>\r\n<p>120/80 mmHg</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p><sup>2</sup></p>\r\n</td>\r\n<td>\r\n<p>RR</p>\r\n</td>\r\n<td>\r\n<p>18-20x/minute</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p>3</p>\r\n</td>\r\n<td>\r\n<p>HR</p>\r\n</td>\r\n<td>\r\n<p>80-100x/minute</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td>\r\n<p><sup>4</sup></p>\r\n</td>\r\n<td>\r\n<p>Body Temperature</p>\r\n</td>\r\n<td>\r\n<p>36,5&deg;C-37,5&deg;C</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p class=\"western\"><a name=\"_GoBack\"></a><br /><br /></p>\r\n<h3>&nbsp;</h3>','2021-09-19 16:02:00',1,'2021-09-19 20:21:09',1),
(8,'0000-00-00','0000-00-00','Nilai Endoktrin','<h3>ENDOCRINE</h3>\r\n<table cellspacing=\"0\" cellpadding=\"7\">\r\n<tbody>\r\n<tr valign=\"top\">\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>NO</strong></span></p>\r\n</td>\r\n<td>\r\n<p align=\"center\"><span style=\"color: #000000;\"><strong>PENGUJIAN</strong></span></p>\r\n</td>\r\n<td>\r\n<p><span style=\"color: #000000;\"><strong>NILAI RUJUKAN</strong></span></p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"3\">\r\n<p>1</p>\r\n</td>\r\n<td>\r\n<p>Adrenocorticotropin (ACTH)</p>\r\n</td>\r\n<td>\r\n<p>9-52 pg/mL(2-ll pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"25\">\r\n<p>2</p>\r\n</td>\r\n<td>\r\n<p>Aldosterone, serum</p>\r\n</td>\r\n<td>\r\n<p>Supine - 2-5 ng/dL (55-138 pmol/L)</p>\r\n<p>Standing - 7-20 ng/dL (194-554 pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"5\">\r\n<p>3</p>\r\n</td>\r\n<td>\r\n<p>Aldosterone, urine</p>\r\n</td>\r\n<td>\r\n<p>5-19 pg/24 h (13.9-52.6 nmol/24 h)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"61\">\r\n<p>4</p>\r\n</td>\r\n<td>\r\n<p>Catecholamines</p>\r\n</td>\r\n<td>\r\n<p>Epinephrine plasma (supine): less than 75 ng/L (410 pmol/L)</p>\r\n<p>Norepinephrine, plasma (supine): 50-440 ng/L (296-2600</p>\r\n<p>pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"24\">\r\n<p>5</p>\r\n</td>\r\n<td>\r\n<p>Catecholamines, 24-hour, urine</p>\r\n</td>\r\n<td>\r\n<p>Less than 100 pg/m2per 24 h (591 nmol/m2 per 24 h)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"4\">\r\n<p>6</p>\r\n</td>\r\n<td>\r\n<p>Cortisol free, urine</p>\r\n</td>\r\n<td>\r\n<p>Less than 90 pg/24 h (248 nmol/24 h)</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div id=\"TextSection\" dir=\"ltr\">\r\n<table cellspacing=\"0\" cellpadding=\"7\"><colgroup><col /><col /><col /></colgroup>\r\n<tbody>\r\n<tr valign=\"top\">\r\n<td height=\"21\">\r\n<p>7</p>\r\n</td>\r\n<td>\r\n<p>Dehydroepiandrosterone sulfate (DHEA), plasma</p>\r\n</td>\r\n<td>\r\n<p>Male: 1.3-5.5 mg/mL (3.5-14.9 pmol/L)</p>\r\n<p>Female: 0.6-3.3 mg/mL (1.6-8.9 pmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"72\">\r\n<p>8</p>\r\n</td>\r\n<td>\r\n<p>Estradiol, serum</p>\r\n</td>\r\n<td>\r\n<ul>\r\n<li>\r\n<p align=\"justify\">Male: 10-30 pg/mL (37-110 pmol/L);</p>\r\n</li>\r\n<li>\r\n<p align=\"justify\">Female: day 1-10, 50-100 pmol/L; day 11-20, 50-200 pmol/L; day 21-30, 70- 150 pmol/L</p>\r\n</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"89\">\r\n<p>9</p>\r\n</td>\r\n<td>\r\n<p>Follide-stimulating hormone, serum</p>\r\n</td>\r\n<td>\r\n<ul>\r\n<li>\r\n<p align=\"justify\">Male (adult): 5-15 mU/mL (5-15 U/L)</p>\r\n</li>\r\n<li>\r\n<p align=\"justify\">Female: follicular or luteal phase, 5-</p>\r\n</li>\r\n</ul>\r\n<p align=\"justify\">20 mU/mL (5-20 U/L); midcycle peak, 30-50 mU/mL (30-50U/L);</p>\r\n<p align=\"justify\">postmenopausal, greater than 35 mU/mL (35 U/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"52\">\r\n<p>10</p>\r\n</td>\r\n<td>\r\n<p>Growth hormone, plasma</p>\r\n</td>\r\n<td>\r\n<p align=\"justify\">After oral glucose, less than 2 ng/mL (2 pg/L); response to</p>\r\n<p align=\"justify\">provocative stimuli: greater than 7 ng/mL (7Pg/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"82\">\r\n<p>11</p>\r\n</td>\r\n<td>\r\n<p>Luteinizing hormone, serum</p>\r\n</td>\r\n<td>\r\n<ul>\r\n<li>\r\n<p align=\"justify\">Male: 3-15 mU/mL (3-15 U/L)</p>\r\n</li>\r\n<li>\r\n<p align=\"justify\">Female: follicular or luteal phase, 5-</p>\r\n</li>\r\n</ul>\r\n<p align=\"justify\">22 mU/mL (5-22 U/L); midcycle peak, 30-250 mU/mL (30-250U/L);</p>\r\n<p align=\"justify\">postmenopausal, greater than 30 mU/mL (30 U/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"5\">\r\n<p>12</p>\r\n</td>\r\n<td>\r\n<p>Parathyroid hormone, serum</p>\r\n</td>\r\n<td>\r\n<p>10-65 pg/mL (10-65 ng/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"24\">\r\n<p>13</p>\r\n</td>\r\n<td>\r\n<p>Prolactin, serum</p>\r\n</td>\r\n<td>\r\n<p>Male: less than 15 ng/mL (15 mg/L);</p>\r\n<p>Female: less than 20 ng/mL (20 mg/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"33\">\r\n<p>14</p>\r\n</td>\r\n<td>\r\n<p>Testosterone, serum</p>\r\n</td>\r\n<td>\r\n<p>Male (adult): 300-1200 ng/dL (10-42 nmol/L)</p>\r\n<p>Female: 20-75 ng/dL(0.7-2.6 nmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"24\">\r\n<p>15</p>\r\n</td>\r\n<td>\r\n<p>Thyroid function tests (normal ranges vary)</p>\r\n</td>\r\n<td>\r\n<p align=\"justify\">Thyroid iodine (1311) uptake: 10% to 30% of administered dose at 24 h</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"15\">\r\n<p>16</p>\r\n</td>\r\n<td>\r\n<p>Thyroid-stimulating hormone (TSH)</p>\r\n</td>\r\n<td>\r\n<p>0.5-5.0 pU/mL (0.5-5.0 mU/mL)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"33\">\r\n<p>17</p>\r\n</td>\r\n<td>\r\n<p>Thyroxine (T4), serum</p>\r\n</td>\r\n<td>\r\n<p>Total -5-12 pg/dL (64-155 nmol/L)</p>\r\n<p>Free - 0.9-2.4 ng/dL (12-31 pmol/L)</p>\r\n<p>Free T4 index: 4-11</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"5\">\r\n<p>18</p>\r\n</td>\r\n<td>\r\n<p>Triiodothyronine, resin (T3)</p>\r\n</td>\r\n<td>\r\n<p>25%-35%</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"5\">\r\n<p>19</p>\r\n</td>\r\n<td>\r\n<p>Triiodothyronine, serum (T3)</p>\r\n</td>\r\n<td>\r\n<p>70-195 ng/dL (1.1-3.0 nmol/L)</p>\r\n</td>\r\n</tr>\r\n<tr valign=\"top\">\r\n<td height=\"4\">\r\n<p>20</p>\r\n</td>\r\n<td>\r\n<p>Vanillylmandelic acid, urine</p>\r\n</td>\r\n<td>\r\n<p>Less than 8 mg/24 h (40.4 pmol/24 h)</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<p>&nbsp;</p>','2021-09-19 16:02:10',1,'2021-09-19 20:21:49',1);

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `log` (`log`(200))
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `log` */

insert  into `log`(`id`,`log`) values 
(1,'tstin saja'),
(2,'tstin saja'),
(3,'tstin saja'),
(4,'tstin saja'),
(5,'tstin saja'),
(6,'tstin saja'),
(7,'tstin saja'),
(8,'tstin saja'),
(9,'tstin saja'),
(10,'tstin saja'),
(11,'tstin saja'),
(12,'tstin saja'),
(13,'tstin saja'),
(14,'tstin saja'),
(15,'ini adalah konten uji coba'),
(16,'ini adalah konten uji coba'),
(17,'ini adalah konten uji coba'),
(18,'ini adalah konten uji coba'),
(19,'ini adalah konten uji coba'),
(20,'ini adalah konten uji coba'),
(21,'ini adalah konten uji coba'),
(22,'ini adalah konten uji coba');

/*Table structure for table `master_academic_major` */

DROP TABLE IF EXISTS `master_academic_major`;

CREATE TABLE `master_academic_major` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `master_academic_major` */

/*Table structure for table `master_core_competency` */

DROP TABLE IF EXISTS `master_core_competency`;

CREATE TABLE `master_core_competency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `master_core_competency` */

/*Table structure for table `master_lesson` */

DROP TABLE IF EXISTS `master_lesson`;

CREATE TABLE `master_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `master_lesson` */

/*Table structure for table `master_level` */

DROP TABLE IF EXISTS `master_level`;

CREATE TABLE `master_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `master_level` */

/*Table structure for table `master_sylabus` */

DROP TABLE IF EXISTS `master_sylabus`;

CREATE TABLE `master_sylabus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `semester` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_lesson` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `competency_rows` int(11) NOT NULL,
  `year` varchar(30) NOT NULL COMMENT 'tahun ajaran 2021/2022',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `master_sylabus` */

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `hp1` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `country` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `neighbourhood` int(11) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authcode` varchar(255) NOT NULL,
  `resetcode` varchar(255) NOT NULL,
  `isreset` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Belum Aktif',
  `regdate` datetime NOT NULL,
  `level` tinyint(4) NOT NULL,
  `regip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `member` */

insert  into `member`(`id`,`email`,`fullname`,`hp`,`hp1`,`alamat`,`country`,`region`,`neighbourhood`,`kodepos`,`password`,`authcode`,`resetcode`,`isreset`,`status`,`regdate`,`level`,`regip`) values 
(1,'roemly@gmail.com','Muhammad Romli','08179388230','081773737373','Jl kusuma bangsa no 198 burneh Bangkalan',17,305,1138,0,'fa2632b3304673761d679bcaff73ee8133f453be','e53032daf90ec24111c4dfd7aa6e8cf1222edc61','bebe5b82b5699fab20cad4c0e2dc845653577c60',0,1,'2015-11-08 15:20:17',0,'127.0.0.1'),
(2,'madya@gmail.com','madya alka','08179388230','081773737373','jl kampung',5,0,1037,0,'fa2632b3304673761d679bcaff73ee8133f453be','424c3fdd8b9c33e35ff79f48316930cd70373fb5','',0,1,'2015-11-11 05:42:43',0,'127.0.0.1'),
(3,'','','','','',17,0,1137,0,'cba52456fbae79927d60c9176325a074d75fd28a','0cf5452ad78359d1f5ac1f2f0a03ceea5d5f4f2f','',0,0,'2015-11-13 04:33:43',0,'127.0.0.1');

/*Table structure for table `member_banned` */

DROP TABLE IF EXISTS `member_banned`;

CREATE TABLE `member_banned` (
  `ip` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `member_banned` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `description_id` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `menu` */

/*Table structure for table `menu_block_layout` */

DROP TABLE IF EXISTS `menu_block_layout`;

CREATE TABLE `menu_block_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `isfull` int(11) NOT NULL COMMENT 'container-fluid',
  `style` text NOT NULL COMMENT 'css',
  `thumbnail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `menu_block_layout` */

insert  into `menu_block_layout`(`id`,`id_menu`,`parent`,`name_id`,`urutan`,`type`,`isfull`,`style`,`thumbnail`) values 
(3,4,0,NULL,1,'',0,'',''),
(8,4,0,NULL,5,'',0,'padding-bottom:15px','eyes-394175_1280-562331efd35af-562cf9e1bed31.jpg'),
(7,4,0,NULL,2,'',1,'background-color:#ddd9c3','money-515058_1920-5554092084bbc.jpg'),
(14,6,0,NULL,1,'',0,'',''),
(11,2,0,NULL,1,'',0,'',''),
(15,4,0,NULL,6,'',0,'background-color:#17365d;padding-top:10px;padding-bottom:10px','bg_services-562e1b75f2088.png'),
(16,9,0,NULL,1,'',0,'background-color:#548dd4',''),
(17,9,0,NULL,2,'',0,'',''),
(18,10,0,NULL,1,'',0,'background-color:#262626;padding-top:30px;padding-bottom:30px','bg_services-563223afbd0fc.jpg'),
(19,11,0,NULL,1,'',0,'',''),
(20,12,0,NULL,1,'',0,'',''),
(21,13,0,NULL,1,'',0,'',''),
(22,13,0,NULL,2,'',0,'background-color:#d99694;padding-top:20px;padding-bottom:20px','bg_services-564d4f27374b8.png');

/*Table structure for table `menu_layout` */

DROP TABLE IF EXISTS `menu_layout`;

CREATE TABLE `menu_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_block` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `block` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(30) NOT NULL,
  `isfull` int(11) NOT NULL COMMENT 'container-fluid',
  `style` text NOT NULL COMMENT 'css',
  `thumbnail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `menu_layout` */

insert  into `menu_layout`(`id`,`id_menu`,`id_block`,`parent`,`name_id`,`block`,`urutan`,`value`,`type`,`isfull`,`style`,`thumbnail`) values 
(22,6,14,0,'1 Column [100%]','col_12',10,'','col',0,'',''),
(23,6,14,0,'2 Column [50%] [50%]','col_6_6',11,'','col',0,'','');

/*Table structure for table `menu_layout_item` */

DROP TABLE IF EXISTS `menu_layout_item`;

CREATE TABLE `menu_layout_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_layout` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `block` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `value` text NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `menu_layout_item` */

insert  into `menu_layout_item`(`id`,`id_layout`,`parent`,`name_id`,`block`,`urutan`,`value`,`position`) values 
(42,23,0,'Gallery - Animasi Geser Kategori tertentu','gallery_carousel_category',1,'{\"title_id\":\"\",\"content_id\":\"13,15,14\",\"navigation\":null,\"pagination\":null,\"autoplay\":null}',2),
(43,22,0,'Gallery - Thumbnail   Tab Kategori','gallery_tab_category',1,'{\"title_id\":\"\",\"content_id\":\"13,15,14\"}',1),
(46,24,0,'Testimonial - Blok','testimonial',3,'{\"title_id\":\"\",\"smartphone\":\"\",\"tablet\":\"\",\"desktop\":\"\"}',1),
(47,24,0,'Judul Utama   Deskripsi','main_title',1,'{\"title_id\":\"Testimoni Alumni\",\"content_id\":\"PHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiPkthbWkgdGVyaWthdCBwZXJzYXVkYXJhYW4mbmJzcDsgYWx1bW5pIFNNS04gMiBCYW5na2FsYW48L3A+\",\"url_id\":\"testimoni-alumni\"}',1),
(48,24,0,'Sub Judul   Deskripsi','single_page',2,'{\"title_id\":\"sub testimoni\",\"content_id\":\"PHA+amFkaSBiZWdpbmkgeWE8L3A+\",\"url_id\":\"sub-testimoni\"}',1),
(49,25,0,'Judul Utama   Deskripsi','main_title',2,'{\"title_id\":\"Lorem Ipsum\",\"content_id\":\"PHA+TG9yZW0gSXBzdW0gTG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDtMb3JlbSBJcHN1bSZuYnNwO0xvcmVtIElwc3VtJm5ic3A7TG9yZW0gSXBzdW0mbmJzcDs8L3A+\",\"url_id\":\"lorem-ipsum\"}',1),
(41,22,0,'Gallery - Thumbnail   Tab Kategori','gallery_tab_category',2,'{\"title_id\":\"\",\"content_id\":\"13,15,14\"}',2),
(39,22,0,'Gallery - Animasi Geser Kategori tertentu','gallery_carousel_category',1,'{\"title_id\":\"\",\"content_id\":\"13,15,14\",\"navigation\":null,\"pagination\":null,\"autoplay\":\"1\"}',2),
(40,23,0,'Gallery - Animasi Geser Hot','gallery_carousel',1,'{\"title_id\":\"\",\"hot1\":\"1\",\"hot2\":\"1\",\"hot3\":\"1\",\"hot4\":\"1\",\"navigation\":\"1\",\"pagination\":\"1\",\"autoplay\":\"1\"}',1),
(7,2,0,'Slide Show dilengkapi text','slide_show_text',2,'{\"title_id\":\"\",\"content_id\":\"3,4,9,10\",\"description\":{\"3\":{\"title\":\"Responsive\",\"content\":\"Bisa dibuka dimanapun dengan tampilan yang elegant\",\"button1_name\":\"\",\"button1_link\":\"\",\"button2_name\":\"\",\"button2_link\":\"\"},\"4\":{\"title\":\"Design Profesional\",\"content\":\"Website yang bagus mencerminkan perusahaan anda\",\"button1_name\":\"\",\"button1_link\":\"\",\"button2_name\":\"\",\"button2_link\":\"\"},\"9\":{\"title\":\"Sejuta warna\",\"content\":\"Pilih warna template sesuka anda tanpa ada batasan\",\"button1_name\":\"\",\"button1_link\":\"\",\"button2_name\":\"\",\"button2_link\":\"\"},\"10\":{\"title\":\"Harga Bersahabat\",\"content\":\"Design profesional dengan harga sesuai budget anda.\",\"button1_name\":\"\",\"button1_link\":\"\",\"button2_name\":\"\",\"button2_link\":\"\"}},\"navigation\":\"1\",\"pagination\":\"1\",\"autoplay\":\"1\"}',1),
(50,26,0,'Judul Utama   Deskripsi','main_title',2,'{\"title_id\":\"Gallery\",\"content_id\":\"PHA+R2FsbGVyeSBrYW1pPC9wPg==\",\"url_id\":\"gallery\"}',1),
(34,13,0,'Judul Utama','main_title',1,'{\"title_id\":\"Paket Kami\",\"content_id\":\"\",\"url_id\":\"paket-kami\"}',1),
(51,26,0,'Gallery - Animasi single   deskripsi','gallery_single_carousel_desc',4,'{\"title_id\":\"\",\"content_id\":\"13,15,14\",\"navigation\":null,\"pagination\":null,\"autoplay\":null}',1),
(29,20,0,'Services - Blok','services',2,'{\"title_id\":\"\",\"smartphone\":\"0\",\"tablet\":\"4\",\"desktop\":\"4\"}',1),
(33,20,0,'Judul Utama','main_title',1,'{\"title_id\":\"Service Kami\",\"content_id\":\"\",\"url_id\":\"service-kami\"}',1),
(31,13,0,'Price List - Blok','price_list',2,'',1),
(60,30,0,'Gallery - Animasi single   deskripsi','gallery_single_carousel_desc',2,'{\"title_id\":\"\",\"content_id\":\"13,15,14\",\"navigation\":null,\"pagination\":null,\"autoplay\":null}',1),
(61,30,0,'Sub Judul   Deskripsi','single_page',2,'{\"title_id\":\"\",\"content_id\":\"PHA+TG9yZW0gaW1wc3VtIGRvYXNsZGZtYTtscyBkZmo7YWtsZGZqIGxrYXNkZmogO2xrZGY7IGFzZGZqIDthc2RmayZuYnNwOzwvcD4NCjxwPjxpbWcgc3JjPSIuLi8uLi8uLi8uLi8uLi8uLi8vdXNlcmZpbGVzL2ZpbGUvd2Vic3VrYS9tZWRpYS9zb3VyY2UvQnV0dG9uL3dlYnN1a2FfYmVsaV93ZWIucG5nIiBhbHQ9IndlYnN1a2FfYmVsaV93ZWIiIC8+PC9wPg==\",\"url_id\":null}',2),
(62,31,0,'Judul Utama   Deskripsi','main_title',2,'{\"title_id\":\"For Ekky bRo\",\"content_id\":\"PHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiPmsga3NhZGhmIGthanNkaGZsYWprZHNmIGxrYWRmaGwgYWRmaCBsc2RmaCBsYXNkZmggc2thZjwvcD4=\",\"url_id\":\"for-ekky-bro\"}',1),
(63,32,0,'Gallery - Animasi single   deskripsi','gallery_single_carousel_desc',2,'{\"title_id\":\"\",\"content_id\":\"13,15,14\",\"navigation\":\"1\",\"pagination\":\"1\",\"autoplay\":\"1\"}',1);

/*Table structure for table `modul` */

DROP TABLE IF EXISTS `modul`;

CREATE TABLE `modul` (
  `modul` varchar(50) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`modul`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `modul` */

insert  into `modul`(`modul`,`title_id`,`title_en`,`urutan`) values 
('inquiry','Inquiry','Inquiry',3),
('service','Divisi service','Service divisions',2),
('index','Beranda','Home',1),
('certificate','Certificate Validation','Certificate Validation',4),
('about','Tentang kami','About',5),
('news','Berita','News',6),
('contact','Hubungi Kami','Contact US',7),
('gallery','Gallery','Gallery',7),
('catalog','Catalog','Catalog',8);

/*Table structure for table `msg_warning` */

DROP TABLE IF EXISTS `msg_warning`;

CREATE TABLE `msg_warning` (
  `name` varchar(50) NOT NULL,
  `title_id` text NOT NULL,
  `title_en` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `msg_warning` */

insert  into `msg_warning`(`name`,`title_id`,`title_en`,`urutan`,`type`,`label`) values 
('signup_user_exists','User exists','',0,'textarea:0:span8','Signup:User Exists'),
('mail_code_activation','<p>Hi, $fullname<br />&nbsp;<br />Thank you for registering on Purple Markets ! <br />To complete the registration process , please make confirmation of registration via the url below <br /><a href=\"http://purple.off/web_dir/mobitren/$value_code_activation\">$value_code_activation</a><br />&nbsp;<br />Best Regards, <br />Purple Market <br />www.purplemarkets.com</p>','',1,'tiny','Mail code activation: ($value_code_activation)'),
('mail_code_reset','<p>Hi, $fullname</p>\r\n<p>Click this link to reset your password<br />Please click this url <a href=\"http://purple.off/web_dir/mobitren/$value_code_reset\">$value_code_reset</a></p>\r\n<p>&nbsp;</p>\r\n<p>Best Regards, <br />Purple Market <br />www.purplemarkets.com</p>\r\n<p>&nbsp;</p>','',1,'tiny','Mail code reset password: ($value_code_reset)'),
('signup_password_not_match','Your password do not match. Please try again.','',0,'textarea:0:span8','Signup:Password Not Match'),
('signup_ip_banned','Sorry your ip banned','',0,'textarea:0:span8','Signup:IP Banned'),
('signup_cannot_register','You must fill in all of the fields correctly.','',0,'textarea:0:span8','Signup:Cannot Register'),
('signup_register_failed','Invalid email address','',0,'textarea:0:span8','Signup:Register Failed'),
('activation_account_success','Congratulation, your account already activated','',0,'textarea:0:span8','Activation:Activation Account Success'),
('activation_account_failed','Invalid activation code','',0,'textarea:0:span8','Activation:Activation Account Failed'),
('reset_pass_success','Please check your email, We already email you a link to reset your password','',0,'textarea:0:span8','Reset Pass:Reset Pass Success'),
('reset_pass_failed','Error, Send mail failed','',0,'textarea:0:span8','Reset Pass:Reset Pass Failed'),
('reset_pass_notmatch','Password Not Match','',0,'textarea:0:span8','Reset Pass:Reset Pass Not Match'),
('reset_link_expired','Link Expired !!','',0,'textarea:0:span8','Reset Pass:Reset Link Expired'),
('reset_pass_done','Password change success, Use new password to login','',0,'textarea:0:span8','Reset Pass:Reset Pass Done'),
('mail_check_your_email','Thank you for register, please check your email','',0,'textarea:0:span8','0'),
('profile_update_success','Profile update success','',0,'textarea:0:span8','Profile Update :Update success'),
('profile_update_failed','Profile update failed','',0,'textarea:0:span8','Profile Update :Update success'),
('profile_password_not_match','Password not match , Please try again','',0,'textarea:0:span8','Profile Password not match ');

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `summary_id` text NOT NULL,
  `summary_en` text NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `publish` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `news` */

insert  into `news`(`id`,`cat_id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`summary_id`,`summary_en`,`tanggal`,`url_id`,`url_en`,`urutan`,`publish`) values 
(1,10,'flow-switch-539e8c214b30e.jpg','Flow Switch','<p>Lorem ipsum Lorem ipsumLorem ipsum Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsum<br /><br /></p>','Flow Switch','<p>Lorem ipsum Lorem ipsumLorem ipsum Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsum</p>','','','2014-07-18','flow-switch','flow-switch',1,1),
(2,0,'pressure-539e8c6bdfef3.jpg','Tekanan','<p>Browsing disini cukup menyenangkan sekali. hore aku bisa membaut produk ku sendiri</p>','Pressure','','','','2014-05-10','tekanan','pressure',4,1),
(3,0,'2014-06-08 101050-53b485ffd5593.jpg','Level Switch','<p>Lorem ipsum</p>','Level Switch','<p>Lorem ipsum</p>','','','2014-05-15','level-switch','level-switch',3,1),
(4,10,'temperature-53a359a738b26.jpg','Suhu','<p>Lorem</p>','Temperature','<p>Lorem</p>','','','2014-05-16','suhu','temperature',5,1),
(6,12,'pic-1-53c2489b78f1f.jpg','Lorem ipsum id','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','Lorem ipsum en','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','2014-07-30','lorem-ipsum-id','lorem-ipsum-en',2,1);

/*Table structure for table `news_category` */

DROP TABLE IF EXISTS `news_category`;

CREATE TABLE `news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name_id` varchar(200) DEFAULT NULL,
  `description_id` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `news_category` */

insert  into `news_category`(`id`,`parent`,`name_id`,`description_id`,`urutan`,`name_en`,`description_en`,`filename`,`url_id`,`url_en`) values 
(5,0,'IPD','Lorem ipsum ipd indo',3,'IPD','Lorem ipsum ipd inggris','temperature-53a09d492d2b6.png','ipd','ipd'),
(11,0,'IDD','<p>Lorem ipsum IDD indo</p>',5,'IDD','<p>Lorem ipsum IDD inggris</p>','valve-53a0a44bbd37e.png','idd','idd'),
(12,0,'HSEQ','Occupational heath,safety,environtment and quality',1,'HSEQ','Occupational heath,safety,environtment and quality','Seal-53a12b74ec1d9.png','hseq','hseq');

/*Table structure for table `page` */

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul` varchar(100) NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `page` */

insert  into `page`(`id`,`modul`,`url_id`,`title_id`,`content_id`,`url_en`,`title_en`,`content_en`,`urutan`) values 
(1,'about','about-us','Tentang Kami','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<p>&nbsp;</p>','about-us','About us','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<p>&nbsp;</p>',1),
(2,'summary','summary-about-us','Tentang Kami','<p title=\"jquery-checkbox-examples\">Ada banyak variasi tulisan Lorem Ipsum yang tersedia, tapi kebanyakan sudah mengalami perubahan bentuk, entah karena unsur humor atau kalimat yang diacak hingga nampak sangat tidak masuk akal</p>','summary-about-us','About us','<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text</p>',1),
(15,'contact_footer','contact-us','hubungi kami','<p>Contact us lah</p>','contact-us','contact-us','<p>plesase contact us</p>',0),
(13,'inquiry_atas','','Feel Free to drop us online','<p>Lorem ipsum to do something</p>','','Feel Free to drop us online','<p>lorem ipsum bro</p>',0),
(14,'quickorder','','PROFIL','<p>Lorem ipsum to do something</p>','','PROFILE','<p>lorem ipsum bro</p>',0);

/*Table structure for table `pengumuman` */

DROP TABLE IF EXISTS `pengumuman`;

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `tanggal_expired` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `pengumuman` */

insert  into `pengumuman`(`id`,`tanggal`,`tanggal_expired`,`title`,`content`,`created_date`,`created_by`,`modified_date`,`modified_by`) values 
(6,'2021-03-21','2021-09-09','motivasi','<p style=\"text-align: center;\"><strong><span style=\"font-size: 12pt;\">SELAMAT BERGABUNG DI CBT WIFI UKAI<br /></span></strong></p>\r\n<p style=\"text-align: center;\"><strong><span style=\"font-size: 12pt;\">SEMOGA SUKSES DAN LULUS 100% BERSAMA WIFI UKAI</span></strong></p>\r\n<p style=\"text-align: center;\"><span style=\"color: #ffffff; background-color: #333333;\"><strong>JUJURLAH PADA DIRI ANDA JIKA ANDA TIDAK INGIN TERJADI KERUGIAN <br />BERUSAHALAH SENDIRI JIKA ANDA TIDAK INGIN TERTINGGAL<br />MENANGISLAH SEKERANG KARENA MASIH ADA WAKTU UNTUK TERSADAR<br />DEWI FORTUNA ATAU DEWI KEBERUNTUNGAN PASTI AKAN MENINGGALKAN MU<br />KARENA ABADI ITU ADALAH RINTIHAN DOA KEBERHASILAN ORTU UNTUKMU<br />JANGAN PERNAH MERASA LELAH KARENA LELAH MU TIDAK SEBANDING BUDI ORTUMU<br />JANGAN MERASA BOSAN&nbsp; KARENA BOSAN AKAN MENENGGELAMKANMU</strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"color: #ffffff; background-color: #333333;\">&nbsp;</span></p>\r\n<p style=\"text-align: center;\"><span style=\"color: #ffffff; background-color: #333333;\"><strong>WIFIUKAI.COM</strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"background-color: #ffff00;\">&nbsp;</span></p>\r\n<p style=\"text-align: center;\"><strong><span style=\"font-size: 14pt;\"><span style=\"font-size: 12pt;\"><br /></span> </span></strong></p>','2020-10-30 22:03:35',6,'2021-09-22 00:12:33',6),
(7,'2021-09-22','2021-09-26','SEMANGAT UKAI APOTEKER 4 DELI HUSADA DAN MEDISTRA','<p style=\"text-align: center;\"><span style=\"font-size: 14pt; background-color: #ffcc00;\">\"Ilmu adalah yang memberikan manfaat, bukan yang sekedar hanya dihafal\". &ndash; Imam Syafi&rsquo;i</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 14pt; background-color: #ffcc00;\">\"Barangsiapa belum pernah merasakan pahitnya menuntut ilmu walau sesaat, ia akan menelan hinanya kebodohan sepanjang hidupnya\". &ndash; Imam Syafi&rsquo;i</span></p>','2021-09-22 00:32:37',6,'0000-00-00 00:00:00',0),
(8,'2021-10-28','2021-10-31','MOTIVASI','<p style=\"text-align: center;\"><span style=\"color: #0000ff;\"><strong>Selamat Bergabung Para Calon Sejawat Apoteker di&nbsp; CBT Tryout WIFI UKAI</strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"color: #0000ff;\"><strong>Nikmati Belajar Santai Tanpa Terbengkalai</strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"color: #0000ff;\"><strong>Ajak Juga Temen Kamu untuk selalu menikmati keseruan belajar UKAI di IG wifi_ukai, youtube wifi_Farma, FB Wifi Ukai, TIKTOK Wifi Ukai dan website kami wifiukai.com</strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"color: #0000ff;\"><strong>Dukung Selalu Konten-Konten Kami di Akun Media Sosial </strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"color: #0000ff;\"><strong>Ayo Segera DAFTARKAN diri kamu di Program BELAJAR yang sesuai Kamu Inginkan</strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"color: #0000ff;\"><strong>Nikmati Keseruan dan Keasikan Belajar Bersama Wifi ukai</strong></span></p>','2021-10-29 00:08:53',6,'0000-00-00 00:00:00',0);

/*Table structure for table `pesanan` */

DROP TABLE IF EXISTS `pesanan`;

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `kelamin` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `pesanan` */

insert  into `pesanan`(`id`,`email`,`telp`,`kelamin`,`name`,`address`,`message`,`tanggal`) values 
(1,'roemly@gmail.com','0817939339',1,'jargo','','mau buat logo keren','2014-05-26 21:18:44'),
(2,'durian@montong.com','08173838338',0,'ayudira','','keren bos','2014-05-26 21:30:54'),
(3,'rindah@yahoo.com','0191919',0,'rindah','','okeh jg asih','2014-05-27 06:38:09'),
(12,'roemly@gmail.com','08191818118',0,'roemly','asdfkjasdkjfsdf','\rjagoan negon = 1\r','2014-06-20 13:36:53'),
(13,'roemly.blogspot@gmail.com','08191898',0,'romli','sdfskdns','\rGanti gambar tadi = 1\r','2014-06-23 00:03:52'),
(11,'roemly@gmail.com','08191818118',0,'roemly','asdfkjasdkjfsdf','\rGanti gambar tadi = 1\r','2014-06-20 12:35:48'),
(9,'kenanga@gmail.com','0817191919',0,'Indah','Kenanga','\rJudul Portofolio = 6\r','2014-06-15 21:46:19'),
(10,'kenanga@gmail.com','0817191919',0,'Indah','Kenanga','\rsepatu cowok kece = 5\r','2014-06-15 21:47:12');

/*Table structure for table `price_list` */

DROP TABLE IF EXISTS `price_list`;

CREATE TABLE `price_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `is_register` int(11) NOT NULL,
  `button_name` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `price_list` */

insert  into `price_list`(`id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`pekerjaan`,`price`,`is_register`,`button_name`,`tanggal`,`url_id`,`url_en`,`urutan`) values 
(33,'','MODUL BELAJAR','<p>BUKU 1000 SOAL DAN PEMBAHASAN SERTA AKSES FULL CBT SAMPAI UKAI</p>\r\n<p>FREE ONGKIR</p>\r\n<h4>RP. 400.000</h4>','','','',400000,1,'Daftar Sekarang','2021-05-01','modul-belajar','',1),
(35,'','SELEKSI UJIAN MASUK APOTEKER','<p style=\"text-align: center;\">&gt; 500 SOAL LATIHAN (Pembahasan)<br />&gt; 3 paket soal tryout yang bakalan real keluar<br />Materi yang disajikan akan membantu kamu untuk menentukan kampus pilhan bahkan sampai Ke UKAI</p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 18pt;\"><strong>RP 500.000</strong></span></p>','','','',500000,1,'BERGABUNG','2021-06-13','seleksi-ujian-masuk-apoteker','',0),
(36,'','BIMBEL ONLINE VIA ZOOM','<p style=\"text-align: center;\"><span style=\"font-size: 12pt;\">12 Pertemuan</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 12pt;\">Free Ongkir Keseluruh Indonesia</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 12pt;\">10x Tryout Prediksi 80% UKAI</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 12pt;\">Prediksi TO Nasional 400 Soal</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 12pt;\">&gt;10.000 Soal Latihan</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 24pt; background-color: #3366ff;\">RP 800.000</span></p>','','','',800000,1,'DAFTAR YUK','2021-08-19','bimbel-online-via-zoom','',0),
(34,'','BIMBEL ONLINE VIA ZOOM MASUK APOTEKER','<p>Mendapatkan Akses &gt;5000 Soal Latihan</p>\r\n<p>Mendapatkan Tryout 16x Dijamin Keluar (Include Pembahasan)</p>\r\n<p>Full Akses Sampai Anda H-1 UKAI</p>\r\n<p>Mendapat Buku Latihan Soal + kunci pembahasan</p>\r\n<p><span style=\"font-size: 18pt; color: #3366ff;\"><strong>RP 800.000</strong></span></p>\r\n<p><span style=\"font-size: 18pt; color: #3366ff;\">&nbsp;</span></p>','','','',800000,1,'DAFTAR SEKARANG','2021-05-25','bimbel-online-via-zoom-masuk-apoteker','',2),
(27,'','KELAS REGULER','<p>18-25 ORANG</p>\r\n<p>16X PERTEMUAN</p>\r\n<h4>RP. 700.000</h4>','','','',700000,1,'Daftar','2021-05-01','kelas-reguler','',3),
(28,'','KELAS VIP','<p>10 ORANG</p>\r\n<p>16X PERTEMUAN</p>\r\n<h4>RP. 1.250.000</h4>','','','',1250000,1,'Daftar','2021-05-01','kelas-vip','',4),
(29,'','KELAS PRIVAT','<p>5 ORANG</p>\r\n<p>22X PERTEMUAN</p>\r\n<h4>RP. 2.500.000</h4>','','','',2500000,1,'Daftar','2021-05-01','kelas-privat','',5),
(30,'','KELAS SUPER INTESIF UKAI','<p style=\"text-align: center;\">15-20 ORANG<br />16X PERTEMUAN (Hari H-1 UKAI)<br />MULAI 01 JULI-30 JULI 2021 (BISA BULAN MEI)<br />INTESIF BAHAS SOAL UKAI DARI SETIAP TAHUN</p>\r\n<h4 style=\"text-align: center;\">RP. 500.000</h4>','','','',500000,1,'Daftar','2021-05-01','kelas-super-intesif-ukai','',6),
(31,'','TryOut Praktis Jangkauan Gratis','<p>1. Bukti Screenshoot sudah Follow akun @wifi_ukai </p>\r\n<p>2. Bukti Screenshoot Share salah satu postingan @wifi_ukai di story Instagram</p>\r\n<p>2. Bukti Screenshoot sudah TAG 5 (lima) teman kamu di kolom komentar postingan (TryOut Praktis Jangkauan Gratis) di Instagram @wifi_ukai</p>\r\n<p>3. Bukti Screenshoot sudah Download aplikasi WIFI UKAI-Bimbingan Online dan Offline Farmasi</p>','','','',0,1,'UJI KEMAMPUAN MU','2021-05-01','tryout-praktis-jangkauan-gratis','',7),
(32,'','TRY OUT UKAI CBT WIFI UKAI','<p>Pengerjaan Tryout Online melalui website wifiukai.com 200 Soal dalam 200 Menit Real CBT UKAI LENGKAP DENGAN PEMBAHASAN</p>\r\n<p>4X TRYOUT</p>\r\n<p>&nbsp;</p>\r\n<h4>RP. 200.000</h4>','','','',200000,1,'BERGABUNG','2021-05-01','try-out-ukai-cbt-wifi-ukai','',8),
(37,'','WIFI UKAI KELAS INTENSIF','<p style=\"text-align: center;\"><strong><span style=\"background-color: #ffffff;\">MINIMAL PERTEMUAN 16X ATAU SAMPAI H-1 UKAI</span></strong></p>\r\n<p style=\"text-align: center;\"><strong><span style=\"background-color: #ffffff;\">TO 22X</span></strong></p>\r\n<p style=\"text-align: center;\"><strong><span style=\"background-color: #ffcc00;\"><span style=\"background-color: #ffffff;\">PAKET BUKU WIFI UKAI</span><br /></span><span style=\"background-color: #ffcc00;\"><span style=\"background-color: #ffffff;\">(INTENSIF, MODUL &amp; 1000 SOAL LATIHAN)</span></span><span style=\"background-color: #ffcc00;\"><br /></span></strong></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 24pt; background-color: #00ccff;\"><strong>RP. 1.900.000</strong></span></p>','','','',1900000,1,'DAFTAR ','2021-11-15','wifi-ukai-kelas-intensif','',0),
(38,'','WIFI UKAI KELAS INTENSIF ONLINE','<p style=\"text-align: center;\"><strong><span style=\"background-color: #ffcc00;\">MINIMAL PERTEMUAN 16X ATAU SAMPAI H-1 UKAI</span></strong></p>\r\n<p style=\"text-align: center;\"><strong><span style=\"background-color: #ffcc00;\">TO 22X</span></strong></p>\r\n<p style=\"text-align: center;\"><strong><span style=\"background-color: #ffcc00;\">PAKET BUKU WIFI UKAI<br /><br />HARGA RP 1.300.000</span></strong></p>','','','',1300000,1,'GABUNG','2021-11-15','wifi-ukai-kelas-intensif-online','',0),
(39,'','KELAS INTENSIF (ALUMNI WIFI UKAI)','<p style=\"text-align: center;\"><span style=\"background-color: #00ff00;\"><strong>MINIMAL PERTEMUAN 16X ATAU SAMPAI H-1 UKAI</strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"background-color: #00ff00;\"><strong>TO 22X</strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"background-color: #00ff00;\"><strong>PAKET BUKU WIFI UKAI (- MODUL)<br /><br /><br />HARGA RP 1.300.000</strong></span></p>','','','',1300000,1,'DAFTAR YUK','2021-11-15','kelas-intensif-alumni-wifi-ukai','',0),
(40,'','KELAS ZOOM PRIVAT ','<p style=\"text-align: center;\"><span style=\"font-size: 18pt;\">5 Orang</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 18pt;\">22 Pertemuan</span></p>\r\n<p style=\"text-align: center;\"><span style=\"background-color: #0000ff; font-size: 18pt;\"><strong>RP 2.200.000</strong></span></p>','','','',2200000,1,'BERGABUNG','2022-02-25','kelas-zoom-privat-','',0),
(41,'','KELAS MANDIRI KHUSUS','<p>MENDAPAT PERLAKUAN KHUSUS ZOOM &amp; LURING</p>\r\n<p>MAKSIMAL 6 ORANG</p>\r\n<p>30 PERTEMUAN</p>\r\n<p>AKSES CBT UNLIMITED</p>\r\n<p><span style=\"font-size: 18pt; background-color: #ff9900;\"><strong>RP. 4.500.000</strong></span></p>','','','',4500000,1,'AYO GABUNG BELAJAR','2022-04-18','kelas-mandiri-khusus','',0),
(42,'','PRIVAT MANDIRI','<p>INDIVIDUAL</p>\r\n<p>JADWAL ANDA TENTUKAN</p>\r\n<p>PROSES BELAJAR ASIK DAN MUDAH DI MENGERTI</p>\r\n<p>30 PERTEMUAN</p>\r\n<p><span style=\"font-size: 18pt;\"><span style=\"background-color: #3366ff;\">RP. 4.500.000</span></span></p>','','','',4500000,1,'IKUT BELAJAR','2022-04-18','privat-mandiri','',0);

/*Table structure for table `quiz_analize` */

DROP TABLE IF EXISTS `quiz_analize`;

CREATE TABLE `quiz_analize` (
  `schedule_id` int(11) NOT NULL,
  `json_member` text NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_analize` */

/*Table structure for table `quiz_category` */

DROP TABLE IF EXISTS `quiz_category`;

CREATE TABLE `quiz_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_category` */

/*Table structure for table `quiz_class` */

DROP TABLE IF EXISTS `quiz_class`;

CREATE TABLE `quiz_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_class` */

insert  into `quiz_class`(`id`,`nama`,`created_by`,`created_date`,`modified_by`,`modified_date`) values 
(1,'123456',1,'2024-12-19 16:29:43',0,'0000-00-00 00:00:00'),
(2,'123456',240,'2025-03-19 12:01:32',0,'0000-00-00 00:00:00'),
(3,'123456',240,'2025-03-19 12:12:14',0,'0000-00-00 00:00:00'),
(4,'123456',240,'2025-03-19 12:14:03',0,'0000-00-00 00:00:00');

/*Table structure for table `quiz_class_log` */

DROP TABLE IF EXISTS `quiz_class_log`;

CREATE TABLE `quiz_class_log` (
  `member_id` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `tanggal_masuk` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_class_log` */

/*Table structure for table `quiz_complex` */

DROP TABLE IF EXISTS `quiz_complex`;

CREATE TABLE `quiz_complex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL COMMENT 'Paket A/B',
  `A` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `B` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `C` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `D` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `E` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `F` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `G` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `H` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `I` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `J` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `model` int(11) DEFAULT NULL COMMENT '0:vertical;1=horizontal',
  `urutan` int(11) DEFAULT NULL,
  `bobot` int(11) DEFAULT 1 COMMENT 'di pake untuk jenis skor =3',
  PRIMARY KEY (`id`),
  KEY `quiz_complex_index` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `quiz_complex` */

/*Table structure for table `quiz_demo` */

DROP TABLE IF EXISTS `quiz_demo`;

CREATE TABLE `quiz_demo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_code` varchar(20) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_demo` */

/*Table structure for table `quiz_detail` */

DROP TABLE IF EXISTS `quiz_detail`;

CREATE TABLE `quiz_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL COMMENT 'Paket A/B',
  `A` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `B` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `C` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `D` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `E` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `F` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `G` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `H` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `I` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `J` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `model` int(11) DEFAULT NULL COMMENT '0:vertical;1=horizontal',
  `urutan` int(11) DEFAULT NULL,
  `bobot` int(11) DEFAULT 1 COMMENT 'di pake untuk jenis skor =3',
  PRIMARY KEY (`id`),
  KEY `quiz_detail_index` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `quiz_detail` */

insert  into `quiz_detail`(`id`,`question`,`quiz_id`,`type`,`A`,`B`,`C`,`D`,`E`,`F`,`G`,`H`,`I`,`J`,`answer`,`model`,`urutan`,`bobot`) values 
(3,'<p>Paat saat Set Up Engine Irigasi, Engine harus diposisikan sejajar dengan :</p>',3,'','<p>A. Drum Pelumas Pompa</p>','<p>B. Gear box</p>','<p>C. Tangki Solar</p>','<p>D. Opeartor Engine</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,1,1),
(4,'<p>Alat yang berfungsi untuk menyambungkan 2 pipa dengan ukuran berbeda disebut :</p>',3,'','<p>A. Elbow</p>','<p>B. Flow Meter</p>','<p>C. Reducer</p>','<p>D. Hour Meter</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,2,1),
(5,'<p>Flow Meter adalah alat yang digunakan untuk mengukur :</p>',3,'','<p>A. Debit Air</p>','<p>B. Suhu Engine</p>','<p>C. Tekanan Engine</p>','<p>D. Jam Kerja Engine</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,3,1),
(6,'<p>Pada setting engine sumur dilakukan pemasangan selang pendingin yang berfungsi untuk :</p>',3,'','<p>A. Menyalurkan air ke pipa irigasi</p>','<p>B. C dan B adalah jawaban yang benar</p>','<p>C. Menyalurkan pasir ketika terjadi tekor pada sumur bor</p>','<p>D. Mendinginkan suhu gearbox agar tidak terjadi overheat</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,4,1),
(7,'<p>Jika terjadi kebocoran pada pipa, yang pertama kali dilakukan adalah :</p>',3,'','<p>A. Memperbaiki sambungan</p>','<p>B. Menghidupkan engine</p>','<p>C. Melakukan Pemasangan reduser dan flow mater</p>','<p>D. Mematikan mesin</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,5,1),
(8,'<p>Berapa jumlah operator yang melakukan instalasi pipa irigasi?</p>',3,'','<p>A. 1 orang operator</p>','<p>B. 2 orang operator</p>','<p>C. 3 orang operator</p>','<p>D. 5 orang operator</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,6,1),
(9,'<p>Apa tujuan dari penggelontoran?</p>',3,'','<p>A. Buang-buang air</p>','<p>B. Supaya air lebih bersih</p>','<p>C. Supaya kotoran tidak masuk ke hose drum</p>','<p>D. Menghitung debit air</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,7,1),
(10,'<p>Berikut ini cara memuat pipa irigasi yang benar?</p>',3,'','<p>A. Diseret</p>','<p>B. Dibanting</p>','<p>C. Diangkat oleh 1 orang</p>','<p>D. Diangkat oleh 2 orang dan diletakkan secara hati-hati</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,8,1),
(11,'<p>Apa nama karet yang dipasang pada pipa irigasi?</p>',3,'','<p>A. Seal</p>','<p>B. Beal</p>','<p>C. Real</p>','<p>D. Teal</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,9,1),
(12,'<p>Berapa menit waktu yang dibutuhkan untuk penggelontoran?</p>',3,'','<p>A. + 10 menit</p>','<p>B. + 15 menit</p>','<p>C. + 8 menit</p>','<p>D. + 5 menit</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,10,1),
(13,'<p>Mengapa Penarikan selang PE harus 3km/Jam?</p>',3,'','<p>A. Supaya Selang PE Tidak mudah Rusak</p>','<p>B. Supaya menghemat Solar</p>','<p>C. Melatih Kesabaran</p>','<p>D. Supaya Tidak Balapan</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,11,1),
(14,'<p>Apa yang perlu dipastikan saat setting gun sprinkle?</p>',3,'','<p>A. Ketersediaan Nozzle</p>','<p>B. Kondisi Nozzle</p>','<p>C. Ukuran rencana Nozzle</p>','<p>D. Semua Jawaban Benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,12,1),
(15,'<p>Ukuran Nozzle yang digunakan di GGP, kecuali?</p>',3,'','<p>A. 25</p>','<p>B. 27</p>','<p>C. 29</p>','<p>D. 15</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,13,1),
(16,'<p>Untuk memastikan irigator tidak bergerak ketika proses irigasi, maka yang harus dilakukan terlebih dahulu adalah :</p>',3,'','<p>A. Pelepesan irigator dengan traktor</p>','<p>B. Memasang jack dudukan irigator</p>','<p>C. Memastikan posisi irrigator lurus searah jalan plot</p>','<p>D. a,b,c semua benar</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,14,1),
(17,'<p>Apa tujuan Penggelontoran / Flushing?</p>',3,'','<p>A. Agar Tidak Masuk Angin</p>','<p>B. Agar Gun Tidak Tersumbat</p>','<p>C. Membersihkan Kotoran agar tidak masuk ke housedrum</p>','<p>D. Semua Jawaban Benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,15,1),
(18,'<p>Langkah apa sajakah yang harus di lakukan sebelum mengoprasikan engine?</p>',3,'','<p>A. Cek oli, cek air radiator</p>','<p>B. Cek air radiator, cek Vanbelt</p>','<p>C. Cek solar, cek kekencangan baut kopel</p>','<p>D. Semua benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,16,1),
(19,'<p>Di RPM berapa saat engine akan di oprasikan?</p>',3,'','<p>A. 500-800</p>','<p>B. 100-200</p>','<p>C. 1000 - 1200</p>','<p>D. 200-400</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,17,1),
(20,'<p>Berapa jumlah RPM pada unit engine saat beroperasi?</p>',3,'','<p>A. 2000 - 2500</p>','<p>B. 500 - 700</p>','<p>C. 100 - 500</p>','<p>D. 1200 - 1700</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,18,1),
(21,'<p>Apa saja tahapan sebelum start engine?</p>',3,'','<p>A. Cek instalasi elektrik</p>','<p>B. Menghidupkan stop kontak accu</p>','<p>C. Cek handle kopling pada posisi netral</p>','<p>D. Semua benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,19,1),
(22,'<p>Bagaimana cara mematikan engine pada keadaan darurat?</p>',3,'','<p>A. Menunggu instruksi</p>','<p>B. Menekan tombol ON</p>','<p>C. Cabut kabel accu</p>','<p>D. Menekan tombol emergency / engine stop</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,20,1),
(23,'<p>Kenapa harus menyetel sudut gun/arah gun?</p>',3,'','<p>A. Agar siram ke nanas rata</p>','<p>B. Agar jalan tersiram</p>','<p>C. Agar hemat air</p>','<p>D. Agar hemat waktu</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,21,1),
(24,'<p>Bagaimana cara pengecekan kecepatan?</p>',3,'','<p>A. Melihat panjangnya selang</p>','<p>B. Menggunakan stik satu meter dan stopwatch (timer)</p>','<p>C. Melihat posisi tuas gas</p>','<p>D. Melihat putaran irrigator</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,22,1),
(25,'<p>Apa fungsi pressure gauge pada irrigator (bower)?</p>',3,'','<p>A. Untuk perlengkapan irrigator</p>','<p>B. Untuk mengetahui tekanan siram yang diinginkan</p>','<p>C. Untuk mengetahui bahwa air sudah mengalir</p>','<p>D. Sebagai pelengkap komponen irrigator</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,23,1),
(26,'<p>Untuk melihat debit air yang terpakai, kita harus melihat&hellip;</p>',3,'','<p>A. Pressure air tertentu</p>','<p>B. Tangka solar</p>','<p>C. Air radiator</p>','<p>D. Flow meter</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,24,1),
(27,'<p>Alat yang digunakan untuk mengukur kecepatan siram adalah :</p>',3,'','<p>A. Stopwatch (HP)</p>','<p>B. Meteran (stik 1m)</p>','<p>C. Batu (penanda)</p>','<p>D. Semua benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,25,1),
(28,'<p>Pengecekan hasil kerja meliputi :</p>',3,'','<p>A. Cek kecepatan siram berkala</p>','<p>B. Cek hasil siram / luasan</p>','<p>C. Cek plot-plot yang sudah disiram</p>','<p>D. Semua benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,26,1),
(29,'<p>Jika ada kebocoran pipa saat operasi irigasi, apa tindakan yang dilakukan?</p>',3,'','<p>A. Lapor ke mekanik</p>','<p>B. Dibiarkan saja</p>','<p>C. Matikan engine lalu perbaikan pipa yang bocor</p>','<p>D. Semua jawaban benar</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,27,1),
(30,'<p>Apa yang kita lakukan pada engine irigasi jika pergantian pipa irigasi bocor?</p>',3,'','<p>A. RPM pada engine dinaikkan</p>','<p>B. Engine dimatikan terlabih dahulu</p>','<p>C. Langsung dilakukan perbaikan</p>','<p>D. Semua benar</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,28,1),
(31,'<p>Pengecekan luas hasil siram berdasarkan&hellip;</p>',3,'','<p>A. Lokasi siram</p>','<p>B. Kecepatan siram</p>','<p>C. Panjang pipa PE</p>','<p>D. Kira-kira saja</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,29,1),
(32,'<p>Dibawah ini cara yang benar dalam pengecekan stok solar adalah :</p>',3,'','<p>A. Melihat fisik solar</p>','<p>B. Mengukur menggunakan stik ukur solar</p>','<p>C. Mengacu pada jam operasi siram</p>','<p>D. Kira-kira saja</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,30,1),
(33,'<p>Apakah yang perlu dilakukan terhadap penangan sampah organik dan non organik yang ada di area kerja irigasi?</p>',3,'','<p>A. Dibakar dekat gubuk irigasi</p>','<p>B. Diletakkan di pojok gubuk</p>','<p>C. Ditempatkan pada tempat sampah dan dibuang ke TPA secara berkala</p>','<p>D. Diselipkan pada area yang tidak terlihat</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,31,1),
(34,'<p>Apakah yang perlu dilakukan pada tumpukan kunci, ember, wadah bekas minuman, dan cangkul yang menumpuk pada satu area?</p>',3,'','<p>A. Ditutupi oleh karung</p>','<p>B. Dimasukkan menjadi satu ke dalam sebuah karung</p>','<p>C. Ditempatkan sesuai jenisnya dan dibuang apabila tidak digunakan</p>','<p>D. Dibiarkan saja</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,32,1),
(35,'<p>Hal-hal yang tidak boleh dilakukan pada area irigasi dan berhubungan dengan 5R adalah...</p>',3,'','<p>A. Makan dan minum</p>','<p>B. Berdiskusi dan Menyusun rencana kerja</p>','<p>C. Memperbaiki kendaraan pribadi</p>','<p>D. Meletakkan kunci kerja di bawah engine</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,33,1),
(36,'<p>Dari beberapa hal yang tidak sesuai dibawah ini, kondisi manakah yang perlu dikerjakan terlebih dahulu?</p>',3,'','<p>A. Sampah berserakan</p>','<p>B. Kabel Listrik yang terkelupas</p>','<p>C. Alat kerja yang berantakan</p>','<p>D. Dokumen kerja yang tidak tersusun</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,34,1),
(37,'<p>Salah satu bentuk penerapan R2 (Rapi) yaitu...</p>',3,'','<p>A. Menentukan area kerja</p>','<p>B. Menyusun dan menyimpan item/perangkat kerja yang sering digunakan secara aman dan mudah dijangkau</p>','<p>C. Penghijauan di area kerja dan mesin</p>','<p>D. Pengecatan gubuk dan unit secara menyuluruh</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,35,1),
(38,'<p>Apa langkah pertama yang harus dilakukan untuk mematikan mesin?</p>',3,'','<p>A. Menekan tombol emergency stop</p>','<p>B. Memutar switch starter mesin ke posisi off</p>','<p>C. Menurunkan RPM secara perlahan</p>','<p>D. Menaikan RPM secara perlahan</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,36,1),
(39,'<p>Berapa RPM yang disarankan saat akan mematikan mesin?</p>',3,'','<p>A. 500 &ndash; 600 RPM</p>','<p>B. 600 &ndash; 700 RPM</p>','<p>C. 700 - 800 RPM</p>','<p>D. 800 - 900 RPM</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,37,1),
(40,'<p>Bagaimana cara menghentikan putaran pompa?</p>',3,'','<p>A. Tekan Tombol Emergency</p>','<p>B. Menarik Handle Rem</p>','<p>C. Mematikan Stopkontak</p>','<p>D. Lepas kopling shaft mesin lalu shaft pompa</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,38,1),
(41,'<p>Apa yang dilakukan apabila terjadi keadaan darurat pada mesin?</p>',3,'','<p>A. Memutar switch starter mesin ke posisi off</p>','<p>B. Menekan tombol emergency stop</p>','<p>C. Menarik handle rem</p>','<p>D. Lepas kopling shaft mesin lalu shaft pompa</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,39,1),
(42,'<p>Jelaskan urutan Langkah mematikan mesin!</p>',3,'','<p>A. Menurunkan RPM &ndash; Melepas kopling shaft &ndash; Menunggu &ndash; Memutar switch starter</p>','<p>B. Melepas kopling shaft &ndash; menurunkan RPM &ndash; Menunggu &ndash; Memutar switch starter</p>','<p>C. Menunggu &ndash; Mematikan switch starter &ndash; Melepas kopling shaft &ndash; Menurunkan RPM</p>','<p>D. Memutar switch starter &ndash; Menunggu &ndash; Melepas kopling shaft &ndash; Menurunkan RPM</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,40,1),
(43,'<p>Berikut indikasi kerusakan berat pada mesin, KECUALI ?</p>',3,'','<p>A. Panas Mesin Berlebih</p>','<p>B. Kopel Lepas</p>','<p>C. Oli Rembes</p>','<p>D. Suara Mesin Kasar</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,41,1),
(44,'<p>Tindakan apa yang dilakukan ketika terjadi seal grandpacking di ash pompa bocor?</p>',3,'','<p>A. Baut Grandpacking Dikencangkan</p>','<p>B. Mengencangkan Baut Pipa</p>','<p>C. Menekan Tombol Emergency</p>','<p>D. Menghubungi Mandor</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,42,1),
(45,'<p>Apa tindakan yang harus dilakukan ketika terjadi masalah gearbox bocor oli?</p>',3,'','<p>A. Menambah Oli</p>','<p>B. Pengecekan Grandpacking / Ash Pompa</p>','<p>C. Menghubungi Mandor</p>','<p>D. Periksa Putaran Mesin</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,43,1),
(46,'<p>Apa yang dilakukan ketika terjadi kebocoran pada selang Fleksibel?</p>',3,'','<p>A. Pengencangan Kopler</p>','<p>B. Ganti Selang Fleksibel Baru</p>','<p>C. Ganti Pipa</p>','<p>D. Penggantian Seal</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,44,1),
(47,'<p>Apa yang dilakukan jika pressure gaudge tidak sesuai standar?</p>',3,'','<p>A. Cek Sesesuaian Putaran Mesin</p>','<p>B. Cek Kebocoran Pipa</p>','<p>C. Informasikan Ke Mandor</p>','<p>D. Semua Benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,45,1),
(48,'<p>Berikut ini yang dilaporkan dalam LHO kecuali...</p>',3,'','<p>A. Tanggal</p>','<p>B. Lokasi</p>','<p>C. Luas</p>','<p>D. Jenis bibit</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,46,1),
(49,'<p>Siapa yang menandatangani LHO kecuali...</p>',3,'','<p>A. Mandor/operator</p>','<p>B. Kasie operasional/kasie FS</p>','<p>C. Kawil</p>','<p>D. Manager PM</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,47,1),
(50,'<p>LHO dibuat oleh?</p>',3,'','<p>A. Operator</p>','<p>B. Mekanik</p>','<p>C. Kasie</p>','<p>D. Mandor</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,48,1),
(51,'<p>Penulisan standar untuk RPM dalam pelaporan LHO adalah...</p>',3,'','<p>A. 15</p>','<p>B. 1.5</p>','<p>C. 150</p>','<p>D. 1500</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,49,1),
(52,'<p>Apa satuan kecepatan irrigator?</p>',3,'','<p>A. m/jam</p>','<p>B. cm/jam</p>','<p>C. km/jam</p>','<p>D. mm/jam</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,50,1),
(53,'<p>Paat Berapa ukuran pipa sedot / pipa yang masuk ke lebung</p>',4,'','<p>A. 5\"</p>','<p>B. 7\"</p>','<p>C. 6,5\"</p>','<p>D. 6</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,1,1),
(54,'<p>Alat yang berfungsi untuk menyambungkan 2 komponen pipa yang memiliki ukuran berbeda adalah?</p>',4,'','<p>A. Reducer</p>','<p>B. Gearbox</p>','<p>C. Koyak</p>','<p>D. Flowmeter</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,2,1),
(55,'<p>Alat yang digunakan untuk mengukur debit air adalah</p>',4,'','<p>A. Flowmeter</p>','<p>B. Spedometer</p>','<p>C. Ombrometer</p>','<p>D. Termometer&nbsp;</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,3,1),
(56,'<p>Apa fungsi kontak accu/baterai pada mesin irigasi</p>',4,'','<p>A. Memutus dan menyambung arus listrik</p>','<p>B. Mengalirkan listrik</p>','<p>C. Mengalirkan air</p>','<p>D. Mengalirkan air</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,4,1),
(58,'<p>Apa fungsi seal karet (perpak) yang terdapat diantara plank</p>',4,'','<p>A. Mengurangi getaran</p>','<p>B. Mencegah kebocoran</p>','<p>C. Mencegah kerusakan pipa</p>','<p>D. Semua benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,5,1),
(60,'<p>Berapa ukuran pipa main line?</p>',4,'','<p>A. 5 inch</p>','<p>B. 3 inch</p>','<p>C. 4 inch</p>','<p>D. 6 inch</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,6,1),
(63,'<p>Berapa ukuran valve submain?</p>',4,'','<p>A. 5 inch</p>','<p>B. 3 inch</p>','<p>C. 4 inch</p>','<p>D. 6 inch</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,7,1),
(66,'<p>Apa jenis selang yang digunakan untuk siram tanaman?</p>',4,'','<p>A. Pipa PVC</p>','<p>B. Pipa Galvanish</p>','<p>C. Pipa HDPE</p>','<p>D. Selang drip</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,8,1),
(69,'<p>Apa tugas operator ketika instalasi selesai dipasang?</p>',4,'','<p>A. Mengisi LHO</p>','<p>B. Pengecekan kebocoran / flushing</p>','<p>C. Menunggu gubuk irigasi</p>','<p>D. Mengukur kedalaman lebung</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,9,1),
(71,'<p>Berapa ukuran pipa yang tidak dipakai untuk instalasi pipa banana?</p>',4,'','<p>A. 5 inch</p>','<p>B. 3 inch</p>','<p>C. 4 inch</p>','<p>D. 6 inch</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,10,1),
(74,'<p>Apa nama konektor selang dengan pipa</p>',4,'','<p>A. Valve</p>','<p>B. Flange</p>','<p>C. Progrip Tape Tee</p>','<p>D. Lem Kubota</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,11,1),
(76,'<p>Apa fungsi Valve?</p>',4,'','<p>A. Kran buka/tutup air</p>','<p>B. Penyambung antar pipa</p>','<p>C. Penghubung atar pipa ukuran berbeda</p>','<p>D. Perekat</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,12,1),
(78,'<p>Apa fungsi Reducer</p>',4,'','<p>A. Kran buka/tutup air</p>','<p>B. Penyambung antar pipa</p>','<p>C. Penghubung atar pipa ukuran berbeda</p>','<p>D. Perekat</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,13,1),
(80,'<p>Apa fungsi Flange</p>',4,'','<p>A. Kran buka/tutup air</p>','<p>B. Penyambung antar komponen instalasi irigasi</p>','<p>C. Penghubung atar pipa ukuran berbeda</p>','<p>D. Perekat&nbsp;</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,14,1),
(83,'<p>Berikut yang bukan termasuk material yang dipakai dalam proses pasang instalasi irigas</p>',4,'','<p>A. Pipa 5 inch</p>','<p>B. Lem</p>','<p>C. Selang</p>','<p>D. Solar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,15,1),
(84,'<p>Berapa Standar siram yang digunakan untuk tanaman pisang umur 1-3 bulan?</p>',4,'','<p>A. 3&nbsp;mm</p>','<p>B. 5&nbsp;mm</p>','<p>C. 7&nbsp;mm</p>','<p>D. 10&nbsp;mm</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,16,1),
(86,'<p>Berapa Standar siram yang digunakan untuk tanaman pisang umur 4-5 bulan?</p>',4,'','<p>A. 3 mm</p>','<p>B. 5&nbsp;mm</p>','<p>C. 7&nbsp;mm</p>','<p>D. 10&nbsp;mm</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,17,1),
(88,'<p>Berapa Standar siram yang digunakan untuk tanaman pisang berbuah?</p>',4,'','<p>A. 3 mm</p>','<p>B. 5&nbsp;mm</p>','<p>C. 7&nbsp;mm</p>','<p>D. 10&nbsp;mm</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,18,1),
(91,'<p>Proses yang bukanuntuk dilakukan pada saat akan menghidupkan mesin:</p>',4,'','<p>A. cek accu</p>','<p>B. cek oli</p>','<p>C. cek valve</p>','<p>D. cek solar</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,19,1),
(93,'<p>5,7 jam dalam pengoperasian mesin irigasi artinya</p>',4,'','<p>A. 57 jam</p>','<p>B. 5 jam 7 menit</p>','<p>C. 5 jam 70 menit</p>','<p>D. 5 jam 47 menit</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,20,1),
(95,'<p>Sebagai seorang operator irigasi, yang dilakukan jika volume irigasi belum tercapai pada waktu yang sudah di tentukan adalah</p>',4,'','<p>A. Lanjutkan siram</p>','<p>B. Matikan mesin / Lapor ke atasan</p>','<p>C. Naikkan RPM</p>','<p>D. Pindah lokasi</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,21,1),
(97,'<p>Apa kerugiaan bagi perusahaan jika dalam bekerja dibidang irigasi terdapat banyak kebocoran pipa, banyak kebuntuan selang seawon, atau flow meter tidak tersedia, kecuali</p>',4,'','<p>A. Produktivitas turun</p>','<p>B. Biaya naik</p>','<p>C. Siram tidak sesua</p>','<p>D. Tidak ada kerugian</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,22,1),
(99,'<p>Kenapa mesin dihidupkan dulu selama 5 menit?</p>',4,'','<p>A. Supaya oli melumasi semua komponen mesin</p>','<p>B. Agar air naik</p>','<p>C. Supaya solar habis</p>','<p>D. Agar pipa tidak bocor</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,23,1),
(101,'<p>Yang perlu dicatat oleh operator dalam lembar LHO, kecuali</p>',4,'','<p>A. RPM</p>','<p>B. Kelembapan tanah</p>','<p>C. Suhu Mesin</p>','<p>D. Jam Mesin</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,24,1),
(104,'<p>Secara teoritis/perhitungan jika air terbaca dalam flowmeter terkirimkan sebesar 160m3 ke area sebesar 2Ha ( 1 Ha = 100m x 100m). berapakah mm ketebalan siramnya selama 2 jam ? ( 0.001m = 1mm)</p>',4,'','<p>A. 16 mm</p>','<p>B. 12 mm</p>','<p>C. 10 mm</p>','<p>D. 5 mm</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,25,1),
(106,'<p>Apa yang harus di isi oleh operator setelah selesai kerja?</p>',4,'','<p>A. Oli</p>','<p>B. Air Radiator</p>','<p>C. Solar</p>','<p>D. Laporan Hasil Operator (LHO)</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,26,1),
(110,'<p>Jika ditemukan pipa bocor saat melakukan pengetesan air / flushing, apa yang harus dilakukan?</p>',4,'','<p>A. Lapor atasan</p>','<p>B. Dibiarkan saja</p>','<p>C. Matikan mesin</p>','<p>D. Beri Penanda dan segera dilakukan perbaikan</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,27,1),
(113,'<p>Apa yang harus dilakukan maintenance saat mesin sudah mulai bekerja?</p>',4,'','<p>A. Pengecekan jalur pipa</p>','<p>B. Pengecekan selang</p>','<p>C. Pengecekan sambungan</p>','<p>D. Benar Semua</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,28,1),
(114,'<p>Apa yang terjadi jika kebocoran pada pipa tidak segera dilakukan perbaikan?</p>',4,'','<p>A. Pressure turun</p>','<p>TB. ebal siram tidak terpenuh</p>','<p>C. Terjadi genangan</p>','<p>D. Semua Benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,29,1),
(117,'<p>Apa tujuan dari pengecekan hasil instalasi Irigasi dengan mengalirkan air?</p>',4,'','<p>A. Untuk mendeteksi kebocoran / kerusakan pipa</p>','<p>B. Memanaskan mesin</p>','<p>C. Membuat laporan</p>','<p>D. Benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,30,1),
(119,'<p>Apakah yang perlu dilakukan terhadap penangan sampah organik dan non organik yang ada di area kerja irigasi?</p>',4,'','<p>A. Dibakar dekat gubuk irigasi</p>','<p>B. Diletakkan di pojok gubuk</p>','<p>C. Ditempatkan pada tempat sampah dan dibuang ke TPA secara berkala</p>','<p>D. Diselipkan pada area yang tidak terlihat</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,31,1),
(121,'<p>Apakah yang perlu dilakukan pada tumpukan kunci, ember, wadah bekas minuman, dan cangkul yang menumpuk pada satu area?</p>',4,'','<p>A. Ditutupi oleh karung</p>','<p>B. Dimasukkan menjadi satu ke dalam sebuah karung</p>','<p>C. Ditempatkan sesuai jenisnya dan dibuang apabila tidak digunakan</p>','<p>D. Dibiarkan saja</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,32,1),
(123,'<p>Hal-hal yang tidak boleh dilakukan pada area irigasi dan berhubungan dengan 5R adalah ..</p>',4,'','<p>A. Makan dan minum</p>','<p>B. Berdiskusi dan Menyusun rencana kerja</p>','<p>C. Memperbaiki kendaraan pribadi</p>','<p>D. Meletakkan kunci kerja di bawah engine</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,33,1),
(125,'<p>Dari beberapa hal yang tidak sesuai dibawah ini, kondisi manakah yang perlu dikerjakan terlebih dahulu?</p>',4,'','<p>A. Sampah berserakan</p>','<p>B. Kabel Listrik yang terkelupas</p>','<p>C. Alat kerja yang berantakan</p>','<p>D. Dokumen kerja yang tidak tersusun</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,34,1),
(128,'<p>Salah satu bentuk penerapan R2 (Rapi) yaitu ..</p>',4,'','<p>A. Menentukan area kerja</p>','<p>B. Menyusun dan menyimpan item/perangkat kerja yang sering digunakan secara aman dan mudah dijangkau</p>','<p>C. Penghijauan di area kerja dan mesin</p>','<p>D. Pengecatan gubuk dan unit secara menyulurh</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,35,1),
(129,'<p>Kenapa tidak boleh mematikan engine pada kondisi RPM tinggi</p>',4,'','<p>A. Menyebabkan kerusakan</p>','<p>B. Pemborosan bahan bakar</p>','<p>C. Pemborosan accu listrik</p>','<p>D. A,b,c benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,36,1),
(130,'<p>Berapa RPM untuk mematikan mesin</p>',4,'','<p>A. 700 &ndash; 900</p>','<p>B. 1000 - 1100</p>','<p>C. 1000 &ndash; 1500</p>','<p>D. A,b,c salah semua</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,37,1),
(132,'<p>Apa yang dilakukan untuk mematikan mesin dalam kondisi darurat</p>',4,'','<p>A. Tekan tombol emergency</p>','<p>B. Lapor mandor</p>','<p>C. Lepas kabel accu / aki</p>','<p>D. Switch kontak</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,38,1),
(133,'<p>Dalam keadaan apa tombol emergency boleh ditekan, kecuali:</p>',4,'','<p>A. Putaran tinggi</p>','<p>B. Insiden / Overheat</p>','<p>C. Overshift</p>','<p>D. Benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,39,1),
(136,'<p>Berapa lama jeda waktu yang diperlukan untuk mematikan engine setelah dilepas kopling</p>',4,'','<p>A. 3 &ndash; 5 menit</p>','<p>B. 10 menit</p>','<p>C. 15 menit</p>','<p>D. 20 menit</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,40,1),
(138,'<p>Bila terjadi selang tersumbat, apa yang dilakukan</p>',4,'','<p>A. Flushing dan diketok pada emiter</p>','<p>B. Order selang baru</p>','<p>C. Dipotong</p>','<p>D. A,b,c benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,41,1),
(139,'<p>Berikut ini beberapa cara menyambung pipa kecuali</p>',4,'','<p>A. Langsung pipa ke pipa</p>','<p>B. Sambungan T</p>','<p>C. Sambungan L</p>','<p>D. Semua salah</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,42,1),
(140,'<p>Material yang digunakan untuk menyambungkan antara pipa pvc yang berbeda ukuran (contoh : 5 inch ke 3 inch) menggunakan</p>',4,'','<p>A. Reducer</p>','<p>B. Lem</p>','<p>C. Baut</p>','<p>D. Bara api</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,43,1),
(141,'<p>Untuk menyambung pipa sub main line ke selang drip (selang lateral) menggunakan</p>',4,'','<p>A. T grow mad (konektor) / Progrip Tape Tee</p>','<p>B. L bow</p>','<p>C. T bow</p>','<p>D. A,b,c benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,44,1),
(142,'<p>Kapan waktu dilakukan pemasangan instalasi irigasi</p>',4,'','<p>A. Sebelum tanam</p>','<p>B. Sebelum bajak</p>','<p>C. Sebelum bongkar</p>','<p>D. A,b,c bisa semua</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,45,1),
(143,'<p>Siapa yang membuat rencana siram</p>',4,'','<p>A. Mandor</p>','<p>B. Kasie</p>','<p>C. Kabag</p>','<p>D. Manager</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,46,1),
(144,'<p>Jika jarak emitter 50, berapa banyak dalam 1 ha</p>',4,'','<p>A. 6666</p>','<p>B. 1111</p>','<p>C. 9999</p>','<p>D. 1339</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,47,1),
(145,'<p>Apa saja hal yang penting diisi pada LHO, kecuali</p>',4,'','<p>A. RPM</p>','<p>B. Kelembaban tanah</p>','<p>C. Flow meter</p>','<p>D. Kecepatan siram</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,48,1),
(146,'<p>Siapa saja yang bertandatangan di form LHO</p>',4,'','<p>A. Mandor dan kasie</p>','<p>B. Kasie kabag</p>','<p>C. Mandor, kasie, kabag</p>','<p>D. Operator, mandor,kasbun</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,49,1),
(147,'<p>Apa yang harus diperhatikan saat overshift</p>',4,'','<p>A. Stok solar</p>','<p>B. Komponen mesin</p>','<p>C. Keadaan air/ stok air</p>','<p>D. Semua Benar</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,50,1),
(148,'<p>Paat Reduser adalah :</p>',6,'','<p>A. Alat untuk Mengecek Oli</p>','<p>B. Alat untuk menyaring Air</p>','<p>C. Alat yang berfungsi untuk menyambungkan dua komponen Pipa yang berbeda</p>','<p>D. Salah semua</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,1,1),
(149,'<p>Pemasangan selang pendingin pada pompa gearbox bertujuan agar :</p>',6,'','<p>A. Sirkulasi angin</p>','<p>B. Sirkulasi oli</p>','<p>C. Pompa tidak overheat</p>','<p>D. Jawaban a ,b ,c Benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,2,1),
(150,'<p>Pemasangan drum pelumas As Pompa Bertujuan untuk :</p>',6,'','<p>A. Menghemat BBM</p>','<p>B. Memperlancar keluarnya air dari pompa</p>','<p>C. Untuk asesoris</p>','<p>D. Melumasi karet spiderbearing</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,3,1),
(151,'<p>Diantara pemasangan reduser dan gearbox sebaiknya di pasang :</p>',6,'','<p>A. Seal karet</p>','<p>B. Seal kit</p>','<p>C. Elbow</p>','<p>D. Benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,4,1),
(152,'<p>Tes pompa irigasi sebaiknya di lakukan minimal...</p>',6,'','<p>A. 2 iam</p>','<p>B. 3 jam</p>','<p>C. 2 menit</p>','<p>D. 15 menit</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,5,1),
(153,'<p>Mengapa sebelum siram, valve harus terbuka?</p>',6,'','<p>A. Agar tak ada kerjaan di pagi hari</p>','<p>B. Semua benar</p>','<p>C. Agar instalasi tidak terjadi kerusakan (jebol) pada irigasi</p>','<p>D. Agar instalasi irigasi sesuai perintah</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,6,1),
(154,'<p>Berapa hari sekali waktu yang di butuhkan untuk siram di tanaman jambu?</p>',6,'','<p>A. 1 hari sekali</p>','<p>B. 2 hari sekali</p>','<p>C. 3 hari sekali</p>','<p>D. 4 hari sekali</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,7,1),
(155,'<p>Berapa ukuran pipa yang digunakan pada instalasi irigasi guava?</p>',6,'','<p>A. 5\" , 3\" , 1\" dan 1/2\"</p>','<p>B. 8\" dan 6\"</p>','<p>C. 7\" dan 4\"</p>','<p>D. Jawaban benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,8,1),
(156,'<p>Agar tidak terjadi kebocoran pada sambungan pipa pvc harus menggunakan?</p>',6,'','<p>A. Lem pipa pvc</p>','<p>B. Lem aibon</p>','<p>C. Lem import</p>','<p>D. Pipa paralon yang sudah di panaskan menggunakan api</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,9,1),
(157,'<p>Berapakah diameter sebaran air menggunakan nozel raindrop pada tanaman jambu?</p>',6,'','<p>A. &plusmn;1 meter</p>','<p>B. &plusmn;2 meter</p>','<p>C. &plusmn;3 meter</p>','<p>D. &plusmn;4 meter</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,10,1),
(158,'<p>Memastikan kembali jumlah pemakai solar adalah termasuk :</p>',6,'','<p>A. Pekerjaan yang sia-sia</p>','<p>B. Bentuk toleransi kerja</p>','<p>C. Melakukan pengecekan hasil kerja&nbsp;</p>','<p>D. Jawaban benar semua</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,11,1),
(159,'<p>Menghitung kembali jumlah jam siram adalah termasuk tindakan pengecekan hasil kerja? apa alasanya?</p>',6,'','<p>A. Ya, agar laporanya akurat</p>','<p>B. Tidak, karena sudah realisasi</p>','<p>C . Tidak, karena bukan pekerjaan kita</p>','<p>D. Mungkin, karena di perintahkan oleh atasan</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,12,1),
(160,'<p>Menghitung jumlah tk untuk kebutuhan oprasional irigasi apakah termasuk pengecekan hasil kerja?</p>',6,'','<p>A. Ya</p>','<p>B. Tidak</p>','<p>C. Mungkin</p>','<p>D. 15</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,13,1),
(161,'<p>Pengecekan Hasil kerja siram irigasi adalah dengan cara:</p>',6,'','<p>A. Bertanya kepada mandor parcela</p>','<p>B. Mengecek ke setiap plot atau lokasi yang sudah di siram</p>','<p>C. Menunggu rencana kerja berikutnya</p>','<p>D. Jawaban tidak ada yang benar</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,14,1),
(162,'<p>Berikut ini adalah tindakan pengecekan hasil kerja, kecuali...</p>',6,'','<p>A. Mengisi solar</p>','<p>B. Mengisi oli enggin</p>','<p>C. Jawaban a dan b benar</p>','<p>D. Mengecek pemakaian solar</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,15,1),
(163,'<p>Sebutkan tahapan persiapan engine?</p>',6,'','<p>A. Pengecekan air radiator, Accu, Vanbelt, dan baut kopel</p>','<p>B. Pengecekan solar, accu, vanbelt, dan baut kopel</p>','<p>C. Pengecekan air radiator, Oli, accu, dan solar</p>','<p>D. Pengecekan vanbelt, baut kopel, oli, dan solar</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,16,1),
(164,'<p>Langkah - langkah mengidupkan engine?</p>',6,'','<p>A.&nbsp;Tombol emergency pada posisi off</p>','<p>B. Tekan tombol emergency</p>','<p>C. Hidupkan engine pada switch starter</p>','<p>D. Hidupkan kontak baterai</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,17,1),
(165,'<p>Berapa RPM yang diperlukan pada saat mengecekan engine?</p>',6,'','<p>A. RPM 400 - 500</p>','<p>B. RPM 400 - 800</p>','<p>C. RPM 500 - 800</p>','<p>D. RPM 500 - 900</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,18,1),
(166,'<p>&nbsp;Apa tujuan pelumasan ash pompa?</p>',6,'','<p>A. Melumasi karet spider bearing agar tidak terbakar</p>','<p>B. Spider bearing tidak lepas</p>','<p>C. Spider bearing berputar</p>','<p>D. Melumasi sumur</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,19,1),
(167,'<p>Alat untuk pengecekan RPM adalah...</p>',6,'','<p>A. Speedometer</p>','<p>B. Termometer</p>','<p>C. Tachometer</p>','<p>D. Barometer</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,20,1),
(168,'<p>Bagaimana mengatasi kebocoran ringan pada pipa irigasi?</p>',6,'','<p>A. Mengganti pipa bocor dengan pipa yang baru</p>','<p>B. Di ikat menggunakan karet</p>','<p>C. Pipa di timbun dengan seresah</p>','<p>D. Semua jawaban salah</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,21,1),
(169,'<p>Apa yang harus kita lakukan jika ada pipa yang retak atau rusak parah?</p>',6,'','<p>A. Mengganti pipa yang retak parah</p>','<p>B. Di ikat menggunakan plastik</p>','<p>C. Di beri lem pipa</p>','<p>D. Jawaban a dan b benar</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,22,1),
(170,'<p>Apa yang di lakukan jika pipa raindrop miring?</p>',6,'','<p>A. Pipa di ikat ke pohon jambu</p>','<p>B. Menacapkan tiang bambu di samping pipa raindrop yang miring lalu pipa dimikat ke bambu tersebut</p>','<p>C. Menyumbat lubang ranidrop agar air tidak keluar</p>','<p>D. Mengganti raindrop lama dengan yang baru</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,23,1),
(171,'<p>Apa yang harus di lakukan jika jalur irigasi raidrop mampet?</p>',6,'','<p>A. Pasang kembali raindrop yang lepas</p>','<p>B. Lepas rain drop ,kemudian pastikan lubang tidak tersumbat dan kemudian pasang kembali</p>','<p>C. Menyumbat lubang raindrop dengan ranting</p>','<p>D. Jawaban a dan b benar</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,24,1),
(172,'<p>Jika pipa mengalami proses tersumbat , apakah yang harus di lakukan?</p>',6,'','<p>A. Menambah RPM Pada enggine agar tekanan air tinggi, sehingga kotoran yang menyumbat pipa bisa keluar</p>','<p>B. Mengganti pipa yang tersumbat dengan pipa yang baru</p>','<p>C. Melakukan flushing pada jalur yang tersumbat</p>','<p>D. Di biarkan saja ,karena lambat laun air pasti mengalir</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,25,1),
(173,'<p>Berikut tahap-tahap mematikan pompa &amp; engine? kecuali&hellip;</p>',6,'','<p>A. Turunkan putaran engine secara perlahan</p>','<p>B. Lepas kompling shaft engine lalu shaft pompa</p>','<p>C. Putar switch starter engine ke posisi of</p>','<p>D. Mencabut starter engine</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,26,1),
(174,'<p>Saat akan mematikan pompa dan engine, berapa standar RPM diperlukan?</p>',6,'','<p>A. 700 - 800 RPM</p>','<p>B. 600 - 800 RPM</p>','<p>C. 500 - 800 RPM</p>','<p>D. 400 - 800 RPM</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,27,1),
(175,'<p>Apa akibatnya jika mesin dimatikan secara mendadak?</p>',6,'','<p>A. Merusak mesin engine dan pompa</p>','<p>B. Geerbox tetap kuat</p>','<p>C. Mesin normal jangka panjang</p>','<p>D. Couple menjadi normal</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,28,1),
(176,'<p>Apa yang harus di lakukan operator jika engine tidak star/tidak mau hidup?</p>',6,'','<p>A. Di biarkan saja</p>','<p>B. Tekan tombol on</p>','<p>C. Aki di cabut</p>','<p>D. Cek dan laporkan ke bagian FS</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,29,1),
(177,'<p>Berapakah waktu yang dibutuhkan setelah shaft kopling dilepas sebelum engine dimatikan?</p>',6,'','<p>A. 2 - 3 menit</p>','<p>B. 3 - 5 menit</p>','<p>C. 4 - 6 menit</p>','<p>D. 5 - 6 menit</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,30,1),
(178,'<p>Apakah yang perlu dilakukan terhadap penangan sampah organik dan non organik yang ada di area kerja irigasi?</p>',6,'','<p>A. Dibakar dekat gubuk irigasi</p>','<p>B. Diletakkan di pojok gubuk</p>','<p>C. Ditempatkan pada tempat sampah dan dibuang ke TPA secara berkala</p>','<p>D. Diselipkan pada area yang tidak terlihat</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,31,1),
(179,'<p>Apakah yang perlu dilakukan pada tumpukan kunci, ember, wadah bekas minuman, dan cangkul yang menumpuk pada satu area?</p>',6,'','<p>A. Ditutupi oleh karung</p>','<p>B. Dimasukkan menjadi satu ke dalam sebuah karung</p>','<p>C. Ditempatkan sesuai jenisnya dan dibuang apabila tidak digunakan</p>','<p>D. Dibiarkan saja</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,32,1),
(180,'<p>Hal-hal yang tidak boleh dilakukan pada area irigasi dan berhubungan dengan 5R adalah...</p>',6,'','<p>A. Makan dan minum</p>','<p>B. Berdiskusi dan Menyusun rencana kerja</p>','<p>C. Memperbaiki kendaraan pribadi</p>','<p>D. Meletakkan kunci kerja di bawah engine</p>','',NULL,NULL,NULL,NULL,NULL,'D',1,33,1),
(181,'<p>Dari beberapa hal yang tidak sesuai dibawah ini, kondisi manakah yang perlu dikerjakan terlebih dahulu?</p>',6,'','<p>A. Sampah berserakan</p>','<p>B. Kabel Listrik yang terkelupas</p>','<p>C. Alat kerja yang berantakan</p>','<p>D. Dokumen kerja yang tidak tersusun</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,34,1),
(182,'<p>Salah satu bentuk penerapan R2 (Rapi) yaitu...</p>',6,'','<p>A. Menentukan area kerja</p>','<p>B. Menyusun dan menyimpan item/perangkat kerja yang sering digunakan secara aman dan mudah dijangkau</p>','<p>C. Penghijauan di area kerja dan mesin</p>','<p>D. Pengecatan gubuk dan unit secara menyulurh</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,35,1),
(183,'<p>Apa yang di lakukan jika rencana kerja tidak sesuai dengan hasil kerja?</p>',6,'','<p>A. Di sesuaikan dengan rencana</p>','<p>B. Melaporkan realisasi kerja yang sesungguhnya</p>','<p>C. Jawaban a dan b benar</p>','<p>D. Semua jawaban benar</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,36,1),
(184,'<p>Bagaimana cara mengetahui HM pada unit irigasi?</p>',6,'','<p>A. Di lihat pada indikator HM</p>','<p>B. Di lihat pada indikator flowmeter</p>','<p>C. Di ukur pakai meteran</p>','<p>D. Di hitung menggunakan kalkulator</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,37,1),
(185,'<p>Apa yang harus Anda lihat untuk mengecek penggunaan air?</p>',6,'','<p>A. Tanki solar</p>','<p>B.&nbsp;Flow meter</p>','<p>C.&nbsp;Hm meter</p>','<p>D.&nbsp;Semua benar</p>','',NULL,NULL,NULL,NULL,NULL,'B',1,38,1),
(186,'<p>Jika saat pengecekan solar awal 170 liter mesin beroperasi selama 5 jam dengan rata-rata 4 liter/jam berapa sisa solar?</p>',6,'','<p>A. 140L</p>','<p>B. 145L</p>','<p>C. 150L</p>','<p>D. 155L</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,39,1),
(187,'<p>Seorang operator irigasi, untuk membuktikan bahwa ia telah bekerja dengan cara?</p>',6,'','<p>A. Mengisi form dengan sejujurnya dan sejelasnya</p>','<p>B. Melaporkan di WA ke atasan</p>','<p>C. Menceritakan ke mandor</p>','<p>D. Meninggalkan area kerja dalam keadaan bersih</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,40,1),
(188,'<p>Apa kerugiaan bagi perusahaan jika dalam bekerja dibidang irigasi terdapat banyak kebocoran pipa, banyak kebuntuan selang seawon, atau flow meter tidak tersedia?</p>',6,'','<p>A. Produktifitas naik</p>','<p>B. Tidak ada kerugian</p>','<p>C. Biaya naik</p>','<p>D. Biaya turun</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,41,1),
(189,'<p>Sebagai seorang operator irigasi, kapan waktu untuk mengecek flow meter?</p>',6,'','<p>A. Tiap jam</p>','<p>B. Sesuai waktu yang sudah ditentukan</p>','<p>C. Tiap menit</p>','<p>D. Tiap istirahat dan selesai kerja</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,42,1),
(190,'<p>Sambungan antara pompa dengan mesin menggunakan alat apa?</p>',6,'','<p>A. Reducer</p>','<p>B. Emiter</p>','<p>C. Valve</p>','<p>D. Kopel</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,43,1),
(191,'<p>Satuan pada flow meter adalah...</p>',6,'','<p>A. HM</p>','<p>B. KM</p>','<p>C. M3</p>','<p>D. Jam</p>','',NULL,NULL,NULL,NULL,NULL,'C',1,44,1),
(192,'<p>Sebagai seorang operator irigasi, siapa yang wajib memeriksa unit irigasi secara berkala :</p>',6,'','<p>A. Operator</p>','<p>B. Field Support</p>','<p>C. Kasie</p>','<p>D. Semua yang terlibat</p>','',NULL,NULL,NULL,NULL,NULL,'A',1,45,1);

/*Table structure for table `quiz_done` */

DROP TABLE IF EXISTS `quiz_done`;

CREATE TABLE `quiz_done` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `member_code` varchar(30) DEFAULT NULL,
  `member_class` text DEFAULT NULL,
  `member_fullname` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `start_time_real` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `check_point` datetime DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `answer_temp` text DEFAULT NULL COMMENT 'fungsinya untuk autosave',
  `schedule_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `quiz_duration` int(11) DEFAULT NULL,
  `quiz_title_id` varchar(255) DEFAULT NULL,
  `quiz_code` varchar(50) DEFAULT NULL,
  `benar` int(11) DEFAULT NULL,
  `salah` int(11) DEFAULT NULL,
  `tidak_jawab` int(11) DEFAULT NULL,
  `score_master` int(11) NOT NULL,
  `kkm` int(11) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `score_complex` decimal(5,2) DEFAULT NULL,
  `score_essay` decimal(5,2) DEFAULT NULL,
  `is_done` int(11) DEFAULT 0,
  `ip_address` varchar(50) DEFAULT NULL,
  `browser_key` text DEFAULT NULL,
  `is_listening` int(11) NOT NULL,
  `acak` text DEFAULT NULL,
  `acak_pilihan` text DEFAULT NULL,
  `custom_score` tinyint(4) DEFAULT NULL,
  `poin_benar` int(11) DEFAULT NULL,
  `poin_salah` int(11) DEFAULT NULL,
  `poin_kosong` int(11) DEFAULT NULL,
  `poin_A` int(11) DEFAULT NULL,
  `poin_B` int(11) DEFAULT NULL,
  `poin_C` int(11) DEFAULT NULL,
  `poin_D` int(11) DEFAULT NULL,
  `poin_E` int(11) DEFAULT NULL,
  `poin_F` int(11) DEFAULT NULL,
  `poin_G` int(11) DEFAULT NULL,
  `poin_H` int(11) DEFAULT NULL,
  `poin_I` int(11) DEFAULT NULL,
  `poin_J` int(11) DEFAULT NULL,
  `ragu` text DEFAULT NULL,
  `bahas_log` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ujian_kunci` (`schedule_id`,`member_id`) USING BTREE,
  UNIQUE KEY `ujian_token_index` (`token`),
  KEY `ujian_quiz_index` (`quiz_id`),
  KEY `ujian_class_index` (`member_class`(200)) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_done` */

/*Table structure for table `quiz_done_arsip` */

DROP TABLE IF EXISTS `quiz_done_arsip`;

CREATE TABLE `quiz_done_arsip` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `member_code` varchar(30) DEFAULT NULL,
  `member_class` text DEFAULT NULL,
  `member_fullname` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `start_time_real` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `check_point` datetime DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `answer_temp` text DEFAULT NULL COMMENT 'fungsinya untuk autosave',
  `schedule_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `quiz_duration` int(11) DEFAULT NULL,
  `quiz_title_id` varchar(255) DEFAULT NULL,
  `quiz_code` varchar(20) DEFAULT NULL,
  `benar` int(11) DEFAULT NULL,
  `salah` int(11) DEFAULT NULL,
  `tidak_jawab` int(11) DEFAULT NULL,
  `score_master` int(11) NOT NULL,
  `kkm` int(11) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `score_essay` decimal(5,2) DEFAULT NULL,
  `is_done` int(11) DEFAULT 0,
  `ip_address` varchar(50) DEFAULT NULL,
  `browser_key` text DEFAULT NULL,
  `is_listening` int(11) NOT NULL,
  `acak` text DEFAULT NULL,
  `acak_pilihan` text DEFAULT NULL,
  `custom_score` tinyint(4) DEFAULT NULL,
  `poin_benar` int(11) DEFAULT NULL,
  `poin_salah` int(11) DEFAULT NULL,
  `poin_kosong` int(11) DEFAULT NULL,
  `poin_A` int(11) DEFAULT NULL,
  `poin_B` int(11) DEFAULT NULL,
  `poin_C` int(11) DEFAULT NULL,
  `poin_D` int(11) DEFAULT NULL,
  `poin_E` int(11) DEFAULT NULL,
  `poin_F` int(11) DEFAULT NULL,
  `poin_G` int(11) DEFAULT NULL,
  `poin_H` int(11) DEFAULT NULL,
  `poin_I` int(11) DEFAULT NULL,
  `poin_J` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ujian_kunci` (`schedule_id`,`member_id`) USING BTREE,
  UNIQUE KEY `ujian_token_index` (`token`),
  KEY `ujian_quiz_index` (`quiz_id`),
  KEY `ujian_class_index` (`member_class`(200)) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_done_arsip` */

/*Table structure for table `quiz_done_complex` */

DROP TABLE IF EXISTS `quiz_done_complex`;

CREATE TABLE `quiz_done_complex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz_done` bigint(11) NOT NULL,
  `answer` text NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `tidak_jawab` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_quiz_done` (`id_quiz_done`),
  CONSTRAINT `quiz_done_complex_ibfk_1` FOREIGN KEY (`id_quiz_done`) REFERENCES `quiz_done` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_done_complex` */

/*Table structure for table `quiz_done_essay` */

DROP TABLE IF EXISTS `quiz_done_essay`;

CREATE TABLE `quiz_done_essay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz_done` bigint(11) NOT NULL,
  `id_quiz_essay` int(11) NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `score_persen` decimal(5,2) NOT NULL,
  `is_done` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_quiz_done_id_quiz_essay` (`id_quiz_done`,`id_quiz_essay`),
  KEY `id_quiz_essay` (`id_quiz_essay`),
  CONSTRAINT `quiz_done_essay_ibfk_1` FOREIGN KEY (`id_quiz_done`) REFERENCES `quiz_done` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_done_essay_ibfk_2` FOREIGN KEY (`id_quiz_essay`) REFERENCES `quiz_essay` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_done_essay` */

/*Table structure for table `quiz_done_history_class` */

DROP TABLE IF EXISTS `quiz_done_history_class`;

CREATE TABLE `quiz_done_history_class` (
  `id_quiz_done` bigint(11) NOT NULL,
  `grade` varchar(30) NOT NULL,
  `class` varchar(50) NOT NULL,
  `tanggal_masuk` varchar(30) NOT NULL,
  `tanggal_selesai` varchar(30) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL,
  KEY `id_quiz_done` (`id_quiz_done`),
  CONSTRAINT `quiz_done_history_class_ibfk_1` FOREIGN KEY (`id_quiz_done`) REFERENCES `quiz_done` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_done_history_class` */

/*Table structure for table `quiz_done_kd` */

DROP TABLE IF EXISTS `quiz_done_kd`;

CREATE TABLE `quiz_done_kd` (
  `id_quiz_done` int(11) NOT NULL,
  `id_quiz_kd` int(11) NOT NULL,
  `nama_kd` varchar(255) NOT NULL,
  `score` decimal(6,2) NOT NULL,
  `score_max` decimal(6,2) NOT NULL,
  `kkm` decimal(6,2) NOT NULL,
  UNIQUE KEY `id_quiz_done_id_quiz_kd` (`id_quiz_done`,`id_quiz_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_done_kd` */

/*Table structure for table `quiz_done_kd_essay` */

DROP TABLE IF EXISTS `quiz_done_kd_essay`;

CREATE TABLE `quiz_done_kd_essay` (
  `id_quiz_done` int(11) NOT NULL,
  `id_quiz_kd` int(11) NOT NULL,
  `nama_kd` varchar(255) NOT NULL,
  `score` decimal(6,2) NOT NULL,
  `score_max` decimal(6,2) NOT NULL,
  `kkm` decimal(6,2) NOT NULL,
  UNIQUE KEY `id_quiz_done_id_quiz_kd` (`id_quiz_done`,`id_quiz_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_done_kd_essay` */

/*Table structure for table `quiz_done_paket` */

DROP TABLE IF EXISTS `quiz_done_paket`;

CREATE TABLE `quiz_done_paket` (
  `quiz_done_id` bigint(11) NOT NULL,
  `pg` text NOT NULL,
  `essay` text NOT NULL,
  `complex` text NOT NULL,
  KEY `quiz_done_id` (`quiz_done_id`),
  CONSTRAINT `quiz_done_paket_ibfk_1` FOREIGN KEY (`quiz_done_id`) REFERENCES `quiz_done` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_done_paket` */

/*Table structure for table `quiz_essay` */

DROP TABLE IF EXISTS `quiz_essay`;

CREATE TABLE `quiz_essay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `A` text DEFAULT NULL,
  `B` text DEFAULT NULL,
  `C` text DEFAULT NULL,
  `D` text DEFAULT NULL,
  `E` text DEFAULT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'alternatif jawaban 1',
  `answer2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'alternatif jawaban 2',
  `answer3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'alternatif jawaban 3',
  `answer4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'alternatif jawaban 4',
  `answer5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'alternatif jawaban 5',
  `point1` decimal(5,2) DEFAULT 100.00 COMMENT 'point untuk alternatif jawaban 1',
  `point2` decimal(5,2) DEFAULT 100.00 COMMENT 'point untuk alternatif jawaban 2',
  `point3` decimal(5,2) DEFAULT 100.00 COMMENT 'point untuk alternatif jawaban 3',
  `point4` decimal(5,2) DEFAULT 100.00 COMMENT 'point untuk alternatif jawaban 4',
  `point5` decimal(5,2) DEFAULT 100.00 COMMENT 'point untuk alternatif jawaban 5',
  `model` int(11) DEFAULT NULL COMMENT '0:vertical;1=horizontal',
  `urutan` int(11) DEFAULT NULL,
  `bobot` int(11) DEFAULT 1 COMMENT 'di pake untuk jenis skor =3',
  PRIMARY KEY (`id`),
  KEY `quiz_detail_index` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_essay` */

/*Table structure for table `quiz_essay_answer` */

DROP TABLE IF EXISTS `quiz_essay_answer`;

CREATE TABLE `quiz_essay_answer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `essay_id` int(11) NOT NULL,
  `done_id` int(11) NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `essay_unik` (`essay_id`,`done_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_essay_answer` */

/*Table structure for table `quiz_grade` */

DROP TABLE IF EXISTS `quiz_grade`;

CREATE TABLE `quiz_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_grade` */

/*Table structure for table `quiz_grade_log` */

DROP TABLE IF EXISTS `quiz_grade_log`;

CREATE TABLE `quiz_grade_log` (
  `member_id` varchar(50) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_grade_log` */

/*Table structure for table `quiz_kd` */

DROP TABLE IF EXISTS `quiz_kd`;

CREATE TABLE `quiz_kd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `id_competency` int(11) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `nomor_soal` varchar(255) NOT NULL COMMENT 'PILIHAN GANDA',
  `nomor_soal_essay` varchar(255) NOT NULL COMMENT 'ESSAY',
  `score_max` varchar(255) NOT NULL,
  `kkm` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_kd` */

insert  into `quiz_kd`(`id`,`quiz_id`,`id_competency`,`title_id`,`nomor_soal`,`nomor_soal_essay`,`score_max`,`kkm`,`urutan`,`created_by`,`created_date`) values 
(1,2,0,'kom1','1','','100',90,0,240,'2025-01-10 08:25:48'),
(2,2,0,'kom2','2','','100',90,0,240,'2025-01-10 08:25:59'),
(3,3,0,'Set-up Engine dan Pompa Sumber Air','1,2,3,4,5','','100',0,0,240,'2025-03-19 09:38:52'),
(4,3,0,'Instalasi Pipa Irigasi','6,7,8,9,10','','100',0,0,240,'2025-03-19 09:42:07'),
(5,3,0,'Instalasi Irigator dan Gun Sprinkler','11,12,13,14,15','','100',0,0,240,'2025-03-19 09:42:55'),
(6,3,0,'Mengoperasikan Engine dan Pompa Irigasi','16,17,18,19,20','','100',0,0,240,'2025-03-19 09:43:22'),
(7,3,0,'Mengoperasikan Unit Irrigator dan Gun Sprinkle','21,22,23,24,25','','100',0,0,240,'2025-03-19 09:43:57'),
(8,3,0,'Melakukan Pengecekan Hasil Kerja Secara Berkala','26,27,28,29,30','','100',0,0,240,'2025-03-19 09:44:27'),
(9,3,0,'Melakukan 5R pada Peralatan dan Engine Irigasi','31,32,33,34,35','','100',0,0,240,'2025-03-19 09:44:46'),
(10,3,0,'Mematikan Pompa  Engine','36,37,38,39,40','','100',0,0,240,'2025-03-19 09:45:04'),
(11,3,0,'Troubleshooting','41,42,43,44,45','','100',0,0,240,'2025-03-19 09:45:21'),
(12,3,0,'Laporan HasilKerjaIrigasi','46,47,48,49,50','','100',0,0,240,'2025-03-19 09:45:39'),
(15,5,0,'Set-up Engine dan Pompa Sumber Air','','','100',0,0,240,'2025-03-19 11:48:12'),
(16,5,0,'Set-up Engine dan Pompa Sumber Air','','','100',0,0,240,'2025-03-19 11:48:34'),
(17,5,0,'Instalasi Pipa Irigasi','','','100',0,0,240,'2025-03-19 11:49:57'),
(18,5,0,'Instalasi Irigator dan Gun Sprinkler','','','100',0,0,240,'2025-03-19 11:51:08'),
(19,5,0,'Mengoperasikan Engine dan Pompa Irigasi','','','100',0,0,240,'2025-03-19 11:51:29'),
(20,5,0,'Mengoperasikan Unit Irrigator dan Gun Sprinkle','','','100',0,0,240,'2025-03-19 11:51:44'),
(21,5,0,'Melakukan Pengecekan Hasil Kerja Secara Berkala','','','100',0,0,240,'2025-03-19 11:51:58'),
(22,5,0,'Melakukan 5R pada Peralatan dan Engine Irigasi','','','100',0,0,240,'2025-03-19 11:52:13'),
(23,5,0,'Mematikan Pompa  Engine','','','100',0,0,240,'2025-03-19 11:52:27'),
(24,5,0,'Troubleshooting','','','100',0,0,240,'2025-03-19 11:52:44'),
(25,5,0,'10. Laporan HasilKerjaIrigasi','','','100',0,0,240,'2025-03-19 11:52:58'),
(26,4,0,'Set-up Engine dan Pompa Sumber Air','1,2,3,4,5','','100',0,0,240,'2025-03-19 11:58:59'),
(27,4,0,'Instalasi Pipa Irigasi','6,7,8,9,10','','100',0,0,240,'2025-03-19 11:59:50'),
(28,4,0,'Intalasi Irigator dan Gun Sprinkler','11,12,13,14,15','','100',0,0,240,'2025-03-19 12:01:04'),
(29,4,0,'Mengoprasikan Engine dan Pompa Irigasi','16,17,18,19,20','','100',0,0,240,'2025-03-19 12:01:47'),
(30,4,0,'Mengoprasikan Unit Irrigator Gun Sprinkle','21,22,23,24,25','','100',0,0,240,'2025-03-19 12:03:28'),
(31,4,0,'Melakukan Pengecekan Hasil Kerja Secara Berkala','26,27,28,29,30','','100',0,0,240,'2025-03-19 12:04:08'),
(32,4,0,'Melakukan 5R pada Peralatan dan Engine Irigasi','31,32,33,34,35','','100',0,0,240,'2025-03-19 12:04:35'),
(34,4,0,'Mematikan Pompa dan Engine','36,37,38,39,40','','100',0,0,240,'2025-03-19 12:06:29'),
(35,4,0,'Troubleshooting','41,42,43,44,45','','100',0,0,240,'2025-03-19 12:07:21'),
(36,4,0,'Laporan Hasil Kerja Irigasi','46,47,48,49,50','','100',0,0,240,'2025-03-19 12:08:41'),
(37,6,0,'Set-up Engine dan Pompa Sumber Air','1,2,3,4,5','','100',0,0,240,'2025-03-19 14:10:56'),
(38,6,0,'Instalasi Pipa Irigasi','6,7,8,9,10','','100',0,0,240,'2025-03-19 14:11:21'),
(39,6,0,'Instalasi Irigator dan Gun Sprinkler','11,12,13,14,15','','100',0,0,240,'2025-03-19 14:11:47'),
(40,6,0,'Mengoperasikan Engine dan Pompa Irigasi','16,17,18,19,20','','100',0,0,240,'2025-03-19 14:12:16'),
(41,6,0,'Mengoperasikan Unit Irrigator dan Gun Sprinkle','21,22,23,24,25','','100',0,0,240,'2025-03-19 14:12:44'),
(42,6,0,'Melakukan Pengecekan Hasil Kerja Secara Berkala','26,27,28,29,30','','100',0,0,240,'2025-03-19 14:13:16'),
(43,6,0,'Melakukan 5R pada Peralatan dan Engine Irigasi','31,32,33,34,35','','100',0,0,240,'2025-03-19 14:13:42'),
(44,6,0,'Mematikan Pompa  Engine','36,37,38,39,40','','100',0,0,240,'2025-03-19 14:14:25'),
(45,6,0,'Troubleshooting','41,42,43,44,45','','100',0,0,240,'2025-03-19 14:14:56');

/*Table structure for table `quiz_master` */

DROP TABLE IF EXISTS `quiz_master`;

CREATE TABLE `quiz_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(50) NOT NULL,
  `id_sylabus` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `title_id` varchar(255) DEFAULT NULL,
  `content_id` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `kkm` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `score_essay` int(11) DEFAULT NULL,
  `is_random` tinyint(11) DEFAULT NULL,
  `is_random_option` int(11) DEFAULT NULL,
  `is_listening` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `uniqid` varchar(30) NOT NULL,
  `point_global` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `custom_score` int(11) DEFAULT NULL,
  `pg_total` int(11) DEFAULT NULL COMMENT 'jumlah soal pg',
  `pg_total_komplek` int(11) DEFAULT NULL COMMENT 'jumla soal pilihan komplek',
  `essay_total` int(11) DEFAULT NULL COMMENT 'jumlah soal essay',
  `poin_benar` int(11) DEFAULT NULL,
  `poin_salah` int(11) DEFAULT NULL,
  `poin_kosong` int(11) DEFAULT NULL,
  `poin_A` float(5,2) DEFAULT NULL,
  `poin_B` float(5,2) DEFAULT NULL,
  `poin_C` float(5,2) DEFAULT NULL,
  `poin_D` float(5,2) DEFAULT NULL,
  `poin_E` float(5,2) DEFAULT NULL,
  `poin_F` float(5,2) DEFAULT NULL,
  `poin_G` float(5,2) DEFAULT NULL,
  `poin_H` float(5,2) DEFAULT NULL,
  `poin_I` float(5,2) DEFAULT NULL,
  `poin_J` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_master_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_master` */

insert  into `quiz_master`(`id`,`grade`,`id_sylabus`,`cat_id`,`tanggal`,`status`,`code`,`title_id`,`content_id`,`keterangan`,`duration`,`kkm`,`score`,`score_essay`,`is_random`,`is_random_option`,`is_listening`,`urutan`,`uniqid`,`point_global`,`created_by`,`created_date`,`modified_by`,`modified_date`,`custom_score`,`pg_total`,`pg_total_komplek`,`essay_total`,`poin_benar`,`poin_salah`,`poin_kosong`,`poin_A`,`poin_B`,`poin_C`,`poin_D`,`poin_E`,`poin_F`,`poin_G`,`poin_H`,`poin_I`,`poin_J`) values 
(3,'',0,0,NULL,NULL,'Pineapple-Irrigation','Pineapple Irrigation',NULL,'',90,70,100,0,0,0,NULL,NULL,'',NULL,240,'2025-03-19 09:23:09',240,'2025-03-19 12:09:10',3,0,NULL,0,NULL,NULL,NULL,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL),
(4,'',0,0,NULL,NULL,'Banana-Irrigation','Banana Irrigation',NULL,'',90,70,100,0,1,1,NULL,NULL,'',NULL,240,'2025-03-19 09:33:04',NULL,NULL,3,0,NULL,0,NULL,NULL,NULL,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL),
(6,'',0,0,NULL,NULL,'Guava-Irrigation','Guava Irrigation',NULL,'',90,70,100,0,1,1,NULL,NULL,'',NULL,240,'2025-03-19 09:34:32',240,'2025-03-19 11:59:13',3,0,NULL,0,NULL,NULL,NULL,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `quiz_master_access` */

DROP TABLE IF EXISTS `quiz_master_access`;

CREATE TABLE `quiz_master_access` (
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_master_access` */

/*Table structure for table `quiz_member` */

DROP TABLE IF EXISTS `quiz_member`;

CREATE TABLE `quiz_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `class` text NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `lastmodify` datetime NOT NULL,
  `password` varchar(100) NOT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `tanggal_masuk` varchar(50) DEFAULT NULL,
  `tanggal_selesai` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `request_reset` datetime DEFAULT NULL,
  `kode_reset` varchar(100) DEFAULT NULL,
  `reset_from` varchar(10) NOT NULL COMMENT 'apps,web',
  `paket` varchar(200) DEFAULT NULL,
  `asal_instansi` varchar(200) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(200) NOT NULL,
  `picture_name` varchar(255) DEFAULT NULL,
  `picture_url` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `telp` varchar(30) NOT NULL,
  `wa` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `level` int(11) NOT NULL COMMENT '0=default,1=pengawas',
  `organization_unit_code` varchar(50) NOT NULL,
  `organization_unit` varchar(50) NOT NULL,
  `position_code` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `direct_supervisor_indeks` varchar(50) NOT NULL,
  `direct_supervisor_name` varchar(100) NOT NULL,
  `2nd_supervisor_indeks` varchar(100) NOT NULL,
  `2nd_supervisor_name` varchar(100) NOT NULL,
  `manager_indeks` varchar(50) NOT NULL,
  `manager_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_member` */

insert  into `quiz_member`(`id`,`username`,`class`,`jurusan`,`ruang`,`fullname`,`status`,`lastmodify`,`password`,`grade`,`tanggal_masuk`,`tanggal_selesai`,`email`,`request_reset`,`kode_reset`,`reset_from`,`paket`,`asal_instansi`,`alamat`,`foto`,`picture_name`,`picture_url`,`token`,`telp`,`wa`,`created_date`,`level`,`organization_unit_code`,`organization_unit`,`position_code`,`position`,`direct_supervisor_indeks`,`direct_supervisor_name`,`2nd_supervisor_indeks`,`2nd_supervisor_name`,`manager_indeks`,`manager_name`) values 
(37,'1001','Production','','','Alex Ruddin',1,'2025-03-19 13:17:40','dc6b4efaed07b43eff195c43ad917221','',NULL,NULL,'ggf.learningcenter@gg-foods.com',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','f68371b2b3026cab77f5ba3f248926b4','','','0000-00-00 00:00:00',1,'Production','Production','293883','Pelaksana Irigasi','100013393','Alex','100013392','roedi','100013394','Alcase'),
(33,'1807212007790002','EstatePG4','','','Suparto',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','3','Tenaga Harian Banana','3141075','Ali Akbar','3980592','Sumarno','3940219','Suharsono'),
(34,'1807010303860001','EstatePG4','','','Alamsyah Udin',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','3','Tenaga Harian Banana','3141084','Asnuri','3980592','Sumarno','3940219','Suharsono'),
(35,'1807210301810001','EstatePG4','','','Sudoko',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','3','Tenaga Harian Banana','3141084','Asnuri','3980592','Sumarno','3940219','Suharsono'),
(36,'1807212406860002','EstatePG4','','','Suparman',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','3','Tenaga Harian Banana','3141084','Asnuri','3980592','Sumarno','3940219','Suharsono'),
(32,'1807013110570001','EstatePG4','','','Sunarto',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','3','Tenaga Harian Banana','3141075','Ali Akbar','3980592','Sumarno','3940219','Suharsono'),
(31,'1807211012750008','EstatePG4','','','Sunarto',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','3','Tenaga Harian Banana','3141075','Ali Akbar','3980592','Sumarno','3940219','Suharsono'),
(30,'1807210612700001','EstatePG4','','','Saiful Anwar',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','3','Tenaga Harian Banana','3141075','Ali Akbar','3980592','Sumarno','3940219','Suharsono'),
(28,'1807211410890002','EstatePG4','','','Kabul Budiawan',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','2','Tenaga Harian Fresh Pineapple','3141070','Akhmad Rosidin','3130947','Fadil Murda Kesuma','3060846','Guntur Widya Nugraha'),
(29,'1807011708620005','EstatePG4','','','Dumyati',1,'2025-03-19 12:14:03','44c04974e6424a1809eb00dd4992a5e8',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','3','Tenaga Harian Banana','3141075','Ali Akbar','3980592','Sumarno','3940219','Suharsono'),
(27,'1807210206940003','Estate PG4','','','David Andi S',1,'2025-03-20 11:51:58','dc6b4efaed07b43eff195c43ad917221','',NULL,NULL,'',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','c020aceb57620ac08268fbb01718ae98','','','0000-00-00 00:00:00',0,'EstatePG4','Estate PG4','2','Tenaga Harian Fresh Pineapple','3141070','Akhmad Rosidin','3130947','Fadil Murda Kesuma','3060846','Guntur Widya Nugraha'),
(38,'10014151','IT','','','Dedi Efendi',1,'2025-03-20 10:36:07','7e03245919786ca33b76238331fc4852','',NULL,NULL,'dedi.efendi@gg-foods.com',NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','37628d44f42f3fce2013d28c823d0baa','','','0000-00-00 00:00:00',1,'IT','IT','IT','IT','','','','','','');

/*Table structure for table `quiz_online` */

DROP TABLE IF EXISTS `quiz_online`;

CREATE TABLE `quiz_online` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `member_code` varchar(30) DEFAULT NULL,
  `member_class` text DEFAULT NULL,
  `member_fullname` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `start_time_real` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `check_point` datetime DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `answer_temp` text DEFAULT NULL COMMENT 'fungsinya untuk autosave',
  `schedule_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `quiz_duration` int(11) DEFAULT NULL,
  `quiz_title_id` varchar(255) DEFAULT NULL,
  `quiz_code` varchar(20) DEFAULT NULL,
  `benar` int(11) DEFAULT NULL,
  `salah` int(11) DEFAULT NULL,
  `tidak_jawab` int(11) DEFAULT NULL,
  `score_master` int(11) NOT NULL,
  `kkm` int(11) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `is_done` int(11) DEFAULT 0,
  `ip_address` varchar(50) DEFAULT NULL,
  `browser_key` text DEFAULT NULL,
  `acak` text DEFAULT NULL,
  `acak_pilihan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ujian_kunci` (`schedule_id`,`member_id`) USING BTREE,
  KEY `ujian_token_index` (`token`),
  KEY `ujian_quiz_index` (`quiz_id`),
  KEY `ujian_class_index` (`member_class`(200)) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_online` */

/*Table structure for table `quiz_pembahasan_pg` */

DROP TABLE IF EXISTS `quiz_pembahasan_pg`;

CREATE TABLE `quiz_pembahasan_pg` (
  `quiz_detail_id` int(11) NOT NULL,
  `pembahasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`quiz_detail_id`),
  CONSTRAINT `quiz_pembahasan_pg_ibfk_1` FOREIGN KEY (`quiz_detail_id`) REFERENCES `quiz_detail` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_pembahasan_pg` */

insert  into `quiz_pembahasan_pg`(`quiz_detail_id`,`pembahasan`) values 
(3,''),
(4,''),
(5,''),
(6,''),
(7,''),
(8,''),
(9,''),
(10,''),
(11,''),
(12,''),
(13,''),
(14,''),
(15,''),
(16,''),
(17,''),
(18,''),
(19,''),
(20,''),
(21,''),
(22,''),
(23,''),
(24,''),
(25,''),
(26,''),
(27,''),
(28,''),
(29,''),
(30,''),
(31,''),
(32,''),
(33,''),
(34,''),
(35,''),
(36,''),
(37,''),
(38,''),
(39,''),
(40,''),
(41,''),
(42,''),
(43,''),
(44,''),
(45,''),
(46,''),
(47,''),
(48,''),
(49,''),
(50,''),
(51,''),
(52,''),
(53,''),
(54,''),
(55,''),
(56,''),
(58,''),
(60,''),
(63,''),
(66,''),
(69,''),
(71,''),
(74,''),
(76,''),
(78,''),
(80,''),
(83,''),
(84,''),
(86,''),
(88,''),
(91,''),
(93,''),
(95,''),
(97,''),
(99,''),
(101,''),
(104,''),
(106,''),
(110,''),
(113,''),
(114,''),
(117,''),
(119,''),
(121,''),
(123,''),
(125,''),
(128,''),
(129,''),
(130,''),
(132,''),
(133,''),
(136,''),
(138,''),
(139,''),
(140,''),
(141,''),
(142,''),
(143,''),
(144,''),
(145,''),
(146,''),
(147,''),
(148,''),
(149,''),
(150,''),
(151,''),
(152,''),
(153,''),
(154,''),
(155,''),
(156,''),
(157,''),
(158,''),
(159,''),
(160,''),
(161,''),
(162,''),
(163,''),
(164,''),
(165,''),
(166,''),
(167,''),
(168,''),
(169,''),
(170,''),
(171,''),
(172,''),
(173,''),
(174,''),
(175,''),
(176,''),
(177,''),
(178,''),
(179,''),
(180,''),
(181,''),
(182,''),
(183,''),
(184,''),
(185,''),
(186,''),
(187,''),
(188,''),
(189,''),
(190,''),
(191,''),
(192,'');

/*Table structure for table `quiz_recent_updates` */

DROP TABLE IF EXISTS `quiz_recent_updates`;

CREATE TABLE `quiz_recent_updates` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `modul` varchar(50) NOT NULL,
  `oleh` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_recent_updates` */

/*Table structure for table `quiz_schedule` */

DROP TABLE IF EXISTS `quiz_schedule`;

CREATE TABLE `quiz_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(50) NOT NULL,
  `custom_title` varchar(255) NOT NULL,
  `is_custom` int(11) NOT NULL,
  `token` varchar(15) NOT NULL,
  `tryout_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_info` text NOT NULL,
  `allow_class` text DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `tanggal_expired` datetime DEFAULT NULL,
  `is_late` int(11) DEFAULT NULL,
  `max_late` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `jenis_ujian` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_schedule` */

/*Table structure for table `quiz_schedule_arsip` */

DROP TABLE IF EXISTS `quiz_schedule_arsip`;

CREATE TABLE `quiz_schedule_arsip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(50) NOT NULL,
  `token` varchar(15) NOT NULL,
  `tryout_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_info` text NOT NULL,
  `allow_class` text DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `tanggal_expired` datetime DEFAULT NULL,
  `is_late` int(11) DEFAULT NULL,
  `max_late` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_schedule_arsip` */

/*Table structure for table `quiz_schedule_member` */

DROP TABLE IF EXISTS `quiz_schedule_member`;

CREATE TABLE `quiz_schedule_member` (
  `schedule_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`schedule_id`,`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_schedule_member` */

/*Table structure for table `quiz_short_answer` */

DROP TABLE IF EXISTS `quiz_short_answer`;

CREATE TABLE `quiz_short_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `A` text DEFAULT NULL,
  `B` text DEFAULT NULL,
  `C` text DEFAULT NULL,
  `D` text DEFAULT NULL,
  `E` text DEFAULT NULL,
  `answer` varchar(5) DEFAULT NULL,
  `model` int(11) DEFAULT NULL COMMENT '0:vertical;1=horizontal',
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_detail_index` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_short_answer` */

/*Table structure for table `quiz_tryout` */

DROP TABLE IF EXISTS `quiz_tryout`;

CREATE TABLE `quiz_tryout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `uniqid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_tryout` */

/*Table structure for table `quiz_wali_kelas` */

DROP TABLE IF EXISTS `quiz_wali_kelas`;

CREATE TABLE `quiz_wali_kelas` (
  `id_user` int(11) NOT NULL,
  `class` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`class`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `quiz_wali_kelas` */

/*Table structure for table `schedule` */

DROP TABLE IF EXISTS `schedule`;

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `team1` int(11) NOT NULL,
  `team2` int(11) NOT NULL,
  `win` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `url` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `schedule` */

/*Table structure for table `school_teacher` */

DROP TABLE IF EXISTS `school_teacher`;

CREATE TABLE `school_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `summary_id` text NOT NULL,
  `summary_en` text NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `school_teacher` */

insert  into `school_teacher`(`id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`summary_id`,`summary_en`,`pekerjaan`,`tanggal`,`url_id`,`url_en`,`urutan`,`publish`) values 
(1,'HOSRI-1-584f84612ca25.jpg','Hosri, S.Pd','Orang yang takut untuk bertanya, malu untuk belajar','','','','','Kepala Sekolah','2016-12-13','hosri-s.pd','',0,0),
(58,'guru8-5852049b10155.jpeg','Nama Guru 8','Belajar adalah pengalaman. Sedangkan yang lainnya hanyalah informasi','','','','','Guru','2016-12-15','nama-guru-8','',0,0),
(57,'guru7-5852047caaff6.jpeg','Nama Guru 7','Hidup adalah tentang belajar. Jika anda berhenti, maka anda MATI','','','','','Guru','2016-12-15','nama-guru-7','',0,0),
(56,'guru6-5852045beb804.jpeg','Nama Guru 6','Kesalahan adalah batu loncatan untuk belajar lebih baik lagi','','','','','Guru','2016-12-15','nama-guru-6','',0,0),
(55,'guru5-5852043a350dd.jpeg','Nama Guru 5','Pertama, mereka menyepelekanmu. Kedua, mereka menertawakanmu. Ketiga, mereka menantangmu. Akhirnya kamu lah yang menang','','','','','Guru','2016-12-15','nama-guru-5','',0,0),
(54,'guru4-585203fa41d54.jpeg','Nama Guru 4','Terkadang kamu menang, terkadang kamu harus belajar untuk menang','','','','','Guru','2016-12-15','nama-guru-4','',0,0),
(53,'guru3-585203b49be00.jpeg','Nama Guru 3','Kita belajar dari kegagalan bukan dari kesuksesan','','','','','Guru','2016-12-15','nama-guru-3','',0,0),
(52,'guru2-58520399bc3c1.jpeg','Nama Guru 2','Anda akan belajar sesuatu yang baru setiap saat, jika saja anda memperhatikannya','','','','','Guru','2016-12-15','nama-guru-2','',0,0),
(51,'guru1-5852036332bca.jpeg','Nama Guru 1','Sebelum anda memulai segala sesuatu, Belajarlah!','','','','','Wakil Kepala Sekolah','2016-12-15','nama-guru-1','',0,0);

/*Table structure for table `service` */

DROP TABLE IF EXISTS `service`;

CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `tagline_id` varchar(255) NOT NULL,
  `tagline_en` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `summary_id` text NOT NULL,
  `summary_en` text NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `service` */

insert  into `service`(`id`,`thumbnail`,`title_id`,`tagline_id`,`tagline_en`,`content_id`,`title_en`,`content_en`,`summary_id`,`summary_en`,`tanggal`,`url_id`,`url_en`,`urutan`,`publish`) values 
(3,'Training-Program-1-HSEQ-53b9321dd698a.jpg','HSEQ','Occupational Health, Safety, Environment and Quality','Occupational Health, Safety, Environment and Quality','<p>Aenean lacinia bibendum nulla sed leo posuere erat a ante venenatis dapibus posuere velit aliquet.</p>\r\n<p>Donec ullamcorper metus auctor fringi. Nullam quis risus eget.</p>\r\n<p>Vestibulum id ligula porta euismod semper. Maecenas faucibus mollis. indonesia</p>','HSEQ','<p>Aenean lacinia bibendum nulla sed leo posuere erat a ante venenatis dapibus posuere velit aliquet.</p>\r\n<p>Donec ullamcorper metus auctor fringi. Nullam quis risus eget.</p>\r\n<p>Vestibulum id ligula porta euismod semper. Maecenas faucibus mollis. english</p>','','','2014-05-15','hseq','hseq',3,1),
(5,'2014-06-08 101050-53cfcff98d13c.jpg','IPD','Indosafe People Development','Indosafe People Development','<p>Ada banyak variasi tulisan Lorem Ipsum yang tersedia, tapi kebanyakan sudah mengalami perubahan bentuk, entah karena unsur humor atau kalimat yang diacak hingga nampak sangat tidak masuk akal. Jika anda ingin menggunakan tulisan Lorem Ipsum EKERE EKERE</p>','IPD','<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum EKRERE</p>','<p>lorem ipsum SADFA SKDHJFALDH FAL SF</p>','<p>lorem ipsum ASDFASDFASDF</p>','2014-07-06','ipd','ipd',0,1),
(6,'Training-Program-IDD-53b93b620d544.jpg','IDD','Indosafe Defensive Driving','Indosafe Defensive Driving','<p>anda harus yakin tidak ada bagian yang memalukan yang tersembunyi di tengah naskah tersebut. Semua generator Lorem Ipsum di internet cenderung untuk mengulang bagian-bagian tertentu. Karena itu inilah generator pertama yang sebenarnya di internet</p>','IDD','<p>you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary,</p>','','','2014-07-06','idd','idd',0,1);

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `services` */

insert  into `services`(`id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`tanggal`,`url_id`,`url_en`,`urutan`) values 
(18,'services2-555bc78340fff.png','Produktif','Peserta didik dipersiapkan menjadi pribadi yang produktif dan mampu bersaing','member 6','','2014-07-02','produktif','member-6',5),
(17,'services3-555bc79b53287.png','Kompeten','Terwujudnya peningkatan kompetensi siswa dalam menghadapi IPTEK secara global.\r\n\r\n','member 5','','2014-07-02','kompeten','member-5',4),
(15,'services1-555bc773db1ac-5566533b761e2.png','Adaptasi','Peserta didik mampu mengembangkan diri dan diterima dalam lingkungan masyarakat.','member 3','','2014-07-02','adaptasi','member-3',6),
(19,'services4-555bc7aa3edf1-5566517929ef2.png','Ahlak Mulia','Terwujudnya peserta didik SMK PGRI 1 Bangkalan berbudi pekerti berahlak pada setiap pelajaran.','','','2015-05-28','ahlak-mulia','',2),
(20,'Screenshot from 2021-04-23 06-19-23-6084c4005a333.png','Cerdas','Terwujudnya peserta didik yang maju dalam Ilmu Pengetahuan dan Teknologi berdasarkan Iman dan Taqwa\r\n','','','2015-05-28','cerdas','',1),
(21,'services6-555bc7d65cd43-556651a19d1db.png','Kreatif','Peserta didik mampu mengembangkan kemampuannya untuk menciptakan sebuah produk maupun layanan','','','2015-05-28','kreatif','',3);

/*Table structure for table `shop_order` */

DROP TABLE IF EXISTS `shop_order`;

CREATE TABLE `shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `transaksi_tgl` datetime NOT NULL,
  `update_tgl` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=done',
  `payment` int(11) NOT NULL COMMENT '0=transfer',
  `ongkir` int(11) NOT NULL,
  `resi` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(20) NOT NULL,
  `hp1` varchar(20) NOT NULL,
  `country` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `neighbourhood` int(11) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `voucher_kode` varchar(20) NOT NULL,
  `total_kotor` decimal(13,2) NOT NULL,
  `voucher_nominal` decimal(13,2) NOT NULL,
  `total` int(11) NOT NULL,
  `uniqid` varchar(20) NOT NULL,
  `nomor_order` varchar(20) NOT NULL,
  `kurir_nama` varchar(255) NOT NULL,
  `kurir_resi` varchar(100) NOT NULL,
  `kurir_berat` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `shop_order` */

insert  into `shop_order`(`id`,`id_member`,`transaksi_tgl`,`update_tgl`,`status`,`payment`,`ongkir`,`resi`,`fullname`,`email`,`alamat`,`hp`,`hp1`,`country`,`region`,`neighbourhood`,`kodepos`,`voucher_kode`,`total_kotor`,`voucher_nominal`,`total`,`uniqid`,`nomor_order`,`kurir_nama`,`kurir_resi`,`kurir_berat`) values 
(2,1,'2015-11-09 21:52:30','0000-00-00 00:00:00',0,0,0,'','Romli','','Jl Kusuma','08179388230','081773737373',17,305,1138,0,'',0.00,0.00,0,'5640b32e49c9f','5640b32e49c9f','','',100.99),
(3,1,'2015-11-09 22:01:59','0000-00-00 00:00:00',0,0,0,'','Romli','','Jl Kusuma','08179388230','081773737373',17,305,1138,0,'',0.00,0.00,0,'5640b567aefdb','5640b567aefdb','','',0.00),
(4,1,'2015-11-09 22:02:19','0000-00-00 00:00:00',0,0,0,'','Romli','','Jl Kusuma','08179388230','081773737373',17,305,1138,0,'',0.00,0.00,0,'5640b57b4e046','5640b57b4e046','','',0.00),
(5,1,'2015-11-10 05:23:52','0000-00-00 00:00:00',0,0,1500,'','Romli','','Jl Kusuma','08179388230','081773737373',17,305,1138,0,'',0.00,0.00,50000,'1-56411cf83f787','1-56411cf83f787','Tiki','',2.00),
(6,1,'2015-11-10 05:56:23','0000-00-00 00:00:00',0,0,1000,'','Romli','','Jl Kusuma','08179388230','081773737373',17,305,1138,0,'',0.00,0.00,0,'1-564124977b9f6','1-564124977b9f6','TIKI','',1.00),
(10,1,'2015-11-12 04:35:01','0000-00-00 00:00:00',0,0,2500,'','Muhammad Romli','','Jl Kusuma','08179388230','081773737373',17,305,1138,0,'',0.00,0.00,900012,'1-5643b485852d7','1447277701','Tiki','',1.00),
(11,1,'2015-12-06 21:45:44','0000-00-00 00:00:00',0,0,0,'','Muhammad Romli','','Jl kusuma bangsa no 194 burneh Bangkalan','08179388230','081773737373',17,305,1138,0,'',0.00,0.00,900012,'1-56644a18c6ce4','1449413144','','',0.00),
(12,1,'2015-12-10 19:25:28','0000-00-00 00:00:00',1,0,8000,'','Muhammad Romli','','Jl kusuma bangsa no 198 burneh Bangkalan','08179388230','081773737373',17,305,1138,0,'DES',300000.00,5000.00,295000,'1-56696f3817cfc','1449750328','TIKI REG','MKV',3.00),
(13,1,'2015-12-11 13:19:16','0000-00-00 00:00:00',0,0,0,'','Muhammad Romli','','Jl kusuma bangsa no 198 burneh Bangkalan','08179388230','081773737373',17,305,1138,0,'JONO',300000.00,20000.00,280000,'1-566a6ae4b635a','1449814756','','',0.00),
(14,1,'2017-02-11 22:36:38','0000-00-00 00:00:00',0,0,0,'','Muhammad Romli','','Jl kusuma bangsa no 198 burneh Bangkalan','08179388230','081773737373',17,305,1138,0,'',6000000.00,0.00,6000000,'1-589f2f8601b25','1486827398','TIKI','',0.00),
(15,1,'2017-02-11 22:41:55','0000-00-00 00:00:00',0,0,0,'','Muhammad Romli','','Jl kusuma bangsa no 198 burneh Bangkalan','08179388230','081773737373',17,305,1138,0,'FEBRUARI',12000000.00,1000000.00,11000000,'1-589f30c3c1411','1486827715','','',0.00);

/*Table structure for table `shop_order_detail` */

DROP TABLE IF EXISTS `shop_order_detail`;

CREATE TABLE `shop_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop` int(11) NOT NULL,
  `id_catalog` int(11) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_shop_detail` (`id_shop`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `shop_order_detail` */

insert  into `shop_order_detail`(`id`,`id_shop`,`id_catalog`,`title_id`,`qty`,`harga_jual`,`status`) values 
(1,3,2,'0',3,25000,0),
(2,3,10,'0',3,150001,0),
(3,4,2,'kario no tola',3,25000,0),
(4,4,10,'daria badras',3,150001,0),
(5,5,2,'kario no tola',3,25000,0),
(6,5,6,'Bio ovischi moro',2,15000,0),
(7,6,2,'kario no tola',3,25000,0),
(8,6,6,'Bio ovischi moro',2,15000,0),
(15,10,17,'daiate psiange',2,150002,0),
(16,10,30,'night city',6,60002,0),
(17,11,17,'daiate psiange',2,150002,0),
(18,11,30,'night city',6,60002,0),
(19,12,3,'badon mal pis',2,150000,0),
(20,13,3,'badon mal pis',2,150000,0);

/*Table structure for table `shop_payment` */

DROP TABLE IF EXISTS `shop_payment`;

CREATE TABLE `shop_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `uniqid` varchar(20) NOT NULL,
  `destination_bank` varchar(50) NOT NULL,
  `from_bank` varchar(50) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `method` int(11) NOT NULL COMMENT '0:transfer:1:?',
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `shop_payment` */

insert  into `shop_payment`(`id`,`tanggal`,`uniqid`,`destination_bank`,`from_bank`,`account_name`,`method`,`status`) values 
(5,'2015-12-07 13:11:18','1-56644a18c6ce4','Mandiri / Muhammad Romli / 14121323123123','Permata','Roni',0,2),
(6,'2015-12-07 20:36:21','1-56658af165d4b','Mandiri / Muhammad Romli / 14121323123123','Mandiri','Romli',0,2),
(8,'2015-12-07 22:02:28','1-56426e108115d','Mandiri<br/>Muhammad Romli<br/>14121323123123','Mandira','Jania',0,2),
(9,'2015-12-09 21:43:53','1-56683da235413','Mandiri<br/>Muhammad Romli<br/>14121323123123','MANDIRI','Mohammad Romli',0,2),
(10,'2015-12-09 21:51:32','1-5643b485852d7','BCA<br/>Jania Alma Ula Ramadhani<br/>1111111111','BCA','MOHAMMAD ROMLI',0,1),
(11,'2015-12-10 21:06:34','1-56696f3817cfc','Mandiri<br/>Muhammad Romli<br/>14121323123123','BCA','Jamreta',0,2),
(12,'2017-02-11 22:38:29','1-589f2f8601b25','BCA<br/>Jania Alma Ula Ramadhani<br/>1111111111','BCA','SUKRON',0,2);

/*Table structure for table `shop_rekening` */

DROP TABLE IF EXISTS `shop_rekening`;

CREATE TABLE `shop_rekening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank` varchar(50) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `shop_rekening` */

insert  into `shop_rekening`(`id`,`bank`,`account_name`,`account_number`,`logo`) values 
(1,'Mandiri','Muhammad Romli','14121323123123',''),
(2,'BCA','Jania Alma Ula Ramadhani','1111111111',''),
(4,'Niaga','Romli','141111111111','');

/*Table structure for table `shop_voucher` */

DROP TABLE IF EXISTS `shop_voucher`;

CREATE TABLE `shop_voucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL,
  `masa_awal` date NOT NULL,
  `masa_akhir` date NOT NULL,
  `nominal` decimal(13,2) NOT NULL,
  `batas_pakai` int(11) NOT NULL COMMENT 'batas pakai secara global',
  `terpakai` int(11) NOT NULL,
  `min_belanja` decimal(13,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_voucher` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `shop_voucher` */

insert  into `shop_voucher`(`id`,`kode`,`masa_awal`,`masa_akhir`,`nominal`,`batas_pakai`,`terpakai`,`min_belanja`) values 
(1,'DES1','2015-12-08','2015-12-31',5000.00,10,5,100000.00),
(2,'JONO','2015-12-11','2016-01-14',20000.00,100,1,20000.00),
(3,'FEBRUARI','2017-02-11','2017-02-15',1000000.00,5,1,6000000.00);

/*Table structure for table `slide` */

DROP TABLE IF EXISTS `slide`;

CREATE TABLE `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `modul` varchar(50) NOT NULL,
  `basename` varchar(20) NOT NULL,
  `extension` varchar(4) NOT NULL,
  `namatampilan` varchar(20) NOT NULL,
  `maxdimension` varchar(20) NOT NULL,
  `maxfilesize` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `slide` */

insert  into `slide`(`id`,`type`,`modul`,`basename`,`extension`,`namatampilan`,`maxdimension`,`maxfilesize`,`urutan`) values 
(2,'defaultheader','pemesanan','slide1','jpg','Slide 1','fixed;650;227',5000000,2),
(3,'defaultheader','pemesanan','slide2','jpg','Slide 2','fixed;650;227',5000000,3),
(4,'defaultheader','pemesanan','slide3','jpg','Slide 3','fixed;650;227',5000000,4),
(5,'defaultheader','about','slide1','jpg','Slide 1','fixed;650;227',5000000,2),
(6,'defaultheader','about','slide2','jpg','Slide 2','fixed;650;227',5000000,3),
(7,'defaultheader','about','slide3','jpg','Slide 3','fixed;650;227',5000000,4);

/*Table structure for table `slide_show` */

DROP TABLE IF EXISTS `slide_show`;

CREATE TABLE `slide_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `basename` varchar(20) NOT NULL,
  `extension` varchar(4) NOT NULL,
  `namatampilan` varchar(20) NOT NULL,
  `maxdimension` varchar(20) NOT NULL,
  `maxfilesize` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `caption` text NOT NULL,
  `usecaption` int(11) NOT NULL COMMENT '1: Title saja,2:Title + Ket',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `slide_show` */

insert  into `slide_show`(`id`,`type`,`basename`,`extension`,`namatampilan`,`maxdimension`,`maxfilesize`,`urutan`,`caption`,`usecaption`) values 
(2,'defaultheader','slide1','png','Slide 1','max;960;350',5000000,2,'',0),
(3,'defaultheader','slide2','png','Slide 2','max;960;350',5000000,3,'',0),
(4,'defaultheader','slide3','png','Slide 3','max;960;350',5000000,4,'',0),
(8,'defaultheader','slide4','jpg','Slide 4','max;960;350',5000000,4,'',0),
(9,'defaultheader','slide5','png','Slide 5','max;960;350',5000000,5,'',0),
(10,'defaultheader','slide6','png','Slide 6','max;960;350',5000000,6,'',0);

/*Table structure for table `sylabus_detail` */

DROP TABLE IF EXISTS `sylabus_detail`;

CREATE TABLE `sylabus_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `row` int(11) NOT NULL,
  `id_master_sylabus` int(11) NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Materi Pokok',
  `allocation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Alokasi Waktu',
  PRIMARY KEY (`id`),
  KEY `id_master_sylabus` (`id_master_sylabus`),
  CONSTRAINT `sylabus_detail_ibfk_1` FOREIGN KEY (`id_master_sylabus`) REFERENCES `master_sylabus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `sylabus_detail` */

/*Table structure for table `sylabus_detail_competency` */

DROP TABLE IF EXISTS `sylabus_detail_competency`;

CREATE TABLE `sylabus_detail_competency` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_sylabus_detail` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sylabus_detail` (`id_sylabus_detail`),
  CONSTRAINT `sylabus_detail_competency_ibfk_1` FOREIGN KEY (`id_sylabus_detail`) REFERENCES `sylabus_detail` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `sylabus_detail_competency` */

/*Table structure for table `sylabus_detail_indicator` */

DROP TABLE IF EXISTS `sylabus_detail_indicator`;

CREATE TABLE `sylabus_detail_indicator` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_sylabus_detail` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sylabus_detail` (`id_sylabus_detail`),
  CONSTRAINT `sylabus_detail_indicator_ibfk_1` FOREIGN KEY (`id_sylabus_detail`) REFERENCES `sylabus_detail` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `sylabus_detail_indicator` */

/*Table structure for table `template_option` */

DROP TABLE IF EXISTS `template_option`;

CREATE TABLE `template_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` varchar(30) NOT NULL,
  `css` text NOT NULL,
  `config` text NOT NULL,
  `color` text NOT NULL,
  `isboxed` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `template_option` */

insert  into `template_option`(`id`,`template`,`css`,`config`,`color`,`isboxed`) values 
(1,'ujian','','','#889C8A',1);

/*Table structure for table `testimonial` */

DROP TABLE IF EXISTS `testimonial`;

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `summary_id` text NOT NULL,
  `summary_en` text NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `testimonial` */

insert  into `testimonial`(`id`,`thumbnail`,`title_id`,`content_id`,`title_en`,`content_en`,`summary_id`,`summary_en`,`pekerjaan`,`tanggal`,`url_id`,`url_en`,`urutan`,`publish`) values 
(1,'image4-609172a44ce7f.jpeg','apt. Winda Wiladatika, S.Farm','Di saat pengumuman TO Nasional Membuat aku merasakan ketakutan yang begitu mendalam sehingga membuat beban di benak fikiran, yah walaupun mendapatkan Nilai TO Nasional kategori cukup yang membuatku kefikiran terus menerus dan ketakutan. Ketika PKPA bertemu teman-teman dan Mereka mengatakan ada mentor di WIFI UKAI yang mengajarnya sangat bagus dan memiliki trik-trik agar kita mudah mengingat dan menjawab soal. Akhirnya setelah mengikuti kelas WIFI UKAI membuat ku semangat belajar karena materinya sangat menarik terutama soalnya berkualitas sehingga sering mendapatkan Hasil yang sangat MEMUASKAN dari semua jenis TO yang saya ikuti dan tidak ada satupun Nilai TO yang TIDAK MEMUASKAN. Hal tersebutlah yang membuat saya menjadi yakin akan Kelulusan UKAI.  Alhamdulillah LULUS dengan Nilai memuaskan, TERIMAKASIH MENTOR WIFI UKAI.\r\n','','','','','Peraih Nilai UKAI 83,5','2021-04-23','apt.-winda-wiladatika-s.farm','',0,0),
(2,'ayu meta-6096d31767132.jpg','apt. Ayu Meta Sari Br. Perangin, S.Farm','WIFI UKAI memiliki jadwal yang fleksibel sehingga sangat membantu, jadi mudah deh menyesuaikan waktu Bekerja dan PKPA. Yang sangat Menariknya sih Modulnya, semua jenis latihan soal-soal Terbaru yang diberikan, dan tryout-trayoutnya Real Seperti Soal UKAI LOH!!! Mentornya sangatsangat mengusai materi sehingga bertanya semua jenis soal-soal dari manapun responya sangat cepat! Karena kesibukan aku begitu padat sering bertanya pada mentornya jam-jam 2-4 subuh sih dan langsung di jawab cepat sehingga tidak mengganggu waktu belajar ku mau di jam berapapun. Dan Akhirnya lulus UKAI dengan nilai Terbaik','','','','','Peraih Nilai UKAI 83,5','2021-04-23','apt.-ayu-meta-sari-br.-perangin-s.farm','',0,0),
(4,'anggun-6096d36a42eaa.jpg','apt. Anggun Syahfitri, S.Farm','Sudah terlampau lama dan banyak menjajakin dan akhirnya bertemu dengan mentor dan sekaligus ownernya . pernah beranggapan akan sama aja dari sebelumnya tetapi akhirnya ikutan juga karena banyak temen yang mengikuti serta penasaran dengan metode belajarnya \"sungguh nyata bukan sekedar kata mulai dari sistem pengajarannya rasa kekeluargaan timbul sehingga selalu tidak bosan owner wifi ukai japri setiap harinya itu takpernah bosen bahkan lebih semangat mentor yang mengingatkan belajar dan menjawab soal â€“ soal di sistem cbt. Jadi itu yang selalu mendorong aku lebih giat di tambah rasa bimbang selama ini terhapuskan karena setelah mengikuti kelas wifi ukai selalu unggul dalam menjajakin soal-soal diluar\". ','','','','','','2021-05-04','apt.-anggun-syahfitri-s.farm','',0,0),
(3,'tanti-6096d37e52c3b.jpg','apt. Tanti Rahmadaniar, S.Farm','Kisi-kisi soal dan materi yang disampaikan semuanya masuk di To Nasional dan ujian UKAI , Terima Kasih wifi ukai.com selalu memberikan kemudahan untuk kami bahkan di bantu untuk dapat kerja, jadi belajarku bukan hanya sampai sebatas ukai tapi sampai kerja karena selalu di arahin dan di bantu oleh owner','','','','','Peraih Nilai UKAI 82','2021-05-04','apt.-tanti-rahmadaniar-s.farm','',0,0),
(5,'OKTA-6096d3a605951.jpg','apt. Oktavina Olivia Purba, S.Farm','Belajar UKAI takperlu Mahal, Kunci utama temukan tempat ternyaman dan carilah mentor yang terbaik serta pembelajaran yang real terpercaya. Wifi ukai merupakan selusi bagi kita yang sulit belajar pada bimbel ini akan terjawab masalah anda semuanya. Bebas bertanya jenis soal UKAI dari manapun tanpa batasan.\r\n','','','','','Peraih Nilai UKAI 82,5','2021-05-04','apt.-oktavina-olivia-purba-s.farm','',0,0),
(6,'image8-60917b82506ff.jpeg','KELAS Privat','Belajar asik, mudah di mengerti dan tanpa batasan waktu, tidak menyangka di perantauan bisa menumkan mentor berasa keluarga sehingga dekat dan leluasa belajar. Kisi-kisi soal keluar semua di ukai serta kesamaannya sangat real','','','','','','2021-05-04','kelas-privat','',0,0),
(7,'image10-60917c37e295f.jpeg','apt. Finky Afriani, S.Farm','Belajar asik mudah dimengerti  waktu flexibel  sehingga  bisnis dan waktu belajar tidak ada yang tertanggu \"Jaya Selalu Wifi UKAI\"\r\n','','','','','OWNER FINKYBEUTY','2021-05-04','apt.-finky-afriani-s.farm','',0,0),
(8,'widya ade syahfitri-6096d3d4ccf41.jpg','apt. Widya Ade Syahfiri Siregar, S.Farm','\"Terima kasih Bimbel WIFI UKAI Materi dan Soal-Soal yang diberikan sangat membantu Sekali. Mentornya ramah dan mau menjawab selapas pribasi. Belajar tanpa batas waktu. \r\n','','','','','Peraih Nilai UKAI 80','2021-05-04','apt.-widya-ade-syahfiri-siregar-s.farm','',0,0),
(9,'SUHAIMI-6096d3edb0045.jpg','apt. Suhaimi, S.Farm','Banyak sudah tempat belajar yang di jajakin cuman di wifi ukai saya merasakan belajar sesungguhnya karena di bimbing sampai mengerti jika mahasiswa tidak mengerti tidak terhitung pertemuan, biaya murah tapi berkualitas seperti privat. Wifi ukai selalu maju dan terimakasih buat mentor yang membatu saya dalam setiap hal bahkan sampai kerja.\r\n','','','','','ALUMNI WIFI UKAI DI MEDISTRA','2021-05-04','apt.-suhaimi-s.farm','',0,0),
(10,'image12-60917dcc1362a.jpeg','KELAS REGULER','Rasa kekeluargaan dan berteman di rasakan saat belajar, semua keluahan dalam pembelajaran selalu terpecahkan dengan jawaban singkat dan padat.\r\n','','','','','','2021-05-05','kelas-reguler','',0,0);

/*Table structure for table `training` */

DROP TABLE IF EXISTS `training`;

CREATE TABLE `training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title_id` varchar(255) NOT NULL DEFAULT '',
  `title_en` varchar(255) NOT NULL,
  `content_id` text NOT NULL,
  `content_en` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `thumb` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL COMMENT 'Untuk 1 gambar',
  `gallery_title` text NOT NULL,
  `gallery_desc` text NOT NULL,
  `training_program` text NOT NULL,
  `training_content` text NOT NULL,
  `attribut_tambahan` text NOT NULL,
  `url_id` varchar(255) NOT NULL,
  `url_en` varchar(255) NOT NULL,
  `publish` tinyint(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `training` */

insert  into `training`(`id`,`tanggal`,`title_id`,`title_en`,`content_id`,`content_en`,`urutan`,`thumb`,`thumbnail`,`gallery_title`,`gallery_desc`,`training_program`,`training_content`,`attribut_tambahan`,`url_id`,`url_en`,`publish`,`id_service`) values 
(23,'2014-07-20 14:23:44','Program pelatihan 2','Program pelatihan 2','','',2,'','1-53cb6e807c97f.jpg','','','{\"id\":{\"title\":null,\"content\":null},\"en\":{\"title\":null,\"content\":null}}','{\"id\":{\"title\":null,\"content\":null},\"en\":{\"title\":null,\"content\":null}}','','program-pelatihan-2','program-pelatihan-2',1,6),
(21,'2014-07-06 19:32:15','Program pelatihan 1','Training program 1','<h3>OVER VIEW</h3>\r\n<p>Training ini berisi materi dan pelatihan kuhusus lorem ipsum</p>','<h3>OVER VIEW</h3>\r\n<p>Training ini berisi materi dan pelatihan kuhusus lorem ipsum</p>',1,'53b941ce9bb8b.jpg:53b941ce9bcda.jpg:53b941ce9bd89.jpg:53b941ce9be3c.jpg','pic 4-53b943035f747.jpg','Lorem ipsum dolor 1:Lorem ipsum dolor 2:Lorem ipsum dolor 3:Lorem ipsum dolor 4','Sed ut perspiciatis unde omnis iste natus 1:Sed ut perspiciatis unde omnis iste natus 2:Sed ut perspiciatis unde omnis iste natus 3:Sed ut perspiciatis unde omnis iste natus 4','{\"id\":{\"title\":[\"Lorem ipsum dolor sit amet 2\",\"Lorem ipsum dolor sit amet\"],\"content\":[\"consectetur adipisicing elit, sed do eiusmod tempor incididunt qq2\",\"consectetur adipisicing elit, sed do eiusmod tempor incididunt \"]},\"en\":{\"title\":[\"Lorem ipsum dolor sit amet 2\",\"Lorem ipsum dolor sit amet\"],\"content\":[\"consectetur adipisicing elit, sed do eiusmod tempor incididunt ee2\",\"consectetur adipisicing elit, sed do eiusmod tempor incididunt \"]}}','{\"id\":{\"title\":[\"Lorem ipsum dolor sit amet\",\"Lorem ipsum dolor sit amet 2\"],\"content\":[\"consectetur adipisicing elit, sed do eiusmod tempor incididunt \",\"consectetur adipisicing elit, sed do eiusmod tempor incididunt qq2\"]},\"en\":{\"title\":[\"Lorem ipsum dolor sit amet\",\"Lorem ipsum dolor sit amet 2\"],\"content\":[\"consectetur adipisicing elit, sed do eiusmod tempor incididunt \",\"consectetur adipisicing elit, sed do eiusmod tempor incididunt ee2\"]}}','','program-pelatihan-1','training-program-1',1,6);

/*Table structure for table `translation` */

DROP TABLE IF EXISTS `translation`;

CREATE TABLE `translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul` varchar(50) NOT NULL,
  `variable` varchar(255) NOT NULL,
  `lang_id` varchar(255) NOT NULL,
  `lang_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `translation` */

insert  into `translation`(`id`,`modul`,`variable`,`lang_id`,`lang_en`) values 
(1,'product','data-tidak-ditemukan','Produk tidak ditemukan','Product not found'),
(2,'product','pencarian','Pencarian','Search'),
(4,'index','quick-order-register','Silahkan mengisi form berikut untuk melakukan quick order','Please fill out this form to make quick order'),
(3,'product','klik-disini','Klik disini','Click here'),
(5,'index','quick-order-profil','Profil anda','Profile'),
(6,'contact','nama','Nama','Name'),
(7,'contact','alamat','Alamat','Address'),
(8,'contact','kontak','Kontak','Contact'),
(9,'contact','mail','Email','Mail');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `ulogin` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` varchar(25) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `kode_reset` varchar(255) DEFAULT NULL,
  `request_reset` datetime DEFAULT NULL,
  `reset_from` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`ulogin`,`fullname`,`password`,`level`,`status`,`lastlogin`,`lastmodify`,`token`,`email`,`kode_reset`,`request_reset`,`reset_from`) values 
(1,'roemly@gmail.com','e2e5fbe2055fce531655458d28eca5e9','Muhammad Romli','19d8d05b965b4864db519d50f6a6ed85','2',1,'2025-01-10 02:40:45','2014-08-06 21:14:34',NULL,'roemly@gmail.com','','0000-00-00 00:00:00','apps'),
(6,'admin','21232f297a57a5a743894a0e4a801fc3','Admin','234a9460fd6a8ca79cc1f5e52b615f90','1',1,'2024-08-12 21:43:09','2020-10-29 19:01:21',NULL,NULL,NULL,NULL,NULL),
(240,'admintcats','a41caa37caf86382dd92854ad5a540da','Admin tcats','6f9b3fd742300f5f57bf81f8230a3171','1',1,'2025-03-20 03:33:49','2024-12-23 23:23:35',NULL,'admintcats@mailinator.com',NULL,NULL,NULL),
(241,'learningcenter','5ab726a7c1242bb094f7c7f2df0b961c','GGF Learning Center','21735a938ed0ebd1805a7920c1a39adc','',1,'2025-03-19 06:46:00','2025-03-19 06:45:51',NULL,'ggf.learningcenter@ggfoods.com',NULL,NULL,NULL),
(242,'dedi.efendi','1c622f802d5c4767e7cb6ae0f2d88b5a','Dedi Efendi','d93a5def7511da3d0f2d171d9c344e91','',1,'2025-03-20 03:47:40','2025-03-20 03:34:45',NULL,'dedi.efendi@ggfoods.com',NULL,NULL,NULL);

/*Table structure for table `web_config` */

DROP TABLE IF EXISTS `web_config`;

CREATE TABLE `web_config` (
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `type` text NOT NULL,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `web_config` */

insert  into `web_config`(`name`,`title_id`,`title_en`,`urutan`,`type`,`label`) values 
('title','GGF','UJIAN SEKOLAH BERBASIS KOMPUTER',1,'text:70:span8','Title:Maksimal 70 karakter'),
('description','-','Training',2,'textarea:160:span8','Description:Maksimal 160 karakter'),
('keyword','Ujian Berbasis Komputer','Training',3,'textarea:0:span8','Keywords'),
('name','GGF','Sukses',4,'text','Name'),
('footer','','<p style=\"text-align: center;\"><a href=\"https://quizroom.id\">Quizroom</a></p>',6,'tiny','Footer'),
('exam_browser_only','0','0',2,'combo:0,1,2,3:Semua Browser,Hanya Hanya Safe Exam Browser, Safe Exam Browse atau Android Exam Browser, Hanya Android Exam Browser','Pilihan Browser'),
('msg_pass_exam','<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 24pt;\"><strong>Thank You</strong></span></p>\r\n<p style=\"text-align: center;\">Your Submission Has been Sent</p>','',3,'tiny','Pesan Ujian Lulus:Muncul jika score ditampilkan'),
('msg_fail_exam','<p style=\"text-align: center;\"><span style=\"font-size: 24pt;\"><strong>Thank You</strong></span></p>\r\n<p style=\"text-align: center;\">Your Submission Has been Sent</p>','',3,'tiny','Pesan Ujian Gagal:Muncul jika score ditampilkan'),
('retake_message','<p style=\"text-align: center;\"><em>(Silakan hubungi admin jika anda sudah melakuan pengajuan ujian ulang)</em></p>','Saya mengajukan ujian ulang untuk kompetensi berikut',6,'tiny','Pesan Retake Post Test'),
('retake_message_waiting','<p style=\"text-align: center;\"><em>Anda berhasil mengajukan ujian ulang. Admin akan melakukan pengecekan terlebih dahulu untuk menyetujui permintaan anda</em></p>','<p style=\"text-align: center;\"><em>Anda berhasil mengajukan ujian ulang. Admin akan melakukan pengecekan terlebih dahulu untuk menyetujui permintaan anda</em></p>',6,'tiny','Pesan Retake Menunggu Persetujuan'),
('profile_pagination','3','3',1,'text:100:span8','Limit tampilan riwayat ujian (Karyawan)'),
('invalid_session','<p style=\"text-align: center;\"><span style=\"font-size: 18pt;\">Anda tidak bisa melaksanakan ujian menggunakan browser ini. <br />Silahkan gunakan browser yang telah ditentukan oleh admin.</span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>','',3,'tiny','Pesan Masuk Ilegal:Exam browser setting'),
('zona_waktu','Asia/Jakarta','',6,'combo:Asia/Jakarta,Asia/Jayapura,Asia/Makassar,:Asia/Jakarta,Asia/Jayapura,Asia/Makassar','Zona waktu'),
('show_score','0','1',2,'combo:0,1:Tidak,Ya','Tampilkan Score'),
('footer_instansi','<p>&nbsp;</p>\r\n<p>&nbsp;</p>','<p>Berikut ini adalah daftar kontak&nbsp;<a href=\"https://suksescbt.com/tentang-developer-aplikasi-unbk/\">Mas TATAG</a>&nbsp;(Developer Aplikasi UNBK Sukses CBT):<br />Telp, SMS, WA, Telegram:&nbsp;<strong>081-329-983-555<br /></strong>Email/ hangouts:&nbsp;<strong><a href=\"mailto:tataqw@gmail.com\">tataqw@gmail.com</a><br /></strong>Email perusahaan:&nbsp;<strong><a href=\"mailto:incloud.inc@gmail.com\">incloud.inc@gmail.com</a><br /></strong>Facebook:&nbsp;<a href=\"https://www.facebook.com/tataqw\">TATAG</a></p>\r\n',6,'tiny','Info Footer'),
('show_footer_instansi','0','0',12,'combo:0,1:Tidak,Ya','Tampilkan info footer'),
('paktaintegritas','Saya mengerjakan Ujian secara jujur, mengerjakan sendiri, tidak kerja sama dan tidak mencontek. Klik setuju untuk memulai ujian','Saya mengerjakan Ujian Sekolah secara jujur, mengerjakan sendiri, mengerjakan dirumah, tidak kerja sama dan tidak mencontek. Klik setuju untuk memulai ujian',6,'textarea:160:span8','Pakta  Integritas'),
('navigasi_soal','0','1',2,'combo:0,1:Manual,Otomatis','Navigasi soal'),
('judulpaktaintegritas','Pakta Integritas','',6,'text:70:span8','Judul Pakta  Integritas'),
('mode_login','1','0',12,'combo:0,1:Langsung Token,Login Siswa','Mode login'),
('nama_sekolah','GGF','SMKN CONTOH',1,'text:70:span8','Nama Sekolah: Muncul di cetak kartu peserta'),
('nama_kepsek','-','Nama Kepala Sekolah, MT',1,'text:100:span8','Nama Kepala Sekolah: Muncul di cetak kartu peserta'),
('judul_kartu','KARTU PESERTA MASUK ','KARTU PESERTA UBK',1,'text:100:span8','Judul Kartu Ujian: Muncul di cetak kartu peserta'),
('sub_judul_kartu','GGF','UJIAN BERBASIS KOMPUTER',1,'text:100:span8','Sub Judul Kartu Ujian: Muncul di cetak kartu peserta');

/*Table structure for table `webmember` */

DROP TABLE IF EXISTS `webmember`;

CREATE TABLE `webmember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `handphone` varchar(30) NOT NULL,
  `chat` text NOT NULL COMMENT 'json BB,WA,YM',
  `alamat` text NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `provinsi` int(11) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `webmember` */

/*Table structure for table `wp9s_commentmeta` */

DROP TABLE IF EXISTS `wp9s_commentmeta`;

CREATE TABLE `wp9s_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_commentmeta` */

/*Table structure for table `wp9s_comments` */

DROP TABLE IF EXISTS `wp9s_comments`;

CREATE TABLE `wp9s_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT 0,
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_comments` */

insert  into `wp9s_comments`(`comment_ID`,`comment_post_ID`,`comment_author`,`comment_author_email`,`comment_author_url`,`comment_author_IP`,`comment_date`,`comment_date_gmt`,`comment_content`,`comment_karma`,`comment_approved`,`comment_agent`,`comment_type`,`comment_parent`,`user_id`) values 
(1,1,'A WordPress Commenter','wapuu@wordpress.example','https://wordpress.org/','','2018-06-20 04:53:02','2018-06-20 04:53:02','Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com\">Gravatar</a>.',0,'1','','',0,0);

/*Table structure for table `wp9s_links` */

DROP TABLE IF EXISTS `wp9s_links`;

CREATE TABLE `wp9s_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_links` */

/*Table structure for table `wp9s_options` */

DROP TABLE IF EXISTS `wp9s_options`;

CREATE TABLE `wp9s_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=324 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_options` */

insert  into `wp9s_options`(`option_id`,`option_name`,`option_value`,`autoload`) values 
(1,'siteurl','http://minori.co.id/shiken/soal.sync','yes'),
(2,'home','http://minori.co.id/shiken/soal.sync','yes'),
(3,'blogname','QuizroomServer','yes'),
(4,'blogdescription','Quiz','yes'),
(5,'users_can_register','0','yes'),
(6,'admin_email','admin@wpress.websuka.com','yes'),
(7,'start_of_week','1','yes'),
(8,'use_balanceTags','0','yes'),
(9,'use_smilies','1','yes'),
(10,'require_name_email','1','yes'),
(11,'comments_notify','1','yes'),
(12,'posts_per_rss','10','yes'),
(13,'rss_use_excerpt','0','yes'),
(14,'mailserver_url','mail.example.com','yes'),
(15,'mailserver_login','login@example.com','yes'),
(16,'mailserver_pass','password','yes'),
(17,'mailserver_port','110','yes'),
(18,'default_category','1','yes'),
(19,'default_comment_status','open','yes'),
(20,'default_ping_status','open','yes'),
(21,'default_pingback_flag','1','yes'),
(22,'posts_per_page','10','yes'),
(23,'date_format','F j, Y','yes'),
(24,'time_format','g:i a','yes'),
(25,'links_updated_date_format','F j, Y g:i a','yes'),
(26,'comment_moderation','0','yes'),
(27,'moderation_notify','1','yes'),
(28,'permalink_structure','/%year%/%monthnum%/%day%/%postname%/','yes'),
(29,'rewrite_rules','a:90:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:58:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:68:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:88:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:83:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:83:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:64:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:53:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$\";s:91:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$\";s:85:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1\";s:77:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:72:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:65:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]\";s:72:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]\";s:61:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]\";s:47:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:57:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:77:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:53:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]\";s:51:\"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]\";s:38:\"([0-9]{4})/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&cpage=$matches[2]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";}','yes'),
(30,'hack_file','0','yes'),
(31,'blog_charset','UTF-8','yes'),
(32,'moderation_keys','','no'),
(33,'active_plugins','a:0:{}','yes'),
(34,'category_base','','yes'),
(35,'ping_sites','http://rpc.pingomatic.com/','yes'),
(36,'comment_max_links','2','yes'),
(37,'gmt_offset','0','yes'),
(38,'default_email_category','1','yes'),
(39,'recently_edited','','no'),
(40,'template','twentyseventeen','yes'),
(41,'stylesheet','twentyseventeen','yes'),
(42,'comment_whitelist','1','yes'),
(43,'blacklist_keys','','no'),
(44,'comment_registration','0','yes'),
(45,'html_type','text/html','yes'),
(46,'use_trackback','0','yes'),
(47,'default_role','subscriber','yes'),
(48,'db_version','38590','yes'),
(49,'uploads_use_yearmonth_folders','1','yes'),
(50,'upload_path','','yes'),
(51,'blog_public','1','yes'),
(52,'default_link_category','2','yes'),
(53,'show_on_front','posts','yes'),
(54,'tag_base','','yes'),
(55,'show_avatars','1','yes'),
(56,'avatar_rating','G','yes'),
(57,'upload_url_path','','yes'),
(58,'thumbnail_size_w','0','no'),
(59,'thumbnail_size_h','0','no'),
(60,'thumbnail_crop','1','yes'),
(61,'medium_size_w','0','no'),
(62,'medium_size_h','0','no'),
(63,'avatar_default','mystery','yes'),
(64,'large_size_w','1024','yes'),
(65,'large_size_h','1024','yes'),
(66,'image_default_link_type','none','yes'),
(67,'image_default_size','','yes'),
(68,'image_default_align','','yes'),
(69,'close_comments_for_old_posts','0','yes'),
(70,'close_comments_days_old','14','yes'),
(71,'thread_comments','1','yes'),
(72,'thread_comments_depth','5','yes'),
(73,'page_comments','0','yes'),
(74,'comments_per_page','50','yes'),
(75,'default_comments_page','newest','yes'),
(76,'comment_order','asc','yes'),
(77,'sticky_posts','a:0:{}','yes'),
(78,'widget_categories','a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}','yes'),
(79,'widget_text','a:0:{}','yes'),
(80,'widget_rss','a:0:{}','yes'),
(81,'uninstall_plugins','a:0:{}','no'),
(82,'timezone_string','','yes'),
(83,'page_for_posts','0','yes'),
(84,'page_on_front','0','yes'),
(85,'default_post_format','0','yes'),
(86,'link_manager_enabled','0','yes'),
(87,'finished_splitting_shared_terms','1','yes'),
(88,'site_icon','0','yes'),
(89,'medium_large_size_w','768','yes'),
(90,'medium_large_size_h','0','yes'),
(91,'wp_page_for_privacy_policy','3','yes'),
(92,'initial_db_version','38590','yes'),
(93,'wp9s_user_roles','a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}','yes'),
(94,'fresh_site','0','yes'),
(95,'widget_search','a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}','yes'),
(96,'widget_recent-posts','a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}','yes'),
(97,'widget_recent-comments','a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}','yes'),
(98,'widget_archives','a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}','yes'),
(99,'widget_meta','a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}','yes'),
(100,'sidebars_widgets','a:5:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}s:13:\"array_version\";i:3;}','yes'),
(101,'widget_pages','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(102,'widget_calendar','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(103,'widget_media_audio','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(104,'widget_media_image','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(105,'widget_media_gallery','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(106,'widget_media_video','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(107,'widget_tag_cloud','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(108,'widget_nav_menu','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(109,'widget_custom_html','a:1:{s:12:\"_multiwidget\";i:1;}','yes'),
(110,'cron','a:6:{i:1589302382;a:1:{s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1589345597;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1589533003;a:1:{s:8:\"do_pings\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:2:{s:8:\"schedule\";b:0;s:4:\"args\";a:0:{}}}}i:1589536382;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1589561582;a:2:{s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}s:7:\"version\";i:2;}','yes'),
(112,'_site_transient_update_core','O:8:\"stdClass\":4:{s:7:\"updates\";a:7:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:7:\"upgrade\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.4.1.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.4.1.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.4.1-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.4.1-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.4.1\";s:7:\"version\";s:5:\"5.4.1\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:0:\"\";}i:1;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.4.1.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.4.1.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.4.1-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.4.1-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.4.1\";s:7:\"version\";s:5:\"5.4.1\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:2;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.3.3.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.3.3.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.3.3-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.3.3-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.3.3\";s:7:\"version\";s:5:\"5.3.3\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:3;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.2.6.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.2.6.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.2.6-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.2.6-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.2.6\";s:7:\"version\";s:5:\"5.2.6\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:4;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.1.5.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.1.5.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.1.5-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.1.5-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.1.5\";s:7:\"version\";s:5:\"5.1.5\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:5;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.0.9.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.0.9.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.0.9-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.0.9-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.0.9\";s:7:\"version\";s:5:\"5.0.9\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:6;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:60:\"https://downloads.wordpress.org/release/wordpress-4.9.14.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:60:\"https://downloads.wordpress.org/release/wordpress-4.9.14.zip\";s:10:\"no_content\";s:71:\"https://downloads.wordpress.org/release/wordpress-4.9.14-no-content.zip\";s:11:\"new_bundled\";s:72:\"https://downloads.wordpress.org/release/wordpress-4.9.14-new-bundled.zip\";s:7:\"partial\";s:70:\"https://downloads.wordpress.org/release/wordpress-4.9.14-partial-6.zip\";s:8:\"rollback\";s:71:\"https://downloads.wordpress.org/release/wordpress-4.9.14-rollback-6.zip\";}s:7:\"current\";s:6:\"4.9.14\";s:7:\"version\";s:6:\"4.9.14\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:5:\"4.9.6\";s:9:\"new_files\";s:0:\"\";}}s:12:\"last_checked\";i:1589532995;s:15:\"version_checked\";s:5:\"4.9.6\";s:12:\"translations\";a:0:{}}','no'),
(115,'theme_mods_twentyseventeen','a:1:{s:18:\"custom_css_post_id\";i:-1;}','yes'),
(119,'_site_transient_update_themes','O:8:\"stdClass\":2:{s:12:\"last_checked\";i:1589532992;s:7:\"checked\";a:0:{}}','no'),
(254,'_site_transient_update_plugins','O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1529585141;s:7:\"checked\";a:2:{s:19:\"akismet/akismet.php\";s:5:\"4.0.3\";s:9:\"hello.php\";s:3:\"1.7\";}s:8:\"response\";a:1:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":12:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:5:\"4.0.8\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/akismet.4.0.8.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:59:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272\";s:2:\"1x\";s:59:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:61:\"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.6\";s:12:\"requires_php\";b:0;s:13:\"compatibility\";O:8:\"stdClass\":0:{}}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:1:{s:9:\"hello.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=969907\";s:2:\"1x\";s:63:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=969907\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:65:\"https://ps.w.org/hello-dolly/assets/banner-772x250.png?rev=478342\";}s:11:\"banners_rtl\";a:0:{}}}}','no'),
(126,'can_compress_scripts','0','no'),
(323,'_transient_doing_cron','1589532992.4718930721282958984375','yes');

/*Table structure for table `wp9s_postmeta` */

DROP TABLE IF EXISTS `wp9s_postmeta`;

CREATE TABLE `wp9s_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_postmeta` */

/*Table structure for table `wp9s_posts` */

DROP TABLE IF EXISTS `wp9s_posts`;

CREATE TABLE `wp9s_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_posts` */

/*Table structure for table `wp9s_term_relationships` */

DROP TABLE IF EXISTS `wp9s_term_relationships`;

CREATE TABLE `wp9s_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_term_relationships` */

insert  into `wp9s_term_relationships`(`object_id`,`term_taxonomy_id`,`term_order`) values 
(1,1,0),
(5,1,0),
(11,1,0),
(44,1,0),
(489,1,0),
(492,1,0),
(594,1,0),
(611,1,0),
(621,1,0),
(646,1,0),
(651,1,0),
(692,1,0),
(703,1,0),
(734,1,0),
(749,1,0),
(937,1,0),
(947,1,0),
(1077,1,0),
(1174,1,0),
(1271,1,0),
(1368,1,0),
(1465,1,0),
(1562,1,0),
(1659,1,0),
(1756,1,0),
(1853,1,0),
(2238,1,0),
(2245,1,0),
(2249,1,0),
(2253,1,0),
(2257,1,0),
(2262,1,0),
(2264,1,0),
(2266,1,0),
(2,1,0),
(12,1,0),
(14,1,0),
(16,1,0),
(18,1,0),
(20,1,0),
(26,1,0),
(33,1,0),
(36,1,0),
(87,1,0),
(94,1,0),
(99,1,0),
(107,1,0),
(136,1,0),
(145,1,0),
(185,1,0),
(221,1,0),
(258,1,0),
(286,1,0),
(317,1,0),
(357,1,0),
(359,1,0),
(391,1,0),
(420,1,0),
(447,1,0),
(480,1,0),
(482,1,0),
(484,1,0),
(486,1,0),
(488,1,0),
(490,1,0),
(494,1,0),
(496,1,0),
(506,1,0),
(521,1,0),
(537,1,0),
(547,1,0),
(554,1,0),
(564,1,0),
(584,1,0),
(586,1,0),
(589,1,0),
(591,1,0),
(593,1,0),
(595,1,0),
(597,1,0),
(599,1,0),
(601,1,0),
(603,1,0),
(605,1,0),
(607,1,0),
(609,1,0),
(613,1,0),
(615,1,0),
(617,1,0),
(619,1,0),
(625,1,0),
(704,1,0),
(706,1,0),
(708,1,0),
(710,1,0),
(712,1,0),
(714,1,0),
(717,1,0),
(719,1,0),
(721,1,0),
(837,1,0),
(839,1,0),
(841,1,0),
(843,1,0),
(925,1,0),
(927,1,0),
(929,1,0),
(932,1,0),
(1084,1,0),
(1088,1,0),
(1097,1,0),
(1447,1,0),
(1672,1,0),
(1899,1,0),
(1903,1,0),
(1906,1,0),
(1908,1,0),
(1911,1,0),
(1914,1,0),
(1916,1,0),
(1931,1,0),
(1946,1,0),
(1972,1,0),
(1978,1,0),
(1993,1,0),
(2006,1,0),
(2026,1,0),
(2043,1,0),
(2077,1,0),
(2092,1,0),
(2250,1,0),
(2252,1,0),
(2267,1,0);

/*Table structure for table `wp9s_term_taxonomy` */

DROP TABLE IF EXISTS `wp9s_term_taxonomy`;

CREATE TABLE `wp9s_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_term_taxonomy` */

insert  into `wp9s_term_taxonomy`(`term_taxonomy_id`,`term_id`,`taxonomy`,`description`,`parent`,`count`) values 
(1,1,'category','',0,102);

/*Table structure for table `wp9s_termmeta` */

DROP TABLE IF EXISTS `wp9s_termmeta`;

CREATE TABLE `wp9s_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_termmeta` */

/*Table structure for table `wp9s_terms` */

DROP TABLE IF EXISTS `wp9s_terms`;

CREATE TABLE `wp9s_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_terms` */

insert  into `wp9s_terms`(`term_id`,`name`,`slug`,`term_group`) values 
(1,'Uncategorized','uncategorized',0);

/*Table structure for table `wp9s_usermeta` */

DROP TABLE IF EXISTS `wp9s_usermeta`;

CREATE TABLE `wp9s_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM AUTO_INCREMENT=635 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_usermeta` */

insert  into `wp9s_usermeta`(`umeta_id`,`user_id`,`meta_key`,`meta_value`) values 
(1,1,'nickname','admin'),
(2,1,'first_name',''),
(3,1,'last_name',''),
(4,1,'description',''),
(5,1,'rich_editing','true'),
(6,1,'syntax_highlighting','true'),
(7,1,'comment_shortcuts','false'),
(8,1,'admin_color','fresh'),
(9,1,'use_ssl','0'),
(10,1,'show_admin_bar_front','true'),
(11,1,'locale',''),
(12,1,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(13,1,'wp9s_user_level','10'),
(14,1,'dismissed_wp_pointers','wp496_privacy'),
(15,1,'show_welcome_panel','1'),
(19,1,'session_tokens','a:4:{s:64:\"6041929e890cd4b9dd3028cf2c62713fa432272f1993e7f036435b62f065444c\";a:4:{s:10:\"expiration\";i:1529643336;s:2:\"ip\";s:15:\"112.215.244.230\";s:2:\"ua\";s:104:\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.75 Safari/537.36\";s:5:\"login\";i:1529470536;}s:64:\"1504e25e22fc4f05a6f61846448b2d74bb08cc71d1e831c4fa2620f07cd9a242\";a:4:{s:10:\"expiration\";i:1529645872;s:2:\"ip\";s:15:\"112.215.244.230\";s:2:\"ua\";s:113:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36\";s:5:\"login\";i:1529473072;}s:64:\"56240618324e85d10d1930297e97de8c139009e3ffe5efee996b82788ad40abe\";a:4:{s:10:\"expiration\";i:1529646191;s:2:\"ip\";s:15:\"112.215.244.230\";s:2:\"ua\";s:101:\"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.62 Safari/537.36\";s:5:\"login\";i:1529473391;}s:64:\"0349d19737efb284885abfb135f463055b8729495a1fec215b969342f8715614\";a:4:{s:10:\"expiration\";i:1529764615;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:104:\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.75 Safari/537.36\";s:5:\"login\";i:1529591815;}}'),
(17,1,'wp9s_dashboard_quick_press_last_post_id','4'),
(18,1,'community-events-location','a:1:{s:2:\"ip\";s:13:\"112.215.244.0\";}'),
(20,1,'wp9s_user-settings','editor=html'),
(21,1,'wp9s_user-settings-time','1529474415'),
(59,7,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(60,7,'wp9s_user_level','10'),
(61,7,'nickname','guru'),
(339,6,'wp9s_user_level','10'),
(340,6,'nickname','admin'),
(203,6,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(204,6,'wp9s_user_level','10'),
(205,6,'nickname','admin'),
(206,6,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(207,6,'wp9s_user_level','10'),
(208,6,'nickname','admin'),
(553,135,'nickname','hanafiaedo'),
(552,135,'wp9s_user_level','10'),
(550,6,'nickname','admin'),
(551,135,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(338,6,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(337,6,'nickname','admin'),
(335,6,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(336,6,'wp9s_user_level','10'),
(549,6,'wp9s_user_level','10'),
(548,6,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(545,6,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(546,6,'wp9s_user_level','10'),
(547,6,'nickname','admin'),
(554,136,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(555,136,'wp9s_user_level','10'),
(556,136,'nickname','romli'),
(557,136,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(558,136,'wp9s_user_level','10'),
(559,136,'nickname','romli'),
(560,191,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(561,191,'wp9s_user_level','10'),
(562,191,'nickname','romli55'),
(615,136,'wp9s_user_level','10'),
(614,136,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(634,242,'nickname','dedi.efendi'),
(633,242,'wp9s_user_level','10'),
(632,242,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(578,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(579,240,'wp9s_user_level','10'),
(580,240,'nickname','radit@gmail.com'),
(581,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(582,240,'wp9s_user_level','10'),
(583,240,'nickname','radit@gmail.com'),
(584,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(585,240,'wp9s_user_level','10'),
(586,240,'nickname','radit@gmail.com'),
(587,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(588,240,'wp9s_user_level','10'),
(589,240,'nickname','radit@gmail.com'),
(590,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(591,240,'wp9s_user_level','10'),
(592,240,'nickname','radit@gmail.com'),
(593,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(594,240,'wp9s_user_level','10'),
(595,240,'nickname','radit@gmail.com'),
(596,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(597,240,'wp9s_user_level','10'),
(598,240,'nickname','radit@gmail.com'),
(599,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(600,240,'wp9s_user_level','10'),
(601,240,'nickname','radit@gmail.com'),
(631,241,'nickname','learningcenter'),
(630,241,'wp9s_user_level','10'),
(629,241,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(628,240,'nickname','admintcats'),
(608,6,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(609,6,'wp9s_user_level','10'),
(610,6,'nickname','admin'),
(627,240,'wp9s_user_level','10'),
(626,240,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(616,136,'nickname','romli'),
(617,136,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(618,136,'wp9s_user_level','10'),
(619,136,'nickname','romli'),
(623,136,'wp9s_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(624,136,'wp9s_user_level','10'),
(625,136,'nickname','romli');

/*Table structure for table `wp9s_users` */

DROP TABLE IF EXISTS `wp9s_users`;

CREATE TABLE `wp9s_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wp9s_users` */

insert  into `wp9s_users`(`ID`,`user_login`,`user_pass`,`user_nicename`,`user_email`,`user_url`,`user_registered`,`user_activation_key`,`user_status`,`display_name`) values 
(6,'admin','$P$B7sfh0NqDO7sRqWZVDtSr2er35ewIX1','admin','admin@admin.com','','2019-01-23 16:59:13','',0,'admin'),
(135,'hanafiaedo','$P$BqNqncezXIHyAaz/FdYhAzdFlkEWIG/','hanafiaedo','hanafiaedo@admin.com','','2020-05-08 20:01:01','',0,'hanafiaedo'),
(136,'romli','$P$BfhbEbkCQH1nxtqfGgn/8.lEEaV1WM1','romli','romli@admin.com','','2020-06-08 11:37:20','',0,'romli'),
(191,'romli55','','romli55','romli55@admin.com','','2020-09-03 19:27:24','',0,'romli55'),
(242,'dedi.efendi','$P$BUw3JvnSn9aKRG3T9jXM9HVonvNObS0','dedi.efendi','dedi.efendi@admin.com','','2025-03-20 10:34:45','',0,'dedi.efendi'),
(240,'admintcats','$P$B97y6UcXNoCG/KMHalzPGyRwQUglPq/','admintcats','admintcats@admin.com','','2020-12-16 13:39:26','',0,'admintcats'),
(241,'learningcenter','$P$BGvbjgtY3h4uF76Fhf1kRNHpfUt7ym/','learningcenter','learningcenter@admin.com','','2021-03-30 05:45:29','',0,'learningcenter');

/*Table structure for table `~member` */

DROP TABLE IF EXISTS `~member`;

CREATE TABLE `~member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `authcode` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Belum Aktif',
  `regdate` datetime NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=502 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `~member` */

insert  into `~member`(`id`,`email`,`fullname`,`hp`,`alamat`,`password`,`authcode`,`status`,`regdate`,`level`) values 
(2,'roemly@a2,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(3,'roemly@a3,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(4,'roemly@a4,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(5,'roemly@a5,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(6,'roemly@a6,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(7,'roemly@a7,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(8,'roemly@a8,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(9,'roemly@a9,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(11,'roemly@a11,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(12,'roemly@a12,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(13,'roemly@a13,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(14,'roemly@a14,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(15,'roemly@a15,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(16,'roemly@a16.com','ciamik1','32312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(17,'roemly@a17,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(18,'roemly@a18,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(19,'roemly@a19,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(20,'roemly@a20,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(21,'roemly@a21,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(22,'roemly@a22,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(23,'roemly@a23,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(24,'roemly@a24,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(25,'roemly@a25,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(26,'roemly@a26,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(27,'roemly@a27,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(28,'roemly@a28,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(29,'roemly@a29,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(30,'roemly@a30,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(31,'roemly@a31,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(32,'roemly@a32,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(33,'roemly@a33,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(34,'roemly@a34,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(35,'roemly@a35,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(36,'roemly@a36,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(37,'roemly@a37,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(38,'roemly@a38,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(39,'roemly@a39,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(40,'roemly@a40,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(41,'roemly@a41.com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(42,'roemly@a42.com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(43,'roemly@a43,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(44,'roemly@a44,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(45,'roemly@a45,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(46,'roemly@a46,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(47,'roemly@a47,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(48,'roemly@a48,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(49,'roemly@a49,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(50,'roemly@a50,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(51,'roemly@a51,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(52,'roemly@a52,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(53,'roemly@a53,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(54,'roemly@a54,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(55,'roemly@a55,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(56,'roemly@a56,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(57,'roemly@a57,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(58,'roemly@a58,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(59,'roemly@a59,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(60,'roemly@a60,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(61,'roemly@a61,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(62,'roemly@a62,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(63,'roemly@a63,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(64,'roemly@a64,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(65,'roemly@a65,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(66,'roemly@a66,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(67,'roemly@a67,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(68,'roemly@a68,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(69,'roemly@a69,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(70,'roemly@a70,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(71,'roemly@a71,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(72,'roemly@a72,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(73,'roemly@a73,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(74,'roemly@a74,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(75,'roemly@a75,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(76,'roemly@a76,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(77,'roemly@a77,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(78,'roemly@a78,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(79,'roemly@a79,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(80,'roemly@a80,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(81,'roemly@a81,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(82,'roemly@a82,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(83,'roemly@a83,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(84,'roemly@a84,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(85,'roemly@a85,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(86,'roemly@a86,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(87,'roemly@a87,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(88,'roemly@a88,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(89,'roemly@a89,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(90,'roemly@a90,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(91,'roemly@a91,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(92,'roemly@a92,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(93,'roemly@a93,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(94,'roemly@a94,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(95,'roemly@a95,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(96,'roemly@a96,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(97,'roemly@a97,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(98,'roemly@a98,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(99,'roemly@a99,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(100,'roemly@a100,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(101,'roemly@a101,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(102,'roemly@a102,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(103,'roemly@a103,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(104,'roemly@a104,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(105,'roemly@a105,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(106,'roemly@a106,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(107,'roemly@a107,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(108,'roemly@a108,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(109,'roemly@a109,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(110,'roemly@a110,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(111,'roemly@a111,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(112,'roemly@a112,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(113,'roemly@a113,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(114,'roemly@a114,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(115,'roemly@a115,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(116,'roemly@a116,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(117,'roemly@a117,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(118,'roemly@a118,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(119,'roemly@a119,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(120,'roemly@a120,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(121,'roemly@a121,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(122,'roemly@a122,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(123,'roemly@a123,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(124,'roemly@a124,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(125,'roemly@a125,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(126,'roemly@a126,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(127,'roemly@a127,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(128,'roemly@a128,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(129,'roemly@a129,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(130,'roemly@a130,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(131,'roemly@a131,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(132,'roemly@a132,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(133,'roemly@a133,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(134,'roemly@a134,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(135,'roemly@a135,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(136,'roemly@a136,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(137,'roemly@a137,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(138,'roemly@a138,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(139,'roemly@a139,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(140,'roemly@a140,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(141,'roemly@a141,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(142,'roemly@a142,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(143,'roemly@a143,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(144,'roemly@a144,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(145,'roemly@a145,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(146,'roemly@a146,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(147,'roemly@a147,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(148,'roemly@a148,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(149,'roemly@a149,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(150,'roemly@a150,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(151,'roemly@a151,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(152,'roemly@a152,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(153,'roemly@a153,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(154,'roemly@a154,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(155,'roemly@a155,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(156,'roemly@a156,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(157,'roemly@a157,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(158,'roemly@a158,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(159,'roemly@a159,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(160,'roemly@a160,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(161,'roemly@a161,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(162,'roemly@a162,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(163,'roemly@a163,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(164,'roemly@a164,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(165,'roemly@a165,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(166,'roemly@a166,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(167,'roemly@a167,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(168,'roemly@a168,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(169,'roemly@a169,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(170,'roemly@a170,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(171,'roemly@a171,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(172,'roemly@a172,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(173,'roemly@a173,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(174,'roemly@a174,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(175,'roemly@a175,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(176,'roemly@a176,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(177,'roemly@a177,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(178,'roemly@a178,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(179,'roemly@a179,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(180,'roemly@a180,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(181,'roemly@a181,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(182,'roemly@a182,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(183,'roemly@a183,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(184,'roemly@a184,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(185,'roemly@a185,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(186,'roemly@a186,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(187,'roemly@a187,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(188,'roemly@a188,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(189,'roemly@a189,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(190,'roemly@a190,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(191,'roemly@a191,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(192,'roemly@a192,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(193,'roemly@a193,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(194,'roemly@a194,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(195,'roemly@a195,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(196,'roemly@a196,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(197,'roemly@a197,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(198,'roemly@a198,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(199,'roemly@a199,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(200,'roemly@a200,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(201,'roemly@a201,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(202,'roemly@a202,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(203,'roemly@a203,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(204,'roemly@a204,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(205,'roemly@a205,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(206,'roemly@a206,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(207,'roemly@a207,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(208,'roemly@a208,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(209,'roemly@a209,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(210,'roemly@a210,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(211,'roemly@a211,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(212,'roemly@a212,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(213,'roemly@a213,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(214,'roemly@a214,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(215,'roemly@a215,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(216,'roemly@a216,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(217,'roemly@a217,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(218,'roemly@a218,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(219,'roemly@a219,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(220,'roemly@a220,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(221,'roemly@a221,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(222,'roemly@a222,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(223,'roemly@a223,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(224,'roemly@a224,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(225,'roemly@a225,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(226,'roemly@a226,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(227,'roemly@a227,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(228,'roemly@a228,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(229,'roemly@a229,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(230,'roemly@a230,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(231,'roemly@a231,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(232,'roemly@a232,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(233,'roemly@a233,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(234,'roemly@a234,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(235,'roemly@a235,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(236,'roemly@a236,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(237,'roemly@a237,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(238,'roemly@a238,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(239,'roemly@a239,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(240,'roemly@a240,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(241,'roemly@a241,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(242,'roemly@a242,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(243,'roemly@a243,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(244,'roemly@a244,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(245,'roemly@a245,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(246,'roemly@a246,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(247,'roemly@a247,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(248,'roemly@a248,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(249,'roemly@a249,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(250,'roemly@a250,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(251,'roemly@a251,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(252,'roemly@a252,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(253,'roemly@a253,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(254,'roemly@a254,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(255,'roemly@a255,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(256,'roemly@a256,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(257,'roemly@a257,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(258,'roemly@a258,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(259,'roemly@a259,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(260,'roemly@a260,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(261,'roemly@a261,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(262,'roemly@a262,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(263,'roemly@a263,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(264,'roemly@a264,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(265,'roemly@a265,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(266,'roemly@a266,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(267,'roemly@a267,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(268,'roemly@a268,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(269,'roemly@a269,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(270,'roemly@a270,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(271,'roemly@a271,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(272,'roemly@a272,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(273,'roemly@a273,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(274,'roemly@a274,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(275,'roemly@a275,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(276,'roemly@a276,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(277,'roemly@a277,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(278,'roemly@a278,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(279,'roemly@a279,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(280,'roemly@a280,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(281,'roemly@a281,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(282,'roemly@a282,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(283,'roemly@a283,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(284,'roemly@a284,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(285,'roemly@a285,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(286,'roemly@a286,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(287,'roemly@a287,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(288,'roemly@a288,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(289,'roemly@a289,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(290,'roemly@a290,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(291,'roemly@a291,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(292,'roemly@a292,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(293,'roemly@a293,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(294,'roemly@a294,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(295,'roemly@a295,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(296,'roemly@a296,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(297,'roemly@a297,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(298,'roemly@a298,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(299,'roemly@a299,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(300,'roemly@a300,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(301,'roemly@a301,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(302,'roemly@a302,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(303,'roemly@a303,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(304,'roemly@a304,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(305,'roemly@a305,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(306,'roemly@a306,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(307,'roemly@a307,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(308,'roemly@a308,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(309,'roemly@a309,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(310,'roemly@a310,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(311,'roemly@a311,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(312,'roemly@a312,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(313,'roemly@a313,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(314,'roemly@a314,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(315,'roemly@a315,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(316,'roemly@a316,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(317,'roemly@a317,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(318,'roemly@a318,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(319,'roemly@a319,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(320,'roemly@a320,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(321,'roemly@a321,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(322,'roemly@a322,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(323,'roemly@a323,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(324,'roemly@a324,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(325,'roemly@a325,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(326,'roemly@a326,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(327,'roemly@a327,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(328,'roemly@a328,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(329,'roemly@a329,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(330,'roemly@a330,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(331,'roemly@a331,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(332,'roemly@a332,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(333,'roemly@a333,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(334,'roemly@a334,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(335,'roemly@a335,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(336,'roemly@a336,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(337,'roemly@a337,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(338,'roemly@a338,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(339,'roemly@a339,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(340,'roemly@a340,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(341,'roemly@a341,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(342,'roemly@a342,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(343,'roemly@a343,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(344,'roemly@a344,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(345,'roemly@a345,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(346,'roemly@a346,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(347,'roemly@a347,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(348,'roemly@a348,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(349,'roemly@a349,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(350,'roemly@a350,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(351,'roemly@a351,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(352,'roemly@a352,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(353,'roemly@a353,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(354,'roemly@a354,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(355,'roemly@a355,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(356,'roemly@a356,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(357,'roemly@a357,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(358,'roemly@a358,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(359,'roemly@a359,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(360,'roemly@a360,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(361,'roemly@a361,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(362,'roemly@a362,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(363,'roemly@a363,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(364,'roemly@a364,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(365,'roemly@a365,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(366,'roemly@a366,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(367,'roemly@a367,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(368,'roemly@a368,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(369,'roemly@a369,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(370,'roemly@a370,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(371,'roemly@a371,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(372,'roemly@a372,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(373,'roemly@a373,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(374,'roemly@a374,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(375,'roemly@a375,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(376,'roemly@a376,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(377,'roemly@a377,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(378,'roemly@a378,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(379,'roemly@a379,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(380,'roemly@a380,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(381,'roemly@a381,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(382,'roemly@a382,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(383,'roemly@a383,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(384,'roemly@a384,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(385,'roemly@a385,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(386,'roemly@a386,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(387,'roemly@a387,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(388,'roemly@a388,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(389,'roemly@a389,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(390,'roemly@a390,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(391,'roemly@a391,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(392,'roemly@a392,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(393,'roemly@a393,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(394,'roemly@a394,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(395,'roemly@a395,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(396,'roemly@a396,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(397,'roemly@a397,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(398,'roemly@a398,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(399,'roemly@a399,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(400,'roemly@a400,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(401,'roemly@a401,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(402,'roemly@a402,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(403,'roemly@a403,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(404,'roemly@a404,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(405,'roemly@a405,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(406,'roemly@a406,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(407,'roemly@a407,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(408,'roemly@a408,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(409,'roemly@a409,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(410,'roemly@a410,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(411,'roemly@a411,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(412,'roemly@a412,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(413,'roemly@a413,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(414,'roemly@a414,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(415,'roemly@a415,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(416,'roemly@a416,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(417,'roemly@a417,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(418,'roemly@a418,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(419,'roemly@a419,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(420,'roemly@a420,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(421,'roemly@a421,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(422,'roemly@a422,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(423,'roemly@a423,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(424,'roemly@a424,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(425,'roemly@a425,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(426,'roemly@a426,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(427,'roemly@a427,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(428,'roemly@a428,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(429,'roemly@a429,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(430,'roemly@a430,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(431,'roemly@a431,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(432,'roemly@a432,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(433,'roemly@a433,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(434,'roemly@a434,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(435,'roemly@a435,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(436,'roemly@a436,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(437,'roemly@a437,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(438,'roemly@a438,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(439,'roemly@a439,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(440,'roemly@a440,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(441,'roemly@a441,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(442,'roemly@a442,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(443,'roemly@a443,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(444,'roemly@a444,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(445,'roemly@a445,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(446,'roemly@a446,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(447,'roemly@a447,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(448,'roemly@a448,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(449,'roemly@a449,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(450,'roemly@a450,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(451,'roemly@a451,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(452,'roemly@a452,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(453,'roemly@a453,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(454,'roemly@a454,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(455,'roemly@a455,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(456,'roemly@a456,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(457,'roemly@a457,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(458,'roemly@a458,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(459,'roemly@a459,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(460,'roemly@a460,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(461,'roemly@a461,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(462,'roemly@a462,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(463,'roemly@a463,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(464,'roemly@a464,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(465,'roemly@a465,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(466,'roemly@a466,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(467,'roemly@a467,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(468,'roemly@a468,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(469,'roemly@a469,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(470,'roemly@a470,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(471,'roemly@a471,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(472,'roemly@a472,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(473,'roemly@a473,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(474,'roemly@a474,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(475,'roemly@a475,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(476,'roemly@a476,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(477,'roemly@a477,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(478,'roemly@a478,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(479,'roemly@a479,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(480,'roemly@a480,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(481,'roemly@a481,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(482,'roemly@a482,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(483,'roemly@a483,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(484,'roemly@a484,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(485,'roemly@a485,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(486,'roemly@a486,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(487,'roemly@a487,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(488,'roemly@a488,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(489,'roemly@a489,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(490,'roemly@a490,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(491,'roemly@a491,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(492,'roemly@a492,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(493,'roemly@a493,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(494,'roemly@a494,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(495,'roemly@a495,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(496,'roemly@a496,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(497,'roemly@a497,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(498,'roemly@a498,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(499,'roemly@a499,com','ciamik','12312','slkjfslj','','',0,'2014-05-01 22:25:18',0),
(500,'tita@yahoo.com','titas','18923123','okeh','','',0,'2014-05-04 13:50:52',0),
(501,'roemly@gmail.com','asdfasdf','223','asdfasdf','','',0,'2014-05-15 20:29:27',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
