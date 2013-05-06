<div class="row-fluid">
    <div class="span2" style="text-align:center;">
        <h2><i class="icon-user icon-3x" style="color:#ccc;"></i></h2>
        <h3>General</h3>
    </div>
    <div class="span10 well">
        <div class="row-fluid">
            <div class="span6">
                <fieldset>
                    <label for="adminemail"><strong>E-Mail</strong></label>
                    <input type="email" name="adminemail" id="adminemail" class="input-block-level"
                           value="{{ adminemail }}"/>

                    <label for="language"><strong>Language</strong></label>
                    <select id="language" name="language" class="input-block-level">
                        {% for key, value in langs %}
                            {{ printOption(value, key, language) }}
                        {% endfor %}
                    </select>
                </fieldset>
            </div>
            <div class="span6">
                <fieldset>
                    <label for="adminpw"><strong>Password</strong></label>
                    <input type="password" name="adminpw" id="adminpw" class="input-block-level"/>
                </fieldset>
            </div>
        </div>
    </div>
</div>