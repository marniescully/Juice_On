<div class="row" id="Main">
	<section class="col-lg-12 col-md-12 col-sm-12">
    	<div class="row">
			<div class="thumbnail">
				<form method="POST" action="/users/signup" role="form">
					<!-- Form to sign up new user  -->
						<h2>Sign up!</h2>
						<h3>All Fields Are Required</h3>
							<label for="user_name">Username:</label> <br>
							<input type="text" id="user_name" name="user_name">
							<br><br>

							<label for="email">Email Address:</label><br>
							<input type="text" id="email" name="email">
							<br><br>

							<label for="password">Password:</label><br>
							<input type="password" id="password" name="password">
							<br><br>

							<input type="submit" value="Sign up">	
							<br><br>
							
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



