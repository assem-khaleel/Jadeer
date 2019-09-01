<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Wa_Award_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Wa_Award_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Wa_Award | Orm_Wa_Award[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('a.*');
        $this->db->distinct();
        $this->db->from(Orm_Wa_Award::get_table_name() . ' AS a');
        $this->db->where('a.is_deleted', 0);
        
        if (isset($filters['id'])) {
            $this->db->where('a.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('a.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('a.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('a.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('a.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('a.name_ar', $filters['name_ar']);
        }
        if (isset($filters['level'])) {
            $this->db->where('a.level >=', $filters['level']);
        }
        if (isset($filters['level_id'])) {
            $this->db->where('a.level_id', $filters['level_id']);
        }
        if (isset($filters['created_by'])) {
            $this->db->where('a.created_by', $filters['created_by']);
        }

        if (!empty($filters['winner_id']) && !empty($filters['candidate_id']))
        {
            $this->db->join(Orm_Wa_Winner_Award::get_table_name() . ' AS wwa', 'wwa.award_id = a.id', 'INNER');
            $this->db->join(Orm_Wa_Candidate_User::get_table_name() . ' AS wca', 'wca.award_id = a.id', 'INNER');
            $this->db->where('wwa.user_id',$filters['winner_id']);
            $this->db->or_where('wca.user_id',$filters['candidate_id']);
        }elseif (!empty($filters['winner_id'])){
            $this->db->join(Orm_Wa_Winner_Award::get_table_name() . ' AS wwa', 'wwa.award_id = a.id', 'INNER');
            $this->db->or_where('wwa.user_id',$filters['winner_id']);
        }elseif (!empty($filters['candidate_id'])){
            $this->db->join(Orm_Wa_Candidate_User::get_table_name() . ' AS wca', 'wca.award_id = a.id', 'INNER');
            $this->db->or_where('wca.user_id',$filters['candidate_id']);
        }


        if (isset($filters['date'])) {
            $this->db->where('a.date', $filters['date']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('a.description_ar', $filters['description_ar']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('a.description_en', $filters['description_en']);
        }
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('a.name_en', $filters['keyword']);
            $this->db->or_like('a.name_ar', $filters['keyword']);
            $this->db->group_end();
        }
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Wa_Award::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Wa_Award::to_object($row);
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
        $this->db->insert(Orm_Wa_Award::get_table_name(), $params);
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
        return $this->db->update(Orm_Wa_Award::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->update(Orm_Wa_Award::get_table_name(), array('is_deleted' => 1), array('id' => $id));
    }
    
}

