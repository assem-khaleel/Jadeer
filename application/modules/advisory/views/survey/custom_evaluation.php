<?php
/* @var  $students Orm_Ad_Student_Faculty[]*/
/* @var $evaluators Orm_Survey_Evaluator[]*/
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Advisory') ?>
        </div>
        <?php
        $extra_html =  form_hidden('evaluation_id', $evaluation_id);
        echo filter_block('/advisory/Ad_Survey/evaluation_filter', '/advisory/Ad_Survey/custom_evaluation/'.$evaluation_id, ['keyword'], 'ajax_block',$extra_html);
        ?>
    </div>
    <?php echo form_open("/advisory/Ad_Survey/save_evaluator"); ?>

    <?php if (empty($students)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Student Members'); ?>
            </div>

        </div>
    <?php } else { ?>
        <div class="table-responsive m-a-0" style="height: 400px;overflow: auto">
            <table class="table table-bordered">
                <thead>
                <tr>

                    <th class="col-md-4">
                        <?php echo lang('Student Name') ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($students as $student) {
                    ?>
                    <tr>
                        <td>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" <?php echo in_array($student->get_student_id(),$evaluators)?"checked=checked":""?> name="student_ids[]" value="<?php echo $student->get_student_id(); ?>">
                                <span class="custom-control-indicator"></span>
                                <?php echo htmlfilter(Orm_User::get_instance($student->get_student_id())->get_full_name()); ?>
                            </label>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <input type="hidden" name="evaluation_id" value="<?php echo (int) $evaluation_id; ?>" /><br>
            <button class="btn btn-outline" type="submit" >
                <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
                <?php echo lang('Save Changes'); ?>
            </button>
        </div>
    <?php } ?>


    <?php echo form_close(); ?>
</div>
