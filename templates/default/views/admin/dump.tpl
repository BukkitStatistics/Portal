<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-remove-circle icon-3x" style="color:#ccc;"></i></h2>

        <h3>Dump data</h3>
    </div>
    <div class="span10 well">
        <div class="alert alert-danger alert-block">
            <p>
                <span class="label label-important">Warning!</span> This operation cannot be undone!
            </p>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <h4>Dump players</h4>
                <fieldset>
                    <label for="dump_players" class="checkbox">
                        <input type="hidden" name="dump_players" value="0"/>
                        <input type="checkbox" value="1" name="dump_players" id="dump_players" />
                        Delete all players
                        <small class="help-inline">This will also remove all data associated with the players.</small>
                    </label>
                </fieldset>
            </div>
            <div class="span6">
                <h4>Dump statistical data</h4>
                <fieldset>
                    <label for="dump_data" class="checkbox">
                        <input type="hidden" name="dump_data" value="0"/>
                        <input type="checkbox" value="1" name="dump_data" id="dump_data"/>
                        Delete all statistical data
                        <small class="help-inline">This will remove the statistical data for all players.</small>
                    </label>
                    <label for="dump_items" class="checkbox">
                        <input type="hidden" name="dump_items" value="0"/>
                        <input type="checkbox" value="1" name="dump_items" id="dump_items"/>
                        Delete item data
                        <small class="help-inline">This will only remove item data for all players.</small>
                    </label>
                    <label for="dump_blocks" class="checkbox">
                        <input type="hidden" name="dump_blocks" value="0"/>
                        <input type="checkbox" value="1" name="dump_blocks" id="dump_blocks"/>
                        Delete block data
                        <small class="help-inline">This will only remove block data for all players.</small>
                    </label>
                    <hr>
                    <label for="dump_deaths" class="checkbox">
                        <input type="hidden" name="dump_deaths" value="0"/>
                        <input type="checkbox" value="1" name="dump_deaths" id="dump_deaths"/>
                        Delete all deaths
                        <small class="help-inline">This will remove all death types like PVP, PVE and other for all players.</small>
                    </label>
                    <label for="dump_pvp" class="checkbox">
                        <input type="hidden" name="dump_pvp" value="0"/>
                        <input type="checkbox" value="1" name="dump_pvp" id="dump_pvp"/>
                        Delete pvp deaths
                        <small class="help-inline">This will only remove pvp data for all players.</small>
                    </label>
                    <label for="dump_pve" class="checkbox">
                        <input type="hidden" name="dump_pve" value="0"/>
                        <input type="checkbox" value="1" name="dump_pve" id="dump_pve"/>
                        Delete pve deaths
                        <small class="help-inline">This will only remove pve data for all players.</small>
                    </label>
                    <label for="dump_other" class="checkbox">
                        <input type="hidden" name="dump_other" value="0"/>
                        <input type="checkbox" value="1" name="dump_other" id="dump_other"/>
                        Delete other deaths
                        <small class="help-inline">This will only remove other death data for all players.</small>
                    </label>
                </fieldset>
            </div>
        </div>
    </div>
</div>