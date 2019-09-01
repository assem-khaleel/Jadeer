<style>
    .page-profile-v2-header.page-header {
        border: none;
        margin-bottom: 0;
        border-radius: 0;
    }

    .page-profile-v2-header .box {
        background: none !important;
    }

    .page-profile-v2-subheader {
        background: rgba(0, 0, 0, .02);
    }

    .page-profile-v2-avatar {
        max-width: 80px;
        border: 4px solid #fff;
        position: relative;
    }

    @media (min-width: 768px) {
        .page-profile-v2-avatar {
            margin-top: -70px;
        }
    }
</style>

<div class="page-profile-v2-header page-header panel p-y-2">
    <div class="box m-a-0">
        <!-- Spacer -->
        <div class="box-cell col-md-6 valign-middle text-xs-center text-md-right">
            <a href="/thread" class="btn  btn-sm m-r-1">
                <i class="btn-label-icon left fa fa-envelope"></i><?php echo lang("Message") ?>
            </a>
        </div>

    </div>
</div>

<div class="page-profile-v2-subheader page-block p-y-3">
    <div class="text-xs-center">
        <img id="avatar" src="<?php echo htmlfilter($user->get_avatar()) ?>"
             alt="<?php echo htmlfilter($user->get_full_name()) ?>" class="page-profile-v2-avatar border-round">
    </div>
    <h1 class="font-size-24 text-xs-center m-y-1"><?php echo htmlfilter($user->get_full_name()) ?></h1>
</div>

<hr class="page-wide-block m-t-0">

<div class="row">
    <div class="col-md-8 col-xl-9">

        <ul class="nav nav-lg nav-tabs nav-tabs-simple tab-resize-nav" id="profile-tabs">
            <li class="dropdown tab-resize">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"><span class="tab-resize-icon"></span></a>
                <ul class="dropdown-menu"></ul>
            </li>
            <li class="active">
                <a href="#profile-about" data-toggle="tab">
                    <?php echo lang('About'); ?>
                </a>
            </li>
            <li>
                <a href="#profile-tasks" data-toggle="tab">
                    <?php echo lang('Tasks'); ?>
                </a>
            </li>
            <li>
                <a href="#profile-notification" data-toggle="tab">
                    <?php echo lang('Notification'); ?>
                </a>
            </li>
        </ul>

        <div class="tab-content p-y-0">
            <div class="tab-pane fade in active" id="profile-about">
                <div class="p-t-4">
                    <div class="list-group-demo">
                        <?php echo $user->draw_demographics(false); ?>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade in" id="profile-notification">
                <div class="p-y-4">
                    <?php echo Modules::run('notification/all', true); ?>
                </div>
            </div>

            <div class="tab-pane fade in" id="profile-tasks">
                <div class="p-y-4">
                    <?php echo $this->load->view('tasks/widget'); ?>
                </div>
            </div>
        </div>

    </div>

    <hr class="page-wide-block visible-xs visible-sm">

    <div class="col-md-4 col-xl-3">
        <div class="panel bg-transparent">
            <div class="panel-body p-a-1">
                <button class="btn btn-block btn-sm" onclick="document.getElementById('avatar_file').click();">
                    <span class="btn-label-icon left"><i class="fa fa-picture-o"
                                                         id="avatar_icon"></i></span><?php echo lang('Change Image') ?>
                    <input type="file" name="file" id="avatar_file" style="display: none;">
                </button>

                <a href="/user/change_password" data-toggle="ajaxModal" class="btn btn-block btn-sm">
                    <i class="btn-label-icon left fa fa-key"></i><?php echo lang('Change Password') ?>
                </a>
                <a href="/user/account_settings" class="btn btn-block btn-sm">
                    <i class="btn-label-icon left fa fa-bullhorn"></i><?php echo lang('Notification Settings') ?>
                </a>
                <script>
                    $("#avatar_file").change(function () {
                        $("#avatar_icon").removeClass('fa-picture-o').addClass('fa-spinner fa-spin');
                        $.ajax("/user/change_avatar", {
                            files: $(this),
                            iframe: true,
                            dataType: "json",
                            data: {csrf_test_name: $.cookie('csrf_cookie_name')}
                        }).done(function (msg) {
                            $("#avatar_icon").removeClass('fa-spinner fa-spin').addClass('fa-picture-o');
                            if (msg.status) {
                                $('#avatar').attr('src', msg.file);
                            } else {
                                alert(msg.error);
                            }
                        });
                    }).hide();
                </script>
            </div>
        </div>
        <div class="panel bg-transparent">
            <div class="panel-heading p-x-1 bg-transparent">
                <span class="panel-title"><?php echo lang('About Me'); ?></span>
                <a href="/user/about_me" data-toggle="ajaxModal" class="fa fa-edit pull-right"></a>
            </div>
            <div class="panel-body p-a-1">
                <?php echo htmlfilter($user->get_about_me()); ?>
            </div>
        </div>
        <div class="panel bg-transparent">
            <div class="panel-heading p-x-1 bg-transparent">
                <span class="panel-title"><?php echo lang('Contact info'); ?></span>
            </div>
            <ul class="list-group">
                <li class="list-group-item p-x-1 b-a-0">
                    <?php echo lang('Email'); ?> : <?php echo htmlfilter($user->get_email()); ?>
                </li>
                <li class="list-group-item p-x-1 b-a-0">
                    <?php echo lang('Phone'); ?> : <?php echo htmlfilter($user->get_phone()); ?>
                </li>
                <li class="list-group-item p-x-1 b-a-0">
                    <?php echo lang('Fax'); ?> : <?php echo htmlfilter($user->get_fax_no()); ?>
                </li>
                <li class="list-group-item p-x-1 b-a-0">
                    <?php echo lang('Address'); ?> : <?php echo htmlfilter($user->get_address()); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
