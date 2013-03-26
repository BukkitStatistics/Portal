<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-pencil icon-3x" style="color:#ccc;"></i></h2>
        <h3>Portal</h3>
    </div>
    <div class="span10 well">
        <div class="row-fluid">
            <div class="span6">
                <fieldset>
                    <label for="portal_title"><strong>Server name</strong></label>
                    <input type="text" name="portal_title" id="portal_title" class="input-block-level"
                           value="<?php echo $this->get('portal_title'); ?>"/>

                    <label for="time_format1"><strong>Time Format</strong></label>
                    <label class="radio">
                        <input type="radio" name="time_format" id="time_format1"
                               value="24" <?php fHTML::showChecked(24,
                                                                   $this->get('time_format')) ?>>
                        24 hour format: <?php echo date('H:i - d.m.Y') ?>
                    </label>
                    <label class="radio">
                        <input type="radio" name="time_format" id="time_format0"
                               value="12" <?php fHTML::showChecked(12,
                                                                   $this->get('time_format')) ?>>
                        12 hour format: <?php echo date('g:i a - d.m.Y') ?>
                    </label>
                </fieldset>
            </div>
            <div class="span6">
                <fieldset>
                    <label for="logo_url"><strong>Logo URL</strong></label>
                    <input type="text" name="logo_url" id="logo_url" class="input-block-level"
                           value="<?php echo $this->get('logo_url'); ?>"/>

                    <label for="timezone"><strong>Timezone</strong></label>
                    <select id="timezone" name="timezone" class="input-block-level">
                        <?php

                        foreach($this->get('times') as $key => $value)
                            fHTML::printOption($value, $key, $this->get('timezone'));
                        ?>
                    </select>
                </fieldset>
            </div>
        </div>
    </div>
</div>