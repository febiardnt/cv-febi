<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AchievementController;

Route::get('/', [PortfolioController::class, 'index'])
    ->name('portfolio.index');

Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index');

Route::get('/admin/profil/edit', [AdminController::class, 'editProfile'])
    ->name('admin.profile.edit');

Route::put('/admin/profil', [AdminController::class, 'updateProfile'])
    ->name('admin.profile.update');

Route::get('/admin/pendidikan', [EducationController::class, 'index'])
    ->name('admin.educations.index');

Route::post('/admin/pendidikan', [EducationController::class, 'store'])
    ->name('admin.educations.store');

Route::get('/admin/pendidikan/{id}/edit', [EducationController::class, 'edit'])
    ->name('admin.educations.edit');

Route::put('/admin/pendidikan/{id}', [EducationController::class, 'update'])
    ->name('admin.educations.update');

Route::delete('/admin/pendidikan/{id}', [EducationController::class, 'destroy'])
    ->name('admin.educations.destroy');

Route::get('/admin/pengalaman', [ExperienceController::class, 'index'])
    ->name('admin.experiences.index');

Route::post('/admin/pengalaman', [ExperienceController::class, 'store'])
    ->name('admin.experiences.store');

Route::get('/admin/pengalaman/{id}/edit', [ExperienceController::class, 'edit'])
    ->name('admin.experiences.edit');

Route::put('/admin/pengalaman/{id}', [ExperienceController::class, 'update'])
    ->name('admin.experiences.update');

Route::delete('/admin/pengalaman/{id}', [ExperienceController::class, 'destroy'])
    ->name('admin.experiences.destroy');

Route::get('/admin/organisasi', [OrganizationController::class, 'index'])
    ->name('admin.organizations.index');

Route::post('/admin/organisasi', [OrganizationController::class, 'store'])
    ->name('admin.organizations.store');

Route::get('/admin/organisasi/{id}/edit', [OrganizationController::class, 'edit'])
    ->name('admin.organizations.edit');

Route::put('/admin/organisasi/{id}', [OrganizationController::class, 'update'])
    ->name('admin.organizations.update');

Route::delete('/admin/organisasi/{id}', [OrganizationController::class, 'destroy'])
    ->name('admin.organizations.destroy');

Route::get('/admin/keahlian', [SkillController::class, 'index'])
    ->name('admin.skills.index');

Route::post('/admin/keahlian', [SkillController::class, 'store'])
    ->name('admin.skills.store');

Route::get('/admin/keahlian/{id}/edit', [SkillController::class, 'edit'])
    ->name('admin.skills.edit');

Route::put('/admin/keahlian/{id}', [SkillController::class, 'update'])
    ->name('admin.skills.update');

Route::delete('/admin/keahlian/{id}', [SkillController::class, 'destroy'])
    ->name('admin.skills.destroy');

Route::get('/admin/prestasi', [AchievementController::class, 'index'])
    ->name('admin.achievements.index');

Route::post('/admin/prestasi', [AchievementController::class, 'store'])
    ->name('admin.achievements.store');

Route::get('/admin/prestasi/{id}/edit', [AchievementController::class, 'edit'])
    ->name('admin.achievements.edit');

Route::put('/admin/prestasi/{id}', [AchievementController::class, 'update'])
    ->name('admin.achievements.update');

Route::delete('/admin/prestasi/{id}', [AchievementController::class, 'destroy'])
    ->name('admin.achievements.destroy');
