<?php
/**
 * @var string $pager
 * @var string $keyword
 * @var string $title
 * @var int $category
 */
/* @var Orm_Sp_Recommendation[] $recommendations */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Recommendation'); ?>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-4"><?php echo lang('type'); ?></th>
                    <th class="col-lg-6"><?php echo lang('title'); ?></th>
                    <th class="col-lg-2"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($recommendations as $recommendation) { ?>
                    <tr class="odd gradeX">
                        <td><?php echo htmlfilter($recommendation->get_recommendation_type_obj()->get_title()); ?></td>
                        <td><?php echo htmlfilter($recommendation->get_title()); ?></td>
                        <td>
                            <a class="btn btn-sm btn-block"
                               href="/strategic_planning/recommendation/add_edit/?id=<?php echo urlencode($recommendation->get_id()); ?>"
                               data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                        class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a> |
                            <a class="btn btn-sm btn-block"
                               href="/strategic_planning/recommendation/remove/?id=<?php echo urlencode($recommendation->get_id()); ?>"
                               message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                        class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                        </td>
                    </tr>
                <?php } ?>
                <?php if (empty($recommendations)) { ?>
                    <tr>
                        <td colspan="12">
                            <div class="alert m-a-0">
                                <?php echo lang('There are no') . ' ' . lang('Recommendations'); ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if (!empty($pager)) { ?>
            <div class="modal-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    function after_modal() {
        init_data_toggle();
    }
</script>