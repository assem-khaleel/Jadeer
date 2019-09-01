<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="KSU, King Saud University, ITQAN, Data Warehouse and Electronic Quality Management System, eQMS, إتقان">
    <meta name="author" content="KSU, King Saud University">
    <title>ITQAN - </title>
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
<body>

<!-- ====================================================
header section -->
<header class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 header-logo">
                <a href="<?php echo base_url('?page=index-ar') ?>"><img src="<?php echo $assets ?>img/logo.png" alt=""
                                                                        class="img-responsive logo"></a>
            </div>
            <div class="col-md-10 pull-right">
                <nav class="navbar navbar-default pull-right">
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
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo base_url('?page=landing-ar') ?>"
                                       class="lan-btn ar active">عربي</a></li>
                                <li><a href="<?php echo base_url('?page=landing-en') ?>" class="lan-btn">Eng</a></li>
                                <li><a class="menu" href="https://youtu.be/6AuNspAIYe8" target="_blank"><i
                                                class="fa fa-youtube"></i></a></li>
                                <li><a class="menu" href="http://twitter.com/itqan_ksu" target="_blank"><i
                                                class="fa fa-twitter"></i></a></li>
                                <li><a class="menu" href="mailto:itqan@ksu.edu.sa" target="_blank"><i
                                                class="fa fa-envelope-o"></i></a></li>

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
                            <p><span>إتقان</span>
                                التطوير المستمر
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo $assets ?>img/slide-two.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>إتقان</span>
                                دعم الجودة
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo $assets ?>img/slide-three.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>إتقان</span>
                                دعم الكفاءات
                                <br>
                                الوطنية
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo $assets ?>img/slide-four.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>إتقان</span>
                                استثمار للوقت
                                <br>
                                والجهد
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo $assets ?>img/slide-five.jpg" alt="">
                        <div class="carousel-caption">
                            <p><span>إتقان</span>
                                دعم الحراك
                                <br>
                                التطويري
                            </p>
                        </div>
                    </div>
                    <div class="black-block"></div>
                    <!-- Controls -->
                    <div class="slider-block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3 black-box"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 info-block">
                                    <h3>بيئــة معلوماتيــة<br>متطـــــــورة</h3>
                                    <p class="info">.مرحبا بكم في بوابة إتقان (نظام إدارة الجودة الإلكتروني), نظام
                                        التخطيط وإدارة المعلومـــات مـــن جامعـــة الملـــك سعـــود لإدارة التمـــيز
                                        فــي الأداء
                                    </p>
                                    <!--a href="#" class="more-btn">المزيد عن إتقان</a-->
                                </div>
                                <div class="col-md-3"></div>
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
                            </div> <!-- row -->
                            <div class="row">
                                <div class="col-md-6 sldr-btm"></div>
                                <div class="col-md-3 video-block">
                                    <a href="https://youtu.be/6AuNspAIYe8" target="_blank"><img
                                                src="<?php echo $assets ?>img/video_img.jpg" alt=""></a>
                                </div>
                                <div class="col-md-3 black-box2">
                                    <ul class="login-list">
                                        <li><a href="<?php echo base_url('/welcome/system') ?>" target="_blank">نظام
                                                إدارة الجودة الإلكتروني <i class="fa fa-caret-left"></i></a></li>
                                        <li><a href="http://itqanbi.ksu.edu.sa/ibmcognos/" target="_blank">لوحات القيادة
                                                القياسية <i class="fa fa-caret-left"></i></a></li>
                                        <li><a href="http://itqaneforms.ksu.edu.sa" target="_blank">النماذج الإلكترونية
                                                <i class="fa fa-caret-left"></i></a></li>
                                    </ul>
                                </div>
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
                <h2>الرؤيــــــة</h2>
                <p>تحقيق متسوى عالي من الإتقان في العمل</p>
            </div>
            <div class="col-md-3 img-box">
                <img src="<?php echo $assets ?>img/goals.jpg" alt="">
            </div>
            <div class="col-md-3 white-box">
                <h2>الأهـــداف</h2>
                <ul id="cScroll">
                    <li><i class="fa fa-caret-left"></i> تحسين عملية إتخاذ القرار ومراقبة الجودة والأداء.</li>
                    <li><i class="fa fa-caret-left"></i> إدارة جودة إلكترونية لضبط الجودة وأتمتة العديد من عملياتها.
                    </li>
                    <li><i class="fa fa-caret-left"></i> توفير بيانات دقيقة وموثوقة يمكن الإعتماد عليها في عملية الإعداد
                        والتخطيط والتطوير وصناعة وإتخاذ القرار الصحيح في الوقت المناسب.
                    </li>
                    <li><i class="fa fa-caret-left"></i> تسهيل عملية الوصول للبيانات المراد تحليلها وتقليل الزمن
                        المستغرق لإسترجاع البيانات
                    </li>
                    <li><i class="fa fa-caret-left"></i> إمداد المستخدمين بهياكل بيانات محللة جاهزة للإستخدام بما يتوافق
                        مع إحتياجاتهم.
                    </li>
                    <li><i class="fa fa-caret-left"></i> أتمتة أعداد كبيرة من التقارير الدورية من خلال نظام إدارة
                        تفاعلية.
                    </li>
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
                <h2>الرسالــــة</h2>
                <p>إدارة المخرجات وتوفير تقارير تسهل من إتخاذ القرارات الإستارتيجية، تشمل جميع الوظائف الرئيسية مثل
                    الملف الشخصي لأعضاء هيئة التدريس, مقاييس الأداء( الاحصاءات, المعلومات والوثائق),</p>
            </div>
            <div class="col-md-3 img-box">
                <img src="<?php echo $assets ?>img/mission.jpg" alt="">
            </div>
            <div class="col-md-3 white-box">
                <h2>مهمتنــــا</h2>
                <p>توفير مصدر موحد لبيانات الجامعة يساعد على توفير المعلومات المناسبة في الوقت المناسب بجودة عالية</p>
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-md-3 img-box">
                <a href="<?php echo $assets ?>img/Itqan.pdf" target="_blank"><img
                            src="<?php echo $assets ?>img/guid.jpg" alt=""></a>
            </div>
            <div class="col-md-3 img-box">
                <a href="#" data-toggle="modal" data-target="#contact"><img src="<?php echo $assets ?>img/contact.jpg"
                                                                            alt=""></a>
            </div>
            <div class="col-md-6 search-box">
                <div class="input-group">
                    <input class="form-control search" placeholder="إبحث" type="text">
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
                <p>الحقوق محفوظة 2016 - جامعة الملك سعود - إتقان</p>
            </div>
            <div class="col-xs-4 f-link">
                <a href="#">عن إتقان</a> | <a href="#">آخر المستجدات </a> | <a href="#" data-toggle="modal"
                                                                               data-target="#contact">تواصل معنا</a>
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
                <button type="button" class="btn more-btn" data-dismiss="modal">أغلق</button>
            </div>
        </div>
    </div>
</div>
<!-- script tags
============================================================= -->
<script src="<?php echo $assets ?>js/jquery-2.1.1.js"></script>
<script src="<?php echo $assets ?>js/smoothscroll.js"></script>
<script src="<?php echo $assets ?>js/bootstrap.min.js"></script>
<script src="<?php echo $assets ?>js/enscroll.js"></script>
<script src="<?php echo $assets ?>js/custom.js"></script>
</body>
</html>