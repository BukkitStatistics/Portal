<h2><i class="icon-magic icon-large" style="color: #ccc"></i> Processing</h2>
<p>Database converting is in progress! Please be patient.</p>

<div id="convertingAlert" class="alert alert-info" {% if next_step is not empty %} style="display: none;" {% endif %}>
    <i class="icon-refresh icon-spin"></i>
    <strong>Converting</strong> <span class="current">{{ current }}</span>
</div>
<div id="finishedAlert" class="alert alert-success" {% if next_step is empty %} style="display: none;" {% endif %}>
    <strong>Step (<span class="current">{{ current }}</span>) finished.</strong> Now press the <em>Next Step</em> Button.
</div>

<div class="progress {% if next_step is not empty %} progress-success {% else %} progress-striped active {% endif %}">
    <div id="progressbar" class="bar" style="width: {{ perc }}%;"></div>
</div>
<a href="?step=converter"
   class="btn btn-inverse">Stop</a>
<a id="nextbutton" {% if next_step is not empty %} href="{{ next_step }}" {% endif %}
   class="btn {% if next_step is not empty %} btn-success {% else %} disabled {% endif %}">Next Step</a>

<script type="text/javascript">
    $(document).ready(function () {
        function process(cur) {
            $.getJSON(
                    'install.php',
                    {
                        step: 'process',
                        type: cur
                    },
                    function (data) {
                        progressbar = $('#progressbar');
                        progresswrap = $('.progress');
                        current = $('.current');

                        if (data['perc'] >= 100) {
                            progressbar.css('width', '100%');
                            progresswrap.removeClass('progress-striped active').addClass('progress-success');

                            if (data['next'] == '') {
                                $('#convertingAlert').hide();
                                $('#finishedAlert').show();
                                nextbutton = $('#nextbutton');
                                nextbutton.removeClass('disabled').addClass('btn-success').attr('href', '?step=five');
                            }
                            else {
                                setTimeout(
                                        function () {
                                            progresswrap.addClass('progress-striped active').removeClass('progress-success');
                                            progressbar.css('width', '0%');
                                            current.html(data['current']);
                                            history.pushState(
                                                    {
                                                        pageTitle: '{{ title }} -' + data['current']
                                                    },
                                                    '',
                                                    '?step=process&type=' + data['next']);
                                            document.title = '{{ title }} -' + data['current'];
                                            process(data['next'])
                                        }, 1500);
                            }

                        }
                        else {
                            progressbar.css('width', data['perc'] + '%');
                            setTimeout(
                                    function () {
                                        process(data['next'])
                                    }, 300);
                        }
                    }
            );
        }
        process('{{ type }}');
    });
</script>