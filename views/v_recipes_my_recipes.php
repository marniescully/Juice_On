<!-- My Juices that I have liked Grouped by Color View -->

<div class="row" id="Main">	
	<section class="col-lg-12 col-md-12 col-sm-12 thumbnail ">
		<h3>My Juices That I Have Liked</h3>
		<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#Red" data-toggle="tab">Red Juices</a></li>
				<li><a href="#Orange" data-toggle="tab">Orange Juices</a></li>
				<li><a href="#Yellow" data-toggle="tab">Yellow Juices</a></li>
				<li><a href="#Green" data-toggle="tab">Green Juices</a></li>
				<li><a href="#Purple" data-toggle="tab">Purple Juices</a></li>
			</ul>
		<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="Red">
					
					<?php if(isset($red_recipes)) : ?>
						<div id="red_accordion">
							<?php foreach($red_recipes as $red_recipe): ?>
								<!-- Display each recipe  -->
									
								   		<h4 class="<?=$red_recipe["color"]?> gray">
									   		<?=$red_recipe["title"]?>
									   	</h4>
									   	<div class="thumbnail">
									   	<p>
									   		<a href="/recipes/display_recipe/<?=$red_recipe["recipe_id"]?>" target="_blank"><?=$red_recipe["description"]?></a><img src="/images/<?=$red_recipe["color"]?>_sm.png" class="pull-right" alt="Juice Picture">
									   	</p>
									   	<p><small><em>Author:<?=$red_recipe["author"]?></em></small></p>
									   </div>
										

							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if(isset($red_message)) : ?>
						<article>
							<h4 class="Red">No Red Juice Recipes Liked</h4>
						</article>
					<?php endif; ?>
						
				</div>
				
				<div class="tab-pane" id="Orange">
					
					<?php if(isset($orange_recipes)) : ?>
						<div id="orange_accordion">
							<?php foreach($orange_recipes as $orange_recipe): ?>
								<!-- Display each recipe  -->
									
								   		<h4 class="<?=$orange_recipe["color"]?> gray">
									   		<?=$orange_recipe["title"]?>
									   	</h4>
									   	<div class="thumbnail">
									   	<p>
									   		<a href="/recipes/display_recipe/<?=$orange_recipe["recipe_id"]?>" target="_blank"><?=$orange_recipe["description"]?></a><img src="/images/<?=$orange_recipe["color"]?>_sm.png" class="pull-right" alt="Juice Picture">
									   	</p>
									   	<p><small><em>Author:<?=$orange_recipe["author"]?></em></small></p>
									   </div>
										

							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if(isset($orange_message)) : ?>
						<article>
							<h4 class="Orange">No Orange Juice Recipes Liked</h4>
						</article>
					<?php endif; ?>
						
				</div>

				<div class="tab-pane" id="Yellow">
					
					<?php if(isset($yellow_recipes)) : ?>
						<div id="yellow_accordion">
							<?php foreach($yellow_recipes as $yellow_recipe): ?>
								<!-- Display each recipe  -->
									
								   		<h4 class="<?=$yellow_recipe["color"]?> gray">
									   		<?=$yellow_recipe["title"]?>
									   	</h4>
									   	<div class="thumbnail">
									   	<p>
									   		<a href="/recipes/display_recipe/<?=$yellow_recipe["recipe_id"]?>" target="_blank"><?=$yellow_recipe["description"]?></a><img src="/images/<?=$yellow_recipe["color"]?>_sm.png" class="pull-right" alt="Juice Picture">
									   	</p>
									   	<p><small><em>Author:<?=$yellow_recipe["author"]?></em></small></p>
									   </div>
										

							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if(isset($yellow_message)) : ?>
						<article>
							<h4 class="Yellow">No Yellow Juice Recipes Liked</h4>
						</article>
					<?php endif; ?>
						
				</div>

				<div class="tab-pane" id="Green">
					
					<?php if(isset($green_recipes)) : ?>
						<div id="green_accordion">
							<?php foreach($green_recipes as $green_recipe): ?>
								<!-- Display each recipe  -->
									
								   		<h4 class="<?=$green_recipe["color"]?> gray">
									   		<?=$green_recipe["title"]?>
									   	</h4>
									   	<div class="thumbnail">
									   	<p>
									   		<a href="/recipes/display_recipe/<?=$green_recipe["recipe_id"]?>" target="_blank"><?=$green_recipe["description"]?></a><img src="/images/<?=$green_recipe["color"]?>_sm.png" class="pull-right" alt="Juice Picture">
									   	</p>
									   	<p><small><em>Author:<?=$green_recipe["author"]?></em></small></p>
									   </div>
										

							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if(isset($green_message)) : ?>
						<article>
							<h4 class="Green">No Green Juice Recipes Liked</h4>
						</article>
					<?php endif; ?>
						
				</div>

				<div class="tab-pane" id="Purple">
					
					<?php if(isset($purple_recipes)) : ?>
						<div id="purple_accordion">
							<?php foreach($purple_recipes as $purple_recipe): ?>
								<!-- Display each recipe  -->
									
								   		<h4 class="<?=$purple_recipe["color"]?> gray">
									   		<?=$purple_recipe["title"]?>
									   	</h4>
									   	<div class="thumbnail">
									   	<p>
									   		<a href="/recipes/display_recipe/<?=$purple_recipe["recipe_id"]?>" target="_blank"><?=$purple_recipe["description"]?></a><img src="/images/<?=$purple_recipe["color"]?>_sm.png" class="pull-right" alt="Juice Picture">
									   	</p>
									   	<p><small><em>Author:<?=$purple_recipe["author"]?></em></small></p>
									   </div>
										

							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if(isset($purple_message)) : ?>
						<article>
							<h4 class="Purple">No Purple Juice Recipes Liked</h4>
						</article>
					<?php endif; ?>
						
				</div>

			</div>
	
	</section> <!-- End Column-->
	
</div> <!-- End Main row -->


	
	

