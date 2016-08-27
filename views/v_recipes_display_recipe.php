<!-- Display Recipe View -->

<div class="row" id="Main">
	
	<section class="thumbnail">
 		
 		<?php if(isset($recipes)) : ?>
		
			<!-- Display the recipe  -->
				<article>
					<img class="thumbnail pull-right img-responsive hidden-xs" src="/images/<?=$recipes["color"]?>_lg.png" alt="Juice Picture">
				   <h2 class="<?=$recipes["color"]?>">
				   	<?=$recipes["title"]?>
				   </h2>
				   <p><?=$recipes["description"]?></p>
				   <p><?=$recipes["servings"]?> Servings</p>
				   <p><small><em>Author:<?=$recipes["author"]?></em></small></p><br>
			
					<h4 class="<?=$recipes["color"]?>">Ingredients</h4>
					<ul>
						<?php foreach($ingredients as $ingredient): ?>
				
							<!-- Display each ingredients  -->
								<li><?=$ingredient["quantity"]?>&nbsp;<?=$ingredient["ingredient"]?></li>
						
						<?php endforeach; ?>
					</ul><br>

					<h4 class="<?=$recipes["color"]?>">Steps</h4>
					<ol>
						<?php if(isset($steps)) : ?>
							<?php foreach($steps as $step): ?>
					
								<!-- Display each step  -->
									<li><?=$step["step"]?></li>
							
							<?php endforeach; ?>
						<?php endif; ?>
							<li>Wash all ingredients.</li>
							<li>Add all ingredients through Juicer and Enjoy!</li>
					</ol><br>
				<p>
					<!-- If there exists a connection with this recipe, show a unfollow link -->
                		<?php if($user): ?>
                   			<?php if(isset($connections)) : ?>
						
								<a href="/recipes/unfollow/<?=$recipes["recipe_id"]?>" class="btn btn-default btn-success" id="unlike">Unlike
								</a>
	                       
                	<!-- Otherwise, show the follow link -->
                    	<?php else: ?>
                        
							<a href="/recipes/follow/<?=$recipes["recipe_id"]?>" class="btn btn-default btn-success" id="like">Like
							</a>
						
                    	<?php endif; ?>

				<?php endif; ?>

				<a href="/recipes/print_recipe/<?=$recipes["recipe_id"]?>" class="btn btn-default btn-success" target="_blank" id="print">	
  					Print
  				</a>
  				</p>
				
				</article>
		
		<?php endif; ?>

		<?php if(isset($message)) : ?>
		
			<article>
				No Juice recipe found</h1>
			</article>
	
		<?php endif; ?>
	
	</section> <!-- End Column-->

	
</div> <!-- End Main row -->

