CREATE TABLE tbl_character(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    death_date DATE,
    biography LONGTEXT,
    image VARCHAR(255)
) ENGINE = InnoDB;

CREATE TABLE tbl_position(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE tbl_character_alias(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    character_id INTEGER NOT NULL,
    alias VARCHAR(255) NOT NULL,
    FOREIGN KEY(character_id) REFERENCES tbl_character(id) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE tbl_character_position(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    character_id INTEGER NOT NULL,
    position_id INTEGER NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    FOREIGN KEY(character_id) REFERENCES tbl_character(id) ON DELETE CASCADE,
    FOREIGN KEY(position_id) REFERENCES tbl_position(id) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE tbl_institution(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT,
    image VARCHAR(255)
) ENGINE = InnoDB;

CREATE TABLE tbl_event(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT,
    start_date DATE NOT NULL,
    end_date DATE,
    image VARCHAR(255)
) ENGINE = InnoDB;

CREATE TABLE tbl_document(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    document VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT
) ENGINE = InnoDB;

CREATE TABLE tbl_document_character(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    document_id INTEGER NOT NULL,
    character_id INTEGER NOT NULL,
    FOREIGN KEY(document_id) REFERENCES tbl_document(id) ON DELETE CASCADE,
    FOREIGN KEY(character_id) REFERENCES tbl_character(id) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE tbl_document_institution(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    document_id INTEGER NOT NULL,
    institution_id INTEGER NOT NULL,
    FOREIGN KEY(document_id) REFERENCES tbl_document(id) ON DELETE CASCADE,
    FOREIGN KEY(institution_id) REFERENCES tbl_institution(id) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE tbl_document_event(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    document_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL,
    FOREIGN KEY(document_id) REFERENCES tbl_document(id) ON DELETE CASCADE,
    FOREIGN KEY(event_id) REFERENCES tbl_event(id) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE tbl_user(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

INSERT INTO tbl_user(username, password, salt) VALUES ('admin', 'b31c416ca991736f4fb5f8479b90075f63921b13', 'akepm3l!/d');