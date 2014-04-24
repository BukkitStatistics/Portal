<div class="row">
    <div class="col-md-12 well">
        <div class="alert alert-danger alert-block">
            <p>
                <span class="label label-danger">Warning!</span> This operation cannot be undone!
            </p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Dump players</h4>
                <fieldset>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="dump_players" value="0"/>
                            <input type="checkbox" value="1" name="dump_players" id="dump_players"/>
                            Delete all players
                            <small>This will also remove all data associated with the players.</small>
                        </label>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6">
                <h4>Dump statistical data</h4>
                <fieldset>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="dump_data" value="0"/>
                            <input type="checkbox" value="1" name="dump_data" id="dump_data"/>
                            Delete all statistical data
                            <small>This will remove the statistical data for all players.</small>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="dump_items" value="0"/>
                            <input type="checkbox" value="1" name="dump_items" id="dump_items"/>
                            Delete item data
                            <small>This will only remove item data for all players.</small>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="dump_blocks" value="0"/>
                            <input type="checkbox" value="1" name="dump_blocks" id="dump_blocks"/>
                            Delete block data
                            <small>This will only remove block data for all players.</small>
                        </label>
                    </div>
                    <hr>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="dump_deaths" value="0"/>
                            <input type="checkbox" value="1" name="dump_deaths" id="dump_deaths"/>
                            Delete all deaths
                            <small>This will remove all death types like PVP, PVE and other for all
                                players.
                            </small>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="dump_pvp" value="0"/>
                            <input type="checkbox" value="1" name="dump_pvp" id="dump_pvp"/>
                            Delete pvp deaths
                            <small>This will only remove pvp data for all players.</small>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="dump_pve" value="0"/>
                            <input type="checkbox" value="1" name="dump_pve" id="dump_pve"/>
                            Delete pve deaths
                            <small>This will only remove pve data for all players.</small>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="dump_other" value="0"/>
                            <input type="checkbox" value="1" name="dump_other" id="dump_other"/>
                            Delete other deaths
                            <small>This will only remove other death data for all players.</small>
                        </label>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>