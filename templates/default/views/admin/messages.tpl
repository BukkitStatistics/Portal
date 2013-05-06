<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-comment icon-3x" style="color:#ccc;"></i></h2>

        <h3>Messages</h3>
    </div>
    <div class="span10 well">
        <div class="row-fluid">
            <div class="span6">
                <fieldset>
                    <label for="first_join_msg"><strong>First join message</strong></label>
                    <label for="show_first_join_msg" class="checkbox">
                        <input type="hidden" name="show_first_join_msg" value="0"/>
                        <input type="checkbox" value="1" name="show_first_join_msg" id="show_first_join_msg"
                                {{ showChecked(1, show_first_join_msg) }}>
                        Show
                    </label>
                    <input type="text" name="first_join_msg" id="first_join_msg"
                           class="input-block-level"
                           value="{{ first_join_msg }}"/>
                </fieldset>
                    <span class="help-block">
                        Use <span class="label label-info">&lt;PLAYER&gt;</span> to display the name of the player.
                    </span>
            </div>
            <div class="span6">
                <fieldset>
                    <label for="welcome_msg"><strong>Welcome message</strong></label>
                    <label for="show_welcome_msg" class="checkbox">
                        <input type="hidden" name="show_welcome_msg" value="0"/>
                        <input type="checkbox" value="1" name="show_welcome_msg" id="show_welcome_msg"
                                {{ showChecked(1, show_welcome_msg) }}>
                        Show
                    </label>
                    <input type="text" name="welcome_msg" id="welcome_msg"
                           class="input-block-level"
                           value="{{ welcome_msg }}"/>
                </fieldset>
            </div>
        </div>
    </div>
</div>