<div class="col-md-3">
    <div class="well">
        <h1><i class="icon-group icon-large"></i></h1>

        <h3>{{ player_stats.online }} {{ 'online'|trans|lower }}</h3>
    </div>
</div>
<div class="col-md-3">
    <div class="well">
        <h1><i class="icon-pencil icon-large"></i></h1>

        <h3>{{ player_stats.tracked }} {{ 'tracked'|trans }}</h3>
    </div>
</div>
<div class="col-md-3">
    <div class="well">
        <h1><i class="icon-remove-sign icon-large"></i></h1>

        <h3>{{ player_stats.killed }} {{ 'killed'|trans }}</h3>
    </div>
</div>
<div class="col-md-3">
    <div class="well">
        <h1><i class="icon-arrow-up icon-large"></i></h1>

        <h3>{{ serverstats.uptime_perc }}% {{ 'uptime'|trans }}</h3>
    </div>
</div>