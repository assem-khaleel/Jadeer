<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Learning_Domain extends Orm {
    
    protected static $table_name = 'cm_learning_domain';
    
    /**
    * @var $instances Orm_Cm_Learning_Domain[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $ncaaa_code = 1;
    protected $title_en = '';
    protected $title_ar = '';
    protected $is_deleted = 0;
    protected $type = 0;

    const TYPE_NCAAA_OLD = 1;
    const TYPE_NCAAA_NEW = 2;
    const TYPE_WELL_KNOWN =3;
    const TYPE_OTHER = 4;

    const NEW_LEARNING_DOMAIN_KNOWLEDGE = 1;
    const NEW_LEARNING_DOMAIN_SKILLS= 2;
    const NEW_LEARNING_DOMAIN_COMPETENCIES= 3;

    const WELLKNOWN_LEARNING_DOMAIN_COGNITIVE_SKILLS = 1;
    const WELLKNOWN_LEARNING_DOMAIN_PSYCHOMOTOR= 2;
    const WELLKNOWN_LEARNING_DOMAIN_AFFECTIVE= 3;


    const LEARNING_DOMAIN_KNOWLEDGE = 1;
    const LEARNING_DOMAIN_COGNITIVE_SKILLS = 2;
    const LEARNING_DOMAIN_INTERPERSONAL_SKILLS_RESPONSIBILITY = 3;
    const LEARNING_DOMAIN_COMMUNICATION_INFORMATION_TECHNOLOGY_NUMERICAL = 4;
    const LEARNING_DOMAIN_PSYCHOMOTOR= 5;

    static $ncaaa_domains_en = array(
        self::LEARNING_DOMAIN_KNOWLEDGE => 'Knowledge',
        self::LEARNING_DOMAIN_COGNITIVE_SKILLS => 'Cognitive Skills',
        self::LEARNING_DOMAIN_INTERPERSONAL_SKILLS_RESPONSIBILITY => 'Interpersonal Skills & Responsibility',
        self::LEARNING_DOMAIN_COMMUNICATION_INFORMATION_TECHNOLOGY_NUMERICAL => 'Communication, Information Technology, Numerical',
        self::LEARNING_DOMAIN_PSYCHOMOTOR => 'Psychomotor'
    );

    static $ncaaa_domains_ar = array(
        self::LEARNING_DOMAIN_KNOWLEDGE => 'مهارات معرفية',
        self::LEARNING_DOMAIN_COGNITIVE_SKILLS => 'مهارات ذهنية',
        self::LEARNING_DOMAIN_INTERPERSONAL_SKILLS_RESPONSIBILITY => 'مهارات التعامل مع الآخرين والمسئولية',
        self::LEARNING_DOMAIN_COMMUNICATION_INFORMATION_TECHNOLOGY_NUMERICAL => 'الاتصالات وتكنولوجيا المعلومات والعددية',
        self::LEARNING_DOMAIN_PSYCHOMOTOR => 'النفسي'
    );


    static $new_ncaaa_domains_en = array(
        self::NEW_LEARNING_DOMAIN_KNOWLEDGE => 'Knowledge',
        self::NEW_LEARNING_DOMAIN_SKILLS => 'Skills',
        self::NEW_LEARNING_DOMAIN_COMPETENCIES => 'Competencies',
    );

    static $new__domains_ar = array(
        self::NEW_LEARNING_DOMAIN_KNOWLEDGE => 'مهارات معرفية',
        self::NEW_LEARNING_DOMAIN_SKILLS => 'مهارات ذهنية',
        self::NEW_LEARNING_DOMAIN_COMPETENCIES => 'الكفاءات',
    );

       static $well_known_domains_en = array(
        self::WELLKNOWN_LEARNING_DOMAIN_COGNITIVE_SKILLS => 'Cognitive Domain (Knowledge)',
        self::WELLKNOWN_LEARNING_DOMAIN_PSYCHOMOTOR => 'Psychomotor Domain (Skills)',
        self::WELLKNOWN_LEARNING_DOMAIN_AFFECTIVE => 'Affective Domain (Attitudes)',
    );

    static $well_known_domains_ar = array(
        self::WELLKNOWN_LEARNING_DOMAIN_COGNITIVE_SKILLS => 'مهارات معرفية',
        self::WELLKNOWN_LEARNING_DOMAIN_PSYCHOMOTOR => 'المجال النفسي (المهارات)',
        self::WELLKNOWN_LEARNING_DOMAIN_AFFECTIVE => 'المجال العاطفي (التصرفات)',
    );
       static $type_list_en = array(
        self::TYPE_NCAAA_OLD => 'NCAAA Old Learning Domain',
        self::TYPE_NCAAA_NEW => 'NCAAA New Learning Domain',
        self::TYPE_WELL_KNOWN => 'Well-Known Learning Domain',
        self::TYPE_OTHER => 'Other Learning Domain',
    );

    static $type_list_ar = array(
        self::TYPE_NCAAA_OLD => 'مجالات التعلم القديمة ل NCAAA',
        self::TYPE_NCAAA_NEW => 'مجالات التعلم الحديثة ل NCAAA',
        self::TYPE_WELL_KNOWN => 'مجالات التعلم الأكثر شهرة',
        self::TYPE_OTHER => 'غير ذلك',
    );



    
    /**
    * @return Cm_Learning_Domain_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Learning_Domain_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Learning_Domain
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
    * @return Orm_Cm_Learning_Domain[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Learning_Domain
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Learning_Domain();
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
        $db_params['ncaaa_code'] = $this->get_ncaaa_code();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['type'] = $this->get_type();

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

    public function set_ncaaa_code($value) {
        $this->add_object_field('ncaaa_code', $value);
        $this->ncaaa_code = $value;
    }

    public function get_ncaaa_code() {
        return $this->ncaaa_code;
    }

    public function get_title($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_title_ar();
        }

        return $this->get_title_en();
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
    
    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted', $value);
        $this->is_deleted = $value;
    }
    
    public function get_is_deleted() {
        return $this->is_deleted;
    }
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    public function get_type() {
        return $this->type;
    }

    /**
     * NCAAA domains depends on active language
     * @param mixed|null|string $lang
     * @return array
     */
    public static function get_ncaaa_domains($lang = UI_LANG) {
        return $lang == 'arabic' ? self::$ncaaa_domains_ar : self::$ncaaa_domains_en;
    }

    /**
     * learning domain type depends on active language
     * @param mixed|null|string $lang
     * @return array
     */
    public static function get_types($lang = UI_LANG) {
        return $lang == 'arabic' ? self::$type_list_ar : self::$type_list_en;
    }

    private $learning_outcomes = null;

    /**
     * get learning outcomes using learning domain id
     * @return Orm_Cm_Learning_Outcome[]
     */
    public function get_learning_outcomes() {

        if(is_null($this->learning_outcomes)) {
            $this->learning_outcomes = Orm_Cm_Learning_Outcome::get_all(array('learning_domain_id' => $this->get_id()));
        }

        return $this->learning_outcomes;
    }

    /**
     * name of learning domain type depends on the active language
     * @param $type
     * @return string
     */
    public function get_type_name($type){
        switch ($type){
            case self::TYPE_NCAAA_OLD:
                return UI_LANG  == 'arabic' ? 'مجالات التعلم القديمة ل NCAAA' : 'NCAAA Old Learning Domain';
                break;
            case self::TYPE_NCAAA_NEW:
                return UI_LANG  == 'arabic' ? 'مجالات التعلم الحديثة ل NCAAA' : 'NCAAA New Learning Domain';
                break;
            case self::TYPE_WELL_KNOWN:
                return UI_LANG  == 'arabic' ? 'مجالات التعلم الأكثر شهرة' : 'Well-Known Learning Domain';
                break;
            case self::TYPE_OTHER:
                return UI_LANG  == 'arabic' ? 'غير ذلك' : 'Other Learning Domain';
                break;
            default:
                return UI_LANG  == 'arabic' ? 'لا يوجد' : 'No Data';
                break;


        }

    }

}

