<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 2/24/15
 * Time: 10:58 AM
 */
/** @var Orm_Cm_Learning_Domain $domain */
/** @var array $outcomes */

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('/curriculum_mapping/settings/learning_domain_add_edit/' . intval($domain->get_id()), array('id' => 'domain-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Learning Domain'); ?></span>
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <label for="title_en" class="col-md-2 control-label"><?php echo lang('Title'); ?>
                    (<?php echo lang('English'); ?>):</label>
                <div class="col-md-10">
                    <input type="text" name="title_en" id="title_en" class="form-control"
                           value="<?php echo htmlfilter($domain->get_title_en()); ?>">
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
            </div>
            <div class="row form-group">
                <label for="title_ar" class="col-md-2 control-label"><?php echo lang('Title'); ?>
                    (<?php echo lang('Arabic'); ?>):</label>
                <div class="col-md-10">
                    <input type="text" name="title_ar" id="title_ar" class="form-control"
                           value="<?php echo htmlfilter($domain->get_title_ar()); ?>">
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>
            </div>
            <?php
            if (Orm_Learning_Domain_Type::get_instance($domain->get_type())->get_is_statics() != 1) {

                $filters['is_statics'] = 2;
                ?>
                <div class="row form-group">
                    <label for="type" class="col-md-2 control-label"><?php echo lang('Learning Domain Types'); ?>
                        :</label>
                    <div class="col-md-10">
                        <select name="type" id="type" class="form-control" >
                            <option value="0"> <?php echo lang('Select One') ?></option>
                            <?php foreach (Orm_Learning_Domain_Type::get_all($filters) as $type) { ?>
                                <?php $selected = ($type->get_id() == $domain->get_type() ? 'selected="selected"' : ''); ?>
                                <option value="<?php echo (int)$type->get_id(); ?>" <?php echo $selected; ?> ><?php echo $type->get_name(); ?></option>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message('type'); ?>
                    </div>
                </div>

            <?php } else { ?>
                <div class="row form-group">
                    <label for="type" class="col-md-2 control-label"><?php echo lang('Learning Domain Types'); ?>
                        :</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control"
                               value="<?php echo htmlfilter(Orm_Learning_Domain_Type::get_instance($domain->get_type())->get_name()) ?>"
                               disabled="">
                        <input type="hidden"   name="type" class="form-control" value="<?php echo (int) $domain->get_type() ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <label for="type" class="col-md-2 control-label"><?php echo lang('Learning Domain'); ?>:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?php echo htmlfilter($domain->get_title()) ?>"
                               disabled="">
                        <input type="hidden" name="domain_id"  class="form-control" value="<?php echo (int) $domain->get_id() ?>">
                    </div>
                </div>
            <?php } ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="table-primary">
                        <div class="table-header">
                            <span class="table-caption"><?php echo lang('Learning Outcomes'); ?></span>
                            <div class="panel-heading-controls col-sm-4">
                                <button class="btn  btn-xs  pull-right" onclick="add_more_learning_outcome();"
                                        type="button"><span class="btn-label-icon left"><i
                                                class="fa fa-plus"></i></span><?php echo lang('Add'); ?></button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="col-md-5"><?php echo lang('Title'); ?> (<?php echo lang('English'); ?>)</th>
                                <th class="col-md-5"><?php echo lang('Title'); ?> (<?php echo lang('Arabic'); ?>)</th>
                                <th class="col-md-2 text-center"><?php echo lang('Actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody id="more_learning_outcome">
                            <?php if ($outcomes) { ?>
                                <?php foreach ($outcomes as $key => $outcome) { ?>
                                    <tr class="item">
                                        <td>
                                            <textarea name="outcomes[<?php echo intval($key); ?>][title_en]"
                                                      class="form-control"><?php echo htmlfilter(isset($outcome['title_en']) ? $outcome['title_en'] : ''); ?></textarea>
                                        </td>
                                        <td>
                                            <textarea name="outcomes[<?php echo intval($key); ?>][title_ar]"
                                                      class="form-control"><?php echo htmlfilter(isset($outcome['title_ar']) ? $outcome['title_ar'] : ''); ?></textarea>
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="outcomes[<?php echo intval($key); ?>][id]"
                                                   class="form-control"
                                                   value="<?php echo intval(isset($outcome['id']) ? $outcome['id'] : 0); ?>">
                                            <a class="btn btn-sm" onclick="remove_option_learning_outcome(this);">
                                                <span class="btn-label-icon left"><i
                                                            class="fa fa-trash"></i></span><?php echo lang('Delete'); ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="form-group m-a-0">
                            <span class="checkbox hidden"></span>
                            <?php echo Validator::get_html_error_message('outcomes'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span
                        class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span
                        class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
            </button>
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
            if (msg.status == 1) {
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
            '<textarea name="outcomes[' + key + '][title_en]" class="form-control" ></textarea>' +
            '</td>' +
            '<td>' +
            '<textarea name="outcomes[' + key + '][title_ar]" class="form-control" ></textarea>' +
            '</td>' +
            '<td class="text-center">' +
            '<input type="hidden" name="outcomes[' + key + '][id]" class="form-control" >' +
            '<a class="btn btn-sm" onclick="remove_option_learning_outcome(this);">' +
            '<span class="btn-label-icon left"><i class="fa fa-trash-o"></i></span><?php echo lang('Delete') ?>' +
            '</a>' +
            '</td>' +
            '</tr>');
        rename_learning_outcome();
    }

    function remove_option_learning_outcome(element) {
        $(element).parents('.item').remove();
        rename_learning_outcome();
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

</script>