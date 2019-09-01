<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Kpi_Survey_Model
 * @property CI_DB_query_builder $db
 */
class Kpi_Survey_Model extends CI_Model {

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

        $this->db->select('ks.*');
        $this->db->distinct();
        $this->db->from(Orm_Kpi_Survey::get_table_name().' AS ks');

        if (isset($filters['id'])) {
            $this->db->where('ks.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ks.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ks.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ks.id', $filters['not_in_id']);
        }
        if (isset($filters['kpi_id'])) {
            $this->db->where('ks.kpi_id', $filters['kpi_id']);
        }
        if (isset($filters['survey_id'])) {
            $this->db->where('ks.survey_id', $filters['survey_id']);
        }
        if (isset($filters['factor_id'])) {
            $this->db->where('ks.factor_id', $filters['factor_id']);
        }
        if (isset($filters['statement_id'])) {
            $this->db->where('ks.statement_id', $filters['statement_id']);
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
            return Orm_Kpi_Survey::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Kpi_Survey::to_object($row);
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
        $this->db->insert(Orm_Kpi_Survey::get_table_name(), $params);
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
        return $this->db->update(Orm_Kpi_Survey::get_table_name(), $params, array('id' => (int) $id));
    }

    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Kpi_Survey::get_table_name(), array('id' => (int) $id));
    }

    /**
     * @param $type
     * @param int $semester_id
     * @param int $college_id
     * @param int $program_id
     * @return mixed
     */
    public function get_scores($type, $semester_id, $college_id = 0, $program_id = 0)
    {
        if (!License::get_instance()->check_module('survey')) {
            return array();
        }

        $filters = array();
        if ($program_id && $college_id)
        {
            $filters = array('college_id' => $college_id,'program_id' => $program_id);
        }
        elseif ($college_id)
        {
            $filters = array('college_id' => $college_id);
        }

        $this->db->select('ks.kpi_id, sqf.id, sqf.title_english, avg(surf.rank) as score, s.type');
        $this->db->from('kpi_survey ks');
        $this->db->join(Orm_Survey_Question_Factor::get_table_name().' AS sqf','ks.factor_id = sqf.id','left');
        $this->db->join(Orm_Survey_Question_Statement::get_table_name().' AS sqs','sqs.id = ks.statement_id','left');
        $this->db->join(Orm_Survey_User_Response_Factor::get_table_name().' AS surf','surf.statement_id = ks.statement_id','left');
        $this->db->join(Orm_Survey_Evaluator::get_table_name().' AS se','se.id = surf.survey_evaluator_id','left');
        $this->db->join(Orm_Survey_Evaluation::get_table_name().' AS sev','se.survey_evaluation_id = sev.id','left');
        $this->db->join(Orm_Survey::get_table_name().' AS s','sev.survey_id = s.id','left');
        switch ($type)
        {
            case Orm_Survey::TYPE_FACULTY:
                $this->db->join(Orm_User_Faculty::get_table_name().' AS uf','se.user_id = uf.user_id','left');
                Orm_User_Faculty::get_model()->get_filters($filters,'uf');
                break;
            case Orm_Survey::TYPE_STAFF:
                $this->db->join(Orm_User_Staff::get_table_name().' AS us','se.user_id = us.user_id','left');
                Orm_User_Staff::get_model()->get_filters($filters,'us');
                break;
            case Orm_Survey::TYPE_EMPLOYER:
                $this->db->join(Orm_User_Employer::get_table_name().' AS ue','se.user_id = ue.user_id','left');
                Orm_User_Employer::get_model()->get_filters($filters,'ue');
                break;
            case Orm_Survey::TYPE_ALUMNI:
                $this->db->join(Orm_User_Alumni::get_table_name().' AS ua','se.user_id = ua.user_id','left');
                Orm_User_Employer::get_model()->get_filters($filters,'ua');
                break;
        }
        $this->db->where('sev.semester_id' , $semester_id);
        $this->db->group_by('ks.kpi_id,sqf.id,s.type');
        $result = $this->db->get()->result_array();
        return $result;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function delete_all($filters = array()) {

        if (isset($filters['kpi_id'])) {
            $this->db->where('kpi_id', $filters['kpi_id']);
        }
        if (isset($filters['statement_in'])) {
            $this->db->where_in('statement_id', $filters['statement_in']);
        }
        if (isset($filters['statement_not_in'])) {
            $this->db->where_not_in('statement_id', $filters['statement_not_in']);
        }
        return $this->db->delete(Orm_Kpi_Survey::get_table_name());
    }
}

