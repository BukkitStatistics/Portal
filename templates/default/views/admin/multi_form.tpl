<?php if(fMessaging::check('slug', 'admin/multi')): ?>
    <?php Util::showMessages('slug', 'admin/multi', 'alert alert-error'); ?>
<?php else: ?>
<?php Util::showMessages('file', 'admin/multi', 'alert alert-error'); ?>
<div class="row-fluid">
    <div class="span6">
        <label for="server_name"><strong>Server name</strong></label>
        <input type="text" name="server_name" id="server_name" class="input-block-level"
               value="<?php echo $this->get('server_name'); ?>"/>
    </div>
    <div class="span6">
        <strong>Server slug:</strong>
        <input type="text" name="server_slug" id="server_slug" class="input-block-level"
               value="<?php echo $this->get('server_slug'); ?>"
            <?php if(fRequest::get('action', 'string') == 'edit'): ?> disabled="disabled" <?php endif; ?>/>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <div class="row-fluid">
            <div class="span8">
                <fieldset>
                    <label for="db_host"><strong>Database Host</strong></label>
                    <input type="text" name="db_host" id="db_host" class="input-block-level"
                           value="<?php echo $this->get('db_host'); ?>"/>
                </fieldset>
            </div>
            <div class="span4">
                <fieldset>
                    <label for="db_port"><strong>Port</strong></label>
                    <input type="text" name="db_port" id="db_port" class="input-block-level"
                           value="<?php echo $this->get('db_port') ?>"/>
                </fieldset>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <label for="db_user"><strong>Database Username</strong></label>
                <input type="text" name="db_user" id="db_user" class="input-block-level"
                       value="<?php echo $this->get('db_user'); ?>"/>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="row-fluid">
            <div class="span8">
                <fieldset>
                    <label for="db_name"><strong>Database Name</strong></label>
                    <input type="text" name="db_name" id="db_name" class="input-block-level"
                           value="<?php echo $this->get('db_name'); ?>"/>
                </fieldset>
            </div>
            <div class="span4">
                <fieldset>
                    <label for="db_prefix"><strong>Prefix</strong></label>

                    <div class="input-append span8">
                        <input type="text" name="db_prefix" id="db_prefix" class="span10"
                               value="<?php echo $this->get('db_prefix') ?>"/>
                        <span class="add-on">_</span>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <label for="db_pw"><strong>Database Password</strong></label>
                <input type="text" name="db_pw" id="db_pw" class="input-block-level"
                       value="<?php echo $this->get('db_pw'); ?>"/>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="save_server" value="1"/>
    <?php if(fRequest::get('action', 'string') == 'add'): ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#server_name').keyup(function () {
                    $('#server_slug').val(string_to_slug($(this).val(), '_'));
                });
            });
        </script>
    <?php endif; ?>
<?php endif; ?>