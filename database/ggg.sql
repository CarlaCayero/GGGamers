-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema GGGamers
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `GGGamers` ;

-- -----------------------------------------------------
-- Schema GGGamers
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `GGGamers` DEFAULT CHARACTER SET utf8 ;
USE `GGGamers` ;

-- -----------------------------------------------------
-- Table `GGGamers`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`roles` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`roles` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`Usuarios` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`Usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  `mail` VARCHAR(250) NOT NULL,
  `contrasenya` VARCHAR(250) NOT NULL,
  `edad` INT NOT NULL,
  `roles_id_rol` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_Usuarios_roles_idx` (`roles_id_rol` ASC) VISIBLE,
  CONSTRAINT `fk_Usuarios_roles`
    FOREIGN KEY (`roles_id_rol`)
    REFERENCES `GGGamers`.`roles` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`espacios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`espacios` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`espacios` (
  `id_espacio` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_espacio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`eventos` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`eventos` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `espacios_id_espacio` INT NOT NULL,
  PRIMARY KEY (`id_evento`),
  INDEX `fk_eventos_espacios1_idx` (`espacios_id_espacio` ASC) VISIBLE,
  CONSTRAINT `fk_eventos_espacios1`
    FOREIGN KEY (`espacios_id_espacio`)
    REFERENCES `GGGamers`.`espacios` (`id_espacio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`juegos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`juegos` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`juegos` (
  `id_juego` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  `pegi` INT NOT NULL,
  PRIMARY KEY (`id_juego`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`categorias` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`categorias` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`juegos_has_categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`juegos_has_categorias` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`juegos_has_categorias` (
  `juegos_id_juego` INT NOT NULL,
  `categorias_id_categoria` INT NOT NULL,
  PRIMARY KEY (`juegos_id_juego`, `categorias_id_categoria`),
  INDEX `fk_juegos_has_categorias_categorias1_idx` (`categorias_id_categoria` ASC) VISIBLE,
  INDEX `fk_juegos_has_categorias_juegos1_idx` (`juegos_id_juego` ASC) VISIBLE,
  CONSTRAINT `fk_juegos_has_categorias_juegos1`
    FOREIGN KEY (`juegos_id_juego`)
    REFERENCES `GGGamers`.`juegos` (`id_juego`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_juegos_has_categorias_categorias1`
    FOREIGN KEY (`categorias_id_categoria`)
    REFERENCES `GGGamers`.`categorias` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`plataformas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`plataformas` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`plataformas` (
  `id_plataforma` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_plataforma`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`juegos_has_plataformas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`juegos_has_plataformas` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`juegos_has_plataformas` (
  `juegos_id_juego` INT NOT NULL,
  `plataformas_id_plataforma` INT NOT NULL,
  PRIMARY KEY (`juegos_id_juego`, `plataformas_id_plataforma`),
  INDEX `fk_juegos_has_plataformas_plataformas1_idx` (`plataformas_id_plataforma` ASC) VISIBLE,
  INDEX `fk_juegos_has_plataformas_juegos1_idx` (`juegos_id_juego` ASC) VISIBLE,
  CONSTRAINT `fk_juegos_has_plataformas_juegos1`
    FOREIGN KEY (`juegos_id_juego`)
    REFERENCES `GGGamers`.`juegos` (`id_juego`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_juegos_has_plataformas_plataformas1`
    FOREIGN KEY (`plataformas_id_plataforma`)
    REFERENCES `GGGamers`.`plataformas` (`id_plataforma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGGamers`.`Usuarios_has_eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GGGamers`.`Usuarios_has_eventos` ;

CREATE TABLE IF NOT EXISTS `GGGamers`.`Usuarios_has_eventos` (
  `Usuarios_id_usuario` INT NOT NULL,
  `eventos_id_evento` INT NOT NULL,
  `juegos_id_juego` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `posicion` INT NOT NULL,
  PRIMARY KEY (`Usuarios_id_usuario`, `eventos_id_evento`),
  INDEX `fk_Usuarios_has_eventos_eventos1_idx` (`eventos_id_evento` ASC) VISIBLE,
  INDEX `fk_Usuarios_has_eventos_Usuarios1_idx` (`Usuarios_id_usuario` ASC) VISIBLE,
  INDEX `fk_Usuarios_has_eventos_juegos1_idx` (`juegos_id_juego` ASC) VISIBLE,
  CONSTRAINT `fk_Usuarios_has_eventos_Usuarios1`
    FOREIGN KEY (`Usuarios_id_usuario`)
    REFERENCES `GGGamers`.`Usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_eventos_eventos1`
    FOREIGN KEY (`eventos_id_evento`)
    REFERENCES `GGGamers`.`eventos` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_eventos_juegos1`
    FOREIGN KEY (`juegos_id_juego`)
    REFERENCES `GGGamers`.`juegos` (`id_juego`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
