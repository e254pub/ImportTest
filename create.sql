CREATE TABLE `directory_db`.`dict_tb`
(
    `key`   VARCHAR(250) NOT NULL,
    `title` VARCHAR(250) NOT NULL,
    UNIQUE `key` (`key`)
) ENGINE = InnoDB;