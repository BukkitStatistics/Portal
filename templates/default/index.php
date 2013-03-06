<?php $this->inject('header.php'); ?>
<div class="container">
    <div class="row">
        <div id="content" class="span10 pull-right">
            <section id="dashboard">
                <div class="row-fluid">
                    <div class="span3">
                        <div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
                            <h1 style="text-align:center;"><i class="icon-group icon-large"></i></h1>

                            <h3 style="text-align:center;">online</h3>
                        </div>
                    </div>


                    <div class="span3">
                        <div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
                            <h1 style="text-align:center;"><i class="icon-pencil icon-large"></i></h1>

                            <h3 style="text-align:center;">tracked</h3>
                        </div>
                    </div>


                    <div class="span3">
                        <div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
                            <h1 style="text-align:center;"><i class="icon-remove-sign icon-large"></i></h1>

                            <h3 style="text-align:center;">killed</h3>
                        </div>
                    </div>


                    <div class="span3">
                        <div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
                            <h1 style="text-align:center;"><i class="icon-tint icon-large"></i></h1>

                            <h3 style="text-align:center;">died</h3>
                        </div>
                    </div>
                </div>

                <div class="section-split"></div>
                <h1><i class="icon-tasks icon-large"></i> Dashboard</h1>

                <div class="row-fluid dashboard">
                    <div class="span4"></div>
                    <div class="span4"></div>
                    <div class="span4"></div>
                </div>

                <div class="row-fluid dashboard">
                    <div class="span4"></div>
                    <div class="span8"></div>
                </div>

                <div class="row-fluid dashboard">
                    <div class="span8"></div>
                    <div class="span4"></div>
                </div>

            </section>
            <section id="players">
                <h1><i class="icon-group icon-large"></i> Player Information</h1>
            </section>
            <section id="world">
                <div class="row-fluid">
                    <div class="span6">
                        <h1><i class="icon-picture icon-large"></i> Blocks</h1>
                    </div>
                    <div class="span6">
                        <h1><i class="icon-legal icon-large"></i> Items</h1>
                    </div>
                </div>
            </section>
            <section id="deaths">
                <div class="row-fluid">
                    <div class="span8">
                        <h1><i class="icon-tint icon-large"></i> Death Log</h1>
                    </div>
                    <div class="span4">
                        <h1> Death Statistics</h1>
                    </div>
                </div>
            </section>
        </div>
        <div class="span2 pull-left">
            <div class="nav nav-sidebar well">
                <ul class="nav nav-list">
                    <li><a href="#dashboard"><i class="icon-tasks"></i> Dashboard</a></li>
                    <li class="divider"></li>
                    <li><a href="#players"><i class="icon-group"></i> Players</a></li>
                    <li><a href="#world"><i class="icon-picture"></i> World</a></li>
                    <li><a href="#deaths"><i class="icon-tint"></i> Death Log</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php $this->inject('footer.php'); ?>
</div>
</body>
</html>