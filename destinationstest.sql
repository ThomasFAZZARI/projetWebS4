CREATE TABLE `test`.`destinationstest` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `temperature` int(11) NOT NULL,
  `rating` float NOT NULL,
  `description` text NOT NULL,
  `imageName` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `test`.`destinationstest` ADD PRIMARY KEY (`id`);

SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';