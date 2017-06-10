<?php
try {  
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=tencentcloud", "root", "19950419li");  
} catch (PDOException $e) {  
    echo 'Connection failed: ' . $e->getMessage();  
}  
$sql = "select updatetime,tem from home"; 
$arr=array();
$data = array();
class User{
    public $UPDATE;
    public $TEM;
}   
$pdo->query('set names utf8;');  
$result = $pdo->query($sql);  
$rows = $result->fetchAll(); 
//echo "<table border=1>";     //使用表格格式化数据
//echo "<tr><td>序号</td><td>温度</td></tr>";
foreach ($rows as $row) {
    $user = new User();
    $user->UPDATE = $row['updatetime'];
    $user->TEM = $row['tem'];
    $arr[] = $user;
//echo  "<tr>";  
//echo  "<td>".$row[0]."</td>";  
//echo "<td>".$row[1]."</td>";
//echo "</tr>";
} 
 $data=json_encode($arr);
 echo $data; 
?>
