<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DefenseController;
use App\Http\Controllers\DefenseTypeController;
use App\Http\Controllers\FinalGradeController;
use App\Http\Controllers\FypRegistrationNumberController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MeetupController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PreDefenseController;
use App\Http\Controllers\ProjectAllocationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubmissionTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');

Auth::routes();

Route::middleware('auth')->group(function () {
    // notifications 
    Route::get(
        '/notifications',
        [NotificationController::class, 'index']
    )->name('notification.index');
    Route::post('/notifications', [NotificationController::class, 'getNotification'])->name('notification.getNotification');


    // ------------------- Students Routes -------------------
    Route::middleware(['student'])->group(function () {
        Route::get(
            '/dashboard',
            [DashboardController::class, 'dashboard']
        )->name('dashboard');


        // students
        Route::post(
            'student/roll-number',
            [StudentController::class, 'searchRollNumber']
        )->name('student.search');

        // fyp registration processes 
        Route::get(
            '/registration',
            [FypRegistrationNumberController::class, 'registrationCreate']
        )->name('registration.create');
        Route::post(
            '/registration',
            [FypRegistrationNumberController::class, 'registrationStore']
        )->name('registration.store');

        // group formation
        Route::get(
            '/groups',
            [GroupController::class, 'index']
        )->name('groups.index');
        Route::post(
            '/groups',
            [GroupController::class, 'store']
        )->name('groups.store');
        Route::post(
            '/groups/invite',
            [GroupController::class, 'sendGroupInvitation']
        )->name('groups.invite.send');
        Route::get(
            '/groups/invite/accept/{id}',
            [GroupController::class, 'acceptGroupInvitation']
        )->name('groups.invite.accept');
        Route::get(
            '/groups/invite/reject/{id}',
            [GroupController::class, 'rejectGroupInvitation']
        )->name('groups.invite.reject');

        // Supervisor allocation
        Route::get(
            '/allocation',
            [ProjectAllocationController::class, 'create']
        )->name('project.allocation.create');
        Route::post(
            '/allocation',
            [ProjectAllocationController::class, 'store']
        )->name('project.allocation.store');
    });


    // ------------------- Faculty Routes -------------------
    Route::middleware(
        []
    )->prefix('faculty')->name('faculty.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'facultyDashboard'])->name('dashboard');

        /* => user management */
        // roles
        Route::get(
            'roles',
            [RoleController::class, 'index']
        )->name('roles.index');
        Route::get(
            'roles/create',
            [RoleController::class, 'create']
        )->name('roles.create')->middleware('superAdmin');
        Route::post(
            'roles',
            [RoleController::class, 'store']
        )->name('roles.store');
        Route::get(
            'roles/{role}',
            [RoleController::class, 'edit']
        )->name('roles.edit');
        Route::get(
            'role/{role}',
            [RoleController::class, 'show']
        )->name('roles.show');
        Route::put(
            'roles/{role}',
            [RoleController::class, 'update']
        )->name('roles.update');

        // permissions
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');

        // users
        Route::get('/users',  [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create',  [UserController::class, 'create'])->name('users.create');
        Route::post('/users',  [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}',  [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/update/{user}',  [UserController::class, 'update'])->name('users.update');
        Route::get('/users/show/{user}',  [UserController::class, 'show'])->name('users.show');
        Route::get('/users/destroy/{user}',  [UserController::class, 'destroy'])->name('users.destroy');

        /* => Student management */
        Route::get('students', [StudentController::class, 'index'])->name('students.index');
        Route::get('students/show/{student}', [StudentController::class, 'show'])->name('students.show');
        Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('students', [StudentController::class, 'store'])->name('students.store');
        Route::get('students/edit/{student}', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('students/update/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::get('students/destroy/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
        Route::get('students/import', [StudentController::class, 'sheetImportPage'])->name('students.import.show');
        Route::post('students/import', [StudentController::class, 'sheetImport'])->name('students.import.store');


        // fyp registrations
        Route::get(
            'fyp-registration',
            [FypRegistrationNumberController::class, 'index']
        )->name('fyp-registration.index');
        Route::get(
            'fyp-registration/show/{fypRegistrationNumber}',
            [FypRegistrationNumberController::class, 'show']
        )->name('fyp-registration.show');
        Route::get(
            'fyp-registration/approve/{fypRegistrationNumber}',
            [FypRegistrationNumberController::class, 'edit']
        )->name('fyp-registration.approve');
        Route::post(
            'fyp-registration/approve-all',
            [FypRegistrationNumberController::class, 'editAll']
        )->name('fyp-registration.approve-all');
        Route::post(
            'fyp-registration/add-remarks',
            [FypRegistrationNumberController::class, 'update']
        )->name('fyp-registration.add-remarks');
        Route::get(
            'fyp-registration/reject/{fypRegistrationNumber}',
            [FypRegistrationNumberController::class, 'reject']
        )->name('fyp-registration.reject');

        // project / supervisors allocation 
        Route::get(
            '/allocation',
            [ProjectAllocationController::class, 'index']
        )->name('project.allocation.index');
        Route::get(
            'allocation/show/{projectAllocation}',
            [ProjectAllocationController::class, 'show']
        )->name('project.allocation.show');
        Route::post(
            'allocation/update/{projectAllocation}',
            [ProjectAllocationController::class, 'update']
        )->name('project.allocation.update');
        Route::get(
            'allocation/approve/{projectAllocation}',
            [ProjectAllocationController::class, 'edit']
        )->name('project.allocation.approve');
        Route::post(
            '/allocation/approve-all',
            [ProjectAllocationController::class, 'editAll']
        )->name('project.allocation.approve-all');
        Route::post(
            'allocation/add-remarks',
            [ProjectAllocationController::class, 'update']
        )->name('project.allocation.add-remarks');
        Route::get(
            'allocation/reject/{projectAllocation}',
            [ProjectAllocationController::class, 'reject']
        )->name('project.allocation.reject');

        // Panel Module
        Route::get('/panels', [PanelController::class, 'index'])->name('panels.index');
        Route::get('/panels/create', [PanelController::class, 'create'])->name('panels.create');
        Route::post('/panels', [PanelController::class, 'store'])->name('panels.store');
        Route::get('/panels/show/{panel}', [PanelController::class, 'show'])->name('panels.show');
        Route::post('/panels/members', [PanelController::class, 'getMembers'])->name('panels.members');
        Route::post('/panels/members/add', [PanelController::class, 'addMembers'])->name('panels.members.add');
        Route::get('/panels/destroy/{panel}', [PanelController::class, 'destroy'])->name('panels.destroy');

        // meetups 
        Route::get('/meetups', [MeetupController::class, 'index'])->name('meetups.index');
        Route::get('/meetups/requests', [MeetupController::class, 'meetupRequests'])->name('meetups.index.requests');
        Route::post('/meetups/requests', [MeetupController::class, 'store'])->name('meetups.store.requests');
        Route::get('/meetups/destroy/{meetup}', [MeetupController::class, 'destroy'])->name('meetups.destroy');

        // submissions - types
        Route::controller(SubmissionTypeController::class)->group(function () {
            Route::get('/submission-types', 'index')->name('submission-types.index');
            Route::get('/submission-types/create', 'create')->name('submission-types.create');
            Route::post('/submission-types', 'store')->name('submission-types.store');
            Route::get('/submission-types/edit/{submissionType}', 'edit')->name('submission-types.edit');
            // Route::get('/submission-types/show/{submissionType}', 'show')->name('submission-types.show');
            Route::put('/submission-types/update/{submissionType}', 'update')->name('submission-types.update');
            Route::get('/submission-types/destroy/{submissionType}', 'destroy')->name('submission-types.destroy');
        });

        // defense - types
        Route::controller(DefenseTypeController::class)->group(function () {
            Route::get('/defense-types', 'index')->name('defense-types.index');
            Route::get('/defense-types/create', 'create')->name('defense-types.create');
            Route::post('/defense-types', 'store')->name('defense-types.store');
            Route::get('/defense-types/edit/{defenseType}', 'edit')->name('defense-types.edit');
            // Route::get('/defense-types/show/{defenseType}', 'show')->name('defense-types.show');
            Route::put('/defense-types/update/{defenseType}', 'update')->name('defense-types.update');
            Route::get('/defense-types/destroy/{defenseType}', 'destroy')->name('defense-types.destroy');
        });

        // defenses
        Route::controller(DefenseController::class)->group(function () {
            Route::get('/defenses', 'index')->name('defenses.index');
            Route::get('/defenses/create', 'create')->name('defenses.create');
            Route::post('/defenses', 'store')->name('defenses.store');
            Route::get('/defenses/show/{defense}', 'show')->name('defenses.show');
            Route::post('/defenses/update/{defense}', 'update')->name('defenses.update');
            Route::get('/defenses/finalized/{defense}', 'markAsFinalized')->name('defenses.finalized');

            Route::get('/defenses/final', 'finalDefense')->name('defenses.final.index');
            Route::post('/defenses/final/create', 'createFinalDefense')->name('defenses.final.create');
            Route::post('/defenses/final', 'storeFinalDefense')->name('defenses.final.store');
        });

        // pre - defenses
        Route::controller(PreDefenseController::class)->group(function () {
            Route::get('/pre-defenses', 'index')->name('pre-defenses.index');
            Route::post('/pre-defenses', 'store')->name('pre-defenses.store');
            Route::post('/pre-defenses/evaluate/{defense}', 'evaluate')->name('pre-defenses.evaluate');
        });

        // projects
        Route::controller(ProjectController::class)->group(function () {
            Route::get('/projects', 'index')->name('projects.index');
        });

        // submissions 
        Route::controller(SubmissionController::class)->group(function () {
            Route::get('/submissions', 'index')->name('submissions.index');
            Route::get('/submissions/create', 'create')->name('submissions.create');
            Route::post('/submissions', 'store')->name('submissions.store');
            Route::get('/submissions/edit/{submission}', 'edit')->name('submissions.edit');
            Route::get('/submissions/show/{submission}', 'show')->name('submissions.show');
            Route::put('/submissions/update/{submission}', 'update')->name('submissions.update');
            Route::get('/submissions/destroy/{submission}', 'destroy')->name('submissions.destroy');
            Route::get('/submissions/download/{submission}', 'download')->name('submissions.download');
        });

        // groups all
        Route::get('/groups', [GroupController::class, 'indexAll'])->name('groups.index-all');

        Route::controller(FinalGradeController::class)->group(function () {
            Route::get('/final-grades', 'index')->name('final-grades.index');
            Route::post('/final-grades', 'store')->name('final-grades.store');
        });

        // ------------------- Super Admin Routes -------------------
        Route::middleware('superAdmin')->group(function () {
            //
        }); // end of super admin

    }); // end of faculty
}); // end of auth
