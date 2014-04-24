<div class="row">
    <div class="col-md-12 well">
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <label for="first_join_msg"><strong>First join message</strong></label>

                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="show_first_join_msg" value="0"/>
                            <input type="checkbox" value="1" name="show_first_join_msg" id="show_first_join_msg"
                                    {{ showChecked(1, show_first_join_msg) }}>
                            Show
                        </label>
                    </div>
                    <input type="text" name="first_join_msg" id="first_join_msg"
                           class="form-control"
                           value="{{ first_join_msg }}"/>
                   <span class="help-block">
                        Use <span class="label label-info">&lt;PLAYER&gt;</span> to display the name of the player.
                    </span>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <label for="welcome_msg"><strong>Welcome message</strong></label>

                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="show_welcome_msg" value="0"/>
                            <input type="checkbox" value="1" name="show_welcome_msg" id="show_welcome_msg"
                                    {{ showChecked(1, show_welcome_msg) }}>
                            Show
                        </label>
                    </div>
                    <input type="text" name="welcome_msg" id="welcome_msg"
                           class="form-control"
                           value="{{ welcome_msg }}"/>
                </fieldset>
            </div>
        </div>
    </div>
</div>