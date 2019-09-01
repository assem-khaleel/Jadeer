<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 01/05/17
 * Time: 04:56 م
 * @var $section_students Orm_User_Student[]
 * @var $exam Orm_Tst_Exam
 */

/** @var Orm_Course_Section[] $course_sections */
/** @var Orm_Tst_Exam $exam */

?>

<div class="col-md-12 col-lg-12 m-t-1 ">
    <div class="alert clearfix">
        <div class="col-md-6">
            <h5 class="m-b-0 m-t-0"> <?php echo lang('Exam Name').': ' ?><?php echo htmlfilter($exam->get_name()); ?></h5>
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-12 m-t-0 ">
        <div class="table-primary">
            <div class="table-header">
                <?php echo filter_block('/proctor/filter', "/examination/proctor/exam_student_attendance/{$exam->get_id()}", ['keyword'],'ajax_block'); ?>
            </div>
            <div class="table-responsive m-a-0">
                <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-1 text-center"><?php echo lang('Attended'); ?></td>
                    <td class="col-md-5"><?php echo lang('Student ID'); ?></td>
                    <td class="col-md-6"><?php echo lang('Student name'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php

                $monitors = $exam->get_monitor_ids();

                $active = $exam->is_active();
                $active = $active && (in_array(Orm_user::get_logged_user_id() ,$monitors) || Orm_user::get_logged_user_id()==$exam->get_teacher_id());

                if($active) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <div class="col-md-9">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" id="select_all" class="custom-control-input"/>
                                    <span class="custom-control-indicator"></span>&nbsp;
                                </label>
                            </div>
                        </td>
                        <td colspan="2" class="">
                            <label for="select_all"><?php echo htmlfilter(lang('Select All')); ?></label>
                        </td>
                    </tr>
                    <?php
                }

                if(count($course_sections)):  ?>
                    <?php foreach ($course_sections as $course_section): ?>
                        <tr>
                            <td  colspan="3" class="col-md-12 alert clearfix">
                                <?php echo htmlfilter(lang('Section').': '.$course_section->get_name()); ?>
                            </td>
                        </tr>
                        <?php foreach ($course_section->get_students() as $student): ?>
                        <?php $attended = Orm_Tst_Exam_Attendance::get_one(['exam_id'=>$exam->get_id(), 'student_id'=>$student->get_user_id()])->get_id(); ?>
                        <tr>
                            <td class="text-center" id="td_<?php echo htmlfilter($student->get_user_id()); ?>">
                                <?php if ($active): ?>
                                <div class="col-md-9 ">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" onchange="attend($(this))" value="1" data-id="<?php echo htmlfilter($student->get_user_id()); ?>"
                                               data-exam-id="<?php echo htmlfilter($exam->get_id()); ?>" class="custom-control-input" <?php echo $attended? 'checked="checked"':''; ?> >
                                        <span class="custom-control-indicator"></span>&nbsp;
                                    </label>
                                </div>
                                <?php else: ?>
                                    <?php if ($attended){ ?>
                                <span class="fa fa-check" aria-hidden="true"></span>
                                    <?php }else{ ?>
                                <span class="fa fa-times" aria-hidden="true"></span>
                                    <?php } ?>
                                <?php endif; ?>
                                </td>
                                <td><?php echo htmlfilter($student->get_user_obj()->get_login_id()); ?></td>
                                <td><?php echo htmlfilter($student->get_user_obj()->get_full_name()); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Students for this Exam'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
        </div>
</div>

<?php if (!empty($pager)): ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php endif; ?>

<script>

    $('#select_all').change(function() {
        if($(this).prop('checked')){
            $('input[data-exam-id]').each(function(){
                if(!$(this).prop('checked')){
                    $(this).prop('checked', true).change();
                }
            });
        }
    });


    function attend (student) {
        var student_id = student.data('id'),
            attend = student.prop("checked"),
            exam_id = student.attr('data-exam-id');

        if(!attend) {
            $('#select_all').prop('checked', false);
        }

        $.ajax({
            type: "POST",
            url: "/examination/proctor/attend",
            data: {'student_id': student_id, 'exam_id': exam_id, 'attend': attend},
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                student.prop("checked",msg.absence);
            }
//            else {
//                $('#ajaxModalDialog').html(msg.html);
//            }
        });
//            .fail(function () {
//            window.location.reload();
//        });
        return false;
    }

</script>

