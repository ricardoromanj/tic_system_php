SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `ricardoroman` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `ricardoroman` ;

-- -----------------------------------------------------
-- Table `ricardoroman`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`user` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`user` (
  `user_id` INT NOT NULL ,
  `user_username` VARCHAR(45) NOT NULL ,
  `user_password` VARCHAR(45) NOT NULL ,
  `user_type` VARCHAR(45) NOT NULL ,
  `user_active` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`user_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`tutor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`tutor` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`tutor` (
  `tutor_id` INT NOT NULL ,
  `tutor_name` VARCHAR(45) NOT NULL ,
  `tutor_second_name` VARCHAR(45) NULL ,
  `tutor_lastname` VARCHAR(45) NOT NULL ,
  `tutor_second_lastname` VARCHAR(45) NULL ,
  `tutor_gender` CHAR NOT NULL ,
  `tutor_role` VARCHAR(45) NOT NULL ,
  `tutor_notes` TEXT NULL ,
  `tutor_picture` VARCHAR(45) NOT NULL ,
  `tutor_date_added` DATETIME NOT NULL ,
  `tutor_user_id` INT NULL ,
  PRIMARY KEY (`tutor_id`) ,
  INDEX `fk_tutor_user1` (`tutor_user_id` ASC) ,
  CONSTRAINT `fk_tutor_user1`
    FOREIGN KEY (`tutor_user_id` )
    REFERENCES `ricardoroman`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`phonetutor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`phonetutor` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`phonetutor` (
  `phonetutor_id` INT NOT NULL ,
  `phonetutor_number` VARCHAR(45) NOT NULL ,
  `phonetutor_type` VARCHAR(45) NOT NULL ,
  `phonetutor_primary` TINYINT(1) NOT NULL ,
  `phonetutor_tutor_id` INT NOT NULL ,
  PRIMARY KEY (`phonetutor_id`) ,
  INDEX `fk_phonetutor_tutor1` (`phonetutor_tutor_id` ASC) ,
  CONSTRAINT `fk_phonetutor_tutor1`
    FOREIGN KEY (`phonetutor_tutor_id` )
    REFERENCES `ricardoroman`.`tutor` (`tutor_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`emailtutor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`emailtutor` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`emailtutor` (
  `emailtutor_id` INT NOT NULL ,
  `emailtutor_address` VARCHAR(45) NULL ,
  `emailtutor_type` VARCHAR(45) NULL ,
  `emailtutor_primary` TINYINT(1) NULL ,
  `emailtutor_tutor_id` INT NOT NULL ,
  PRIMARY KEY (`emailtutor_id`) ,
  INDEX `fk_emailtutor_tutor1` (`emailtutor_tutor_id` ASC) ,
  CONSTRAINT `fk_emailtutor_tutor1`
    FOREIGN KEY (`emailtutor_tutor_id` )
    REFERENCES `ricardoroman`.`tutor` (`tutor_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`coordinator`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`coordinator` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`coordinator` (
  `coordinator_id` INT NOT NULL ,
  `coordinator_name` VARCHAR(45) NOT NULL ,
  `coordinator_second_name` VARCHAR(45) NULL ,
  `coordinator_lastname` VARCHAR(45) NOT NULL ,
  `coordinator_second_lastname` VARCHAR(45) NULL ,
  `coordinator_gender` CHAR NOT NULL ,
  `coordinator_notes` TEXT NULL ,
  `coordinator_picture` VARCHAR(45) NOT NULL ,
  `coordinator_date_added` DATETIME NOT NULL ,
  `coordinator_user_id` INT NOT NULL ,
  PRIMARY KEY (`coordinator_id`) ,
  INDEX `fk_coordinator_user1` (`coordinator_user_id` ASC) ,
  CONSTRAINT `fk_coordinator_user1`
    FOREIGN KEY (`coordinator_user_id` )
    REFERENCES `ricardoroman`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`phonecoordinator`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`phonecoordinator` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`phonecoordinator` (
  `phonecoordinator_id` INT NOT NULL ,
  `phonecoordinator_number` VARCHAR(45) NOT NULL ,
  `phonecoordinator_type` VARCHAR(45) NOT NULL ,
  `phonecoordinator_primary` TINYINT(1) NOT NULL ,
  `phonecoordinator_coordinator_id` INT NOT NULL ,
  PRIMARY KEY (`phonecoordinator_id`) ,
  INDEX `fk_phonecoordinator_coordinator1` (`phonecoordinator_coordinator_id` ASC) ,
  CONSTRAINT `fk_phonecoordinator_coordinator1`
    FOREIGN KEY (`phonecoordinator_coordinator_id` )
    REFERENCES `ricardoroman`.`coordinator` (`coordinator_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`emailcoordinator`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`emailcoordinator` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`emailcoordinator` (
  `emailcoordinator_id` INT NOT NULL ,
  `emailcoordinator_address` VARCHAR(45) NULL ,
  `emailcoordinator_type` VARCHAR(45) NULL ,
  `emailcoordinator_primary` TINYINT(1) NULL ,
  `emailcoordinator_coordinator_id` INT NOT NULL ,
  PRIMARY KEY (`emailcoordinator_id`) ,
  INDEX `fk_emailcoordinator_coordinator1` (`emailcoordinator_coordinator_id` ASC) ,
  CONSTRAINT `fk_emailcoordinator_coordinator1`
    FOREIGN KEY (`emailcoordinator_coordinator_id` )
    REFERENCES `ricardoroman`.`coordinator` (`coordinator_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`child`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`child` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`child` (
  `child_id` INT NOT NULL AUTO_INCREMENT ,
  `child_name` VARCHAR(45) NOT NULL ,
  `child_second_name` VARCHAR(45) NULL ,
  `child_lastname` VARCHAR(45) NOT NULL ,
  `child_second_lastname` VARCHAR(45) NULL ,
  `child_gender` CHAR NOT NULL ,
  `child_birthdate` DATETIME NOT NULL ,
  `child_allgergies` TEXT NOT NULL ,
  `child_medical_notes` TEXT NULL ,
  `child_general_notes` TEXT NULL ,
  `child_picture` VARCHAR(45) NOT NULL ,
  `child_date_added` DATETIME NOT NULL ,
  `child_active` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`child_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`childtutor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`childtutor` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`childtutor` (
  `childtutor_id` INT NOT NULL ,
  `childtutor_tutor_id` INT NOT NULL ,
  `childtutor_child_id` INT NOT NULL ,
  PRIMARY KEY (`childtutor_id`) ,
  INDEX `fk_childtutor_tutor1` (`childtutor_tutor_id` ASC) ,
  INDEX `fk_childtutor_child1` (`childtutor_child_id` ASC) ,
  CONSTRAINT `fk_childtutor_tutor1`
    FOREIGN KEY (`childtutor_tutor_id` )
    REFERENCES `ricardoroman`.`tutor` (`tutor_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_childtutor_child1`
    FOREIGN KEY (`childtutor_child_id` )
    REFERENCES `ricardoroman`.`child` (`child_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`workshop`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`workshop` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`workshop` (
  `workshop_id` INT NOT NULL ,
  `workshop_name` VARCHAR(45) NOT NULL ,
  `workshop_desc` TEXT NULL ,
  `workshop_picture` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`workshop_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`catechesis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`catechesis` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`catechesis` (
  `catechesis_id` INT NOT NULL ,
  `catechesis_name` VARCHAR(45) NOT NULL ,
  `catechesis_desc` TEXT NULL ,
  `catechesis_picture` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`catechesis_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`announcement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`announcement` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`announcement` (
  `announcement_id` INT NOT NULL ,
  `announcement_date` VARCHAR(45) NOT NULL ,
  `announcement_heading` VARCHAR(45) NOT NULL ,
  `announcement_text` LONGTEXT NOT NULL ,
  `announcement_audience` VARCHAR(45) NULL ,
  PRIMARY KEY (`announcement_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`semester`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`semester` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`semester` (
  `semester_id` INT NOT NULL ,
  `semester_name` VARCHAR(45) NOT NULL ,
  `semester_begin_date` VARCHAR(45) NOT NULL ,
  `semester_end_date` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`semester_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`coordinatorcatechesis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`coordinatorcatechesis` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`coordinatorcatechesis` (
  `coordinatorcatechesis_id` INT NOT NULL ,
  `coordinatorcatechesis_catechesis_id` INT NOT NULL ,
  `coordinatorcatechesis_coordinator_id` INT NOT NULL ,
  PRIMARY KEY (`coordinatorcatechesis_id`) ,
  INDEX `fk_coordinatorcatechesis_catechesis1` (`coordinatorcatechesis_catechesis_id` ASC) ,
  INDEX `fk_coordinatorcatechesis_coordinator1` (`coordinatorcatechesis_coordinator_id` ASC) ,
  CONSTRAINT `fk_coordinatorcatechesis_catechesis1`
    FOREIGN KEY (`coordinatorcatechesis_catechesis_id` )
    REFERENCES `ricardoroman`.`catechesis` (`catechesis_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coordinatorcatechesis_coordinator1`
    FOREIGN KEY (`coordinatorcatechesis_coordinator_id` )
    REFERENCES `ricardoroman`.`coordinator` (`coordinator_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`coordinatorworkshop`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`coordinatorworkshop` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`coordinatorworkshop` (
  `coordinatorworkshop_id` INT NOT NULL ,
  `coordinatorworkshop_coordinator_id` INT NOT NULL ,
  `coordinatorworkshop_workshop_id` INT NOT NULL ,
  PRIMARY KEY (`coordinatorworkshop_id`) ,
  INDEX `fk_coordinatorworkshop_coordinator1` (`coordinatorworkshop_coordinator_id` ASC) ,
  INDEX `fk_coordinatorworkshop_workshop1` (`coordinatorworkshop_workshop_id` ASC) ,
  CONSTRAINT `fk_coordinatorworkshop_coordinator1`
    FOREIGN KEY (`coordinatorworkshop_coordinator_id` )
    REFERENCES `ricardoroman`.`coordinator` (`coordinator_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coordinatorworkshop_workshop1`
    FOREIGN KEY (`coordinatorworkshop_workshop_id` )
    REFERENCES `ricardoroman`.`workshop` (`workshop_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`childworkshop`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`childworkshop` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`childworkshop` (
  `childworkshop_id` INT NOT NULL ,
  `workshop_workshop_id` INT NOT NULL ,
  `child_child_id` INT NOT NULL ,
  PRIMARY KEY (`childworkshop_id`) ,
  INDEX `fk_childworkshop_workshop1` (`workshop_workshop_id` ASC) ,
  INDEX `fk_childworkshop_child1` (`child_child_id` ASC) ,
  CONSTRAINT `fk_childworkshop_workshop1`
    FOREIGN KEY (`workshop_workshop_id` )
    REFERENCES `ricardoroman`.`workshop` (`workshop_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_childworkshop_child1`
    FOREIGN KEY (`child_child_id` )
    REFERENCES `ricardoroman`.`child` (`child_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`childcatechesis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`childcatechesis` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`childcatechesis` (
  `childcatechesis_id` INT NOT NULL ,
  `childcatechesis_catechesis_id` INT NOT NULL ,
  `childcatechesis_child_id` INT NOT NULL ,
  PRIMARY KEY (`childcatechesis_id`) ,
  INDEX `fk_childcatechesis_catechesis1` (`childcatechesis_catechesis_id` ASC) ,
  INDEX `fk_childcatechesis_child1` (`childcatechesis_child_id` ASC) ,
  CONSTRAINT `fk_childcatechesis_catechesis1`
    FOREIGN KEY (`childcatechesis_catechesis_id` )
    REFERENCES `ricardoroman`.`catechesis` (`catechesis_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_childcatechesis_child1`
    FOREIGN KEY (`childcatechesis_child_id` )
    REFERENCES `ricardoroman`.`child` (`child_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`announcementsemester`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`announcementsemester` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`announcementsemester` (
  `announcementsemester_id` INT NOT NULL ,
  `semester_semester_id` INT NOT NULL ,
  `announcement_announcement_id` INT NOT NULL ,
  PRIMARY KEY (`announcementsemester_id`) ,
  INDEX `fk_announcementsemester_semester1` (`semester_semester_id` ASC) ,
  INDEX `fk_announcementsemester_announcement1` (`announcement_announcement_id` ASC) ,
  CONSTRAINT `fk_announcementsemester_semester1`
    FOREIGN KEY (`semester_semester_id` )
    REFERENCES `ricardoroman`.`semester` (`semester_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_announcementsemester_announcement1`
    FOREIGN KEY (`announcement_announcement_id` )
    REFERENCES `ricardoroman`.`announcement` (`announcement_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`workshopsemester`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`workshopsemester` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`workshopsemester` (
  `workshopsemester_id` INT NOT NULL ,
  `workshopsemester_semester_id` INT NOT NULL ,
  `workshopsemester_workshop_id` INT NOT NULL ,
  PRIMARY KEY (`workshopsemester_id`) ,
  INDEX `fk_workshopsemester_semester1` (`workshopsemester_semester_id` ASC) ,
  INDEX `fk_workshopsemester_workshop1` (`workshopsemester_workshop_id` ASC) ,
  CONSTRAINT `fk_workshopsemester_semester1`
    FOREIGN KEY (`workshopsemester_semester_id` )
    REFERENCES `ricardoroman`.`semester` (`semester_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_workshopsemester_workshop1`
    FOREIGN KEY (`workshopsemester_workshop_id` )
    REFERENCES `ricardoroman`.`workshop` (`workshop_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`catechesissemester`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`catechesissemester` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`catechesissemester` (
  `catechesissemester_id` INT NOT NULL ,
  `catechesissemester_catechesis_id` INT NOT NULL ,
  `catechesissemester_semester_id` INT NOT NULL ,
  PRIMARY KEY (`catechesissemester_id`) ,
  INDEX `fk_catechesissemester_catechesis1` (`catechesissemester_catechesis_id` ASC) ,
  INDEX `fk_catechesissemester_semester1` (`catechesissemester_semester_id` ASC) ,
  CONSTRAINT `fk_catechesissemester_catechesis1`
    FOREIGN KEY (`catechesissemester_catechesis_id` )
    REFERENCES `ricardoroman`.`catechesis` (`catechesis_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_catechesissemester_semester1`
    FOREIGN KEY (`catechesissemester_semester_id` )
    REFERENCES `ricardoroman`.`semester` (`semester_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`childsemester`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`childsemester` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`childsemester` (
  `childsemester_id` INT NOT NULL ,
  `childsemester_child_id` INT NOT NULL ,
  `childsemester_semester_id` INT NOT NULL ,
  PRIMARY KEY (`childsemester_id`) ,
  INDEX `fk_childsemester_child1` (`childsemester_child_id` ASC) ,
  INDEX `fk_childsemester_semester1` (`childsemester_semester_id` ASC) ,
  CONSTRAINT `fk_childsemester_child1`
    FOREIGN KEY (`childsemester_child_id` )
    REFERENCES `ricardoroman`.`child` (`child_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_childsemester_semester1`
    FOREIGN KEY (`childsemester_semester_id` )
    REFERENCES `ricardoroman`.`semester` (`semester_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`saturday`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`saturday` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`saturday` (
  `saturday_id` INT NOT NULL AUTO_INCREMENT ,
  `saturday_date` DATETIME NULL ,
  `saturday_notes` TEXT NULL ,
  `saturday_heading` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL ,
  PRIMARY KEY (`saturday_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`assistanceworkshop`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`assistanceworkshop` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`assistanceworkshop` (
  `assitanceworkshop_id` INT NOT NULL AUTO_INCREMENT ,
  `assitanceworkshop_assitance` TINYINT(1) NULL ,
  `assistanceworkshop_notes` TEXT NULL ,
  `assistanceworkshop_child_id` INT NOT NULL ,
  `assistanceworkshop_saturday_id` INT NOT NULL ,
  `assistanceworkshop_workshop_id` INT NOT NULL ,
  PRIMARY KEY (`assitanceworkshop_id`) ,
  INDEX `fk_assistanceworkshop_child1` (`assistanceworkshop_child_id` ASC) ,
  INDEX `fk_assistanceworkshop_saturday1` (`assistanceworkshop_saturday_id` ASC) ,
  INDEX `fk_assistanceworkshop_workshop1` (`assistanceworkshop_workshop_id` ASC) ,
  CONSTRAINT `fk_assistanceworkshop_child1`
    FOREIGN KEY (`assistanceworkshop_child_id` )
    REFERENCES `ricardoroman`.`child` (`child_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assistanceworkshop_saturday1`
    FOREIGN KEY (`assistanceworkshop_saturday_id` )
    REFERENCES `ricardoroman`.`saturday` (`saturday_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assistanceworkshop_workshop1`
    FOREIGN KEY (`assistanceworkshop_workshop_id` )
    REFERENCES `ricardoroman`.`workshop` (`workshop_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ricardoroman`.`assistancecatechesis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ricardoroman`.`assistancecatechesis` ;

CREATE  TABLE IF NOT EXISTS `ricardoroman`.`assistancecatechesis` (
  `assitancecatechesis_id` INT NOT NULL AUTO_INCREMENT ,
  `assitancecatechesis_assitance` TINYINT(1) NULL ,
  `assistancecatechesis_notes` TEXT NULL ,
  `assistancecatechesis_child_id` INT NOT NULL ,
  `assistancecatechesis_saturday_id` INT NOT NULL ,
  `assistancecatechesis_catechesis_id` INT NOT NULL ,
  PRIMARY KEY (`assitancecatechesis_id`) ,
  INDEX `fk_assistancecatechesis_child1` (`assistancecatechesis_child_id` ASC) ,
  INDEX `fk_assistancecatechesis_saturday1` (`assistancecatechesis_saturday_id` ASC) ,
  INDEX `fk_assistancecatechesis_catechesis1` (`assistancecatechesis_catechesis_id` ASC) ,
  CONSTRAINT `fk_assistancecatechesis_child1`
    FOREIGN KEY (`assistancecatechesis_child_id` )
    REFERENCES `ricardoroman`.`child` (`child_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assistancecatechesis_saturday1`
    FOREIGN KEY (`assistancecatechesis_saturday_id` )
    REFERENCES `ricardoroman`.`saturday` (`saturday_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assistancecatechesis_catechesis1`
    FOREIGN KEY (`assistancecatechesis_catechesis_id` )
    REFERENCES `ricardoroman`.`catechesis` (`catechesis_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
