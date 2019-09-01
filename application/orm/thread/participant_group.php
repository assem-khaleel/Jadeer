<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Thread_Participant_Group extends Orm {
    
    /**
    * @var $instances Orm_Thread_Participant_Group[]
    */
    protected static $instances = array();
    protected static $table_name = 'thread_participant_group';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $thread_id = 0;
    protected $type_class = '';
    protected $type_id = 0;
    
    /**
    * @return Thread_Participant_Group_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Thread_Participant_Group_Model', 'thread');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Thread_Participant_Group
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
    * @return Orm_Thread_Participant_Group[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Thread_Participant_Group
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Thread_Participant_Group();
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
        $db_params['thread_id'] = $this->get_thread_id();
        $db_params['type_class'] = $this->get_type_class();
        $db_params['type_id'] = $this->get_type_id();
        
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
    
    public function set_thread_id($value) {
        $this->add_object_field('thread_id', $value);
        $this->thread_id = $value;
    }
    
    public function get_thread_id() {
        return $this->thread_id;
    }
    
    public function set_type_class($value) {
        $this->add_object_field('type_class', $value);
        $this->type_class = $value;
    }
    
    public function get_type_class() {
        return $this->type_class;
    }
    
    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }
    
    public function get_type_id() {
        return $this->type_id;
    }
    
    public static function prepare_participan($thread_id, $to) {

        $result = array();

        if ($to && is_array($to)) {
            foreach ($to as $participan) {
                $data = explode('-', $participan);
                $class = isset($data[0]) ? $data[0] : Orm_User::class;
                $id = isset($data[1]) ? $data[1] : 0;

                $participant_group = self::get_one(['thread_id' => $thread_id, 'type_class' => $class, 'type_id' => $id]);
                $participant_group->set_thread_id($thread_id);
                $participant_group->set_type_class($class);
                $participant_group->set_type_id($id);
                $participant_group->save();

                switch ($class) {
                    case Orm_User::class:
                        $result[] = $id;
                        break;

                    case Orm_Thread_Group::class:
                        $result = array_merge(array_column(Orm_Thread_Group_Members::get_model()->get_all(array('group_id' => $id), 0, 0, [], Orm::FETCH_ARRAY), 'user_id'), $result);
                        break;

                    case Orm_Course_Section::class:
                        $result = array_merge(array_column(Orm_Course_Section_Student::get_model()->get_all(array('section_id' => $id), 0, 0, [], Orm::FETCH_ARRAY), 'user_id'), $result);
                        break;
                }
            }
        }

        return array_unique($result);
    }

    public static function prepare_option($to) {

        $html = '';

        if (isset($to) && is_array($to)) {
            foreach ($to as $participant) {

                if (strpos($participant, '-') !== false) {
                    $data = explode('-', $participant);
                    $class = isset($data[0]) ? $data[0] : Orm_User::class;
                    $id = isset($data[1]) ? $data[1] : 0;
                } else {
                    $class = Orm_User::class;
                    $id = $participant;
                }

                switch ($class) {
                    case Orm_User::class:
                        $user = Orm_User::get_instance($id);
                        if (!is_null($user) && $user->get_id()) {
                            $html .= "<option selected='selected' value='{$participant}'>{$user->get_full_name()}</option>";
                        }
                        break;

                    case Orm_Thread_Group::class:
                        $group = Orm_Thread_Group::get_instance($id);
                        if (!is_null($group) && $group->get_id()) {
                            $html .= "<option selected='selected' value='{$participant}'>{$group->get_group_name()}</option>";
                        }
                        break;

                    case Orm_Course_Section::class:
                        $section = Orm_Course_Section::get_instance($id);
                        if (!is_null($section) && $section->get_id()) {
                            $html .= "<option selected='selected' value='{$participant}'>{$section->get_name()}</option>";
                        }
                        break;
                }
            }
        }

        return $html;

    }

}

