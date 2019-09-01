<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Forms_Rate_Model extends CI_Model {

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

        $this->db->select('ffr.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Forms_Rate::get_table_name() . ' AS ffr');
        $this->db->where('ffr.deleted_at',0);
        
        if (isset($filters['id'])) {
            $this->db->where('ffr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ffr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ffr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ffr.id', $filters['not_in_id']);
        }
        if (isset($filters['deadline_id'])) {
            $this->db->where('ffr.deadline_id', $filters['deadline_id']);
        }
        if (isset($filters['type_id'])) {
            $this->db->where('ffr.type_id', $filters['type_id']);
        }
        if (isset($filters['rate'])) {
            $this->db->where('ffr.rate', $filters['rate']);
        }
        if (isset($filters['created_at'])) {
            $this->db->where('ffr.created_at', $filters['created_at']);
        }
        if (isset($filters['updated_at'])) {
            $this->db->where('ffr.updated_at', $filters['updated_at']);
        }
        if (isset($filters['deleted_at'])) {
            $this->db->where('ffr.deleted_at', $filters['deleted_at']);
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
                return Orm_Fp_Forms_Rate::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Fp_Forms_Rate::to_object($row);
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
        $this->db->insert(Orm_Fp_Forms_Rate::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Forms_Rate::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Forms_Rate::get_table_name(), array('id' => $id));
    }

    /**
     * get rate summation for each types depends on deadline
     * @param int $deadline
     * @param $type_id
     * @return int
     */
    public function get_sum_by_deadline($deadline=-1, $type_id) {
        $this->db->select_sum('rate');

        if($deadline!=-1){
            $this->db->where('deadline_id',$deadline);
            $this->db->where('type_id !=',$type_id);
            $this->db->where('deleted_at',0);
        }

        $sumType= $this->db->get(Orm_Fp_Forms_Rate::get_table_name())->row();

            if(isset($sumType->rate))
                return intval($sumType->rate);

        return 0;
    }
}

