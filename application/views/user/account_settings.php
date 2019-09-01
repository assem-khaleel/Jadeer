<div class="row">
    <div class="col-md-12">

        <div style="font-size: 16px; margin-bottom: 20px;">
            <span class="text-semibold"><?php echo $user->get_full_name() ?></span> <?php echo lang('Profile') ?>
        </div>

        <div class="profile-content">

            <ul id="profile-tabs" class="nav nav-tabs">
                <li class="active">
                    <a href="#profile-tabs-notification-settings" data-toggle="tab">
                        <?php echo lang('Notification Settings'); ?>
                    </a>
                </li>
            </ul>

            <div class="tab-content tab-content-bordered panel-padding">
                <!-- / .tab-pane -->
                <div class="tab-pane fade active in clearfix" id="profile-tabs-notification-settings">
                    <div id="notification_settings">
                        <?php echo form_open('/user/save_notification_settings'); ?>
                        <div class="col-md-6">
                            <div class="panel bg-transparent">
                                <div class="panel-title"><strong><?php echo lang('Email Notifications'); ?></strong>
                                </div>
                                <hr class="m-y-0">
                                <div class="panel-body">
                                    <p><?php echo lang('Email me when') ?>:</p>

                                    <?php
                                    foreach (Orm_Notification_Template::get_all() as $template) {
                                        $user_settings = $template->get_user_notification_settings();
                                        ?>

                                        <label class="custom-control custom-checkbox m-t-2"
                                               for="notifications[<?php echo $template->get_name(); ?>][allow_email]">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="notifications[<?php echo $template->get_name(); ?>][allow_email]"
                                                   name="notifications[<?php echo $template->get_name(); ?>][allow_email]"
                                                   value="1" <?php echo($user_settings->get_allow_email() ? 'checked="checked"' : ''); ?>>
                                            <span class="custom-control-indicator"></span>
                                            <?php echo lang($template->get_name()); ?>
                                        </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel bg-transparent">
                                <div class="panel-title"><strong><?php echo lang('SMS Notifications'); ?></strong>
                                </div>
                                <hr class="m-y-0">
                                <?php if ($this->config->item('sms_gateway')) { ?>
                                    <div class="panel-body">
                                        <p><?php echo lang('Send SMS when') ?>:</p>

                                        <?php
                                        foreach (Orm_Notification_Template::get_all() as $template) {
                                            $user_settings = $template->get_user_notification_settings();
                                            ?>

                                            <label class="custom-control custom-checkbox m-t-2"
                                                   for="notifications[<?php echo $template->get_name(); ?>][allow_email]">
                                                <input type="checkbox" class="custom-control-input"
                                                       name="notifications[<?php echo $template->get_name(); ?>][allow_sms]"
                                                       value="1" <?php echo($user_settings->get_allow_sms() ? 'checked="checked"' : ''); ?>>
                                                <span class="custom-control-indicator"></span>
                                                <?php echo lang($template->get_name()); ?>
                                            </label>
                                        <?php } ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="panel-body">
                                        <div class="alert">
                                            <?php echo lang("There are no").' '.lang('Settings for SMS'); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <button type="submit"
                                    class="btn btn-lg m-t-3"><?php echo lang('Save Update'); ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
            <!-- / .tab-content -->
        </div>
    </div>
</div>

