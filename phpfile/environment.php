<?php
         session_start();
        $conn = new mysqli('127.0.0.1', 'root', '19950419li', 'tencentcloud');
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql="SELECT * FROM home";
        $result=$conn->query($sql);
        if ($result->num_rows > 0){
        echo "您家里的环境是这样的";
         echo '<table border="1"><tr><td>序号</td><td>时间</td><td>温度</td><td>湿度</td><td>距离</td></tr>';
        while($row =$result->fetch_field()){
      echo '<tr><td>'.$row['id'].'</td>';
      echo '<tr><td>'.$row['updatetime'].'</td>';
      echo '<tr><td>'.$row['tem'].'</td>';
      echo '<tr><td>'.$row['hum'].'</td>';
      echo '<td>'.$row['distance'].'</td></tr>';
   }
        }else{
        echo "没有您查询的信息";
        }
        $conn->close();
?>

