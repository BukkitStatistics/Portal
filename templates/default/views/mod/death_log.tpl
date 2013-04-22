<div class="content" data-mod="death_log">
    <?php if($this->get('death_log')->countReturnedRows() != 0): ?>
        <?php
            foreach($this->get('death_log') as $log):
                if(is_null($log['player_killed'])) {
                    $killer = new Player($log['id1']);
                    $victim = new Player($log['id2']);

                    $killer_img = $killer->getPlayerHead(16, 'img-thumb img-polaroid');
                    $victim_img = $victim->getPlayerHead(16, 'img-thumb img-polaroid');
                }
                else {
                    if($log['player_killed']) {
                        $killer = new Entity($log['id1']);
                        $victim = new Player($log['id2']);

                        $killer_img = $killer->getImage(16, 'img-thumb img-polaroid');
                        $victim_img = $victim->getPlayerHead(16, 'img-thumb img-polaroid');
                    }
                    else {
                        $victim = new Entity($log['id1']);
                        $killer = new Player($log['id2']);

                        $victim_img = $victim->getImage(16, 'img-thumb img-polaroid');
                        $killer_img = $killer->getPlayerHead(16, 'img-thumb img-polaroid');
                    }
                }
                $material= new Material($log['material_id']);
                $time = new fTimestamp($log['time']);
        ?>
            <div class="well well-small">
                <div class="row-fluid">
                    <div class="span3">
                        <?php echo $time->format('std'); ?>
                    </div>
                    <div class="span3">
                        <span class="label label-success">
                            <?php echo $killer_img; ?>
                            <?php echo $killer->encodeName(); ?>
                        </span>
                    </div>
                    <div class="span2">
                        <?php echo $material->getImage(32, null, true); ?>
                    </div>
                    <div class="span4">
                        <span class="label label-important">
                            <?php echo $victim_img; ?>
                            <?php echo $victim->encodeName(); ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div id="death_logPagination" class="pagination-centered"></div>

        <script type="text/javascript">
            $(document).ready(function () {
                callModulePage(
                    'death_log',
                    <?php echo $this->get('death_log_pages'); ?>,
                    <?php echo $this->get('death_log_page'); ?>
                );
            });
        </script>
    <?php else: ?>
    <div class='force-center'><em>No death log.</em></div>
    <?php endif; ?>

</div>