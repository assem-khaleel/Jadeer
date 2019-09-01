<?php

/** @var $invitation Orm_Rb_Evaluations */

$type = $this->input->get_post('fltr');


$type = isset($type['type']) ? $type['type'] : Orm_User_Faculty::class;

?>

<div class="modal-dialog modal-lg">

    <div class="modal-content">
        <?php echo form_open('/rubrics/invitation/' . $rubric->get_id() . '?invitation_id=' . $invitation_id, ['class' => 'form-horizontal', 'id' => 'invitation_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title"><?php
                if (empty($id)) {
                    echo lang('Add New') . ' ' . lang('Invitation');
                } else {
                    echo lang('Edit') . ' ' . lang('Invitation');
                }
                ?></h4>
        </div>
        <div class="modal-body">
            <input type="hidden" value="<?php $invitation->get_id() ?>" name="invitation_id"/>
            <div class="form-group">
                <label class="col-sm-3" for="description_en"><?php echo lang('Description') ?>
                    (<?php echo lang('English') ?>)</label>
                <div class="col-sm-9">
                    <textarea id="description_en" class="form-control"
                              name="description_en"><?php echo htmlfilter($invitation->get_description_en() ? $invitation->get_description_en() : $description_en) ?></textarea>
                    <?php echo Validator::get_html_error_message('description_en'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3" for="description_ar"><?php echo lang('Description') ?>
                    (<?php echo lang('Arabic') ?>)</label>
                <div class="col-sm-9">
                    <textarea id="description_ar" class="form-control"
                              name="description_ar"><?php echo htmlfilter($invitation->get_description_ar() ? $invitation->get_description_ar() : $description_ar) ?></textarea>
                    <?php echo Validator::get_html_error_message('description_ar'); ?>
                </div>
            </div>
            <hr class="page-block m-t-0">

            <div class="box p-a-1 fltr-type">
                <div class="col-md-3">
                    <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>"
                            type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false"
                            aria-controls="filters">
                        <span class="fa fa-filter"></span>
                    </button>
                </div>


                <div class="col-md-3">
                    <div class="radio"><label><input type="radio"
                                                     class="px" <?php if ($type == Orm_User_Faculty::class) {
                                echo 'checked="checked"';
                            } ?> value="<?php echo Orm_User_Faculty::class ?>" name="fltr[type]"><span
                                    class="lbl"><?php echo lang('Faculty'); ?></span></label></div>
                </div>
                <div class="col-md-3">
                    <div class="radio"><label><input type="radio" class="px" <?php if ($type == Orm_User_Staff::class) {
                                echo 'checked="checked"';
                            } ?> value="<?php echo Orm_User_Staff::class ?>" name="fltr[type]"><span
                                    class="lbl"><?php echo lang('Staff'); ?></span></label></div>
                </div>
                <div class="col-md-3">
                    <div class="radio"><label><input type="radio"
                                                     class="px" <?php if ($type == Orm_User_Student::class) {
                                echo 'checked="checked"';
                            } ?> value="<?php echo Orm_User_Student::class ?>" name="fltr[type]"><span
                                    class="lbl"><?php echo lang('Students'); ?></span></label></div>
                </div>
                <div class="col-md-12">
                    <?php echo Validator::get_html_error_message('fltr'); ?>
                </div>
            </div>

            <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
                <div class="well">
                    <div id="details"><?php
                        switch ($type) {
                            case Orm_User_Staff::class:
                                echo Orm_User_Staff::draw_filters();
                                break;

                            case Orm_User_Student::class:
                                echo Orm_User_Student::draw_filters();
                                break;

                            default:
                                echo Orm_User_Faculty::draw_filters();
                        }
                        ?></div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="pull-right">
                <button class="btn" type="submit" <?php echo data_loading_text() ?>><span
                            class="btn-label-icon left fa fa-floppy-o"></span><?php echo lang('Send') ?></button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>

<script>
    $('.fltr-type input[type="radio"]').on('click, change', function () {

        $fltr = $('#invitation_form').serializeArray();
        $fltr.push({name: 'type', value: $(this).val()});

        $.get('/rubrics/draw_filter', $fltr)
            .success(function (html) {
                $('#details').html(html);
            });
    });

    $('#invitation_form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>
