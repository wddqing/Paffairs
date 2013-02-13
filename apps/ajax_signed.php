<?php
/**
 * Created by JetBrains PhpStorm.
 * User: wddqing
 * Date: 13-2-13
 * Time: 下午12:11
 * To change this template use File | Settings | File Templates.
 */
    include "../config/dbconnect.php";

    if(isset($_POST['message_id'])){
        header("Content-type:text/json");
        $sql = "update signed set times = times + 1 where id = ".$_POST['message_id'];
        mysql_query($sql) or die("update error!");
        $sql = "insert into signed_session(`message_id`) values ('".$_POST['message_id']."')";
        mysql_query($sql) or die("insert error!");
        $sql = "select times from signed where id = ".$_POST['message_id'];
        $times = mysql_fetch_array(mysql_query($sql));
        $times = $times['times'];
        $sql = "select signed.id,signed.message,signed_time from signed,signed_session where signed.id = signed_session.message_id and signed.id = ".$_POST['message_id']." order by signed_session.signed_time desc limit 1";
        $signed = mysql_query($sql);
        $signed = mysql_fetch_array($signed);
        $signed = "<tr><td style='text-align:center'>".$signed['id']."</td><td>".$signed['message']."</td><td>".$signed['signed_time']."</td></tr>";
        $json['times'] = $times;
        $json['signed'] = $signed;
        echo json_encode($json);
    }
    if(isset($_GET['message_id'])){
        $sql = "update signed set del = 0 where id = ".$_GET['message_id'];
        mysql_query($sql) or die('update error!');
        echo "success";
    }
?>