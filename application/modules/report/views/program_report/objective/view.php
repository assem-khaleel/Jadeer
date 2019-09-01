<?php

$program_id = $data['item_id'];
$objectives = $data['objectives'];
$plos = $data['plos'];

//print_r( $data['objectives']);die;
/* @var $objectives Orm_Program_Objective[]*/
/* @var $plos Orm_Cm_Program_Learning_Outcome[]*/

$program_obj = Orm_Program::get_instance($data['item_id'])
?>
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="table-light">

        <div class="table-header">
            <div class="table-caption">
                <button class="btn btn-rounded btn-sm " type="button"><i
                        class="fa fa-question"></i></button>
                <span class="padding-sm-hr"><?php echo lang('Program Objectives Legends'); ?></span>
            </div>
        </div>

        <div id="obj_legends">
            <table class="table table-bordered">
                <tbody>
                <?php
                if($objectives){

                    foreach ($objectives as $key => $objective) {
                        ?>
                        <tr>
                            <td class="col-md-2 valign-middle"><?php echo  lang('OBJ') . ' ' . ($key + 1); ?></td>
                            <td class="col-md-10 valign-middle"><?php echo htmlfilter($objective->get_title()); ?></td>
                        </tr>
                    <?php }}else{ ?>
                    <tr>
                        <td colspan="2"><?php echo  lang('There are no') . ' ' . lang('Objective'); ?></td>
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
                <button class="btn btn-rounded btn-sm" type="button">
                    <i class="fa fa-question"></i>
                </button>
                <span class="padding-sm-hr"><?php echo lang('Program Learning Outcomes Legends'); ?></span>
            </div>
        </div>

        <div id="plo_legends">
            <table class="table table-bordered">
                <tbody>
                <?php
                if($plos){
                    foreach ($plos as  $key => $plo):?>
                        <tr>
                            <td class="col-md-2 valign-middle"><?php echo  lang('P.L.O ') . ' ' . ($key + 1); ?></td>
                            <td class="col-lg-10"><?php echo htmlfilter($plo->get_text()); ?> ( <?php echo htmlfilter($plo->get_learning_domain_obj()->get_title()).' - '.htmlfilter(Orm_Cm_Program_Domain::get_type_name($plo->get_learning_domain_obj()->get_type())); ?> )</td>
                        </tr>
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
                <?php echo lang('PLO to Program Objectives for').' '.$program_obj->get_name() ?>
            </div>
        </div>
        <table class="table table-bordered">
            <?php if($objectives): ?>
                <thead>
                <tr>
                    <th></th>
                    <?php foreach ($objectives as $key => $objective): ?>
                        <th title="<?php echo htmlfilter($objective->get_title()); ?>">
                            <?php echo  lang('OBJ') . ' ' . ($key + 1); ?>
                        </th>

                    <?php endforeach;?>
                </tr>

                </thead>
                <?php if($plos): ?>
                    <?php foreach ($plos as $plo):
                        ?>
                        <tr>
                            <td><?php echo  lang('P.L.O ') . ' ' . ($key + 1); ?></td>
                            <?php
                            foreach ($objectives as $key => $objective):

                                $checked = '';

                                $check = Orm_Pt_Obj_Plo_Relation::get_all(['obj_id' => $objective->get_id(), 'plo_id' => $plo->get_id()]);

                                if (!empty($check)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <?php if(!empty($check)){ ?>
                                <td>
                                    <label class="custom-control custom-checkbox checkbox-inline"
                                           for="relation_<?php echo intval($plo->get_id()) ?>-<?php echo (int)$key ?>">
                                        <input type="checkbox" style="z-index: 9999;margin-top:-10px;"
                                               name="relation[<?php echo $plo->get_id(); ?>][<?php echo intval($objective->get_id()) ?>]"
                                               id="<?php echo intval($objective->get_id()) ?>-<?php echo intval($objective->get_id()) ?>"
                                               value="<?php echo intval($objective->get_id()) ?>"
                                               class="custom-control-input" <?php echo $checked ?> disabled />
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                                <?php } ?>

                            <?php endforeach;?>

                        </tr>
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

