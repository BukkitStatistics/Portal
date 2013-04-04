<?php
$tpl = Util::newTpl($this, 'admin/dump', 'sub');

if(fRequest::isPost() && fRequest::check('save')) {
    try {
        $db = fORMDatabase::retrieve();

        if(fRequest::get('dump_players', 'int')) {
            $db->translatedExecute('
                   DELETE FROM "prefix_players" WHERE 1;
            ');
        }
        else {
            if(fRequest::get('dump_items', 'int') || fRequest::get('dump_data', 'int')) {
                $db->translatedExecute('
                   DELETE FROM "prefix_total_items" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_pickedup_items" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_dropped_items" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_used_items" WHERE 1;
                ');
            }
            if(fRequest::get('dump_blocks', 'int') || fRequest::get('dump_data', 'int')) {
                $db->translatedExecute('
                   DELETE FROM "prefix_total_blocks" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_destroyed_blocks" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_placed_blocks" WHERE 1;
                ');
            }

            // delete everything else not covered by the statements before
            if(fRequest::get('dump_data', 'int')) {
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_log_players" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_distances" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_misc_info_players" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_player_inventories" WHERE 1;
                ');
            }

            if(fRequest::get('dump_pvp', 'int') || fRequest::get('dump_deaths', 'int')) {
                $db->translatedExecute('
                   DELETE FROM "prefix_total_pvp_kills" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_pvp_kills" WHERE 1;
                ');
            }
            if(fRequest::get('dump_pve', 'int') || fRequest::get('dump_deaths', 'int')) {
                $db->translatedExecute('
                   DELETE FROM "prefix_total_pve_kills" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_pve_kills" WHERE 1;
                ');
            }
            if(fRequest::get('dump_other', 'int') || fRequest::get('dump_deaths', 'int')) {
                $db->translatedExecute('
                   DELETE FROM "prefix_total_deaths" WHERE 1;
                ');
                $db->translatedExecute('
                   DELETE FROM "prefix_detailed_death_players" WHERE 1;
                ');
            }
        }

    } catch(fSQLException $e) {
        fMessaging::create('input', 'admin', $e->getMessage());
    }
}