<?php
session_start();
if(!isset($_SESSION['settings'])) {
    header("Location: /index.php");
}
if(isset($_POST['logout'])){
    unset($_SESSION['logintoken']);
}
?>

<html>
    <head>
        <title>MessHub</title>
        <link href="css/metro.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/flex.css" rel="stylesheet" type="text/css">
        <link href="css/menus.css" rel="stylesheet" type="text/css">
        <link href="css/flag-icon.min.css" rel="stylesheet" type="text/css">

        <script src="js/clock.js"></script>
        <script src="js/metro.min.js"></script>
        <script src="js/menuredirect.js"></script>
    </head>

    <body onload="startTime()">
        <div class="box">
            <?php include 'bar.php';?>

            <div class="row content">
                <div style="display: inline-block; margin: 3em;">
                    <button class="btn" onclick="buttonPress('dispense.php')">Dispense</button><br />
                    <button class="btn" onclick="window.open('http://www.bing.com')">Internet</button><br />
                    <?php
                    if (isset($_SESSION['logintoken'])) {
                        echo '<form method="POST" action="'. $_SERVER['PHP_SELF'] .'"><button class="btn red" type="submit" id="logout" name="logout">Log Out</button></form>';
                    }
                    ?>
                </div>
                <div class="sidebar">
                    <div class="sidebar item">
                        <h3 style="color: #333; font-family: Arial; border-bottom: 2px solid #444;">News</h3>
                        <!-- start feedwind code --><script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "https://news.google.com/news?cf=all&hl=el&pz=1&ned=el_gr&output=rss",rssmikle_frame_width: "100%",rssmikle_frame_height: screen.height*0.7-245,frame_height_by_article: "0",rssmikle_target: "_blank",rssmikle_font: "Arial, Helvetica, sans-serif",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "on",scrolldirection: "up",scrollstep: "10",mcspeed: "20",sort: "Off",rssmikle_title: "off",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#0066FF",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "55",rssmikle_item_title_color: "#0066FF",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "300",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><!-- end feedwind code --><!--  end  feedwind code -->
                    </div>
                    <div class="sidebar item">
                        <iframe id="forecast_embed" type="text/html" frameborder="0" height="245" width="100%" src="http://forecast.io/embed/#lat=38.0947427&lon=23.7930319&units=uk"> </iframe>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
