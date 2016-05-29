<?php include_once("header.php");?>

        <section id="slider">
            <div class="container">
                <!-- START REVOLUTION SLIDER 4.6.0 fullwidth mode -->
                <div id="rev_slider_21_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="margin:0px auto;background-color:#eee;padding:0px;margin-top:0px;margin-bottom:0px;max-height:700px;">
                    <div id="rev_slider_21_1" class="rev_slider fullwidthabanner" style="display:none;max-height:700px;height:700px;">
                        <ul>
                            <!-- SLIDE  -->
                            <li data-transition="slideup" data-slotamount="7" data-masterspeed="1000" data-thumb="img/IMG_6309.jpg" data-saveperformance="off">
                                <!-- MAIN IMAGE -->
                                <img src="img/IMG_6309.jpg" alt="Layer-468" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->

                            </li>
                            <!-- SLIDE  -->
                            <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-thumb="img/IMG_6319.jpg" data-saveperformance="off" >
                                <!-- MAIN IMAGE -->
                                <img src="img/IMG_6319.jpg" alt="back" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->
                            </li>

                            <!-- SLIDE  -->
                            <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500" data-thumb="img/IMG_6328.jpg" data-saveperformance="off">
                                <!-- MAIN IMAGE -->
                                <img src="img/IMG_6328.jpg" alt="back2" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->
                            </li>

                            <!-- SLIDE  -->
                            <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500" data-thumb="img/IMG_6312.jpg" data-saveperformance="off">
                                <!-- MAIN IMAGE -->
                                <img src="img/IMG_6312.jpg" alt="back2" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->

                            </li>

                            <!-- SLIDE  -->
                            <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500" data-thumb="img/IMG_6297.jpg" data-saveperformance="off">
                                <!-- MAIN IMAGE -->
                                <img src="img/IMG_6297.jpg" alt="back2" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->

                            </li>

                            <!-- SLIDE  -->
                            <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500" data-thumb="img/IMG_6300.jpg" data-saveperformance="off">
                                <!-- MAIN IMAGE -->
                                <img src="img/IMG_6300.jpg" alt="back2" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->

                            </li>

                            <!-- SLIDE  -->
                            <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500" data-thumb="img/IMG_6303.jpg" data-saveperformance="off">
                                <!-- MAIN IMAGE -->
                                <img src="img/IMG_6303.jpg" alt="back2" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <!-- LAYERS -->

                            </li>

                        </ul>
                        <div class="tp-bannertimer">
                        </div>
                    </div>
                    <script type="text/javascript">
                        /******************************************
                         -   PREPARE PLACEHOLDER FOR SLIDER  -
                         ******************************************/
                        var setREVStartSize = function() {
                            var tpopt = new Object();
                            tpopt.startwidth = 1170;
                            tpopt.startheight = 700;
                            tpopt.container = jQuery('#rev_slider_21_1');
                            tpopt.fullScreen = "off";
                            tpopt.forceFullWidth="off";
                            tpopt.container.closest(".rev_slider_wrapper").css({height:tpopt.container.height()});tpopt.width=parseInt(tpopt.container.width(),0);tpopt.height=parseInt(tpopt.container.height(),0);tpopt.bw=tpopt.width/tpopt.startwidth;tpopt.bh=tpopt.height/tpopt.startheight;if(tpopt.bh>tpopt.bw)tpopt.bh=tpopt.bw;if(tpopt.bh<tpopt.bw)tpopt.bw=tpopt.bh;if(tpopt.bw<tpopt.bh)tpopt.bh=tpopt.bw;if(tpopt.bh>1){tpopt.bw=1;tpopt.bh=1}if(tpopt.bw>1){tpopt.bw=1;tpopt.bh=1}tpopt.height=Math.round(tpopt.startheight*(tpopt.width/tpopt.startwidth));if(tpopt.height>tpopt.startheight&&tpopt.autoHeight!="on")tpopt.height=tpopt.startheight;if(tpopt.fullScreen=="on"){tpopt.height=tpopt.bw*tpopt.startheight;var cow=tpopt.container.parent().width();var coh=jQuery(window).height();if(tpopt.fullScreenOffsetContainer!=undefined){try{var offcontainers=tpopt.fullScreenOffsetContainer.split(",");jQuery.each(offcontainers,function(e,t){coh=coh-jQuery(t).outerHeight(true);if(coh<tpopt.minFullScreenHeight)coh=tpopt.minFullScreenHeight})}catch(e){}}tpopt.container.parent().height(coh);tpopt.container.height(coh);tpopt.container.closest(".rev_slider_wrapper").height(coh);tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(coh);tpopt.container.css({height:"100%"});tpopt.height=coh;}else{tpopt.container.height(tpopt.height);tpopt.container.closest(".rev_slider_wrapper").height(tpopt.height);tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(tpopt.height);}
                        };
                        /* CALL PLACEHOLDER */
                        setREVStartSize();
                        var tpj=jQuery;
                        tpj.noConflict();
                        var revapi21;
                        tpj(document).ready(function() {
                            if(tpj('#rev_slider_21_1').revolution == undefined)
                                revslider_showDoubleJqueryError('#rev_slider_21_1');
                            else
                                revapi21 = tpj('#rev_slider_21_1').show().revolution(
                                    {
                                        dottedOverlay:"none",
                                        delay:16000,
                                        startwidth:1170,
                                        startheight:700,
                                        hideThumbs:200,
                                        thumbWidth:100,
                                        thumbHeight:50,
                                        thumbAmount:3,
                                        simplifyAll:"off",
                                        navigationType:"bullet",
                                        navigationArrows:"solo",
                                        navigationStyle:"preview4",
                                        touchenabled:"on",
                                        onHoverStop:"on",
                                        nextSlideOnWindowFocus:"off",
                                        swipe_threshold: 0.7,
                                        swipe_min_touches: 1,
                                        drag_block_vertical: false,
                                        parallax:"mouse",
                                        parallaxBgFreeze:"on",
                                        parallaxLevels:[7,4,3,2,5,4,3,2,1,0],
                                        keyboardNavigation:"off",
                                        navigationHAlign:"center",
                                        navigationVAlign:"bottom",
                                        navigationHOffset:0,
                                        navigationVOffset:20,
                                        soloArrowLeftHalign:"left",
                                        soloArrowLeftValign:"center",
                                        soloArrowLeftHOffset:20,
                                        soloArrowLeftVOffset:0,
                                        soloArrowRightHalign:"right",
                                        soloArrowRightValign:"center",
                                        soloArrowRightHOffset:20,
                                        soloArrowRightVOffset:0,
                                        shadow:0,
                                        fullWidth:"on",
                                        fullScreen:"off",
                                        spinner:"spinner4",
                                        stopLoop:"off",
                                        stopAfterLoops:-1,
                                        stopAtSlide:-1,
                                        shuffle:"off",
                                        autoHeight:"off",
                                        forceFullWidth:"off",
                                        hideThumbsOnMobile:"off",
                                        hideNavDelayOnMobile:1500,
                                        hideBulletsOnMobile:"off",
                                        hideArrowsOnMobile:"off",
                                        hideThumbsUnderResolution:0,
                                        hideSliderAtLimit:0,
                                        hideCaptionAtLimit:0,
                                        hideAllCaptionAtLilmit:0,
                                        startWithSlide:0                    });
                        }); /*ready*/
                    </script>
                </div>
                <!-- END REVOLUTION SLIDER -->
                <script>
                    /* Fix The Revolution Slider Loading Height issue */
                    jQuery(document).ready(function($){
                        $('.rev_slider_wrapper').each(function(){
                            $(this).css('height','');
                            var revStartHeight = parseInt($('>.rev_slider', this).css('height'));
                            $(this).height(revStartHeight);
                            $(this).parents('#slider').height(revStartHeight);
                            $(window).load(function(){
                                $('#slider').css('height','');
                            });
                        });
                    });
                </script>
            </div>
        </section>

    <div class="smallest-padding">
        <div class="container">
            <div class="row">
                <div class="col-m-12">
                    <h3 style="padding: 10px;background: #fcfcfa;border-bottom: 3px solid #f4f4f2">Mengly J. Quach Library</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div id='tab-24803' class='tabs animated fadeIn style2'>
                    <div class="tab-header" style="width: 25%">
                        <ul class=''>
                            <li><a href="#tab1"><i class="icons icon-link"></i>About the Library</a></li>
                            <li><a href="#tab2"><i class="icons icon-link"></i>daily activities</a></li>
                            <li><a href="#tab3"><i class="icons icon-link"></i>library policies</a></li>
                        </ul>
                        <br>
                        <img src="img/Library.jpg" width="100%" alt="">
                    </div>
                    <div class="tab-content">
                        <div id="tab1" class="tab">
                            <h3>About the Library</h3>

                            <h4>Vision:</h4>
                            <p>The Mengly J. Quach library strives for excellence in support for the learning, teaching and research mission of the institute and school; to be the most dynamic learning environment.</p>

                            <h4>Mission:</h4>
                            <p>The Mengly J. Quach library is to provide comprehensive resources and services in support of the learning, teaching and research needs of the library users; to promote lifelong learning by creating welcoming spaces that offer collections and services to inform, inspire, enrich and entertain. </p>

                            <h4>Goals:</h4>
                            <ul>
                                <li>Provide access to and promote the discovery and use of local and external information resources.</li>
                                <li>Understand the learning, teaching and research needs of its users.</li>
                                <li>Provide exemplary learning environment to its users.</li>
                                <li>Provide the physical facilities that enhance the learning and research environment.</li>
                                <li>Support the learning, teaching and research activities of the institute and school through provision of information sources, resources and services.</li>
                                <li>Provide high quality services that meet and exceed the expectations of the diverse users. </li>
                            </ul>
                        </div>

                        <div id="tab2" class="tab">
                            <h3>SCRABBLE</h3>
                            <p>
                                Engaging students to play Scrabble enhances their ability to recognize words. Such that they have actually been changing the process of reading words and they start to build spelling, vocabulary, and social skills. It can also give students a chance to compete against other students and they are learning without realizing it.
                            </p>

                            <h3>BOOKMARKER</h3>
                            <p>Dig out students’ latent knowledge of creativeness by making them work independently. Creating art provides a distraction, giving your brain a break from your usual thoughts.</p>

                            <h3>BINGO</h3>
                            <p>Let students have fun with words. Students are usually given a list of important words from the reading material and asked to discuss their meanings and relationship to the story. A fun and simple way to review these words and their meanings with your child is to play a kind of reverse bingo that features definitions as bingo cues. It’s an easy twist on the classic game and it will prepare your child for the vocabulary challenges.</p>

                            <h3>SCAVENGER HUNT</h3>
                            <p>Turn a group/individual activity into a learning experience. Let the students do the Scavenger Hunt and explore the unexplored books/things that can be found inside the library. Use word problems or simple math equations for clues to help children determine where to go next or how many steps to take as they search for the objects given.</p>

                            <h3>STORYTELLING</h3>
                            <p>We are promoting English speaking environment by letting the student to tell the story that they have just read. Storytelling is a unique way for students to develop an understanding, respect and appreciation for other cultures, and can promote a positive attitude to people from different lands, races and religions.</p>
                        </div>

                        <div id="tab3" class="tab">
                            <h3>Library Policies</h3>
                            <p>Mengly J. Quach Library Rules and Regulations These policies aim to inform all library service users the information to facilitate the use and practices of library services conveniently and effectively.</p>
                            <h3>Responsibilities</h3>
                            <ul>
                                <li>All users must have student ID card, alumni card, or visitor card.</li>
                                <li>All library users must help taking good care of the library properties such as table, shelves, chair, books and others. </li>
                                <li>Users are required to return newspaper or magazine to its proper place after reading. Users must place books or reference materials in the basket after reading.</li>
                                <li>All bags, cases, folders, etc., must be left at the luggage shelves.</li>
                                <li>All users must observe total silence, order, and good moral.</li>
                                <li>Users must put their phones on silent mode to avoid disturbing other users.</li>
                                <li>All users are required to cooperate and let the librarian check in case of any sign of fraud or unusual behavior.</li>
                                <li>All library users have to ask the librarian if they have any doubts or do not understand something while using the library service. </li>
                                <li>Users are not allowed to bring into any food or beverage, except bottled drink in the library.</li>
                                <li>Only library members are allowed to check out books. (Read III)</li>
                                <li>Users must not draw or write on the books, walls, tables, or chairs.</li>
                                <li>Good order and moral must be observed at all time. Users are not allowed to use inappropriate languages.</li>
                                <li>Library users are not allowed to bring along small children or pet that will cause disturbance and disorder within the library.</li>
                                <li>Users are not allowed to smoke, spit, wear hat, or take photos in the library.</li>
                                <li>Users must not make any disruptive noises.</li>
                            </ul>

                            <h3>Membership</h3>
                            <p>All library service users can register as library members by complying with the following condition:</p>
                            <ul>
                                <li>Complete the registration form (registration form is free of charge and available at all five Mengly J. Quach Libraries.) </li>
                                <li>Registration form is required to be signed by parents or guardians. Aii students who are 16 and above may sign the form by themselves.</li>
                            </ul>

                            <h3>Borrowing Policy</h3>
                            <ul>
                                <li>Library members can borrow book or any material only if one has ID.</li>
                                <li>Members are entitled to borrow 2 books at a time for a period of 1 week (including weekend and public holiday). Member who study at both Aii and AIS can borrow 4 books at a time, but one must present both ID cards.</li>
                                <li>Library members who are teachers and staffs and wish to borrow books or other materials for teaching or research that benefit the institution and school can borrow 5 books or materials for a period of 3 weeks.</li>
                                <li>Members who haven’t returned the books or materials are not allowed to borrow any extra books or materials. Only until they return the previous materials and books to the librarian can members borrow other books or materials in order to prevent being fined.</li>
                                <li>Library members who are studying at Ais, from preschool to grade 6th, are not allowed to borrow romance novels.</li>
                                <li>All library members will be held responsible for any losses, damages, or marks, which affects the aesthetic of the materials. (Read V)</li>
                                <li>Members with overdue materials or books from two weeks and above will be suspended from borrowing for a period of a month.</li>
                                <li>Borrowing service will be closed 10 days before the end of each term or semester of the institute and school.</li>
                                <li>Important materials such as rare books, expensive books, dilapidated books, dictionaries, and encyclopedias are not allowed to be borrowed. They are reserved and labeled “Reference”</li>
                                <li>Expensive books with many copies can be lenth to the members upon depositing of 20 USD which will be fully refunded after member return the book.</li>
                            </ul>

                            <h3>Fine Policy</h3>
                            <ul>
                                <li>Library member who is late to return the book 1 day over the due date will be fined 500 Riels for each book.</li>
                                <li>Library member who is late to return the book 2 weeks over the due date will be fined according to the number of days and will be suspended from borrowing book for a month.</li>
                                <li>Member who damage, write, or mark on the book will be fined 50% of the book price. In case the book is badly damaged, torn, lose pages, or lost, member will either replace the book with a new one or pay in cash. Paying in cash will include 20% of the book price.</li>
                                <li> Member will not be fined if one informs the librarian about the loss before due date or if one is ill or has accident, or loss of relative, etc.
                                    Clarification:
                                    <ul>
                                        <li>For members who are currently student of Pre-kid to Kid 4 of Aii</li>
                                        <li> For members who are currently student of Pre-school to grade 2nd of Ais</li>
                                    </ul>
                                </li>
                            </ul>

                            <h3>Final Statement</h3>
                            <ul>
                                <li>These principles are organized and agreed by the head of administration division of Aii and Ais to put into practice for the benefit of and followed by library service users.</li>
                                <li>Library user who fails to follow the principles is held responsible in front of the management team of the institution.</li>
                                <li>Management team of Aii and Ais reserve all the right to change the policy at any time necessary.</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once("footer.php");?>
