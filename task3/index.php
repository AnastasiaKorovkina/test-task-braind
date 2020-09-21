<?php
    if ((isset($_POST['n'])) && (isset($_POST['k']))) {
        if ((empty($_POST['n'])) || (empty($_POST['k']))) {
            echo "Введите значения";
        } else {
            //$n = 121;
            //$k = 5;
            $n = $_POST['n'];
            $k = $_POST['k'];

            $base = 10; //основание системы счисления
            $arr = range(0, $n); //создаем массив от 0 до n

            $count = ($n !== 0) ? floor(log10($n) + 1) : 1; //находим количество разрядов в числе
            //echo "Разрядов в числе: $count<br>";

            /*for ($i = 0; $i < count($arr); $i++) { //проверка работоспособности
                echo "$arr[$i]<br>";
            }*/

            $arr_res = array();
            //основываясь на основание системы счисления, выбираем ряды чисел
            //срезаем значения из исходного массива для каждой цифры j (1..9) длиной 10^разрядности i
            //каждый полученный массив заносим в конец массива $arr_res
            for ($j = 1; $j < $base; $j++) { // перебираем цифры
                for ($i = 0; $i < $base; $i++) { //перебираем разряды в числе
                    //print_r(array_slice($arr, $j*pow(10, $i), 1*pow(10, $i)));
                    //$arr_res[] = array_merge(array_slice($arr, $j*pow(10, $i), 1*pow(10, $i)));
                    $arr_res[] = array_slice($arr, $j*pow($base, $i), 1*pow($base, $i));
                }
            }
            $arr_res = call_user_func_array('array_merge', $arr_res); // преобразуем многомерный массив в одномерный

            print_r($arr_res);  //выводы для проверки работы
            echo "<br>Результат: <br>";
            /*for ($i = 0; $i < count($arr_res); $i++) { //проход по массиву
                echo "$arr_res[$i] , ";
            }
            echo "<br>";*/

            $key_res = array_search($k, $arr_res) + 1; //находим место интересующего нас числа в массиве
            echo "Значение $k находится на месте $key_res";
        }
    }

