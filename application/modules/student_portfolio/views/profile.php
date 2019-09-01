<div class="profile-full-name">
    <span class="text-semibold"><?php echo htmlfilter($user->get_full_name()) ?></span> <?php echo lang('Profile') ?>
</div>
<div class="profile-row">
    <div class="left-col">
        <div class="profile-block">
            <div class="panel panel-primary profile-photo">
                <img id="avatar" src="<?php echo htmlfilter($user->get_avatar()) ?>" alt="">
            </div>
        </div>

        <div class="panel panel-transparent">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('About Me'); ?></span>
            </div>
            <div class="panel-body">
                <?php echo htmlfilter($user->get_about_me()); ?>
            </div>
        </div>
    </div>
    <div class="right-col">

        <hr class="profile-content-hr no-grid-gutter-h">

        <div class="profile-content">

            <ul id="profile-tabs" class="nav nav-tabs">
                <li class="active">
                    <a href="#profile-tabs-about" data-toggle="tab">
                        <?php echo lang('About'); ?>
                    </a>
                </li>

                <?php echo Modules::run('student_portfolio/profile_tabs', 'link', $user->get_id()); ?>
            </ul>

            <script>
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    var tab = $(e.target).attr('href');
                    var url = $(tab).attr('data-url');

                    if (url && !$(tab).hasClass('data')) {
                        $.ajax({
                            type: "POST",
                            url: url
                        }).done(function (msg) {
                            $(tab).addClass('data');
                            $(tab).html(msg);
                            init_data_toggle();
                        }).fail(function () {
                            window.location.reload();
                        });
                    }
                });
            </script>

            <div class="tab-content tab-content-bordered panel-padding">
                <div class="tab-pane fade active in" id="profile-tabs-about">
                    <div class="row list-group-demo">
                        <div class="col-sm-12">
                            <ul class="list-group">
                                <?php if (!empty($user->get_email())) : ?>
                                    <li class="list-group-item">
                                        <label class="control-label"><?php echo lang('Email'); ?> : </label>
                                        <?php echo htmlfilter($user->get_email()); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($user->draw_demographics())) : ?>
                                    <li class="list-group-item">
                                        <label class="control-label"><?php echo lang('Information'); ?> : </label>
                                        <?php echo $user->draw_demographics(); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($user->get_birth_date()) && $user->get_birth_date()) : ?>
                                    <li class="list-group-item">
                                        <label class="control-label"><?php echo lang('Birth Date'); ?> : </label>
                                        <?php echo htmlfilter($user->get_birth_date()); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($user->get_phone())) : ?>
                                    <li class="list-group-item">
                                        <label class="control-label"><?php echo lang('Phone Number'); ?> : </label>
                                        <?php echo htmlfilter($user->get_phone()); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($user->get_fax_no())) : ?>
                                    <li class="list-group-item">
                                        <label class="control-label"><?php echo lang('Fax Number'); ?> : </label>
                                        <?php echo htmlfilter($user->get_fax_no()); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($user->get_address())) : ?>
                                    <li class="list-group-item">
                                        <label class="control-label"><?php echo lang('Address'); ?> : </label>
                                        <?php echo htmlfilter($user->get_address()); ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php echo Modules::run('student_portfolio/profile_tabs', 'wrapper', $user->get_id()); ?>
            </div>
        </div>
    </div>
</div>

