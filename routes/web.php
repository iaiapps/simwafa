<?php

use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KomponenController;
use App\Http\Controllers\EvaluationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin.index');
// });

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('teacher', TeacherController::class);
        Route::resource('student', StudentController::class);
        Route::resource('grade', GradeController::class);
        Route::resource('cluster', ClusterController::class);
        Route::resource('komponen', KomponenController::class);
        Route::resource('stage', StageController::class);

        // nilai
        Route::resource('evaluation', EvaluationController::class);
        // Route::get('assigneval', [EvaluationController::class, 'assigneval'])->name('assign.eval');

        // edit role
        Route::get('editrole', [UserController::class, 'editrole'])->name('role.edit');
        Route::put('editrole', [UserController::class, 'updaterole'])->name('role.update');

        //assign cluster and grade
        Route::get('assigncluster', [StudentController::class, 'assignCluster'])->name('assign.cluster');
        Route::put('assigncluster', [StudentController::class, 'storeAssignCluster'])->name('assign.cluster');
        Route::get('assigngrade', [StudentController::class, 'assignGrade'])->name('assign.grade');
        Route::put('assigngrade', [StudentController::class, 'storeAssignGrade'])->name('assign.grade');
        Route::get('assignstage', [StudentController::class, 'assignStage'])->name('assign.stage');
        Route::put('assignstage', [StudentController::class, 'storeAssignStage'])->name('assign.stage');
    });

    Route::middleware('role:guru|walas')->group(function () {
        //dapatkan student cluster
        Route::get('student-cluster', [TeacherController::class, 'studentCluster'])->name('student.cluster');

        // nilai
        Route::get('evalindex', [EvaluationController::class, 'evalIndex'])->name('eval.index');
        Route::get('eval-student', [EvaluationController::class, 'evalStudent'])->name('student.evaluation');
        Route::post('eval-student', [EvaluationController::class, 'evalStudentStore'])->name('student.evaluation.store');
        Route::get('eval-show/{id}', [EvaluationController::class, 'evalStudentShow'])->name('student.evaluation.show');

        // utk walas lihat siswa
        Route::get('student-grade', [TeacherController::class, 'studentGrade'])->name('student.grade');
    });
});
