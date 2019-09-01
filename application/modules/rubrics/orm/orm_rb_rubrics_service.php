<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 23/10/17
 * Time: 13:31
 */

class Orm_Rb_Rubrics_Service extends Orm_Rb_Rubrics
{

    /**
     * @return bool
     */
    public static function is_valid()
    {
        $service_desc = self::get_ci()->input->get_post('extra_value');

        Validator::required_field_validator('extra_value', $service_desc, lang('You have to enter service description'));

        return Validator::success();
    }

    /**
     * this function get properties by its error and value
     * @param string $error the error of the get properties to be call function
     * @param string $value the value of the get properties to be call function
     * @return string the html view
     */
    public static function get_properties($error = '', $value = '')
    {
        $service_desc = lang('Service Description');

        return <<<HTML
                <div class="form-group">
                    <label class="control-label" for="service_desc">$service_desc</label>
                    <textarea id="service_desc" name="extra_value" style="min-height: 100px;" type="text" class="form-control">$value</textarea>
                    $error
                </div>
HTML;
    }

    /**
     * this function draw
     * @return string the html call function
     */
    public function draw()
    {
        $value = $this->get_extra_data();

        return <<<HTML
        <div class="form-group">
            <textarea style="min-height: 100px;" readonly="" class="form-control">$value</textarea>
        </div>
HTML;

    }

    /**
     * @param $view_params
     */
    public function set_evaluation($view_params)
    {

        $invitation_id = $this->get_ci()->input->get_post('invitation_id');
        $description_en = $this->get_ci()->input->get_post('description_en');
        $description_ar = $this->get_ci()->input->get_post('description_ar');
        $fltr = $this->get_ci()->input->post('fltr');

        Validator::required_field_validator('description_en', $description_en, lang('This field is required'));
        Validator::required_field_validator('description_ar', $description_ar, lang('This field is required'));
        Validator::required_array_validator('fltr', $fltr, lang('This field is required'));

        $evaluation = Orm_Rb_Evaluations::get_one(['rubrics_id' => $this->get_id(), 'id' => $invitation_id]);

        if (Validator::success()) {
            $evaluation->set_description_en($description_en);
            $evaluation->set_description_ar($description_ar);
            $evaluation->set_rubrics_id($this->get_id());
            $evaluation->set_criteria(json_encode($fltr));

            if (!$evaluation->get_id()) {
                $evaluation->set_date_added(date('Y-m-d'));
            }

            $evaluation->save();

            json_response(['success' => true]);
        }

        $view_params['rubric'] = $this;
        $view_params['invitation_id'] = $invitation_id;
        $view_params['invitation'] = $evaluation;
        $view_params['description_en'] = $description_en ?: '';
        $view_params['description_ar'] = $description_ar ?: '';

        json_response(['success' => false, 'html' => $this->get_ci()->load->view('invitation/service', $view_params, true)]);
    }
    /**
     * this function get invitation form by its view params
     * @param array $view_params the view params of the get invitation form to be call function
     * @return object|string the call function
     */
    public function get_invitation_form($view_params)
    {

        $invitation_id = intval($this->get_ci()->input->get_post('invitation_id'));


        $view_params['invitation'] = Orm_Rb_Evaluations::get_one(['rubric_id' => $this->get_id(), 'id' => $invitation_id]);

        $view_params['description_en'] = '';
        $view_params['description_ar'] = '';

        return $this->get_ci()->load->view('invitation/service', $view_params, true);
    }
    /**
     * this function check invitation
     * @return bool the call function
     */
    public function check_invitation()
    {
        if (!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY, Orm_User::USER_STUDENT])) {
            return false;
        }

        foreach (Orm_Rb_Evaluations::get_all(['rubrics_id' => $this->get_id()]) as $evaluation) {
            $criteria = json_decode($evaluation->get_criteria(), 1);
            $criteria['id'] = Orm_User::get_logged_user_id();

            if ($criteria['type']::get_one($criteria)->get_id()) {
                return true;
            }

        }

        return false;
    }

    /**
     * this function answer draw
     * @return string the html view
     */
    public function answer_draw()
    {
        $value = htmlfilter($this->get_extra_data());

        return <<<HTML
        <div class="form-group">
            <pre class="form-control">$value</pre>
        </div>
        <input type="hidden" name="user_id" value="0" />
HTML;
    }
}