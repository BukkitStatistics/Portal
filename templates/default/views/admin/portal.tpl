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
        <div class="row-fluid">
            <div class="span12">
                <h3>Caching</h3>
                <div class="alert alert-info">
                    <p>
                        <span class="label label-info"><strong>Info!</strong></span>
                        Set the time how long the specific module should be stored in the cache.
                        This will drastically increase the performance on large servers.<br>
                        Set the specific caching to <strong>0</strong> to disable it.
                    </p>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="row-fluid">
                    <div class="span4">
                        <h4>Pages</h4>
                    </div>
                    <div class="span2">
                        <label for="cache_pages[d]">days</label>
                        <input type="text" class="input-block-level" id="cache_pages[d]" name="cache_pages[d]"
                                value="<?php echo $this->get('cache_pages[d]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_pages[h]">hours</label>
                        <input type="text" class="input-block-level" id="cache_pages[h]" name="cache_pages[h]"
                               value="<?php echo $this->get('cache_pages[h]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_pages[m]">minutes</label>
                        <input type="text" class="input-block-level" id="cache_pages[m]" name="cache_pages[m]"
                               value="<?php echo $this->get('cache_pages[m]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_pages[s]">seconds</label>
                        <input type="text" class="input-block-level" id="cache_pages[s]" name="cache_pages[s]"
                               value="<?php echo $this->get('cache_pages[s]'); ?>"/>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <h4>Options</h4>
                    </div>
                    <div class="span2">
                        <label for="cache_options[d]">days</label>
                        <input type="text" class="input-block-level" id="cache_options[d]" name="cache_options[d]"
                               value="<?php echo $this->get('cache_options[d]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_options[h]">hours</label>
                        <input type="text" class="input-block-level" id="cache_options[h]" name="cache_options[h]"
                               value="<?php echo $this->get('cache_options[h]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_options[m]">minutes</label>
                        <input type="text" class="input-block-level" id="cache_options[m]" name="cache_options[m]"
                               value="<?php echo $this->get('cache_options[m]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_options[s]">seconds</label>
                        <input type="text" class="input-block-level" id="cache_options[s]" name="cache_options[s]"
                               value="<?php echo $this->get('cache_options[s]'); ?>"/>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="row-fluid">
                    <div class="span4">
                        <h4>Skins</h4>
                    </div>
                    <div class="span2">
                        <label for="cache_skins[d]">days</label>
                        <input type="text" class="input-block-level" id="cache_skins[d]" name="cache_skins[d]"
                               value="<?php echo $this->get('cache_skins[d]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_skins[h]">hours</label>
                        <input type="text" class="input-block-level" id="cache_skins[h]" name="cache_skins[h]"
                               value="<?php echo $this->get('cache_skins[h]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_skins[m]">minutes</label>
                        <input type="text" class="input-block-level" id="cache_skins[m]" name="cache_skins[m]"
                               value="<?php echo $this->get('cache_skins[m]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_skins[s]">seconds</label>
                        <input type="text" class="input-block-level" id="cache_skins[s]" name="cache_skins[s]"
                               value="<?php echo $this->get('cache_skins[s]'); ?>"/>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <h4>Player search</h4>
                    </div>
                    <div class="span2">
                        <label for="cache_search[d]">days</label>
                        <input type="text" class="input-block-level" id="cache_search[d]" name="cache_search[d]"
                               value="<?php echo $this->get('cache_search[d]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_search[h]">hours</label>
                        <input type="text" class="input-block-level" id="cache_search[h]" name="cache_search[h]"
                               value="<?php echo $this->get('cache_search[h]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_search[m]">minutes</label>
                        <input type="text" class="input-block-level" id="cache_search[m]" name="cache_search[m]"
                               value="<?php echo $this->get('cache_search[m]'); ?>"/>
                    </div>
                    <div class="span2">
                        <label for="cache_search[s]">seconds</label>
                        <input type="text" class="input-block-level" id="cache_search[s]" name="cache_search[s]"
                               value="<?php echo $this->get('cache_search[s]'); ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>