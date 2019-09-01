<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Evaluation_Model extends CI_Model {
    
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
        
        $this->db->select('fe.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Evaluation::get_table_name().' AS fe');
        
        if (isset($filters['id'])) {
            $this->db->where('fe.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fe.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fe.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fe.id', $filters['not_in_id']);
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('fe.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['level'])) {
            $this->db->where('fe.level', $filters['level']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('fe.user_id', $filters['user_id']);
        }
        if (!empty($filters['user_score'])) {
            $this->db->where('fe.user_score', $filters['user_score']);
        }
        if (isset($filters['peer_id'])) {
            $this->db->where('fe.peer_id', $filters['peer_id']);
        }
        if (!empty($filters['peer_score'])) {
            $this->db->where('fe.peer_score', $filters['peer_score']);
        }
        if (isset($filters['supervisor_id'])) {
            $this->db->where('fe.supervisor_id', $filters['supervisor_id']);
        }
        if (isset($filters['eva_tab_id'])) {
            $this->db->where('fe.eva_tab_id', $filters['eva_tab_id']);
        }
        if (isset($filters['eva_tab_col_id'])) {
            $this->db->where('fe.eva_tab_col_id', $filters['eva_tab_col_id']);
        }
        if (isset($filters['eva_tab_row_id'])) {
            $this->db->where('fe.eva_tab_row_id', $filters['eva_tab_row_id']);
        }
        if (!empty($filters['supervisor_score'])) {
            $this->db->where('fe.supervisor_score', $filters['supervisor_score']);
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
            return Orm_Fp_Evaluation::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Evaluation::to_object($row);
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
        $this->db->insert(Orm_Fp_Evaluation::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Evaluation::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Evaluation::get_table_name(), array('id' => (int) $id));
    }

    /**
     * @param $eva_tab_id
     * @param $user_id
     * @return mixed
     */
    public function get_avg_rows($eva_tab_id, $user_id) {
        $this->db->select_avg('user_score', 'user_score');
        $this->db->select_avg('peer_score', 'peer_score');
        $this->db->select_avg('supervisor_score', 'supervisor_score');
        $this->db->select('title_'.(UI_LANG=='arabic'? 'ar': 'en').' as title');
        $this->db->where(Orm_Fp_Evaluation::get_table_name().'.eva_tab_id', $eva_tab_id);
        $this->db->where('user_id', $user_id);
        $this->db->group_by('eva_tab_row_id');
        $this->db->join(Orm_Fp_Eva_Tab_Row::get_table_name(), 'eva_tab_row_id = '.Orm_Fp_Eva_Tab_Row::get_table_name().'.id');


        $rs = $this->db->get(Orm_Fp_Evaluation::get_table_name());

        return $rs->row();
    }

}

