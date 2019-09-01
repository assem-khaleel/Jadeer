<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class As_Status_Model extends CI_Model {

	/**
	 * get table rows according to the assigned filters and page
	 *
	 * @param array $filters
	 * @param int $page
	 * @param int $per_page
	 * @param array $orders
	 * @param int $fetch_as
	 *
	 * @return array
	 */
	public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

		$page = (int) $page;
		$per_page = (int) $per_page;

		if (!empty($filters['chart'])) {

			$this->db->select('IF(ass.id, ass.id, uuid()) id');
			$this->db->select('ass.agency');
			$this->db->select('p.id program_id');
			$this->db->select('ass.status');
			$this->db->select('ass.status_date');
			$this->db->select('ass.note');
			$this->db->select('ass.quality_coordinator');
			$this->db->select('ass.program_chair');
			$this->db->select('ass.chair_name');
			$this->db->select('ass.chair_phone');
			$this->db->select('ass.chair_email');
			$this->db->select('ass.dean');
			$this->db->select('ass.dean_name');
			$this->db->select('ass.dean_email');
			$this->db->select('ass.dean_phone');
			$this->db->select('ass.year');
			$this->db->select('ass.attachment');
			$this->db->select('ass.date_added');
			$this->db->select('ass.date_modified');

			$agency_where = '';
			if (!empty($filters['agency'])) {
				$agency = intval($filters['agency']);
				$agency_where = " AND ass.agency = {$agency}";
			}

			$college_where = '';
			if (!empty($filters['college_id'])) {
				$college_id = intval($filters['college_id']);
				$college_where = " AND c.id = {$college_id}";
			}

			$this->db->distinct();
			$this->db->from(Orm_As_Status::get_table_name().' AS ass');

            $this->db->join(Orm_Program::get_table_name() . ' AS p', "ass.program_id = p.id AND p.is_deleted = 0 {$agency_where}", 'RIGHT');
            $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id AND d.is_deleted = 0', 'INNER');
            $this->db->join(Orm_College::get_table_name() . ' AS c', 'c.id = d.college_id AND c.is_deleted = 0', 'INNER');
            $this->db->join(Orm_Campus_College::get_table_name().' AS cc', 'c.id = cc.college_id', 'INNER');
            $this->db->join(Orm_Campus::get_table_name().' AS cp', "cp.id = cc.campus_id AND cp.is_deleted = 0 {$college_where}", 'INNER');

            License::valid_colleges('c.id');
            License::valid_programs('p.id');

			if (!empty($filters['status'])) {
				if($filters['status'] == Orm_As_Status::ACC_SLEEP) {
					$this->db->where('ass.status IS NULL', null, false);
				} else {
					$this->db->where('ass.status', $filters['status']);
				}
			}

		} else {
			$this->db->select('ass.*');
			$this->db->distinct();
			$this->db->from(Orm_As_Status::get_table_name().' AS ass');

			if (isset($filters['id'])) {
				$this->db->where('ass.id', $filters['id']);
			}
			if (isset($filters['not_id'])) {
				$this->db->where('ass.id !=', $filters['not_id']);
			}
			if (!empty($filters['in_id'])) {
				$this->db->where_in('ass.id', $filters['in_id']);
			}
			if (!empty($filters['not_in_id'])) {
				$this->db->where_not_in('ass.id', $filters['not_in_id']);
			}
			if (!empty($filters['agency'])) {
				$this->db->where('ass.agency', $filters['agency']);
			}
			if (isset($filters['college_id'])) {
                $this->db->join(Orm_Program::get_table_name() . ' AS p', "ass.program_id = p.id AND p.is_deleted = 0", 'INNER');
                $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id AND d.is_deleted = 0', 'INNER');

				$this->db->where('d.college_id', $filters['college_id']);

                License::valid_colleges('d.college_id');
                License::valid_programs('p.id');
			}
			if (isset($filters['program_id'])) {
				$this->db->where('ass.program_id', $filters['program_id']);
			}
			if (!empty($filters['status'])) {
				$this->db->where('ass.status', $filters['status']);
			}
			if (!empty($filters['status_date'])) {
				$this->db->where('ass.status_date', $filters['status_date']);
			}
			if (!empty($filters['note'])) {
				$this->db->where('ass.note', $filters['note']);
			}
			if (!empty($filters['quality_coordinator'])) {
				$this->db->where('ass.quality_coordinator', $filters['quality_coordinator']);
			}
			if (!empty($filters['program_chair'])) {
				$this->db->where('ass.program_chair', $filters['program_chair']);
			}
			if (!empty($filters['chair_name'])) {
				$this->db->where('ass.chair_name', $filters['chair_name']);
			}
			if (!empty($filters['chair_phone'])) {
				$this->db->where('ass.chair_phone', $filters['chair_phone']);
			}
			if (!empty($filters['chair_email'])) {
				$this->db->where('ass.chair_email', $filters['chair_email']);
			}
			if (!empty($filters['dean'])) {
				$this->db->where('ass.dean', $filters['dean']);
			}
			if (!empty($filters['dean_name'])) {
				$this->db->where('ass.dean_name', $filters['dean_name']);
			}
			if (!empty($filters['dean_email'])) {
				$this->db->where('ass.dean_email', $filters['dean_email']);
			}
			if (!empty($filters['dean_phone'])) {
				$this->db->where('ass.dean_phone', $filters['dean_phone']);
			}
			if (!empty($filters['year'])) {
				$this->db->where('ass.year', $filters['year']);
			}
			if (!empty($filters['attachment'])) {
				$this->db->where('ass.attachment', $filters['attachment']);
			}
			if (!empty($filters['accredited'])) {
				$this->db->where('ass.accredited', $filters['accredited']);
			}
			if (!empty($filters['date_added'])) {
				$this->db->where('ass.date_added', $filters['date_added']);
			}
			if (!empty($filters['date_modified'])) {
				$this->db->where('ass.date_modified', $filters['date_modified']);
			}
		}

		if ($orders) {
			$this->db->order_by(implode(',', $orders));
		}

		if ($page) {
			$offset = ($page - 1) * $per_page;
			$this->db->limit($per_page, $offset);
		}

		switch($fetch_as) {
			case Orm::FETCH_OBJECT:
				return Orm_As_Status::to_object($this->db->get()->row_array());
				break;
			case Orm::FETCH_OBJECTS:
				$objects = array();
				foreach($this->db->get()->result_array() as $row) {
					$objects[] = Orm_As_Status::to_object($row);
				}
				return $objects;
				break;
			case Orm::FETCH_ARRAY:
				return $this->db->get()->result_array();
				break;
			case Orm::FETCH_COUNT:
				return $this->db->count_all_results();
				break;
		}
	}

	/**
	 * insert new row to the table
	 *
	 * @param array $params
	 * @return int
	 */
	public function insert($params = array()) {
		$this->db->insert(Orm_As_Status::get_table_name(), $params);
		return $this->db->insert_id();
	}

	/**
	 * update item
	 *
	 * @param int $id
	 * @param array $params
	 * @return boolean
	 */
	public function update($id, $params = array()) {
		return $this->db->update(Orm_As_Status::get_table_name(), $params, array('id' => (int) $id));
	}

	/**
	 * delete item
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function delete($id) {
		return $this->db->delete(Orm_As_Status::get_table_name(), array('id' => (int) $id));
	}

}