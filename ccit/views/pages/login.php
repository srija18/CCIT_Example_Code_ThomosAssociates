
        <!-- /.parallax full screen background image -->
  <div class="fullscreen landing parallax" style="background-image:url('<?= adminUrl . 'public/' ?>images/headphones-405886.jpg');" data-img-width="2000" data-img-height="1125" data-diff="100">

            <div class="overlay">
                <div class="container">
                   <div class="col-md-6 col-md-offset-3">
                    <div class="signup-header wow fadeInUp">
                                <h3 class="form-title text-center">LogIn</h3>
                                <form class="form-header" role="form" method="POST" id="login" action="<?= site_url('user/signIn'); ?>">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="password" id="password" type="password" placeholder="Password">
                                    </div>
                                    <div class="form-group last">
                                        <input type="submit" class="btn btn-warning btn-block btn-lg" value="Login">
                                    </div>
                                    <p class="privacy text-center">Don't you have account? <a href="<?= site_url('Home/register'); ?>">Sign Up</a>.</p>
                                </form>
                            </div>
					</div>
                </div> 
            </div> 
        </div>

        <!-- NAVIGATION -->
        <!--<div id="pagemenu">
            <nav class="navbar-wrapper navbar-default" role="navigation">
                <div class="">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div id="navbar-scroll" class="navbar-backyard pagebarmenu">
                        <ul class="nav navbar-nav">
                            <li><a href="#Strategy"><p><img src="images/strategy.png" /></p> Strategy</a></li>
                            <li><a href="#solution"><p><img src="images/Solutions.png" /></p> Solution</a></li>
                            <li><a href="#data"><p><img src="images/data.png" /></p> Data</a></li>
                            <li><a href="#Statistics"><p><img src="images/statistics.png" /></p> Statistics</a></li>
                            <li><a href="#communication"><p><img src="images/communications.png" /></p> Communication</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>-->
        
        <div class="clearfix"></div>

