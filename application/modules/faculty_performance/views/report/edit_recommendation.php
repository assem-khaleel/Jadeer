<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 17/04/17
 * Time: 02:27 م
 */
/* @var $recommendation Orm_Fp_Forms_Recommendation */
/*@var $type_id string*/
/*@var  $category_id string*/
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_performance/faculty_report/save_recommendation", array('id' => 'recommendation-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Recommendation'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="row form-group">
                    <label class="col-md-3 control-label" for="recommendation_en">
                        <?php echo lang('Recommendation') ?>  (<?php echo lang('English') ?>)
                    </label>
                    <div class="col-md-9">
                           <textarea id="recommendation_en" name="recommendation_en" class="form-control"><?php echo $recommendation->get_recommendation_en() ? xssfilter($recommendation->get_recommendation_en()) : '' ?></textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 control-label" for="recommendation_ar">
                        <?php echo lang('Recommendation') ?> (<?php echo lang('Arabic') ?>)
                    </label>
                    <div class="col-md-9">
                             <textarea id="recommendation_ar" name="recommendation_ar" class="form-control"><?php echo $recommendation->get_recommendation_ar() ? xssfilter($recommendation->get_recommendation_ar()) : '' ?></textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 control-label" for="action_en">
                        <?php echo lang('Actions') ?> (<?php echo lang('English') ?>)
                    </label>
                    <div class="col-md-9">
                             <textarea id="action_en" name="action_en" class="form-control"><?php echo $recommendation->get_action_en() ? xssfilter($recommendation->get_action_en()) : '' ?></textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 control-label" for="action_ar">
                        <?php echo lang('Actions') ?> (<?php echo lang('Arabic') ?>)
                    </label>
                    <div class="col-md-9">
                             <textarea id="action_ar" name="action_ar" class="form-control"><?php echo $recommendation->get_action_ar() ? xssfilter($recommendation->get_action_ar()) : '' ?></textarea>
                        
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo intval($recommendation->get_id()) ?>">
                <input type="hidden" name="type_id" value="<?php echo intval($type_id) ?>">
                <input type="hidden" name="category_id" value="<?php echo intval($category_id) ?>">
                
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
                </button>
                <button type="submit" class="btn btn-sm pull-right ">
                    <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


    <script type="text/javascript">

        $('#recommendation-form').on('submit', function (e) {
            e.preventDefault();

            var $ajaxProp = {
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serializeArray(),
                dataType: 'JSON'
            };

            $.ajax($ajaxProp).done(function () {
                    window.location.reload();
            });
        });

    </script>

