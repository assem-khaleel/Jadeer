<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 8/20/17
 * Time: 1:40 PM
 */
/** @var $pager String */
/** @var $industrial Orm_Is_Industrial_Skills[] */
/** @var $relations Orm_Is_Industrial_Relation[]  */
/** @var $items Orm_Rb_Rubrics[] */



?>
<div class="form-group" id="rubricsDiv">
<!--    <label class="control-label"><h3>--><?php //echo lang('Rubrics') ?><!--</h3></label>-->
    <div class="form-group">
        <div class="row">
            <label class="control-label col-sm-2" for="keyword"><?php echo lang('Keyword') ?></label>
            <div class="col-sm-6">
                <div class="input-group input-group-sm">
                    <input type="text" id="keyword" placeholder="<?php echo lang('Search') ?>" name="keyword"
                           class="form-control" value="<?php ?>">
                    <span class="input-group-btn">
                                    <button type="button" class="btn"
                                            data-loading-text="<span class='fa fa-spinner fa-spin'></span>"
                                            onclick="search(this);">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </span>
                </div>
            </div>
            <div class="col-sm-4 text-right">
                <button type="button" class="btn" id="clear"><?php echo lang('Clear Selection') ?></button>
            </div>
        </div>
    </div>
    <div class="more_items well">
        <?php
        if (!empty($items)) {
            foreach ($items as $item) {
                ?>

                <h5 class="m-t-2 font-weight-semibold text-muted">
                    <?php echo lang('Rubric Name').' = '.$item->get_name() ?>
                </h5>
                <?php
                if (!empty($item->get_skills())) {
                foreach ($item->get_skills() as $skill) {?>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <input type="checkbox" name="skills[]" id="" value="<?php echo $skill->get_id(); ?>"
                                       <?php foreach ($relations as $relation): ?>
                                           <?php echo in_array($skill->get_id(), $relation->get_rubric_ids($industrial->get_id())) == '1' ? 'checked' : '0'; ?>

                                       <?php endforeach;?>

                                       class="px">
                                <span class="lbl"><?php echo $skill->get_name(); ?></span>
                            </li>
                        </ul>
            <?php    } ?>
                <?php }else{?>
                    <ul class="list-group">
                        <li class="list-group-item"><?php echo lang('There are no').' '.lang('Skills') ?>
                        </li>
                    </ul>
                <?php }?>
            <?php }
        }else{?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center"><?php echo lang("There are no") . ' ' . lang('Rubrics') ?></h3>
            </div>
      <?php  }
        ?>
        <?php if ($pager) { ?>
                <?php echo $pager; ?>
        <?php } ?>
        <?php echo Validator::get_html_error_message_no_arrow('skill_ids'); ?>
    </div>

</div>
<script>
    function search(btn) {
        $(btn).button('load');
        $.get('/industrial_skills/load_rubric', {keyword: $('#keyword').val()})
            .done(function (msg) {
                $('#search-rubric').html(msg);
            });
    }
    init_data_toggle();


    $('#clear').on('click', function (e) {
        e.preventDefault();
        $.get({
            url: '/industrial_skills/load_rubric'
        }).done(function (msg) {
            $('#search-rubric').html(msg);
        });
    });
</script>