<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_Evaluation_Model extends CI_Model
{

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
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS)
    {

        $page = (int)$page;
        $per_page = (int)$per_page;

        $this->db->select('se.*');
        $this->db->distinct();
        $this->db->from(Orm_Survey_Evaluation::get_table_name().' AS se');

        if (isset($filters['id'])) {
            $this->db->where('se.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('se.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('se.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('se.id', $filters['not_in_id']);
        }
        if (isset($filters['survey_id'])) {
            $this->db->where('se.survey_id', $filters['survey_id']);
        }
        if (isset($filters['survey_in'])) {
            $this->db->where_in('se.survey_id', $filters['survey_in']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('se.semester_id', $filters['semester_id']);
        }
        if (isset($filters['academic_year'])) {
            $this->db->join(Orm_Semester::get_table_name().' AS s','s.id = se.semester_id','inner');
            $this->db->where('s.year', $filters['academic_year']);
        }
        if (!empty($filters['description_english'])) {
            $this->db->where('se.description_english', $filters['description_english']);
        }
        if (!empty($filters['description_arabic'])) {
            $this->db->where('se.description_arabic', $filters['description_arabic']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('se.description_arabic', $filters['keyword']);
            $this->db->or_like('se.description_english', $filters['keyword']);
            $this->db->group_end();
        }
        if (!empty($filters['criteria'])) {

            if(is_array($filters['criteria'])) {
                $filters['criteria'] = json_encode($filters['criteria']);
            }
            
            $this->db->where('se.criteria', $filters['criteria']);
        }
        if (!empty($filters['created_by'])) {
            $this->db->where('se.created_by', $filters['created_by']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('se.date_added', $filters['date_added']);
        }
        if (!empty($filters['date_modified'])) {
            $this->db->where('se.date_modified', $filters['date_modified']);
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Survey_Evaluation::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Survey_Evaluation::to_object($row);
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
    public function insert($params = array())
    {
        $this->db->insert(Orm_Survey_Evaluation::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
     * update item
     *
     * @param int $id
     * @param array $params
     * @return boolean
     */
    public function update($id, $params = array())
    {
        return $this->db->update(Orm_Survey_Evaluation::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        $this->db->query("DELETE sr FROM `".Orm_Survey_User_Response_Choice::get_table_name()."` AS sr JOIN `".Orm_Survey_Evaluator::get_table_name()."` AS se ON `sr`.`survey_evaluator_id` = `se`.`id` WHERE `se`.`survey_evaluation_id` = '{$id}'");
        $this->db->query("DELETE sr FROM `".Orm_Survey_User_Response_Factor::get_table_name()."` AS sr JOIN `".Orm_Survey_Evaluator::get_table_name()."` AS se ON `sr`.`survey_evaluator_id` = `se`.`id` WHERE `se`.`survey_evaluation_id` = '{$id}'");
        $this->db->query("DELETE sr FROM `".Orm_Survey_User_Response_Text::get_table_name()."` AS sr JOIN `".Orm_Survey_Evaluator::get_table_name()."` AS se ON `sr`.`survey_evaluator_id` = `se`.`id` WHERE `se`.`survey_evaluation_id` = '{$id}'");

        $this->db->delete(Orm_Survey_Evaluator::get_table_name(), array('survey_evaluation_id' => (int) $id));

        return $this->db->delete(Orm_Survey_Evaluation::get_table_name(), array('id' => (int) $id));
    }
    /**
     * this function get last invitation by its survey id
     * @param int $survey_id the survey id of the get last invitation to be vcall function
     * @return array the call function
     */
    public function get_last_invitation($survey_id)
    {
        $this->db->select('MAX(date_added) last_invitation');
        $this->db->from(Orm_Survey_Evaluation::get_table_name());
        $this->db->where('survey_id',$survey_id);
        return $this->db->get()->row_array();
    }

}

