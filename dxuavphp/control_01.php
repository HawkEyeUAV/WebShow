<?php
//echo $_POST;
//if(isset($_GET["act"]) {
//    echo "1";
//  }
//header('Conent-type:type/html;charset=gb2312');
$i=$_POST['act'];
//$fh=fopen('./control.txt', 'a+');
//fwrite($fh, $i);
//fclose($fh);
switch($i){
case "left"; 
  shell_exec(" mosquitto_pub -t 'uav_cloud' -m 'print vehicle'");
  break;
case "right";
  shell_exec(" mosquitto_pub -t 'uav_cloud' -m 'print vehicle'");
  break;
case "up";
  shell_exec(" mosquitto_pub -t 'uav_cloud' -m 'print vehicle'");
  break;
case "down";
  shell_exec(" mosquitto_pub -t 'uav_cloud' -m 'print vehicle'");
  break;
default:
  echo "no cmd for this";
}


// header("Location:./control_01.html");
// exit;
// exit;
//  print_r($i);

//else{
// echo "close";
// shell_exec(" mosquitto_pub -t 'serial' -m '0'");
// header("refresh:0.0001;url=./control_01.html");
//header("Location:./control_01_html");
//exit;
//}
/*header('Content-Type:application/json;charset=utf-8');
$result = array();
$json = file_get_content("php://input");
$obj = json_decode($json);
$input = $obj->input;
$result("result") = "my name is:".$input;
echo json_encode($result);*/
?>


