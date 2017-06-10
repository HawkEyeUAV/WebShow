<?php
try {  
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=tencentcloud", "root", "19950419li");  
} catch (PDOException $e) {  
    echo 'Connection failed: ' . $e->getMessage();  
}  
$sql = "select * from home where id=(select max(id) from home)";    
$pdo->query('set names utf8;');  
$result = $pdo->query($sql);  
$rows = $result->fetchAll(); 
echo "当前环境状况为";
echo "<input type=button value=刷新 onclick='history.go(0)'>";
echo "<a href='./test.php'><input type=button value=查看详细信息 ></a>";
echo "<table border=1>";     //使用表格格式化数据
echo "<tr><td>序号</td><td>时间</td><td>温度</td><td>湿度</td><td>距离</td></tr>";
foreach ($rows as $row) {
echo  "<tr>";  
echo  "<td>".$row[0]."</td>";  
echo "<td>".$row[1]."</td>";
echo "<td>".$row[2]."</td>";
echo "<td>".$row[3]."</td>";
echo "<td>".$row[4]."</td>";
echo "</tr>";
}  
?>
