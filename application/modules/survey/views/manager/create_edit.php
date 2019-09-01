<?php echo form_open('/survey/save', 'id="survey_form"') ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="panel-title">
                <?php
                if (empty($id)) {
                    echo lang('Create').' '.lang('Survey');
                } else {
                    echo lang('Edit').' '.lang('Survey');
                }
                ?>
            </span>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="control-label" for="title_english">
                    <?php echo lang('Survey Title'). ' (' . lang('English') . ')'; ?> *
                </label>
                <input type="text" class="form-control" id="title_english" name="title_english"
                       value="<?php echo htmlfilter((!empty($title_english) ? $title_english : '')); ?>"/>
                <?php echo Validator::get_html_error_message('title_english'); ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="title_arabic">
                    <?php echo lang('Survey Title'). ' (' . lang('Arabic') . ')'; ?> *
                </label>
                <input type="text" class="form-control" id="title_arabic" name="title_arabic"
                       value="<?php echo htmlfilter((!empty($title_arabic) ? $title_arabic : '')); ?>"/>
                <?php echo Validator::get_html_error_message('title_arabic'); ?>
            </div>

            <input type="hidden" name="type" value="<?php echo intval(Orm_Survey::check_role_type($type)) ?>">
            <?php /* ?>
            <div class="form-group">
                <label class="control-label" for="type">
                    <?php echo lang('Type') ?>: *
                </label>
                <select class="form-control" id="type" name="type">
                    <option value=""><?php echo lang('Select One') ?></option>
                    <?php
                    foreach (Orm_Survey::$survey_types as $survey_const => $survey_type) {
                        $selected = ((!empty($type) AND $survey_const == $type) ? 'selected = "selected"' : '');
                        echo '<option value="' . htmlfilter($survey_const) . '" ' . htmlfilter($selected) . '>' . htmlfilter(lang($survey_type)) . '</option>';
                    }
                    ?>
                </select>
                <?php echo Validator::get_html_error_message('type'); ?>
            </div>
            */ ?>

            <?php if (empty($id)) { ?>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="copy_flag" id="copy_flag"
                               value="1" <?php echo(!empty($copy_flag) ? 'checked="checked"' : ''); ?>
                               onclick="change_mode(this);"/>
                        <span class="lbl"><?php echo lang('Copy an Existing Survey') ?></span>
                    </label>
                </div>

                <div class="form-group" id="copy" style="display: none;">
                    <label class="control-label" for="survey_id">
                        <?php echo lang('Existing Survey') ?>: *
                    </label>
                    <select name="survey_id" id="survey_id" class="form-control" onchange="copy_name();">
                        <option value=""><?php echo lang('Select One') ?></option>
                        <?php
                        foreach (Orm_Survey::get_all() as $survey) {
                            $selected = ((!empty($survey_id) AND $survey->get_id() == $survey_id) ? 'selected = "selected"' : '');
                            echo '<option survey_type="' . htmlfilter($survey->get_type()) . '" title_arabic="' . htmlfilter($survey->get_title_arabic()) . '" title_english="' . htmlfilter($survey->get_title_english()) . '" value="' . htmlfilter($survey->get_id()) . '" ' . htmlfilter($selected) . '>' . lang($survey->get_type(true)) . ' : ' . htmlfilter($survey->get_title()) . '</option>';
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('survey_id'); ?>
                </div>

            <?php } ?>

            <hr class="panel-wide"/>

            <button class="btn " <?php echo data_loading_text() ?> type="submit" name="go_to" value="save">
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save and Continue Later'); ?>
            </button>

            <button class="btn " <?php echo data_loading_text() ?> type="submit" name="go_to" value="go_next">
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save & Go Next'); ?>
            </button>

            <input type="hidden" name="id" value="<?php echo htmlfilter((empty($id) ? 0 : $id)); ?>"/>
        </div>
    </div>
<?php echo form_close() ?>

<?php if (empty($id)) { ?>
    <script>

        function copy_name() {
            if ($('#survey_id').val()) {
                var option = '#survey_id option:selected';

                var now = new Date();

                var month = now.getMonth() + 1;
                var day = now.getDate();
                var year = now.getFullYear();
                var date = day + "/" + month + "/" + year;

                $('#title_arabic').val($(option).attr('title_arabic') + ' ' + date);
                $('#title_english').val($(option).attr('title_english') + ' ' + date);
                $('#type').val($(option).attr('survey_type'));
            } else {
                $('#title_arabic').val('');
                $('#title_english').val('');
                $('#type').val('');
            }
        }

        function change_mode(elem) {

            if ($(elem).is(':checked')) {
                $('#copy').show();
            } else {
                $('#copy').hide();
            }

        }

        change_mode($('#copy_flag'));

    </script>
<?php } ?>
