<!-- <overview> -->
<div class="row quick-info">
    {% include headbar %}
</div>
<div class="row">
    <div class="container col-md-3">
        {% include sidebar %}
    </div>

    <div class="col-md-9" id="page-body">
        <!-- <dashboard> -->
        <section id="dashboard">
            <div class="row">
                <div class="col-md-8" id="module-online-players">
                    <div class="well well-sm module module-big">
                        <h3>{{ 'online_players'|trans }}</h3>

                        <div class="online-players">
                            {% include online_players %}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well well-sm module module-small">
                        <h3>{{ 'server'|trans }}</h3>
                        {% include server_stats %}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="well well-sm module module-small">
                        <h3>{{ 'players'|trans }}</h3>
                        {% include players %}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well well-sm module module-small">
                        <h3>{{ 'blocks'|trans }}</h3>
                        {% include blocks %}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well well-sm module module-small">
                        <h3>{{ 'items'|trans }}</h3>
                        {% include items %}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="well well-sm module module-small">
                        <h3>{{ 'distances'|trans }}</h3>
                        {% include distances %}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="well well-sm module module-big">
                        <h3>{{ 'deaths'|trans }}</h3>
                        {% include deaths %}
                    </div>
                </div>
            </div>
        </section>
        <!-- </dashboard> -->

        <!-- <players> -->
        <section id="players">
            <h1><i class="icon-group"></i> {{ 'players'|trans }}
                <small>{{ 'tracked_on_server'|trans }}</small>
            </h1>

            <div data-mod="players" id="playersBlock" class="table-responsive">
                {% include total_players %}
            </div>
        </section>
        <!-- </players> -->

        <!-- <world> -->
        <section id="world">
            <div class="row" id="blocks">
                <div class="col-md-12">
                    <h1><i class="icon-picture icon-large"></i> {{ 'blocks'|trans }}</h1>

                    <div class="well custom-well paginator table-responsive" data-mod="total_blocks" id="worldBlocks">
                        {% include total_blocks %}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="items">
                    <h1><i class="icon-legal icon-large"></i> {{ 'items'|trans }}</h1>

                    <div class="well custom-well table-responsive" data-mod="total_items" id="worldItems">
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