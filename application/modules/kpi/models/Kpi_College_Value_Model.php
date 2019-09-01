<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_College_Value_Model extends CI_Model {
    
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
        
        $this->db->select('kcv.*');
        $this->db->distinct();
        $this->db->from(Orm_Kpi_College_Value::get_table_name().' AS kcv');
        $this->db->join(Orm_Kpi_Detail::get_table_name().' AS qkd', 'kcv.detail_id = qkd.id', 'left');
        $this->db->join(Orm_Kpi_Legend::get_table_name().' AS ql', 'qkd.legend_id = ql.id', 'left');
        $this->db->join(Orm_Kpi_Level::get_table_name().' AS qlv', 'ql.level_id = qlv.id', 'left');
        $this->db->join(Orm_Semester::get_table_name().' AS s','s.id = qkd.semester_id','left');

        if (isset($filters['id'])) {
            $this->db->where('kcv.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('kcv.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('kcv.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('kcv.id', $filters['not_in_id']);
        }
        if (isset($filters['detail_id'])) {
            $this->db->where('kcv.detail_id', $filters['detail_id']);
        }
        if (isset($filters['detail_in'])) {
            $this->db->where_in('kcv.detail_id', $filters['detail_in']);
        }
        if (isset($filters['college_id'])) {
            $this->db->where('kcv.college_id', $filters['college_id']);
        }
        if (!empty($filters['actual_benchmark'])) {
            $this->db->where('kcv.actual_benchmark', $filters['actual_benchmark']);
        }
        if (!empty($filters['actual_benchmark_greater'])) {
            $this->db->where('kcv.actual_benchmark >', $filters['actual_benchmark_greater']);
        }
        if (!empty($filters['internal_college_benchmark'])) {
            $this->db->where('kcv.internal_college_benchmark', $filters['internal_college_benchmark']);
        }
        if (!empty($filters['internal_institution_benchmark'])) {
            $this->db->where('kcv.internal_institution_benchmark', $filters['internal_institution_benchmark']);
        }
        if (!empty($filters['target_benchmark'])) {
            $this->db->where('kcv.target_benchmark', $filters['target_benchmark']);
        }
        if (!empty($filters['new_benchmark'])) {
            $this->db->where('kcv.new_benchmark', $filters['new_benchmark']);
        }
        if (!empty($filters['external_benchmark'])) {
            $this->db->where('kcv.external_benchmark', $filters['external_benchmark']);
        }
        if (isset($filters['kpi_id'])) {
            $this->db->where('qlv.kpi_id', $filters['kpi_id']);
        }
        if (isset($filters['legend_id'])) {
            $this->db->where('qkd.legend_id', $filters['legend_id']);
        }
        if (isset($filters['academic_year'])) {
            $this->db->where('s.year', $filters['academic_year']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('s.id', $filters['semester_id']);
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
            return Orm_Kpi_College_Value::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Kpi_College_Value::to_object($row);
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
        $this->db->insert(Orm_Kpi_College_Value::get_table_name(), $params);
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
        return $this->db->update(Orm_Kpi_College_Value::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Kpi_College_Value::get_table_name(), array('id' => (int) $id));
    }
    
}

