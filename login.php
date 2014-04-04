<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/headerNoNav.php'; ?>
<div class="entire">
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarPlain.php'; ?>

<div class="jumbotron" style="padding-top: 3%;">
      <div class="container">
	<div style="text-align:center; font-weight: bold; font-size: 250%">
	Join a community of millions of music lovers!
	</div>
	<div style="text-align:center; font-weight: bold; font-size: 250%">
	Sign Up with MusicNet now!
	</div>


	<table style="width:100%">
		<thead>
		</thead>
		<tbody>
		<tr>
			<td class="ss" >
				<form style="padding-right: 20pt;" action="/signup" method="post">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" required="required" class="form-control" id="username" name="username"
						       placeholder="Enter Username" />
					</div>
					<div class="form-group">
						<label for="first-name">First Name</label>
						<input type="text" required="required" class="form-control" id="first-name" name="first-name"
						       placeholder="Enter First Name" />
					</div>
					<div class="form-group">
						<label for="last-name">Last Name</label>
						<input type="text" required="required" class="form-control" id="last-name" name="last-name"
						       placeholder="Enter Last Name" />
					</div>
					<div class="form-group">
						<label for="signup-email">Email</label>
						<input type="email" required="required" class="form-control" id="signup-email" name="signup-email"
						       placeholder="Enter Email" />
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

<div class = 'imcontainer'>
<img src="http://i.telegraph.co.uk/multimedia/archive/01252/Michael_Rosen_1252427c.jpg">
<img src="http://www2.warwick.ac.uk/services/communications/medialibrary/images/january10/michael_rosen_4_warwick_prize_for_writing_210110.jpg">
<img src="http://calverleyparkside.pbworks.com/f/rosen460.jpg">
<img src="http://www.hackneygazette.co.uk/polopoly_fs/hg_wk46_workshop_arcola_theatre_3_1_1801745!image/2163885511.jpg_gen/derivatives/landscape_630/2163885511.jpg">
</div>




<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?> 
