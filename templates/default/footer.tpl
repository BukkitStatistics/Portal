<!-- <footer> -->
<footer>
    <div class="row footer-block">
        <div class="col-md-6">
            <a href="http://dev.bukkit.org/server-mods/statistics/">
                <img class="img-responsive" src="media/img/plugin_logo.png" alt="Statistics"/>
            </a>
        </div>
        <div class="col-md-4 col-md-offset-2" style="text-align: right;">
            <p>
                {{ constant('VERSION') }}-db{{ Util.getOption('version') }}
                <br>
                <small id="execution_time">
                    {{ 'exec_time'|trans(Util.getExecTime) }}
                </small>
                <br>
                &copy; {{ 'now'|date('Y') }} Statistics -
                <a href="?page=admin">
                    <small>Admin</small>
                </a>
            </p>
        </div>
    </div>
</footer>
<!-- </footer> -->
</div>
</body>