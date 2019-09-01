<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/9/16
 * Time: 5:08 PM
 */
/** @var $research Orm_Fp_Research */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/publication/research_manage" , array('id' => 'research-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Researches'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_research">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Research Title')?></label>
                            <div class="col-md-9">
                                <input type="text" name="title" value="<?php echo htmlfilter($research->get_title()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Research Subject')?></label>
                            <div class="col-md-9">
                                <input type="text" name="subject" value="<?php echo htmlfilter($research->get_subject()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('subject'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Research Number')?></label>
                            <div class="col-md-9">
                                <input type="text" name="number" value="<?php echo htmlfilter($research->get_number()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('number'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Language')?></label>
                            <div class="col-md-9">
                                <input type="text" name="language" value="<?php echo htmlfilter($research->get_language()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('language'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Author Type')?></label>
                            <div class="col-md-9">
                                <select name="type" class="form-control" >
                                    <option value=""><?php echo lang('Type')?>...</option>
                                    <?php foreach(Orm_Fp_Research::$author_types as $research_key => $research_type) { ?>
                                        <?php $selected = ($research_key == $research->get_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $research_key; ?>" <?php echo $selected; ?>><?php echo lang($research_type); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('author_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Authors')?></label>
                            <div class="col-md-9">
                                <input type="text" name="authors" value="<?php echo htmlfilter($research->get_authors()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('authors'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Authors Count')?></label>
                            <div class="col-md-9">
                                <input type="text" name="participant_count" value="<?php echo htmlfilter($research->get_participant_count()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('participant_count'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Author Rank')?></label>
                            <div class="col-md-9">
                                <input type="text" name="position_rank" value="<?php echo htmlfilter($research->get_position_rank()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('position_rank'); ?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Paper Status')?></label>
                            <div class="col-md-9">
                                <select name="paper_status" class="form-control" >
                                    <option value=""><?php echo lang('Paper Status')?>...</option>
                                    <?php foreach(Orm_Fp_Research::$paper_statuses as $status_key => $status_type) { ?>
                                        <?php $selected = ($status_key == $research->get_paper_status() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $status_key; ?>" <?php echo $selected; ?>><?php echo lang($status_type); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('author_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Publish Type')?></label>
                            <div class="col-md-9">
                                <select name="publish_type" class="form-control" >
                                    <option value=""><?php echo lang('Publish Type')?>...</option>
                                    <?php foreach(Orm_Fp_Research::$PUBLISH_TYPES as $research_publish_key => $research_publish_type) { ?>
                                        <?php $selected = ($research_publish_key == $research->get_publish_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $research_publish_key; ?>" <?php echo $selected; ?>><?php echo lang($research_publish_type); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('author_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Publish Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="publish_date" value="<?php echo $research->get_publish_date() != '0000-00-00' ? htmlfilter($research->get_publish_date()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('publish_date'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('ISSN')?></label>
                            <div class="col-md-9">
                                <input type="text" name="issn" value="<?php echo htmlfilter($research->get_issn()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('issn'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('ISI')?></label>
                            <div class="col-md-9">
                                <input type="text" name="isi" value="<?php echo htmlfilter($research->get_isi()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('isi'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Others')?></label>
                            <div class="col-md-9">
                                <input type="text" name="other" value="<?php echo htmlfilter($research->get_other()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('other'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('ISBN')?></label>
                            <div class="col-md-9">
                                <input type="text" name="isbn" value="<?php echo htmlfilter($research->get_isbn()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('isbn'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Published In')?></label>
                            <div class="col-md-9">
                                <input type="text" name="published_in" value="<?php echo htmlfilter($research->get_published_in()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('published_in'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Page From')?></label>
                            <div class="col-md-9">
                                <input type="text" name="page_from" value="<?php echo htmlfilter($research->get_page_from()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('page_from'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Page To')?></label>
                            <div class="col-md-9">
                                <input type="text" name="page_to" value="<?php echo htmlfilter($research->get_page_to()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('page_to'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Page Count')?></label>
                            <div class="col-md-9">
                                <input type="text" name="page_count" value="<?php echo htmlfilter($research->get_page_count()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('page_count'); ?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Original Type')?></label>
                            <div class="col-md-9">
                                <input type="text" name="original_type" value="<?php echo htmlfilter($research->get_original_type()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('original_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Original Language')?></label>
                            <div class="col-md-9">
                                <input type="text" name="original_language" value="<?php echo htmlfilter($research->get_original_language()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('original_language'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Original Researcher')?></label>
                            <div class="col-md-9">
                                <input type="text" name="original_researcher" value="<?php echo htmlfilter($research->get_original_researcher()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('original_researcher'); ?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Summary')?></label>
                            <div class="col-md-9">
                                <textarea name="summary" class="form-control" ><?php echo htmlfilter($research->get_summary()); ?></textarea>
                                <?php echo Validator::get_html_error_message('summary'); ?>
                            </div>
                        </div>
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
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Comments')?></label>
                            <div class="col-md-9">
                                <input type="text" name="comments" value="<?php echo htmlfilter($research->get_comments()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('comments'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Source')?></label>
                            <div class="col-md-9">
                                <input type="text" name="source" value="<?php echo htmlfilter($research->get_source()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('source'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Email')?></label>
                            <div class="col-md-9">
                                <input type="text" name="email" value="<?php echo htmlfilter($research->get_email()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Agreement Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="agreement_date" value="<?php echo $research->get_agreement_date() != '0000-00-00' ? htmlfilter($research->get_agreement_date()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('agreement_date'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo lang('Agreement Attachment'); ?></label>
                            <div class="col-md-9">
                                <label class="custom-file px-file" id="agreement_attachment">
                                    <input type="file" name="agreement_attachment" class="custom-file-input">
                                    <span class="custom-file-control form-control"> <?php echo lang('Attachment'); ?></span>
                                    <div class="px-file-buttons">
                                        <button type="button" class="btn px-file-clear"><?php echo lang('Clear') ?></button>
                                        <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse') ?></button>
                                    </div>
                                </label>
                                <?php echo Validator::get_html_error_message('agreement_attachment'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Country')?></label>
                            <div class="col-md-9">
                                <input type="text" name="country" value="<?php echo htmlfilter($research->get_country()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('country'); ?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Research Center')?></label>
                            <div class="col-md-9">
                                <input type="text" name="research_center" value="<?php echo htmlfilter($research->get_research_center()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('research_center'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Research Budget')?></label>
                            <div class="col-md-9">
                                <input type="text" name="research_budget" value="<?php echo htmlfilter($research->get_research_budget()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('research_budget'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Support Party')?></label>
                            <div class="col-md-9">
                                <input type="text" name="support_party" value="<?php echo htmlfilter($research->get_support_party()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('support_party'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($research->get_id()); ?>" >
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

    $('#research-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);

        if(files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: $(":file:enabled", this),
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
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }

    });
    $('.custom-file').pxFile();
</script>
