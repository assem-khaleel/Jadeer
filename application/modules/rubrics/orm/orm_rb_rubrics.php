<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rb_Rubrics extends Orm
{

    /**
     * @var $instances Orm_Rb_Rubrics[]
     */
    protected static $instances = array();
    protected static $table_name = 'rb_rubrics';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $desc_en = '';
    protected $desc_ar = '';
    protected $rubric_class = '';
    protected $weight_type = 0;
    protected $extra_data = '';
    protected $rubric_type = 0;
    protected $creator = 0;
    protected $publisher = 0;
    protected $start_date = 0;
    protected $end_date = 0;
    protected $date_added = 0;
    protected $date_modified = 0;
    protected $is_deleted = 0;


    const RUBRIC_TYPE_SUMMATIVE = 1;
    const RUBRIC_TYPE_FORMATIVE = 2;


    const WEIGHT_TYPE_POINTS = 1;
    const WEIGHT_TYPE_PERCENTAGE = 2;


    /**
     * @return Rb_Rubrics_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Rb_Rubrics_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Rb_Rubrics
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
     * Get all rows as Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Rb_Rubrics[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Rb_Rubrics
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Rb_Rubrics();
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
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();
        $db_params['rubric_class'] = $this->get_rubric_class();
        $db_params['weight_type'] = $this->get_weight_type();
        $db_params['extra_data'] = $this->get_extra_data();
        $db_params['rubric_type'] = $this->get_rubric_type();
        $db_params['creator'] = $this->get_creator();
        $db_params['publisher'] = $this->get_publisher();
        $db_params['start_date'] = $this->get_start_date(true);
        $db_params['end_date'] = $this->get_end_date(true);
        $db_params['date_added'] = $this->get_date_added(true);
        $db_params['date_modified'] = $this->get_date_modified(true);
        $db_params['is_deleted'] = $this->get_is_deleted();

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

    public function set_desc_en($value)
    {
        $this->add_object_field('desc_en', $value);
        $this->desc_en = $value;
    }

    public function get_desc_en()
    {
        return $this->desc_en;
    }

    public function set_desc_ar($value)
    {
        $this->add_object_field('desc_ar', $value);
        $this->desc_ar = $value;
    }

    public function get_desc_ar()
    {
        return $this->desc_ar;
    }

    public function set_rubric_class($value)
    {
        $this->add_object_field('rubric_class', $value);
        $this->rubric_class = $value;
    }

    public function get_rubric_class()
    {
        return $this->rubric_class;
    }

    public function set_weight_type($value)
    {
        $this->add_object_field('weight_type', $value);
        $this->weight_type = $value;
    }

    public function get_weight_type()
    {
        return $this->weight_type;
    }

    public function set_extra_data($value)
    {
        $this->add_object_field('extra_data', $value);
        $this->extra_data = $value;
    }

    public function get_extra_data()
    {
        return $this->extra_data;
    }

    public function set_rubric_type($value)
    {
        $this->add_object_field('rubric_type', $value);
        $this->rubric_type = $value;
    }

    public function get_rubric_type()
    {
        return $this->rubric_type;
    }

    public function set_creator($value)
    {
        $this->add_object_field('creator', $value);
        $this->creator = $value;
    }

    public function get_creator()
    {
        return $this->creator;
    }

    public function set_publisher($value)
    {
        $this->add_object_field('publisher', $value);
        $this->publisher = $value;
    }

    public function get_publisher()
    {
        return $this->publisher;
    }

    public function set_start_date($value)
    {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }

    public function get_start_date($int = false)
    {
        if ($int) {
            return $this->start_date;
        }
        return date('Y-m-d', $this->start_date);
    }

    public function set_end_date($value)
    {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }

    public function get_end_date($int = false)
    {
        if ($int) {
            return $this->end_date;
        }
        return date('Y-m-d', $this->end_date);
    }

    public function set_date_added($value)
    {
        $this->add_object_field('date_added', $value);
        $this->date_added = $value;
    }

    public function get_date_added($int = false)
    {
        if ($int) {
            return $this->date_added;
        }
        return $this->date_added;
    }

    public function set_date_modified($value)
    {
        $this->add_object_field('date_modified', $value);
        $this->date_modified = $value;
    }

    public function get_date_modified($int = false)
    {
        if ($int) {
            return $this->date_modified;
        }
        return $this->date_modified;
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

    /**
     * @return Orm_Rb_Scale[]
     */
    public function get_scales()
    {
        return Orm_Rb_Scale::get_all(['rubrics_id' => $this->get_id()]);
    }

    /**
     * @param null $id
     *
     * @return Orm_Rb_Skills|Orm_Rb_Skills[]
     */
    public function get_skills($id = null)
    {
        if ($id) {
            return Orm_Rb_Skills::get_one(['rubrics_id' => $this->get_id(), 'id' => $id]);
        }
        return Orm_Rb_Skills::get_all(['rubrics_id' => $this->get_id()], 0, 0, ['id']);
    }

    /**
     * @return Orm_Rb_Table[]
     */
    public function get_table($skill_id = null)
    {

        $wh['rubrics_id'] = $this->get_id();
        if ($skill_id) {
            $wh['skill_id'] = $skill_id;
        }

        return Orm_Rb_Table::get_all($wh, 0, 0, ['skill_id']);
    }

    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }

    public function get_desc($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_desc_ar();
        }
        return $this->get_desc_en();
    }

    /**
     * @return bool
     */
    public function can_manage()
    {
        if (!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, ['rubrics-admin'])) {
            return true;
        }

        if (!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'rubrics-manage')) {
            return false;
        }

        if (Orm_User::get_logged_user_id() != $this->get_creator()) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public static function is_valid()
    {
        return true;
    }

    /**
     * @return array
     */
    public static function get_classes()
    {
        return [
            Orm_Rb_Rubrics_Course::class,
            Orm_Rb_Rubrics_Service::class,
            Orm_Rb_Rubrics_User::class,
        ];
    }

    /**
     * @param int $type
     * @return array|mixed
     */
    public static function get_type($type = 0)
    {
        $types = [
            Orm_Rb_Rubrics::RUBRIC_TYPE_SUMMATIVE => lang('Summative'),
            Orm_Rb_Rubrics::RUBRIC_TYPE_FORMATIVE => lang('Formative')
        ];

        if ($type) {
            return $types[$type];
        }

        return $types;
    }

    /**
     * @param string $error
     * @param string $value
     * @return string
     */
    public static function get_properties($error = '', $value = '')
    {
        return "<div class='alert alert-warning m-a-0'>" . lang('Please Choose One Of Rubric Classification') . "</div>";
    }

    public function has_answer()
    {
        return boolval(Orm_Rb_Result::get_one(['rubric_id' => $this->get_id()])->get_id());
    }

    /**
     * @return string
     */
    public function draw()
    {
        return '';
    }

    /**
     * @param $skill_ids
     */
    public function delete_skills_not_in($skill_ids)
    {
        Modules::load('industrial_skills');
        if (count($skill_ids)) {
            foreach (Orm_Rb_Table::get_all(['rubric_id' => $this->get_id(), 'not_in_skill_id' => $skill_ids]) as $row) {
                $row->delete();
            }

            foreach (Orm_Rb_Skills::get_all(['rubrics_id' => $this->get_id(), 'not_in_id' => $skill_ids]) as $row) {
                $row->delete();
            }
            foreach (Orm_Is_Industrial_Relation::get_all(['not_in_rubric_row_id' => $skill_ids]) as $row) {
                $row->delete();
            }
        }
    }

    /**
     * @return bool
     */
    public function is_published()
    {
        return $this->get_start_date(true) && $this->get_end_date(true);
    }

    /**
     * @return bool
     */
    public function is_start()
    {
        return $this->is_published() && $this->get_start_date(true) < time() && $this->get_end_date(true) > time();
    }

    /**
     * @return bool
     */
    public function is_end()
    {
        return $this->is_published() && $this->get_end_date(true) < time();
    }
    /**
     * this function get invitation form by its view params
     * @param array $view_params the view params of the get invitation form to be call function
     * @return string the call function
     */
    public function get_invitation_form($view_params)
    {
        // do nothing
        return '';
    }
    /**
     * this function has invitation
     * @return bool the call function
     */
    public function has_invitation()
    {
        return true;
    }

    /**
     * this function set evaluation by its view params
     * @param array $view_params the view params of the set evaluation to be call function
     * @return string the call function
     */
    public function set_evaluation($view_params)
    {
        // do nothing
    }

    /**
     * this function check invitation
     * @return void the call function
     */
    public function check_invitation()
    {
        // do nothing
    }

    /**
     * this function get evaluation
     * @return int|Orm_Rb_Evaluations[] the object call function
     */
    public function get_evaluation()
    {
        return Orm_Rb_Evaluations::get_all(['rubrics_id' => $this->get_id()]);
    }
    /**
     * this function  answer draw
     * @return string the call function
     */
    public function answer_draw()
    {
        return '';
    }
    /**
     * this function ready to publish
     * @return bool the call function
     */
    public function ready_to_publish()
    {

        if (!Orm_Rb_Skills::get_one(['rubrics_id' => $this->get_id()])->get_id()) {
            return false;
        }

        if ($this->get_weight_type() == static::WEIGHT_TYPE_PERCENTAGE) {

            $total = 0;

            foreach (Orm_Rb_Skills::get_all(['rubrics_id' => $this->get_id()]) as $skill) {
                $total += $skill->get_value();
            }

            if ($total != 100) {
                return false;
            }
        }

        if (Orm_Rb_Skills::get_one(['rubrics_id' => $this->get_id(), 'or_name_en' => '', 'or_name_ar' => '', 'or_value' => '0'])->get_id()) {
            return false;
        }

        if (Orm_Rb_Scale::get_one(['rubrics_id' => $this->get_id(), 'or_name_en' => '', 'or_name_ar' => '', 'or_weight' => '0'])->get_id()) {
            return false;
        }

        $scales = Orm_Rb_Scale::get_count(['rubrics_id' => $this->get_id()]);
        $skills = Orm_Rb_Skills::get_count(['rubrics_id' => $this->get_id()]);

        if (Orm_Rb_Table::get_count(['rubric_id' => $this->get_id()]) != $scales * $skills) {
            return false;
        }

        if (Orm_Rb_Table::get_one(['rubrics_id' => $this->get_id(), 'target' => 0])->get_id()) {
            return false;
        }


        return true;

    }
}

