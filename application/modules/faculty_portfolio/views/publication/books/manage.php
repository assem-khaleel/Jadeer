<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/8/16
 * Time: 12:06 PM
 */

/**
 * @var $book Orm_Fp_Book
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open_multipart("/faculty_portfolio/publication/book_manage" , array('id' => 'book-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Books'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_book">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Book Title')?></label>
                            <div class="col-md-9">
                                <input type="text" name="title" value="<?php echo htmlfilter($book->get_title()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('title'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Publish Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="publish_date" value="<?php echo $book->get_publish_date() != '0000-00-00' ? htmlfilter($book->get_publish_date()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('publish_date'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Pages Count')?></label>
                            <div class="col-md-9">
                                <input type="text" name="pages_count" value="<?php echo intval($book->get_pages_count()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('pages_count'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Publisher')?></label>
                            <div class="col-md-9">
                                <input type="text" name="publisher" value="<?php echo htmlfilter($book->get_publisher()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('publisher'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Translated Book')?></label>
                            <div class="col-md-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_translate" <?php echo($book->get_is_translate() ? 'checked="checked"' : ''); ?> />
                                        <?php echo lang("Is Translated Book"); ?>
                                    </label>
                                </div>
                                <?php echo Validator::get_html_error_message('is_translate'); ?>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Author Type')?></label>
                            <div class="col-md-9">
                                <select name="author_type" class="form-control" >
                                    <option value=""><?php echo lang('Type')?>...</option>
                                    <?php foreach(Orm_Fp_Book::$author_types as $book_key => $book_author_type) { ?>
                                        <?php $selected = ($book_key == $book->get_author_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $book_key; ?>" <?php echo $selected; ?>><?php echo lang($book_author_type); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('author_type'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Authors')?></label>
                            <div class="col-md-9">
                                <textarea name="authors" class="form-control" ><?php echo htmlfilter($book->get_authors()); ?></textarea>
                                <?php echo Validator::get_html_error_message('authors'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Authors Count')?></label>
                            <div class="col-md-9">
                                <input type="text" name="authors_no" value="<?php echo intval($book->get_authors_no()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('authors_no'); ?>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo lang('Attachment'); ?></label>
                            <div class="col-md-9">
                                <label class="custom-file px-file" id="attachment">
                                    <input type="file" name="attachment" class="custom-file-input">
                                    <span class="custom-file-control form-control"> <?php echo lang('Attachment'); ?></span>
                                    <div class="px-file-buttons">
                                        <button type="button" class="btn px-file-clear"><?php echo lang('Clear') ?></button>
                                        <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse') ?></button>
                                    </div>
                                </label>
                                <?php echo Validator::get_html_error_message('attachment'); ?>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?php echo intval($book->get_id()); ?>" >
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

    $(".datepicker_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#book-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);


        if(files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: files,
                iframe: true,
                dataType: "json"
            }).complete(function(data) {
                handle_response(data.responseJSON);
            });
        } else {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'JSON'
            }).done(function (msg) {
                handle_response(msg);
            });
        }

        function handle_response(msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }

    });

    $('.custom-file').pxFile();
</script>