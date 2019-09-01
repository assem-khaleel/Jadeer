<nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
        <a class="navbar-brand" href="/">
            <img height="48px" src="<?php echo Orm_Institution::get_one()->get_univ_logo(); ?>">
        </a>
    </div>
    <ul class="nav navbar-nav visible-md visible-lg">
        <li>
            <?php $language_key = UI_LANG == 'arabic' ? 'english' : 'arabic'; ?>
            <a href="/language/change/<?php echo $language_key; ?>">
                <span><?php echo lang($language_key); ?></span>
            </a>
        </li>
    </ul>

    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-navbar-collapse"
            aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-navbar-collapse">
        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown">

                <a href="/help/<?php echo UI_LANG; ?>" target="_blank">
                    <i class="nav-icon fa fa-question"></i>
                    <span class="px-navbar-icon-label"><?php echo lang('Help') ?></span>
                </a>
            </li>

            <li id="notification_wrapper" class="dropdown">
                <script type="text/javascript">
                    pxInit.push(function () {
                        check_notification();
                    });
                </script>
            </li>

            <li class="dropdown">
                <a href="/thread">
                    <i class="nav-icon fa fa-envelope"></i>
                    <span class="px-navbar-icon-label"><?php echo lang('Income Messages') ?></span>
                    <span class="px-navbar-label label label-danger"><?php echo Orm_Thread::get_count(array('type' => Orm_Thread::LIST_TYPE_INBOX, 'is_read' => false)); ?></span>
                </a>
            </li>

            <li class="dropdown">
                <?php
                $semesters = Orm_Semester::get_all();
                $semesters_count = count($semesters);
                $semester_active = Orm_Semester::get_active_semester();
                ?>
                <?php if ($semesters_count) { ?>
                    <a data-toggle="dropdown" class="dropdown-toggle">
                        <?php echo htmlfilter($semester_active->get_name()); ?>
                    </a>
                    <?php if ($semesters_count > 1) { ?>
                        <ul style="overflow-x: hidden; max-height: 250px;" class="dropdown-menu m-a-0">
                            <?php foreach ($semesters as $semester) { ?>
                                <li>
                                    <a href="/semester/change/<?php echo urlencode($semester->get_id()); ?>">
                                        <i class="dropdown-icon fa <?php echo($semester_active->get_id() === $semester->get_id() ? 'fa-check-square-o' : 'fa-square-o') ?>"></i>&nbsp;&nbsp;
                                        <?php echo htmlfilter($semester->get_name()); ?>
                                        <?php echo($semester->get_is_current() ? '&nbsp;&nbsp;<i class="fa fa-bolt"></i>' : '') ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                <?php } else { ?>
                    <a><i class="fa fa-warning"></i>&nbsp;&nbsp;<?php echo lang('No Semesters') ?></a>
                <?php } ?>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                    <span><?php echo htmlfilter(Orm_User::get_logged_user()->get_full_name()) ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/user/profile"><?php echo lang('Profile'); ?></a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="/welcome/logout">
                            <i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;<?php echo lang('Log Out'); ?>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>