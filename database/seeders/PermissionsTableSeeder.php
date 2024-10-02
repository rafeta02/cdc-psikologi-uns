<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'blog_master_access',
            ],
            [
                'id'    => 20,
                'title' => 'article_category_create',
            ],
            [
                'id'    => 21,
                'title' => 'article_category_edit',
            ],
            [
                'id'    => 22,
                'title' => 'article_category_show',
            ],
            [
                'id'    => 23,
                'title' => 'article_category_delete',
            ],
            [
                'id'    => 24,
                'title' => 'article_category_access',
            ],
            [
                'id'    => 25,
                'title' => 'article_tag_create',
            ],
            [
                'id'    => 26,
                'title' => 'article_tag_edit',
            ],
            [
                'id'    => 27,
                'title' => 'article_tag_show',
            ],
            [
                'id'    => 28,
                'title' => 'article_tag_delete',
            ],
            [
                'id'    => 29,
                'title' => 'article_tag_access',
            ],
            [
                'id'    => 30,
                'title' => 'post_create',
            ],
            [
                'id'    => 31,
                'title' => 'post_edit',
            ],
            [
                'id'    => 32,
                'title' => 'post_show',
            ],
            [
                'id'    => 33,
                'title' => 'post_delete',
            ],
            [
                'id'    => 34,
                'title' => 'post_access',
            ],
            [
                'id'    => 35,
                'title' => 'vacancy_master_access',
            ],
            [
                'id'    => 36,
                'title' => 'education_create',
            ],
            [
                'id'    => 37,
                'title' => 'education_edit',
            ],
            [
                'id'    => 38,
                'title' => 'education_show',
            ],
            [
                'id'    => 39,
                'title' => 'education_delete',
            ],
            [
                'id'    => 40,
                'title' => 'education_access',
            ],
            [
                'id'    => 41,
                'title' => 'position_create',
            ],
            [
                'id'    => 42,
                'title' => 'position_edit',
            ],
            [
                'id'    => 43,
                'title' => 'position_show',
            ],
            [
                'id'    => 44,
                'title' => 'position_delete',
            ],
            [
                'id'    => 45,
                'title' => 'position_access',
            ],
            [
                'id'    => 46,
                'title' => 'department_create',
            ],
            [
                'id'    => 47,
                'title' => 'department_edit',
            ],
            [
                'id'    => 48,
                'title' => 'department_show',
            ],
            [
                'id'    => 49,
                'title' => 'department_delete',
            ],
            [
                'id'    => 50,
                'title' => 'department_access',
            ],
            [
                'id'    => 51,
                'title' => 'industry_create',
            ],
            [
                'id'    => 52,
                'title' => 'industry_edit',
            ],
            [
                'id'    => 53,
                'title' => 'industry_show',
            ],
            [
                'id'    => 54,
                'title' => 'industry_delete',
            ],
            [
                'id'    => 55,
                'title' => 'industry_access',
            ],
            [
                'id'    => 56,
                'title' => 'area_access',
            ],
            [
                'id'    => 57,
                'title' => 'province_create',
            ],
            [
                'id'    => 58,
                'title' => 'province_edit',
            ],
            [
                'id'    => 59,
                'title' => 'province_show',
            ],
            [
                'id'    => 60,
                'title' => 'province_delete',
            ],
            [
                'id'    => 61,
                'title' => 'province_access',
            ],
            [
                'id'    => 62,
                'title' => 'regency_create',
            ],
            [
                'id'    => 63,
                'title' => 'regency_edit',
            ],
            [
                'id'    => 64,
                'title' => 'regency_show',
            ],
            [
                'id'    => 65,
                'title' => 'regency_delete',
            ],
            [
                'id'    => 66,
                'title' => 'regency_access',
            ],
            [
                'id'    => 67,
                'title' => 'company_create',
            ],
            [
                'id'    => 68,
                'title' => 'company_edit',
            ],
            [
                'id'    => 69,
                'title' => 'company_show',
            ],
            [
                'id'    => 70,
                'title' => 'company_delete',
            ],
            [
                'id'    => 71,
                'title' => 'company_access',
            ],
            [
                'id'    => 72,
                'title' => 'tracer_access',
            ],
            [
                'id'    => 73,
                'title' => 'tracer_alumnu_create',
            ],
            [
                'id'    => 74,
                'title' => 'tracer_alumnu_edit',
            ],
            [
                'id'    => 75,
                'title' => 'tracer_alumnu_show',
            ],
            [
                'id'    => 76,
                'title' => 'tracer_alumnu_delete',
            ],
            [
                'id'    => 77,
                'title' => 'tracer_alumnu_access',
            ],
            [
                'id'    => 78,
                'title' => 'tracer_stakeholder_create',
            ],
            [
                'id'    => 79,
                'title' => 'tracer_stakeholder_edit',
            ],
            [
                'id'    => 80,
                'title' => 'tracer_stakeholder_show',
            ],
            [
                'id'    => 81,
                'title' => 'tracer_stakeholder_delete',
            ],
            [
                'id'    => 82,
                'title' => 'tracer_stakeholder_access',
            ],
            [
                'id'    => 83,
                'title' => 'prestasi_access',
            ],
            [
                'id'    => 84,
                'title' => 'prestasi_mahasiswa_create',
            ],
            [
                'id'    => 85,
                'title' => 'prestasi_mahasiswa_edit',
            ],
            [
                'id'    => 86,
                'title' => 'prestasi_mahasiswa_show',
            ],
            [
                'id'    => 87,
                'title' => 'prestasi_mahasiswa_delete',
            ],
            [
                'id'    => 88,
                'title' => 'prestasi_mahasiswa_access',
            ],
            [
                'id'    => 89,
                'title' => 'prestasi_mahasiswa_detail_access',
            ],
            [
                'id'    => 90,
                'title' => 'competence_create',
            ],
            [
                'id'    => 91,
                'title' => 'competence_edit',
            ],
            [
                'id'    => 92,
                'title' => 'competence_show',
            ],
            [
                'id'    => 93,
                'title' => 'competence_delete',
            ],
            [
                'id'    => 94,
                'title' => 'competence_access',
            ],
            [
                'id'    => 95,
                'title' => 'competence_item_create',
            ],
            [
                'id'    => 96,
                'title' => 'competence_item_edit',
            ],
            [
                'id'    => 97,
                'title' => 'competence_item_show',
            ],
            [
                'id'    => 98,
                'title' => 'competence_item_delete',
            ],
            [
                'id'    => 99,
                'title' => 'competence_item_access',
            ],
            [
                'id'    => 100,
                'title' => 'kompetensi_access',
            ],
            [
                'id'    => 101,
                'title' => 'result_access',
            ],
            [
                'id'    => 102,
                'title' => 'result_competence_create',
            ],
            [
                'id'    => 103,
                'title' => 'result_competence_edit',
            ],
            [
                'id'    => 104,
                'title' => 'result_competence_show',
            ],
            [
                'id'    => 105,
                'title' => 'result_competence_delete',
            ],
            [
                'id'    => 106,
                'title' => 'result_competence_access',
            ],
            [
                'id'    => 107,
                'title' => 'result_assessment_create',
            ],
            [
                'id'    => 108,
                'title' => 'result_assessment_edit',
            ],
            [
                'id'    => 109,
                'title' => 'result_assessment_show',
            ],
            [
                'id'    => 110,
                'title' => 'result_assessment_delete',
            ],
            [
                'id'    => 111,
                'title' => 'result_assessment_access',
            ],
            [
                'id'    => 112,
                'title' => 'holland_test_show',
            ],
            [
                'id'    => 113,
                'title' => 'holland_test_access',
            ],
            [
                'id'    => 114,
                'title' => 'work_readiness_test_access',
            ],
            [
                'id'    => 115,
                'title' => 'career_confidence_test_access',
            ],
            [
                'id'    => 116,
                'title' => 'vacancy_create',
            ],
            [
                'id'    => 117,
                'title' => 'vacancy_edit',
            ],
            [
                'id'    => 118,
                'title' => 'vacancy_show',
            ],
            [
                'id'    => 119,
                'title' => 'vacancy_delete',
            ],
            [
                'id'    => 120,
                'title' => 'vacancy_access',
            ],
            [
                'id'    => 121,
                'title' => 'prestasi_maba_create',
            ],
            [
                'id'    => 122,
                'title' => 'prestasi_maba_edit',
            ],
            [
                'id'    => 123,
                'title' => 'prestasi_maba_show',
            ],
            [
                'id'    => 124,
                'title' => 'prestasi_maba_delete',
            ],
            [
                'id'    => 125,
                'title' => 'prestasi_maba_access',
            ],
            [
                'id'    => 126,
                'title' => 'kategori_prestasi_create',
            ],
            [
                'id'    => 127,
                'title' => 'kategori_prestasi_edit',
            ],
            [
                'id'    => 128,
                'title' => 'kategori_prestasi_show',
            ],
            [
                'id'    => 129,
                'title' => 'kategori_prestasi_delete',
            ],
            [
                'id'    => 130,
                'title' => 'kategori_prestasi_access',
            ],
            [
                'id'    => 131,
                'title' => 'question_create',
            ],
            [
                'id'    => 132,
                'title' => 'question_edit',
            ],
            [
                'id'    => 133,
                'title' => 'question_show',
            ],
            [
                'id'    => 134,
                'title' => 'question_delete',
            ],
            [
                'id'    => 135,
                'title' => 'question_access',
            ],
            [
                'id'    => 136,
                'title' => 'experience_create',
            ],
            [
                'id'    => 137,
                'title' => 'experience_edit',
            ],
            [
                'id'    => 138,
                'title' => 'experience_show',
            ],
            [
                'id'    => 139,
                'title' => 'experience_delete',
            ],
            [
                'id'    => 140,
                'title' => 'experience_access',
            ],
            [
                'id'    => 141,
                'title' => 'vacancy_tag_create',
            ],
            [
                'id'    => 142,
                'title' => 'vacancy_tag_edit',
            ],
            [
                'id'    => 143,
                'title' => 'vacancy_tag_show',
            ],
            [
                'id'    => 144,
                'title' => 'vacancy_tag_delete',
            ],
            [
                'id'    => 145,
                'title' => 'vacancy_tag_access',
            ],
            [
                'id'    => 146,
                'title' => 'assessment_access',
            ],
            [
                'id'    => 147,
                'title' => 'mahasiswa_create',
            ],
            [
                'id'    => 148,
                'title' => 'mahasiswa_edit',
            ],
            [
                'id'    => 149,
                'title' => 'mahasiswa_show',
            ],
            [
                'id'    => 150,
                'title' => 'mahasiswa_delete',
            ],
            [
                'id'    => 151,
                'title' => 'mahasiswa_access',
            ],
            [
                'id'    => 152,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
