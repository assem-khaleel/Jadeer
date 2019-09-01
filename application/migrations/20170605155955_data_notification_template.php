<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Notification_Template
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Data_Notification_Template extends CI_Migration
{

    public function up()
    {

        $notifications = [
            [
                'name' => 'admin_add_user_on_node',
                'subject' => 'New Assessor Added',
                'body' => '<p>%receiver_name%, A new assessor has been successfully added to the %node_name% node.</p>'
            ],
            [
                'name' => 'admin_entered_due_date_to_node',
                'subject' => 'New Due Date from Admin',
                'body' => '<p>The admin has assigned the&nbsp;%node_name% node to be submitted at&nbsp;%due_date%.</p>'
            ],
            [
                'name' => 'assessor_finished_entering_forms_data',
                'subject' => 'Assessor has Completed the Forms',
                'body' => '<p>The assigned assessor has completed forms for the&nbsp;%node_name% node.</p>'
            ],
            [
                'name' => 'all_form_data_enterd_and_checked_correctly',
                'subject' => 'Forms Accepted as Compliant',
                'body' => '<p>All&nbsp;forms in the&nbsp;%node_name% node have been reviewed and accepted to compliant to standards.</p>'
            ],
            [
                'name' => 'form_data_incorrect_or_not_enterd',
                'subject' => 'Form(s) have been Rejected',
                'body' => '<p>The set of forms in the&nbsp;%node_name% node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>'
            ],
            [
                'name' => 'survey_invitation',
                'subject' => 'Fill out This Survey',
                'body' => '<p>You are invitated to fill out the&nbsp;%survey_title_english% survey and give your input.</p>'
            ],
            [
                'name' => 'survey_alumni_invitation',
                'subject' => 'Fill out This Survey',
                'body' => '<p><span data-sheets-value="{&quot;1&quot;:2,&quot;2&quot;:&quot;You are invitated to fill out the %survey_title_english% survey and give your input.&quot;}" data-sheets-userformat="{&quot;2&quot;:513,&quot;3&quot;:{&quot;1&quot;:0},&quot;12&quot;:0}">You are invitated to fill out the %survey_title_english% survey and give your input.</span></p>'
            ],
            [
                'name' => 'survey_employer_invitation',
                'subject' => 'Fill out This Survey',
                'body' => '<p><span data-sheets-value="{&quot;1&quot;:2,&quot;2&quot;:&quot;You are invitated to fill out the %survey_title_english% survey and give your input.&quot;}" data-sheets-userformat="{&quot;2&quot;:513,&quot;3&quot;:{&quot;1&quot;:0},&quot;12&quot;:0}">You are invitated to fill out the %survey_title_english% survey and give your input.</span></p>'
            ],
            [
                'name' => 'survey_reminder',
                'subject' => 'Don\'t Forget to Fill out This Survey',
                'body' => '<p>Please don\'t forgot to fill the&nbsp;%survey_title_english% survey as your input is valuable.</p>'
            ],
            [
                'name' => 'forgot_password',
                'subject' => 'Forgot Password Service',
                'body' => '<p>You have requested to send your forgotton password. Your password is as follows:</p><p>%password%</p>'
            ],
            [
                'name' => 'alumni_employer_created',
                'subject' => 'An Employer Entity Created',
                'body' => '<p>The respected alumnus member has created a new employer entity to be associated with in the system as well other alumni if there exists a current or previous association with this employer.</p>'
            ],
            [
                'name' => 'email_received',
                'subject' => 'You have a New Message',
                'body' => '<p>%receiver_name% has sent you a new message from the %receiver_email% account.</p>'
            ],
            [
                'name' => 'remind_user_to_fill',
                'subject' => 'Please Fill out Required Forms',
                'body' => '<p>%receiver_name%, it is important that your assigned forms for the&nbsp;%node_name% node be filled so that accreditation can take place accordingly.</p>'
            ],
            [
                'name' => 'join_training',
                'subject' => 'New Member need to join training',
                'body' => '<p>%sender_name% need to join %training_name_english%</p><p>%link%</p>'
            ],
            [
                'name' => 'ignore_training',
                'subject' => 'Training Request Ignored',
                'body' => '<p>Your Request for Joining %training_name_english% ignored by %sender_name%</p>'
            ],
            [
                'name' => 'approve_training',
                'subject' => 'Training Request Approved',
                'body' => '<p>Your request to join %training_name_english% approved by %sender_name%</p>'
            ],
            [
                'name' => 'award_candidate',
                'subject' => 'award candidate',
                'body' => '<p>you have been nominated in award by %sender_name%</p>'
            ],
            [
                'name' => 'award_winner',
                'subject' => 'award winner',
                'body' => '<p>you have been nominated in award by %sender_name%</p>'
            ],
            [
            'name' => 'rubrics',
            'subject' => 'You have been invited in rubric',
            'body' => '<p> You hav been assigned to fill a rubric %rubrics_name_english% by %sender_name%</p><p>%link%</p>'
            ],
            [
                'name' => 'clubs',
                'subject' => 'You have been invited to club',
                'body' => '<p>You have been invited in %club_name_english% club by %sender_name%</p>'
            ]
        ];

        foreach ($notifications as $notification) {
            $this->db->set('name', $notification['name']);
            $this->db->set('subject', $notification['subject']);
            $this->db->set('body', $notification['body']);
            $this->db->insert('notification_template');
        }
    }

    public function down()
    {
        $this->db->truncate('notification_template');
    }

}