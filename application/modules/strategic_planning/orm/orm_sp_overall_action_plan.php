<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Overall_Action_Plan extends Orm
{

    /**
     * @var $instances Orm_Sp_Overall_Action_Plan[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_overall_action_plan';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $action_plan_id = 0;
    protected $date_generated = '0000-00-00 00:00:00';
    protected $academic_year = '';
    protected $completion_certifed = '';
    protected $date_completed = '0000-00-00 00:00:00';
    protected $perpared_by = '';
    protected $accepted_by = '';

    /**
     * @return Sp_Overall_Action_Plan_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Overall_Action_Plan_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Overall_Action_Plan
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
     * @return Orm_Sp_Overall_Action_Plan[] | int
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
     * @return Orm_Sp_Overall_Action_Plan
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Overall_Action_Plan();
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
        $db_params['action_plan_id'] = $this->get_action_plan_id();
        $db_params['date_generated'] = $this->get_date_generated();
        $db_params['academic_year'] = $this->get_academic_year();
        $db_params['completion_certifed'] = $this->get_completion_certifed();
        $db_params['date_completed'] = $this->get_date_completed();
        $db_params['perpared_by'] = $this->get_perpared_by();
        $db_params['accepted_by'] = $this->get_accepted_by();

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

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
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

    public function set_action_plan_id($value)
    {
        $this->add_object_field('action_plan_id',$value);
        $this->action_plan_id = $value;
    }

    public function get_action_plan_id()
    {
        return $this->action_plan_id;
    }

    public function set_date_generated($value)
    {
        $this->add_object_field('date_generated',$value);
        $this->date_generated = $value;
    }

    public function get_date_generated()
    {
        return $this->date_generated;
    }

    public function set_academic_year($value)
    {
        $this->add_object_field('academic_year',$value);
        $this->academic_year = $value;
    }

    public function get_academic_year()
    {
        return $this->academic_year;
    }

    public function set_completion_certifed($value)
    {
        $this->add_object_field('completion_certifed',$value);
        $this->completion_certifed = $value;
    }

    public function get_completion_certifed()
    {
        return $this->completion_certifed;
    }

    public function set_date_completed($value)
    {
        $this->add_object_field('date_completed',$value);
        $this->date_completed = $value;
    }

    public function get_date_completed()
    {
        return $this->date_completed;
    }

    public function set_perpared_by($value)
    {
        $this->add_object_field('perpared_by',$value);
        $this->perpared_by = $value;
    }

    public function get_perpared_by()
    {
        return $this->perpared_by;
    }

    public function set_accepted_by($value)
    {
        $this->add_object_field('accepted_by',$value);
        $this->accepted_by = $value;
    }

    public function get_accepted_by()
    {
        return $this->accepted_by;
    }

    /**
     * @return Orm_Sp_Action_Plan
     */
    public function get_action_plan_obj() {
        return Orm_Sp_Action_Plan::get_instance($this->get_action_plan_id());
    }

    public function get_reasons() {
        $items = Orm_Sp_Reason_Action_Plan::get_all(array('overall_id' => $this->get_id()));
        $results = array();
        foreach ($items as $item) {
            $results[$item->get_reason_type()] = $item->get_content();
        }
        return $results;
    }

    public function generate_pdf($view_params = array()) {

        $headerText = Orm_Institution::get_instance()->get_name(). '<br/>';
        $headerText .= lang("Overall developmental action plan for academic year"). ": ". $this->get_academic_year();

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

        $view_params['report'] = $this;
        $this->generate_pdf_page($pdf, $view_params);

        $files_dir = '/files/' . $this->get_attachments_directory();

        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name = $this->get_name() . '.pdf';
        $file_name = rtrim($files_fulldir,'/') . '/' . $name;

        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf, $view_params = array()) {
        $html = Orm::get_ci()->layout->set_layout('layout_pdf')->view('action_plan/overall_report', $view_params, true);
        $pdf->addPage($html);
    }

    public function get_filename() {
        return $this->get_name() .'.pdf';
    }

    public function get_full_path() {
        $files_dir = '/files/' . $this->get_attachments_directory();

        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;

        $name = $this->get_name() . '.pdf';
        return rtrim($files_fulldir, '/') . '/' . $name;
    }

    private function get_name() {
        return "overall_report";
    }

    private function get_attachments_directory() {
        $directory = array('Documents', 'Strategic Planning');
        $year = date('Y', strtotime($this->get_date_generated()));
        $dm = date('m-d', strtotime($this->get_date_generated()));

        return implode('/', $directory) .'/'. $year .'/'. $dm;
    }

}

