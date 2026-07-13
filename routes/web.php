<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
// Page Edit BY Admin
Route::get('/admin/edit/{string?}', [AdminController::class, 'EditPage'])->name('editpage');
Route::post('/admin/save/static-page', [AdminController::class, 'SavePage'])->name('saveaboutpage');

//Categories
Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
Route::post('/savecategory', [AdminController::class, 'savecategory'])->name('savecategory');
Route::get('/editcategory', [AdminController::class, 'editcategory'])->name('editcategory');
Route::get('/deletecategory', [AdminController::class, 'deletecategory'])->name('deletecategory');
//SubCategories
Route::get('/subcategories', [AdminController::class, 'subcategories'])->name('subcategories');
Route::post('/savesubcategory', [AdminController::class, 'savesubcategory'])->name('savesubcategory');
Route::get('/editsubcategory', [AdminController::class, 'editsubcategory'])->name('editsubcategory');
Route::get('/deletesubcategory', [AdminController::class, 'deletesubcategory'])->name('deletesubcategory');
//subchildcategory
Route::get('/subchildcategories', [AdminController::class, 'subchildcategories'])->name('subchildcategories');
Route::get('/fetch-subcategories', [AdminController::class, 'fetchsubcategories'])->name('fetch-subcategories');
Route::post('/savechildcategory', [AdminController::class, 'savechildcategory'])->name('savechildcategory');
Route::get('/deletesubchildcategory', [AdminController::class, 'deletesubchildcategory'])->name('deletesubchildcategory');
//Products
Route::get('/products', [AdminController::class, 'products'])->name('products');
Route::get('/addproducts', [AdminController::class, 'addproducts'])->name('addproducts');
Route::post('/saveproduct', [AdminController::class, 'saveproduct'])->name('saveproduct');
Route::post('/deleteproducts', [AdminController::class, 'deleteproducts'])->name('delete-products');
Route::get('/product/delete/{id?}', [AdminController::class, 'DeleteProduct'])->name('DeleteProduct');
Route::get('/product/edit/{id?}', [AdminController::class, 'EditProduct'])->name('EditProduct');
Route::get('/getsubcategories', [AdminController::class, 'getsubcategories'])->name('getsubcategories');
Route::get('/getsubchildcategories', [AdminController::class, 'getsubchildcategories'])->name('getsubchildcategories');
Route::post('/make-top-export', [AdminController::class, 'maketopexport'])->name('make-top-export');
//product-details
Route::get('/product-details/{id?}', [AdminController::class, 'productdetails'])->name('product-details');
//approveproduct
Route::post('/approveproduct', [AdminController::class, 'approveproduct'])->name('approveproduct');
//rejectproduct
Route::post('/rejectproduct', [AdminController::class, 'rejectproduct'])->name('rejectproduct');

Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('inquiries');
Route::post('/assign-inquiry', [AdminController::class, 'assigninquiry'])->name('assign-inquiry');
//Bolgs
Route::get('/blogsettings', [AdminController::class, 'blogsettings'])->name('blogs.settings');
Route::get('/author', [AdminController::class, 'blogauthors'])->name('blogs.author');
Route::get('/blogscategories', [AdminController::class, 'blogscategories'])->name('blogs.categories');
//Posts
Route::prefix('posts')->name('posts.')->group(function () {
    Route::view('/add-post', 'admin.blogs.add-post')->name('add.post');
    Route::view('/allposts', 'admin.blogs.allposts')->name('all.post');
});

Route::post('/create', [AdminController::class, 'postcreate'])->name('posts-create');
Route::get('/edit-post/{id?}', [AdminController::class, 'EditPost'])->name('edit-post');
Route::get('/delte-post/{id?}', [AdminController::class, 'DeletePost'])->name('delete-post');



            //CustomerController

//subscription save
Route::post('/subscription/save', [CustomerController::class, 'Subscribe'])->name('save-subscribe');
//search product
Route::post('/search', [CustomerController::class, 'Search'])->name('searchproduct');
//getcontactcities
Route::get('about', [CustomerController::class, 'about'])->name('about');
Route::get('contact', [CustomerController::class, 'contact'])->name('contact');
Route::get('privacy', [CustomerController::class, 'privacy'])->name('privacy');
Route::get('faq', [CustomerController::class, 'FAQ'])->name('faq');
Route::get('how-to-post-your-buyer-inquiry', [CustomerController::class, 'BuyerInquire'])->name('inquirybuyer');
Route::get('benefits/{type?}', [CustomerController::class, 'BenefitPage'])->name('benefitpage');
Route::get('HowtoRegister/{type?}', [CustomerController::class, 'HowRegisterPage'])->name('howtoregister');
Route::get('getcontactcities', [CustomerController::class, 'getcities'])->name('getcontactcities');
Route::get('/', [CustomerController::class, 'index'])->name('index');
//Route::get('/categories', [CustomerController::class, 'categoriesgrid'])->name('categories-grid');
Route::get('categories/{slug?}', [CustomerController::class, 'showProducts'])->name('categories.products');
Route::get('categories/{categorySlug}/{subcategorySlug}', [CustomerController::class, 'showSubcategoryProducts'])->name('categories.subcategory.products');
Route::get('categories/{categorySlug}/{subcategorySlug}/{subchildSlug}', [CustomerController::class, 'showSubchildCategoryProducts'])->name('categories.subchildcategory.products');

Route::get('products-details/{slug}', [CustomerController::class, 'productsDetails'])
    ->name('products.details')
    ->where('slug', '.*'); // Allow slashes in slug
Route::get('blogs', [CustomerController::class, 'blogs'])
    ->name('blogs');
Route::get('blogs-details/{slug?}', [CustomerController::class, 'blogDetails'])
    ->name('blogs.details');
Route::get('/blogs/search', [CustomerController::class, 'blogsearch']);
Route::get('blogs/{slug?}', [CustomerController::class, 'CatBlog'])
    ->name('blogs.category');
//buyermanagement
Route::get('/buyemanagement', [AdminController::class, 'buyermanagement'])->name('buyermanagement');
Route::post('/update-user-status', [AdminController::class, 'updateuserstatus'])->name('update-user-status');
//vendermanagement
Route::get('/vendormanagement', [AdminController::class, 'vendormanagement'])->name('vendormanagement');
//subscribermanagement
Route::get('/subscriber-management', [AdminController::class, 'SubscriberManagement'])->name('subscribermanagement');
//download excel
Route::get('/downloadexcel/{type?}', [AdminController::class, 'DownloadExcel'])->name('DownloadExcel');
//newsletter
Route::get('/newsletter', [AdminController::class, 'NewsLetter'])->name('newsletter');
Route::post('/newsletter/send', [AdminController::class, 'SendNewsLetter'])->name('send-newsletter');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/thank-you', function () {
    return view('thank-you');
})->name('thankyou');
Route::get('/activate/{user}', [AdminController::class, 'activate'])->name('activate');
Route::post('/inquiry', [CustomerController::class, 'inquiry'])->name('inquiry');

// Route::livewire('/assets/js/vendor/livewire/message/author-general-settings', 'author-general-settings');
//membership plans
Route::get('/membershipplan', [CustomerController::class, 'MembershipPlan'])->name('membershipplan');
Route::match(['get', 'post'], '/membershipplan/order', [AdminController::class, 'MembershipPlanType'])->name('membershipplantype');
Route::post('/free-membership-status', [AdminController::class, 'FreeMembership'])->name('free-membership-status');
Route::get('/update/membership/{user}/{type}', [AdminController::class, 'UpdateMembership'])->name('changemembershipplan');
//membership manage
Route::get('/membership-management', [AdminController::class, 'MembershipManagement'])->name('membershipmanagement');
Route::post('/status-member-ship', [AdminController::class, 'MembershipStatus'])->name('status-member-ship');
