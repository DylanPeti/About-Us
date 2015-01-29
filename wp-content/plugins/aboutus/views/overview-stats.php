<?php 
// print_r($stats);
foreach($stats as $i): ?>
<li>
  <span class="count <?php echo $i['key'] ?>"><?php echo intval($i['value']) ?></span>
  <h4><?php echo $i['title'] ?></h4>
</li>
<?php endforeach ?>
<?php if(count($connect)): foreach($connect as $i): ?>
<li class="connect">
  <a href="<?php echo $i['url'] ?>" class="<?php echo @$i['class'] ?>">
    <h4><?php echo $i['title'] ?></h4>
  </a>
</li>
<?php endforeach; endif ?>