#update jadikan unik  token;



CREATE TABLE `quiz_master_access` (
  `quiz_id` int NOT NULL,
  `user_id` int NOT NULL
);

UPDATE `decoration` SET
`id` = '1',
`type` = 'logo',
`basename` = 'logo',
`extension` = 'png',
`namatampilan` = 'Logo',
`maxdimension` = 'max;300;300',
`maxfilesize` = '5000000',
`urutan` = '1',
`caption` = '',
`usecaption` = '0'
WHERE `id` = '1';


INSERT INTO `web_config` (`name`, `title_id`, `title_en`, `urutan`, `type`, `label`)
SELECT 'allow_teacher', '1', '0', '12', 'combo:0,1:Tidak,Ya', 'Mode login guru dan siswa'
FROM `web_config`
WHERE ((`name` = 'show_footer_instansi' AND `name` = 'show_footer_instansi' COLLATE utf8mb4_bin));


CREATE TABLE `pengumuman` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` int NOT NULL,
  `created_by` int NOT NULL,
  `modified_date` int NOT NULL,
  `modified_by` int NOT NULL
);

ALTER TABLE `pengumuman`
CHANGE `id` `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;

ALTER TABLE `pengumuman`
CHANGE `created_date` `created_date` datetime NOT NULL AFTER `content`,
CHANGE `modified_date` `modified_date` datetime NOT NULL AFTER `created_by`;

ALTER TABLE `quiz_essay`
CHANGE `answer` `answer` varchar(255) COLLATE 'latin1_swedish_ci' NULL AFTER `E`;

ALTER TABLE `quiz_essay`
CHANGE `answer` `answer` varchar(255) COLLATE 'latin1_swedish_ci' NULL AFTER `E`;
/*
CREATE TABLE `quiz_done_essay` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_quiz_done` bigint(11) NOT NULL,
  `id_quiz_essay` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `is_done` int NOT NULL,
  FOREIGN KEY (`id_quiz_done`) REFERENCES `quiz_done` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_quiz_essay`) REFERENCES `quiz_essay` (`id`)
);
*/
ALTER TABLE `quiz_essay`
ADD `point1`  decimal(5,2) NULL DEFAULT '100' COMMENT 'point untuk alternatif jawaban 1' AFTER `answer`,
ADD `point2`  decimal(5,2) NULL DEFAULT '100' COMMENT 'point untuk alternatif jawaban 2' AFTER `point1`,
ADD `point3`  decimal(5,2) NULL DEFAULT '100' COMMENT 'point untuk alternatif jawaban 3' AFTER `point2`,
ADD `point4`  decimal(5,2) NULL DEFAULT '100' COMMENT 'point untuk alternatif jawaban 4' AFTER `point3`,
ADD `point5`  decimal(5,2) NULL DEFAULT '100' COMMENT 'point untuk alternatif jawaban 5' AFTER `point4`;

ALTER TABLE `quiz_essay`
ADD `answer1` varchar(255) COLLATE 'latin1_swedish_ci' NULL COMMENT 'alternatif jawaban 1' AFTER `answer`,
ADD `answer2` varchar(255) COLLATE 'latin1_swedish_ci' NULL COMMENT 'alternatif jawaban 2' AFTER `answer1`,
ADD `answer3` varchar(255) COLLATE 'latin1_swedish_ci' NULL COMMENT 'alternatif jawaban 3' AFTER `answer2`,
ADD `answer4` varchar(255) COLLATE 'latin1_swedish_ci' NULL COMMENT 'alternatif jawaban 4' AFTER `answer3`,
ADD `answer5` varchar(255) COLLATE 'latin1_swedish_ci' NULL COMMENT 'alternatif jawaban 5' AFTER `answer4`;

ALTER TABLE `quiz_done_essay`
ADD UNIQUE `id_quiz_done_id_quiz_essay` (`id_quiz_done`, `id_quiz_essay`);

INSERT INTO `web_config` (`name`, `title_id`, `title_en`, `urutan`, `type`, `label`)
SELECT 'nama_sekolah', 'SMKN CONTOH', 'SMKN CONTOH', '1', 'text:70:span8', 'Nama Sekolah: Muncul di cetak kartu peserta'
FROM `web_config`
WHERE ((`name` = 'title' AND `name` = 'title' COLLATE utf8mb4_bin));

INSERT INTO `web_config` (`name`, `title_id`, `title_en`, `urutan`, `type`, `label`)
SELECT 'nama_kepsek', 'Nama Kepala Sekolah, MT', 'Nama Kepala Sekolah, MT', '1', 'text:100:span8', 'Nama Kepala Sekolah: Muncul di cetak kartu peserta'
FROM `web_config`
WHERE ((`name` = 'nama_sekolah' AND `name` = 'nama_sekolah' COLLATE utf8mb4_bin));

CREATE TABLE `quiz_wali_kelas` (
  `id_user` int NOT NULL,
  `class` varchar(100) NOT NULL
);
ALTER TABLE `quiz_wali_kelas`
ADD `created_by` int NOT NULL,
ADD `created_date` datetime NOT NULL AFTER `created_by`,
ADD `modified_by` int NOT NULL AFTER `created_date`,
ADD `modified_date` datetime NOT NULL AFTER `modified_by`;

ALTER TABLE `quiz_wali_kelas`
ADD PRIMARY KEY `class` (`class`);

CREATE TABLE `quiz_grade` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nama` varchar(30) NOT NULL
);

ALTER TABLE `quiz_grade`
ADD `created_by` int NOT NULL,
ADD `created_date` datetime NOT NULL AFTER `created_by`,
ADD `modified_by` int NOT NULL AFTER `created_date`,
ADD `modified_date` datetime NOT NULL AFTER `modified_by`;

ALTER TABLE `quiz_member`
ADD `grade` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL;

CREATE TABLE `quiz_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `quiz_grade_log` (
  `member_id` varchar(50) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL
);

DROP TABLE IF EXISTS `quiz_class_log`;
CREATE TABLE `quiz_class_log` (
  `member_id` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `quiz_member`
CHANGE `grade` `grade` varchar(50) COLLATE 'latin1_swedish_ci' NULL AFTER `password`;

ALTER TABLE `quiz_schedule`
ADD `grade` varchar(30) NOT NULL AFTER `id`;

ALTER TABLE `quiz_master`
ADD `poin_F` int(11) NULL,
ADD `poin_G` int(11) NULL AFTER `poin_F`,
ADD `poin_H` int(11) NULL AFTER `poin_G`,
ADD `poin_I` int(11) NULL AFTER `poin_H`,
ADD `poin_J` int(11) NULL AFTER `poin_I`;

ALTER TABLE `quiz_master`
CHANGE `poin_A` `poin_A` float(5,2) NULL AFTER `poin_kosong`,
CHANGE `poin_B` `poin_B` float(5,2) NULL AFTER `poin_A`,
CHANGE `poin_C` `poin_C` float(5,2) NULL AFTER `poin_B`,
CHANGE `poin_D` `poin_D` float(5,2) NULL AFTER `poin_C`,
CHANGE `poin_E` `poin_E` float(5,2) NULL AFTER `poin_D`,
CHANGE `poin_F` `poin_F` float(5,2) NULL AFTER `poin_E`,
CHANGE `poin_G` `poin_G` float(5,2) NULL AFTER `poin_F`,
CHANGE `poin_H` `poin_H` float(5,2) NULL AFTER `poin_G`,
CHANGE `poin_I` `poin_I` float(5,2) NULL AFTER `poin_H`,
CHANGE `poin_J` `poin_J` float(5,2) NULL AFTER `poin_I`;

ALTER TABLE `quiz_master`
ADD `score_essay` int(11) NULL AFTER `score`;

ALTER TABLE `quiz_done`
ADD `poin_F` int(11) NULL,
ADD `poin_G` int(11) NULL AFTER `poin_F`,
ADD `poin_H` int(11) NULL AFTER `poin_G`,
ADD `poin_I` int(11) NULL AFTER `poin_H`,
ADD `poin_J` int(11) NULL AFTER `poin_I`;
ALTER TABLE `quiz_done`
ADD `score_essay` decimal(5,2) NULL AFTER `score`;

UPDATE `web_config` SET
`name` = 'mode_login',
`title_id` = '1',
`title_en` = '0',
`urutan` = '12',
`type` = 'combo:0,1:Langsung Token,Login Siswa',
`label` = 'Mode login'
WHERE `name` = 'allow_teacher' AND `name` = 'allow_teacher' COLLATE utf8mb4_bin;

ALTER TABLE `quiz_master`
ADD `grade` varchar(50) NOT NULL AFTER `id`;
ALTER TABLE `quiz_schedule`
ADD `grade` varchar(50) NOT NULL AFTER `id`;
ALTER TABLE `quiz_done_essay`
ADD `score_persen` decimal(5,2) NOT NULL AFTER `score`;

ALTER TABLE `quiz_done_essay`
ADD `comment` varchar(255) NOT NULL,
ADD `modified_by` int NOT NULL AFTER `comment`,
ADD `modified_date` datetime NOT NULL AFTER `modified_by`;
ALTER TABLE `pengumuman`
ADD `tanggal_expired` date NOT NULL AFTER `tanggal`;

INSERT INTO `quiz_grade` (`id`, `nama`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1,	'A1',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(2,	'A2',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(3,	'A3',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(4,	'A4',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(5,	'B1',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(6,	'B2',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(7,	'B3',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(8,	'B4',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(9,	'C1',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(10,	'C2',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(11,	'C3',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(12,	'C4',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(13,	'D1',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(14,	'D2',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(15,	'D3',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(16,	'D4',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(17,	'E1',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(18,	'E2',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(19,	'E3',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(20,	'E4',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(21,	'F1',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(22,	'F2',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(23,	'F3',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(24,	'F4',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(25,	'G1',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(26,	'G2',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(27,	'G3',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(28,	'G4',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(29,	'H1',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(30,	'H2',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(31,	'H3',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(32,	'H4',	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00');
