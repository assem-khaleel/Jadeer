<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rm_Room_Management_Model extends CI_Model {
    
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
        
        $this->db->select('rrm.*');
        $this->db->distinct();
        $this->db->from(Orm_Rm_Room_Management::get_table_name() . ' AS rrm');

        $this->db->join(Orm_College::get_table_name().' AS c', 'c.id = rrm.college_id AND c.is_deleted = 0', 'INNER');
        $this->db->join(Orm_Campus_College::get_table_name().' AS cc', 'c.id = cc.college_id', 'INNER');
        $this->db->join(Orm_Campus::get_table_name().' AS cp', 'cp.id = cc.campus_id AND cp.is_deleted = 0', 'INNER');


        if (isset($filters['id'])) {
            $this->db->where('rrm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('rrm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('rrm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('rrm.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('rrm.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('rrm.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_like'])) {
            $this->db->like('rrm.name_en', $filters['name_like']);
        }
        if (isset($filters['room_number'])) {
            $this->db->where('rrm.room_number', $filters['room_number']);
        }
        if (isset($filters['campus_id'])) {
            $this->db->where('cp.id', $filters['campus_id']);
        }
        if (isset($filters['college_id'])) {
            $this->db->where('rrm.college_id', $filters['college_id']);
        }
        if (isset($filters['room_type'])) {
            $this->db->where('rrm.room_type', $filters['room_type']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('rrm.name_ar', $filters['keyword']);
            $this->db->or_like('rrm.name_en', $filters['keyword']);
            $this->db->or_like('room_number', $filters['keyword']);
            $this->db->group_end();
        }
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        $this->db->order_by('id', 'desc');
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Rm_Room_Management::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Rm_Room_Management::to_object($row);
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
        $this->db->insert(Orm_Rm_Room_Management::get_table_name(), $params);
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
        return $this->db->update(Orm_Rm_Room_Management::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Rm_Room_Management::get_table_name(), array('id' => $id));
    }
    
}

