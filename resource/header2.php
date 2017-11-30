
<!-- This holder company's header/menu when they log in -->
<?php /*if(is_loggedin()){ }else{*/ 
if(is_loggedin()){ ?>
<div class="divider"></div>
	 
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#compNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="../business/dashboard.php"><?php echo $compname;?></a>
    </div>
	
	<div class="collapse navbar-collapse" id="compNavbar">	
		<ul class="nav navbar-nav">
		  <li class="active"><a href="../business/dashboard.php">Dashboard</a></li>
		  
		  <!--<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Purchase Book
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
			  <li><a href="../business/addstock.php">Add new goods</a></li>
			  <li><a href="#">Page 1-2</a></li>
			  <li><a href="#">Page 1-3</a></li>
			</ul>
		  </li>-->
		  
		  <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="../business/dashboard.php">Stock
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
			  <li><a href="../business/addstock.php">Add new stock/purchase</a></li>
			  <li><a href="../business/viewstock.php">View AvailabeStock</a></li>
			  <li><a href="#">Page 1-3</a></li>
			</ul>
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Supplier
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="../business/addsupplier.php">Add new supplier</a></li>
				  <li><a href="#">View Supplier</a></li>
				  <li><a href="#">Page 1-3</a></li>
				</ul>
			  </li>
		  </li>
		  
		  <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Location/Area
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="../business/addlocation.php">Add new location</a></li>
				  <li><a href="../business/addarea.php">Add new area</a></li>
				  <li><a href="#">Page 1-3</a></li>
				</ul>
			  </li>
		  </li>
		  
		  <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Sales
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="../business/addsales.php">Make sale</a></li>
				  <li><a href="../business/viewsales.php">View Sales</a></li>
				  <li><a href="#">Page 1-3</a></li>
				</ul>
			  </li>
		  </li>
		  
		  <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Users(employees)
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				<?php if((reporter_logincheck() || basic_user_logincheck())){ }else{ ?>	
				  <li><a href="../business/addusers.php">Add New Users</a></li>
				<?php } ?>  
				  <li><a href="../business/viewusers.php">View Users</a></li>
				  <li><a href="#">Page 1-3</a></li>
				</ul>
			  </li>
		  </li>
		  
		  <li><a href="#">Page 2</a></li>
		  <li><a href="#">Page 3</a></li>
		</ul>
		
		<div class="nav navbar-nav navbar-right">
		  <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<?php /*from check the at the top main script get_user_name() was called */ echo $fullname;  ?>
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="../resource/logout.php"><span class="glyphicon glyphicon-log-out"></span>
					<button type="button" class="btn btn-info btn-sm" data-toggle="modal" >Logout</button>
				</a></li>
				<li><a href="#">Page 1-2</a></li>
				<li><a href="#">Page 1-3</a></li>
			</ul>
		  </li>
		  </div>
		<?php }else{ /*nothing */} ?>
	<?php/* } */?>