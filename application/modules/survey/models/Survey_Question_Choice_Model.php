<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_Question_Choice_Model extends CI_Model
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

        $this->db->select('sqc.*');
        $this->db->distinct();
        $this->db->from(Orm_Survey_Question_Choice::get_table_name().' AS sqc');

        if (isset($filters['id'])) {
            $this->db->where('sqc.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('sqc.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('sqc.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('sqc.id', $filters['not_in_id']);
        }
        if (isset($filters['question_id'])) {
            $this->db->where('sqc.question_id', $filters['question_id']);
        }
        if (!empty($filters['choice_english'])) {
            $this->db->where('sqc.choice_english', $filters['choice_english']);
        }
        if (!empty($filters['choice_arabic'])) {
            $this->db->where('sqc.choice_arabic', $filters['choice_arabic']);
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
                return Orm_Survey_Question_Choice::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Survey_Question_Choice::to_object($row);
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
        $this->db->insert(Orm_Survey_Question_Choice::get_table_name(), $params);
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
        return $this->db->update(Orm_Survey_Question_Choice::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Survey_Question_Choice::get_table_name(), array('id' => (int)$id));
    }

    /**
     * this function delete old choices by its question id and exclude ids
     * @param int $question_id the question id of the delete old choices to be call function
     * @param int $exclude_ids the exclude ids of the delete old choices to be call function
     * @redirect success or error
     */
    public function delete_old_choices($question_id, $exclude_ids) {
        if($exclude_ids) {
            $this->db->where_not_in('id', $exclude_ids);
        }
        $this->db->delete(Orm_Survey_Question_Choice::get_table_name(), array('question_id' => (int) $question_id));
    }

    /**
     * this function get choice ids by its question id
     * @param int $question_id the question id of the get choice ids to be call function
     * @return array the call function
     */
    public function get_choice_ids($question_id){
        $this->db->select('sqc.id');
        $this->db->distinct();
        $this->db->from(Orm_Survey_Question_Choice::get_table_name().' AS sqc');
        $this->db->where('sqc.question_id', $question_id);

        return array_column($this->db->get()->result_array() , 'id');
    }

}

