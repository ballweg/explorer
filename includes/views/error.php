<?php
header("HTTP/1.0 404 Not Found");
render('_header',array('title'=>'Error'))
?>
<p><?php echo $msg?></p>
<?php render('_footer')?>