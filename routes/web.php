<?php

use App\Http\Controllers\PackegeController;
use App\Http\Controllers\RsetDeviceController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ByForYouController;
use App\Http\Controllers\RsetCamController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\viewConreoller;
use App\Http\Controllers\ChateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ByForYouUpdateController;
use App\Http\Controllers\CooperateController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\OnlinController;
use App\Http\Controllers\UpdateFileController;
use App\Http\Middleware\user;
use App\Http\Middleware\admin;
use App\Http\Middleware\adminL1;
use App\Http\Middleware\adminL2;
use App\Http\Middleware\adminL3;
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
Route::get('/splash',[viewConreoller::class, 'index']);
Route::get('/', [viewConreoller::class, 'index']);
Route::get('/register', [viewConreoller::class, 'register']);
Route::get('/login', [viewConreoller::class, 'login']);
Route::get('/abute', [viewConreoller::class, 'abute']);
Route::middleware(user::class)->get('/other', [viewConreoller::class, 'other']);
Route::middleware(user::class)->get('/shopPage', [viewConreoller::class, 'shopPage']);
Route::middleware(user::class)->get('/panel', [viewConreoller::class, 'panel']);
Route::middleware(user::class)->get('/chate', [viewConreoller::class, 'chate']);
Route::middleware(user::class)->get('/byForYou', [viewConreoller::class, 'byForYou'])->name('byForYou');
Route::middleware(user::class)->get('/byForYouUpdateFile', [viewConreoller::class, 'byForYouUpdateFile'])->name('byForYouUpdateFile');
Route::middleware(user::class)->get('/resetCa', [viewConreoller::class, 'resetCam'])->name('resetCam');
Route::middleware(user::class)->get('/resetDe', [viewConreoller::class, 'resetDevice'])->name('resetDevice');
Route::middleware(user::class)->post('/editeUserInfo/{id}', [UserController::class, 'editeUserInfo'])->name('editeUserInfo');
Route::middleware(user::class)->post('/editeUserImg/{id}', [UserController::class, 'editeUserImg'])->name('editeUserImg');
Route::middleware(user::class)->get('/packegeL', [viewConreoller::class, 'packegeL'])->name('packegeL');
Route::middleware(user::class)->get('/cooperateL', [viewConreoller::class, 'cooperateL'])->name('cooperateL');
Route::middleware(user::class)->get('/katalogL', [viewConreoller::class, 'katalogL'])->name('katalogL');
Route::get('/resePassVwie', [viewConreoller::class, 'resePassVwie'])->name('resePassVwie');
Route::get('/ruls', [viewConreoller::class, 'ruls'])->name('ruls');
// ================device=================
Route::middleware(user::class)->get('/search', [viewConreoller::class, 'search'])->name('search');
Route::middleware(user::class)->get('/searchViwe', [viewConreoller::class, 'searchViwe'])->name('searchViwe');
Route::middleware(user::class)->get('/showDevice/{id}', [viewConreoller::class, 'showDevice'])->name('showDevice');
// ================device=================
// ================update=================
Route::middleware(user::class)->get('/searchUpdate', [viewConreoller::class, 'searchUpdate'])->name('searchUpdate');
Route::middleware(user::class)->get('/searchUpdateViwe', [viewConreoller::class, 'searchUpdateViwe'])->name('searchUpdateViwe');
Route::middleware(user::class)->get('/showDeviceUpdate/{id}', [viewConreoller::class, 'showDeviceUpdate'])->name('showDeviceUpdate');
// ================update=================
//==============view=============


//==============chat==================
Route::middleware(user::class)->post('/completeInfo/{id}', [ChateController::class, 'completeInfo'])->name('completeInfo');
Route::middleware(user::class)->post('/reciveData', [ChateController::class, 'reciveData'])->name('reciveData');
Route::middleware(user::class)->post('/chateOther/{row}/{id}', [ChateController::class, 'chateOther'])->name('chateOther');
Route::get('/lastSeenAdmin/{last}/{id}', [ChateController::class, 'lastSeenAdmin'])->name('lastSeenAdmin');
Route::middleware(user::class)->get('/lastSeenUser/{last}/{id}', [ChateController::class, 'lastSeenUser'])->name('lastSeenUser');
Route::post('/checkSendChat', [ChateController::class, 'checkSendChat'])->name('checkSendChat');
Route::get('/checkSeeAdmin/{last}/{id}', [ChateController::class, 'checkSeeAdmin'])->name('checkSeeAdmin');
Route::get('/checkSeeUser/{last}/{id}', [ChateController::class, 'checkSeeUser'])->name('checkSeeUser');
Route::middleware(user::class)->post('/sendUserAudio', [ChateController::class, 'sendUserAudio'])->name('sendUserAudio');
Route::middleware(user::class)->post('/deletMessUser', [ChateController::class, 'deletMessUser'])->name('deletMessUser');
//==============chat==================

//============regester login===========
Route::post('/user/getPhon', [UserController::class, 'getPhon'])->name('getPhon');
Route::post('/user/atheUser', [UserController::class, 'atheUser'])->name('atheUser');
Route::post('/user/setUserPass', [UserController::class, 'setUserPass'])->name('setUserPass');
Route::post('/user/login', [UserController::class, 'login'])->name('login');
Route::get('/user/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/UserInfo', [UserController::class, 'UserInfo'])->name('UserInfo');
Route::post('/resetPass/auth', [UserController::class, 'resetPassAuth'])->name('resetPassAuth');
Route::post('/resetPass/reset', [UserController::class, 'resetPass'])->name('resetPass');
Route::post('/resetPass/passChang', [UserController::class, 'passChang'])->name('passChang');
//============regester login===========

//=================user===============
Route::get('/user/addFlash/{device}/{user}/{flash}/{iprom}', [UserController::class, 'addFlash'])->name('addFlash');
Route::get('/user/addFileUpdShop/{device}', [UserController::class, 'addFileUpdShop'])->name('addFileUpdShop');
Route::delete('/user/deleteFlash/{id}', [UserController::class, 'deleteFlash'])->name('deleteFlash');
Route::post('/user/byFlash', [UserController::class, 'byFlash'])->name('byFlash');
Route::get('/user/downloadeFile/{file}/{order}/{type}', [UserController::class, 'downloadeFile'])->name('downloadeFile');
Route::get('/user/checkPay', [UserController::class, 'checkPay'])->name('checkPay');
Route::post('/user/addComment', [CommentController::class, 'addComment'])->name('addComment');
Route::post('/checkFrind', [UserController::class, 'checkFrind'])->name('checkFrind');
//=================user===============


//===============packege================
Route::middleware(user::class)->post('/addShopPackege/{id}', [PackegeController::class, 'addShopPackege'])->name('addShopPackege');
Route::middleware(user::class)->delete('/deleteShopPack/{id}', [PackegeController::class, 'deleteShopPack'])->name('deleteShopPack');
//===============packege================

//===============downCooperate================
Route::middleware(user::class)->post('/downCooperate/{id}', [CooperateController::class, 'downCooperate'])->name('downCooperate');
//===============downCooperate================

Route::middleware(user::class)->post('/changScorDisc', [UserController::class, 'changScorDisc'])->name('changScorDisc');




///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
//==============admin=============
Route::get('/admin/login', [viewConreoller::class, 'loginAdmin']);
Route::POST('/loginAdmin', [AdminController::class, 'loginAdmin'])->name('loginAdmin');
Route::get('/logoutAdmin', [AdminController::class, 'logoutAdmin'])->name('logoutAdmin');
Route::post('/resetMonny', [DataController::class, 'resetMonny'])->name('resetMonny');
Route::middleware(admin::class)->prefix('/dashbord')->group(function () {
    Route::get('/', [viewConreoller::class, 'dashbord']);



    // ==========user==========
    Route::get('/userList', [viewConreoller::class, 'userList'])->name('userList')->middleware('adminL1');
    Route::get('/userSearch', [viewConreoller::class, 'userSearch'])->name('userSearch')->middleware('adminL1');
    // ==========user==========

    Route::post('/changInfo', [InfoController::class, 'changInfo'])->name('changInfo')->middleware('adminL1');
    Route::get('/infoVwie', [viewConreoller::class, 'infoVwie'])->name('infoVwie')->middleware('adminL1');


    // ==========flash==========
    Route::get('/flashList', [viewConreoller::class, 'flashList'])->name('flashList')->middleware('adminL2');
    Route::get('/flashShow/{id}', [viewConreoller::class, 'flashShow'])->name('flashShow')->middleware('adminL2');
    Route::get('/flashSearch', [viewConreoller::class, 'flashSearch'])->name('flashSearch')->middleware('adminL2');
    Route::post('/updatPiceALL', [DeviceController::class, 'updatPiceALL'])->name('updatPiceALL')->middleware('adminL2');
    Route::get('/loadFlash', [DeviceController::class, 'loadFlash'])->name('loadFlash')->middleware('adminL2');
    Route::post('/flashLodear', [DeviceController::class, 'flashLodear'])->name('flashLodear')->middleware('adminL2');
    Route::delete('/flashDelete/{id}', [DeviceController::class, 'flashDelete'])->name('flashDelete')->middleware('adminL1');
    Route::POST('/user/flashUpdate/{id}', [DeviceController::class, 'flashUpdate'])->name('flashUpdate')->middleware('adminL2');
    Route::get('/user/flashUpdateManualV/{id}', [DeviceController::class, 'flashUpdateManualV'])->name('flashUpdateManualV')->middleware('adminL2');
    Route::POST('/user/flashUpdateManual/{id}', [DeviceController::class, 'flashUpdateManual'])->name('flashUpdateManual')->middleware('adminL2');
    // ==========flash==========




    // ==========fileUpdate==========
    Route::get('/fileUpdateList', [viewConreoller::class, 'fileUpdateList'])->name('fileUpdateList')->middleware('adminL2');
    Route::get('/fileUpdateShow/{id}', [viewConreoller::class, 'fileUpdateShow'])->name('fileUpdateShow')->middleware('adminL2');
    Route::get('/fileUpdateSearch', [viewConreoller::class, 'fileUpdateSearch'])->name('fileUpdateSearch')->middleware('adminL2');
    Route::get('/loadFileUpdate', [UpdateFileController::class, 'loadFileUpdate'])->name('loadFileUpdate')->middleware('adminL2');
    Route::post('/fileUpdatehLodear', [UpdateFileController::class, 'fileUpdatehLodear'])->name('fileUpdatehLodear')->middleware('adminL2');
    Route::delete('/fileUpdateDelete/{id}', [UpdateFileController::class, 'fileUpdateDelete'])->name('fileUpdateDelete')->middleware('adminL1');
    Route::POST('/user/fileUpdateUpdate/{id}', [UpdateFileController::class, 'fileUpdateUpdate'])->name('fileUpdateUpdate')->middleware('adminL2');
    Route::get('/user/fileUpdateUpdateManualV/{id}', [UpdateFileController::class, 'fileUpdateUpdateManualV'])->name('fileUpdateUpdateManualV')->middleware('adminL2');
    Route::POST('/user/fileUpdateUpdateManual/{id}', [UpdateFileController::class, 'fileUpdateUpdateManual'])->name('fileUpdateUpdateManual')->middleware('adminL2');
    // ==========fileUpdate==========




    // =================by for you=================
    Route::get('/byForYouList', [viewConreoller::class, 'byForYouList'])->name('byForYouList')->middleware('adminL2');
    Route::get('/byForYouInsertViwe', [viewConreoller::class, 'byForYouInsertViwe'])->name('byForYouInsertViwe')->middleware('adminL2');
    Route::post('/byForYouInsert', [ByForYouController::class, 'byForYouInsert'])->name('byForYouInsert')->middleware('adminL2');
    Route::get('/byForYouImage', [viewConreoller::class, 'byForYouImage'])->name('byForYouImage')->middleware('adminL2');
    Route::post('/byForYouImageInsert', [ByForYouController::class, 'byForYouImageInsert'])->name('byForYouImageInsert')->middleware('adminL2');
    Route::delete('/byForYouDelete/{id}', [ByForYouController::class, 'byForYouDelete'])->name('byForYouDelete')->middleware('adminL1');
    Route::get('/byForYouUpdateV/{id}', [ByForYouController::class, 'byForYouUpdateV'])->name('byForYouUpdateV')->middleware('adminL2');
    Route::post('/byForYouUpdate/{id}', [ByForYouController::class, 'byForYouUpdate'])->name('byForYouUpdate')->middleware('adminL2');
    // =================by for you=================

    // =================by for you update=================
    Route::get('/byForYouUpdateFileList', [viewConreoller::class, 'byForYouUpdateFileList'])->name('byForYouUpdateFileList')->middleware('adminL2');
    Route::get('/byForYouUpdateFileInsertViwe', [viewConreoller::class, 'byForYouUpdateFileInsertViwe'])->name('byForYouUpdateFileInsertViwe')->middleware('adminL2');
    Route::post('/byForYouUpdateFileInsert', [ByForYouUpdateController::class, 'byForYouUpdateFileInsert'])->name('byForYouUpdateFileInsert')->middleware('adminL2');
    Route::get('/byForYouUpdateFileImage', [viewConreoller::class, 'byForYouUpdateFileImage'])->name('byForYouUpdateFileImage')->middleware('adminL2');
    Route::post('/byForYouUpdateFileImageInsert', [ByForYouUpdateController::class, 'byForYouUpdateFileImageInsert'])->name('byForYouUpdateFileImageInsert')->middleware('adminL2');
    Route::delete('/byForYouUpdateFileDelete/{id}', [ByForYouUpdateController::class, 'byForYouUpdateFileDelete'])->name('byForYouUpdateFileDelete')->middleware('adminL1');
    Route::get('/byForYouUpdateFileUpdateV/{id}', [ByForYouUpdateController::class, 'byForYouUpdateFileUpdateV'])->name('byForYouUpdateFileUpdateV')->middleware('adminL2');
    Route::post('/byForYouUpdateFileUpdate/{id}', [ByForYouUpdateController::class, 'byForYouUpdateFileUpdate'])->name('byForYouUpdateFileUpdate')->middleware('adminL2');
    // =================by for you update=================





    //===============reset cam================
    Route::post('/resetPassCamLoder', [RsetCamController::class, 'resetPassCamLoder'])->name('resetPassCamLoder')->middleware('adminL2');
    Route::get('/resetCamlist', [RsetCamController::class, 'resetCamlist'])->name('resetCamlist')->middleware('adminL2');
    Route::delete('/resetCamDelete/{id}', [RsetCamController::class, 'resetCamDelete'])->name('resetCamDelete')->middleware('adminL1');
    Route::get('/resetCamUpdatAddV', [RsetCamController::class, 'resetCamUpdatAddV'])->name('resetCamUpdatAddV')->middleware('adminL2');
    Route::get('/resetCamUpdatView/{id}', [RsetCamController::class, 'resetCamUpdatView'])->name('resetCamUpdatView')->middleware('adminL2');
    Route::post('/resetCamUpdateM/{id}', [RsetCamController::class, 'resetCamUpdateM'])->name('resetCamUpdateM')->middleware('adminL2');
    Route::post('/resetCamUpdate/{id}', [RsetCamController::class, 'resetCamUpdate'])->name('resetCamUpdate')->middleware('adminL2');
    //===============reset cam================



    //===============packege================
    Route::post('/packegeLoder', [PackegeController::class, 'packegeLoder'])->name('packegeLoder')->middleware('adminL2');
    Route::get('/packegelist', [PackegeController::class, 'packegelist'])->name('packegelist')->middleware('adminL2');
    Route::delete('/packegeDelete/{id}', [PackegeController::class, 'packegeDelete'])->name('packegeDelete')->middleware('adminL1');
    Route::get('/packegeUpdatAddV', [PackegeController::class, 'packegeUpdatAddV'])->name('packegeUpdatAddV')->middleware('adminL2');
    Route::get('/packegeUpdatView/{id}', [PackegeController::class, 'packegeUpdatView'])->name('packegeUpdatView')->middleware('adminL2');
    Route::post('/packegeUpdateM/{id}', [PackegeController::class, 'packegeUpdateM'])->name('packegeUpdateM')->middleware('adminL2');
    Route::post('/packegeUpdate/{id}', [PackegeController::class, 'packegeUpdate'])->name('packegeUpdate')->middleware('adminL2');
    //===============packege================



    //===============cooperate================
    Route::post('/cooperateLoder', [CooperateController::class, 'cooperateLoder'])->name('cooperateLoder')->middleware('adminL2');
    Route::get('/cooperatelist', [CooperateController::class, 'cooperatelist'])->name('cooperatelist')->middleware('adminL2');
    Route::delete('/cooperateDelete/{id}', [CooperateController::class, 'cooperateDelete'])->name('cooperateDelete')->middleware('adminL1');
    Route::get('/cooperateUpdatAddV', [CooperateController::class, 'cooperateUpdatAddV'])->name('cooperateUpdatAddV')->middleware('adminL2');
    Route::get('/cooperateUpdatView/{id}', [CooperateController::class, 'cooperateUpdatView'])->name('cooperateUpdatView')->middleware('adminL2');
    Route::post('/cooperateUpdateM/{id}', [CooperateController::class, 'cooperateUpdateM'])->name('cooperateUpdateM')->middleware('adminL2');
    Route::post('/cooperateUpdate/{id}', [CooperateController::class, 'cooperateUpdate'])->name('cooperateUpdate')->middleware('adminL2');
    //===============cooperate================


    //===============katalog================
    Route::post('/katalogLoder', [KatalogController::class, 'katalogLoder'])->name('katalogLoder')->middleware('adminL2');
    Route::get('/kataloglist', [KatalogController::class, 'kataloglist'])->name('kataloglist')->middleware('adminL2');
    Route::delete('/katalogDelete/{id}', [KatalogController::class, 'katalogDelete'])->name('katalogDelete')->middleware('adminL1');
    Route::get('/katalogUpdatAddV', [KatalogController::class, 'katalogUpdatAddV'])->name('katalogUpdatAddV')->middleware('adminL2');
    Route::get('/katalogUpdatView/{id}', [KatalogController::class, 'katalogUpdatView'])->name('katalogUpdatView')->middleware('adminL2');
    Route::post('/katalogUpdateM/{id}', [KatalogController::class, 'katalogUpdateM'])->name('katalogUpdateM')->middleware('adminL2');
    Route::post('/katalogUpdate/{id}', [KatalogController::class, 'katalogUpdate'])->name('katalogUpdate')->middleware('adminL2');
    //===============katalog================


    //===============reset Device================
    Route::post('/resetPassDvrNvrLoder', [RsetDeviceController::class, 'resetPassDvrNvrLoder'])->name('resetPassDvrNvrLoder')->middleware('adminL2');
    Route::get('/resetDevicelist', [RsetDeviceController::class, 'resetDevicelist'])->name('resetDevicelist')->middleware('adminL2');
    Route::delete('/resetDeviceDelete/{id}', [RsetDeviceController::class, 'resetDeviceDelete'])->name('resetDeviceDelete')->middleware('adminL1');
    Route::get('/resetDeviceUpdatView/{id}', [RsetDeviceController::class, 'resetDeviceUpdatView'])->name('resetDeviceUpdatView')->middleware('adminL2');
    Route::get('/resetDevicelistAddV', [RsetDeviceController::class, 'resetDevicelistAddV'])->name('resetDevicelistAddV')->middleware('adminL2');
    Route::get('/resetDevicelistAdd', [RsetDeviceController::class, 'resetDevicelistAdd'])->name('resetDevicelistAdd')->middleware('adminL2');
    Route::post('/resetDeviceUpdateM/{id}', [RsetDeviceController::class, 'resetDeviceUpdateM'])->name('resetDeviceUpdateM')->middleware('adminL2');
    Route::post('/resetDeviceUpdate/{id}', [RsetDeviceController::class, 'resetDeviceUpdate'])->name('resetDeviceUpdate')->middleware('adminL2');
    //===============reset Device================




    //===================== comment =============
    Route::get('/commentList', [CommentController::class, 'commentList'])->name('commentList')->middleware('adminL1');
    Route::get('/commentUpdateShow/{id}', [CommentController::class, 'commentUpdateShow'])->name('commentUpdateShow')->middleware('adminL1');
    Route::post('/commentUpdate/{id}', [CommentController::class, 'commentUpdate'])->name('commentUpdate')->middleware('adminL1');
    Route::delete('/commentDelete/{id}', [CommentController::class, 'commentDelete'])->name('commentDelete')->middleware('adminL1');
    //===================== comment =============



    // ====================== chat ====================
    Route::get('/chatlist', [ChateController::class, 'chatlist'])->name('chatlist');
    Route::get('/chatlistSearch', [ChateController::class, 'chatlistSearch'])->name('chatlistSearch');
    Route::post('/sendSmsNow/{id}', [ChateController::class, 'sendSmsNow'])->name('sendSmsNow');
    Route::get('/chatAdmin/{chate_id}', [ChateController::class, 'chatAdmin'])->name('chatAdmin');
    Route::post('/reciveDataAdmin', [ChateController::class, 'reciveDataAdmin'])->name('reciveDataAdmin');
    Route::post('/sendAdminAudio', [ChateController::class, 'sendAdminAudio'])->name('sendAdminAudio');
    Route::get('/readyMessegeV', [ChateController::class, 'readyMessegeV'])->name('readyMessegeV');
    Route::post('/addReadyMessege', [ChateController::class, 'addReadyMessege'])->name('addReadyMessege');
    Route::delete('/readyMessegeDelete/{id}', [ChateController::class, 'readyMessegeDelete'])->name('readyMessegeDelete');
    Route::post('/deletMessAdmin', [ChateController::class, 'deletMessAdmin'])->name('deletMessAdmin');
    // ====================== chat ====================



    // ====================== admin ====================
    Route::get('/adminList', [AdminController::class, 'adminList'])->name('adminList')->middleware('adminL1');
    Route::get('/adminUpdateV{id}', [AdminController::class, 'adminUpdateV'])->name('adminUpdateV')->middleware('adminL1');
    Route::post('/adminUpdate/{id}', [AdminController::class, 'adminUpdate'])->name('adminUpdate')->middleware('adminL1');
    Route::get('/adminAddV', [AdminController::class, 'adminAddV'])->name('adminAddV')->middleware('adminL1');
    Route::post('/adminAdd', [AdminController::class, 'adminAdd'])->name('adminAdd')->middleware('adminL1');
    Route::post('/adminDelete', [AdminController::class, 'adminDelete'])->name('adminDelete')->middleware('adminL1');
    // ====================== admin ====================

    // ====================== time ====================
    Route::post('/setTime', [OnlinController::class, 'setTime'])->name('setTime');
    Route::post('/setOfline', [OnlinController::class, 'setOfline'])->name('setOfline');
    Route::post('/setOnline', [OnlinController::class, 'setOnline'])->name('setOnline');
    // ====================== time ====================
});

//==============admin=============
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////
///////////////////////////  dashbord  /////////////////////////////////