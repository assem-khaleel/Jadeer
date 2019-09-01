<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tst_Question_Model extends CI_Model {
    
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
        
        $this->db->select('tq.*');
        $this->db->distinct();
        $this->db->from(Orm_Tst_Question::get_table_name() . ' AS tq');
        
        if (isset($filters['id'])) {
            $this->db->where('tq.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('tq.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('tq.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('tq.id', $filters['not_in_id']);
        }
        if (!empty($filters['text_ar'])) {
            $this->db->where('tq.text_ar', $filters['text_ar']);
        }
        if (!empty($filters['text_en'])) {
            $this->db->where('tq.text_en', $filters['text_en']);
        }
        if (isset($filters['type'])) {
            $this->db->where('tq.type', $filters['type']);
        }
        if (isset($filters['difficulty'])) {
            $this->db->where('tq.difficulty', $filters['difficulty']);
        }
        if (isset($filters['status'])) {
            $this->db->where('tq.status', $filters['status']);
        }
        if (isset($filters['is_assignment'])) {
            $this->db->where('tq.is_assignment', $filters['is_assignment']);
        }
        if (isset($filters['can_attach'])) {
            $this->db->where('tq.can_attach', $filters['can_attach']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('tq.user_id', $filters['user_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('tq.course_id', $filters['course_id']);
        }
        if (isset($filters['only_mine']) && $filters['only_mine']) {
            $this->db->group_start();
            $this->db->where('tq.status', 3);
            $this->db->or_group_start();
            $this->db->where('tq.status', 1);
            $this->db->where('tq.user_id', Orm_User::get_logged_user_id());
            $this->db->group_end();
            $this->db->group_end();
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('tq.text_ar', $filters['keyword']);
            $this->db->or_like('tq.text_en', $filters['keyword']);
            $this->db->group_end();
        }
        if (!empty($filters['or_my_status'])) {
            $this->db->or_group_start();
            $this->db->where('tq.status', $filters['or_my_status']);
            $this->db->where('tq.user_id', Orm_User::get_logged_user_id());

            if (!empty($filters['keyword'])) {
                $this->db->group_start();
                $this->db->like('tq.text_ar', $filters['keyword']);
                $this->db->or_like('tq.text_en', $filters['keyword']);
                $this->db->group_end();
            }

            if (isset($filters['course_id'])) {
                $this->db->where('tq.course_id', $filters['course_id']);
            }

            if (isset($filters['is_assignment'])) {
                $this->db->where('tq.is_assignment', $filters['is_assignment']);
            }

            $this->db->group_end();
        }

        // Added by shamaseen
        if (!empty($filters['campus_in'])) {
            $this->db->join(Orm_Program_Plan::get_table_name() . ' AS pp', " `pp`.`course_id` = `tq`.`course_id`");
            $this->db->join(Orm_Program::get_table_name() . ' AS p', " `p`.`id` = `pp`.`program_id`");
            $this->db->join(Orm_Department::get_table_name() . ' AS d', " `d`.`id` = `p`.`department_id`");
            $this->db->join(Orm_College::get_table_name() . ' AS college', " `college`.`id` = `d`.`college_id`");
            $this->db->join(Orm_Campus_College::get_table_name() . ' AS cc', "`cc`.`college_id` = `college`.`id`");
            $this->db->where_in('cc.campus_id', $filters['campus_in']);
        }
        if (!empty($filters['college_id'])) {
            $this->db->where('college.id', $filters['college_id']);
        }
        if (!empty($filters['program_id'])) {
            $this->db->where('p.id', $filters['program_id']);
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
                $row = $this->db->get()->row_array();
            return Orm_Tst_Question::to_object($row, $row['type']);
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Tst_Question::to_object($row, (empty($row['type']) ? null : $row['type']));
            }
            return $objects;
            break;
            case Orm::FETCH_ARRAY:
            return $this->db->get()->result_array();
            break;
            case Orm::FETCH_COUNT:
//                $count = $this->db->count_all_results();
//                echo "<br> <pre>";
//                echo $this->db->last_query();
//                echo "</pre>";
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
        $this->db->insert(Orm_Tst_Question::get_table_name(), $params);
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
        return $this->db->update(Orm_Tst_Question::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Tst_Question::get_table_name(), array('id' => $id));
    }
    
}

