<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand" href="index.php">QBnB</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
						
						
						<?php if(isset($_SESSION['admin_id'])): ?>
						
						
						<!--<a href="index.php?logout=1" id="login">Logout</a>-->
						<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="admin.php">Home</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?logout=1">Logout</a></li>
                          </ul>
                        </li> 
						
						
                                            					
						
                        <?php elseif(isset($_SESSION['member_id'])): ?>
						
                        <!--<a href="index.php?logout=1" id="login">Logout</a>-->
						<!--<li class="hidden"><a href="#">Administration</a></li>-->
						
						<li>
                		<a href="search.php">Find a Place</a>
                		</li>
						<li><a href="register.php">Become a Host</a>
						</li>
						
                       <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="register.php">Register A Property</a></li>
							<li><a href="property.php">Manage Properties</a></li>
							<li><a href="bookings.php">Manage Bookings</a></li>
							<li><a href="editbookings.php">Edit Bookings</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?logout=1">Logout</a></li>
                          </ul>
                        </li> 
						
						<?php else: ?>
						<li>	
                		<a href="index.php">Find a Place</a>
                		</li>
                		
                	<li>
                		<a href="login.php">Register</a>
                	</li>
						<li>
                        <?php if(isset($_SESSION['id'])): ?>
                        <a href="home.php?logout=1" id="logout">Logout</a>
                        <?php else: ?>
                        <a href="login.php" id="login">Login</a>
                        <?php endif; ?>
                    </li>
						<!--<li>
						<a href="admin.php">Administration</a>
						</li>
						
						<li>
                		<a href="search.php">Find a Place</a>
                		</li>
						
                        <li>
                        <a href="login.php" id="login">Member</a>
						</li>-->
						<?php endif; ?>
						
						 
						
					 <?php //endif; ?>
                       
                        
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
   </div>
    <!-- /.container -->
</nav> 