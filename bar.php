<div class="row header">
    <ul class="bar">
        <li class="item" style="margin-left:1em;">
            <a href="index.php" style="color: black;">
                <h1 style="font-family:Trebuchet MS;">MessHub
                <?php
                if($_SERVER['PHP_SELF'] != "/menu.php"){
                    echo '<i class="fa fa-home" aria-hidden="true" style="margin-left: 16px;"></i>';
                }
                ?></h1>
            </a>
        </li>
        <li class="item" style="float: right; margin-right: 6px; margin-left: 36px;">
            <i class="fa fa-battery-full"></i>
            <br />
            <i class="fa fa-wifi"></i>
        </li>
        <li class="item" style="float: right; font-family: Trebuchet MS;">
            <div id="clock" align="right"></div>
            <div id="date" align="right"></div>
        </li>
        <li class="item" style="float: right">
            <span class="flag-icon flag-icon-gr"></span>
            <span class="flag-icon flag-icon-gb"></span>
            <span class="flag-icon flag-icon-sa"></span>
        </li>
    </ul>
</div>
