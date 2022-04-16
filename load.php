<?php
                                                /* КЛАСС "МИКРОВОЛНОВАЯ ПЕЧЬ" */
    $products = 'product.txt';
    class Microwave
                {
                    public $items = array();    //массив для хранения инфо о продукте

                function getItems()             //возвращаем items
                {
                    global $products;      //область видимости
                    $file=fopen($products,'r');           //(fopen) Открывает файл (r) для чтения
                    while($line=fgets($file, 128)) {        //fgets — Читает строку из файла
                        $readProduct=substr($line,0,strpos($line,':'));              //вытаскиваем название продукта
                        $newLine1 = str_replace($readProduct. ':', '', $line);          //убираем имя пользователя из строки            
                        $readTime=trim(substr($newLine1,0,strpos($newLine1,':')));
                        $readPower = str_replace($readTime. ':', '', $newLine1);     //убираем имя пользователя из строки     
                        $readPower = preg_replace('/[^0-9]/', '', $readPower);        
                        array_push($this->items, [$readProduct, $readTime, $readPower]);
                    }
                    return $this -> items;
                }
            }
                                                    /* РАБОТАЕМ С КЛАССОМ */
    $myMicrowave = new Microwave();  
    $getArray = $myMicrowave->getItems();
    $ar = array("arr" => $getArray );   //для преобразования в json создаем массив, добавляем в него все четыре параметра   
    echo json_encode($ar);      //Возвращает строку, содержащую JSON-представление предоставленной платформы
                                //в браузере http://<домен>/<имя php файла>.php?name=php&second=second
?>