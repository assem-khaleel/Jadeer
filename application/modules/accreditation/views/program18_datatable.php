<div class="table-responsive m-a-0">
    <table class="table table-striped table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="col-md-6">
                <b><?php echo lang('Name') ?></b>
            </td>
            <td class="col-md-2">
                <b><?php echo lang('Progress') ?></b>
            </td>
            <td class="col-md-2">
                <b><?php echo lang('Review') ?></b>
            </td>
            <td class="col-md-2 text-center">
                <b><?php echo lang('Action') ?></b>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($programs) {

            $active_node = Orm_Node::get_active_program2018_node();

            foreach ($programs as $program) {
                /* @var $program Orm_Program */
                $node = Orm_Node::get_one(array('system_number' => $active_node->get_system_number(), 'class_type' => Orm_Node::PROGRAM_PROGRAM18, 'item_id' => $program->get_id()));
                ?>
                <tr>
                    <td>
                        <b><?php echo htmlfilter($program->get_name()); ?></b>
                        <ul>
                            <li><?php echo lang('College'); ?>
                                : <?php echo htmlfilter($program->get_department_obj()->get_college_obj()->get_name()); ?></li>
                            <li><?php echo lang('Department'); ?>
                                : <?php echo htmlfilter($program->get_department_obj()->get_name()); ?></li>
                        </ul>
                    </td>
                    <td>
                        <?php if ($node->get_id()) : ?>
                            <?php $progress = $node->get_progress_score() ?>
                            <div id="progress-gauge-<?php echo  $node->get_id() ?>" style="height: 100px"></div>
                            <script>
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
                            </script>
                        <?php else : ?>
                            <?php echo lang('Not Started'); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($node->get_id()) : ?>
                            <?php $review = $node->get_review_score() ?>
                            <div id="review-gauge-<?php echo $node->get_id() ?>" style="height: 100px"></div>
                            <script>
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
                            </script>
                        <?php else : ?>
                            <?php echo lang('Not Started'); ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($node->get_id()) : ?>
                            <a href="/accreditation/item/<?php echo (int)$node->get_id() ?>" class="btn btn-block"  style="margin-bottom: 3px;">
                                <span class="btn-label-icon left fa fa-cogs" aria-hidden="true"></span>
                                <?php echo lang('Manage'); ?>
                            </a>
                        <?php else : ?>
                            <a href="/accreditation/add_national/program18/<?php echo (int)$program->get_id() ?>" class="btn btn-block"  role="button"
                                <?php echo data_loading_text() ?>
                               onclick="$(this).button('loading');" style="margin-bottom: 3px;">
                                <span class="btn-label-icon left fa fa-plus-circle" aria-hidden="true"></span>
                                <?php echo lang('Generate Forms'); ?>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="10" >
                    <div class="well well-sm m-a-0">
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Programs'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php if ($pager) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>