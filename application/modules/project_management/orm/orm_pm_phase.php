<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pm_Phase extends Orm {
    
    /**
    * @var $instances Orm_Pm_Phase[]
    */
    protected static $instances = array();
    protected static $table_name = 'pm_phase';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $desc_en = '';
    protected $desc_ar = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    
    /**
    * @return Pm_Phase_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pm_Phase_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pm_Phase
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
    * @return Orm_Pm_Phase[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pm_Phase
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pm_Phase();
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

    /** convert object to array
    */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        
        return $db_params;
    }

    /** save object
    */
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

    /** delete object
    */
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
    
    public function set_title_en($value) {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }
    
    public function get_title_en() {
        return $this->title_en;
    }
    
    public function set_title_ar($value) {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }
    
    public function get_title_ar() {
        return $this->title_ar;
    }
    
    public function set_desc_en($value) {
        $this->add_object_field('desc_en', $value);
        $this->desc_en = $value;
    }
    
    public function get_desc_en() {
        return $this->desc_en;
    }
    
    public function set_desc_ar($value) {
        $this->add_object_field('desc_ar', $value);
        $this->desc_ar = $value;
    }
    
    public function get_desc_ar() {
        return $this->desc_ar;
    }
    
    public function set_start_date($value) {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }
    
    public function get_start_date() {
        return $this->start_date;
    }
    
    public function set_end_date($value) {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }
    
    public function get_end_date() {
        return $this->end_date;
    }
    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }

    /** draw report of the project using this function to draw charts
     * return json request
     *
     * @return object
     */
    public static function gantt_chart_data($fillter){
        $index = 1;
        $data = [];
        if($fillter['project_type'] == 0){
            $project_info = Orm_Sp_Project::get_instance($fillter['project_id']);
        }else{
            $project_info = Orm_Pm_Project::get_instance($fillter['project_id']);
        }
        $start_date = new DateTime($project_info->get_start_date());
        $end_date = new DateTime($project_info->get_end_date());
        $project_duration = $end_date->diff($start_date);
        $data['data'][] = ['id' => $index , 'text' => $project_info->get_title() , 'start_date' => date('d-m-Y',strtotime($project_info->get_start_date()))  , 'duration' =>  $project_duration->days, 'open' => true ];
        $index ++;
        $project_phases = Orm_Pm_Project_Phase::get_all($fillter);
        foreach ($project_phases as $phase){
            $phase_info = Orm_Pm_Phase::get_instance($phase->get_phase_id());
            $start_date = new DateTime($phase_info->get_start_date());
            $end_date = new DateTime($phase_info->get_end_date());
            $phase_duration = $end_date->diff($start_date);
            $data['data'][] = ['id' => $index , 'text' => $phase_info->get_title() , 'start_date' => date('d-m-Y',strtotime($phase_info->get_start_date())), 'duration' =>  $phase_duration->days , 'open' => true , 'parent' => 1];
            $parent_temp = $index;
            $index ++;
            $sub_phases = Orm_Pm_Sub_Phase::get_all(['phase_id' => $phase_info->get_id()]);
            foreach ($sub_phases as $sub_phase){
                $start_date = new DateTime($sub_phase->get_start_date());
                $end_date = new DateTime($sub_phase->get_end_date());
                $phase_duration = $end_date->diff($start_date);
                $data['data'][] = ['id' => $index , 'text' => $sub_phase->get_title() , 'start_date' => date('d-m-Y',strtotime($sub_phase->get_start_date())) , 'duration' =>  $phase_duration->days , 'open' => true , 'parent' => $parent_temp];
                $parent_temp = $index;
                $index ++;
            }
        }
        return json_encode($data);
    }
    
}

