<div class="well well-sm">
    <ul class="nav nav-list">
        <li class="nav-header">Admin Navigation</li>

        <li class="{{ general }}">
            <a href="?page=admin&sub=general">
                <i class="icon-user icon-fixed-width"></i> General
            </a>
        </li>
        <li class="{{ portal }}">
            <a href="?page=admin&sub=portal">
                <i class="icon-pencil icon-fixed-width"></i> Portal
            </a>
        </li>
        <li class="{{ database }}">
            <a href="?page=admin&sub=database">
                <i class="icon-cog icon-fixed-width"></i> Database
            </a>
        </li>
        <li class="{{ messages }}">
            <a href="?page=admin&sub=messages">
                <i class="icon-comment icon-fixed-width"></i> Messages
            </a>
        </li>
        <li class="{{ modules }}">
            <a href="?page=admin&sub=modules">
                <i class="icon-tasks icon-fixed-width"></i> Modules
            </a>
        </li>
        <li class="{{ dump }}">
            <a href="?page=admin&sub=dump">
                <i class="icon-remove-circle icon-fixed-width"></i> Dump Data
            </a>
        </li>
        {% if constant('DB_TYPE') == 'default' %}
            <li class="{{ multi }}">
                <a href="?page=admin&sub=multi">
                    <i class="icon-sitemap icon-fixed-width"></i> Multi Portal
                </a>
            </li>
        {% endif %}
        {% if sub and not main %}
            <li class="divider"></li>
            <li>
                <a href="?page=admin">
                    <i class="icon-reply"></i> Back
                </a>
            </li>
        {% endif %}
    </ul>
</div>