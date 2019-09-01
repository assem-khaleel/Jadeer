<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php
    $this->load->view("program_tree/edit");
    ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left" style="padding-top: 7.5px;"><?php echo  lang("Program Mission") ?></span>
        </div>
        <div class="panel-body">
            <div class="form-control col-xs-12"
                 style="height: 160px; overflow: auto; overflow-wrap: break-word; resize:none; background: transparent; border: none; margin-top: 10px;">
                <?php if($program_mission){?>
                    <div class="list-group-item" style="overflow: auto;">
                        <div class="well well-md m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo  htmlentities($program_mission)?></h3>
                        </div>
                    </div>
                <?php }else{?>
                    <div class="list-group-item" style="overflow: auto;">
                        <div class="well well-md m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There is no').' '.lang('Program mission to be displayed.'); ?></h3>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>

    <?php echo form_open('', ['method' => 'post', "class" => 'inline-form', 'id' => "form"]) ?>
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left" style="padding-top: 7.5px;"><?php echo  lang("Program Objectives") ?></span>

            <div class=" pull-right ">
                <button class="btn cg-code btn-3d no-print"><?php echo lang('Save')?></button>
            </div>
        </div>
        <div class="panel-body">
            <div class=" padding-xs-vr">
                <div class="col-lg-12">
                    <ul id="divmiss" class="list-group">
                    </ul>
                </div>
            </div>
            <table class="table table-striped table-bordered" border="0">
                <?php if($objectives){?>
                <thead>
                <tr>
                    <th class="no-border"></th>
                    <?php foreach ($keywordsProgram as $key => $programObj) {
                        echo '<th>' . lang('Program Mission').' '. ($key + 1) . '</th>';
                    } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($objectives as $key => $objectiveObj) { ?>
                    <tr>
                        <td><?php echo lang('Program Objective ') . ($key + 1); ?></td>
                        <?php
                        foreach ($keywordsProgram as $programObj) {
                            $checked = '';
                            if (isset($relations[$programObj->get_id() . '-' . $objectiveObj->get_id()])) {
                                $checked = 'checked';
                            }
                            ?>
                            <td>
                                <label class="custom-control custom-checkbox checkbox-inline"
                                       for="<?php echo  intval($objectiveObj->get_id()) ?>-<?php echo  intval($programObj->get_id()) ?>">
                                    <input type="checkbox" name="relation[<?php echo  intval($programObj->get_id()) ?>][]"
                                           id="<?php echo  intval($objectiveObj->get_id()) ?>-<?php echo  intval($programObj->get_id()) ?>"
                                           value="<?php echo  intval($objectiveObj->get_id()) ?>" class="custom-control-input" <?php echo  $checked ?> />
                                    <span class="custom-control-indicator"></span>
                                </label>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>

                </tbody>
                <?php   } else {?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program objectives to be displayed.'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php echo form_close(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo  lang("Program Mission Keywords") ?></span>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered" border="0">
                <tbody>
                <?php
                /**
                 * @var $keywordObj Orm_Pt_Keyword_College
                 */
                if (count($keywordsProgram)) {
                    foreach ($keywordsProgram as $key => $keywordObj) { ?>
                        <tr>
                            <td class="col-lg-3"><?php echo lang('Program Mission' ).' '. ($key + 1); ?></td>
                            <td class="col-lg-9"><?php echo htmlfilter($keywordObj->get_title()); ?></td>
                        </tr>
                    <?php  } } else {?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program mission Keywords to be displayed.'); ?></h3>
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
            <span class="panel-title pull-left" style="padding-top: 7.5px;"><?php echo  lang("Program Objectives") ?></span>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered" border="0">
                <tbody>
                <?php
                /**
                 * @var $keywordObj Orm_Pt_Keyword_Program
                 */
                if (count($objectives)) {
                    foreach ($objectives as $key => $keywordObj) { ?>
                        <tr>
                            <td class="col-lg-3"><?php echo lang('Program Objective ' ).' '. ($key + 1); ?></td>
                            <td class="col-lg-9"><?php echo htmlfilter($keywordObj->get_title()); ?></td>
                        </tr>
                    <?php  } } else {?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program objective to be displayed.'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
