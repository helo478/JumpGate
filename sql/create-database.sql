DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    id          INT             PRIMARY KEY AUTO_INCREMENT,
    alias       VARCHAR(32)    NOT NULL UNIQUE,
    email       VARCHAR(32)    NOT NULL UNIQUE,
    fname       VARCHAR(32),
    lname       VARCHAR(32),
    password    CHAR(32)        NOT NULL
)
ENGINE=InnoDB;