<?php
/*	This file "header.php" contains the menu items.
 *	The default, top navigational menu system
 */
?>

<nav class="navbar navbar-default nav">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../resource/index.php">Stocker</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li class="active"><a href="../index.php">Home</a></li>
			<li ><a href="#">Pricing</a></li>
			<li ><a href="#">Services</a></li>
			<li ><a href="#">Faqs</a></li>
			<li ><a href="#"><span class="glyphicon glyphicon-envelope"></span> Contact Us</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			
			<!-- Signup modal button definition-->
			<?php if(is_loggedin()){ }else{ ?>
			<li><a href="#signup_modal.php"><span class="glyphicon glyphicon-user"></span>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#signup_modal">Sign Up</button>
			<?php } ?>
				<div id="signup_modal" class="modal fade" role="dialog">
					<div class="modal-dialog">
					<!-- Sign up Modal content-->
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Sign Up</h4>
						</div>
						<div class="modal-body">
						<form role="form"  action="../resource/signup.php" method="post">
							<div class="form-group">
							<input type="text" name="fullname" class="form-control" placeholder="Full Name" required="required" />
							</div>
							<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="email: this serves as your username for login" required />
							</div>
							<div class="form-group">
							<input type="number" name="mobile" class="form-control" placeholder="Your mobile phone number" required />
							</div>
							<div class="form-group">
							<input type="text" name="compname" class="form-control" placeholder="Company Name" required />
							</div>
							<div class="form-group">
							<input type="text" name="location" class="form-control" placeholder="Company location: preferably, enter a state within your" required />
							</div>
							<div class="form-group">
							<input type="text" name="areaname" class="form-control" placeholder="Company area: A branch within the location: LGA perhaps" required />
							</div>
							<div class="form-group">
							<input type="text" name="areaaddress" class="form-control" placeholder="The actual address where the company is located under the area" required />
							</div>
							<div class="form-group">
							<input type="text" name="lcomment" class="form-control" placeholder="Some comments about the company" />
							</div>
							<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password" required />
							</div>
							<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-block btn-sm">Sign Up</button>
							</div>
						</form>
						</div>

						<div class="modal-footer">
						<!--<button type="button" class="btn btn-primary btn-block btn-sm">Sign Up</button>-->
						<p>Register you business today</p>
						</div>
					</div>
					</div>
				</div>
				<!-- End of Signup modal definition-->
			</a></li>
			<!-- Login modal definition-->
			<?php
			if(is_loggedin()){ }else{ ?>
			<li ><a href="#login_modal.php"><span class="glyphicon glyphicon-log-in"></span>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#login_modal">Login</button>
				<?php } ?>
				<div id="login_modal" class="modal fade" role="dialog">
					<div class="modal-dialog">
					<!-- Sign up Modal content-->
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Login</h4>
						</div>
						<div class="modal-body">
						<form role="form"  action="../resource/login.php" method="post">
							<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="email" required />
							</div>
							<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password" required />
							</div>
							<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-block btn-sm">Login</button>
							</div>
						</form>
						</div>

						<div class="modal-footer">
						<!--<button type="button" class="btn btn-primary btn-block btn-sm">Sign Up</button>-->
						<p>Login</p>
						</div>
					</div>
					</div>
				</div>
			<!-- End of Login modal button definition-->
			</a></li>



			<!-- Logout modal button definition-->
			<?php
			if(is_loggedin()==true){ ?>
			<li><a href="../resource/logout.php"><span class="glyphicon glyphicon-log-out"></span>
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" >Logout</button>
			</a></li>
			<?php } ?>
		</ul>

		<form class="navbar-form navbar-right">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search" />
			</div>
			<button type="submit" class="btn btn-default" >Submit</button>
		</form>
	</div>
	</div>

	<?php
	//if(is_loggedin()){ ?>
		<!-- Company's header when users log in -->
		<?php include '../resource/header2.php'; ?>
	<?php //}else{ /*nothing */} ?>

	</div>
</nav>
