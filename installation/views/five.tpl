<h2><i class="icon-ok-circle icon-large" style="color: #ccc"></i> Finishing</h2>

<?php
Util::showMessages('*', 'install/five', 'alert alert-error');
?>

<p>
    The installation of the web portal is completed. Now press the button to delete all files and directories which were
    necessary for the installation.
</p>
<p>
    If the system could not delete the files, please do it manually! Only if this has been done the web portal is
    reachable.
</p>

<strong>Files and folders to be deleted:</strong>
<ul>
    <li>installation</li>
    <li>install.php</li>
</ul>
<br>
<input type="submit" value="Go to web portal" name="finish" class="btn btn-success"/>