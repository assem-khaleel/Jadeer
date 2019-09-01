<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_Question_Statement_Model extends CI_Model
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

        $this->db->select('sqs.*');
        $this->db->distinct();
        $this->db->from(Orm_Survey_Question_Statement::get_table_name().' AS sqs');
        $this->db->join(Orm_Survey_Question_Factor::get_table_name().' AS sqf','sqs.factor_id = sqf.id','left');
        $this->db->join(Orm_Survey_Question::get_table_name().' AS sq','sqf.question_id = sq.id','left');
        $this->db->join(Orm_Survey_Page::get_table_name().' AS sp','sp.id = sq.page_id','left');
        $this->db->join(Orm_Survey::get_table_name().' AS s','s.id = sp.survey_id','left');

        if (isset($filters['id'])) {
            $this->db->where('sqs.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('sqs.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('sqs.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('sqs.id', $filters['not_in_id']);
        }
        if (isset($filters['factor_id'])) {
            $this->db->where('sqs.factor_id', $filters['factor_id']);
        }
        if (isset($filters['survey_id'])) {
            $this->db->where('s.id', $filters['survey_id']);
        }
        if (!empty($filters['title_english'])) {
            $this->db->where('sqs.title_english', $filters['title_english']);
        }
        if (!empty($filters['title_arabic'])) {
            $this->db->where('sqs.title_arabic', $filters['title_arabic']);
        }
        if (!empty($filters['abbreviation_english'])) {
            $this->db->where('sqs.abbreviation_english', $filters['abbreviation_english']);
        }
        if (!empty($filters['abbreviation_arabic'])) {
            $this->db->where('sqs.abbreviation_arabic', $filters['abbreviation_arabic']);
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
                return Orm_Survey_Question_Statement::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Survey_Question_Statement::to_object($row);
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
        $this->db->insert(Orm_Survey_Question_Statement::get_table_name(), $params);
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
        return $this->db->update(Orm_Survey_Question_Statement::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Survey_Question_Statement::get_table_name(), array('id' => (int)$id));
    }

    /**
     * this function delete old statements by its factor id and exclude ids
     * @param int $factor_id the factor id of the delete old statements to be call function
     * @param int $exclude_ids the exclude ids of the delete old statements to be call function
     * @redirect success or error
     */
    public function delete_old_statements($factor_id, $exclude_ids) {
        if($exclude_ids) {
            $this->db->where_not_in('id', $exclude_ids);
        }
        $this->db->delete(Orm_Survey_Question_Statement::get_table_name(), array('factor_id' => (int) $factor_id));
    }

    /**
     * this function get last invitation by its factor id
     * @param int $factor_id  the factor id of the get last invitation to be call function
     * @return array the call function
     */
    public function get_statement_ids($factor_id){
        $this->db->select('sqs.id');
        $this->db->distinct();
        $this->db->from(Orm_Survey_Question_Statement::get_table_name().' AS sqs');
        $this->db->where('sqs.factor_id', $factor_id);

        return array_column($this->db->get()->result_array() , 'id');
    }
}

