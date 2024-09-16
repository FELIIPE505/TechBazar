-- MySQL Script generated by MySQL Workbench
-- Mon Sep 16 09:41:42 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema TechBazar
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema TechBazar
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `TechBazar` ;
USE `TechBazar` ;

-- -----------------------------------------------------
-- Table `TechBazar`.`tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TechBazar`.`tb_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `administrador` BLOB(1) NOT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TechBazar`.`tb_jogo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TechBazar`.`tb_jogo` (
  `id_jogo` INT NOT NULL AUTO_INCREMENT,
  `nome_jogo` VARCHAR(50) NOT NULL,
  `descricao_jogo` VARCHAR(500) NOT NULL,
  `preco_jogo` INT NOT NULL,
  `categoria_jogo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_jogo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TechBazar`.`tb_usuario_has_tb_jogo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TechBazar`.`tb_usuario_has_tb_jogo` (
  `tb_usuario_id_usuario` INT NOT NULL,
  `tb_jogo_id_jogo` INT NOT NULL,
  PRIMARY KEY (`tb_usuario_id_usuario`, `tb_jogo_id_jogo`),
  INDEX `fk_tb_usuario_has_tb_jogo_tb_jogo1_idx` (`tb_jogo_id_jogo` ASC) VISIBLE,
  INDEX `fk_tb_usuario_has_tb_jogo_tb_usuario_idx` (`tb_usuario_id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_tb_usuario_has_tb_jogo_tb_usuario`
    FOREIGN KEY (`tb_usuario_id_usuario`)
    REFERENCES `TechBazar`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_usuario_has_tb_jogo_tb_jogo1`
    FOREIGN KEY (`tb_jogo_id_jogo`)
    REFERENCES `TechBazar`.`tb_jogo` (`id_jogo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
