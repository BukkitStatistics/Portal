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


    <script src="media/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="media/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="media/js/functions.js" type="text/javascript"></script>
    <script src="media/js/initialize.js" type="text/javascript"></script>

    <?php $this->place('js'); ?>

    <link href="media/css/bootstrap.min.css" rel="stylesheet">
    <link href="media/css/yasp.css" rel="stylesheet">
    <link href="media/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="media/css/font-awesome.min.css" rel="stylesheet">

    <?php $this->place('css'); ?>

    <!--[if lt IE 9]>
    <script src="media/js/html5.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="./"><img class="logo-img" src="media/img/icon-default.png"> <?php echo $this->get('title'); ?></a>

            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li>
                        <p class="navbar-text">
                            Server status:
                            <?php
                                ServerStatistic::init();
                                if(ServerStatistic::getStatus()):
                            ?>
                            <span class='label label-success'>Online</span>
                            <?php else: ?>
                            <span class='label label-important'>Offline</span>
                            <?php endif; ?>
                        </p>
                    </li>
                    <li class="divider-vertical"></li>
                    <li id="admin-navi" class="dropdown">
                        <a id="drop3" class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">
                            Settings
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="drop3" role="menu">
                            <li role="menuitem"><a href="contents/default/settings/"><i class="icon-wrench"></i>
                                Settings</a></li>
                            <li role="menuitem"><a href="contents/default/logout/"><i class="icon-globe"></i>
                                Log out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>