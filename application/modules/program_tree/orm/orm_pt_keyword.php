<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pt_Keyword extends Orm {
    
    protected static $table_name = 'pt_keyword';
    
    /**
    * @var $instances Orm_Pt_Keyword[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title_ar = '';
    protected $title_en = '';
    
    /**
    * @return Pt_Keyword_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pt_Keyword_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pt_Keyword
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
    * @return Orm_Pt_Keyword[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pt_Keyword
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pt_Keyword();
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
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['title_en'] = $this->get_title_en();
        
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
    
    public function set_title_ar($value) {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }
    
    public function get_title_ar() {
        return $this->title_ar;
    }
    
    public function set_title_en($value) {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }
    
    public function get_title_en() {
        return $this->title_en;
    }

    public function set_title($value) {
        if (UI_LANG == 'arabic') {
            $this->set_title_ar($value);
        }else{
            $this->set_title_en($value);
        }
    }

    /**
     * this function get pdf cover by its program
     * @param Orm_Program $program the program of the saveImage to be call function
     * @return string the call function
     */
    public static function get_pdf_cover(Orm_Program $program) {


        $background = '';
        if (file_exists(rtrim(FCPATH,'/').Orm::get_ci()->config->item('qpar-report-cover'))) {
            $background = 'background: url('.base_url(Orm::get_ci()->config->item('qpar-report-cover')).') no-repeat fixed center top transparent; background-size: cover; ';
        }

        $cover = '<html>';
        $cover .= '<head>';
        $cover .= '<meta charset="utf-8">';
        $cover .= '</head>';
        $cover .= '<body style="'.$background.'padding-top:600px;">';
        $cover .= '<div style="padding:20px 0; display:block; position: relative; overflow: auto; text-align: center; font-family: \'Open Sans\', sans-serif; font-weight:bold; font-size: 18pt; color: #02577e; background-color: rgba(255,255,255,0.5);">';
        $cover .= $program->get_name() .'<br>';
        $cover .= $program->get_department_obj()->get_college_obj()->get_name() .'<br>';
        $cover .= '</div>';
        $cover .= '</body>';
        $cover .= '</html>';

        return $cover;
    }
    /**
     * this function generate_pdf by its program and view params
     * @param Orm_Program $program the program of the generate pdf to be call function
     * @param array $view_params the view params of the generate pdf to be call function
     * @return string the call function
     */
    public static function generate_pdf(Orm_Program $program, $view_params)
    {
        $headerText = Orm_Semester::get_active_semester()->get_name() . ' Academic Year: ' . Orm_Semester::get_active_semester()->get_year() . "<br>";

        if ($program->get_id())
        {
            $headerText .= $program->get_name('english') .'<br>';
        }
        $headerText .= $program->get_department_obj()->get_college_obj()->get_name('english') . ', ' .  Orm_Institution::get_instance()->get_name();

        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line'
        ));

        if (self::get_pdf_cover($program)) {
            $pdf->addCover(self::get_pdf_cover($program));
        }

        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->view('program_tree/view', $view_params, true);

        $pdf->addPage($content);

        $files_dir = '/files/Documents/' . self::get_attachments_directory($program);

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $name = 'Program Tree - ' . $program->get_name_en() . '.pdf';
        $file_name = rtrim($files_full_dir,'/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);

        if($pdf->getError() && ENVIRONMENT == 'development') {
            show_error($pdf->getError());
        }

        $pdf->send($name);
    }
    /**
     * this function get_attachments_directory by its program and view params
     * @param Orm_Program $program the program of the get attachments directory to be call function
     * @return int|string the call function
     */
    public static function get_attachments_directory(Orm_Program $program)
    {
        $path = Orm_Semester::get_active_semester()->get_year();
        $path .= '/'.$program->get_department_obj()->get_college_obj()->get_name('english');
        $path .= '/'.$program->get_name('english');
        $path .= '/Program Tree';
        return $path;
    }
}

