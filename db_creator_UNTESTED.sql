-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema locationtracking
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema locationtracking
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `locationtracking` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `locationtracking` ;

-- -----------------------------------------------------
-- Table `locationtracking`.`account_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`account_info` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `current_week_pay` DECIMAL(5,2) NULL DEFAULT NULL,
  `current_weekend_pay` DECIMAL(5,2) NULL DEFAULT NULL,
  `tax_rate_approx` DECIMAL(5,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE UNIQUE INDEX `id_UNIQUE` ON `locationtracking`.`account_info` (`id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `locationtracking`.`cookies_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`cookies_table` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cookie` VARCHAR(45) NULL DEFAULT NULL,
  `search_id` VARCHAR(45) NULL DEFAULT NULL,
  `row_creation_time` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 37
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE UNIQUE INDEX `id_UNIQUE` ON `locationtracking`.`cookies_table` (`id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `locationtracking`.`function_usage`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`function_usage` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `functName` VARCHAR(45) NULL DEFAULT NULL,
  `startMills` BIGINT NULL DEFAULT NULL,
  `endMills` BIGINT NULL DEFAULT NULL,
  `startTime` DATETIME NULL DEFAULT NULL,
  `rowCreation` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` VARCHAR(45) NULL DEFAULT NULL,
  `typesucc` VARCHAR(45) NULL DEFAULT NULL,
  `remote_addr` VARCHAR(45) NULL DEFAULT NULL,
  `forwarded_for` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 245
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE UNIQUE INDEX `id_UNIQUE` ON `locationtracking`.`function_usage` (`id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `locationtracking`.`future_work_dates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`future_work_dates` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date_info` DATE NULL DEFAULT NULL,
  `start_time` DATETIME NULL DEFAULT NULL,
  `end_time` DATETIME NULL DEFAULT NULL,
  `user_id` VARCHAR(45) NULL DEFAULT NULL,
  `row_creation_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 42
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE UNIQUE INDEX `id_UNIQUE` ON `locationtracking`.`future_work_dates` (`id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `locationtracking`.`new_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`new_table` (
  `idnew_table` INT NOT NULL AUTO_INCREMENT,
  `lat` VARCHAR(45) NULL DEFAULT NULL,
  `long2` VARCHAR(45) NULL DEFAULT NULL,
  `speed` VARCHAR(45) NULL DEFAULT NULL,
  `timestamp2` VARCHAR(45) NULL DEFAULT NULL,
  `alt` VARCHAR(45) NULL DEFAULT NULL,
  `acc` VARCHAR(45) NULL DEFAULT NULL,
  `uuid2` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idnew_table`))
ENGINE = InnoDB
AUTO_INCREMENT = 12759
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE UNIQUE INDEX `idnew_table_UNIQUE` ON `locationtracking`.`new_table` (`idnew_table` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `locationtracking`.`past_payment_data`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`past_payment_data` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date_info` DATE NULL DEFAULT NULL,
  `hours` DECIMAL(5,2) NULL DEFAULT NULL,
  `weekend` TINYINT NULL DEFAULT NULL,
  `user_id` VARCHAR(45) NULL DEFAULT NULL,
  `row_creation_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `hourly_pay` DECIMAL(5,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 179
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE UNIQUE INDEX `id_UNIQUE` ON `locationtracking`.`past_payment_data` (`id` ASC) INVISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
