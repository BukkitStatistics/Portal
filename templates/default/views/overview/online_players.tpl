{% for player in players_online %}
    <div class="online-player-heads">
        <a href="?page=player&name={{ player.getName }}">
            {{ player.getPlayerHead(64, 'img-polaroid', true)|raw }}
        </a>
    </div>
{% else %}
    <div class='force-center'><em>No players online</em></div>
{% endfor %}