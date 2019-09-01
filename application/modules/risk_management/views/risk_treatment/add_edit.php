<?php
/**
 * Created by PhpStorm.
 * User: laith
 * Date: 10/31/17
 * Time: 12:43 PM
 */
/** @var $risk_treatment Orm_Rim_Risk_Treatment */
/** @var $risk_id int */

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("risk_management/risk_treatment/save?risk_id={$risk_id}", array('id' => 'risk-treatment-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Risk Treatment'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="risk_desc_en"><?php echo lang('Risk Description'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <textarea class="form-control" id="risk_desc_en"
                              name="risk_desc_en"><?php echo htmlfilter($risk_treatment->get_risk_desc_en()) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="risk_desc_ar"> <?php echo lang('Risk Description'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <textarea class="form-control" id="risk_desc_ar"
                              name="risk_desc_ar"><?php echo htmlfilter($risk_treatment->get_risk_desc_ar()) ?></textarea>
                </div>
                 <div class="form-group">
                    <label class="control-label" for="impact_en"><?php echo lang('Impact'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <textarea class="form-control" id="impact_en"
                              name="impact_en"><?php echo htmlfilter($risk_treatment->get_impact_en()) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="impact_ar"> <?php echo lang('Impact'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <textarea class="form-control" id="impact_ar"
                              name="impact_ar"><?php echo htmlfilter($risk_treatment->get_impact_ar()) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="desc_en"><?php echo lang('Risk Treatment'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <textarea class="form-control" id="desc_en"
                              name="desc_en"><?php echo htmlfilter($risk_treatment->get_desc_en()) ?></textarea>
                    <?php echo Validator::get_html_error_message('desc_en'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label" for="desc_ar"> <?php echo lang('Risk Treatment'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <textarea class="form-control" id="desc_ar"
                              name="desc_ar"><?php echo htmlfilter($risk_treatment->get_desc_ar()) ?></textarea>
                    <?php echo Validator::get_html_error_message('desc_ar'); ?>

                </div>

                 <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"
                                   for="responsible_name"><?php echo lang('Risk Responsible') ?></label>
                            <div class="col-sm-9">
                                <input type="text"
                                       placeholder="<?php echo lang('Select') . ' ' . lang('Responsible') ?>"
                                       onclick="find_users(this, 'responsible_id', 'responsible_name', null, ['<?php echo Orm_User::USER_FACULTY . "', '" . Orm_User::USER_STAFF; ?>'])"
                                       readonly class="form-control"
                                       id="responsible_name" name="responsible_name"
                                       value="<?php if ($risk_treatment->get_responsible_id()) {
                                           echo $risk_treatment->get_responsible_id(true)->get_full_name();
                                       } ?>"/>
                                <input id="responsible_id" name="responsible_id" data-type="chair" type="hidden"
                                       value="<?php echo $risk_treatment->get_responsible_id(); ?>"/>
                                <?php echo Validator::get_html_error_message('responsible_id'); ?>
                            </div>
                        </div>
                    </div>

                <input type="hidden" name="id" value="<?php echo intval($risk_treatment->get_id()) ?>"/>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right "
                <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#risk-treatment-form').on('submit', function (e) {
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
</script>