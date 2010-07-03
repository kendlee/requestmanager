<html>
<head>
</head>
<body>
  <div id="container">
    <?php if ($has_menu) $this->load->view('navigation')?>
    <div id="content">
      <?php echo $content; ?>
    </div>
  </div>
</body>
</html>