<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/17/17
 * Time: 11:46 AM
 */

/**
 * @var $book Orm_Fp_Book
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Book') ?></span>
        <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <div class="panel-heading-controls ">
                <a style="" class="btn btn-sm" href="/faculty_portfolio/publication/book_manage" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New') ?></a>
            </div>
        <?php } ?>
    </div>
    <?php if(count($books)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Book Title') ?></th>
            <th class="col-lg-2"><?php echo lang('Publish Date') ?></th>
            <th class="col-lg-3"><?php echo lang('Authors') ?></th>
            <th class="col-lg-2"><?php echo lang('Attachment') ?></th>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <th class="col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($books as $book) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($book->get_title()) ?></span>
            </td>
            <td>
                <span><?php echo $book->get_publish_date() ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($book->get_authors()) ?></span>
            </td>
            <td class="text-center">
                <?php if(file_exists(FCPATH.$book->get_attachment())): ?>
                    <a href="<?php echo htmlfilter($book->get_attachment()) ?>" target="_blank" class="btn  btn-block"><i class="btn-label-icon left fa fa-paperclip"></i><?php echo lang('Download') ?></a>
                <?php endif; ?>
            </td>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/faculty_portfolio/publication/book_manage?id=<?php echo intval($book->get_id()) ?>"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit') ?></a>
                    <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/faculty_portfolio/publication/book_delete/<?php echo intval($book->get_id()) ?>"><span class="btn-label-icon left fa fa-remove"></span><?php echo lang('Delete') ?></a>
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
            <?php echo lang('There are no') . ' ' . lang('Books'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>