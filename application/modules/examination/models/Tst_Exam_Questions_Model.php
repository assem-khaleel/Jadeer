<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tst_Exam_Questions_Model extends CI_Model {
    
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
        
        $this->db->select('teq.*');
        $this->db->distinct();
        $this->db->from(Orm_Tst_Exam_Questions::get_table_name() . ' AS teq');
        
        if (isset($filters['id'])) {
            $this->db->where('teq.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('teq.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('teq.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('teq.id', $filters['not_in_id']);
        }
        if (isset($filters['exam_id'])) {
            $this->db->where('teq.exam_id', $filters['exam_id']);
        }
        if (isset($filters['question_id'])) {
            $this->db->where('teq.question_id', $filters['question_id']);
        }
        if (isset($filters['mark'])) {
            $this->db->where('teq.mark', $filters['mark']);
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
            return Orm_Tst_Exam_Questions::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Tst_Exam_Questions::to_object($row);
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
        $this->db->insert(Orm_Tst_Exam_Questions::get_table_name(), $params);
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
        return $this->db->update(Orm_Tst_Exam_Questions::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Tst_Exam_Questions::get_table_name(), array('id' => $id));
    }

    public function get_mark_total($exam_id) {
        $this->db->where('exam_id', $exam_id);
        $this->db->select_sum('mark', 'marks');

        $rs = $this->db->get(Orm_Tst_Exam_Questions::get_table_name());

        return $rs->num_rows()? intval($rs->row()->marks): 0;
    }

}

