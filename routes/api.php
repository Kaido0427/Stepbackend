<?php

use App\Http\Controllers\Api\currencyConvertController;
use App\Http\Controllers\Api\GuardApiController;
use App\Http\Controllers\Api\OwnerApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Owner\OwnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user/data', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'owner'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::resource('space', 'ParkingSpaceController');
        Route::resource('guard', 'ParkingGuardController');
        Route::post('convert', [currencyConvertController::class, 'owner_Convert']);
        Route::get('profile', function (Request $request) {
            return $request->user();
        });


        Route::post('images', [OwnerApiController::class, 'storeParkingImage']);
        Route::get('images/{id}/space', [OwnerApiController::class, 'parkingImages']);
        Route::delete('images/{id}', [OwnerApiController::class, 'destroyParkingImage']);
        Route::post('profile/update', [OwnerApiController::class, 'profileUpdate']);
        Route::post('profile/update/password', [OwnerApiController::class, 'passwordUpdate']);
        Route::post('profile/setting', [OwnerApiController::class, 'settingUpdate']);
        Route::get('available/guard', [OwnerApiController::class, 'availableGuard']);
        Route::get('review', [OwnerApiController::class, 'allReview']);
        Route::get('transaction/{id}/{type}', [OwnerApiController::class, 'transactionAllInOne']);
        Route::post('transaction/{id}/custom', [OwnerApiController::class, 'transactionCustom']);
        Route::get('space/{id}/live', [OwnerApiController::class, 'liveSlotLocation']);
        Route::get('booking/scanner/{order}', [OwnerApiController::class, 'ownerShowScanner']);
        Route::post('profile/picture/update', [OwnerApiController::class, 'profilePictureUpdate']);
        Route::post('guard-space', [OwnerApiController::class, 'guardSpace']);
        Route::get('/owner-setting', [OwnerApiController::class, 'ownerSetting']);
        Route::get('space/{id}', [OwnerApiController::class, 'showParkingSpace']);
        Route::post('conversion_rate', [currencyConvertController::class, 'getConversionRate']);
        Route::post('reqForOTP', [OwnerApiController::class, 'reqForOTP']);

        // Subscription
        Route::get('subscription', [OwnerApiController::class, 'getSubscription']);
        Route::get('subscription_history', [OwnerApiController::class, 'subscriptionHistory']);
        Route::post('purchase_subscription', [OwnerApiController::class, 'purchaseSubscription']);
        // API route pour la conversion de devise
       
    });

    Route::get('setting', [OwnerApiController::class, 'allSetting']);
    Route::post('store', [OwnerApiController::class, 'storeParkingOwner']);
    Route::post('login', [OwnerApiController::class, 'login']);
    Route::post('forgot', [OwnerApiController::class, 'forgotPassword']);
    Route::get('facilities', [OwnerApiController::class, 'displayFacilities']);
    Route::post('change-status', [OwnerApiController::class, 'changeStatus']);

    // unused
    // Route::put('zone/{id}/update',[OwnerApiController::class,'updateSpaceZone']);
    // Route::post('zone',[OwnerApiController::class,'storeSpaceZone']);
    // Route::delete('zone/{id}', [OwnerApiController::class,'deleteSpaceZone']);
    // Route::get('booking/{id}', [OwnerApiController::class,'ownerShow']);
    // Route::get('review/{id}',[OwnerApiController::class,'spaceReview']);
    // Route::get('zone/{id}/space', [OwnerApiController::class,'zoneForSpace']);
    // Route::get('subscription/{id}/buy',[OwnerApiController::class,'purchaseSubscription']);
    // Route::put('slot/{id}/update',[OwnerApiController::class,'updateSpaceSlot']);
    // Route::delete('slot/{id}', [OwnerApiController::class,'deleteSpaceSlot']);
    // Route::put('booking/{id}/update', [OwnerApiController::class,'updateParkingBooking']);
    // Route::get('vehicleType', [OwnerApiController::class,'displayVehicleType']);
});
/*
Route::group(['prefix' => 'guard'], function () {
    Route::post('login', [GuardApiController::class, 'login']);
    Route::post('forgot', [GuardApiController::class, 'guardForgotPassword']);
    Route::group(['middleware' => ['auth:guardApi']], function () {
        Route::get('space/{id}', [GuardApiController::class, 'showParkingSpace']);
        Route::get('profile', function (Request $request) {
            return $request->user();
        });
        Route::post('profile/update', [GuardApiController::class, 'profileUpdate']);
        Route::post('profile/update/password', [GuardApiController::class, 'passwordUpdate']);

        Route::get('review/{id}', [GuardApiController::class, 'spaceReview']);
        Route::get('transaction/{id}/{type}', [GuardApiController::class, 'transactionAllInOne']);
        Route::post('transaction/{id}/custom', [GuardApiController::class, 'transactionCustom']);
        Route::get('booking/{id}', [GuardApiController::class, 'ownerShow']);
        Route::get('booking/scanner/{order}', [GuardApiController::class, 'ownerShowScanner']);
        Route::put('booking/{id}/update', [GuardApiController::class, 'updateParkingBooking']);
        Route::get('space/{id}/live', [GuardApiController::class, 'liveSlotLocation']);
        Route::post('images', [GuardApiController::class, 'storeParkingImage']);
        Route::get('images/{id}/space', [GuardApiController::class, 'displayParkingImages']);
        Route::delete('images/{id}', [GuardApiController::class, 'destroyParkingImage']);
        Route::post('profile/picture/update', [GuardApiController::class, 'profilePictureUpdate']);
        Route::post('change-status', [GuardApiController::class, 'changeStatus']);
    });
    Route::get('setting', [GuardApiController::class, 'allSetting']);
});*/

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => ['auth:userApi']], function () {
        Route::resource('vehicle', 'UserVehicleController');
        Route::post('booking', [UserApiController::class, 'storeParkingBookin']);
        Route::get('booking/cancel/{id}', [UserApiController::class, 'bookingCancel']);
        Route::post('review', [UserApiController::class, 'storeReview']);
        Route::get('booking/{id}', [UserApiController::class, 'showParkingBooking']);
        Route::get('booking', [UserApiController::class, 'displayParkingBooking']);
        Route::get('profile', function (Request $request) {
            return $request->user();
        });
        Route::post('profile/update', [UserApiController::class, 'profileUpdate']);
        Route::post('profile/picture/update', [UserApiController::class, 'profilePictureUpdate']);

        Route::get('successTrans', [UserApiController::class, 'successTransaction'])->name('successTransaction');
        Route::get('cancelTrans', [UserApiController::class, 'cancelTransaction'])->name('cancelTransaction');
        Route::post('convert', [currencyConvertController::class, 'user_Convert']);
        Route::get('confirmStripay', [UserApiController::class, 'confirmStripay'])->name('StripeTransaction');

    });
    Route::get('setting', [UserApiController::class, 'allSetting']);
    Route::post('forgot', [UserApiController::class, 'forgotPassword']);
    Route::post('store', [UserApiController::class, 'storeUser']);
    Route::post('reqForOTP', [UserApiController::class, 'reqForOTP']);
    Route::post('verifyMe', [UserApiController::class, 'verifyMe']);
    Route::post('conversion_rate', [currencyConvertController::class, 'getConversionRate']);


    Route::get('pp', [UserApiController::class, 'ppApi']);
    Route::post('space', [UserApiController::class, 'getNearByParking']);
    Route::post('space/{id}', [UserApiController::class, 'getNearByParkingSingle']);
    Route::post('space/{id}/zone', [UserApiController::class, 'getParkingZone']);
    Route::post('login', [UserApiController::class, 'login']);
    // API route pour la conversion de devise
   

Route::get('/mail',[UserApiController::class,'mailer']);
    //  // unuse
    // Route::get('facilities', [UserApiController::class,'displayFacilities']);
    // Route::get('vehicleType', [UserApiController::class,'displayVehicleType']);
});
