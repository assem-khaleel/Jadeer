<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Unit extends Orm
{

	/**
	 * @var $instances Orm_Unit[]
	 */
	protected static $instances = array();
	protected static $table_name = 'unit';

	/**
	 * class attributes
	 */
	protected $id = 0;
	protected $integration_id = 0;
	protected $parent_id = 0;
	protected $is_deleted = 0;
	protected $name_en = '';
	protected $name_ar = '';
	protected $class_type = '';
	protected $is_academic = '';
	protected $vision_en = '';
	protected $vision_ar = '';
	protected $mission_en = '';
	protected $mission_ar = '';

	const UNIT_ACADEMIC = 1;
	const UNIT_NONE_ACADEMIC = 0;

	/**
	 * @return Unit_Model
	 */
	public static function get_model()
	{
		return Orm::get_ci_model('Unit_Model');
	}

	/**
	 * get instance
	 *
	 * @param int $id
	 * @return Orm_Unit
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
	 * @return Orm_Unit[] | int
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
	 * @return Orm_Unit
	 */
	public static function get_one($filters = array(), $orders = array())
	{

		/** @var Orm_Unit $result */
		$result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

		if ($result && $result->get_id()) {
			return $result;
		}

		return new static();
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
		$db_params['parent_id'] = $this->get_parent_id();
		$db_params['is_deleted'] = $this->get_is_deleted();
		$db_params['name_en'] = $this->get_name_en();
		$db_params['name_ar'] = $this->get_name_ar();
		$db_params['class_type'] = $this->get_class_type();
		$db_params['is_academic'] = $this->get_is_academic();
		$db_params['vision_en'] = $this->get_vision_en();
		$db_params['vision_ar'] = $this->get_vision_ar();
		$db_params['mission_en'] = $this->get_mission_en();
		$db_params['mission_ar'] = $this->get_mission_ar();

		return $db_params;
	}

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

	public function delete()
	{
		return self::get_model()->delete($this->get_id());
	}

	public function set_id($value)
	{
		$this->add_object_field('id', $value);
		$this->id = $value;
		$this->push_instance();
	}

	public function get_id()
	{
		return $this->id;
	}

	public function set_integration_id($value)
	{
		$this->add_object_field('integration_id', $value);
		$this->integration_id = $value;
	}

	public function get_integration_id()
	{
		return $this->integration_id;
	}

	public function set_parent_id($value)
	{
		$this->add_object_field('parent_id', $value);
		$this->parent_id = $value;
	}

	public function get_parent_id()
	{
		return $this->parent_id;
	}

	public function set_is_deleted($value)
	{
		$this->add_object_field('is_deleted', $value);
		$this->is_deleted = $value;
	}

	public function get_is_deleted()
	{
		return $this->is_deleted;
	}

	public function set_name_en($value)
	{
		$this->add_object_field('name_en', $value);
		$this->name_en = $value;
	}

	public function get_name_en()
	{
		return $this->name_en;
	}

	public function set_name_ar($value)
	{
		$this->add_object_field('name_ar', $value);
		$this->name_ar = $value;
	}

	public function get_name_ar()
	{
		return $this->name_ar;
	}


	public function get_vision($lang = UI_LANG)
	{
		if ($lang == 'arabic') {
			return $this->get_vision_ar();
		}
		return $this->get_vision_en();
	}

	public function set_vision_en($value)
	{
		$this->add_object_field('vision_en', $value);
		$this->vision_en = $value;
	}

	public function get_vision_en()
	{
		return $this->vision_en;
	}

	public function set_vision_ar($value)
	{
		$this->add_object_field('vision_ar', $value);
		$this->vision_ar = $value;
	}

	public function get_vision_ar()
	{
		return $this->vision_ar;
	}

	public function get_mission($lang = UI_LANG)
	{
		if ($lang == 'arabic') {
			return $this->get_mission_ar();
		}
		return $this->get_mission_en();
	}

	public function set_mission_en($value)
	{
		$this->add_object_field('mission_en', $value);
		$this->mission_en = $value;
	}

	public function get_mission_en()
	{
		return $this->mission_en;
	}

	public function set_mission_ar($value)
	{
		$this->add_object_field('mission_ar', $value);
		$this->mission_ar = $value;
	}

	public function get_mission_ar()
	{
		return $this->mission_ar;
	}

	public function set_class_type($value)
	{
		$this->add_object_field('class_type', $value);
		$this->class_type = $value;
	}

	public function get_class_type()
	{
		return $this->class_type;
	}

	public function set_is_academic($value)
	{
		$this->add_object_field('is_academic', $value);
		$this->is_academic = $value;
	}

	public function get_is_academic()
	{
		return $this->is_academic;
	}

	public function get_name($lang = UI_LANG)
	{
		return $lang == 'english' ? $this->get_name_en() : $this->get_name_ar();
	}

	private static $objectives = null;

	/**
	 * @return Orm_Unit_Objective[]
	 */
	public function get_objectives()
	{
		if (is_null(self::$objectives)) {
			self::$objectives = Orm_Unit_Objective::get_all(array('unit_id' => $this->get_id()));
		}
		return self::$objectives;
	}

	private static $goals = null;

	/**
	 * @return Orm_Unit_Goal[]
	 */
	public function get_goals()
	{
		if (is_null(self::$goals)) {
			self::$goals = Orm_Unit_Goal::get_all(array('unit_id' => $this->get_id()));
		}
		return self::$goals;
	}

	public function draw_mission()
	{
		return Orm::get_ci()->load->view('setup/mission/view', array('object' => $this), true);
	}

	public function draw_vision()
	{
		return Orm::get_ci()->load->view('setup/vision/view', array('object' => $this), true);
	}

	public function draw_goals()
	{
		return Orm::get_ci()->load->view('setup/goal/view', array('object' => $this), true);
	}

	public function draw_objectives()
	{
		return Orm::get_ci()->load->view('setup/objective/view', array('object' => $this), true);
	}

	public static function class_types()
	{
		$types[] = Orm_Unit_Rector::class;
		$types[] = Orm_Unit_Vice_Rector::class;
		$types[] = Orm_Unit_College::class;
		$types[] = Orm_Unit_Admin::class;

		return $types;
	}

	private $children = array();
	private static $prepared_children = false;

	public function prepare_children()
	{
		if (!self::$prepared_children) {
			$nodes = self::get_all(['not_class_type' => Orm_Unit_College::class]);

			if ($nodes) {
				foreach ($nodes as $node) {
					if ($node->get_parent_id()) {
						$parent = self::get_instance($node->get_parent_id());
						$parent->add_child($node);
					}
				}
			}

			self::$prepared_children = true;
		}

		return $this;
	}

	public function add_child(Orm_Unit $node)
	{
		$this->children[$node->get_id()] = $node;
	}

	/**
	 *
	 * @return Orm_Unit[]
	 */
	public function get_children()
	{
		return $this->prepare_children()->children;
	}

	public function draw_org_chart($level = 1)
	{

		$name = htmlfilter($this->get_name());
		$title = $this->get_unit_head()->get_user_id() ? htmlfilter($this->get_unit_head()->get_user_obj()->get_full_name()) : lang('N/A');

		$result = array('name' => $name, 'title' => $title, 'children' => array(), 'className' => 'level-' . $level);

		$colleges = Orm_College::get_all(['unit_id' => $this->get_id()]);

		if ($this->get_children() || !empty($colleges)) {

			foreach ($this->get_children() as $child) {
				$result['children'][] = $child->draw_org_chart($level + 1);
			}

			foreach ($colleges as $college) {
				$result['children'][] = $college->draw_org_chart($level + 1);
			}
		}

		return $result;
	}

	public function draw_parents()
	{
		return '';
	}

	public function get_unit_head()
	{
		return Orm_Unit_Log::get_one(array(
			'unit_id' => $this->get_id(),
			'year' => Orm_Semester::get_active_semester()->get_year()
		));
	}

	public static function draw_find_unit($fltr=[], $page=1,$per_page=5, $unit_id=0)
	{
		$html='';
		$html .= '<div id="search-unit">';
		if($unit_id!=0){
			$unit=self::get_instance($unit_id);
			$html.="<div class='col-sm-12'>";
			$html.="<span id='unit_label'>{$unit->get_name()}</span>";
			$html.="<input type='hidden' name='unit' id='selected_unit' value='{$unit_id}'>";
			$html.="</div>";
		}else{

			$html.="<div class='col-sm-12'>";
			$html.=" <p id='unit_label' class='text-light-gray'>".lang('Unit Not Selected')."</p>";
			$html.="<input type='hidden' name='unit' id='selected_unit' value='0'>";
			$html.="</div>";
		}

		//All Units

		$html .= '<div class="form-group">';
		$html .= '<div class="row">';
		$html .= '<div class="col-sm-9">';
		$html .= '<input type="text" id="keyword" placeholder="' . lang('Search') . '" name="fltr[keyword]" class="form-control" value="' . (isset($fltr['keyword']) ? $fltr['keyword'] : '') . '" />';
		$html .=Validator::get_html_error_message('unit');
		$html .= '</div>';
		$html .= '<div class="col-sm-3">';
		$html .= '<button type="button" class="btn btn-block"
										data-loading-text="<span class=\'fa fa-spinner fa-spin\'></span>"
										onclick="search(this);">' . lang('Search') . '</button>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="form-group">';

		$html .= '<div class="table-responsive m-a-0">';
		$html .= '<table class="table table-bordered">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th>' . lang('All Units');
		$html .= '</th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';


		$pager = new Pager(array('url' => "/Unit/load_unit?unit_id=$unit_id"));
		$pager->set_page($page);
		$pager->set_per_page($per_page);
		$pager->set_total_count(self::get_count($fltr));
		$pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="search-unit"');
		$units = self::get_all($fltr, $page, $per_page);

		if (!empty($units)) {
			foreach ($units as $unit) {
				$html .= '<td><div class="checkbox m-b-0"><label>';
				$html .= '<input type="radio" class="unit_select" name="unit" value="' . (int)$unit->get_id() . '" ' . ($unit_id == $unit->get_id() ? 'checked="checked"' : '') . '/>';
				$html .= '<span style="word-break: break-all" class="until-label m-l-3" data-id="'.(int)$unit->get_id().'"  title="' . htmlfilter($unit->get_name()) . '">' . htmlfilter($unit->get_name()) . '</span>';
				$html .= '</label></div></td>';
				$html .= '</tr>';
			}
		} else {
			$html .= '<div class="alert alert-default"><div class="m-b-1">' . lang('There are no').' '.lang('units') . '</div></div>';
		}

		$html .= '</tbody>';
		$html .= '</table>';
		if ($pager) {
			$html .= $pager->render(true);
		}
		$html .= '</div>';

		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}
}

