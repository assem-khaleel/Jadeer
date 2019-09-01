<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Strategy extends Orm
{

    /**
     * @var $instances Orm_Sp_Strategy[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_strategy';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $strategy_id = 0;
    protected $parent_id = 0;
    protected $parent_lft = 0;
    protected $parent_rgt = 0;
    protected $item_class = '';
    protected $item_id = 0;
    protected $start_year = 0;
    protected $year = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $vision_en = '';
    protected $vision_ar = '';
    protected $mission_en = '';
    protected $mission_ar = '';
    protected $description_en = '';
    protected $description_ar = '';
    protected $lead = 0;
    protected $lag = 0;
    //
    private $children = array();
    private static $prepare_children = false;
    private static $active_strategy;

    /**
     * @return Sp_Strategy_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Strategy_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Strategy
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
     * @return Orm_Sp_Strategy[] | int
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
     * @return Orm_Sp_Strategy
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Strategy();
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
        $db_params['strategy_id'] = $this->get_strategy_id();
        $db_params['parent_id'] = $this->get_parent_id();
        $db_params['parent_lft'] = $this->get_parent_lft();
        $db_params['parent_rgt'] = $this->get_parent_rgt();
        $db_params['item_class'] = $this->get_item_class();
        $db_params['item_id'] = $this->get_item_id();
        $db_params['start_year'] = $this->get_start_year();
        $db_params['year'] = $this->get_year();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['vision_en'] = $this->get_vision_en();
        $db_params['vision_ar'] = $this->get_vision_ar();
        $db_params['mission_en'] = $this->get_mission_en();
        $db_params['mission_ar'] = $this->get_mission_ar();
        $db_params['description_en'] = $this->get_description_en();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['lead'] = $this->get_lead();
        $db_params['lag'] = $this->get_lag();

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

    /**
     * @return $this
     */
    public function prepare_children()
    {
        if(!self::$prepare_children) {

            $strategies = self::get_all(array('strategy_id' => $this->get_strategy_id(), 'parent_lft' => $this->get_parent_lft(), 'parent_rgt' => $this->get_parent_rgt()));

            if ($strategies) {
                foreach ($strategies as $strategy) {
                    if ($strategy->get_parent_id()) {
                        $parent = self::get_instance($strategy->get_parent_id());
                        $parent->add_child($strategy);
                    }
                }
            }

            self::$prepare_children = true;
        }

        return $this;
    }

    public function add_child(Orm_Sp_Strategy $strategy) {
        $this->children[$strategy->get_id()] = $strategy;
    }

    /**
     * @return Orm_Sp_Strategy[]
     */
    public function get_children()
    {
        return $this->prepare_children()->children;
    }

    /**
     * @return Orm_Sp_Strategy
     */
    public function reset_children()
    {
        self::$prepare_children = false;
        return $this;
    }

    /**
     *
     */
    public function build_parent_tree() {
        self::get_model()->build_parent_tree($this->get_strategy_id());
    }

    /**
     * @return Orm_Sp_Strategy[]
     */
    public function get_children_strategies()
    {
        return array();
    }

    /**
     * @return int
     */
    public function validate_strategy_exist() {
        return $this->get_count(array(
            'strategy_id' => $this->get_strategy_id(),
            'item_class' => $this->get_item_class(),
            'item_id' => $this->get_item_id(),
            'parent_id' => $this->get_parent_id()
        ));
    }

    /**
     *
     */
    public function generate()
    {
        if (!$this->validate_strategy_exist()) {
            $id = $this->save();
        }


        $children = $this->get_children_strategies();
        if ($children) {
            foreach ($children as $child) {
                $child->set_parent_id($id);
                $child->set_year($this->get_year());
                $child->set_strategy_id($this->get_strategy_id());
                $child->generate();
            }
        }
    }

    /**
     * @return int
     */
    public function get_performance(){
        $filters = array();
        $filters['strategy_id'] = $this->get_strategy_id();
        $filters['parent_lft'] = $this->get_parent_lft();
        $filters['parent_rgt'] = $this->get_parent_rgt();

        return self::get_count($filters);
    }

    /**
     * return Orm_Sp_Strategy
     */
    public function get_parent_obj()
    {
        return self::get_instance($this->get_parent_id());
    }

    /**
     * @param $progress
     * @param $target
     * @param $start_date
     * @param $end_date
     * @return string
     */
    public static function draw_status($progress, $target, $start_date, $end_date) {

        $period_date = Orm_Sp_Strategy::get_period_date();

        $status = '<i class="fa fa-exclamation-circle text-warning font-size-52"></i>';

        if ($period_date >= $start_date) {
            if ($progress >= $target && $target != 0) {
                $status = '<i class="fa fa-check-circle text-success font-size-52"></i>';
            } else {
                if ($period_date > $end_date) {
                    $status = '<i class="fa fa-times-circle text-danger font-size-52"></i>';
                }
            }
        }

        return $status;
    }

    /**
     * @param $progress
     * @param $progress_old
     * @return string
     */
    public static function draw_trend($progress, $progress_old) {

        $trend = '<i class="fa fa-arrows-h text-warning font-size-52"></i>';
        if($progress > $progress_old) {
            $trend = '<i class="fa fa-arrow-up text-success font-size-52"></i>';
        } elseif($progress < $progress_old) {
            $trend = '<i class="fa fa-arrow-down text-danger font-size-52"></i>';
        }

        return $trend;

    }

    /**
     * @param $progress
     * @param $target
     * @return string
     */
    public static function draw_gauge($progress, $target) {

        $progress = round($progress, 2);

        $id = uniqid('gauge_');

        $target_half = $target / 2;

        $html = <<<HTML
        <div id="{$id}" style="display: block; margin: 0 auto; width: 80px;"></div>
        <script>
            
            if (typeof google.visualization === 'undefined') {
                google.setOnLoadCallback(drawChart_{$id});
            } else {
                drawChart_{$id}();
            }

            function drawChart_{$id}() {
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['', {$progress}]
                ]);
                var options = {
                    width: 80, height: 80,
                    greenFrom: {$target},greenTo:100,
                    yellowFrom:{$target_half}, yellowTo: {$target},
                    redFrom: 0, redTo: {$target_half},
                    minorTicks: 5
                };
                var chart = new google.visualization.Gauge(document.getElementById('{$id}'));
                chart.draw(data, options);
            }
        </script>
HTML;

        return $html;
    }

    /**
     * @param $progress
     * @return string
     */
    public static function draw_gauge_bands($progress) {

        $progress = round($progress);

        $id = uniqid('gauge_bands_');

        $html = <<<HTML
        <div id="{$id}" style="display: block; margin: 0 auto; width: 100px;"></div>
        <script>
        
            if (typeof google.visualization === 'undefined') {
                google.setOnLoadCallback(drawChart_{$id});
            } else {
                drawChart_{$id}();
            }
            
            function drawChart_{$id}() {
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['Band {$progress}', {$progress}]
                ]);
                var options = {
                    width: 100,
                    height: 80,
                    bar: { groupWidth: "40%" },
                    legend: { position: "none" },
                    vAxis: {
                        minValue: 0, maxValue: 6,
                        ticks: [0,1,2,3,4,5,6]
                    }
                };
                var chart = new google.visualization.ColumnChart(document.getElementById('{$id}'));
                chart.draw(data, options);
            }
        </script>
HTML;

        return $html;
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

    public function set_strategy_id($value)
    {
        $this->add_object_field('strategy_id',$value);
        $this->strategy_id = $value;
    }

    public function get_strategy_id()
    {
        return $this->strategy_id;
    }

    public function set_parent_id($value)
    {
        $this->add_object_field('parent_id',$value);
        $this->parent_id = $value;
    }

    public function get_parent_id()
    {
        return $this->parent_id;
    }

    public function set_parent_lft($value)
    {
        $this->add_object_field('parent_lft',$value);
        $this->parent_lft = $value;
    }

    public function get_parent_lft()
    {
        return $this->parent_lft;
    }

    public function set_parent_rgt($value)
    {
        $this->add_object_field('parent_rgt',$value);
        $this->parent_rgt = $value;
    }

    public function get_parent_rgt()
    {
        return $this->parent_rgt;
    }

    public function set_item_class($value)
    {
        $this->add_object_field('item_class',$value);
        $this->item_class = $value;
    }

    public function get_item_class()
    {
        return $this->item_class;
    }

    public function set_item_id($value)
    {
        $this->add_object_field('item_id',$value);
        $this->item_id = $value;
    }

    public function get_item_id()
    {
        return $this->item_id;
    }

    public function get_start_year()
    {
        return $this->start_year;
    }

    public function set_start_year($value)
    {
        $this->add_object_field('start_year',$value);
        $this->start_year= $value;
    }

    public function set_year($value)
    {
        $this->add_object_field('year',$value);
        $this->year = $value;
    }

    public function get_year()
    {
        return $this->year;
    }

    public function set_title_en($value)
    {
        $this->add_object_field('title_en',$value);
        $this->title_en = $value;
    }

    public function get_title_en()
    {
        return $this->title_en;
    }

    public function set_title_ar($value)
    {
        $this->add_object_field('title_ar',$value);
        $this->title_ar = $value;
    }

    public function get_title_ar()
    {
        return $this->title_ar;
    }

    public function set_vision_en($value)
    {
        $this->add_object_field('vision_en',$value);
        $this->vision_en = $value;
    }

    public function get_vision_en()
    {
        return $this->vision_en;
    }

    public function set_vision_ar($value)
    {
        $this->add_object_field('vision_ar',$value);
        $this->vision_ar = $value;
    }

    public function get_vision_ar()
    {
        return $this->vision_ar;
    }

    public function set_mission_en($value)
    {
        $this->add_object_field('mission_en',$value);
        $this->mission_en = $value;
    }

    public function get_mission_en()
    {
        return $this->mission_en;
    }

    public function set_mission_ar($value)
    {
        $this->add_object_field('mission_ar',$value);
        $this->mission_ar = $value;
    }

    public function get_mission_ar()
    {
        return $this->mission_ar;
    }

    public function set_description_en($value)
    {
        $this->add_object_field('description_en',$value);
        $this->description_en = $value;
    }

    public function get_description_en()
    {
        return $this->description_en;
    }

    public function set_description_ar($value)
    {
        $this->add_object_field('description_ar',$value);
        $this->description_ar = $value;
    }

    public function get_description_ar()
    {
        return $this->description_ar;
    }

    public function set_lead($value)
    {
        $this->add_object_field('lead',$value);
        $this->lead = $value;
    }

    public function get_lead()
    {
        return $this->lead;
    }

    public function set_lag($value)
    {
        $this->add_object_field('lag',$value);
        $this->lag = $value;
    }

    public function get_lag()
    {
        return $this->lag;
    }

    /**
     * return Orm_Sp_Strategy
     */
    public function get_system_obj()
    {
        return self::get_instance($this->get_strategy_id());
    }

    /**
     * @return Orm_Institution | Orm_Unit | Orm_College | Orm_Program
     */
    public function get_item_obj() { }

    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }

    public function get_vision($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_vision_ar() : $this->get_vision_en();
    }

    public function get_mission($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_mission_ar() : $this->get_mission_en();
    }

    public function get_description($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_description_ar() : $this->get_description_en();
    }

    private $values = null;

    /**
     * @return Orm_Sp_Values[]
     */
    public function get_values() {
        if(is_null($this->values)) {
            $this->values = Orm_Sp_Values::get_all(array('strategy_id' => $this->get_id()));
        }
        return $this->values;
    }

    private $goals = null;

    /**
     * @return Orm_Sp_Goal[]
     */
    public function get_goals() {
        if(is_null($this->goals)) {
            $this->goals = Orm_Sp_Goal::get_all(array('strategy_id' => $this->get_id()));
        }
        return $this->goals;
    }

    /**
     * @param Orm_Sp_Strategy|null $start_node
     * @return int
     */
    public function get_indentation_level(Orm_Sp_Strategy $start_node = null)
    {

        if (!is_null($start_node) && $start_node == $this) {
            return 0;
        }

        if ($this->get_parent_id()) {
            return $this->get_parent_obj()->get_indentation_level($start_node) + 1;
        }
        return 0;
    }

    /**
     * @return int
     */
    public function get_goals_count() {
        return Orm_Sp_Goal::get_count(array('strategy_id' => $this->get_id()));
    }

    /**
     * @return int
     */
    public function get_objective_count() {
        return Orm_Sp_Objective::get_count(array('strategy_id' => $this->get_id()));
    }

    /**
     * @return int
     */
    public function get_initiative_count() {
        return Orm_Sp_Initiative::get_count(array('strategy_id' => $this->get_id()));
    }

    /**
     * @return int
     */
    public function get_action_plan_count() {
        return Orm_Sp_Action_Plan::get_count(array('strategy_id' => $this->get_id()));
    }

    /**
     * @return int
     */
    public function get_project_count() {
        return Orm_Sp_Project::get_count(array('strategy_id' => $this->get_id()));
    }

    /**
     * @return int
     */
    public function get_activity_count() {
        return Orm_Sp_Activity::get_count(array('strategy_id' => $this->get_id()));
    }

    /**
     * @return string
     */
    public function get_start_date(){
        return self::get_model()->get_date_range($this->get_id(), 'start_date');
    }

    public function get_end_date(){
        return self::get_model()->get_date_range($this->get_id(), 'end_date');
    }

    /**
     * @return Orm_Sp_Strategy
     */
    public static function get_active_strategy() {

        if(empty(self::$active_strategy)) {

            $filters = array();
            $filters['parent_id'] = 0;
            $filters['year_less_than'] = Orm_Semester::get_active_semester()->get_year();

            self::$active_strategy = self::get_one($filters, array('ss.year ASC'));
        }

        return self::$active_strategy;
    }
    /**
     * this function get progress type by its table and table id abd type and last period
     * @param string $table the table of the get progress type to be call function
     * @param int $table_id the table id of the get progress type to be call function
     * @param string $type the type of the get progress type to be call function
     * @param bool $last_period the last period of the get progress type to be call function
     * @return int the call function
     */
    public static function get_progress_type($table, $table_id, $type = 'lead', $last_period = false) {
        return self::get_model()->get_progress_type($table, $table_id, $type, $last_period);
    }
    /**
     * this function get target type by its table and table id
     * @param string $table the table of the get target type to be call function
     * @param int $table_id the table id of the get target type to be call function
     * @return int the call function
     */
    public static function get_target_type($table, $table_id) {
        return self::get_model()->get_target_type($table, $table_id);
    }
    /**
     * this function get period date by its last period
     * @param bool $last_period the last period of the get period date to be call function
     * @return false|string the call function
     */
    public static function get_period_date($last_period = false) {

        $period_mode = Orm::get_ci()->input->get('period_mode');
        $period_year = (int) Orm::get_ci()->input->get('period_year');
        $period_value =(int) Orm::get_ci()->input->get('period_value');

        if(empty($period_mode)) {
            $period_mode = 'Year';
        }

        if(empty($period_year)) {
            $period_year = date('Y');
        }

        if(empty($period_value)) {
            $period_value = 1;
        }

        switch($period_mode) {
            case 'Year':

                if($last_period) {
                    $period_year -= 1;
                }

                $period_date = "{$period_year}-12-31";
                break;
            case 'Month':

                if($last_period) {
                    $period_value -= 1;

                    if($period_value === 0) {
                        $period_value = 12;
                        $period_year -= 1;
                    }
                }

                $period_date = date("Y-m-t", strtotime("{$period_year}-{$period_value}-01"));
                break;
            case 'Quarter':

                if($last_period) {
                    $period_value -= 1;

                    if($period_value === 0) {
                        $period_value = 4;
                        $period_year -= 1;
                    }
                }

                switch($period_value) {
                    case 1:
                        $period_date = "{$period_year}-03-31";
                        break;
                    case 2:
                        $period_date = "{$period_year}-06-30";
                        break;
                    case 3:
                        $period_date = "{$period_year}-09-30";
                        break;
                    case 4:
                        $period_date = "{$period_year}-12-31";
                        break;
                }
                break;
        }

        return $period_date;
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
            $this->progress_lag[$period] = Orm_Sp_Strategy::get_progress_type('strategy', $this->get_id(), 'lag', $last_period);
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
            $this->target_lag = Orm_Sp_Strategy::get_target_type('strategy', $this->get_id());
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

        return Orm_Sp_Strategy::draw_status($progress, $target, $this->get_start_date(), $this->get_end_date());
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
    public function draw_gauge_lag($perspective = null) {

        if(is_null($perspective)) {

            $progress = $this->get_progress_lag();

        } else {

            $total_lag = 0;
            $total_weight = 0;

            foreach (Orm_Sp_Objective::get_all(array('strategy_id' => $this->get_id(), 'perspective' => $perspective)) as $objective) {
                $total_lag += $objective->get_lag();
                $total_weight += 1;
            }

            $progress = $total_weight ? $total_lag / $total_weight : 0;

        }

        return Orm_Sp_Strategy::draw_gauge_bands($progress);
    }

    private $progress_lead = null;
    /**
     * this function get progress lead by its last period
     * @param bool $last_period the last period of the get progress lead to be call function
     * @return mixed the call function
     */
    public function get_progress_lead($last_period = false) {

        $period = 'current';
        if($last_period) {
            $period = 'previous';
        }

        if(!isset($this->progress_lead[$period])) {
            $this->progress_lead[$period] = Orm_Sp_Strategy::get_progress_type('strategy', $this->get_id(), 'lead', $last_period);
        }

        return $this->progress_lead[$period];
    }

    private $target_lead = null;
    /**
     * this function get target lead
     * @return int|null the call function
     */
    public function get_target_lead() {

        if(is_null($this->target_lead)) {
            $this->target_lead = Orm_Sp_Strategy::get_target_type('strategy', $this->get_id());
        }

        return $this->target_lead;
    }
    /**
     * this function get status lead
     * @return string the call function
     */
    public function get_status_lead() {

        $progress = $this->get_progress_lead();
        $target = (int) $this->get_target_lead();

        return Orm_Sp_Strategy::draw_status($progress, $target, $this->get_start_date(), $this->get_end_date());
    }
    /**
     * this function get trend lead
     * @return string the call function
     */
    public function get_trend_lead() {

        $progress = $this->get_progress_lead();
        $progress_last = $this->get_progress_lead(true);

        return Orm_Sp_Strategy::draw_trend($progress, $progress_last);
    }
    /**
     * this function draw gauge lead
     * @return string the call function
     */
    public function draw_gauge_lead($perspective = null) {

        if(is_null($perspective)) {

            $progress = $this->get_progress_lead();

        } else {

            $total_lead = 0;
            $total_weight = 0;

            foreach (Orm_Sp_Objective::get_all(array('strategy_id' => $this->get_id(), 'perspective' => $perspective)) as $objective) {
                $total_lead += $objective->get_lead();
                $total_weight += 1;
            }

            $progress = $total_weight ? $total_lead / $total_weight : 0;

        }

        $target = (int) $this->get_target_lead();

        return Orm_Sp_Strategy::draw_gauge($progress, $target);
    }

    public function compute_progress() {
        $this->set_lead($this->compute_progress_lead());
        $this->set_lag($this->compute_progress_lag());
        $this->save();
    }
    /**
     * this function compute progress lag
     * @return float|int the call function
     */
    public function compute_progress_lag() {
        $progress = 0;

        if($this->get_goals()) {

            $total_lag = 0;
            $total_weight = 0;

            foreach ($this->get_goals() as $goal) {
                $total_lag += $goal->get_lag();
                $total_weight += 1;
            }

            $progress = $total_weight ? $total_lag / $total_weight : 0;
        }

        return $progress;
    }
    /**
     * this function compute progress lead
     * @return float|int the call function
     */
    public function compute_progress_lead() {
        $progress = 0;

        if($this->get_goals()) {

            $total_lead = 0;
            $total_weight = 0;

            foreach ($this->get_goals() as $goal) {
                $total_lead += $goal->get_lead();
                $total_weight += 1;
            }

            $progress = $total_weight ? $total_lead / $total_weight : 0;
        }

        return $progress;
    }
    /**
     * this function get objectives
     * @return int|Orm_Sp_Objective[] the call function
     */
    public function get_objectives() {
        return Orm_Sp_Objective::get_all(array('strategy_id' => $this->get_id()));
    }

    /**
     * this function get perspectives
     * @return Orm_Sp_Objective_Perspective[] the object call function
     */
    public function get_perspectives() {
        return self::get_model()->get_perspectives($this->get_id());
    }


}

