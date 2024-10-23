
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
