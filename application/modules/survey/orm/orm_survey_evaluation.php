<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey_Evaluation extends Orm
{

    /**
     * @var $instances Orm_Survey_Evaluation[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey_evaluation';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $survey_id = 0;
    protected $semester_id = 0;
    protected $description_english = '';
    protected $description_arabic = '';
    protected $criteria = '';
    protected $created_by = 0;
    protected $date_added = '0000-00-00 00:00:00';
    protected $date_modified = '0000-00-00 00:00:00';
    protected $response_date = '0000-00-00 00:00:00';
    protected $start = 0;
    protected $end = 0;

    /**
     * @return Survey_Evaluation_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_Evaluation_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey_Evaluation
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
     * @return Orm_Survey_Evaluation[] | int
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
     * @return Orm_Survey_Evaluation
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey_Evaluation();
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
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['description_english'] = $this->get_description_english();
        $db_params['description_arabic'] = $this->get_description_arabic();
        $db_params['criteria'] = $this->get_criteria(false);
        $db_params['created_by'] = $this->get_created_by();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['date_modified'] = $this->get_date_modified();
        $db_params['start'] = $this->get_start(true);
        $db_params['end'] = $this->get_end(true);

        return $db_params;
    }

    public function save() {

        $this->set_date_modified(date('Y-m-d H:i:s'));

        if ($this->get_object_status() == 'new') {

            $this->set_date_added(date('Y-m-d H:i:s'));

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

    public function set_semester_id($value)
    {
        $this->add_object_field('semester_id',$value);
        $this->semester_id = $value;
    }

    public function get_semester_id()
    {
        return $this->semester_id;
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

    public function set_criteria($value)
    {
        if(is_array($value)) {
            $value = json_encode($value);
        }

        $this->add_object_field('criteria',$value);
        $this->criteria = $value;
    }

    public function get_criteria($as_array = true)
    {
        if($as_array) {
            return json_decode($this->criteria, true);
        }
        return $this->criteria;
    }

    public function get_item_from_criteria($item) {
        $criteria = $this->get_criteria();
        return isset($criteria[$item]) ? $criteria[$item] : null;
    }

    public function set_created_by($value)
    {
        $this->add_object_field('created_by',$value);
        $this->created_by = $value;
    }

    public function get_created_by()
    {
        return $this->created_by;
    }

    public function set_date_added($value) {
        $this->add_object_field('date_added',$value);
        $this->date_added = $value;
    }

    public function get_date_added()
    {
        return $this->date_added;
    }

    public function set_date_modified($value) {
        $this->add_object_field('date_modified',$value);
        $this->date_modified = $value;
    }

    public function get_date_modified()
    {
        return $this->date_modified;
    }

    public function get_date_format($lang = UI_LANG) {
        if($this->get_start(true)==0){
            return '-';
        }
        return date('F d,Y', strtotime($this->get_start()));
    }
    public function set_start($value) {
        $this->add_object_field('start', $value);
        $this->start = $value;
    }

    public function get_start($timestamp = false) {
        if(empty($this->start)){
            return '';
        }
        if($timestamp){
            return $this->start;
        }else{
            return date('Y-m-d H:i:s',$this->start);
        }
    }

    public function set_end($value) {
        $this->add_object_field('end', $value);
        $this->end = $value;
    }

    public function get_end($timestamp=false) {
        if(empty($this->end)){
            return '';
        }
        if($timestamp){
            return $this->end;
        }else{
            return date('Y-m-d H:i:s',$this->end);
        }
    }
    /*Date start and end */

    public function get_start_date(){
        if(empty($this->start)){
            return '';
        }
        return date('Y-m-d',$this->start);
    }

    public function get_end_date(){
        if(empty($this->end)){
            return '';
        }
        return date('Y-m-d',$this->end);
    }

    /*Date start and end */

    public function get_start_time(){
        if(empty($this->start)){
            return '';
        }
        return date('h:i', $this->start).' '.lang(date('a',$this->start));
    }

    public function get_end_time(){
        if(empty($this->end)){
            return '';
        }
        return date('h:i', $this->end).' '.lang(date('a',$this->end)) ;
    }
    /**
     *this function is published
     * @return bool the call function
     */
    public function is_published() {
        $surve_exceptions = array(Orm_Survey::TYPE_TRAINING_AFTER,Orm_Survey::TYPE_TRAINING_BEFORE,Orm_Survey::TYPE_BOA_LEADER,Orm_Survey::TYPE_BOA_MEMBER,Orm_Survey::TYPE_Advisory);
        if(in_array(Orm_Survey::get_instance($this->get_survey_id())->get_type(),$surve_exceptions) ){
          return true;
        }else{
            return ($this->get_start(true) <= time() && $this->get_end(true) >= time());
        }
    }

    private $total = null;
    private $response = null;
    /**
     * this function get respondent by its percentage
     * @param bool $percentage the percentage of the get respondent to be call function
     * @return int|string the call function
     */
    public function get_respondent($percentage = false){

        if(is_null($this->total)) {
            $this->total = Orm_Survey_Evaluator::get_count(array('survey_evaluation_id' => $this->get_id(),'academic_year' => Orm_Semester::get_active_semester()->get_year()));
        }

        if(is_null($this->response)) {
            $this->response = Orm_Survey_Evaluator::get_count(array('survey_evaluation_id' => $this->get_id(),'academic_year' => Orm_Semester::get_active_semester()->get_year(), 'response_status' => 1));
        }

        if($percentage) {

            if($this->total == 0){
                return 0;
            }

            return round($this->response / $this->total * 100, 2);
        }
        return "$this->response / $this->total";
    }
    /**
     * this function get respondent ids by its as query
     * @param bool $as_query the as query of the get respondent ids to be call function
     * @return array|string the call function
     */
    public function get_respondent_ids($as_query = false) {
        return Orm_Survey_Evaluator::get_user_ids($this->get_id(), $as_query);
    }
    /**
     *this function get evaluators
     * @return Orm_Survey_Evaluator[] all data by survey evaluation id the call function
     */
    public function get_evaluators() {
        return Orm_Survey_Evaluator::get_all(array('survey_evaluation_id' => $this->get_id()));
    }
    /**
     *this function get survey obj
     * @return Orm_Survey object the call function
     */
    public function get_survey_obj() {
        return Orm_Survey::get_instance($this->get_survey_id());
    }

    /**
     * this function get last invitation by its survey id
     * @param int $survey_id the survey id of the get last invitation to be call function
     * @return int the call function
     */
    public static function get_last_invitation($survey_id)
    {
        $result = self::get_model()->get_last_invitation($survey_id);
        return !empty($result) ? $result['last_invitation'] : 0;
    }
}

