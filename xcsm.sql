SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `sxccms` ;
CREATE SCHEMA IF NOT EXISTS `sxccms` DEFAULT CHARACTER SET latin1 ;
USE `sxccms` ;

-- -----------------------------------------------------
-- Table `sxccms`.`departments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`departments` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`departments` (
  `Code` VARCHAR(8) NOT NULL ,
  `Name` VARCHAR(50) NOT NULL ,
  `Type` ENUM('academic','nonacademic') NOT NULL ,
  PRIMARY KEY (`Code`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`users` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`users` (
  `UserID` BIGINT UNSIGNED NOT NULL ,
  `UserType` ENUM('student','cr','dept','system') NOT NULL ,
  `FirstName` VARCHAR(50) NOT NULL ,
  `LastName` VARCHAR(50) NOT NULL ,
  `Department` VARCHAR(8) NOT NULL ,
  `Roll` INT NOT NULL ,
  `Email` VARCHAR(100) NOT NULL ,
  `Password` VARCHAR(100) NOT NULL ,
  `Status` TINYINT(1) NULL DEFAULT true ,
  PRIMARY KEY (`UserID`) ,
  UNIQUE INDEX `Email` (`Email` ASC) ,
  INDEX `Department` (`Department` ASC) ,
  CONSTRAINT `users_ibfk_1`
    FOREIGN KEY (`Department` )
    REFERENCES `sxccms`.`departments` (`Code` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`blocksinfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`blocksinfo` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`blocksinfo` (
  `BlockID` BIGINT UNSIGNED NOT NULL ,
  `Department` VARCHAR(8) NOT NULL ,
  `Year` TINYINT(1) NOT NULL ,
  `Room` INT NOT NULL ,
  PRIMARY KEY (`BlockID`) ,
  INDEX `Department` (`Department` ASC) ,
  CONSTRAINT `blocksinfo_ibfk_1`
    FOREIGN KEY (`Department` )
    REFERENCES `sxccms`.`departments` (`Code` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`blocksetsinfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`blocksetsinfo` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`blocksetsinfo` (
  `BlockSetID` BIGINT UNSIGNED NOT NULL ,
  `BlockID` BIGINT UNSIGNED NOT NULL ,
  `CRID` BIGINT UNSIGNED NOT NULL ,
  `Status` TINYINT(1) NULL DEFAULT true ,
  `Net` INT NOT NULL ,
  PRIMARY KEY (`BlockSetID`) ,
  INDEX `BlockID` (`BlockID` ASC) ,
  INDEX `BlockID_2` (`BlockID` ASC) ,
  INDEX `CRID` (`CRID` ASC) ,
  CONSTRAINT `blocksetsinfo_ibfk_2`
    FOREIGN KEY (`CRID` )
    REFERENCES `sxccms`.`users` (`UserID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `blocksetsinfo_ibfk_1`
    FOREIGN KEY (`BlockID` )
    REFERENCES `sxccms`.`blocksinfo` (`BlockID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`codesetsinfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`codesetsinfo` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`codesetsinfo` (
  `BlockSetID` BIGINT UNSIGNED NOT NULL ,
  `Code` BIGINT UNSIGNED NOT NULL ,
  `Valid` TINYINT(1) NULL DEFAULT true ,
  `UserID` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`BlockSetID`, `Code`) ,
  INDEX `UserID` (`UserID` ASC) ,
  CONSTRAINT `codesetsinfo_ibfk_2`
    FOREIGN KEY (`UserID` )
    REFERENCES `sxccms`.`users` (`UserID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `codesetsinfo_ibfk_1`
    FOREIGN KEY (`BlockSetID` )
    REFERENCES `sxccms`.`blocksetsinfo` (`BlockSetID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`events` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`events` (
  `EventID` BIGINT UNSIGNED NOT NULL ,
  `Department` VARCHAR(8) NOT NULL ,
  `StartDate` DATE NOT NULL ,
  `EndDate` DATE NOT NULL ,
  `EventName` VARCHAR(100) NOT NULL ,
  `Details` TEXT NOT NULL ,
  `SocialCredit` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`EventID`) ,
  INDEX `Department` (`Department` ASC) ,
  CONSTRAINT `events_ibfk_1`
    FOREIGN KEY (`Department` )
    REFERENCES `sxccms`.`departments` (`Code` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`credits`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`credits` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`credits` (
  `UserID` BIGINT UNSIGNED NOT NULL ,
  `EventID` BIGINT UNSIGNED NOT NULL ,
  `Unit` ENUM('hours','atomic') NOT NULL ,
  `Amount` INT NOT NULL ,
  PRIMARY KEY (`UserID`, `EventID`) ,
  INDEX `EventID` (`EventID` ASC) ,
  CONSTRAINT `credits_ibfk_2`
    FOREIGN KEY (`EventID` )
    REFERENCES `sxccms`.`events` (`EventID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `credits_ibfk_1`
    FOREIGN KEY (`UserID` )
    REFERENCES `sxccms`.`users` (`UserID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`eventassociationsinfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`eventassociationsinfo` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`eventassociationsinfo` (
  `EventID` BIGINT UNSIGNED NOT NULL ,
  `UserID` BIGINT UNSIGNED NOT NULL ,
  `Role` VARCHAR(50) NOT NULL ,
  `States` ENUM('submitted','accepted','rejected') NULL DEFAULT 'submitted' ,
  PRIMARY KEY (`EventID`, `UserID`) ,
  INDEX `UserID` (`UserID` ASC) ,
  CONSTRAINT `eventassociationsinfo_ibfk_1`
    FOREIGN KEY (`EventID` )
    REFERENCES `sxccms`.`events` (`EventID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `eventassociationsinfo_ibfk_2`
    FOREIGN KEY (`UserID` )
    REFERENCES `sxccms`.`users` (`UserID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`eventrolesinfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`eventrolesinfo` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`eventrolesinfo` (
  `EventID` BIGINT UNSIGNED NOT NULL ,
  `Role` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`EventID`, `Role`) ,
  CONSTRAINT `eventrolesinfo_ibfk_1`
    FOREIGN KEY (`EventID` )
    REFERENCES `sxccms`.`events` (`EventID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sxccms`.`registryinfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sxccms`.`registryinfo` ;

CREATE  TABLE IF NOT EXISTS `sxccms`.`registryinfo` (
  `Key` VARCHAR(100) NOT NULL ,
  `Value` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`Key`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `sxccms`.`departments`
-- -----------------------------------------------------
START TRANSACTION;
USE `sxccms`;
INSERT INTO `sxccms`.`departments` (`Code`, `Name`, `Type`) VALUES ('CMSA', 'Computer Science', 'academic');
INSERT INTO `sxccms`.`departments` (`Code`, `Name`, `Type`) VALUES ('NSS', 'National Service Scheme', 'nonacademic');

COMMIT;

-- -----------------------------------------------------
-- Data for table `sxccms`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `sxccms`;
INSERT INTO `sxccms`.`users` (`UserID`, `UserType`, `FirstName`, `LastName`, `Department`, `Roll`, `Email`, `Password`, `Status`) VALUES (1, 'student', 'Rik', 'Dutt', 'CMSA', 543, 'anuvabhdutt@gmail.com', 'mercedes', NULL);

COMMIT;
