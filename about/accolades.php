<?php
    require_once("../config/Database.php");
    $database = new Database();
    $conn = $database->getConnection();

    $sql_select = "SELECT * FROM accolades";
    $stmt = $conn->prepare($sql_select);
    $stmt->execute();
?>

<?php include_once('../include_header.php');?>

<div class="smallest-padding">
    <div class="container">
        <div class="page-heading style3 wrapper border-bottom ">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h1>Accolades</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-12 col-md-12 col-sm-12 small-padding padding-bottom0">
                <div class="row wpb_row row-fluid">
                    <div class="col-sm-12 column column_container">
                        <!-- Full Width Projects -->
                        <div class="align-center">
                            <h2 class="big"></h2>
                            <p class="full-width-p-col">
                            </p>
                        </div>

                        <div class="row projects-container">
                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-web">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/all_award_english-10(1).png" alt="Sample Item"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/all_award_english-10(1).png"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                       <h6>October 08, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->

                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-web">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/golden_medal-09.jpg" alt="Sample Item"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/golden_medal-09.jpg"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                       <h6>October 08, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->

                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-print">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/all_award-06.jpg" alt="Project Title"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/all_award-06.jpg"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                        <h6>October 08, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->
                        </div>
                        <div class="clearfix"></div>

                        <div class="row">
                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-business">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/csr_certificate.jpg" alt="Maecenas sodales"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/csr_certificate.jpg"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                       <h6>May 22, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->

                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-business">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/all_award-05.png" alt="Maecenas sodales"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/all_award-05.png"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                       <h6>October 08, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->
                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-business">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/all_award-01.jpg" alt="The Ocean Surfers"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/all_award-07(1).png"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                       <h6>July 19, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->
                        </div>
                        <div class="clearfix"></div>

                        <div class="row">
                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-business">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/all_award-04.png" alt="Maecenas sodales"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/all_award-04.png"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                        <h6>November 18, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->

                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-business">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/all_award-03.jpg" alt="Maecenas sodales"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/all_award-03.jpg"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                        <h6>September 08, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->
                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-business">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/all_award-02.jpg" alt="The Ocean Surfers"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/all_award-02.jpg"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                        <h6>July 01, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->
                        </div>
                        <!-- Full Width Projects -->

                        <div class="clearfix"></div>

                        <div class="row">
                            <!-- Project -->
                            <div class="col-lg-4 col-md-4 col-sm-4 mix category-business">
                                <div class="project light">
                                    <div class="project-image">
                                        <img src="../img/all_award-07(1).png" alt="Maecenas sodales"/>
                                        <div class="project-hover">
                                            <a class="link-icon" href="#"></a>
                                            <a class="search-icon prettyPhoto" href="../img/all_award-07(1).png"></a>
                                        </div>
                                    </div>
                                    <div class="project-meta">
                                        <h6>December 17, 2014</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project -->

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>


<?php include_once('../include_footer.php');?>