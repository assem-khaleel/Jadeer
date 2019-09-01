<?php
/**
 * Created by PhpStorm.
 * User: laith
 * Date: 5/1/17
 * Time: 4:18 PM
 */

/* @var $question Orm_Tst_Question */

?>


<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <b><span class="label label-default" style="font-size: large"><?php echo  lang('Q') .':'; ?></span>&nbsp;&nbsp;<?php echo nl2br(htmlfilter($question->get_text())); ?></b>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <?php echo $question->draw_question(); ?>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left "
                    data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
        </div>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->