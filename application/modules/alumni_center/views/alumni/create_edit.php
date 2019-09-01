<?php
/** @var $user Orm_User */
$user_label = $user->get_class_type() == Orm_User::USER_ALUMNI ? lang('Alumni') : lang('\'Employer\'');
?>
<?php echo form_open('/alumni_center/save','class="form-horizontal"'); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="panel-title">
                <?php echo ($user->get_id() ? lang('Edit').' '.lang($user_label) : lang('Create').' '.lang($user_label)); ?>
            </span>
        </div>
        <div class="panel-body">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="panel-title">
                        <?php echo lang($user_label).' ( '.lang( 'Login Info').' ) '; ?>
                    </span>
                </div>
                <div class="panel-body">
                    <?php if ($user->get_class_type() == Orm_User::USER_ALUMNI): ?>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">
                                <?php echo lang('User Name') . " (" . lang('Email') . ")"; ?> *
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="email" id="email" class="form-control disable_spellcheck" value="<?php echo htmlfilter($user->get_email()); ?>" />
                                <?php echo Validator::get_html_error_message('email'); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">
                                <?php echo lang('Contact Email'); ?> *
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="email" id="email" class="form-control disable_spellcheck" value="<?php echo htmlfilter($user->get_email()); ?>" />
                                <?php echo Validator::get_html_error_message('email'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="panel-title">
                        <?php echo lang($user_label).' ( '.lang('General Info').' ) '; ?>
                    </span>
                </div>
                <div class="panel-body">
                    <?php echo $user->draw_form(); ?>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="panel-title">
                        <?php echo lang($user_label).' ( '.lang('Personal Info').' ) '; ?>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="first_name">
                            <?php echo lang('First Name'); ?> *
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlfilter($user->get_first_name()); ?>" />
                            <?php echo Validator::get_html_error_message('first_name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="last_name">
                            <?php echo lang('Last Name'); ?> *
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo htmlfilter($user->get_last_name()); ?>" />
                            <?php echo Validator::get_html_error_message('last_name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="birth_date">
                            <?php echo lang('Birth Date'); ?>
                        </label>
                        <div class="col-sm-9">
                            <input name="birth_date" id="birth_date" class="form-control input-sm" value="<?php echo htmlfilter(($user->get_birth_date() != '0000-00-00') ? date('Y-m-d', strtotime($user->get_birth_date())) : ''); ?>">
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
                                        <input type="radio" class="px" value="<?php echo $key ?>" <?php echo $selected ?> name="gender">
                                        <span class="lbl"><?php echo lang($gender) ?></span>
                                    </label>
                                </div>
                            <?php } ?>
                            <?php echo Validator::get_html_error_message('gender'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="nationality">
                            <?php echo lang('Nationality'); ?>
                        </label>
                        <div class="col-sm-9">
                            <input name="nationality" id="nationality" class="form-control input-sm" value="<?php echo htmlfilter($user->get_nationality()); ?>">
                            <?php echo Validator::get_html_error_message('nationality'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="panel-title">
                        <?php echo lang('User Contact Info'); ?>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="phone">
                            <?php echo lang('Cell Phone'); ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlfilter($user->get_phone()); ?>" />
                            <?php echo Validator::get_html_error_message('phone'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="office_no">
                            <?php echo lang('Office Number'); ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="office_no" id="office_no" value="<?php echo htmlfilter($user->get_office_no()); ?>" />
                            <?php echo Validator::get_html_error_message('office_no'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="fax_no">
                            <?php echo lang('Fax Number'); ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="fax_no" id="fax_no" value="<?php echo htmlfilter($user->get_fax_no()); ?>" />
                            <?php echo Validator::get_html_error_message('fax_no'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="address">
                            <?php echo lang('Address'); ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlfilter($user->get_address()); ?>" />
                            <?php echo Validator::get_html_error_message('address'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <input name="id" type="hidden" value="<?php echo intval($user->get_id()); ?>" />
            <input name="type" type="hidden" value="<?php echo htmlfilter($user->get_class_type()); ?>" />
            <button type="submit" class="btn btn-sm" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-floppy-o"></span><?php echo lang('Save'); ?>
            </button>
        </div>
    </div>
<?php echo form_close(); ?>