<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 23/10/17
 * Time: 13:30
 */

class Orm_Rb_Rubrics_Course extends Orm_Rb_Rubrics {

    /**
     * @return bool
     */
    public static function is_valid() {
        $course_id = intval(self::get_ci()->input->get_post('extra_value'));

        Validator::less_than_validator('extra_value', $course_id, 1, lang('You have to select course'));

        return Validator::success();
    }
    /**
     * this function get properties
     * @param string $error the error of the get properties to be call function
     * @param string $value the value of the get properties to be call function
     * @return string the html view
     */
    public static function get_properties($error ='', $value='') {
        $course = lang('Select Course');
        $name = Orm_Course::get_instance($value)->get_name();
        return <<<HTML
                <div class="form-group">
                    <label class="control-label">$course</label>
                    <input id="course_label" type="text" onclick="find_courses(this,'course_id','course_label')" readonly
                           class="form-control" value="$name"/>
                    <input id="course_id" name="extra_value" type="hidden"  value="$value"/>
                    $error
                </div>
HTML;
    }

    /**
     * this function draw
     * @return string the html call function
     */
    public function draw()
    {
        $title = lang('Course name');
        $value = Orm_Course::get_instance($this->get_extra_data())->get_name();

        return <<<HTML
        <div class="form-group">
            <label class="control-label"> $title </label>
            <label class="form-control">$value</label>
        </div>
HTML;

    }
    /**
     * this function has invitation
     * @return bool the call function
     */
    public function has_invitation(){
        return false;
    }

    public function check_invitation()
    {
        if(!Orm_User::check_credential([Orm_User::USER_FACULTY])){
            return false;
        }

        $course_id = $this->get_extra_data();

        return boolval(Orm_Course_Section::get_one([
            'teacher_id'=> Orm_User::get_logged_user_id(),
            'course_id' => $course_id,
            'semester_id' => Orm_Semester::get_active_semester_id()
        ])->get_id());
    }

    /**
     * this function answer draw
     * @return string the html call function
     */
    public function answer_draw()
    {
        $course_title  = lang('Course name');
        $section_title = lang('Section');
        $student_title  = lang('Student list');

        $select_section_title = lang('Select Sections');
        $select_student_title = lang('Select Student');

        $select_title = lang('Select');

        $course = Orm_Course::get_instance($this->get_extra_data())->get_name();


        $user_id    = intval($this->get_ci()->input->get_post('user_id'));
        $section_id =  intval($this->get_ci()->input->get_post('section_id'));

        $course_select = "";
        
        foreach(Orm_Course_Section::get_all(['teacher_id' => Orm_User::get_logged_user_id(), 'course_id'=>$this->get_extra_data()]) as $section) {
            $selected = $section->get_id()==$section_id? 'selected="selected"': '';
            $course_select .= "<option {$selected} value='{$section->get_id()}'>{$section->get_name()}</option>\n";
        }

        $user_select = "";

        foreach(Orm_Course_Section::get_instance($section_id)->get_students() as $student) {
            $selected = $student->get_user_id()==$user_id? 'selected="selected"': '';
            $user_select .= "<option {$selected} value='{$student->get_user_id()}'>{$student->get_user_obj()->get_full_name()}</option>\n";
        }


        return <<<HTML
        <div class="form-group">
            <label class="control-label"> $course_title </label>
            <label class="form-control">$course</label>
        </div>
        
        <div class="form-group">
            <label class="control-label"> $section_title </label>
            <select class="form-control" id="section_id" name="section_id">
<option value="">$select_section_title</option>                
$course_select
            </select>
        </div>
        
        <div class="form-group">
            <label class="control-label"> $student_title </label>
            <select class="form-control" id="user_id" name="user_id">
<option value="">$select_student_title</option>
$user_select
            </select>
        </div>
        
        <div class="form-group">
            <button type="button" class="btn btn-primary" id="select_student">$select_title</button>
        </div>

<script>
    $('#section_id').change(function(){
        $.get('/rubrics/assigned/get_students/'+$('#section_id').val())
        .success(function(d){
            $('#user_id').html(d);
        })
    });
    
    $('#select_student').click(function(){
        $('#answer_form').find('[name="csrf_test_name"]').remove();
        $('#answer_form').attr('method', 'get').submit();
    })
    
</script>

HTML;

    }
}