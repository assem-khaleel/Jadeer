<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Institution extends Orm {

    protected static $table_name = 'institution';

    /**
     * @var $instances Orm_Institution[]
     */
    protected static $instances = array();

    /**
     * class attributes
     */
    protected $id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $univ_logo_en = '';
    protected $univ_logo_ar = '';
    protected $login_bg_en = '';
    protected $login_bg_ar = '';
    protected $cs_cover = '';
    protected $cr_cover = '';
    protected $fes_cover = '';
    protected $fer_cover = '';
    protected $ps_cover = '';
    protected $pr_cover = '';
    protected $ssr_cover = '';
    protected $sesr_cover = '';
    protected $vision_en = '';
    protected $vision_ar = '';
    protected $mission_en = '';
    protected $mission_ar = '';
    protected $section_id=0;

    private $app_name_en = 'Jadeer';
    private $app_name_ar = 'جدير';
    private $favicon = '/assets/jadeer/img/university/favicon.png';
    private $app_logo_en = '/assets/jadeer/img/logo.png';
    private $app_logo_ar = '/assets/jadeer/img/logo.png';

    /**
     * @return Institution_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Institution_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Institution
     */
    public static function get_instance() {

        if(!empty(self::$instances)) {
            $values = array_values(self::$instances);
            $first = array_shift($values);
            return $first;
        }

        return self::get_one();
    }

    /**
     * Get all rows as Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Institution[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Institution
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Institution();
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
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['univ_logo_en'] = $this->get_univ_logo_en();
        $db_params['univ_logo_ar'] = $this->get_univ_logo_ar();
        $db_params['login_bg_en'] = $this->get_login_bg_en();
        $db_params['login_bg_ar'] = $this->get_login_bg_ar();
        $db_params['cs_cover'] = $this->get_cs_cover();
        $db_params['cr_cover'] = $this->get_cr_cover();
        $db_params['fes_cover'] = $this->get_fes_cover();
        $db_params['fer_cover'] = $this->get_fer_cover();
        $db_params['ps_cover'] = $this->get_ps_cover();
        $db_params['pr_cover'] = $this->get_pr_cover();
        $db_params['ssr_cover'] = $this->get_ssr_cover();
        $db_params['sesr_cover'] = $this->get_sesr_cover();
        $db_params['vision_en'] = $this->get_vision_en();
        $db_params['vision_ar'] = $this->get_vision_ar();
        $db_params['mission_en'] = $this->get_mission_en();
        $db_params['mission_ar'] = $this->get_mission_ar();

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

    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }

    public function get_name_en() {
        return $this->name_en;
    }

    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }

    public function get_name_ar() {
        return $this->name_ar;
    }
    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }

    public function set_univ_logo_en($value) {
        $this->add_object_field('univ_logo_en', $value);
        $this->univ_logo_en = $value;
    }

    public function get_univ_logo_en() {

        if($this->univ_logo_en && file_exists(FCPATH . trim($this->univ_logo_en, '/'))) {
            return $this->univ_logo_en;
        }

        return '/assets/jadeer/img/university/logo.png';
    }

    public function set_univ_logo_ar($value) {
        $this->add_object_field('univ_logo_ar', $value);
        $this->univ_logo_ar = $value;
    }

    public function get_univ_logo_ar() {

        if($this->univ_logo_ar && file_exists(FCPATH . trim($this->univ_logo_ar, '/'))) {
            return $this->univ_logo_ar;
        }

        return '/assets/jadeer/img/university/logo.png';
    }

    public function get_univ_logo($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_univ_logo_ar();
        }
        return $this->get_univ_logo_en();
    }

    public function set_login_bg_en($value) {
        $this->add_object_field('login_bg_en', $value);
        $this->login_bg_en = $value;
    }

    public function get_login_bg_en() {

        if($this->login_bg_en && file_exists(FCPATH . trim($this->login_bg_en, '/'))) {
            return $this->login_bg_en;
        }

        return '/assets/jadeer/img/university/background.png';
    }

    public function set_login_bg_ar($value) {
        $this->add_object_field('login_bg_ar', $value);
        $this->login_bg_ar = $value;
    }

    public function get_login_bg_ar() {

        if($this->login_bg_ar && file_exists(FCPATH . trim($this->login_bg_ar, '/'))) {
            return $this->login_bg_ar;
        }

        return '/assets/jadeer/img/university/background.png';
    }

    public function get_login_bg($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_login_bg_ar();
        }
        return $this->get_login_bg_en();
    }

    public function set_cs_cover($value) {
        $this->add_object_field('cs_cover', $value);
        $this->cs_cover = $value;
    }

    public function get_cs_cover() {
        return $this->cs_cover;
    }

    public function set_cr_cover($value) {
        $this->add_object_field('cr_cover', $value);
        $this->cr_cover = $value;
    }

    public function get_cr_cover() {
        return $this->cr_cover;
    }


    public function set_fes_cover($value) {
        $this->add_object_field('fes_cover', $value);
        $this->fes_cover = $value;
    }

    public function get_fes_cover() {
        return $this->fes_cover;
    }

    public function set_fer_cover($value) {
        $this->add_object_field('fer_cover', $value);
        $this->fer_cover = $value;
    }

    public function get_fer_cover() {
        return $this->fer_cover;
    }

    public function set_ps_cover($value) {
        $this->add_object_field('ps_cover', $value);
        $this->ps_cover = $value;
    }

    public function get_ps_cover() {
        return $this->ps_cover;
    }

    public function set_pr_cover($value) {
        $this->add_object_field('pr_cover', $value);
        $this->pr_cover = $value;
    }

    public function get_pr_cover() {
        return $this->pr_cover;
    }

    public function set_ssr_cover($value) {
        $this->add_object_field('ssr_cover', $value);
        $this->ssr_cover = $value;
    }

    public function get_ssr_cover() {
        return $this->ssr_cover;
    }

    public function set_sesr_cover($value) {
        $this->add_object_field('sesr_cover', $value);
        $this->sesr_cover = $value;
    }

    public function get_sesr_cover() {
        return $this->sesr_cover;
    }

    public function get_vision($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_vision_ar();
        }
        return $this->get_vision_en();
    }

    public function set_vision_en($value) {
        $this->add_object_field('vision_en', $value);
        $this->vision_en = $value;
    }

    public function get_vision_en() {
        return $this->vision_en;
    }

    public function set_vision_ar($value) {
        $this->add_object_field('vision_ar', $value);
        $this->vision_ar = $value;
    }

    public function get_vision_ar() {
        return $this->vision_ar;
    }

    public function get_mission($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_mission_ar();
        }
        return $this->get_mission_en();
    }

    public function set_mission_en($value) {
        $this->add_object_field('mission_en', $value);
        $this->mission_en = $value;
    }

    public function get_mission_en() {
        return $this->mission_en;
    }

    public function set_mission_ar($value) {
        $this->add_object_field('mission_ar', $value);
        $this->mission_ar = $value;
    }

    public function get_mission_ar() {
        return $this->mission_ar;
    }

    private static $objectives = null;

    /**
     * @return Orm_Institution_Objective[]
     */
    public function get_objectives() {
        if(is_null(self::$objectives)) {
            self::$objectives = Orm_Institution_Objective::get_all(array('institution_id' => $this->get_id()));
        }
        return self::$objectives;
    }

    private static $goals = null;

    /**
     * @return Orm_Institution_Goal[]
     */
    public function get_goals() {
        if(is_null(self::$goals)) {
            self::$goals = Orm_Institution_Goal::get_all(array('institution_id' => $this->get_id()));
        }
        return self::$goals;
    }
    private static $section = null;

    /**
     * @return Orm_Course_Section[]
     */
    public function get_section() {
        if(is_null(self::$section)) {
            self::$section = Orm_Course_Section::get_instance($this->section_id);
        }
        return self::$section;
    }

    public static function get_university_name($lang = UI_LANG) {
        if ($lang == 'arabic') {
            return self::get_instance()->get_name_ar();
        }
        return self::get_instance()->get_name_en();
    }

    public static function get_university_logo($lang = UI_LANG) {
        if ($lang == 'arabic') {
            return self::get_instance()->get_univ_logo_ar();
        }
        return self::get_instance()->get_univ_logo_en();
    }

    public static function get_university_login_bg($lang = UI_LANG) {
        if ($lang == 'arabic') {
            return self::get_instance()->get_login_bg_ar();
        }
        return self::get_instance()->get_login_bg_en();
    }

    public function draw_mission() {
        return Orm::get_ci()->load->view('setup/mission/view', array('object' => $this), true);
    }

    public function draw_vision() {
        return Orm::get_ci()->load->view('setup/vision/view', array('object' => $this), true);
    }

    public function draw_goals() {
        return Orm::get_ci()->load->view('setup/goal/view', array('object' => $this), true);
    }

    public function draw_objectives() {
        return Orm::get_ci()->load->view('setup/objective/view', array('object' => $this), true);
    }
    public function draw_sections($id) {
        $this->section_id=$id;
        return Orm::get_ci()->load->view('setup/section/view', array('object' => $this), true);
    }

    public function get_app_name_en() {
        return $this->app_name_en;
    }

    public function get_app_name_ar() {
        return $this->app_name_ar;
    }

    public static function get_app_name($lang = UI_LANG) {
        if ($lang == 'arabic') {
            return self::get_instance()->get_app_name_ar();
        }
        return self::get_instance()->get_app_name_en();
    }

    public function get_favicon() {
        return $this->favicon;
    }

    public function get_app_logo_en() {
        return $this->app_logo_en;
    }

    public function get_app_logo_ar(){
        return $this->app_logo_ar;
    }

    public static  function get_app_logo($lang = UI_LANG) {
        if ($lang == 'arabic') {
            return self::get_instance()->get_app_logo_ar();
        }
        return self::get_instance()->get_app_logo_en();
    }

    public static  function is_insert_institution() {
        if(empty(Orm_Institution::get_one()->get_id())){
            return false;
        }
        return true;
     
    }


}

