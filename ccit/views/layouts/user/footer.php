     <!-- /.footer -->
        <footer class="prefooter">
            <div class="container">
            	<div class="col-md-4">
                	<img src="<?= adminUrl . 'public/' ?>images/logo.png" alt="CCIT" />
                    <p>CCIT leads clients on their digital transformation journey, providing innovative next-generation technology solutions and services that leverage deep industry expertise, global scale, technology independence and an extensive partner community. </p>
                </div>
                <div class="col-md-4">
                	<h3>Our Services</h3>
                    <ul class="list-inline footerserlist">
                    	<li><a href="<?= site_url('Home/index'); ?>" class="<?php
                                if ($this->uri->segment(2) == '') {
                                    echo 'active';
                                }
                                ?>">Home</a></li>
                        <li><a href="<?= site_url('Home/about'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'about') {
                                    echo 'active';
                                }
                                ?>">About US</a></li>
                        <li><a href="<?= site_url('Home/itservices'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'itservices') {
                                    echo 'active';
                                }
                                ?>">IT Services</a></li>
                        <li><a href="<?= site_url('Home/clients'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'clients') {
                                    echo 'active';
                                }
                                ?>">Clients</a></li>
                        <li><a href="<?= site_url('Home/careers'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'careers') {
                                    echo 'active';
                                }
                                ?>">Careers</a></li>
                        <li><a href="<?= site_url('Home/contact'); ?>" class="<?php
                                if ($this->uri->segment(2) == 'contact') {
                                    echo 'active';
                                }
                                ?>">Contacts</a></li>
                    </ul>
                    <div class="social">
                        <ul>
                            <li><a class="wow fadeInUp" href="https://twitter.com/ccit" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="wow fadeInUp" href="https://www.facebook.com/ccitinc" data-wow-delay="0.2s" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="wow fadeInUp" href="https://www.linkedin.com/" data-wow-delay="0.6s" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                	<div class="contact-footer wow fadeInUp">
                                <h3 class="wow fadeInLeft animated">Get in Touch</h3>
                                <ul class="ul-address">
                                    <!--<li><i class="fa fa-map-marker"></i>33 S Wood Ave, Iselin</br>
                                        NJ 08830
                                    </li>-->
                                    <li><i class="fa fa-phone"></i>+1 (248) 955-5002</br>
                                        <i class="fa fa-phone"></i>+1 (248) 955-5275</br>
                                        
                                    </li>
                                    <li><i class="fa fa-envelope"></i><a href="mailto:info@ccintinc.com">info@ccitinc.com</a></li>
                                    <li><i class="fa fa-eye"></i><a href="http://www.ccitinc.com/">www.ccitinc.com</a></li>
                                </ul>	

                            </div>
                </div>
                
                	
            </div>	
        </footer>
        <footer id="footer">
        	<div class="col-sm-4 col-sm-offset-4">
                    <!-- /.social links -->
                    	
                    <div class="text-center wow fadeInUp" style="font-size: 14px;">&copy; Copyright CCITINC <a target="_blank" href="http://www.webmobilez.com/">designed by WebMobileZ</a></div>
                    <a href="#" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
                </div>
        </footer>
     <script>
    var baseurl='<?php echo base_url(); ?>'; 
    </script>
<script> var siteUrl1 = '<?= site_url(); ?>';</script>
<script> var siteUrl = '<?= site_url(); ?>/';
</script>
        <!-- /.javascript files -->
        <script src="<?= adminUrl . 'public/' ?>js/jquery.js"></script>
        <script src="<?= adminUrl . 'public/' ?>css/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= adminUrl . 'public/' ?>js/jquery.validate.min.js"></script>
        <script src="<?= adminUrl . 'public/' ?>js/custom.js"></script>
        <script src="<?= adminUrl . 'public/' ?>js/jquery.sticky.js"></script>
        <script src="<?= adminUrl . 'public/' ?>js/wow.min.js"></script>
        <script src="<?= adminUrl . 'public/' ?>js/owl.carousel.min.js"></script>
        <script src="<?= adminUrl . 'public/' ?>js/ekko-lightbox-min.js"></script>
        <script src="<?= adminUrl . 'public/' ?>js/redirect.js"></script>
        
        <script type="text/javascript">
			$( document ).delegate( '*[data-toggle="lightbox"]', 'click', function ( event ) {
				event.preventDefault();
				$( this ).ekkoLightbox();
			} );
        </script>
        <script>
            new WOW().init();
        </script>
        <!--<script type="text/javascript">
        $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 150
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>-->
    </body>
</html>