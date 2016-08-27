<div class="row" id="Main">
	<section class="col-lg-12 col-md-12 col-sm-12">
    	<div class="row">
			<div class="thumbnail">
					<h2>Log in!</h2>
					<h3>All Fields Are Required</h3>
						<!-- Log In Form for existing Users  -->
							<form method="POST" action="/users/p_login" role="form">
								
								<label for="email">Email:</label><br>
								<input type="text" id="email" name="email"><br><br>

								<label for="password">Password:</label><br>
								<input type="password" id="password" name="password"><br><br>
								
								<p class="error">	
									<!-- Show error is email is blank  -->		
										<?php if(isset($error) && $error == "email"): ?>
											Email was blank.

									<!-- Show error is password is blank  -->
										<?php elseif(isset($error) && $error == "pword"): ?>
											Password was blank.
									
									<!-- Show error is both are blank  -->
										<?php elseif(isset($error) && $error == "both"): ?>
											Both Email and Password were blank.
									
									<!-- Show error is email is not in proper format  -->
										<?php elseif(isset($error) && $error == "format"): ?>
											Email not in proper format. 

									<!-- Show if login was rejected -->
										<?php elseif(isset($error) && $error == "error"): ?>
											Email and password combination was incorrect.
											<br>Try again!
									
										<?php endif; ?>
							</p>

							<input type="submit" name="login" value="Log in">
						</form>
			</div>
		</div>
	</section>
</div>
