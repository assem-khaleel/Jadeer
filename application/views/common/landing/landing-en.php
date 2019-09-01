<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="KSU, King Saud University, ITQAN, Data Warehouse and Electronic Quality Management System, eQMS, إتقان">
    <meta name="author" content="KSU, King Saud University">
    <title>ITQAN - Electronic Performance Management Platform</title>
    <link rel="stylesheet" href="<?php echo $assets ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $assets ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $assets ?>css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=BenchNine:300,400,700' rel='stylesheet' type='text/css'>
    <script src="<?php echo $assets ?>js/modernizr.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo $assets ?>js/html5shiv.js"></script>
    <script src="<?php echo $assets ?>js/respond.min.js"></script>
    <![endif]-->

</head>
<body dir="rtl" class="en-version">

<!-- ====================================================
header section -->
<header class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav class="navbar navbar-default">
                    <div class="container-fluid nav-bar">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="https://youtu.be/6AuNspAIYe8" target="_blank"><i class="fa fa-youtube"></i></a>
                                </li>
                                <li><a href="http://twitter.com/itqan_ksu" target="_blank"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="mailto:itqan@ksu.edu.sa" target="_blank"><i
                                                class="fa fa-envelope-o"></i></a></li>
                                <li><a href="<?php echo base_url('?page=landing-en') ?>" class="lan-btn active">Eng</a>
                                </li>
                                <li><a href="<?php echo base_url('?page=landing-ar') ?>" class="lan-btn ar">عربي</a>
                                </li>
                                <!--li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-navicon"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="" href="#">Dropdown1</a></li>
                                        <li><a class="" href="#">Dropdown2</a></li>
                                    </ul>
                                </li-->
                            </ul>
                        </div><!-- /navbar-collapse -->
                    </div><!-- / .container-fluid -->
                </nav>
            </div>
            <div class="col-md-2 header-logo">
                <a href="<?php echo base_url('?page=index-en') ?>"><img src="<?php echo $assets ?>img/logo.png" alt=""
                                                                        class="img-responsive logo"></a>
            </div>
        </div>
    </div>
</header> <!-- end of header area -->

<section class="slider" id="home">
    <div class="container-fluid">
        <div class="row">
            <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                <!--div class="header-backup"></div-->
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="<?php echo $assets ?>img/slide-one.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>ITQAN</span>
                                Continuous Development
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo $assets ?>img/slide-two.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>ITQAN</span>
                                Quality Support
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo $assets ?>img/slide-three.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>ITQAN</span>
                                Supporting <br>National Competencies
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo $assets ?>img/slide-four.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>ITQAN</span>
                                Investment of <br>
                                Time and Effort
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo $assets ?>img/slide-five.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>ITQAN</span>
                                Development, Movement
                                <br>
                                and Support
                            </p>
                        </div>
                    </div>
                    <div class="black-block"></div>
                    <!-- Controls -->
                    <div class="slider-block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 black-box"></div>
                                <div class="col-md-9"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 slide-control">
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <!--span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span-->
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <div id="caption-box">
                                    </div>
                                    <a class="right carousel-control" href="#myCarousel" role="button"
                                       data-slide="next">
                                        <!--span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span-->
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-6 info-block">
                                    <h3>Information <br>Environment</h3>
                                    <p class="info">Welcome to the ITQAN portal (Electronic Quality Management System),
                                        planning and management of information from King Saud University for excellence
                                        in performance management system.</p>
                                    <!--a href="#" class="more-btn">Read more</a-->
                                </div>
                            </div> <!-- row -->
                            <div class="row">
                                <div class="col-md-3 black-box2">
                                    <ul class="login-list">
                                        <li><a href="<?php echo base_url('/welcome/system') ?>" target="_blank"><i
                                                        class="fa fa-caret-right"></i> Electronic Performance Management
                                                System</a></li>
                                        <li><a href="http://itqanbi.ksu.edu.sa/ibmcognos/" target="_blank"><i
                                                        class="fa fa-caret-right"></i> KSU Performance Dashboards</a>
                                        </li>
                                        <li><a href="http://itqaneforms.ksu.edu.sa" target="_blank"><i
                                                        class="fa fa-caret-right"></i> ITQAN e-Forms</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-3 video-block">
                                    <a href="https://youtu.be/6AuNspAIYe8" target="_blank"><img
                                                src="<?php echo $assets ?>img/video_img_en.jpg" alt=""></a>
                                </div>
                                <div class="col-md-6 sldr-btm"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section><!-- end of slider section -->

<!-- content section starts here -->
<section class="contents">
    <div class="container">
        <div class="row">
            <div class="col-md-3 white-box">
                <h2>Vision</h2>
                <p>Provide High level of perfection in work.</p>
            </div>
            <div class="col-md-3 img-box">
                <img src="<?php echo $assets ?>img/goals.jpg" alt="">
            </div>
            <div class="col-md-3 white-box">
                <h2>Objectives</h2>
                <ul id="cScroll">
                    <li><i class="fa fa-caret-right"></i> Implement an eQuality solution to achieve NCAA Accreditation,
                        KSU 2030 initiative
                    </li>
                    <li><i class="fa fa-caret-right"></i> Eliminate manually intensive data gathering and reporting
                        processes
                    </li>
                    <li><i class="fa fa-caret-right"></i> Build the foundation for a fully integrated reporting platform
                    </li>
                    <li><i class="fa fa-caret-right"></i> Provide relevent, accurate and timely information to the KSU
                        management
                    </li>
                    <li><i class="fa fa-caret-right"></i> 360<sup>o</sup> view of all University activities and
                        performence
                    </li>
                    <li><i class="fa fa-caret-right"></i> Enhance the quality of academic and teaching services</li>
            </div>
            <div class="col-md-3 img-box">
                <img src="<?php echo $assets ?>img/message.jpg" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 img-box">
                <img src="<?php echo $assets ?>img/vision.jpg" alt="">
            </div>
            <div class="col-md-3 white-box">
                <h2>Message</h2>
                <p>Output management and the provision of reports to facilitate strategic decision-making, including all
                    the major functions such as profile faculty, performance metrics (statistics, information and
                    documents)</p>
            </div>
            <div class="col-md-3 img-box">
                <img src="<?php echo $assets ?>img/mission.jpg" alt="">
            </div>
            <div class="col-md-3 white-box">
                <h2>Mission</h2>
                <p>Provide and single point of truth in KSU that will provide all the accurate data in the right time
                    with high quality</p>
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-md-3 img-box">
                <a href="<?php echo $assets ?>img/Itqan.pdf" target="_blank"><img
                            src="<?php echo $assets ?>img/guid_en.jpg" alt=""></a>
            </div>
            <div class="col-md-3 img-box">
                <a href="#" data-toggle="modal" data-target="#contact"><img
                            src="<?php echo $assets ?>img/contact_en.jpg" alt=""></a>
            </div>
            <div class="col-md-6 search-box">
                <div class="input-group">
                    <input class="form-control search" placeholder="Search" type="text">
                    <div class="input-group-addon">
                        <button><i class="fa fa-search"></i></button>
                    </div>
                </div><!-- /.input group -->

            </div>
        </div> <!-- row -->
        <!--div class="row">
            <div class="col-md-6 cont-box">
                <h3>إتقان" يصدر التقرير الإعلامي ويوجه الشكر لرسالة الجامعة والجهات المتعاونة"</h3>
            <p>أصدر مشروع إدارة مستودع البيانات والجودة الإلكترونية "إتقان" التقرير الإعلامي الذي يوثق جهود المشروع في التواصل مع كافة الجهات الداخلية والخارجية، وقد أوضح الدكتور عاطف بن محمد العمري مساعد وكيل الجامعة للتخطيط ...</p>
            <a href="#" class="more-btn" data-toggle="modal" data-target="#event1">إقــــــــرأ المزيـــــد</a>
            </div>
            <div class="col-md-6 cont-box grey-box">
                <h3>إتقان" يعقد أربعة ورش عمل للتدريب على مشروع تجديد الاعتماد المؤسسي"</h3>
            <p>تعقد وكالة الجامعة للتخطيط والتطوير ممثلة بمشروع إدارة مستودع البيانات والجودة الإلكترونية إتقان أربعة ورش عمل تدريبية لممثلي كليات الجامعة خلال الفترة من 15إلى 18/ 4/1437هـ</p>
            <a href="#" class="more-btn" data-toggle="modal" data-target="#event2">إقــــــــرأ المزيـــــد</a>
            </div>
        </div-->
    </div>
</section><!-- end of contact section -->

<!-- footer starts here -->
<footer class="footer clearfix">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 footer-para">
                <p>King Saud University &copy; 2016 ITQAN</p>
            </div>
            <div class="col-xs-4 f-link">
                <a href="#">About ITQAN</a> | <a href="#">Latest News</a> | <a href="#" data-toggle="modal"
                                                                               data-target="#contact">Contact Us</a>
            </div>
            <div class="col-xs-4 text-right">
                <a href="https://youtu.be/6AuNspAIYe8" target="_blank"><i class="fa fa-youtube"></i></a>
                <a href="http://twitter.com/itqan_ksu" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="mailto:itqan@ksu.edu.sa" target="_blank"><i class="fa fa-envelope-o"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="event1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">إتقان" يصدر التقرير الإعلامي ويوجه الشكر لرسالة الجامعة
                    والجهات المتعاونة"</h4>
            </div>
            <div class="modal-body">
                أصدر مشروع إدارة مستودع البيانات والجودة الإلكترونية "إتقان" التقرير الإعلامي الذي يوثق جهود المشروع في
                التواصل مع كافة الجهات الداخلية والخارجية، وقد أوضح الدكتور عاطف بن محمد العمري مساعد وكيل الجامعة
                للتخطيط والتطوير رئيس مشروع "إتقان" أن المشروع حرص منذ بدء العمل فيه إلى توثيق كافة الجهود الإعلامية
                التي يتم إنجازها، والتي بدأت بوضع خطة إعلامية تتضمن محاور عديدة تهدف إلى نشر الوعي بالمشروع وأهدافه،
                ودعوة الجهات المستهدفة للتعاون مع إدارة المشروع، وبناء صورة ايجابية عن مشروع "إتقان" والمخرجات المتوقعة
                منه، وتعريف المجتمع الداخلي والخارجي بالخدمات التي يقدمها المشروع.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn more-btn" data-dismiss="modal">أغلق</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="event2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button-->
                <h4 class="modal-title" id="myModalLabel">إتقان" يعقد أربعة ورش عمل للتدريب على مشروع تجديد الاعتماد
                    المؤسسي" </h4>
            </div>
            <div class="modal-body">
                تعقد وكالة الجامعة للتخطيط والتطوير ممثلة بمشروع إدارة مستودع البيانات والجودة الإلكترونية إتقان أربعة
                ورش عمل تدريبية لممثلي كليات الجامعة خلال الفترة من 15إلى 18/ 4/1437هـ، وتهدف الورش تدريب ممثلي كليات
                الجامعة على مشروع تجديد الاعتماد الأكاديمي المؤسسي، والذي تعمل الجامعة على تنفيذه. وقد أوضح الدكتور عاطف
                العمري مساعد وكيل الجامعة للتخطيط والتطوير رئيس مشروع "إتقان" بأن هذه الورش سوف تتضمن محاور عديدة لتدريب
                ممثلي الكليات على مشروع تجديد الاعتماد الأكاديمي المؤسسي، ومن أهمها: التدريب على محتوى الوثائق التي سوف
                تسلم للهيئة الوطنية، والتدريب على "إتقان" كمنصة لتطوير جميع وثائق الاعتماد المؤسسي، وكذلك التدريب على
                الأدوات التحليلية الداعمة لفرق العمل التي يمكن استخدامها في كتابة الدراسة الذاتية.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn more-btn" data-dismiss="modal">أغلق</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button-->
                <h4 class="modal-title" id="myModalLabel"><span class="pull-right"><img
                                src="<?php echo $assets ?>img/ksu-logo.png"></span>تواصل معنا <span
                            class="itqan pull-left"><img src="<?php echo $assets ?>img/logo.png" alt=""
                                                         class="img-responsive"></span></h4>
            </div>
            <div class="modal-body">
                <h3>King Saudi University</h3>
                <p>
                    Riyadh, Kingdom of Saudi Arabia
                </p>
                <p>
                    Office : 011 469 6862 <br>
                    Fax : 001 4696859
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn more-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- script tags
============================================================= -->
<script src="<?php echo $assets ?>js/jquery-2.1.1.js"></script>
<script src="<?php echo $assets ?>js/smoothscroll.js"></script>
<script src="<?php echo $assets ?>js/bootstrap.min.js"></script>
<script src="<?php echo $assets ?>js/enscroll.min.js"></script>
<script src="<?php echo $assets ?>js/custom.js"></script>
</body>
</html>