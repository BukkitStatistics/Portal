<hr>

<footer>
    <div class="row-fluid">
        <div class="span10 offset2">
            <div class="row-fluid">
                <div class="span2">
                    <p>
                        <a href="https://github.com/bitWolfy/YetAnotherStatisticsPlugin"><img
                                src="media/img/plugin_logo_small.png" alt="YASP"/>
                        </a>
                    </p>
                </div>
                <div class="span4">
                    <p style="position:relative; top:5px;">&copy; <?php echo date('Y'); ?> Yet Another Statistics Plugin
                </div>
                <div class="span4 offset2" style="text-align: right;">
                    <p>
                        Running database version DEV
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