<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Authentications Routes
 */
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'check'])->name('check');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'signup'])->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/{platform}/redirect', [AuthController::class, 'redirect'])->name('platform.redirect');
Route::get('/auth/{platform}/callback', [AuthController::class, 'callback'])->name('platform.callback');

/**
 * Ticket Status Routes
 */
Route::get('/dashboard/tickets/status/{status}', [TicketController::class, 'statusArchive'])->name('statusArchive');

/**
 * Dashboard Routes
 */
Route::prefix('/dashboard')->middleware('auth')->name('dashboard.')->group(function (){
    Route::get('/', [UserController::class, 'dashboard'])->name('index');

    /**
     * Companies Routes
     */
    Route::resource('/companies', CompanyController::class);
    Route::prefix('/companies/{company}')->name('companies.')->group(function (){

    });

    /**
     * Tickets Routes
     */
    Route::prefix('/tickets')->name('tickets.')->group(function (){
        Route::resource('/',TicketController::class)->except(['show','edit','update']);
        Route::get('/{ticket}', [TicketController::class, 'show'])->name('show');
        Route::get('/{ticket}/edit', [TicketController::class, 'edit'])->name('edit');
        Route::patch('/{ticket}', [TicketController::class, 'update'])->name('update');
        Route::delete('/', [TicketController::class, 'delete'])->name('deleteTicket');
        Route::patch('/close', [TicketController::class, 'close'])->name('closeTicket');
    });

    /**
     * Users Route
     */
    Route::prefix('/user')->name('user.')->group(function (){
        Route::get('/', [UserController::class, 'index'])->name('userProfile');
        Route::get('/create', [UserController::class, 'create'])->name('createUser');
        Route::post('/', [UserController::class, 'store'])->name('storeUser');
        Route::patch('/', [UserController::class, 'update'])->name('updateUser');
        Route::put('/', [UserController::class, 'updatePassword'])->name('updateUserPassword');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('editUser');
        Route::delete('/', [UserController::class, 'delete'])->name('deleteUser');
    });
    Route::get('/users', [UserController::class, 'allUsers'])->name('allUsers');

    /**
     * Modules Routes
     */
    Route::prefix('/modules')->name('modules.')->group(function (){
        Route::get('/',[ModuleController::class, 'index'])->name('allModules');
        Route::get('/create',[ModuleController::class, 'create'])->name('createModule');
        Route::delete('/', [ModuleController::class, 'delete'])->name('deleteModule');
        Route::post('/enable', [ModuleController::class, 'enable'])->name('enableModule');
        Route::post('/disable', [ModuleController::class, 'disable'])->name('disableModule');
        Route::post('/install', [ModuleController::class, 'install'])->name('installModule');
    });

    /**
     * Departments Routes
     */
    Route::prefix('/departments')->name('departments.')->group(function (){
        Route::get('/',[DepartmentController::class, 'index'])->name('allDepartments');
        Route::get('/{department}/edit',[DepartmentController::class, 'edit'])->name('editDepartments');
        Route::get('/create',[DepartmentController::class, 'create'])->name('createDepartment');
        Route::post('/', [DepartmentController::class, 'store'])->name('storeDepartment');
        Route::patch('/', [DepartmentController::class, 'update'])->name('updateDepartment');
        Route::delete('/', [DepartmentController::class, 'delete'])->name('deleteDepartment');
    });

    /**
     * Priorities Routes
     */
    Route::prefix('/priorities')->name('priorities.')->group(function (){
        Route::get('/',[PriorityController::class, 'index'])->name('allPriorities');
        Route::get('/{priority}/edit',[PriorityController::class, 'edit'])->name('editPriority');
        Route::get('/create',[PriorityController::class, 'create'])->name('createPriority');
        Route::post('/',[PriorityController::class, 'store'])->name('storePriority');
        Route::patch('/', [PriorityController::class, 'update'])->name('updatePriority');
        Route::delete('/',[PriorityController::class, 'delete'])->name('deletePriority');
    });

    /**
     * Ticket status Routes
     */
    Route::prefix('/status')->name('status.')->group(function (){
        Route::get('/',[TicketStatusController::class, 'index'])->name('allTicketStatuses');
        Route::get('/{ticketStatus}/edit',[TicketStatusController::class, 'edit'])->name('editTicketStatus');
        Route::get('/create',[TicketStatusController::class, 'create'])->name('createTicketStatuses');
        Route::post('/',[TicketStatusController::class, 'store'])->name('storeTicketStatus');
        Route::patch('/', [TicketStatusController::class, 'update'])->name('updateTicketStatus');
        Route::delete('/',[TicketStatusController::class, 'delete'])->name('deleteTicketStatus');
    });

    /**
     * Messages Route
     */
    Route::post('/messages/{ticket}', [MessageController::class, 'store'])->name('storeMessage');
    Route::patch('/messages/{message}', [MessageController::class, 'update'])->name('updateMessage');

    /**
     * Search Route
     */
    Route::get('/search', [TicketController::class, 'search'])->name('search');
});
