{% if player is not null %}
    <div class="row-fluid">
        <div class="well well-small span6 {% if misc.getIsBanned %} alert-danger {% endif %}"
             style="position: relative;">
            <h1 style="position: relative">
                {{ player.getPlayerHead(64, 'img-polaroid')|raw }}
                {{ player.getName }}
                {% if player.getOnline %}
                    <span class='label label-success player-status'>In-Game</span>
                {% else %}
                    <span class='label label-important player-status'>Offline</span>
                {% endif %}
                {% if misc.getIsOp %}
                    <span class="label label-info player-op">OP</span>
                {% endif %}
                <div class="player-top-right-info">
                    {% if misc.getIsBanned %}
                        <span class="label label-important player-top-right-info-label">
                            <strong>banned</strong>
                        </span>
                    {% endif %}
                    {% if misc.getGamemode > 0 %}
                        <span class="label label-warning player-top-right-info-label">
                            {% if misc.getGamemode == 1 %}
                                <strong>creative</strong>
                            {% else %}
                                <strong>adventure</strong>
                            {% endif %}
                        </span>
                    {% endif %}
                    <?php endif; ?>
                </div>
            </h1>
            <div class="bar-container">
                <div class="xpbar-cur">
                    <strong>{{ misc.getExpLevel }}</strong>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="armor-bar">
                            {{ misc.getArmorBar|raw }}
                        </div>
                    </div>
                </div>
                <div class="row-fluid" id="playerhead-bars">
                    <div class="span6">
                        <div class="heart-bar clearfix">
                            {{ misc.getHealthBar|raw }}
                        </div>
                    </div>

                    <div class="span6">
                        <div class="hunger-bar">
                            {{ misc.getFoodBar|raw }}
                        </div>
                    </div>
                </div>

                <div class="force-center xpbar-container">
                    {{ misc.getXPBar|raw }}
                </div>
            </div>

            <div class="player-effects">
                {% if inv %}
                    {{ inv.printEffects|raw }}
                {% endif %}
            </div>
        </div>
        <div class="span6">
            {% if inv %}
                <div class="player-inv pull-right hidden-phone">
                    <div class="player-inv-row clearfix">
                        {{ inv.printRowOne|raw }}
                    </div>
                    <div class="player-inv-row clearfix">
                        {{ inv.printRowTwo|raw }}
                    </div>
                    <div class="player-inv-row clearfix">
                        {{ inv.printRowThree|raw }}
                    </div>
                    <div class="player-inv-hotbar clearfix">
                        {{ inv.printHotbar|raw }}
                    </div>
                </div>
                <div class="player-armor pull-right hidden-phone">
                    {{ inv.printArmor|raw }}
                </div>
            {% endif %}
        </div>
    </div>
    <div class="row-fluid">
        <div class="span3 center">
            {% if pvp.most_killed_by is not null %}
                {% set player = pvp.most_killed_by.createPlayer('player_id') %}
            {% else %}
                {% set player = Player().setName('none') %}
            {% endif %}
            {{ player.getPlayerHead(64, 'img-polaroid')|raw }}
            <h4 class="well well-small center">
                {% if player.getName != 'none' %}
                    <a href="?page=player&name={{ player.getName|e('url') }}">{{ player.getName }}</a>
                {% else %}
                    {{ player.getName }}
                {% endif %}
                <br>
                <small>Arch Nemesis</small>
            </h4>
        </div>
        <div class="span3 center">
            {% if pvp.most_killed is not null %}
                {% set player = pvp.most_killed.createPlayer('victim_id') %}
            {% else %}
                {% set player = Player().setName('none') %}
            {% endif %}
            {{ player.getPlayerHead(64, 'img-polaroid')|raw }}
            <h4 class="well well-small center">
                {% if player.getName != 'none' %}
                    <a href="?page=player&name={{ player.getName|e('url') }}">{{ player.getName }}</a>
                {% else %}
                    {{ player.getName }}
                {% endif %}
                <br>
                <small>Most killed</small>
            </h4>
        </div>
        <div class="span3 center">
            {% if blocks.most_destroyed %}
                {% set block = blocks.most_destroyed.createMaterial %}
            {% else %}
                {% set block = Material('-1:0') %}
            {% endif %}
            {{ block.getImage(64, 'img-polaroid')|raw }}
            <h4 class="well well-small center">
                {{ block.getName }}
                <br>
                <small>Most broken</small>
            </h4>
        </div>
        <div class="span3 center">
            {% if blocks.most_placed %}
                {% set block = blocks.most_placed.createMaterial %}
            {% else %}
                {% set block = Material('-1:0') %}
            {% endif %}
            {{ block.getImage(64, 'img-polaroid')|raw }}
            <h4 class="well well-small center">
                {{ block.getName }}
                <br>
                <small>Most placed</small>
            </h4>
        </div>
    </div>
    <h2>General Statistics</h2>

    <div class="row-fluid col-wrap-320">
        <div class="span4 well well-small">
            <h3>Blocks</h3>

            <p>
                <strong>Total Placed:</strong>
                {{ blocks.placed|ffNumber }} Blocks
            </p>

            <p>
                <strong>Most Placed:</strong>
                {% if blocks.most_placed %}
                    {{ blocks.most_placed.createMaterial.getImage(32, null, true)|raw }}
                    {{ blocks.most_placed.preparePlaced }}
                {% else %}
                    <em>none</em>
                {% endif %}
            </p>

            <p>
                <strong>Total Destroyed:</strong>
                {{ blocks.destroyed|ffNumber }} Blocks
            </p>

            <p>
                <strong>Most Destroyed:</strong>
                {% if blocks.most_destroyed %}
                    {{ blocks.most_destroyed.createMaterial.getImage(32, null, true)|raw }}
                    {{ blocks.most_destroyed.prepareDestroyed }}
                {% else %}
                    <em>none</em>
                {% endif %}
            </p>
        </div>
        <div class="span4 well well-small">
            <h3>Items</h3>

            <p>
                <strong>Total Picked Up:</strong>
                {{ items.picked|ffNumber }} Items
            </p>

            <p>
                <strong>Most Picked Up:</strong>
                {% if items.most_picked %}
                    {{ items.most_picked.createMaterial.getImage(32, null, true)|raw }}
                    {{ items.most_picked.preparePickedUp }}
                {% else %}
                    <em>none</em>
                {% endif %}
            </p>

            <p>
                <strong>Total Dropped:</strong>
                {{ items.dropped|ffNumber }} Items
            </p>

            <p>
                <strong>Most Dropped:</strong>
                {% if items.most_dropped %}
                    {{ items.most_dropped.createMaterial.getImage(32, null, true)|raw }}
                    {{ items.most_dropped.prepareDropped }}
                {% else %}
                    <em>none</em>
                {% endif %}
            </p>
        </div>
        <div class="span4 well well-small">
            <h3>Distances</h3>

            <p>
                <strong>Travelled:</strong>
                {{ distance.prepareTotal }} meters
            </p>

            <p>
                <strong>Walked:</strong>
                {{ distance.prepareFoot }} meters
            </p>

            <p>
                <strong>Minecarted:</strong>
                {{ distance.prepareMinecart }} meters
            </p>

            <p>
                <strong>Boated:</strong>
                {{ distance.prepareBoat }} meters
            </p>

            <p>
                <strong>Piggybacked:</strong>
                {{ distance.preparePig }} meters
            </p>

            <p>
                <strong>Swum:</strong>
                {{ distance.prepareSwim }} meters
            </p>

            <p>
                <strong>Flight:</strong>
                {{ distance.prepareFlight }} meters
            </p>
        </div>
    </div>
    <div class="row-fluid col-wrap-220">

        <div class="span8 well well-small">
            <h3>Miscellaneous</h3>
            <table class="table table-condensed no-border">
                <tr>
                    <td>
                        <strong>Total XP:</strong>
                    </td>
                    <td>
                        {{ misc.prepareExpTotal }}
                    </td>
                    <td>
                        <strong>Times kicked:</strong>
                    </td>
                    <td>
                        {{ misc.prepareTimesKicked }}
                    </td>
                    <td>
                        <strong>Eggs thrown:</strong>
                    </td>
                    <td>
                        {{ misc.prepareEggsThrown }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Food eaten:</strong>
                    </td>
                    <td>
                        {{ misc.prepareFoodEaten }}
                    </td>
                    <td>
                        <strong>Arrows shot:</strong>
                    </td>
                    <td>
                        {{ misc.prepareArrowsShot }}
                    </td>
                    <td>
                        <strong>Damage taken:</strong>
                    </td>
                    <td>
                        {{ misc.prepareDamageTaken }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Words said:</strong>
                    </td>
                    <td>
                        {{ misc.prepareWordsSaid }}
                    </td>
                    <td>
                        <strong>Commands sent:</strong>
                    </td>
                    <td>
                        {{ misc.prepareCommandsSent }}
                    </td>
                    <td>
                        <strong>Beds entered:</strong>
                    </td>
                    <td>
                        {{ misc.prepareBedsEntered }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Portals entered:</strong>
                    </td>
                    <td>
                        {{ misc.preparePortalsEntered }}
                    </td>
                    <td>
                        <strong>Fish caught:</strong>
                    </td>
                    <td>
                        {{ misc.prepareFishCaught }}
                    </td>
                    <td>
                        <strong>Times jumped:</strong>
                    </td>
                    <td>
                        {{ misc.prepareTimesJumped }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="span4 well well-small">
            <h3>Login statistics</h3>

            <p>
                <strong>Joined on:</strong>
                {{ player.getFirstLogin|date }}
            </p>

            <p>
                <strong>Last seen:</strong>
                {% if player.getLoginTime is not null and player.getLoginTime != 0 %}
                    {{ player.getLoginTime|date }}
                {% else %}
                    <em>never</em>
                {% endif %}
            </p>

            <p>
                <strong>Playtime:</strong>
                {{ Util.formatSeconds(fTimestamp(player.getPlaytime), false) }}
            </p>

            <p>
                <strong>Logins:</strong>
                {{ player.prepareLogins }}
            </p>
        </div>
    </div>
    <div class="row-fluid">

        <div class="span4 well well-small">
            <h3>PvP</h3>

            <p>
                <strong>Total Kills:</strong>
                {{ pvp.kills|ffNumber }}
            </p>

            <p>
                <strong>Total Deaths:</strong>
                {{ pvp.deaths|ffNumber }}
            </p>

            <p>
                <strong>Current kill streak:</strong>
                {{ misc.prepareKillStreak }}
            </p>

            <p>
                <strong>Best kill streak:</strong>
                {{ misc.prepareMaxKillStreak }}
            </p>
            {% if pvp.most_killed %}
                <br/>
                <h4>Most killed:</h4>

                <p>
                    {% set victim = pvp.most_killed.createPlayer('victim_id') %}
                    <a href="?page=player&name={{ victim.getName|e('url') }}">
                        {{ victim.getPlayerHead|raw }}
                        {{ victim.getName }}
                    </a>
                </p>

                <p>
                    <strong>Kills:</strong>
                    {{ pvp.most_killed.getTimes|ffNumber }}
                </p>

                <p>
                    <strong>Used weapon:</strong>
                    {% set weapon = pvp.most_killed.createMaterial %}
                    {{ weapon.getImage|raw }}
                    {{ weapon.getName }}
                </p>
            {% endif %}
            {% if pvp.most_killed_by %}
                <br/>
                <h4>Most killed by:</h4>

                <p>
                    {% set killer = pvp.most_killed_by.createPlayer('player_id') %}
                    <a href="?page=player&name={{ killer.getName|e('url') }}">
                        {{ killer.getPlayerHead|raw }}
                        {{ killer.getName }}
                    </a>
                </p>

                <p>
                    <strong>Kills:</strong>
                    {{ pvp.most_killed_by.getTimes|ffNumber }}
                </p>

                <p>
                    <strong>Used weapon:</strong>
                    {% set weapon = pvp.most_killed_by.createMaterial %}
                    {{ weapon.getImage|raw }}
                    {{ weapon.getName }}
                </p>
            {% endif %}
        </div>

        <div class="span4 well well-small">
            <h3>PvE</h3>

            <p>
                <strong>Total Kills:</strong>
                {{ pve.kills|ffNumber }}
            </p>

            <p><strong>Total Deaths:</strong>
                {{ pve.deaths|ffNumber }}
            </p>
            {% if pve.most_killed %}
                <br/>
                <h4>Most killed:</h4>

                <p>
                    {% set victim = pve.most_killed.createEntity %}
                    {{ victim.getImage|raw }}
                    {{ victim.getName }}
                </p>

                <p>
                    <strong>Kills:</strong>
                    {{ pve.most_killed.prepareCreatureKilled }}
                </p>

                <p>
                    <strong>Used weapon:</strong>
                    {% set weapon = pve.most_killed.createMaterial %}
                    {{ weapon.getImage|raw }}
                    {{ weapon.getName }}
                </p>
            {% endif %}
            {% if pve.most_killed_by %}
                <br/>
                <h4>Most killed by:</h4>

                <p>
                    {% set killer = pve.most_killed_by.createEntity %}
                    {{ killer.getImage|raw }}
                    {{ killer.getName }}
                </p>

                <p>
                    <strong>Kills:</strong>
                    {{ pve.most_killed_by.preparePlayerKilled }}
                </p>

                <p>
                    <strong>Used weapon:</strong>
                    {% set weapon = pve.most_killed_by.createMaterial %}
                    {{ weapon.getImage|raw }}
                    {{ weapon.getName }}
                </p>
            {% endif %}
        </div>

        <div class="span4 well well-small">
            <h3>Other</h3>
            {% for death in deaths %}
                <p>
                    <strong>{{ death.getName }}</strong>
                    {{ death.getTimes|ffNumber }}
                </p>
            {% else %}
                <p><strong>This player was not killed by outside influences.</strong></p>
            {% endfor %}
        </div>
    </div>
{% else %}
    <div class="alert alert-block alert-error">
        <h3>Player not found!</h3>
    </div>
{% endif %}