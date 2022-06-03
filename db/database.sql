drop database if exists `db_sistemaInformacion`;

create database if not exists `db_sistemaInformacion`;

CREATE TABLE IF NOT EXISTS `db_sistemaInformacion`.`user` (
  `id` int unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `photo` varchar(100) ,
  `bodge` float NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `photo` (`photo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `db_sistemaInformacion`.`category`(
	`id` int unsigned NOT NULL auto_increment,
    `title` varchar(50) NOT NULL,
    `type` varchar(10) NOT NULL,
    primary key(`id`),
    UNIQUE KEY `title` (`title`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `db_sistemaInformacion`.`expensesIncome` (
  `id` int unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `category_id` int unsigned NOT NULL,
  `amount` float NOT NULL,
  `date` datetime NOT NULL default now(),
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_expensesIncome_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_expensesIncome_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- users

INSERT INTO `db_sistemaInformacion`.`user` (`name`, `lastname`, `username`, `password`, `role`, `bodge`, `email`) VALUES ('Raul', 'Estrada', 'Estradivarius', '210cf7aa5e2682c9c9d4511f88fe2789', 'admin', '15000', 'raulestrada2000@gmail.com');
INSERT INTO `db_sistemaInformacion`.`user` (`name`, `lastname`, `username`, `password`, `role`, `bodge`, `email`) VALUES ('Paco', 'Gerte', 'paquitoMaster', '210cf7aa5e2682c9c9d4511f88fe2789', 'user', '1500', 'paconeitor@gmail.com');
INSERT INTO `db_sistemaInformacion`.`user` (`name`, `lastname`, `username`, `password`, `role`, `bodge`, `email`) VALUES ('memeitor', 'virgineitor', 'PussyDestroyer', '210cf7aa5e2682c9c9d4511f88fe2789', 'user', '100', 'espantaviejasDelux@gmail.com');

-- categories

INSERT INTO `db_sistemaInformacion`.`category` (`title`, `type`) VALUES ('Pago Trabajo', 'Ingreso');
INSERT INTO `db_sistemaInformacion`.`category` (`title`, `type`) VALUES ('Comida', 'Gasto');


-- expenses and incomes
INSERT INTO `db_sistemaInformacion`.`expensesIncome` (`title`, `category_id`, `amount`, `user_id`) VALUES ('papitas', '1', '80', '1');
INSERT INTO `db_sistemaInformacion`.`expensesIncome` (`title`, `category_id`, `amount`, `user_id`) VALUES ('pago trabajo', '2', '15000', '1');

