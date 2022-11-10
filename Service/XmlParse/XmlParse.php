<?php

namespace Service\XmlParse;

use PDO;
use Service\XmlParse\Car;
use Service\XmlParse\Database;


class XmlParse extends Car
{

    private $conn;

    public function __construct($db) 
    {
        $this->conn = $db;
    }

    public function StartXmlParse()
    {
        $xml = file_get_contents('xml_files/data.xml');
        $xml_parse = simplexml_load_string($xml);
        
        // выборка всех generation_id и id из файла xml
        foreach($xml_parse->offers->offer as $key => $value) { 

           $generation_id_arr[] = (string) $value->{'generation_id'};    
           $id_xml_arr[] = (string) $value->id;
        }
               
       $this->conn->connect();
        
        
        // выборка всех generation_id и id из таблицы 
        $result = $this->read();
        if(!empty($result)) {
            
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $db_generation_id_arr[] = $row['generation_id'];
            $db_id_arr[] = $row['id'];
        }
        }
        // если в таблице нет записей, заполняем таблицу строками из xml файла
        if(empty($db_generation_id_arr)) {
            foreach($xml_parse->offers->offer as $value) {
                    
                $result = $this->create($value);   
            }
        }
        
        
        // если в базе нет записей, которые есть в xml файле, добавляем эти записи
         
         $res = array_diff($generation_id_arr, $db_generation_id_arr);
        //  $res - массив данных generation_id и id, которых еще нет в базе. 
        if(!empty($res)) {
           
        foreach($xml_parse->offers->offer as $value) {

            foreach($res as $val) {

                if($value->generation_id == $val) {
           
                    $result = $this->create($value);    
           }
          }
        }
            if($result === true) {

            echo 'Записи в таблице обновлены';
        }
        }
        
        // комбинируем и сравниваем значения id и generation_id из xml файла с данными таблицы 
        $array_values_xml = array_combine($id_xml_arr, $generation_id_arr);
        $array_values_db = array_combine($db_id_arr, $db_generation_id_arr);
        $res_keys_value = array_diff_key($array_values_db, $array_values_xml);
        
        
        if(!empty($res_keys_value)) {
        foreach($res_keys_value as $key => $val) {
             
               $result = $this->delete($key, $val);
            if($result === true) {
                echo 'Из таблицы удалены ненужные записи';
            }
          }
       }    
    }  
 }


