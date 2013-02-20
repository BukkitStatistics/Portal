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

    <script src="media/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="media/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="media/js/jquery.tablesorter.js" type="text/javascript"></script>
    <script src="media/js/jquery.pajinate.js" type="text/javascript"></script>
    <script src="media/js/initialize.js" type="text/javascript"></script>
</head>
<body>
<?php
Util::showMessages();
?>
<fieldset name="installation">
    <legend>Installation</legend>
    <form name="install" method="post" action="<?php echo fURL::getWithQueryString(); ?>">
        <?php
        $this->place('tpl');
        ?>
    </form>
</fieldset>
<?php

fCore::expose($_SESSION);

?>
</body>
</html>