<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Forms_Deadline extends Orm
{

    /**
     * @var $instances Orm_Fp_Forms_Deadline[]
     */
    protected static $instances = array();
    protected static $table_name = 'fp_forms_deadline';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $start_date = '0000-00-00 00:00:00';
    protected $end_date = '0000-00-00 00:00:00';
    protected $created_at = '0000-00-00 00:00:00';
    protected $updated_at = '0000-00-00 00:00:00';
    protected $deleted_at = 0;

    /**
     * @return Fp_Forms_Deadline_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Fp_Forms_Deadline_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Fp_Forms_Deadline
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
     * @return Orm_Fp_Forms_Deadline[] | int
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
     * @return Orm_Fp_Forms_Deadline
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Fp_Forms_Deadline();
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
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['deleted_at'] = $this->get_deleted_at();
        $db_params['created_at'] = $this->get_created_at();
        $db_params['updated_at'] = $this->get_updated_at();
        return $db_params;
    }

    public function save()
    {
        $this->set_updated_at(date('Y-m-d H:i:s'));
        if ($this->get_object_status() == 'new') {
            $this->set_created_at(date('Y-m-d H:i:s'));
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

    public function set_start_date($value)
    {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }

    public function get_start_date()
    {
        return $this->start_date;
    }

    public function set_end_date($value)
    {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }

    public function get_end_date()
    {
        return $this->end_date;
    }

    public function set_created_at($value)
    {
        $this->add_object_field('created_at', $value);
        $this->created_at = $value;
    }

    public function get_created_at()
    {
        return $this->created_at;
    }

    public function set_updated_at($value)
    {
        $this->add_object_field('updated_at', $value);
        $this->updated_at = $value;
    }

    public function get_updated_at()
    {
        return $this->updated_at;
    }

    public function set_deleted_at($value)
    {
        $this->add_object_field('deleted_at', $value);
        $this->deleted_at = $value;
    }

    public function get_deleted_at()
    {
        return $this->deleted_at;
    }

    /**
     * change the value for input " is_delete" from 0 to one
     * @param $deadline_id
     */
    public function soft_delete($deadline_id)
    {
        $data = Orm_Fp_Forms_Result::get_one(['deadline_id'=>$deadline_id]);
        if(!$data->get_id()){
            $this->set_deleted_at(1);
            self::save();
            Validator::set_success_flash_message(lang('Successfully Deleted'), true);
            redirect('/faculty_performance/faculty_settings/');
        }
        else{

            Validator::set_error_flash_message(lang("This Deadline Forms has data, You can't remove it"),true);
            redirect('/faculty_performance/faculty_settings/');
        }

    }

    private static $current_deadline = null;

    /**
     * get the deadline that is current depends on today date
     * @return int|null
     */
    public static function get_current_deadline()
    {

        if(is_null(self::$current_deadline)) {
            self::$current_deadline = self::get_model()->current_deadline();
        }

       return self::$current_deadline;
        
    }

    /**
     * time validation for date to check if the date are not repeated and the range is correct
     * @param $start
     * @param $end
     * @param int $id
     * @return bool
     */
    public function time_check($start, $end , $id=0)
    {
        $start_date= strtotime($start);
        $end_date= strtotime($end);
        $current = strtotime(date('Y-m-d'));

        // check if start date less than the current date

        if ($start_date < $current) {
            Validator::set_error('start_date', lang('Start Date Must equal or Larger than the current date'));
            return false;
        }
        // End date must be larger than start date

        if ($end_date < $start_date) {
            Validator::set_error('start_date', lang('Start Date Must be Less than End Date'));
            return false;
        }

        $date = $this->get_model()->start_end($start, $end, $id);

        if ($date != 0) {
            Validator::set_error('start_date', lang('Date Range are Conflict with another deadline'));
            return false;
        }

        $this->set_start_date($start);
        $this->set_end_date($end);

        return true;


    }


}

