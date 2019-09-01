<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_C_Committee extends Orm
{

    /**
     * @var $instances Orm_C_Committee[]
     */
    protected static $instances = array();
    protected static $table_name = 'c_committee';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $description_en = '';
    protected $description_ar = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    protected $type = 0;
    protected $type_id = 0;
    protected $is_deleted = 0;

    const COMMITTEE_INSTITUTION_LEVEL = 0;
    const COMMITTEE_COLLEGE_LEVEL = 1;
    const COMMITTEE_PROGRAM_LEVEL = 2;

    /**
     * @return C_Committee_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('C_Committee_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_C_Committee
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
     * @return Orm_C_Committee[] | int
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
     * @return Orm_C_Committee
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_C_Committee();
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
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['description_en'] = $this->get_description_en();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['type'] = $this->get_type();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['is_deleted'] = $this->get_is_deleted();

        return $db_params;
    }

    /**
     * @return int
     */
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

    /**
     * @return bool
     */
    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @param $value
     */
    public function set_id($value)
    {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    /**
     * @return int
     */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * @param $value
     */
    public function set_title_en($value)
    {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }

    /**
     * @return string
     */
    public function get_title_en()
    {
        return $this->title_en;
    }

    /**
     * @param $value
     */
    public function set_title_ar($value)
    {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }

    /**
     * @return string
     */
    public function get_title_ar()
    {
        return $this->title_ar;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_title($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_title_ar();
        }
        return $this->get_title_en();
    }

    /**
     * @param $value
     */
    public function set_description_en($value)
    {
        $this->add_object_field('description_en', $value);
        $this->description_en = $value;
    }

    /**
     * @return string
     */
    public function get_description_en()
    {
        return $this->description_en;
    }

    /**
     * @param $value
     */
    public function set_description_ar($value)
    {
        $this->add_object_field('description_ar', $value);
        $this->description_ar = $value;
    }

    /**
     * @return string
     */
    public function get_description_ar()
    {
        return $this->description_ar;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_description($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_description_ar();
        }
        return $this->get_description_en();
    }

    /**
     * @param $value
     */
    public function set_start_date($value)
    {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }

    /**
     * @return string
     */
    public function get_start_date()
    {
        return $this->start_date;
    }

    /**
     * @param $value
     */
    public function set_end_date($value)
    {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }

    /**
     * @return string
     */
    public function get_end_date()
    {
        return $this->end_date;
    }

    /**
     * @param $value
     */
    public function set_type($value)
    {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    /**
     * @param bool $string
     * @return int|mixed
     */
    public function get_type($string = false)
    {
        if ($string) {
            return $this->get_types()[$this->type];
        }
        return $this->type;
    }

    /**
     * @param $value
     */
    public function set_type_id($value)
    {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }

    /**
     * @return int
     */
    public function get_type_id()
    {
        return $this->type_id;
    }

    /**
     * @param $value
     */
    public function set_is_deleted($value)
    {
        $this->add_object_field('is_deleted', $value);
        $this->is_deleted = $value;
    }

    /**
     * @return int
     */
    public function get_is_deleted()
    {
        return $this->is_deleted;
    }

    /**
     * @return mixed
     */
    public function get_current_type()
    {
        return self::get_types()[$this->get_type()];
    }

    /**
     * get the value of committee level such as 0 => institutional , 1=> college , 2 => program
     * @return array
     */
    public static function get_types()
    {
        return [
            self::COMMITTEE_INSTITUTION_LEVEL => lang('Institution'),
            self::COMMITTEE_COLLEGE_LEVEL => lang('College'),
            self::COMMITTEE_PROGRAM_LEVEL => lang('Program')
        ];
    }

    /**
     * get the name of type after you choose college or program you must know the name of it so this function will help you in
     * @return string
     */
    public function get_current_type_id_title()
    {

        switch ($this->get_type()) {
            case self::COMMITTEE_COLLEGE_LEVEL:
                return Orm_College::get_instance($this->get_type_id())->get_name();

            case self::COMMITTEE_PROGRAM_LEVEL:
                return Orm_Program::get_one(['id' => $this->get_type_id()])->get_name();
        }

        return '';
    }

    private $members = null;

    /**
     * get all users that has been added as a member for the committee
     * @return Orm_C_Committee_Member[]
     */
    public function get_members()
    {
        if (is_null($this->members)) {
            $this->members = Orm_C_Committee_Member::get_all(array('committee_id' => $this->get_id()), 0, 0, array('is_leader'), 'desc');
        }
        return $this->members;
    }

    /**
     * get this ids' of users that addedd to committee
     * @return array
     */
    public function get_user_ids()
    {
        $return = array_column(Orm_C_Committee_Member::get_model()->get_all(['committee_id' => $this->get_id()], 0, 0, array(), Orm::FETCH_ARRAY), 'user_id');

        return $return;
    }

    /**
     * get the directory (url / path) that the file will set on
     * @param $type
     * @param $filters
     * @return string
     */
    public function get_attachments_directory($type, $filters)
    {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';
        switch ($type) {
            case self::COMMITTEE_INSTITUTION_LEVEL:
                $path .= 'Institution/';
                break;
            case self::COMMITTEE_COLLEGE_LEVEL:
                $path .= Orm_College::get_instance($filters)->get_name_en() . '/';
                break;
            case self::COMMITTEE_PROGRAM_LEVEL:
                $path .= Orm_Program::get_instance($filters)->get_department_obj()->get_college_obj()->get_name_en() . '/';
                $path .= Orm_Program::get_instance($filters)->get_name_en() . '/';
                break;
        }

        $path .= 'Committee';

        return $path;
    }

    private $leaders = null;

    /**
     * get the leader id for the committee depends on committee ID
     * @return Orm_C_Committee_Member
     */
    public function get_leader()
    {
        if (is_null($this->leaders)) {
            $this->leaders = Orm_C_Committee_Member::get_one(array('committee_id' => $this->get_id(), 'is_leader' => 1));
        }
        return $this->leaders;
    }

    /**
     * generate_pdf function used to prepare and download committee work information as pdf file
     */
    public function generate_pdf()
    {
        $headerText = lang('Committee') . " : ";
        $headerText .= $this->get_title() . "<br />";
        $headerText .= lang('Level') . " : ";
        $headerText .= $this->get_types()[$this->get_type()];

        switch ($this->get_type()) {
            case Orm_C_Committee::COMMITTEE_COLLEGE_LEVEL:
                $headerText .= " (" . Orm_College::get_instance($this->get_type_id())->get_name() . ")";
                break;
            case Orm_C_Committee::COMMITTEE_PROGRAM_LEVEL:
                $headerText .= " (" . Orm_Program::get_instance($this->get_type_id())->get_name() . ")";
                break;
        }

        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom'] = 1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);

        $header_html = Orm::get_ci()->load->view('pdf_header', array(''), true);

        $pdf->setOptions(array(
            //header
            'margin-top' => 27,
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            //footer
            'footer-left' => lang('Committee')
        ));

        $this->generate_pdf_page($pdf);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($this->get_type(), $this->get_type_id());

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name = 'Committee (' . $this->get_title() . ').pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /**
     * generate_pdf_page function used to call the WKHTMLTOPDF Library and set data on several pages
     * @param \mikehaertl\wkhtmlto\Pdf $pdf
     */
    public function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf)
    {

        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->content_as_html(false)->view('report', array('committee' => $this), true);
        $pdf->addPage($content);
    }

    /**
     * check if logged user can add committee work or not
     * @return bool
     */
    public static function check_if_can_add()
    {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'committee_work-manage');
    }

    private $can_edit = null;

    /**
     * check if logged user can modify or update the data for committee
     * @return bool|null
     */
    public function check_if_can_edit()
    {

        if (is_null($this->can_edit)) {

            $this->can_edit = false;

            if (self::check_if_can_add()) {
                $this->can_edit = true;
            }
        }

        return $this->can_edit;

    }

    private $can_delete = null;

    /**
     * check if the logged user can remove the committee
     * @return bool|null
     */
    public function check_if_can_delete()
    {

        if (is_null($this->can_delete)) {

            $this->can_delete = false;

            if ($this->check_if_can_edit()) {
                $this->can_delete = true;
            }
        }

        return $this->can_delete;
    }

    /**
     * check if user can see the pdf and manage the report
     * @return bool
     */
    public static function check_if_can_generate_report()
    {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'committee_work-report');
    }

    /**
     * check if the committee can show in Meeting Minutes Module (Meeting Minutes Module if active or not the result will return depends on that)
     * @return bool
     */
    public function check_if_can_map_with_meeting()
    {

        if (License::get_instance()->check_module('meeting_minutes', true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'meeting_minutes-list')) {
            Modules::load('meeting_minutes');

            return boolval(Orm_Mm_Meeting::get_count(array('type_id' => $this->get_id())));
        }

        return false;
    }

}

