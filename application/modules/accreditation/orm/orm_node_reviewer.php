<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Node_Reviewer extends Orm
{

    /**
     * @var $instances Orm_Node_Reviewer[]
     */
    protected static $instances = array();
    protected static $table_name = 'node_reviewer';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $node_id = 0;
    protected $reviewer_id = 0;

    private static $reviewer_nodes;
    private static $reviewer_children_nodes;

    /**
     * @return Node_Reviewer_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Node_Reviewer_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Node_Reviewer
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
     * @return Orm_Node_Reviewer[] | int
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
     * @return Orm_Node_Reviewer
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Node_Reviewer();
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
        $db_params['node_id'] = $this->get_node_id();
        $db_params['reviewer_id'] = $this->get_reviewer_id();

        return $db_params;
    }

    public function save() {

        $exist = self::get_one($this->to_array());
        if ($exist->get_id()) {
            $this->set_id($exist->get_id());
        }

        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);

            Orm_Notification::send_node_notification(Orm_User::get_logged_user()->get_id(), $this->get_reviewer_id(), $this->get_node_id(), Orm_Notification_Template::ADMIN_ADD_USER_ON_NODE);
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
        $this->id = (int) $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_node_id($value)
    {
        $this->add_object_field('node_id',$value);
        $this->node_id = (int) $value;
    }

    public function get_node_id()
    {
        return $this->node_id;
    }

    public function set_reviewer_id($value)
    {
        $this->add_object_field('reviewer_id',$value);
        $this->reviewer_id = (int) $value;
    }

    public function get_reviewer_id()
    {
        return $this->reviewer_id;
    }

    /**
     * @return Orm_User
     */
    public function get_user_obj()
    {
        return Orm_User::get_instance($this->get_reviewer_id());
    }

    public function get_node_obj()
    {
        return Orm_Node::get_instance($this->get_node_id());
    }

    public static function get_reviewer_systems($reviewer_id = null)
    {

        if(is_null($reviewer_id)){
            $reviewer_id = Orm_User::get_logged_user()->get_id();
        }

        return array_merge(array(0), self::get_model()->get_reviewer_systems($reviewer_id));
    }

    private static $assign_reviewer_nodes = array();

    /**
     * @param $system_number
     * @param null $reviewer_id
     * @return Orm_Node[]
     */
    public static function get_reviewer_nodes($system_number, $reviewer_id = null)
    {

        if(is_null($reviewer_id)){
            $reviewer_id = Orm_User::get_logged_user()->get_id();
        }

        if(!isset(self::$assign_reviewer_nodes[$system_number][$reviewer_id])) {
            $reviewer_nodes = self::get_all(array('reviewer_id' => $reviewer_id, 'system_number' => $system_number), 0, 0, array('nr.node_id ASC'));
            $nodes = array();
            foreach ($reviewer_nodes as $reviewer_node) {
                $node = $reviewer_node->get_node_obj();
                $nodes[$node->get_id()] = $node;
            }

            self::$assign_reviewer_nodes[$system_number][$reviewer_id] = $nodes;
        }

        return self::$assign_reviewer_nodes[$system_number][$reviewer_id];
    }

    public static function get_reviewer_tree($system_number, $reviewer_id = null)
    {

        if(is_null($reviewer_id)){
            $reviewer_id = Orm_User::get_logged_user()->get_id();
        }

        if (!isset(self::$reviewer_nodes[$system_number][$reviewer_id])) {

            $tree = array();
            foreach (self::get_reviewer_nodes($system_number, $reviewer_id) as $node) {
                self::fill_tree_parent_node($tree, $node);
                self::fill_tree_children_node($tree, $node);
            }

            self::$reviewer_nodes[$system_number][$reviewer_id] = $tree;
        }

        return self::$reviewer_nodes[$system_number][$reviewer_id];
    }

    public static function fill_tree_parent_node(&$tree, Orm_Node $node)
    {
        $tree[$node->get_id()] = $node;

        if ($node->get_parent_id()) {
            self::fill_tree_parent_node($tree, $node->get_parent_obj());
        }
    }

    public static function fill_tree_children_node(&$tree, Orm_Node $node)
    {
        $tree += Orm_Node::get_all(array('system_number' => $node->get_system_number(), 'parent_lft' => $node->get_parent_lft(), 'parent_rgt' => $node->get_parent_rgt()));
    }

    public static function get_reviewer_children_tree($system_number, $reviewer_id = null)
    {

        if(is_null($reviewer_id)){
            $reviewer_id = Orm_User::get_logged_user()->get_id();
        }

        if (!isset(self::$reviewer_children_nodes[$system_number][$reviewer_id])) {

            $tree = array();
            foreach (self::get_reviewer_nodes($system_number, $reviewer_id) as $node) {
                self::fill_tree_children_node($tree, $node);
            }

            self::$reviewer_children_nodes[$system_number][$reviewer_id] = $tree;
        }

        return self::$reviewer_children_nodes[$system_number][$reviewer_id];
    }

    public static function get_parent_reviewers($node_id, &$reviewers = array())
    {

        $node = Orm_Node::get_instance($node_id);

        if ($node->get_parent_id()) {

            foreach (self::get_all(array('node_id' => $node->get_parent_id())) as $reviewer) {
                $reviewers[$reviewer->get_reviewer_id()] = $reviewer;
            }

            self::get_parent_reviewers($node->get_parent_id(), $reviewers);
        }
    }

    public static function get_node_reviewers($node_id)
    {
        $reviewers = self::get_all(array('node_id' => $node_id));
        self::get_parent_reviewers($node_id, $reviewers);

        return $reviewers;
    }

    public static function get_nodes($user_id = null) {
        if (is_null($user_id)) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $nodes = array();

        foreach (self::get_reviewer_systems() as $system_number) {
            $nodes += self::get_reviewer_nodes($system_number,$user_id);
        }

        return $nodes;
    }
}

