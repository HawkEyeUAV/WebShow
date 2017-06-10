<?php
if (isset($_POST['lng'])){
$i = $_POST['lng'];
$j = $_POST['lat'];
$groPoint = $i."a".$j;
 shell_exec(" mosquitto_pub -t 'uav_cloud' -m {$groPoint}");
} 
try {  
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=tencentcloud", "root", "19950419li");  
} catch (PDOException $e) {  
    echo 'Connection failed: ' . $e->getMessage();  
}  
$sql = "select lng,lat from dxuav where id=(select max(id) from dxuav)"; 
$arr=array();
$data = array();
class User{
    public $LNG;
    public $LAT;
}   
$pdo->query('set names utf8;');  
$result = $pdo->query($sql);  
$rows = $result->fetchAll(); 
//echo "<table border=1>";     //使用表格格式化数据
//echo "<tr><td>序号</td><td>温度</td></tr>";
foreach ($rows as $row) {
    $user = new User();
    $user->LNG = $row['lng'];
    $user->LAT = $row['lat'];
    $arr[] = $user;
//echo  "<tr>";  
//echo  "<td>".$row[0]."</td>";  
//echo "<td>".$row[1]."</td>";
//echo "</tr>";
} 
 $data=json_encode($arr);
 echo $data;
//ignore_user_abort(true);
//set_time_limit(0);
//$size = ob_get_length();
 // send headers to tell the browser to close the connection
// header("Content-Length: $size");
 //header('Connection: close');
 //ob_end_flush();
 //ob_flush();
 //flush();

 /******** background process starts here ********/
// ignore_user_abort(true);//在关闭连接后，继续运行php脚本
 /******** background process ********/
// set_time_limit(0); //no time limit，不设置超时时间（根据实际情况使用）
 /******** Rest of your code starts here ********/
 //继续运行的代码  
?>
