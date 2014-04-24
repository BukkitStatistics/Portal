<!-- <header> -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>{{ title }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    {% for header_add in header_additions %}
        {{ header_add }}
    {% endfor %}

    <script src="media/js/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="media/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="media/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
    <script src="media/js/functions.js" type="text/javascript"></script>
    <script src="media/js/initialize.js" type="text/javascript"></script>

    {% for ele in js %}
    <script type="text/javascript" src="{{ ele }}"></script>
    {% endfor %}

    <link href="media/css/bootstrap.min.css" rel="stylesheet">
    <link href="media/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="media/css/style.css" rel="stylesheet">
    <link href="media/css/font-awesome.min.css" rel="stylesheet">

    {% for ele in css %}
    <link rel="stylesheet" type="text/css" href="{{ ele }}"/>
    {% endfor %}

    <!--[if lt IE 9]>
    <script src="media/js/html5.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
<!-- <navbar> -->

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <img class="pull-left header-icon"
                 src="{{ Util.getOption('logo_url', 'media/img/icon-default.png') }}"
                 alt="logo"/>
            <a class="navbar-brand" href="./">{{ title }}</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <!-- Online status -->
                {% if ServerStatistic.getStatus %}
                    <span class="btn btn-success disabled navbar-btn">{{ 'online'|trans|capitalize }}</span>
                {% else %}
                    <span class="btn btn-danger disabled navbar-btn">{{ 'offline'|trans }}</span>
                {% endif %}
            </li>
            <li class="divider-vertical"></li>
            <li>
                <!-- Search form -->
                <form class="navbar-form" method="get">
                    <input type="hidden" name="page" value="player">

                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="{{ 'player'|trans }}" id="playerSearch"
                               autocomplete="off">
                        <input type="hidden" value="0" name="id" id="playerSearchID"/>
                        <button class="btn btn-default" value="1" type="submit">{{ 'search'|trans }}</button>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>

<!-- </navbar> -->

<!-- </header> -->