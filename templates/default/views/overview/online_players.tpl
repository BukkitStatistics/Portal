{% for player in players_online %}
    <div class="online-player-heads">
        <a href="?page=player&id={{ player.getPlayerId }}">
            {{ player.getPlayerHead(64, 'img-thumbnail', true)|raw }}
        </a>
    </div>
{% else %}
    <div class='force-center'><em>{{ 'no_players_online'|trans }}</em></div>
{% endfor %}