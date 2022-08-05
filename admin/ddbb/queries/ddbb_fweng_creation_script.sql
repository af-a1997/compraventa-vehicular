-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gestion_veh
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestion_veh
-- -----------------------------------------------------

/*
	-> Forward engineered query had to be modified to take out INDEX declarations, because of a supposed syntaxis error with INDEX elements in CREATE TABLE statements, for some reason it's like MariaDB is being used even though phpMyAdmin (and even the script here) are set to use InnoDB as per defaults (and this was checked in PMA's config too).
	
	-> Also, I added a DROP DATABASE statement to re-create the database, backup *all* the data in this database before running this again.
	
	-> Only run when testing, diagnosing or to repair potentially broken relations, tables, etc. by re-creating the database, again, make sure to backup data before running this.
*/
DROP DATABASE IF EXISTS gestion_veh;

CREATE SCHEMA IF NOT EXISTS `gestion_veh` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `gestion_veh`;

-- -----------------------------------------------------
-- Table `gestion_veh`.`marcas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`marcas` (
  `idno` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` LONGTEXT NULL,
  `url_img` VARCHAR(1000) NULL,
  PRIMARY KEY (`idno`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`tipo_veh`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`tipo_veh` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  `icono_fa` VARCHAR(100) NOT NULL COMMENT 'Ícono utilizado en algunas secciones del sitio. Definir SOLAMENTE clase de Font Awesome. Consultar: https://fontawesome.com/search?m=free&s=solid',
  `descripcion` LONGTEXT NULL,
  PRIMARY KEY (`id_tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`vehiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`vehiculos` (
  `idno` INT NOT NULL AUTO_INCREMENT,
  `modelo` VARCHAR(200) NULL,
  `unidades` INT NULL,
  `anho_fab` INT NULL,
  `puertas` INT NULL,
  `transmision` TINYINT NULL,
  `combustible_tipo` VARCHAR(20) NULL,
  `combustible_capac` DOUBLE NULL,
  `motor` LONGTEXT NULL,
  `marca` INT NOT NULL,
  `categorizacion` INT NOT NULL,
  PRIMARY KEY (`idno`),
  CONSTRAINT `fk_vehiculos_marcas`
    FOREIGN KEY (`marca`)
    REFERENCES `gestion_veh`.`marcas` (`idno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehiculos_tipo_veh1`
    FOREIGN KEY (`categorizacion`)
    REFERENCES `gestion_veh`.`tipo_veh` (`id_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`registros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`registros` (
  `id_reg` INT NOT NULL AUTO_INCREMENT,
  `ultima_act_info` DATETIME NOT NULL,
  `color` VARCHAR(10) NOT NULL COMMENT 'Estimación del color del vehículo, guardada en formato hexadecimal/HTML.\n\n#RRGGBB (intensidades de: rojo, verde y azul).',
  `matricula` VARCHAR(10) NULL,
  `estado_act` LONGTEXT NULL,
  `kilometraje_act` DOUBLE NULL,
  `usado` TINYINT NULL,
  `vehiculo_asociado` INT NOT NULL,
  PRIMARY KEY (`id_reg`),
  CONSTRAINT `fk_registros_vehiculos1`
    FOREIGN KEY (`vehiculo_asociado`)
    REFERENCES `gestion_veh`.`vehiculos` (`idno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`divisas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`divisas` (
  `id_moneda` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `abr` VARCHAR(5) NULL,
  `simbolizacion` VARCHAR(5) NULL,
  `pos_sim` TINYINT NULL,
  PRIMARY KEY (`id_moneda`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`adquisiciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`adquisiciones` (
  `id_adq` INT NOT NULL AUTO_INCREMENT,
  `tiempo` DATETIME NOT NULL,
  `precio` DOUBLE NOT NULL,
  `estado_adq` LONGTEXT NULL,
  `kilometraje_adq` DOUBLE NULL,
  `divisa_precio` INT NOT NULL,
  `id_del_adquirido` INT NOT NULL,
  PRIMARY KEY (`id_adq`),
  CONSTRAINT `fk_adquisiciones_registros1`
    FOREIGN KEY (`id_del_adquirido`)
    REFERENCES `gestion_veh`.`registros` (`id_reg`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adquisiciones_divisas1`
    FOREIGN KEY (`divisa_precio`)
    REFERENCES `gestion_veh`.`divisas` (`id_moneda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`remises`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`remises` (
  `id_remise` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `cedula_identidad` INT NOT NULL,
  `tel_cel` VARCHAR(20) NULL,
  `tel_fijo` VARCHAR(20) NULL,
  `email` VARCHAR(100) NULL,
  `ubicacion_residencia` VARCHAR(100) NULL COMMENT 'Aquí se guarda información de la ubicación en coordenadas GPS, al gestionar o añadir un remise se interactúa con una API de mapas para facilitar el especificar el lugar de residencia. En ocasiones este campo puede venir nulo si el remise no quiere dar su ubicación de residencia.',
  `costo_d` DOUBLE NULL,
  `costo_espera_h` DOUBLE NULL,
  `divisa_precio` INT NOT NULL,
  `id_reg_veh` INT NOT NULL,
  PRIMARY KEY (`id_remise`),
  CONSTRAINT `fk_remises_registros1`
    FOREIGN KEY (`id_reg_veh`)
    REFERENCES `gestion_veh`.`registros` (`id_reg`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remises_divisas1`
    FOREIGN KEY (`divisa_precio`)
    REFERENCES `gestion_veh`.`divisas` (`id_moneda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`seleccion_alquiler`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`seleccion_alquiler` (
  `id_art_alq` INT NOT NULL AUTO_INCREMENT,
  `id_reg_veh` INT NOT NULL,
  `id_divisa` INT NOT NULL,
  `valor_diario_alq` DOUBLE NOT NULL,
  `disponibilidad` TINYINT NOT NULL,
  PRIMARY KEY (`id_art_alq`),
  CONSTRAINT `fk_seleccion_alquiler_registros1`
    FOREIGN KEY (`id_reg_veh`)
    REFERENCES `gestion_veh`.`registros` (`id_reg`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seleccion_alquiler_divisas1`
    FOREIGN KEY (`id_divisa`)
    REFERENCES `gestion_veh`.`divisas` (`id_moneda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`puesto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`puesto` (
  `id_puesto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` LONGTEXT NULL,
  PRIMARY KEY (`id_puesto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`usuarios` (
  `nro_id_u` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `nombre_usuario` VARCHAR(50) NOT NULL,
  `clave` VARCHAR(100) NOT NULL,
  `cedula_identidad` INT NOT NULL,
  `email` VARCHAR(100) NULL,
  `residencia_actual` VARCHAR(100) NULL,
  `tel_cel` VARCHAR(20) NULL,
  `tel_fijo` VARCHAR(20) NULL,
  `momento_registro` DATETIME NULL,
  `cargo_en_sitio` INT NOT NULL,
  PRIMARY KEY (`nro_id_u`),
  CONSTRAINT `fk_usuarios_puesto1`
    FOREIGN KEY (`cargo_en_sitio`)
    REFERENCES `gestion_veh`.`puesto` (`id_puesto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`historial_alquiler`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`historial_alquiler` (
  `id_hst_alq` INT NOT NULL AUTO_INCREMENT,
  `momento_alquilado` DATETIME NULL,
  `momento_devolucion` DATETIME NULL,
  `estado_alquiler` TINYINT NOT NULL,
  `id_veh_alquilado` INT NOT NULL,
  `no_cli` INT NOT NULL,
  PRIMARY KEY (`id_hst_alq`, `no_cli`, `id_veh_alquilado`),
  CONSTRAINT `fk_historial_alquiler_seleccion_alquiler1`
    FOREIGN KEY (`id_veh_alquilado`)
    REFERENCES `gestion_veh`.`seleccion_alquiler` (`id_art_alq`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_historial_alquiler_clientes1`
    FOREIGN KEY (`no_cli`)
    REFERENCES `gestion_veh`.`usuarios` (`nro_id_u`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`a_vender`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`a_vender` (
  `id_art_venta` INT NOT NULL AUTO_INCREMENT,
  `id_reg_veh` INT NOT NULL,
  `divisa_precio` INT NOT NULL,
  `valor_venta` DOUBLE NOT NULL,
  `momento_pub` DATETIME NOT NULL,
  `detalles` LONGTEXT NULL,
  `vendedor` INT NOT NULL,
  PRIMARY KEY (`id_art_venta`, `vendedor`),
  CONSTRAINT `fk_a_vender_registros1`
    FOREIGN KEY (`id_reg_veh`)
    REFERENCES `gestion_veh`.`registros` (`id_reg`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_a_vender_divisas1`
    FOREIGN KEY (`divisa_precio`)
    REFERENCES `gestion_veh`.`divisas` (`id_moneda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_a_vender_usuarios1`
    FOREIGN KEY (`vendedor`)
    REFERENCES `gestion_veh`.`usuarios` (`nro_id_u`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`ventas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`ventas` (
  `id_venta` INT NOT NULL AUTO_INCREMENT,
  `notas` LONGTEXT NULL,
  `id_catalogo_ex_ent` INT NOT NULL,
  `id_comprador` INT NOT NULL,
  PRIMARY KEY (`id_venta`, `id_catalogo_ex_ent`),
  CONSTRAINT `fk_ventas_a_vender1`
    FOREIGN KEY (`id_catalogo_ex_ent`)
    REFERENCES `gestion_veh`.`a_vender` (`id_art_venta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_clientes1`
    FOREIGN KEY (`id_comprador`)
    REFERENCES `gestion_veh`.`usuarios` (`nro_id_u`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`reg_contrato_remises`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`reg_contrato_remises` (
  `id_entrada_reg` INT NOT NULL AUTO_INCREMENT,
  `tiempo_inicio` DATETIME NULL,
  `tiempo_fin` DATETIME NULL,
  `pago_diario_contrato` DOUBLE NULL,
  `remisero` INT NOT NULL,
  `contratador` INT NOT NULL,
  PRIMARY KEY (`id_entrada_reg`, `remisero`, `contratador`),
  CONSTRAINT `fk_reg_contrato_remises_remises1`
    FOREIGN KEY (`remisero`)
    REFERENCES `gestion_veh`.`remises` (`id_remise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reg_contrato_remises_clientes1`
    FOREIGN KEY (`contratador`)
    REFERENCES `gestion_veh`.`usuarios` (`nro_id_u`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`imagenes_cat_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`imagenes_cat_venta` (
  `id_imagen` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `url` LONGTEXT NOT NULL,
  `id_articulo` INT NOT NULL,
  PRIMARY KEY (`id_imagen`),
  CONSTRAINT `fk_imagenes_cat_venta_a_vender1`
    FOREIGN KEY (`id_articulo`)
    REFERENCES `gestion_veh`.`a_vender` (`id_art_venta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`imagenes_cat_remise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`imagenes_cat_remise` (
  `id_imagen` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `url` LONGTEXT NOT NULL,
  `pertenece_a_remise` INT NOT NULL,
  PRIMARY KEY (`id_imagen`),
  CONSTRAINT `fk_imagenes_cat_remise_remises1`
    FOREIGN KEY (`pertenece_a_remise`)
    REFERENCES `gestion_veh`.`remises` (`id_remise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion_veh`.`imagenes_cat_alq`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion_veh`.`imagenes_cat_alq` (
  `id_imagen` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `url` LONGTEXT NOT NULL,
  `pertenece_a_veh_alq` INT NOT NULL,
  PRIMARY KEY (`id_imagen`),
  CONSTRAINT `fk_imagenes_cat_alq_seleccion_alquiler1`
    FOREIGN KEY (`pertenece_a_veh_alq`)
    REFERENCES `gestion_veh`.`seleccion_alquiler` (`id_art_alq`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
