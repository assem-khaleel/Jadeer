<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class As_Agency_Mapping_Model extends CI_Model {
    
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
        
        $this->db->select('aam.*');
        $this->db->distinct();
        $this->db->from(Orm_As_Agency_Mapping::get_table_name().' AS aam');

	    if (!empty($filters['keyword'])) {
		    $this->db->join(Orm_College::get_table_name() . ' AS c', 'aam.college_id = c.id AND c.is_deleted = 0', 'INNER');

		    $this->db->group_start();
		    $this->db->like('c.name_en', $filters['keyword']);
		    $this->db->or_like('c.name_ar', $filters['keyword']);
		    $this->db->group_end();

            License::valid_colleges('c.id');
	    }
        
        if (isset($filters['id'])) {
            $this->db->where('aam.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('aam.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('aam.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('aam.id', $filters['not_in_id']);
        }
        if (isset($filters['college_id'])) {
            $this->db->where('aam.college_id', $filters['college_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->join(Orm_Department::get_table_name() . ' AS d', 'aam.college_id = d.college_id AND d.is_deleted = 0', 'INNER');
            $this->db->join(Orm_Program::get_table_name() . ' AS p', 'd.id = p.department_id AND p.is_deleted = 0', 'INNER');
            $this->db->where('p.id', $filters['program_id']);
            License::valid_programs('p.id');
        }
        if (isset($filters['agency_id'])) {
            $this->db->where('aam.agency_id', $filters['agency_id']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('aam.date_added', $filters['date_added']);
        }
        if (!empty($filters['date_modified'])) {
            $this->db->where('aam.date_modified', $filters['date_modified']);
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
	            return Orm_As_Agency_Mapping::to_object($this->db->get()->row_array());
	            break;
            case Orm::FETCH_OBJECTS:
	            $objects = array();
	            foreach($this->db->get()->result_array() as $row) {
	                $objects[] = Orm_As_Agency_Mapping::to_object($row);
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
        $this->db->insert(Orm_As_Agency_Mapping::get_table_name(), $params);
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
        return $this->db->update(Orm_As_Agency_Mapping::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_As_Agency_Mapping::get_table_name(), array('id' => (int) $id));
    }

}