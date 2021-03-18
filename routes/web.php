<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClickAndCollectController;
use App\Http\Controllers\DatesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeMsgController;
use App\Http\Controllers\InfoServiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayGreenController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\RestoPAY;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\OpenTimeController;
//use App\Http\Controllers\TRestoController;
use App\Http\Controllers\TotalDeliveryController;
use App\Http\Controllers\UsersController;
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

Route::group(['middleware'=>'web'], function (){
    Route::get('/ordersNotComfirmed', [PayGreenController::class, 'updateStatus']);
    Route::get('/loginRole', [HomeController::class, 'redirectRouteRole']);
    //Route::get('/payAjaxRequest', [PayGreenController::class, 'payAjaxRequest']);
    Route::get('/myCartOnJson', [MenuController::class, 'orderJson']);
    Route::get('/apiClosingDates', [DatesController::class, 'apiDates']);
//guest routes
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'menuShow']);
    Route::post('/saveNewUserAddress', [UsersController::class, 'userAdress']);

//cart routes

    Route::post('/add-to-cart/{id}', [MenuController::class, 'storeOnDB']);
    Route::get('/add-to-cart/{id}', [MenuController::class, 'storeOnDB']);
    Route::get('/remove-from-cart/{id}', [MenuController::class, 'removeFromDB']);
    Route::get('/delete-from-cart/{id}', [MenuController::class, 'deleteFromDB']);
    Route::get('/incrase-from-cart/{id}', [MenuController::class, 'incraseFromDB']);

});

Route::group(['middleware'=>'role:user'], function (){

    Route::get('/pay-return', [PayGreenController::class, 'payGreenVerify']);
    Route::post('/saveOrderOnsession', [OrderController::class, 'orderSession']);
    Route::get('/payOrder', [PayGreenController::class, 'payOrderCash']);

    Route::get('/user-update', [UsersController::class, 'updateUser']);
    Route::post('/user-update', [UsersController::class, 'updateUser']);
    Route::get('/payOrder/{payType}', [PayGreenController::class, 'payGreenGenerate']);


});


Route::group(['middleware'=>'role:superadministrator|administrator'], function (){

    Route::get('/admin', [AdminHomeController::class, 'homeOrder'])->name('homeAdmin');
    Route::get('/admin/commades-du-jour', [OrderController::class, 'dayOrder'])->name('dayOrder');
    Route::get('/admin/futures-commades', [OrderController::class, 'futureOrder'])->name('futureOrder');
    Route::get('/admin/historique-commades', [OrderController::class, 'oldOrder'])->name('oldOrder');
    Route::get('/admin/clients', [UsersController::class, 'show'])->name('customers');
    Route::get('/admin/info', [InfoServiceController::class, 'show'])->name('info');

    Route::get('/admin/client/{id}', [UsersController::class, 'userShow'])->name('client');
    Route::post('/admin/client/{id}', [UsersController::class, 'updateCust'])->name('updateCustomer');

    Route::get('/admin/ajax-commande-du-jour', [OrderController::class, 'dayOrderAjax']);

    Route::get('/print/{id}', [PrintController::class, 'printTicket']);
    Route::post('/print/{id}', [PrintController::class, 'updateStatus']);

    Route::post('/update-pay-method/{id}', [OrderController::class, 'updatepayMethod']);

    Route::get('/delete-TR-info/{id}', [RestoPAY::class, 'TRdelete']);
    Route::post('/update-TR-info/{id}', [RestoPAY::class, 'TRupdate']);
    Route::get('/update-TR-info/{id}', [RestoPAY::class, 'TRupdate']);
    Route::get('/delete-CB-info/{id}', [RestoPAY::class, 'CBdelete']);
    Route::post('/update-CB-info/{id}', [RestoPAY::class, 'CBupdate']);
    Route::get('/update-CB-info/{id}', [RestoPAY::class, 'CBupdate']);

    Route::get('/admin/update-recettes-livreur', [TotalDeliveryController::class, 'updateList'])->name('deliRevenu');
    Route::get('/admin/recettes-livreur', [TotalDeliveryController::class, 'show']);
    Route::post('/update-TR-deli/{id}', [TotalDeliveryController::class, 'updateTR']);
    Route::get('/delete-TR-deli/{id}', [TotalDeliveryController::class, 'deleteTR']);


});


Route::group(['middleware'=>'role:superadministrator'], function (){

    Route::post('/admin/jour-fermeture', [DatesController::class, 'store']);
    Route::get('/admin/jour-fermeture/{id}', [DatesController::class, 'delete']);
    Route::get('/admin/jour-fermeture', [DatesController::class, 'show'])
        ->name('dayClose');

    Route::get('/admin/newsletter', function () {
        return view('admin.newsletter');
    })->name('newsletter');
    Route::get('/admin/ajouter-admin', function () {
        return view('admin.newAdmin');
    })->name('newAdmin');
    Route::post('/admin/ajouter-admin', [AdminController::class, 'store']);

    Route::post('/newsletter', [NewsletterController::class, 'sendNews']);

    Route::post('/admin/modifier-admin/{id}', [AdminController::class, 'update']);
    Route::get('/admin/modifier-admin/{id}', [AdminController::class, 'updateAdmin']);

    Route::get('/admin/sup-admin/{id}', [AdminController::class, 'delete']);

    Route::get('/admin/liste-admin', [AdminController::class, 'show'])->name('listAdmin');

    Route::get('/admin/recettes', [RevenueController::class, 'show'])->name('revenue');
    Route::get('/admin/service-liste', [InfoServiceController::class, 'showList'])->name('listeInfo');

    Route::get('/admin/ajouter-info', function () {
        return view('admin.info.newInfo');
    });
    Route::post('/admin/ajouter-info', [InfoServiceController::class, 'store']);
    Route::get('/admin/delete-info/{id}', [InfoServiceController::class, 'delete']);
    Route::get('/admin/modifier-info/{id}', [InfoServiceController::class, 'updateInfo']);
    Route::post('/admin/update-info/{id}', [InfoServiceController::class, 'update']);
    //settings
    Route::get('/admin/home-message', [HomeMsgController::class, 'homeMsg'])->name('homeMsg');
    Route::post('/admin/home-info/{id}', [HomeMsgController::class, 'update']);
    Route::post('/admin/home-info-activation/{id}', [HomeMsgController::class, 'updateStatus']);
    Route::get('/admin/horaires', [OpenTimeController::class, 'show'])->name('schedules');
    Route::post('/admin/schedules/{id}', [OpenTimeController::class, 'save']);
    Route::get('/admin/retrait-livraisons', [ClickAndCollectController::class, 'show'])->name('clickAndCollect');
    Route::post('/admim/click&collect-time', [ClickAndCollectController::class, 'saveTime']);
    Route::get('/admim/click&collect-time-delete/{id}', [ClickAndCollectController::class, 'delete']);

    Route::get('/admin/delete/{id}', [OrderController::class, 'deleteOrder']);
    Route::get('/admin/prod-stock', [MenuController::class, 'offStock'])->name('offStock');
    Route::post('/admin/prod-stock/{id}', [MenuController::class, 'offStockUpdate']);

});



// file manager //
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
});

Auth::routes();
