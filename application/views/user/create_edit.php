<?php
/** @var $user Orm_User */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open('/user/save', 'class="form-horizontal"') ?>
        <div class="panel panel-primary panel-dark">
            <div class="panel-heading">
            <span class="panel-title">
                <?php echo($user->get_id() ? lang('Edit').' '.lang('User') : lang('Create').' '.lang('User')); ?>
                :: <?php echo lang(str_replace('orm_user_', '', strtolower($user->get_class_type()))); ?>
            </span>
            </div>
            <div class="panel-body">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading">
                    <span class="panel-title">
                        <?php echo lang('User Login Info'); ?>
                    </span>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="login_id" class="col-sm-3 control-label">
                                <?php echo lang('User Login ID'); ?> *
                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="login_id" class="form-control disable_spellcheck"
                                       value="<?php echo htmlfilter($user->get_login_id()); ?>"/>
                                <?php echo Validator::get_html_error_message('login_id'); ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">
                                <?php echo lang('User Name') . " (" . lang('Email') . ")"; ?> *
                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control disable_spellcheck"
                                       value="<?php echo htmlfilter($user->get_email()); ?>"/>
                                <?php echo Validator::get_html_error_message('email'); ?>
                            </div>
                        </div>

                        <?php //if (empty($user->get_login_id())) { ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <?php echo lang('Password'); ?> *
                                </label>

                                <div class="col-sm-9">
                                    <?php $reset_password = (int)$this->input->post('reset_password'); ?>

                                    <?php if ($user->get_id()) : ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       class="px" <?php echo($reset_password ? 'checked="checked"' : ''); ?>
                                                       onclick="checkbox_password(this);"/>
                                                <span class="lbl"><?php echo lang('Reset Password'); ?></span>
                                            </label>

                                            <input type="hidden" name="reset_password" id="reset_password"
                                                   value="<?php echo $reset_password; ?>"/>
                                            <script>
                                                function checkbox_password(element) {
                                                    if ($(element).is(':checked')) {
                                                        $('#reset_password').val(1);
                                                        $('#password').toggle();
                                                    } else {
                                                        $('#reset_password').val(0);
                                                        $('#password').toggle();
                                                    }
                                                }
                                            </script>
                                        </div>
                                    <?php endif; ?>

                                    <div id="password"
                                         <?php if ($user->get_id() && !$reset_password) : ?>style="display: none;"<?php endif; ?> >
                                        <input type="password" name="password" class="form-control"/>
                                        <?php echo Validator::get_html_error_message('password'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php //} ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Is Active'); ?>
                            </label>

                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="px"
                                               name="is_active" <?php echo($user->get_is_active() ? 'checked="checked"' : ''); ?>
                                               value="1"/>
                                        <span class="lbl"><?php echo lang('Active'); ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading">
                    <span class="panel-title">
                        <?php echo lang('User Info'); ?>
                    </span>
                    </div>
                    <div class="panel-body">
                        <?php echo $user->draw_form(); ?>
                    </div>
                </div>

                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading">
                    <span class="panel-title">
                        <?php echo lang('User Personal Info'); ?>
                    </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('First Name'); ?> *
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="first_name"
                                       value="<?php echo htmlfilter($user->get_first_name()); ?>"/>
                                <?php echo Validator::get_html_error_message('first_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Last Name'); ?> *
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="last_name"
                                       value="<?php echo htmlfilter($user->get_last_name()); ?>"/>
                                <?php echo Validator::get_html_error_message('last_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Birth Date'); ?>
                            </label>

                            <div class="col-sm-9">
                                <input name="birth_date" id="birth_date" class="form-control input-sm"
                                       value="<?php echo htmlfilter(($user->get_birth_date() != '0000-00-00') ? $user->get_birth_date() : ''); ?>">
                                <?php echo Validator::get_html_error_message('birth_date'); ?>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $("#birth_date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
                                });
                            </script>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo lang('Gender') ?></label>

                            <div class="col-sm-9">
                                <?php
                                foreach (Orm_User::$gender_list as $key => $gender) {
                                    $selected = ($key == $user->get_gender() ? 'checked="checked"' : '');
                                    ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="px"
                                                   value="<?php echo $key ?>" <?php echo $selected ?> name="gender">
                                            <span class="lbl"><?php echo lang($gender) ?></span>
                                        </label>
                                    </div>
                                <?php } ?>
                                <?php echo Validator::get_html_error_message('gender'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Nationality'); ?>
                            </label>

                            <div class="col-sm-9">
                                <input name="nationality" class="form-control input-sm"
                                       value="<?php echo htmlfilter($user->get_nationality()); ?>">
                                <?php echo Validator::get_html_error_message('nationality'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading">
                    <span class="panel-title">
                        <?php echo lang('User Contact Info'); ?>
                    </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Cell Phone'); ?>
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone"
                                       value="<?php echo htmlfilter($user->get_phone()); ?>"/>
                                <?php echo Validator::get_html_error_message('phone'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Office Number'); ?>
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="office_no"
                                       value="<?php echo htmlfilter($user->get_office_no()); ?>"/>
                                <?php echo Validator::get_html_error_message('office_no'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Fax Number'); ?>
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fax_no"
                                       value="<?php echo htmlfilter($user->get_fax_no()); ?>"/>
                                <?php echo Validator::get_html_error_message('fax_no'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Address'); ?>
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address"
                                       value="<?php echo htmlfilter($user->get_address()); ?>"/>
                                <?php echo Validator::get_html_error_message('address'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <input name="id" type="hidden" value="<?php echo htmlfilter($user->get_id()); ?>"/>
                <input name="type" type="hidden" value="<?php echo htmlfilter($user->get_class_type()); ?>"/>

                <button type="submit" class="btn btn-sm "
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i
                                class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>

                <!--            <input type="submit" class="btn btn-sm" value="-->
                <?php //echo lang('save'); ?><!--"/>-->
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>

