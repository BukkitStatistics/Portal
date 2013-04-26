<!-- <overview> -->
<div class="row-fluid quick-info">
    <?php $this->place('headbar'); ?>
</div>
<div class="row-fluid">
<div class="container span3">

    <?php $this->place('sidebar'); ?>
</div>

<div class="span9" id="page-body">
<!-- <dashboard> -->
<section id="dashboard">
<div class="row-fluid">
    <div class="span8 well well-small module module-big" id="module-online-players">
        <h3>Online Players</h3>

        <div class="online-players">
            <?php $this->place('online_players'); ?>
        </div>

    </div>
    <div class="span4 well well-small module module-small">
        <h3>Server</h3>

        <?php $this->place('server_stats'); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4 well well-small module module-small">
        <h3>Players</h3>

        <?php $this->place('players'); ?>
    </div>
    <div class="span4 well well-small module module-small">
        <h3>Blocks</h3>

        <?php $this->place('blocks'); ?>
    </div>
    <div class="span4 well well-small module module-small">
        <h3>Items</h3>

        <?php $this->place('items'); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4 well well-small module module-small">
        <h3>Distances</h3>

        <?php $this->place('distances'); ?>
    </div>
    <div class="span8 well well-small module module-big">
        <h3>Deaths</h3>

        <?php $this->place('deaths'); ?>
    </div>
</div>
</section>
<!-- </dashboard> -->

<!-- <players> -->
<section id="players">
    <h1><i class="icon-group"></i> Players
        <small>tracked on the server</small>
    </h1>

    <div data-mod="players" id="playersBlock">

        <?php $this->place('total_players'); ?>

    </div>
</section>
<!-- </players> -->

<!-- <world> -->
<section id="world">
    <div class="row-fluid">
        <div class="span6">
            <h1><i class="icon-picture icon-large"></i> Blocks</h1>

            <div class="well custom-well paginator" data-mod="total_blocks" id="worldBlocks">
                <?php $this->place('total_blocks'); ?>
            </div>
        </div>
        <div class="span6">
            <h1><i class="icon-legal icon-large"></i> Items</h1>

            <div class="well custom-well" data-mod="total_items" id="worldItems">
                <?php $this->place('total_items'); ?>
            </div>
        </div>
    </div>
</section>
<!-- </world> -->

<!-- <deaths> -->
<section id="deaths">
    <h1><i class="icon-tint icon-large"></i> Death Log
        <small>PVP, PVE and EVP kills</small>
    </h1>
    <div class="well custom-well" style="padding: 10px;" id="deathsBlock">

        <?php $this->place('death_log'); ?>

    </div>
</section>
<!-- </deaths> -->

</div>
</div>
<!-- </overview> -->