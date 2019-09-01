<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Research extends Orm {
    
    /**
    * @var $instances Orm_Fp_Research[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_research';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $number = '';
    protected $type = 0;
    protected $title = '';
    protected $subject = '';
    protected $publish_type = 0;
    protected $publish_date = '0000-00-00';
    protected $language = '';
    protected $summary = '';
    protected $attachment = '';
    protected $comments = '';
    protected $issn = '';
    protected $isi = '';
    protected $other = '';
    protected $isbn = '';
    protected $source = '';
    protected $published_in = '';
    protected $page_from = 0;
    protected $page_to = 0;
    protected $page_count = 0;
    protected $original_type = 0;
    protected $original_language = '';
    protected $original_researcher = '';
    protected $email = '';
    protected $authors = '';
    protected $participant_count = 0;
    protected $position_rank = 0;
    protected $agreement_date = '0000-00-00';
    protected $agreement_attachment = '';
    protected $country = '';
    protected $research_center = '';
    protected $research_budget = 0;
    protected $support_party = '';
    protected $paper_status = 0;

    const PUBLISH_TYPE_NATIONAL_JOURNAL = 1;
    const PUBLISH_TYPE_INTERNATIONAL_JOURNAL = 2;
    const PUBLISH_TYPE_NATIONAL_CONFERENCE = 3;
    const PUBLISH_TYPE_INTERNATIONAL_CONFERENCE = 4;

    public static $PUBLISH_TYPES = array(
        self::PUBLISH_TYPE_NATIONAL_JOURNAL => 'National Journal',
        self::PUBLISH_TYPE_INTERNATIONAL_JOURNAL => 'International Journal',
        self::PUBLISH_TYPE_NATIONAL_CONFERENCE => 'National Conference',
        self::PUBLISH_TYPE_INTERNATIONAL_CONFERENCE => 'International Conference'
    );

    const Paper_Status_1 = 1;
    const Paper_Status_2 = 2;
    const Paper_Status_3 = 3;
    const Paper_Status_4 = 4;
    const Paper_Status_5 = 5;
    const Paper_Status_6 = 6;

    public static $paper_statuses = array(
        self::Paper_Status_1 => 'Paper In Progress',
        self::Paper_Status_2 => 'Accepted for International Conference',
        self::Paper_Status_3 => 'Publication in Conference Proceedings',
        self::Paper_Status_4 => 'Publication in ISI Journals',
        self::Paper_Status_5 => 'Cited Paper in ISI Journals',
        self::Paper_Status_6 => 'Highly Cited Paper in ISI Journals'
    );

    const TYPE_SHARED = 1;
    const TYPE_SINGLE = 2;

    public static $author_types = array(
        self::TYPE_SHARED => 'Shared',
        self::TYPE_SINGLE => 'Single'
    );
    
    /**
    * @return Fp_Research_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Research_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Research
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        return self::get_one(array('id' => $id));
    }
    
    /**
    * get all Objects
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    *
    * @return Orm_Fp_Research[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Research
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Research();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return array
     */
    public static function get_count($filters = array()) {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    /**
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['user_id'] = $this->get_user_id();
        $db_params['number'] = $this->get_number();
        $db_params['type'] = $this->get_type();
        $db_params['title'] = $this->get_title();
        $db_params['subject'] = $this->get_subject();
        $db_params['publish_type'] = $this->get_publish_type();
        $db_params['publish_date'] = $this->get_publish_date();
        $db_params['language'] = $this->get_language();
        $db_params['summary'] = $this->get_summary();
        $db_params['attachment'] = $this->get_attachment();
        $db_params['comments'] = $this->get_comments();
        $db_params['issn'] = $this->get_issn();
        $db_params['isi'] = $this->get_isi();
        $db_params['other'] = $this->get_other();
        $db_params['isbn'] = $this->get_isbn();
        $db_params['source'] = $this->get_source();
        $db_params['published_in'] = $this->get_published_in();
        $db_params['page_from'] = $this->get_page_from();
        $db_params['page_to'] = $this->get_page_to();
        $db_params['page_count'] = $this->get_page_count();
        $db_params['original_type'] = $this->get_original_type();
        $db_params['original_language'] = $this->get_original_language();
        $db_params['original_researcher'] = $this->get_original_researcher();
        $db_params['email'] = $this->get_email();
        $db_params['authors'] = $this->get_authors();
        $db_params['participant_count'] = $this->get_participant_count();
        $db_params['position_rank'] = $this->get_position_rank();
        $db_params['agreement_date'] = $this->get_agreement_date();
        $db_params['agreement_attachment'] = $this->get_agreement_attachment();
        $db_params['country'] = $this->get_country();
        $db_params['research_center'] = $this->get_research_center();
        $db_params['research_budget'] = $this->get_research_budget();
        $db_params['support_party'] = $this->get_support_party();
        $db_params['paper_status'] = $this->get_paper_status();

        return $db_params;
    }

    /**
     * @return int
     */
    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    /**
     * @return bool
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @param $value
     */
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        $this->push_instance();
    }

    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * @param $value
     */
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    /**
     * @return int
     */
    public function get_user_id() {
        return $this->user_id;
    }

    /**
     * @param $value
     */
    public function set_number($value) {
        $this->add_object_field('number', $value);
        $this->number = $value;
    }

    /**
     * @return string
     */
    public function get_number() {
        return $this->number;
    }

    /**
     * @param $value
     */
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_type($to_string = false) {
        if ($to_string) {
            return isset(self::$author_types[$this->type]) ? self::$author_types[$this->type] : '';
        }
        return $this->type;
    }

    /**
     * @param $value
     */
    public function set_title($value) {
        $this->add_object_field('title', $value);
        $this->title = $value;
    }

    /**
     * @return string
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * @param $value
     */
    public function set_subject($value) {
        $this->add_object_field('subject', $value);
        $this->subject = $value;
    }

    /**
     * @return string
     */
    public function get_subject() {
        return $this->subject;
    }

    /**
     * @param $value
     */
    public function set_publish_type($value) {
        $this->add_object_field('publish_type', $value);
        $this->publish_type = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_publish_type($to_string = false) {
        if ($to_string) {
            return isset(self::$PUBLISH_TYPES[$this->publish_type]) ? self::$PUBLISH_TYPES[$this->publish_type] : '';
        }
        return $this->publish_type;
    }

    /**
     * @param $value
     */
    public function set_publish_date($value) {
        $this->add_object_field('publish_date', $value);
        $this->publish_date = $value;
    }

    /**
     * @return string
     */
    public function get_publish_date() {
        return $this->publish_date;
    }

    /**
     * @param $value
     */
    public function set_language($value) {
        $this->add_object_field('language', $value);
        $this->language = $value;
    }

    /**
     * @return string
     */
    public function get_language() {
        return $this->language;
    }

    /**
     * @param $value
     */
    public function set_summary($value) {
        $this->add_object_field('summary', $value);
        $this->summary = $value;
    }

    /**
     * @return string
     */
    public function get_summary() {
        return $this->summary;
    }

    /**
     * @param $value
     */
    public function set_attachment($value) {
        $this->add_object_field('attachment', $value);
        $this->attachment = $value;
    }

    /**
     * @return string
     */
    public function get_attachment() {
        return $this->attachment;
    }

    /**
     * @param $value
     */
    public function set_comments($value) {
        $this->add_object_field('comments', $value);
        $this->comments = $value;
    }

    /**
     * @return string
     */
    public function get_comments() {
        return $this->comments;
    }

    /**
     * @param $value
     */
    public function set_issn($value) {
        $this->add_object_field('issn', $value);
        $this->issn = $value;
    }

    /**
     * @return string
     */
    public function get_issn() {
        return $this->issn;
    }

    /**
     * @param $value
     */
    public function set_isi($value) {
        $this->add_object_field('isi', $value);
        $this->isi = $value;
    }

    /**
     * @return string
     */
    public function get_isi() {
        return $this->isi;
    }

    /**
     * @param $value
     */
    public function set_other($value) {
        $this->add_object_field('other', $value);
        $this->other = $value;
    }

    /**
     * @return string
     */
    public function get_other() {
        return $this->other;
    }

    /**
     * @param $value
     */
    public function set_isbn($value) {
        $this->add_object_field('isbn', $value);
        $this->isbn = $value;
    }

    /**
     * @return string
     */
    public function get_isbn() {
        return $this->isbn;
    }

    /**
     * @param $value
     */
    public function set_source($value) {
        $this->add_object_field('source', $value);
        $this->source = $value;
    }

    /**
     * @return string
     */
    public function get_source() {
        return $this->source;
    }

    /**
     * @param $value
     */
    public function set_published_in($value) {
        $this->add_object_field('published_in', $value);
        $this->published_in = $value;
    }

    /**
     * @return string
     */
    public function get_published_in() {
        return $this->published_in;
    }

    /**
     * @param $value
     */
    public function set_page_from($value) {
        $this->add_object_field('page_from', $value);
        $this->page_from = $value;
    }

    /**
     * @return int
     */
    public function get_page_from() {
        return $this->page_from;
    }

    /**
     * @param $value
     */
    public function set_page_to($value) {
        $this->add_object_field('page_to', $value);
        $this->page_to = $value;
    }

    /**
     * @return int
     */
    public function get_page_to() {
        return $this->page_to;
    }

    /**
     * @param $value
     */
    public function set_page_count($value) {
        $this->add_object_field('page_count', $value);
        $this->page_count = $value;
    }

    /**
     * @return int
     */
    public function get_page_count() {
        return $this->page_count;
    }

    /**
     * @param $value
     */
    public function set_original_type($value) {
        $this->add_object_field('original_type', $value);
        $this->original_type = $value;
    }

    /**
     * @return int
     */
    public function get_original_type() {
        return $this->original_type;
    }

    /**
     * @param $value
     */
    public function set_original_language($value) {
        $this->add_object_field('original_language', $value);
        $this->original_language = $value;
    }

    /**
     * @return string
     */
    public function get_original_language() {
        return $this->original_language;
    }

    /**
     * @param $value
     */
    public function set_original_researcher($value) {
        $this->add_object_field('original_researcher', $value);
        $this->original_researcher = $value;
    }

    /**
     * @return string
     */
    public function get_original_researcher() {
        return $this->original_researcher;
    }

    /**
     * @param $value
     */
    public function set_email($value) {
        $this->add_object_field('email', $value);
        $this->email = $value;
    }

    /**
     * @return string
     */
    public function get_email() {
        return $this->email;
    }

    /**
     * @param $value
     */
    public function set_authors($value) {
        $this->add_object_field('authors', $value);
        $this->authors = $value;
    }

    /**
     * @return string
     */
    public function get_authors() {
        return $this->authors;
    }

    /**
     * @param $value
     */
    public function set_participant_count($value) {
        $this->add_object_field('participant_count', $value);
        $this->participant_count = $value;
    }

    /**
     * @return int
     */
    public function get_participant_count() {
        return $this->participant_count;
    }

    /**
     * @param $value
     */
    public function set_position_rank($value) {
        $this->add_object_field('position_rank', $value);
        $this->position_rank = $value;
    }

    /**
     * @return int
     */
    public function get_position_rank() {
        return $this->position_rank;
    }

    /**
     * @param $value
     */
    public function set_agreement_date($value) {
        $this->add_object_field('agreement_date', $value);
        $this->agreement_date = $value;
    }

    /**
     * @return string
     */
    public function get_agreement_date() {
        return $this->agreement_date;
    }

    /**
     * @param $value
     */
    public function set_agreement_attachment($value) {
        $this->add_object_field('agreement_attachment', $value);
        $this->agreement_attachment = $value;
    }

    /**
     * @return string
     */
    public function get_agreement_attachment() {
        return $this->agreement_attachment;
    }

    /**
     * @param $value
     */
    public function set_country($value) {
        $this->add_object_field('country', $value);
        $this->country = $value;
    }

    /**
     * @return string
     */
    public function get_country() {
        return $this->country;
    }

    /**
     * @param $value
     */
    public function set_research_center($value) {
        $this->add_object_field('research_center', $value);
        $this->research_center = $value;
    }

    /**
     * @return string
     */
    public function get_research_center() {
        return $this->research_center;
    }

    /**
     * @param $value
     */
    public function set_research_budget($value) {
        $this->add_object_field('research_budget', $value);
        $this->research_budget = $value;
    }

    /**
     * @return int
     */
    public function get_research_budget() {
        return $this->research_budget;
    }

    /**
     * @param $value
     */
    public function set_support_party($value) {
        $this->add_object_field('support_party', $value);
        $this->support_party = $value;
    }

    /**
     * @return string
     */
    public function get_support_party() {
        return $this->support_party;
    }

    /**
     * @param $value
     */
    public function set_paper_status($value) {
        $this->add_object_field('paper_status', $value);
        $this->paper_status = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_paper_status($to_string = false) {

        if($to_string) {
            return isset(self::$paper_statuses[$this->paper_status]) ? self::$paper_statuses[$this->paper_status] : '';
        }

        return $this->paper_status;
    }

    /**
     * this function get authorship contribution by rows by its to string
     * @param bool $to_string the to string of the call to be controller
     * @return int
     */
    public function get_authorship_contribution($to_string = false) {

        $score = 0;

        if($this->get_position_rank() == 5) {
            $score = 30;
        } elseif($this->get_position_rank() == 4) {
            $score = 50;
        } elseif($this->get_position_rank() == 3) {
            $score = 65;
        } elseif($this->get_position_rank() == 2) {
            $score = 85;
        } elseif($this->get_position_rank() == 1) {
            $score = 100;
        }

        if($to_string) {
            return Orm_Fp_Evaluation::get_band_performance($score);
        }

        return $score;
    }

    /**
     * this function get_paper status rank by rows by its to string
     * @param bool $to_string the to string of the call to be controller
     * @return int
     */
    public function get_paper_status_rank($to_string = false) {

        $score = 0;

        if($this->get_paper_status() == self::Paper_Status_1) {
            $score = 10;
        } elseif($this->get_paper_status() == self::Paper_Status_2) {
            $score = 30;
        } elseif($this->get_paper_status() == self::Paper_Status_3) {
            $score = 50;
        } elseif($this->get_paper_status() == self::Paper_Status_4) {
            $score = 65;
        } elseif($this->get_paper_status() == self::Paper_Status_5) {
            $score = 85;
        } elseif($this->get_paper_status() == self::Paper_Status_6) {
            $score = 100;
        }

        if($to_string) {
            return Orm_Fp_Evaluation::get_band_performance($score);
        }

        return $score;
    }

    /**
     * this function get paper score by rows by its to string
     * @param bool $to_string the to string of the call to be controller
     * @return float|int
     */
    public function get_paper_score($to_string = false) {

        $paper_score = (($this->get_authorship_contribution() + $this->get_paper_status_rank()) / 2);

        if($to_string) {
            return Orm_Fp_Evaluation::get_band_performance($paper_score);
        }

        return $paper_score;
    }
}

