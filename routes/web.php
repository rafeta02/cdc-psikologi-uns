<?php

use Mews\Captcha\Captcha;

Route::get('/', 'HomeController@index')->name('home');
Route::get('jobs', 'HomeController@job')->name('jobs');
Route::get('jobs/{slug}', 'HomeController@jobDetail')->name('job-detail');
Route::get('job-ajax', 'HomeController@jobAjax')->name('job-ajax');

// Magang/Internships Routes
Route::get('magang', 'HomeController@magang')->name('magang');
Route::get('magang/{slug}', 'HomeController@magangDetail')->name('magang-detail');
Route::get('magang-ajax', 'HomeController@magangAjax')->name('magang-ajax');

Route::get('companies', 'HomeController@company')->name('companies');
Route::get('companies/{slug}', 'HomeController@companyDetail')->name('company-detail');
Route::get('news/acara-berita', 'HomeController@acara')->name('news.acara-berita');
Route::get('news/beasiswa', 'HomeController@beasiswa')->name('news.beasiswa');
Route::get('news/{category?}', 'HomeController@news')->name('news');
Route::get('alumni-caring/{slug}', 'HomeController@alumniCaringDetail')->name('alumni-caring-detail')->middleware(['auth']);
Route::get('alumni-caring', 'HomeController@alumniCaring')->name('alumni-caring')->middleware(['auth']);
Route::get('articles/search', 'HomeController@blogSearch')->name('blog-search');
Route::get('articles/{slug}', 'HomeController@blogDetail')->name('blog-detail');
Route::get('tracer-study', 'HomeController@tracerStudy')->name('tracer-study');
Route::post('tracer-study', 'HomeController@tracerStudyStore')->name('tracer-study-store');
Route::get('tracer-alumni', 'HomeController@tracerAlumni')->name('tracer-alumni');
Route::post('tracer-alumni', 'HomeController@tracerAlumniStore')->name('tracer-alumni-store');
Route::get('prestasi', 'HomeController@prestasiMahasiswa')->name('prestasi');
Route::get('jadwal-lomba', 'HomeController@jadwalLomba')->name('jadwal-lomba');
Route::get('jadwal-lomba-events', 'HomeController@jadwalLombaEvents')->name('jadwal-lomba-events');

Route::get('infografis', 'HomeController@grafik')->name('infografis');

Route::get('about-us', 'HomeController@about')->name('about-us');
Route::get('team', 'HomeController@team')->name('team');
Route::get('help-center', 'HomeController@help')->name('help-center');
Route::get('faq', 'HomeController@faq')->name('faq');
Route::get('privacy-policy', 'HomeController@privacy')->name('privacy-policy');

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');

//ajax for select
Route::get('select/regencies', 'Admin\ProvinceController@getRegencies')->name('select.getRegencies');
Route::get('select/companies', 'Admin\CompanyController@getCompanies')->name('select.getCompanies');

Auth::routes(['register' => false]);

Route::get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha');

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
    Route::get('article-tags/search-select', 'ArticleTagController@searchSelect')->name('article-tags.searchSelect');
    Route::post('article-tags/store-select', 'ArticleTagController@storeSelect')->name('article-tags.storeSelect');
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
    Route::post('educations/process-csv-import', 'EducationController@processCsvImport')->name('education.processCsvImport');
    Route::resource('educations', 'EducationController');

    // Position
    Route::delete('positions/destroy', 'PositionController@massDestroy')->name('positions.massDestroy');
    Route::post('positions/parse-csv-import', 'PositionController@parseCsvImport')->name('positions.parseCsvImport');
    Route::post('positions/process-csv-import', 'PositionController@processCsvImport')->name('positions.processCsvImport');
    Route::post('positions/store-select', 'PositionController@storeSelect')->name('positions.storeSelect');
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
    Route::get('industries/search-select', 'IndustryController@searchSelect')->name('industries.searchSelect');
    Route::post('industries/store-select', 'IndustryController@storeSelect')->name('industries.storeSelect');
    Route::resource('industries', 'IndustryController');

    // Province
    Route::delete('provinces/destroy', 'ProvinceController@massDestroy')->name('provinces.massDestroy');
    Route::post('provinces/parse-csv-import', 'ProvinceController@parseCsvImport')->name('provinces.parseCsvImport');
    Route::post('provinces/process-csv-import', 'ProvinceController@processCsvImport')->name('provinces.processCsvImport');
    Route::get('provinces/province-regencies', 'ProvinceController@getProvincesWithRegencies')->name('provinces.getProvincesWithRegencies');
    Route::resource('provinces', 'ProvinceController');

    // Regencies
    Route::delete('regencies/destroy', 'RegenciesController@massDestroy')->name('regencies.massDestroy');
    Route::post('regencies/parse-csv-import', 'RegenciesController@parseCsvImport')->name('regencies.parseCsvImport');
    Route::post('regencies/process-csv-import', 'RegenciesController@processCsvImport')->name('regencies.processCsvImport');
    Route::post('regencies/import', 'RegenciesController@import')->name('regencies.import');
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
    Route::post('tracer-alumnus/export', 'TracerAlumniController@export')->name('tracer-alumnus.export');
    Route::resource('tracer-alumnus', 'TracerAlumniController');

    // Tracer Stakeholder
    Route::delete('tracer-stakeholders/destroy', 'TracerStakeholderController@massDestroy')->name('tracer-stakeholders.massDestroy');
    Route::post('tracer-stakeholders/media', 'TracerStakeholderController@storeMedia')->name('tracer-stakeholders.storeMedia');
    Route::post('tracer-stakeholders/ckmedia', 'TracerStakeholderController@storeCKEditorImages')->name('tracer-stakeholders.storeCKEditorImages');
    Route::post('tracer-stakeholders/export', 'TracerStakeholderController@export')->name('tracer-stakeholders.export');
    Route::resource('tracer-stakeholders', 'TracerStakeholderController');

    // Prestasi Mahasiswa
    Route::delete('prestasi-mahasiswas/destroy', 'PrestasiMahasiswaController@massDestroy')->name('prestasi-mahasiswas.massDestroy');
    Route::post('prestasi-mahasiswas/media', 'PrestasiMahasiswaController@storeMedia')->name('prestasi-mahasiswas.storeMedia');
    Route::post('prestasi-mahasiswas/ckmedia', 'PrestasiMahasiswaController@storeCKEditorImages')->name('prestasi-mahasiswas.storeCKEditorImages');
    Route::post('prestasi-mahasiswas/export', 'PrestasiMahasiswaController@export')->name('prestasi-mahasiswas.export');
    
    // Validation routes for Prestasi Mahasiswa
    Route::patch('prestasi-mahasiswas/{id}/approved', 'PrestasiMahasiswaController@approved')->name('prestasi-mahasiswas.approved');
    Route::patch('prestasi-mahasiswas/{id}/reject', 'PrestasiMahasiswaController@reject')->name('prestasi-mahasiswas.reject');
    
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
    Route::post('result-assessments/export', 'ResultAssessmentController@export')->name('result-assessments.export');
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
    Route::post('prestasi-mabas/export', 'PrestasiMabaController@export')->name('prestasi-mabas.export');
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

    // Vacancy Tag
    Route::delete('vacancy-tags/destroy', 'VacancyTagController@massDestroy')->name('vacancy-tags.massDestroy');
    Route::post('vacancy-tags/parse-csv-import', 'VacancyTagController@parseCsvImport')->name('vacancy-tags.parseCsvImport');
    Route::post('vacancy-tags/process-csv-import', 'VacancyTagController@processCsvImport')->name('vacancy-tags.processCsvImport');
    Route::resource('vacancy-tags', 'VacancyTagController');

    // Magang
    Route::delete('magangs/destroy', 'MagangController@massDestroy')->name('magangs.massDestroy');
    Route::post('magangs/media', 'MagangController@storeMedia')->name('magangs.storeMedia');
    Route::post('magangs/ckmedia', 'MagangController@storeCKEditorImages')->name('magangs.storeCKEditorImages');
    Route::resource('magangs', 'MagangController');

    // Mahasiswa Magang
    Route::get('mahasiswa-magangs/dashboard', 'MahasiswaMagangController@dashboard')->name('mahasiswa-magangs.dashboard');
    Route::get('mahasiswa-magangs/export', 'MahasiswaMagangController@export')->name('mahasiswa-magangs.export');
    Route::delete('mahasiswa-magangs/destroy', 'MahasiswaMagangController@massDestroy')->name('mahasiswa-magangs.massDestroy');
    Route::post('mahasiswa-magangs/media', 'MahasiswaMagangController@storeMedia')->name('mahasiswa-magangs.storeMedia');
    Route::post('mahasiswa-magangs/ckmedia', 'MahasiswaMagangController@storeCKEditorImages')->name('mahasiswa-magangs.storeCKEditorImages');
    Route::post('mahasiswa-magangs/{id}/approve', 'MahasiswaMagangController@approve')->name('mahasiswa-magangs.approve');
    Route::post('mahasiswa-magangs/{id}/reject', 'MahasiswaMagangController@reject')->name('mahasiswa-magangs.reject');
    Route::get('mahasiswa-magangs/{id}/verify', 'MahasiswaMagangController@verify')->name('mahasiswa-magangs.verify');
    Route::get('mahasiswa-magangs/{id}/verify-documents', 'MahasiswaMagangController@verifyDocuments')->name('mahasiswa-magangs.verify-documents');
    Route::post('mahasiswa-magangs/{id}/process-verification', 'MahasiswaMagangController@processVerification')->name('mahasiswa-magangs.process-verification');
    Route::get('mahasiswa-magangs/{id}/generate-certificate', 'MahasiswaMagangController@generateCertificate')->name('mahasiswa-magangs.generate-certificate');
    Route::get('internship-applications/{mahasiswaMagang}/upload-documents', 'MahasiswaMagangController@uploadDocuments')->name('mahasiswa-magangs.upload-documents');
    Route::post('internship-applications/{mahasiswaMagang}/store-documents', 'MahasiswaMagangController@storeDocuments')->name('mahasiswa-magangs.store-documents');
    Route::get('internship-applications/{mahasiswaMagang}/upload-final-documents', 'MahasiswaMagangController@uploadFinalDocuments')->name('mahasiswa-magangs.upload-final-documents');
    Route::post('internship-applications/{mahasiswaMagang}/store-final-documents', 'MahasiswaMagangController@storeFinalDocuments')->name('mahasiswa-magangs.store-final-documents');
    Route::resource('internship-applications', 'MahasiswaMagangController', ['names' => 'mahasiswa-magangs']);

    // Test Magang
    Route::delete('test-magangs/destroy', 'TestMagangController@massDestroy')->name('test-magangs.massDestroy');
    Route::get('test-magangs/take/{magang_id}/{type}', 'TestMagangController@takeTest')->name('test-magangs.take');
    Route::post('test-magangs/store-test', 'TestMagangController@storeTest')->name('test-magangs.storeTest');
    Route::resource('test-magangs', 'TestMagangController');

    // Monitoring Magang
    Route::delete('monitoring-magangs/destroy', 'MonitoringMagangController@massDestroy')->name('monitoring-magangs.massDestroy');
    Route::post('monitoring-magangs/media', 'MonitoringMagangController@storeMedia')->name('monitoring-magangs.storeMedia');
    Route::post('monitoring-magangs/ckmedia', 'MonitoringMagangController@storeCKEditorImages')->name('monitoring-magangs.storeCKEditorImages');
    Route::resource('monitoring-magangs', 'MonitoringMagangController');

    // Contest
    Route::delete('contests/destroy', 'ContestController@massDestroy')->name('contests.massDestroy');
    Route::post('contests/parse-csv-import', 'ContestController@parseCsvImport')->name('contests.parseCsvImport');
    Route::post('contests/process-csv-import', 'ContestController@processCsvImport')->name('contests.processCsvImport');
    Route::resource('contests', 'ContestController');
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
    Route::get('/dashboard', 'HomeController@index')->name('home');

    // Magang Application Routes (moved here from outside)
    Route::get('magang/{slug}/apply', 'MahasiswaMagangController@apply')->name('magang.apply');
    Route::post('magang/store-application', 'MahasiswaMagangController@storeApplication')->name('magang.store-application');
    
    // Test Magang Frontend Routes (moved here from outside)
    Route::get('mahasiswa-magang/{magang_id}/test/{type}', 'TestMagangController@takeTest')->name('mahasiswa-magangs.take-test');
    Route::post('mahasiswa-magang/store-test', 'TestMagangController@storeTest')->name('mahasiswa-magangs.store-test');

    // Tracer Alumni
    Route::delete('tracer-alumnus/destroy', 'TracerAlumniController@massDestroy')->name('tracer-alumnus.massDestroy');
    Route::resource('tracer-alumnus', 'TracerAlumniController');

    // Tracer Stakeholder
    Route::delete('tracer-stakeholders/destroy', 'TracerStakeholderController@massDestroy')->name('tracer-stakeholders.massDestroy');
    Route::post('tracer-stakeholders/media', 'TracerStakeholderController@storeMedia')->name('tracer-stakeholders.storeMedia');
    Route::post('tracer-stakeholders/ckmedia', 'TracerStakeholderController@storeCKEditorImages')->name('tracer-stakeholders.storeCKEditorImages');
    Route::post('tracer-stakeholders/export', 'TracerStakeholderController@export')->name('tracer-stakeholders.export');
    Route::resource('tracer-stakeholders', 'TracerStakeholderController');

    // Prestasi Maba
    Route::delete('prestasi-mabas/destroy', 'PrestasiMabaController@massDestroy')->name('prestasi-mabas.massDestroy');
    Route::post('prestasi-mabas/media', 'PrestasiMabaController@storeMedia')->name('prestasi-mabas.storeMedia');
    Route::post('prestasi-mabas/ckmedia', 'PrestasiMabaController@storeCKEditorImages')->name('prestasi-mabas.storeCKEditorImages');
    Route::post('prestasi-mabas/print-bukti', 'PrestasiMabaController@printBukti')->name('prestasi-mabas.printBukti');
    Route::resource('prestasi-mabas', 'PrestasiMabaController');

    // Prestasi Mahasiswa
    Route::delete('prestasi-mahasiswas/destroy', 'PrestasiMahasiswaController@massDestroy')->name('prestasi-mahasiswas.massDestroy');
    Route::post('prestasi-mahasiswas/media', 'PrestasiMahasiswaController@storeMedia')->name('prestasi-mahasiswas.storeMedia');
    Route::post('prestasi-mahasiswas/ckmedia', 'PrestasiMahasiswaController@storeCKEditorImages')->name('prestasi-mahasiswas.storeCKEditorImages');
    Route::post('prestasi-mahasiswas/print-bukti', 'PrestasiMahasiswaController@printBukti')->name('prestasi-mahasiswas.printBukti');
    Route::post('prestasi-mahasiswas/save-step', 'PrestasiMahasiswaController@saveStep')->name('prestasi-mahasiswas.save-step');
    Route::resource('prestasi-mahasiswas', 'PrestasiMahasiswaController');

     // Result Assessment
     Route::delete('assessments/destroy', 'ResultAssessmentController@massDestroy')->name('assessments.massDestroy');
     Route::get('assessments/take-test/{test}', 'ResultAssessmentController@takeTest')->name('assessments.takeTest');
     Route::resource('assessments', 'ResultAssessmentController')->names('assessments');

    // Result Competence
    Route::delete('competences/destroy', 'ResultCompetenceController@massDestroy')->name('competences.massDestroy');
    Route::post('competences/media', 'ResultCompetenceController@storeMedia')->name('competences.storeMedia');
    Route::post('competences/ckmedia', 'ResultCompetenceController@storeCKEditorImages')->name('competences.storeCKEditorImages');
    Route::get('competences/certificate/{competence}', 'ResultCompetenceController@certificate')->name('competences.certificate');
    Route::resource('competences', 'ResultCompetenceController')->names('competences');

    // Mahasiswa Magang
    Route::delete('internship-applications/destroy', 'MahasiswaMagangController@massDestroy')->name('mahasiswa-magangs.massDestroy');
    Route::post('internship-applications/media', 'MahasiswaMagangController@storeMedia')->name('mahasiswa-magangs.storeMedia');
    Route::post('internship-applications/ckmedia', 'MahasiswaMagangController@storeCKEditorImages')->name('mahasiswa-magangs.storeCKEditorImages');
    Route::get('internship-applications/{mahasiswaMagang}/resubmit', 'MahasiswaMagangController@resubmitFiles')->name('mahasiswa-magangs.resubmit');
    Route::put('internship-applications/{mahasiswaMagang}/update-files', 'MahasiswaMagangController@updateFiles')->name('mahasiswa-magangs.update-files');
    Route::get('internship-applications/{mahasiswaMagang}/upload-documents', 'MahasiswaMagangController@uploadDocuments')->name('mahasiswa-magangs.upload-documents');
    Route::post('internship-applications/{mahasiswaMagang}/store-documents', 'MahasiswaMagangController@storeDocuments')->name('mahasiswa-magangs.store-documents');
    Route::get('internship-applications/{mahasiswaMagang}/upload-final-documents', 'MahasiswaMagangController@uploadFinalDocuments')->name('mahasiswa-magangs.upload-final-documents');
    Route::post('internship-applications/{mahasiswaMagang}/store-final-documents', 'MahasiswaMagangController@storeFinalDocuments')->name('mahasiswa-magangs.store-final-documents');
    Route::get('internship-applications/{mahasiswaMagang}/generate-certificate', 'MahasiswaMagangController@generateCertificate')->name('mahasiswa-magangs.generate-certificate');
    Route::resource('internship-applications', 'MahasiswaMagangController', ['names' => 'mahasiswa-magangs']);

    // Test Magang
    Route::delete('test-magangs/destroy', 'TestMagangController@massDestroy')->name('test-magangs.massDestroy');
    Route::resource('test-magangs', 'TestMagangController');

    // Monitoring Magang
    Route::delete('monitoring-magangs/destroy', 'MonitoringMagangController@massDestroy')->name('monitoring-magangs.massDestroy');
    Route::post('monitoring-magangs/media', 'MonitoringMagangController@storeMedia')->name('monitoring-magangs.storeMedia');
    Route::post('monitoring-magangs/ckmedia', 'MonitoringMagangController@storeCKEditorImages')->name('monitoring-magangs.storeCKEditorImages');
    Route::resource('monitoring-magangs', 'MonitoringMagangController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});