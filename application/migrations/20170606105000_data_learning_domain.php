<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Initial
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Data_Learning_Domain extends CI_Migration {

    public function up() {


        $learning_domains = [
            [
                'type'=> 1,
                'code' => 1,
                'name_en' => 'Knowledge',
                'name_ar' => 'المعرفة',
                'learning_outcome' => [
                    [
                        'en' => 'knowledge of specific facts.',
                        'ar' => 'knowledge of specific facts.'
                    ],
                    [
                        'en' => 'knowledge of concepts, principles and theories.',
                        'ar' => 'knowledge of concepts, principles and theories.'
                    ],
                    [
                        'en' => 'knowledge of procedures.',
                        'ar' => 'knowledge of procedures.'
                    ]
                ]
            ],
            [
                'type'=> 1,
                'code' => 2,
                'name_en' => 'Cognitive Skills',
                'name_ar' => 'المهارات الإدراكية',
                'learning_outcome' => [
                    [
                        'en' => 'apply conceptual understanding of concepts, principles, theories.',
                        'ar' => 'apply conceptual understanding of concepts, principles, theories.'
                    ],
                    [
                        'en' => 'apply procedures involved in critical thinking and creative problem solving, both when asked to do so, and when faced with unanticipated new situations.',
                        'ar' => 'apply procedures involved in critical thinking and creative problem solving, both when asked to do so, and when faced with unanticipated new situations.'
                    ],
                    [
                        'en' => 'investigate issues and problems in a field of study using a range of sources and draw valid conclusions.',
                        'ar' => 'investigate issues and problems in a field of study using a range of sources and draw valid conclusions.'
                    ]
                ]
            ],
            [
                'type'=> 1,
                'code' => 3,
                'name_en' => 'Interpersonal Skills and Responsibility',
                'name_ar' => 'المسؤولية والمهارات الشخصية',
                'learning_outcome' => [
                    [
                        'en' => 'take responsibility for their own learning and continuing personal and professional development.',
                        'ar' => 'take responsibility for their own learning and continuing personal and professional development.'
                    ],
                    [
                        'en' => 'work effectively in groups and exercise leadership when appropriate.',
                        'ar' => 'work effectively in groups and exercise leadership when appropriate.'
                    ],
                    [
                        'en' => 'act responsibly in personal and professional relationships.',
                        'ar' => 'act responsibly in personal and professional relationships.'
                    ],
                    [
                        'en' => 'act ethically and consistently with high moral standards in personal and public forums.',
                        'ar' => 'act ethically and consistently with high moral standards in personal and public forums.'
                    ]
                ]
            ],
            [
                'type'=> 1,
                'code' => 4,
                'name_en' => 'communication,
                 information technology and numerical skills',
                'name_ar' => 'والاتصالات وتكنولوجيا المعلومات والمهارات العددية',
                'learning_outcome' => [
                    [
                        'en' => 'communicate effectively in oral and written form.',
                        'ar' => 'communicate effectively in oral and written form.'
                    ],
                    [
                        'en' => 'use information and communications technology.',
                        'ar' => 'use information and communications technology.'
                    ],
                    [
                        'en' => 'use basic mathematical and statistical techniques.',
                        'ar' => 'use basic mathematical and statistical techniques.'
                    ]
                ]],
            [
                'type'=> 1,
                'code' => 5,
                'name_en' => 'Psychomotor Skills',
                'name_ar' => 'المهارات الحركية',
                'learning_outcome' => []
            ],
            [
                'type'=> 2,
                'code' => 6,
                'name_en' => 'Knowledge',
                'name_ar' => 'مهارات معرفية',
                'learning_outcome' => []
            ],
            [
                'type'=> 2,
                'code' => 7,
                'name_en' => 'Skills',
                'name_ar' => 'مهارات ذهنية',
                'learning_outcome' => []
            ],
            [
                'type'=> 2,
                'code' => 8,
                'name_en' => 'Competencies',
                'name_ar' => 'الكفاءات',
                'learning_outcome' => []
            ],
            [
                'type'=> 3,
                'code' => 9,
                'name_en' => 'Cognitive Domain (Knowledge)',
                'name_ar' => 'مهارات معرفية',
                'learning_outcome' => []
            ],
            [
                'type'=> 3,
                'code' => 10,
                'name_en' => 'Psychomotor Domain (Skills)',
                'name_ar' => 'المجال النفسي (المهارات)',
                'learning_outcome' => []
            ],
            [
                'type'=> 3,
                'code' => 11,
                'name_en' => 'Affective Domain (Attitudes)',
                'name_ar' => 'المجال العاطفي (التصرفات)',
                'learning_outcome' => []
            ],
        ];


        foreach($learning_domains as $learning_domain){
            $this->db->set('type', $learning_domain['type']);
            $this->db->set('ncaaa_code', $learning_domain['code']);
            $this->db->set('title_en', $learning_domain['name_en']);
            $this->db->set('title_ar', $learning_domain['name_ar']);
            $this->db->insert('cm_learning_domain');

            $learning_domain_id = $this->db->insert_id();

            foreach($learning_domain['learning_outcome'] as $learning_outcome) {
                $this->db->set('learning_domain_id', $learning_domain_id);
                $this->db->set('title_en', $learning_outcome['en']);
                $this->db->set('title_ar', $learning_outcome['ar']);
                $this->db->insert('cm_learning_outcome');
            }
        }
    }

    public function down() {
        $this->db->truncate('cm_learning_domain');
        $this->db->truncate('cm_learning_outcome');
    }

}
