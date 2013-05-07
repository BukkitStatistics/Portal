<form name="install" method="post">
<h2><i class="icon-laptop icon-large"></i> Converter settings</h2>
{{ Util.showMessages('*', 'install/converter', 'alert alert-error') }}

{% if state is null %}
<p>Enter the login credentials for your old statistician database.</p>
<div class="alert">
    <div class="label label-warning">Warning</div> Be sure you have shut off the minecraft server before you continue!
</div>

<div class="control-group">
    <label for="host" class="control-label">Server:</label>

    <div class="controls">
        <input type="text" name="host" id="host" value="{{ host|default('localhost') }}">
    </div>
</div>
<div class="control-group">
    <label for="user" class="control-label">User:</label>

    <div class="controls">
        <input type="text" name="user" id="user" value="{{ user }}">
    </div>
</div>
<div class="control-group">
    <label for="pw" class="control-label">Password:</label>

    <div class="controls">
        <input type="password" name="pw" id="pw" autocomplete="off" value="{{ pw }}">
    </div>
</div>
<div class="control-group">
    <label for="database" class="control-label">Database:</label>

    <div class="controls">
        <input type="text" name="database" id="database" value="{{ database }}">
    </div>
</div>
{% endif %}

{% if state == 2 %}
<p> This could last a long time! Go and drink an coffee or finish your dinner...</p>
<p>Choose which entries do you want to convert:</p>

<div class="row">
    <div class="span6 offset2">

        <label class="checkbox">
            <input type="checkbox" name="convert[players]" id="convert_players" disabled="disabled"
                   checked="checked">
            Players ({{ player_count }})
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[pvp]" id="convert_pvp" checked="checked">
            Player vs. Player Kills ({{ total_pvp_kills }})
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[pve]" id="convert_pve" checked="checked">
            Player vs. Environment Kills ({{ total_pve_kills }})
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[evp]" id="convert_evp" checked="checked">
            Environment vs. Player Kills ({{ total_evp_kills }})
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[deaths]" id="convert_deaths" checked="checked">
            Death Causes ({{ total_deaths }})
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[blocks]" id="convert_blocks" checked="checked">
            Total Blocks ({{ total_blocks }})
        </label>
        <label class="checkbox">
            <input type="checkbox" name="convert[items]" id="convert_items" checked="checked">
            Total Items ({{ total_items }})
        </label>
    </div>
</div>
<input type="hidden" name="start" value="true">
{% endif %}
<div class="form-actions">
    <button type="submit" name="converter_submit" value="1"
            class="btn btn-primary">Next</button>
</div>
</form>
