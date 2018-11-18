<?php
header('Content-Type: text/html; charset=utf-8');

     $host = 'a248429.mysql.mchost.ru'; // адрес сервера 
$database = 'a248429_ips'; // имя базы данных
$user = 'a248429_ips'; // имя пользователя
$password = '00217365'; // пароль


//PDO
$db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);

try
{
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
}
catch(  PDOException $e  )
{
    echo "You have an error: ".$e->getMessage()."<br>";
    echo "On line: ".$e->getLine();
}

$db->query('SET CHARACTER SET utf8'); 
//$db->execute();

$my_array = array('x'=>30.32, 'y'=>24.32, 'z'=>432.2, 'color'=>'втеств'); 
$res =   $db->query('SELECT * FROM sources');
$result = $res->FETCHALL(PDO::FETCH_ASSOC);
 echo   json_encode($result);
/*

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
   $query ="SELECT * FROM sources WHERE source_id = 1";
      $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));  
      $rows_pr=mysqli_fetch_array($result);
      //sss
      $php_arr = array('id'=>45, 'uid'=>168752145, 'developers'=>'Крендель');
$my_array = array('id'=>$rows_pr[0], 'name'=>$rows_pr[1], 'ip'=>$rows_pr[2],  'year'=>$rows_pr[3], 'developers'=>$rows_pr[4]); 
//$otv = $result->fetch_array(MYSQLI_ASSOC);
header('Content-Type: application/json');
           echo   json_encode($php_arr);

      //echo $result;
      
	

mysqli_close($link);
*/
?>