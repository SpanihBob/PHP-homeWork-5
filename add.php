<?php
                                                /* ПОЛУЧЕНЫЕ ПАРАМЕТРЫ ИЗ HTML */
    $product=trim(htmlspecialchars($_GET['newProduct']));
    $time=trim(htmlspecialchars($_GET['newTime']));                        //trim — Удаляет пробелы (или другие символы) из начала и конца строки
    $power=trim(htmlspecialchars($_GET['newPower']));                      //htmlspecialchars — Преобразует специальные символы в HTML-сущности\
    


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

                                            /* ВНЕКЛАССОВЫЕ ФУНКЦИИ */
     
      //функция проверки формы для добавления нового продукта
    function add($product, $time, $power) 
    {
        $product=trim(htmlspecialchars($product));                 
        $time=trim(htmlspecialchars($time));                        //trim — Удаляет пробелы (или другие символы) из начала и конца строки
        $power=trim(htmlspecialchars($power));                      //htmlspecialchars — Преобразует специальные символы в HTML-сущности
        if ($product == '') return false;
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
                                                    /* РАБОТАЕМ С КЛАССОМ */
    $myMicrowave = new Microwave();

    // функция добавления нового продукта
    
    if (add($product, $time, $power)) {       
        $getArray = $myMicrowave->getItems();

        $ar = array("arr" => $getArray );   //для преобразования в json создаем массив, добавляем в него все четыре параметра   
        echo json_encode($ar);      //Возвращает строку, содержащую JSON-представление предоставленной платформы
                                //в браузере http://<домен>/<имя php файла>.php?name=php&second=second
    }
    
    
       
        
    
  

?>