<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institution_Model extends CI_Model {
    
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
        
        $this->db->select('i.*');
        $this->db->distinct();
        $this->db->from(Orm_Institution::get_table_name() . ' AS i');
        
        if (isset($filters['id'])) {
            $this->db->where('i.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('i.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('i.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('i.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('i.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('i.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['univ_logo_en'])) {
            $this->db->where('i.univ_logo_en', $filters['univ_logo_en']);
        }
        if (!empty($filters['univ_logo_ar'])) {
            $this->db->where('i.univ_logo_ar', $filters['univ_logo_ar']);
        }
        if (!empty($filters['login_bg_en'])) {
            $this->db->where('i.login_bg_en', $filters['login_bg_en']);
        }
        if (!empty($filters['login_bg_ar'])) {
            $this->db->where('i.login_bg_ar', $filters['login_bg_ar']);
        }
        if (!empty($filters['cs_cover'])) {
            $this->db->where('i.cs_cover', $filters['cs_cover']);
        }
        if (!empty($filters['cr_cover'])) {
            $this->db->where('i.cr_cover', $filters['cr_cover']);
        }
        if (!empty($filters['fes_cover'])) {
            $this->db->where('i.fes_cover', $filters['fes_cover']);
        }
        if (!empty($filters['fer_cover'])) {
            $this->db->where('i.fer_cover', $filters['fer_cover']);
        }
        if (!empty($filters['ps_cover'])) {
            $this->db->where('i.ps_cover', $filters['ps_cover']);
        }
        if (!empty($filters['pr_cover'])) {
            $this->db->where('i.pr_cover', $filters['pr_cover']);
        }
        if (!empty($filters['ssr_cover'])) {
            $this->db->where('i.ssr_cover', $filters['ssr_cover']);
        }
        if (!empty($filters['sesr_cover'])) {
            $this->db->where('i.sesr_cover', $filters['sesr_cover']);
        }
        if (!empty($filters['vision_en'])) {
            $this->db->where('i.vision_en', $filters['vision_en']);
        }
        if (!empty($filters['vision_ar'])) {
            $this->db->where('i.vision_ar', $filters['vision_ar']);
        }
        if (!empty($filters['mission_en'])) {
            $this->db->where('i.mission_en', $filters['mission_en']);
        }
        if (!empty($filters['mission_ar'])) {
            $this->db->where('i.mission_ar', $filters['mission_ar']);
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
            return Orm_Institution::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Institution::to_object($row);
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
        $this->db->insert(Orm_Institution::get_table_name(), $params);
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
        return $this->db->update(Orm_Institution::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Institution::get_table_name(), array('id' => $id));
    }
    
}

