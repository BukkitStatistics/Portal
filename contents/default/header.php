<!-- <header> -->
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
    <link href="media/css/style.css" rel="stylesheet">
    <link href="media/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="media/css/font-awesome.min.css" rel="stylesheet">

    <?php $this->place('css'); ?>

    <!--[if lt IE 9]>
    <script src="media/js/html5.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- <navbar> -->

<div class="navbar navbar-fixed-top" style="position: static !important;">
    <div class="navbar-inner">
        <div class="container page-width">

            <!-- Icon -->
            <img class="pull-left header-icon" src="media/img/icon-default.png"
                 alt="logo"/>

            <!-- Project Name -->
            <a class="brand" href="./"><?php echo $this->encode('title'); ?></a>

            <ul class="nav pull-right">
                <li>
                    <!-- Online status -->
                    <?php if(ServerStatistic::getStatus()): ?>
                    <span class="btn btn-success disabled">Online</span>
                    <?php else: ?>
                    <span class="btn btn-danger disabled">Offline</span>
                    <?php endif; ?>
                </li>
                <li class="divider-vertical"></li>
                <li>
                    <!-- Search form -->
                    <form class="navbar-form" method="get">
                        <input type="hidden" name="page" value="player">
                        <div class="input-append">
                            <input type="text" name="name" class="" placeholder="Player" id="playerSearch" autocomplete="off">
                            <button class="btn" type="button">Search</button>
                        </div>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</div>

<!-- </navbar> -->

<!-- </header> -->