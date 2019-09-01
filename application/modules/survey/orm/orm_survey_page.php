<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey_Page extends Orm
{

    /**
     * @var $instances Orm_Survey_Page[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey_page';


    /**
     * class attributes
     */
    protected $id = 0;
    protected $survey_id = 0;
    protected $title_english = '';
    protected $title_arabic = '';
    protected $description_english = '';
    protected $description_arabic = '';
    protected $order = 0;

    /**
     * @return Survey_Page_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_Page_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey_Page
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
     * @return Orm_Survey_Page[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array('sp.order ASC'))
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Survey_Page
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey_Page();
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
        $db_params['survey_id'] = $this->get_survey_id();
        $db_params['title_english'] = $this->get_title_english();
        $db_params['title_arabic'] = $this->get_title_arabic();
        $db_params['description_english'] = $this->get_description_english();
        $db_params['description_arabic'] = $this->get_description_arabic();
        $db_params['order'] = $this->get_order();

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

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_survey_id($value)
    {
        $this->add_object_field('survey_id',$value);
        $this->survey_id = $value;
    }

    public function get_survey_id()
    {
        return $this->survey_id;
    }

    public function set_title_english($value)
    {
        $this->add_object_field('title_english',$value);
        $this->title_english = $value;
    }

    public function get_title_english()
    {
        return $this->title_english;
    }

    public function set_title_arabic($value)
    {
        $this->add_object_field('title_arabic',$value);
        $this->title_arabic = $value;
    }

    public function get_title_arabic()
    {
        return $this->title_arabic;
    }

    public function get_title($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_title_arabic();
        }

        return $this->get_title_english();
    }

    public function set_description_english($value)
    {
        $this->add_object_field('description_english',$value);
        $this->description_english = $value;
    }

    public function get_description_english()
    {
        return $this->description_english;
    }

    public function set_description_arabic($value)
    {
        $this->add_object_field('description_arabic',$value);
        $this->description_arabic = $value;
    }

    public function get_description_arabic()
    {
        return $this->description_arabic;
    }

    public function get_description($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_description_arabic();
        }

        return $this->get_description_english();
    }

    public function set_order($value)
    {
         $this->add_object_field('order',$value);
        $this->order = $value;
    }

    public function get_order()
    {
        return $this->order;
    }

    /**
     * @return Orm_Survey_Question[]
     */
    public function get_questions() {
        return Orm_Survey_Question::get_all(array('page_id' => $this->get_id()));
    }

    /**
     * @return Orm_Survey
     */
    public function get_survey_obj() {
        return Orm_Survey::get_instance($this->get_survey_id());
    }

    /**
     * @return int|Orm_Survey_Page[]
     */
    public function get_greater() {
        return self::get_all(array('survey_id' => $this->get_survey_id(), 'not_id' => $this->get_id(), 'greater_order' => $this->get_order()));
    }

    public function fix_orders() {
        foreach($this->get_greater() as $page) {
            $page->set_order($page->get_order() + 1);
            $page->save();
        }

        $this->reorder();
    }

    /**
     *this function reorder
     * @redirect success or error
     */
    public function reorder() {
        $order = 1;
        $pages = self::get_all(array('survey_id' => $this->get_survey_id()));
        foreach($pages as $page) {
            $page->set_order($order);
            $page->save();

            $order++;
        }
    }
    /**
     * this function clone me by its survey id and with copy name and with response
     * @param int $survey_id the survey id of the clone me to be call function
     * @param bool $with_copy_name the with copy name of the clone me to be call function
     * @param bool $with_response the with response of the clone me to be call function
     * @return bool|Orm_Survey_Page the call function
     */
    public function clone_me($survey_id , $with_copy_name = false, $with_response = true) {

        $copy_name = '';
        if($with_copy_name){
            $copy_name = 'copy ';
        }

        $object = new Orm_Survey_Page();
        $object->set_survey_id($survey_id);
        $object->set_title_english($copy_name . $this->get_title_english());
        $object->set_description_english($this->get_description_english());
        $object->set_title_arabic($copy_name . $this->get_title_arabic());
        $object->set_description_arabic($this->get_description_arabic());
        $object->set_order($this->get_order());

        if ($object->save()) {
            foreach ($this->get_questions() as $question) {
                $question->clone_me($object->get_id(), false, $with_response);
            }

            return $object;
        }

        return false;
    }

    /**
     *this function get js validator
     * @return string the call function
     */
    public function get_js_validator() {

        $rules = array();
        foreach ($this->get_questions() as $question) {
            if($question->get_is_require()) {
                $rules[] = $question->get_js_validator();
            }
        }

        if($rules) {

            return
                '$("#wizard-' . $this->get_order() . '").pxValidate({
                ignore: ".ignore",
                focusInvalid: true,
                rules: {
                ' . implode(",\n", $rules) . '
                }
            });';

        }

    }

}

