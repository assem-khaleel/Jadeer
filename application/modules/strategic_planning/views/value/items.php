<?php
/**
 * @var string $pager
 * @var string $keyword
 * @var string $title
 * @var int $category
 */
/* @var $values Orm_Sp_Values */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Value'); ?></span>
    </div>
    <div class="table-header">
        <span class="table-caption">&nbsp;</span>

        <div class="panel-heading-controls col-sm-4">
            <form method="GET">
                <div class="input-group input-group-sm">
                    <input type="text" name="s" placeholder="<?php echo lang('Search'); ?>" class="form-control"
                           value="<?php echo isset($keyword) && $keyword ? $keyword : ''; ?>">
                    <input type="hidden" name="c" value="<?php echo $category; ?>">
                    <span class="input-group-btn">
                        <button type="submit" class="btn">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                </div>
                <!-- / .input-group -->
            </form>
            <a class="btn" data-toggle="ajaxModal"
               href="/strategic_planning/value/add_edit?c=<?php echo htmlfilter($category); ?>"><span
                    class="btn-label-icon left"><i class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create'); ?></a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-8"><?php echo lang('title'); ?></th>
            <th class="col-lg-4"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($values as $value) { ?>
            <tr class="odd gradeX">
                <td><?php echo htmlfilter($value->get_title()); ?></td>
                <td>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/value/add_edit?c=<?php echo urlencode($category); ?>&id=<?php echo urlencode($value->get_id()); ?>"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/value/remove?id=<?php echo urlencode($vision->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($values)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Values'); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (!empty($pager)) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>
<script>
    function after_modal() {
        init_data_toggle();
    }
</script>