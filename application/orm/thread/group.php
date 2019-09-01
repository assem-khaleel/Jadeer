<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Thread_Group extends Orm {
    
    /**
    * @var $instances Orm_Thread_Group[]
    */
    protected static $instances = array();
    protected static $table_name = 'thread_group';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $group_name_ar = '';
    protected $group_desc_ar = '';
    protected $group_name_en = '';
    protected $group_desc_en = '';
    protected $creator_id = 0;

    private $object = null;

    private static $types = [
        'Orm_Thread_Group_Members' => 'Custom',
        'Orm_Course_Section' => 'System'
    ];

    /**
    * @return Thread_Group_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Thread_Group_Model', 'thread');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Thread_Group
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
    * @return Orm_Thread_Group[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Thread_Group
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Thread_Group();
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
        $db_params['group_name_ar'] = $this->get_group_name_ar();
        $db_params['group_desc_en'] = $this->get_group_desc_en();
        $db_params['group_name_en'] = $this->get_group_name_en();
        $db_params['group_desc_ar'] = $this->get_group_desc_ar();
        $db_params['creator_id'] = $this->get_creator_id();
        
        return $db_params;
    }
    
    public function save() {

        if(!is_null($this->object)) {
            return;
        }

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
    
    public function delete() {

        if(!is_null($this->object)) {
            return;
        }

        return self::get_model()->delete($this->get_id());
    }

    public function set_object($value) {
        $this->object = $value;
    }

    public function get_object() {
        return $this->object;
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_group_name_ar($value) {
        $this->add_object_field('group_name_ar', $value);
        $this->group_name_ar = $value;
    }

    public function get_group_name_ar() {
        return $this->group_name_ar;
    }

    public function set_group_name_en($value) {
        $this->add_object_field('group_name_en', $value);
        $this->group_name_en = $value;
    }

    public function get_group_name_en() {
        return $this->group_name_en;
    }

    public function get_group_name($lang = UI_LANG) {
        if ($lang == 'arabic') {
            return $this->get_group_name_ar();
        }
        return $this->get_group_name_en();
    }
    
    public function set_group_desc_ar($value) {
        $this->add_object_field('group_desc_ar', $value);
        $this->group_desc_ar = $value;
    }

    public function get_group_desc_ar() {
        return $this->group_desc_ar;
    }

    public function set_group_desc_en($value) {
        $this->add_object_field('group_desc_en', $value);
        $this->group_desc_en = $value;
    }

    public function get_group_desc_en() {
        return $this->group_desc_en;
    }

    public function get_group_desc($lang = UI_LANG) {
        if ($lang == 'arabic') {
            return $this->get_group_desc_ar();
        }
        return $this->get_group_desc_en();
    }
    
    public function set_creator_id($value) {
        $this->add_object_field('creator_id', $value);
        $this->creator_id = $value;
    }
    
    public function get_creator_id() {
        return $this->creator_id;
    }

    public static function get_types() {
        return self::$types;
    }

    private $members_count = null;

    public function members_count()
    {
        if(is_null($this->members_count)) {
            $this->members_count = 0;

            if(!is_null($this->object)) {

                $object = $this->get_object();

                switch (get_class($object)) {

                    case Orm_Course_Section::class : /** @var $object Orm_Course_Section */
                        $this->members_count = Orm_Course_Section_Student::get_count(array('section_id' => $object->get_id()));
                        break;

                }

            } else {
                $this->members_count = Orm_Thread_Group_Members::get_count(['group_id' => $this->get_id()]);
            }
        }

        return $this->members_count;

    }

    public static function get_system_groups($filters = array(), $page = 0, $per_page = 10, $orders = array()){

        $i = 0;
        $count = 0;
        $list = array();

        if(Orm_User::has_role_teacher()) {
            $filters['in_id'] = Orm_Course_Section_Teacher::get_section_ids();
            $filters['semester_id'] = Orm_Semester::get_current_semester()->get_id();

            $sections = Orm_Course_Section::get_all($filters, $page, $per_page, $orders);

            foreach ($sections as $section) {
                $list[$i]['id'] = $section->get_id();
                $list[$i]['object'] = $section;
                $list[$i]['name_en'] = $section->get_name();
                $list[$i]['name_ar'] = $section->get_name();
                $list[$i]['desc_en'] = $section->get_course_obj()->get_name_en();
                $list[$i]['desc_ar'] = $section->get_course_obj()->get_name_ar();

                $i++;
            }

            $count = Orm_Course_Section::get_count($filters);
        }

        $groups = array();

        if($list) {
            foreach ($list as $row) {
                $group = new Orm_Thread_Group();
                $group->set_id($row['id']);
                $group->set_object($row['object']);
                $group->set_group_name_en($row['name_en']);
                $group->set_group_name_ar($row['name_ar']);
                $group->set_group_desc_en($row['desc_en']);
                $group->set_group_desc_ar($row['desc_ar']);

                $groups[] = $group;
            }
        }

        return array($groups, $count);
    }

}

