<div class="content" data-mod="death_log">
    {% if death_log.countReturnedRows != 0 %}
        {% for log in death_log %}
            {% if log.player_killed is null %}
                {% set killer = Player(log.id1) %}
                {% set victim = Player(log.id2) %}
                {% set killer_img = killer.getPlayerHead(16, 'img-thumb img-polaroid', true) %}
                {% set victim_img = victim.getPlayerHead(16, 'img-thumb img-polaroid', true) %}
            {% else %}
                {% if log.player_killed %}
                    {% set killer = Entity(log.id1) %}
                    {% set victim = Player(log.id2) %}
                    {% set killer_img = killer.getImage(16, 'img-thumb img-polaroid', true) %}
                    {% set victim_img = victim.getPlayerHead(16, 'img-thumb img-polaroid', true) %}
                {% else %}
                    {% set killer = Player(log.id2) %}
                    {% set victim = Entity(log.id1) %}
                    {% set killer_img = killer.getPlayerHead(16, 'img-thumb img-polaroid', true) %}
                    {% set victim_img = victim.getImage(16, 'img-thumb img-polaroid', true) %}
                {% endif %}
            {% endif %}
            {% set material = Material(log.material_id) %}
            {% set time = fTimestamp(log.time) %}
            <div class="well well-small">
                <div class="row-fluid">
                    <div class="span3">
                        {{ time|date }}
                    </div>
                    <div class="span3">
                        <span class="label label-success">
                            {{ killer_img|raw }}
                            {{ killer.getName }}
                        </span>
                    </div>
                    <div class="span2">
                        {{ material.getImage(32, null, true)|raw }}
                    </div>
                    <div class="span4">
                        <span class="label label-important">
                            {{ victim_img|raw }}
                            {{ victim.getName }}
                        </span>
                    </div>
                </div>
            </div>
        {% endfor %}
        <div id="death_logPagination" class="pagination-centered"></div>

        <script type="text/javascript">
            $(document).ready(function () {
                callModulePage(
                        'death_log',
                        {{ death_log_pages }},
                        {{ death_log_page }}
                );
            });
        </script>
    {% else %}
        <div class='force-center'><em>No death log.</em></div>
    {% endif %}
</div>