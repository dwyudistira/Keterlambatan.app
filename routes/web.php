<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatesController;
use App\Http\Controllers\RayonsController;
use App\Http\Controllers\RombelsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\RoleController;

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

// Route::middleware('IsLogin')->group(function(){
    Route::middleware(['IsGuest'])->group(function() {
        Route::get('/', function () {
            return view('login');
        })->name('login');
        Route::post('/login',[UsersController::class, 'loginAuth'])->name('login.auth');
    });
    Route::get('/logout',[UsersController::class, 'logout'])->name('logout');
    
    Route::get('/error-permission', function() {
            return view('errors.permission');
        })->name('error.permission');
    
    Route::middleware(['IsLogin'])->group(function() {
        Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
        // Route::get('/home', function () {
        //     return view('home');
        // })->name('home.page');
    });


    Route::middleware(['IsLogin', 'IsPs'])->group(function() {
        Route::prefix('/Ps')->name('Ps.')->group(function(){
            Route::prefix('/role')->name('role.')->group(function(){
                Route::get('/home', [StudentsController::class, 'dashboard'])->name('home');
                Route::get('/data/siswa/search', [StudentsController::class, 'search'])->name('search');
                Route::get('/data/siswa', [StudentsController::class, 'dataSiswa'])->name('dataSiswa');
                Route::get('/data/late', [LatesController::class, 'dataLate'])->name('dataLate');
                Route::get('/data/late/{id}', [LatesController::class, 'dataLihat'])->name('dataLihat');
                Route::get('/data/rekap', [LatesController::class, 'data'])->name('dataRekap');
                Route::get('/cetaklate/{id}', [LatesController::class, 'cetakLate'])->name('print');
                Route::get('/lates/export-excel-lates',[LatesController::class, 'exportExcel' ])->name('export.excel.lates');
            });
        });
    });
    
    Route::middleware(['IsLogin', 'IsAdmin'])->group(function() {
        Route::get('/home', function () {
            return view('home');
        })->name('home.page');
        Route::prefix('/late')->name('late.')->group(function(){
            Route::get('/create', [LatesController::class, 'create'])->name('create');
            Route::post('/store', [LatesController::class, 'store'])->name('store');
            Route::get('/', [LatesController::class, 'index'])->name('home');
            Route::get('/{id}', [LatesController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [LatesController::class, 'update'])->name('update');
            Route::delete('/{id}', [LatesController::class, 'destroy'])->name('delete');
            Route::get('/data/rekap', [LatesController::class, 'data'])->name('data');
            Route::get('/data/{student_id}', [LatesController::class, 'show'])->name('rekap');
            Route::get('/cetaklate/{id}', [LatesController::class, 'cetakLate'])->name('print');
            Route::get('/lates/search', [LatesController::class, 'search'])->name('search');
            Route::get('/lates/export-excel-lates',[LatesController::class, 'exportExcel' ])->name('export.excel.lates');
        });
        
        Route::prefix('/user')->name('user.')->group(function(){
            Route::get('/create', [UsersController::class, 'create'])->name('create');
            Route::post('/store', [UsersController::class, 'store'])->name('store');
            Route::get('/', [UsersController::class, 'index'])->name('home');
            Route::get('/{id}', [UsersController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [UsersController::class, 'update'])->name('update');
            Route::delete('/{id}', [UsersController::class, 'destroy'])->name('delete');
            Route::get('/user/search', [UsersController::class, 'search'])->name('search');
        });
        
        Route::prefix('/rayon')->name('rayon.')->group(function(){
            Route::get('/create', [RayonsController::class, 'create'])->name('create');
            Route::post('/store', [RayonsController::class, 'store'])->name('store');
            Route::get('/', [RayonsController::class, 'index'])->name('home');
            Route::get('/{id}', [RayonsController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [RayonsController::class, 'update'])->name('update');
            Route::delete('/{id}', [RayonsController::class, 'destroy'])->name('delete');
            Route::get('/rayon/search', [RayonsController::class, 'search'])->name('search');
        });
        
        Route::prefix('/rombel')->name('rombel.')->group(function(){
            Route::get('/create', [RombelsController::class, 'create'])->name('create');
            Route::post('/store', [RombelsController::class, 'store'])->name('store');
            Route::get('/', [RombelsController::class, 'index'])->name('home');
            Route::get('/{id}', [RombelsController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [RombelsController::class, 'update'])->name('update');
            Route::delete('/{id}', [RombelsController::class, 'destroy'])->name('delete');
            Route::get('/rombel/search', [RombelsController::class, 'search'])->name('search');
        });
        Route::prefix('/student')->name('student.')->group(function(){
            Route::get('/create', [StudentsController::class, 'create'])->name('create');
            Route::post('/store', [StudentsController::class, 'store'])->name('store');
            Route::get('/', [StudentsController::class, 'index'])->name('home');
            Route::get('/{id}', [StudentsController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [StudentsController::class, 'update'])->name('update');
            Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('delete');
            Route::get('/student/search', [StudentsController::class, 'search'])->name('search');
        });
    });
    

Route::prefix('/user')->name('user.')->group(function(){
});
