<?php

use App\Model\OptionUser;
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

Route::get('url', function (){
   dd(asset('/images'));
});

Route::get('/', function () {
    \Illuminate\Support\Facades\Log::debug("initiated");
    return view('login');
});

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin');

Route::get('/test', 'EmployeeController@test');

Route::post('/login', 'AuthController@login')->name('login');
Route::post('/admin/login', 'AuthController@adminLogin')->name('adminlogin');
Route::post('/logout', 'AuthController@logout')->name('logout');

Route::middleware(['employee'])->group(function(){
    Route::get('/instructions', function () {
        return view('instruction');
    })->name('instructions');

    Route::get('/welcome', 'EmployeeController@getUserInfo')->name('welcome');
    Route::get('/question', 'EmployeeController@getMCQQuestionsView')->name('get_mcq_question_view');
    Route::get('/situation_question', 'EmployeeController@getVideoQuestionsView')->name('situation_question');

    Route::post('/get_mcq_questions', 'EmployeeController@getMCQQuestions');
    Route::post('/set_mcq_answers', 'EmployeeController@setMCQAnswers');
    Route::post('/get_assesment_questions', 'EmployeeController@getSituationAssesmentQuestions');
    Route::post('/upload_video', 'EmployeeController@uploadVideo')->name('upload_video');


    // Route::get('/recording', function () {
    //     return view('recording');
    // })->name('recording');

    Route::get('/upload', function () {
        return view('upload');
    })->name('upload');

    Route::get('/thank_you', function () {
        return view('thank_you');
    })->name('thanku');

});


Route::middleware(['admin'])->group(function(){
    Route::get('/download_zip', 'AdminController@downloadZIP')->name('download_zip');

    Route::get('/admin/employees', 'AdminController@getEmployeeList')->name('employees');
    Route::post('/admin/employees/add', 'AdminController@addEmployee')->name('add_employee');
    Route::post('/admin/employees/edit', 'AdminController@editEmployee')->name('edit_employee');
    Route::delete('/admin/employees/remove', 'AdminController@removeEmployee')->name('remove_employee');
    Route::delete('/admin/employees/remove/all', 'AdminController@removeAllEmployee')->name('remove_all_employee');

    Route::get('/admin/employers', 'AdminController@getEmployerList')->name('employers');
    Route::post('/admin/employers/add', 'AdminController@addEmployer')->name('add_employer');
    Route::post('/admin/employers/edit', 'AdminController@editEmployer')->name('edit_employer');
    Route::post('/admin/employers/reset_pass', 'AdminController@resetPassofEmployer')->name('reset_pass');
    Route::delete('/admin/employers/remove', 'AdminController@removeEmployer')->name('remove_employer');

    Route::get('/admin/results', 'AdminController@getResult')->name('results');
    Route::get('/admin/results/download', 'AdminController@downloadResult')->name('download_results');
    Route::get('/admin/results/download/employee', 'AdminController@downloadEmployeeResult')->name('download_emp_result');
    Route::get('/admin/answers/mcq/', 'AdminController@getEmployeeMCQAnswer')->name('mcq_answers');
    Route::get('/admin/answers/video/', 'AdminController@getEmployeeVideoAnswer')->name('video_answers');
    Route::delete('/admin/answers/remove/all', 'AdminController@removeAllAnswers')->name('remove_all_answers');

    Route::get('/admin/questions/mcq/', 'AdminController@getMCQQuestions')->name('mcq_questions');
    Route::delete('/admin/questions/mcq/remove', 'AdminController@removeMCQQuestion')->name('remove_mcq_question');
    Route::delete('/admin/questions/mcq/remove/all', 'AdminController@removeAllMCQQuestion')->name('remove_all_mcq_question');
    Route::get('/admin/questions/mcq/status/{id}/{status}', 'AdminController@updateMCQQuestionStatus')->name('update_mcq_question_status');

    Route::get('/admin/questions/situation_assesment/', 'AdminController@getVideoQuestions')->name('situation_assesment');
    Route::post('/admin/questions/situation_assesment/edit', 'AdminController@editVideoQuestion')->name('edit_situation_assesment');
    Route::delete('/admin/questions/situation_assesment/remove', 'AdminController@removeVidoeQuestion')->name('remove_video_question');
    Route::delete('/admin/questions/situation_assesment/remove/all', 'AdminController@removeAllVidoeQuestion')->name('remove_all_video_question');
    Route::get('/admin/questions/situation_assesment/status/{id}/{status}', 'AdminController@updateVideoQuestionStatus')->name('update_video_question_status');

    Route::post('/set_excel_mcq_questions', 'AdminController@importMCQQuestion')->name('set_excel_mcq_questions');
    Route::post('/set_excel_assesment_questions', 'AdminController@importAssesmentQuestion')->name('set_excel_assesment_questions');
    Route::post('/set_excel_employee_list', 'AdminController@importEmployeeList')->name('set_excel_employee_list');
    // Route::post('/get_assesment_questions', 'EmployeeController@getSituationAssesmentQuestions');

    // Route::get('/question', function () {
    //     return view('mcq_question');
    // })->name('get_mcq_question_view');

});

Route::get('/videos/url/{name}', function($name){
    return redirect("/storage/videos/".$name);
})->name("getVideoURL");


Route::get('/images/employee/{name}', function($name){
    return redirect("/storage/images/employee/".$name);
})->name("getEmployeeImage");

Route::get('/images/employer/{name}', function($name){
    return redirect("/storage/images/employer/".$name);
})->name("getEmployerImage");
