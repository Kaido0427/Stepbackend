<?php

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

use App\AdminSetting;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AppUsersController;
use App\Http\Controllers\currencyController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\OwnerSpaceZoneController;
use App\Http\Controllers\Owner\ParkingImageController;
use App\Http\Controllers\Owner\SecurityController;
use App\Http\Controllers\Owner\SpaceController;
use App\Http\Controllers\ParkingOwnerController;
use App\Http\Controllers\ParkingSpaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\NotificationTemplateController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VehicleTypesController;
use App\Http\Controllers\Website\UserVehiclesController;
use App\Http\Controllers\Website\WebsiteController;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "Cache is cleared";
});
Route::get('/display', function () {
    \Log::debug(date("d-m-Y (D) H:i:s"));
});

Auth::routes();
Route::middleware(['XssSanitizer'])->group(function () {
    Route::get('/', function () {
        if (env('DB_DATABASE'))
            return view('auth.login');
        return redirect('installer');
    });

    Route::any('installer', [AdminSettingController::class, 'license']);

    Route::post('saveEnvData', [AdminSettingController::class, 'saveEnvData']);
    Route::post('saveAdminData', [AdminSettingController::class, 'saveAdminData']);

    Route::post('saveAdminData', [AdminSettingController::class, 'setup']);

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('user', 'UserController', ['except' => ['show']]);
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');
        Route::resource('vehicleType', 'VehicleTypeController');
        Route::resource('subscription', 'SubscriptionController');
        Route::resource('vehicle_type', VehicleTypesController::class);

        Route::get('subscription_history', [SubscriptionController::class, 'subscriptionHistory']);
        Route::resource('facilities', 'FacilitiesController');
        Route::resource('faq', 'FAQController');
        Route::get('parkingOwner', [ParkingOwnerController::class, 'adminIndex']);
        Route::get('parkingOwner/{id}/space', [ParkingOwnerController::class, 'ownerSpaceDetail']);
        Route::get('space/{id}/verify', [ParkingSpaceController::class, 'adminChangeVerify']);
        Route::get('space/{id}/view', [ParkingSpaceController::class, 'adminSpaceView']);
        Route::get('parkingUser', [AppUsersController::class, 'adminIndex']);
        Route::get('pp', [AdminSettingController::class, 'pp']);
        Route::get('tc', [AdminSettingController::class, 'tc']);
        Route::put('tc/update', [AdminSettingController::class, 'updateTc'])->name('tc.update');
        Route::get('website_content', [AdminSettingController::class, 'websiteContent']);
        Route::put('webcontent/update', [AdminSettingController::class, 'updateWebContent'])->name('webcontent.update');
        Route::get('contactus', [AdminSettingController::class, 'contactUs']);
        Route::put('contactus/update', [AdminSettingController::class, 'updateContactUs'])->name('contactus.update');
        Route::get('licenseactive', [AdminSettingController::class, 'licenseactive']);
        Route::post('update_license', [AdminSettingController::class, 'updateLicense']);
        Route::get('setting', [AdminSettingController::class, 'index']);
        Route::get('/test_mail', [AdminSettingController::class, 'testMail']);
        Route::get('/dashboard', [AdminSettingController::class, 'dashboard']);
        Route::get('/home', [AdminSettingController::class, 'dashboard'])->name('home');
        Route::resource('languages', 'LanguageController');
        Route::put('setting/email', [AdminSettingController::class, 'updateEmail'])->name('setting.email');
        Route::put('setting/payments', [AdminSettingController::class, 'updatePayments'])->name('setting.payments');
        Route::put('setting/general_setting', [AdminSettingController::class, 'updateGeneralSetting'])->name('setting.generalsetting');
        Route::put('setting/notification', [AdminSettingController::class, 'updateNotification'])->name('setting.notification');
        Route::put('setting/ownerNotification', [AdminSettingController::class, 'updateOwnerNotification'])->name('setting.ownerNotification');
        Route::put('setting/guardNotification', [AdminSettingController::class, 'updateGuardNotification'])->name('setting.guardNotification');
        Route::put('setting/twilio', [AdminSettingController::class, 'updateTwilio'])->name('setting.twilio');
        Route::get('notification_template', [NotificationTemplateController::class, 'index']);
        Route::get('edit_notification/{id}', [NotificationTemplateController::class, 'edit_notification']);
        Route::post('update_template/{id}', [NotificationTemplateController::class, 'update_template']);
        Route::post('/block_parkingOwner/{id}', [AdminSettingController::class, 'blockParkingOwner']);
        Route::get('allBookingTransactions/{type}', [AdminSettingController::class, 'transactionforAllSpace']);
        Route::get('/transaction', [AdminSettingController::class, 'transaction']);
        Route::post('/transaction/custom', [AdminSettingController::class, 'transactionCustom']);
        Route::post('/transactionAll', [AdminSettingController::class, 'transactionAll']);
        Route::POST('/convert', [AdminSettingController::class, 'convertAll'])->name('convert');
    });
    Route::get('selectlanguage/{id}', [LanguageController::class, 'SelectLanguage']);
    Route::get('sampleDownloadFile', [LanguageController::class, 'sampleDownload']);

    Route::group(['prefix' => 'owner'], function () {
        Route::group(['middleware' => 'ownerpanel'], function () {
            Route::get('/logout', [OwnerController::class, 'logout']);
            Route::get('/dashboard', [OwnerController::class, 'index']);
            Route::get('/profile', [OwnerController::class, 'profile']);
            Route::POST('/updateprofile', [OwnerController::class, 'updateProfile']);
            Route::POST('/changepassword', [OwnerController::class, 'changePassword']);
            Route::get('/setting', [OwnerController::class, 'setting']);
            Route::POST('/setting/payments', [OwnerController::class, 'settingPayments']);
            Route::get('/review', [SpaceController::class, 'review']);
            Route::get('/bookuser', [OwnerController::class, 'bookuser']);
            Route::POST('/bookingstatus/{id}', [OwnerController::class, 'bookingStatus']);
            Route::POST('/bookingPaymentStatus/{id}', [OwnerController::class, 'bookingPaymentStatus']);
            Route::get('/subscription', [OwnerController::class, 'subscription']);
            Route::get('/subscription_history', [OwnerController::class, 'subscriptionHistory']);
            Route::get('/transection', [OwnerController::class, 'transection']);
            Route::post('/transection/custom', [OwnerController::class, 'transectionCustom']);
            Route::post('/transectionall', [OwnerController::class, 'transectionAll']);
            Route::post('/purchaseSubscription', [OwnerController::class, 'purchase_subscription']);
            Route::resources([
                'security' => SecurityController::class,
                'spaces' => SpaceController::class,
                'space_zone' => OwnerSpaceZoneController::class,
                'parkingimages' => ParkingImageController::class
            ]);
        });
        Route::get('/login', [OwnerController::class, 'loginView']);
        Route::get('/register', [OwnerController::class, 'registerView']);
        Route::post('/login_confirm', [OwnerController::class, 'login']);
        Route::post('/register_confirm', [OwnerController::class, 'register']);
    });
});

// ------------- Website Routes Starts from Here --------------
// -------  TODO: Paste Website Routes Data Here between start & end
Route::get('/', [WebsiteController::class, 'dashboard']);
Route::post('/user_login', [WebsiteController::class, 'userLogin']);
Route::post('/user_verify', [WebsiteController::class, 'userVerify']);
Route::post('/user_register', [WebsiteController::class, 'userRegister']);
Route::post('/resend_mail', [WebsiteController::class, 'resendMail']);
Route::post('/forgotpassword', [WebsiteController::class, 'userForgotPassword']);
Route::get('/about_us', [WebsiteController::class, 'getAboutUs']);
Route::get('/privacy_policy', [WebsiteController::class, 'getPrivacyPolicy']);
Route::get('/terms_condition', [WebsiteController::class, 'getTermsCondition']);
Route::get('/faqs', [WebsiteController::class, 'getFaqs']);
Route::get('/contact_us', [WebsiteController::class, 'getContactUs']);
Route::post('/contactus_mail', [WebsiteController::class, 'contactusMail']);
Route::get('/parking_map_list', [WebsiteController::class, 'getParkingMapList']);
Route::get('/search_query', [WebsiteController::class, 'searchQuery']);
Route::get('/settings', [WebsiteController::class, 'getSettings']);
// If User is logged-in 
Route::middleware(['auth:appuser'])->group(function () {
    Route::get('/display_parking_booking', [WebsiteController::class, 'getParkingBooking']);
    Route::get('/user_profile', [WebsiteController::class, 'userProfile']);
    Route::post('/update_user_profile', [WebsiteController::class, 'updateUserProfile']);
    Route::post('/update_user_profileimage', [WebsiteController::class, 'updateUserProfileImage']);
    Route::post('/user_change_password', [WebsiteController::class, 'userChangePassword']);
    // User's Vehicle
    Route::get('/user_vehicle', [UserVehiclesController::class, 'getUserVehicle']);
    Route::post('/user_vehicle_store', [UserVehiclesController::class, 'userVehicleStore']);
    Route::post('/user_vehicle_update/{id}', [UserVehiclesController::class, 'userVehicleUpdate']);
    Route::post('/user_vehicle_destroy/{id}', [UserVehiclesController::class, 'userVehicleDestroy']);
    // Parking Slot
    Route::get('/parking_space/{id}', [WebsiteController::class, 'getParkingSpaceDetails']);
    Route::any('/parking_slots', [WebsiteController::class, 'getParkingSlots']);
    // Bookings
    Route::post('/parkingspace_booking', [WebsiteController::class, 'parkingSpaceBooking']);
    Route::post('/parkingslot_booking', [WebsiteController::class, 'parkingSlotBooking']);
    Route::post('/billing', [WebsiteController::class, 'billing']);
    Route::get('/checkout', [WebsiteController::class, 'getCheckout']);
    Route::get('/order_details/{id}', [WebsiteController::class, 'getOrderDetails']);
    Route::post('/booking_cancel/{id}', [WebsiteController::class, 'bookingCancel']);
    Route::post('/review', [WebsiteController::class, 'review']);
    Route::post('/edit_review', [WebsiteController::class, 'editReview']);
    Route::post('/delete_account', [WebsiteController::class, 'deleteAccount']);
});
Route::get('/logout', [WebsiteController::class, 'logOut']);
// ------------- Website Routes Ends Here --------------

Route::group(['middleware' => ['auth']], function () {
    Route::put('pp/update', [AdminSettingController::class, 'updatePP'])->name('pp.update');
});
