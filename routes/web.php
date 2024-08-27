<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Article Category
    Route::delete('article-categories/destroy', 'ArticleCategoryController@massDestroy')->name('article-categories.massDestroy');
    Route::post('article-categories/parse-csv-import', 'ArticleCategoryController@parseCsvImport')->name('article-categories.parseCsvImport');
    Route::post('article-categories/process-csv-import', 'ArticleCategoryController@processCsvImport')->name('article-categories.processCsvImport');
    Route::resource('article-categories', 'ArticleCategoryController');

    // Article Tag
    Route::delete('article-tags/destroy', 'ArticleTagController@massDestroy')->name('article-tags.massDestroy');
    Route::post('article-tags/parse-csv-import', 'ArticleTagController@parseCsvImport')->name('article-tags.parseCsvImport');
    Route::post('article-tags/process-csv-import', 'ArticleTagController@processCsvImport')->name('article-tags.processCsvImport');
    Route::resource('article-tags', 'ArticleTagController');

    // Post
    Route::delete('posts/destroy', 'PostController@massDestroy')->name('posts.massDestroy');
    Route::post('posts/media', 'PostController@storeMedia')->name('posts.storeMedia');
    Route::post('posts/ckmedia', 'PostController@storeCKEditorImages')->name('posts.storeCKEditorImages');
    Route::post('posts/parse-csv-import', 'PostController@parseCsvImport')->name('posts.parseCsvImport');
    Route::post('posts/process-csv-import', 'PostController@processCsvImport')->name('posts.processCsvImport');
    Route::resource('posts', 'PostController');

    // Education
    Route::delete('educations/destroy', 'EducationController@massDestroy')->name('educations.massDestroy');
    Route::post('educations/parse-csv-import', 'EducationController@parseCsvImport')->name('educations.parseCsvImport');
    Route::post('educations/process-csv-import', 'EducationController@processCsvImport')->name('educations.processCsvImport');
    Route::resource('educations', 'EducationController');

    // Position
    Route::delete('positions/destroy', 'PositionController@massDestroy')->name('positions.massDestroy');
    Route::post('positions/parse-csv-import', 'PositionController@parseCsvImport')->name('positions.parseCsvImport');
    Route::post('positions/process-csv-import', 'PositionController@processCsvImport')->name('positions.processCsvImport');
    Route::resource('positions', 'PositionController');

    // Department
    Route::delete('departments/destroy', 'DepartmentController@massDestroy')->name('departments.massDestroy');
    Route::post('departments/parse-csv-import', 'DepartmentController@parseCsvImport')->name('departments.parseCsvImport');
    Route::post('departments/process-csv-import', 'DepartmentController@processCsvImport')->name('departments.processCsvImport');
    Route::resource('departments', 'DepartmentController');

    // Industry
    Route::delete('industries/destroy', 'IndustryController@massDestroy')->name('industries.massDestroy');
    Route::post('industries/parse-csv-import', 'IndustryController@parseCsvImport')->name('industries.parseCsvImport');
    Route::post('industries/process-csv-import', 'IndustryController@processCsvImport')->name('industries.processCsvImport');
    Route::resource('industries', 'IndustryController');

    // Province
    Route::delete('provinces/destroy', 'ProvinceController@massDestroy')->name('provinces.massDestroy');
    Route::post('provinces/parse-csv-import', 'ProvinceController@parseCsvImport')->name('provinces.parseCsvImport');
    Route::post('provinces/process-csv-import', 'ProvinceController@processCsvImport')->name('provinces.processCsvImport');
    Route::resource('provinces', 'ProvinceController');

    // Regencies
    Route::delete('regencies/destroy', 'RegenciesController@massDestroy')->name('regencies.massDestroy');
    Route::post('regencies/parse-csv-import', 'RegenciesController@parseCsvImport')->name('regencies.parseCsvImport');
    Route::post('regencies/process-csv-import', 'RegenciesController@processCsvImport')->name('regencies.processCsvImport');
    Route::resource('regencies', 'RegenciesController');

    // Company
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompanyController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompanyController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::post('companies/parse-csv-import', 'CompanyController@parseCsvImport')->name('companies.parseCsvImport');
    Route::post('companies/process-csv-import', 'CompanyController@processCsvImport')->name('companies.processCsvImport');
    Route::resource('companies', 'CompanyController');

    // Tracer Alumni
    Route::delete('tracer-alumnus/destroy', 'TracerAlumniController@massDestroy')->name('tracer-alumnus.massDestroy');
    Route::resource('tracer-alumnus', 'TracerAlumniController');

    // Tracer Stakeholder
    Route::delete('tracer-stakeholders/destroy', 'TracerStakeholderController@massDestroy')->name('tracer-stakeholders.massDestroy');
    Route::post('tracer-stakeholders/media', 'TracerStakeholderController@storeMedia')->name('tracer-stakeholders.storeMedia');
    Route::post('tracer-stakeholders/ckmedia', 'TracerStakeholderController@storeCKEditorImages')->name('tracer-stakeholders.storeCKEditorImages');
    Route::resource('tracer-stakeholders', 'TracerStakeholderController');

    // Prestasi Mahasiswa
    Route::delete('prestasi-mahasiswas/destroy', 'PrestasiMahasiswaController@massDestroy')->name('prestasi-mahasiswas.massDestroy');
    Route::post('prestasi-mahasiswas/media', 'PrestasiMahasiswaController@storeMedia')->name('prestasi-mahasiswas.storeMedia');
    Route::post('prestasi-mahasiswas/ckmedia', 'PrestasiMahasiswaController@storeCKEditorImages')->name('prestasi-mahasiswas.storeCKEditorImages');
    Route::resource('prestasi-mahasiswas', 'PrestasiMahasiswaController');

    // Prestasi Mahasiswa Detail
    Route::resource('prestasi-mahasiswa-details', 'PrestasiMahasiswaDetailController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Competence
    Route::delete('competences/destroy', 'CompetenceController@massDestroy')->name('competences.massDestroy');
    Route::post('competences/media', 'CompetenceController@storeMedia')->name('competences.storeMedia');
    Route::post('competences/ckmedia', 'CompetenceController@storeCKEditorImages')->name('competences.storeCKEditorImages');
    Route::post('competences/parse-csv-import', 'CompetenceController@parseCsvImport')->name('competences.parseCsvImport');
    Route::post('competences/process-csv-import', 'CompetenceController@processCsvImport')->name('competences.processCsvImport');
    Route::resource('competences', 'CompetenceController');

    // Competence Item
    Route::delete('competence-items/destroy', 'CompetenceItemController@massDestroy')->name('competence-items.massDestroy');
    Route::post('competence-items/media', 'CompetenceItemController@storeMedia')->name('competence-items.storeMedia');
    Route::post('competence-items/ckmedia', 'CompetenceItemController@storeCKEditorImages')->name('competence-items.storeCKEditorImages');
    Route::resource('competence-items', 'CompetenceItemController');

    // Result Competence
    Route::delete('result-competences/destroy', 'ResultCompetenceController@massDestroy')->name('result-competences.massDestroy');
    Route::post('result-competences/media', 'ResultCompetenceController@storeMedia')->name('result-competences.storeMedia');
    Route::post('result-competences/ckmedia', 'ResultCompetenceController@storeCKEditorImages')->name('result-competences.storeCKEditorImages');
    Route::resource('result-competences', 'ResultCompetenceController');

    // Result Assessment
    Route::delete('result-assessments/destroy', 'ResultAssessmentController@massDestroy')->name('result-assessments.massDestroy');
    Route::resource('result-assessments', 'ResultAssessmentController');

    // Holland Test
    Route::resource('holland-tests', 'HollandTestController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Work Readiness Test
    Route::resource('work-readiness-tests', 'WorkReadinessTestController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Career Confidence Test
    Route::resource('career-confidence-tests', 'CareerConfidenceTestController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Vacancy
    Route::delete('vacancies/destroy', 'VacancyController@massDestroy')->name('vacancies.massDestroy');
    Route::post('vacancies/media', 'VacancyController@storeMedia')->name('vacancies.storeMedia');
    Route::post('vacancies/ckmedia', 'VacancyController@storeCKEditorImages')->name('vacancies.storeCKEditorImages');
    Route::resource('vacancies', 'VacancyController');

    // Prestasi Maba
    Route::delete('prestasi-mabas/destroy', 'PrestasiMabaController@massDestroy')->name('prestasi-mabas.massDestroy');
    Route::post('prestasi-mabas/media', 'PrestasiMabaController@storeMedia')->name('prestasi-mabas.storeMedia');
    Route::post('prestasi-mabas/ckmedia', 'PrestasiMabaController@storeCKEditorImages')->name('prestasi-mabas.storeCKEditorImages');
    Route::resource('prestasi-mabas', 'PrestasiMabaController');

    // Kategori Prestasi
    Route::delete('kategori-prestasis/destroy', 'KategoriPrestasiController@massDestroy')->name('kategori-prestasis.massDestroy');
    Route::resource('kategori-prestasis', 'KategoriPrestasiController');

    // Question
    Route::delete('questions/destroy', 'QuestionController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/parse-csv-import', 'QuestionController@parseCsvImport')->name('questions.parseCsvImport');
    Route::post('questions/process-csv-import', 'QuestionController@processCsvImport')->name('questions.processCsvImport');
    Route::resource('questions', 'QuestionController');

    // Experience
    Route::delete('experiences/destroy', 'ExperienceController@massDestroy')->name('experiences.massDestroy');
    Route::post('experiences/parse-csv-import', 'ExperienceController@parseCsvImport')->name('experiences.parseCsvImport');
    Route::post('experiences/process-csv-import', 'ExperienceController@processCsvImport')->name('experiences.processCsvImport');
    Route::resource('experiences', 'ExperienceController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Article Category
    Route::delete('article-categories/destroy', 'ArticleCategoryController@massDestroy')->name('article-categories.massDestroy');
    Route::resource('article-categories', 'ArticleCategoryController');

    // Article Tag
    Route::delete('article-tags/destroy', 'ArticleTagController@massDestroy')->name('article-tags.massDestroy');
    Route::resource('article-tags', 'ArticleTagController');

    // Post
    Route::delete('posts/destroy', 'PostController@massDestroy')->name('posts.massDestroy');
    Route::post('posts/media', 'PostController@storeMedia')->name('posts.storeMedia');
    Route::post('posts/ckmedia', 'PostController@storeCKEditorImages')->name('posts.storeCKEditorImages');
    Route::resource('posts', 'PostController');

    // Education
    Route::delete('educations/destroy', 'EducationController@massDestroy')->name('educations.massDestroy');
    Route::resource('educations', 'EducationController');

    // Position
    Route::delete('positions/destroy', 'PositionController@massDestroy')->name('positions.massDestroy');
    Route::resource('positions', 'PositionController');

    // Department
    Route::delete('departments/destroy', 'DepartmentController@massDestroy')->name('departments.massDestroy');
    Route::resource('departments', 'DepartmentController');

    // Industry
    Route::delete('industries/destroy', 'IndustryController@massDestroy')->name('industries.massDestroy');
    Route::resource('industries', 'IndustryController');

    // Province
    Route::delete('provinces/destroy', 'ProvinceController@massDestroy')->name('provinces.massDestroy');
    Route::resource('provinces', 'ProvinceController');

    // Regencies
    Route::delete('regencies/destroy', 'RegenciesController@massDestroy')->name('regencies.massDestroy');
    Route::resource('regencies', 'RegenciesController');

    // Company
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompanyController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompanyController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::resource('companies', 'CompanyController');

    // Tracer Alumni
    Route::delete('tracer-alumnus/destroy', 'TracerAlumniController@massDestroy')->name('tracer-alumnus.massDestroy');
    Route::resource('tracer-alumnus', 'TracerAlumniController');

    // Tracer Stakeholder
    Route::delete('tracer-stakeholders/destroy', 'TracerStakeholderController@massDestroy')->name('tracer-stakeholders.massDestroy');
    Route::post('tracer-stakeholders/media', 'TracerStakeholderController@storeMedia')->name('tracer-stakeholders.storeMedia');
    Route::post('tracer-stakeholders/ckmedia', 'TracerStakeholderController@storeCKEditorImages')->name('tracer-stakeholders.storeCKEditorImages');
    Route::resource('tracer-stakeholders', 'TracerStakeholderController');

    // Prestasi Mahasiswa
    Route::delete('prestasi-mahasiswas/destroy', 'PrestasiMahasiswaController@massDestroy')->name('prestasi-mahasiswas.massDestroy');
    Route::post('prestasi-mahasiswas/media', 'PrestasiMahasiswaController@storeMedia')->name('prestasi-mahasiswas.storeMedia');
    Route::post('prestasi-mahasiswas/ckmedia', 'PrestasiMahasiswaController@storeCKEditorImages')->name('prestasi-mahasiswas.storeCKEditorImages');
    Route::resource('prestasi-mahasiswas', 'PrestasiMahasiswaController');

    // Prestasi Mahasiswa Detail
    Route::resource('prestasi-mahasiswa-details', 'PrestasiMahasiswaDetailController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Competence
    Route::delete('competences/destroy', 'CompetenceController@massDestroy')->name('competences.massDestroy');
    Route::post('competences/media', 'CompetenceController@storeMedia')->name('competences.storeMedia');
    Route::post('competences/ckmedia', 'CompetenceController@storeCKEditorImages')->name('competences.storeCKEditorImages');
    Route::resource('competences', 'CompetenceController');

    // Competence Item
    Route::delete('competence-items/destroy', 'CompetenceItemController@massDestroy')->name('competence-items.massDestroy');
    Route::post('competence-items/media', 'CompetenceItemController@storeMedia')->name('competence-items.storeMedia');
    Route::post('competence-items/ckmedia', 'CompetenceItemController@storeCKEditorImages')->name('competence-items.storeCKEditorImages');
    Route::resource('competence-items', 'CompetenceItemController');

    // Result Competence
    Route::delete('result-competences/destroy', 'ResultCompetenceController@massDestroy')->name('result-competences.massDestroy');
    Route::post('result-competences/media', 'ResultCompetenceController@storeMedia')->name('result-competences.storeMedia');
    Route::post('result-competences/ckmedia', 'ResultCompetenceController@storeCKEditorImages')->name('result-competences.storeCKEditorImages');
    Route::resource('result-competences', 'ResultCompetenceController');

    // Result Assessment
    Route::delete('result-assessments/destroy', 'ResultAssessmentController@massDestroy')->name('result-assessments.massDestroy');
    Route::resource('result-assessments', 'ResultAssessmentController');

    // Holland Test
    Route::resource('holland-tests', 'HollandTestController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Work Readiness Test
    Route::resource('work-readiness-tests', 'WorkReadinessTestController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Career Confidence Test
    Route::resource('career-confidence-tests', 'CareerConfidenceTestController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Vacancy
    Route::delete('vacancies/destroy', 'VacancyController@massDestroy')->name('vacancies.massDestroy');
    Route::post('vacancies/media', 'VacancyController@storeMedia')->name('vacancies.storeMedia');
    Route::post('vacancies/ckmedia', 'VacancyController@storeCKEditorImages')->name('vacancies.storeCKEditorImages');
    Route::resource('vacancies', 'VacancyController');

    // Prestasi Maba
    Route::delete('prestasi-mabas/destroy', 'PrestasiMabaController@massDestroy')->name('prestasi-mabas.massDestroy');
    Route::post('prestasi-mabas/media', 'PrestasiMabaController@storeMedia')->name('prestasi-mabas.storeMedia');
    Route::post('prestasi-mabas/ckmedia', 'PrestasiMabaController@storeCKEditorImages')->name('prestasi-mabas.storeCKEditorImages');
    Route::resource('prestasi-mabas', 'PrestasiMabaController');

    // Kategori Prestasi
    Route::delete('kategori-prestasis/destroy', 'KategoriPrestasiController@massDestroy')->name('kategori-prestasis.massDestroy');
    Route::resource('kategori-prestasis', 'KategoriPrestasiController');

    // Question
    Route::delete('questions/destroy', 'QuestionController@massDestroy')->name('questions.massDestroy');
    Route::resource('questions', 'QuestionController');

    // Experience
    Route::delete('experiences/destroy', 'ExperienceController@massDestroy')->name('experiences.massDestroy');
    Route::resource('experiences', 'ExperienceController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
