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


    <script src="media/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="media/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="media/js/jquery.tablesorter.js" type="text/javascript"></script>
    <script src="media/js/jquery.pajinate.js" type="text/javascript"></script>
    <script src="media/js/initialize.js" type="text/javascript"></script>

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
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container force-center">
            <a class="brand" href="../">
                LOGOURL
            </a>


            <ul class="nav pull-right">
                <li>
                    <a> <?php if($this->get('online')) {
                        echo "Server status: <span class='label label-success'>Online</span>";
                    }
                    else {
                        echo "Server status: <span class='label label-important'>Offline</span>";
                    } ?> </a>
                </li>
                <?php if($this->get('login') == "Guest") {
                echo '<li><a href="?page=login">Log in</a></li>';
            }
            else {
                ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdwn"
                       data-target="#"><?php echo $this->get('login'); ?><b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li role="menuitem"><a href="contents/default/settings/"><i class="icon-wrench"></i>
                            Settings</a></li>
                        <li role="menuitem"><a href="contents/default/logout/"><i class="icon-globe"></i> Log out</a>
                        </li>
                    </ul>
                </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span2">
            <div class="nav sidebar-nav well" style="position: fixed;" id="menubar">
                <ul class="nav nav-list">
                    <li><a href="#dashboard"><i class="icon-tasks"></i> Dashboard</a></li>
                    <li class="divider"></li>
                    <li><a href="#players"><i class="icon-group"></i> Players</a></li>
                    <li><a href="#world"><i class="icon-picture"></i> World</a></li>
                    <li><a href="#deaths"><i class="icon-tint"></i> Death Log</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php
$this->place('tpl');
?>
</div>
<hr>

<footer>
    <div class="row-fluid">
        <div class="span10 offset2">
            <div class="row-fluid">
                <div class="span2">
                    <p>
                        <a href="https://github.com/bitWolfy/YetAnotherStatisticsPlugin"><img
                                src="media/img/plugin_logo_small.png" alt="YASP"/>
                        </a>
                    </p>
                </div>
                <div class="span4">
                    <p style="position:relative; top:5px;">&copy; <?php echo date('Y'); ?> Yet Another Statistics Plugin
                </div>
                <div class="span4" style="text-align: right;">
                    <p>Running database version DEV
                    </p>
                    <small id="execution_time">
                        Execution time: <?php echo round((float)array_sum(explode(' ', microtime())) - STARTTIME, 4); ?>
                        seconds.
                    </small>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>