-- MySQL Script generated by MySQL Workbench
-- 07/31/18 15:02:20
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema shop
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema shop
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `shop` ;

-- -----------------------------------------------------
-- Table `shop`.`table1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`table1` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shop`.`Category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`Category` (
  `category_id` INT NOT NULL,
  `category_name` VARCHAR(50) NOT NULL,
  `description` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shop`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`Product` (
  `product_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `description` VARCHAR(200) NOT NULL,
  `barcode` INT NOT NULL,
  `image` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`product_id`),
  INDEX `fk_Product_Category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_Product_Category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `shop`.`Category` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shop`.`Roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`Roles` (
  `rol_id` INT NOT NULL,
  `rol_name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`rol_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shop`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`Users` (
  `user_id` INT NOT NULL,
  `rol_id` INT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_Users_Roles1_idx` (`rol_id` ASC),
  CONSTRAINT `fk_Users_Roles1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `shop`.`Roles` (`rol_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shop`.`Sale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`Sale` (
  `sale_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`sale_id`),
  INDEX `fk_Sale_Users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_Sale_Users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `shop`.`Users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shop`.`Detail_sale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`Detail_sale` (
  `product_id` INT NOT NULL,
  `sale_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(3,1) NOT NULL,
  INDEX `fk_Product_has_Sale_Sale1_idx` (`sale_id` ASC, `product_id` ASC),
  CONSTRAINT `fk_Product_has_Sale_Sale1`
    FOREIGN KEY (`sale_id` , `product_id`)
    REFERENCES `shop`.`Sale` (`sale_id` , `sale_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Detail_sale_Product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `shop`.`Product` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shop`.`Detail_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`Detail_users` (
  `user_id` INT NOT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(200) NOT NULL,
  `telephone` VARCHAR(12) NULL,
  CONSTRAINT `fk_Detail_users_Users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `shop`.`Users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shop`.`Inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shop`.`Inventory` (
  `code` INT NOT NULL,
  `product_id` INT NOT NULL,
  `product_name` VARCHAR(45) NOT NULL,
  `unit_price` INT NOT NULL,
  `existence` INT NOT NULL,
  PRIMARY KEY (`code`),
  INDEX `fk_Inventary_Product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_Inventary_Product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `shop`.`Product` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
