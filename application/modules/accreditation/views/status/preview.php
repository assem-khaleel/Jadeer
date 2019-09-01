<?php
/**
 * @var Orm_As_Status $status_obj
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Agency'); ?></h4>
        </div>
        <div class="modal-body">

            <div class="well m-a-0">
                <div class="row m-b-1">
                    <div class="col-md-10">
                        <h4><?php echo htmlfilter($status_obj->get_agency_obj()->get_name()) ?> - <?php echo htmlfilter($status_obj->get_program_obj()->get_name()) ?></h4>
                        <hr>
                        <?php echo xssfilter($status_obj->get_note()) ?>
                    </div>
                    <div class="col-md-2">
                        <div style="position: relative;">
                            <i class="fa fa-certificate" style="font-size: 130px; color: <?php echo htmlfilter($status_obj->get_status('color')) ?>;"></i>
                            <span style="position: absolute; left: 15px; top: 40px; color: #FFF; width: 80px; text-align: center;">
                                <?php echo htmlfilter($status_obj->get_agency_obj()->get_name()) ?>
                                <br>
                                <?php echo htmlfilter($status_obj->get_status('name')) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="well m-a-0">
                            <h4><?php echo lang('Program Chair'); ?></h4>
                            <hr>
                            <b><?php echo lang('Name'); ?></b> : <?php echo htmlfilter($status_obj->get_chair_name()) ?:'-'; ?><br>
                            <b><?php echo lang('Email'); ?></b> : <?php echo htmlfilter($status_obj->get_chair_email()) ?:'-'; ?><br>
                            <b><?php echo lang('Phone'); ?></b> : <?php echo htmlfilter($status_obj->get_chair_phone()) ?:'-'; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="well m-a-0">
                            <h4><?php echo lang('Dean'); ?></h4>
                            <hr>
                            <b><?php echo lang('Name'); ?></b> : <?php echo htmlfilter($status_obj->get_dean_name()) ?:'-'; ?><br>
                            <b><?php echo lang('Email'); ?></b> : <?php echo htmlfilter($status_obj->get_dean_email()) ?:'-'; ?><br>
                            <b><?php echo lang('Phone'); ?></b> : <?php echo htmlfilter($status_obj->get_dean_phone()) ?:'-'; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($status_obj->get_attachment()) { ?>
                <hr>
                <a class="link" href="<?php echo htmlfilter($status_obj->get_attachment_link()) ?>" ><i class="fa fa-paperclip"></i> <?php echo lang('Download Attachment'); ?></a>
            <?php } ?>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
        </div>
    </div>
</div>