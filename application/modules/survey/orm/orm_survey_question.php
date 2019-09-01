<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey_Question extends Orm
{

    /**
     * @var $instances Orm_Survey_Question[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey_question';


    /**
     * class attributes
     */
    protected $id = 0;
    protected $page_id = 0;
    protected $class_type = '';
    protected $question_english = '';
    protected $question_arabic = '';
    protected $description_english = '';
    protected $description_arabic = '';
    protected $order = 0;
    protected $is_require = 0;

    private static $types = array(
        'Orm_Survey_Question_Type_Radio' => 'Multiple Choice (Only One Answer)',
        'Orm_Survey_Question_Type_Checkbox' => 'Multiple Choice (Multiple Answers)',
        'Orm_Survey_Question_Type_Textarea' => 'Comment/Essay Box',
        'Orm_Survey_Question_Type_Factors_And_Statements' => 'Factors And Statements',
    );

    /**
     * @return Survey_Question_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_Question_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey_Question
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
     * @return Orm_Survey_Question[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array('sq.order ASC'))
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Survey_Question
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey_Question();
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
        $db_params['page_id'] = $this->get_page_id();
        $db_params['class_type'] = $this->get_class_type();
        $db_params['question_english'] = $this->get_question_english();
        $db_params['question_arabic'] = $this->get_question_arabic();
        $db_params['description_english'] = $this->get_description_english();
        $db_params['description_arabic'] = $this->get_description_arabic();
        $db_params['order'] = $this->get_order();
        $db_params['is_require'] = $this->get_is_require();

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

    public function set_page_id($value)
    {
        $this->add_object_field('page_id',$value);
        $this->page_id = $value;
    }

    public function get_page_id()
    {
        return $this->page_id;
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

    public function set_question_english($value)
    {
        $this->add_object_field('question_english',$value);
        $this->question_english = $value;
    }

    public function get_question_english()
    {
        return $this->question_english;
    }

    public function set_question_arabic($value)
    {
        $this->add_object_field('question_arabic',$value);
        $this->question_arabic = $value;
    }

    public function get_question_arabic()
    {
        return $this->question_arabic;
    }

    public function get_question($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_question_arabic();
        }

        return $this->get_question_english();
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

    public function set_is_require($value)
    {
        $this->add_object_field('is_require',$value);
        $this->is_require = (int) $value;
    }

    public function get_is_require()
    {
        return $this->is_require;
    }

    /**
     * @return Orm_Survey_Page
     */
    public function get_page_obj() {
        return Orm_Survey_Page::get_instance($this->get_page_id());
    }

    public static function get_types() {
        return self::$types;
    }

    /**
     * @return int|Orm_Survey_Question[]
     */
    public function get_greater() {
        return self::get_all(array('page_id' => $this->get_page_id(), 'not_id' => $this->get_id(), 'greater_order' => $this->get_order()));
    }

    /**
     *
     */
    public function fix_orders() {
        foreach($this->get_greater() as $question) {
            $question->set_order($question->get_order() + 1);
            $question->save();
        }

        $this->reorder();
    }

    public function reorder() {
        $order = 1;
        $questions = self::get_all(array('page_id' => $this->get_page_id()));
        foreach($questions as $question) {
            $question->set_order($order);
            $question->save();

            $order++;
        }
    }

    /**
     * @param $question_id
     * @param bool $with_response
     */
    public function clone_me_type($question_id, $with_response = true) {}

    /**
     * this function clone me by its page id and with copy name and with response
     * @param int $page_id the page id of the clone me to be viewed
     * @param bool $with_copy_name the with copy name of the clone me to be call function
     * @param bool $with_response the with response of the clone me to be call function
     * @return bool|Orm_Survey_Question
     */
    public function clone_me($page_id , $with_copy_name = false, $with_response = true) {

        $copy_name = '';
        if($with_copy_name){
            $copy_name = 'copy ';
        }

        $object = new Orm_Survey_Question();
        $object->set_page_id($page_id);
        $object->set_question_english($copy_name . $this->get_question_english());
        $object->set_question_arabic($copy_name . $this->get_question_arabic());
        $object->set_description_english($this->get_description_english());
        $object->set_description_arabic($this->get_description_arabic());
        $object->set_class_type($this->get_class_type());
        $object->set_order($this->get_order());
        $object->set_is_require($this->get_is_require());

        if ($object->save()) {
            $this->clone_me_type($object->get_id(), $with_response);

            return $object;
        }

        return false;
    }
    /**
     *this function get factors
     * @return Orm_Survey_Question_Factor[] the call function
     */
    public function get_factors() {
        return Orm_Survey_Question_Factor::get_all(array('question_id' => $this->get_id()));
    }
    /**
     *this function get choices
     * @return Orm_Survey_Question_Choice[] the call function
     */
    public function get_choices() {
        return Orm_Survey_Question_Choice::get_all(array('question_id' => $this->get_id()));
    }

    public function validator() {}

    public function save_process() {
        $this->save();
    }

    /**
     *this function draw add edit
     * @return string the call function
     */
    public function draw_add_edit() {}
    /**
     *this function draw question
     * @return string the call function
     */
    public function draw_question() {}
    /**
     *this function draw report by its filters
     * @param array $filters the order of the draw report to be call function
     * @return string the call function
     */
    public function draw_report($filters = array()) {}

    /**
     *this function get js validator
     * @return string the call function
     */
    public function get_js_validator() {
        return "'{$this->get_html_question_name()}': { required: true }";
    }

    /**
     *this function get html question name
     * @return string the call function
     */
    public function get_html_question_name() {
        return "question_{$this->get_id()}";
    }

    /**
     * @param $evaluator_id
     */
    public function save_user_response($evaluator_id) {}
    /**
     *this function get responses by its filters
     * @param array $filters the order of the get responses with wrapper to be call function
     * @return array the call function
     */
    public function get_responses($filters){
        $questionType = $this->get_class_type();
        $q_id = $this->get_id();
        $data=[];
        $temp=[];
        $filters['question_id'] = $q_id;
        switch ($questionType){
            case 'Orm_Survey_Question_Type_Checkbox':
                $data[$q_id]['name']=$this->get_question();
                $chooses = Orm_Survey_User_Response_Choice::get_all($filters);
                $data[$q_id]['total_responses']=count($chooses);
                foreach ($chooses as $choose){
                    if(!isset( $temp[$choose->get_choice_id()])){
                        $temp[$choose->get_choice_id()]['total']=1;
                        $name=Orm_Survey_Question_Choice::get_instance($choose->get_choice_id());
                        $temp[$choose->get_choice_id()]['name']=$name->get_choice();
                    }
                    else{
                        $temp[$choose->get_choice_id()]['total']++;
                    }
                }

                $data[$q_id]['choices']=$temp;
                break;
            case 'Orm_Survey_Question_Type_Radio':
                $data[$q_id]['name']=$this->get_question();
                $chooses=Orm_Survey_User_Response_Choice::get_all($filters);
                $data[$q_id]['total_responses']=count($chooses);
                foreach ($chooses as $choose){
                    if(!isset( $temp[$choose->get_choice_id()])){
                        $temp[$choose->get_choice_id()]['total']=1;
                        $name=Orm_Survey_Question_Choice::get_instance($choose->get_choice_id());
                        $temp[$choose->get_choice_id()]['name']=$name->get_choice();
                    }
                    else{
                        $temp[$choose->get_choice_id()]['total']++;
                    }
                }

                $data[$q_id]['choices']=$temp;
                break;
            case 'Orm_Survey_Question_Type_Textarea':
                $data[$q_id]['name']=$this->get_question();
                $text_responses =Orm_Survey_User_Response_Text::get_all($filters);
                $data[$q_id]['total_responses']=count($text_responses);
                break;
            case 'Orm_Survey_Question_Type_Factors_And_Statements':
                $data[$q_id]['name']=$this->get_question();
                foreach ($this->get_factors() as $factor){
                    $temp[$factor->get_id()]['factor_group_name'] = $factor->get_title();
                    foreach($factor->get_statements() as $statement){
                        $temp[$factor->get_id()]['questions'][$statement->get_id()]['statement'] = $statement->get_title();
                        $rank= $statement->get_user_response($filters);
                        $temp[$factor->get_id()]['questions'][$statement->get_id()]['avg'] = ($rank['average'])?:0;
                        $data[$q_id]['total_responses'] = ($rank['count'])?:0;
                    }
                }
                $data[$q_id]['factors'] = $temp;
                break;
        }
        return $data;
    }
    /**
     *this function draw question with wrapper by its order
     * @param string $order the order of the draw question with wrapper to be call function
     * @return string the html view
     */
    public function draw_question_with_wrapper(&$order) {

        $q = lang('Q');
        //$order = $this->get_order();
        $question = nl2br(htmlfilter($this->get_question()));
        $description = '';
        if ($this->get_description()) {
            $description = '<div class="well well-sm">' . xssfilter($this->get_description()) . '</div>';
        }

        return <<<HTML
        <div class="panel panel-primary">
            <div class="panel-heading">
                <label class="label label-default m-a-0">{$q} {$order}</label> {$question}
            </div>
            <div class="panel-body">
                {$description}
                {$this->draw_question()}
            </div>
        </div>
HTML;

    }

    /**
     * this function update old question by its class type
     * @param string $class_type the class type of the update old question to be call function
     * @return Orm_Survey_Question the call function
     */
    public function update_old_question($class_type) {

        $question_obj = new $class_type(); /** @var $question_obj Orm_Survey_Question */
        $question_obj->set_id($this->get_id());
        $question_obj->set_page_id($this->get_page_id());
        $question_obj->set_class_type($this->get_class_type());
        $question_obj->set_question_english($this->get_question_english());
        $question_obj->set_description_arabic($this->get_description_arabic());
        $question_obj->set_order($this->get_order());
        $question_obj->set_is_require($this->get_is_require());

        $question_obj->set_object_status('old');

        return $question_obj;

    }
}

