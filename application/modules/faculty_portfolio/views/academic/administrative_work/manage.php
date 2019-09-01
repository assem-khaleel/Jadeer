<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/10/16
 * Time: 12:06 PM
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/academic/administrative_work_manage" , array('id' => 'administrative_work-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Administrative Work'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_administrative_work">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Start Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="start_date" value="<?php echo $administrative_work->get_start_date() != '0000-00-00' ? htmlfilter($administrative_work->get_start_date()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('start_date'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('End Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="end_date" value="<?php echo $administrative_work->get_end_date() != '0000-00-00' ? htmlfilter($administrative_work->get_end_date()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('end_date'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Position')?></label>
                            <div class="col-md-9">
                                <input type="text" name="position" value="<?php echo htmlfilter($administrative_work->get_position()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('position'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Type')?></label>
                            <div class="col-md-9">
                                <select name="type" id="type" class="form-control">
                                    <option value=""><?php echo lang('All Types') ?></option>
                                    <?php
                                    foreach(Orm_Fp_Administrative_Work::get_types_array() as $typeKey=>$type) {
                                        echo '<option value="'.$typeKey.'"'.($typeKey==$administrative_work->get_type()? ' selected="selected"':'').'>'.$type.'</option>';
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('type'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="college_row">
                            <label class="control-label col-md-3"><?php echo lang('College')?></label>
                            <div class="col-md-9">
                                <select name="college_id" id="college_id" class="form-control" onchange="get_departments_by_college(this, 1, 1, '_aw');">
                                    <option value=""><?php echo lang('All College') ?></option><?php
                                        foreach (Orm_College::get_all() as $college) {
                                         $selected = ($college->get_id() == $administrative_work->get_college_id() ? 'selected="selected"' : '');
                                    ?>
                                    <option value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('college_id'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="department_row">
                            <label class="control-label col-md-3"><?php echo lang('Department')?></label>
                            <div class="col-md-9">
                                <select id="department_block_aw" name="department_id" class="form-control">
                                    <option value=""><?php echo lang('All Department') ?></option>
                                </select>
                                <?php echo Validator::get_html_error_message('department_id'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="deanship_row">
                            <label class="control-label col-md-3"><?php echo lang('Deanship Id')?></label>
                            <div class="col-md-9">
                                <select name="deanship_id" class="form-control">
                                    <option value=""><?php echo lang('All Deanship') ?></option><?php
                                    foreach (Orm_Unit::get_all() as $unit) {
                                        $selected = ($unit->get_id() == $administrative_work->get_deanship_id() ? 'selected="selected"' : '');
                                        ?>
                                        <option value="<?php echo (int)$unit->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('deanship_id'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="vice_recotrate_row">
                            <label class="control-label col-md-3"><?php echo lang('Vice Rectorate')?></label>
                            <div class="col-md-9">
                                <input type="text" name="vice_recotrate" value="<?php echo htmlfilter($administrative_work->get_vice_recotrate()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('vice_recotrate'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($administrative_work->get_id()); ?>" >
                    </td>
                </tr>
            </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $(".datepicker_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#administrative_work-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    $('#type').change(function() {
        $('#department_row').hide();
        $('#college_row').hide();
        $('#deanship_row').hide();
        $('#vice_recotrate_row').hide();

        switch(parseInt($(this).val())) {
            case <?php echo Orm_Fp_Administrative_Work::TYPE_DEPARTMENT ?>:
                $('#department_row').show();

            case <?php echo Orm_Fp_Administrative_Work::TYPE_COLLEGE ?>:
                $('#college_row').show();
                break;

            case <?php echo Orm_Fp_Administrative_Work::TYPE_DEANSHIP ?>:
                $('#deanship_row').show();
                break;

            case <?php echo Orm_Fp_Administrative_Work::TYPE_VICE_RECOTRATE ?>:
                $('#vice_recotrate_row').show();
        }
    });

    $('#type').change();

    <?php  if($administrative_work->get_department_id()) : ?>
    $('#college_id').change();

    $timer_for_department = setInterval(function() {
        if($("#department_block_aw").find('option[value="<?php echo $administrative_work->get_department_id() ?>"]').length!=0) {

            $("#department_block_aw").val('<?php echo $administrative_work->get_department_id() ?>');
            clearInterval($timer_for_department);
        }
    },500);
    <?php endif; ?>
</script>