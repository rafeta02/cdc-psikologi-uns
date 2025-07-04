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
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            // MahasiswasTableSeeder::class,
        ]);

        // ArticleCategory::factory()->count(10)->create();
        // ArticleTag::factory()->count(30)->create();
        // Industry::factory()->count(15)->create();
        // Position::factory()->count(20)->create();
        // Education::factory()->count(30)->create();
        // Department::factory()->count(25)->create();
        // Company::factory()->count(20)->create();


        // Vacancy::factory()->count(50)->create();

        // $vacancies = Vacancy::all();
        // $educations = Education::all(); // Fetch all available tags
        // $departments = Department::all(); // Fetch all available tags
        // $locations = Regency::all(); // Fetch all available tags

        // foreach ($vacancies as $vacancy) {
        //     $vacancy->education()->attach(
        //         $educations->random(1)->pluck('id')->toArray() // Attaching 3 random tags
        //     );
        //     $vacancy->departments()->attach(
        //         $departments->random(2)->pluck('id')->toArray() // Attaching 3 random tags
        //     );
        //     $vacancy->locations()->attach(
        //         $locations->random(2)->pluck('id')->toArray() // Attaching 3 random tags
        //     );
        // }


        // Post::factory()->count(50)->create();

        // // Assuming you want to assign tags to each post
        // $posts = Post::all();
        // $tags = ArticleTag::all(); // Fetch all available tags
        // $categories = ArticleCategory::all(); // Fetch all available tags

        // foreach ($posts as $post) {
        //     $post->tags()->attach(
        //         $tags->random(2)->pluck('id')->toArray() // Attaching 3 random tags
        //     );
        //     $post->categories()->attach(
        //         $categories->random(1)->pluck('id')->toArray() // Attaching 3 random tags
        //     );
        // }
    }
}
