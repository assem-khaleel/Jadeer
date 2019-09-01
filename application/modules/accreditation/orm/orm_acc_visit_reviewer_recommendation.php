<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Acc_Visit_Reviewer_Recommendation extends Orm {
    
    /**
    * @var $instances Orm_Acc_Visit_Reviewer_Recommendation[]
    */
    protected static $instances = array();
    protected static $table_name = 'acc_visit_reviewer_recommendation';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $visit_reviewer_id = 0;
    protected $recommendation = '';
    protected $type = '';
    protected $type_id = 0;
    protected $reviewer_id = 0;
    protected $date_added = '0000-00-00';

    const TYPE_INSTITUTION = 'institution';
    const TYPE_PROGRAM = 'program';

    /**
    * @return Acc_Visit_Reviewer_Recommendation_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Acc_Visit_Reviewer_Recommendation_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Acc_Visit_Reviewer_Recommendation
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        
        if(isset(self::$instances[$id])) {
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
    * @return Orm_Acc_Visit_Reviewer_Recommendation[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Acc_Visit_Reviewer_Recommendation
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Acc_Visit_Reviewer_Recommendation();
    }
    
    /**
    * get count
    *
    * @param array $filters
    * @return int
    */
    public static function get_count($filters = array()) {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }
    
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['visit_reviewer_id'] = $this->get_visit_reviewer_id();
        $db_params['recommendation'] = $this->get_recommendation();
        $db_params['type'] = $this->get_type();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['reviewer_id'] = $this->get_reviewer_id();
        $db_params['date_added'] = $this->get_date_added();
        
        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {

            $this->set_date_added(date('Y-m-d'));

            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }
        
        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }
    
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_visit_reviewer_id($value) {
        $this->add_object_field('visit_reviewer_id', $value);
        $this->visit_reviewer_id = $value;
    }
    
    public function get_visit_reviewer_id() {
        return $this->visit_reviewer_id;
    }
    
    public function set_recommendation($value) {
        $this->add_object_field('recommendation', $value);
        $this->recommendation = $value;
    }
    
    public function get_recommendation() {
        return $this->recommendation;
    }
    
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }
    
    public function get_type() {
        return $this->type;
    }
    
    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }
    
    public function get_type_id() {
        return $this->type_id;
    }
    
    public function set_reviewer_id($value) {
        $this->add_object_field('reviewer_id', $value);
        $this->reviewer_id = $value;
    }
    
    public function get_reviewer_id() {
        return $this->reviewer_id;
    }

    public function get_reviewer_obj() {
        return Orm_User::get_instance($this->get_reviewer_id());
    }

    public function get_visit_reviewer_obj() {
        return Orm_Acc_Visit_Reviewer::get_instance($this->get_visit_reviewer_id());
    }

    public function set_date_added($value) {
        $this->add_object_field('date_added', $value);
        $this->date_added = $value;
    }

    public function get_date_added() {
        return $this->date_added;
    }

    private $action_plans = null;

    /**
     * @return Orm_Acc_Pre_Visit_Reviewer_Action_Plan[]
     */
    public function get_action_plans() {

        if(is_null($this->action_plans)) {
            $this->action_plans = Orm_Acc_Visit_Reviewer_Action_Plan::get_all(['recommendation_id' => $this->get_id()]);
        }

        return $this->action_plans;
    }

    public function get_progress() {

        $progress = 0;
        $count = 0;

        foreach ($this->get_action_plans() as $action_plan) {
            $progress += $action_plan->get_progress();
            $count++;
        }

        return $count ? ($progress / $count) : 0;
    }

}

