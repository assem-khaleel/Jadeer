<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Report extends Orm {
    
    /**
    * @var $instances Orm_Pc_Report[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_report';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title_ar = '';
    protected $title_en = '';
    protected $course_id = 0;

    const COMPONENT_EVALUATION = 1;
    const COMPONENT_SYLLABUS_CATALOGUE_INFO = 2;
    const COMPONENT_SYLLABUS_INSTRUCTOR_INFO = 3;
    const COMPONENT_SYLLABUS_REQUIRED_MATERIALS = 4;
    const COMPONENT_SYLLABUS_COURSE_DESCRIPTION = 5;
    const COMPONENT_SYLLABUS_COURSE_CALENDAR = 6;
    const COMPONENT_SYLLABUS_COURSE_POLICIES = 7;
    const COMPONENT_SYLLABUS_SUPPORT_SERVICE = 8;
    const COMPONENT_TEACHING_MATERIAL = 9;
    const COMPONENT_SUPPORT_MATERIAL = 10;
    const COMPONENT_ASSIGNMENTS = 11;
    const COMPONENT_STUDENT_WORK = 12;

    public static $COMPONENTS = array(
        self::COMPONENT_EVALUATION => 'Evaluations',
        self::COMPONENT_SYLLABUS_CATALOGUE_INFO => 'Syllabus Catalogue Info',
        self::COMPONENT_SYLLABUS_INSTRUCTOR_INFO => 'Syllabus Instructor Info',
        self::COMPONENT_SYLLABUS_REQUIRED_MATERIALS => 'Syllabus Required Materials',
        self::COMPONENT_SYLLABUS_COURSE_DESCRIPTION => 'Syllabus Course Description',
        self::COMPONENT_SYLLABUS_COURSE_CALENDAR => 'Syllabus Course Calendar',
        self::COMPONENT_SYLLABUS_COURSE_POLICIES => 'Syllabus Course Policies',
        self::COMPONENT_SYLLABUS_SUPPORT_SERVICE => 'Syllabus Support Service',
        self::COMPONENT_TEACHING_MATERIAL => 'Teaching Material',
        self::COMPONENT_SUPPORT_MATERIAL => 'Support Material',
        self::COMPONENT_ASSIGNMENTS => 'Assignments',
        self::COMPONENT_STUDENT_WORK => 'Student Work'
    );

    /**
    * @return Pc_Report_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Report_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Report
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
    * @return Orm_Pc_Report[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Report
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Report();
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
        $db_params['course_id'] = $this->get_course_id();
        
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

    public function get_title($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_title_ar();
        }
        return $this->get_title_en();
    }
    
    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }
    
    public function get_course_id() {
        return $this->course_id;
    }

    public function get_course_obj() {
        return Orm_Course::get_instance($this->get_course_id());
    }

    /**
     * @param int $core
     * @return Orm_Pc_Report_Components[]
     */
    public function get_components($core = 1) {
        return Orm_Pc_Report_Components::get_all(['report_id' => $this->get_id(), 'is_core' => $core], 0, 0, ['component_id']);
    }

    public function get_attachments_directory()
    {
        $path = Orm_Semester::get_active_semester()->get_year();

        $path .= '/'. $this->get_course_obj()->get_department_obj()->get_college_obj()->get_name('english');
        $path .= '/'. $this->get_course_obj()->get_name('english');

        $path .= '/Course Portfolio';
        return $path;
    }

    public function get_component_ids($is_core = 1) {
        $components = Orm_Pc_Report_Components::get_model()->get_all(['report_id' => $this->get_id(), 'is_core' => $is_core], 0, 0, [], Orm::FETCH_ARRAY);
        return array_column($components, 'component_id');
    }

    public function generate_pdf()
    {
        $headerText = Orm_Semester::get_active_semester()->get_name() . ' Academic Year: ' . Orm_Semester::get_active_semester()->get_year() . "<br>";

        $headerText .= $this->get_course_obj()->get_code_en() .' '. $this->get_course_obj()->get_name('english') . '<br>';

        $headerText .=  Orm_Institution::get_instance()->get_name();

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
        ));

        $this->generate_pdf_page($pdf);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory();

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $name = "Course Portfolio-{$this->get_course_obj()->get_name('english')}.pdf";

        $file_name = rtrim($files_full_dir,'/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf)
    {
        $this->get_ci()->layout->set_layout('layout_pdf');
        
        foreach ($this->get_components(1) as $component) {
            switch ($component->get_component_id()) {

                case self::COMPONENT_EVALUATION:

                    $level='syllabus';
                    $params['active']='syllabus';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    if ($survey_id = Orm_Pc_Settings::get_one(array('entity_key' => Orm_Pc_Settings::ENTITY_COURSE_SURVEY))->get_entity_value()) {
                        if (License::get_instance()->check_module('survey')) {
                            Modules::load('survey');
                            $filters['class_type'] = Orm_User_Student::class;
                            $filters['course_id'] = $this->get_course_id();
                            $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
                            $survey = Orm_Survey::get_instance(Orm_Pc_Settings::get_one(array('entity_key' => Orm_Pc_Settings::ENTITY_COURSE_SURVEY))->get_entity_value());
                            $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('survey/report/summary_details', array('survey' => $survey, 'filters' => $filters), true);
                            $pdf->addPage($html);
                        }
                    }
                    break;
                case self::COMPONENT_SYLLABUS_CATALOGUE_INFO:
                    $level='syllabus';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='syllabus';
                    $params['course'] = $this->get_course_obj();
                    $params['sections'] = $this->get_course_obj()->get_sections();
                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/syllabus/catalog_list', $params, true);
                    $pdf->addPage($html);
                    break;
                case self::COMPONENT_SYLLABUS_INSTRUCTOR_INFO:

                    $faculty = Orm_Course_Section_Teacher::get_all(['course_id'=>$this->course_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
                    $faculty_members=[];

                    foreach ($faculty as $vsl)
                    {
                        $faculty_members[$vsl->get_user_id()] = $vsl;
                    }
                    $params['faculty'] = $faculty_members;
                    $params['course_id'] = $this->get_course_id();
                    $params['can_manage'] = false;

                    $level='syllabus';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='syllabus';
                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/syllabus/instructor_list', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_SYLLABUS_REQUIRED_MATERIALS:

                    $params['materialTypes'] = Orm_Pc_Material::get_types();
                    $params['course_id'] = $this->get_course_id();
                    $params['can_manage'] = false;

                    $level='syllabus';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='syllabus';
                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/syllabus/required_material_list', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_SYLLABUS_COURSE_DESCRIPTION:

                    Modules::load('curriculum_mapping');
                    $clo = Orm_Cm_Course_Learning_Outcome::get_all(['course_id'=>$this->get_course_id()]);
                    $assessment_method = Orm_Cm_Course_Assessment_Method::get_all(['course_id'=>$this->get_course_id()]);

                    $level='syllabus';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='syllabus';
                    $params['assessment_method'] = $assessment_method;
                    $params['clo'] = $clo;
                    $params['course_id'] = $this->get_course_id();
                    $params['can_manage'] = false;

                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/syllabus/course_desc_list', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_SYLLABUS_COURSE_CALENDAR:

                    $level='syllabus';
                    $params['active']='syllabus';
                    $params['course_id'] = $this->get_course_id();
                    $params['can_manage'] = false;

                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/syllabus/course_calender_list', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_SYLLABUS_COURSE_POLICIES:

                    $level='syllabus';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='syllabus';
                    $params['course_id'] = $this->get_course_id();
                    $params['policy'] = Orm_Pc_Course_Policies::get_one(['course_id'=>$this->get_course_id()]);
                    $params['can_manage'] = false;

                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/syllabus/course_policies_list', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_SYLLABUS_SUPPORT_SERVICE:

                    $level='syllabus';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='syllabus';
                    $params['course_id'] = $this->get_course_id();
                    $params['can_manage'] = false;

                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/syllabus/available_support_list', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_TEACHING_MATERIAL:

                    $level='teaching_material';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='teaching_material';
                    $params['course_id'] = $this->get_course_id();
                    $manuals = Orm_Pc_Teaching_Material::get_all(['course_id'=>$this->course_id, 'type'=>1]);
                    $params['manuals'] = $manuals;
                    $params['lectureNote'] = Orm_Pc_Teaching_Material::get_one(['course_id'=>$this->course_id, 'type'=>2]);
                    $params['additions'] = Orm_Pc_Teaching_Material::get_one(['course_id'=>$this->course_id, 'type'=>3]);
                    $params['can_manage'] = false;
                    
                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/teaching_material/teaching', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_SUPPORT_MATERIAL:

                    $level='support_material';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='support_material';
                    $params['course_id'] = $this->get_course_id();
                    $params['constructions'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'construction_technique_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
                    $params['equipments'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'equipment_documentation_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
                    $params['computerDocumentations'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'computer_documentation_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
                    $params['troubleshootingTips'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'troubleshooting_tip_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
                    $params['debuggingTips'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'debugging_tip_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
                    $params['addition'] = Orm_Pc_Support_Material::get_one(['course_id'=>$this->course_id, 'type'=>2, 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
                    $params['can_manage'] = false;
                    
                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/support_material/support', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_ASSIGNMENTS:

                    $level='assignment_info';
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
                    $params['active']='assignment_info';
                    $params['level'] = 'assignment_info';
                    $params['course_id'] = $this->get_course_id();
                    $params['assTypes'] = Orm_Pc_Assignment::get_types();
                    $params['assignments'] = Orm_Pc_Assignment::get_all(['course_id'=>$this->course_id, 'semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
                    $params['can_manage'] = false;
                    
                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/assignment/assignment_list', $params, true);
                    $pdf->addPage($html);

                    break;
                case self::COMPONENT_STUDENT_WORK:
                    
                    $level='student_work';
                    $params['active']='student_work';
                    $params['level'] = 'student_work';
                    $params['course_id'] = $this->get_course_id();
                    $params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);

                    $params['projects'] = Orm_Pc_Student_Work::get_all(['course_id'=>$this->get_course_id(), 'type' => 1]);
                    $params['guideline'] = Orm_Pc_Student_Work::get_one(['course_id'=>$this->get_course_id(), 'type' => 2]);
                    $params['can_manage'] = false;
                    
                    $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/student_work/student_work', $params, true);
                    $pdf->addPage($html);

                    break;
            }
        }

        //$params['custom_menus'] = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$level]);
        //$params['active'] = $active;
        
        foreach ($this->get_components(0) as $component) {
            $params['course_id'] = $this->course_id;
            $params['cat'] = $component->get_component_id();
            $params['fields']= Orm_Pc_Syllabus_Fields::get_all(['course_id' => $this->get_course_id(), 'category_id' => $component->get_component_id(), 'deleted' => '0', 'display' => '1']);
            $params['fieldsvalue'] = Orm_Pc_Syllabus_Fields_Value::get_all(['course_id' => $this->get_course_id(), 'category_id' => $component->get_component_id(), 'deleted' => '0']);
            $params['can_manage'] = false;

            $html = $this->get_ci()->layout->set_layout('layout_pdf')->view('portfolio_course/forms/custom_category_list', $params, true);
            $pdf->addPage($html);
        }
    }
}