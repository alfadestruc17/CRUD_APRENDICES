create DATABASE IF NOT EXISTS `aprendices` /*DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;*/

USE `aprendices`;


CREATE TABLE `personas` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`primer_nombre` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`segundo_nombre` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`primer_apellido` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`segundo_apellido` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`documento` INT(10) NOT NULL,
	`id_tipo_documento` INT(10) NOT NULL,
	`id_grupo_sanguineo` INT(10) NOT NULL,
	`id_factor_sanguineo` INT(10) NOT NULL,
	`id_genero` INT(10) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `documento` (`documento`) USING BTREE,
	INDEX `FK_personas_tipo_documento` (`id_tipo_documento`) USING BTREE,
	INDEX `FK_personas_grupo sanguineo` (`id_grupo_sanguineo`) USING BTREE,
	INDEX `FK_personas_factor sanguineo` (`id_factor_sanguineo`) USING BTREE,
	INDEX `FK_personas_genero` (`id_genero`) USING BTREE,
	CONSTRAINT `FK_personas_factor sanguineo` FOREIGN KEY (`id_factor_sanguineo`) REFERENCES `factor sanguineo` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_personas_genero` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_personas_grupo sanguineo` FOREIGN KEY (`id_grupo_sanguineo`) REFERENCES `grupo sanguineo` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_personas_tipo_documento` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

CREATE TABLE `aprendices` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`id_persona` INT(10) NULL DEFAULT NULL,
	`id_programa_formacion` INT(10) NULL DEFAULT NULL,
	`id_ficha` INT(10) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `FK_aprendices_personas` (`id_persona`) USING BTREE,
	INDEX `FK_aprendices_programa de formacion` (`id_programa_formacion`) USING BTREE,
	INDEX `FK_aprendices_ficha` (`id_ficha`) USING BTREE,
	CONSTRAINT `FK_aprendices_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `ficha` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_aprendices_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_aprendices_programa de formacion` FOREIGN KEY (`id_programa_formacion`) REFERENCES `programa de formacion` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

CREATE TABLE `factor sanguineo` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`factor` VARCHAR(1) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

CREATE TABLE `ficha` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`ficha` INT(10) NULL DEFAULT '0',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

CREATE TABLE `genero` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`genero` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

CREATE TABLE `grupo sanguineo` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`grupo` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

CREATE TABLE `programa de formacion` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

CREATE TABLE `tipo_documento` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`tipo_documento` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;

