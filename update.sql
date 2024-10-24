
ALTER TABLE `app_course_sub`
ADD `publish` int(11) NOT NULL;

ALTER TABLE `quiz_member`
ADD `organization_unit_code` varchar(50) NOT NULL,
ADD `organization_unit` varchar(50) NOT NULL AFTER `organization_unit_code`,
ADD `position_code` varchar(50) NOT NULL AFTER `organization_unit`,
ADD `position` varchar(50) NOT NULL AFTER `position_code`,
ADD `direct_supervisor_indeks` varchar(50) NOT NULL AFTER `position`,
ADD `direct_supervisor_name` varchar(100) NOT NULL AFTER `direct_supervisor_indeks`,
ADD `manager_indeks` varchar(50) NOT NULL AFTER `direct_supervisor_name`,
ADD `manager_name` varchar(100) NOT NULL AFTER `manager_indeks`;

ALTER TABLE `quiz_member`
ADD `2nd_supervisor_indeks` varchar(100) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `direct_supervisor_name`,
ADD `2nd_supervisor_name` varchar(100) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `2nd_supervisor_indeks`;


2024/10/20
ALTER TABLE `app_register`
ADD `username` varchar(100) NOT NULL AFTER `id`;

2024/10/22
ALTER TABLE `user`
ADD `token` varchar(255) NULL;

2024/10/23
ALTER TABLE `user`
ADD `email` varchar(255) COLLATE 'latin1_swedish_ci' NULL;
ALTER TABLE `user`
ADD `kode_reset` varchar(255) COLLATE 'latin1_swedish_ci' NULL;

ALTER TABLE `user`
ADD `request_reset` datetime NULL;

ALTER TABLE `user`
ADD `reset_from` varchar(50) NULL;

=========

CREATE TABLE `app_quiz_request` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `member_id` int NOT NULL,
  `course_material_id` int NOT NULL,
  `created_at` int NOT NULL,
  `approved_by` int NOT NULL,
  `approved_at` datetime NOT NULL,
  `disaprove_by` int NOT NULL,
  `disaprove_at` datetime NOT NULL
);


INSERT INTO `web_config` (`name`, `title_id`, `title_en`, `urutan`, `type`, `label`)
SELECT 'retake_message', 'Saya mengajukan ujian ulang untuk kompetensi berikut', 'Saya mengajukan ujian ulang untuk kompetensi berikut', '6', 'textarea:160:span8', 'Pesan Retake Post Test'
FROM `web_config`
WHERE ((`name` = 'paktaintegritas' AND `name` = 'paktaintegritas' COLLATE utf8mb4_bin));


UPDATE `web_config` SET
`name` = 'retake_message',
`title_id` = 'Saya mengajukan ujian ulang untuk kompetensi berikut',
`title_en` = 'Saya mengajukan ujian ulang untuk kompetensi berikut',
`urutan` = '6',
`type` = 'tiny',
`label` = 'Pesan Retake Post Test'
WHERE `name` = 'retake_message' AND `name` = 'retake_message' COLLATE utf8mb4_bin;


ALTER TABLE `app_quiz_request`
ADD `quiz_done_id` bigint(11) NOT NULL COMMENT 'quiz_done_id failed' AFTER `course_material_id`,
ADD FOREIGN KEY (`quiz_done_id`) REFERENCES `quiz_done` (`id`);


ALTER TABLE `app_quiz_request`
DROP FOREIGN KEY `app_quiz_request_ibfk_1`


ALTER TABLE `app_quiz_request`
CHANGE `disaprove_by` `disapprove_by` int(11) NOT NULL AFTER `approved_at`,
CHANGE `disaprove_at` `disapprove_at` datetime NOT NULL AFTER `disapprove_by`;

INSERT INTO `web_config` (`name`, `title_id`, `title_en`, `urutan`, `type`, `label`)
SELECT 'profile_pagination', '-', '3', '1', 'text:100:span8', 'Limit tampilan riwayat ujian (Karyawan)'
FROM `web_config`
WHERE ((`name` = 'nama_kepsek' AND `name` = 'nama_kepsek' COLLATE utf8mb4_bin));

ALTER TABLE `app_quiz_request`
CHANGE `created_at` `created_at` datetime NOT NULL AFTER `quiz_done_id`;

ALTER TABLE `app_quiz_request`
ADD UNIQUE `quiz_done_id_course_material_id` (`quiz_done_id`, `course_material_id`),
DROP INDEX `quiz_done_id`;

ALTER TABLE `app_quiz_done`
ADD `course_material_id_void` int(11) NOT NULL AFTER `course_material_id`;