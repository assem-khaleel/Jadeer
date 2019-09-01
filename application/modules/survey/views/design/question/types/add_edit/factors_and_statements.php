<?php
/* @var $question Orm_Survey_Question */
?>
<div class="form-group">
    <label class="control-label" for="more_property_factors"><?php echo lang('Factors');?></label>

    <div class="more_items" id="more_property_factors">

        <?php
        $index_factor = 0;
        $factors = (empty($factors) ? $question->get_factors() : $factors);
        if ($factors) {
            foreach ($factors as $factor) {
                if (is_object($factor)) {

                    $factor_params = array();
                    $factor_params['id'] = $factor->get_id();
                    $factor_params['question_id'] = $factor->get_question_id();
                    $factor_params['title_english'] = $factor->get_title_english();
                    $factor_params['title_arabic'] = $factor->get_title_arabic();
                    $factor_params['abbreviation_english'] = $factor->get_abbreviation_english();
                    $factor_params['abbreviation_arabic'] = $factor->get_abbreviation_arabic();

                    foreach ($factor->get_statements() as $statement) {

                        $statement_params = array();
                        $statement_params['id'] = $statement->get_id();
                        $statement_params['factor_id'] = $statement->get_factor_id();
                        $statement_params['title_english'] = $statement->get_title_english();
                        $statement_params['title_arabic'] = $statement->get_title_arabic();
                        $statement_params['abbreviation_english'] = $statement->get_abbreviation_english();
                        $statement_params['abbreviation_arabic'] = $statement->get_abbreviation_arabic();

                        $factor_params['statements'][] = $statement_params;
                    }

                    $factor = $factor_params;
                }
                ?>
                <div class="item panel panel-primary">
                    <div class="panel-heading">
                       <?php echo lang('Factor');?>
                        <?php if ($index_factor) { ?>
                            <button type="button" class="close" aria-label="Close"
                                    style="margin-top: 0; color: red; opacity: 0.7;" onclick="remove_option(this);">
                                <span aria-hidden="true">&times;</span></button>
                        <?php } ?>
                        <input type="hidden" name="factors[<?php echo $index_factor ?>][id]"
                               value="<?php echo htmlfilter($factor['id']) ?>">
                    </div>
                    <div class="panel-body" style="padding-bottom: 0;">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" name="factors[<?php echo $index_factor ?>][abbreviation_english]"
                                       value="<?php echo htmlfilter($factor['abbreviation_english']) ?>"
                                       placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('English');?>) " class="form-control">
                                <?php echo Validator::get_html_error_message('factor_abbreviation_english' , $index_factor) ?>
                            </div>
                            <div class="form-group col-md-9">
                                <input type="text" name="factors[<?php echo $index_factor ?>][title_english]"
                                       value="<?php echo htmlfilter($factor['title_english']) ?>"
                                       placeholder="<?php echo lang('Title');?> (<?php echo lang('English') ?>)" class="form-control">
                                <?php echo Validator::get_html_error_message('factor_title_english' , $index_factor) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" name="factors[<?php echo $index_factor ?>][abbreviation_arabic]"
                                       value="<?php echo htmlfilter($factor['abbreviation_arabic']) ?>"
                                       placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('Arabic');?>)" class="form-control">
                                <?php echo Validator::get_html_error_message('factor_abbreviation_arabic' , $index_factor) ?>
                            </div>
                            <div class="form-group col-md-9">
                                <input type="text" name="factors[<?php echo $index_factor ?>][title_arabic]"
                                       value="<?php echo htmlfilter($factor['title_arabic']) ?>"
                                       placeholder="<?php echo lang('Title');?> (<?php echo lang('Arabic') ?>)" class="form-control">
                                <?php echo Validator::get_html_error_message('factor_title_arabic' , $index_factor) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label"
                                       for="property_factors_<?php echo $index_factor ?>_statements"><?php echo lang('Statements');?></label>

                                <div class="more_items"
                                     id="more_property_factors_<?php echo $index_factor ?>_statements">
                                    <?php
                                    $index_statement = 0;
                                    if ($factor['statements']) {
                                        foreach ($factor['statements'] as $statement) {
                                            ?>
                                            <div class="item row">
                                                <div class="col-md-1">
                                                    <?php if ($index_statement) { ?>
                                                        <button style="width: 100%; height: 79px;" type="button"
                                                                class="btn" aria-label="Left Align"
                                                                onclick="remove_option(this);">
                                                            <span class="fa fa-trash-o"
                                                                  aria-hidden="true"></span>
                                                        </button>
                                                    <?php } else { ?>
                                                        <button style="width: 100%; height: 79px;" type="button"
                                                                class="btn"
                                                                onclick="add_more_factor_statements(<?php echo $index_factor ?>);">
                                                            <span class="fa fa-plus"
                                                                  aria-hidden="true"></span>
                                                        </button>
                                                    <?php } ?>
                                                    <input type="hidden"
                                                           name="factors[<?php echo $index_factor ?>][statements][<?php echo $index_statement ?>][id]"
                                                           value="<?php echo htmlfilter($statement['id']) ?>">
                                                </div>
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <input type="text"
                                                                   name="factors[<?php echo $index_factor ?>][statements][<?php echo $index_statement ?>][abbreviation_english]"
                                                                   value="<?php echo htmlfilter($statement['abbreviation_english']) ?>"
                                                                   placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('English');?>)"
                                                                   class="form-control">
                                                            <?php echo Validator::get_html_error_message('statement_abbreviation_english' , "f_{$index_factor}_s_{$index_statement}") ?>
                                                        </div>
                                                        <div class="form-group col-md-9">
                                                            <input type="text"
                                                                   name="factors[<?php echo $index_factor ?>][statements][<?php echo $index_statement ?>][title_english]"
                                                                   value="<?php echo htmlfilter($statement['title_english']) ?>"
                                                                   placeholder="<?php echo lang('Title');?> (<?php echo lang('English') ?>)" class="form-control">
                                                            <?php echo Validator::get_html_error_message('statement_title_english' , "f_{$index_factor}_s_{$index_statement}") ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <input type="text"
                                                                   name="factors[<?php echo $index_factor ?>][statements][<?php echo $index_statement ?>][abbreviation_arabic]"
                                                                   value="<?php echo htmlfilter($statement['abbreviation_arabic']) ?>"
                                                                   placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('Arabic');?>)"
                                                                   class="form-control">
                                                            <?php echo Validator::get_html_error_message('statement_abbreviation_arabic' , "f_{$index_factor}_s_{$index_statement}") ?>
                                                        </div>
                                                        <div class="form-group col-md-9">
                                                            <input type="text"
                                                                   name="factors[<?php echo $index_factor ?>][statements][<?php echo $index_statement ?>][title_arabic]"
                                                                   value="<?php echo htmlfilter($statement['title_arabic']) ?>"
                                                                   placeholder="<?php echo lang('Title');?> (<?php echo lang('Arabic');?>)" class="form-control">
                                                            <?php echo Validator::get_html_error_message('statement_title_arabic' , "f_{$index_factor}_s_{$index_statement}") ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $index_statement++;
                                        }
                                    } else {
                                        ?>
                                        <div class="item row">
                                            <div class="col-md-1">
                                                <button style="width: 100%; height: 79px;" type="button"
                                                        class="btn"
                                                        onclick="add_more_factor_statements(<?php echo $index_factor ?>);">
                                                    <span class="fa fa-plus"
                                                          aria-hidden="true"></span>
                                                </button>
                                                <input type="hidden"
                                                       name="factors[<?php echo $index_factor ?>][statements][0][id]">
                                            </div>
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <input type="text"
                                                               name="factors[<?php echo $index_factor ?>][statements][0][abbreviation_english]"
                                                               placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('English');?>)" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-9">
                                                        <input type="text"
                                                               name="factors[<?php echo $index_factor ?>][statements][0][title_english]"
                                                               placeholder="<?php echo lang('Title');?> (<?php echo lang('English') ?>)" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <input type="text"
                                                               name="factors[<?php echo $index_factor ?>][statements][0][abbreviation_arabic]"
                                                               placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('Arabic');?>)" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-9">
                                                        <input type="text"
                                                               name="factors[<?php echo $index_factor ?>][statements][0][title_arabic]"
                                                               placeholder="<?php echo lang('Title');?> (<?php echo lang('Arabic') ?>)" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $index_factor++;
            }
        } else {
            ?>
            <div class="item panel panel-primary">
                <div class="panel-heading">
                    <?php echo lang('Factor');?>
                    <input type="hidden" name="factors[0][id]">
                </div>
                <div class="panel-body" style="padding-bottom: 0;">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <input type="text" name="factors[0][abbreviation_english]"
                                   placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('English');?>)" class="form-control">
                        </div>
                        <div class="form-group col-md-9">
                            <input type="text" name="factors[0][title_english]" placeholder="<?php echo lang('Title');?> (<?php echo lang('English') ?>)"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <input type="text" name="factors[0][abbreviation_arabic]" placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('Arabic');?>)"
                                   class="form-control">
                        </div>
                        <div class="form-group col-md-9">
                            <input type="text" name="factors[0][title_arabic]" placeholder="<?php echo lang('Title');?> (<?php echo lang('Arabic');?>)"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label" for="property_factors_0_statements"><?php echo lang('Statements');?></label>

                            <div class="more_items" id="more_property_factors_0_statements">
                                <div class="item row">
                                    <div class="col-md-1">
                                        <button style="width: 100%; height: 79px;" type="button" class="btn"
                                                onclick="add_more_factor_statements(0);">
                                            <span class="fa fa-plus" aria-hidden="true"></span>
                                        </button>
                                        <input type="hidden" name="factors[0][statements][0][id]">
                                    </div>
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <input type="text"
                                                       name="factors[0][statements][0][abbreviation_english]"
                                                       placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('English');?>)" class="form-control">
                                            </div>
                                            <div class="form-group col-md-9">
                                                <input type="text" name="factors[0][statements][0][title_english]"
                                                       placeholder="<?php echo lang('Title');?> (<?php echo lang('English') ?>)" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <input type="text" name="factors[0][statements][0][abbreviation_arabic]"
                                                       placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('Arabic');?>)" class="form-control">
                                            </div>
                                            <div class="form-group col-md-9">
                                                <input type="text" name="factors[0][statements][0][title_arabic]"
                                                       placeholder="<?php echo lang('Title');?> (<?php echo lang('Arabic');?>)" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class="more_link">
        <button onclick="add_more_factors();" aria-label="Left Align" class="btn " type="button">
            <span aria-hidden="true" class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add').' '.lang('Another Factor');?>
        </button>
    </div>
</div>

<script type="text/javascript">

    function add_more_factors() {
        var count = new Date().getTime();
        var more_items = $('#more_property_factors');
        more_items.append(
            '<div class="item panel panel-primary">' +
            '<div class="panel-heading">' +
            '<?php echo lang('Factor') ;?>' +
            '<button type="button" class="close" aria-label="Close" style="margin-top: 0; color: red; opacity: 0.7;" onclick="remove_option(this);"><span aria-hidden="true">&times;</span></button>' +
            '<input type="hidden" name="factors[' + count + '][id]" >' +
            '</div>' +
            '<div class="panel-body" style="padding-bottom: 0;">' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<input type="text" name="factors[' + count + '][abbreviation_english]" placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('English');?>)" class="form-control">' +
            '</div>' +
            '<div class="form-group col-md-9">' +
            '<input type="text" name="factors[' + count + '][title_english]" placeholder="<?php echo lang('Title');?> (<?php echo lang('English') ?>)" class="form-control">' +
            '</div>' +
            '</div>' +

            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<input type="text" name="factors[' + count + '][abbreviation_arabic]" placeholder="<?php echo lang('Abbreviation');?> (<?php echo lang('Arabic');?>)" class="form-control">' +
            '</div>' +
            '<div class="form-group col-md-9">' +
            '<input type="text" name="factors[' + count + '][title_arabic]" placeholder="<?php echo lang('Title') ;?> (<?php echo lang('Arabic');?>)" class="form-control">' +
            '</div>' +
            '</div>' +

            '<div class="row">' +
            '<div class="col-md-12">' +
            '<label class="control-label" for="property_factors_' + count + '_statements"><?php echo lang('Statements') ;?></label>' +

            '<div class="more_items" id="more_property_factors_' + count + '_statements">' +
            '<div class="item row">' +
            '<div class="col-md-1">' +
            '<button style="width: 100%; height: 79px;" type="button" class="btn" onclick="add_more_factor_statements(' + count + ');">' +
            '<span class="fa fa-plus" aria-hidden="true"></span>' +
            '</button>' +
            '<input type="hidden" name="factors[' + count + '][statements][0][id]" />' +
            '</div>' +
            '<div class="col-md-11">' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<input type="text" name="factors[' + count + '][statements][0][abbreviation_english]" placeholder="<?php echo lang('Abbreviation') ;?> (<?php echo lang('English');?>)" class="form-control">' +
            '</div>' +
            '<div class="form-group col-md-9">' +
            '<input type="text" name="factors[' + count + '][statements][0][title_english]" placeholder="<?php echo lang('Title') ;?> (<?php echo lang('English') ?>)" class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<input type="text" name="factors[' + count + '][statements][0][abbreviation_arabic]" placeholder="<?php echo lang('Abbreviation') ;?> (<?php echo lang('Arabic');?>)" class="form-control">' +
            '</div>' +
            '<div class="form-group col-md-9">' +
            '<input type="text" name="factors[' + count + '][statements][0][title_arabic]" placeholder="<?php echo lang('Title') ;?> (<?php echo lang('Arabic');?>)" class="form-control">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        );
        rename(more_items);
    }

    function add_more_factor_statements(factor) {
        var count = new Date().getTime();
        var more_items = $('#more_property_factors_' + factor + '_statements');
        more_items.append(
            '<div class="item row">' +
            '<div class="col-md-1">' +
            '<button style="width: 100%; height: 79px;" type="button" class="btn" aria-label="Left Align" onclick="remove_option(this);" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span>' +
            '</button>' +
            '<input type="hidden" name="factors[' + factor + '][statements][' + count + '][id]" />' +
            '</div>' +
            '<div class="col-md-11">' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<input type="text" class="form-control" placeholder="<?php echo lang('Abbreviation') ;?> (<?php echo lang('English');?>)" name="factors[' + factor + '][statements][' + count + '][abbreviation_english]" />' +
            '</div>' +
            '<div class="form-group col-md-9">' +
            '<input type="text" class="form-control" placeholder="<?php echo lang('Title') ;?> (<?php echo lang('English') ?>)" name="factors[' + factor + '][statements][' + count + '][title_english]" />' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<input type="text" class="form-control" placeholder="<?php echo lang('Abbreviation') ;?> (<?php echo lang('Arabic');?>)" name="factors[' + factor + '][statements][' + count + '][abbreviation_arabic]" />' +
            '</div>' +
            '<div class="form-group col-md-9">' +
            '<input type="text" class="form-control" placeholder="<?php echo lang('Title') ;?> (<?php echo lang('Arabic');?>)" name="factors[' + factor + '][statements][' + count + '][title_arabic]" />' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        );
        rename(more_items);
    }
    function remove_option(element) {
        var more_items = $(element).parents('.more_items').get(0);
        $(element).parents('.item').get(0).remove();
        rename(more_items);
    }
    function rename(element) {
        $(element).find('input[name], select[name], textarea[name]').each(function () {
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
