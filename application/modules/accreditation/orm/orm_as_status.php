<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_As_Status extends Orm {

	/**
	 * @var $instances Orm_As_Status[]
	 */
	protected static $instances = array();
    protected static $table_name = 'as_status';


	/**
	 * class attributes
	 */
	protected $id = 0;
	protected $agency = '';
	protected $program_id = 0;
	protected $status = self::ACC_SLEEP;
	protected $status_date = '0000-00-00';
	protected $note = '';
	protected $quality_coordinator = 0;
	protected $program_chair = 0;
	protected $chair_name = '';
	protected $chair_phone = '';
	protected $chair_email = '';
	protected $dean = 0;
	protected $dean_name = '';
	protected $dean_email = '';
	protected $dean_phone = '';
	protected $year = 0;
	protected $attachment = '';
	protected $accredited = 0;
	protected $date_added = '0000-00-00 00:00:00';
	protected $date_modified = '0000-00-00 00:00:00';

	const ACC_SLEEP = 1;
	const ACC_INACTIVE = 2;
	const ACC_ACTIVE = 3;
	const ACC_SUBMITTED = 4;
	const ACC_VISITED = 5;
	const ACC_ACCREDITED = 6;
	const ACC_NOT_ACCREDITED = 7;

	public static $types = array(
		self::ACC_SLEEP 			=> array('name' => 'Sleep', 'color' => '#b68b68', 'disc' => 'This program has not yet started the accreditation process.'),
		self::ACC_INACTIVE 			=> array('name' => 'Inactive', 'color' => '#9d9d9d', 'disc' => 'This program has some accreditation activities but is not yet qualified to apply for accreditation.'),
		self::ACC_ACTIVE 			=> array('name' => 'Active', 'color' => '#618b9d', 'disc' => 'This program is currently working on filling for accreditation.'),
		self::ACC_SUBMITTED 		=> array('name' => 'Submitted', 'color' => '#a946e8', 'disc' => 'This program has filed for accreditation.'),
		self::ACC_VISITED 			=> array('name' => 'Visited', 'color' => '#36a766', 'disc' => 'This program has been visited by the accreditation agency.'),
		self::ACC_ACCREDITED 		=> array('name' => 'Accredited', 'color' => '#ecad3f', 'disc' => 'This program is accredited.'),
		self::ACC_NOT_ACCREDITED 	=> array('name' => 'Not Accredited', 'color' => '#ffd700', 'disc' => 'This program is not accredited.')
	);

	public static function get_type($type, $attr = null) {

		if(!is_null($attr)) {
			return isset(self::$types[$type][$attr]) ? self::$types[$type][$attr] : null;
		}

		return isset(self::$types[$type]) ? self::$types[$type] : null;
	}

	/**
	 * @return As_Status_Model
	 */
	public static function get_model() {
		return Orm::get_ci_model('As_Status_Model');
	}

	/**
	 * get instance
	 *
	 * @param int $id
	 * @return Orm_As_Status
	 */
	public static function get_instance($id) {

		$id = intval($id);
		if(isset(self::$instances[$id])) {
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

	 * @return Orm_As_Status[] | int
	 */
	public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
		return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
	}

	/**
	 * get one Object
	 *
	 * @param array $filters
	 * @param array $orders
	 * @return Orm_As_Status
	 */
	public static function get_one($filters = array(), $orders = array()) {

		/* @var Orm_As_Status $result */
		$result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

		if ($result && $result->get_id()) {
			return $result;
		}

		return new Orm_As_Status();
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
		$db_params['agency'] = $this->get_agency();
		$db_params['program_id'] = $this->get_program_id();
		$db_params['status'] = $this->get_status();
		$db_params['status_date'] = $this->get_status_date();
		$db_params['note'] = $this->get_note();
		$db_params['quality_coordinator'] = $this->get_quality_coordinator();
		$db_params['program_chair'] = $this->get_program_chair();
		$db_params['chair_name'] = $this->get_chair_name();
		$db_params['chair_phone'] = $this->get_chair_phone();
		$db_params['chair_email'] = $this->get_chair_email();
		$db_params['dean'] = $this->get_dean();
		$db_params['dean_name'] = $this->get_dean_name();
		$db_params['dean_email'] = $this->get_dean_email();
		$db_params['dean_phone'] = $this->get_dean_phone();
		$db_params['year'] = $this->get_year();
		$db_params['attachment'] = $this->get_attachment();
		$db_params['accredited'] = $this->get_accredited();
		$db_params['date_added'] = $this->get_date_added();
		$db_params['date_modified'] = $this->get_date_modified();

		return $db_params;
	}

    public function save() {
        if ($this->get_object_status() == 'new') {
            $this->set_date_added(date('Y-m-d H:i:s'));

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

	public function set_agency($value) {
		$this->add_object_field('agency', $value);
		$this->agency = $value;
	}

	public function get_agency() {
		return $this->agency;
	}

	public function get_agency_obj() {
		return Orm_As_Agency::get_instance($this->get_agency());
	}

	public function set_program_id($value) {
		$this->add_object_field('program_id', $value);
		$this->program_id = $value;
	}

	public function get_program_id() {
		return $this->program_id;
	}

	public function get_program_obj() {
		return Orm_Program::get_instance($this->get_program_id());
	}

	public function set_status($value) {
		$this->add_object_field('status', $value);
		$this->status = $value;
	}

	public function get_status($attr = null) {

		if(empty($this->status)) {
			$this->status = self::ACC_SLEEP;
		}

		if(!is_null($attr)) {
			return isset(self::$types[$this->status][$attr]) ? self::$types[$this->status][$attr] : '';
		}

		return $this->status;
	}

	public function set_status_date($value) {
		$this->add_object_field('status_date', $value);
		$this->status_date = $value;
	}

	public function get_status_date() {
		return $this->status_date;
	}

	public function set_note($value) {
		$this->add_object_field('note', $value);
		$this->note = $value;
	}

	public function get_note() {
		return $this->note;
	}

	public function set_quality_coordinator($value) {
		$this->add_object_field('quality_coordinator', $value);
		$this->quality_coordinator = $value;
	}

	public function get_quality_coordinator() {
		return $this->quality_coordinator;
	}

	public function set_program_chair($value) {
		$this->add_object_field('program_chair', $value);
		$this->program_chair = $value;
	}

	public function get_program_chair() {
		return $this->program_chair;
	}

	public function set_chair_name($value) {
		$this->add_object_field('chair_name', $value);
		$this->chair_name = $value;
	}

	public function get_chair_name() {
		return $this->chair_name;
	}

	public function set_chair_phone($value) {
		$this->add_object_field('chair_phone', $value);
		$this->chair_phone = $value;
	}

	public function get_chair_phone() {
		return $this->chair_phone;
	}

	public function set_chair_email($value) {
		$this->add_object_field('chair_email', $value);
		$this->chair_email = $value;
	}

	public function get_chair_email() {
		return $this->chair_email;
	}

	public function set_dean($value) {
		$this->add_object_field('dean', $value);
		$this->dean = $value;
	}

	public function get_dean() {
		return $this->dean;
	}

	public function set_dean_name($value) {
		$this->add_object_field('dean_name', $value);
		$this->dean_name = $value;
	}

	public function get_dean_name() {
		return $this->dean_name;
	}

	public function set_dean_email($value) {
		$this->add_object_field('dean_email', $value);
		$this->dean_email = $value;
	}

	public function get_dean_email() {
		return $this->dean_email;
	}

	public function set_dean_phone($value) {
		$this->add_object_field('dean_phone', $value);
		$this->dean_phone = $value;
	}

	public function get_dean_phone() {
		return $this->dean_phone;
	}

	public function set_year($value) {
		$this->add_object_field('year', $value);
		$this->year = $value;
	}

	public function get_year() {
		return $this->year;
	}

	public function set_attachment($value) {
		$this->add_object_field('attachment', $value);
		$this->attachment = $value;
	}

	public function get_attachment() {
		return $this->attachment;
	}

	public function set_accredited($value) {
		$this->add_object_field('accredited', $value);
		$this->accredited = $value;
	}

	public function get_accredited() {
		return $this->accredited;
	}

	public function set_date_added($value) {
		$this->add_object_field('date_added', $value);
		$this->date_added = $value;
	}

	public function get_date_added() {
		return $this->date_added;
	}

	public function set_date_modified($value) {
		$this->add_object_field('date_modified', $value);
		$this->date_modified = $value;
	}

	public function get_date_modified() {
		return $this->date_modified;
	}

	public function get_attachment_link() {
		return "/accreditation/status/agency_download/{$this->get_id()}";
	}

}