<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Forms_Evaluations extends Orm {
    
    /**
    * @var $instances Orm_Fp_Forms_Evaluations[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_forms_evaluations';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $type_id = 0;
    protected $value = 0;
    protected $deadline_id = 0;
    protected $created_at = '0000-00-00 00:00:00';
    protected $updated_at = '0000-00-00 00:00:00';

    /**
    * @return Fp_Forms_Evaluations_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Forms_Evaluations_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Forms_Evaluations
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
    * @return Orm_Fp_Forms_Evaluations[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Forms_Evaluations
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Forms_Evaluations();
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
        $db_params['user_id'] = $this->get_user_id();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['value'] = $this->get_value();
        $db_params['deadline_id'] = $this->get_deadline_id();
        $db_params['created_at'] = $this->get_created_at();
        $db_params['updated_at'] = $this->get_updated_at();
        return $db_params;
    }
    
    public function save() {
        $this->set_updated_at(date('Y-m-d H:i:s'));
        if ($this->get_object_status() == 'new') {
            $this->set_created_at(date('Y-m-d H:i:s'));
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
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }
    
    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }
    
    public function get_type_id() {
        return $this->type_id;
    }
    
    public function set_value($value) {
        $this->add_object_field('value', $value);
        $this->value = $value;
    }
    
    public function get_value() {
        return $this->value;
    }

    public function set_deadline_id($value) {
        $this->add_object_field('deadline_id', $value);
        $this->deadline_id = $value;
    }
    
    public function get_deadline_id() {
        return $this->deadline_id;
    }
    public function set_created_at($value) {
        $this->add_object_field('created_at', $value);
        $this->created_at = $value;
    }

    public function get_created_at() {
        return $this->created_at;
    }

    public function set_updated_at($value) {
        $this->add_object_field('updated_at', $value);
        $this->updated_at = $value;
    }

    public function get_updated_at() {
        return $this->updated_at;
    }

    /**
     * @param $type_id
     * @param $ids
     * @param int $deadline
     * @return mixed
     */
    public static function get_avg_by_type($type_id, $ids, $deadline=-1) {
        return self::get_model()->get_avg_by_type($type_id, $ids, $deadline);
    }

    /**
     * @param $col_name
     * @param $col_value
     * @param $type_id
     * @param int $deadline
     * @return mixed|string
     */
    public static function get_avg($col_name, $col_value, $type_id, $deadline = 0){

        if($deadline == -1) {
            $faculty = Orm_User_Faculty::get_all([$col_name => $col_value]);
        } else {
            if($deadline == 0){
                $deadline = Orm_Fp_Forms_Deadline::get_current_deadline();
            }
            $faculty = Orm_User_Faculty::get_all([$col_name => $col_value, 'deadline_id' => $deadline]);

        }

        $ids = [];
        foreach ($faculty as $teacher){
            $ids[] = $teacher->get_id();
        }

        if(count($ids) == 0){
            return '';
        }

        return self::get_avg_by_type($type_id, $ids, $deadline);

    }

    /**
     * @param $user_id
     * @param $deadline
     */
    public  function generate_pdf($user_id, $deadline)
    {
        $user =  Orm_User::get_instance($user_id)->get_full_name();
        $headerText = $user. '<br>';
        $headerText .= Orm_Institution::get_one()->get_name();

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

        $this->generate_pdf_page($pdf,$user_id,$deadline);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($user_id);

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $today = date('Ymd');

        $name = "{$user}-{$today}.pdf";
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
     * @param \mikehaertl\wkhtmlto\Pdf $pdf
     * @param $user_id
     * @param $deadline
     */
    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf, $user_id, $deadline)
    {
        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');

        $type = Orm_Fp_Forms_Type::get_all(['deadline_id'=>$deadline]);
        $recommendation = Orm_Fp_Forms_Recommendation::get_recmmedation_by_values($user_id,0,$deadline);
        $evaluation = self::get_all(['user_id' => $user_id ,'deadline_id'=>$deadline]);
        $faculty =Orm_User_Faculty::get_instance($user_id);

        $params['types'] = $type;
        $params['recommendations'] = $recommendation;
        $params['faculty'] = $faculty;
        $params['evaluations'] = $evaluation;
        $params['user_id'] =$user_id;
        $params['deadline'] = $deadline;
        $params['action'] = true;
        $content = Orm::get_ci()->load->view('faculty_performance/report/all_report', $params, true);

        $html = Orm::get_ci()->layout->view($content,array(),true);

        $pdf->addPage($html);
    }

    /**
     * @param $user_id
     * @return string
     */
    public function get_attachments_directory($user_id)
    {
        $path = '/Users';
        $path .= '/'.$user_id;
        $path .= '/Faculty Performance/';
        return $path;
    }

    /**
     * @param $type_id
     * @param $form_value
     * @param $deadline
     */
    public static function compare_rate_values($type_id, $form_value, $deadline){

        $types = Orm_Fp_Forms_Rate::get_rate_by_type($type_id,$deadline);

        if($form_value > $types->get_rate()){
            Validator::set_error('rate' ,lang('Rate Must be Less than the Rates of each Form Type'));
        }
    }

}

