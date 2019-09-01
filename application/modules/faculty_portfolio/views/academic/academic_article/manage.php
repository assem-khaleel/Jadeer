<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/10/16
 * Time: 12:06 PM
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/academic/academic_article_manage" , array('id' => 'academic_article-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Academic Article'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_academic_article">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Authors')?></label>
                            <div class="col-md-9">
                                <input type="text" name="authors" value="<?php echo htmlfilter($academic_article->get_authors()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('authors'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Year')?></label>
                            <div class="col-md-9">
                                <input type="text" name="year" value="<?php echo $academic_article->get_year(); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('year'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Author Type')?></label>
                            <div class="col-md-9">
                                <select name="author_type" class="form-control" >
                                    <option value=""><?php echo lang('Author Type')?>...</option>
                                    <?php foreach(Orm_Fp_Academic_Article::$author_types as $author_key => $author_value) { ?>
                                        <?php $selected = ($author_key == $academic_article->get_author_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $author_key; ?>" <?php echo $selected; ?>><?php echo lang($author_value); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('author_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Title')?></label>
                            <div class="col-md-9">
                                <input type="text" name="title" value="<?php echo htmlfilter($academic_article->get_title()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Publisher')?></label>
                            <div class="col-md-9">
                                <input type="text" name="publisher" value="<?php echo htmlfilter($academic_article->get_publisher()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('publisher'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($academic_article->get_id()); ?>" >
                    </td>
                </tr>
            </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#academic_article-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>