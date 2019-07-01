<?php

$sql = "
CREATE TABLE IF NOT EXISTS Skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(16),
    chance TINYINT,
    description VARCHAR(256),
    type BOOLEAN,
    multiplier SMALLINT,
    hero_id INT,
    CONSTRAINT FK_Skills FOREIGN KEY (hero_id) REFERENCES Hero(id)
);
";

$db->executeQuery($sql);