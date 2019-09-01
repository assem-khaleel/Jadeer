<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Migration_Data_Faculty_Performance
 *
 * @property CI_DB_forge $dbforge
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Migration_Data_Faculty_Performance extends CI_Migration
{
    public function up()
    {
        $faculty_data = [
            ['id' => 1, 'type_name_en' => 'Teaching', 'type_name_ar' => 'التدريس'],
            ['id' => 2, 'type_name_en' => 'Research', 'type_name_ar' => 'الابحاث'],
            ['id' => 3, 'type_name_en' => 'Service', 'type_name_ar' => 'الخدمات']
        ];
        
        foreach ($faculty_data as $faculty) {
            $this->db->set('id', $faculty['id']);
            $this->db->set('type_name_en', $faculty['type_name_en']);
            $this->db->set('type_name_ar', $faculty['type_name_ar']);
            $this->db->set('created_at',date('Y-m-d H:i:s'));
            $this->db->set('updated_at',date('Y-m-d H:i:s'));
            $this->db->insert('fp_forms_type');
        }
        
        $faculty_data= [
            [
                'id' => 1,
                'type_id' => 3,
                'form_name_en' => 'Appointments as Editor',
                'form_name_ar'=>'التعيينات كمحرر',
                'static_file'=>'appointments_as_editor'
            ],
            [
                'id' => 2,
                'type_id' => 1,
                'form_name_en' => 'Courses Taught',
                'form_name_ar'=>'تدريس المواد الدراسية',
                'static_file'=>'courses_taught'
            ],
            [
                'id' => 3,
                'type_id' => 3,
                'form_name_en' => 'Conference Chair Organizer',
                'form_name_ar'=>'منظم المؤتمر الرئيسي',
                'static_file'=>'conference_chair_organizer'
            ],
            [
                'id' => 4,
                'type_id' => 1,
                'form_name_en' => 'Course Development',
                'form_name_ar'=>'تطوير المادة الدراسية',
                'static_file'=>'course_development'
            ],
            [
                'id' => 5,
                'type_id' => 3,
                'form_name_en' => 'Session Chair Organizer',
                'form_name_ar'=>'منظم الجالسة الرئيسي',
                'static_file'=>'session_chair_organizer'
            ],
            [
                'id' => 6,
                'type_id' => 1,
                'form_name_en' => 'Laboratory Course Development',
                'form_name_ar'=>'مكتبة تطوير المادة الدراسية',
                'static_file'=>'laboratory_course_development'
            ],
            [
                'id' => 7,
                'type_id' => 3,
                'form_name_en' => 'Reviewer',
                'form_name_ar'=>'مراجع',
                'static_file'=>'reviewer'
            ],
            [
                'id' => 8,
                'type_id' => 3,
                'form_name_en' => 'Professional Committees',
                'form_name_ar'=>'اللجان الفنية',
                'static_file'=>'professional_committees'
            ],
            [
                'id' => 9,
                'type_id' => 3,
                'form_name_en' => 'Examiner Committees',
                'form_name_ar'=>'لجان الامتحانات',
                'static_file'=>'examiner_committees'
            ],
            [
                'id' => 10,
                'type_id' => 3,
                'form_name_en' => 'Departmental Committees',
                'form_name_ar'=>'لجان الأقسام',
                'static_file'=>'departmental_committees'
            ],
            [
                'id' => 11,
                'type_id' => 3,
                'form_name_en' => 'College Committees',
                'form_name_ar'=>'لجان الكلية',
                'static_file'=>'college_committees'
            ],
            [
                'id' => 12,
                'type_id' => 1,
                'form_name_en' => 'Curricular Revisions',
                'form_name_ar'=>'المراجعات المنهجية',
                'static_file'=>'curricular_revisions'
            ],
            [
                'id' => 13,
                'type_id' => 1,
                'form_name_en' => 'Ph.D. Dissertations Completed',
                'form_name_ar'=>'رسائل الدكتوراة المكتملة',
                'static_file'=>'PhD_dissertations_completed'
            ],
            [
                'id' => 14,
                'type_id' => 1,
                'form_name_en' => 'MS Thesis Completed',
                'form_name_ar'=>'رسائل الماجستير المكتملة',
                'static_file'=>'ms_thesis_completed'
            ],
            [
                'id' => 15,
                'type_id' => 1,
                'form_name_en' => 'MS Non-Thesis Completed',
                'form_name_ar'=>'رسائل الماجستير غير المكتملة',
                'static_file'=>'ms_non-thesis_completed'
            ],
            [
                'id' => 16,
                'type_id' => 3,
                'form_name_en' => 'University Committees',
                'form_name_ar'=>'لجان الجامعة',
                'static_file'=>'university_committees'
            ],
            [
                'id' => 17,
                'type_id' => 3,
                'form_name_en' => 'Miscellaneous Service Activities',
                'form_name_ar'=>'أنشطة الخدمات المتنوعة',
                'static_file'=>'miscellaneous'
            ],
            [
                'id' => 18,
                'type_id' => 3,
                'form_name_en' => 'Consulting Activities - Organization Unpaid',
                'form_name_ar'=>'الأنشطة الاستشارية - المنظمة بدون أجر',
                'static_file'=>'organization_unpaid'
            ],
            [
                'id' => 19,
                'type_id' => 3,
                'form_name_en' => 'Consulting Activities - Organization Service',
                'form_name_ar'=>'الأنشطة الاستشارية - خدمة المنظمة',
                'static_file'=>'organization_service'
            ],
            [
                'id' => 20,
                'type_id' => 3,
                'form_name_en' => 'Consulting Activities - Professional Testimony',
                'form_name_ar'=>'الأنشطة الاستشارية - شهادة مهنية',
                'static_file'=>'professional_testimony'
            ],
            [
                'id' => 21,
                'type_id' => 3,
                'form_name_en' => 'Teaching Awards - External',
                'form_name_ar'=>'جوائز التدريس - الخارجية',
                'static_file'=>'teaching_awards _ external'
            ],
            [
                'id' => 22,
                'type_id' => 3,
                'form_name_en' => 'Teaching Awards - Internal',
                'form_name_ar'=>'جوائز التدريس - الداخلية',
                'static_file'=>'teaching_awards_internal'
            ],
            [
                'id' => 23,
                'type_id' => 3,
                'form_name_en' => 'Research Awards - External',
                'form_name_ar'=>'جوائز البحث - الخارجية',
                'static_file'=>'research_awards_external'
            ],
            [
                'id' => 24,
                'type_id' => 3,
                'form_name_en' => 'Research Awards - Internal',
                'form_name_ar'=>'جوائز البحث - الداخلية',
                'static_file'=>'research_awards_internal'
            ],
            [
                'id' => 25,
                'type_id' => 3,
                'form_name_en' => 'Service Awards - External',
                'form_name_ar'=>'جوائز الخدمة - الخارجية',
                'static_file'=>'service_awards_external'
            ],
            [
                'id' => 26,
                'type_id' => 3,
                'form_name_en' => 'Service Awards - Internal',
                'form_name_ar'=>'جوائز الخدمة - الداخلية',
                'static_file'=>'service_awards_internal'
            ],
            [
                'id' => 27,
                'type_id' => 3,
                'form_name_en' => 'Consulting Activities - Organization Paid',
                'form_name_ar'=>'الأنشطة الاستشارية - المنظمة المدفوعة',
                'static_file'=>'consulting'
            ],
            [
                'id' => 28,
                'type_id' => 1,
                'form_name_en' => 'Adviser for Student Organization(s)',
                'form_name_ar'=>'نصائح للمنظمات الطلابية',
                'static_file'=>'adviser_for_student_organization'
            ],
            [
                'id' => 29,
                'type_id' => 1,
                'form_name_en' => 'Post-Doctoral Students ',
                'form_name_ar'=>'طلاب ما بعد الدكتوراة',
                'static_file'=>'post-doctoral_students'
            ],
            [
                'id' => 30,
                'type_id' => 1,
                'form_name_en' => 'Instructional techniques Utilized',
                'form_name_ar'=>'التقنيات التعليمية المستخدمة',
                'static_file'=>'instructional_techniques_utilized'
            ],
            [
                'id' => 31,
                'type_id' => 1,
                'form_name_en' => 'Undergraduate Projects Completed',
                'form_name_ar'=>'مشاريع التخرج المنتجزة',
                'static_file'=>'undergraduate_projects_completed'
            ],
            [
                'id' => 32,
                'type_id' => 1,
                'form_name_en' => 'Current Ph.D. Students and Support',
                'form_name_ar'=>'دعم وطلاب الدكتوراة الحاليين',
                'static_file'=>'current_phD_students_and_support'
            ],
            [
                'id' => 33,
                'type_id' => 1,
                'form_name_en' => 'Current MS Students and Support',
                'form_name_ar'=>'دعم وطلاب الماجستير الحاليين',
                'static_file'=>'current_MS_students_and_support'
            ],
            [
                'id' => 34,
                'type_id' => 1,
                'form_name_en' => 'Current Undergraduate Students',
                'form_name_ar'=>'الطلاب الجامعيين الحاليين',
                'static_file'=>'current_undergraduate_students'
            ],
            [
                'id' => 35,
                'type_id' => 2,
                'form_name_en' => 'Journal Articles - Referred',
                'form_name_ar'=>'مقالات صحفية محكمة',
                'static_file'=>'journal_articles_refereed'
            ],
            [
                'id' => 36,
                'type_id' => 2,
                'form_name_en' => 'Journal Articles - Non Referred',
                'form_name_ar'=>'مقالات صحفية غير محكمة',
                'static_file'=>'journal_articles_non_refereed'
            ],
            [
                'id' => 37,
                'type_id' => 2,
                'form_name_en' => 'Conference Proceedings - Referred',
                'form_name_ar'=>'وقائع المؤتمر المحكمة',
                'static_file'=>'conference_proceedings_refereed'
            ],
            [
                'id' => 38,
                'type_id' => 2,
                'form_name_en' => 'Conference Proceedings - Non Referred',
                'form_name_ar'=>'وقائع المؤتمر غير المحكمة',
                'static_file'=>'conference_proceedings_non_refereed'
            ],
            [
                'id' => 39,
                'type_id' => 2,
                'form_name_en' => 'Books - Unpublished',
                'form_name_ar'=>'الكتب - كتب جديدة',
                'static_file'=>'books_new_books'
            ],
            [
                'id' => 40,
                'type_id' => 2,
                'form_name_en' => 'Books - Edited or Revised',
                'form_name_ar'=>'كتب - تعديل ومراجعة',
                'static_file'=>'books_edited_or_revised'
            ],
            [
                'id' => 41,
                'type_id' => 2,
                'form_name_en' => 'Books - Chapters',
                'form_name_ar'=>'الكتب - فصول',
                'static_file'=>'book_chapters'
            ],
            [
                'id' => 42,
                'type_id' => 2,
                'form_name_en' => 'Books - Published',
                'form_name_ar'=>'الكتب - كتب منشورة',
                'static_file'=>'book_published_book'
            ],
            [
                'id' => 43,
                'type_id' => 2,
                'form_name_en' => 'Meetings and Conferences',
                'form_name_ar'=>'الاجتماعات والمؤتمرات',
                'static_file'=>'meetings_and_conferences'
            ],
            [
                'id' => 44,
                'type_id' => 2,
                'form_name_en' => 'Workshops and Short Courses',
                'form_name_ar'=>'ورشات العمل والدورات القصيرة',
                'static_file'=>'workshops_and_short_courses'
            ],
            [
                'id' => 45,
                'type_id' => 2,
                'form_name_en' => 'Seminars at Other Universities or Industries',
                'form_name_ar'=>'ندوات في الجامعات أو المؤسسات الأخرى',
                'static_file'=>'seminars_at_other_universities_or_industry'
            ],
            [
                'id' => 46,
                'type_id' => 2,
                'form_name_en' => 'Patents',
                'form_name_ar'=>'براءات الاختراع',
                'static_file'=>'patents'
            ],
            [
                'id' => 47,
                'type_id' => 2,
                'form_name_en' => 'Intellectual Property Disclosures',
                'form_name_ar'=>'الإفصاح عن الملكية الفكرية',
                'static_file'=>'intellectual_property_disclosures'
            ],
            [
                'id' => 48,
                'type_id' => 2,
                'form_name_en' => 'Computer Software',
                'form_name_ar'=>'برامج الكمبيوتر',
                'static_file'=>'computer_software'
            ],
            [
                'id' => 49,
                'type_id' => 2,
                'form_name_en' => 'Governmental Grants',
                'form_name_ar'=>'المنح الحكومية',
                'static_file'=>'governmental_grants'
            ],
            [
                'id' => 50,
                'type_id' => 2,
                'form_name_en' => 'External, Non-Governmental Grants',
                'form_name_ar'=>'المنح الخارجية غير الحكومية',
                'static_file'=>'external_non_governmental_grants'
            ],
            [
                'id' => 51,
                'type_id' => 2,
                'form_name_en' => 'Internal, University Grants',
                'form_name_ar'=>'المنح الجامعية الداخلية',
                'static_file'=>'internal_university_grants'
            ],
            [
                'id' => 52,
                'type_id' => 2,
                'form_name_en' => 'Successful New Grants Received',
                'form_name_ar'=>'الحصول على منح جديدة ناجحة',
                'static_file'=>'successful_new_grants_received'
            ],
            [
                'id' => 53,
                'type_id' => 2,
                'form_name_en' => 'Proposals Declined, or Submitted and Pending',
                'form_name_ar'=>'المقترحات المرفوضة أو المرسلة أو المعلقة ',
                'static_file'=>'proposals_declined_or_submitted_and_pending'
            ],
        ];
        
        foreach ($faculty_data as $faculty) {
            $this->db->set('id', $faculty['id']);
            $this->db->set('type_id', $faculty['type_id']);
            $this->db->set('form_name_en', $faculty['form_name_en']);
            $this->db->set('form_name_ar', $faculty['form_name_ar']);
            $this->db->set('static_file', $faculty['static_file']);
            $this->db->set('created_at',date('Y-m-d H:i:s'));
            $this->db->set('updated_at',date('Y-m-d H:i:s'));
            $this->db->insert('fp_forms');
        }
        
        $faculty_data = [
            [
                "id" => 1,
                "form_id" => 1,
                "input_label_en" => "Publication Name",
                "input_label_ar" => "اسم النشر",
            ],
            [
                "id" => 2,
                "form_id" => 1,
                "input_label_en" => "Member of Editorial Board",
                "input_label_ar" => "عضو هيئة التحرير",
            ],
            [
                "id" => 3,
                "form_id" => 3,
                "input_label_en" => "Chair Name",
                "input_label_ar" => "اسم المنظم",
            ],
            [
                "id" => 4,
                "form_id" => 4,
                "input_label_en" => "Semester",
                "input_label_ar" => "الفصل الدراسي",
            ],

            [
                "id" => 6,
                "form_id" => 4,
                "input_label_en" => "Course Title",
                "input_label_ar" => "اسم المادة",
            ],
            [
                "id" => 7,
                "form_id" => 4,
                "input_label_en" => "Brief Description",
                "input_label_ar" => "وصف عام",
            ],
            [
                "id" => 8,
                "form_id" => 5,
                "input_label_en" => "Chair Name",
                "input_label_ar" => "اسم المنظم",
            ],
            [
                "id" => 9,
                "form_id" => 6,
                "input_label_en" => "Semester",
                "input_label_ar" => "الفصل الدراسي",
            ],

            [
                "id" => 11,
                "form_id" => 6,
                "input_label_en" => "Course Title",
                "input_label_ar" => "اسم المادة",
            ],
            [
                "id" => 12,
                "form_id" => 6,
                "input_label_en" => "Brief Description",
                "input_label_ar" => "وصف عام",
            ],
            [
                "id" => 13,
                "form_id" => 7,
                "input_label_en" => "Chair Name",
                "input_label_ar" => "اسم المنظم",
            ],
            [
                "id" => 14,
                "form_id" => 8,
                "input_label_en" => "Committee Name",
                "input_label_ar" => "اسم اللجنة",
            ],
            [
                "id" => 15,
                "form_id" => 9,
                "input_label_en" => "Committee Name",
                "input_label_ar" => "اسم اللجنة",
            ],
            [
                "id" => 16,
                "form_id" => 10,
                "input_label_en" => "Committee Name",
                "input_label_ar" => "اسم اللجنة",
            ],
            [
                "id" => 17,
                "form_id" => 11,
                "input_label_en" => "Committee Name",
                "input_label_ar" => "اسم اللجنة",
            ],
            [
                "id" => 18,
                "form_id" => 16,
                "input_label_en" => "Committee Name",
                "input_label_ar" => "اسم اللجنة",
            ],
            [
                "id" => 20,
                "form_id" => 14,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 21,
                "form_id" => 14,
                "input_label_en" => "Degree",
                "input_label_ar" => "الدرجة العملية",
            ],
            [
                "id" => 22,
                "form_id" => 14,
                "input_label_en" => "Thesis Title",
                "input_label_ar" => "عنوان الرسالة",
            ],
            [
                "id" => 23,
                "form_id" => 14,
                "input_label_en" => "Student Position",
                "input_label_ar" => "وضع الطالب",
            ],
            [
                "id" => 24,
                "form_id" => 15,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 25,
                "form_id" => 15,
                "input_label_en" => "Degree",
                "input_label_ar" => "الدرجة العلمية",
            ],
            [
                "id" => 26,
                "form_id" => 15,
                "input_label_en" => "Thesis Title",
                "input_label_ar" => "عنوان الرسالة",
            ],
            [
                "id" => 27,
                "form_id" => 15,
                "input_label_en" => "Student Position",
                "input_label_ar" => "وضع الطالب",
            ],
            [
                "id" => 28,
                "form_id" => 28,
                "input_label_en" => "Summary",
                "input_label_ar" => "المراجعة",
            ],
            [
                "id" => 29,
                "form_id" => 29,
                "input_label_en" => "Summary",
                "input_label_ar" => "المراجعة",
            ],
            [
                "id" => 30,
                "form_id" => 30,
                "input_label_en" => "Summary",
                "input_label_ar" => "المراجعة",
            ],
            [
                "id" => 31,
                "form_id" => 31,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 32,
                "form_id" => 31,
                "input_label_en" => "Program",
                "input_label_ar" => "البرنامج",
            ],
            [
                "id" => 33,
                "form_id" => 31,
                "input_label_en" => "Project Title",
                "input_label_ar" => "اسم المشروع",
            ],
            [
                "id" => 34,
                "form_id" => 32,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 35,
                "form_id" => 32,
                "input_label_en" => "Department",
                "input_label_ar" => "القسم",
            ],
            [
                "id" => 36,
                "form_id" => 32,
                "input_label_en" => "Type Support",
                "input_label_ar" => "نوع الدعم",
            ],
            [
                "id" => 37,
                "form_id" => 32,
                "input_label_en" => "Department Support",
                "input_label_ar" => "دعم القسم",
            ],
            [
                "id" => 38,
                "form_id" => 33,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 39,
                "form_id" => 33,
                "input_label_en" => "Department",
                "input_label_ar" => "القسم",
            ],
            [
                "id" => 40,
                "form_id" => 33,
                "input_label_en" => "Type Support",
                "input_label_ar" => "نوع الدعم",
            ],
            [
                "id" => 41,
                "form_id" => 33,
                "input_label_en" => "Department Support",
                "input_label_ar" => "دعم القسم",
            ],
            [
                "id" => 42,
                "form_id" => 34,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 43,
                "form_id" => 34,
                "input_label_en" => "Program",
                "input_label_ar" => "البرنامج",
            ],
            [
                "id" => 44,
                "form_id" => 34,
                "input_label_en" => "Year",
                "input_label_ar" => "السنة",
            ],
            [
                "id" => 45,
                "form_id" => 12,
                "input_label_en" => "Semester",
                "input_label_ar" => "الفصل الدراسي",
            ],

            [
                "id" => 47,
                "form_id" => 12,
                "input_label_en" => "Course Title",
                "input_label_ar" => "اسم المادة",
            ],
            [
                "id" => 48,
                "form_id" => 12,
                "input_label_en" => "Brief Description",
                "input_label_ar" => "وصف عام",
            ],
            [
                "id" => 49,
                "form_id" => 13,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 50,
                "form_id" => 13,
                "input_label_en" => "Degree",
                "input_label_ar" => "الدرجة العلمية",
            ],
            [
                "id" => 51,
                "form_id" => 13,
                "input_label_en" => "Thesis Title",
                "input_label_ar" => "عنوان الرسالة",
            ],
            [
                "id" => 52,
                "form_id" => 13,
                "input_label_en" => "Student Position",
                "input_label_ar" => "وضع الطالب",
            ],
            [
                "id" => 53,
                "form_id" => 2,
                "input_label_en" => "Semester",
                "input_label_ar" => "الفصل الدراسي",
            ],

            [
                "id" => 55,
                "form_id" => 2,
                "input_label_en" => "Course Title",
                "input_label_ar" => "اسم المادة",
            ],
            [
                "id" => 600,
                "form_id" => 35,
                "input_label_en" => "Appeared and Accepted",
                "input_label_ar" => "الظهور والقبول",
            ],
            [
                "id" => 57,
                "form_id" => 2,
                "input_label_en" => "Number of Students Enrolled",
                "input_label_ar" => "عدد الطلاب المسجلين",
            ],
            [
                "id" => 58,
                "form_id" => 2,
                "input_label_en" => "Course Evaluation Overall Rating",
                "input_label_ar" => "التقييم العام للمادة الدراسية",
            ],
            [
                "id" => 59,
                "form_id" => 36,
                "input_label_en" => "Article Title",
                "input_label_ar" => "غير الحكم",
            ],
            [
                "id" => 60,
                "form_id" => 35,
                "input_label_en" => "Article Title",
                "input_label_ar" => "الحكم",
            ],
            [
                "id" => 61,
                "form_id" => 36,
                "input_label_en" => "Appeared and Accepted",
                "input_label_ar" => "الظهور والقبول",
            ],
            [
                "id" => 63,
                "form_id" => 37,
                "input_label_en" => "Appeared and Accepted",
                "input_label_ar" => "الظهور والقبول",
            ],
            [
                "id" => 62,
                "form_id" => 37,
                "input_label_en" => "Name",
                "input_label_ar" => "الحكم",
            ],
            [
                "id" => 65,
                "form_id" => 38,
                "input_label_en" => "Appeared and Accepted",
                "input_label_ar" => "الظهور والقبول",
            ],
            [
                "id" => 64,
                "form_id" => 38,
                "input_label_en" => "Name",
                "input_label_ar" => "غير الحكم",
            ],
            [
                "id" => 67,
                "form_id" => 39,
                "input_label_en" => "Book Title",
                "input_label_ar" => "كتاب جديد",
            ],
            [
                "id" => 68,
                "form_id" => 39,
                "input_label_en" => "Appeared and Accepted",
                "input_label_ar" => "الظهور والقبول",
            ],
            [
                "id" => 69,
                "form_id" => 40,
                "input_label_en" => "Book Title",
                "input_label_ar" => "تعديل أو مراجعة",
            ],
            [
                "id" => 70,
                "form_id" => 40,
                "input_label_en" => "Appeared and Accepted",
                "input_label_ar" => "الظهور والقبول",
            ],
            [
                "id" => 71,
                "form_id" => 41,
                "input_label_en" => "Chapter Title",
                "input_label_ar" => "عنوان الفصل",
            ],
            [
                "id" => 72,
                "form_id" => 41,
                "input_label_en" => "Book",
                "input_label_ar" => "الكتاب",
            ],
            [
                "id" => 73,
                "form_id" => 42,
                "input_label_en" => "Book Title",
                "input_label_ar" => "عنوان الكتاب",
            ],
            [
                "id" => 74,
                "form_id" => 42,
                "input_label_en" => "Reviewed Date",
                "input_label_ar" => "تاريخ المراجعة",
            ],
            [
                "id" => 75,
                "form_id" => 43,
                "input_label_en" => "Presentation Title",
                "input_label_ar" => "عنوان العرض",
            ],
            [
                "id" => 107,
                "form_id" => 51,
                "input_label_en" => "Amount Funded",
                "input_label_ar" => "المبلغ الممول",
            ],
            [
                "id" => 106,
                "form_id" => 51,
                "input_label_en" => "Funding Agency",
                "input_label_ar" => "وكالة التمويل",
            ],
            [
                "id" => 105,
                "form_id" => 51,
                "input_label_en" => "Title",
                "input_label_ar" => "العنوان",
            ],
            [
                "id" => 98,
                "form_id" => 49,
                "input_label_en" => "Your Percentage of Participation",
                "input_label_ar" => "النسبة المئوية الخاص من المشاركة",
            ],
            [
                "id" => 97,
                "form_id" => 49,
                "input_label_en" => "List of PI’s & Co-PIs",
                "input_label_ar" => "قائمة الباحثين الرئيسين والباحثين المشاركين",
            ],
            [
                "id" => 96,
                "form_id" => 49,
                "input_label_en" => "Funding Period",
                "input_label_ar" => "فترة التمويل",
            ],
            [
                "id" => 95,
                "form_id" => 49,
                "input_label_en" => "Amount Funded",
                "input_label_ar" => "المبلغ الممول",
            ],
            [
                "id" => 94,
                "form_id" => 49,
                "input_label_en" => "Funding Agency",
                "input_label_ar" => "وكالة التمويل",
            ],
            [
                "id" => 93,
                "form_id" => 49,
                "input_label_en" => "Title",
                "input_label_ar" => "العنوان",
            ],
            [
                "id" => 104,
                "form_id" => 50,
                "input_label_en" => "Your Percentage of Participation",
                "input_label_ar" => "النسبة المئوية الخاص من المشاركة",
            ],
            [
                "id" => 102,
                "form_id" => 50,
                "input_label_en" => "Funding Period",
                "input_label_ar" => "فترة التمويل",
            ],
            [
                "id" => 103,
                "form_id" => 50,
                "input_label_en" => "List of PI’s & Co-PIs",
                "input_label_ar" => "قائمة الباحثين الرئيسين والباحثين المشاركين",
            ],
            [
                "id" => 99,
                "form_id" => 50,
                "input_label_en" => "Title",
                "input_label_ar" => "العنوان",
            ],
            [
                "id" => 100,
                "form_id" => 50,
                "input_label_en" => "Funding Agency",
                "input_label_ar" => "وكالة التمويل",
            ],
            [
                "id" => 101,
                "form_id" => 50,
                "input_label_en" => "Amount Funded",
                "input_label_ar" => "المبلغ الممول",
            ],
            [
                "id" => 92,
                "form_id" => 48,
                "input_label_en" => "Date",
                "input_label_ar" => "التاريخ",
            ],
            [
                "id" => 91,
                "form_id" => 48,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 83,
                "form_id" => 45,
                "input_label_en" => "Presentation Title",
                "input_label_ar" => "عنوان العرض",
            ],
            [
                "id" => 84,
                "form_id" => 45,
                "input_label_en" => "Location",
                "input_label_ar" => "الموقع",
            ],
            [
                "id" => 86,
                "form_id" => 45,
                "input_label_en" => "Meeting or Conference",
                "input_label_ar" => "الاجتماعات والمؤتمرات",
            ],
            [
                "id" => 85,
                "form_id" => 45,
                "input_label_en" => "Date",
                "input_label_ar" => "التاريخ",
            ],
            [
                "id" => 81,
                "form_id" => 44,
                "input_label_en" => "Date",
                "input_label_ar" => "التاريخ",
            ],
            [
                "id" => 82,
                "form_id" => 44,
                "input_label_en" => "Meeting or Conference",
                "input_label_ar" => "الاجتماعات والمؤتمرات",
            ],
            [
                "id" => 80,
                "form_id" => 44,
                "input_label_en" => "Location",
                "input_label_ar" => "الموقع",
            ],
            [
                "id" => 79,
                "form_id" => 44,
                "input_label_en" => "Presentation Title",
                "input_label_ar" => "عنوان العرض",
            ],
            [
                "id" => 78,
                "form_id" => 43,
                "input_label_en" => "Meeting or Conference",
                "input_label_ar" => "الاجتماعات والمؤتمرات",
            ],
            [
                "id" => 77,
                "form_id" => 43,
                "input_label_en" => "Date",
                "input_label_ar" => "التاريخ",
            ],
            [
                "id" => 76,
                "form_id" => 43,
                "input_label_en" => "Location",
                "input_label_ar" => "الموقع",
            ],
            [
                "id" => 108,
                "form_id" => 51,
                "input_label_en" => "Funding Period",
                "input_label_ar" => "فترة التمويل",
            ],
            [
                "id" => 109,
                "form_id" => 51,
                "input_label_en" => "List of PI’s & Co-PIs",
                "input_label_ar" => "قائمة الباحثين الرئيسين والباحثين المشاركين",
            ],
            [
                "id" => 110,
                "form_id" => 51,
                "input_label_en" => "Your Percentage of Participation",
                "input_label_ar" => "النسبة المئوية الخاص من المشاركة",
            ],
            [
                "id" => 111,
                "form_id" => 52,
                "input_label_en" => "Title",
                "input_label_ar" => "العنوان",
            ],
            [
                "id" => 112,
                "form_id" => 52,
                "input_label_en" => "Funding Agency",
                "input_label_ar" => "وكالة التمويل",
            ],
            [
                "id" => 113,
                "form_id" => 52,
                "input_label_en" => "Amount Funded",
                "input_label_ar" => "المبلغ الممول",
            ],
            [
                "id" => 114,
                "form_id" => 52,
                "input_label_en" => "Funding Period",
                "input_label_ar" => "فترة التمويل",
            ],
            [
                "id" => 115,
                "form_id" => 52,
                "input_label_en" => "List of PI’s & Co-PIs",
                "input_label_ar" => "قائمة الباحثين الرئيسين والباحثين المشاركين",
            ],
            [
                "id" => 116,
                "form_id" => 52,
                "input_label_en" => "Your Percentage of Participation",
                "input_label_ar" => "النسبة المئوية الخاص من المشاركة",
            ],
            [
                "id" => 117,
                "form_id" => 53,
                "input_label_en" => "Title",
                "input_label_ar" => "العنوان",
            ],
            [
                "id" => 118,
                "form_id" => 53,
                "input_label_en" => "Funding Agency",
                "input_label_ar" => "وكالة التمويل",
            ],
            [
                "id" => 119,
                "form_id" => 53,
                "input_label_en" => "Amount Funded",
                "input_label_ar" => "المبلغ الممول",
            ],
            [
                "id" => 120,
                "form_id" => 53,
                "input_label_en" => "Funding Period",
                "input_label_ar" => "فترة التمويل",
            ],
            [
                "id" => 121,
                "form_id" => 53,
                "input_label_en" => "List of PI’s & Co-PIs",
                "input_label_ar" => "قائمة الباحثين الرئيسين والباحثين المشاركين",
            ],
            [
                "id" => 122,
                "form_id" => 53,
                "input_label_en" => "Your Percentage of Participation",
                "input_label_ar" => "النسبة المئوية الخاص من المشاركة",
            ],
            [
                "id" => 123,
                "form_id" => 17,
                "input_label_en" => "Title",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 124,
                "form_id" => 18,
                "input_label_en" => "Organization Name",
                "input_label_ar" => "اسم المنظمة",
            ],
            [
                "id" => 125,
                "form_id" => 18,
                "input_label_en" => "Number of Days",
                "input_label_ar" => "عدد الأيام",
            ],
            [
                "id" => 126,
                "form_id" => 19,
                "input_label_en" => "Organization Name",
                "input_label_ar" => "اسم المنظمة",
            ],
            [
                "id" => 127,
                "form_id" => 19,
                "input_label_en" => "Number of Days",
                "input_label_ar" => "عدد الأيام",
            ],
            [
                "id" => 128,
                "form_id" => 20,
                "input_label_en" => "Organization Name",
                "input_label_ar" => "اسم المنظمة",
            ],
            [
                "id" => 129,
                "form_id" => 20,
                "input_label_en" => "Number of Days",
                "input_label_ar" => "عدد الأيام",
            ],
            [
                "id" => 130,
                "form_id" => 21,
                "input_label_en" => "Award Name",
                "input_label_ar" => "اسم الجائزة",
            ],
            [
                "id" => 131,
                "form_id" => 22,
                "input_label_en" => "Award Name",
                "input_label_ar" => "اسم الجائزة",
            ],
            [
                "id" => 132,
                "form_id" => 23,
                "input_label_en" => "Award Name",
                "input_label_ar" => "اسم الجائزة",
            ],
            [
                "id" => 133,
                "form_id" => 24,
                "input_label_en" => "Award Name",
                "input_label_ar" => "اسم الجائزة",
            ],
            [
                "id" => 134,
                "form_id" => 25,
                "input_label_en" => "Award Name",
                "input_label_ar" => "اسم الجائزة",
            ],
            [
                "id" => 135,
                "form_id" => 26,
                "input_label_en" => "Award Name",
                "input_label_ar" => "اسم الجائزة",
            ],
            [
                "id" => 136,
                "form_id" => 27,
                "input_label_en" => "Organization Name",
                "input_label_ar" => "اسم المنظمة",
            ],
            [
                "id" => 137,
                "form_id" => 27,
                "input_label_en" => "Number of Days",
                "input_label_ar" => "عدد الأيام",
            ],
            [
                "id" => 138,
                "form_id" => 46,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 139,
                "form_id" => 46,
                "input_label_en" => "Date",
                "input_label_ar" => "التاريخ",
            ],
            [
                "id" => 140,
                "form_id" => 47,
                "input_label_en" => "Name",
                "input_label_ar" => "الاسم",
            ],
            [
                "id" => 141,
                "form_id" => 47,
                "input_label_en" => "Date",
                "input_label_ar" => "التاريخ",
            ]
        ];
        
        foreach ($faculty_data as $faculty) {
            $this->db->set('id', $faculty['id']);
            $this->db->set('form_id', $faculty['form_id']);
            $this->db->set('input_label_en', $faculty['input_label_en']);
            $this->db->set('input_label_ar', $faculty['input_label_ar']);
            $this->db->set('created_at',date('Y-m-d H:i:s'));
            $this->db->set('updated_at',date('Y-m-d H:i:s'));
            $this->db->insert('fp_forms_inputs');
        }
    }
    
    public function down()
    {
        $this->db->truncate('fp_forms_type');
        $this->db->truncate('fp_forms_inputs');
        $this->db->truncate('fp_forms');
    }
}