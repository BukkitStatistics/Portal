<div class="row">
    <div class="col-md-12 well">
        <div class="alert alert-info">
            <p>
                <span class="label label-info">Info!</span> Here you can specify which data should be logged.<br>
                Due to architectural limitations, you only can disable major types.
            </p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <h4>General modules</h4>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="module_blocks" value="0"/>
                            <input type="checkbox" value="1" name="module_blocks" id="module_blocks"
                                    {{ showChecked(1, module_blocks) }}>
                            Log Blocks
                            <small>This will log all block events like destroying or placing.</small>
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="module_items" value="0"/>
                            <input type="checkbox" value="1" name="module_items" id="module_items"
                                    {{ showChecked(1, module_items) }}>
                            Log Items
                            <small>This will log all item events like dropping, using, picking up etc.</small>
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="module_deaths" value="0"/>
                            <input type="checkbox" value="1" name="module_deaths" id="module_deaths"
                                    {{ showChecked(1, module_deaths) }}>
                            Log Deaths
                            <small>This will log all pvp, pve, evp and other death causes of the players.</small>
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="module_inventory" value="0"/>
                            <input type="checkbox" value="1" name="module_inventory" id="module_inventory"
                                    {{ showChecked(1, module_inventory) }}>
                            Log and show players inventory
                            <small>This will log the inventory of every player.</small>
                        </label>
                    </div>
                </fieldset>

                <fieldset>
                    <h4>Hooks</h4>

                    {% for hook in hooks %}
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="{{ hook.key }}" value="0"/>
                                <input type="checkbox" value="1" name="{{ hook.key }}" id="{{ hook.key }}"
                                        {{ showChecked(1, hook.value) }}>
                                Hook into {{ hook.key|slice(5)|replace({'.': '_'})|humanize }}
                            </label>
                        </div>
                    {% else %}
                        {{ 'No hooks in your database.'|trans }}
                    {% endfor %}
                </fieldset>
            </div>
        </div>
    </div>
</div>