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

    <style type="text/css">
        .section-<?php echo fRequest::get('step', 'string', 'one'); ?> {
            color: #fff;
            background: #70C68D;
        }

        .language-form select {
            margin-right: 20px;
        }

        <?php
            $ar = array('one', 'two', 'three', 'four', 'converter', 'process', 'five');
            for($i = 0; $i < array_search(fRequest::get('step', 'string', 'one'), $ar); $i++):
        ?>
        .complete-<?php echo $i; ?> {
            color: #fff;
            background: #33AD5C;
        }
        <?php endfor; ?>

    </style>
</head>
<body>
<?php
Util::showMessages();
?>
<div class="force-center">
    <img src="media/img/plugin_logo.png" alt="Statistics"/>
</div>
<section id="page-<?php echo fRequest::get('step', 'string', 'one') ?>">
    <div class="container page-width install-container">
        <div class="row-fluid">
            <div class="section-one complete-0 muted span2 well well-small center">
                <h4>Language</h4>
            </div>
            <div class="muted span1 center">
                <h1>
                    <i class="icon-chevron-right"></i>
                </h1>
            </div>
            <div class="section-two complete-1 muted span2 well well-small center">
                <h4>Database</h4>
            </div>
            <div class="muted span1 center">
                <h1>
                    <i class="icon-chevron-right"></i>
                </h1>
            </div>
            <div class="section-four complete-3 muted span2 well well-small center">
                <h4>Settings</h4>
            </div>
            <div class="muted span1 center">
                <h1>
                    <i class="icon-chevron-right"></i>
                </h1>
            </div>
            <div class="section-five section-converter section-process muted span3 well well-small center">
                <h4>Confirm / Import</h4>
            </div>
        </div>
    </div>
    <div class="container page-width install-container" style="padding-top: 25px;">
        <div class="well">
            <?php $this->place('tpl'); ?>
        </div>
    </div>
</section>

</body>
</html>