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
		<header class="row">
			<!--Top Navigation -->
			<div class="col-md-12 col-sm-12 pull-right">
				<ul class="nav navbar-nav navbar-right">
					<!-- If not logged in view home page -->
					<?php if(!$user): ?>
						<li><a href="/users/login" class="ltgreen">Login</a></li>
						<li><a href="/users/signup" class="ltgreen">Sign Up</a></li>
					<?php else: ?>
						<li><a href="/users/logout" class="ltgreen">Logout</a></li>
					<?php endif; ?>
					<?php if($user): ?>
					<li><a href="/users/edit_profile" class="ltgreen">Profile</a></li>
      				<li><a href="/recipes/my_recipes" class="ltgreen">My Juices</a></li>
      				<?php endif; ?>
				</ul>
			</div>

			<!--Logo and Vegt. Image -->
	    	<div class="col-md-5 col-sm-5">
	        	<a href="/">
	                 <img src="/images/logo.png" alt="Juice ON!" class="img-responsive">
	            </a>
	        </div>
	    	<div class="col-md-7 col-sm-7">
	        	<img src="/images/vegs.png" alt="Vegt. Graphic" class="img-responsive hidden-xs"/>
	        </div>
    	</header>

		<!--Main Navigation -->
		<div class="row">
	    	<nav class="navbar navbar-default" role="navigation">
            	<div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
	                  <span class="sr-only">Toggle navigation</span>
	                  <span class="icon-bar"></span>
	                  <span class="icon-bar"></span>
	                  <span class="icon-bar"></span>
	                </button>
            	</div>

            <!-- Selection of Juice Colors-->
            	<div class="collapse navbar-collapse" id="collapse">
                	
		                <ul class="nav navbar-nav">
		                    <li><a href="/recipes/by_color/4" class="red">Red Juices</a></li>
		                    <li><a href="/recipes/by_color/3" class="orange">Orange Juices</a></li>
		                    <li><a href="/recipes/by_color/2" class="yellow">Yellow Juices</a></li>
		                    <li><a href="/recipes/by_color/1" class="green">Green Juices</a></li>
		                    <li><a href="/recipes/by_color/5" class="purple">Purple Juices</a></li>  
	                	</ul>
                	

		                <form class="navbar-form" role="search" action="/recipes/by_search/" method="POST">
	     					<div class="form-group">
	        					<input type="text" class="form-control" name="search_term" id="search_term" placeholder="Search by Ingredient">
	      					</div>
	      					<button type="submit" class="btn btn-default btn-success">Search</button>
	    				</form>
	    			
	            </div>
	         </nav>
	     </div>
	    
    <!-- Main Section of page where Views Appear-->
	<?php if(isset($content)) echo $content; ?>
	
	<!-- Footer -->
		<footer class="row">
         	<p><small>&copy; Marnie Scully  |  All Recipes and content are from <a href="http://www.rebootwithjoe.com" target="_blank"> 101 Recipes from by Joe Cross</a> or <a href="http://rebootwithjoe.com" target="_blank">Rebbot with Joe.com</a></small></p>
    	</footer>
	</div>
	
	<?php if(isset($client_files_body)) echo $client_files_body; ?>

	
<script src="/js/jquery-2.0.3.min.js"></script>
<script src="/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>