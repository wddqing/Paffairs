<?php
/**
 * Created by JetBrains PhpStorm.
 * User: wddqing
 * Date: 13-2-12
 * Time: 上午11:27
 * To change this template use File | Settings | File Templates.
 */

    if(isset($_POST['goal']) && $_POST['goal'] != ''){
        $sql = "insert into main(`goal`,`done`) values ('".$_POST['goal']."',0)";
        mysql_query($sql) or die('insert error!');
    }
    if(isset($_POST['selected'])){
        $sql = "update main set done = 1,endtime = now() where ";
        $length = strlen($sql);
        foreach ($_POST as $key => $value) {
            if($key != 'goal' and $key != 'selected'){
                $sql .= "id = ".$value." or ";
            }
        }
        if($length < strlen($sql)){
            $sql = substr($sql, 0,strlen($sql)-4);
            mysql_query($sql) or die("update error!");
            $sql = "select * from main where done = 1 order by time desc limit 10";
            $response_done = mysql_query($sql) or die('select error!');
            $json = array('timeline'=>array());
            $json['timeline']['headline'] = "wddqing's pass view";
            $json['timeline']['type']="default";
            $json['timeline']['text']="It is hard for me!";
            $json['timeline']['stratDate']="2013,1,1";
            $json['timeline']['date']=array();
            while($result = mysql_fetch_array($response_done)){
                $json['timeline']['date'][]=array(
                    "startDate"=>date("Y,m,d,H",strtotime($result['time'])),
				    "endDate"=>date("Y,m,d,H",strtotime($result['endtime'])),
                    "headline"=>$result['goal']
                );
            }

            $json = json_encode($json);
            //echo $json;
            $fp = fopen("data/json.json","w");
            fputs($fp,$json);
            fclose($fp);
        }
    }

    $sql = "select * from main where done = 1 order by endtime desc limit 10";
    $response_done = mysql_query($sql) or die('select error!');
    $sql = "select * from main where done != 1";
    $response_never = mysql_query($sql) or die('select error!');

?>
<h1>Wddqing's goal!</h1><p/>
<hr />
<h2>Will Do!</h2>
<div class="display_never">
    <table>
        <tr>
            <th>Goal</th>
            <th>Will Do</th>
            <th>Time</th>
        </tr>
        <form action="index.php" method="post">
            <?php
            while($result = mysql_fetch_array($response_never)){
                echo "<tr><td>".$result['goal']."</td>";
                echo "<td><input name='selected".$result['id']."' type='checkbox' value='".$result['id']."'></td>";
                echo "<td>".$result['time']."</td></tr>";
            }
            ?>
            <tr>
                <td><input type="hidden" name="selected"></td>
                <td>&nbsp;</td>
                <td><input type="submit"></td>
            </tr>
        </form>

    </table>
</div>
<hr />
<h2>Add New!</h2>
<div class="add">
    <form action="index.php" method="post">
        <table>
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Goal</td>
                <td><input name="goal" type="text" /></td>
            </tr>
            <tr>
                <td><input type="submit"></td>
                <td><input type="reset"></td>
            </tr>
        </table>
    </form>
</div>
<hr />
<h2>Had Done!</h2>
<div class="display_done">
    <table>
        <tr>
            <th>Goal</th>
            <th>Done</th>
            <th>Time</th>
            <th>EndTime</th>
        </tr>

            <?php
            while($result = mysql_fetch_array($response_done)){
                echo "<tr><td>".$result['goal']."</td>";
                echo "<td>Done</td>";
                echo "<td>".$result['time']."</td>";
                echo "<td>".$result['endtime']."</td></tr>";
            }
            ?>

    </table>
</div>