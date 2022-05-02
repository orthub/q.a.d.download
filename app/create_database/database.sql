DROP TABLE IF EXISTS `documents`;

DROP TABLE IF EXISTS `address`;

DROP TABLE IF EXISTS `users`;

DROP TABLE IF EXISTS `roles`;

USE db;

CREATE TABLE IF NOT EXISTS `roles` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`role` VARCHAR(16) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `users` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(64) NOT NULL,
	`last_name` VARCHAR(64) NOT NULL,
	`email` VARCHAR(128) NOT NULL,
	`password` VARCHAR(128) NOT NULL,
	`user_role` INT UNSIGNED NOT NULL DEFAULT 3,
	UNIQUE KEY (`email`),
	PRIMARY KEY (`id`),
	CONSTRAINT `FK_users_user_role` FOREIGN KEY (`user_role`) REFERENCES `roles`(`id`) ON UPDATE NO ACTION ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `address` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`city` VARCHAR(64) NOT NULL,
	`street` VARCHAR(64) NOT NULL,
	`zip_code` VARCHAR(64) NOT NULL,
	`user_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `FK_address_users` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON UPDATE NO ACTION ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `documents` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`path` VARCHAR(256) NOT NULL,
	`doc_user_role` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `FK_documents_roles` FOREIGN KEY (`doc_user_role`) REFERENCES `roles`(`id`) ON UPDATE NO ACTION ON DELETE CASCADE
);

INSERT INTO `roles` (`role`) VALUES('ADMIN');

INSERT INTO `roles` (`role`) VALUES('LEVEL_2');

INSERT INTO `roles` (`role`) VALUES('LEVEL_3');

INSERT INTO
	`users` (
		`first_name`,
		`last_name`,
		`email`,
		`password`,
		`user_role`
	)
VALUES(
		"Roland",
		"Ortner",
		"test@test.test",
		"$2y$10$edRWb5iABWmOidEiIRJc7e5xc/BcwhOOgYNYZiL7esB1JD6sicLKa",
		1
	);

INSERT INTO
	`users` (
		`first_name`,
		`last_name`,
		`email`,
		`password`,
		`user_role`
	)
VALUES(
		"John",
		"Doe",
		"john@test.test",
		"$2y$10$edRWb5iABWmOidEiIRJc7e5xc/BcwhOOgYNYZiL7esB1JD6sicLKa",
		2
	);

INSERT INTO
	`users` (
		`first_name`,
		`last_name`,
		`email`,
		`password`,
		`user_role`
	)
VALUES(
		"Jane",
		"Doe",
		"jane@test.test",
		"$2y$10$edRWb5iABWmOidEiIRJc7e5xc/BcwhOOgYNYZiL7esB1JD6sicLKa",
		3
	);

INSERT INTO
	`documents` (`path`, `doc_user_role`)
VALUES("/public/storage/datei_eins.txt", 1);

INSERT INTO
	`documents` (`path`, `doc_user_role`)
VALUES("/public/storage/datei_zwei.txt", 2);

INSERT INTO
	`documents` (`path`, `doc_user_role`)
VALUES("/public/storage/datei_drei.txt", 3);

INSERT INTO
	`documents` (`path`, `doc_user_role`)
VALUES("/public/storage/datei_vier.pdf", 1);