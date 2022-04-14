
CREATE TABLE `test`.`elections` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `IDdestination1` int(11) NOT NULL,
  `IDdestination2` int(11) NOT NULL,
  `IDdestination3` int(11) DEFAULT NULL,
  `IDdestination4` int(11) DEFAULT NULL,
  `IDdestination5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `test`.`elections` ADD PRIMARY KEY (`id`);
ALTER TABLE `test`.`elections` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;