-- MySQL Script generated by MySQL Workbench
-- Wed Mar 20 16:02:59 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema new_schema1
-- -----------------------------------------------------
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`em_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`em_user` (
  `username` VARCHAR(16) NOT NULL,
  `phonenumber` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `category_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`user_id`));


-- -----------------------------------------------------
-- Table `mydb`.`em_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`em_category` (
  `category_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_id`));


-- -----------------------------------------------------
-- Table `mydb`.`em_signup`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`em_signup` (
  `signup_id` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `user_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `incomecategory` VARCHAR(45) NOT NULL,
  `eventtype` VARCHAR(45) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `phonenumber` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`signup_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`em_events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`em_events` (
  `event_id` INT NOT NULL,
  `eventname` VARCHAR(45) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `capacity` INT NOT NULL,
  `orgnaizer` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `icg_id` INT NOT NULL,
  PRIMARY KEY (`event_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`em_incomegroup`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`em_incomegroup` (
  `icg_id` INT NOT NULL,
  `incomegroup` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`icg_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;