<?php

$sql = "
CREATE TABLE IF NOT EXISTS Monster (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(16),
    health_min TINYINT,
    health_max TINYINT,
    strength_min TINYINT,
    strenth_max TINYINT,
    defence_min TINYINT,
    defence_max TINYINT,
    speed_min TINYINT,
    speed_max TINYINT,
    luck_min TINYINT,
    luck_max TINYINT
);
";

$db->executeQuery($sql);