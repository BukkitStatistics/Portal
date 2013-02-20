<?php
Util::showMessages('*', 'install/converter', 'alert alert-error');
?>
<fieldset id="converter">
    <?php if($this->get('state') == null): ?>
    <p>Enter the data where your old data is stored!</p>
    <label for="host"><?php echo fText::compose('server'); ?>:</label>
    <input type="text" name="host" id="host" placeholder="localhost" value="<?php echo $this->get('host') ?>"><br>
    <label for="user"><?php echo fText::compose('user'); ?>:</label>
    <input type="text" name="user" id="user" placeholder="user" value="<?php echo $this->get('user') ?>"><br>
    <label for="pw"><?php echo fText::compose('pw'); ?>:</label>
    <input type="text" name="pw" id="pw" placeholder="password" value="<?php echo $this->get('pw') ?>"><br>
    <label for="database"><?php echo fText::compose('db'); ?>:</label>
    <input type="text" name="database" id="database" placeholder="statistican"
           value="<?php echo $this->get('database') ?>"><br>
    <?php endif; ?>

    <?php if($this->get('state') == 2): ?>
    <p>This could last a long time! Go and drink an coffee or finish your dinner ;)</p>
    <p>Do not reload the page even if your browser will take ages for the next page...</p>

    <p>Choose which entries do you want to convert:</p>
    <table>
        <tr>
            <td>Players:</td>
            <td><label for="convert_players"><?php echo $this->get('player_count'); ?></label></td>
            <td><input type="checkbox" name="convert[players]" id="convert_players" disabled="disabled"
                       checked="checked">
            </td>
            <!-- TODO add options to choose which players should be converted e.g. number of logins, last login time -->
        </tr>
        <tr>
            <td>Player vs. Player Kills:</td>
            <td><label for="convert_pvp"><?php echo $this->get('total_pvp_kills'); ?></label></td>
            <td><input type="checkbox" name="convert[pvp]" id="convert_pvp" checked="checked"></td>
        </tr>
        <tr>
            <td>Player vs. Environment Kills:</td>
            <td><label for="convert_pve"><?php echo $this->get('total_pve_kills'); ?></label></td>
            <td><input type="checkbox" name="convert[pve]" id="convert_pve" checked="checked"></td>
        </tr>
        <tr>
            <td>Environment vs. Player Kills:</td>
            <td><label for="convert_evp"><?php echo $this->get('total_evp_kills'); ?></label></td>
            <td><input type="checkbox" name="convert[evp]" id="convert_evp" checked="checked"></td>
        </tr>
        <tr>
            <td>Death Causes:</td>
            <td><label for="convert_deaths"><?php echo $this->get('total_deaths'); ?></label></td>
            <td><input type="checkbox" name="convert[deaths]" id="convert_deaths" checked="checked"></td>
        </tr>
        <tr>
            <td>Total Blocks Destroyed:</td>
            <td><label for="convert_blocks_destroyed"><?php echo $this->get('total_blocks_destroyed'); ?></label></td>
            <td><input type="checkbox" name="convert[blocks_destroyed]" id="convert_blocks_destroyed" checked="checked"></td>
        </tr>
        <tr>
            <td>Total Blocks Placed:</td>
            <td><label for="convert_blocks_placed"><?php echo $this->get('total_blocks_placed'); ?></label></td>
            <td><input type="checkbox" name="convert[blocks_placed]" id="convert_blocks_placed" checked="checked"></td>
        </tr>
        <tr>
            <td>Total Items Dropped:</td>
            <td><label for="convert_items_dropped"><?php echo $this->get('total_items_dropped'); ?></label></td>
            <td><input type="checkbox" name="convert[items_dropped]" id="convert_items_dropped" checked="checked"></td>
        </tr>
        <tr>
            <td>Total Items Picked Up:</td>
            <td><label for="convert_items_picked"><?php echo $this->get('total_items_picked'); ?></label></td>
            <td><input type="checkbox" name="convert[items_picked]" id="convert_items_picked" checked="checked"></td>
        </tr>
    </table>
    <input type="hidden" name="start" value="true">
    <?php endif; ?>
    <input type="submit" name="converter_submit" value="<?php echo fText::compose('Next'); ?>">
</fieldset>
