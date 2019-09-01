<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 10:32 ص
 */
/* @var $quiz Orm_Tst_Exam*/
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/examination/quiz/section_manage/".($quiz->get_id()?: ''), array('id' => 'exam_form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Select Sections'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label" for="course_label"><?php echo lang('Course') ?></label>
                    <input id="course_label" type="text" readonly class="form-control" value="<?php echo htmlfilter($quiz->get_course_obj()->get_name()); ?>"/>
                </div>

                <div class="form-group">
                    <label class="control-label" for="sections"><?php echo lang('Course Sections'); ?></label>
                    <select name="sections[]" id="sections" class="form-control" multiple="multiple">
                        <?php foreach (Orm_Course_Section::get_all(['course_id'=>$quiz->get_course_id(), 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]) as $section){
                            $is_selected = false;

                            foreach ($quiz->get_sections() as $sec) {
                                $is_selected = ($sec == $section->get_id());

                                if($is_selected == true) {
                                    break;
                                }
                            }

                            ?>
                        <option value="<?php echo $section->get_id(); ?>"<?php echo $is_selected ? 'selected="selected"' : '' ?>>
                            <?php echo htmlfilter($section->get_section_no()); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <?php echo Validator::get_html_error_message('sections'); ?>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
                </button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                </button>
            </div>


        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">


    $('#exam_form').submit(function(e){
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

    $(document).ready(function() {
        $('#sections').select2({
            placeholder: '<?php echo lang('Select value');?>',
            allowClear: true
        });
        //make drooplist on top
        $('#sections').data('select2').$dropdown.css({"z-index":"2000"});
    });

    var find_onselect = function (course_id) {

        course_id = course_id || $('#course_id').val();
        $.ajax({
            type: "GET",
            url: "/examination/get_section/" + course_id,
            dataType: 'json'
        }).done(function (content) {
            var selector = $("#sections");

            selector.select2('destroy');
            selector.find("option").remove();

            if (content.success) {
                var row;
                for(var i=0; row = content.data[i]; i++) {
                    selector.append($('<option>').val(row.id).text(row.text))
                }

                selector.select2();
            }
        });
    }

</script>
