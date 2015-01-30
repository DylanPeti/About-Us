<?php if($stats):?>

    <div class="stats" id="stats_<?=strtolower($name)?>">
    <h3><div><?php //leave for app icon ?></div><?=$name?></h3>
    <ul>
    <?php 
    foreach($stats as $name => $value):?>
        <li class="icon-<?=$name?> <?=$name?>"><div class="stats_name"><?=$name?></div><div class="stats_value"><?= is_array($value) ? implode(', ',$value) : $value;?></div></li>
    <?php 
    endforeach; ?>
    </ul>
    </div>
<?php else:?>

    <script type="text/javascript">
        jQuery('#stats_tab_<?=$name?>, #stats_<?=$name?>').remove();
    </script>

<?php endif;?>
