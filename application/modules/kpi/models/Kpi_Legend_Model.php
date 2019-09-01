<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_Legend_Model extends CI_Model {
    
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
        
        $this->db->select('kl.*');
        $this->db->distinct();
        $this->db->from(Orm_Kpi_Legend::get_table_name().' AS kl');
        
        if (isset($filters['id'])) {
            $this->db->where('kl.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('kl.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('kl.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('kl.id', $filters['not_in_id']);
        }
        if (!empty($filters['title'])) {
            $this->db->where('kl.title', $filters['title']);
        }
        if (isset($filters['level_id'])) {
            $this->db->where('kl.level_id', $filters['level_id']);
        }
        if (isset($filters['kpi_id'])) {
            $this->db->join(Orm_Kpi_Level::get_table_name().' AS klv','kl.level_id = klv.id','left');
            $this->db->where('klv.kpi_id', $filters['kpi_id']);
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
            return Orm_Kpi_Legend::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Kpi_Legend::to_object($row);
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
        $this->db->insert(Orm_Kpi_Legend::get_table_name(), $params);
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
        return $this->db->update(Orm_Kpi_Legend::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Kpi_Legend::get_table_name(), array('id' => (int) $id));
    }

    /**
     * @param $filters
     * @return object
     */
    public function delete_all($filters) {
        if (isset($filters['id_in'])) {
            $this->db->where_in('id', $filters['id_in']);
        }
        if (isset($filters['level_id'])) {
            $this->db->where('level_id', $filters['level_id']);
        }
        if (isset($filters['legend_in'])) {
            $this->db->where_in('title', $filters['legend_in']);
        }
        if (isset($filters['legend_not_in'])) {
            $this->db->where_not_in('title', $filters['legend_not_in']);
        }
        return $this->db->delete(Orm_Kpi_Legend::get_table_name());
    }
    
}

