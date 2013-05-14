<!-- TODO: test multiserver -->
<!-- <navigation> -->
<div class="left-menu hidden-phone" id="left-menu">
    <div class="nav nav-sidebar well">
        <ul class="nav nav-list" id="nav-menu">
            <li><a href="#dashboard"><i class="icon-tasks"></i> {{ 'dashboard'|trans }}</a></li>
            <li class="divider"></li>
            <li><a href="#players"><i class="icon-group"></i> {{ 'players'|trans }}</a></li>
            <li><a href="#world"><i class="icon-picture"></i> {{ 'world'|trans }}</a></li>
            <li><a href="#deaths"><i class="icon-tint"></i> {{ 'death_log'|trans }}</a></li>
        </ul>
    </div>
    {% if constant('DB_TYPE') == 'default' and multi %}
        <div class="well">
            <h4>{{ 'other_servers'|trans }}</h4>
        {% for server in multi %}
            {% set domain = staticCall('fUrl', 'getDomain') %}
            {% set url = staticCall('fUrl', 'get') %}
            {% set info = Util.getFileContents(domain ~ url ~ '?server=' ~ server.slug ~ '&api=true&type=server_stats', true) %}
            {% set info = staticCall('fJSON', 'decode', [info, true]) %}

            {% if info.current_uptime > 0 %}
                <i class="icon-circle text-success"></i>
            {% else %}
                <i class="icon-circle text-error"></i>
            {% endif %}
            <a href="?server={{ server.slug }}">
                {{ server.name }} {{ info.online_players }}/{{ info.players_allowed }}
            </a>
            <br>
        {% endfor %}
        </div>
    {% elseif constant('DB_TYPE') != 'default' %}
        <div class="well">
            <a href="?server=default"><h4><i class="icon-reply"></i> {{ 'back_main_server'|trans }}</h4></a>
        </div>
    {% endif %}
</div>
<!-- </navigation> -->