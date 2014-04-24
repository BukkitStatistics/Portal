<div class="row">
    <div class="col-md-12 well">
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <label for="adminemail"><strong>E-Mail</strong></label>
                    <input type="email" name="adminemail" id="adminemail" class="form-control"
                           value="{{ adminemail }}"/>

                    <label for="language"><strong>Language</strong></label>
                    <select id="language" name="language" class="form-control">
                        {% for key, value in langs %}
                            {{ printOption(value, key, language) }}
                        {% endfor %}
                    </select>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <label for="adminpw"><strong>Password</strong></label>
                    <input type="password" name="adminpw" id="adminpw" class="form-control"/>
                </fieldset>
            </div>
        </div>
    </div>
</div>