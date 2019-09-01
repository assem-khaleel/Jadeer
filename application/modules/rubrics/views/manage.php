<?php
/** @var Orm_Rb_Rubrics $rubric */

/** @var Orm_Rb_Skills[] $new_skills */
/** @var Orm_Rb_Table[] $new_scales */

/** @var Orm_Rb_Skills[] $current_skills */
/** @var Orm_Rb_Table[] $current_scales */

$scales = $rubric->get_scales();
$scales_id = [];
foreach ($scales as $scale) {
    $scales_id[] = $scale->get_id();
}

?>

<div class="col-md-3 col-lg-3">
    <div class="well">
        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <label style="height: auto !important;" class="form-control"><?php echo htmlfilter($rubric->get_name_ar()); ?>
            </label>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <label style="height: auto !important;" class="form-control"><?php echo htmlfilter($rubric->get_name_en()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_en"> <?php echo lang('Description'); ?>
                (<?php echo lang('Arabic'); ?>)</label>
            <label style="height: auto !important;" class="form-control"><?php echo htmlfilter($rubric->get_desc_ar()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_ar"> <?php echo lang('Description'); ?>
                (<?php echo lang('English'); ?>)</label>
            <label style="height: auto !important;" class="form-control"><?php echo htmlfilter($rubric->get_desc_en()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_ar"> <?php echo lang('Classification'); ?> </label>
            <label style="height: auto !important;" class="form-control"><?php echo lang($rubric->get_rubric_class()); ?></label>
        </div>
        <?php echo $rubric->draw(); ?>

    </div>
</div>
<?php echo form_open('/rubrics/manage/' . $rubric->get_id(), ['method' => 'post', 'id' => 'skill_id']); ?>
<div class="col-md-9 col-lg-9">
    <div class="table-primary">
        <div class="table-header">
            <div class="table-caption ">
                <?php echo lang('Rubrics'); ?>
                <tfoot>
                <tr>
                    <td colspan="<?php echo count($scales) + 1; ?>">
                        <a class="btn btn-sm pull-right" href="javascript:void(0);" id="add_skill">
                            <span class="btn-label-icon left"><i
                                        class="fa fa-plus"></i></span> <?php echo lang('Add').''. lang('Skill') ?> </a>
                    </td>
                </tr>
                </tfoot>

            </div>
        </div>
    </div>
    <table class="table" id="skill_tab">
        <thead>
        <?php if ($msg = Validator::get_error_message('skills_weight')): ?>
            <tr>
                <td colspan="<?php echo count($scales) + 1 ?>" class="bg-danger"><?php echo $msg ?>
            </tr>
        <?php endif; ?>
        <tr>
            <td><?php echo lang('Skills'); ?>/<?php echo lang('Scale'); ?></td>
            <?php
            foreach ($scales as $scale) {
                echo "<td>" . $scale->get_name() . "</td>";
            }
            ?>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($current_skills as $key_skill => $current_skill): ?>
            <tr>
                <td>
                    <span style="line-height: 32px;"></span><br>
                    <div class="form-group">
                        <label class="control-label m-t-1"
                               for="current_skill_<?php echo $current_skill->get_id(); ?>_ar"><?php echo lang('Skill') . ' (' . lang('Arabic') . ')'; ?></label>
                        <textarea class="form-control" id="current_skill_<?php echo $current_skill->get_id(); ?>_ar"
                                  name="current_skill[<?php echo $current_skill->get_id(); ?>][ar]"><?php echo htmlfilter($current_skill->get_name_ar()) ?></textarea>
                        <?php echo Validator::get_html_error_message('current_skill_ar', $current_skill->get_id()); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"
                               for="current_skill_<?php echo $current_skill->get_id(); ?>_en"><?php echo lang('Skill') . ' (' . lang('English') . ')'; ?></label>
                        <textarea class="form-control" id="current_skill_<?php echo $current_skill->get_id(); ?>_en"
                                  name="current_skill[<?php echo $current_skill->get_id(); ?>][en]"><?php echo htmlfilter($current_skill->get_name_en()) ?></textarea>
                        <?php echo Validator::get_html_error_message('current_skill_en', $current_skill->get_id()); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"
                               for="current_skill_<?php echo $current_skill->get_id(); ?>_value"><?php echo lang('Value'); ?></label>
                        <input class="form-control number text-center"
                               id="current_skill_<?php echo $current_skill->get_id(); ?>_value"
                               name="current_skill[<?php echo $current_skill->get_id(); ?>][value]"
                               value="<?php echo intval($current_skill->get_value()) ?>">
                        <?php echo Validator::get_html_error_message('current_skill_value', $current_skill->get_id()); ?>
                    </div>
                    <span style="line-height: 32px;">
                    <a class="btn btn-sm btn-danger delete-row" href="javascript:void(0);">
                        <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('delete') ?></a>
                </span><br>

                </td>


                <?php foreach ($scales as $scale): ?>
                    <?php
                    $key_scale = $scale->get_id();

                    $current_scale = isset($current_scales[$current_skill->get_id()]) ? $current_scales[$current_skill->get_id()] : [];
                    $current_scale = isset($current_scale[$scale->get_id()]) ? $current_scale[$scale->get_id()] : new Orm_Rb_Table();
                    ?>
                    <td>
                        <span style="line-height: 32px;"></span><br>
                        <div class="form-group">
                            <label class="control-label m-t-1"
                                   for="current_scale_<?php echo $current_skill->get_id(); ?>_<?php echo $key_scale; ?>_desc_ar"><?php echo lang('Description') . ' (' . lang('Arabic') . ')'; ?></label>
                            <textarea class="form-control"
                                      id="current_scale_<?php echo $current_skill->get_id(); ?>_<?php echo $key_scale; ?>_desc_ar"
                                      name="current_skill[<?php echo $current_skill->get_id(); ?>][scales][<?php echo $key_scale; ?>][desc_ar]"><?php echo htmlfilter($current_scale->get_description_ar()) ?></textarea>
                            <?php echo Validator::get_html_error_message('current_desc_ar_' . $current_skill->get_id(), $key_scale); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"
                                   for="current_scale_<?php echo $current_skill->get_id(); ?>_<?php echo $key_scale; ?>_desc_en"><?php echo lang('Description') . ' (' . lang('English') . ')'; ?></label>
                            <textarea class="form-control"
                                      id="current_scale_<?php echo $current_skill->get_id(); ?>_<?php echo $key_scale; ?>_desc_en"
                                      name="current_skill[<?php echo $current_skill->get_id(); ?>][scales][<?php echo $key_scale; ?>][desc_en]"><?php echo htmlfilter($current_scale->get_description_en()) ?></textarea>
                            <?php echo Validator::get_html_error_message('current_desc_en_' . $current_skill->get_id(), $key_scale); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"
                                   for="current_scale_<?php echo $current_skill->get_id(); ?>_<?php echo $key_scale; ?>_target_en"><?php echo lang('Target'); ?></label>
                            <input class="form-control number text-center"
                                   id="current_scale_<?php echo $current_skill->get_id(); ?>_<?php echo $key_scale; ?>_target_en"
                                   name="current_skill[<?php echo $current_skill->get_id(); ?>][scales][<?php echo $key_scale; ?>][target]"
                                   value="<?php echo intval($current_scale->get_target()) ?>">
                            <?php echo Validator::get_html_error_message('current_target_' . $current_skill->get_id(), $key_scale); ?>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>


        <?php foreach ($new_skills as $key_skill => $new_skill): ?>
            <tr class="new">
                <td>
                    <span style="line-height: 32px;"></span><br>
                    <div class="form-group">
                        <label class="control-label m-t-1"
                               for="new_skill_<?php echo $key_skill; ?>_ar"><?php echo lang('Skill') . ' (' . lang('Arabic') . ')'; ?></label>
                        <textarea class="form-control" id="new_skill_<?php echo $key_skill; ?>_ar"
                                  name="new_skill[<?php echo $key_skill; ?>][ar]"><?php echo htmlfilter($new_skill->get_name_ar()) ?></textarea>
                        <?php echo Validator::get_html_error_message('skill_ar', $key_skill); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"
                               for="new_skill_<?php echo $key_skill; ?>_en"><?php echo lang('Skill') . ' (' . lang('English') . ')'; ?></label>
                        <textarea class="form-control" id="new_skill_<?php echo $key_skill; ?>_en"
                                  name="new_skill[<?php echo $key_skill; ?>][en]"><?php echo htmlfilter($new_skill->get_name_en()) ?></textarea>
                        <?php echo Validator::get_html_error_message('skill_en', $key_skill); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"
                               for="new_skill_<?php echo $key_skill; ?>_value"><?php echo lang('Value'); ?></label>
                        <input class="form-control number text-center" id="new_skill_<?php echo $key_skill; ?>_value"
                               name="new_skill[<?php echo $key_skill; ?>][value]"
                               value="<?php echo intval($new_skill->get_value()) ?>">
                        <?php echo Validator::get_html_error_message('skill_value', $key_skill); ?>
                    </div>
                    <span style="line-height: 32px;">
                    <a class="btn btn-sm btn-danger delete-row" href="javascript:void(0);">
                        <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('delete') ?></a>
                </span><br>

                </td>

                <?php foreach ($new_scales[$key_skill] as $key_scale => $new_scale): ?>
                    <td>
                        <span style="line-height: 32px;"></span><br>
                        <div class="form-group">
                            <label class="control-label m-t-1"
                                   for="new_scale_<?php echo $key_skill; ?>_<?php echo $key_scale; ?>_desc_ar"><?php echo lang('Description') . ' (' . lang('Arabic') . ')'; ?></label>
                            <textarea class="form-control"
                                      id="new_scale_<?php echo $key_skill; ?>_<?php echo $key_scale; ?>_desc_ar"
                                      name="new_skill[<?php echo $key_skill; ?>][scales][<?php echo $key_scale; ?>][desc_ar]"><?php echo htmlfilter($new_scale->get_description_ar()) ?></textarea>
                            <?php echo Validator::get_html_error_message('desc_ar_' . $key_skill, $key_scale); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"
                                   for="new_scale_<?php echo $key_skill; ?>_<?php echo $key_scale; ?>_desc_en"><?php echo lang('Description') . ' (' . lang('English') . ')'; ?></label>
                            <textarea class="form-control"
                                      id="new_scale_<?php echo $key_skill; ?>_<?php echo $key_scale; ?>_desc_en"
                                      name="new_skill[<?php echo $key_skill; ?>][scales][<?php echo $key_scale; ?>][desc_en]"><?php echo htmlfilter($new_scale->get_description_en()) ?></textarea>
                            <?php echo Validator::get_html_error_message('desc_en_' . $key_skill, $key_scale); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"
                                   for="new_scale_<?php echo $key_skill; ?>_<?php echo $key_scale; ?>_target_en"><?php echo lang('Target'); ?></label>
                            <input class="form-control number text-center"
                                   id="new_scale_<?php echo $key_skill; ?>_<?php echo $key_scale; ?>_target_en"
                                   name="new_skill[<?php echo $key_skill; ?>][scales][<?php echo $key_scale; ?>][target]"
                                   value="<?php echo intval($new_scale->get_target()) ?>">
                            <?php echo Validator::get_html_error_message('target_' . $key_skill, $key_scale); ?>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
    <div class="alert alert-warning" id="alert" style="display:none"></div>
    <div class="panel-heading-controls col-sm-4">
        <button class="btn btn-sm pull-right" type="submit">
            <span class="btn-label-icon left"><i class="fa fa-save"></i></span> <?php echo lang('Save') ?> </button>
    </div>
</div>
<?php echo form_close() ?>

<script>

    $(document).on('keypress', '.number', function (e) {

        var key = e.charCode || e.which;
        var char = String.fromCharCode(key);
        if (!(/[\d]/).test(char)) {
            e.preventDefault();
            return false;
        }
    });

    $(document).on('click', '.delete-row', function (e) {
        if ($(this).parent().parent().parent().parent().find('tr').length > 1)
            $(this).parent().parent().parent().remove();
        else {
            $("#alert").css({"display": "block"}).html("Must contain at least one skill");
        }
    });

    $('#add_skill').click(function () {

        var arabic_label = '<?php echo lang('Arabic') ?>';
        var english_label = '<?php echo lang('English') ?>';

        var skill_label = '<?php echo lang('Skill') ?>';
        var description_label = '<?php echo lang('Description') ?>';

        var value_label = '<?php echo lang('Value') ?>';
        var target_label = '<?php echo lang('Target') ?>';

        var delete_label = '<?php echo lang('Delete') ?>';

        var scales_count = [<?php echo implode(',', $scales_id) ?>];

        var count_line = $('#skill_tab').find('tbody tr.new').length;
        var row = $('<tr>')
            .addClass('new')
            .append(function () {
                var cells = [];
                cells.push(
                    $('<td>')

                        .append($('<span style="line-height: 32px;"></span>'))
                        .append($('<br>'))
                        .append($('<label>').addClass('control-label m-t-1').attr('for', 'new_skill_' + count_line + '_ar').text(skill_label + ' (' + arabic_label + ')'))
                        .append($('<textarea>').addClass('form-control').attr('id', 'new_skill_' + count_line + '_ar').attr('name', 'new_skill[' + count_line + '][ar]'))
                        .append($('<label>').addClass('control-label').attr('for', 'new_skill_' + count_line + '_en').text(skill_label + ' (' + english_label + ')'))
                        .append($('<textarea>').addClass('form-control').attr('id', 'new_skill_' + count_line + '_en').attr('name', 'new_skill[' + count_line + '][en]'))
                        .append($('<label>').addClass('control-label').attr('for', 'new_skill_' + count_line + '_value').text(value_label))
                        .append($('<input>').addClass('form-control number text-center').attr('id', 'new_skill_' + count_line + '_value').attr('name', 'new_skill[' + count_line + '][value]'))
                        .append($('<br>'))
                        .append(
                            $('<span>')
                                .css('line-height', '32px')
                                .append(
                                    $('<a>').addClass('btn btn-sm btn-danger delete-row').attr('href', 'javascript:void(0);')
                                        .append('<span class="btn-label-icon left"><i class="fa fa-times"></i></span>')
                                        .append(delete_label)
                                )
                        )
                );

                for (var i = 0; scales_count[i]; i++) {
                    cells.push(
                        $('<td>')
                            .append($('<span>').css('line-height', '32px'))
                            .append($('<br>'))

                            .append($('<label>').addClass('control-label m-t-1').attr('for', 'new_scale_' + count_line + '_desc_ar').text(description_label + ' (' + arabic_label + ')'))
                            .append($('<textarea>').addClass('form-control').attr('id', 'new_scale_' + count_line + '_desc_ar').attr('name', 'new_skill[' + count_line + '][scales][' + scales_count[i] + '][desc_ar]'))
                            .append($('<label>').addClass('control-label').attr('for', 'new_scale_' + count_line + '_desc_en').text(description_label + ' (' + english_label + ')'))
                            .append($('<textarea>').addClass('form-control').attr('id', 'new_scale_' + count_line + '_desc_en').attr('name', 'new_skill[' + count_line + '][scales][' + scales_count[i] + '][desc_en]'))

                            .append($('<label>').addClass('control-label').attr('for', 'new_scale_' + count_line + '_target_en').text(target_label))
                            .append($('<input>').addClass('form-control number text-center').attr('id', 'new_scale_' + count_line + '_target_en').attr('name', 'new_skill[' + count_line + '][scales][' + scales_count[i] + '][target]'))
                    );
                }

                return cells;

            });

        $('#skill_tab').find('tbody').append(row);

    });
</script>
