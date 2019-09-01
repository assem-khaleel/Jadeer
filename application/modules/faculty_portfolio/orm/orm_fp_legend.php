<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Legend extends Orm {
    
    /**
    * @var $instances Orm_Fp_Legend[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_legend';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $is_delete = 0;
    
    /**
    * @return Fp_Legend_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Legend_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Legend
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
    * @return Orm_Fp_Legend[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Legend
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Legend();
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

    /**
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['is_delete'] = $this->get_is_delete();
        
        return $db_params;
    }

    /**
     * @return int
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

    /**
     * @return bool
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @param $value
     */
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }

    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * @param $value
     */
    public function set_title_en($value) {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }

    /**
     * @return string
     */
    public function get_title_en() {
        return $this->title_en;
    }

    /**
     * @param $value
     */
    public function set_title_ar($value) {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }

    /**
     * @return string
     */
    public function get_title_ar() {
        return $this->title_ar;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_title($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_title_ar();
        }

        return $this->get_title_en();
    }

    /**
     * @param $value
     */
    public function set_is_delete($value) {
        $this->add_object_field('is_delete', $value);
        $this->is_delete = $value;
    }

    /**
     * @return int
     */
    public function get_is_delete() {
        return $this->is_delete;
    }


    /**
     * this function get items
     * @return int|Orm_Fp_Legend_Desc[]
     */
    public function get_items(){
        return Orm_Fp_Legend_Desc::get_all(['legend_id' => $this->get_id()], 0, 0, ['min']);
    }

    /**
     * this function get performance by rows by its user id
     * @param int $score the score of the call to be controller
     * @param int $legend_id the legend id of the call to be controller
     * @return string
     */
    public static function get_performance($score, $legend_id){
        $legends = Orm_Fp_Legend::get_instance($legend_id)->get_items();

        if(!count($legends)) {
            return lang('none legend');
        }

        foreach ($legends as $legend) {
            if($legend->check_range($score)){
                return $legend->get_legend();
            }
        }

        return $legends[0]->get_legend();
    }

    public function used() {
        if($this->get_id()==1){
            return true;
        }

        return boolval(Orm_Fp_Eva_Tabs::get_one(['legend_id' => $this->get_id()])->get_id());
    }

}

