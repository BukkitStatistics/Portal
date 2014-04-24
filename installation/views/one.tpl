<form name="install" method="post" class="form-inline language-form">
    <h2><i class="fa fa-exclamation-triangle"></i> Warning</h2>

    <p>The plugin needs to be configured and running before the installation. Additionally, be ready to provide the
        database
        details during the next step.</p>

    <p>If you have a Statistician database to import, you can do that after you specify the database details.</p>

    <br>

    <h2><i class="fa fa-globe"></i> Language</h2>

    <p>Select an language for the installation process and the whole portal afterwards.</p>
    <p><em>Only english is supported right now. More to come soon!</em></p>

    <p>
        <select name="lang" id="lang" class="form-control">
            <option value="en" selected="selected">English</option>
        </select>
        <button type="submit" name="lang_submit" value="1" class="btn btn-primary">Submit</button>
    </p>
</form>