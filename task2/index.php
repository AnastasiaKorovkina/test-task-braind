<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Задание №2</title>
</head>
<body>
	<h2>Задание 2. Помочь программисту Пете победить эрроры и ворнинги</h2>
	<p>Определи минимальное количество коммитов, нужное для исправления всех багов.<br></p>
	<h3>Введите значения N и M:</h3>
	<form method="POST">
		<label>N Fatal Error: <input type="number" name="n" min="0" max="1000" placeholder="0≤N≤1000"></label>
		<label>M warning: <input type="number" name="m" min="0" max="1000" placeholder="0≤M≤1000"></label>
		<input type="submit" value="Отправить"><br><br>
	</form>
	<?php 
		if ((isset($_POST['n'])) && (isset($_POST['m']))) {
			if ((empty($_POST['n'])) || (empty($_POST['m']))) 
				echo "-1 <br>Ошибок нет или какое-либо из значений не введено.";
			else {
				$n = $_POST['n'];
				$m = $_POST['m'];
				//echo "Пришло: $n и $m <br><br>";
				commit($n, $m);
			}
		} 

		function commit(&$err, &$warn) {
		$count = 0;	
			
			do {
				$temp_err = $err; //сохраняем предыдущий шаг
				$temp_warn = $warn; //сохраняем предыдущий шаг
				if ($err >= 2) { //т.к. задача минимаизация итераций - выбираем вариант с наибольшим весом
					$err-=2;
					//echo "if (err >= 2): $err, $warn <br><br>";
					check_deadlock($err, $warn, $temp_err, $temp_warn); //проверяем попадание в тупикокуй вариант
				} elseif ($warn >= 2) {
					$warn-=2;
					$err++;
					//echo "if (warn >= 2): $err, $warn <br><br>";
					check_deadlock($err, $warn, $temp_err, $temp_warn);	
				} else {
					//echo "else $err, $warn <br><br>";
					$warn--;
					$warn+=2;
				}
				$count++;
				//echo "$count шаг : $err, $warn <br><br>"; //проверка работоспособоности 
			} while (($err !== 0) || ($warn !== 0));

			echo "$count понадобилось";

		}

		function check_deadlock(&$err, &$warn, $prev_err, $prev_warn) {
			if (($err == 1) && ($warn == 0)) { //проверяем на попадание в тупик
				//echo "check_deadlock <br>";
				$err = $prev_err; //заменяем на значения с предыдущего шага
				$warn = $prev_warn;
				//echo "Откат на шаг назад к: $err, $warn <br>";  //проверка работоспособоности
				
				$warn--; //примеем другой варинт исправления warning
				$warn+=2; //
				//echo "шаг $count: $err, $warn <br>";
				//echo "end check_deadlock <br><br>";
			}
		}	
	 ?>
</body>
</html>