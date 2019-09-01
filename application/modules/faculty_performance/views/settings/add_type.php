<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 06/04/17
 * Time: 04:16 م
 */
/* @var  $performance Orm_Fp_Forms_Type  */
/* @var  $deadline_id string  */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_performance/faculty_settings/save_type", array('id' => 'form_type-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Type'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="type_name_en"><?php echo lang('Type Name') . ' ( ' . lang('English').' ) ' ?></label>
                        <div class="col-sm-9">
                            <input type="text" id="type_name_en" name="type_name_en" class="form-control"
                                   value="<?php echo $performance->get_type_name_en()  ? htmlfilter($performance->get_type_name_en() ) : ''?>">
                            <?php echo Validator::get_html_error_message('type_name_en'); ?>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="type_name_ar"><?php echo lang('Type Name') . ' ( ' . lang('Arabic').' ) ' ?></label>
                        <div class="col-sm-9">
                            <input type="text" id="type_name_ar" name="type_name_ar" class="form-control"
                                   value="<?php echo $performance->get_type_name_ar()  ? htmlfilter($performance->get_type_name_ar() ) : ''?>">
                            <?php echo Validator::get_html_error_message('type_name_ar'); ?>

                        </div>
                    </div>
                </div>
                <?php
                $count_evaluation = Orm_Fp_Forms_Evaluations::get_one(['deadline_id'=>$deadline_id ]);
                if($count_evaluation->get_id()==0):
                ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"
                                   for="rate"><?php echo lang('Rate Value') ?></label>
                            <div class="col-sm-9">
                                <div class="input-group">

                                    <input type="text" id="rate" name="rate" class="form-control"
                                           value="<?php echo $performance->get_rate($deadline_id)  ? htmlfilter($performance->get_rate($deadline_id) ) : ''?>">

                                    <div class="input-group-addon">%</div>
                                </div>
                                <?php echo Validator::get_html_error_message('rate'); ?>

                            </div>
                        </div>
                    </div>
                <?php else: ?>
                <input type="hidden" id="rate" name="rate" class="form-control"
                       value="<?php echo htmlfilter( $performance->get_rate($deadline_id)?: 0) ?>">

                <?php endif; ?>

            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo intval($performance->get_id()) ?>">
            <div class="hidden alert alert-danger text-left"  id="error_message">

            </div>
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

    $('#form_type-form').on('submit', function (e) {
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


//    $('#input-type-form').on('submit', function (e) {
//        e.preventDefault();
//
//        var $ajaxProp = {
//            type: "POST",
//            url: $(this).attr('action'),
//            data: $(this).serializeArray(),
//            dataType: 'JSON'
//        };
//
//        $.ajax($ajaxProp).done(function (msg) {
//            if (msg.success) {
//                window.location.reload();
//            } else {
//                $('#error_message').html(msg.html).removeClass('hidden');
//            }
//        });
//    });

</script>
