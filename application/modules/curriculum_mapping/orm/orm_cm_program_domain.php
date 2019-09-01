<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Program_Domain extends Orm
{

    /**
     * @var $instances Orm_Cm_Program_Domain[]
     */
    protected static $instances = array();
    protected static $table_name = 'cm_program_domain';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $program_id = 0;
    protected $domain_type = 0;
    protected $semester_id = 0;

    const TYPE_NCAAA_OLD = 1;
    const TYPE_NCAAA_NEW = 2;
    const TYPE_WELL_KNOWN = 3;
    const TYPE_OTHER = 4;

    /**
     * @return Cm_Program_Domain_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Cm_Program_Domain_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Cm_Program_Domain
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
     * Get all rows as Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Cm_Program_Domain[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Cm_Program_Domain
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Cm_Program_Domain();
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
        $db_params['program_id'] = $this->get_program_id();
        $db_params['domain_type'] = $this->get_domain_type();
        $db_params['semester_id'] = $this->get_semester_id();

        return $db_params;
    }

    public function save()
    {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif ($this->get_object_fields()) {
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
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_program_id($value)
    {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }

    public function get_program_id()
    {
        return $this->program_id;
    }

    public function set_domain_type($value)
    {
        $this->add_object_field('domain_type', $value);
        $this->domain_type = $value;
    }

    public function get_domain_type()
    {
        return $this->domain_type;
    }

    public function set_semester_id($value)
    {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }

    public function get_semester_id()
    {
        return $this->semester_id;
    }


    /**
     * get learning domain type using learning domain type id
     * @param $type => learning domain type id
     * @return string
     */
    public static function get_type_name($type)
    {
        return Orm_Learning_Domain_Type::get_instance($type)->get_name();

    }
}

