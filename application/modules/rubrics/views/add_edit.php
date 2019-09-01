<?php
/** @var Orm_Rb_Rubrics $rubric */
/** @var Orm_Rb_Rubrics $orm_rubric */
/** @var Orm_Rb_Scale $all_scales */
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/rubrics/add_edit/" . $rubric->get_id(), ['id' => 'rubrics-form', 'method' => 'post']); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo ($rubric->get_id() ? lang('Edit') : lang('Add')) . ' ' . lang('Rubrics'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <input name="name_ar" type="text" class="form-control"
                           value="<?php echo htmlfilter($rubric->get_name_ar()); ?>"/>
                    <?php echo Validator::get_html_error_message('name_ar'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="name_en"> <?php echo lang('Name'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <input name="name_en" type="text" class="form-control"
                           value="<?php echo htmlfilter($rubric->get_name_en()); ?>"/>
                    <?php echo Validator::get_html_error_message('name_en'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label" for="desc_ar"> <?php echo lang('Description'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <textarea name="desc_en" type="text"
                              class="form-control"><?php echo htmlfilter($rubric->get_desc_ar()); ?></textarea>
                    <?php echo Validator::get_html_error_message('desc_ar'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label" for="desc_en"> <?php echo lang('Description'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <textarea name="desc_ar" type="text"
                              class="form-control"><?php echo htmlfilter($rubric->get_desc_en()); ?></textarea>
                    <?php echo Validator::get_html_error_message('desc_en'); ?>
                </div>
                <?php if (!$rubric->get_id()): ?>
                    <div class="form-group">
                        <label class="control-label" for="scale_count"> <?php echo lang('Number of scales'); ?></label>
                        <input name="scale_count" type="text" class="form-control number"
                               value="<?php echo count($rubric->get_scales()) ?: Orm_Rb_Settings::get_value('scale_count'); ?>"/>
                        <?php echo Validator::get_html_error_message('scale_count'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label"> <?php echo lang('Weight Type'); ?>: </label>
                            </div>
                            <div class="col-md-offset-1 col-md-4">
                                <input type="radio" class="px" value="<?php echo Orm_Rb_Rubrics::WEIGHT_TYPE_POINTS ?>"
                                       name="weight_type" <?php echo $rubric->get_weight_type() == Orm_Rb_Rubrics::WEIGHT_TYPE_POINTS || $rubric->get_weight_type() == 0 ? "checked" : ""; ?>/> <?php echo lang('Points') ?>
                            </div>
                            <div class="col-md-5">
                                <input type="radio" class="px"
                                       value="<?php echo Orm_Rb_Rubrics::WEIGHT_TYPE_PERCENTAGE ?>"
                                       name="weight_type" <?php echo $rubric->get_weight_type() == Orm_Rb_Rubrics::WEIGHT_TYPE_PERCENTAGE ? "checked" : ""; ?>/> <?php echo lang('Percentage') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label"> <?php echo lang('Type'); ?>: </label>
                            </div>
                            <div class="col-md-offset-1 col-md-4">
                                <input type="radio" class="px"
                                       value="<?php echo Orm_Rb_Rubrics::RUBRIC_TYPE_SUMMATIVE ?>"
                                       name="rubric_type" <?php echo $rubric->get_rubric_type() == Orm_Rb_Rubrics::RUBRIC_TYPE_SUMMATIVE || $rubric->get_rubric_type() == 0 ? "checked" : ""; ?>/> <?php echo Orm_Rb_Rubrics::get_type(Orm_Rb_Rubrics::RUBRIC_TYPE_SUMMATIVE) ?>
                            </div>
                            <div class="col-md-5">
                                <input type="radio" class="px"
                                       value="<?php echo Orm_Rb_Rubrics::RUBRIC_TYPE_FORMATIVE ?>"
                                       name="rubric_type" <?php echo $rubric->get_rubric_type() == Orm_Rb_Rubrics::RUBRIC_TYPE_FORMATIVE ? "checked" : ""; ?>/> <?php echo Orm_Rb_Rubrics::get_type(Orm_Rb_Rubrics::RUBRIC_TYPE_FORMATIVE) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"
                               for="rubric_class"> <?php echo lang('Rubric Classification'); ?></label>
                        <select class="form-control" name="rubric_class" id="rubric_class">
                            <option value=""><?php echo lang('Select Class') ?></option>
                            <?php foreach (Orm_Rb_Rubrics::get_classes() as $class): ?>
                                <option value="<?php echo $class ?>" <?php if ($class == $rubric->get_rubric_class()) {
                                    echo 'selected=""';
                                } ?>><?php echo lang($class) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo Validator::get_html_error_message('rubric_class'); ?>
                    </div>
                    <div id="properties"><?php
                        $orm_rubric = Orm_Rb_Rubrics::class;
                        if (class_exists($rubric->get_rubric_class()) && in_array($rubric->get_rubric_class(), $rubric::get_classes())) {
                            $orm_rubric = $rubric->get_rubric_class();
                        }
                        echo $orm_rubric::get_properties(Validator::get_html_error_message('extra_value'), $this->input->get_post('extra_value'));
                        ?></div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
                </button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $('#datepicker-range').datepicker();

    $('.number').keypress(function (e) {

        var key = e.charCode || e.which;
        var char = String.fromCharCode(key);
        if (!(/[\d]/).test(char)) {
            e.preventDefault();
            return false;
        }
    });

    $('#rubric_class').change(function () {
        $.ajax({
            type: "POST",
            url: '/rubrics/get_properties',
            data: {'class': $(this).val()}
        }).success(function (msg) {
            $('#properties').html(msg);
        });
    });

    $('#rubrics-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });

        return false;
    });


</script>

