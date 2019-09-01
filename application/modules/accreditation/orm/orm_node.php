<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Node extends Orm
{

    /**
     * @var $instances Orm_Node[]
     */
    protected static $instances = array();
    protected static $table_name = 'node';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $parent_id = 0;
    protected $parent_lft = 0;
    protected $parent_rgt = 0;
    protected $system_number = 0;
    protected $item_id = 0;
    protected $year = 0;
    protected $name = '';
    protected $class_type = '';
    protected $date_added = '0000-00-00 00:00:00';
    protected $is_deleted = 0;
    protected $is_finished = 0;
    protected $is_form = 1;
    protected $is_shared = 0;
    protected $shared_date = '0000-00-00 00:00:00';
    protected $due_date = '0000-00-00 00:00:00';
    protected $review_status = 'none';
    protected $properties = array();
    //
    private $children = array();
    private static $prepare_children = false;
    private static $college_parents;
    private static $program_parents;
    private static $course_parents;
    private static $course_section_parents;
    private static $semester_parents;
    private static $save_properties = false;
    //
    protected $link_pdf = false;
    protected $link_view = false;
    protected $link_edit = false;
    protected $link_send_to_review = false;
    //
    protected $orientation = 'portrait';
    protected $wizard_url = '/accreditation/wizard_step_2';

    const SYSTEM_INSTITUTIONAL = Node\ncai14\Root::class;
    const SYSTEM_SSR = Node\ncassr14\Root::class;
    const SYSTEM_PROGRAM = Node\ncapm14\Root::class;
    const SYSTEM_COURSE = Node\ncacm14\Root::class;
    const COLLEGE_SSR = Node\ncassr14\College::class;
    const COLLEGE_PROGRAM = Node\ncapm14\College::class;
//    const COLLEGE_COURSE = Node\ncacm14\College::class;
    const PROGRAM_SSR = Node\ncassr14\Program::class;
    const PROGRAM_PROGRAM = Node\ncapm14\Program::class;
//    const PROGRAM_COURSE = Node\ncacm14\Program::class;
    const COURSE_COURSE = Node\ncacm14\Course::class;
    const COURSE_SECTIONS = Node\ncacm14\Sections::class;
    const COURSE_SECTION = Node\ncacm14\Course_Section::class;

    const FORM_P_I  = Node\ncai14\Inst_Profile::class;
    const FORM_ER_I = Node\ncai14\Eligibility_Requirements::class;
    const FORM_PA_I = Node\ncai14\Provisional_Accreditation::class;
    const FORM_SES_I = Node\ncai14\Ses::class;
    const FORM_SSR_I = Node\ncai14\Ssri::class;

    const FORM_PP_P = Node\ncassr14\Program_Profile::class;
    const FORM_ER_P = Node\ncassr14\Eligibility_Requirements::class;
    const FORM_PA_P = Node\ncassr14\Provisional_Accreditation::class;
    const FORM_SES_P = Node\ncassr14\Ses::class;
    const FORM_SSR_P = Node\ncassr14\Ssr::class;

    const FORM_CS = Node\ncacm14\Course_Specifications::class;
    const FORM_CR = Node\ncacm14\Course_Report::class;

    const FORM_FS = Node\ncacm14\Field_Experience_Specification::class;
    const FORM_FR = Node\ncacm14\Field_Report::class;

    const FORM_PS = Node\ncapm14\Program_Specifications::class;
    const FORM_PR = Node\ncapm14\Annual::class;

    /** NCAAA 2018 Forms */

    const SYSTEM_INSTITUTIONAL2018 = Node\ncai18\Root::class;
    const SYSTEM_SSR2018 = Node\ncassr18\Root::class;
    const SYSTEM_PROGRAM2018 = Node\ncapm18\Root::class;
    const SYSTEM_COURSE2018 = Node\ncacm18\Root::class;

    const COLLEGE_SSR18 = Node\ncassr18\College::class;
    const COLLEGE_PROGRAM18 = Node\ncapm18\College::class;

    const PROGRAM_SSR18 = Node\ncassr18\Program::class;
    const PROGRAM_PROGRAM18 = Node\ncapm18\Program::class;

    const COURSE_COURSE18 = Node\ncacm18\Course::class;
    const COURSE_SECTIONS18 = Node\ncacm18\Sections::class;
    const COURSE_SECTION18 = Node\ncacm18\Course_Section::class;


    /*End of new form */

    public static $college_nodes = array(
        self::COLLEGE_SSR,
        self::COLLEGE_PROGRAM,
        self::COLLEGE_SSR18,
        self::COLLEGE_PROGRAM18,
    );
    public static $program_nodes = array(
        //ABET
        Node\abet_asac\Root::class,
        Node\abet_cac\Root::class,
        Node\abet_eac\Root::class,
        Node\abet_etac\Root::class,
        //AACSB
        Node\aacsb\Root::class,
        Node\aacsb_business\Root::class,
        //ACPE
        Node\acpe\Root::class,
        //ASIINP
        Node\asiinp\Root::class,
        //NCAAA
        self::PROGRAM_SSR,
        self::PROGRAM_PROGRAM,
        self::SYSTEM_PROGRAM,
        /*2018 new forms */
        self::PROGRAM_SSR18,
        self::PROGRAM_PROGRAM18,
        self::SYSTEM_PROGRAM2018,

    );
    public static $course_nodes = array(
        self::COURSE_COURSE,
        self::COURSE_COURSE18
    );
    public static $course_section_nodes = array(
        self::COURSE_SECTION,
        self::COURSE_SECTION18
    );
    public static $semester_nodes = array(
        self::SYSTEM_SSR,
        self::SYSTEM_PROGRAM,
        self::SYSTEM_COURSE,
        /*2018 new forms */
        self::SYSTEM_SSR2018,
        self::SYSTEM_PROGRAM2018,
        self::SYSTEM_COURSE2018,
    );

    /**
     * @return Node_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model(Node_Model::class);
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Node
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
     * @return Orm_Node[] | int
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
     * @return Orm_Node
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Node();
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
        $db_params['parent_id'] = $this->get_parent_id();
        $db_params['parent_lft'] = $this->get_parent_lft();
        $db_params['parent_rgt'] = $this->get_parent_rgt();
        $db_params['system_number'] = $this->get_system_number();
        $db_params['item_id'] = $this->get_item_id();
        $db_params['year'] = $this->get_year();
        $db_params['name'] = $this->get_name();
        $db_params['class_type'] = $this->get_class_type();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['is_finished'] = $this->get_is_finished();
        $db_params['is_form'] = $this->get_is_form();
        $db_params['is_shared'] = $this->get_is_shared();
        $db_params['shared_date'] = $this->get_shared_date();
        $db_params['due_date'] = $this->get_due_date();
        $db_params['review_status'] = $this->get_review_status();
        $db_params['properties'] = json_encode($this->get_properties_as_array());

        return $db_params;
    }

    public function reset_object_fields() {
        self::$save_properties = false;
        parent::reset_object_fields();
    }

    public function save($log = true) {

        if ($this->get_id() && self::$save_properties) {
            $this->add_object_field('properties', json_encode($this->get_properties_as_array()));
        }

        if (!$this->get_id()) {

            $this->set_date_added(date('Y-m-d H:i:s'));

            $this->after_node_load();

            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        if ($this->get_is_finished()) {
            $this->check_parent_is_finished();
        }

        if ($log) {
            Orm_Node_Log::add_log($this);
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        $this->reset_object_fields();
        $this->set_is_deleted(1);
        $this->save(false);
    }

    public function delete_children()
    {
        self::get_model()->delete_children($this->get_system_number(), $this->get_parent_lft(), $this->get_parent_rgt());
    }

    public function get_properties_as_array()
    {
        $properties = array();
        foreach ($this->get_properties() as $property) {
            /* @var $property Orm_Property */
            if ($property instanceof Orm_Property_Fixedtext) {
                continue;
            }
            $properties[$property->get_name()] = $property->get_value();
        }
        return $properties;
    }

    public function init() {}

    /**
     * @return Orm_Property[]
     */
    public function get_properties()
    {
        if(empty($this->properties)) {
            if($this->get_id()) {
                $this->set_properties(self::get_model()->get_lazy_properties($this->get_id()));
            } else {
                $this->init();
            }
        }

        return $this->properties;
    }

    public function set_properties($value)
    {
        $this->init();
        $properties = json_decode($value, true);

        if($properties && is_array($properties)){
            foreach ($properties as $name => $value) {
                $set_function = "set_{$name}";
                if (method_exists($this, $set_function)) {
                    $this->$set_function($value);
                }
            }
        }
    }

    public function set_property(Orm_Property $property, $independent_property = false)
    {

        if($this->check_if_independent_reviewer()) {
            $independent_property = !$independent_property;
        }
        $property->set_readonly($independent_property);

        self::$save_properties = true;
        $this->properties[$property->get_name()] = $property;
    }

    /**
     * @param string $property_name
     * @return Orm_Property
     */
    public function get_property($property_name)
    {
        $properties = $this->get_properties();
        return (isset($properties[$property_name]) ? $properties[$property_name] : new Orm_Property($property_name));
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

    public function set_parent_id($value)
    {
        $this->add_object_field('parent_id',$value);
        $this->parent_id = (int) $value;
    }

    public function get_parent_id()
    {
        return $this->parent_id;
    }

    public function set_parent_lft($value)
    {
        $this->add_object_field('parent_lft',$value);
        $this->parent_lft = (int) $value;
    }

    public function get_parent_lft()
    {
        return $this->parent_lft;
    }

    public function set_parent_rgt($value)
    {
        $this->add_object_field('parent_rgt',$value);
        $this->parent_rgt = (int) $value;
    }

    public function get_parent_rgt()
    {
        return $this->parent_rgt;
    }

    public function set_system_number($value)
    {
        $this->add_object_field('system_number',$value);
        $this->system_number = (int) $value;
    }

    public function get_system_number()
    {
        return $this->system_number;
    }

    public function set_item_id($value)
    {
        $this->add_object_field('item_id',$value);
        $this->item_id = (int) $value;
    }

    public function get_item_id()
    {
        return $this->item_id;
    }

    public function set_year($value)
    {
        $this->add_object_field('year',$value);
        $this->year = (int) $value;
    }

    public function get_year()
    {
        return $this->year;
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

    public function set_class_type($value)
    {
        $this->add_object_field('class_type',$value);
        $this->class_type = $value;
    }

    public function get_class_type()
    {
        return $this->class_type;
    }

    public function set_date_added($value)
    {
        $this->add_object_field('date_added',$value);
        $this->date_added = $value;
    }

    public function get_date_added()
    {
        return $this->date_added;
    }

    public function set_is_deleted($value)
    {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = (int) $value;
    }

    public function get_is_deleted()
    {
        return $this->is_deleted;
    }

    public function set_is_finished($value)
    {
        $this->add_object_field('is_finished',$value);
        $this->is_finished = (int) $value;
    }

    public function get_is_finished()
    {
        return $this->is_finished;
    }

    public function set_is_form($value)
    {
        $this->add_object_field('is_form',$value);
        $this->is_form = (int) $value;
    }

    public function get_is_form()
    {
        return $this->is_form;
    }

    public function set_is_shared($value)
    {
        $this->add_object_field('is_shared',$value);
        $this->is_shared = (int) $value;
    }

    public function get_is_shared()
    {
        return $this->is_shared;
    }

    public function set_shared_date($value)
    {
        $this->add_object_field('shared_date',$value);
        $this->shared_date = $value;
    }

    public function get_shared_date()
    {
        return $this->shared_date;
    }

    public function set_due_date($value)
    {
        $this->add_object_field('due_date',$value);
        $this->due_date = $value;
    }

    public function get_due_date()
    {
        return $this->due_date;
    }

    public function set_review_status($value)
    {
        $this->add_object_field('review_status',$value);
        $this->review_status = $value;
    }

    public function get_review_status()
    {
        return $this->review_status;
    }

    private $reviews = null;

    /**
     * @return Orm_Node_Review[]
     */
    public function get_reviews() {

        if(is_null($this->reviews)) {
            $this->reviews = Orm_Node_Review::get_all(['node_id' => $this->get_id()], 0,0, ['date_added DESC']);
        }

        return $this->reviews;
    }

    public function get_review_comment()
    {
        return Orm_Node_Review::get_one(['node_id' => $this->get_id()],['date_added DESC'])->get_comment();
    }

    public static function get_international_systems($initiate_object = true)
    {

        $systems = array();

        //ABET
        $systems[] = Node\abet_asac\Root::class;
        $systems[] = Node\abet_cac\Root::class;
        $systems[] = Node\abet_eac\Root::class;
        $systems[] = Node\abet_etac\Root::class;

        //AACSB
        $systems[] = Node\aacsb\Root::class;
        $systems[] = Node\aacsb_business\Root::class;

        //ACPE
        $systems[] = Node\acpe\Root::class;

        //JCI
        $systems[] = Node\jci\Root::class;

        //ASIINP
        $systems[] = Node\asiinp\Root::class;

        if ($initiate_object) {
            $system_objects = array();
            foreach ($systems as $system) {
                if (class_exists($system)) {
                    $system_objects[] = new $system();
                } else {
                    show_error("orm_node : class not found ({$system})");
                }
            }
            $systems = $system_objects;
        }

        return $systems;
    }

    public static function get_national_systems($initiate_object = true, $include_institutional = false)
    {
        //NCAAA
        if(Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || $include_institutional) {
            $systems[] = self::SYSTEM_INSTITUTIONAL;
            $systems[] = self::SYSTEM_INSTITUTIONAL2018;
        }

        $systems[] = self::SYSTEM_SSR;
        $systems[] = self::SYSTEM_PROGRAM;
        $systems[] = self::SYSTEM_COURSE;

        $systems[] = self::SYSTEM_SSR2018;
        $systems[] = self::SYSTEM_PROGRAM2018;
        $systems[] = self::SYSTEM_COURSE2018;

        if ($initiate_object) {
            $system_objects = array();
            foreach ($systems as $system) {
                if (class_exists($system)) {
                    $system_objects[] = new $system();
                } else {
                    show_error("orm_node : class not found ({$system})");
                }
            }
            $systems = $system_objects;
        }


        return $systems;
    }

    public function draw_properties($change_name = '')
    {

        $groups = array();
        $properties = array();

        foreach ($this->get_properties() as $property) {

            if ($change_name) {
                $name = $change_name . '_' . $property->get_name();
                $property->set_name($name);
            }

            if ($property->get_group()) {
                if (isset($groups[$property->get_group()])) {
                    $groups[$property->get_group()][] = $property;
                } else {
                    $groups[$property->get_group()][] = $property;
                    $properties[] = &$groups[$property->get_group()];
                }
            } else {
                $properties[] = $property;
            }
        }

        $html = '';
        foreach ($properties as $property) {
            /** @var $property Orm_Property */
            if (is_array($property)) {
                $html .= '<div class="group">';
                foreach ($property as $group_property) {
                    $html .= $group_property->draw_html();
                }
                $html .= '</div>';
            } else {
                $html .= $property->draw_html();
            }
        }

        return $html;
    }

    public function draw_all_report($pdf = false)
    {
        $html = '<div class="page-header">';
        $html .= '<h4>' . $this->get_name() . '</h4>';
        $html .= '</div>';
        $html .= $this->draw_report($pdf);

        $children = $this->get_children();
        if ($children) {
            foreach ($children as $child) {
                $html .= $child->draw_all_report($pdf);
            }
        }

        return $html;
    }

    public function draw_report($pdf = false)
    {

        $groups = array();
        $properties = array();

        foreach ($this->get_properties() as $property) {

            if ($property->get_group()) {
                if (isset($groups[$property->get_group()])) {
                    $groups[$property->get_group()][] = $property;
                } else {
                    $groups[$property->get_group()][] = $property;
                    $properties[] = &$groups[$property->get_group()];
                }
            } else {
                $properties[] = $property;
            }
        }

        $html = '';
        foreach ($properties as $property) {
            /* @var $property Orm_Property */
            if (is_array($property)) {
                $html .= '<div class="group">';
                foreach ($property as $group_property) {
                    $method = "draw_report_{$group_property->get_name()}";
                    if (method_exists($this, $method)) {
                        $html .= $this->$method($pdf);
                    } else {
                        $html .= $group_property->draw_report($pdf);
                    }
                }
                $html .= '</div>';
            } else {
                $method = "draw_report_{$property->get_name()}";
                if (method_exists($this, $method)) {
                    $html .= $this->$method($pdf);
                } else {
                    $html .= $property->draw_report($pdf);
                }
            }
        }

        return $html;
    }

    public function get_less_due_date(&$less_date = array())
    {

        $less_date[] = $this->get_due_date();

        if ($this->get_parent_id()) {
            $this->get_parent_obj()->get_less_due_date($less_date);
        }

        $array_date = array_diff($less_date, array('0000-00-00 00:00:00'));

        if($array_date && is_array($array_date)) {
            return min($array_date);
        }

        return '0000-00-00 00:00:00';
    }

    /**
     * return Orm_Node
     */
    public function get_parent_obj()
    {
        return self::get_instance($this->get_parent_id());
    }

    /**
     * return Orm_Node
     */
    public function get_system_obj()
    {
        return self::get_instance($this->get_system_number());
    }

    public function get_indentation_level(Orm_Node $start_node = null)
    {

        if (!is_null($start_node) && $start_node == $this) {
            return 0;
        }

        if ($this->get_parent_id()) {
            return $this->get_parent_obj()->get_indentation_level($start_node) + 1;
        }
        return 0;
    }

    public function prepare_children()
    {
        if (!self::$prepare_children) {
            if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'accreditation-read')) {
                $nodes = self::get_all(array('system_number' => $this->get_system_number(), 'parent_lft' => $this->get_parent_lft(), 'parent_rgt' => $this->get_parent_rgt()));
            } else {
                $nodes = self::get_user_nodes($this->get_system_number());
            }

            if ($nodes) {
                foreach ($nodes as $node) {
                    if ($node->get_parent_id()) {
                        $parent = self::get_instance($node->get_parent_id());
                        $parent->add_child($node);
                    }
                }
            }

            self::$prepare_children = true;
        }

        return $this;
    }

    public function add_child(Orm_Node $node)
    {
        $this->children[$node->get_id()] = $node;
    }

    /**
     *
     * @return Orm_Node[]
     */
    public function get_children()
    {
        return $this->prepare_children()->children;
    }

    public function reset_children()
    {
        self::$prepare_children = false;
        return $this;
    }

    public function draw_tree()
    {

        $html = '<div id="tree">';
        $html .= $this->get_tree_item()->draw();
        $html .= '</div>';

        return $html;
    }

    /**
     * @param bool $show_all
     * @return Orm_Tree_Item
     */
    public function get_tree_item($show_all = true)
    {
        $tree_item = new Orm_Tree_Item();
        $tree_item->set_id('node_' . $this->get_id());
        $tree_item->set_name($this->get_name());
        $tree_item->set_indentation($this->get_indentation_level());
        $tree_item->set_is_finished($this->get_is_finished());
        $tree_item->set_review_status($this->get_review_status());

        if ($show_all) {
            $children = $this->get_children();
            if ($children) {
                foreach ($children as $child) {
                    $tree_item->add_child($child->get_tree_item($show_all));
                }
            }
        }

        $this->tree_item_actions($tree_item);

        return $tree_item;
    }

    public function tree_item_actions(Orm_Tree_Item &$tree_item)
    {
        if ($this->check_if_can_download()) {
            $tree_item->add_action('fa fa-download', '/accreditation/download/' . $this->get_id(), 'title="' . lang('Download As') . '" data-toggle="ajaxModal"');
        }

        if ($this->check_if_can_send_to_review()) {
            $tree_item->add_action('fa fa-paper-plane', '/accreditation/send_to_review/' . $this->get_id(), 'title="' . lang('Send To Review') . '"');
        }

        if ($this->check_if_viewable()) {
            $tree_item->add_action('fa fa-eye', '/accreditation/view/' . $this->get_id(), 'title="' . lang('View').' '.lang('Form') . '" data-toggle="ajaxModal"');
        }

        if ($this->check_if_editable()) {
            $tree_item->add_action('fa fa-pencil-square-o', '/accreditation/edit/' . $this->get_id(), 'title="' . lang('Edit').' '.lang('Form') . '" data-toggle="ajaxModal"');
        }

        if ($this->check_if_can_assign_user()) {
            $tree_item->add_action('fa fa-user', '/accreditation/user_list/' . $this->get_id(), 'title="' . lang('User List') . '" data-toggle="ajaxModal"');
        }

        if ($this->check_if_can_manage()) {
            $tree_item->add_action('fa fa-calendar', '/accreditation/due_date/' . $this->get_id(), 'title="' . lang('Set Due Date') . '" data-toggle="ajaxModal"');
            //$tree_item->add_action('fa fa-trash-o', '/accreditation/delete/' . $this->get_id(), 'title="' . lang('Delete').' '.lang('Accreditation') . '" data-toggle="deleteAction" message="' . lang('Are you sure ?').'"');
        }
    }

    public function check_if_editable($check_due_date = true)
    {

        if ($check_due_date && $this->check_if_due_date_has_past()) {
            return false;
        }

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if ($this->link_edit && $can_manage && $this->check_if_can_fill_node()) {
            return true;
        }

        if($this->link_edit && $this->check_if_independent_reviewer()) {
            return true;
        }

        return false;
    }

    public function check_if_viewable()
    {

        if ($this->link_view) {
            return true;
        }

        return false;
    }

    public function check_if_can_assign_user()
    {
        $obj_class = get_class($this->get_system_obj());

        if(in_array($obj_class, self::get_international_systems(false))) {
            return $this->check_if_can_manage();
        }

        switch ($obj_class) {
            case Orm_Node::SYSTEM_INSTITUTIONAL:
            case Orm_Node::SYSTEM_SSR:
            case Orm_Node::SYSTEM_PROGRAM:
            case Orm_Node::SYSTEM_INSTITUTIONAL2018:
            case Orm_Node::SYSTEM_SSR2018:
            case Orm_Node::SYSTEM_PROGRAM2018:
                return $this->check_if_can_manage();
                break;

            case Orm_Node::SYSTEM_COURSE:
            case Orm_Node::SYSTEM_COURSE2018:
                return $this->check_if_can_fill_node();
                break;
        }

        return false;
    }

    public function check_if_can_fill_node() {

        if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            return true;
        } else {
            $nodes = Orm_Node_Assessor::get_assessor_children_tree($this->get_system_number());
            $nodes += self::get_user_role_nodes($this->get_system_number());

            if (isset($nodes[$this->get_id()])) {
                return true;
            }
        }

        return false;
    }

    public function check_if_can_review_node() {

        $nodes = Orm_Node_Reviewer::get_reviewer_children_tree($this->get_system_number());

        if($this->check_if_viewable() && $this->get_is_finished() && isset($nodes[$this->get_id()])){
            return true;
        }

        return false;
    }

    public function check_if_user_can_access_node()
    {
        if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'accreditation-read')) {
            return true;
        } else {
            $nodes = self::get_user_nodes($this->get_system_number());
            if (isset($nodes[$this->get_id()])) {
                return true;
            }
        }

        return false;
    }

    public function check_if_can_download()
    {
        $can_report = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-report');

        if ($this->link_pdf && $can_report && $this->check_if_user_can_access_node()) {
            return true;
        }
        return false;
    }

    public function check_if_can_manage()
    {

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if($can_manage) {
            $user = Orm_User::get_logged_user();
            switch ($user->get_institution_role()) {
                case Orm_Role::ROLE_INSTITUTION_ADMIN:
                case Orm_Role::ROLE_COLLEGE_ADMIN:
                case Orm_Role::ROLE_PROGRAM_ADMIN:

                    if($this->check_if_can_fill_node()) {
                        return true;
                    }

                    break;
            }
        }

        return false;
    }

    public static function check_if_can_generate($institution_admin_only = false)
    {

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if($can_manage) {
            $user = Orm_User::get_logged_user();
            switch ($user->get_institution_role()) {
                
                case Orm_Role::ROLE_INSTITUTION_ADMIN:
                    return true;
                    break;
                
                case Orm_Role::ROLE_COLLEGE_ADMIN:
                case Orm_Role::ROLE_PROGRAM_ADMIN:
                    if(!$institution_admin_only) {
                        return true;    
                    }
                    break;
            }
        }

        return false;
    }

    public function check_if_due_date_has_past()
    {

        if (date('Y-m-d H:i:s') > $this->get_less_due_date()) {
            return true;
        }

        return false;
    }

    public function check_if_is_finished()
    {
        return self::get_count(array('system_number' => $this->get_system_number(), 'is_form' => 1, 'is_finished' => 0, 'parent_lft' => $this->get_parent_lft(), 'parent_rgt' => $this->get_parent_rgt()));
    }

    public function check_if_can_send_to_review()
    {
        if ($this->link_send_to_review && $this->check_if_can_fill_node()) {
            return true;
        }
        return false;
    }

    private static $user_nodes = array();

    /**
     * @return Orm_Node[] | array()
     */
    public static function get_user_nodes($system_number, $user_id = null) {

        if(is_null($user_id)){
            $user_id = Orm_User::get_logged_user()->get_id();
        }

        if(!isset(self::$user_nodes[$system_number][$user_id])) {
            $user_nodes = array();
            $user_nodes += Orm_Node_Assessor::get_assessor_tree($system_number, $user_id);
            $user_nodes += Orm_Node_Reviewer::get_reviewer_tree($system_number, $user_id);

            $user_nodes += self::get_user_role_nodes($system_number, $user_id);

            ksort($user_nodes);

            self::$user_nodes[$system_number][$user_id] = $user_nodes;
        }

        return self::$user_nodes[$system_number][$user_id];
    }

    private static $user_role_nodes = array();

    /**
     * @return Orm_Node[] | array()
     */
    public static function get_user_role_nodes($system_number, $user_id = null) {

        if(is_null($user_id)){
            $user_id = Orm_User::get_logged_user()->get_id();
        }

        if(!isset(self::$user_role_nodes[$system_number][$user_id])) {

            self::$user_role_nodes[$system_number][$user_id] = array();

            if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {

                $system_node = Orm_Node::get_instance($system_number);

                $filters = array();
                $filters['system_number'] = $system_number;

                switch (get_class($system_node)) {
                    case Orm_Node::SYSTEM_SSR:
                    case Orm_Node::SYSTEM_PROGRAM:
                    case Orm_Node::SYSTEM_SSR2018:
                    case Orm_Node::SYSTEM_PROGRAM2018:

                        if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {

                            $college_node = Orm_Node::get_one(array(
                                    'system_number' => $system_number,
                                    'class_type_in' => array(Orm_Node::COLLEGE_SSR, Orm_Node::COLLEGE_PROGRAM,Orm_Node::COLLEGE_SSR18, Orm_Node::COLLEGE_PROGRAM18),
                                    'item_id' => Orm_User::get_logged_user()->get_college_id())
                            );

                            $filters['parent_lft'] = $college_node->get_parent_lft();
                            $filters['parent_rgt'] = $college_node->get_parent_rgt();

                            self::$user_role_nodes[$system_number][$user_id] = self::get_all($filters);

                        } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {

                            $program_node = Orm_Node::get_one(array(
                                    'system_number' => $system_number,
                                    'class_type_in' => array(Orm_Node::PROGRAM_SSR, Orm_Node::PROGRAM_PROGRAM,Orm_Node::PROGRAM_SSR18, Orm_Node::PROGRAM_PROGRAM18),
                                    'item_id' => Orm_User::get_logged_user()->get_program_id())
                            );

                            $filters['parent_lft'] = $program_node->get_parent_lft();
                            $filters['parent_rgt'] = $program_node->get_parent_rgt();

                            self::$user_role_nodes[$system_number][$user_id] = self::get_all($filters);

                        }

                        break;
                    case Orm_Node::SYSTEM_COURSE:
                    case Orm_Node::SYSTEM_COURSE2018:

                        $path_arr = explode('/', $_SERVER['PATH_INFO']);
                        $node_id = intval(end($path_arr));

                        if($node_id) {
                            $node_obj = Orm_Node::get_instance($node_id);

                            $filters['parent_lft'] = $node_obj->get_parent_lft();
                            $filters['parent_rgt'] = $node_obj->get_parent_rgt();
                        }

                        if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                            $filters['college_id'] = Orm_User::get_logged_user()->get_college_id();
                        } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                            $filters['program_id'] = Orm_User::get_logged_user()->get_program_id();
                        }

                        $filters['course_ranges'] = self::get_model()->get_course_ranges($filters);

                        self::$user_role_nodes[$system_number][$user_id] = self::get_all($filters);

                        break;
                }
            }

        }

        return self::$user_role_nodes[$system_number][$user_id];
    }

    public function get_children_nodes()
    {
        return array();
    }

    public function validate_node_exist() {
        return $this->get_count(array(
            'system_number' => $this->get_system_number(),
            'class_type' => $this->get_class_type(),
            'item_id' => $this->get_item_id(),
            'parent_id' => $this->get_parent_id(),
            'name' => $this->get_name()
            ));
    }

    public function generate()
    {
        if (!$this->validate_node_exist()) {
            $this->save(false);
        }

        $children = $this->get_children_nodes();

//        echo '<pre>';
//        var_dump($children);
//        echo '</pre>';

        if ($children) {
            foreach ($children as $child) {
                $child->set_parent_id($this->get_id());
                $child->set_year($this->get_year());
                $child->set_system_number($this->get_system_number());
                $child->generate();
            }
        }
    }

    public function get_item_obj()
    {
        return null;
    }

    public function generate_word()
    {

        $html = Orm::get_ci()->load->view('accreditation/view_all', array('node' => $this, 'word' => true), true);
        $css = file_get_contents(FCPATH.'assets/jadeer/css/word.css');

        // create instance
        $cssToInlineStyles = new \TijsVerkoyen\CssToInlineStyles\CssToInlineStyles();
        $cssToInlineStyles->setHTML($html);
        $cssToInlineStyles->setCSS($css);
        $html = $cssToInlineStyles->convert();

        $files_dir = '/files/' . $this->get_attachments_directory();

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name = $this->get_name() . '.doc';
        $file_name = $files_fulldir . '/' . $name;

        file_put_contents($file_name, $html);

        if (file_exists($file_name)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.ms-office');
            header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_name));
            flush();
            readfile($file_name);
            exit;
        }

    }

    public function get_form_code()
    {
        return $this->code;
    }

    public function generate_ams_form()
    {

        $ams_form = array();
        $ams_form['form_code'] = $this->get_form_code();
        $ams_form['form_name'] = $this->get_name();
        $ams_form['institution'] = array('id' => '', 'name' => Orm_Institution::get_university_name('english'));

        $course_node = $this->get_parent_course_node();
        if ($course_node->get_id()) {
            $ams_form['course'] = array('id' => $course_node->get_item_obj()->get_id(), 'name' => $course_node->get_item_obj()->get_name('english'));
        }

        $program_node = $this->get_parent_program_node();
        if ($program_node->get_id()) {
            $ams_form['program'] = array('id' => $program_node->get_item_obj()->get_id(), 'name' => $program_node->get_item_obj()->get_name('english'));
        }

        $college_node = $this->get_parent_college_node();
        if ($college_node->get_id()) {
            $ams_form['college'] = array('id' => $college_node->get_item_obj()->get_id(), 'name' => $college_node->get_item_obj()->get_name('english'));
        }

        $this->generate_ams_page($ams_form['contents'], $this->get_form_code());

        return $ams_form;
    }

    public function generate_ams_page(&$ams_form = array(), $ams_file = null)
    {

        foreach ($this->get_properties() as $property) {

            $method = "generate_ams_{$property->get_name()}";
            if (method_exists($this, $method)) {
                $this->$method($ams_form, $ams_file, get_class($this));
            } else {
                $property->generate_ams_property($ams_form, $ams_file, get_class($this));
            }
        }

        $children = $this->reset_children()->get_children();
        if ($children) {
            foreach ($children as $child) {
                $child->generate_ams_page($ams_form, $ams_file);
            }
        }
    }

    public function generate_pdf()
    {
        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $this->get_name()), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line'
        ));

        if ($this->get_pdf_cover()) {
            $pdf->addCover($this->get_pdf_cover());
        }

        $pdf->addToc();

        $this->generate_pdf_page($pdf);

        $files_dir = '/files/' . $this->get_attachments_directory();

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name = $this->get_name() . '.pdf';
        $file_name = $files_fulldir . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);

        if($pdf->getError() && ENVIRONMENT == 'development') {
            show_error($pdf->getError());
        }

        $pdf->send($name);
    }

    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf)
    {
        $content = '<div class="container-fluid">';
        $content .= "<h4>{$this->get_name()}</h4>";
        $content .= $this->draw_report(true);
        $content .= '</div>';

        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');
        Orm::get_ci()->layout->add_stylesheet('assets/jadeer/css/tinymce_zero.css');

        $html = Orm::get_ci()->layout->view($content, array(), true);
        
        $pdf->addPage($html);
        $pdf->setOptions(array('orientation'=>$this->orientation));

        $children = $this->get_children();

        if ($children) {
            foreach ($children as $child) {
                $child->generate_pdf_page($pdf);
            }
        }
    }

    public function collect_progress(&$finished = 0, &$in_process = 0)
    {
        $filters = array();
        $filters['system_number'] = $this->get_system_number();
        $filters['parent_lft'] = $this->get_parent_lft();
        $filters['parent_rgt'] = $this->get_parent_rgt();
        $filters['is_form'] = 1;

        $filters['is_finished'] = 1;
        $finished = self::get_count($filters);

        $filters['is_finished'] = 0;
        $in_process = self::get_count($filters);
    }

    public function collect_reviewing(&$reviewed = 0, &$not_reviewed = 0)
    {
        $filters = array();
        $filters['system_number'] = $this->get_system_number();
        $filters['parent_lft'] = $this->get_parent_lft();
        $filters['parent_rgt'] = $this->get_parent_rgt();
        $filters['is_form'] = 1;
        $filters['is_finished'] = 1;

        $filters['review_status_in'] = array('compliant', 'not_compliant', 'partly_compliant');
        $reviewed = self::get_count($filters);

        $filters['review_status_in'] = array('none');
        if (Orm::get_ci()->config->item('review_overall')) {
            unset($filters['is_finished']);
        }
        $not_reviewed = self::get_count($filters);
    }

    private $reviewers = null;

    public function get_reviewers() {

        if(is_null($this->reviewers)) {

            $this->reviewers = array();

            $filters = array();
            $filters['system_number'] = $this->get_system_number();
            $filters['parent_lft'] = $this->get_parent_lft();
            $filters['parent_rgt'] = $this->get_parent_rgt();

            $node_ids = array_column(self::get_model()->get_all($filters,0,0,[],Orm::FETCH_ARRAY), 'id');

            if($node_ids) {
                $reviewers = Orm_Node_Reviewer::get_all(array('in_node_id' => $node_ids));

                foreach ($reviewers as $reviewer) {
                    $this->reviewers[$reviewer->get_reviewer_id()] = $reviewer->get_reviewer_id();
                }
            }
        }

        return $this->reviewers;
    }

    public static function get_years()
    {
        return array_column(self::get_model()->get_years(), 'year');
    }

    /**
     * @param array $find_nodes
     * @return $this|Orm_Node
     */
    public function find_parent_node($find_nodes = array())
    {
        if (in_array(get_class($this), $find_nodes)) {
            return $this;
        } else if ($this->get_parent_id()) {
            return $this->get_parent_obj()->find_parent_node($find_nodes);
        }

        return new Orm_Node();
    }

    /**
     * @return Orm_Node
     */
    public function get_parent_college_node()
    {
        if (empty(self::$college_parents[$this->get_id()])) {
            self::$college_parents[$this->get_id()] = $this->find_parent_node(self::$college_nodes);
        }

        return self::$college_parents[$this->get_id()];
    }

    /**
     * @return Orm_Node
     */
    public function get_parent_program_node()
    {
        if (empty(self::$program_parents[$this->get_id()])) {
            self::$program_parents[$this->get_id()] = $this->find_parent_node(self::$program_nodes);
        }

        return self::$program_parents[$this->get_id()];
    }

    /**
     * @return Orm_Node
     */
    public function get_parent_course_node()
    {
        if (empty(self::$course_parents[$this->get_id()])) {
            self::$course_parents[$this->get_id()] = $this->find_parent_node(self::$course_nodes);
        }

        return self::$course_parents[$this->get_id()];
    }

    /**
     * @return Orm_Node
     */
    public function get_parent_course_section_node()
    {
        if (empty(self::$course_section_parents[$this->get_id()])) {
            self::$course_section_parents[$this->get_id()] = $this->find_parent_node(self::$course_section_nodes);
        }

        return self::$course_section_parents[$this->get_id()];
    }

    /**
     * @return Orm_Node
     */
    public function get_parent_semester_node()
    {
        if (empty(self::$semester_parents[$this->get_id()])) {
            self::$semester_parents[$this->get_id()] = $this->find_parent_node(self::$semester_nodes);
        }

        return self::$semester_parents[$this->get_id()];
    }

    public function fill_property_values()
    {
        foreach ($this->get_properties() AS $property) {
            /* @var $property Orm_Property */
            $property->validat();
        }
        $this->save(false);
    }

    public function check_parent_is_finished()
    {

        if ($this->get_parent_id()) {
            $parent = $this->get_parent_obj();

            if (self::get_count(array('parent_id' => $parent->get_id(), 'is_finished' => 0)) === 0) {
                $parent->set_is_finished(1);
                $parent->save(false);
            }
        }
    }

    public function after_node_load()
    {
        //Do Nothing
    }

    public function get_attachments_directory($with_dir = true, &$directory = array(), $first = true, $course_obj = null)
    {
        if($first && $with_dir) {
            if(!in_array(get_class($this->get_system_obj()), array(self::SYSTEM_INSTITUTIONAL, self::SYSTEM_COURSE,self::SYSTEM_INSTITUTIONAL2018,self::SYSTEM_COURSE2018))) {
                $directory[] = str_replace('/', '-', $this->get_system_obj()->get_name());
            }

            $directory[] = 'Accreditation';

            if(get_class($this->get_system_obj()) == self::SYSTEM_INSTITUTIONAL || get_class($this->get_system_obj()) == self::SYSTEM_INSTITUTIONAL2018 ) {
                $directory[] = 'Institution';
            }
        }

        if ($this->get_item_id()) {
            $item_obj = $this->get_item_obj();
            if (is_object($item_obj) && !is_null($item_obj) && in_array(get_class($item_obj), array(Orm_Program::class, Orm_College::class, Orm_Course::class, Orm_Program_Plan::class, Orm_Course_Section::class))) {
                if ($item_obj instanceof Orm_Program_Plan) {
                    $course_obj = $item_obj->get_course_obj(); /* @var $course_obj Orm_Course */
                    $directory[] = str_replace('/', '-', $course_obj->get_name('english'));
                } else {
                    $directory[] = str_replace('/', '-', $item_obj->get_name('english'));

                    if($item_obj instanceof Orm_Course) {
                        $course_obj = $item_obj; /* @var $course_obj Orm_Course */
                    }
                }
            }
        }

        if ($this->get_parent_id()) {
            $this->get_parent_obj()->get_attachments_directory($with_dir, $directory, false, $course_obj);
        } else {

            if (get_class($this) == self::SYSTEM_COURSE || get_class($this) == self::SYSTEM_COURSE2018) { /* @var $item_obj Orm_Semester */
                $directory[] = str_replace('/', '-', $item_obj->get_name());

                if(!is_null($course_obj)) {
                    $directory[] = str_replace('/', '-', $course_obj->get_department_obj()->get_college_obj()->get_name('english'));
                }
            }

            $directory[] = $this->get_year();
        }

        return ($with_dir ? 'Documents/' : '') . implode('/', array_reverse($directory));
    }

    /**
     * system_validator
     *
     * @param array $view_params
     * @return int item_id
     */
    public function system_validator(&$view_params = array())
    {
        \Validator::set_error('common_error', 'Functions Must be Overwritten');
    }

    public function get_system_url()
    {
        return '/accreditation/wizard_step_2';
    }

    public function draw_system_node()
    {
        //Do Nothing
    }

    public function draw_system_forms()
    {
        //Do Nothing
    }

    public function header_actions(&$actions = array())
    {

        $actions[] = array(
            'class' => 'btn',
            'title' => '<i class="fa fa-refresh"></i> ' . lang('Import'),
            'extra' => 'onclick="import_form(this, ' . $this->get_id() . ');" ' . data_loading_text(true)
        );

        $actions[] = array(
            'class' => 'btn',
            'title' => '<i class="fa fa-history"></i> ' . lang('Logs'),
            'extra' => 'onclick="log_form(this, ' . $this->get_id() . ');" ' . data_loading_text(true)
        );

        $html = '';
        foreach ($actions as $action) {
            $html .= '<button type="button" class="' . $action['class'] . '" ' . $action['extra'] . ' style="margin:0 5px;">' . $action['title'] . '</button>';
        }

        return $html;
    }

    public function integration_processes()
    {
        $this->get_properties();
    }

    public function get_pdf_cover()
    {
        return '';
    }

    public function build_parent_tree()
    {
        self::get_model()->build_parent_tree($this->get_system_number());
    }

    public function save_as_finished()
    {
        self::get_model()->save_as_finished($this->get_system_number(), $this->get_parent_lft(), $this->get_parent_rgt());
    }

    public function save_as_shared()
    {
        self::get_model()->save_as_shared($this->get_system_number(), $this->get_parent_lft(), $this->get_parent_rgt());
    }

    public static function get_max_system_year($class_type)
    {
        return self::get_model()->get_max_system_year($class_type);
    }

    private static $active_institutional_node = null;
    public static function get_active_institutional_node()
    {
        if(is_null(self::$active_institutional_node)) {
            $semester = Orm_Semester::get_active_semester();

            $filters = array();
            $filters['class_type'] = self::SYSTEM_INSTITUTIONAL;
            $filters['year'] = $semester->get_year();

            self::$active_institutional_node = self::get_one($filters);
        }

        return self::$active_institutional_node;
    }

    private static $active_ssr_node = null;
    public static function get_active_ssr_node()
    {
        if(is_null(self::$active_ssr_node)) {
            $semester = Orm_Semester::get_active_semester();

            $filters = array();
            $filters['class_type'] = self::SYSTEM_SSR;
            $filters['year_start'] = ($semester->get_year() - 1);
            $filters['year_end'] = $semester->get_year();

            self::$active_ssr_node = self::get_one($filters);
        }

        return self::$active_ssr_node;
    }

    private static $active_program_node = null;
    public static function get_active_program_node()
    {
        if(is_null(self::$active_program_node)) {
            $semester = Orm_Semester::get_active_semester();

            $filters = array();
            $filters['class_type'] = self::SYSTEM_PROGRAM;
            $filters['year'] = $semester->get_year();

            self::$active_program_node = self::get_one($filters);
        }

        return self::$active_program_node;
    }

    private static $active_course_node = null;
    public static function get_active_course_node()
    {

        if(is_null(self::$active_course_node)) {
            $semester = Orm_Semester::get_active_semester();

            $filters = array();
            $filters['class_type'] = self::SYSTEM_COURSE;
            $filters['item_id'] = $semester->get_id();

            self::$active_course_node = self::get_one($filters);
        }

        return self::$active_course_node;
    }


    /* accreditation 2018*/
    private static $active_institutional2018_node = null;
    public static function get_active_institutional2018_node()
    {
        if(is_null(self::$active_institutional2018_node)) {
            $semester = Orm_Semester::get_active_semester();

            $filters = array();
            $filters['class_type'] = self::SYSTEM_INSTITUTIONAL2018;
            $filters['year'] = $semester->get_year();

            self::$active_institutional2018_node = self::get_one($filters);
        }

        return self::$active_institutional2018_node;
    }

    private static $active_ssr2018_node = null;
    public static function get_active_ssr2018_node()
    {
        if(is_null(self::$active_ssr2018_node)) {
            $semester = Orm_Semester::get_active_semester();

            $filters = array();
            $filters['class_type'] = self::SYSTEM_SSR2018;
            $filters['year_start'] = ($semester->get_year() - 1);
            $filters['year_end'] = $semester->get_year();

            self::$active_ssr2018_node = self::get_one($filters);
        }

        return self::$active_ssr2018_node;
    }

    private static $active_program2018_node = null;
    public static function get_active_program2018_node()
    {
        if(is_null(self::$active_program2018_node)) {
            $semester = Orm_Semester::get_active_semester();

            $filters = array();
            $filters['class_type'] = self::SYSTEM_PROGRAM2018;
            $filters['year'] = $semester->get_year();

            self::$active_program2018_node = self::get_one($filters);
        }

        return self::$active_program2018_node;
    }

    private static $active_course2018_node = null;
    public static function get_active_course2018_node()
    {

        if(is_null(self::$active_course2018_node)) {
            $semester = Orm_Semester::get_active_semester();

            $filters = array();
            $filters['class_type'] = self::SYSTEM_COURSE2018;
            $filters['item_id'] = $semester->get_id();

            self::$active_course2018_node = self::get_one($filters);
        }

        return self::$active_course2018_node;
    }

    public function get_item_ids_by_class_type($class_type)
    {
        return array_column(self::get_model()->get_item_ids_by_class_type($class_type, $this->get_system_number(), $this->get_parent_lft(), $this->get_parent_rgt()), 'item_id');
    }

    /**
     * @return Orm_Node_Assessor[]
     */
    public function get_assessors()
    {
        return Orm_Node_Assessor::get_all(array('node_id' => $this->get_id()));
    }

    /**
     * @return Orm_Node_Assessor[]
     */
    public function get_parent_assessors()
    {
        $assessors = array();
        Orm_Node_Assessor::get_parent_assessors($this->get_id(), $assessors);
        return $assessors;
    }

    public function  get_days_remaining()
    {
        $start = $this->get_less_due_date();

        if ($start != '0000-00-00 00:00:00') {

            $end = date('Y-m-d H:i:s');

            if ($start >= $end) {

                $diff = abs(strtotime($end) - strtotime($start));

                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                $period = [];

                if ($years) {
                    if ($years > 1) {
                        $period[] = $years . ' ' . lang('Years');
                    } else {
                        $period[] = $years . ' ' . lang('Year');
                    }
                }
                if ($months) {
                    if ($months > 1) {
                        $period[] = $months . ' ' . lang('Months');
                    } else {
                        $period[] = $months . ' ' . lang('Month');
                    }
                }
                if ($days) {
                    if ($days > 1) {
                        $period[] = $days . ' ' . lang('Days');
                    } else {
                        $period[] = $days . ' ' . lang('Day');
                    }
                }

                if($period) {
                    $string = '<b>' . lang('Due in') . '</b> ' . implode(' & ', $period);
                } else {
                    $string = '<b>' . lang('Due Today') . '</b>';
                }

            } else {
                $string = '<b>' . lang('Due Date Passed') . '</b>';
            }
        } else {
            $string = '<b>' . lang('Due Date Not Assigned') . '</b>';
        }

        return $string;
    }

    public function get_progress_score() {
        $finished = 0;
        $in_process = 0;
        $this->collect_progress($finished, $in_process);

        $progress = 0;
        if (($finished + $in_process) > 0) {
            $progress = round(($finished / ($finished + $in_process)) * 100, 2);
        }

        return $progress;
    }

    public function get_progress_bar($size = 100, $progress = null)
    {
        $id = uniqid();

        if(is_null($progress)) {
            $progress = $this->get_progress_score();
        }

        return <<<BAR
        <div id="progress-{$id}" class="easy-pie-chart" data-percent="{$progress}">
            <span></span>
        </div>
        
        <script>
          $(function() {
            $('#progress-{$id}').easyPieChart({
              animate: 1000,
              barColor: '#72B159',
              size: {$size},
              onStep: function(_from, _to, currentValue) {
                $(this.el).find('> span').text(currentValue.toFixed(2) + '%');
              },
            });
          });
        </script>
BAR;

    }

    public function get_review_score() {
        $reviewed = 0;
        $not_reviewed = 0;
        $this->collect_reviewing($reviewed, $not_reviewed);

        $review = 0;
        if (($reviewed + $not_reviewed) > 0) {
            $review = round(($reviewed / ($reviewed + $not_reviewed)) * 100, 2);
        }

        return $review;
    }

    public function get_review_bar($size = 100, $review = null)
    {
        $id = uniqid();

        if(is_null($review)) {
            $review = $this->get_review_score();
        }

        return <<<BAR
        <div id="review-{$id}" class="easy-pie-chart" data-percent="{$review}">
            <span></span>
        </div>
        
        <script>
          $(function() {
            $('#review-{$id}').easyPieChart({
              animate: 1000,
              size: {$size},
              onStep: function(_from, _to, currentValue) {
                $(this.el).find('> span').text(currentValue.toFixed(2) + '%');
              },
            });
          });
        </script>
BAR;

    }

    public function get_shared_node()
    {

        $shared_node_id = 0;

        $course_node = $this->get_parent_course_node();
        if (!is_null($course_node) && $course_node->get_id()) {
            $plan_obj = $course_node->get_item_obj();
            /* @var $plan_obj Orm_Program_Plan */

            $shared_node_id = self::get_model()->get_shared_node_id($this->get_class_type(), $plan_obj->get_course_id(), $plan_obj->get_course_obj()->get_department_id());

            //echo(Orm::get_ci()->db->last_query());
        }

        return self::get_instance($shared_node_id);
    }

    public static function get_standard_class($standard, $type = 'i') {

        if($type == 'p') {
            $prefix = 'Node\\ncassr14\\';
        } else {
            $prefix = 'Node\\ncai14\\';
        }

        switch($standard){
            case 1:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_1' : 'Ssri_G_Evaluation_1_Mission');
                break;
            case 2:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_2' : 'Ssri_G_Evaluation_2_Administration');
                break;
            case 3:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_3' : 'Ssri_G_Evaluation_3_Quality_Assurance');
                break;
            case 4:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_4_Kpi' : 'Ssri_G_Evaluation_4_Learning_And_Teaching');
                break;
            case 5:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_5' : 'Ssri_G_Evaluation_5_Student_Administration');
                break;
            case 6:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_6' : 'Ssri_G_Evaluation_6_Learning_Resources');
                break;
            case 7:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_7' : 'Ssri_G_Evaluation_7_Facilities_And_Equipment');
                break;
            case 8:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_8' : 'Ssri_G_Evaluation_8_Financial_Planning');
                break;
            case 9:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_9' : 'Ssri_G_Evaluation_9_Employment_Processes');
                break;
            case 10:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_10' : 'Ssri_G_Evaluation_10_Research');
                break;
            case 11:
                $class = $prefix . (($type == 'p') ? 'Ssr_H_Standard_11' : 'Ssri_G_Evaluation_11_Institutional_Relationships');
                break;
        }

        return $class;
    }

    public function get_path(&$output) {

        if ($this->get_parent_id()) {

            $parent = $this->get_parent_obj();
            $item_obj = $parent->get_item_obj();

            if (!is_null($item_obj) && in_array(get_class($item_obj), array(Orm_Program::class, Orm_College::class, Orm_Course::class))) {
                $parent->get_path($output);
            }
        }
        $output[] = $this->get_name();
    }

    public function get_course_progress_bar($filters = array(), $size = 100)
    {
        return $this->get_progress_bar($size, 0);
    }

    public function get_course_review_bar($filters = array(), $size = 100)
    {
        return $this->get_review_bar($size, 0);
    }

    private static $independent_reviewer = null;

    public function check_if_independent_reviewer() {

        if(is_null(self::$independent_reviewer)) {

            if(get_class($this->get_system_obj()) == self::SYSTEM_INSTITUTIONAL || get_class($this->get_system_obj()) == self::SYSTEM_INSTITUTIONAL2018) {
                $type = Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION;
                $type_id = 0;
            } else {
                $type = Orm_Acc_Independent_Reviewer::TYPE_PROGRAM;
                $type_id = $this->get_parent_program_node()->get_item_id();
            }

            self::$independent_reviewer = Orm_Acc_Independent_Reviewer::get_count(['type' => $type, 'type_id' => $type_id, 'reviewer_id' => Orm_User::get_logged_user_id()]);

        }

        return boolval(self::$independent_reviewer);
    }

    public  static function get_node_id_by_year($year,$class_type = "Node\\ncai14\\Ssri") {

        return self::get_model()->get_node_by_year($year,$class_type) ;
    }
}

