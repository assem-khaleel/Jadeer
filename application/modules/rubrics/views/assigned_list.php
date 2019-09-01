<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Assigned Rubrics') ?>
        </div>
    </div>
    <div class="table-responsive m-a-0">
        <table class="table table-striped table-bordered">
            <thead>
            <tr class="bg-primary">
                <th class="col-md-2">
                    <b><?php echo lang('Name') ?></b>
                </th>
                <th class="col-md-2">
                    <b><?php echo lang('Description') ?></b>
                </th>
                <th class="col-md-2">
                    <b><?php echo lang('Publisher') ?></b>
                </th>
                <th class="col-md-2">
                    <b><?php echo lang('Publish') ?></b>
                </th>
                <th class="col-md-1 text-center"><?php echo lang('Type') ?></th>
                <th class="col-md-1 text-center"><?php echo lang('Classification') ?></th>

                <th class="col-md-2 text-center">
                    <b><?php echo lang('Action') ?></b>
                </th>
            </tr>
            </thead>
            <tbody>

            <?php
            /** @var Orm_Rb_Rubrics $rubric */
            if (!empty($rubrics)) {
                foreach ($rubrics as $rubric) {
                    ?>
                    <tr>
                        <td>
                            <b><?php echo htmlfilter($rubric->get_name()) ?></b>
                        </td>
                        <td>
                            <b><?php echo htmlfilter($rubric->get_desc()) ?></b>
                        </td>
                        <td>
                            <b><?php echo htmlfilter(Orm_User::get_instance($rubric->get_creator())->get_full_name()) ?></b>
                        </td>
                        <td>
                            <b><?php echo $rubric->get_start_date(true) ? htmlfilter($rubric->get_start_date()) . ' - ' . htmlfilter($rubric->get_end_date()) : '-' ?></b>
                        </td>

                        <td class="text-center">
                            <b><?php echo Orm_Rb_Rubrics::get_type($rubric->get_rubric_type()) ?></b>
                        </td>
                        <td class="text-center">
                            <b><?php echo lang($rubric->get_rubric_class()) ?></b>
                        </td>
                        <td class="text-center">
                            <a href="/rubrics/assigned/answer/<?php echo (int)$rubric->get_id(); ?>"
                               class="btn btn-block "><span
                                        class="btn-label-icon left fa fa-check-square-o"></span><?php echo lang('Answer') ?>
                            </a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="7">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Rubrics'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php

    $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
    $pager->set_per_page($this->config->item('per_page'));
    $pager->set_page((int)$this->input->get_post('page')?: 1);
    $pager->set_total_count(count($rubrics));
    ?>
    <?php if (!empty($pager)): ?>
        <div class="table-footer">
            <?php echo $pager->render(true); ?>
        </div>
    <?php endif; ?>
</div>

