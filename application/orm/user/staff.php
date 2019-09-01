<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_User_Staff extends Orm_User
{

    protected $class_type = __CLASS__;
    protected static $table_name = 'user_staff';

    protected $user_id = 0;
    protected $role_id = 0;
    protected $unit_id = 0;
    protected $campus_id = 0;
    protected $college_id = 0;
    protected $department_id = 0;
    protected $program_id = 0;
    protected $service_time = 1;
    protected $job_position = 0;

    const JOB_POSITION_MEMBERS = 0;
    const JOB_POSITION_ADMINISTRATORS = 1;

    public static $job_positions = array(
        self::JOB_POSITION_ADMINISTRATORS => 'Unit Administrators',
        self::JOB_POSITION_MEMBERS => 'Staff Members'
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
     * @return User_Staff_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('User_Staff_Model', 'user');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_User_Staff
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
     * @return Orm_User_Staff[] | int
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
     * @return Orm_User_Staff
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_User_Staff();
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
        $db_params['unit_id'] = $this->get_unit_id();
        $db_params['campus_id'] = $this->get_campus_id();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['department_id'] = $this->get_department_id();
        $db_params['program_id'] = $this->get_program_id();
        $db_params['service_time'] = $this->get_service_time();
        $db_params['job_position'] = $this->get_job_position();

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

    public function set_unit_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('unit_id', $value);
        $this->unit_id = $value;
    }

    public function get_unit_id()
    {
        return $this->unit_id;
    }

    public function set_campus_id($value)
    {
        $value = intval($value);
        $this->add_user_object_fields('campus_id', $value);
        $this->campus_id = $value;
    }

    public function get_campus_id()
    {
        return $this->campus_id;
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

    public function fill_post_object()
    {
        $role_id = Orm::get_ci()->input->post('role_id');
        $unit_id = Orm::get_ci()->input->post('unit_id');
        $campus_id = Orm::get_ci()->input->post('campus_id');
        $college_id = Orm::get_ci()->input->post('college_id');
        $department_id = Orm::get_ci()->input->post('department_id');
        $program_id = Orm::get_ci()->input->post('program_id');
        $service_time = Orm::get_ci()->input->post('service_time');
        $job_position = Orm::get_ci()->input->post('job_position');

        $this->set_role_id($role_id);
        $this->set_unit_id($unit_id);
        $this->set_campus_id($campus_id);
        $this->set_college_id($college_id);
        $this->set_department_id($department_id);
        $this->set_program_id($program_id);
        $this->set_service_time($service_time);
        $this->set_job_position($job_position);
    }

    /**
     * @return Orm_Role
     */
    public function get_role_obj()
    {
        return Orm_Role::get_instance($this->get_role_id());
    }

    /**
     * @return Orm_Unit
     */
    public function get_unit_obj()
    {
        return Orm_Unit::get_instance($this->get_unit_id());
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
        $html .= '<label class="col-sm-3">' . lang('Unit') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter($this->get_unit_obj()->get_name() ?: '----');
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
        $html .= '<label class="col-sm-3">' . lang('Job Position') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter(lang($this->get_job_position(true)));
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="row">';
        $html .= '<label class="col-sm-3">' . lang('Service Time') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= htmlfilter($this->get_service_time(true) ? lang($this->get_service_time(true)): '----');
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

        //All Units
        $html .= '<div class="form-group">';
        $html .= '<label class="col-sm-3">' . lang('Unit') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select name="fltr[unit_id]" class="form-control">';
        $html .= '<option value="0">'.lang('All Units').'</option>';
        foreach (Orm_Unit::get_all() as $unit) {
            $selected = (isset($fltr['unit_id']) && $unit->get_id() == $fltr['unit_id'] ? 'selected="selected"' : '');
            $html .= '<option value="' . htmlfilter($unit->get_id()) . '" ' . $selected . '>' . htmlfilter($unit->get_name()) . '</option>';
        }
        $html .= '</select>';
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
            $label = lang('Staff');
        }

        return parent::draw_find_users($input_name, $input_value, $label, [self::class], self::class);
    }
}

