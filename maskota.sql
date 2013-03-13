SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Usuario` (
  `idPersona` INT NOT NULL AUTO_INCREMENT ,
  `nombre` TEXT NOT NULL ,
  `calle` TEXT NOT NULL ,
  `password` TEXT NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `telefono` VARCHAR(10) NOT NULL ,
  `privilegios` INT NULL ,
  PRIMARY KEY (`idPersona`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cita`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`cita` (
  `idcita` INT NOT NULL ,
  `detalles` VARCHAR(45) NULL ,
  `estado` VARCHAR(45) NOT NULL ,
  `inicio` TIME NOT NULL ,
  `fin` TIME NOT NULL ,
  `fecha` DATE NOT NULL ,
  `Persona_idPersona` INT NOT NULL ,
  PRIMARY KEY (`idcita`, `Persona_idPersona`) ,
  INDEX `fk_cita_Persona1_idx` (`Persona_idPersona` ASC) ,
  CONSTRAINT `fk_cita_Persona1`
    FOREIGN KEY (`Persona_idPersona` )
    REFERENCES `mydb`.`Usuario` (`idPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`servicio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`servicio` (
  `idservicio` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` VARCHAR(45) NOT NULL ,
  `precio` FLOAT NOT NULL ,
  `tiempo` INT NOT NULL ,
  PRIMARY KEY (`idservicio`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`detalle_cita`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`detalle_cita` (
  `cita_idcita` INT NOT NULL ,
  `cita_Persona_idPersona` INT NOT NULL ,
  `servicio_idservicio` INT NOT NULL ,
  PRIMARY KEY (`cita_idcita`, `cita_Persona_idPersona`, `servicio_idservicio`) ,
  INDEX `fk_cita_has_servicio_servicio1_idx` (`servicio_idservicio` ASC) ,
  INDEX `fk_cita_has_servicio_cita1_idx` (`cita_idcita` ASC, `cita_Persona_idPersona` ASC) ,
  CONSTRAINT `fk_cita_has_servicio_cita1`
    FOREIGN KEY (`cita_idcita` , `cita_Persona_idPersona` )
    REFERENCES `mydb`.`cita` (`idcita` , `Persona_idPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cita_has_servicio_servicio1`
    FOREIGN KEY (`servicio_idservicio` )
    REFERENCES `mydb`.`servicio` (`idservicio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`articulo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`articulo` (
  `idarticulo` INT NOT NULL ,
  `nombre` VARCHAR(45) NULL ,
  `descripcion` VARCHAR(45) NULL ,
  `precio` FLOAT NULL ,
  PRIMARY KEY (`idarticulo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`nota_venta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`nota_venta` (
  `idnota_venta` INT NOT NULL AUTO_INCREMENT ,
  `total` FLOAT NULL ,
  `fecha` DATE NULL ,
  PRIMARY KEY (`idnota_venta`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`detalle_venta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`detalle_venta` (
  `articulo_idarticulo` INT NOT NULL ,
  `nota_venta_idnota_venta` INT NOT NULL ,
  `precio_venta` FLOAT NULL ,
  PRIMARY KEY (`articulo_idarticulo`, `nota_venta_idnota_venta`) ,
  INDEX `fk_articulo_has_nota_venta_nota_venta1_idx` (`nota_venta_idnota_venta` ASC) ,
  INDEX `fk_articulo_has_nota_venta_articulo1_idx` (`articulo_idarticulo` ASC) ,
  CONSTRAINT `fk_articulo_has_nota_venta_articulo1`
    FOREIGN KEY (`articulo_idarticulo` )
    REFERENCES `mydb`.`articulo` (`idarticulo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_has_nota_venta_nota_venta1`
    FOREIGN KEY (`nota_venta_idnota_venta` )
    REFERENCES `mydb`.`nota_venta` (`idnota_venta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pedido`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`pedido` (
  `fecha` DATE NULL ,
  `estado` TEXT NULL ,
  `Persona_idPersona1` INT NOT NULL ,
  `articulo_idarticulo` INT NOT NULL ,
  `idpedido` INT NOT NULL ,
  INDEX `fk_pedido_Persona1_idx` (`Persona_idPersona1` ASC) ,
  INDEX `fk_pedido_articulo1_idx` (`articulo_idarticulo` ASC) ,
  PRIMARY KEY (`idpedido`) ,
  CONSTRAINT `fk_pedido_Persona1`
    FOREIGN KEY (`Persona_idPersona1` )
    REFERENCES `mydb`.`Usuario` (`idPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_articulo1`
    FOREIGN KEY (`articulo_idarticulo` )
    REFERENCES `mydb`.`articulo` (`idarticulo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
