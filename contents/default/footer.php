<!-- <footer> -->
<footer>
    <div class="row-fluid page-width footer-block">
        <div class="span9 offset3">
            <div class="row-fluid">
                <div class="span2">
                    <p>
                        <a href="https://github.com/bitWolfy/Statistics">
                            <img src="media/img/plugin_logo.png" alt="Statistics"/>
                        </a>
                    </p>
                </div>
                <div class="span4">
                    <p style="margin-top: 6px">
                        &copy; <?php echo date('Y'); ?> Statistics - <a href="?page=admin"><small>Admin</small></a>
                    </p>
                </div>
                <div class="span4 offset2" style="text-align: right;">
                    <p>
                        <?php echo VERSION; ?>-db<?php echo Util::getOption('version'); ?>
                        <br>
                        <small id="execution_time">
                            Execution time: <?php echo round(
                            (float)array_sum(explode(' ', microtime())) - STARTTIME, 4); ?>
                            seconds.
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
<!-- </footer> -->