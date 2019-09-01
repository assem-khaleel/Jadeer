<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Policies_Procedures extends Orm {
    
    /**
    * @var $instances Orm_Policies_Procedures[]
    */
    protected static $instances = array();
    protected static $table_name = 'policies_procedures';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $unit_id = 0;
    protected $unit_type = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $desc_en = '';
    protected $desc_ar = '';
    protected $statement_en = '';
    protected $statement_ar = '';
    protected $definitions_en = '';
    protected $definitions_ar = '';
    protected $audience_en = '';
    protected $audience_ar = '';
    protected $reason_en = '';
    protected $reason_ar = '';
    protected $compliance_en = '';
    protected $compliance_ar = '';
    protected $regulations_en = '';
    protected $regulations_ar = '';
    protected $contact_def_en = '';
    protected $contact_def_ar = '';
    protected $history_en = '';
    protected $history_ar = '';
    protected $procedures_en = '';
    protected $procedures_ar = '';
    protected $standard_en = '';
    protected $standard_ar = '';
    protected $creator_id = 0;

    /**
     * UNIT Types
     */
    const UNIT_INSTITUTION_LEVEL = 0;
    const UNIT_COLLEGE_LEVEL = 1;
    const UNIT_PROGRAM_LEVEL = 2;
    
    /**
    * @return Policies_Procedures_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Policies_Procedures_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Policies_Procedures
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
    * @return Orm_Policies_Procedures[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Policies_Procedures
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Policies_Procedures();
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
     * @param  array $db_params
     * return array
    */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['unit_id'] = $this->get_unit_id();
        $db_params['unit_type'] = $this->get_unit_type();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();
        $db_params['statement_en'] = $this->get_statement_en();
        $db_params['statement_ar'] = $this->get_statement_ar();
        $db_params['definitions_en'] = $this->get_definitions_en();
        $db_params['definitions_ar'] = $this->get_definitions_ar();
        $db_params['audience_en'] = $this->get_audience_en();
        $db_params['audience_ar'] = $this->get_audience_ar();
        $db_params['reason_en'] = $this->get_reason_en();
        $db_params['reason_ar'] = $this->get_reason_ar();
        $db_params['compliance_en'] = $this->get_compliance_en();
        $db_params['compliance_ar'] = $this->get_compliance_ar();
        $db_params['regulations_en'] = $this->get_regulations_en();
        $db_params['regulations_ar'] = $this->get_regulations_ar();
        $db_params['contact_def_en'] = $this->get_contact_def_en();
        $db_params['contact_def_ar'] = $this->get_contact_def_ar();
        $db_params['history_en'] = $this->get_history_en();
        $db_params['history_ar'] = $this->get_history_ar();
        $db_params['procedures_en'] = $this->get_procedures_en();
        $db_params['procedures_ar'] = $this->get_procedures_ar();
        $db_params['standard_en'] = $this->get_standard_en();
        $db_params['standard_ar'] = $this->get_standard_ar();
        $db_params['creator_id'] = $this->get_creator_id();
        
        return $db_params;
    }

    /** save object
     * @param  array $insert_id
     * return int
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
    
    public function set_unit_id($value) {
        $this->add_object_field('unit_id', $value);
        $this->unit_id = $value;
    }
    
    public function get_unit_id() {
        return $this->unit_id;
    }

    public function set_unit_type($value) {
        $this->add_object_field('unit_type', $value);
        $this->unit_type = $value;
    }

    public function get_unit_type() {
        return $this->unit_type;
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
    
    public function set_statement_en($value) {
        $this->add_object_field('statement_en', $value);
        $this->statement_en = $value;
    }
    
    public function get_statement_en() {
        return $this->statement_en;
    }
    
    public function set_statement_ar($value) {
        $this->add_object_field('statement_ar', $value);
        $this->statement_ar = $value;
    }
    
    public function get_statement_ar() {
        return $this->statement_ar;
    }

    public function get_statement($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_statement_ar();
        }
        return $this->get_statement_en();
    }

    
    public function set_definitions_en($value) {
        $this->add_object_field('definitions_en', $value);
        $this->definitions_en = $value;
    }
    
    public function get_definitions_en() {
        return $this->definitions_en;
    }
    
    public function set_definitions_ar($value) {
        $this->add_object_field('definitions_ar', $value);
        $this->definitions_ar = $value;
    }
    
    public function get_definitions_ar() {
        return $this->definitions_ar;
    }

    public function get_definitions($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_definitions_ar();
        }
        return $this->get_definitions_en();
    }
    
    public function set_audience_en($value) {
        $this->add_object_field('audience_en', $value);
        $this->audience_en = $value;
    }
    
    public function get_audience_en() {
        return $this->audience_en;
    }
    
    public function set_audience_ar($value) {
        $this->add_object_field('audience_ar', $value);
        $this->audience_ar = $value;
    }
    
    public function get_audience_ar() {
        return $this->audience_ar;
    }

    public function get_audience($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_audience_ar();
        }
        return $this->get_audience_en();
    }

    public function set_reason_en($value) {
        $this->add_object_field('reason_en', $value);
        $this->reason_en = $value;
    }
    
    public function get_reason_en() {
        return $this->reason_en;
    }
    
    public function set_reason_ar($value) {
        $this->add_object_field('reason_ar', $value);
        $this->reason_ar = $value;
    }
    
    public function get_reason_ar() {
        return $this->reason_ar;
    }

    public function get_reason($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_reason_ar();
        }
        return $this->get_reason_en();
    }

    public function set_compliance_en($value) {
        $this->add_object_field('compliance_en', $value);
        $this->compliance_en = $value;
    }
    
    public function get_compliance_en() {
        return $this->compliance_en;
    }
    
    public function set_compliance_ar($value) {
        $this->add_object_field('compliance_ar', $value);
        $this->compliance_ar = $value;
    }
    
    public function get_compliance_ar() {
        return $this->compliance_ar;
    }

    public function get_compliance($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_compliance_ar();
        }
        return $this->get_compliance_en();
    }

    public function set_regulations_en($value) {
        $this->add_object_field('regulations_en', $value);
        $this->regulations_en = $value;
    }
    
    public function get_regulations_en() {
        return $this->regulations_en;
    }
    
    public function set_regulations_ar($value) {
        $this->add_object_field('regulations_ar', $value);
        $this->regulations_ar = $value;
    }
    
    public function get_regulations_ar() {
        return $this->regulations_ar;
    }
    public function get_regulations($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_regulations_ar();
        }
        return $this->get_regulations_en();
    }

    public function set_contact_def_en($value) {
        $this->add_object_field('contact_def_en', $value);
        $this->contact_def_en = $value;
    }
    
    public function get_contact_def_en() {
        return $this->contact_def_en;
    }
    
    public function set_contact_def_ar($value) {
        $this->add_object_field('contact_def_ar', $value);
        $this->contact_def_ar = $value;
    }
    
    public function get_contact_def_ar() {
        return $this->contact_def_ar;
    }
    
    public function get_contact_def($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_contact_def_ar();
        }
        return $this->get_contact_def_en();
    }
    
    public function set_history_en($value) {
        $this->add_object_field('history_en', $value);
        $this->history_en = $value;
    }
    
    public function get_history_en() {
        return $this->history_en;
    }
    
    public function set_history_ar($value) {
        $this->add_object_field('history_ar', $value);
        $this->history_ar = $value;
    }
    
    public function get_history_ar() {
        return $this->history_ar;
    }

    public function get_history($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_history_ar();
        }
        return $this->get_history_en();
    }
    
    public function set_procedures_en($value) {
        $this->add_object_field('procedures_en', $value);
        $this->procedures_en = $value;
    }
    
    public function get_procedures_en() {
        return $this->procedures_en;
    }
    
    public function set_procedures_ar($value) {
        $this->add_object_field('procedures_ar', $value);
        $this->procedures_ar = $value;
    }
    
    public function get_procedures_ar() {
        return $this->procedures_ar;
    }

    public function get_procedures($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_procedures_ar();
        }
        return $this->get_procedures_en();
    }
    
    public function set_standard_en($value) {
        $this->add_object_field('standard_en', $value);
        $this->standard_en = $value;
    }
    
    public function get_standard_en() {
        return $this->standard_en;
    }
    
    public function set_standard_ar($value) {
        $this->add_object_field('standard_ar', $value);
        $this->standard_ar = $value;
    }
    
    public function get_standard_ar() {
        return $this->standard_ar;
    }

    public function get_standard($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_standard_ar();
        }
        return $this->get_standard_en();
    }
    
    public function set_creator_id($value) {
        $this->add_object_field('creator_id', $value);
        $this->creator_id = $value;
    }

    public function get_creator_id() {
        return $this->creator_id;
    }
    
    public static function get_unit_types($is_String = false) {

        $access = array();
        if(!$is_String){
            if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                $access[self::UNIT_INSTITUTION_LEVEL]=lang('Institution');
                $access[self::UNIT_COLLEGE_LEVEL]=lang('College');
            }
            if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                $access[self::UNIT_COLLEGE_LEVEL]=lang('College');
            }

        }else{
            $access[self::UNIT_INSTITUTION_LEVEL]=lang('Institution');
            $access[self::UNIT_COLLEGE_LEVEL]=lang('College');
        }

        $access[self::UNIT_PROGRAM_LEVEL]=lang('Program');
        return $access;
        
        
//        return [
//            self::UNIT_INSTITUTION_LEVEL => lang('Institution'),
//            self::UNIT_COLLEGE_LEVEL     => lang('College'),
//            self::UNIT_PROGRAM_LEVEL     => lang('Program')
//        ];
    }
    
    public function get_current_unit_type() {
        return self::get_unit_types(true)[$this->get_unit_type()];
    }

    public function get_current_unit_type_title() {
        switch($this->get_unit_type()) {
            case self::UNIT_COLLEGE_LEVEL:
                return Orm_College::get_instance($this->get_unit_id())->get_name();
            case self::UNIT_PROGRAM_LEVEL:
                return Orm_Program::get_instance($this->get_unit_id())->get_name();
        }

        return '';
    }

    public function get_title($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_title_ar();
        }
        return $this->get_title_en();
    }
    public function get_desc($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_desc_ar();
        }
        return $this->get_desc_en();
    }

    private $managers = null;

    /**
     * @return Orm_Policies_Procedures_Managers[]
     */
    public function get_managers()
    {
        if(is_null($this->managers)) {
            $this->managers = Orm_Policies_Procedures_Managers::get_all(['policy_id' => $this->get_id()]);
        }

        return $this->managers;
    }

    public function get_manager_ids()
    {
        $manager_ids = array();
        foreach ($this->get_managers() as $manager) {
            $manager_ids[] = $manager->get_manager_id();
        }
        return $manager_ids;
    }

    /** draw pdf file and save it
     */
    public  function generate_pdf($policy_id)
    {
        $policy =  Orm_Policies_Procedures::get_instance($policy_id);
//        $headerText = $policy->get_title(). '<br>';
//        $headerText .= lang('Level') . ' : ' . htmlfilter($policy->get_current_unit_type()).($policy->get_current_unit_type_title()  ? ' ( '.$policy->get_current_unit_type_title().' ) ':''); 
      
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

        $this->generate_pdf_page($pdf,$policy_id);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($policy_id);

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $today = date('Ymd');
        $file_title = str_replace(['&',' ','/','(',')','-','\\'],'_',$policy->get_title());
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

    /** generate and realese pdf page after drawing it
    */
    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf,$policy_id)
    {
        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');


        $policy =Orm_Policies_Procedures::get_instance($policy_id);

     
        $params['policy'] = $policy;
        
        $content = Orm::get_ci()->load->view('policies_procedures/view', $params, true);

        $html = Orm::get_ci()->layout->view($content,array(),true);

        $pdf->addPage($html);
    }

    public function get_attachments_directory($policy_id)
    {
        $path = 'policy_procedure';
        $path .= '/'.$policy_id;
        return $path;
    }

/** check if users can view the procedures
*/
    public static function check_if_can_view() {

      return  Orm_User::check_credential(array(Orm_User::USER_STUDENT), true) || Orm_User::check_permission(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'policies_procedures-list');

    }
    /** check if users can add the procedures
     */
    public static function check_if_can_add() {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class],false,'policies_procedures-manage');
    }

    private $can_edit = null;

    /** check if users can edit the procedures
     */
    public function check_if_can_edit(){

        if(is_null($this->can_edit)) {

            $this->can_edit = false;

            if(self::check_if_can_add()) {
                $this->can_edit = true;
            }
        }

        return $this->can_edit;

    }
    private $can_delete = null;
    /** check if users can delete the procedures
     */
    public  function check_if_can_delete(){

        if(is_null($this->can_delete)) {

            $this->can_delete = false;

            if($this->check_if_can_edit()) {
                $this->can_delete = true;
            }
        }

        return $this->can_delete;
    }

    /** check if users can genearate reports for specific procedure
     */
    public static function check_if_can_generate_report() {

        return  Orm_User::check_credential(array(Orm_User::USER_STUDENT), true) || Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'policies_procedures-report');
        
    }
    

    private $can_modify =null;
    /**  check if users can modify the procedures
     */
    public function check_if_can_modify($user /*@var $user Orm_User() */){

        if(self::check_if_can_add()){
            if($this->get_creator_id() == $user->get_id() || in_array($user->get_id(),$this->get_manager_ids())){
                $this->can_modify = true;

            }

            if ($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                if ( $this->get_unit_type() == Orm_Policies_Procedures::UNIT_COLLEGE_LEVEL &&
                    $this->get_unit_id() == $user->get_college_id()  || $this->get_creator_id() == $user->get_id() || in_array($user->get_id(),$this->get_manager_ids()))
                {
                    $this->can_modify = true;

                }

            }

            if ($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                if ( $this->get_unit_type() == Orm_Policies_Procedures::UNIT_PROGRAM_LEVEL &&
                    $this->get_unit_id() == $user->get_program_id()  || $this->get_creator_id() == $user->get_id() || in_array($user->get_id(),$this->get_manager_ids()))
                {
                    $this->can_modify = true;

                }

            }

            if ($user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                    $this->can_modify = true;
            }

            return  $this->can_modify;
        }

        return  $this->can_modify;

    }
}

