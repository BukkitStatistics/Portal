<!-- <overview> -->
<div class="row-fluid quick-info">
    {% include headbar %}
</div>
<div class="row-fluid">
    <div class="container span3">
        {% include sidebar %}
    </div>

    <div class="span9" id="page-body">
        <!-- <dashboard> -->
        <section id="dashboard">
            <div class="row-fluid">
                <div class="span8 well well-small module module-big" id="module-online-players">
                    <h3>{{ 'online_players'|trans }}</h3>

                    <div class="online-players">
                        {% include online_players %}
                    </div>
                </div>
                <div class="span4 well well-small module module-small">
                    <h3>{{ 'server'|trans }}</h3>
                    {% include server_stats %}
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4 well well-small module module-small">
                    <h3>{{ 'players'|trans }}</h3>
                    {% include players %}
                </div>
                <div class="span4 well well-small module module-small">
                    <h3>{{ 'blocks'|trans }}</h3>
                    {% include blocks %}
                </div>
                <div class="span4 well well-small module module-small">
                    <h3>{{ 'items'|trans }}</h3>
                    {% include items %}
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4 well well-small module module-small">
                    <h3>{{ 'distances'|trans }}</h3>
                    {% include distances %}
                </div>
                <div class="span8 well well-small module module-big">
                    <h3>{{ 'deaths'|trans }}</h3>
                    {% include deaths %}
                </div>
            </div>
        </section>
        <!-- </dashboard> -->

        <!-- <players> -->
        <section id="players">
            <h1><i class="icon-group"></i> {{ 'players'|trans }}
                <small>{{ 'tracked_on_server'|trans }}</small>
            </h1>

            <div data-mod="players" id="playersBlock">
                {% include total_players %}
            </div>
        </section>
        <!-- </players> -->

        <!-- <world> -->
        <section id="world">
            <div class="row-fluid">
                <div class="span6">
                    <h1><i class="icon-picture icon-large"></i> {{ 'blocks'|trans }}</h1>

                    <div class="well custom-well paginator" data-mod="total_blocks" id="worldBlocks">
                        {% include total_blocks %}
                    </div>
                </div>
                <div class="span6">
                    <h1><i class="icon-legal icon-large"></i> {{ 'items'|trans }}</h1>

                    <div class="well custom-well" data-mod="total_items" id="worldItems">
                        {% include total_items %}
                    </div>
                </div>
            </div>
        </section>
        <!-- </world> -->

        <!-- <deaths> -->
        <section id="deaths">
            <h1><i class="icon-tint icon-large"></i> {{ 'death_log'|trans }}
                <small>{{ 'pvp'|trans }}, {{ 'pve'|trans }} and {{ 'evp'|trans }} kills</small>
            </h1>
            <div class="well custom-well" style="padding: 10px;" id="deathsBlock">
                {% include death_log %}
            </div>
        </section>
        <!-- </deaths> -->
    </div>
</div>
<!-- </overview> -->