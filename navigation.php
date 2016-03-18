<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
            <a class="navbar-brand" href="index.php">QBnB</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                		<a href="index.php">Find a Place</a>
                		<li>
                		<a href="register.php">Become a Host</a>
                	</li>
                        <?php if(isset($_SESSION['member_id'])): ?>
                        <!--<a href="index.php?logout=1" id="login">Logout</a>-->
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="profile.php">Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?logout=1">Logout</a></li>
                          </ul>
                        </li>
                        <?php else: ?>
                        <li>
                        <a href="login.php" id="login">Login</a>
                    </li>
                        <?php endif; ?>
                    
                        

                       
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>