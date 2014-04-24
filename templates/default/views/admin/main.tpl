<div class="row">
    <div class="col-md-12 well">
        {% if constant('DEVELOPMENT') %}
        <div class="alert alert-warning">
            <span class="label label-warning"><strong>Development Mode</strong></span>
            Caching is disabled in this mode. Errors will be displayed on the page if they occur.
        </div>
        {% endif %}
        {% if install %}
            <div class="alert alert-danger">
                <span class="label label-danger">Warning!</span>
                Installation files still available! Please delete the 'install.php' file and the 'installation/' folder!
            </div>
        {% endif %}
        <div class="row">
            <div class="col-md-12">
                <h4>{{ title }}
                    <small>Admin Panel</small>
                </h4>
                <table class="table">
                    <tr>
                        <td><strong>Bukkit Version:</strong></td>
                        <td>{{ ServerStatistic.getValue('bukkit_version') }}</td>
                        <td><strong>Installed Plugins:</strong></td>
                        <td>{{ ServerStatistic.getValue('plugins') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Server IP:</strong></td>
                        <td colspan="4">{{ ServerStatistic.getValue('server_ip') }}
                            :{{ ServerStatistic.getValue('server_port') }}</td>
                    </tr>
                    <tr>
                        <td><strong>First Startup:</strong></td>
                        <td>{{ ServerStatistic.getValue('first_startup')|date }}</td>
                        <td><strong>Current Uptime:</strong></td>
                        <td>{{ ServerStatistic.getCurrentUptime }}</td>
                    </tr>
                    <tr>
                        <td><strong>Memory:</strong></td>
                        <td>{{ Util.convertBytes(ServerStatistic.getValue('total_memory') - ServerStatistic.getValue('free_memory')) }}
                            / {{ Util.convertBytes(ServerStatistic.getValue('total_memory')) }}</td>
                        <td><strong>Ticks per Second:</strong></td>
                        {% set ticks = ServerStatistic.getValue('ticks_per_second') %}
                        {% if ticks == 20 %}
                            {% set label = 'label-success' %}
                        {% elseif ticks >= 18 and ticks <= 22 %}
                            {% set label = 'label-primary' %}
                        {% elseif ticks >= 12 and ticks <= 17 %}
                            {% set label = 'label-warning' %}
                        {% elseif ticks >= 5 and ticks <= 11 %}
                            {% set label = 'label-danger' %}
                        {% else %}
                            {% set label = 'label-default' %}
                        {% endif %}
                        <td><span class="label {{ label }}">{{ ticks }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Players:</strong></td>
                        <td>{{ ServerStatistic.getPlayersOnline }}
                            / {{ ServerStatistic.getValue('players_allowed') }}</td>
                        <td><strong>Server Time:</strong></td>
                        <td>{{ ServerStatistic.getRealServerTime }}</td>
                    </tr>
                    <tr>
                        <td><strong>MOTD:</strong></td>
                        <td colspan="4">{{ Util.formatMinecraftString(ServerStatistic.getValue('server_motd'))|raw }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>