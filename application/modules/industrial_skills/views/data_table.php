<?php
/** @var $items Orm_Is_Industrial_Skills[] */
/** @var $pager String */
?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption">
            <?php echo lang('Industrial Skills') ?>
        </span>
    </div>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="col-md-5"><?php echo lang('Name'); ?></th>
                <th class="col-md-3"><?php echo lang('Skills'); ?></th>
                <th class="col-md-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            /* @var $program Orm_Program */

            foreach ($items as $item) { ?>
                <tr>
                    <td>
                        <h5 class="m-t-0"><?php echo htmlfilter($item->get_name()); ?></h5>
                        <ul>
                            <li>
                                <i><?php echo lang('College'); ?></i> : <?php echo htmlfilter($item->get_college_obj()->get_name()); ?>
                            </li>
                            <li>
                                <i><?php echo lang('Program'); ?></i> : <?php echo htmlfilter($item->get_program_obj()->get_name()); ?>
                            </li>
                        </ul>


                    </td>

                    <td>
                        <ul>
                            <?php foreach (Orm_Is_Industrial_Relation::get_skill_ids($item->get_id()) as $skill_id){ ?>

                                <li>
                                    <?php echo htmlfilter(Orm_Rb_Skills::get_instance($skill_id)->get_name())?>
                                </li>

                            <?php } ?>
                        </ul>

                    </td>


                    <td class="text-center">
                        <a class="btn btn-sm btn-block"
                           href="/industrial_skills/details/<?php echo urlencode($item->get_id()); ?>">
                            <span class="btn-label-icon left "><i
                                    class="fa fa-eye"></i></span> <?php echo lang('Details'); ?>
                        </a>
                        <?php if (Orm_Is_Industrial_Skills::check_if_can_add()) { ?>

                        <a class="btn btn-sm btn-block"
                           href="/industrial_skills/add_edit/<?php echo urlencode($item->get_id());?>"
                           data-toggle="ajaxModal">
                            <span class="btn-label-icon left "><i
                                    class="fa fa-edit"></i></span> <?php echo lang('Edit'); ?>
                        </a>
                        <a class="btn btn-sm btn-block"
                           href="/industrial_skills/delete/<?php echo urlencode($item->get_id()); ?>"
                           data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>">
                            <span class="btn-label-icon left"><i
                                    class="fa fa-trash-o"></i></span> <?php echo lang('Delete') ?>
                        </a>
                        <?php }?>
                    </td>
                </tr>
            <?php }
            if (empty($items)) { ?>
                <tr>
                    <td colspan="6">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang("There are no") . ' ' . lang('Industrial Skills') ?></h3>
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
</div>