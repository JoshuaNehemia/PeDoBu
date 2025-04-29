SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE `users` (
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `fullName` VARCHAR(100) NOT NULL,
  `phoneNumber` VARCHAR(15) NOT NULL,
  `balance` DOUBLE NOT NULL,
  `securityPin` VARCHAR(6) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `drivers` (
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `fullName` VARCHAR(100) NOT NULL,
  `phoneNumber` VARCHAR(15) NOT NULL,
  `balance` DOUBLE NOT NULL,
  `securityPin` VARCHAR(6) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `province` (
  `id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `city` (
  `id` INT NOT NULL,
  `province_id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_province_idx` (`province_id`),
  CONSTRAINT `fk_city_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `districts` (
  `id` INT NOT NULL,
  `city_id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_districts_city1_idx` (`city_id`),
  CONSTRAINT `fk_districts_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `streets` (
  `id` INT NOT NULL,
  `name` VARCHAR(200) NOT NULL,
  `districts_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_streets_districts1_idx` (`districts_id`),
  CONSTRAINT `fk_streets_districts1` FOREIGN KEY (`districts_id`) REFERENCES `districts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `locations` (
  `id` INT NOT NULL,
  `name` VARCHAR(200) DEFAULT NULL,
  `numbers` VARCHAR(10) DEFAULT NULL,
  `streets_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_locations_streets1_idx` (`streets_id`),
  CONSTRAINT `fk_locations_streets1` FOREIGN KEY (`streets_id`) REFERENCES `streets` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `distance` (
  `from` INT NOT NULL,
  `destination` INT NOT NULL,
  `distance` DOUBLE NOT NULL,
  PRIMARY KEY (`from`, `destination`),
  KEY `fk_table1_locations1_idx` (`from`),
  KEY `fk_table1_locations2_idx` (`destination`),
  CONSTRAINT `fk_table1_locations1` FOREIGN KEY (`from`) REFERENCES `locations` (`id`),
  CONSTRAINT `fk_table1_locations2` FOREIGN KEY (`destination`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `orders` (
  `id` INT NOT NULL,
  `orderDate` DATE NOT NULL,
  `madeTime` TIME NOT NULL,
  `finishTime` TIME DEFAULT NULL,
  `users_username` VARCHAR(45) NOT NULL,
  `drivers_username` VARCHAR(45) NOT NULL,
  `distance_from` INT NOT NULL,
  `distance_destination` INT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_users1_idx` (`users_username`),
  KEY `fk_orders_drivers1_idx` (`drivers_username`),
  KEY `fk_orders_distance1_idx` (`distance_from`, `distance_destination`),
  CONSTRAINT `fk_orders_users1` FOREIGN KEY (`users_username`) REFERENCES `users` (`username`),
  CONSTRAINT `fk_orders_drivers1` FOREIGN KEY (`drivers_username`) REFERENCES `drivers` (`username`),
  CONSTRAINT `fk_orders_distance1` FOREIGN KEY (`distance_from`, `distance_destination`) REFERENCES `distance` (`from`, `destination`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `orderStatus` (
  `orders_id` INT NOT NULL,
  `driversLocation` INT NOT NULL,
  `status` ENUM('') NOT NULL,
  `time` TIME NOT NULL,
  PRIMARY KEY (`driversLocation`, `orders_id`),
  KEY `fk_table1_orders1_idx` (`orders_id`),
  KEY `fk_table1_streets1_idx` (`driversLocation`),
  CONSTRAINT `fk_table1_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `fk_table1_streets1` FOREIGN KEY (`driversLocation`) REFERENCES `streets` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `driversPayment` (
  `id` INT NOT NULL,
  `orders_id` INT NOT NULL,
  `fare` DOUBLE NOT NULL,
  `paidTime` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table1_orders2_idx` (`orders_id`),
  CONSTRAINT `fk_table1_orders2` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `usersPayment` (
  `id` INT NOT NULL,
  `orders_id` INT NOT NULL,
  `price` DOUBLE NOT NULL,
  `paymentTime` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usersPayment_orders1_idx` (`orders_id`),
  CONSTRAINT `fk_usersPayment_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
