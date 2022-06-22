<?php

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

//Route::get('/', function () {
//    return view('home.index');
//});
//Route::get('/home.blank', function () {
//    return view('home.blank');
//});

Route::get('/download/{patch}/{file}', 'DownloadController@download');
Route::get('/', 'Home\HomeController@index');
Route::get('/profile', 'ProfileController@index');
Route::any('/profileUpdate/{id}', 'ProfileController@update');
Route::get('/profile/updatepassword/{id}', 'ProfileController@updatepassword');
Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
    Route::get('export', 'HomeController@export');

    Route::get('/index', 'HomeController@index');
    Route::get('/consult', 'HomeController@consult');
    Route::get('/consultSingle/{id}', 'HomeController@consultSingle');

    Route::get('/service', 'HomeController@service');
    Route::get('/blog', 'HomeController@blog');
    Route::get('/blog/{id}', 'HomeController@blog_single');
    Route::get('/about_us', 'HomeController@about_us');
    Route::get('/contact_us', 'HomeController@contact_us');
    Route::post('/contact/store', 'HomeController@contact_store');
    Route::get('/tagSearch/{id}', 'HomeController@tagSearch');
    Route::any('/search', 'HomeController@search');
});


Route::group(['prefix' => 'panel', 'namespace' => 'Panel'], function () {

    Route::get('/report/{id}', 'ReportController@create');
    Route::post('/reportStore', 'ReportController@store');
    Route::post('/report/update/{id}', 'ReportController@update');
    Route::any('/report/destroy/{id}', 'ReportController@destroy');

    Route::get('/taraz', 'TarazController@create');
    Route::get('/taraz/index/{id}', 'TarazController@index');
    Route::post('/tarazStore', 'TarazController@store');
    Route::get('/karnameh/{id}', 'TarazController@karnameh');
    Route::any('/taraz/destroy/{id}', 'TarazController@destroy');


    Route::post('/comments/{id}', 'CommentController@index');
    Route::post('/comment/store', 'CommentController@store');
    Route::any('/comment/destroy/{id}', 'CommentController@destroy');


    Route::get('/manager_debt', 'PanelController@manager_debt')->middleware('can:consult-list');
    Route::get('/manager_debt_export', 'PanelController@manager_debt_export')->middleware('can:consult-list');
    Route::get('/manager_clear', 'PanelController@manager_clear')->middleware('can:consult-list');
    Route::get('/financeExcel', 'PanelController@finance')->middleware('can:consult-list');

    Route::post('/uploadExcel', 'PanelController@uploadUser');


    Route::any('/updateSite', 'PanelController@updateSite');
    Route::resource('/notification', 'NotificationController');
    Route::get('/notification/changeStatus/{id}/{status}', 'NotificationController@changeStatus');

    Route::resource('/pattern', 'PatternController');
    Route::get('/pattern/doros/{id}', 'PatternController@doros');
    Route::post('/pattern/doros/store', 'PatternController@dorosStore');
    Route::get('/pattern/edit/{id}', 'PatternController@edit');
    Route::post('/pattern/update/{id}', 'PatternController@update');
    Route::get('/pattern/changeStatus/{id}/{status}', 'PatternController@changeStatus');
    Route::any('/pattern/deletePattern/{id}', 'PatternController@destroy');
    Route::get('/pattern/report/dailyReport', 'PatternController@dailyReport');
    Route::post('/pattern/report/daily', 'PatternController@daily');
    Route::get('/pattern/report/monthReport', 'PatternController@monthReport');
    Route::post('/pattern/report/month', 'PatternController@month');

#image
    Route::any('/deleteImage/{id}', 'PanelController@deleteImage');
#end image
    # Roles
    Route::resource('roles', 'RoleController');
# End Roles

# Roles
    Route::resource('users', 'UserController');;
    Route::any('/users/userDestroy/{id}', 'UserController@delete');

# End Roles

    Route::get('/index', 'PanelController@index');
    Route::post('/state_city', 'PanelController@state_city');
    Route::resource('/student', 'StudentController')->middleware('can:student-list');
    Route::get('/student/single/{id}', 'StudentController@single')->middleware('can:student-list');
    Route::get('/student/count/{count}', 'StudentController@count')->middleware('can:student-list');
    Route::get('/students/export', 'StudentController@export')->middleware('can:student-list');
    Route::get('/student/destroy/{id}', 'StudentController@delete')->middleware('can:student-delete');

    Route::get('/student/service/{id}', 'StudentController@service')->middleware('can:student-list');
    Route::post('/student/serviceShow/{id}', 'StudentController@serviceShow')->middleware('can:student-list');
    Route::post('/student/serviceFinance/{id}', 'StudentController@serviceFinance')->middleware('can:student-list');
    Route::post('/student/serviceFinanceStore/{id}', 'StudentController@serviceFinanceStore')->middleware('can:student-list');
    Route::post('/student/service/store', 'StudentController@serviceStore')->middleware('can:student-list');
    Route::post('/student/service/update/{id}', 'StudentController@serviceUpdate')->middleware('can:student-list');
    Route::any('/student/service/destroy/{id}', 'StudentController@servicedestroy')->middleware('can:student-list');
    Route::any('/student/finance/{id}', 'StudentController@studentFinance')->middleware('can:student-list');
    Route::get('/student/cancel/{id}', 'StudentController@cancel')->middleware('can:student-list');

    Route::post('/consult/student/{id}', 'StudentController@consult')->middleware('can:student-list');
    Route::get('/consult/finance/auth', 'Home\ConsultController@financeauth');
    Route::get('/consult/finance/{id}', 'Home\ConsultController@finance')->middleware('can:consult-create');
    Route::get('/caller/finance/{id}', 'CallerController@finance')->middleware('can:caller-finance');
    Route::get('/callers/export', 'CallerController@export')->middleware('can:caller-finance');
    Route::get('/caller_debt', 'CallerController@debt')->middleware('can:consult-list');
    Route::get('/caller_debt_export', 'CallerController@callerDebt')->middleware('can:consult-list');

    Route::resource('/finance', 'FinanceController')->middleware('can:finance');
    Route::any('/finance/changeStatus/{id}/{read}', 'FinanceController@changeStatus')->middleware('can:finance');
    Route::any('/deleteFinance/{id}', 'FinanceController@delete')->middleware('can:finance');

    Route::resource('/suggest', 'SuggestController');
    Route::get('/deleteSuggest/{id}', 'SuggestController@delete');

    Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
        Route::resource('/slider', 'SliderController')->middleware('can:slider');
        Route::any('/deleteSlider/{id}', 'SliderController@delete')->middleware('can:slider');

        Route::post('/changeStatusShowConsults', 'ConsultController@changeStatus');
        Route::resource('/consult', 'ConsultController')->middleware('can:consult-list');
        Route::get('/consults/export', 'ConsultController@export')->middleware('can:consult-list');
        Route::any('/deleteConsult/{id}', 'ConsultController@delete')->middleware('can:student-list');
        Route::get('/consult_debt', 'ConsultController@debt')->middleware('can:consult-list');
        Route::get('/consult_debt_export', 'ConsultController@consultDebt')->middleware('can:consult-list');


        Route::resource('/service', 'ServiceController')->middleware('can:service');
        Route::post('/service/changeStatus', 'ServiceController@changeStatus')->middleware('can:service');
        Route::any('/deleteService/{id}', 'ServiceController@delete')->middleware('can:service');
        Route::resource('/blog', 'BlogController')->middleware('can:blog');
        Route::any('/blog/deleteBlog/{id}', 'BlogController@delete')->middleware('can:blog');
        Route::resource('/about_us', 'AboutController')->middleware('can:about');
        Route::resource('/contact_us', 'ContactController')->middleware('can:slider');
        Route::any('/contact_us/changeStatus/{id}/{read}', 'ContactController@changeStatus')->middleware('can:contact');
        Route::resource('/tag', 'TagController')->middleware('can:blog');
        Route::any('users/{id}', 'BlogController@destroyy')->name('posts.destroy')->middleware('can:blog');
    });

    Route::group(['prefix' => 'students'], function () {
        Route::get('/consult/show', 'Home\ConsultController@show')->middleware('can:consult-list');
        Route::resource('/pattern', 'Student\PatternController');
        Route::get('/pattern/doros/{id}', 'Student\PatternController@doros');
        Route::get('/pattern/date/{id}', 'Student\PatternController@date');
        Route::post('/pattern/sabt', 'Student\PatternController@sabt');
        Route::post('/pattern/sabt/dars', 'Student\PatternController@sabtDars');

    });
});


Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
