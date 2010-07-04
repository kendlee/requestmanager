<?php
  $sort_method = $this->uri->segment(2);
  $selector = $this->uri->segment(3);
?>
<div id="selector">
  <ul>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/1');?>">1</a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/2');?>">2</a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/3');?>">3</a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/4');?>">4</a></li>
  </ul>
</div>
<div id="sorter">
  <ul>
    <li><a href="<?php echo site_url('manager/by_resident/'.$selector);?>">By Residents</a></li>
    <li><a href="<?php echo site_url('manager/by_request/'.$selector);?>">By Request</a></li>
  </ul>
</div>