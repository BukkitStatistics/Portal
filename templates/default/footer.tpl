<!-- <footer> -->
<footer>
    <div class="row-fluid page-width footer-block">
        <div class="span12">
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
                        &copy; {{ 'now'|date('Y') }} Statistics - <a href="?page=admin">
                            <small>Admin</small>
                        </a>
                    </p>
                </div>
                <div class="span4 offset2" style="text-align: right;">
                    <p>
                        {{ constant('VERSION') }}-db{{ Util.getOption('version') }}
                        <br>
                        <small id="execution_time">
                            Execution time: {{ Util.getExecTime }} seconds.
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
<!-- </footer> -->