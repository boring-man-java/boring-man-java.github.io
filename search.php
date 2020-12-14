<?php
header('Content-type:text/json; charset=utf-8');
@ $db = mysqli_connect('localhost','root','');
mysqli_query($db,"set names utf8;");
mysqli_select_db($db,'mpicture');//找到数据库mpicture
if(mysqli_connect_errno()){
 echo "Error:Could not connect to mysqli database.";
 exit;
}
$keyword=$_GET['keyword'];
$q="SELECT count(*) FROM picture where title like '%$keyword%'";
$result1 = mysqli_query($db,$q);
$row1 = mysqli_fetch_array($result1);
$allnum=$row1[0];
//echo $allnum;
$k="SELECT * FROM picture where title like '%$keyword%';";//对表picture进行选择
$result = mysqli_query($db,$k);//执行$k的mysql语句，并赋给result
$rownum = mysqli_num_rows($result);//获取result的数据数量
$picture=array(array());
for($i=0;$i<$rownum;$i++){
    $row = mysqli_fetch_assoc($result);//获取result的一条数据
	$picture[0][$i]= $row['path1'];//获得缩略图的路径
	$picture[1][$i]= $row['path2'];//获得全图的路径
	$picture[2][$i]= $row['title'];//获得文字描述
	$picture[3][$i]= $row['Id'];//获得id
}
$picture[4][0]=$allnum;
echo json_encode($picture);
?>
