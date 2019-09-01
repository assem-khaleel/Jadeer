<?php
/**
 * User: OMAR
 * Date: 4/17/17
 * Time: 06:31 PM
 */
/** @var Orm_Cm_Learning_Domain $domain */
/** @var array $outcomes */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/portfolio_course/forms/add_edit_custom_menu/$level/{$category_obj->get_id()}?id={$course_id}", array('id' => 'domain-form','method' => 'post')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Custom Items'); ?></span>
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <label for="title_en" class="col-md-2 control-label"><?php echo lang('Title'); ?> (<?php echo lang('English'); ?>):</label>
                <div class="col-md-10">
                    <input type="text" name="title_en" id="title_en" class="form-control" value="<?php echo htmlfilter($category_obj->get_title_en()); ?>">
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
            </div>
            <div class="row form-group">
                <label for="title_ar" class="col-md-2 control-label"><?php echo lang('Title'); ?> (<?php echo lang('Arabic'); ?>):</label>
                <div class="col-md-10">
                    <input type="text" name="title_ar" id="title_ar" class="form-control" value="<?php echo htmlfilter($category_obj->get_title_ar()); ?>">
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>
            </div>
            <div class="row form-group">
                <label for="desc_en" class="col-md-2 control-label"><?php echo lang('Description'); ?> (<?php echo lang('English'); ?>):</label>
                <div class="col-md-10">
                    <input type="text" name="desc_en" id="desc_en" class="form-control" value="<?php echo htmlfilter($category_obj->get_description_en()); ?>">
                    <?php echo Validator::get_html_error_message('description_en'); ?>
                </div>
            </div>
            <div class="row form-group">
                <label for="desc_ar" class="col-md-2 control-label"><?php echo lang('Description'); ?> (<?php echo lang('Arabic'); ?>):</label>
                <div class="col-md-10">
                    <input type="text" name="desc_ar" id="desc_ar" class="form-control" value="<?php echo htmlfilter($category_obj->get_description_ar()); ?>">
                    <?php echo Validator::get_html_error_message('description_ar'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-primary">
                        <div class="table-header">
                            <span class="table-caption"><?php echo lang('Syllabus Fields'); ?></span>
                            <div class="panel-heading-controls col-sm-4">
                                <button class="btn  btn-xs  pull-right" onclick="add_more_learning_outcome();" type="button"><span class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add'); ?></button>
                            </div>
                        </div>
                        <table class="table table-bordered" >

                            <thead>
                            <tr>
                                <th class="col-md-3"><?php echo lang('Label'); ?> (<?php echo lang('English'); ?>)</th>
                                <th class="col-md-3"><?php echo lang('Label'); ?> (<?php echo lang('Arabic'); ?>)</th>
                                <th class="col-md-2"><?php echo lang('Type'); ?> </th>
                                <th class="col-md-1"><?php echo lang('Required'); ?></th>
                                <th class="col-md-1"><?php echo lang('Display'); ?></th>
                                <th class="col-md-2 text-center"><?php echo lang('Actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody id="more_learning_outcome">
                            <?php if (isset($field_obj) && !empty($field_obj)) { ?>
                                <?php foreach ($field_obj as $key => $custom_field) {?>
                                    <tr class="item">
                                        <td>
                                            <input name="custom[<?php echo intval($key); ?>][title_en]" class="form-control" type="text" value="<?php echo htmlfilter(($custom_field->get_title_en()) ? $custom_field->get_title_en() : ''); ?>">
                                        </td>
                                        <td>
                                            <input name="custom[<?php echo intval($key); ?>][title_ar]" class="form-control" type="text" value="<?php echo htmlfilter(($custom_field->get_title_ar()) ? $custom_field->get_title_ar() : ''); ?>">
                                        </td>
                                        <td>
                                        <select name="custom[<?php echo intval($key); ?>][type]" id="custom[<?php echo intval($key); ?>][type]" class="form-control" onchange="check_dd(<?php echo $key?>);">
                                              <option value="text" <?php echo $custom_field->get_field_type() == 'text' ? 'selected' : ''; ?>><?php echo lang('Text');?></option>
                                              <option value="richtext" <?php echo $custom_field->get_field_type() == 'richtext'? 'selected' : ''; ?>><?php echo lang('Rich Text')?></option>
                                              <option value="date" <?php echo $custom_field->get_field_type() == 'date'? 'selected' : ''; ?>><?php echo lang('Date')?></option>
                                              <option value="radio" <?php echo $custom_field->get_field_type() == 'radio'? 'selected' : ''; ?>><?php echo lang('Yes / No') ?></option>
                                              <option value="file" <?php echo $custom_field->get_field_type() == 'file'? 'selected' : ''; ?>><?php echo lang('File Upload')?></option>
                                              <option value="checkbox" <?php echo $custom_field->get_field_type() == 'checkbox'? 'selected' : ''; ?>><?php echo lang('Checkbox')?></option>
                                        </select>
                                        <?php //echo Validator::get_html_error_message('ncaaa_code'); ?>
                                        </td>
                                        <td>
                                            <input  type="checkbox" name="custom[<?php echo intval($key); ?>][required]" class="form-control" <?php echo $custom_field->get_required() && $custom_field->get_required()=='1' ? 'checked': ''; ?>>
                                        </td>
                                        <td>
                                            <input  type="checkbox" name="custom[<?php echo intval($key); ?>][display]" class="form-control" <?php echo $custom_field->get_display() && $custom_field->get_display()=='1' ? 'checked' : ''; ?>>
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="custom[<?php echo intval($key); ?>][id]" class="form-control" value="<?php echo intval($custom_field->get_id() ? $custom_field->get_id() : 0); ?>">
                                            <a name="<?php echo $key?>" class="btn btn-sm" onclick="remove_option_learning_outcome(this);">
                                                <span class="btn-label-icon left"><i class="fa fa-trash"></i></span><?php echo lang('Delete'); ?>
                                            </a>
                                        </td>
                                    </tr>
                                    </tr>
                                    <?php if($custom_field->get_field_type() == 'checkbox'){ $checkboxes=$custom_field->get_value(); }?>
                                    <tr id="checkbox<?php echo $key?>" style="<?php echo isset($checkboxes) ? 'display:table-row;' : 'display:none;' ?>">
                                    <td colspan="6">
                                        <span><?php echo lang('Please Add your options Separated by comma') ?></span>
                                        <textarea placeholder="<?php echo lang('Please Add your options Separated by comma') ?>" name="custom[<?php echo $key?>][checkboxvalue]" class="form-control" ><?php echo isset($checkboxes) ? $checkboxes : '' ?></textarea>
                                    </td>
                                    <?php echo Validator::get_html_error_message("custom[$key][checkboxvalue]"); ?>
                                    </tr>
                                <?php unset($checkboxes);} ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="form-group m-a-0">
                            <span class="checkbox hidden"></span>
                            <?php echo Validator::get_html_error_message('custom'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    init_data_toggle();

    $('#domain-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    function add_more_learning_outcome() {
        var key = new Date().getTime();
        $('#more_learning_outcome').append('<tr class="item">' +
            '<td>' +
            '<input type="text" name="custom[' + key + '][title_en]" class="form-control" >' +
            '</td>' +
            '<td>' +
            '<input type="text" name="custom[' + key + '][title_ar]" class="form-control" >' +
            '</td>' +
            '<td>' +
            '<select name="custom[' + key + '][type]" id="custom[' + key + '][type]" class="form-control" onchange="check_dd('+ key +');">'+
            '<option value="text" "selected"><?php echo lang('Text')?></option>'+
            '<option value="richtext"><?php echo lang('Rich Text')?></option>'+
            '<option value="date"><?php echo lang('Date')?></option>'+
            '<option value="radio"><?php echo lang('Yes / No')?></option>'+
            '<option value="file"><?php echo lang('File Upload')?></option>'+
            '<option value="checkbox"><?php echo lang('Checkbox')?></option>'+
            '</select>'+
            '</td>' +
            '<td>'+
            '<input type="checkbox" name="custom[' + key + '][required]" class="form-control" >'+
            '</td>'+
            '<td>'+
            '<input type="checkbox" name="custom[' + key + '][display]" class="form-control" >'+
            '</td>'+
            '<td class="text-center">' +
            '<input type="hidden" name="custom[' + key + '][id]" class="form-control" >' +
            '<a name="'+key+'" class="btn btn-sm" onclick="remove_option_learning_outcome(this);">' +
            '<span class="btn-label-icon left"><i class="fa fa-trash-o"></i></span><?php echo lang('Delete') ?>' +
            '</a>' +
            '</td>' +
            '</tr>'+
            '<tr id="checkbox' + key + '" style="display:none;">'+
            '<td colspan="6">'+
            '<span><?php echo lang('Please Add your options Separated by comma') ?></span>'+
            '<textarea id="checkbox' + key + '" placeholder="<?php echo lang('Please Add your options Separated by comma') ?>" name="custom[' + key + '][checkboxvalue]" class="form-control" ></textarea>'+
            '</td>'+
            '</tr>'
            );

        //rename_learning_outcome();
    }
    function remove_option_learning_outcome(element) {
        $(element).parents('.item').remove();
        document.getElementById("checkbox"+ element.getAttribute("name")).remove();
        //rename_learning_outcome();
    }
    function rename_learning_outcome() {
        $('#more_learning_outcome').find('input[name], select[name], textarea[name]').each(function () {
            var map = get_map_learning_outcome($(this).parents('.item').get(0)).reverse();
            var old_name = $(this).attr('name');
            var new_name = get_field_name_learning_outcome(old_name, map);
            $(this).attr('name', new_name);
        });
    }
    function get_map_learning_outcome(item_element, map) {
        if (!map) {
            map = [];
        }
        map.push($(item_element).parent().children('.item').index(item_element));
        var parent_item = $(item_element).parents('.item');
        if ($(parent_item).length) {
            return get_map_learning_outcome(parent_item, map);
        } else {
            return map;
        }
    }
    function get_field_name_learning_outcome(name, map, parent_name, index, field_name) {
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
            return get_field_name_learning_outcome(name, map, parent_name, index, field_name);
        } else {
            field_name += name;
            return field_name;
        }
    }


function check_dd(key) {
    if(document.getElementById('custom['+ key + '][type]').value == "checkbox") {
        document.getElementById('checkbox' + key).style.display = 'table-row';
    } else {
        document.getElementById('checkbox' + key).style.display = 'none';
    }
}
</script>