<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/users/register', [UserController::class, 'registerUser']); // Done
Route::post('/users/login', [UserController::class, 'loginUser']); // Done



Route::middleware('auth:sanctum')->group(function () {
	Route::post('/users/logout', [UserController::class, 'logoutUser']); // Done
	Route::get('/users', [UserController::class, 'getUsers'])->middleware('permission:can-access-all-users'); // Done
	Route::get('/users/{id}', [UserController::class, 'getUser'])->middleware('permission:can-access-all-users'); // Done 
	Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->middleware('permission:can-access-all-users'); // Done 
	Route::put('/users/{id}', [UserController::class, 'updateUser'])->middleware('permission:can-access-all-users'); // Done


	// Route for TaskController
	Route::post('/tasks', [TaskController::class, 'postTasks'])->middleware('permission:can-create-task');
	Route::get('/tasks', [TaskController::class, 'getTasks'])->middleware('permission:can-view-task');
	Route::get('/tasks/{id}', [TaskController::class, 'showTasks'])->middleware('permission:can-view-task');
	Route::delete('/tasks/{id}', [TaskController::class, 'deleteTasks'])->middleware('permission:can-delete-task');
	Route::put('/tasks/{id}', [TaskController::class, 'updateTasks'])->middleware('permission:can-update-task'); // for updating complete start
	Route::put('/tasks/reassign/{id}', [TaskController::class, 'reassignTasks'])->middleware('permission:can-reassign-task'); // for reassigning the task


	// Routes for TeamController
	Route::get('/teams', [TeamController::class, 'getTeams'])->middleware('permission:can-view-teams');
    Route::get('/user/teams', [TeamController::class, 'getUserTeams'])->middleware('permission:can-view-teams');
	Route::post('/team/add', [TeamController::class, 'postTeam'])->middleware('permission:can-create-teams');
	Route::get('/teams/{id}', [TeamController::class, 'showTeams'])->middleware('permission:can-view-specific-team');
	Route::put('/teams/{id}', [TeamController::class, 'updateTeams'])->middleware('permission:can-update-teams');
	Route::delete('/teams/{id}', [TeamController::class, 'deleteTeams'])->middleware('permission:can-delete-team');

	// Routes for TeamMembers
    Route::get('/teammembers/{team_id}', [TeamMemberController::class, 'getTeamMember'])->middleware('permission:can-delete-member'); // Done
	Route::post('/teammembers', [TeamMemberController::class, 'postTeamMembers'])->middleware('permission:can-create-members'); // Done
	Route::put('/teammembers/{id}', [TeamMemberController::class, 'updateTeamMember'])->middleware('permission:can-update-member'); // Done 
	Route::delete('/teammembers/{id}', [TeamMemberController::class, 'deleteTeamMember'])->middleware('permission:can-update-member'); // Done


	// Routes for DepartmentController
	Route::post('/departments', [DepartmentController::class, 'postDepartments'])->middleware('permission:can-add-department');
	Route::put('/departments/{id}', [DepartmentController::class, 'updateDepartments'])->middleware('permission:can-update-department');
	Route::delete('/departments/{id}', [DepartmentController::class, 'deleteDepartments'])->middleware('permission:can-delete-department');
	Route::get('/departments', [DepartmentController::class, 'getDepartments'])->middleware('permission:can-view-department');
	Route::get('/departments/{id}', [DepartmentController::class, 'showDepartments'])->middleware('permission:can-view-department');


	// messages
	Route::post('/messages', [MessageController::class, 'postMessage']);
	Route::get('/messages', [MessageController::class, 'getLastMessages']);
});
