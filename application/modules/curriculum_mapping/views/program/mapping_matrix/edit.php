<?php
/** @var $program_id int */
/** @var $level int */

$program_levels = Orm_Program_Plan::get_program_levels($program_id, true);
$level = $level ?: ($program_levels ? min($program_levels) : 0);

$program_domain = Orm_Cm_Program_Domain::get_one(array('program_id' => $program_id,'$semester_id' =>Orm_Semester::get_active_semester()->get_id()));
$domains = Orm_Cm_Learning_Domain::get_all(array('type'=> $program_domain->get_domain_type()));
$program_plans = Orm_Program_Plan::get_all(array('program_id' => $program_id));

/** @var Orm_Cm_Program_Learning_Outcome[][] $program_outcomes */
$program_outcomes = array();

$program_outcome_nodomain = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_id));

?>
<?php echo form_open("/curriculum_mapping/program/mapping_matrix_save/{$program_id}", array('class' => 'tab-content tab-content-bordered', 'id' => 'mapping-form')); ?>


<div class="table-light">
    <div class="table-header">
        <div class="table-caption">
            <button class="btn btn-rounded btn-sm collapsed" type="button" data-toggle="collapse" data-target="#legends" aria-expanded="false" aria-controls="legends"><i class="fa fa-question"></i></button>
            <span class="padding-sm-hr"><?php echo lang('Learning Outcomes'); ?></span>
        </div>
    </div>

    <div class="collapse" id="legends" aria-expanded="false" style="height: 0;">
        <table class="table table-bordered">
            <tbody>
            <?php foreach ($program_outcome_nodomain as $Nodomain) { ?>
                <tr>
                    <td class="col-md-2 valign-middle"><?php echo htmlfilter($Nodomain->get_code()); ?></td>
                    <td class="col-md-10 valign-middle"><?php echo htmlfilter($Nodomain->get_text()); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>


<div class="table-primary table-responsive" id="new-ipaMatrix">

    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-md-2"><?php echo lang('Course'); ?></th>

            <?php foreach($program_plans as $plan) {  ?>
                <th><?php echo htmlfilter($plan->get_course_obj()->get_code()).'-'; ?>
                    <?php echo htmlfilter($plan->get_course_obj()->get_name()); ?>
                </th>
            <?php } ?>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($program_outcome_nodomain as $Nodomain) { ?>
            <tr>
                <td class="bg-theme">
                    <strong><?php echo $Nodomain->get_code(); ?></strong>
                </td>

                <?php foreach($program_plans as $plan) { ?>
                    <td class="valign-middle">
                        <?php $map_obj = Orm_Cm_Program_Mapping_Matrix::get_one(array('program_id' => $program_id, 'course_id' => $plan->get_course_id(), 'program_learning_outcome_id' => $Nodomain->get_learning_outcome_id())) ?>

                        <select class="form-control"  name="mapping[<?php echo $plan->get_course_id(); ?>][<?php echo $Nodomain->get_learning_outcome_id(); ?>]">
                            <option value=""><?php echo lang('N/A') ?></option>
                            <?php foreach(Orm_Cm_Program_Mapping_Matrix::get_ipa_list() as $ipa_key => $ipa_value) { ?>
                                <option value="<?php echo $ipa_key ?>" <?php echo ($map_obj->get_id() && $map_obj->get_ipa() == $ipa_key ? 'selected="selected"' : ''); ?> ><?php echo lang($ipa_value) ?></option>
                            <?php } ?>
                        </select>
                    </td>
                <?php } ?>
            </tr>

        <?php } ?>
        </tbody>

    </table>
</div>

<div class="table-footer">
    <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
    <div class="clearfix"></div>
</div>

<?php echo form_close(); ?>
<script>
    $('#mapping-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>