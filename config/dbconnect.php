<?php
/**
 * Created by JetBrains PhpStorm.
 * User: wddqing
 * Date: 13-2-12
 * Time: 上午10:42
 * To change this template use File | Settings | File Templates.
 */

    define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","123");
    define("DB","paffaris");
    define("DB_CHARSET","UTF8");

    $conn = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die("connect error!");
    $db = mysql_select_db(DB,$conn) or die("select_db error!");

    mysql_query("set names ".DB_CHARSET) or die("charset error!");
