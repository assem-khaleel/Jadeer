<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Role extends Orm
{

    /**
     * @var $instances Orm_Role[]
     */
    protected static $instances = array();
    protected static $table_name = 'role';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $name = '';
    protected $credential = array();
    protected $admin_level = 1;

    const ROLE_NOT_ADMIN = 1;
    const ROLE_PROGRAM_ADMIN = 2;
    const ROLE_DEPARTMENT_ADMIN = 3;
    const ROLE_COLLEGE_ADMIN = 4;
    const ROLE_INSTITUTION_ADMIN = 5;
    const ROLE_TEACHER = 6;

    public static $admin_levels = array(
        self::ROLE_NOT_ADMIN => 'Not Admin',
        self::ROLE_PROGRAM_ADMIN => 'Program Admin',
        self::ROLE_DEPARTMENT_ADMIN => 'Department Admin',
        self::ROLE_COLLEGE_ADMIN => 'College Admin',
        self::ROLE_INSTITUTION_ADMIN => 'Institution Admin',
        self::ROLE_TEACHER => 'Teacher'
    );

    /**
     * @return Role_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Role_Model', 'user');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Role
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
     * @return Orm_Role[] | int
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
     * @return Orm_Role
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Role();
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

    public function to_array()
    {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['name'] = $this->get_name();
        $db_params['credential'] = json_encode($this->get_credential());
        $db_params['admin_level'] = $this->get_admin_level();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_name($value)
    {
        $this->add_object_field('name',$value);
        $this->name = $value;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_credential($value)
    {

        if(is_array($value)) {
            $this->add_object_field('credential', json_encode($value));
        } elseif (is_string($value)) {
            $this->add_object_field('credential', $value);
            $value = json_decode($value, true);
        }

        $this->credential = $value;
    }

    public function get_credential()
    {
        return $this->credential;
    }

    public function set_admin_level($value)
    {
        $this->add_object_field('admin_level',$value);
        $this->admin_level = $value;
    }

    public function get_admin_level($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$admin_levels[$this->admin_level]) ? self::$admin_levels[$this->admin_level] : '');
        }

        return $this->admin_level;
    }

    public static function draw_filters($fltr = array())
    {
        $html = '<div class="table-header">';
        //All College
        $html .= '<div class="form-group">';
        $html .= '<label for="college_block" class="col-sm-3">' . lang('College') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select id="college_block" name="fltr[college_id]" class="form-control" onchange="get_departments_by_college(this, 0, 1); $(\'#program_block\').html(\'<option value>' . lang('All Program') . '</option>\');">';
        $html .= '<option value="">' . lang('All College') . '</option>';
        foreach (Orm_College::get_all() as $college) {
            $selected = (isset($fltr['college_id']) && $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : '');
            $html .= '<option value="' . $college->get_id() . '" ' . $selected . '>' . htmlfilter($college->get_name()) . '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';

        //All Department
        $html .= '<div class="form-group">';
        $html .= '<label for="department_block" class="col-sm-3">' . lang('Department') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select id="department_block" name="fltr[department_id]" class="form-control" onchange="get_programs_by_department(this, 0, 1);">';
        $html .= '<option value="">' . lang('All Department') . '</option>';
        if (!empty($fltr['college_id'])) {
            foreach (Orm_Department::get_all(array('college_id' => $fltr['college_id'])) as $department) {
                $selected = (isset($fltr['department_id']) && $department->get_id() == $fltr['department_id'] ? 'selected="selected"' : '');
                $html .= '<option value="' . $department->get_id() . '" ' . $selected . '>' . htmlfilter($department->get_name()) . '</option>';
            }
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';

        //All Program
        $html .= '<div class="form-group">';
        $html .= '<label for="program_block" class="col-sm-3">' . lang('Program') . '</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select id="program_block" name="fltr[program_id]" class="form-control">';
        $html .= '<option value="">' . lang('All Program') . '</option>';
        if (!empty($fltr['department_id'])) {
            foreach (Orm_Program::get_all(array('department_id' => $fltr['department_id'])) as $program) {
                $selected = (isset($fltr['program_id']) && $program->get_id() == $fltr['program_id'] ? 'selected="selected"' : '');
                $html .= '<option value="' . $program->get_id() . '" ' . $selected . '>' . htmlfilter($program->get_name()) . '</option>';
            }
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    private static $level_roles;

    public static function get_role_ids_by_level($level)
    {
        if (empty(self::$level_roles[$level])) {
            $roles = array_column(self::get_model()->get_all(array('admin_level' => $level), 0, 0, array(), Orm::FETCH_ARRAY), 'id');
            self::$level_roles[$level] = empty($roles) ? array(-1) : $roles;
        }
        return self::$level_roles[$level];
    }
}

