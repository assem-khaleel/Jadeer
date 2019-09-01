<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Wa_Award extends Orm {
    
    /**
    * @var $instances Orm_Wa_Award[]
    */
    protected static $instances = array();
    protected static $table_name = 'wa_award';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $created_by = 0;
    protected $is_deleted = 0;
    protected $date = '0000-00-00';
    protected $level = 0;
    protected $level_id = 0;
    protected $description_ar = '';
    protected $description_en = '';

    const INSTITUTION_LEVEL = 0;
    const COLLEGE_LEVEL = 1;
    const PROGRAM_LEVEL = 2;

    /**
    * @return Wa_Award_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Wa_Award_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Wa_Award
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
    * @return Orm_Wa_Award[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Wa_Award
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Wa_Award();
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


    /**
     * get array
     *
     * @param array $db_params
     * @return int
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['created_by'] = $this->get_created_by();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['date'] = $this->get_date();
        $db_params['level'] = $this->get_level();
        $db_params['level_id'] = $this->get_level_id();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['description_en'] = $this->get_description_en();
        
        return $db_params;
    }

    /**
     * save object
     *
     * @param int $insert_id
     * @return int
     */
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


    /**
     * delete object
     * @return int
     */
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
    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }
    public function get_name_ar() {
        return $this->name_ar;
    }
    
    public function set_created_by($value) {
        $this->add_object_field('created_by', $value);
        $this->created_by = $value;
    }
    
    public function get_created_by() {
        return $this->created_by;
    }
    
    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted', $value);
        $this->is_deleted = $value;
    }
    
    public function get_is_deleted() {
        return $this->is_deleted;
    }
    
    public function set_date($value) {
        $this->add_object_field('date', $value);
        $this->date = $value;
    }
    
    public function get_date() {
        return $this->date;
    }
    
    public function set_description_ar($value) {
        $this->add_object_field('description_ar', $value);
        $this->description_ar = $value;
    }
    
    public function get_description_ar() {
        return $this->description_ar;
    }
    
    public function set_description_en($value) {
        $this->add_object_field('description_en', $value);
        $this->description_en = $value;
    }
    
    public function get_description_en() {
        return $this->description_en;
    }

    public function get_description($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_description_ar();
        }
        return $this->get_description_en();
    }
    public function set_level($value)
    {
        $this->add_object_field('level', $value);
        $this->level = $value;
    }

    public function get_level($title = false)
    {
        if ($title) {
            return self::get_levels($title)[$this->level];
        }
        return $this->level;
    }

    public function set_level_id($value)
    {
        $this->add_object_field('level_id', $value);
        $this->level_id = $value;
    }

    public function get_level_id($title = false)
    {
        if ($title) {
            return $this->get_level_title();
        }

        return $this->level_id;
    }
    public function get_current_type() {
        return self::get_levels(true)[$this->get_level()];
    }

    public static function get_levels($is_String = false)
    {
        $access = array();
        if(!$is_String){
            if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {

                $access[self::INSTITUTION_LEVEL]=lang('Institution');
                $access[self::COLLEGE_LEVEL]=lang('College');
            }
            if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {

                $access[self::COLLEGE_LEVEL]=lang('College');
            }

        }else{
            $access[self::INSTITUTION_LEVEL]=lang('Institution');
            $access[self::COLLEGE_LEVEL]=lang('College');
        }

        $access[self::PROGRAM_LEVEL]=lang('Program');

        return $access;
    }

    public  function get_winners(){
    	return Orm_Wa_Winner_Award::get_all(['award_id'=>$this->get_id()]);
	}

	public  function get_candidates(){
    	return Orm_Wa_Candidate_User::get_all(['award_id'=>$this->get_id()]);
	}
    public function get_level_title()
    {
        switch ($this->get_level()) {
            case self::COLLEGE_LEVEL:
                return Orm_College::get_instance($this->get_level_id())->get_name();

            case self::PROGRAM_LEVEL:
                return Orm_Program::get_instance($this->get_level_id())->get_name();

            default :
                return  lang('INSTITUTION');
            break;
        }
    }

    /** generate pdf page
     * generate pdf page depending on many settings for page
    */
    public function generate_pdf() {
        $headerText = lang('Award')." : ";
        $headerText .= $this->get_name(). "<br />";
        $headerText .= lang('Level')." : ";
        $headerText .= $this->get_level();
        $headerText .= ' ( '.$this->get_level_title().' )';


        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);

        $header_html = Orm::get_ci()->load->view('pdf_header', array(''), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            //footer
            'footer-left' => lang('Award')
        ));


        $this->generate_pdf_page($pdf);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory();

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name =  'Award ('.$this->get_name().').pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }
    /** set layout and convert it pdf from html
    */
    public function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf) {

        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->content_as_html(false)->view('view', array('award' => $this), true);
        $pdf->addPage($content);
    }

    /** get the path of file directory
     */
    public function get_attachments_directory()
    {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';

        $path .= 'Award';

        return $path;
    }
}

