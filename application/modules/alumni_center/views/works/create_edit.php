<?php
/* @var $work Orm_Alumni_Work  */
/* @var $user Orm_user */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title">
            <?php echo lang('Alumni works'); ?>
        </span>
    </div>
    <?php echo form_open('/alumni_center/works/save',array('id' => 'add_alumni_works_form')) ?>
        <div class="panel-body">
            <input name="id" type="hidden" value="<?php echo htmlfilter($work->get_id()); ?>" />
            <input type="hidden" name="user_id" value="<?php echo (int) $user->get_id(); ?>"/>

            <div class="title_container">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="employer_id"><?php echo lang('Employer'); ?>: *</label>
                    <div class="col-sm-10">
                        <select name="employer_id" id="employer_id" class="form-control">
                            <option value=""><?php echo lang('Select one'); ?></option>
                            <?php
                            foreach (Orm_User_Employer::get_all() as $employer) {
                                $selected = ($employer->get_id() == $work->get_employer_id() ? 'selected="selected"' : '');
                                ?>
                                <option value="<?php echo htmlfilter($employer->get_id()) ?>" <?php echo $selected ?>><?php echo htmlfilter($employer->get_full_name()) ?></option>
                                <?php
                            }
                            ?>
                        </select>   
                        <?php echo Validator::get_html_error_message('employer_id'); ?>
                    </div>
                </div>
            </div>
            <div class="title_container">
                <div class="form-group">
                    <label for="position" class="col-sm-2 control-label"><?php echo lang('Position'); ?>:</label>
                    <div class="col-sm-10">
                        <div id="user_cont">
                            <input name="position" id="position" class="form-control input-sm" value="<?php echo htmlfilter($work->get_position()); ?>">
                            <?php echo Validator::get_html_error_message('position'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="title_container">
                <div class="form-group">
                    <label for="start_date" class="col-sm-2 control-label"><?php echo lang('Start date'); ?>: *</label>
                    <div class="col-sm-10">
                        <input type="text" name="start_date" class="form-control numeric-field" id="start_date" readonly="readonly" value="<?php echo ($work->get_start_date() ? htmlfilter(date("Y-m-d", $work->get_start_date())) : ''); ?>" />
                        <?php echo Validator::get_html_error_message('start_date'); ?>
                    </div>
                </div>
            </div>

            <div class="title_container">
                <div class="form-group">
                    <label for="end_date" class="col-sm-2 control-label"><?php echo lang('End date'); ?>: *</label>
                    <div class="col-sm-10">
                        <input type="text" name="end_date" class="form-control numeric-field" id="end_date" readonly="readonly" value="<?php echo ($work->get_end_date() ? htmlfilter(date("Y-m-d", $work->get_end_date())) : ''); ?>" />
                        <?php echo Validator::get_html_error_message('end_date'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <div class="form-group">
                <div class="save_and_cancel_container">
                    <button  name="save" id="save" type="submit" class="btn btn-sm"
                            <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-floppy-o"></span><?php echo lang('Save'); ?></button>
                </div>
            </div>
        </div>
    <?php echo form_close() ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var d = new Date();
        var curr_year = d.getFullYear();
        $("#start_date , #end_date").datepicker({format: 'yyyy-mm-dd', autoclose: true, yearRange: curr_year + ":" + (curr_year + 1)});
    });
</script>
