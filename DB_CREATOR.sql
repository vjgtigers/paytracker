-- -----------------------------------------------------
-- Schema locationtracking
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `locationtracking` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `locationtracking`;
-- -----------------------------------------------------
-- Table `locationtracking`.`account_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`account_info` (
  `id` INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  `user_id` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `current_week_pay` DECIMAL(5,2) NULL DEFAULT NULL,
  `current_weekend_pay` DECIMAL(5,2) NULL DEFAULT NULL,
  `tax_rate_approx` DECIMAL(5,2) NULL DEFAULT NULL)
AUTO_INCREMENT = 1;


-- -----------------------------------------------------
-- Table `locationtracking`.`cookies_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`cookies_table` (
  `id` INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  `cookie` VARCHAR(45) NULL DEFAULT NULL,
  `search_id` VARCHAR(45) NULL DEFAULT NULL,
  `row_creation_time` DATETIME NULL DEFAULT CURRENT_TIMESTAMP)
AUTO_INCREMENT = 1;

-- -----------------------------------------------------
-- Table `locationtracking`.`function_usage`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`function_usage` (
  `id` INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  `functName` VARCHAR(45) NULL DEFAULT NULL,
  `startMills` BIGINT NULL DEFAULT NULL,
  `endMills` BIGINT NULL DEFAULT NULL,
  `startTime` DATETIME NULL DEFAULT NULL,
  `rowCreation` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` VARCHAR(45) NULL DEFAULT NULL,
  `typesucc` VARCHAR(45) NULL DEFAULT NULL,
  `remote_addr` VARCHAR(45) NULL DEFAULT NULL,
  `forwarded_for` VARCHAR(45) NULL DEFAULT NULL)
AUTO_INCREMENT = 1;

-- -----------------------------------------------------
-- Table `locationtracking`.`future_work_dates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`future_work_dates` (
  `id` INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  `date_info` DATE NULL DEFAULT NULL,
  `start_time` DATETIME NULL DEFAULT NULL,
  `end_time` DATETIME NULL DEFAULT NULL,
  `user_id` VARCHAR(45) NULL DEFAULT NULL,
  `row_creation_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP)
AUTO_INCREMENT = 1;


-- -----------------------------------------------------
-- Table `locationtracking`.`past_payment_data`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `locationtracking`.`past_payment_data` (
  `id` INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  `date_info` DATE NULL DEFAULT NULL,
  `hours` DECIMAL(5,2) NULL DEFAULT NULL,
  `user_id` VARCHAR(45) NULL DEFAULT NULL,
  `row_creation_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `hourly_pay` DECIMAL(5,2) NULL DEFAULT NULL)
AUTO_INCREMENT = 1;
