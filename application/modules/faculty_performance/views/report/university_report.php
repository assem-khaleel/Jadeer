<?php
/** @var Orm_Fp_Forms_Type $form_types */
/** @var Orm_Fp_Forms_Recommendation $university */
?>
<?php if( Orm_Fp_Forms_Deadline::get_current_deadline()!=0){?>

<div class="well m-t-4">
    <div class="row ">
        <div class="col-md-12 col-lg-12">
            <?php foreach ($form_types as $type) {/** @var Orm_Fp_Forms_Type $type */ ?>
                <div class="col-lg-4 form-group">
                    <label for=""><?php echo htmlfilter($type->get_name()); ?> (<?php echo htmlfilter($type->get_rate(Orm_Fp_Forms_Deadline::get_current_deadline())); ?>)</label>
                    <div class="input-group">
                        <span class="input-group-addon">%</span>
                        <input type="text" readonly="readonly" class="form-control"
                               placeholder="<?php echo Orm_Fp_Forms_Evaluations::get_avg('','',$type->get_id()); ?> ">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?php echo form_open("/faculty_performance/faculty_report/save_recommendation", array('id' => 'form-university')); ?>
            <div class="col-lg-6 form-group">
                <label for="recommendation_en"><?php echo lang('Recommendation'); ?> (<?php echo lang('English'); ?>)</label>
                <textarea id="recommendation_en" class="form-control" name="recommendation_en"><?php echo $university->get_recommendation_en()? htmlfilter($university->get_recommendation_en()): lang('There are no').' '.lang('Recommendation').' ('.lang('English').')'?></textarea>
            </div>

            <div class="col-lg-6 form-group">
                <label for="recommendation_ar"><?php echo lang('Recommendation'); ?> (<?php echo lang('Arabic'); ?>)</label>
                <textarea id="recommendation_ar" class="form-control" name="recommendation_ar"><?php echo $university->get_recommendation_ar() ? htmlfilter($university->get_recommendation_ar()): lang('There are no').' '.lang('Recommendation').' ('.lang('Arabic').')'?></textarea>
            </div>
            <div class="col-lg-6 form-group">
                <label for="action_en"><?php echo lang('Action'); ?> (<?php echo lang('English'); ?>)</label>
                <textarea id="action_en" class="form-control" name="action_en"><?php echo $university->get_action_en() ? htmlfilter($university->get_action_en()): lang('There are no').' '.lang('Action') .' ('.lang('English').')'?></textarea>
            </div>

            <div class="col-lg-6 form-group">
                <label for="action_ar"><?php echo lang('Action'); ?> (<?php echo lang('Arabic'); ?>)</label>
                <textarea id="action_ar" class="form-control" name="action_ar"><?php echo $university->get_action_ar() ? htmlfilter($university->get_action_ar()): lang('There are no').' '.lang('Action').' ('.lang('Arabic').')'?></textarea>
            </div>

            <input type="hidden" name="id" value="<?php echo intval($university->get_id()) ?>">
            <input type="hidden" name="type_id" value="3">
            <input type="hidden" name="category_id" value="0">

            <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
                <?php echo lang('Save Changes'); ?>
            </button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php }else{ ?>
    <div class="well">
        <div class="alert alert-default">
            <h3 class="m-a-0 text-center"><?php echo lang('There is no') . ' ' . lang('Current Deadline'); ?></h3>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">

    $('#form-university').on('submit', function (e) {
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