<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policies_Procedures_Model extends CI_Model {

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

        $this->db->select('pp.*');
        $this->db->distinct();
        $this->db->from(Orm_Policies_Procedures::get_table_name() . ' AS pp');

//        if(count($filters) ){
//            $this->db->group_start();
//        }

        if (isset($filters['id'])) {
            $this->db->where('pp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pp.id', $filters['not_in_id']);
        }
        if (isset($filters['in_unit_id'])) {
            $this->db->where_in('pp.unit_id', $filters['in_unit_id']);
        }
        if (isset($filters['unit_id'])) {
            $this->db->where('pp.unit_id', $filters['unit_id']);
        }
        if (isset($filters['unit_type'])) {
            $this->db->where('pp.unit_type', $filters['unit_type']);
        }
        if (isset($filters['in_unit_type'])) {
            $this->db->where_in('pp.unit_type', $filters['in_unit_type']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('pp.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('pp.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['desc_en'])) {
            $this->db->where('pp.desc_en', $filters['desc_en']);
        }
        if (!empty($filters['desc_ar'])) {
            $this->db->where('pp.desc_ar', $filters['desc_ar']);
        }
        if (!empty($filters['statement_en'])) {
            $this->db->where('pp.statement_en', $filters['statement_en']);
        }
        if (!empty($filters['statement_ar'])) {
            $this->db->where('pp.statement_ar', $filters['statement_ar']);
        }
        if (!empty($filters['definitions_en'])) {
            $this->db->where('pp.definitions_en', $filters['definitions_en']);
        }
        if (!empty($filters['definitions_ar'])) {
            $this->db->where('pp.definitions_ar', $filters['definitions_ar']);
        }
        if (!empty($filters['audience_en'])) {
            $this->db->where('pp.audience_en$filters', $filters['audience_en']);
        }
        if (!empty($filters['audience_ar'])) {
            $this->db->where('pp.audience_ar', $filters['audience_ar']);
        }
        if (!empty($filters['reason_en'])) {
            $this->db->where('pp.reason_en', $filters['reason_en']);
        }
        if (!empty($filters['reason_ar'])) {
            $this->db->where('pp.reason_ar', $filters['reason_ar']);
        }
        if (!empty($filters['compliance_en'])) {
            $this->db->where('pp.compliance_en', $filters['compliance_en']);
        }
        if (!empty($filters['compliance_ar'])) {
            $this->db->where('pp.compliance_ar', $filters['compliance_ar']);
        }
        if (!empty($filters['regulations_en'])) {
            $this->db->where('pp.regulations_en', $filters['regulations_en']);
        }
        if (!empty($filters['regulations_ar'])) {
            $this->db->where('pp.regulations_ar', $filters['regulations_ar']);
        }
        if (!empty($filters['contact_def_en'])) {
            $this->db->where('pp.contact_def_en', $filters['contact_def_en']);
        }
        if (!empty($filters['contact_def_ar'])) {
            $this->db->where('pp.contact_def_ar', $filters['contact_def_ar']);
        }
        if (!empty($filters['history_en'])) {
            $this->db->where('pp.history_en', $filters['history_en']);
        }
        if (!empty($filters['history_ar'])) {
            $this->db->where('pp.history_ar', $filters['history_ar']);
        }
        if (!empty($filters['procedures_en'])) {
            $this->db->where('pp.procedures_en', $filters['procedures_en']);
        }
        if (!empty($filters['procedures_ar'])) {
            $this->db->where('pp.procedures_ar', $filters['procedures_ar']);
        }
        if (!empty($filters['standard_en'])) {
            $this->db->where('pp.standard_en', $filters['standard_en']);
        }
        if (!empty($filters['standard_ar'])) {
            $this->db->where('pp.standard_ar', $filters['standard_ar']);
        }
        if (isset($filters['creator_id'])) {
            $this->db->where('pp.creator_id', $filters['creator_id']);
        }

        if (isset($filters['manager_id'])) {
            $this->db->join(Orm_Policies_Procedures_Managers::get_table_name() . ' AS ppm', 'pp.id = ppm.policy_id', 'left');
            $this->db->where('ppm.manager_id', $filters['manager_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->join(Orm_Policies_Procedures_Managers::get_table_name() . ' AS ppm', 'pp.id = ppm.policy_id', 'left');
            $this->db->or_where('ppm.manager_id', $filters['user_id']);
        }
//        if(count($filters) ){
//            $this->db->group_end();
//        }
        

        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('pp.title_en', $filters['keyword']);
            $this->db->or_like('pp.title_ar', $filters['keyword']);
            $this->db->group_end();
        }


        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        $this->db->order_by('id', 'desc');

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Policies_Procedures::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Policies_Procedures::to_object($row);
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
        $this->db->insert(Orm_Policies_Procedures::get_table_name(), $params);
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
        return $this->db->update(Orm_Policies_Procedures::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Policies_Procedures::get_table_name(), array('id' => $id));
    }

}

