{% if players|length == 0 %}
    <div class='force-center'><em>No players tracked</em></div>
{% else %}
    <table class="table table-striped table-bordered table-hover table-vcenter" id="playersTable">
        <thead>
        <tr>
            <th class="sort-button {{ sort[1] }}" data-type="1" data-sort="desc">
                Name
            </th>
            <th class="sort-button {{ sort[2] }}" data-type="2" data-sort="desc">
                Last Seen
            </th>
            <th class="sort-button {{ sort[3] }}" data-type="3" data-sort="desc">
                Date Joined
            </th>
            <th class="sort-button {{ sort[4] }}" data-type="4" data-sort="desc">
                Playtime
            </th>
        </tr>
        </thead>
        <tbody class="content">
        {% for player in players %}
            <tr>
                <td>
                    <a href="?page=player&name={{ player.getName|e('url') }}">
                        {{ player.getPlayerHead(32, 'img-polaroid')|raw }}
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
        </tbody>
    </table>
    <div id="playersPagination" class="pagination-centered"></div>

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