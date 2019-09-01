<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Kpi extends Orm {
    
    /**
    * @var $instances Orm_Kpi[]
    */
    protected static $instances = array();
    protected static $table_name = 'kpi';


    /**
    * class attributes
    */
    protected $id = 0;
    protected $criteria_id = 0;
    protected $code = '';
    protected $title = '';
    protected $kpi_type = 0;
    protected $chart_y_title = '';
    protected $college_id = '0';
    protected $created_by = 0;
    protected $category_id = 0;
    protected $ncaaa = self::KPI_NCAAA;
    protected $unit_id = 0;
    protected $is_semester = 0;
    protected $overall = 0;
    protected $is_core = 0;
    protected $institution_score = 0;
    protected $college_score = 0;

    const KPI_ACCREDITATION = 0;
    const KPI_STRATEGIC = 1;
    const KPI_REPORTS = 3;
    const KPI_SETTINGS = 4;
    const KPI_LEVEL_SETTINGS = 5;

    const KPI_QUALITATIVE = 1;
    const KPI_QUANTITATIVE = 2;

    const KPI_ALLOW_OVERALL_AVERAGE = 1;
    const KPI_NOT_ALLOW_OVERALL_AVERAGE = 0;

    const KPI_SEMESTER_BASED = 1;
    const KPI_YEARLY_BASED = 0;

    const KPI_REPORT_NORMAL = 1;
    const KPI_REPORT_DETAILS = 2;
    const KPI_REPORT_HISTORICAL = 3;

    const KPI_LIST_REPORT_NORMAL = 4;
    const KPI_LIST_REPORT_DETAILS = 5;
    const KPI_LIST_REPORT_HISTORICAL = 6;
    //Internal Benchmarking Reports
    const KPI_TYPE_ONE_REPORT = 7;
    const KPI_TYPE_TWO_REPORT = 8;
    const KPI_TYPE_THREE_REPORT = 9;
    const KPI_TYPE_FOUR_REPORT = 10;
    const KPI_TYPE_FIVE_REPORT = 11;
    //Strategic KPIs
    const KPI_LIST_REPORT_NORMAL_STRATEGIC = 12;
    const KPI_LIST_REPORT_DETAILS_STRATEGIC = 13;
    const KPI_LIST_REPORT_HISTORICAL_STRATEGIC = 14;


    const KPI_NCAAA = 1;
    const KPI_NOT_NCAAA = 2;

    /**
    * @return Kpi_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Kpi_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Kpi
    */
    public static function get_instance($id) {

        $id = intval($id);
        if(isset(self::$instances[$id])) {
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
    * @return Orm_Kpi[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Kpi
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Kpi();
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
        $db_params['criteria_id'] = $this->get_criteria_id();
        $db_params['code'] = $this->get_code();
        $db_params['title'] = $this->get_title();
        $db_params['kpi_type'] = $this->get_kpi_type();
        $db_params['chart_y_title'] = $this->get_chart_y_title();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['unit_id'] = $this->get_unit_id();
        $db_params['created_by'] = $this->get_created_by();
        $db_params['category_id'] = $this->get_category_id();
        $db_params['is_semester'] = $this->get_is_semester();
        $db_params['overall'] = $this->get_overall();
        $db_params['is_core'] = $this->get_is_core();
        $db_params['institution_score'] = $this->get_institution_score();
        $db_params['college_score'] = $this->get_college_score();
        
        return $db_params;
    }

    public function save($standard_id = 0) {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);

            if($standard_id && License::get_instance()->check_module('accreditation')) {
                Modules::load('accreditation');
                $this->add_to_accreditation($standard_id);
            }
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    /**
     * add KPI in Accreditation Module under the standard that related to
     * @param $standard_id
     */
    private function add_to_accreditation($standard_id) {

        $standard = Orm_Standard::get_instance($standard_id)->get_code();

        if(!$this->get_college_id()) {
            $node_institutional = Orm_Node::get_active_institutional_node();
            if($node_institutional->get_id()) {
                $class = Orm_Node::get_standard_class($standard, 'i');
                $parent_kpi_node_institutional = Orm_Node::get_one(array('system_number' => $node_institutional->get_system_number(), 'class_type' => $class));

                if($parent_kpi_node_institutional->get_id()) {
                    $info = $this->get_info(Orm_Kpi_Detail::TYPE_INSTITUTION);

                    $kpi_obj = new Node\ncai14\Kpi();
                    $kpi_obj->set_parent_id($parent_kpi_node_institutional->get_id());
                    $kpi_obj->set_year($parent_kpi_node_institutional->get_year());
                    $kpi_obj->set_system_number($parent_kpi_node_institutional->get_system_number());
                    $kpi_obj->set_standard($standard);
                    $kpi_obj->set_kpi_id($this->get_id());
                    $kpi_obj->set_name("KPI {$info['code']}");
                    $kpi_obj->set_kpi_info($this->get_title());
                    $kpi_obj->set_kpi_ref_num($info['code']);
                    $kpi_obj->set_actual($info['actual_benchmarks']);
                    $kpi_obj->set_target($info['target_benchmarks']);
                    $kpi_obj->set_internal($info['internal_benchmarks']);
                    $kpi_obj->set_external($info['external_benchmarks']);
                    $kpi_obj->set_new_target($info['new_benchmarks']);

                    $kpi_obj->save();
                    $kpi_obj->build_parent_tree();
                }
            }
        }

        $node_ssr = Orm_Node::get_active_ssr_node();
        if($node_ssr->get_id()) {

            $class = Orm_Node::get_standard_class($standard, 'p');
            $filters = array('system_number' => $node_ssr->get_system_number(), 'class_type' => $class);

            if($this->get_college_id()) {
                $parent_node_college = Orm_Node::get_one(array('system_number' => $node_ssr->get_system_number(), 'class_type' => 'Node\\ncassr14\\College', 'item_id' => $this->get_college_id()));
                if(!$parent_node_college->get_id()) {
                    return;
                }
                $filters['parent_lft'] = $parent_node_college->get_parent_lft();
                $filters['parent_rgt'] = $parent_node_college->get_parent_rgt();
            }

            $parent_kpi_node_programs = Orm_Node::get_all($filters);

            if($parent_kpi_node_programs) {
                foreach($parent_kpi_node_programs as $parent_kpi_node_program) {
                    $program_node = $parent_kpi_node_program->get_parent_program_node();
                    $info = $this->get_info(Orm_Kpi_Detail::TYPE_PROGRAM, array('college_id' => $program_node->get_parent_college_node()->get_item_id(), 'program_id' => $program_node->get_item_id()));

                    $kpi_obj = new Node\ncassr14\Kpi();
                    $kpi_obj->set_parent_id($parent_kpi_node_program->get_id());
                    $kpi_obj->set_year($parent_kpi_node_program->get_year());
                    $kpi_obj->set_system_number($parent_kpi_node_program->get_system_number());
                    $kpi_obj->set_standard($standard);
                    $kpi_obj->set_kpi_id($this->get_id());
                    $kpi_obj->set_name("KPI {$info['code']}");
                    $kpi_obj->set_kpi_info($this->get_title());
                    $kpi_obj->set_kpi_ref_num($info['code']);
                    $kpi_obj->set_actual($info['actual_benchmarks']);
                    $kpi_obj->set_target($info['target_benchmarks']);
                    $kpi_obj->set_internal($info['internal_benchmarks']);
                    $kpi_obj->set_external($info['external_benchmarks']);
                    $kpi_obj->set_new_target($info['new_benchmarks']);

                    $kpi_obj->save();
                }
                $kpi_obj->build_parent_tree();
            }
        }
    }
    
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }
    
    public function set_id($value) {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_criteria_id($value) {
        $this->add_object_field('criteria_id',$value);
        $this->criteria_id = $value;
    }
    
    public function get_criteria_id() {
        return $this->criteria_id;
    }
    
    public function set_code($value) {
        $this->add_object_field('code',$value);
        $this->code = $value;
    }
    
    public function get_code() {
        return $this->code;
    }
    
    public function set_title($value) {
        $this->add_object_field('title',$value);
        $this->title = $value;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function set_kpi_type($value) {
        $this->add_object_field('kpi_type',$value);
        $this->kpi_type = $value;
    }
    
    public function get_kpi_type() {
        return $this->kpi_type;
    }
    
    public function set_chart_y_title($value) {
        $this->add_object_field('chart_y_title',$value);
        $this->chart_y_title = $value;
    }
    
    public function get_chart_y_title() {
        return $this->chart_y_title;
    }
    
    public function set_college_id($value) {
        $this->add_object_field('college_id',$value);
        $this->college_id = $value;
    }
    
    public function get_college_id() {
        return $this->college_id;
    }
    public function set_unit_id($value) {
        $this->add_object_field('unit_id',$value);
        $this->unit_id = $value;
    }

    public function get_unit_id() {
        return $this->unit_id;
    }
    
    public function set_created_by($value) {
        $this->add_object_field('created_by',$value);
        $this->created_by = $value;
    }
    
    public function get_created_by() {
        return $this->created_by;
    }
    
    public function set_category_id($value) {
        $this->add_object_field('category_id',$value);
        $this->category_id = $value;
    }
    
    public function get_category_id() {
        return $this->category_id;
    }
    
    public function set_is_semester($value) {
        $this->add_object_field('is_semester',$value);
        $this->is_semester = $value;
    }
    
    public function get_is_semester() {
        return $this->is_semester;
    }

    public function set_ncaaa($value) {
        $this->add_object_field('ncaaa',$value);
        $this->ncaaa = $value;
    }

    public function get_ncaaa() {
        return $this->ncaaa;
    }
    
    public function set_overall($value) {
        $this->add_object_field('overall',$value);
        $this->overall = $value;
    }
    
    public function get_overall() {
        return $this->overall;
    }
    
    public function set_is_core($value) {
        $this->add_object_field('is_core',$value);
        $this->is_core = $value;
    }
    
    public function get_is_core() {
        return $this->is_core;
    }
    
    public function set_institution_score($value) {
        $this->add_object_field('institution_score',$value);
        $this->institution_score = $value;
    }
    
    public function get_institution_score() {
        return $this->institution_score;
    }
    
    public function set_college_score($value) {
        $this->add_object_field('college_score',$value);
        $this->college_score = $value;
    }
    
    public function get_college_score() {
        return $this->college_score;
    }

    public function get_view_code() {
        return $this->get_code();
    }

    /**
     * get number of legend that mapped with KPI
     * @return int
     */
    public function get_kpi_legends_count() {
        return Orm_Kpi_Legend::get_count(array('kpi_id' => $this->get_id()));
    }

    /**
     * get Count Of levels that the KPI has
     * @return int
     */
    public function get_kpi_levels_count() {
        return Orm_Kpi_Level::get_count(array('kpi_id' => $this->get_id()));
    }

    /**
     * get the name of categories
     * @return array
     */
    public static function get_categories() {
        return array(
            self::KPI_ACCREDITATION => lang('Accreditation KPI'),
            self::KPI_STRATEGIC => lang('Strategic KPI')
        );
    }

    /**
     * get the name of category depends on numbers c = 0 => accreditation c = 1 strategic KPI
     * @param $category
     * @return string
     */
    public static function get_category_by_id($category) {
        switch ($category) {
            case self::KPI_ACCREDITATION:
                $title = lang('Accreditation KPI');
                break;
            case self::KPI_STRATEGIC:
                $title = lang('Strategic KPI');
                break;
            default:
                $title = lang('Accreditation KPI');
                break;
        }
        return $title;
    }

    /**
     * draw KPI charts depends on a specifics parameters
     * @param int $type
     * @param array $filters
     * @return string
     */
    public function draw_chart($type = 0, $filters = array()) {

        $levels = Orm_Kpi_Level::get_all(array('kpi_id' => $this->get_id()));
        $multiple_levels = Orm_Kpi_Level::get_count(array('kpi_id' => $this->get_id()));
        $html = '';
        if (!Orm_Kpi_Legend::get_count(array('kpi_id' => $this->get_id()))) {
            $text = lang('There is no').' '.lang('Graph to be Displayed');
            $html .= <<<HTML
<div class="alert alert-default"><div class="m-b-1">{$text}</div></div>
HTML;
;
        } else {
            foreach ($levels as $level) {
                $html .= $level->draw_chart($type, $filters, $this->get_chart_y_title(), !$multiple_levels, $this);
            }
        }
        return $html;
    }

    /**
     * get all values for kpi depends on the following parameters
     * @param $type
     * @param array $filters
     * @return array
     */
    public function get_values($type, $filters = array()) {
        $levels = Orm_Kpi_Level::get_all(array('kpi_id' => $this->get_id()));

        if ($this->get_is_semester() && empty($filters['semester_id'])) {
            $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        } elseif (empty($filters['academic_year'])) {
            $filters['academic_year'] = Orm_Semester::get_active_semester()->get_year();
        }

        $html = array();
        foreach ($levels as $level) {
            $html[$level->get_id()] = $level->get_values($type, $filters, $this);
        }
        return $html;
    }

    /**
     * drae the view of kpi data depends on the following parameters
     * @param $type
     * @param array $filters
     * @return string
     */
    public function draw_html($type, $filters = array()) {
        if ($this->get_is_semester()) {
            $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        } else {
            $filters['academic_year'] = Orm_Semester::get_active_semester()->get_year();
        }
        $levels = Orm_Kpi_Level::get_all(array('kpi_id' => $this->get_id()));
        $html = '';
        $levels_count = count($levels);
        foreach ($levels as $level) {
            $html .= '<div class="table-primary table-responsive">';
            $html .= '<div class="table-header">';
            $html .= htmlfilter($levels_count > 1 ? $level->get_level() : $this->get_title());
            $html .= '</div>';
            $html .= $level->draw_html($type, $filters);
            $html .= '</div>';
        }
        return $html;
    }

    /**
     * draw the chart that will appear on KPI details depends on the following parameters
     * @param $type
     * @param array $filters
     * @return string
     */
    public function draw_details_chart($type, $filters = array()) {
        $levels = Orm_Kpi_Level::get_all(array('kpi_id' => $this->get_id()));
        $multiple_levels = Orm_Kpi_Level::get_count(array('kpi_id' => $this->get_id()));
        $html = '';
        foreach ($levels as $level) {
            $html .= $level->draw_chart($type, $filters, $this->get_chart_y_title(), !$multiple_levels ? false : true, Orm_Kpi::get_instance(0));
        }
        return $html;
    }

    /**
     * draw the chart that will appear on KPI Trend depends on the following parameters
     * @param $type
     * @param array $filters
     * @return string
     */
    public function draw_trend_analysis($type, $filters = array()) {
        $levels = Orm_Kpi_Level::get_all(array('kpi_id' => $this->get_id()));
        $multiple_levels = Orm_Kpi_Level::get_count(array('kpi_id' => $this->get_id()));
        $html = '';
        if (!Orm_Kpi_Legend::get_count(array('kpi_id' => $this->get_id()))) {
            $text = lang('There is no').' '.lang('Graph to be Displayed');
            $html .= <<<HTML
<div class="alert alert-default"><div class="m-b-1">{$text}</div></div>
HTML;
            ;
        } else {
            foreach ($levels as $level) {
                $html .= $level->draw_trend_chart($type, $filters, $this->get_chart_y_title(), !$multiple_levels, $this);
            }
        }

        return $html;
    }

    /**
     * prepare all data of kpi to set in pdf file
     * @param $type => type of KPI details (college, program)
     * @param array $params => all parameters that will influence on the data
     * @param $chart =>type of chart that will draw on the pdf
     */
    public function generate_pdf($type, $params = array(), $chart) {

        $filters = isset($params['fltr']) ? $params['fltr'] : $params;

        $headerText = 'Academic Year: ' . Orm_Semester::get_active_semester()->get_year() . "<br>";
        if ($type == Orm_Kpi_Detail::TYPE_PROGRAM) {
            $college = Orm_College::get_instance($filters['college_id']);
            $program = Orm_Program::get_instance($filters['program_id']);
            $headerText .= htmlfilter($program->get_name_en()) . ', ' . htmlfilter($college->get_name_en())."<br>";
        } elseif ($type == Orm_Kpi_Detail::TYPE_COLLEGE) {
            $college = Orm_College::get_instance($filters['college_id']);
            $headerText .= htmlfilter($college->get_name_en())."<br>";
        }
        $headerText .= Orm_Institution::get_instance()->get_name();

        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);

//        $pdf = new \mikehaertl\wkhtmlto\Pdf(Orm::get_ci()->config->item('wk_pdf_options'));
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $options = array(
            //header
            'margin-top' => 27,
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            //footer
            'footer-left' => lang('KPI')
        );

        switch ($chart) {
            case self::KPI_LIST_REPORT_DETAILS:
                $html = Orm::get_ci()->load->view('reports/details',$params,true);
                break;
            case self::KPI_LIST_REPORT_HISTORICAL:
                $html = Orm::get_ci()->load->view('reports/trend',$params,true);
                break;
            case self::KPI_LIST_REPORT_NORMAL:
                $html = Orm::get_ci()->load->view('reports/benchmarks',$params,true);
                break;
            default :
                $html = $this->get_view_header($chart, $type, $filters);
                break;
        }

        $pdf->setOptions($options);
        $this->generate_pdf_page($pdf, $html);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($type, $filters);

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name = $this->get_name($chart) . '.pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /**
     * prepare all data of kpi to set in image
     * @param $type => type of KPI details (college, program)
     * @param $filters => specific parameter to select data
     * @param $chart =>type of chart that will show
     * @param bool $only_save  => to save data or show data
     * @return string
     */
    function generate_image($type, $filters, $chart, $only_save = false) {

        $img = new \mikehaertl\wkhtmlto\Image(Orm::get_ci()->config->item('wk_image_options'));

        $html = $this->get_view_header($chart, $type, $filters, true);

        $this->generate_image_page($img, $html);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($type, $filters);

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $name = $this->get_name($chart) . '.png';
        $file_name = $files_full_dir . '/' . $name;

        $img->saveAs($file_name);
        if (!$only_save) {
            $img->send($name);
        }
        if ($img->getError()) {
            echo $img->getError();
            die;
        }
        return $files_dir . '/' . $name;
    }

    /**
     * get the data that will show in the header of page
     * @param int $chart_type =>chart type
     * @param int $type => type of KPI that deitals related to (institutional , college, program )
     * @param array $filters =>specific parameter to select data
     * @param bool $is_image if not image what will shoe in page header different
     * @return string
     */
    public function get_view_header($chart_type = self::KPI_REPORT_NORMAL, $type = 0, $filters = array(), $is_image = false) {
        $html = '<div class="panel panel-primary">';
        $html .= '<div class="panel-heading">';
        $html .= '<div class="row">';
        $html .= '<span class="panel-title col-md-12 col-sm-10 col-xs-8" ><h4 class="m-a-0"><span class="label label-primary">' . htmlfilter($this->get_code()). '</span> - ' . htmlfilter($this->get_title()) . '</h4></span>';
        $html .= '</div>';
        $html .= '</div>';
        if ($is_image) {
            $html .= '<div class="panel-heading">';
            $html .= '<div class="row">';
            $html .= 'Academic Year: ' . Orm_Semester::get_active_semester()->get_year();
            $html .= '</div>';
            $html .= '</div>';
            if ($type == Orm_Kpi_Detail::TYPE_PROGRAM && isset($filters['program_id'])) {
                $html .= '<div class="panel-heading">';
                $html .= '<div class="row">';
                $html .= htmlfilter(Orm_Program::get_instance($filters['program_id'])->get_name());
                $html .= '</div>';
                $html .= '</div>';
            }

            if (isset($filters['college_id']) && $filters['college_id']) {
                $html .= '<div class="panel-heading">';
                $html .= '<div class="row">';
                $html .= htmlfilter(Orm_College::get_instance($filters['college_id'])->get_name());
                $html .= '</div>';
                $html .= '</div>';
            }
        }
        $html .= '<div class="panel-body">';
        switch ($chart_type) {
            case self::KPI_REPORT_NORMAL:
                $html .= $this->draw_chart($type, $filters);
                break;
            case self::KPI_REPORT_DETAILS:
                $html .= $this->draw_details_chart($type, $filters);
                break;
            case self::KPI_REPORT_HISTORICAL:
                $html .= $this->draw_trend_analysis($type, $filters);
                break;
            default:
                $html .= $this->draw_chart($type, $filters);
                break;
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    /**
     * get name of file that will called after downlaoad
     * @param $type
     * @return string
     */
    public function get_name($type) {
        switch ($type) {
            case Orm_Kpi::KPI_REPORT_DETAILS:
                $name = 'Details-KPI.'.$this->get_code();
                break;
            case Orm_Kpi::KPI_REPORT_HISTORICAL:
                $name = 'Trend-KPI.'.$this->get_code();
                break;
            case Orm_Kpi::KPI_REPORT_NORMAL:
                $name = 'Benchmarks-KPI.'.$this->get_code();
                break;
            case Orm_Kpi::KPI_LIST_REPORT_DETAILS:
                $name = 'Details-KPIs';
                break;
            case Orm_Kpi::KPI_LIST_REPORT_HISTORICAL:
                $name = 'Trend-KPIs';
                break;
            case Orm_Kpi::KPI_LIST_REPORT_NORMAL:
                $name = 'Benchmarks-KPIs';
                break;
            default:
                $name = 'KPI';
                break;
        }

        return $name;
    }

    /**
     * get the path / url that the file will set on after downloading
     * @param $type
     * @param $filters
     * @return string
     */
    public function get_attachments_directory($type, $filters) {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';
        switch ($type) {
            case Orm_Kpi_Detail::TYPE_INSTITUTION:
                $path .= 'Institution/';
                break;
            case Orm_Kpi_Detail::TYPE_COLLEGE:
                $path .= Orm_College::get_instance($filters['college_id'])->get_name('english') . '/';
                break;
            case Orm_Kpi_Detail::TYPE_PROGRAM:
                $path .= Orm_College::get_instance($filters['college_id'])->get_name('english') . '/';
                $path .= Orm_Program::get_instance($filters['program_id'])->get_name('english') . '/';
                break;
        }

        $path .= 'KPI';

        return $path;
    }

    /**
     * after prepare all data it will set in pdf and calling the library WKHTMTOPDF
     * @param \mikehaertl\wkhtmlto\Pdf $pdf
     * @param $content
     */
    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf, $content) {
        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');

        Orm::get_ci()->layout->add_javascript('https://www.google.com/jsapi', false);
        Orm::get_ci()->layout->add_javascript('/assets/jadeer/js/jquery-2.2.0.min.js');

        $html = Orm::get_ci()->layout->view($content, array(), true);
        $pdf->addPage($html);
    }

    /**
     * after prepare all data it will set in pdf and calling the library WKHTMTOIMAGE
     * @param \mikehaertl\wkhtmlto\Image $img
     * @param $content
     */
    function generate_image_page(\mikehaertl\wkhtmlto\Image $img, $content) {

        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');

        Orm::get_ci()->layout->stylesheet = array();

        $lang = (UI_LANG == 'arabic') ? '.rtl' : '';

        Orm::get_ci()->layout->add_stylesheet("/assets/pixel/css/bootstrap{$lang}.min.css");
        Orm::get_ci()->layout->add_stylesheet("/assets/pixel/css/themes/candy-green{$lang}.min.css");

        Orm::get_ci()->layout->add_javascript('https://www.google.com/jsapi', false);
        Orm::get_ci()->layout->add_javascript('/assets/jadeer/js/jquery-2.2.0.min.js');

        $content = "<script>google.load('visualization', '1', {packages: ['corechart', 'bar', 'table']});</script>" . $content;

        $html = Orm::get_ci()->layout->view($content, array(), true);
        $img->setPage($html);
    }

    /**
     * show all information about the Criteria that KPI mapped to
     * @return Orm_Criteria
     */
    public function get_criteria_obj(){
        return Orm_Criteria::get_instance($this->get_criteria_id());
    }

    /**
     * show information of KPI Benchmarks and the  value that collected for
     * @param $type
     * @param array $filters
     * @return array
     */
    public function get_info($type, $filters = array()){

        $info = array();
        $info['actual_benchmarks'] = '';
        $info['target_benchmarks'] = '';
        $info['new_benchmarks'] = '';
        $info['internal_benchmarks'] = '';
        $info['external_benchmarks'] = '';

        $benchmarks = $this->get_values($type, $filters);
        $multiple = count($benchmarks) > 1 ? true : false;
        foreach ($benchmarks as $key => $level) {
            if ($multiple) {
                $level_title = Orm_Kpi_Level::get_instance($key)->get_level();
                $info['actual_benchmarks'] .= $level_title . ': ' . $level['actual_benchmark'] . ",";
                $info['target_benchmarks'] .= $level_title . ': ' . $level['target_benchmark'] . ",";
                $info['new_benchmarks'] .= $level_title . ': ' . $level['new_benchmark'] . ",";
                $info['internal_benchmarks'] .= $level_title . ': ' . 'Institution(' . $level['internal_institution_benchmark'] . ') College(' . $level['internal_college_benchmark'] . '),';
                $info['external_benchmarks'] .= $level_title . ': ' . $level['external'];
            } else {
                $info['actual_benchmarks'] .= $level['actual_benchmark'];
                $info['target_benchmarks'] .= $level['target_benchmark'];
                $info['new_benchmarks'] .= $level['new_benchmark'];
                $info['internal_benchmarks'] .= 'Institution(' . $level['internal_institution_benchmark'] . ') College(' . $level['internal_college_benchmark'] . ')';
                $info['external_benchmarks'] .= $level['external'];
            }
        }

        $info['code'] = $this->get_code();

        return $info;
    }

    /**
     * get all information related to Unit depends on UNIT ID that mapped to
     * @return Orm_Unit
     */
    public function get_unit_obj()
    {
        return Orm_Unit::get_instance($this->get_unit_id());
    }
    
}

