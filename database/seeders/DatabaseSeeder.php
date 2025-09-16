<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Models\Industry;
use App\Models\Position;
use App\Models\Education;
use App\Models\Department;
use App\Models\Company;
use App\Models\Post;
use App\Models\Vacancy;
use App\Models\Regency;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Base user and permission seeders
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
        ]);

        // // Independent model seeders (no foreign key dependencies)
        // $this->call([
        //     ArticleCategoriesTableSeeder::class,
        //     ArticleTagsTableSeeder::class,
        //     DepartmentsTableSeeder::class,
        //     EducationsTableSeeder::class,
        //     ExperiencesTableSeeder::class,
        //     IndustriesTableSeeder::class,
        //     PositionsTableSeeder::class,
        //     VacancyTagsTableSeeder::class,
        //     KategoriPrestasisTableSeeder::class,
        //     ProvincesTableSeeder::class,
        // ]);

        // // Dependent model seeders (with foreign key dependencies)
        // $this->call([
        //     RegenciesTableSeeder::class,      // depends on Province
        //     CompetencesTableSeeder::class,    // independent
        //     CompaniesTableSeeder::class,      // depends on Industry, Regency
        // ]);

        // // Complex model seeders (multiple dependencies)
        // $this->call([
        //     CompetenceItemsTableSeeder::class, // depends on Competence
        //     MahasiswasTableSeeder2::class,     // depends on User
        //     PostsTableSeeder::class,           // depends on User
        //     VacanciesTableSeeder::class,       // depends on Company, Experience, Position, Industry, User
        //     MagangsTableSeeder::class,         // depends on Company, User
        // ]);

        // // Optional: Create relationships for many-to-many tables
        // $this->createPostRelationships();
        // $this->createVacancyRelationships();
    }

    /**
     * Create relationships for posts with categories and tags
     */
    private function createPostRelationships()
    {
        $posts = Post::all();
        $tags = ArticleTag::all();
        $categories = ArticleCategory::all();

        foreach ($posts as $post) {
            // Attach random tags (1-3 tags per post)
            $randomTags = $tags->random(rand(1, 3))->pluck('id')->toArray();
            $post->tags()->attach($randomTags);

            // Attach random categories (1-2 categories per post)
            $randomCategories = $categories->random(rand(1, 2))->pluck('id')->toArray();
            $post->categories()->attach($randomCategories);
        }
    }

    /**
     * Create relationships for vacancies with educations, departments, and locations
     */
    private function createVacancyRelationships()
    {
        $vacancies = Vacancy::all();
        $educations = Education::all();
        $departments = Department::all();
        $locations = Regency::all();

        foreach ($vacancies as $vacancy) {
            // Attach random educations (1-2 educations per vacancy)
            $randomEducations = $educations->random(rand(1, 2))->pluck('id')->toArray();
            $vacancy->education()->attach($randomEducations);

            // Attach random departments (1-3 departments per vacancy)
            $randomDepartments = $departments->random(rand(1, 3))->pluck('id')->toArray();
            $vacancy->departments()->attach($randomDepartments);

            // Attach random locations (1-2 locations per vacancy)
            $randomLocations = $locations->random(rand(1, 2))->pluck('id')->toArray();
            $vacancy->locations()->attach($randomLocations);
        }
    }
}
