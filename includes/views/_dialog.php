<div data-role="page" <?php if(isset($id)){?>id="<?php echo $id;}?>" data-close-btn="none" >
	<div data-role="header" data-theme="b">
		<h1><?php echo $title?></h1>
	</div>
	<div data-role="content" <?php if(isset($id)){?>id="<?php echo $id;}?>-content">
		<h2 id="diag-heading"></h2>
		<img id="diag-image"/>
		<div id="diag-text"></div>
		<a href="" id="diag-btn" data-rel="page" data-role="button" data-theme="b">OK</a>
	</div>
</div>