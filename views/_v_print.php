<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta charset="UTF-8" />	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">		
	
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
	<div class="container">
	<!--Main Navigation -->
		
    <!-- Main Section of page where Views Appear-->
	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>

	
	</div>


<script src="/js/jquery-2.0.3.min.js"></script>
<script src="/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>