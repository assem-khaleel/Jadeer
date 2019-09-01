<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rim_Risk_Management extends Orm {
    
    /**
    * @var $instances Orm_Rim_Risk_Management[]
    */
    protected static $instances = array();
    protected static $table_name = 'rim_risk_management';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $level_type = '';
    protected $level_id = 0;
    protected $type = __CLASS__;
    protected $type_id = 0;
    protected $likely = 0;
    protected $severity = 0;


    const RISK_INSTITUTION_LEVEL = 0;
    const RISK_COLLEGE_LEVEL = 1;
    const RISK_PROGRAM_LEVEL = 2;
    const RISK_UNIT_LEVEL = 3;
    /**
    * @return Rim_Risk_Management_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rim_Risk_Management_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rim_Risk_Management
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
    * @return Orm_Rim_Risk_Management[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rim_Risk_Management
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new static();
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
        $db_params['level_type'] = $this->get_level_type();
        $db_params['level_id'] = $this->get_level_id();
        $db_params['type'] = $this->get_type();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['likely'] = $this->get_likely();
        $db_params['severity'] = $this->get_severity();
        
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
    
    public function set_level_type($value) {
        $this->add_object_field('level_type', $value);
        $this->level_type = $value;
    }
    
    public function get_level_type() {
        return $this->level_type;
    }
    
    public function set_level_id($value) {
        $this->add_object_field('level_id', $value);
        $this->level_id = $value;
    }
    
    public function get_level_id() {
        return $this->level_id;
    }
    
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }
    
    public function get_type() {
        return $this->type;
    }
    
    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }
    
    public function get_type_id() {
        return $this->type_id;
    }
    
    public function set_likely($value) {
        $this->add_object_field('likely', $value);
        $this->likely = $value;
    }
    
    public function get_likely() {
        return $this->likely;
    }
    
    public function set_severity($value) {
        $this->add_object_field('severity', $value);
        $this->severity = $value;
    }
    
    public function get_severity() {
        return $this->severity;
    }

    /* additional code */

    public function get_type_title() {
        return '';
    }

    public function get_current_level_type() {
        return self::get_level_types()[$this->get_level_type()];
    }

    public static function get_level_types() {
        return [
            self::RISK_INSTITUTION_LEVEL => lang('Institution'),
            self::RISK_COLLEGE_LEVEL     => lang('College'),
            self::RISK_PROGRAM_LEVEL     => lang('Program'),
            self::RISK_UNIT_LEVEL        => lang('Unit')
        ];
    }

    public static function get_type_types() {

        $type_types = array();

        if(License::get_instance()->check_module('kpi')){
            $type_types[] = Orm_Rim_Risk_Management_Kpi::class;
        }

        $type_types[] = Orm_Rim_Risk_Management_Objective::class;

        if(License::get_instance()->check_module('strategic_planning')){
            $type_types[] = Orm_Rim_Risk_Management_Initiative::class;
        }

        if(License::get_instance()->check_module('strategic_planning')){
            $type_types[] = Orm_Rim_Risk_Management_Action_Plan::class;
        }

        if(License::get_instance()->check_module('strategic_planning')){
            $type_types[] = Orm_Rim_Risk_Management_Project::class;
        }

        if(License::get_instance()->check_module('strategic_planning')){
            $type_types[] = Orm_Rim_Risk_Management_Activity::class;
        }

        if(License::get_instance()->check_module('curriculum_mapping')) {
            $type_types[] = Orm_Rim_Risk_Management_Clo::class;
            $type_types[] = Orm_Rim_Risk_Management_Plo::class;
        }

        return $type_types;
    }

    public function is_valid() {
        return true;
    }
 /** draw risk management properties
 */
    public function draw_properties() {
        return "<div class='alert alert-default m-a-0'>".lang('Please Choose One Of Risk Management Types')."</div>";
    }

    /** ajax parent function that multi function can override it and check if it's ajax request
    */
    public function ajax() {
        /* Do Nothing */
    }

    public function get_current_level_type_id_title() {
        switch($this->get_level_type()) {
            case self::RISK_COLLEGE_LEVEL:
                return Orm_College::get_instance($this->get_level_id())->get_name();

            case self::RISK_PROGRAM_LEVEL:
                return Orm_Program::get_instance($this->get_level_id())->get_name();

            case self::RISK_UNIT_LEVEL:
                return Orm_Unit::get_instance($this->get_level_id())->get_name();

        }

        return '';
    }

    /** calculate risk level by multiply get like with severity and appear messsage depending on result
    */
    public function risk_level() {
       $result = $this->get_likely()*$this->get_severity();
       switch ($result){
           case $result > 19 : return "<span class='label label-tag label-danger'>".lang('High')."</span>"."<div>".lang('Very likely to occur')."</div>";
           break;
           case $result > 9 && $result < 20 : return "<span class='label label-tag label-warning'>".lang('Medium')."</span>"."<div>".lang('Some chance of occurrence')."</div>";
           break;
           default : return "<span class='label label-tag label-success'>".lang('Low')."</span>"."<div>".lang('Small chance of occurrence')."</div>";
       }
    }

    public function get_attachments_directory($type, $filters)
    {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';
        switch ($type) {
            case self::RISK_INSTITUTION_LEVEL:
                $path .= 'Institution/';
                break;
            case self::RISK_COLLEGE_LEVEL:
                $path .= Orm_College::get_instance($filters)->get_name_en() . '/';
                break;
            case self::RISK_PROGRAM_LEVEL:
                $path .= Orm_Program::get_instance($filters)->get_department_obj()->get_college_obj()->get_name_en() . '/';
                $path .= Orm_Program::get_instance($filters)->get_name_en() . '/';
                break;
            case self::RISK_UNIT_LEVEL:
                $path .= Orm_Unit::get_instance($filters)->get_name_en() . '/';
                break;
        }

        $path .= 'Risk Management';

        return $path;
    }

    /** draw pdf page to print it
    */
    public function generate_pdf() {

        $headerText = lang('Risk Management Type')." : ";
        $headerText .= $this->get_type(). "<br />";
        $headerText .= lang('Level')." : ";
        $headerText .= $this->risk_level();

        switch ($this->get_type()) {
            case Orm_Rim_Risk_Management::RISK_COLLEGE_LEVEL:
                $headerText .= " (".Orm_College::get_instance($this->get_type_id())->get_name() .")";
                break;
            case Orm_Rim_Risk_Management::RISK_PROGRAM_LEVEL:
                $headerText .= " (".Orm_Program::get_instance($this->get_type_id())->get_name().")";
                break;
        }

        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            'footer-left' => lang('Risk Management'),

        ));

        $pdf->addToc();

        $this->generate_pdf_page($pdf);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($this->get_type(), $this->get_type_id());

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name =  'Risk Management.pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /** get all object and report them
    */
    public function get_report_obj() {
        return Orm_Rim_Risk_Treatment::get_all(['risk_id'=>$this->get_id()]);
    }

    /** draw pdf file for every risk management type
    */
    public function draw($pdf=false) {
        return htmlfilter($this->get_type_title());
    }

    /** generate pdf file and include it in the above function
    */
    public function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf) {

        Orm::get_ci()->layout->set_layout('layout_pdf');

        Orm::get_ci()->layout->add_javascript('/assets/jadeer/js/jquery-2.2.0.min.js');

        $content = Orm::get_ci()->layout->content_as_html(false)->view('risk_management/report/info_report', array('risk_treatments' => $this->get_report_obj(), 'risk' => $this, 'risk_id' => $this->get_id()), true);
        $pdf->addPage($content);
        $content = Orm::get_ci()->layout->content_as_html(false)->view('risk_management/report/matrix_report', array('risk_treatments' => $this->get_report_obj(), 'risk' => $this, 'risk_id' => $this->get_id()), true);
        $pdf->addPage($content);
    }


}

