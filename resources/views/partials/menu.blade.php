<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('area_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/provinces*") ? "menu-open" : "" }} {{ request()->is("admin/regencies*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/provinces*") ? "active" : "" }} {{ request()->is("admin/regencies*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-globe">

                            </i>
                            <p>
                                {{ trans('cruds.area.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('province_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.provinces.index") }}" class="nav-link {{ request()->is("admin/provinces") || request()->is("admin/provinces/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-justify">

                                        </i>
                                        <p>
                                            {{ trans('cruds.province.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('regency_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.regencies.index") }}" class="nav-link {{ request()->is("admin/regencies") || request()->is("admin/regencies/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-left">

                                        </i>
                                        <p>
                                            {{ trans('cruds.regency.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('blog_master_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/article-categories*") ? "menu-open" : "" }} {{ request()->is("admin/article-tags*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/article-categories*") ? "active" : "" }} {{ request()->is("admin/article-tags*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fab fa-blogger-b">

                            </i>
                            <p>
                                {{ trans('cruds.blogMaster.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('article_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.article-categories.index") }}" class="nav-link {{ request()->is("admin/article-categories") || request()->is("admin/article-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-justify">

                                        </i>
                                        <p>
                                            {{ trans('cruds.articleCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('article_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.article-tags.index") }}" class="nav-link {{ request()->is("admin/article-tags") || request()->is("admin/article-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.articleTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('vacancy_master_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/industries*") ? "menu-open" : "" }} {{ request()->is("admin/positions*") ? "menu-open" : "" }} {{ request()->is("admin/educations*") ? "menu-open" : "" }} {{ request()->is("admin/departments*") ? "menu-open" : "" }} {{ request()->is("admin/experiences*") ? "menu-open" : "" }} {{ request()->is("admin/vacancy-tags*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/industries*") ? "active" : "" }} {{ request()->is("admin/positions*") ? "active" : "" }} {{ request()->is("admin/educations*") ? "active" : "" }} {{ request()->is("admin/departments*") ? "active" : "" }} {{ request()->is("admin/experiences*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-asterisk">

                            </i>
                            <p>
                                {{ trans('cruds.vacancyMaster.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('industry_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.industries.index") }}" class="nav-link {{ request()->is("admin/industries") || request()->is("admin/industries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-fire">

                                        </i>
                                        <p>
                                            {{ trans('cruds.industry.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('position_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.positions.index") }}" class="nav-link {{ request()->is("admin/positions") || request()->is("admin/positions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-accessible-icon">

                                        </i>
                                        <p>
                                            {{ trans('cruds.position.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('education_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.educations.index") }}" class="nav-link {{ request()->is("admin/educations") || request()->is("admin/educations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-graduation-cap">

                                        </i>
                                        <p>
                                            {{ trans('cruds.education.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('department_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.departments.index") }}" class="nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-justify">

                                        </i>
                                        <p>
                                            {{ trans('cruds.department.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('experience_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.experiences.index") }}" class="nav-link {{ request()->is("admin/experiences") || request()->is("admin/experiences/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sort-numeric-up">

                                        </i>
                                        <p>
                                            {{ trans('cruds.experience.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vacancy_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vacancy-tags.index") }}" class="nav-link {{ request()->is("admin/vacancy-tags") || request()->is("admin/vacancy-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.vacancyTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('company_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.companies.index") }}" class="nav-link {{ request()->is("admin/companies") || request()->is("admin/companies/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-building">

                            </i>
                            <p>
                                {{ trans('cruds.company.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('post_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.posts.index") }}" class="nav-link {{ request()->is("admin/posts") || request()->is("admin/posts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-newspaper">

                            </i>
                            <p>
                                {{ trans('cruds.post.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('vacancy_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.vacancies.index") }}" class="nav-link {{ request()->is("admin/vacancies") || request()->is("admin/vacancies/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-user-md">

                            </i>
                            <p>
                                {{ trans('cruds.vacancy.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('tracer_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/tracer-alumnus*") ? "menu-open" : "" }} {{ request()->is("admin/tracer-stakeholders*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/tracer-alumnus*") ? "active" : "" }} {{ request()->is("admin/tracer-stakeholders*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-shoe-prints">

                            </i>
                            <p>
                                {{ trans('cruds.tracer.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('tracer_alumnu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tracer-alumnus.index") }}" class="nav-link {{ request()->is("admin/tracer-alumnus") || request()->is("admin/tracer-alumnus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-graduate">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tracerAlumnu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tracer_stakeholder_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tracer-stakeholders.index") }}" class="nav-link {{ request()->is("admin/tracer-stakeholders") || request()->is("admin/tracer-stakeholders/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-graduation-cap">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tracerStakeholder.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('prestasi_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/prestasi-mahasiswas*") ? "menu-open" : "" }} {{ request()->is("admin/kategori-prestasis*") ? "menu-open" : "" }} {{ request()->is("admin/prestasi-mabas*") ? "menu-open" : "" }} {{ request()->is("admin/prestasi-mahasiswa-details*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/prestasi-mahasiswas*") ? "active" : "" }} {{ request()->is("admin/kategori-prestasis*") ? "active" : "" }} {{ request()->is("admin/prestasi-mabas*") ? "active" : "" }} {{ request()->is("admin/prestasi-mahasiswa-details*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-trophy">

                            </i>
                            <p>
                                {{ trans('cruds.prestasi.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('kategori_prestasi_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.kategori-prestasis.index") }}" class="nav-link {{ request()->is("admin/kategori-prestasis") || request()->is("admin/kategori-prestasis/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-trophy">

                                        </i>
                                        <p>
                                            {{ trans('cruds.kategoriPrestasi.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('prestasi_mahasiswa_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.prestasi-mahasiswas.index") }}" class="nav-link {{ request()->is("admin/prestasi-mahasiswas") || request()->is("admin/prestasi-mahasiswas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-trophy">

                                        </i>
                                        <p>
                                            {{ trans('cruds.prestasiMahasiswa.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('prestasi_maba_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.prestasi-mabas.index") }}" class="nav-link {{ request()->is("admin/prestasi-mabas") || request()->is("admin/prestasi-mabas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-trophy">

                                        </i>
                                        <p>
                                            {{ trans('cruds.prestasiMaba.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('contest_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.contests.index") }}" class="nav-link {{ request()->is("admin/contests") || request()->is("admin/contests/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-child">

                            </i>
                            <p>
                                {{ trans('cruds.contest.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('kompetensi_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/result-competences*") ? "menu-open" : "" }} {{ request()->is("admin/competences*") ? "menu-open" : "" }} {{ request()->is("admin/competence-items*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/result-competences*") ? "active" : "" }} {{ request()->is("admin/competences*") ? "active" : "" }} {{ request()->is("admin/competence-items*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fab fa-kickstarter-k">

                            </i>
                            <p>
                                {{ trans('cruds.kompetensi.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('competence_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.competences.index") }}" class="nav-link {{ request()->is("admin/competences") || request()->is("admin/competences/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-korvue">

                                        </i>
                                        <p>
                                            {{ trans('cruds.competence.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('competence_item_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.competence-items.index") }}" class="nav-link {{ request()->is("admin/competence-items") || request()->is("admin/competence-items/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list-ol">

                                        </i>
                                        <p>
                                            {{ trans('cruds.competenceItem.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('result_competence_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.result-competences.index") }}" class="nav-link {{ request()->is("admin/result-competences") || request()->is("admin/result-competences/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file">

                                        </i>
                                        <p>
                                            {{ trans('cruds.resultCompetence.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('dospem_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.dospems.index") }}" class="nav-link {{ request()->is("admin/dospems") || request()->is("admin/dospems/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.dospem.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('magang_access')
                <li class="nav-item">
                    <a href="{{ route("admin.magangs.index") }}" class="nav-link {{ request()->is("admin/magangs") || request()->is("admin/magangs/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-user-md">

                        </i>
                        <p>
                            {{ trans('cruds.magang.title') }}
                        </p>
                    </a>
                </li>
            @endcan
            @can('mahasiswa_magang_access')
                <li class="nav-item has-treeview {{ request()->is("admin/mahasiswa-magangs*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/mahasiswa-magangs*") ? "active" : "" }}" href="#">
                        <i class="fa-fw nav-icon fas fa-cogs">
                        </i>
                        <p>
                            {{ trans('cruds.mahasiswaMagang.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("admin.mahasiswa-magangs.dashboard") }}" class="nav-link {{ request()->is("admin/mahasiswa-magangs/dashboard") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-tachometer-alt">
                                </i>
                                <p>
                                    Phase Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.mahasiswa-magangs.index") }}" class="nav-link {{ request()->is("admin/mahasiswa-magangs") && !request()->is("admin/mahasiswa-magangs/dashboard") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-list">
                                </i>
                                <p>
                                    Data Table
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('test_magang_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.test-magangs.index") }}" class="nav-link {{ request()->is("admin/test-magangs") || request()->is("admin/test-magangs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.testMagang.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('monitoring_magang_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.monitoring-magangs.index") }}" class="nav-link {{ request()->is("admin/monitoring-magangs") || request()->is("admin/monitoring-magangs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-desktop">

                            </i>
                            <p>
                                {{ trans('cruds.monitoringMagang.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('result_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/result-assessments*") ? "menu-open" : "" }} {{ request()->is("admin/holland-tests*") ? "menu-open" : "" }} {{ request()->is("admin/work-readiness-tests*") ? "menu-open" : "" }} {{ request()->is("admin/career-confidence-tests*") ? "menu-open" : "" }} {{ request()->is("admin/questions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/result-assessments*") ? "active" : "" }} {{ request()->is("admin/holland-tests*") ? "active" : "" }} {{ request()->is("admin/work-readiness-tests*") ? "active" : "" }} {{ request()->is("admin/career-confidence-tests*") ? "active" : "" }} {{ request()->is("admin/questions*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-chart-area">

                            </i>
                            <p>
                                Assessment
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.questions.index") }}" class="nav-link {{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.question.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('result_assessment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.result-assessments.index") }}" class="nav-link {{ request()->is("admin/result-assessments") || request()->is("admin/result-assessments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-clipboard-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.resultAssessment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('holland_test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.holland-tests.index") }}" class="nav-link {{ request()->is("admin/holland-tests") || request()->is("admin/holland-tests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-signature">

                                        </i>
                                        <p>
                                            {{ trans('cruds.hollandTest.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('work_readiness_test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.work-readiness-tests.index") }}" class="nav-link {{ request()->is("admin/work-readiness-tests") || request()->is("admin/work-readiness-tests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.workReadinessTest.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('career_confidence_test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.career-confidence-tests.index") }}" class="nav-link {{ request()->is("admin/career-confidence-tests") || request()->is("admin/career-confidence-tests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.careerConfidenceTest.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
