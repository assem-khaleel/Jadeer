<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <span><?php echo lang('Required, recommended and support materials')?></span>
            <?php if($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){?>
                <a class="btn btn-sm  pull-right" href="/portfolio_course/syllabus/edit/<?php echo $level; ?>?id=<?php echo $course_id; ?>" data-toggle="ajaxModal" >
                    <span class="btn-label-icon left icon fa fa-plus" aria-hidden="true"></span><?php echo lang('Add').' '.lang('New Material') ?>
                </a>
            <?php }?>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><?php echo lang('Material Title') ?></th>
            <th><?php echo lang('Description') ?></th>
            <th><?php echo lang('Type') ?></th>
            <th><?php echo lang('Author') ?></th>
            <th><?php echo lang('Release Date') ?></th>
            <th><?php echo lang('Edition') ?></th>
            <th><?php echo lang('publisher') ?></th>
            <th><?php echo lang('Where to find') ?></th>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){ ?>
                <th class="col-md-2"><?php echo lang('Action') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $materials = Orm_Pc_Material::get_all(['course_id'=>$course_id]);
        if($materials):
            foreach ($materials as $material) {
                ?>
                <tr>
                    <?php /* @var $material Orm_Pc_Material*/?>
                    <td><?php echo  htmlfilter($material->get_title()) ?> </td>
                    <td><?php echo  htmlfilter($material->get_description()) ?> </td>
                    <td><?php echo  htmlfilter($materialTypes[$material->get_material_type()]) ?> </td>
                    <td><?php echo  $material->get_author() ?> </td>
                    <td><?php echo  $material->get_release_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($material->get_release_date())) ?> </td>
                    <td><?php echo  htmlfilter($material->get_edition()) ?> </td>
                    <td><?php echo  htmlfilter($material->get_publisher()) ?> </td>
                    <td><?php echo  $material->get_material_location() ?> </td>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){ ?>
                        <td>
                            <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($material->get_id()) ?>?id=<?php echo $course_id; ?>" data-toggle="ajaxModal" class="btn btn-sm btn-block" >
                                <span class="btn-label-icon left icon fa fa-pencil-square-o" aria-hidden="true"></span><?php echo lang('Edit') ?>
                            </a>
                            <a href="/portfolio_course/syllabus/delete/<?php echo $level?>/<?php echo intval($material->get_id()) ?>?id=<?php echo $course_id ?>" class="btn btn-sm  btn-block" title="Delete" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span><?php echo lang('Delete') ?>
                            </a>
                        </td>
                    <?php } ?>

                </tr>
            <?php } ?>
        <?php else:?>
            <tr>
                <td colspan="9">
                    <div class="well well-sm text-center">
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Required, recommended and support materials'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php endif;?>

        </tbody>
    </table>
</div>
