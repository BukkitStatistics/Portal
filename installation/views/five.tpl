<?php
Util::showMessages('*', 'install/five', 'alert alert-error');
?>
<fieldset>
    <legend>Finishing</legend>
    <p>The installation of the web portal is completed. No press this button to delete all files and directories which were necessary for the installation.</p>
    <p>If the system could not delete the files, please do it manually! Only if this has been done the web portal is reachable.</p>
    <b>Files and folders to be deleted:</b>
    <ul>
        <li>installation</li>
        <li>install.php</li>
    </ul>
</fieldset>
<br>
<input type="submit" value="Go to web portal" name="finish" class="btn btn-success" />