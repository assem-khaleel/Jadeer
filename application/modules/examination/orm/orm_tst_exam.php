<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tst_Exam extends Orm {

    /**
    * @var $instances Orm_Tst_Exam[]
    */
    protected static $instances = array();
    protected static $table_name = 'tst_exam';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $course_id = 0;
    protected $is_deleted = 0;
    protected $teacher_id = 0;
    protected $sections = '';
    protected $desc_en = '';
    protected $desc_ar = '';
    protected $type = 0;
    protected $start = 0;
    protected $end = 0;
    protected $semester_id = 0;
    protected $fullmark = 0;

    private $monitors = null;


    const TYPE_EXAM = 0;
    const TYPE_ASSIGNMENT = 1;
    const TYPE_QUIZ = 2;

    public static function get_students_attended($exam_id) {

        $sql  = "select count(DISTINCT user_id) as count_students from (";
        $sql .= "select DISTINCT user_id from `".Orm_Tst_Exam_Response_Choice::get_table_name()."` where exam_id=? ";
        $sql .= "union ";
        $sql .= "select DISTINCT user_id from `".Orm_Tst_Exam_Response_Text::get_table_name()."` where exam_id=? ";
        $sql .= "union ";
        $sql .= "select DISTINCT user_id from `".Orm_Tst_Exam_Response_Attachment::get_table_name()."` where exam_id=? ";
        $sql .= ") as tab";


        $rs = self::get_ci()->db->query($sql, [$exam_id, $exam_id, $exam_id]);

        if($rs->num_rows()){
            return $rs->row()->count_students;
        }

        return 0;
    }

    /**
    * @return Tst_Exam_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tst_Exam_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tst_Exam
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
    * @return Orm_Tst_Exam[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tst_Exam
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tst_Exam();
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
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['course_id'] = $this->get_course_id();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['teacher_id'] = $this->get_teacher_id();
        $db_params['sections'] = $this->get_sections(false);
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();
        $db_params['type'] = $this->get_type();
        $db_params['start'] = $this->get_start(true);
        $db_params['end'] = $this->get_end(true);
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['fullmark'] = $this->get_fullmark();
        
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
    
    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }
    
    public function get_name_en() {
        return $this->name_en;
    }
    
    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }
    
    public function get_name_ar() {
        return $this->name_ar;
    }
    
    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }
    
    public function get_course_id() {
        return $this->course_id;
    }
    
    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted', $value);
        $this->is_deleted = $value;
    }
    
    public function get_is_deleted() {
        return $this->is_deleted;
    }
    
    public function set_teacher_id($value) {
        $this->add_object_field('teacher_id', $value);
        $this->teacher_id = $value;
    }
    
    public function get_teacher_id() {
        return $this->teacher_id;
    }

    public function set_sections($value) {

        if(is_array($value)) {
            $value = json_encode($value);
        }

        $this->add_object_field('sections', $value);
        $this->sections = $value;
    }

    public function get_sections($as_array = true) {
//        echo $this->sections ;die;
        if($as_array) {
            $arr = json_decode($this->sections, true);
            return $arr?: [];
        }
        return $this->sections;
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
    
    public function set_type($value) {
        $value = intval($value);
        $this->add_object_field('type', $value);
        $this->type = $value;
    }
    
    public function get_type() {
        return $this->type;
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

    public function set_fullmark($value) {
        $this->add_object_field('fullmark', $value);
        $this->fullmark = $value;
    }

    public function get_fullmark() {
        return $this->fullmark;
    }


    public function get_name($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }

    public function get_desc($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_desc_ar();
        }
        return $this->get_desc_en();
    }

    public function get_course_obj(){
        return Orm_Course::get_instance($this->get_course_id());
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
        return date('H:i:s',$this->start);
    }

    public function get_end_time(){
        if(empty($this->end)){
            return '';
        }
        return date('H:i:s',$this->end);
    }

    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }

    public function get_semester_id() {
        return $this->semester_id;
    }

    /**
     * @return int|null|Orm_Tst_Exam_Monitors[]
     */
    public function get_monitors()
    {
        if(is_null($this->monitors)) {
            $this->monitors = Orm_Tst_Exam_Monitors::get_all(['exam_id' => $this->get_id()]);
        }

        return $this->monitors;
    }

    public function get_monitor_ids()
    {
        $monitor_ids = array();
        foreach ($this->get_monitors() as $monitor) {/* @var $monitor Orm_Tst_Exam_Monitors*/
            $monitor_ids[] = $monitor->get_monitor_id();
        }
        return $monitor_ids;
    }

    public function is_monitor($id)
    {
        $monitor = $this->monitors = Orm_Tst_Exam_Monitors::get_one(['exam_id' => $this->get_id(), 'monitor_id' => $id]);

        return ($monitor && $monitor->get_id());
    }

    public static function get_student_exams($filters = array(),$page,$per_page, $count=false){
        $filters['start_greater_than'] = 1;
        $filters['semester_id'] = Orm_Semester::get_active_semester_id();

        $filters['student']['in_course_id'] = Orm_Course_Section_Student::get_course_ids(null, Orm_Semester::get_active_semester_id());
        $filters['student']['in_section_id'] = Orm_Course_Section_Student::get_section_ids();

        if($count) {
            return self::get_count($filters);
        }

        return self::get_all($filters,$page,$per_page, ['id desc']);
    }

    public function get_students($filter=[], $page=0, $per_page=0) {

        $filter['section_id_in'] = $this->get_sections(true);
        return Orm_Course_Section_Student::get_all($filter, $page,$per_page);
    }

    public function get_students_count($filter=[]) {

        $filter['section_id_in'] = $this->get_sections(true);

        if(count($filter['section_id_in'])==0){
            return 0;
        }

        return Orm_Course_Section_Student::get_count($filter);
    }

    /** check if the exam can start depending on start and end date
    */
    public function exam_can_start() {
        $can_start=false;

        $date_check = (time() >= $this->get_start(true) && time() <= $this->get_end(true));
        $date_attendance = Orm_Tst_Exam_Attendance::get_one(['exam_id' => $this->get_id(), 'student_id' => Orm_User::get_logged_user_id()]);
        if ($date_check && $date_attendance->get_id()) {
            $can_start = true;
        }

        return $can_start ;
    }

    /** check if the exam is still active
    */
    public function is_active(){

        $go = time() >= $this->get_start(true) && time() <= $this->get_end(true);

        return ($go && !empty($this->get_sections(true)));
    }

    /** check if user can edit the exam
    */
    public function can_edit() {

        if(!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')){
            return false;
        }


        if($this->get_semester_id() != Orm_Semester::get_current_semester()->get_id()) {
            return false;
        }


        if($this->get_teacher_id() != Orm_user::get_logged_user_id()) {
            return false;
        }

        $answer = Orm_Tst_Exam_Response_Attachment::get_one(['exam_id'=>$this->get_id()]);

        if($answer && $answer->get_id()) {
            return false;
        }

        $answer = Orm_Tst_Exam_Response_Choice::get_one(['exam_id'=>$this->get_id()]);

        if($answer && $answer->get_id()) {
            return false;
        }

        $answer = Orm_Tst_Exam_Response_Text::get_one(['exam_id'=>$this->get_id()]);

        if($answer && $answer->get_id()) {
            return false;
        }

        return true;
    }

    /** check if the user can publish the exam or not
    */
    public function ready_to_publish() {

        if(!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')){
            return false;
        }

        if($this->get_teacher_id() != Orm_user::get_logged_user_id()) {
            return false;
        }

        if($this->get_semester_id() != Orm_Semester::get_current_semester()->get_id()) {
            return false;
        }

        if($this->get_total_question_marks() != $this->get_fullmark()) {
            return false;
        }

        return true;
    }

    /** check if the exam is published or not
    */
    public function is_published() {
        return ($this->get_start(true) <= time() && $this->get_start(true) != 0);
    }

    public static function get_exam_id_by_monitor($monitor_id){
        $ids = [];

        $exams = Orm_Tst_Exam_Monitors::get_all(['monitor_id'=>$monitor_id]);

        foreach ($exams as $exam){
            $ids[] =  $exam->get_exam_id();
        }

        return $ids;
    }

    public function check_end(){

        if($this->get_end(true)!=0) {
            if ($this->get_end(true) < time()) {
                return true;
            }
        }

        return false;
    }

    /** check if the student has answer and attachment
    */
    public function has_answer($user_id=0) {

        if(!$user_id){
            $user_id=Orm_User::get_logged_user_id();
        }

        $row = Orm_Tst_Exam_Response_Choice::get_one(['user_id' => $user_id, 'exam_id'=> $this->get_id()]);
        if($row && $row->get_id()) {
            return true;
        }

        $row = Orm_Tst_Exam_Response_Text::get_one(['user_id' => $user_id, 'exam_id'=> $this->get_id()]);
        if($row && $row->get_id()) {
            return true;
        }

        $row = Orm_Tst_Exam_Response_Attachment::get_one(['user_id' => $user_id, 'exam_id'=> $this->get_id()]);
        if($row && $row->get_id()) {
            return true;
        }

        return false;
    }

    /**
     * @return Orm_Tst_Exam_Questions[]
     */
    public function get_questions() {
        return Orm_Tst_Exam_Questions::get_all(['exam_id'=>$this->get_id()], 0, 0, ['id']);
    }

    public function get_total_question_marks(){
        return Orm_Tst_Exam_Questions::get_mark_total($this->get_id());
    }

    public function get_attachment(){
        $file = Orm_Tst_Exam_Attachment::get_one(['exam_id'=>$this->get_id()]);

        if($file && $file->get_id() && $file->get_path() !=''){
            return $file->get_path();
        }

        return false;
    }


    /** save file of attachemnt in  the correct path and upload it
    */
    public function save_file()
    {
        Uploader::validator('attach', false);

        if (Validator::success()) {

            $files_dir = '/files/Documents/' . $this->get_attachments_directory();

            $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
            if (!is_dir($files_full_dir)) {
                mkdir($files_full_dir, 0777, true);
            }

            $name = $_FILES['attach']['name'];

            $name = substr($name, 0, strrpos($name, '.'));
            $files_dir = rtrim($files_dir, '/') . '/' . $name;


            $file = Uploader::do_process('attach', $files_dir);

            if ($file) {

                $attach = Orm_Tst_Exam_Attachment::get_one(['exam_id'   => $this->get_id()]);

                @unlink(rtrim(FCPATH, '/') . $attach->get_path());

                $attach->set_exam_id($this->get_id());
                $attach->set_file_type($_FILES['attach']['type']);
                $attach->set_path($file);
                return $attach->save();
            }
        }

        return false;
    }

    protected function get_attachments_directory() {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';

        $path .= Orm_user::get_logged_user()->get_college_obj()->get_name_en() . '/';
        $path .= Orm_user::get_logged_user()->get_program_obj()->get_name_en() . '/';

        $exam = Orm_Tst_Exam::get_instance($this->get_id());

        $type = 'Exams';

        switch ($exam->get_type()){
            case Orm_Tst_Exam::TYPE_ASSIGNMENT:
                $type = 'Assignments';
                break;
            case Orm_Tst_Exam::TYPE_QUIZ:
                $type = 'Quiz';
                break;
        }
        $path .= $type.'/';

        $path .= $exam->get_course_obj()->get_name().'/';

        $path .= Orm_User::get_logged_user()->get_full_name().'/';

        $path .= $exam->get_name().'/';

        $path = preg_replace('/[\/]+/', '/', $path);

        return $path;
    }

}

