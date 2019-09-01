<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Wa_Winner_Award_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Wa_Winner_Award_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Wa_Winner_Award | Orm_Wa_Winner_Award[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;


        $this->db->select('wa.*');
		$this->db->join(Orm_Wa_Award::get_table_name() . ' AS w', 'w.id = wa.award_id');
        $this->db->distinct();
        $this->db->from(Orm_Wa_Winner_Award::get_table_name() . ' AS wa');


        if (isset($filters['award_id'])) {
            $this->db->where('wa.award_id', $filters['award_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('wa.user_id', $filters['user_id']);
        }
        if (!empty($filters['created_by'])){
            $this->db->or_where('w.created_by',$filters['created_by']);
        }
        if (isset($filters['id'])) {
            $this->db->where('wa.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('wa.id !=', $filters['not_id']);
        }
        if (isset($filters['level'])) {
            $this->db->where('w.level >=', $filters['level']);
        }
        if (isset($filters['level_id'])) {
            $this->db->where('w.level_id =', $filters['level_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('wa.id', $filters['in_id']);
        }
        if (!empty($filters['coll'])) {
            $this->db->where_in('wa.award_id', $filters['award_ids']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('wa.id', $filters['not_in_id']);
        }

        if (!empty($filters['winner_id'])){
            $this->db->where('wa.user_id',$filters['winner_id']);
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('w.name_en', $filters['keyword']);
            $this->db->or_like('w.name_ar', $filters['keyword']);
            $this->db->join(Orm_User::get_table_name(),'As user where user.id = wa.user_id','inner');
            $this->db->or_like("CONCAT(user.first_name, ' ' ,user.last_name)", $filters['keyword']);
            $this->db->group_end();
        }
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Wa_Winner_Award::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Wa_Winner_Award::to_object($row);
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
        $this->db->insert(Orm_Wa_Winner_Award::get_table_name(), $params);
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
        return $this->db->update(Orm_Wa_Winner_Award::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Wa_Winner_Award::get_table_name(), array('id' => $id));
    }
    
}

