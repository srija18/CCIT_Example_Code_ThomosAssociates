    <!-- /.parallax full screen background image -->
    <div class="fullscreen landing parallax" style="background-image:url('<?= adminUrl . 'public/' ?>images/headphones-405886.jpg');" data-img-width="2000" data-img-height="1125" data-diff="100">

            <div class="overlay">
                <div class="container">
                   <div class="col-md-6 col-md-offset-3">
                    <div class="signup-header wow fadeInUp">
                                <h3 class="form-title text-center">Register</h3>
                                <form class="form-header" role="form" method="POST" action="<?= site_url('user/signUp'); ?>" id="register">
                                    <div class="form-group">
                                        <input class="form-control" name="username" id="username" type="text" placeholder="your name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="mobile_no" id="mobile_no" type="text" placeholder="Mobile Number">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="password" id="password" type="password" placeholder="password">
                                    </div>
                                    <div class="form-group last">
                                        <input type="submit" class="btn btn-warning btn-block btn-lg" value="Register">
                                    </div>
                                 
                                </form>
                            </div>
                       <div class="successMsg">
                           
                       </div>
					</div>
                </div> 
            </div> 
        </div>

        
         <div class="clearfix"></div>