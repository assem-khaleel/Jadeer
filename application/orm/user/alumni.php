<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_User_Alumni extends Orm_User
{

    protected $class_type = __CLASS__;
    protected static $table_name = 'user_alumni';

    protected $user_id = 0;
    protected $college_id = 0;
    protected $department_id = 0;
    protected $program_id = 0;
    protected $graduated = 0;
    protected $job_status = 0;
    protected $professional_category = 0;
    protected $activity = 0;
    protected $employer_id = 0;

    const GRADUATED_0_TO_1 = 1;
    const GRADUATED_2_TO_4 = 2;
    const GRADUATED_5_TO_7 = 3;
    const GRADUATED_8_TO_10 = 4;
    const GRADUATED_10_TO_ANY = 5;

    public static $graduation = array(
        self::GRADUATED_0_TO_1 => '> 1 year',
        self::GRADUATED_2_TO_4 => '2 to 4 years',
        self::GRADUATED_5_TO_7 => '5 to 7 years',
        self::GRADUATED_8_TO_10 => '8 to 10 years',
        self::GRADUATED_10_TO_ANY => '< 10 years',
    );

    const JOB_STATUS_LOOKING = 0;
    const JOB_STATUS_CONTINUING = 1;
    const JOB_STATUS_EMPLOYED_PUBLIC_SECTOR = 2;
    const JOB_STATUS_EMPLOYED_PRIVATE_SECTOR = 3;

    public static $jobs_status = array(
        self::JOB_STATUS_LOOKING => 'Looking for Job',
        self::JOB_STATUS_CONTINUING => 'Continuing Further Studies',
        self::JOB_STATUS_EMPLOYED_PUBLIC_SECTOR => 'Employed in Public Sector',
        self::JOB_STATUS_EMPLOYED_PRIVATE_SECTOR => 'Employed in Private Sector'
    );

    const PROFESSIONAL_CATEGORY_MANAGERS = 0;
    const PROFESSIONAL_CATEGORY_STAFF = 1;
    const PROFESSIONAL_CATEGORY_TECHNICAL = 2;
    const PROFESSIONAL_CATEGORY_INTERMEDIATE = 3;
    const PROFESSIONAL_CATEGORY_OTHER = 4;

    public static $professional_categories = array(
        self::PROFESSIONAL_CATEGORY_MANAGERS => 'Managers and executives',
        self::PROFESSIONAL_CATEGORY_STAFF => 'Professional staff',
        self::PROFESSIONAL_CATEGORY_TECHNICAL => 'Technician and specialized staff',
        self::PROFESSIONAL_CATEGORY_INTERMEDIATE => 'Intermediate staff',
        self::PROFESSIONAL_CATEGORY_OTHER => 'Other'
    );

    const ACTIVITY_ADMIN = 0;
    const ACTIVITY_EDUCATION = 1;
    const ACTIVITY_HEALTH = 2;
    const ACTIVITY_SOCIAL = 3;
    const ACTIVITY_LEGAL = 4;
    const ACTIVITY_SERVICES = 5;
    const ACTIVITY_FOOD_SERVICES = 6;
    const ACTIVITY_ENGINEERING = 7;
    const ACTIVITY_TRANSPORTATION = 8;
    const ACTIVITY_FINANCE = 9;
    const ACTIVITY_RETAIL = 10;
    const ACTIVITY_MANUFACTURING = 11;
    const ACTIVITY_AGRICULTURE = 12;
    const ACTIVITY_OTHER = 13;

    public static $activities = array(
        self::ACTIVITY_ADMIN => 'Public Administration',
        self::ACTIVITY_EDUCATION => 'Education',
        self::ACTIVITY_HEALTH => 'Health Services',
        self::ACTIVITY_SOCIAL => 'Social Services',
        self::ACTIVITY_LEGAL => 'Legal Services',
        self::ACTIVITY_SERVICES => 'Recreational Services/Tourism/Art & Culture/Leisure',
        self::ACTIVITY_FOOD_SERVICES => 'Accommodation and Food Services',
        self::ACTIVITY_ENGINEERING => 'Engineering/Technology',
        self::ACTIVITY_TRANSPORTATION => 'Transportation/Utilities (e.g. hydro, water)',
        self::ACTIVITY_FINANCE => 'Commerce/Finance/Accounting/Marketing/Banking',
        self::ACTIVITY_RETAIL => 'Retail/Wholesale Trade',
        self::ACTIVITY_MANUFACTURING => 'Manufacturing/Construction',
        self::ACTIVITY_AGRICULTURE => 'Agriculture/Forestry/Fishing/Mining/Environmental',
        self::ACTIVITY_OTHER => 'Other'
    );

    /**
     * @return User_Alumni_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('User_Alumni_Model','user');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_User_Alumni
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
     * @return Orm_User_Alumni[] | int
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
     * @return Orm_User_Alumni
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_User_Alumni();
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
        $db_params['graduated'] = $this->get_graduated();
//        $db_params['job_status'] = $this->get_job_status();
//        $db_params['professional_category'] = $this->get_professional_category();
//        $db_params['activity'] = $this->get_activity();
//        $db_params['employer_id'] = $this->get_employer_id();

        return $db_params;
    }

    public function save()
    {
        $user_id = parent::save();

        $this->set_user_id($user_id);
        if($this->get_user_object_fields()) {
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

    public function set_employer_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('employer_id', $value);
        $this->employer_id = $value;
    }

    public function get_employer_id()
    {
        return $this->employer_id;
    }

    public function set_graduated($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('graduated', $value);
        $this->graduated = $value;
    }

    public function get_graduated($to_string = false)
    {

        if ($to_string) {
            return $this->graduated < 2001 ? lang('Not Defined') : ($this->graduated - 1) .' / '. $this->graduated . ' ( ' . ($this->graduated - 580) . ' / ' . ($this->graduated - 579) . ' )';
        }
        return $this->graduated;
    }

    public function set_job_status($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('job_status', $value);
        $this->job_status = $value;
    }

    public function get_job_status($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$jobs_status[$this->job_status]) ? self::$jobs_status[$this->job_status] : '');
        }
        return $this->job_status;
    }

    public function set_professional_category($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('professional_category', $value);
        $this->professional_category = $value;
    }

    public function get_professional_category($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$professional_categories[$this->professional_category]) ? self::$professional_categories[$this->professional_category] : '');
        }
        return $this->professional_category;
    }

    public function set_activity($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('activity', $value);
        $this->activity = $value;
    }

    public function get_activity($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$activities[$this->activity]) ? self::$activities[$this->activity] : '');
        }
        return $this->activity;
    }

    public function fill_post_object()
    {

        $college_id = Orm::get_ci()->input->post('college_id');
        $department_id = Orm::get_ci()->input->post('department_id');
        $program_id = Orm::get_ci()->input->post('program_id');
        $graduated = Orm::get_ci()->input->post('graduated');

//        Validator::required_field_validator('college_id', $college_id, lang('Invalid College!'));
//        Validator::required_field_validator('department_id', $department_id, lang('Invalid Department'));
//        Validator::required_field_validator('program_id', $program_id, lang('Invalid Program!'));

        $this->set_college_id($college_id);
        $this->set_department_id($department_id);
        $this->set_program_id($program_id);
        $this->set_graduated($graduated);
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
        $html .= '<label class="col-sm-3">' . lang('Graduated') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter($this->get_graduated(true));
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function draw_filters($full_filters = false)
    {

        $fltr = Orm::get_ci()->input->get_post('fltr');

        $html = parent::draw_filters();
        $html .= parent::draw_structure_filters();

        $html .= '<input type="hidden" name="type" value="' . __CLASS__ . '" />';
        $html .= '<input type="hidden" name="fltr[class_type]" value="' . __CLASS__ . '" />';

        //All Graduated
        $html .= '<div class="form-group">';
        $html .= '<label class="col-sm-3">' . lang('Graduated') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select name="fltr[graduated]" class="form-control">';
        $html .= '<option value="" >'.lang('Not Specified').'</option>';
        for ($i = date("Y"); $i >= 2001 ; $i--) {
            $selected = (isset($fltr['graduated']) && $fltr['graduated'] == $i ? 'selected="selected"' : '');
            $html .= '<option value="' . $i . '"' . $selected .'>'. ($i-1) . '/' . ($i) . ' (' . ($i-580) .' / '. ($i-579) . ')' .'</option>';
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function draw_find_users($input_name = 'user_id', $input_value = null, $label = null, $allowed_types = null, $role = null) {

        if(is_null($label)) {
            $label = lang('Alumni');
        }

        return parent::draw_find_users($input_name, $input_value, $label, [self::class], self::class);
    }
}

