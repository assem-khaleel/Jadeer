<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tst_Question extends Orm
{

    /**
     * @var $instances Orm_Tst_Question[]
     */
    protected static $instances = array();
    protected static $table_name = 'tst_question';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $course_id = 0;
    protected $text_ar = '';
    protected $text_en = '';
    protected $type = '0';
    protected $difficulty = 0;
    protected $status = 0;
    protected $user_id = 0;
    protected $can_attach = 0;
    protected $is_assignment = 0;

    private static $types = array(
        'Orm_Tst_Question_Type_Textarea' => 'Comment/Essay Box',
        'Orm_Tst_Question_Type_Radio' => 'Multiple Choice (Only One Answer)',
        'Orm_Tst_Question_Type_Checkbox' => 'Multiple Choice (Multiple Answers)',
    );

    const DIFFICULTY_HARD = 1;
    const DIFFICULTY_MEDIUM = 2;
    const DIFFICULTY_EASY = 3;
    public static $difficulties = [
        self::DIFFICULTY_HARD => ['label' => 'Hard', 'tag' => 'danger'],
        self::DIFFICULTY_MEDIUM => ['label' => 'Medium', 'tag' => 'warning'],
        self::DIFFICULTY_EASY => ['label' => 'Easy', 'tag' => 'success']
    ];

    const STATUS_PRIVATE = 1;
    const STATUS_PENDING = 2;
    const STATUS_PUBLIC = 3;
    public static $status_arr = [
        self::STATUS_PRIVATE => 'Private',
//        self::STATUS_PENDING => 'Pending',
        self::STATUS_PUBLIC => 'Show on Public'
    ];


    /**
     * @return Tst_Question_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Tst_Question_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Tst_Question
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
     * Get all rows as Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Tst_Question[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Tst_Question
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Tst_Question();
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
        $db_params['course_id'] = $this->get_course_id();
        $db_params['text_ar'] = $this->get_text_ar();
        $db_params['text_en'] = $this->get_text_en();
        $db_params['type'] = $this->get_type();
        $db_params['difficulty'] = $this->get_difficulty();
        $db_params['status'] = $this->get_status();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['can_attach'] = $this->get_can_attach();
        $db_params['is_assignment'] = $this->get_is_assignment();

        return $db_params;
    }

    public function save()
    {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif ($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        if ($this->get_type() != 'Orm_Tst_Question_Type_Textarea') {
            $options = Orm_Tst_Question_Options::get_all(['question_id' => $this->get_id()]);
            if (count($options)) {
                foreach ($options as $option)
                    $option->delete();
            }
        }
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_text_ar($value)
    {
        $this->add_object_field('text_ar', $value);
        $this->text_ar = $value;
    }

    public function get_text_ar()
    {
        return $this->text_ar;
    }

    public function set_text_en($value)
    {
        $this->add_object_field('text_en', $value);
        $this->text_en = $value;
    }

    public function get_text_en()
    {
        return $this->text_en;
    }

    public function get_text($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_text_ar();
        }
        return $this->get_text_en();
    }

    public function set_type($value)
    {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    public function get_type($to_string = false)
    {
        if($to_string) {
            $a = isset(self::$types[$this->type]) ? self::$types[$this->type] : '';
            return $a;
        }

        return $this->type;
    }

    public function set_difficulty($value)
    {
        $this->add_object_field('difficulty', $value);
        $this->difficulty = $value;
    }

    public function get_difficulty()
    {
        return $this->difficulty;
    }

    public function set_status($value)
    {
        $this->add_object_field('status', $value);
        $this->status = $value;
    }

    public function get_status()
    {
        return $this->status;
    }

    public function get_course_id($to_obj=false) {
        if($to_obj){
            return Orm_course::get_instance($this->course_id);
        }

        return $this->course_id;
    }

    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }

    public function set_can_attach($value)
    {
        $this->add_object_field('can_attach', $value);
        $this->can_attach = $value;
    }

    public function get_can_attach()
    {
        return $this->can_attach;
    }

    public function set_is_assignment($value)
    {
        $this->add_object_field('is_assignment', $value);
        $this->is_assignment = $value;
    }

    public function get_is_assignment()
    {
        return $this->is_assignment;
    }

    public function set_user_id($value)
    {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }


    public static function get_types()
    {
        return self::$types;
    }

    /**
     * @return Orm_Tst_Question_Options[]
     */
    public function get_choices()
    {
        return Orm_Tst_Question_Options::get_all(array('question_id' => $this->get_id()));
    }


    /** save choices for the student who are selected it either radio or checkbox
    */
    public function save_process() {
        $this->save();
    }

    /** parent function to draw the
     *
    */
    public function draw_add_edit() {
//        echo '<h1>' . lang('Please Select Question Type') . '</h1>';
    }

    /** function to draw question as charts and has two three functions override
    */
    public function draw_question() {}

    /** validate the choices for the students either for radio or checkbox
    */
    public function validator() {}
    /** draw report fort choices that student choose and draw it
    */
    public function draw_report($filters = array()) {}

    public function get_html_question_name($attachment=false)
    {
        if($attachment) {
            return "question_{$this->get_id()}_attachment";
        }

        return "question_{$this->get_id()}";
    }

    public function get_question_with_user_response($exam_id, $user_id=0, $correction_more=false) {}

    /** save user reponse depending on question type
    */
    public function save_user_response($exam_id) {}

    /** save student attachment file for the question
    */
    public function save_user_attachment($exam_id) {

        Uploader::validator($this->get_html_question_name(),false);

        if(Validator::success() && $this->get_can_attach()) {

            $files_dir = '/files/Documents/' . $this->get_attachments_directory($exam_id);

            $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
            if (!is_dir($files_full_dir)) {
                mkdir($files_full_dir, 0777, true);
            }

            $name = $_FILES[$this->get_html_question_name(true)]['name'] ;

            $name = substr($name,0,strrpos($name,'.'));
            $files_dir = rtrim($files_dir, '/') . '/' . $name;


            $file = Uploader::do_process(
                $this->get_html_question_name(true),
                $files_dir
            );

            if($file) {

                $attch = Orm_Tst_Exam_Response_Attachment::get_one([
                    'exam_id'=>$exam_id,
                    'question_id' => $this->get_id(),
                    'user_id'=>Orm_User::get_logged_user_id()
                ]);

                @unlink(rtrim(FCPATH, '/').$attch->get_path_file());

                $attch->set_path_file($file);
                $attch->set_exam_id($exam_id);
                $attch->set_question_id($this->get_id());
                $attch->set_user_id(Orm_User::get_logged_user_id());
                return $attch->save();
            }

        }

        return false;
    }

    /** check if user can edit the question and has authority for it
    */
    public function can_edit(){
        $can_edit = true;
        $filters['question_id'] = $this->get_id();
        $exams_ids = array_column(Orm_Tst_Exam_Questions::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_ARRAY), 'exam_id');

        if (count($exams_ids) && Orm_Tst_Exam::get_count(['in_id' => $exams_ids, 'is_deleted' => 0]))
            $can_edit = false;

        return $can_edit;
    }

    public function get_outcome() {
        return Orm_Tst_Question_Outcome::get_all(['question_id' => $this->get_id()]);
    }


    protected function get_attachments_directory($exam_id)
    {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';

        $path .= Orm_user::get_logged_user()->get_college_obj()->get_name_en() . '/';
        $path .= Orm_user::get_logged_user()->get_program_obj()->get_name_en() . '/';

        $exam = Orm_Tst_Exam::get_instance($exam_id);

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


        $section = array_intersect($exam->get_sections(), Orm_Course_Section_Student::get_section_ids(Orm_User::get_logged_user_id()));

        $section = reset($section);

        if($section===false){
            $path .= 'non_sections/';
        }
        else {
            $path .= Orm_Course_Section::get_instance($section)->get_name().'/';
        }

        $path .= Orm_user::get_logged_user()->get_full_name().'/';

        return $path;
    }

}