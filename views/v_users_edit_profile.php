<div class="row" id="Main">
	<section class="col-lg-12 col-md-12 col-sm-12">
    	<div class="row">
			<div class="thumbnail">
				<!-- A form to edit profile  -->
					<form method="POST" action="/users/edit_profile">
						<h2>Edit Your Profile <?=$user->user_name?></h2>
						<h3>All Fields Are Required</h3>
							<label for="user_name">Username:</label><br>
							<input type="text" id="user_name" name="user_name" value="<?=$user_name?>">
							<br><br>

							<label for="email">Email:</label><br>
							<input type="text" id="email" name="email" value="<?=$email?>">
							<br><br>

						    <label for="password">Password:</label><br>
							<input type="password" id="password" name="password">
							<br><br>

							<input type="submit" name="submit" value="Save Changes">
							<input type="submit" name="submit" value="Cancel">

							<div class="error">
								<!-- If error with email format display error  -->
									<?php if(isset($error_email)) echo $error_email; ?>	
								
								<!-- Any other error returned display  -->
									<?php if(isset($error)) echo $error; ?>	
							</div>
					</form>
			</div>
		</div>
	</section>
</div>