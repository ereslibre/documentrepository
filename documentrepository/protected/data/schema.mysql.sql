CREATE TABLE tbl_character(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    death_date DATE,
    biography LONGTEXT,
    image VARCHAR(255)
);

CREATE TABLE tbl_position(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE tbl_character_alias(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    character_id INTEGER NOT NULL,
    alias VARCHAR(255) NOT NULL
);

CREATE TABLE tbl_character_position(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    character_id INTEGER NOT NULL,
    position_id INTEGER NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE
);

CREATE TABLE tbl_collective(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT,
    image VARCHAR(255)
);

CREATE TABLE tbl_event(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT,
    start_date DATE NOT NULL,
    end_date DATE,
    image VARCHAR(255)
);

CREATE TABLE tbl_document(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    document VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description LONGTEXT
);

CREATE TABLE tbl_document_character(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    document_id INTEGER NOT NULL,
    character_id INTEGER NOT NULL
);

CREATE TABLE tbl_document_collective(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    document_id INTEGER NOT NULL,
    collective_id INTEGER NOT NULL
);

CREATE TABLE tbl_document_event(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    document_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL
);