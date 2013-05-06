<div class="row-fluid grid">
    <div class="span4">
        <span class="badge badge-success no-img">
            {{ death_stats.total }}
        </span> Total Kills
    </div>
    <div class="span4">
        <span class="badge badge-success no-img">
            {{ death_stats.deaths }}
        </span> Total Deaths
    </div>
    <div class="span4">
        <span class="badge badge-success grid-img">
            {{ staticCall('Material', 'getMaterialImg', [death_stats.top_weapon[1], 32, null, true])|raw }}
        </span> Best Weapon
    </div>
</div>
<div class="row-fluid grid">
    <div class="span4">
        <span class="badge badge-success no-img">
            {{ death_stats.pve }}
        </span> PvE Kills
    </div>
    <div class="span4">
        <span class="badge badge-success grid-img">
            {{ staticCall('Entity', 'getEntityImg', [death_stats.most_dangerous[1], 32, null, true])|raw }}
        </span> Most Dangerous
    </div>
    <div class="span4">
        <span class="badge badge-success grid-img">
            {{ staticCall('Entity', 'getEntityImg', [death_stats.most_killed_mob[1], 32, null, true])|raw }}
        </span> Most killed
    </div>
</div>
<div class="row-fluid grid">
    <div class="span4">
        <span class="badge badge-success no-img">
            {{ death_stats.pvp }}
        </span> PvP Kills
    </div>
    <div class="span4">
        <span class="badge badge-important grid-img">
            {% if death_stats.top_killer[1].getName != 'none' %}
                <a href="?page=player&name={{ death_stats.top_killer[1].getName|e('url') }}">
                    {{ death_stats.top_killer[1].getPlayerHead(32, null, true)|raw }}
                </a>
            {% else %}
                {{ death_stats.top_killer[1].getPlayerHead|raw }}
            {% endif %}
        </span> Most Kills
    </div>
    <div class="span4">
        <span class="badge badge-important grid-img">
            {% if death_stats.most_killed_player[1].getName != 'none' %}
                <a href="?page=player&name={{ death_stats.most_killed_player[1].getName|e('url') }}">
                    {{ death_stats.most_killed_player[1].getPlayerHead(32, null, true)|raw }}
                </a>
            {% else %}
                {{ death_stats.most_killed_player[1].getPlayerHead|raw }}
            {% endif %}
        </span> Most Deaths
    </div>
</div>