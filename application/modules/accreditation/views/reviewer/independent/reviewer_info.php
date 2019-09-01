<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/20/17
 * Time: 9:28 AM
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Reviewer Information'); ?></h4>
        </div>
        <div class="modal-body">

            <div class="table-responsive">
                <table class="table table-hover table-light">
                    <tbody>
                    <tr>
                        <td class="col-md-4"><?php echo lang('Reviewer Name') ?></td>
                        <td class="text-xs-right col-md-8"><?php echo $reviewer->get_reviewer_obj()->get_full_name(true); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Reviewer CV Attachment') ?></td>
                        <td class="text-xs-right"><a href="<?php echo $reviewer->get_cv_attachment(); ?>" class="btn btn-sm btn-primary"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Reviewer CV Text') ?></td>
                        <td><?php echo xssfilter($reviewer->get_cv_text()); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Reviewer Report Attachment') ?></td>
                        <td class="text-xs-right"><a href="<?php echo $reviewer->get_report_attachment(); ?>" class="btn btn-sm btn-primary"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Reviewer Report Text') ?></td>
                        <td><?php echo xssfilter($reviewer->get_report_text()); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Recommendations') ?></td>
                        <td><?php echo xssfilter($reviewer->get_recommendations()); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
