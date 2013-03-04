<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
    foreach($this->get('header_additions') as $row)
        echo $row . "\n";
    ?>
    <title><?php echo $this->get('title'); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="media/css/bootstrap.min.css" rel="stylesheet">
    <link href="media/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="media/css/font-awesome.min.css" rel="stylesheet">
    <link href="media/css/tablesorter.css" rel="stylesheet">
    <link href="media/css/yasp.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="../media/js/html5.min.js"></script>
    <![endif]-->
</head>
<body data-spy="scroll" data-target="#menubar">
<?php
$this->place('tpl');
?>

<hr>

<footer>
    <div class="row-fluid">
        <div class="span10 offset2">
            <div class="row-fluid">
                <div class="span2"><p><a href="https://github.com/bitWolfy/YetAnotherStatisticsPlugin"><img
                        src="media/img/plugin_logo_small.png" alt="YASP"/></a></p></div>
                <div class="span4"><p style="position:relative; top:5px;">&copy; 2013 Yet Another Statistics
                    Plugin<br/>Based on <a href="http://dev.bukkit.org/server-mods/statisticianv2/" target="_blank">Statistician
                        2</a> technology</p></div>
                <div class="span4 offset2" style="text-align: right;"><p>Running database
                    version DEV</p>
                    <small>Execution time: <?php echo round(microtime() - STARTTIME, 8); ?> seconds.</small>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="media/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="media/js/bootstrap.min.js" type="text/javascript"></script>
<script src="media/js/jquery.tablesorter.js" type="text/javascript"></script>
<script src="media/js/jquery.pajinate.js" type="text/javascript"></script>
<script src="media/js/initialize.js" type="text/javascript"></script>
</body>
</html>