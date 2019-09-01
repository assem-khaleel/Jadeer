<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_College extends Orm
{

    /**
     * @var $instances Orm_College[]
     */
    protected static $instances = array();
    protected static $table_name = 'college';


    /**
     * class attributes
     */
    protected $id = 0;
    protected $integration_id = 0;
    protected $unit_id = 0;
    protected $is_deleted = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $campus_id =0;
    protected $area = 0;
    protected $size = 0;
    protected $vision_en = '';
    protected $vision_ar = '';
    protected $mission_en = '';
    protected $mission_ar = '';

    /**
     * @return College_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('College_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_College
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
     * @return Orm_College[] | int
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
     * @return Orm_College
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_College();
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
        $db_params['integration_id'] = $this->get_integration_id();
        $db_params['unit_id'] = $this->get_unit_id();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['area'] = $this->get_area();
        $db_params['size'] = $this->get_size();
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

    public function set_integration_id($value)
    {
        $this->add_object_field('integration_id',$value);
        $this->integration_id = $value;
    }

    public function get_integration_id()
    {
        return $this->integration_id;
    }

    public function set_is_deleted($value)
    {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = $value;
    }

    public function get_is_deleted()
    {
        return $this->is_deleted;
    }

    public function set_name_en($value)
    {
        $this->add_object_field('name_en',$value);
        $this->name_en = $value;
    }

    public function get_name_en()
    {
        return $this->name_en;
    }

    public function set_name_ar($value)
    {
        $this->add_object_field('name_ar',$value);
        $this->name_ar = $value;
    }

    public function get_name_ar()
    {
        return $this->name_ar;
    }

    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }

    public function set_area($value) {
        $this->add_object_field('area', $value);
        $this->area = $value;
    }

    public function get_area() {
        return $this->area;
    }

    public function set_size($value) {
        $this->add_object_field('size', $value);
        $this->size = $value;
    }

    public function get_size() {
        return $this->size;
    }

    public function get_vision($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_vision_ar();
        }
        return $this->get_vision_en();
    }

    public function set_vision_en($value) {
        $this->add_object_field('vision_en',$value);
        $this->vision_en = $value;
    }

    public function get_vision_en() {
        return $this->vision_en;
    }

    public function set_vision_ar($value) {
        $this->add_object_field('vision_ar',$value);
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
        $this->add_object_field('mission_en',$value);
        $this->mission_en = $value;
    }

    public function get_mission_en() {
        return $this->mission_en;
    }

    public function set_mission_ar($value) {
        $this->add_object_field('mission_ar',$value);
        $this->mission_ar = $value;
    }

    public function get_mission_ar() {
        return $this->mission_ar;
    }

    public function set_unit_id($value) {
        $this->add_object_field('unit_id',$value);
        $this->unit_id = $value;
    }

    public function get_unit_id() {
        return $this->unit_id;
    }

	public function draw_agency_chart($mode = 'national')
	{
		$program_count = Orm_Program::get_count(array('college_id' => $this->get_id()));

		if ($mode == 'national') {
			$factors = Orm_As_Status::$national_agencies;
		}
		else {
			$factors = Orm_As_Status::$international_agencies;
		}

		$agencies_counts = Orm_As_Status::get_model()->get_counts($this->get_id(), 'agency', array(
			'year' => Orm_Semester::get_active_semester()->get_year(),
			$mode => true,
			'without_sleep' => true
		));

		$agency_data = array();
		$counts = 0;
		foreach ($factors as $key => $agency) {
			$agency_data[$agency] = (isset($agencies_counts[$key]) && !empty($agencies_counts[$key])) ? $agencies_counts[$key] : 0;
			$counts += $agency_data[$agency];
		}
		$agency_data['sleep'] = ($program_count - $counts);


		$agency_lang = lang('Agency');
		$value = lang('Value');
		$key = "area_college_agency_". $this->get_id();

		$inputs = array();
		foreach ($agency_data as $agency => $counter) {
			$inputs[] = "['". lang($agency) ."', {$counter}]";
		}
		$out = implode(', ', $inputs);

		$colors = "'". implode("', '", Orm_As_Status::$type_color) ."'";

		$html = <<<HTML
        <div class="panel"><div class="panel-body"><div id="{$key}" style="height: 200px;"></div></div></div>
        <script>
	        function {$key}() {
				var data = google.visualization.arrayToDataTable([
					['{$agency_lang}', '{$value}'],
					{$out}
				]);

				var options = {
					pieHole: 0.4,
					colors: [{$colors}]
				};

				var chart = new google.visualization.PieChart(document.getElementById('{$key}'));
				chart.draw(data, options);
			}
			{$key}();
        </script>
HTML;

		return $html;
	}

	public function draw_status_chart($mode = 'national')
	{
		$program_count = Orm_Program::get_count(array('college_id' => $this->get_id()));

		$status_current_counts = Orm_As_Status::get_model()->get_counts($this->get_id(), 'status', array(
			'year' => Orm_Semester::get_active_semester()->get_year(),
			$mode => true
		));

		$counter = 0;
		foreach ($status_current_counts as $status => $val) {
			if ($status != Orm_As_Status::ACC_SLEEP) {
				$counter += $val;
			}
		}
		$current_sleep = $program_count - $counter;

		$status_prev_counts = Orm_As_Status::get_model()->get_counts($this->get_id(), 'status', array(
			'year' => (Orm_Semester::get_active_semester()->get_year() - 1),
			$mode => true
		));
		$counter = 0;
		foreach ($status_prev_counts as $status => $val) {
			if ($status != Orm_As_Status::ACC_SLEEP) {
				$counter += $val;
			}
		}
		$prev_sleep = $program_count - $counter;

		$status_data = array();
		foreach (Orm_As_Status::$types as $key => $status) {
			if ($key == Orm_As_Status::ACC_SLEEP) {
				$status_data[$status]['current'] = number_format(($current_sleep / $program_count) * 100, 2);
				$status_data[$status]['prev'] = number_format(($prev_sleep / $program_count) * 100, 2);
			}
			else {
				$status_data[$status]['current'] = (!empty($status_current_counts[$key])) ? number_format(($status_current_counts[$key] / $program_count) * 100, 2) : 0;
				$status_data[$status]['prev'] = (!empty($status_prev_counts[$key])) ? number_format(($status_prev_counts[$key] / $program_count) * 100, 2) : 0;
			}
			$trend = ($status_data[$status]['prev'] > 0 && $status_data[$status]['current'] > 0) ? number_format((($status_data[$status]['current'] - $status_data[$status]['prev']) / $status_data[$status]['prev']) * 100, 2) : 0;
			$status_data[$status]['trend'] = $trend;
		}

		$status_lang = lang('Status');
		$current = lang('Active Semester');
		$previous = lang('Last Semester');
		$trend = lang('Trend');
		$value = lang('Percentage');
		$key = "area_college_status_". $this->get_id();

		$inputs = array();
		foreach ($status_data as $status => $data) {
			$d = implode(', ', $data);
			$inputs[] = "['". lang($status) ."', {$d}]";
		}
		$out = implode(', ', $inputs);


		$html = <<<HTML
        <div class="panel"><div class="panel-body"><div id="{$key}" style="height: 200px;"></div></div></div>
        <script>
	        function {$key}() {
				var data = google.visualization.arrayToDataTable([
					['{$status_lang}', '{$current}', '{$previous}', '{$trend}'],
					{$out}
				]);

				var options = {
					vAxis: {title: '{$value}'},
					hAxis: {title: '{$status_lang}'},
					seriesType: 'bars',
					series: {5: {type: 'line'}},
					colors: ['#71c73e', '#d54848', '#ecad3f']
				};
				var chart = new google.visualization.ComboChart(document.getElementById('{$key}'));
				chart.draw(data, options);
			}
			{$key}();
        </script>
HTML;

		return $html;
	}

    private static $objectives = null;

    /**
     * @return Orm_College_Objective[]
     */
    public function get_objectives() {
        if(is_null(self::$objectives)) {
            self::$objectives = Orm_College_Objective::get_all(array('college_id' => $this->get_id()));
        }
        return self::$objectives;
    }

    private static $goals = null;

    /**
     * @return Orm_College_Goal[]
     */
    public function get_goals() {
        if(is_null(self::$goals)) {
            self::$goals = Orm_College_Goal::get_all(array('college_id' => $this->get_id()));
        }
        return self::$goals;
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

    public function draw_org_chart($level = 0) {

        $name = htmlfilter($this->get_name());
        $title = lang('N/A');

        $result = array('name' => $name, 'title' => $title, 'children' => array(), 'className' => 'level-'.$level);

        $roots = Orm_Unit::get_all(array('class_type' => Orm_Unit_College::class, 'parent_id' => $this->get_id()));

        if($roots) {
            foreach ($roots as $root) {
                $result['children'][] = $root->draw_org_chart($level + 1);
            }
        }

        $departments = Orm_Department::get_all(['college_id' => $this->get_id()]);

        if($departments) {
            foreach ($departments as $department) {
                $result['children'][] = $department->draw_org_chart($level + 1);
            }
        }

        return $result;
    }

    private $campus_ids = null;

    /**
     * @return array
     */
    public function get_campus_ids() {

        if(is_null($this->campus_ids)) {
            $this->campus_ids = array_column(Orm_Campus_College::get_model()->get_all(array('college_id' => $this->get_id()),0,0, [],Orm::FETCH_ARRAY), 'campus_id');
        }

        return $this->campus_ids;

    }

    private $campuses = null;

    /**
     * @return array|int|null|Orm_Campus[]
     */
    public function get_campuses() {

        if(is_null($this->campuses)) {
            $this->campuses = array();
            $campus_ids = $this->get_campus_ids();
            if($campus_ids) {
                $this->campuses = Orm_Campus::get_all(array('in_id' => $campus_ids));
            }
        }

        return $this->campuses;

    }
}