<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thread_Group_Model extends CI_Model {
    
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
        
        $this->db->select('tg.*');
        $this->db->distinct();
        $this->db->from(Orm_Thread_Group::get_table_name() . ' AS tg');
        
        if (isset($filters['id'])) {
            $this->db->where('tg.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('tg.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('tg.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('tg.id', $filters['not_in_id']);
        }
        if (!empty($filters['group_name_ar'])) {
            $this->db->where('tg.group_name_ar', $filters['group_name_ar']);
        }
        if (!empty($filters['group_desc_en'])) {
            $this->db->where('tg.group_desc_en', $filters['group_desc_en']);
        }
        if (isset($filters['creator_id'])) {
            $this->db->where('tg.creator_id', $filters['creator_id']);
        }
        if (!empty($filters['group_name_en'])) {
            $this->db->where('tg.group_name_en', $filters['group_name_en']);
        }
        if (!empty($filters['group_desc_ar'])) {
            $this->db->where('tg.group_desc_ar', $filters['group_desc_ar']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('tg.group_name_en', $filters['keyword']);
            $this->db->or_like("tg.group_name_ar", $filters['keyword']);
            $this->db->or_like("tg.group_desc_en", $filters['keyword']);
            $this->db->or_like("tg.group_desc_ar", $filters['keyword']);
            $this->db->group_end();
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
            return Orm_Thread_Group::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Thread_Group::to_object($row);
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
        $this->db->insert(Orm_Thread_Group::get_table_name(), $params);
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
        return $this->db->update(Orm_Thread_Group::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        $this->db->delete(Orm_Thread_Group_Members::get_table_name(), array('group_id' => $id));
        return $this->db->delete(Orm_Thread_Group::get_table_name(), array('id' => $id));
    }
    
}

