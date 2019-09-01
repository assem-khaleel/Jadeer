<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tst_Exam_Model extends CI_Model {
    
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
        
        $this->db->select('te.*');
        $this->db->distinct();
        $this->db->from(Orm_Tst_Exam::get_table_name() . ' AS te');
        $this->db->where('te.is_deleted', 0);
        
        if (isset($filters['id'])) {
            $this->db->where('te.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('te.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('te.id', $filters['in_id']);
        }

        // Added by shamaseen : select first member of the array because the array is nested
        if (!empty($filters['campus_in'][0])) {
            $this->db->join(Orm_Program_Plan::get_table_name() . ' AS pp', " `pp`.`course_id` = `te`.`course_id`");
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


        if (!empty($filters['in_course_id'])) {
            $this->db->where_in('te.course_id', $filters['in_course_id']);
        }
        if (!empty($filters['section_id'])) {
            $this->db->like('te.sections', '"'.$filters['section_id'].'"');
        }
        if (!empty($filters['in_section_id'])) {
            $this->db->where('te.sections', $filters['in_section_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('te.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('te.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('te.name_ar', $filters['name_ar']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('te.course_id', $filters['course_id']);
        }
        if (isset($filters['teacher_id'], $filters['monitor_id'])) {
            $this->db->join(Orm_Tst_Exam_Monitors::get_table_name() . ' AS tem', 'te.id = tem.exam_id', 'left');
            $this->db->group_start();
            $this->db->where('te.teacher_id', $filters['teacher_id']);
            $this->db->or_where('tem.monitor_id', $filters['monitor_id']);
            $this->db->group_end();
        }else {
            if (isset($filters['teacher_id'])) {
                $this->db->where('te.teacher_id', $filters['teacher_id']);
            }
            if (isset($filters['monitor_id'])) {
                $this->db->join(Orm_Tst_Exam_Monitors::get_table_name() . ' AS tem', 'te.id = tem.exam_id', 'left');
                $this->db->where('tem.monitor_id', $filters['monitor_id']);
            }
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('te.semester_id', $filters['semester_id']);
        }
        if (!empty($filters['sections'])) {
            $this->db->where('te.sections', $filters['sections']);
        }
        if (!empty($filters['desc_en'])) {
            $this->db->where('te.desc_en', $filters['desc_en']);
        }
        if (!empty($filters['desc_ar'])) {
            $this->db->where('te.desc_ar', $filters['desc_ar']);
        }
        if (isset($filters['type'])) {
            $this->db->where('te.type', $filters['type']);
        }
        if (isset($filters['start'])) {
            $this->db->where('te.start', $filters['start']);
        }
        if (isset($filters['end'])) {
            $this->db->where('te.end', $filters['end']);
        }
        if (isset($filters['fullmark'])) {
            $this->db->where('te.fullmark', $filters['fullmark']);
        }
        if (isset($filters['start_greater_than'])) {
            $this->db->where('te.start >= ', $filters['start_greater_than']);
        }
        if (isset($filters['start_less_than'])) {
            $this->db->where('te.start <= ', $filters['start_less_than']);
        }
        if (isset($filters['end_greater_than'])) {
            $this->db->where('te.end >= ', $filters['end_greater_than']);
        }
        if (isset($filters['end_less_than'])) {
            $this->db->where('te.end <= ', $filters['end_less_than']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('te.name_en', $filters['keyword']);
            $this->db->or_like('te.name_ar', $filters['keyword']);
            $this->db->group_end();
        }
        if (!empty($filters['student'])) {
            $this->db->where_in('te.course_id', $filters['student']['in_course_id']);

            $this->db->group_start();
            foreach($filters['student']['in_section_id'] as $section_id) {
                $this->db->or_like('te.sections', '"'.$section_id.'"');
            }
            $this->db->group_end();


//            $this->db->group_start();
//                $this->db->group_start();
//                    $this->db->where_in('te.course_id', $filters['student']['in_course_id']);
////                    $this->db->where('te.sections', json_encode(array()));
//                $this->db->group_end();
//                $this->db->or_group_start();
//                    $this->db->where_in('te.course_id', $filters['student']['in_course_id']);
////                    $this->db->where('te.sections', $filters['student']['in_section_id']);
//                $this->db->group_end();
//            $this->db->group_end();
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
            return Orm_Tst_Exam::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Tst_Exam::to_object($row);
            }
;
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
        $this->db->insert(Orm_Tst_Exam::get_table_name(), $params);
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
        return $this->db->update(Orm_Tst_Exam::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Tst_Exam::get_table_name(), array('id' => $id));
//        return $this->db->update(Orm_Tst_Exam::get_table_name(), array('is_deleted' => 1), array('id' => $id));
    }
    
}

