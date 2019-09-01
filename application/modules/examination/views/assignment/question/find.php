<?php
/* @var $questions Orm_Tst_Question*/
?>
<form method="GET">
    <input type="hidden" id="property_id" name="property_id" value="<?php echo $this->input->get_post('property_id') ?>">
    <input type="hidden" id="property_label" name="property_label" value="<?php echo $this->input->get_post('property_label'); ?>">
    <div class="panel m-a-0">
        <div class="panel-heading p-l-0">
            <div class="col-md-12" style="margin-bottom: 5px;">
                <div class="input-group input-group-sm">
                    <input type="text"
                           value="<?php echo(empty($fltr['keyword']) ? '' : htmlfilter($fltr['keyword'])); ?>"
                           class="form-control" name="fltr[keyword]" placeholder="<?php echo lang('Keyword') ?>">
                <span class="input-group-btn">
            <button class="btn" type="submit">
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>
            </span>
                </div>
            </div>

        </div>
    </div>
    <div class="panel-body p-a-1">
        <table class="table table-hover m-a-0">
            <thead>
            <tr>
                <td  class="col-md-1">#</td>
                <td class="col-md-6"><?php echo lang('Question'); ?></td>
                <td class="col-md-5"><?php echo lang('Type'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($questions as $question) : /* @var $question Orm_Tst_Question */ ?>
                <tr onclick="select_option(<?php echo htmlfilter($question->get_id()); ?>);">
                   <td>
                        <input type="radio" id="id_<?php echo htmlfilter($question->get_id()); ?>" name="question_id"
                               value="<?php echo htmlfilter($question->get_id()); ?>"
                               label="<?php echo htmlfilter($question->get_text()); ?>"/>
                    </td>
                    <td><?php echo htmlfilter($question->get_text()); ?></td>
                    <td><?php echo htmlfilter($question->get_type(true)); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo (isset($pager) ? '<div class="panel-footer p-y-0">' . $pager . '</div>' : ""); ?>
</form>

<script>
    function select_option(id) {
        var option = $('#id_' + id);

        option.prop('checked', true);

        var property_id = $('#property_id').val();
        var property_label = $('#property_label').val();

        parent.document.getElementById(property_id).value = option.val();
        parent.document.getElementById(property_label).value = option.attr('label');

        parent.find_onselect(option.val(), property_id, property_label);

        parent.document.getElementById('wrapper_' + property_id).remove();
    }
</script>
