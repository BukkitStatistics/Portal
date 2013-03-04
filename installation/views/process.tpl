<h2><i class="icon-magic icon-large" style="color: #ccc"></i> Processing</h2>
<p>Database converting is in progress! Please be patient.</p>

<div id="convertingAlert" class="alert alert-info" <?php echo $this->get('next_step') != '' ? 'style="display: none;"' : '' ?>>
    <i class="icon-refresh icon-spin"></i>
    <strong>Converting</strong> <span class="current"><?php echo $this->get('current'); ?></span>
</div>
<div id="finishedAlert" class="alert alert-success" <?php echo
$this->get('next_step') == '' ? 'style="display: none;"' : '' ?>>
    <strong>Step (<span class="current"><?php echo $this->get('current'); ?></span>) finished.</strong> Now press the
    <em>Next Step</em> Button.
</div>

<div class="progress <?php echo ($this->get('next_step') != '' ? 'progress-success' : 'progress-striped active') ?>">
    <div id="progressbar" class="bar" style="width: <?php echo $this->get('perc'); ?>%;"></div>
</div>
<a href="?step=converter"
   class="btn btn-inverse">Stop</a>
<a id="nextbutton" <?php if($this->get('next_step') != ''): ?>
   href="<?php echo $this->get('next_step'); ?>"
    <?php endif; ?>
   class="btn <?php echo ($this->get('next_step') != '' ? 'btn-success' : 'disabled') ?>">Next Step</a>

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
                                            current.html(data['next']);
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

        process('players');
    });
</script>