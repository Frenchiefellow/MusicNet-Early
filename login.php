<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/headerNoNav.php'; ?>
<div class="entire">
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarPlain.php'; ?>


<style>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/splash.css'; ?>
</style> 
<div class="jumbotron" id= "welcome" style="background-color: rgba(128, 128, 128, .85);">
    <div class="container">

    <div class = 'titlecontainer' style= 'padding-top: 25px;'>
	<div id = 'mtitle'>
	Join a community of music lovers!
	</div>
	<div id= 'mtitle'>
	Sign Up with MusicNet now!
	</div>
	</div>


	<table style="width:100%">
		<thead>
		</thead>
		<tbody>
		<tr>
			<td class="ss" >
				<form style="padding-right: 20pt;" action="adduser.php" method="post">

					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" required="required" class="form-control" id="username" name="username"
						       placeholder="Enter Username" />
					</div>
					<div class="form-group">
						<label for="signup-password">Password</label>
						<input type="password" required="required" class="form-control" id="signup-password" name="signup-password"
						       placeholder="Enter Password" />
					</div>
					<div class="form-group">
						<label for="confirm-password">Confirm Password</label>
						<input type="password" required="required" class="form-control" id="confirm-password"
						       name="confirm-password" placeholder="Confirm Password" />
					</div>
					<div class="form-group">
						<label for="age">Age (Between 13 and 110)(Optional)</label>
						<input type="number"  class="form-control" id="age" name="age"
						       placeholder="Enter Age" min="13" max="110" />
					</div>
					<div class="form-group">
						<label for="location">Location (Optional)</label>
						<input type="text"  class="form-control" id="location" name="location"
						       placeholder="Enter Location (e.g. Boston)" />
					</div>
					<div class="form-group">
						<label for="gender">Gender (Optional)</label>
						<select name="Gender">
						<option value="male">Male</option>
						<option value="female">Female</option>
						<option value="na">Prefer not to answer.</option>
						</select>					
					</div>
					
					<div class="error">
						<!--ERROR MESSAGES HERE -->
					</div>
					<button type="submit" class="btn btn-success">Sign Up</button>
				</form>
			</td>
		</tr>
		</tbody>
	</table>
</div>
</div>

<div class = 'holder'>
<div class = 'imcontainer'>
<img src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/guitar_2.jpg"));?>'>
<img src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/girl.jpg"));?>'>
<img src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/acordian_2.jpg"));?>'>
<img src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/girl2_2.jpg"));?>'>
</div>
</div>





<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?> 
