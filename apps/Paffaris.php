<?php
    include "../config/dbconnect.php";


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
        <script type="text/javascript">
            var timeline_config = {
                width:              '100%',
                height:             '500',
                type:               'timeline',
                source:             '../data/json.json',
                embed_id:           'timeline-embed',               //OPTIONAL USE A DIFFERENT DIV ID FOR EMBED
                start_at_end:       false,                          //OPTIONAL START AT LATEST DATE
                start_at_slide:     '4',                            //OPTIONAL START AT SPECIFIC SLIDE
                start_zoom_adjust:  '5',                            //OPTIONAL TWEAK THE DEFAULT ZOOM LEVEL
                hash_bookmark:      true,                           //OPTIONAL LOCATION BAR HASHES
                font:               'Bevan-PotanoSans',             //OPTIONAL FONT
                debug:              true,                           //OPTIONAL DEBUG TO CONSOLE
                lang:               'zh-ch',                           //OPTIONAL LANGUAGE
                maptype:            'watercolor',                   //OPTIONAL MAP STYLE
                css:                '../TimelineJS-master/compiled/css/timeline.css',     //OPTIONAL PATH TO CSS
                js:                 '../TimelineJS-master/compiled/js/timeline-min.js'    //OPTIONAL PATH TO JS
            };


        </script>
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
    <h1>wddqing's timeline!</h1>
    <div id="timeline-embed"></div>
    <div id="show"></div>
    <script type="text/javascript" src="../TimelineJS-master/compiled/js/storyjs-embed.js"></script>


<?php
    include "../views/footer.php";
?>