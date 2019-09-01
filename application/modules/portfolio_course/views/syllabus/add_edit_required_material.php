<?php
/** @var $material_obj Orm_Pc_Material */
?>

<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">
                <?php echo  $material_obj->get_id() ? lang('Edit').' '.lang('Required Materials'): lang('Add').' '.lang('Required Materials')?>
            </h4>
        </div>
        <?php echo form_open("/portfolio_course/syllabus/edit/{$level}/{$material_obj->get_id()}?id={$course_id}", ['method' => 'post', "class" => 'inline-form', "id" => "addEditMaterial", 'en']) ?>
        <div class="padding-sm-hr">
            <div class="modal-body">
                <div class="row form-group">
                    <label for="title_en" class="control-label"><?php echo lang('Material Title') ?> (<?php echo lang('English'); ?>):</label>
                    <input type="text" name="title_en" id="editTitle_en" class="form-control"
                           placeholder="<?php echo lang('Material Title') ?> (<?php echo lang('English'); ?>)"
                           value="<?php echo $material_obj->get_title_en(); ?>"/>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label"><?php echo lang('Material Title') ?> (<?php echo lang('Arabic'); ?>):</label>
                    <input type="text" name="title_ar" id="editTitle_ar" class="form-control"
                           placeholder="<?php echo lang('Material Title') ?> (<?php echo lang('Arabic'); ?>)"
                           value="<?php echo $material_obj->get_title_ar(); ?>"/>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>
                <div class="row form-group">
                    <label for="description_en"
                           class="control-label"><?php echo lang('Material Description') ?> (<?php echo lang('English'); ?>):</label>
                    <input type="text" name="description_en" id="editDesc_en" class="form-control"
                           placeholder="<?php echo lang('Material Description') ?> (<?php echo lang('English'); ?>)"
                           value="<?php echo $material_obj->get_description_en(); ?>"/>
                    <?php echo Validator::get_html_error_message('description_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="description_ar"
                           class="control-label"><?php echo lang('Material Description') ?> (<?php echo lang('Arabic'); ?>):</label>
                    <input type="text" name="description_ar" id="editDesc_ar" class="form-control"
                           placeholder="<?php echo lang('Material Description') ?> (<?php echo lang('Arabic'); ?>)"
                           value="<?php echo $material_obj->get_description_ar(); ?>"/>
                    <?php echo Validator::get_html_error_message('description_ar'); ?>
                </div>
                <div class="row form-group">
                    <label for="material_type" class="control-label"><?php echo lang('Material Type') ?>:</label>
                    <select name="material_type" id="editType" class="form-control">
                        <?php
                        foreach ($materialTypes as $val => $text) {
                            $selected = ($val == $material_obj->get_material_type()) ? 'selected' : '';
                            echo "<option value=" . $val . " $selected >" . lang($text) . "</option>";
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('material_type'); ?>
                </div>
                <div class="row form-group">
                    <label for="author" class="control-label"><?php echo lang('Author') ?>:</label>
                    <input type="text" name="author" id="author" class=" form-control"
                           placeholder="<?php echo lang('Author') ?>"
                           value="<?php echo $material_obj->get_author(); ?>"/>
                    <?php echo Validator::get_html_error_message('author'); ?>
                </div>
                <div class="row form-group">
                    <label for="release_date" class="control-label"><?php echo lang('Release Date') ?>:</label>
                    <input type="text" name="release_date" class="form-control" id="release_date"
                           placeholder="<?php echo lang('Release Date') ?>"
                           value="<?php echo $material_obj->get_release_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($material_obj->get_release_date())); ?>"/>
                    <?php echo Validator::get_html_error_message('release_date'); ?>
                </div>
                <div class="row form-group">
                    <label for="edition" class="control-label"><?php echo lang('Edition') ?>:</label>
                    <input type="text" name="edition" id="edition" class=" form-control"
                           placeholder="<?php echo lang('Edition') ?>"
                           value="<?php echo $material_obj->get_edition(); ?>"/>
                    <?php echo Validator::get_html_error_message('edition'); ?>
                </div>
                <div class="row form-group">
                    <label for="publisher" class="control-label"><?php echo lang('Publisher') ?>:</label>
                    <input type="text" name="publisher" id="publisher" class=" form-control"
                           placeholder="<?php echo lang('Publisher') ?>"
                           value="<?php echo $material_obj->get_publisher(); ?>"/>
                    <?php echo Validator::get_html_error_message('publisher'); ?>
                </div>
                <div class="row form-group">
                    <label for="place" class="control-label"><?php echo lang('Where to find') ?>:</label>
                    <textarea name="place" id="find" class="form-control" placeholder="<?php echo lang('Where to find') ?>"><?php echo htmlfilter($material_obj->get_material_location()); ?></textarea>
                    <?php echo Validator::get_html_error_message('place'); ?>
                </div>
                <div class="modal-footer">
                    <div class=" text-right">
                        <button type="button" class="btn pull-left " data-dismiss="modal"><span
                                class="btn-label-icon left"><i
                                    class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                        <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                                class="btn-label-icon left"><i
                                    class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script>
    $('#addEditMaterial').on('submit', function (e) {
        e.preventDefault();
        var files = $(":file:enabled", this);
        if (files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: $(":file:enabled", this),
                iframe: true,
                dataType: 'JSON'
            }).complete(function (data) {
                handle_response(data.responseJSON);
            });
        } else {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'JSON'
            }).done(function (msg) {
                handle_response(msg);
            });
        }

        function handle_response(msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }
    });


    $('#release_date').datepicker({
        calendarWeeks: true,
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayBtn: 'linked',
        clearBtn: true,
        todayHighlight: true,
        daysOfWeekHighlighted: '1',
        orientation: 'auto right',
        beforeShowMonth: function (date) {
            if (date.getMonth() === 8) {
                return false;
            }
        },
        beforeShowYear: function (date) {
            if (date.getFullYear() === 2014) {
                return false;
            }
        }
    });

</script>