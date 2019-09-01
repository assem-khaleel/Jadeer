<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Research_Model extends CI_Model {
    
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
        
        $this->db->select('fr.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Research::get_table_name().' AS fr');
        
        if (isset($filters['id'])) {
            $this->db->where('fr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fr.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('fr.user_id', $filters['user_id']);
        }
        if (!empty($filters['number'])) {
            $this->db->where('fr.number', $filters['number']);
        }
        if (!empty($filters['type'])) {
            $this->db->where('fr.type', $filters['type']);
        }
        if (!empty($filters['title'])) {
            $this->db->where('fr.title', $filters['title']);
        }
        if (!empty($filters['subject'])) {
            $this->db->where('fr.subject', $filters['subject']);
        }
        if (!empty($filters['publish_type'])) {
            $this->db->where('fr.publish_type', $filters['publish_type']);
        }
        if (!empty($filters['publish_date'])) {
            $this->db->where('fr.publish_date', $filters['publish_date']);
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('YEAR(fr.publish_date)', $filters['academic_year']);
        }
        if (!empty($filters['language'])) {
            $this->db->where('fr.language', $filters['language']);
        }
        if (!empty($filters['summary'])) {
            $this->db->where('fr.summary', $filters['summary']);
        }
        if (!empty($filters['attachment'])) {
            $this->db->where('fr.attachment', $filters['attachment']);
        }
        if (!empty($filters['comments'])) {
            $this->db->where('fr.comments', $filters['comments']);
        }
        if (!empty($filters['issn'])) {
            $this->db->where('fr.issn', $filters['issn']);
        }
        if (!empty($filters['isi'])) {
            $this->db->where('fr.isi', $filters['isi']);
        }
        if (!empty($filters['isbn'])) {
            $this->db->where('fr.isbn', $filters['isbn']);
        }
        if (!empty($filters['source'])) {
            $this->db->where('fr.source', $filters['source']);
        }
        if (!empty($filters['published_in'])) {
            $this->db->where('fr.published_in', $filters['published_in']);
        }
        if (!empty($filters['page_from'])) {
            $this->db->where('fr.page_from', $filters['page_from']);
        }
        if (!empty($filters['page_to'])) {
            $this->db->where('fr.page_to', $filters['page_to']);
        }
        if (!empty($filters['page_count'])) {
            $this->db->where('fr.page_count', $filters['page_count']);
        }
        if (!empty($filters['original_type'])) {
            $this->db->where('fr.original_type', $filters['original_type']);
        }
        if (!empty($filters['original_language'])) {
            $this->db->where('fr.original_language', $filters['original_language']);
        }
        if (!empty($filters['original_researcher'])) {
            $this->db->where('fr.original_researcher', $filters['original_researcher']);
        }
        if (!empty($filters['email'])) {
            $this->db->where('fr.email', $filters['email']);
        }
        if (!empty($filters['authors'])) {
            $this->db->where('fr.authors', $filters['authors']);
        }
        if (!empty($filters['participant_count'])) {
            $this->db->where('fr.participant_count', $filters['participant_count']);
        }
        if (!empty($filters['position_rank'])) {
            $this->db->where('fr.position_rank', $filters['position_rank']);
        }
        if (!empty($filters['agreement_date'])) {
            $this->db->where('fr.agreement_date', $filters['agreement_date']);
        }
        if (!empty($filters['agreement_attachment'])) {
            $this->db->where('fr.agreement_attachment', $filters['agreement_attachment']);
        }
        if (!empty($filters['country'])) {
            $this->db->where('fr.country', $filters['country']);
        }
        if (!empty($filters['research_center'])) {
            $this->db->where('fr.research_center', $filters['research_center']);
        }
        if (!empty($filters['research_budget'])) {
            $this->db->where('fr.research_budget', $filters['research_budget']);
        }
        if (!empty($filters['support_party'])) {
            $this->db->where('fr.support_party', $filters['support_party']);
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
            return Orm_Fp_Research::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Research::to_object($row);
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
        $this->db->insert(Orm_Fp_Research::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Research::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Research::get_table_name(), array('id' => (int) $id));
    }
    
}

