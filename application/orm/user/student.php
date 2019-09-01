<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_User_Student extends Orm_User
{

    protected $class_type = __CLASS__;
    protected static $table_name = 'user_student';

    protected $user_id = 0;
    protected $college_id = 0;
    protected $department_id = 0;
    protected $program_id = 0;
    protected $level_of_study = 1;
    protected $status_id = 0;

    const LEVEL_1 = 1;
    const LEVEL_2 = 2;
    const LEVEL_3 = 3;
    const LEVEL_4 = 4;
    const LEVEL_5 = 5;
    const LEVEL_6 = 6;

    public static $level_of_studies = array(
        self::LEVEL_1 => 'First',
        self::LEVEL_2 => 'Second',
        self::LEVEL_3 => 'Third',
        self::LEVEL_4 => 'Fourth',
        self::LEVEL_5 => 'Fifth',
        self::LEVEL_6 => 'Sixth',
    );

    /**
     * @return User_Student_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('User_Student_Model', 'user');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_User_Student
     */
    public static function get_instance($id)
    {

        $id = intval($id);
        if (isset(self::$instances[$id])) {
            return self::$instances[$id];
        }

        return self::get_one(array('id' => $id));
    }

    /**
     * get all Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_User_Student[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_User_Student
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_User_Student();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return int
     */
    public static function get_count($filters = array())
    {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public function to_array_type()
    {
        $db_params = array();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['department_id'] = $this->get_department_id();
        $db_params['program_id'] = $this->get_program_id();
        $db_params['level_of_study'] = $this->get_level_of_study();
        $db_params['status_id'] = $this->get_status_id();

        return $db_params;
    }

    public function save()
    {
        $user_id = parent::save();

        $this->set_user_id($user_id);
        if($this->get_user_object_fields()) {
            self::get_model()->replace($this->to_array_type());
        }

        $this->status_log();

        $this->reset_user_object_fields();
        return $user_id;
    }

    private function status_log() {

        if (in_array('status_id', array_keys($this->get_user_object_fields()))) {
            $status_obj = new Orm_Student_Status_Log();
            $status_obj->set_semester_id(Orm_Semester::get_active_semester()->get_id());
            $status_obj->set_student_id($this->get_id());
            $status_obj->set_status_id($this->get_status_id());
            $status_obj->save();
        }
    }

    public function set_user_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('user_id', $value);
        $this->user_id = $value;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }

    public function set_college_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('college_id', $value);
        $this->college_id = $value;
    }

    public function get_college_id()
    {
        return $this->college_id;
    }

    public function set_department_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('department_id', $value);
        $this->department_id = $value;
    }

    public function get_department_id()
    {
        return $this->department_id;
    }

    public function set_program_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('program_id', $value);
        $this->program_id = $value;
    }

    public function get_program_id()
    {
        return $this->program_id;
    }

    public function set_status_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('status_id', $value);
        $this->status_id = $value;
    }

    public function get_status_id()
    {
        return $this->status_id;
    }

    public function set_level_of_study($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('level_of_study', $value);
        $this->level_of_study = $value;
    }

    public function get_level_of_study($to_string = false)
    {

        if ($to_string) {
            return (isset(self::$level_of_studies[$this->level_of_study]) ? self::$level_of_studies[$this->level_of_study] : '');
        }

        return $this->level_of_study;
    }

    public function fill_post_object()
    {

        $college_id = Orm::get_ci()->input->post('college_id');
        $department_id = Orm::get_ci()->input->post('department_id');
        $program_id = Orm::get_ci()->input->post('program_id');
        $level_of_study = Orm::get_ci()->input->post('level_of_study');
        $status_id = Orm::get_ci()->input->post('status_id');

//        Validator::required_field_validator('college_id', $college_id, lang('Invalid College!'));
//        Validator::required_field_validator('department_id', $department_id, lang('Invalid Department'));
//        Validator::required_field_validator('program_id', $program_id, lang('Invalid Program!'));

        $this->set_college_id($college_id);
        $this->set_department_id($department_id);
        $this->set_program_id($program_id);
        $this->set_level_of_study($level_of_study);
        $this->set_status_id($status_id);
    }

    /**
     * @return Orm_College
     */
    public function get_college_obj()
    {
        return Orm_College::get_instance($this->get_college_id());
    }

    /**
     * @return Orm_Department
     */
    public function get_department_obj()
    {
        return Orm_Department::get_instance($this->get_department_id());
    }

    /**
     * @return Orm_Program
     */
    public function get_program_obj()
    {
        return Orm_Program::get_instance($this->get_program_id());
    }

    public function draw_demographics($draw_general_info = true)
    {

        $html = parent::draw_demographics($draw_general_info);

        $html .= '<div class="row">';
        $html .= '<label class="col-sm-3">' . lang('College') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter($this->get_college_obj()->get_name() ?: '----');
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="row">';
        $html .= '<label class="col-sm-3">' . lang('Department') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter($this->get_department_obj()->get_name() ?: '----');
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="row">';
        $html .= '<label class="col-sm-3">' . lang('Program') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter($this->get_program_obj()->get_name() ?: '----');
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="row">';
        $html .= '<label class="col-sm-3">' . lang('Level of Study') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter(lang($this->get_level_of_study(true)) ?: '----');
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function draw_filters($full_filters = true,$semester=false)
    {

        $fltr = Orm::get_ci()->input->get_post('fltr');

        $html = parent::draw_filters();

        $html .= parent::draw_structure_filters($full_filters,$semester);

        $html .= '<input type="hidden" name="type" value="' . __CLASS__ . '" />';
        $html .= '<input type="hidden" name="fltr[class_type]" value="' . __CLASS__ . '" />';

        if($full_filters) {
            $html .= '<div class="form-group">';
            $html .= '<label class="col-sm-3">' . lang('Course') . '</label>';
            $html .= '<div class="col-sm-9">';
            $html .= '<select id="course_block" class="form-control" name="fltr[course_id]" onchange="get_sections_by_course(this, 0, 1);">';
            $html .= '<option value="">' . lang('All Course') . '</option>';
            if (isset($fltr['program_id'])) {
                foreach (Orm_Course::get_all(array('program_plan' => true, 'program_id' => $fltr['program_id'])) as $course) {
                    $selected = (isset($fltr['course_id']) && $fltr['course_id'] == $course->get_id() ? 'selected="selected"' : '');
                    $html .= '<option value="' . $course->get_id() . '" ' . $selected . '>' . htmlfilter($course->get_code()) . ' - ' . htmlfilter($course->get_name()) . '</option>';
                }
            }
            $html .= '</select>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label class="col-sm-3">' . lang('Course Section') . '</label>';
            $html .= '<div class="col-sm-9">';
            $html .= '<select id="section_block" class="form-control" name="fltr[section_id]">';
            $html .= '<option value="">' . lang('All Section') . '</option>';
            if (isset($fltr['course_id'])) {
                foreach (Orm_Course_Section::get_all(array('course_id' => $fltr['course_id'], 'semester_id' => Orm_Semester::get_active_semester()->get_id())) as $section) {
                    $selected = (isset($fltr['section_id']) && $fltr['section_id'] == $section->get_id() ? 'selected="selected"' : '');
                    $html .= '<option value="' . htmlfilter($section->get_id()) . '" ' . $selected . '>' . htmlfilter($section->get_section_no()) . '</option>';
                }
            }
            $html .= '</select>';
            $html .= '</div>';
            $html .= '</div>';

            //All level_of_study
            $html .= '<div class="form-group">';
            $html .= '<label class="col-sm-3">' . lang('Level of Study') . '</label>';
            $html .= '<div class="col-sm-9">';
            foreach (self::$level_of_studies as $key => $level_of_study) {
                $selected = (isset($fltr['level_of_study']) && is_array($fltr['level_of_study']) && in_array($key, $fltr['level_of_study']) ? 'checked="checked"' : '');
                $html .= '<div class="checkbox">';
                $html .= '<label>';
                $html .= '<input type="checkbox" class="px" value="' . htmlfilter($key) . '" ' . $selected . ' name="fltr[level_of_study][]">';
                $html .= '<span class="lbl">' . lang($level_of_study) . '</span>';
                $html .= '</label>';
                $html .= '</div>';
            }
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }

    public static function draw_find_users($input_name = 'user_id', $input_value = null, $label = null, $allowed_types = null, $role = null) {

        if(is_null($label)) {
            $label = lang('Student');
        }

        return parent::draw_find_users($input_name, $input_value, $label, [self::class], self::class);
    }
}

