<?php 

$database = "CREATE DATABASE data_xml";
 
$table = "CREATE TABLE cars
(
    id INT PRIMARY KEY,
    mark VARCHAR(25),
    model VARCHAR(25),
    generation VARCHAR(30),
    `year` INT,
    run INT,
    color VARCHAR(25),
    `body-type` VARCHAR(25),
    `engine-type` VARCHAR(25),
    transmission VARCHAR(25),
    `gear-type` VARCHAR(25),
    generation_id VARCHAR(25),
)";

$unique_index = "ALTER IGNORE TABLE `table` ADD UNIQUE INDEX(id, generation_id)";
 






?>