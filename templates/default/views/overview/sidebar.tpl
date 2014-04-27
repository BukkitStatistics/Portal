<!-- <navigation> -->
<div id="left-menu">
    <div class="nav nav-sidebar well">
        <ul class="nav nav-list">
            <li><a href="#dashboard"><i class="fa fa-tasks fa-fw"></i> {{ 'dashboard'|trans }}</a></li>
            <li class="divider"></li>
            <li><a href="#players"><i class="fa fa-group fa-fw"></i> {{ 'players'|trans }}</a></li>
            <li><a href="#blocks"><i class="fa fa-picture-o fa-fw"></i> {{ 'blocks'|trans }}</a></li>
            <li><a href="#items"><i class="fa fa-legal fa-fw"></i> {{ 'items'|trans }}</a></li>
            <li><a href="#deaths"><i class="fa fa-tint fa-fw"></i> {{ 'death_log'|trans }}</a></li>
        </ul>
    </div>
    {% if constant('DB_TYPE') == 'default' and multi %}
        <div class="well">
            <h4>{{ 'other_servers'|trans }}</h4>
        {% for server in multi %}
            {% set info = info_ar[server.slug] %}

            {% if info.current_uptime > 0 %}
                <i class="fa fa-circle text-success"></i>
            {% else %}
                <i class="fa fa-circle text-danger"></i>
            {% endif %}
            <a href="?server={{ server.slug }}">
                {{ server.name }} {{ info.online_players }}/{{ info.players_allowed }}
            </a>
            <br>
        {% endfor %}
        </div>
    {% elseif constant('DB_TYPE') != 'default' %}
        <div class="well">
            <a href="?server=default"><h4><i class="fa fa-reply"></i> {{ 'back_main_server'|trans }}</h4></a>
        </div>
    {% endif %}
</div>
<!-- </navigation> -->