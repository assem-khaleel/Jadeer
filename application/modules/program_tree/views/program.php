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
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo  lang("Program mission keyword") ?></span>

            <div class=" pull-right ">
                <button class="btn cg-code btn-3d no-print"><?php echo lang('Save')?></button>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                        <div class="input-group col-xs-12">
                            <input type="text" name="mission_en" placeholder="<?= lang('Add').' '.lang('Program Mission Keyword')?> (<?php echo lang('English') ?>)"
                                   id="inputmission" class="form-control select2-input">
                        </div>
                        <p class="help-block hidden" style="margin-top: 5px;"><?php echo  lang("This field is required") ?></p>
                </div>
                <div class=" padding-xs-vr">
                    <div class="col-lg-12">
                        <ul id="divmiss" class="list-group">
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12">
                        <div class="input-group col-xs-12">
                            <input type="text" name="mission_ar" placeholder="<?= lang('Add').' '.lang('Program Mission Keyword')?> (<?php echo lang('Arabic') ?>)"
                                   id="inputmission" class="form-control select2-input">
                        </div>
                        <p class="help-block hidden" style="margin-top: 5px;"><?php echo  lang("This field is required") ?></p>
                    </div>
            </div>
            <div class=" padding-xs-vr">
                <div class="col-lg-12">
                    <ul id="divmiss" class="list-group">
                    </ul>
                </div>
            </div>
            <table class="table table-striped table-bordered" border="0">
                <?php if($keywordsProgram){?>
                <thead>
                <tr>
                    <th class="no-border"></th>
                    <?php foreach ($keywordsCollege as $key => $collegeObj) {
                        echo '<th>' . lang('College Keyword').' ' . ($key + 1) . '</th>';
                    } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($keywordsProgram as $key => $programObj) { ?>
                    <tr>
                        <td>
                            <textarea class="hidden" id="en_<?php echo intval($programObj->get_id()); ?>"><?php echo htmlfilter($programObj->get_title_en()); ?></textarea>
                            <textarea class="hidden" id="ar_<?php echo intval($programObj->get_id()); ?>"><?php echo htmlfilter($programObj->get_title_ar()); ?></textarea>

                            <a class="program text-primary" href="javascript:void(0)" data-id="<?php echo intval($programObj->get_id()); ?>">
                                <?php echo lang('Program Keyword ' ). ($key + 1); ?> </a>
                        </td>
                        <?php
                        foreach ($keywordsCollege as $colObj) {
                            $checked = '';
                            if (isset($relations[$programObj->get_id() . '-' . $colObj->get_id()])) {
                                $checked = 'checked';
                            }
                            ?>
                            <td>
                                <label class="custom-control custom-checkbox checkbox-inline" for="<?php echo  intval($colObj->get_id()) ?>-<?php echo  intval($programObj->get_id()) ?>">
                                    <input type="checkbox" name="relation[<?php echo  intval($programObj->get_id()) ?>][]"
                                           id="<?php echo  intval($colObj->get_id()) ?>-<?php echo  intval($programObj->get_id()) ?>"
                                           value="<?php echo  intval($colObj->get_id()) ?>" class="custom-control-input" <?php echo  $checked ?> />
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
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program mission Keywords to be displayed.'); ?></h3>
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
                  style="padding-top: 7.5px;"><?php echo  lang("College Mission Keywords") ?></span>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered" border="0">
                <tbody>
                <?php
                /**
                 * @var $keywordObj Orm_Pt_Keyword_College
                 */
                if (count($keywordsCollege)) {
                    foreach ($keywordsCollege as $key => $keywordObj) { ?>
                        <tr>
                            <td class="col-lg-3"><?php echo lang('College Keyword' ).' '. ($key + 1); ?></td>
                            <td class="col-lg-9"><?php echo htmlfilter($keywordObj->get_title()); ?></td>
                        </tr>
                    <?php }} else {?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('college mission keywords to be displayed.'); ?></h3>
                            </div>
                        </td>
                    </tr>
             <?php }?>
                </tbody>
            </table>
        </div>
    </div>

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
                 * @var $keywordObj Orm_Pt_Keyword_Program
                 */
                if (count($keywordsProgram)) {
                    foreach ($keywordsProgram as $key => $keywordObj) { ?>
                        <tr>
                            <td class="col-lg-3"><?php echo lang('Program Keyword') .' ' . ($key + 1); ?></td>
                            <td class="col-lg-9"><?php echo htmlfilter($keywordObj->get_title()); ?></td>
                        </tr>
                    <?php }}else {?>
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
</div>

<div id="editMode" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sx animated fadeIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang('Edit').' '.lang('Program Mission Keyword');?></h4>
            </div>
            <?php echo form_open('', ['method' => 'post', "class" => 'inline-form', "id" => "editForm"]) ?>
            <div class="modal-body">
                <div class="row form-group">
                    <label for="mission_en" class="control-label"><?= lang('Program Mission Keyword') ?> (<?php echo lang('English'); ?>:</label>
                    <input type="text" name="mission_en" id="editEn" class="form1 form-control select2-input"
                           placeholder="<?= lang('Program Mission Keyword') ?> (<?php echo lang('English'); ?>"/>
                    <p class="help-block hidden"><?php echo lang('This field is required')?></p>
                </div>
                <div class="row form-group">
                    <label for="mission_ar" class="control-label"><?= lang('Program Mission Keyword') ?> (<?php echo lang('Arabic'); ?>:</label>
                    <input type="text" name="mission_ar" id="editAr" class="form1 form-control select2-input"
                           placeholder="<?= lang('Program Mission Keyword') ?> (<?php echo lang('Arabic'); ?>"/>
                    <p class="help-block hidden"><?php echo lang('This field is required')?>.</p>
                </div>
                <div class="row">
                    <br/>
                    <div class="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo lang('Removing this keyword will destroy all its existing relationships') ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="keywordID" id="keywordID" class="form1 form-control select2-input">
                    <input name="edit" type="submit" class="btn editbtn pull-left" value="<?php echo  lang('Save') ?>"/>
                    <input name="delete" type="submit" class="btn delbtn pull-right" value="<?php echo  lang('Delete') ?>"/>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).click(function () {
        $(".program").click(function () {
            var id = $(this).data('id'),
                dataEn = $("#en_"+id).val(),
                dataAr = $("#ar_"+id).val();
            $("#keywordID").val(id);
            $("#editEn").val(dataEn);
            $("#editAr").val(dataAr);
            $("#editMode").modal('show');
        })
    })
</script>