<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Category_Model extends CI_Model {
    
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

        $this->db->select('pt.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Category::get_table_name() . ' AS pt');
        $this->db->where('pt.deleted', 0);


        if (isset($filters['id'])) {
            $this->db->where('pt.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pt.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pt.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pt.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('pt.course_id', $filters['course_id']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('pt.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('pt.title_en', $filters['title_en']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('pt.description_ar', $filters['description_ar']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('pt.description_en', $filters['description_en']);
        }
        if (isset($filters['deleted'])) {
            $this->db->where('pt.deleted', $filters['deleted']);
        }
        if (isset($filters['level'])) {
            $this->db->where('pt.level', $filters['level']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('pt.title_ar', $filters['keyword']);
            $this->db->or_like('pt.title_en', $filters['keyword']);
            $this->db->or_like('pt.description_ar', $filters['keyword']);
            $this->db->or_like('pt.description_en', $filters['keyword']);
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
            return Orm_Pc_Category::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Category::to_object($row);
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
        $this->db->insert(Orm_Pc_Category::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Category::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Category::get_table_name(), array('id' => $id));
    }
    
}

