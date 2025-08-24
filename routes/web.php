<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ContactUsMessageController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LawCategoryController;
use App\Http\Controllers\LegalAreaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentReceiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReputationController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;

use Illuminate\Support\Facades\Route;

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
//     return view('frontend.home');
// });
Route::get('/', [FrontendController::class, 'Home'])->name('home');
Route::get('about_us', [FrontendController::class, 'AboutUs'])->name('frontend.about.us');
Route::get('our_team', [FrontendController::class, 'OurTeam'])->name('frontend.our.team');
Route::get('team_details/{id?}', [FrontendController::class, 'TeamDetails'])->name('frontend.team_details');
Route::get('faq', [FrontendController::class, 'Faq'])->name('frontend.faq');
Route::get('articles', [FrontendController::class, 'Articles'])->name('frontend.articles');
Route::get('contact', [FrontendController::class, 'ContactUs'])->name('frontend.contact');
Route::get('practice_area/{id?}', [FrontendController::class, 'practiceArea'])->name('frontend.practice.area');
Route::get('articles_details/{id?}', [FrontendController::class, 'ArticlesDetails'])->name('frontend.articles.details');
Route::get('articles_by_legal_area/{id?}', [FrontendController::class, 'ArticlesByLegalArea'])->name('frontend.articles.by_legal_area');
Route::get('articles_by_tag/{id?}', [FrontendController::class, 'ArticlesByTag'])->name('frontend.articles.by_tag');
Route::get('make_appointment/{id?}', [FrontendController::class, 'MakeAppointment'])->name('frontend.make_appointment');
Route::get('slot_get/{id?}', [FrontendController::class, 'SlotGet'])->name('frontend.slot_get');

Route::get('/employees/{employee}/availability/{date?}', [FrontendController::class, 'getEmployeeAvailability'])
    ->name('employee.availability');
Route::get('/team/{id}/employees', [FrontendController::class, 'getEmployees'])->name('get.employees');
Route::post('/bookings', [AppointmentController::class, 'store'])->name('bookings.store');


Route::post('contact_us_message_insert', [ContactUsMessageController::class, 'ContactUsMessageInsert'])->name('account.contact_us_message.insert');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::post('signin-process', [LoginController::class, 'SignInProcess'])->name('sign-in.process');
Route::post('signUp-process', [LoginController::class, 'SignUpProcess'])->name('sign-Up.process');
Route::get('/download-pdf/{id?}', [AppointmentController::class, 'downloadPdf'])->name('pdf.download');
Route::middleware('auth')->group(function () {

    Route::get('/user/dashboard', [HomeController::class, 'UserDashboard'])->name('user.dashboard');
    Route::post('profile_update', [ProfileController::class, 'UserProfileUpdate'])->name('account.profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('change_password', [ProfileController::class, 'change_password'])->name('account.profile.change.password');
    Route::post('change_password', [ProfileController::class, 'UserChangePassword'])->name('account.profile.change.password.insert');

    Route::get('my_appointment', [UserController::class, 'UserAppointment'])->name('user.appointment');
    // Route::get('/download-pdf/{id?}', [AppointmentController::class, 'downloadPdf'])->name('pdf.download');




    Route::get('/dashboard', [HomeController::class, 'Dashboard'])->name('dashboard');
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('company-setting', [CompanySettingController::class, 'index'])->name('company.setting');
        Route::post('company-setting-insert', [CompanySettingController::class, 'companySettingInsert'])->name('company.setting.insert');

        Route::get('user_role_list', [UserManagementController::class, 'userRoleLists'])->name('user_role_list');
        Route::get('user_role/{id?}', [UserManagementController::class, 'userRole'])->name('user-role');
        Route::post('user_role/update', [UserManagementController::class, 'userRoleUpdate'])->name('user_role.update');
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
        Route::post('/appointments/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.update.status');
        Route::post('/update-status', [AppointmentController::class, 'DashboardUpdateStatus'])->name('dashboard.update.status');

        Route::get('team/{id?}', [TeamController::class, 'TeamAccounts'])->name('account.team');
        Route::get('team_create', [TeamController::class, 'TeamCreate'])->name('account.team.create');
        Route::get('team_edit/{id?}', [TeamController::class, 'TeamEdit'])->name('account.team.editnew');
        Route::post('team_destroy/{id?}', [TeamController::class, 'TeamDestroy'])->name('account.team.destroy');

        Route::get('team_data', [TeamController::class, 'TeamData'])->name('account.team.data');
        Route::get('team_edit_data', [TeamController::class, 'TeamEditData'])->name('account.team.edit');

        Route::post('team_insert', [TeamController::class, 'TeamInsert'])->name('account.team.insert');
        Route::post('team_update/{id?}', [TeamController::class, 'TeamUpdate'])->name('account.team.update');

        Route::get('legal_area/{id?}', [LegalAreaController::class, 'LegalArea'])->name('account.legal_area');
        Route::get('legal_area_data', [LegalAreaController::class, 'LegalAreaData'])->name('account.legal_area.data');
        Route::get('legal_area_edit_data', [LegalAreaController::class, 'LegalAreaEditData'])->name('account.legal_area.edit');
        Route::post('lagal_area_insert', [LegalAreaController::class, 'LegalAreaInsert'])->name('account.legal_area.insert');
        Route::get('lagal_area_search', [LegalAreaController::class, 'LegalAreaSearch'])->name('account.legal_area.search');


        Route::get('sub_legal_area/{id?}', [LegalAreaController::class, 'SubLegalArea'])->name('account.sub_legal_area');
        Route::get('sub_legal_area_data', [LegalAreaController::class, 'SubLegalAreaData'])->name('account.sub_legal_area.data');
        Route::get('sub_legal_area_edit_data', [LegalAreaController::class, 'SubLegalAreaEditData'])->name('account.sub_legal_area.edit');
        Route::post('sub_legal_area_insert', [LegalAreaController::class, 'SubLegalAreaInsert'])->name('account.sub_legal_area.insert');
        Route::get('sub.lagal_area_search', [LegalAreaController::class, 'SubLegalAreaSearch'])->name('account.sub.legal_area.search');
        //banner
        Route::get('banner/{id?}', [BannerController::class, 'Banner'])->name('account.banner');
        Route::get('banner_data', [BannerController::class, 'BannerData'])->name('account.banner.data');
        Route::get('banner_edit_data', [BannerController::class, 'BannerEditData'])->name('account.banner.edit');
        Route::post('banner_insert', [BannerController::class, 'BannerInsert'])->name('account.banner.insert');
        //end
        //reputation
        Route::get('reputation/{id?}', [ReputationController::class, 'Reputation'])->name('account.reputation');
        Route::get('reputation_data', [ReputationController::class, 'ReputationData'])->name('account.reputation.data');
        Route::get('reputation_edit_data', [ReputationController::class, 'ReputationEditData'])->name('account.reputation.edit');
        Route::post('reputation_insert', [ReputationController::class, 'ReputationInsert'])->name('account.reputation.insert');
        //end
        //banner
        Route::get('experience/{id?}', [ExperienceController::class, 'Experience'])->name('account.experience');
        Route::get('experience_data', [ExperienceController::class, 'ExperienceData'])->name('account.experience.data');
        Route::get('experience_edit_data', [ExperienceController::class, 'ExperienceEditData'])->name('account.experience.edit');
        Route::post('experience_insert', [ExperienceController::class, 'ExperienceInsert'])->name('account.experience.insert');

        //end
        Route::get('testimonial/{id?}', [TestimonialController::class, 'Testimonial'])->name('account.testimonial');
        Route::get('testimonial_data', [TestimonialController::class, 'TestimonialData'])->name('account.testimonial.data');
        Route::get('testimonial_edit_data', [TestimonialController::class, 'TestimonialEditData'])->name('account.testimonial.edit');
        Route::post('testimonial_insert', [TestimonialController::class, 'TestimonialInsert'])->name('account.testimonial.insert');

        Route::get('contact_us/{id?}', [ContactUsController::class, 'ContactUs'])->name('account.contact_us');
        Route::get('contact_us_data', [ContactUsController::class, 'ContactUsData'])->name('account.contact_us.data');
        Route::get('contact_us_edit_data', [ContactUsController::class, 'ContactUsEditData'])->name('account.contact_us.edit');
        Route::post('contact_us_insert', [ContactUsController::class, 'ContactUsInsert'])->name('account.contact_us.insert');


        Route::get('contact_us_message/{id?}', [ContactUsMessageController::class, 'ContactUsMessage'])->name('account.contact_us_message');
        Route::get('contact_us_message_data', [ContactUsMessageController::class, 'ContactUsMessageData'])->name('account.contact_us_message.data');
        Route::get('contact_us_message_edit_data', [ContactUsMessageController::class, 'ContactUsMessageEditData'])->name('account.contact_us_message.edit');

        Route::get('article/{id?}', [ArticleController::class, 'Article'])->name('account.article');
        Route::get('article_data', [ArticleController::class, 'ArticleData'])->name('account.article.data');
        Route::get('article_edit_data', [ArticleController::class, 'ArticleEditData'])->name('account.article.edit');
        Route::post('article_insert', [ArticleController::class, 'ArticleInsert'])->name('account.article.insert');

        Route::get('tag/{id?}', [TagController::class, 'Tag'])->name('account.tag');
        Route::get('tag_data', [TagController::class, 'TagData'])->name('account.tag.data');
        Route::get('tag_edit_data', [TagController::class, 'TagEditData'])->name('account.tag.edit');
        Route::post('tag_insert', [TagController::class, 'TagInsert'])->name('account.tag.insert');
        Route::get('tag_search', [TagController::class, 'TagSearch'])->name('account.tag.search');


        Route::get('about_us/{id?}', [AboutUsController::class, 'AboutUs'])->name('account.about_us');
        Route::get('about_us_data', [AboutUsController::class, 'AboutUsData'])->name('account.about_us.data');
        Route::get('about_us_edit_data', [AboutUsController::class, 'AboutUsEditData'])->name('account.about_us.edit');
        Route::post('about_us_insert', [AboutUsController::class, 'AboutUsInsert'])->name('account.about_us.insert');

        Route::get('faq_category/{id?}', [FaqCategoryController::class, 'faqCategory'])->name('account.faq_category');
        Route::get('faq_category_data', [FaqCategoryController::class, 'faqCategoryData'])->name('account.faq_category.data');
        Route::get('faq_category_edit_data', [FaqCategoryController::class, 'faqCategoryEditData'])->name('account.faq_category.edit');
        Route::post('faq_category_insert', [FaqCategoryController::class, 'faqCategoryInsert'])->name('account.faq_category.insert');
        Route::get('faq_category_search', [FaqCategoryController::class, 'faqCategorySearch'])->name('account.faq_category.search');

        Route::get('faq/{id?}', [FaqController::class, 'Faq'])->name('account.faq');
        Route::get('faq_data', [FaqController::class, 'FaqData'])->name('account.faq.data');
        Route::get('faq_edit_data', [FaqController::class, 'FaqEditData'])->name('account.faq.edit');
        Route::post('faq_insert', [FaqController::class, 'FaqInsert'])->name('account.faq.insert');

        Route::get('law_category/{id?}', [LawCategoryController::class, 'LawCategory'])->name('account.law_category');
        Route::get('law_category_data', [LawCategoryController::class, 'LawCategoryData'])->name('account.law_category.data');
        Route::get('law_category_edit_data', [LawCategoryController::class, 'LawCategoryEditData'])->name('account.law_category.edit');
        Route::post('law_category_insert', [LawCategoryController::class, 'LawCategoryInsert'])->name('account.law_category.insert');


        Route::get('slot/{id?}', [SlotController::class, 'Slot'])->name('account.slot');
        Route::get('slot_data', [SlotController::class, 'SlotData'])->name('account.slot.data');
        Route::get('slot_edit_data', [SlotController::class, 'SlotEditData'])->name('account.slot.edit');
        Route::post('slot_insert', [SlotController::class, 'SlotInsert'])->name('account.slot.insert');


        Route::get('payment_recieve/{id?}', [PaymentReceiveController::class, 'index'])->name('account.payment_receive');
        Route::get('payment_recieve_data', [PaymentReceiveController::class, 'PaymentReceiveData'])->name('account.payment_recieve.data');
    });

    //like dislike
    Route::get('posts', [ArticleController::class, 'index'])->name('posts.index');
    Route::post('posts/ajax-like-dislike', [ArticleController::class, 'ajaxLike'])->name('posts.ajax.like.dislike');
    //end
});

require __DIR__ . '/auth.php';
