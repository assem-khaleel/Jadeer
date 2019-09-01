<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php
    $this->load->view("program_tree/edit");
    ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <?php echo form_open('', ['method' => 'post', "class" => 'inline-form', 'id' => "form"]) ?>
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo  lang("PLO to Program Objectives") ?></span>

            <div class=" pull-right ">
                <button class="btn btn-3d"><?php echo lang('save')?></button>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <?php if($plos):?>
                <thead>
                <tr>
                    <th class="no-border"></th>
                    <?php foreach ($objectives as $key => $objectiveObj) {
                        echo '<th>' . lang('Program Objectives ' ).' '. ($key + 1) . '</th>';
                    } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($plos as $key => $ploObj) { ?>
                    <tr>
                        <td><?php echo lang('PLO ') . ($key + 1); ?></td>
                        <?php
                        foreach ($objectives as $objectiveObj) {
                            $checked = '';
                            if (isset($relations[$objectiveObj->get_id() . '-' . $ploObj->get_id()])) {
                                $checked = 'checked';
                            }
                            ?>
                            <td>
                                <label class="custom-control custom-checkbox checkbox-inline" for="<?php echo  intval($objectiveObj->get_id()) ?>-<?php echo  intval($ploObj->get_id()) ?>">
                                    <input type="checkbox" name="relation[<?php echo  intval($objectiveObj->get_id()) ?>][]"
                                           id="<?php echo  intval($objectiveObj->get_id()) ?>-<?php echo  intval($ploObj->get_id()) ?>"
                                           value="<?php echo  intval($ploObj->get_id()) ?>" class="custom-control-input" <?php echo  $checked ?> />
                                    <span class="custom-control-indicator"></span>
                                </label>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
                <?php else:?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program learning outcome PLOs to be displayed.'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php endif;?>
            </table>
        </div>
    </div>
    <?php echo form_close(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo  lang("Program Objective Keywords") ?></span>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered" border="0">
                <tbody>
                <?php
                /**
                 * @var $keywordObj Orm_Pt_Keyword_College
                 */
                if (count($objectives))
                    foreach ($objectives as $key => $objectiveObj) { ?>
                        <tr>
                            <td class="col-lg-3"><?php echo lang('Program Objective ').' '. ($key + 1); ?></td>
                            <td class="col-lg-9"><?php echo htmlfilter($objectiveObj->get_title()); ?></td>
                        </tr>
                    <?php   } else {?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program objective keywords to be displayed.'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left" style="padding-top: 7.5px;"><?php echo  lang("PLO ") ?></span>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered" border="0">
                <tbody>
                <?php
                /**
                 * @var $keywordObj Orm_Pt_Keyword_Program
                 */
                if (count($plos))
                    foreach ($plos as $key => $ploObj) { ?>
                        <tr>
                            <td class="col-lg-3"><?php echo lang('PLO ') .' '. ($key + 1); ?></td>
                            <td class="col-lg-9"><?php echo htmlfilter($ploObj->get_text()); ?></td>
                        </tr>
                    <?php   } else {?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program learning outcome PLOs to be displayed.'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>