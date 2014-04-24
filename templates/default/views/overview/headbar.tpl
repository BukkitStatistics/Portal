<div class="col-md-3">
    <div class="well">
        <h1><i class="fa fa-group fa-lg"></i></h1>

        <h3>{{ player_stats.online }} {{ 'online'|trans|lower }}</h3>
    </div>
</div>
<div class="col-md-3">
    <div class="well">
        <h1><i class="fa fa-pencil fa-lg"></i></h1>

        <h3>{{ player_stats.tracked }} {{ 'tracked'|trans }}</h3>
    </div>
</div>
<div class="col-md-3">
    <div class="well">
        <h1><i class="fa fa-times-circle fa-lg"></i></h1>

        <h3>{{ player_stats.killed }} {{ 'killed'|trans }}</h3>
    </div>
</div>
<div class="col-md-3">
    <div class="well">
        <h1><i class="fa fa-arrow-up fa-lg"></i></h1>

        <h3>{{ serverstats.uptime_perc }}% {{ 'uptime'|trans }}</h3>
    </div>
</div>