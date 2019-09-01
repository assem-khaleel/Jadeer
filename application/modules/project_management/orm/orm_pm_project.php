<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pm_Project extends Orm {
    
    /**
    * @var $instances Orm_Pm_Project[]
    */
    protected static $instances = array();
    protected static $table_name = 'pm_project';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    protected $budget = 0;
    protected $resources = '';
    protected $desc_en = '';
    protected $desc_ar = '';
    protected $responsible_id = 0;
    
    /**
    * @return Pm_Project_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pm_Project_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pm_Project
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
    * @return Orm_Pm_Project[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pm_Project
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pm_Project();
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

    /** convert object to array
    */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['budget'] = $this->get_budget();
        $db_params['resources'] = $this->get_resources();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();
        $db_params['responsible_id'] = $this->get_responsible_id();
        
        return $db_params;
    }

    /** save object
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

    /** delete object
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
    
    public function set_title_en($value) {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }
    
    public function get_title_en() {
        return $this->title_en;
    }
    
    public function set_title_ar($value) {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }
    
    public function get_title_ar() {
        return $this->title_ar;
    }
    
    public function set_start_date($value) {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }
    
    public function get_start_date() {
        return $this->start_date;
    }
    
    public function set_end_date($value) {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }
    
    public function get_end_date() {
        return $this->end_date;
    }
    
    public function set_budget($value) {
        $this->add_object_field('budget', $value);
        $this->budget = $value;
    }
    
    public function get_budget() {
        return $this->budget;
    }
    
    public function set_resources($value) {
        $this->add_object_field('resources', $value);
        $this->resources = $value;
    }
    
    public function get_resources() {
        return $this->resources;
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
    
    public function set_responsible_id($value) {
        $this->add_object_field('responsible_id', $value);
        $this->responsible_id = $value;
    }
    
    public function get_responsible_id() {
        return $this->responsible_id;
    }

    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }
    public static function check_if_can_generate_report() {

        return  Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'project_management-report');

    }
    /** generate pdf file either for strategic projects or customized projects and save it
    */
    public static function generate_pdf($project_id , $type , $html)
    {
        if($type == 0){
            $project = Orm_Sp_Project::get_instance($project_id);
        }else{
            $project = Orm_Pm_Project::get_instance($project_id);
        }
        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);

        $header_html = Orm::get_ci()->load->view('pdf_header', array(''), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line'
        ));

        $pdf->addPage($html);

        $files_dir = '/files/Documents/project_management';

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $today = date('Ymd');
        $file_title = str_replace(['&',' ','/','(',')','-','\\'],'_',$project->get_title());
        $file_title = str_replace(['__'],'_',$file_title);
        $file_title = str_replace(['__'],'_',$file_title);
        $name =str_replace(['__'],'_', "{$file_title}_{$today}.pdf");
        $file_name = rtrim($files_full_dir,'/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name))
        {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /** check and validate end date for the project
    */
    public static function end_date($date){
        if($date == date('Y-m-d')){
            Validator::set_error_flash_message(lang('Date out of Scope'));
            redirect('project_management/assigned_sub_phases');

        }
    }
}

