<?php
    $products = 'product.txt';
    class Microwave
        {
            public $power;              //мощность
            public $time;               //время
            public $items = array();    //массив для хранения инфо о продукте

    //функция возвращает массив
        function getItems()             //возвращаем items
        {
            global $products;      //область видимости
            $file=fopen($products,'r');           //(fopen) Открывает файл (r) для чтения
            while($line=fgets($file, 128)) {        //fgets — Читает строку из файла
                $readProduct=substr($line,0,strpos($line,':'));              //вытаскиваем название продукта
                $newLine1 = str_replace($readProduct. ':', '', $line);          //убираем имя пользователя из строки            
                $readTime=trim(substr($newLine1,0,strpos($newLine1,':')));
                $readPower = str_replace($readTime. ':', '', $newLine1);     //убираем имя пользователя из строки            
                array_push($this->items, [$readProduct, $readTime, $readPower]);
            }
            return $this -> items;
        }

    //функция возвращает время
        function getTime()              //возвращаем time
        {
            return $this -> time;
        }

    //функция возвращает мощность
        function getPower()             //возвращаем power
        {
            return $this -> power;
        }
        
    //функция возвращает массив
        function setProduct($product, $time, $power)
        {
            global $products;      //область видимости
            $file=fopen($products,'r');           //(fopen) Открывает файл (r) для чтения
            while($line=fgets($file, 128)) {        //fgets — Читает строку из файла
                $readProduct=substr($line,0,strpos($line,':'));              //вытаскиваем название продукта
                $newLine1 = str_replace($readProduct. ':', '', $line);          //убираем имя пользователя из строки            
                $readTime=trim(substr($newLine1,0,strpos($newLine1,':')));
                $readPower = str_replace($readTime. ':', '', $newLine1);     //убираем имя пользователя из строки            
                array_push($this->items, [$readProduct, $readTime, $readPower]);
            }        
        }

    //функция возвращает массив
        function setTime($time)         //устанавливаем time
        {
            $this -> time = $time;
        }

    //функция возвращает массив
        function setPower($power)         //устанавливаем power
        {
            $this -> power = $power;
        }
    }



                                                                    /* НЕ КЛАССОВЫЕ ФУНКЦИИ */
//функция проверки формы
        function enter($product, $time, $power) 
        {
            $time=trim(htmlspecialchars($time));                        //trim — Удаляет пробелы (или другие символы) из начала и конца строки
            $power=trim(htmlspecialchars($power));                      //htmlspecialchars — Преобразует специальные символы в HTML-сущности
            $product=trim(htmlspecialchars($product));    
                if($time && $power)
                {
                    return true;
                } 
                return false;
        }

//функция проверки формы для добавления нового продукта в текстовый файл
        function add($product, $time, $power) 
        {
            $product=trim(htmlspecialchars($product));                 
            $time=trim(htmlspecialchars($time));                        //trim — Удаляет пробелы (или другие символы) из начала и конца строки
            $power=trim(htmlspecialchars($power));                      //htmlspecialchars — Преобразует специальные символы в HTML-сущности

            //блок проверки уникальности продукта
            global $products;      //область видимости
            $file=fopen($products,'a+');           //(fopen) Открывает файл (a+) для записи и чтения
            while($line=fgets($file, 128)) {        //fgets — Читает строку из файла
                $readProduct=substr($line,0,strpos($line,':'));              //mb_substr — Возвращает часть строки, strpos — Находит позицию первого вхождения подстроки в строку
                if($readProduct == $product) {
                    return false;
                }
            }

            //блок добавления нового продукта
            $line=$product.':'.$time.':'.$power."\r\n";   
            fputs($file,$line);     //fputs — Псевдоним fwrite() — Бинарно-безопасная запись в файл
            fclose($file);          //fclose — Закрывает открытый дескриптор файла
            return true;

            if($product && $time && $power)
                {
                    return true;
                } 
                else 
                {
                    return false;
                }
        }
        
?>