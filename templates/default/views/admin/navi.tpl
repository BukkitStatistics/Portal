<div class="well well-sm">
    <ul class="nav nav-pills nav-stacked">
        <li class="{{ general }}">
            <a href="?page=admin&sub=general">
                <i class="fa fa-user fa-fw"></i> General
            </a>
        </li>
        <li class="{{ portal }}">
            <a href="?page=admin&sub=portal">
                <i class="fa fa-pencil fa-fw"></i> Portal
            </a>
        </li>
        <li class="{{ database }}">
            <a href="?page=admin&sub=database">
                <i class="fa fa-cog fa-fw"></i> Database
            </a>
        </li>
        <li class="{{ messages }}">
            <a href="?page=admin&sub=messages">
                <i class="fa fa-comment fa-fw"></i> Messages
            </a>
        </li>
        <li class="{{ modules }}">
            <a href="?page=admin&sub=modules">
                <i class="fa fa-tasks fa-fw"></i> Modules
            </a>
        </li>
        <li class="{{ dump }}">
            <a href="?page=admin&sub=dump">
                <i class="fa fa-times-circle-o fa-fw"></i> Dump Data
            </a>
        </li>
        {% if constant('DB_TYPE') == 'default' %}
            <li class="{{ multi }}">
                <a href="?page=admin&sub=multi">
                    <i class="fa fa-sitemap fa-fw"></i> Multi Portal
                </a>
            </li>
        {% endif %}
        {% if sub and not main %}
            <li class="divider"></li>
            <li>
                <a href="?page=admin">
                    <i class="fa fa-reply"></i> Back
                </a>
            </li>
        {% endif %}
    </ul>
</div>