<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_Model extends CI_Model {
    
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

        $this->db->select('d.*');
        $this->db->distinct();
        $this->db->from(Orm_Department::get_table_name().' AS d');
        $this->db->where('d.is_deleted', 0);

        $this->db->join(Orm_College::get_table_name().' AS c', 'c.id = d.college_id AND c.is_deleted = 0', 'INNER');
        $this->db->join(Orm_Campus_College::get_table_name().' AS cc', 'c.id = cc.college_id', 'INNER');
        $this->db->join(Orm_Campus::get_table_name().' AS cp', 'cp.id = cc.campus_id AND cp.is_deleted = 0', 'INNER');

        License::valid_colleges('c.id');

        if (isset($filters['id'])) {
            $this->db->where('d.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('d.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('d.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('d.id', $filters['not_in_id']);
        }
        if (isset($filters['integration_id'])) {
            $this->db->where('d.integration_id', $filters['integration_id']);
        }
        if (isset($filters['campus_id'])) {
            $this->db->where('cp.id', $filters['campus_id']);
        }
        if (isset($filters['campus_in'])) {
            $this->db->where_in('cp.id', $filters['campus_in']);
        }
        if (isset($filters['college_id'])) {
            $this->db->where('c.id', $filters['college_id']);
        }
        if (!empty($filters['is_deleted'])) {
            $this->db->where('d.is_deleted', $filters['is_deleted']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('d.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('d.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('d.name_en', $filters['keyword']);
            $this->db->or_like('d.name_ar', $filters['keyword']);
            $this->db->group_end();
        }
        
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        } else {
            $orders = array('name_en');
            $this->db->order_by(implode(',', $orders));
        }
        
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Department::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:

            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Department::to_object($row);
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
        $this->db->insert(Orm_Department::get_table_name(), $params);
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
        return $this->db->update(Orm_Department::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->update(Orm_Department::get_table_name(), array('is_deleted'=>1), array('id' => (int) $id));
    }
    
}

