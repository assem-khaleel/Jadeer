<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 09/04/17
 * Time: 09:05 ص
 */
/* @var  $form Orm_Fp_Forms  */
/* @var  $inputs Orm_Fp_Forms_Inputs  */
/* $type */

?>

<div class="modal-dialog modal-lg" id="ajaxModalDialog">
    <div class="modal-content">
        <?php echo form_open("/faculty_performance/faculty_settings/add_edit_form/{$type}/{$form->get_id()}", array('id' => 'input_type-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo $form->get_id()? lang('Edit').' '.lang('Form') : lang('Add').' '.lang('Form'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="form_name_en"><?php echo lang('Form Name') . ' ( ' . lang('English').' ) ' ?></label>
                        <div class="col-sm-9">
                            <input type="text" id="form_name_en" name="form_name_en" class="form-control"
                                   value="<?php echo $form->get_form_name_en() ? htmlfilter($form->get_form_name_en()):'' ?>">
                            <?php echo Validator::get_html_error_message('form_name_en'); ?>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="form_name_ar"><?php echo lang('Form Name') . ' ( ' . lang('Arabic').' ) ' ?></label>
                        <div class="col-sm-9">
                            <input type="text" id="form_name_ar" name="form_name_ar" class="form-control"
                                   value="<?php echo $form->get_form_name_ar() ? htmlfilter($form->get_form_name_ar()):'' ?>">
                            <?php echo Validator::get_html_error_message('form_name_ar'); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-primary">
                            <div class="table-header">
                                <span class="table-caption"><?php echo lang('Form Input'); ?></span>
                                <div class="panel-heading-controls col-sm-4">
                                    <button class="btn  btn-xs  pull-right" onclick="add_more_input();" type="button"><span class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add'); ?></button>
                                </div>
                            </div>
                            <table class="table table-bordered" >
                                <thead>
                                <tr>
                                    <th class="col-md-5"><?php echo lang('Input Label').'('.lang('English').')'?> </th>
                                    <th class="col-md-5"><?php echo lang('Input Label').'('.lang('Arabic').')'?></th>
                                    <th class="col-md-2 text-center"><?php echo lang('Actions'); ?></th>
                                </tr>
                                </thead>
                                <tbody id="more_input">
                                <?php if ($inputs) { ?>
                                    <?php foreach ($inputs as $key => $input) { ?>
                                        <tr class="item">
                                            <td>
                                                <div class="form-group m-a-0-vr">
                                                    <input type="text" id="input_label_en" name="inputs[<?php echo intval($key); ?>][input_label_en]" class="form-control" value="<?php echo htmlfilter(isset($input['input_label_en']) ? $input['input_label_en'] : ''); ?>">
                                                    <?php echo Validator::get_html_error_message('required_input_label_en_'.$key); ?>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="form-group m-a-0-vr">
                                                    <input type="text" id="input_label_ar" name="inputs[<?php echo intval($key); ?>][input_label_ar]" class="form-control" value="<?php echo htmlfilter(isset($input['input_label_ar']) ? $input['input_label_ar'] : ''); ?>">
                                                    <?php echo Validator::get_html_error_message('required_input_label_ar_'.$key); ?>
                                                </div>

                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="inputs[<?php echo intval($key); ?>][id]" class="form-control" value="<?php echo intval(isset($input['id']) ? $input['id'] : 0); ?>">
                                                <a class="btn btn-sm" onclick="remove_option_input(this);">
                                                    <span><i class="fa fa-trash"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                            <div class="form-group m-a-0">
                                <?php echo Validator::get_html_error_message('inputs'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="form_id" value="<?php echo intval($form->get_id()) ?>">
            <input type="hidden" name="type" value="<?php echo intval($type) ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script type="text/javascript">

    init_data_toggle();

    $('#input_type-form').on('submit', function (e) {
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

    function add_more_input() {
        var key = new Date().getTime();
        $('#more_input').append('<tr class="item">' +
            '<td>' +
            '<input type="text" id="input_label_en" name="inputs['+ key +'][input_label_en]" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" id="input_label_ar" name="inputs['+ key +'][input_label_ar]" class="form-control">' +
            '</td>' +
            '<td class="text-center">' +
            '<input type="hidden" name="inputs[' + key + '][id]" class="form-control" >' +
            '<a class="btn btn-sm" onclick="remove_option_input(this);">' +
            '<span class=""><i class="fa fa-trash-o"></i></span>' +
            '</a>' +
            '</td>' +
            '</tr>');
        rename_input();
    }
    function remove_option_input(element) {
        $(element).parents('.item').remove();
        rename_input();
    }
    function rename_input() {
        $('#more_input').find('input[name], select[name], textarea[name]').each(function () {
            var map = get_map_input($(this).parents('.item').get(0)).reverse();
            var old_name = $(this).attr('name');
            var new_name = get_field_name_input(old_name, map);
            $(this).attr('name', new_name);
        });
    }
    function get_map_input(item_element, map) {
        if (!map) {
            map = [];
        }
        map.push($(item_element).parent().children('.item').index(item_element));
        var parent_item = $(item_element).parents('.item');
        if ($(parent_item).length) {
            return get_map_input(parent_item, map);
        } else {
            return map;
        }
    }
    function get_field_name_input(name, map, parent_name, index, field_name) {
        if (!index) {
            index = 0;
        }
        if (!field_name) {
            field_name = '';
        }
        var patt = new RegExp(/\[\d+\]/);
        if (parent_name) {
            name = name.replace(parent_name, '');
            name = name.replace(patt, '');
        }
        parent_name = name.substr(0, name.indexOf(name.match(patt)));
        if (patt.test(name)) {
            field_name += parent_name + '[' + map[index] + ']';
            index++;
            return get_field_name_input(name, map, parent_name, index, field_name);
        } else {
            field_name += name;
            return field_name;
        }
    }

</script>
