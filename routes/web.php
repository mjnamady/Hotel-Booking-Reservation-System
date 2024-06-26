<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\backend\TeamController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\CommentController;
use App\Http\Controllers\backend\ContactUsController;
use App\Http\Controllers\backend\GalleryController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\RoomListController;
use App\Http\Controllers\backend\RoomTypeController;
use App\Http\Controllers\frontend\BookingController;
use App\Http\Controllers\frontend\AllRoomsController;
use App\Http\Controllers\Backend\TestimonialController;

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
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


// Admin Group Middleware 
Route::middleware(['auth', 'roles:admin'])->group(function () {

    // TEAM AREA ALL ROUTES 
Route::controller(TeamController::class)->group(function(){
    Route::get('all/team', 'AllTeam')->name('all.team')->middleware('permission:team.all');
    Route::get('add/team', 'AddTeam')->name('add.team')->middleware('permission:team.add');
    Route::post('store/team', 'StoreTeam')->name('store.team');
    Route::get('edit/team/{id}', 'EditTeam')->name('edit.team')->middleware('permission:team.edit');
    Route::post('update/team', 'UpdateTeam')->name('update.team');
    Route::get('delete/team/{id}', 'DeleteTeam')->name('delete.team')->middleware('permission:team.delete');
});

//// Book Area All Routes
Route::controller(TeamController::class)->group(function(){
    Route::get('book/area', 'BookArea')->name('book.area');
    Route::post('book/area/update', 'BookAreaUpdate')->name('book.area.update')->middleware('permission:update.bookarea');
});

//// RoomType All Routes
Route::controller(RoomTypeController::class)->group(function(){ 
    Route::get('room/type/list', 'RoomTypeList')->name('room.type.list');
    Route::get('add/room/type', 'AddRoomType')->name('add.room.type')->middleware('permission:room.type');
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

//// Site Setting All Routes
Route::controller(SettingController::class)->group(function(){
    Route::get('site/setting', 'SiteSetting')->name('site.setting');
    Route::post('update/setting', 'UpdateSetting')->name('update.setting');
});

//// Testimonial  All Routes
Route::controller(TestimonialController::class)->group(function(){
    Route::get('all/testimonial', 'AllTestimonial')->name('all.testimonial')->middleware('permission:testimonial.all');
    Route::get('add/testimonial', 'AddTestimonial')->name('add.testimonial')->middleware('permission:testimonial.add');
    Route::post('store/testimonial', 'StoreTestimonial')->name('store.testimonial');
    Route::get('edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial')->middleware('permission:testimonial.edit');
    Route::post('update/testimonial', 'UpdateTestimonial')->name('update.testimonial');
    Route::get('delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial')->middleware('permission:testimonial.delete');
    
});

//// Blog Category  All Routes
Route::controller(BlogController::class)->group(function(){
    Route::get('all/category', 'BlogCategory')->name('blog.category')->middleware('permission:blog.category'); 
    Route::post('store/blog/category', 'StoreCategory')->name('store.blog.category');
    Route::get('/edit/blog/category/{id}', 'EditBlogCategory');
    Route::post('update/blog/category', 'UpdateCategory')->name('update.blog.category');
    Route::get('delete/blog/category/{id}', 'DeleteCategory')->name('delete.blog.category');
   
});

//// Blog Post  All Routes
Route::controller(BlogController::class)->group(function(){
    Route::get('all/blog/post', 'AllBlogPost')->name('all.blog.post')->middleware('permission:blog.post.list'); 
    Route::get('add/blog/post', 'AddBlogPost')->name('add.blog.post'); 
    Route::post('store/blog/post', 'StoreBlogPost')->name('store.blog.post'); 
    Route::get('edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post'); 
    Route::post('update/blog/post', 'UpdateBlogPost')->name('update.blog.post'); 
    Route::get('delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');
   
});

Route::controller(CommentController::class)->group(function(){
    Route::get('all/comment', 'AllComment')->name('all.comment'); 
    Route::post('update/comment/status', 'UpdateCommentStatus')->name('update.comment.status'); 
});

Route::controller(ReportController::class)->group(function(){
    Route::get('booking/report', 'BookingReport')->name('booking.report'); 
    Route::post('booking/report/search', 'BookingReportSearch')->name('booking.report.search'); 
   
});

Route::controller(GalleryController::class)->group(function(){
    Route::get('gallery/image', 'GalleryImage')->name('gallery.image'); 
    Route::get('add/image', 'AddImage')->name('add.image'); 
    Route::post('store/gallery/image', 'StoreGalleryImage')->name('store.gallery.image'); 
    Route::get('edit/image/{id}', 'EditImage')->name('edit.image'); 
    Route::post('update/gallery/image', 'UpdateGalleryImage')->name('update.gallery.image'); 
    Route::get('delete/image/{id}', 'DeleteImage')->name('delete.image'); 
    Route::post('delete/multi/image', 'DeleteMultiImage')->name('delete.multi.image'); 
});


Route::controller(ContactUsController::class)->group(function(){
    Route::get('contact/us', 'ContactUs')->name('contact.us'); 

});

//// Permission All Routes
Route::controller(RoleController::class)->group(function(){
    Route::get('all/permission', 'AllPermission')->name('all.permission'); 
    Route::get('add/permission', 'AddPermission')->name('add.permission'); 
    Route::post('store/permission', 'StorePermission')->name('store.permission'); 
    Route::get('edit/permission/{id}', 'EditPermission')->name('edit.permission'); 
    Route::post('update/permission', 'UpdatePermission')->name('update.permission'); 
    Route::get('delete/permission/{id}', 'DeletePermission')->name('delete.permission');

    Route::get('permission/import', 'PermissionImport')->name('permission.import'); 
    Route::get('export', 'Export')->name('export'); 
    Route::post('import', 'Import')->name('import'); 
});

//// Role All Routes
Route::controller(RoleController::class)->group(function(){
    Route::get('all/roles', 'AllRoles')->name('all.roles'); 
    Route::get('add/role', 'AddRole')->name('add.role'); 
    Route::post('store/role', 'StoreRole')->name('store.role'); 
    Route::get('edit/role/{id}', 'EditRole')->name('edit.role'); 
    Route::post('update/role', 'UpdateRole')->name('update.role'); 
    Route::get('delete/role/{id}', 'DeleteRole')->name('delete.role');

    Route::get('add/role/permission', 'AddRolePermission')->name('add.role.permission'); 
    Route::post('role/permission/store', 'RolePermissionStore')->name('role.permission.store'); 
    Route::get('all/role/permission', 'AllRolePermission')->name('all.role.permission'); 

    Route::get('admin/edit/role/{id}', 'AdminEditRole')->name('admin.edit.role'); 
    Route::post('admin/role/update/{id}', 'AdminRoleUpdate')->name('admin.role.update'); 
    Route::get('admin/delete/role/{id}', 'AdminDeleteRole')->name('admin.delete.role'); 
   
});


//// Role All Routes
Route::controller(AdminController::class)->group(function(){
    Route::get('all/admin/user', 'AllAdminUser')->name('all.admin.user'); 
    Route::get('add/admin/user', 'AddAdminUser')->name('add.admin.user'); 
    Route::post('store/admin/user', 'StoreAdminUser')->name('store.admin.user'); 
    Route::get('edit/admin/user/{id}', 'EditAdminUser')->name('edit.admin.user'); 
    Route::post('update/admin/user/{id}', 'UpdateAdminUser')->name('update.admin.user'); 
    Route::get('delete/admin/user/{id}', 'DeleteAdminUser')->name('delete.admin.user'); 

});



}); // Admin Group Middleware 

Route::controller(AllRoomsController::class)->group(function(){

    Route::get('/all/rooms/page', 'AllRoomsPage')->name('all.rooms.page');
    Route::get('/room/detail/{id}', 'RoomDetailV');
    Route::get('/booking', 'BookingSearch')->name('booking.search');
    Route::get('/search/room/details/{id}', 'SearchRoomDetails')->name('search_room_details');

    Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');

});


//// Frontend Blog Post  All Routes
Route::controller(BlogController::class)->group(function(){
    Route::get('blog/post/detail/{post_slug}', 'BlogPostDetail');
    Route::get('category/wise/blog/{cat_id}', 'CategoryWiseBlog');
    Route::get('all/blogs', 'AllBlogs')->name('all.blogs');
   
});

Route::controller(GalleryController::class)->group(function(){
    Route::get('all/gallery/image', 'AllGalleryImage')->name('all.gallery.image'); 
});

Route::controller(ContactUsController::class)->group(function(){
    Route::get('contact/page', 'ContactPage')->name('contact.page'); 
    Route::post('store/message', 'StoreMessage')->name('store.message'); 

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
    Route::get('/booking/list/', 'BookingList')->name('booking.list')->middleware('permission:booking.list');
    Route::get('/edit/booking/{id}', 'EditBooking')->name('edit.booking');
    Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');

    // Update Booking
    Route::post('/update/booking/status/{id}', 'UpdateBookingStatus')->name('update.booking.status');
    Route::post('/update/booking/{id}', 'UpdateBooking')->name('update.booking');

     // Delete Booking
     Route::get('/delete/booking/{id}', 'DeleteBooking')->name('delete.booikng');

    // Assign Room route
    Route::get('/assign_room/{id}', 'AssignRoom')->name('assign_room');
    Route::get('/assign_room/store/{booking_id}/{room_number_id}', 'AssignRoomStore')->name('assign_room_store');
    Route::get('/assign_room_delete/{id}', 'AssignRoomDelete')->name('assign_room_delete');

    Route::get('/user/bookings', 'UserBooking')->name('user.bookings');
    Route::get('/user/invoice/{id}', 'UserVoice')->name('user.invoice');
    
    });

    Route::controller(RoomListController::class)->group(function(){
        Route::get('/view/room/list', 'ViewRoomList')->name('view.room.list');
        Route::get('/add/room/list', 'AddRoomList')->name('add.room.list')->middleware('permission:booking.add');
        Route::post('/store/roomlist', 'StoreRoomList')->name('store.roomlist');
    });

    Route::controller(CommentController::class)->group(function(){
        Route::post('/store/comment', 'StoreComment')->name('store.comment');
    });

}); // End User Group Middleware 

// Notification all route
Route::controller(BookingController::class)->group(function(){
    Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead'); 
});