<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Is_Industrial_Relation extends Orm {

    /**
     * @var $instances Orm_Is_Industrial_Relation[]
     */
    protected static $instances = array();
    protected static $table_name = 'is_industrial_relation';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $industrial_id = 0;
    protected $rubric_row_id = 0;

    /**
     * @return Is_Industrial_Relation_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Is_Industrial_Relation_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Is_Industrial_Relation
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
     * @return Orm_Is_Industrial_Relation[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Is_Industrial_Relation
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Is_Industrial_Relation();
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
        $db_params['industrial_id'] = $this->get_industrial_id();
        $db_params['rubric_row_id'] = $this->get_rubric_row_id();

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
    public function set_industrial_id($value) {
        $this->add_object_field('industrial_id', $value);
        $this->industrial_id = $value;
    }

    /**
     * @return int
     */
    public function get_industrial_id() {
        return $this->industrial_id;
    }

    /**
     * @param $value
     */
    public function set_rubric_row_id($value) {
        $this->add_object_field('rubric_row_id', $value);
        $this->rubric_row_id = $value;
    }

    /**
     * @return int
     */
    public function get_rubric_row_id() {
        return $this->rubric_row_id;
    }

    /**
     * this function get rubric ids by its id
     * @param int $id the id of the get skill ids to be controller
     * @return array the call function
     */
    public function get_rubric_ids($id)
    {
        $rubric_ids = array();
        foreach ($this->get_all(['industrial_id'=>$id]) as $industrial) {
            $rubric_ids[] = $industrial->get_rubric_row_id();
        }
        return $rubric_ids;
    }

    /**
     * this function get skill id by its industrial id
     * @param int $industrial_id the industrial id of the get skill ids to be controller
     * @return int|Orm_Is_Industrial_Relation[] the object call function
     */
    public static function get_skills_id($industrial_id) {
        return self::get_all(array('industrial_id' => $industrial_id));
    }

    /**
     * this function get skill ids by its industrial skills
     * @param int $industrial_skills the industrial skills  of the get skill ids to be controller
     * @return array the call function
     */
    public static function get_skill_ids($industrial_skills) {

        $skill_ids = array();

        foreach (self::get_skills_id($industrial_skills) as $skill) {
            $skill_ids[$skill->get_rubric_row_id()] = $skill->get_rubric_row_id();
        }

        return $skill_ids;
    }

    /**
     * this function get rubric obj
     * @return Orm_Rb_Rubrics the object call function
     */
    public function get_rubric_obj()
    {
        return Orm_Rb_Rubrics::get_instance($this->get_rubric_row_id());
    }


}

