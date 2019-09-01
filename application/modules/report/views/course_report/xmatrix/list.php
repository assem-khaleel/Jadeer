<?php
/* @var $course_obj Orm_Course*/
/* @var $programs Orm_Program_Plan[]*/
/* @var $clos Orm_Cm_Course_Learning_Outcome[]*/
?>

<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="table-light">

        <div class="table-header">
            <div class="table-caption">
                <button class="btn btn-rounded btn-sm collapsed" type="button" data-toggle="collapse"
                        data-target="#clo_legends" aria-expanded="false" aria-controls="clo_legends"><i
                        class="fa fa-question"></i></button>
                <span class="padding-sm-hr"><?php echo lang('Course Learning Outcomes Legends'); ?></span>
            </div>
        </div>

        <div class="collapse" id="clo_legends" aria-expanded="false" style="height: 0;">
            <table class="table table-bordered">
                <tbody>

                <?php
                if($clos){

                foreach ($clos as $key => $clo) {
                    ?>
                    <tr>
                        <td class="col-md-2 valign-middle"><?php echo  lang('C.L.O ') . ' ' . ($key + 1); ?></td>
                        <td class="col-md-10 valign-middle"><?php echo htmlfilter($clo->get_code()); ?> - <?php echo htmlfilter($clo->get_text()); ?></td>
                    </tr>
                <?php }}else{ ?>
                    <tr>
                        <td colspan="2"><?php echo  lang('There are no') . ' ' . lang('Course Learning Outcomes'); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="table-light">

        <div class="table-header">
            <div class="table-caption">
                <button class="btn btn-rounded btn-sm collapsed" type="button" data-toggle="collapse"
                        data-target="#plo_legends" aria-expanded="false" aria-controls="plo_legends"><i
                        class="fa fa-question"></i></button>
                <span class="padding-sm-hr"><?php echo lang('Program Learning Outcomes Legends'); ?></span>
            </div>
        </div>

        <div class="collapse" id="plo_legends" aria-expanded="false" style="height: 0;">
            <table class="table table-bordered">
                <tbody>
                <?php
                if($programs){
                foreach ($programs as $program):?>
                    <?php foreach (Orm_Cm_Program_Learning_Outcome::get_all(array('program_id'=>$program->get_program_id())) as $key => $plo) { ?>
                        <tr>
                            <td class="col-md-2 valign-middle"><?php echo  lang('P.L.O ') . ' ' . ($key + 1); ?></td>
                            <td class="col-lg-10"><?php echo htmlfilter($plo->get_text()); ?> ( <?php echo htmlfilter($plo->get_learning_domain_obj()->get_title()).' - '.htmlfilter(Orm_Cm_Program_Domain::get_type_name($plo->get_learning_domain_obj()->get_type())); ?> )</td>
                        </tr>
                    <?php } ?>
                <?php endforeach; ?>
                <?php } else{ ?>
                <tr>
                    <td colspan="2"><?php echo  lang('There are no') . ' ' . lang('Program Learning Outcomes'); ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="table table-responsive table-light table-primary">
        <div class="table-header">
            <div class="table-caption">
                <?php echo lang('X-Matrix for').' '.$course_obj->get_name() ?>
            </div>
        </div>
        <table class="table table-bordered">
            <?php if($clos): ?>
                <thead>
                <tr>
                    <th></th>
                    <?php foreach ($clos as $key => $clo): ?>
                        <th title="<?php echo htmlfilter($clo->get_code()); ?> - <?php echo htmlfilter($clo->get_text()); ?>">
                            <?php echo  lang('C.L.O ') . ' ' . ($key + 1); ?>
                        </th>

                    <?php endforeach;?>
                </tr>

                </thead>
                <?php if($programs): ?>
                <?php foreach ($programs as $program):
                    $plos = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id'=>$program->get_program_id()));
                    ?>
                    <?php foreach ($plos as $key => $plo){ ?>
                    <tr>
                        <td><?php echo  lang('P.L.O ') . ' ' . ($key + 1); ?></td>

                        <?php
                        foreach ($clos as $key => $clo):

                            $checked = '';

                            $check = Orm_Cm_Course_Matrix::get_all(['clo_id' => $clo->get_id(), 'plo_id' => $plo->get_id()]);

                            if (!empty($check)) {
                                $checked = 'checked';
                            }
                            ?>
                            <td>
                                <?php   if (!empty($check)) { ?>
                                <label class="custom-control custom-checkbox checkbox-inline"
                                       for="relation_<?php echo intval($plo->get_id()) ?>-<?php echo (int)$key ?>">
                                    <input type="checkbox" style="z-index: 9999;margin-top:-10px;"
                                           name="relation[<?php echo $plo->get_id(); ?>][<?php echo intval($clo->get_id()) ?>]"
                                           id="<?php echo intval($clo->get_id()) ?>-<?php echo intval($clo->get_id()) ?>"
                                           value="<?php echo intval($clo->get_id()) ?>"
                                           class="custom-control-input" <?php echo $checked ?> disabled />
                                    <span class="custom-control-indicator"></span>
                                </label>
                                <?php } ?>
                            </td>

                        <?php endforeach;?>

                    </tr>
                <?php } ?>

                <?php endforeach;?>
            <?php else: ?>
            <tr>
                <td>
                    <?php echo  lang('There are no') . ' ' . lang('Program Learning Outcomes'); ?>
                </td>
            </tr>
            <?php endif; ?>
            <?php else: ?>
                <tr>
                    <td>
                        <?php echo  lang('There are no') . ' ' . lang('Course Learning Outcomes'); ?>
                    </td>
                </tr>
            <?php endif; ?>


        </table>
    </div>
</div>
