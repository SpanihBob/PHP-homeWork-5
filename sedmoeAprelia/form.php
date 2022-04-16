<?php
    include_once "function.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Site1</title>
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="text-center">
    <h3>Microwave oven</h3>
    <main class="form-signin">
        <form action="" method="get" style="width: 400px; margin: auto;">

            <!-- input для ввода нового продукта -->
            <div class="form-group">
                <label for="newProduct">Product:</label>
                <input type="text" class="form-control" name="newProduct" placeholder="новый продукт">
            </div>

            <!-- выводим  из массива данные в select -->
            <div class="form-group">
                <label for="inputSelect">Products:</label>
                <select class="form-control" name="inputProducts" placeholder="список продуктов">
                    <?php       
            //функция выводит из массива данные в select                    
                        $myMicrowave = new Microwave();
                        $arr = $myMicrowave->getItems();
                        for ( $i = 0; $i < count($arr); $i++)
                        {
                            echo '<option>'. $arr[$i][0] .'</option>';
                        }
                    ?>
                </select>
            </div>

            <!-- input для ввода нового времени -->
            <div class="form-group">
                <label for="inputTime">Time:</label>
                <input type="number" class="form-control" name="inputTime" required placeholder="время приготовления">
            </div>

            <!-- input для ввода мощности -->
            <div class="form-group">
                <label for="inputPower">Power:</label>
                <input type="number" class="form-control" name="inputPower" required placeholder="мощность">
            </div>

            <!-- кнопка ввода данных -->
            <div class="form-group">
                <button type="submit" style="margin-top: 20px" class="w-100 btn btn-lg btn-primary" name="inputbtn">Enter</button>
            </div>

            <!-- кнопка добавления нового продукта в список -->
            <div class="form-group">
                <button type="submit" style="margin-top: 20px" class="w-100 btn btn-lg btn-primary" name="addbtn">Add</button>
            </div>
        </form>
    </main>
    <?php
        // функция добавления нового продукта
        if(add($_GET['newProduct'], $_GET['inputTime'], $_GET['inputPower']))
        {
            $product=trim(htmlspecialchars($_GET['newProduct']));
            $time=trim(htmlspecialchars($_GET['inputTime']));                        //trim — Удаляет пробелы (или другие символы) из начала и конца строки
            $power=trim(htmlspecialchars($_GET['inputPower']));                      //htmlspecialchars — Преобразует специальные символы в HTML-сущности\
            $myMicrowave->setProduct($product, $time, $power);
            $array = $myMicrowave->getItems();
            // var_dump($array);
        }
    ?>
    <?php
        // функция изменения данных пользователем
        if(enter($_GET['inputProducts'], $_GET['inputTime'], $_GET['inputPower'])) {           //если функция выдает true
            $time=trim(htmlspecialchars($_GET['inputTime']));                        //trim — Удаляет пробелы (или другие символы) из начала и конца строки
            $power=trim(htmlspecialchars($_GET['inputPower']));                      //htmlspecialchars — Преобразует специальные символы в HTML-сущности
            $product=trim(htmlspecialchars($_GET['inputProducts']));
            $myMicrowave->setTime($time);
            $myMicrowave->setPower($power);            
            echo "<br>";
            echo "<div style='width: 400px; margin:auto;' class='form-group'><h3 class='w-100 btn btn-lg btn-primary'>время: ". $myMicrowave->getTime() ."</h3><h3 class='w-100 btn btn-lg btn-primary'>мощность: ". $myMicrowave->getPower() ."</h3></div>";               
        }
    ?>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>