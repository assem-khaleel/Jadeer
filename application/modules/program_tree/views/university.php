<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php
    $this->load->view("program_tree/edit");
    ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo lang("University Mission") ?></span>
        </div>
        <div class="panel-body">
            <div class="form-control col-xs-12"
                 style="height: 160px; overflow: auto; overflow-wrap: break-word; resize:none; background: transparent; border: none; margin-top: 10px;">
                <?php if ($institution_mission) { ?>
                    <div class="list-group-item" style="overflow: auto;">
                        <div class="well well-md m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo htmlentities($institution_mission) ?></h3>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="list-group-item" style="overflow: auto;">
                        <div class="well well-md m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There is no').' '.lang('university mission to be displayed.'); ?></h3>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php echo form_open('', ['method' => 'post', "class" => 'inline-form', 'id' => "form"]) ?>
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo lang("University Mission Keywords") ?></span>

            <div class=" pull-right ">
                <button class="btn cg-code btn-3d no-print"><?php echo lang('Save') ?></button>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <div>
                        <div class="input-group col-xs-12">
                            <input type="text" name="mission_en"
                                   placeholder="<?= lang('University Mission Keyword') ?> (<?php echo lang('English') ?>)"
                                   id="inputmission_en" class="form-control select2-input m-b-2">
                            <input type="text" name="mission_ar"
                                   placeholder="<?= lang('University Mission Keyword') ?> (<?php echo lang('Arabic') ?>)"
                                   id="inputmission_ar" class="form-control select2-input m-b-2">

                        </div>
                        <p class="help-block hidden"
                           style="margin-top: 5px;"><?php echo lang("This field is required") ?></p>
                    </div>

                </div>
            </div>


            <div class=" padding-xs-vr">

                <ul id="divmiss" class="list-group">
                    <?php
                    /**
                     * @var $keywordObj Orm_Pt_Keyword_Uni
                     */
                    if (count($keywords)) {
                        foreach ($keywords as $keywordObj) { ?>
                            <li class="list-group-item" style="overflow: auto;">

                                <textarea class="hidden" id="en_<?php echo intval($keywordObj->get_id()); ?>"><?php echo htmlfilter($keywordObj->get_title_en()); ?></textarea>
                                <textarea class="hidden" id="ar_<?php echo intval($keywordObj->get_id()); ?>"><?php echo htmlfilter($keywordObj->get_title_ar()); ?></textarea>
                                <a class="keyword text-primary"
                                   data-id="<?php echo intval($keywordObj->get_id()); ?>" href="#">
                                    <?php echo htmlfilter($keywordObj->get_title()); ?>
                                </a>
                            </li>
                            <?php
                        }
                    } else {
                        ?>
                        <li class="list-group-item" style="overflow: auto;">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('university mission Keywords to be displayed.'); ?></h3>
                            </div>
                        </li>
                    <?php } ?>
                </ul>

            </div>

            <div class=" padding-xs-vr">
                <div class="col-lg-12">
                    <ul id="divmiss" class="list-group">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<div id="editMode" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sx animated fadeIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang('Edit').' '.lang('University Mission Title') ?></h4>
            </div>
            <?php echo form_open('', ['method' => 'post', "class" => 'inline-form', "id" => "editForm"]) ?>
            <div class="modal-body">
                <div class="row form-group">
                    <label for="mission_en" class="control-label"><?= lang('University Mission Keyword') ?> (<?php echo lang('English') ?>):</label>
                    <input type="text" name="mission_en" id="editEn" class="form1 form-control select2-input"
                           placeholder="<?= lang('University Mission Keyword') ?> (<?php echo lang('English') ?>)"/>
                    <p class="help-block hidden"><?php echo lang('You Cant Leave It Empty') ?></p>
                </div>
                <div class="row form-group">
                    <label for="mission_ar" class="control-label"><?= lang('University Mission Keyword') ?> (<?php echo lang('Arabic') ?>):</label>
                    <input type="text" name="mission_ar" id="editAr" class="form1 form-control select2-input"
                           placeholder="<?= lang('University Mission Keyword') ?> (<?php echo lang('Arabic') ?>)"/>
                    <p class="help-block hidden"><?php echo lang('You Cant Leave It Empty') ?></p>
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
                <input name="edit" type="submit" class="btn editbtn pull-left" value="<?php echo lang('Save') ?>"/>
                <input name="delete" type="submit" class="btn delbtn pull-right" value="<?php echo lang('Delete') ?>"/>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>

    $("a.keyword").click(function () {
        var id = $(this).data('id'),
            dataEn = $("#en_"+id).val(),
            dataAr = $("#ar_"+id).val();
        $("#keywordID").val(id);
        $("#editEn").val(dataEn);
        $("#editAr").val(dataAr);
        $("#editMode").modal('show');
    })

</script>