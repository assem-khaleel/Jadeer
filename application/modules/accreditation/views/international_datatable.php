<div class="table-responsive m-a-0">
    <table class="table table-striped table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="<?php echo(Orm_Node::check_if_can_generate(true) ? 'col-md-3' : 'col-md-5') ?>">
                <b><?php echo lang('Name') ?></b>
            </td>
            <td class="col-md-1">
                <b><?php echo lang('Year') ?></b>
            </td>
            <td class="col-md-2">
                <b><?php echo lang('Progress') ?></b>
            </td>
            <td class="col-md-2">
                <b><?php echo lang('Review') ?></b>
            </td>
            <td class="<?php echo(Orm_Node::check_if_can_generate(true) ? 'col-md-4' : 'col-md-2') ?> text-center">
                <b><?php echo lang('Action') ?></b>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php if ($first_levels): ?>
            <?php foreach ($first_levels as $node) : /* @var $node Orm_Node */ ?>
                <tr>
                    <td>
                        <div class="form-group">
                            <label class="control-label"><?php echo htmlfilter($node->get_name()); ?></label>
                        </div>
                        <?php if (in_array(get_class($node), Orm_Node::$program_nodes) && !is_null($node->get_item_obj())) : ?>
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label class="control-label"><?php echo lang('College') ?>:</label>
                                <?php echo htmlfilter($node->get_item_obj()->get_department_obj()->get_college_obj()->get_name()); ?>
                            </div>
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label class="control-label"><?php echo lang('Program') ?>:</label>
                                <?php echo htmlfilter($node->get_item_obj()->get_name()); ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $node->get_year() ?>
                    </td>
                    <td>
                        <?php $progress = $node->get_progress_score() ?>
                        <div id="progress-gauge-<?php echo  $node->get_id() ?>" style="height: 100px"></div>
                        <script>
                            //                        pxInit.push(function () {
                            $(function () {
                                var data = {
                                    columns: [
                                        ['<?php echo lang('Progress') ?>', <?php echo $progress ?>]
                                    ],
                                    type: 'gauge'
                                };

                                c3.generate({
                                    bindto: '#progress-gauge-<?php echo $node->get_id() ?>',
                                    color: {pattern: ['<?php echo get_chart_color($progress)?>']},
                                    data: data
                                });
                            });
                            //                        });
                        </script>
                    </td>
                    <td>
                        <?php $review = $node->get_review_score() ?>
                        <div id="review-gauge-<?php echo $node->get_id() ?>" style="height: 100px"></div>
                        <script>
                            //                        pxInit.push(function () {
                            $(function () {
                                var data = {
                                    columns: [
                                        ['<?php echo lang('Progress') ?>', <?php echo $review ?>]
                                    ],
                                    type: 'gauge'
                                };

                                c3.generate({
                                    bindto: '#review-gauge-<?php echo  $node->get_id() ?>',
                                    color: {pattern: ['<?php echo get_chart_color($review)?>']},
                                    data: data
                                });
                            });
                            //                        });
                        </script>
                    </td>
                    <td class="text-center">
                        <a href="/accreditation/item/<?php echo $node->get_id() ?>" class="btn btn-block"  style="margin-bottom: 3px;">
                            <span class="btn-label-icon left fa fa-cogs" aria-hidden="true"></span>
                            <?php echo lang('Manage'); ?>
                        </a>
                        <?php if (Orm_Node::check_if_can_generate(true)): ?>
                            <a href="/accreditation/due_date/<?php echo $node->get_id() ?>" data-toggle="ajaxModal" class="btn btn-block"  style="margin-bottom: 3px;">
                                <span class="btn-label-icon left fa fa-calendar" aria-hidden="true"></span>
                                <?php echo lang('Due Date'); ?>
                            </a>
                            <a href="/accreditation/delete/<?php echo $node->get_id() ?>" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?')?>" class="btn btn-block"  style="margin-bottom: 3px;">
                                <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                <?php echo lang('Delete'); ?>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" style="text-align: center;">
                    <div class="well well-sm m-a-0" >
                        <h3 class="text-center m-a-0" ><?php echo lang('There are no') . ' ' . lang('Accreditations'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if (!empty($pager)): ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php endif; ?>