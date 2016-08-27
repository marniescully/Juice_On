<!-- Search by Color View -->

<div class="row" id='Main'>
	
	<section class="col-lg-12 col-md-12 col-sm-12">

	<?php if(isset($recipes)) : ?>
		
		<?php foreach($recipes as $recipe): ?>
			
			<!-- Display each recipe  -->
				<article class='thumbnail'>
			   		<h2 class='<?=$recipe['color']?>'>
				   	<a href='/recipes/display_recipe/<?=$recipe['recipe_id']?>'><?=$recipe['title']?></a><img src='/images/<?=$recipe['color']?>_sm.png' class='pull-right' alt='Juice Picture'>
				   	</h2>

				   	<p><?=$recipe['description']?></p>
				   	<p><small><em>Author:<?=$recipe['author']?></em></small></p>
				</article>	

		<?php endforeach; ?>
	
	<?php endif; ?>
	
	</section> <!-- End Column-->
	
</div> <!-- End Main row -->
