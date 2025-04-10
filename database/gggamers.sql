
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema gggamers
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gggamers
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gggamers` DEFAULT CHARACTER SET utf8mb3 ;
USE `gggamers` ;

-- -----------------------------------------------------
-- Table `gggamers`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`categorias` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_categoria`));


-- -----------------------------------------------------
-- Table `gggamers`.`espacios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`espacios` (
  `id_espacio` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_espacio`));
-- -----------------------------------------------------
-- Table `gggamers`.`juegos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`juegos` (
  `id_juego` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  `pegi` INT NOT NULL,
  `rutas` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_juego`));


-- -----------------------------------------------------
-- Table `gggamers`.`eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`eventos` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `espacios_id_espacio` INT NOT NULL,
  `juegos_id_juego` INT NOT NULL,
  `fecha_inicio` DATETIME NULL,
  `fecha_fin` DATETIME NULL,
  `participantes` INT NULL,
  PRIMARY KEY (`id_evento`),
  INDEX `fk_eventos_espacios1_idx` (`espacios_id_espacio` ASC) ,
  INDEX `fk_eventos_juegos1_idx` (`juegos_id_juego` ASC) ,
  CONSTRAINT `fk_eventos_espacios1`
    FOREIGN KEY (`espacios_id_espacio`)
    REFERENCES `gggamers`.`espacios` (`id_espacio`),
  CONSTRAINT `fk_eventos_juegos1`
    FOREIGN KEY (`juegos_id_juego`)
    REFERENCES `gggamers`.`juegos` (`id_juego`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `gggamers`.`juegos_has_categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`juegos_has_categorias` (
  `juegos_id_juego` INT NOT NULL,
  `categorias_id_categoria` INT NOT NULL,
  PRIMARY KEY (`juegos_id_juego`, `categorias_id_categoria`),
  INDEX `fk_juegos_has_categorias_categorias1_idx` (`categorias_id_categoria` ASC),
  INDEX `fk_juegos_has_categorias_juegos1_idx` (`juegos_id_juego` ASC),
  CONSTRAINT `fk_juegos_has_categorias_categorias1`
    FOREIGN KEY (`categorias_id_categoria`)
    REFERENCES `gggamers`.`categorias` (`id_categoria`),
  CONSTRAINT `fk_juegos_has_categorias_juegos1`
    FOREIGN KEY (`juegos_id_juego`)
    REFERENCES `gggamers`.`juegos` (`id_juego`));


-- -----------------------------------------------------
-- Table `gggamers`.`plataformas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`plataformas` (
  `id_plataforma` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_plataforma`));


-- -----------------------------------------------------
-- Table `gggamers`.`juegos_has_plataformas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`juegos_has_plataformas` (
  `juegos_id_juego` INT NOT NULL,
  `plataformas_id_plataforma` INT NOT NULL,
  PRIMARY KEY (`juegos_id_juego`, `plataformas_id_plataforma`),
  INDEX `fk_juegos_has_plataformas_plataformas1_idx` (`plataformas_id_plataforma` ASC),
  INDEX `fk_juegos_has_plataformas_juegos1_idx` (`juegos_id_juego` ASC) ,
  CONSTRAINT `fk_juegos_has_plataformas_juegos1`
    FOREIGN KEY (`juegos_id_juego`)
    REFERENCES `gggamers`.`juegos` (`id_juego`),
  CONSTRAINT `fk_juegos_has_plataformas_plataformas1`
    FOREIGN KEY (`plataformas_id_plataforma`)
    REFERENCES `gggamers`.`plataformas` (`id_plataforma`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `gggamers`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`roles` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `gggamers`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gggamers`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  `mail` VARCHAR(250) NOT NULL,
  `contrasenya` VARCHAR(250) NOT NULL,
  `edad` INT NOT NULL,
  `ImagenRuta` varchar(500) null,
  `roles_id_rol` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_Usuarios_roles_idx` (`roles_id_rol` ASC),
  CONSTRAINT `fk_Usuarios_roles`
    FOREIGN KEY (`roles_id_rol`)
    REFERENCES `gggamers`.`roles` (`id_rol`));
    CREATE TABLE IF NOT EXISTS `gggamers`.`evento_usuario` (
  `evento_id_evento` INT NOT NULL,
  `usuario_id_usuario` INT NOT NULL,
  `posicion` INT NOT NULL,  -- Columna para guardar la posición del jugador en el evento
  PRIMARY KEY (`evento_id_evento`, `usuario_id_usuario`),
  CONSTRAINT `fk_evento_usuario_eventos`
    FOREIGN KEY (`evento_id_evento`)
    REFERENCES `gggamers`.`eventos` (`id_evento`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_evento_usuario_usuarios`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `gggamers`.`usuarios` (`id_usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Table `gggamers`.`usuarios_has_eventos`
-- -----------------------------------------------------



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO juegos VALUES 
(1, 'Counter Strike 2', 18, 'image/juegos/counterstrike2.png'),
(2, 'COD 6', 18, 'image/juegos/cod6.png'),
(3, 'Valorant', 16, 'image/juegos/valorant.jpg'),
(4, 'Rainbow Six: Siege', 18, 'image/juegos/rainbowsix.png'),
(5, 'Fortnite', 12, 'image/juegos/fornite.jpg'),
(6, 'Apex Legends', 16, 'image/juegos/apexlegends.png'),
(7, 'PUBG: Battlegrounds', 16, 'image/juegos/pubg.png'),
(8, 'Free Fire', 12, 'image/juegos/freefire.png'),
(9, 'Dota2', 12, 'image/juegos/dota2.png'),
(10, 'League Of Legends', 12, 'image/juegos/leagueoflegends.png'),
(11, 'Smite', 12, 'image/juegos/smite.png'),
(12, 'Street Fighter 6', 12, 'image/juegos/streetfighter6.png'),
(13, 'Mortal Kombat', 18, 'image/juegos/mk1.jpg'),
(14, 'Tekken 8', 16, 'image/juegos/tekken8.png'),
(15, 'Super Smash Bros. Ultimate', 12, 'image/juegos/supersmashbros.png'),
(16, 'Guilty Gear Strive', 12, 'image/juegos/guiltygear.png'),
(17, 'FIFA 25', 3, 'image/juegos/fifa.jpg'),
(18, 'eFootball (PES)', 3, 'image/juegos/efootball.png'),
(19, 'Rocket League', 3, 'image/juegos/rocketleague.png'),
(20, 'Gran Turismo 7', 3, 'image/juegos/granturismo7.png'),
(21, 'F1 24', 3, 'image/juegos/f124.png'),
(22, 'Age of Empires IV', 12, 'image/juegos/ageofempires4.png'),
(23, 'StarCraft II', 12, 'image/juegos/starcraft2.png'),
(24, 'Clash Royale', 7, 'image/juegos/clashroyale.png'),
(25, 'Hearthstone', 7, 'image/juegos/Hearthstone.jpg'),
(26, 'Pokémon TCG', 3, 'image/juegos/pokemon.png'),
(27, 'Teamfight Tactics', 12, 'image/juegos/teamfightrtactics.png'),
(28, 'Dota Underlords', 12, 'image/juegos/dotaunderlords.png'),
(29, 'Fall Guys', 3, 'image/juegos/fallguys.png'),
(30, 'Mario Kart 8 Deluxe', 3, 'image/juegos/mariokart8.png'),
(31, 'Super Mario Party Jamboree', 3, 'image/juegos/mario.jpg'),
(32, 'World of Warcraft', 12, 'image/juegos/worldofwarcraft.png'),
(33, 'Lost Ark', 18, 'image/juegos/lostark.png'),
(34, 'Elden Ring', 16, 'image/juegos/eldenring.png'),
(35, 'Diablo IV', 18, 'image/juegos/diablo4.png'),
(36, 'Just Dance', 3, 'image/juegos/justdance.png'),
(37, 'Osu!', 16, 'image/juegos/osu.png'),
(38, 'Beat Saber', 3, 'image/juegos/beatsaber.png');


INSERT INTO espacios VALUES (1,'Realidad Virtual'),(2,'Nintendo'),(3,'Las Torres'),(4,'Sala Azul'),(5,'Sala Verde'),(6,'Táctil');
INSERT INTO categorias VALUES (1,'Shooter'),(2,'Battle Royale'),(3,'M.O.B.A'),(4,'Fighting'),(5,'Deportes y Carreras'),(6,'RTS (cartas y estrategia)'),(7,'AutoBattlers'),(8,'Party Games'),(9,'MMO RPGs'),(10,'Music');
INSERT INTO juegos_has_categorias VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(2,2),(5,2),(6,2),(7,2),(8,2),(9,3),(10,3),(11,3),(12,4),(13,4),(14,4),(15,4),(16,4),(17,5),(18,5),(19,5),(20,5),(21,6),(22,6),(23,6),(24,6),(25,6),(26,6),(27,7),(28,7),(29,8),(30,8),(31,8),(32,9),(33,9),(34,9),(35,9),(36,10),(37,10),(38,10);
INSERT INTO plataformas VALUES (1,'PlayStation'),(2,'XBOX'),(3,'PC'),(4,'Switch'),(5,'Móvil');
INSERT INTO roles VALUES (1,'users'),(2,'admin');
INSERT INTO usuarios (id_usuario, nombre, mail, contrasenya, edad, ImagenRuta, roles_id_rol) VALUES
(1, 'Pepe Gamer', 'pepe@gmail.com', '1234', 21, 'image/logoUser/pepe.png', 1),
(2, 'Laura Combo', 'laura@gmail.com', 'abcd', 19, 'image/logoUser/laura.png', 1),
(3, 'JuanGol', 'juan@gmail.com', 'pass', 23, 'image/logoUser/juan.png', 1),
(4, 'MartaBaile', 'marta@gmail.com', 'marta123', 20, 'image/logoUser/marta.png', 1),
(5, 'CarlosSwitch', 'carlos@gmail.com', 'switchon', 22, 'image/logoUser/carlos.png', 1);
INSERT INTO juegos_has_plataformas VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(12,1),(13,1),(14,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(33,1),(34,1),(36,1),(37,1),(38,1),(2,2),(5,2),(9,2),(1,3),(2,3),(3,3),(4,3),(5,3),(6,3),(8,3),(9,3),(10,3),(11,3),(16,3),(23,3),(24,3),(25,3),(26,3),(27,3),(28,3),(29,3),(32,3),(34,3),(35,3),(5,4),(15,4),(25,4),(30,4),(31,4),(35,4),(5,5),(25,5);
INSERT INTO eventos (nombre, descripcion, espacios_id_espacio, juegos_id_juego, Fecha_inicio, Fecha_fin, participantes) VALUES
('Torneo Counter Strike 2', 'Competencia de disparos en equipo en Counter Strike 2', 1, 1, '2025-04-15 10:00:00', '2025-04-15 14:00:00', 2),
('Torneo Valorant', 'Competencia estratégica en Valorant', 3, 3, '2025-04-16 10:00:00', '2025-04-16 14:00:00', 2);
-- Inserción para Counter Strike 2 (Evento 1)
INSERT INTO evento_usuario (evento_id_evento, usuario_id_usuario, posicion) VALUES
(1, 1, 1),  -- Pepe Gamer en el Torneo Counter Strike 2, en posición 1
(1, 2, 2);  -- Laura Combo en el Torneo Counter Strike 2, en posición 2

-- Inserción para Fortnite (Evento 2)
INSERT INTO evento_usuario (evento_id_evento, usuario_id_usuario, posicion) VALUES
(2, 3, 1),  -- JuanGol en el Torneo Fortnite, en posición 1
(2, 4, 2);  -- MartaBaile en el Torneo Fortnite, en posición 2



  select * from categorias;
  select * from espacios;
  select * from juegos;
  select * from juegos_has_categorias;
  select * from juegos_has_plataformas;
  select * from plataformas;
  select * from eventos;
  select * from roles;
  select * from usuarios;
  select * from evento_usuario;
