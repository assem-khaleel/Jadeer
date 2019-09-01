<?php
/**
 * @var $skills Orm_stp_skill
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Skills') ?></span>
        <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <div class="panel-heading-controls ">
                <a style="" class="btn btn-sm" href="/student_portfolio/skill_manage" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New') ?></a>
            </div>
        <?php } ?>
    </div>
    <?php if(count($skills)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Skill Name') ?></th>
            <th class="col-lg-2"><?php echo lang('Attachment') ?></th>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <th class="col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($skills as $skill) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($skill->get_skill_name()) ?></span>
            </td>
            <td class="text-center">
                <?php if(file_exists(FCPATH.$skill->get_attachment())): ?>
                    <a href="<?php echo htmlfilter($skill->get_attachment()) ?>" target="_blank" class="btn  btn-block"><i class="btn-label-icon left fa fa-paperclip"></i><?php echo lang('Download') ?></a>
                <?php endif; ?>
            </td>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/student_portfolio/skill_manage?id=<?php echo intval($skill->get_id()) ?>"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit') ?></a>
                    <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/student_portfolio/skill_delete/<?php echo intval($skill->get_id()) ?>"><span class="btn-label-icon left fa fa-remove"></span><?php echo lang('Delete') ?></a>
                </td>
            <?php } ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $pager ?>
    <?php else: ?>
    <div class="alert alert-dafualt">
        <div class="m-b-12">
            <?php echo lang('There are no') . ' ' . lang('Skills'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>