<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey extends Orm
{

    /**
     * @var $instances Orm_Survey[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey';


    /**
     * class attributes
     */
    protected $id = 0;
    protected $title_english = '';
    protected $title_arabic = '';
    protected $created_by = 0;
    protected $date_added = '0000-00-00 00:00:00';
    protected $date_modified = '0000-00-00 00:00:00';
    protected $type = 0;
    protected $is_deleted = 0;

    const TYPE_STUDENTS = 1;
    const TYPE_FACULTY = 2;
    const TYPE_STAFF = 3;
    const TYPE_ALUMNI = 4;
    const TYPE_EMPLOYER = 5;
    const TYPE_BOA_LEADER = 6;
    const TYPE_BOA_MEMBER = 7;
    const TYPE_COURSES = 8;
    const TYPE_TRAINING_BEFORE= 9;
    const TYPE_TRAINING_AFTER= 10;
    const TYPE_Advisory= 11;

    const SUMMARY_REPORT_ONE = 1;
    const SUMMARY_REPORT_TWO = 2;

    public static $survey_types = array(
        self::TYPE_COURSES => 'Courses',
        self::TYPE_STUDENTS => 'Students',
        self::TYPE_FACULTY => 'Faculty',
        self::TYPE_STAFF => 'Staff',
        self::TYPE_ALUMNI => 'Alumni',
        self::TYPE_EMPLOYER => 'Employer'
    );

    //Private Types not to be presented in the views only for the ACL
    public static $survey_all_types = array(
        self::TYPE_COURSES => 'Courses',
        self::TYPE_STUDENTS => 'Students',
        self::TYPE_FACULTY => 'Faculty',
        self::TYPE_STAFF => 'Staff',
        self::TYPE_ALUMNI => 'Alumni',
        self::TYPE_EMPLOYER => 'Employer',
        self::TYPE_BOA_LEADER => 'BOA',
        self::TYPE_BOA_MEMBER => 'BOA',
        self::TYPE_TRAINING_BEFORE   => 'Training',
        self::TYPE_TRAINING_AFTER   => 'Training',
        self::TYPE_Advisory   => 'Advisory'
    );

    public static function get_survey_type($type) {
        return strtolower( isset(self::$survey_all_types[$type]) ? self::$survey_all_types[$type] : null );
    }

    /**
     * @return Survey_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey
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
     * @return Orm_Survey[] | int
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
     * @return Orm_Survey
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey();
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
        $db_params['title_english'] = $this->get_title_english();
        $db_params['title_arabic'] = $this->get_title_arabic();
        $db_params['created_by'] = $this->get_created_by();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['date_modified'] = $this->get_date_modified();
        $db_params['type'] = $this->get_type();
        $db_params['is_deleted'] = $this->get_is_deleted();

        return $db_params;
    }

    /**
     * @param bool $with_new_page
     * @return int
     */
    public function save($with_new_page = true) {

        $this->set_date_modified(date('Y-m-d H:i:s'));

        if ($this->get_object_status() == 'new') {

            $this->set_date_added(date('Y-m-d H:i:s'));

            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);

            if($with_new_page) {
                $page = new Orm_Survey_Page();
                $page->set_survey_id($insert_id);
                $page->set_order(1);
                $page->save();
            }

        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete() {
        $this->reset_object_fields();
        $this->set_is_deleted(1);
        $this->save();
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

    public function set_title_english($value)
    {
        $this->add_object_field('title_english',$value);
        $this->title_english = $value;
    }

    public function get_title_english()
    {
        return $this->title_english;
    }

    public function set_title_arabic($value)
    {
        $this->add_object_field('title_arabic',$value);
        $this->title_arabic = $value;
    }

    public function get_title_arabic()
    {
        return $this->title_arabic;
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

    public function set_type($value)
    {
        $this->add_object_field('type',$value);
        $this->type = $value;
    }

    public function get_type($to_string = false) {

        if($to_string) {
            return (isset(self::$survey_all_types[$this->type]) ? self::$survey_all_types[$this->type] : '');
        }

        return $this->type;
    }

    public function set_is_deleted($value)
    {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = (int) $value;
    }

    public function get_is_deleted()
    {
        return $this->is_deleted;
    }

    public function get_title($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_title_arabic();
        }

        return $this->get_title_english();
    }

    public function get_date_format($lang = UI_LANG) {
        $date = Orm_Survey_Evaluation::get_last_invitation($this->get_id());
        if(!$date) {
            $date = $this->get_date_modified();
        }

        return date('F d,Y', strtotime($date));
    }
    /**
     * this function get role types by its credentials name
     * @param string $credentials_name the credentials name of the get role types to be call function
     * @return array the call function
     */
    public static function get_role_types($credentials_name = 'list') {
        $role_types = array();
        foreach (self::$survey_types as $id => $name) {
            $survey_type = strtolower($name);
            if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-{$credentials_name}")) {
                $role_types[$id] = "survey_{$survey_type}-{$credentials_name}";
            }
        }

        return $role_types;
    }
    /**
     * this function check role types by its type
     * @param string $type the type of the check role types to be call function
     * @return int|mixed the call function
     */
    public static function check_role_type($type) {
        $type = intval($type);
        $role_types = Orm_Survey::get_role_types();
        if (!in_array($type, array_keys($role_types))) {
            $type = current(array_keys($role_types));
        }
        return $type;
    }
    /**
     * this function get pages
     * @return Orm_Survey_Page[] the call function
     */
    public function get_pages() {
        return Orm_Survey_Page::get_all(array('survey_id' => $this->get_id()));
    }
    /**
     * this function clone me by its with copy name and with response
     * @param bool $with_copy_name the with copy name of the clone me to be call function
     * @param bool $with_response the with response of the clone me to be call function
     * @return bool|Orm_Survey the call function
     */
    public function clone_me($with_copy_name = false, $with_response = true) {

        $copy_name = '';
        if($with_copy_name){
            $copy_name = 'copy ';
        }

        $object = new Orm_Survey();
        $object->set_title_english($copy_name . $this->get_title_english());
        $object->set_title_arabic($copy_name . $this->get_title_arabic());
        $object->set_created_by(Orm_User::get_logged_user()->get_id());
        $object->set_type($this->get_type());

        if ($object->save(false)) {
            foreach ($this->get_pages() as $page) {
                $page->clone_me($object->get_id(), false , $with_response);
            }

            return $object;
        }

        return false;
    }

    /**
     * this function generate pdf by its filters
     * @param array $filters the filters of the generate pdf to be call function
     * @return string file pdf the call function
     */
    public function generate_pdf($filters)
    {
        $headerText = Orm_Semester::get_active_semester()->get_name() . ' Academic Year: ' . Orm_Semester::get_active_semester()->get_year() . "<br>";

        if (isset($filters['course_id']))
        {
            $course = Orm_Course::get_instance($filters['course_id']);
            $headerText .= $course->get_code_en() .' '. $course->get_name().' '.Orm_Semester::get_active_semester()->get_name().'<br>';
        }
        if (isset($filters['program_id']))
        {
            $program = Orm_Program::get_instance($filters['program_id']);
            $headerText .= $program->get_name('english') .', '.$program->get_department_obj()->get_college_obj()->get_name('english') . '<br>';
        } elseif (isset($filters['program_id']))
        {
            $college = Orm_College::get_instance($filters['college_id']);
            $headerText .= $college->get_name() . '<br>';
        } else {
            $headerText .= $this->get_title('english') . "<br>";
        }
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
            'header-line'
        ));

        if (isset($filters['summary']) && $filters['summary'] >= 1)
        {
            $this->generate_pdf_page($pdf,$filters);
        } else
        {
            $pages = Orm_Survey_Page::get_all(array('survey_id' => $this->get_id()));
            $this->generate_pdf_page($pdf,$filters, $pages);
        }

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($filters);

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $name = str_replace(DIRECTORY_SEPARATOR,'-', $this->get_title_english()) . '.pdf';
        $file_name = rtrim($files_full_dir,'/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name))
        {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /**
     * this function generate csv by its filters
     * @param array $filters the filters of the generate csv to be call function
     * @return string file csv the call function
     */
    public function generate_csv($filters)
    {

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($filters);

        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $name = str_replace(DIRECTORY_SEPARATOR,'-', $this->get_title_english()) . '.csv';
        $name = str_replace(' ','_',$name);
        $file_name = rtrim($files_full_dir,'/') . '/' . $name;


        $csv = fopen($file_name , 'w');

        foreach ($this->get_pages() as $page) {

            $questions = $page->get_questions();
            $question_order = 1;
            foreach ($questions as $question) {
                $questionType = $question->get_class_type();
                $question_response = $question->get_responses($filters);
                switch ($questionType){
                    case 'Orm_Survey_Question_Type_Radio':
                    case 'Orm_Survey_Question_Type_Checkbox':
                        $numOfResponses = $question_response[$question->get_id()]['total_responses'];
                        $choices = $question_response[$question->get_id()]['choices'];
                        fputcsv($csv , ['Question number' , $question_order]);
                        fputcsv($csv , ['Question type' , (strpos($questionType , 'Radio')?"Select one answer":"Multible choice")]);
                        fputcsv($csv , ['Question title' , $question_response[$question->get_id()]['name']]);
                        fputcsv($csv , ['Question responses' , $numOfResponses]);
                        foreach ($choices as $choice){
                            fputcsv($csv , [ $choice['name'] , $choice['total'].' responses']);
                        }
                        $question_order++;
                        break;
                    case 'Orm_Survey_Question_Type_Textarea':
                        $numOfResponses = $question_response[$question->get_id()]['total_responses'];
                        fputcsv($csv , ['Question number' , $question_order]);
                        fputcsv($csv , ['Question type' , "Essay Question"]);
                        fputcsv($csv , ['Question title' , $question_response[$question->get_id()]['name']]);
                        fputcsv($csv , ['Question responses' , $numOfResponses]);
                        $question_order++;
                        break;
                    case 'Orm_Survey_Question_Type_Factors_And_Statements':
                        $numOfResponses = $question_response[$question->get_id()]['total_responses'];
                        fputcsv($csv , ['Question number' , $question_order]);
                        fputcsv($csv , ['Question type' , "Factors And Statements"]);
                        fputcsv($csv , ['Question title' , $question_response[$question->get_id()]['name']]);
                        fputcsv($csv , ['Question responses' , $numOfResponses]);
                        $factors = $question_response[$question->get_id()]['factors'];
                        $numOfStatment = 0;
                        foreach ($factors as $factor){
                            $numOfStatment ++;
                            fputcsv($csv , ['Factor' , $factor['factor_group_name']]);
                            fputcsv($csv , ['Statements :']);
                            $statements = $factor['questions'];
                            foreach($statements as $statement){
                                fputcsv($csv , ['' , 'Statement' , $statement['statement']]);
                                fputcsv($csv , ['' , 'Avg' , $statement['avg']]);
                            }
                        }
                        $question_order++;
                        break;
                }

                fputcsv($csv , []);
            }
        }
        fclose($csv);

        $this->get_ci()->output->set_header("Content-type: text/csv");
        $this->get_ci()->output->set_header("Content-Disposition: attachment; filename=".basename($file_name));
        $this->get_ci()->output->set_header("Pragma: no-cache");
        $this->get_ci()->output->set_header("Expires: 0");
        $this->get_ci()->output->set_header('Content-Length: '.filesize($file_name));

        readfile($file_name);
        return;
    }

    /**
     * this function generate image by its filters and only save
     * @param array $filters the filters of the generate image to be call function
     * @param bool $only_save the only save of the generate image to be call function
     * @return string file image the call function
     */
    function generate_image($filters, $only_save = false) {

        $img = new \mikehaertl\wkhtmlto\Image(Orm::get_ci()->config->item('wk_image_options'));

        $this->generate_image_page($img,$filters);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($filters);;

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $name = str_replace(DIRECTORY_SEPARATOR,'-', $this->get_title_english()) . '.png';
        $file_name = $files_full_dir . '/' . $name;

        $img->saveAs($file_name);
        if (!$only_save)
        {
            $img->send($name);
        }
        if ($img->getError())
        {
            echo $img->getError();die;
        }
        return $files_dir.'/'.$name;
    }

    /**
     * this function generate image page by its  img and filters
     * @param \mikehaertl\wkhtmlto\Image $img the img of the generate image page to be call function
     * @param array $filters the filters of the generate image page to be call function
     * @return string file image the call function
     */
    function generate_image_page(\mikehaertl\wkhtmlto\Image $img,$filters) {

        $html = '';
        if ($filters['summary'] == Orm_Survey::SUMMARY_REPORT_ONE) {
            $html .= $this->get_summary_report($filters);
        } else {
            $html .= $this->get_summary_details_report($filters);
        }

        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');

        Orm::get_ci()->layout->stylesheet = array();

        $lang = (UI_LANG == 'arabic') ? '.rtl' : '';

        Orm::get_ci()->layout->add_stylesheet("/assets/pixel/css/bootstrap{$lang}.min.css");
        Orm::get_ci()->layout->add_stylesheet("/assets/pixel/css/themes/candy-green{$lang}.min.css");
        Orm::get_ci()->layout->add_stylesheet("/assets/jadeer/css/img-style.css");

        if ($filters['summary'] == Orm_Survey::SUMMARY_REPORT_TWO) {
            Orm::get_ci()->layout->add_javascript('https://www.google.com/jsapi', false);
        }

        $html = Orm::get_ci()->layout->view($html, array(), true);

        $img->setPage($html);
    }
    /**
     * this function get attachments directory by its filters
     * @param array $filters $img the filters of the get attachments directory to be call function
     * @return int|string file the call function
     */
    public function get_attachments_directory($filters)
    {
        $path = Orm_Semester::get_active_semester()->get_year();

        if (isset($filters['college_id']))
        {
            $path .= '/'.Orm_College::get_instance($filters['college_id'])->get_name('english');
        }
        if (isset($filters['program_id']))
        {
            $path .= '/'.Orm_Program::get_instance($filters['program_id'])->get_name('english');
        }
        if (isset($filters['course_id']))
        {
            $path .= '/'.Orm_Course::get_instance($filters['program_id'])->get_name('english');
        }
        if (empty($filters['course_id']) && empty($filters['program_id']) && empty($filters['college_id'])) {
            $path .= '/Institution';
        }
        $path .= '/Survey';
        return $path;
    }

    /**
     * this function generate pdf page by its pdf and filters and pages
     * @param \mikehaertl\wkhtmlto\Pdf $pdf the pdf of the generate pdf page to be call function
     * @param array $filters the filters of the generate pdf page to be call function
     * @param Orm_Survey_Page[] $pages the pages of the generate pdf page to be call function
     * @return string file pdf the call function
     */
    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf, $filters, $pages = null)
    {
        $html = '';
        if (!is_null($pages))
        {
            if (isset($filters['preview'])) {
                $order = 0;
                foreach ($pages as $page) {
                    $page_title = $page->get_title_english();
                    $html .= "<h4>{$page_title}</h4>";
                    $questions = Orm_Survey_Question::get_all(array('page_id' => $page->get_id()));
                    foreach ($questions as $question)
                    {
                        $order++;
                        $html .= $question->draw_question_with_wrapper($order);
                    }
                }
            } else {
                $filters['is_pdf'] = true;
                foreach ($pages as $page) {
                    $page_title = $page->get_title_english();
                    $html .= "<h4>{$page_title}</h4>";
                    $questions = Orm_Survey_Question::get_all(array('page_id' => $page->get_id()));
                    foreach ($questions as $question)
                    {
                        $html .= $question->draw_report($filters);
                    }
                }
            }
        }
        else
        {
            if ($filters['summary'] == Orm_Survey::SUMMARY_REPORT_ONE) {
                $html .= $this->get_summary_report($filters);
            } else {
                $html .= $this->get_summary_details_report($filters);
            }
        }

        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');

        Orm::get_ci()->layout->add_javascript('/assets/jadeer/js/jquery-2.2.0.min.js');
        Orm::get_ci()->layout->add_javascript('https://www.google.com/jsapi', false);

        $html = Orm::get_ci()->layout->view($html, array(), true);
        $pdf->addPage($html);
    }

    /**
     * this function get summary report by its filters
     * @param array $filters the filters of the get summary report to be call function
     * @return string the html call function
     */
    public function get_summary_report($filters)
    {
        $html = '';
        $html .= '<div class="table-primary">';
        $html .= '<div class="table-header">'.$this->get_title_english().'</div>';
        $html .= '<table class="table">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="col-md-1"><b>'. lang('Abbreviation').'</b></th>';
        $html .= '<th class="col-md-9"><b>'. lang('Title') .'</b></th>';
        $html .= '<th class="col-md-1 text-center">'. lang('Average') .'</th>';
        $html .= '<th class="col-md-1 text-center">'. lang('Response') .'</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $factors = Orm_Survey_Question_Factor::get_all(array('survey_id' => $this->get_id()));
        $overall = 0;
        $max_response = 0;
        foreach ($factors as $factor)
        {
            $factor_response = $factor->get_user_response($filters);
            $overall += isset($factor_response['average']) ? round($factor_response['average'],2) : 0;
            $max_response = isset($factor_response['count']) && $factor_response['count'] > $max_response ? $factor_response['count'] : $max_response;
            $html .= '<tr>';
            $html .= '<td class="col-md-1"><b>'. htmlfilter($factor->get_abbreviation()) .'</b></td>';
            $html .= '<td class="col-md-9"><b>'. htmlfilter($factor->get_report_title()) .'</b></td>';
            $html .= '<td class="col-md-1 text-center">'.(isset($factor_response['average']) ? round($factor_response['average'],2) : 0) .': 5</td>';
            $html .= '<td class="col-md-1 text-center">'.(isset($factor_response['count']) ? $factor_response['count'] : 0).'</td>';
            $html .= '</tr>';
        }
        $html .= '<tr>';
        $html .= '<td class="col-md-10" colspan="2"><b>' . lang('Evaluation Overall') . '</b></td>';
        $html .= '<td class="col-md-1 text-center">' . ( count($factors) ? round($overall/count($factors),2) : 0) . ' : 5</td>';
        $html .= '<td class="col-md-1 text-center">' . $max_response . '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</div>';

        return $html;
    }

    /**
     * this function get summary details report by its filters
     * @param array $filters the filters of the get summary report details to be call function
     * @return string the html call function
     */
    public function get_summary_details_report($filters)
    {

        $html = '';
        $html .= '<div class="table-primary">';
        $html .= '<div class="table-header">'.$this->get_title_english().'</div>';
        $html .= '<table class="table">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="col-md-1"><b>'. lang('Abbreviation').'</b></th>';
        $html .= '<th class="col-md-6"><b>'. lang('Title') .'</b></th>';
        $html .= '<th class="col-md-1 text-center">'. lang('Strongly Disagree (SD)') .'</th>';
        $html .= '<th class="col-md-1 text-center">'. lang('Disagree (D)') .'</th>';
        $html .= '<th class="col-md-1 text-center">'. lang('Neutral (N)') .'</th>';
        $html .= '<th class="col-md-1 text-center">'. lang('Agree (A)') .'</th>';
        $html .= '<th class="col-md-1 text-center">'. lang('Strongly Agree (SA)') .'</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $factors = Orm_Survey_Question_Factor::get_all(array('survey_id' => $this->get_id()));
        $sa = 0; $a = 0; $n = 0; $d = 0; $sd = 0;
        foreach ($factors as $factor)
        {
            $factor_response = $factor->get_detail_user_response($filters);
            $sa += $factor_response['SA'];
            $a  += $factor_response['A'];
            $n  += $factor_response['N'];
            $d  += $factor_response['D'];
            $sd += $factor_response['SD'];

            $html .= '<tr>';
            $html .= '<td ><b>'. htmlfilter($factor->get_abbreviation()) .'</b></td>';
            $html .= '<td ><b>'. htmlfilter($factor->get_report_title()) .'</b></td>';
            $html .= '<td class="text-center">'.number_format($factor_response['SD'],0) . '</td>';
            $html .= '<td class="text-center">'.number_format($factor_response['D'],0).'</td>';
            $html .= '<td class="text-center">'.number_format($factor_response['N'],0).'</td>';
            $html .= '<td class="text-center">'.number_format($factor_response['A'],0).'</td>';
            $html .= '<td class="text-center">'.number_format($factor_response['SA'],0).'</td>';
            $html .= '</tr>';
        }
        $html .= '<tr>';
        $html .= '<td class="col-md-10" colspan="2"><b>' . lang('Evaluation Overall') . '</b></td>';
        $html .= '<td class="col-md-1 text-center">' . number_format((count($factors) ? $sd / count($factors) : 0),0) . '</td>';
        $html .= '<td class="col-md-1 text-center">' . number_format((count($factors) ? $d  / count($factors) : 0),0) . '</td>';
        $html .= '<td class="col-md-1 text-center">' . number_format((count($factors) ? $n  / count($factors) : 0),0) . '</td>';
        $html .= '<td class="col-md-1 text-center">' . number_format((count($factors) ? $a  / count($factors) : 0),0) . '</td>';
        $html .= '<td class="col-md-1 text-center">' . number_format((count($factors) ? $sa / count($factors) : 0),0) . '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</div>';

        $html .= '<div class="table-footer">';
        $html .= '<div id="survey-chart" style="width: 100%; height: 300px;"></div>';
        $html .= '<script type="text/javascript">';
        $sa_s = lang('Strongly Disagree (SD)');
        $a_s = lang('Disagree (D)');
        $n_s = lang('Neutral (N)');
        $d_s = lang('Agree (A)');
        $sd_s = lang('Strongly Agree (SA)');
        $html .= <<<JS

            if (typeof google.visualization === 'undefined') {
                google.load("visualization", "1", {packages:["corechart"]});
                google.setOnLoadCallback(drawChart);
            } else {
                drawChart();
            }
            
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Option', '# of Responses'],
                    ['{$sd_s}', {$sd}],
                    ['{$d_s}', {$d}],
                    ['{$n_s}', {$n}],
                    ['{$a_s}', {$a}],
                    ['{$sa_s}', {$sa}]
                ]);

                var options = {
                    title: '{$this->get_title_english()}',
                    is3D: true,
                    pieSliceText: 'Option',
                    fontSize: 10

                };

                var chart = new google.visualization.PieChart(document.getElementById('survey-chart'));

                chart.draw(data, options);
            }
JS;

        $html .= '</script>';
        $html .= '<script>drawChart();window.onresize = function(){drawChart();};</script>';
        $html .= '</div>';

        return $html;
    }

    /**
     * this function refine filters by its filters
     * @param array $filters the filters of the refine filters to be call function
     * @return string the call function
     */
    public function refine_filters(&$filters) {

        switch ($this->get_type()) {
            case Orm_Survey::TYPE_ALUMNI :
                $filters['class_type'] = 'Orm_User_Alumni';
                break;

            case Orm_Survey::TYPE_EMPLOYER :
                $filters['class_type'] = 'Orm_User_Employer';
                break;

            case Orm_Survey::TYPE_FACULTY :
                $filters['class_type'] = 'Orm_User_Faculty';
                break;

            case Orm_Survey::TYPE_STAFF :
                $filters['class_type'] = 'Orm_User_Staff';
                break;

            case Orm_Survey::TYPE_STUDENTS :
                $filters['class_type'] = 'Orm_User_Student';
                break;
        }
    }

    /**
     *this function has scale questions
     * @return int the call function
     */
    public function has_scale_questions() {
        return Orm_Survey_Question_Statement::get_count(['survey_id' => $this->get_id()]);
    }
}

