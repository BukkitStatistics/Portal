<div class="span3 well">
    <h1 style="text-align:center;"><i class="icon-group icon-large"></i></h1>

    <h3 style="text-align:center;"><?php echo $this->get('players[online]'); ?> online</h3>
</div>
<div class="span3 well">
    <h1 style="text-align:center;"><i class="icon-pencil icon-large"></i></h1>

    <h3 style="text-align:center;"><?php echo $this->get('players[tracked]'); ?> tracked</h3>
</div>
<div class="span3 well">
    <h1 style="text-align:center;"><i class="icon-remove-sign icon-large"></i></h1>

    <h3 style="text-align:center;"><?php echo $this->get('players[killed]'); ?> killed</h3>
</div>
<div class="span3 well">
    <h1 style="text-align:center;"><i class="icon-arrow-up icon-large"></i></h1>

    <h3 style="text-align:center;"><?php echo $this->get('server_stats[uptime_perc]'); ?>% uptime</h3>
</div>