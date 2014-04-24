{% if players|length == 0 %}
    <div class='force-center'><em>{{ 'no_players_tracked'|trans }}</em></div>
{% else %}
    <table class="table table-striped table-bordered table-hover table-vcenter" id="playersTable">
        <thead>
        <tr>
            <th class="sort-button {{ sort[1] }}" data-type="1" data-sort="desc">
                {{ 'name'|trans }}
            </th>
            <th class="sort-button {{ sort[2] }}" data-type="2" data-sort="desc">
                {{ 'last_seen'|trans }}
            </th>
            <th class="sort-button {{ sort[3] }}" data-type="3" data-sort="desc">
                {{ 'date_joined'|trans }}
            </th>
            <th class="sort-button {{ sort[4] }}" data-type="4" data-sort="desc">
                {{ 'playtime'|trans }}
            </th>
        </tr>
        {% for player in players %}
            <tr>
                <td>
                    <a href="?page=player&id={{ player.getPlayerId }}">
                        {{ player.getPlayerHead(32, 'img-thumbnail')|raw }}
                        {{ player.getName }}
                    </a>
                </td>
                <td>
                    {% if player.getLoginTime != 0 %}
                        {{ player.getLoginTime|date }}
                    {% else %}
                        <em>never</em>
                    {% endif %}
                </td>
                <td>
                    {{ player.getFirstLogin|date }}
                </td>
                <td>
                    {{ Util.formatSeconds(fTimestamp(player.getPlaytime), false) }}
                </td>
            </tr>
        {% endfor %}
    </table>
    <div id="playersPagination" class="force-center"></div>

    <script type="text/javascript">
        $(document).ready(function () {
            callModulePage(
                    'players',
                    {{ players.getPages }},
                    {{ players.getPage }}
            );
        });
    </script>
{% endif %}