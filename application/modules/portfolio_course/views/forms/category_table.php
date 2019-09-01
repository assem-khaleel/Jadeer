<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 01/06/17
 * Time: 04:05 م
 */
/* @var $categories Orm_Pc_Category*/
?>
<div class="table-responsive m-a-0">
    <table class="table table-bordered">

        <thead>
        <tr>
            <td class="col-md-3"><?php echo lang('Category Name'); ?></td>
            <td class="col-md-4"><?php echo lang('Description'); ?></td>
            <td class="col-md-3"><?php echo lang('Level'); ?></td>
            <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($categories): ?>
            <?php foreach ($categories as $category): /* @var $category Orm_Pc_Category*/?>
                <tr>
                    <td> <?php echo htmlfilter($category->get_title())?></td>
                    <td> <?php echo htmlfilter($category->get_description())?></td>
                    <td> <?php echo htmlfilter(lang($category->get_level()))?></td>
                    <td class="text-center">
                        <?php if( Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')): ?>

                        <a href="/portfolio_course/forms/add_edit_custom_menu/<?php echo htmlfilter($type); ?>/<?php echo intval($category->get_id()) ?>?id=<?php echo $course_id; ?>&cat=<?php echo $category->get_id();?>"
                           data-toggle="ajaxModal"  class="btn btn-sm btn-block"
                           title="<?php echo lang('Edit') ?>">
                            <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                            <?php echo lang('Edit') ?>
                        </a>
                        <a href="/portfolio_course/forms/delete/<?php echo htmlfilter($type); ?>/<?php echo intval($category->get_id()) ?>?id=<?php echo $course_id; ?>&cat=<?php echo $category->get_id();?>"
                        class="btn btn-sm btn-block"
                           title="<?php echo lang('Delete') ?>" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>">
                            <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                            <?php echo lang('Delete') ?>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Category'); ?></h3>
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
