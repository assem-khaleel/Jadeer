<?php
/** @var $fieldsvalue Orm_Pc_Syllabus_Fields_Value[] */
/** @var $can_manage bool */
/** @var $course_id int */
/** @var $cat int */
/** @var $fields array */
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo htmlentities(strip_tags(Orm_Pc_Category::get_instance($cat)->get_title())); ?>
            <?php if($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){?>
                <a class="btn btn-sm  pull-right topic" href="/portfolio_course/forms/edit/<?php echo $level; ?>?id=<?php echo $course_id; ?>&cat=<?php echo $cat; ?>" data-toggle="ajaxModal" >
                    <span class="btn-label-icon left icon fa fa-plus" aria-hidden="true"> </span> <?php echo lang('Add') ?>
                </a>
            <?php }?>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <?php $display=[]; $type=[]; foreach ($fields as $key => $value1): ?>
                <th><?php $display[$value1->get_id()]='field'.$value1->get_id(); $type[$value1->get_id()]= $value1->get_field_type(); echo $value1->get_title(); ?></th>
            <?php endforeach;?>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){ ?>
                <th class="col-md-2"><?php echo lang('Action') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if($fieldsvalue):
            foreach ($fieldsvalue as $fieldvalue) {
                $topic= unserialize($fieldvalue->get_value());
                ?>
                <tr>
                    <?php foreach ($display as $key => $value):?>
                    <td>
                        <?php if($type[$key]=='file'){?>
                         <a class="btn btn-sm p-r-1" href="/portfolio_course/forms/download/<?php echo intval($key) ?>?id=<?php echo $fieldvalue->get_id(); ?>">
                            <span class="fa fa-download" aria-hidden="true"></span>
                        </a>
                        <?php } else {?>
                        <?php echo isset($topic[$value])? is_array($topic[$value])? htmlentities(strip_tags(implode(',', $topic[$value]))) : (strip_tags($topic[$value])) :'' ?> </td>
                        <?php } endforeach;?>
                    <?php if (!empty($display) && $can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){ ?>
                        <td>
                            <a href="/portfolio_course/forms/edit/<?php echo $level; ?>/<?php echo intval($fieldvalue->get_id()) ?>?id=<?php echo $course_id; ?>&cat=<?php echo $cat;?>" data-toggle="ajaxModal" class="btn btn-sm btn-block">
                                <span class="btn-label-icon left icon fa fa-pencil-square-o" aria-hidden="true"></span> <?php echo lang('Edit') ?>
                            </a>
                            <a href="/portfolio_course/forms/delete/custom_menu_value/<?php echo intval($fieldvalue->get_id()) ?>?id=<?php echo $course_id ?>&cat=<?php echo $cat;?>" class="btn btn-sm  btn-block" title="Delete"  message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                <?php echo lang('Delete') ?>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        <?php else:?>
            <tr>
                <td colspan="<?php echo sizeof($display)+1?>">
                    <div class="well well-sm text-center">
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Topics'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>