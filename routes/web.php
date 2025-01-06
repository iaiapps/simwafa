<?php

use App\Http\Controllers\Auth\LoginController;
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
use App\Http\Controllers\JournalController;
use App\Http\Controllers\YearController;

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

// note
// grade = kelas
// clustrer =kelompok
// stage = jilid

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
        Route::delete('evaluation/{del}', [EvaluationController::class, 'destroy'])->name('evaluation.destroy');
        Route::resource('evaluation', EvaluationController::class)->except('destroy');
        // Route::get('assigneval', [EvaluationController::class, 'assigneval'])->name('assign.eval');

        // edit role
        Route::get('editrole', [UserController::class, 'editrole'])->name('role.edit');
        Route::put('editrole', [UserController::class, 'updaterole'])->name('role.update');

        //assign cluster and grade
        Route::get('assigncluster', [StudentController::class, 'assignCluster'])->name('assign.cluster');
        Route::put('assigncluster', [StudentController::class, 'storeAssignCluster'])->name('assign.cluster');
        Route::get('assigngrade', [StudentController::class, 'assignGrade'])->name('assign.grade');
        Route::put('assigngrade', [StudentController::class, 'storeAssignGrade'])->name('assign.grade');
        // Route::get('assignstage', [StudentController::class, 'assignStage'])->name('assign.stage');
        // Route::put('assignstage', [StudentController::class, 'storeAssignStage'])->name('assign.stage');

        // menu siswa
        Route::post('deletestudentall', [StudentController::class, 'deleteAll'])->name('deleteAll');
        Route::get('movecluster', [StudentController::class, 'moveGrade'])->name('move.grade');
        Route::put('movecluster', [StudentController::class, 'storeMoveGrade'])->name('move.grade');

        // raport
        Route::get('showraport/{id}', [StudentController::class, 'viewRaport'])->name('show.raport');

        // jurnal guru
        Route::get('jurnal', [JournalController::class, 'index'])->name('journal.index');
        Route::get('jurnal/{id}', [JournalController::class, 'showJournal'])->name('journal.show');

        // tahun ajaran
        Route::resource('year', YearController::class);
    });

    Route::middleware('role:guru')->group(function () {
        //dapatkan student cluster(kelompok)
        Route::get('student-cluster', [TeacherController::class, 'studentCluster'])->name('student.cluster');
        // assigncluster
        Route::get('t_assigncluster', [TeacherController::class, 'assignCluster'])->name('tassign.cluster');
        Route::put('t_assigncluster', [TeacherController::class, 'storeAssignCluster'])->name('tassign.cluster');
        // delete student cluster
        Route::delete('t_assigncluster/{id}', [TeacherController::class, 'deleteclusterstudent'])->name('tdestroy.cluster');

        // nilai
        Route::get('evalindex', [EvaluationController::class, 'evalIndex'])->name('eval.index');
        Route::get('eval-student', [EvaluationController::class, 'evalStudent'])->name('student.evaluation');
        Route::post('eval-student', [EvaluationController::class, 'evalStudentStore'])->name('student.evaluation.store');
        Route::get('eval-show/{id}', [EvaluationController::class, 'evalStudentShow'])->name('student.evaluation.show');

        // utk walas lihat siswa
        Route::get('student-grade', [TeacherController::class, 'studentGrade'])->name('student.grade');

        // akses walas
        Route::get('akses-walas', [HomeController::class, 'changeAccess'])->name('akses.walas');

        // akses jurnal
        Route::get('teacher-journal', [JournalController::class, 'show'])->name('teacher.journal');
        Route::get('journal-create/{teacher_id}', [JournalController::class, 'create'])->name('journal.create');
        Route::post('journal-create', [JournalController::class, 'store'])->name('journal.store');
        Route::get('journal-edit/{journal}/edit', [JournalController::class, 'edit'])->name('journal.edit');
        Route::put('journal-edit/{journal}', [JournalController::class, 'update'])->name('journal.update');
    });
});
