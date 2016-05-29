<?php include_once("header.php");?>
<div class="">
    <div class="container">
        <!-- Google Map -->
        <section class="full-width google-map-ts ext">
            <div class="sc-map full">
<!--                <div class="sc-map-container contactv2-map-container">-->
<!--                    <div class="wpgmappity_container" id="wpgmappity-map-4">-->
<!--                    </div>-->
<!--                </div>-->

            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1954.5365566538426!2d104.908323!3d11.546613!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x386d0e144a892e3!2sAmerican+Intercon+Institute%2C+Mao+Tse+Tong+Campus+(Main+Office)!5e0!3m2!1sen!2skh!4v1463029014507" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            <section class="full-width-bg gray-bg normal-padding get-in-touch-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-2">
                            <h2>Contact Form</h2>
                            <form class="get-in-touch light contact-form" method="post">
                                <input type="hidden" id="contact_nonce" name="contact_nonce" value="d0e33461eb"/><input type="hidden" name="" value="/contact-us-v2/"/><input type="hidden" name="contact-form-value" value="1"/>
                                <div class="iconic-input">
                                    <input type="text" name="name" placeholder="Name*"><i class="icons no"></i>
                                </div>
                                <div class="iconic-input">
                                    <input type="text" name="email" placeholder="E-mail*"><i class="icons no"></i>
                                </div>
                                <textarea name="msg" placeholder="Message"></textarea><input type="submit" value="Send Message">
                                <div class="iconic-button">
                                    <input type="reset" value="Clear"><i class="icons icon-cancel-circle-1"></i>
                                </div>
                            </form>
                            <div id="msg">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <!-- /Google Map -->
    </div>
</div>
<?php include_once("footer.php");?>
