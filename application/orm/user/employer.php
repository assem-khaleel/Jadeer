<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_User_Employer extends Orm_User
{

    protected $class_type = __CLASS__;
    protected static $table_name = 'user_employer';

    protected $user_id = 0;
    protected $position = 0;
    protected $employed_duration = 0;
    protected $employed_in = 0;
    protected $activity = 0;
    protected $college_id = 0;
    protected $department_id = 0;
    protected $program_id = 0;

    const POSITION_TOP = 0;
    const POSITION_MID = 1;
    const POSITION_OPERATIONAL = 2;

    public static $positions = array(
        self::POSITION_TOP => 'Top-Level Management (CEO, General Manager, Director)',
        self::POSITION_MID => 'Mid-Level Management (Manager, Dept. Head)',
        self::POSITION_OPERATIONAL => 'Operational Management (Supervisor, Unit Head)'
    );

    const EMPLOYED_DUARTION_0_TO_1 = 1;
    const EMPLOYED_DUARTION_2_TO_3 = 2;
    const EMPLOYED_DUARTION_4_TO_6 = 3;
    const EMPLOYED_DUARTION_7_TO_10 = 4;
    const EMPLOYED_DUARTION_10_TO_ANY = 5;

    public static $employed_durations = array(
        self::EMPLOYED_DUARTION_0_TO_1 => '> 1 year',
        self::EMPLOYED_DUARTION_2_TO_3 => '2 to 3 years',
        self::EMPLOYED_DUARTION_4_TO_6 => '4 to 6 years',
        self::EMPLOYED_DUARTION_7_TO_10 => '7 to 10 years',
        self::EMPLOYED_DUARTION_10_TO_ANY => '< 10 years',
    );

    const POSITION_IN_MANAGERS = 0;
    const POSITION_IN_STAFF = 1;
    const POSITION_IN_TECHNICAL = 2;
    const POSITION_IN_INTERMEDIATE = 3;
    const POSITION_IN_OTHER = 4;

    public static $employed_positions = array(
        self::POSITION_IN_MANAGERS => 'Managers and executives',
        self::POSITION_IN_STAFF => 'Professional staff',
        self::POSITION_IN_TECHNICAL => 'Technician and specialized staff',
        self::POSITION_IN_INTERMEDIATE => 'Intermediate staff',
        self::POSITION_IN_OTHER => 'Other'
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
        self::ACTIVITY_ADMIN => 'Public Administration - federal, provincial, municipal',
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
     * @return User_Employer_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('User_Employer_Model','user');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_User_Employer
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
     * @return Orm_User_Employer[] | int
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
     * @return Orm_User_Employer
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_User_Employer();
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
//        $db_params['position'] = $this->get_position();
//        $db_params['employed_duration'] = $this->get_employed_duration();
//        $db_params['employed_in'] = $this->get_employed_in();
//        $db_params['activity'] = $this->get_activity();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['department_id'] = $this->get_department_id();
        $db_params['program_id'] = $this->get_program_id();

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

    public function set_position($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('position', $value);
        $this->position = $value;
    }

    public function get_position($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$positions[$this->position]) ? self::$positions[$this->position] : '');
        }
        return $this->position;
    }

    public function set_employed_duration($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('employed_duration', $value);
        $this->employed_duration = $value;
    }

    public function get_employed_duration($to_string = false)
    {
        if ($to_string) {
            if ($this->employed_duration >= 0 && $this->employed_duration <= 1) {
                return self::$employed_durations[self::EMPLOYED_DUARTION_0_TO_1];
            } elseif ($this->employed_duration >= 2 && $this->employed_duration <= 3) {
                return self::$employed_durations[self::EMPLOYED_DUARTION_2_TO_3];
            } elseif ($this->employed_duration >= 4 && $this->employed_duration <= 6) {
                return self::$employed_durations[self::EMPLOYED_DUARTION_4_TO_6];
            } elseif ($this->employed_duration >= 7 && $this->employed_duration <= 10) {
                return self::$employed_durations[self::EMPLOYED_DUARTION_7_TO_10];
            } elseif ($this->employed_duration > 10) {
                return self::$employed_durations[self::EMPLOYED_DUARTION_10_TO_ANY];
            }
        }
        return $this->employed_duration;
    }

    public function set_employed_in($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('employed_in', $value);
        $this->employed_in = $value;
    }

    public function get_employed_in($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$employed_positions[$this->employed_in]) ? self::$employed_positions[$this->employed_in] : '');
        }
        return $this->employed_in;
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

    public function fill_post_object()
    {

        $college_id = Orm::get_ci()->input->post('college_id');
        $department_id = Orm::get_ci()->input->post('department_id');
        $program_id = Orm::get_ci()->input->post('program_id');
        $position = Orm::get_ci()->input->post('position');
        $employed_duration = Orm::get_ci()->input->post('employed_duration');
        $employed_in = Orm::get_ci()->input->post('employed_in');
        $activity = Orm::get_ci()->input->post('activity');

        $this->set_college_id($college_id);
        $this->set_department_id($department_id);
        $this->set_program_id($program_id);
        $this->set_position($position);
        $this->set_employed_duration($employed_duration);
        $this->set_employed_in($employed_in);
        $this->set_activity($activity);
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

        return $html;
    }

    public static function draw_filters($full_filters = false)
    {

        $fltr = Orm::get_ci()->input->get_post('fltr');

        $html = parent::draw_filters();
        $html .= parent::draw_structure_filters();

        $html .= '<input type="hidden" name="type" value="' . __CLASS__ . '" />';
        $html .= '<input type="hidden" name="fltr[class_type]" value="' . __CLASS__ . '" />';

        return $html;
    }

    public static function draw_find_users($input_name = 'user_id', $input_value = null, $label = null, $allowed_types = null, $role = null) {

        if(is_null($label)) {
            $label = lang('Employer');
        }

        return parent::draw_find_users($input_name, $input_value, $label, [self::class], self::class);
    }

}

