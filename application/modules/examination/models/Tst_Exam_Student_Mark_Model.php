<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tst_Exam_Student_Mark_Model extends CI_Model {
    
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

        $this->db->distinct();
        $this->db->from(Orm_Tst_Exam_Student_Mark::get_table_name() . ' AS tesm');
        
        if (isset($filters['id'])) {
            $this->db->where('tesm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('tesm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('tesm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('tesm.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('tesm.user_id', $filters['user_id']);
        }
        if (isset($filters['question_id'])) {
            $this->db->where('tesm.question_id', $filters['question_id']);
        }
        if (isset($filters['exam_id'])) {
            $this->db->where('tesm.exam_id', $filters['exam_id']);
        }
        if (isset($filters['student_mark'])) {
            $this->db->select(['tesm.user_id', 'tesm.exam_id']);
            $this->db->select_sum('tesm.mark', 'mark');
            $this->db->group_by(['tesm.user_id', 'tesm.exam_id']);

            if (isset($filters['mark'])) {
                $this->db->having('sum(tesm.mark)', $filters['mark']);
            }

            if (isset($filters['between_mark'])) {
                $this->db->having("sum(tesm.mark) between '". implode("' and '", $filters['between_mark'])."'");
            }

            if (isset($filters['greater_equal_mark'])) {
                $this->db->having('sum(tesm.mark) >=', $filters['greater_equal_mark']);
            }
        }
        else {
            $this->db->select('tesm.*');
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
            return Orm_Tst_Exam_Student_Mark::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Tst_Exam_Student_Mark::to_object($row);
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
        $this->db->insert(Orm_Tst_Exam_Student_Mark::get_table_name(), $params);
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
        return $this->db->update(Orm_Tst_Exam_Student_Mark::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Tst_Exam_Student_Mark::get_table_name(), array('id' => $id));
    }
   /** get average of mark for the student
   */
    function get_mark_average($filter = [])
    {
        $this->db->select('AVG(mark) as average');
        $this->db->from(Orm_Tst_Exam_Student_Mark::get_table_name() . ' AS sm ');
        if(!empty($filter['exam_id']))
        {
            $this->db->where('exam_id', $filter['exam_id']);
        }

        $result = $this->db->get()->row()->average;

        return  $result ? $result : 0;
    }


    /** get max mark for the student
    */
    public function get_max($exam_id) {
        $sql = "select max(mark_sum) as mark_max from 
(select sum(mark) as mark_sum from ".Orm_Tst_Exam_Student_Mark::get_table_name()." where exam_id=? group by user_id) as tab";

        $rs = $this->db->query($sql, [$exam_id]);

        if($rs->num_rows()){
            return $rs->row()->mark_max;
        }

        return 0;
    }

    /** get minimum mark for the student
    */
    public function get_min($exam_id) {
        $sql = "select min(mark_sum) as mark_min from 
(select sum(mark) as mark_sum from ".Orm_Tst_Exam_Student_Mark::get_table_name()." where exam_id=? group by user_id) as tab";

        $rs = $this->db->query($sql, [$exam_id]);

        if($rs->num_rows()){
            return $rs->row()->mark_min;
        }

        return 0;
    }


    /** get the median mark for the student
    */
    public function get_median($exam_id) {
        $sql = "select sum(mark) as mark_sum from ".Orm_Tst_Exam_Student_Mark::get_table_name()." where exam_id=? group by user_id order by mark_sum";

        $rs = $this->db->query($sql, [$exam_id]);

        if($num_rows = $rs->num_rows()){
            if($num_rows % 2==1) {
                return $rs->row(intval($num_rows / 2))->mark_sum;
            }

            $median = ($rs->row($num_rows / 2-1)->mark_sum + $rs->row($num_rows / 2)->mark_sum)/2;
            return $median;
        }

        return 0;
    }

}

