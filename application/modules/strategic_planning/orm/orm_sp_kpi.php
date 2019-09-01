<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Kpi extends Orm
{

    /**
     * @var $instances Orm_Sp_Kpi[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_kpi';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $kpi_id = 0;
    protected $type_id = 0;
    protected $class_type = '';
    protected $polarity = 0;
    protected $band = 1;

    const KPI_POLARITY_POSITIVE = 1;
    const KPI_POLARITY_NEGATIVE = 2;

    const BAND_1 = 1;
    const BAND_2 = 2;
    const BAND_3 = 3;
    const BAND_4 = 4;
    const BAND_5 = 5;
    const BAND_6 = 6;

    public static $bands = array(
        self::BAND_1 => 'Band 1',
        self::BAND_2 => 'Band 2',
        self::BAND_3 => 'Band 3',
        self::BAND_4 => 'Band 4',
        self::BAND_5 => 'Band 5',
        self::BAND_6 => 'Band 6',
    );

    /**
     * @return Sp_Kpi_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Kpi_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Kpi
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
     * @return Orm_Sp_Kpi[] | int
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
     * @return Orm_Sp_Kpi
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Kpi();
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
        $db_params['kpi_id'] = $this->get_kpi_id();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['class_type'] = $this->get_class_type();
        $db_params['polarity'] = $this->get_polarity();
        $db_params['band'] = $this->get_band();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        if(!is_null($this->get_type_obj()) && $this->check_object_field('band')) {
            $this->get_type_obj()->compute_progress();
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }
    /**
     * this function get type obj
     * @return Orm_Sp_Objective | Orm_Sp_Initiative the object call function
     */
    public function get_type_obj() {

        $class_type = $this->get_class_type();
        if(!in_array($class_type, array('Orm_Sp_Objective', 'Orm_Sp_Initiative'))) {
            return null;
        }

        return $class_type::get_instance($this->get_type_id());
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

    public function set_kpi_id($value)
    {
        $this->add_object_field('kpi_id',$value);
        $this->kpi_id = $value;
    }

    public function get_kpi_id()
    {
        return $this->kpi_id;
    }

    public function set_type_id($value)
    {
        $this->add_object_field('type_id',$value);
        $this->type_id = $value;
    }

    public function get_type_id()
    {
        return $this->type_id;
    }

    public function set_class_type($value)
    {
        $this->add_object_field('class_type',$value);
        $this->class_type = $value;
    }

    public function get_class_type()
    {
        return $this->class_type;
    }

    public function set_polarity($value)
    {
        $this->add_object_field('polarity',$value);
        $this->polarity = $value;
    }

    public function get_polarity()
    {
        return $this->polarity;
    }

    public function set_band($value)
    {
        $this->add_object_field('band',$value);
        $this->band = $value;
    }

    public function get_band()
    {
        return $this->band;
    }

    /**
     * @return Orm_Kpi
     */
    public function get_kpi_obj() {
        return Orm_Kpi::get_instance($this->get_kpi_id());
    }
    /**
     * this function get indicator obj
     * @return Orm_Kpi the object call function
     */
    public function get_indicator_obj() {
        return Orm_Kpi::get_instance($this->get_kpi_id());
    }

    private $progress_lag = null;
    /**
     * this function get progress lag by its last period
     * @param bool $last_period the last period of the get progress lead to be call function
     * @return mixed the call function
     */
    public function get_progress_lag($last_period = false) {

        $period = 'current';
        if($last_period) {
            $period = 'previous';
        }

        if(!isset($this->progress_lag[$period])) {
            $this->progress_lag[$period] = Orm_Sp_Strategy::get_progress_type('kpi', $this->get_id(), 'band', $last_period);
        }

        return $this->progress_lag[$period];
    }

    private $target_lag = null;
    /**
     * this function get target lag
     * @return int|null the call function
     */
    public function get_target_lag() {

        if(is_null($this->target_lag)) {
            $this->target_lag = Orm_Sp_Strategy::get_target_type('kpi', $this->get_id());
        }

        return $this->target_lag;
    }
    /**
     * this function get status lag
     * @return string the call function
     */
    public function get_status_lag() {

        $progress = $this->get_progress_lag();
        $target = (int) $this->get_target_lag();

        $start_date = $this->get_type_obj()->get_start_date();
        $end_date = $this->get_type_obj()->get_end_date();

        return Orm_Sp_Strategy::draw_status($progress, $target, $start_date, $end_date);
    }
    /**
     * this function get trend lag
     * @return string the call function
     */
    public function get_trend_lag() {

        $progress = $this->get_progress_lag();
        $progress_last = $this->get_progress_lag(true);

        return Orm_Sp_Strategy::draw_trend($progress, $progress_last);
    }
    /**
     * this function get gauge lag
     * @return string the call function
     */
    public function draw_gauge_lag() {

        $progress = $this->get_progress_lag();

        return Orm_Sp_Strategy::draw_gauge_bands($progress);
    }
    /**
     * this function draw bands by its kpi id
     * @param int $kpi_id the kpi id of the draw bands to be call function
     * @return string the html call function
     */
    public function draw_bands($kpi_id = 0) {

        $level_label = lang('Levels');
        $settings = Orm_Kpi_Level_Settings::get_one();
        $descriptions = Orm_Kpi_Level_Description::get_kpi_descriptions($kpi_id);

        $html = '';
        $html .= "<div class='form-group'>";
        $html .= "<label for='bands' class='col-sm-2 control-label'>{$level_label}: *</label>";
        $html .= "<div class='col-sm-10'>";
        $html .= "<table class='table'>";
        $html .= "<tbody>";
        for ($i = 1; $i <= $settings->get_level(); $i++) {
            $checked = $this->get_band() == $i ? 'checked="checked"' : '';
            $html .= "<tr>";
            $html .= "<td class='col-md-1'><input type='radio' value='{$i}' class='px' name='band' {$checked}></td>";
            $html .= "<td class='col-md-2'>" . (isset($descriptions[$i]['title']) ? htmlfilter($descriptions[$i]['title']) : "{$settings->get_label()} {$i}") . "</td>";
            $html .= "<td class='col-md-9'>" . (isset($descriptions[$i]['description']) ? htmlfilter($descriptions[$i]['description']) : '') . "</td>";
            $html .= "</tr>";
        }
        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }
}