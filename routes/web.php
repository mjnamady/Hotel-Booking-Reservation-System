<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\backend\TeamController;
use App\Http\Controllers\backend\RoomListController;
use App\Http\Controllers\backend\RoomTypeController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\frontend\BookingController;
use App\Http\Controllers\frontend\AllRoomsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    
});

require __DIR__.'/auth.php';

////////// MY ROUTES ////////////////////
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    
});
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware(['auth', 'role:admin'])->group(function () {

    // TEAM AREA ALL ROUTES 
Route::controller(TeamController::class)->group(function(){

    Route::get('all/team', 'AllTeam')->name('all.team');
    Route::get('add/team', 'AddTeam')->name('add.team');
    Route::post('store/team', 'StoreTeam')->name('store.team');
    Route::get('edit/team/{id}', 'EditTeam')->name('edit.team');
    Route::post('update/team', 'UpdateTeam')->name('update.team');
    Route::get('delete/team/{id}', 'DeleteTeam')->name('delete.team');

});

//// Book Area All Routes
Route::controller(TeamController::class)->group(function(){

    Route::get('book/area', 'BookArea')->name('book.area');
    Route::post('book/area/update', 'BookAreaUpdate')->name('book.area.update');
});

//// RoomType All Routes
Route::controller(RoomTypeController::class)->group(function(){

    Route::get('room/type/list', 'RoomTypeList')->name('room.type.list');
    Route::get('add/room/type', 'AddRoomType')->name('add.room.type');
    Route::post('store/room/type', 'StoreRoomType')->name('store.room.type');
   
});

//// Room All Routes
Route::controller(RoomController::class)->group(function(){

    Route::get('edit/room/{id}', 'EditRoom')->name('edit.room');
    Route::post('update/room/{id}', 'UpdateRoom')->name('update.room');
    Route::get('multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');

    Route::post('store/room/number/{id}', 'StoreRoomNumber')->name('store.room.number');
    Route::get('edit/room/number/{id}', 'EditRoomNumber')->name('edit.room.no'); 
    Route::post('room/no/update/{id}', 'RoomNumberUpdate')->name('room.no.update');
    Route::get('delete/room/no/{id}', 'DeleteRoomNumber')->name('delete.room.no');

    Route::get('delete/room/{id}', 'DeleteRoom')->name('delete.room');


});


//// SMTP Setting All Routes
Route::controller(SettingController::class)->group(function(){

    Route::get('smtp/setting', 'SmtpSetting')->name('smtp.setting');
    Route::post('update/smtp', 'UpdateSmtp')->name('update.smtp');
   
   
});



});

Route::controller(AllRoomsController::class)->group(function(){

    Route::get('/all/rooms/page', 'AllRoomsPage')->name('all.rooms.page');
    Route::get('/room/detail/{id}', 'RoomDetailV');
    Route::get('/booking', 'BookingSearch')->name('booking.search');
    Route::get('/search/room/details/{id}', 'SearchRoomDetails')->name('search_room_details');

    Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');
   


});

// Auth Middleware User must have login for access this route 
Route::middleware(['auth'])->group(function(){

    /// CHECKOUT ALL Routes
    Route::controller(BookingController::class)->group(function(){

    Route::get('/checkout', 'Checkout')->name('checkout');
    Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');

    Route::post('/checkout/store/', 'CheckoutStore')->name('checkout.store');
    Route::match(['get', 'post'],'/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');

    // Booking All Routes
    Route::get('/booking/list/', 'BookingList')->name('booking.list');
    Route::get('/edit/booking/{id}', 'EditBooking')->name('edit.booking');
    Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');

    // Update Booking
    Route::post('/update/booking/status/{id}', 'UpdateBookingStatus')->name('update.booking.status');
    Route::post('/update/booking/{id}', 'UpdateBooking')->name('update.booking');

    // Assign Room route
    Route::get('/assign_room/{id}', 'AssignRoom')->name('assign_room');
    Route::get('/assign_room/store/{booking_id}/{room_number_id}', 'AssignRoomStore')->name('assign_room_store');
    Route::get('/assign_room_delete/{id}', 'AssignRoomDelete')->name('assign_room_delete');

    Route::get('/user/bookings', 'UserBooking')->name('user.bookings');
    Route::get('/user/invoice/{id}', 'UserVoice')->name('user.invoice');



    
    });


    Route::controller(RoomListController::class)->group(function(){

        Route::get('/view/room/list', 'ViewRoomList')->name('view.room.list');
        Route::get('/add/room/list', 'AddRoomList')->name('add.room.list');
        Route::post('/store/roomlist', 'StoreRoomList')->name('store.roomlist');
       
        });

}); // End Admin Group Middleware 