<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ title }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    {% for header_add in header_additions %}
        {{ header_add|raw }}
    {% endfor %}

    <link href="media/css/bootstrap.min.css" rel="stylesheet">
    <link href="media/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="media/css/style.css"/>

    <!--[if lt IE 9]>
    <script src="media/js/html5.min.js"></script>
    <![endif]-->

    <script src="media/js/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="media/js/bootstrap.min.js" type="text/javascript"></script>

    <style type="text/css">
        .section-{{ staticCall('fRequest', 'get', ['step', 'string', 'one']) }} {
            color: #fff;
            background: #70C68D;
        }

        .language-form select {
            margin-right: 20px;
        }

        {% for i in 0..install_pos - 1 %}
        .complete-{{ i }} {
            color: #fff;
            background: #33AD5C;
        }
        {% endfor %}

        .center {
            text-align: center;
        }

        .center-icon {
            padding-top: 15px;
            text-align: center;
        }

        .logo {
            margin-bottom: 15px;
        }

    </style>
</head>
<body>
{{ Util.showMessages() }}
<div class="force-center logo">
    <img src="media/img/plugin_logo.png" alt="Statistics"/>
</div>
<section id="page-{{ staticCall('fRequest', 'get', ['step', 'string', 'one']) }}">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="well well-sm center section-one complete-0">
                    <h4>Language</h4>
                </div>
            </div>
            <div class="col-md-1">
                <div class="muted center-icon">
                    <i class="fa fa-chevron-circle-right fa-2x"></i>
                </div>
            </div>
            <div class="col-md-2">
                <div class="well well-sm center section-two complete-1">
                    <h4>Database</h4>
                </div>
            </div>
            <div class="col-md-1">
                <div class="muted center-icon">
                    <i class="fa fa-chevron-circle-right fa-2x"></i>
                </div>
            </div>
            <div class="col-md-2">
                <div class="well well-sm center section-four complete-3">
                    <h4>Settings</h4>
                </div>
            </div>
            <div class="col-md-1">
                <div class="muted center-icon">
                    <i class="fa fa-chevron-circle-right fa-2x"></i>
                </div>
            </div>
            <div class="col-md-2">
                <div class="well well-sm center section-five">
                    <h4>Finish</h4>
                </div>
            </div>
            <div class="col-md-1">
                <div class="muted center-icon">
                    <i class="fa fa-check fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top: 25px;">
        <div class="well">
            {% include tpl %}
        </div>
    </div>
</section>

</body>
</html>