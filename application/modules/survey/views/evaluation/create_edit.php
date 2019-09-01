<?php
/** @var $survey Orm_Survey */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title">
            <?php
            if (empty($id)) {
                echo lang('Create').' '.lang('Evaluation');
            } else {
                echo lang('Edit').' '.lang('Evaluation');
            }
            ?>
        </span>
    </div>
    <div class="panel-body">
        <?php echo form_open('/survey/evaluation/save', array('class' => 'form-horizontal')); ?>
            <div class="form-group">
                <label class="col-sm-3" for="description_english"><?php echo lang('Description') ?> (<?php echo lang('English') ?>)</label>

                <div class="col-sm-9">
                    <textarea id="description_english" class="form-control"
                              name="description_english"><?php echo(!empty($description_english) ? htmlfilter($description_english) : '') ?></textarea>

                    <p class="help-block"><?php echo lang('Example evaluation help text here.') ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3" for="description_arabic"><?php echo lang('Description') ?> (<?php echo lang('Arabic') ?>)</label>

                <div class="col-sm-9">
                    <textarea id="description_arabic" class="form-control"
                              name="description_arabic"><?php echo(!empty($description_arabic) ? htmlfilter($description_arabic) : '') ?></textarea>

                    <p class="help-block"><?php echo lang('Example evaluation help text here.') ?></p>
                </div>
            </div>
            <div class="form-group">

                <label class="control-label col-sm-1" for="date"> <?php echo lang('Survey Date'); ?></label>
                <div class="col-sm-3">
                    <input name="date" id="date" type="text" class="form-control date" value="<?php echo(!empty($date) ? htmlfilter($date) : '') ?>"/>
                    <?php echo Validator::get_html_error_message('date'); ?>
                </div>

                <label class="control-label col-sm-1" for="start_time"> <?php echo lang('Start Time'); ?></label>
                <div class="col-sm-3">
                <input name="start_time" id="start_time" type="text" class="form-control time" value="<?php echo(!empty($time_start) ? htmlfilter($time_start) : '') ?>"/>
                <?php echo Validator::get_html_error_message('start_time'); ?>
                </div>

                    <label class="control-label col-sm-1" for="end_time"> <?php echo lang('End Time'); ?></label>
                <div class="col-sm-3">
                    <input name="end_time" id="end_time" type="text" class="form-control time" value="<?php echo(!empty($time_end) ? htmlfilter($time_end) : '') ?>"/>
                    <?php echo Validator::get_html_error_message('end_time'); ?>
            </div>
            </div>

            <hr class="page-block m-t-0">

            <?php if(intval($survey->get_type()) !== Orm_Survey::TYPE_COURSES) { ?>

                <div class="box p-a-1">

                    <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>"
                            type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false"
                            aria-controls="filters">
                        <span class="fa fa-filter"></span>
                    </button>

                    <?php echo lang($survey->get_type(true)) ?>
                </div>

                <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
                    <div class="well">
                        <?php
                        switch ($survey->get_type()) {
                            case Orm_Survey::TYPE_ALUMNI :
                                echo Orm_User_Alumni::draw_filters();
                                break;

                            case Orm_Survey::TYPE_EMPLOYER :
                                echo Orm_User_Employer::draw_filters();
                                break;

                            case Orm_Survey::TYPE_FACULTY :
                                echo Orm_User_Faculty::draw_filters();
                                break;

                            case Orm_Survey::TYPE_STAFF :
                                echo Orm_User_Staff::draw_filters();
                                break;

                            case Orm_Survey::TYPE_STUDENTS :
                                echo Orm_User_Student::draw_filters();
                                break;
                        }
                        ?>
                    </div>
                </div>

                <hr class="page-block m-t-0">

            <?php } ?>

            <div class="pull-right">
                <button class="btn" type="submit" <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-floppy-o"></span><?php echo lang('Send') ?></button>
            </div>
            <input type="hidden" name="id" value="<?php echo(!empty($id) ? (int)$id : 0) ?>">
            <input type="hidden" name="survey_id" value="<?php echo (int)$survey->get_id() ?>">
        <?php echo form_close() ?>
    </div>
</div>
<script type="text/javascript">
    $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true, startDate: '<?php echo date('Y-m-d') ?>'});
    $('.time').timepicker({ 'scrollDefault': 'now' });
    $('#duration').timepicker({
        defaultTime: '00:00',
        minuteStep: 1,
        showSeconds: false,
        showMeridian: false,
        showInputs: false,
        orientation: $('body').hasClass('right-to-left') ? { x: 'right', y: 'auto'} : { x: 'auto', y: 'auto'}
    });


//    $('input[name="method"]').change(function () {
//
//        $('div[data-method="1"]').toggle($('input[name="method"][value=1]').prop('checked'));
//        $('div[data-method="2"]').toggle($('input[name="method"][value=2]').prop('checked'));
//
//    });


//    $('#exam_form').submit(function(e){
//        e.preventDefault();
//
//        $.ajax({
//            type: "POST",
//            url: $(this).attr('action'),
//            data: $(this).serializeArray(),
//            dataType: 'JSON'
//        }).done(function (msg) {
//            if (msg.success) {
//                window.location.reload();
//            } else {
//                $('#ajaxModalDialog').html(msg.html);
//            }
//        });
//    });
</script>