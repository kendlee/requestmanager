<?php
  $sort_method = $this->uri->segment(2);
  $selector = $this->uri->segment(3);
?>
<div id="selector">
  <h2>Categories</h2>
  <ul>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/1');?>"><?=CATEGORY_1?></a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/2');?>"><?=CATEGORY_2?></a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/3');?>"><?=CATEGORY_3?></a></li>
    <li><a href="<?php echo site_url('manager/'.$sort_method.'/4');?>"><?=CATEGORY_4?></a></li>
  </ul>
</div>
<div id="sorter">
  <h2>Show</h2>
  <ul>
    <li><a href="<?php echo site_url('manager/by_resident/'.$selector);?>">By Residents</a></li>
    <li><a href="<?php echo site_url('manager/by_request/'.$selector);?>">By Requests</a></li>
  </ul>
</div>