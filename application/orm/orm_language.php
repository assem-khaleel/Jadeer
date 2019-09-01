<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Language extends Orm {
    
    /**
    * @var $instances Orm_Language[]
    */
    protected static $instances = array();
    protected static $table_name = 'language';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $string = '';
    protected $line = '';
    protected $language_code = 0;
    
    /**
    * @return Language_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Language_Model');
    }
    
    /**
    * push instance
    */
    public function push_instance() {
        if ($this->id) {
            self::$instances[$this->id] = $this;
        }
    }
    
    /**
    * pull_instance
    *
    * @param array $row
    * @return array
    */
    public static function pull_instance($row) {
        
        $id = intval(isset($row['id']) ? $row['id'] : 0);
        
        if(isset(self::$instances[$id])) {
            return array(true, self::$instances[$id]);
        }
        
        return array(false, null);
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Language
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
    * @return Orm_Language[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Language
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Language();
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
        $db_params['string'] = $this->get_string();
        $db_params['line'] = $this->get_line();
        $db_params['language_code'] = $this->get_language_code();
        
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
    
    public function set_string($value) {
        $this->add_object_field('string', $value);
        $this->string = $value;
    }
    
    public function get_string() {
        return $this->string;
    }
    
    public function set_line($value) {
        $this->add_object_field('line', $value);
        $this->line = $value;
    }
    
    public function get_line() {
        return $this->line;
    }
    
    public function set_language_code($value) {
        $this->add_object_field('language_code', $value);
        $this->language_code = $value;
    }
    
    public function get_language_code() {
        return $this->language_code;
    }

    public static function generate_lang_file()
    {

        $languages = Orm::get_ci()->config->item('languages');

        if ($languages) {
            foreach ($languages as $lang_key => $lang_value) {

                $lang = array();

                $translations = self::get_all(array('language_id' => $lang_value));
                if ($translations) {
                    foreach ($translations as $translation) {
                        if ($translation->get_string()) {
                            $lang[$translation->get_string()] = ($translation->get_line() ? $translation->get_line() : $translation->get_string());
                        }
                    }
                }

                $content = "<?php \ndefined('BASEPATH') OR exit('No direct script access allowed'); \n\n";

                if ($lang) {
                    /** @var string $translation */
                    foreach ($lang as $key => $translation) {
                        $translation = str_replace("'", "\'", $translation);
                        $content .= "\$lang['{$key}'] = '{$translation}';" . "\n";
                    }
                }

                // Write the contents back to the file
                $path = APPPATH . "language/{$lang_key}";
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }

                file_put_contents("{$path}/all_lang.php", $content);
            }
        }
    }
}

