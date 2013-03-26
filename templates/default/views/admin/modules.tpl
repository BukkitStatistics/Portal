<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-tasks icon-3x" style="color:#ccc;"></i></h2>

        <h3>Modules</h3>
    </div>
    <div class="span10 well">
        <div class="alert alert-info alert-block">
            <p>
                <span class="label label-info">Info!</span> Here you can specify which data should be logged.<br>
                Due to architectural limitations, you only can disable major types.
            </p>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <fieldset>
                    <label for="module_blocks" class="checkbox">
                        <input type="hidden" name="module_blocks" value="0"/>
                        <input type="checkbox" value="1" name="module_blocks" id="module_blocks"
                            <?php fHTML::showChecked('1', $this->get('module_blocks')); ?>>
                        Log Blocks
                        <small class="help-inline">This will log all block events like destroying or placing.</small>
                    </label>
                    <label for="module_items" class="checkbox">
                        <input type="hidden" name="module_items" value="0"/>
                        <input type="checkbox" value="1" name="module_items" id="module_items"
                            <?php fHTML::showChecked('1', $this->get('module_items')); ?>>
                        Log Items
                        <small class="help-inline">This will log all item events like dropping, using, picking up etc.</small>
                    </label>
                    <label for="module_deaths" class="checkbox">
                        <input type="hidden" name="module_deaths" value="0"/>
                        <input type="checkbox" value="1" name="module_deaths" id="module_deaths"
                            <?php fHTML::showChecked('1', $this->get('module_deaths')); ?>>
                        Log Deaths
                        <small class="help-inline">This will log all pvp, pve, evp and other death causes of the players.</small>
                    </label>

                </fieldset>
            </div>
        </div>
    </div>
</div>