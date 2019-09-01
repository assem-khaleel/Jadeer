<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_User_Faculty extends Orm_User
{

    protected $class_type = __CLASS__;
    protected static $table_name = 'user_faculty';

    protected $user_id = 0;
    protected $role_id = 0;
    protected $college_id = 0;
    protected $department_id = 0;
    protected $program_id = 0;
    protected $service_time = 1;
    protected $job_position = 0;
    protected $academic_rank = 1;
    protected $general_specialty = '';
    protected $specific_specialty = '';
    protected $graduate_from = '';
    protected $degree = 0;

    const ACADEMIC_RANK_TUTOR = 1;
    const ACADEMIC_RANK_TEACHING_ASSISTANT = 2;
    const ACADEMIC_RANK_LECTURER = 3;
    const ACADEMIC_RANK_ASSISTANT_PROF = 4;
    const ACADEMIC_RANK_ASSOCIATE_PROF = 5;
    const ACADEMIC_RANK_PROFESSOR = 6;

    public static $academic_ranks = array(
        self::ACADEMIC_RANK_TUTOR => 'Tutor',
        self::ACADEMIC_RANK_TEACHING_ASSISTANT => 'Teaching Assistant',
        self::ACADEMIC_RANK_LECTURER => 'Lecturer',
        self::ACADEMIC_RANK_ASSISTANT_PROF => 'Assistant Prof.',
        self::ACADEMIC_RANK_ASSOCIATE_PROF => 'Associate Prof.',
        self::ACADEMIC_RANK_PROFESSOR => 'Professor',
    );

    const JOB_POSITION_MEMBERS = 0;
    const JOB_POSITION_ADMINISTRATORS = 1;
    const JOB_POSITION_LECTURER = 2;

    public static $job_positions = array(
        self::JOB_POSITION_ADMINISTRATORS => 'College Administrators',
        self::JOB_POSITION_MEMBERS => 'Faculty Members',
        self::JOB_POSITION_LECTURER => 'Instructors & Lecturer'
    );

    const SERVICE_TIME_1_TO_3 = 1;
    const SERVICE_TIME_4_TO_6 = 2;
    const SERVICE_TIME_7_TO_10 = 3;
    const SERVICE_TIME_11_TO_15 = 4;
    const SERVICE_TIME_16_TO_20 = 5;
    const SERVICE_TIME_21_TO_25 = 6;
    const SERVICE_TIME_25_TO_ANY = 7;

    public static $service_times = array(
        self::SERVICE_TIME_1_TO_3 => '1 to 3 years',
        self::SERVICE_TIME_4_TO_6 => '4 to 6 years',
        self::SERVICE_TIME_7_TO_10 => '7 to 10 years',
        self::SERVICE_TIME_11_TO_15 => '11 to 15 years',
        self::SERVICE_TIME_16_TO_20 => '16 to 20 years',
        self::SERVICE_TIME_21_TO_25 => '21 to 25 years',
        self::SERVICE_TIME_25_TO_ANY => '> 25 years'
    );

    /**
     * @return User_Faculty_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('User_Faculty_Model', 'user');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_User_Faculty
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
     * @return Orm_User_Faculty[] | int
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
     * @return Orm_User_Faculty
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_User_Faculty();
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
        $db_params['role_id'] = $this->get_role_id();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['department_id'] = $this->get_department_id();
        // Edited by shamaseen
        $db_params['program_id'] = $this->get_program_id();
        //$db_params['program_id'] = $this->get_program_id();

        $db_params['service_time'] = $this->get_service_time();
        $db_params['job_position'] = $this->get_job_position();
        $db_params['academic_rank'] = $this->get_academic_rank();
        $db_params['general_specialty'] = $this->get_general_specialty();
        $db_params['specific_specialty'] = $this->get_specific_specialty();
        $db_params['graduate_from'] = $this->get_graduate_from();
        $db_params['degree'] = $this->get_degree();

        return $db_params;
    }

    public function save()
    {
        $user_id = parent::save();

        $this->set_user_id($user_id);
        if($this->get_user_object_fields())
        {
            self::get_model()->replace($this->to_array_type());
        }

        $this->reset_user_object_fields();
        return $user_id;
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

    public function set_role_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('role_id', $value);
        $this->role_id = $value;
    }

    public function get_role_id()
    {
        return $this->role_id;
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
        // Edited by shamaseen
        $value = intval($value);
        $this->add_user_object_fields('program_id', $value);
        $this->program_id = $value;
    }

    public function get_program_id()
    {
        return $this->program_id;
    }

    public function set_service_time($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('service_time', $value);
        $this->service_time = $value;
    }

    public function get_service_time($to_string = false)
    {

        if ($to_string) {
            if ($this->service_time >= 1 && $this->service_time <= 3) {
                return self::$service_times[self::SERVICE_TIME_1_TO_3];
            } elseif ($this->service_time >= 4 && $this->service_time <= 6) {
                return self::$service_times[self::SERVICE_TIME_4_TO_6];
            } elseif ($this->service_time >= 7 && $this->service_time <= 10) {
                return self::$service_times[self::SERVICE_TIME_7_TO_10];
            } elseif ($this->service_time >= 11 && $this->service_time <= 15) {
                return self::$service_times[self::SERVICE_TIME_11_TO_15];
            } elseif ($this->service_time >= 16 && $this->service_time <= 20) {
                return self::$service_times[self::SERVICE_TIME_16_TO_20];
            } elseif ($this->service_time >= 21 && $this->service_time <= 25) {
                return self::$service_times[self::SERVICE_TIME_21_TO_25];
            } elseif ($this->service_time > 25) {
                return self::$service_times[self::SERVICE_TIME_25_TO_ANY];
            }
        }

        return $this->service_time;
    }

    public function set_job_position($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('job_position', $value);
        $this->job_position = $value;
    }

    public function get_job_position($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$job_positions[$this->job_position]) ? self::$job_positions[$this->job_position] : '');
        }
        return $this->job_position;
    }

    public function set_academic_rank($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('academic_rank', $value);
        $this->academic_rank = $value;
    }

    public function get_academic_rank($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$academic_ranks[$this->academic_rank]) ? self::$academic_ranks[$this->academic_rank] : '');
        }
        return $this->academic_rank;
    }

    public function set_general_specialty($value) {
        $this->add_user_object_fields('general_specialty', $value);
        $this->general_specialty = $value;
    }

    public function get_general_specialty() {
        return $this->general_specialty;
    }

    public function set_specific_specialty($value) {
        $this->add_user_object_fields('specific_specialty', $value);
        $this->specific_specialty = $value;
    }

    public function get_specific_specialty() {
        return $this->specific_specialty;
    }

    public function set_graduate_from($value) {
        $this->add_user_object_fields('graduate_from', $value);
        $this->graduate_from = $value;
    }

    public function get_graduate_from() {
        return $this->graduate_from;
    }

    public function set_degree($value) {
        $this->add_user_object_fields('degree', $value);
        $this->degree = $value;
    }

    public function get_degree() {
        return $this->degree;
    }

    public function fill_post_object()
    {

        $role_id = Orm::get_ci()->input->post('role_id');
        $college_id = Orm::get_ci()->input->post('college_id');
        $department_id = Orm::get_ci()->input->post('department_id');
        // edited by shamaseen
       // $program_in = Orm::get_ci()->input->post('program_in[]');
      //  $program_id = json_encode($program_in);
        $program_id = Orm::get_ci()->input->post('program_id');
        $service_time = Orm::get_ci()->input->post('service_time');
        $job_position = Orm::get_ci()->input->post('job_position');
        $academic_rank = Orm::get_ci()->input->post('academic_rank');

        //TODO: These fields are not mandatory
//        Validator::required_field_validator('college_id', $college_id, lang('Invalid College!'));
//        Validator::required_field_validator('department_id', $department_id, lang('Invalid Department'));
//        Validator::required_field_validator('program_id', $program_id, lang('Invalid Program!'));

        $this->set_role_id($role_id);
        $this->set_college_id($college_id);
        $this->set_department_id($department_id);
        $this->set_program_id($program_id);
        $this->set_service_time($service_time);
        $this->set_job_position($job_position);
        $this->set_academic_rank($academic_rank);
    }

    /**
     * @return Orm_Role
     */
    public function get_role_obj()
    {
        return Orm_Role::get_instance($this->get_role_id());
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
        $html .= '<label class="col-sm-3">' . lang('Role') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter($this->get_role_obj()->get_name() ?: '----');
        $html .= '</div>';
        $html .= '</div>';

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
        $html .= '<label class="col-sm-3">' . lang('Service Time') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter($this->get_service_time() ? lang($this->get_service_time()): '----') . ' ' . lang('Years');
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="row">';
        $html .= '<label class="col-sm-3">' . lang('Job Position') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter(lang($this->get_job_position(true)));
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="row">';
        $html .= '<label class="col-sm-3">' . lang('Academic Rank') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter(lang($this->get_academic_rank(true)));
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function draw_filters($full_filters = false, $type=0)
    {

        $fltr = Orm::get_ci()->input->get_post('fltr');

        $html = parent::draw_filters();
        $html .= parent::draw_structure_filters();

        $html .= '<input type="hidden" name="type" value="' . __CLASS__ . '" />';
        $html .= '<input type="hidden" name="type_id" value="'.$type.'" />';
        $html .= '<input type="hidden" name="fltr[class_type]" value="' . __CLASS__ . '" />';

        if($full_filters) {
            $html .= '<div class="form-group">';
            $html .= '<label class="col-sm-3">' . lang('Role') . '</label>';
            $html .= '<div class="col-sm-9">';
            $html .= '<select name="fltr[role_id]" class="form-control" >';
            $html .= '<option value="">' . lang('All Role') . '</option>';
            foreach (Orm_Role::get_all() as $role) {
                $selected = (isset($fltr['role_id']) && $role->get_id() == $fltr['role_id'] ? 'selected="selected"' : '');
                $html .= '<option value="' . $role->get_id() . '" ' . $selected . '>' . htmlfilter($role->get_name()) . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
            $html .= '</div>';
        }

        //All Academic Rank
        $html .= '<div class="form-group">';
        $html .= '<label class="col-sm-3">' . lang('Academic Rank') . '</label>';
        $html .= '<div class="col-sm-9">';
        foreach (self::$academic_ranks as $key => $academic_rank) {
            $selected = (isset($fltr['academic_rank']) && is_array($fltr['academic_rank']) && in_array($key, $fltr['academic_rank']) ? 'checked="checked"' : '');
            $html .= '<div class="checkbox">';
            $html .= '<label>';
            $html .= '<input type="checkbox" class="px" value="' . htmlfilter($key) . '" ' . $selected . ' name="fltr[academic_rank][]">';
            $html .= '<span class="lbl">' . lang($academic_rank) . '</span>';
            $html .= '</label>';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '</div>';

        //All Job Position
        $html .= '<div class="form-group">';
        $html .= '<label class="col-sm-3">' . lang('Job Position') . '</label>';
        $html .= '<div class="col-sm-9">';
        foreach (self::$job_positions as $key => $job_position) {
            $selected = (isset($fltr['job_position']) && is_array($fltr['job_position']) && in_array($key, $fltr['job_position']) ? 'checked="checked"' : '');
            $html .= '<div class="checkbox">';
            $html .= '<label>';
            $html .= '<input type="checkbox" class="px" value="' . htmlfilter($key) . '" ' . $selected . ' name="fltr[job_position][]">';
            $html .= '<span class="lbl">' . lang($job_position) . '</span>';
            $html .= '</label>';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '</div>';

        //All Service Time
        $html .= '<div class="form-group">';
        $html .= '<label class="col-sm-3">' . lang('Service Time') . '</label>';
        $html .= '<div class="col-sm-9">';
        foreach (self::$service_times as $key => $service_time) {
            $selected = (isset($fltr['service_time']) && is_array($fltr['service_time']) && in_array($key, $fltr['service_time']) ? 'checked="checked"' : '');
            $html .= '<div class="checkbox">';
            $html .= '<label>';
            $html .= '<input type="checkbox" class="px" value="' . htmlfilter($key) . '" ' . $selected . ' name="fltr[service_time][]">';
            $html .= '<span class="lbl">' . lang($service_time) . '</span>';
            $html .= '</label>';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function draw_find_users($input_name = 'user_id', $input_value = null, $label = null, $allowed_types = null, $role = null) {

        if(is_null($label)) {
            $label = lang('Faculty');
        }

        return parent::draw_find_users($input_name, $input_value, $label, [self::class], self::class);
    }
}

