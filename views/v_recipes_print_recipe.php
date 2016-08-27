<!-- Print Recipe View -->

<div class="row" id="Main">
	
	<section class="col-lg-12 col-md-12 col-sm-12">
 		
 		<?php if(isset($recipes)) : ?>
		
			<!-- Display The Recipe for printing  -->
				<article>
				   <h2 class="<?=$recipes["color"]?>">
				   	<?=$recipes["title"]?>
				   </h2>
				   <p><?=$recipes["description"]?></p>
				   <p><?=$recipes["servings"]?> Servings</p>
				   <p><small><em>Author:<?=$recipes["author"]?></em></small></p><br>
		
					<h4>Ingredients</h4>
					<ul>
						<?php foreach($ingredients as $ingredient): ?>
				
							<!-- Display each ingredient  -->
							<li><?=$ingredient["quantity"]?>&nbsp;<?=$ingredient["ingredient"]?></li>
						
						<?php endforeach; ?>
					</ul><br>

					<h4>Steps</h4>
					<ol>
						<?php if(isset($steps)) : ?>
							<?php foreach($steps as $step): ?>
					
								<!-- Display each step  -->
								<li><?=$step["step"]?></li>
							
							<?php endforeach; ?>
						<?php endif; ?>
							<li>Wash all ingredients.</li>
							<li>Add all ingredients through Juicer and Enjoy!</li>
					</ol>
				
				</article>
		
	<?php endif; ?>

	<?php if(isset($message)) : ?>
		
		<article>
			No Juice recipe found</h1>
		</article>
	
	<?php endif; ?>
	
	</section> <!-- End Left Column-->
	    	
</div> <!-- End Main row -->

