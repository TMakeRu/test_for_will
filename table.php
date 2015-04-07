#!/usr/bin/env php
<?php
if(!file_exists(__DIR__ . '/jsonData')){
    exit("Error! file not found\n");
}

// Получаем данные
$json = json_decode(file_get_contents(__DIR__ . '/jsonData'));
// Разделитель
$separation = "+----------+--------+-------+\n";
// Кол-во строк для шапки
$endHeader = 1;

if(count($json)>0){
    echo $separation;

    foreach($json as $i=>$row){
        if($i == $endHeader){
            echo $separation;
        }
        echo ' | ' . implode(' | ', $row)."\n";
    }

    if($endHeader != count($json) || count($json) == 1){
        echo $separation;
    }
} else {
    exit("Error! Empty data\n");
}
