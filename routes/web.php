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


//==============view=============
Route::get('/', [\App\Http\Controllers\viewConreoller::class, 'index']);
Route::get('/register', [\App\Http\Controllers\viewConreoller::class, 'register']);
Route::get('/login', [\App\Http\Controllers\viewConreoller::class, 'login']);
Route::get('/abute', [\App\Http\Controllers\viewConreoller::class, 'abute']);
Route::middleware(\App\Http\Middleware\user::class)->get('/other', [\App\Http\Controllers\viewConreoller::class, 'other']);
Route::middleware(\App\Http\Middleware\user::class)->get('/panel', [\App\Http\Controllers\viewConreoller::class, 'panel']);
Route::middleware(\App\Http\Middleware\user::class)->get('/chate', [\App\Http\Controllers\viewConreoller::class, 'chate']);
Route::middleware(\App\Http\Middleware\user::class)->get('/search', [\App\Http\Controllers\viewConreoller::class, 'search'])->name('search');
Route::middleware(\App\Http\Middleware\user::class)->get('/byForYou', [\App\Http\Controllers\viewConreoller::class, 'byForYou'])->name('byForYou');
Route::middleware(\App\Http\Middleware\user::class)->get('/resetCa', [\App\Http\Controllers\viewConreoller::class, 'resetCam'])->name('resetCam');
Route::middleware(\App\Http\Middleware\user::class)->get('/resetDe', [\App\Http\Controllers\viewConreoller::class, 'resetDevice'])->name('resetDevice');
Route::middleware(\App\Http\Middleware\user::class)->get('/searchViwe', [\App\Http\Controllers\viewConreoller::class, 'searchViwe'])->name('searchViwe');
Route::middleware(\App\Http\Middleware\user::class)->get('/showDevice/{id}', [\App\Http\Controllers\viewConreoller::class, 'showDevice'])->name('showDevice');
Route::get('/ruls', [\App\Http\Controllers\viewConreoller::class, 'ruls'])->name('ruls');

//==============view=============


//==============chat==================
Route::middleware(\App\Http\Middleware\user::class)->post('/completeInfo/{id}', [\App\Http\Controllers\ChateController::class, 'completeInfo'])->name('completeInfo');
Route::middleware(\App\Http\Middleware\user::class)->post('/reciveData', [\App\Http\Controllers\ChateController::class, 'reciveData'])->name('reciveData');
Route::middleware(\App\Http\Middleware\user::class)->post('/checkSendChat', [\App\Http\Controllers\ChateController::class, 'checkSendChat'])->name('checkSendChat');
Route::middleware(\App\Http\Middleware\user::class)->post('/chateOther/{row}/{id}', [\App\Http\Controllers\ChateController::class, 'chateOther'])->name('chateOther');
Route::middleware(\App\Http\Middleware\user::class)->get('/lastSeenAdmin/{last}/{id}', [\App\Http\Controllers\ChateController::class, 'lastSeenAdmin'])->name('lastSeenAdmin');
Route::middleware(\App\Http\Middleware\user::class)->post('/sendUserAudio', [\App\Http\Controllers\ChateController::class, 'sendUserAudio'])->name('sendUserAudio');
//==============chat==================

//============regester login===========
Route::post('/user/getPhon', [\App\Http\Controllers\UserController::class, 'getPhon'])->name('getPhon');
Route::post('/user/atheUser', [\App\Http\Controllers\UserController::class, 'atheUser'])->name('atheUser');
Route::post('/user/setUserPass', [\App\Http\Controllers\UserController::class, 'setUserPass'])->name('setUserPass');
Route::post('/user/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('/user/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::post('/UserInfo', [\App\Http\Controllers\UserController::class, 'UserInfo'])->name('UserInfo');
Route::get('/resePassVwie', [\App\Http\Controllers\viewConreoller::class, 'resePassVwie'])->name('resePassVwie');
Route::post('/resetPass/auth', [\App\Http\Controllers\UserController::class, 'resetPassAuth'])->name('resetPassAuth');
Route::post('/resetPass/reset', [\App\Http\Controllers\UserController::class, 'resetPass'])->name('resetPass');
Route::post('/resetPass/passChang', [\App\Http\Controllers\UserController::class, 'passChang'])->name('passChang');
//============regester login===========

//=================user===============
Route::get('/user/addFlash/{device}/{user}/{flash}/{iprom}', [\App\Http\Controllers\UserController::class, 'addFlash'])->name('addFlash');
Route::delete('/user/deleteFlash/{id}', [\App\Http\Controllers\UserController::class, 'deleteFlash'])->name('deleteFlash');
Route::post('/user/byFlash', [\App\Http\Controllers\UserController::class, 'byFlash'])->name('byFlash');
Route::get('/user/downloadeFile/{file}/{order}/{type}', [\App\Http\Controllers\UserController::class, 'downloadeFile'])->name('downloadeFile');
Route::get('/user/checkPay', [\App\Http\Controllers\UserController::class, 'checkPay'])->name('checkPay');
Route::post('/user/addComment', [\App\Http\Controllers\CommentController::class, 'addComment'])->name('addComment');
//=================user===============


//==============admin=============
Route::get('/admin/login', [\App\Http\Controllers\viewConreoller::class, 'loginAdmin']);
Route::POST('/loginAdmin', [\App\Http\Controllers\AdminController::class, 'loginAdmin'])->name('loginAdmin');
Route::get('/logoutAdmin', [\App\Http\Controllers\AdminController::class, 'logoutAdmin'])->name('logoutAdmin');
Route::post('/resetMonny', [\App\Http\Controllers\DataController::class, 'resetMonny'])->name('resetMonny');
Route::middleware(\App\Http\Middleware\admin::class)->prefix('/dashbord')->group(function () {
    Route::get('/', [\App\Http\Controllers\viewConreoller::class, 'dashbord']);



    // ==========user==========
    Route::get('/userList', [\App\Http\Controllers\viewConreoller::class, 'userList'])->name('userList');
    Route::get('/userSearch', [\App\Http\Controllers\viewConreoller::class, 'userSearch'])->name('userSearch');
    // ==========user==========




    




    Route::post('/changInfo', [\App\Http\Controllers\InfoController::class, 'changInfo'])->name('changInfo');
    Route::get('/infoVwie', [\App\Http\Controllers\viewConreoller::class, 'infoVwie'])->name('infoVwie');
    



    
    // ==========flash==========
    Route::get('/flashList', [\App\Http\Controllers\viewConreoller::class, 'flashList'])->name('flashList');
    Route::get('/flashShow/{id}', [\App\Http\Controllers\viewConreoller::class, 'flashShow'])->name('flashShow');
    Route::get('/flashSearch', [\App\Http\Controllers\viewConreoller::class, 'flashSearch'])->name('flashSearch');
    Route::post('/updatPiceALL', [\App\Http\Controllers\DeviceController::class, 'updatPiceALL'])->name('updatPiceALL');
    Route::get('/loadFlash', [\App\Http\Controllers\DeviceController::class, 'loadFlash'])->name('loadFlash');
    Route::post('/flashLodear', [\App\Http\Controllers\DeviceController::class, 'flashLodear'])->name('flashLodear');
    Route::delete('/flashDelete/{id}', [\App\Http\Controllers\DeviceController::class, 'flashDelete'])->name('flashDelete');
    Route::POST('/user/flashUpdate/{id}', [\App\Http\Controllers\DeviceController::class, 'flashUpdate'])->name('flashUpdate');
    Route::get('/user/flashUpdateManualV/{id}', [\App\Http\Controllers\DeviceController::class, 'flashUpdateManualV'])->name('flashUpdateManualV');
    Route::POST('/user/flashUpdateManual/{id}', [\App\Http\Controllers\DeviceController::class, 'flashUpdateManual'])->name('flashUpdateManual');
    // ==========flash==========
    


    
    // =================by for you=================
    Route::get('/byForYouList', [\App\Http\Controllers\viewConreoller::class, 'byForYouList'])->name('byForYouList');
    Route::get('/byForYouInsertViwe', [\App\Http\Controllers\viewConreoller::class, 'byForYouInsertViwe'])->name('byForYouInsertViwe');
    Route::post('/byForYouInsert', [\App\Http\Controllers\ByForYouController::class, 'byForYouInsert'])->name('byForYouInsert');
    Route::get('/byForYouImage', [\App\Http\Controllers\viewConreoller::class, 'byForYouImage'])->name('byForYouImage');
    Route::post('/byForYouImageInsert', [\App\Http\Controllers\ByForYouController::class, 'byForYouImageInsert'])->name('byForYouImageInsert');
    Route::delete('/byForYouDelete/{id}', [\App\Http\Controllers\ByForYouController::class, 'byForYouDelete'])->name('byForYouDelete');
    // =================by for you=================
    



    //===============reset cam================
    Route::post('/resetPassCamLoder', [\App\Http\Controllers\RsetCamController::class, 'resetPassCamLoder'])->name('resetPassCamLoder');
    Route::get('/resetCamlist', [\App\Http\Controllers\RsetCamController::class, 'resetCamlist'])->name('resetCamlist');
    Route::delete('/resetCamDelete/{id}', [\App\Http\Controllers\RsetCamController::class, 'resetCamDelete'])->name('resetCamDelete');
    Route::get('/resetCamUpdatAddV', [\App\Http\Controllers\RsetCamController::class, 'resetCamUpdatAddV'])->name('resetCamUpdatAddV');
    Route::get('/resetCamUpdatView/{id}', [\App\Http\Controllers\RsetCamController::class, 'resetCamUpdatView'])->name('resetCamUpdatView');
    Route::post('/resetCamUpdateM/{id}', [\App\Http\Controllers\RsetCamController::class, 'resetCamUpdateM'])->name('resetCamUpdateM');
    Route::post('/resetCamUpdate/{id}', [\App\Http\Controllers\RsetCamController::class, 'resetCamUpdate'])->name('resetCamUpdate');
    //===============reset cam================





    //===============reset Device================
    Route::post('/resetPassDvrNvrLoder', [\App\Http\Controllers\RsetDeviceController::class, 'resetPassDvrNvrLoder'])->name('resetPassDvrNvrLoder');
    Route::get('/resetDevicelist', [\App\Http\Controllers\RsetDeviceController::class, 'resetDevicelist'])->name('resetDevicelist');
    Route::delete('/resetDeviceDelete/{id}', [\App\Http\Controllers\RsetDeviceController::class, 'resetDeviceDelete'])->name('resetDeviceDelete');
    Route::get('/resetDeviceUpdatView/{id}', [\App\Http\Controllers\RsetDeviceController::class, 'resetDeviceUpdatView'])->name('resetDeviceUpdatView');
    Route::get('/resetDevicelistAddV', [\App\Http\Controllers\RsetDeviceController::class, 'resetDevicelistAddV'])->name('resetDevicelistAddV');
    Route::get('/resetDevicelistAdd', [\App\Http\Controllers\RsetDeviceController::class, 'resetDevicelistAdd'])->name('resetDevicelistAdd');
    Route::post('/resetDeviceUpdateM/{id}', [\App\Http\Controllers\RsetDeviceController::class, 'resetDeviceUpdateM'])->name('resetDeviceUpdateM');
    Route::post('/resetDeviceUpdate/{id}', [\App\Http\Controllers\RsetDeviceController::class, 'resetDeviceUpdate'])->name('resetDeviceUpdate');
    //===============reset Device================




    //===================== comment =============
    Route::get('/commentList', [\App\Http\Controllers\CommentController::class, 'commentList'])->name('commentList');
    Route::get('/commentUpdateShow/{id}', [\App\Http\Controllers\CommentController::class, 'commentUpdateShow'])->name('commentUpdateShow');
    Route::post('/commentUpdate/{id}', [\App\Http\Controllers\CommentController::class, 'commentUpdate'])->name('commentUpdate');
    Route::delete('/commentDelete/{id}', [\App\Http\Controllers\CommentController::class, 'commentDelete'])->name('commentDelete');
    //===================== comment =============



    // ====================== chat ====================
    Route::get('/chatlist', [\App\Http\Controllers\ChateController::class, 'chatlist'])->name('chatlist');
    Route::get('/chatAdmin/{chate_id}', [\App\Http\Controllers\ChateController::class, 'chatAdmin'])->name('chatAdmin');
    Route::post('/reciveDataAdmin', [\App\Http\Controllers\ChateController::class, 'reciveDataAdmin'])->name('reciveDataAdmin');
    Route::middleware(\App\Http\Middleware\user::class)->post('/sendAdminAudio', [\App\Http\Controllers\ChateController::class, 'sendAdminAudio'])->name('sendAdminAudio');
    // ====================== chat ====================
});

//==============admin=============F
