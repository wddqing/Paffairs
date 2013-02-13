<?php
/**
 * Created by JetBrains PhpStorm.
 * User: wddqing
 * Date: 13-2-13
 * Time: 上午11:21
 * To change this template use File | Settings | File Templates.
 */
    include "../config/dbconnect.php";
    if(isset($_POST['sign']) && $_POST['sign'] != ""){
        $sql = "insert into signed(`message`,`times`,`del`) values('".$_POST['sign']."',0,1)";
        mysql_query($sql) or die('insert error!');
    }
    $sql = "select * from signed where del = 1 order by created_time desc";
    $response_message = mysql_query($sql);
    $sql = "select message_id,message,signed_time from signed,signed_session where signed.id = signed_session.message_id and signed.del = 1 order by signed_session.signed_time desc limit 15";
    $response_signed = mysql_query($sql);

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>
        Timeline
    </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css" >
    <script type="text/javascript" src="../TimelineJS-master/compiled/lib/jquery-min.js"></script >
    <script type="text/javascript" src="../js/main.js"></script >
</head>
<body>
<div class="pannel">
    <ul>
        <li>
            <img src="../images/woailuo.jpg" alt="wddqing" width="40px">
        </li>
        <li>
            <a class="visit" href="../index.php">My goals</a>
        </li>
        <li>
            <a class="visit" href="Paffaris.php">Pass view</a>
        </li>
        <li>
            <a class="visit" href="signed.php" >Signed daily</a >
        </li>
        <li>
            <a class="visit" href="#">about me</a>
        </li>

    </ul>
</div>
<br>
<h1>wddqing's signed daily!</h1>
<hr>
<h2>My goals!</h2>
<div class="display_message">
    <table>
        <tr>
            <th>Message</th>
            <th>Times</th>
            <th>Created_time</th>
            <th>Signed</th>
            <th>Delete</th>
        </tr>
        <?php
            while($result = mysql_fetch_array($response_message)){
                echo "<tr id='".$result['id']."1'><td>".$result['message']."</td>";
                echo "<td id=".$result['id'].">".$result['times']."</td>";
                echo "<td>".$result['created_time']."</td>";
                echo "<td><button onclick='signed(".$result['id'].");'>Signed</button></td>";
                echo "<td><button onclick='del(".$result['id'].");'>Delete</button></td></tr>";
            }
        ?>
    </table>
</div>
<hr>
<h2>Add new!</h2>
<div class="add_sign">
    <form action="signed.php" method="post">
        <table>
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Sign</td>
                <td>
                    <input type="text" name="sign">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit">
                </td>
                <td>
                    <input type="reset" >
                </td>
            </tr>
        </table>
    </form >
</div>
<hr>
<h2>Signed view!</h2>
<div class="display_signed">
    <table>
        <tr id="table_signed">
            <th>Message_id</th>
            <th>Message</th>
            <th>Signed_time</th>
        </tr>
        <?php
            while($result = mysql_fetch_array($response_signed)){
                echo "<tr><td style='text-align:center'>".$result['message_id']."</td>";
                echo "<td>".$result['message']."</td>";
                echo "<td>".$result['signed_time']."</td></tr>";
            }
        ?>
    </table>
</div>
<hr>
<?php
    include "../views/footer.php";
?>