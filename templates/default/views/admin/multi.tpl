<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-sitemap icon-3x" style="color:#ccc;"></i></h2>

        <h3>Multi Portal</h3>
    </div>
    <div class="span10 well">
        <?php if($this->get('main')): ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="alert alert-block alert-info">
                    <p>
                        <span class="label label-info"><strong>Info</strong></span> Here you can set up multiple config
                        files
                        for different servers. With this you can use one portal installation with more than one
                        server.<br>
                        <strong>The database credentials specified in the database section are used for the main
                            portal.</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php if($this->get('servers')): ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 12%">Slug</th>
                            <th style="width: 35%">Server name</th>
                            <th style="width: 20%">Database name</th>
                            <th style="width: 25%">Database host</th>
                            <th style="width: 8%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($this->get('servers') as $server):
                            $file = __INC__ . 'config/db_' . $server['slug'] . '.php';
                            if(!file_exists($file))
                                continue;

                            include $file;
                        ?>
                            <tr>
                                <td><?php echo $server['slug']; ?></td>
                                <td><?php echo $server['name']; ?></td>
                                <td><?php echo $db_values['database']; ?></td>
                                <td><?php echo $db_values['host'] . ':' . $db_values['port']; ?></td>
                                <td>
                                    <a href="?page=admin&sub=multi&action=edit&slug=<?php echo $server['slug']; ?>">
                                        <i class="icon-wrench"></i>
                                    </a>
                                    &nbsp;
                                    <a href="?page=admin&sub=multi&action=delete&slug=<?php echo $server['slug']; ?>">
                                        <i class="icon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="muted">No servers specified.</p>
                <?php endif; ?>
                <div class="form-actions">
                    <a href="?page=admin&sub=multi&action=add" class="btn btn-primary">Add Server</a>
                </div>
            </div>
        </div>
        <?php else: ?>
            <div class="row-fluid">
                <div class="span12">
                    <?php $this->place('multi_form'); ?>
                    <div class="form-actions">
                        <a href="?page=admin&sub=multi" class="btn">Back to servers</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>