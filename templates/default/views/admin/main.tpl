<div class="row-fluid">
    <div class="span12 well">
        <div class="row-fluid">
            <div class="span12">
                <p>
                <h4>{{ title }}
                    <small>Admin Panel</small>
                </h4>
                </p>
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
                            {% set lable = 'badge-success' %}
                        {% elseif ticks >= 18 and ticks <= 22 %}
                            {% set lable = '' %}
                        {% elseif ticks <= 17 and ticks <= 12 %}
                            {% set lable = 'badge-warning' %}
                        {% elseif ticks <= 11 and ticks >= 5 %}
                            {% set lable = 'badge-important' %}
                        {% else %}
                            {% set lable = 'badge-inverse' %}
                        {% endif %}
                        <td><span class="badge {{ label }}">{{ ticks }}</span></td>
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