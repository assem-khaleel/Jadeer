<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Data_Assessment_Method extends CI_Migration {
    
    public function up() {

        $assessment_methods = [
            ['name_en' => 'Quiz', 'name_ar' => 'أمتحان قصير', 'assessment_component' => [
                    [
                        'en' => 'Essay Questions',
                        'ar' => 'أسئلة مقالية'
                    ],
                    [
                        'en' => 'Multiple Choice',
                        'ar' => 'اختيار من متعدد'
                    ],
                    [
                        'en' => 'Fill in the Blanks',
                        'ar' => 'إملأ الفراغات'
                    ],
                    [
                        'en' => 'Matching',
                        'ar' => 'التطابق'
                    ]
                ]
            ],
            ['name_en' => 'Class Participation', 'name_ar' => 'المشاركة في الصف', 'assessment_component' => [
                    [
                        'en' => 'Frequency of Participation',
                        'ar' => 'عدد مرات المشاركة'
                    ],
                    [
                        'en' => 'Quality of Participation',
                        'ar' => 'نوعية المشاركة'
                    ]
                ]
            ],
            ['name_en' => 'Examination (Mid-Term)', 'name_ar' => 'امتحان منتصف الفترة', 'assessment_component' => [
                    [
                        'en' => 'Essay Questions',
                        'ar' => 'اسئلة مقالية'
                    ],
                    [
                        'en' => 'Multiple Choice',
                        'ar' => 'اختيار من متعدد'
                    ],
                    [
                        'en' => 'Fill in the Blanks',
                        'ar' => 'إملأ الفراغات'
                    ],
                    [
                        'en' => 'Matching',
                        'ar' => 'التطابق'
                    ]
                ]
            ],
            ['name_en' => 'Examination (Final)', 'name_ar' => 'الامتحان النهائي', 'assessment_component' => [
                    [
                        'en' => 'Essay Questions',
                        'ar' => 'اسئلة مقالية'
                    ],
                    [
                        'en' => 'Multiple Choice',
                        'ar' => 'اختيار من متعدد'
                    ],
                    [
                        'en' => 'Fill in the Blanks',
                        'ar' => 'إملأ الفراغات'
                    ],
                    [
                        'en' => 'Matching',
                        'ar' => 'التطابق'
                    ]
                ]
            ],
        ];


        foreach($assessment_methods as $assessment_method){
            $this->db->set('title_en', $assessment_method['name_en']);
            $this->db->set('title_ar', $assessment_method['name_ar']);
            $this->db->insert('cm_assessment_method');

            $assessment_method_id = $this->db->insert_id();

            foreach($assessment_method['assessment_component'] as $assessment_component) {
                $this->db->set('assessment_method_id', $assessment_method_id);
                $this->db->set('title_en', $assessment_component['en']);
                $this->db->set('title_ar', $assessment_component['ar']);
                $this->db->insert('cm_assessment_component');
            }
        }

    }
    
    public function down() {
        $this->db->truncate('cm_assessment_method');
        $this->db->truncate('cm_assessment_component');
    }
    
}
