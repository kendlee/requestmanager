<?php
  $sort_method = 'by_resident';
?>
<div id="selector">
  <ul>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/1');?>">1</a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/2');?>">2</a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/3');?>">3</a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/4');?>">4</a></li>
  </ul>
</div>
//end of selector.php