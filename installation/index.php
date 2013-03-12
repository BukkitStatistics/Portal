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
    <link href="media/css/yasp.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="media/js/html5.min.js"></script>
    <![endif]-->

    <script src="media/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="media/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<?php
Util::showMessages();
?>
<div class="container page-width well-large">
    <img src="media/img/plugin_logo_small.png"/>
    <fieldset name="installation">
        <legend>Installation</legend>
        <form name="install" method="post" action="<?php echo fURL::getWithQueryString(); ?>" class="form-horizontal">
            <?php
            $this->place('tpl');
            ?>
        </form>
    </fieldset>
    <div class="row">
        <div class="pull-right">
            <small>Execution time: <?php echo round((float)array_sum(explode(' ', microtime())) - STARTTIME, 4); ?> seconds.</small>
        </div>
    </div>
</div>
</body>
</html>