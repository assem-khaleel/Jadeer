<?php
/* @var $question Orm_Survey_Question */
?>
<div class="form-group">
    <label class="for"><?php echo lang('Question Choices'); ?> : *</label>

    <div class="more_items" id="more">
        <?php
        $index = 0;
        $choices = (empty($choices) ? $question->get_choices() : $choices);
        if ($choices) {
            foreach ($choices as $choice) {
                if (is_object($choice)) {

                    $params = array();
                    $params['id'] = $choice->get_id();
                    $params['question_id'] = $choice->get_question_id();
                    $params['choice_english'] = $choice->get_choice_english();
                    $params['choice_arabic'] = $choice->get_choice_arabic();

                    $choice = $params;
                }
                ?>
                <div class="item">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <input type="text" name="choices[<?php echo $index ?>][choice_english]"
                                   placeholder="<?php echo lang('Choice');?> (<?php echo lang('English') ?>)"
                                   value="<?php echo htmlfilter($choice['choice_english']) ?>" class="form-control">
                            <?php echo Validator::get_html_error_message('choice_english' , $index) ?>
                        </div>
                        <div class="form-group col-md-5">
                            <input type="text" name="choices[<?php echo $index ?>][choice_arabic]"
                                   placeholder="<?php echo lang('Choice');?> (<?php echo lang('Arabic') ?>)"
                                   value="<?php echo htmlfilter($choice['choice_arabic']) ?>" class="form-control">
                            <?php echo Validator::get_html_error_message('choice_arabic' , $index) ?>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="hidden" name="choices[<?php echo $index ?>][id]"
                                   value="<?php echo htmlfilter($choice['id']) ?>">
                            <?php if ($index) { ?>
                                <button type="button" class="btn pull-right" aria-label="Left Align"
                                        onclick="remove_option(this);">
                                    <span class="fa fa-trash-o"
                                          aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                $index++;
            }
        } else {
            ?>
            <div class="item">
                <div class="row">
                    <div class="form-group col-md-5">
                        <input type="text" name="choices[0][choice_english]" placeholder="<?php echo lang('Choice');?> (<?php echo lang('English') ?>)"
                               class="form-control">
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" name="choices[0][choice_arabic]" placeholder="<?php echo lang('Choice');?> (<?php echo lang('Arabic') ?>)"
                               class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="hidden" name="choices[0][id]">
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="more_link">
        <button onclick="add_more();" aria-label="Left Align" class="btn" type="button">
            <span aria-hidden="true" class="fa fa-plus"></span> <?php echo lang('Add').' '.lang('More'); ?>
        </button>
    </div>
</div>

<script type="text/javascript">
    function add_more() {
        var count = new Date().getTime();
        $('#more').append('<div class="item">' +
            '<div class="row">' +
            '<div class="form-group col-md-5">' +
            '<input type="text" class="form-control" name="choices[' + count + '][choice_english]" placeholder="<?php echo lang('Choice');?> (<?php echo lang('English') ?>)" />' +
            '</div>' +
            '<div class="form-group col-md-5">' +
            '<input type="text" class="form-control" name="choices[' + count + '][choice_arabic]" placeholder="<?php echo lang('Choice');?> (<?php echo lang('Arabic') ?>)" />' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<input type="hidden" name="choices[' + count + '][id]" >' +
            '<button type="button" class="btn pull-right" aria-label="Left Align" onclick="remove_option(this);" >' +
            '<span class="fa fa-trash-o btn-label-icon left" aria-hidden="true"></span> <?php echo lang('Remove'); ?>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        rename();
    }
    function remove_option(element) {
        $(element).parents('.item').get(0).remove();
        rename();
    }
    function rename() {
        $('#more').find('input[name], select[name], textarea[name]').each(function () {
            var map = get_map($(this).parents('.item').get(0)).reverse();
            var old_name = $(this).attr('name');
            var new_name = get_field_name(old_name, map);
            $(this).attr('name', new_name);
        });
    }
    function get_map(item_element, map) {
        if (!map) {
            map = [];
        }
        map.push($(item_element).parent().children('.item').index(item_element));
        var parent_item = $(item_element).parents('.item');
        if ($(parent_item).length) {
            return get_map(parent_item, map);
        } else {
            return map;
        }
    }
    function get_field_name(name, map, parent_name, index, field_name) {
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
            return get_field_name(name, map, parent_name, index, field_name);
        } else {
            field_name += name;
            return field_name;
        }
    }
</script>