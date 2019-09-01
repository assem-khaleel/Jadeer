<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rb_Result extends Orm {
    
    /**
    * @var $instances Orm_Rb_Result[]
    */
    protected static $instances = array();
    protected static $table_name = 'rb_result';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $evaluator = 0;
    protected $user_id = 0;
    protected $semester_id = 0;
    protected $rubric_id = 0;
    protected $skill_id = 0;
    protected $scale_id = 0;
    
    /**
    * @return Rb_Result_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rb_Result_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rb_Result
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
    * @return Orm_Rb_Result[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rb_Result
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rb_Result();
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
        $db_params['id'] = $this->get_id();
        $db_params['evaluator'] = $this->get_evaluator();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['rubric_id'] = $this->get_rubric_id();
        $db_params['skill_id'] = $this->get_skill_id();
        $db_params['scale_id'] = $this->get_scale_id();
        
        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {
            self::get_model()->insert($this->to_array());
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }
        
        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this;
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
    
    public function set_evaluator($value) {
        $this->add_object_field('evaluator', $value);
        $this->evaluator = $value;
    }
    
    public function get_evaluator() {
        return $this->evaluator;
    }
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }
    
    public function set_rubric_id($value) {
        $this->add_object_field('rubric_id', $value);
        $this->rubric_id = $value;
    }
    
    public function get_rubric_id() {
        return $this->rubric_id;
    }
    
    public function set_skill_id($value) {
        $this->add_object_field('skill_id', $value);
        $this->skill_id = $value;
    }
    
    public function get_skill_id() {
        return $this->skill_id;
    }
    
    public function set_scale_id($value) {
        $this->add_object_field('scale_id', $value);
        $this->scale_id = $value;
    }
    
    public function get_scale_id() {
        return $this->scale_id;
    }

    /**
     * this function get skill obj
     * @return Orm_Rb_Skills the object call function
     */
    public function get_skill_object() {
        return Orm_Rb_Skills::get_instance($this->get_skill_id());
    }

    /**
     * this function get rubric obj
     * @return Orm_Rb_Rubrics the object call function
     */
    public function get_rubric_obj()
    {
        return Orm_Rb_Rubrics::get_instance($this->get_rubric_id());
    }

    /**
     * this function get scale obj
     * @return Orm_Rb_Scale the object call function
     */
    public function get_scale_obj()
    {
        return Orm_Rb_Scale::get_instance($this->get_scale_id());
    }

    /**
     * this function get all group by user id by its filters
     * @param array $filters the program of the get all group by user id  to be call function
     * @return array the call function
     */
    public static function get_all_group_by_user_id($filters) {

        return self::get_model()->get_all_group_by_user_id($filters);
    }

    /**
     * this function get all group by user id by its filters
     * @param array $filters the program of the get all group by user id  to be call function
     * @return int the call function
     */
    public static function get_all_group_by_user_id_count($filters) {

        return self::get_model()->get_all_group_by_user_id_count($filters);
    }

    /**
     * this function generate pdf by its user id
     * @param int $user_id the user id of the generate pdf to be call function
     * @return string file pdf the call function
    */
    public static function generate_pdf($user_id)
    {

        $user=Orm_User::get_instance($user_id);
        $headerText = lang('Skills Transcript')." : ";
        $headerText .= $user->get_full_name(). "<br />";



        $rbSkills=Orm_Rb_Result::get_all(['user_id'=>$user_id]);


        $var=Orm::get_ci()->config->item('wk_pdf_options');
        $var['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($var);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $pdf->setOptions(array(
            'margin-top' => 27,

            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            //footer
            'footer-left' => lang('Skills Transcript')
        ));

        $pdf->addToc();

        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->content_as_html(false)->view('skills_transcript/details', array('rbSkills' => $rbSkills,'user_id' =>$user_id), true);
        $pdf->addPage($content);

        $files_dir = '/files/Documents/' .'Skills Transcript';

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name =  'Skills Transcript.pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }
    
}

