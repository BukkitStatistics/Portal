<form name="install" method="post" class="form-inline language-form">
    <h2><i class="icon-warning-sign"></i> Warning</h2>

    <p>The plugin needs to be configured and running before the installation. Additionally, be ready to provide the
        database
        details during the next step.</p>

    <p>If you have a Statistician database to import, you can do that after you specify the database details.</p>

    <h2><i class="icon-info-sign"></i> Skip installation</h2>

    <p>
        If you already installed the portal then you can go directly to the portal with no further configuration.
    </p>
    <p>
        <button type="submit" name="skip" value="1" class="btn btn-large">Skip</button>
    </p>
    <br>

    <h2><i class="icon-globe"></i> Language</h2>

    <p>Select an language for the installation process and the whole portal afterwards.

    <p>
        <select name="lang" id="lang">
            <option value="en" selected="selected">English</option>
            <option value="de">German</option>
        </select>
        <button type="submit" name="lang_submit" value="1" class="btn btn-primary">Submit</button>
    </p>
</form>