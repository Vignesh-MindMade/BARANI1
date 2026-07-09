<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopbarController;
use App\Http\Controllers\PressedComponentController;
use App\Http\Controllers\LatestvideoController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CircularController;
use App\Http\Controllers\EditoriolController;
use App\Http\Controllers\InfrastructureController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SustainabilityController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CapabilitiesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BaraniGroupSubmenuController;
use App\Http\Controllers\BaraniGroupSubmenuPageController;
use App\Http\Controllers\JSRController;
use App\Http\Controllers\CapabilitiesMenuController;
use App\Http\Controllers\CapabilitiesPageController;
use App\Http\Controllers\ProductarchiveController;
use App\Http\Controllers\BrochureLeadController;

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\BlogController as BackendBlogController;

#Cache Clear:
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return response()->json(['success' => true, 'message' => 'All caches cleared! Application running smoothly.']);
})->name('clear.cache');


Route::get('/',function(){
    return view('frontend.home.index');
});

// Frontend Routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{blog}/pdf', [BlogController::class, 'viewPdf'])->name('blogs.pdf.view');
Route::get('/blogs/{blog}/pdf/download', [BlogController::class, 'downloadPdf'])->name('blogs.pdf.download');


#Product Search Routes
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/search-suggestions', [ProductController::class, 'suggestions'])->name('product.suggestions');
 
#FRONTEND ROUTES
Route::get('/about-us', [AboutUsController::class, 'AboutUsIndex'])->name('aboutus.index');
Route::get('/sustainability', [SustainabilityController::class, 'FrontView'])->name('sustainability.index');
Route::get('/aboutus-management', [AboutUsController::class, 'ManagementShow'])->name('managementshow.index');
Route::get('/cbse-curriculum', [AboutUsController::class, 'CurriculumShow'])->name('curriculumshow.index');
Route::get('/facilities_our_campus', [AboutUsController::class, 'Frontendfacilitiesindex'])->name('Frontendfacilities.index');
Route::get('/contact_us', [AboutUsController::class, 'Frontendcontactusindex'])->name('Frontendcontactus.index');
Route::get('/faculty_home', [AboutUsController::class, 'facultyFrontEndView'])->name('faculty.index');
Route::get('/careers', [CarrierController::class, 'frontviewofcarrer'])->name('carrers.index');
Route::get('/gallery', [PortfolioController::class, 'GalleryFrontView'])->name('gallery.index');
Route::get('/gallery-events', [PortfolioController::class, 'GalleryEventFrontView'])->name('galleryEvent.index');
Route::get('/contactus', [ContactUsController::class, 'FrontView'])->name('contactus.index');
Route::post('/contact', [ContactUsController::class, 'sendMail'])->name('contact.send');
Route::get('/job_detatils/{id}', [CarrierController::class, 'RedirectIndex'])->name('job_detatils.index');
Route::post('/job_application', [CarrierController::class, 'storeApplication'])->name('career.apply');
Route::get('/job_application_apply', [CarrierController::class, 'GeneralRedirectIndex'])->name('generalcareer.apply');
Route::get('/supplier', [SupplierController::class, 'RediectIndex'])->name('supplier.index');
Route::get('/download_page', [TopbarController::class, 'Front'])->name('download_page.index');
Route::get('/capabilities', [CapabilitiesController::class, 'FrontView'])->name('capabilities.fndex');
Route::get('/group-submenu/view/{submenu}', [BaraniGroupSubmenuController::class, 'frontendShow'])->name('frontend.groupsubmenu.view');
Route::get('/group-submenu/page/{pageId}', [BaraniGroupSubmenuPageController::class, 'view'])->name('frontend.groupsubmenu.page.view');
Route::get('/product/detail/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product/archive/{slug}', [ProductController::class, 'archive'])->name('archive.page');

Route::post('/brochure-lead', [BrochureLeadController::class, 'storeLead'])->name('brochure.lead.store');
Route::get('/download/{file}', [BrochureLeadController::class, 'download'])->name('brochure.lead.download');

# Static Pages
// Route::get('/capabilities1', function () {
//     return view('frontend.capabilities.capabilities');
// });

// Route::get('/capabilities/tooling', function () {
//     return view('frontend.capabilities.tooling');
// });

// Route::get('/capabilities/automation', function () {
//     return view('frontend.capabilities.automation');
// });
Route::get('/capabilities/{slug}', [CapabilitiesPageController::class, 'show'])
    ->name('capabilities.page');
Route::get('/jsr', [JSRController::class, 'frontendIndex'])->name('jsr.frontend.index');

#BACKEND ROUTES
Route::middleware(['auth'])->group(function () {

    // Blog CRUD
    Route::get('/blogs-admin', [BackendBlogController::class, 'index'])->name('blogs-admin.index');
    Route::get('/blogs-admin/create', [BackendBlogController::class, 'create'])->name('blogs-admin.create');
    Route::post('/blogs-admin', [BackendBlogController::class, 'store'])->name('blogs-admin.store');
    Route::get('/blogs-admin/{blog}/edit', [BackendBlogController::class, 'edit'])->name('blogs-admin.edit');
    Route::put('/blogs-admin/{blog}', [BackendBlogController::class, 'update'])->name('blogs-admin.update');
    Route::delete('/blogs-admin/{blog}', [BackendBlogController::class, 'destroy'])->name('blogs-admin.destroy');
    
    // AJAX reorder
    Route::post('/blogs-admin/reorder', [BackendBlogController::class, 'reorderImages'])->name('blogs-admin.reorder-images');
    Route::get('admin', [CustomAuthController::class, 'admin']);
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/view_pages', [HomePageController::class, 'HOME_VIEW'])->name('view_pages');
    Route::get('/contact_view', [DashboardController::class, 'ContactView'])->name('contact_view');
    Route::get('/career_view', [DashboardController::class, 'CarrerView'])->name('career_view');
    Route::get('/supplier_view', [DashboardController::class, 'SupplierView'])->name('supplier_view');
    Route::get('/sub_pages',[DashboardController::class,'Subpage'])->name('subpage.view');

    // Home Page / Downloadpage
    Route::get('/downloadpage', [TopbarController::class, 'index'])->name('topbar.index');
    Route::post('/downloadpage', [TopbarController::class, 'store'])->name('topbar.store');
    Route::put('/downloadpage/{id}/update', [TopbarController::class, 'update'])->name('topbar.update');
    Route::delete('/downloadpage/{id}/delete', [TopbarController::class, 'delete'])->name('topbar.delete');
    // Brochure Lead
         Route::get('/brochure_leads_view', [DashboardController::class, 'BrochureLeadsView'])->name('brochure_leads_view');
    Route::get('/export-brochure-leads', [DashboardController::class, 'ExportBrochureLeads'])->name('export_brochure_leads');
    ####dev
Route::get('/capabilities/{menuId}', [CapabilitiesMenuController::class, 'frontendShow'])
    ->name('capabilities.show');

     
    Route::get('/cap-submenu', [CapabilitiesMenuController::class, 'index'])->name('capsubmenu.index');
    Route::post('/cap-submenu', [CapabilitiesMenuController::class, 'store'])->name('capsubmenu.store');
    Route::put('/cap-submenu/{id}', [CapabilitiesMenuController::class, 'update'])->name('capsubmenu.update');
    Route::delete('/cap-submenu/{id}', [CapabilitiesMenuController::class, 'destroy'])->name('capsubmenu.destroy');
    Route::post('/cap-submenu/sort', [CapabilitiesMenuController::class, 'sort'])->name('capsubmenu.sort');
    ### pages for capabilities submenu
// List all pages for a specific menu
    Route::get('/cap-submenu/{menu}/pages', [CapabilitiesPageController::class, 'index'])
        ->name('capsubmenu.pages.index');

    // Create new page form
    Route::get('/cap-submenu/{menu}/pages/create', [CapabilitiesPageController::class, 'create'])
        ->name('capsubmenu.pages.create');

    // Store new page
    Route::post('/cap-submenu/pages', [CapabilitiesPageController::class, 'store'])
        ->name('capsubmenu.pages.store');

    // Edit existing page
    Route::get('/cap-submenu/{menu}/pages/{page}/edit', [CapabilitiesPageController::class, 'edit'])
        ->name('capsubmenu.pages.edit');

    // Update page
    Route::put('/cap-submenu/{menu}/pages/{page}', [CapabilitiesPageController::class, 'update'])
        ->name('capsubmenu.pages.update');

    // Delete page
    Route::delete('/cap-submenu/{menu}/pages/{page}', [CapabilitiesPageController::class, 'destroy'])
        ->name('capsubmenu.pages.destroy');

    /* Dev Routes for Capabilities Menu Management */


    
    // BARANI GROUP SUBMENU CRUD
    Route::get('/group-submenu', [BaraniGroupSubmenuController::class, 'index'])->name('groupsubmenu.index');
    Route::post('/group-submenu', [BaraniGroupSubmenuController::class, 'store'])->name('groupsubmenu.store');
    Route::put('/group-submenu/{id}', [BaraniGroupSubmenuController::class, 'update'])->name('groupsubmenu.update');
    Route::delete('/group-submenu/{id}', [BaraniGroupSubmenuController::class, 'destroy'])->name('groupsubmenu.destroy');
    Route::post('/group-submenu/sort', [BaraniGroupSubmenuController::class, 'sort'])->name('groupsubmenu.sort');
    Route::get('/group-submenu/{id}/pages', [BaraniGroupSubmenuPageController::class, 'index'])->name('groupsubmenu.pages.index');
    
    // Group submenu pages
    Route::get('/group-submenu/{submenu}/pages', [BaraniGroupSubmenuPageController::class, 'index'])->name('groupsubmenu.pages.index');
    Route::get('/group-submenu/{submenu}/pages/create', [BaraniGroupSubmenuPageController::class, 'create'])->name('groupsubmenu.pages.create');
    Route::post('/group-submenu/{submenu}/pages', [BaraniGroupSubmenuPageController::class, 'store'])->name('groupsubmenu.pages.store');
    
    Route::get('/group-submenu/{submenu}/pages/{page}/edit', [BaraniGroupSubmenuPageController::class, 'edit'])->name('groupsubmenu.pages.edit');
    Route::put('/group-submenu/{submenu}/pages/{page}', [BaraniGroupSubmenuPageController::class, 'update'])->name('groupsubmenu.pages.update');
    Route::delete('/group-submenu/{submenu}/pages/{page}', [BaraniGroupSubmenuPageController::class, 'destroy'])->name('groupsubmenu.pages.destroy');

    #Prodcut Page
    Route::get('/product_catagory', [ProductController::class, 'index'])->name('product_catagory.index');
    Route::post('/product_catagory', [ProductController::class, 'store'])->name('product_catagory.store');
    Route::put('/product_catagory/{id}/update', [ProductController::class, 'update'])->name('product_catagory.update');
    Route::delete('/product_catagory/{id}/delete', [ProductController::class, 'delete'])->name('product_catagory.delete');

   // Detail
    Route::get('/product_view', [ProductController::class, 'viewindex'])->name('viewindex.index');
    Route::post('/product_view/update/{id}', [ProductController::class, 'viewupdate'])->name('product_view.update');
    Route::post('/product_view/store', [ProductController::class, 'viewstore'])->name('product_view.store');
    Route::delete('/product_view/destroy/{id}', [ProductController::class, 'viewdelete'])->name('product_view.destroy');
       // Product Archives (backend management)
    Route::get('/productarchives', [ProductarchiveController::class, 'index'])->name('productarchives.index');
    Route::get('/productarchives/create', [ProductarchiveController::class, 'create'])->name('productarchives.create');
    Route::post('/productarchives', [ProductarchiveController::class, 'store'])->name('productarchives.store');
    Route::get('/productarchives/{productarchive}/edit', [ProductarchiveController::class, 'edit'])->name('productarchives.edit');
    Route::put('/productarchives/{productarchive}', [ProductarchiveController::class, 'update'])->name('productarchives.update');
    Route::delete('/productarchives/{productarchive}', [ProductarchiveController::class, 'destroy'])->name('productarchives.destroy');
     
    // Home Page / Sliders
    Route::get('/homepage', [CircularController::class, 'Homeindex'])->name('testCurricular.index');
    Route::post('/homepage/sliders/store', [CircularController::class, 'Homestore'])->name('circulars.main.store');
    Route::put('/homepage/sliders/{id}', [CircularController::class, 'Homeupdate'])->name('circulars.main.update');
    Route::delete('/homepage/sliders/{id}', [CircularController::class, 'Homedestroy'])
    ->name('circulars.main.destroy');
 
    // Home Page /  Amenities : 
    Route::get('/our_specialised_unit', [LatestvideoController::class, 'index'])->name('latestvideos.index');
    Route::post('/our_specialised_unit', [LatestvideoController::class, 'store'])->name('latestvideos.store');
    Route::put('/our_specialised_unit/{id}', [LatestvideoController::class, 'update'])->name('latestvideos.update');
    Route::delete('/our_specialised_unit/{id}', [LatestvideoController::class, 'destroy'])->name('latestvideos.destroy');

    // Home Page / Testimoniols : 
    Route::get('/homepage-testimonial', [LatestvideoController::class, 'testimonialindex'])->name('Homepagetestimonial.index');
    Route::post('/homepage-testimonial', [LatestvideoController::class, 'testimonialstore'])->name('Homepagetestimonial.store');
    Route::put('/homepage-testimonial/{id}', [LatestvideoController::class, 'testimonialupdate'])->name('Homepagetestimonial.update');
    Route::delete('/homepage-testimonial/{id}', [LatestvideoController::class, 'testimonialdestroy'])->name('Homepagetestimonial.destroy');

    // Home Page /  About Us : 
    Route::get('/aboutus_backend', [LatestvideoController::class, 'Faciltiesindex'])->name('facilties.index');
    Route::post('aboutus_backend', [LatestvideoController::class, 'Faciltiesstore'])->name('facilties.store');
    Route::put('aboutus_backend/{id}', [LatestvideoController::class, 'Faciltiesupdate'])->name('facilties.update');
    Route::delete('aboutus_backend/{id}', [LatestvideoController::class, 'Faciltiesdestroy'])->name('facilties.destroy');


    Route::post('/homepage/faciltiesheadings', [LatestvideoController::class, 'Faciltiesheadingstore'])->name('aboutus.store');
    Route::put('/homepage/faciltiesheadings/{id}/update', [LatestvideoController::class, 'Faciltiesheadingupdate'])->name('aboutus.update');
    Route::delete('/homepage/faciltiesheadings/{id}', [LatestvideoController::class, 'FaciltiesdestroyHeading'])->name('faciltiesheadings.destroy');

    // SUPPLIER PAGE:
    Route::get('/supplier_space', [SupplierController::class, 'Index'])->name('supplier_space.index');
    Route::put('/homepage/supplier_space/{id}/update', [SupplierController::class, 'update'])->name('supplier_space.update');
    Route::post('supplier_registrations', [SupplierController::class, 'RegistrationfORM'])->name('supplier_registrations.store');


    // Team
    // Route::prefix('team')->group(function () {
    //     Route::get('/', [TeamController::class, 'Index'])->name('team.index');
    //     Route::post('/store', [TeamController::class, 'store'])->name('team.store');
    //     Route::put('/update/{id}', [TeamController::class, 'update'])->name('team.update');
    //     Route::delete('/destroy/{id}', [TeamController::class, 'destroy'])->name('team.destroy');
    //     Route::get('/show/{id}', [TeamController::class, 'show'])->name('team.show');
    //     Route::get('/hierarchy', [TeamController::class, 'getHierarchy'])->name('team.hierarchy');
    // });

    Route::get('/team', [TeamController::class, 'TestIndex'])->name('team.testindex');
    Route::put('/team/update', [TeamController::class, 'TESTupdate'])->name('team_test.update');


    Route::get('/jsr-be', [JSRController::class, 'index'])->name('jsr.index');
    Route::post('/jsr/store', [JSRController::class, 'store'])->name('jsr.store');
    Route::put('/jsr/update/{id}', [JSRController::class, 'update'])->name('jsr.update');
    Route::delete('/jsr/delete/{id}', [JSRController::class, 'destroy'])->name('jsr.destroy');
    
    
    // Home Page / Awards & History :
    Route::get('view_awards', [LatestvideoController::class, 'Historyindex'])->name('view_awards.index');
    Route::post('view_awards', [LatestvideoController::class, 'Historystore'])->name('view_awards.store');
    Route::put('view_awards/{id}', [LatestvideoController::class, 'Historyupdate'])->name('view_awards.update');
    Route::delete('view_awards/{id}', [LatestvideoController::class, 'Historydestroy'])->name('view_awards.destroy');

    // Home Page / Gallery
    Route::get('/homepage-gallery', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::post('/homepage-gallery', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::delete('/homepage-gallery/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::put('/homepage-gallery/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');

    // Home Page / Portfolio
    Route::post('/students-portfolio-headings', [PortfolioController::class, 'headingstore'])->name('StudentPortfolioheadings.store');
    Route::put('/students-portfolio-headings/{id}/update', [PortfolioController::class, 'headingupdate'])->name('StudentPortfolioheadings.update');
    Route::delete('/students-portfolio-headings/{id}', [PortfolioController::class, 'destroyHeading'])->name('StudentPortfolioheadings.destroy');
   
    // Home Page / latestvideos
    Route::post('/latestvideosheadings', [LatestvideoController::class, 'headingstore'])->name('latestvideosheading.store');
    Route::put('/latestvideosheadings/{id}/update', [LatestvideoController::class, 'headingupdate'])->name('latestvideosheading.update');
    Route::delete('/latestvideosheadings/{id}', [LatestvideoController::class, 'destroyHeading'])->name('latestvideosheading.destroy');

    // 2.0
    Route::get('/add-gallery', [GalleryController::class, 'index'])->name('viewgallery.index');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');

    // Our Blogs
    Route::get('/homepage-ourblogs', [CircularController::class, 'OurBlogsIndex'])->name('Cocurriculart.index');
    Route::post('/homepage-ourblogs/store', [CircularController::class, 'OurBlogsStore'])->name('cocurricular.main.store');
    Route::put('/homepage-ourblogs/update/{id}', [CircularController::class, 'OurBlogsUpdate'])->name('cocurricular.update');
    Route::delete('/homepage-ourblogs/delete/{id}', [CircularController::class, 'OurBlogsDelete'])->name('cocurricular.delete');


    // About Us -> View Certificate Title
    Route::get('/view_certficate_title', [AboutUsController::class, 'VIEWindexTITLE'])->name('view_certficate_title.index');
    Route::post('/view_certficate_title', [AboutUsController::class, 'VIEWstoreTITLE'])->name('view_certficate_title.store');
    Route::put('/view_certficate_title/{id}', [AboutUsController::class, 'VIEWupdateTITLE'])->name('view_certficate_title.update');
    Route::delete('/view_certficate_title/{id}', [AboutUsController::class, 'VIEWdeleteTITLE'])->name('view_certficate_title.delete');

    Route::get('/view_certficate', [AboutUsController::class, 'VIEWindex'])->name('view_certficate.index');
    Route::post('/view_certficate', [AboutUsController::class, 'VIEWstore'])->name('view_certficate.store');
    Route::put('/view_certficate/{id}/update', [AboutUsController::class, 'VIEWupdate'])->name('view_certficate.update');
    Route::delete('/view_certficate/{id}/delete', [AboutUsController::class, 'VIEWdelete'])->name('view_certficate.delete');


    // AboutUS - > Why Chinmaya Backend
    Route::get('/homepage-whychinmaya-backend', [AboutUsController::class, 'BackendIndex'])->name('whychinmaya');
    Route::post('/homepage-whychinmaya/store', [AboutUsController::class, 'WhyChinmayaStore'])->name('whychinmaya.store');
    Route::put('/homepage-whychinmaya/update/{id}', [AboutUsController::class, 'WhyChinmayaUpdate'])->name('whychinmaya.update');
    Route::delete('/homepage-whychinmaya/delete/{id}', [AboutUsController::class, 'WhyChinmayaDelete'])->name('whychinmaya.delete');

    // AboutUS - > Why Chinmaya Cards
    Route::post('/whychinmaya-cards/store', [AboutUsController::class, 'CardsStore'])->name('cards.store');
    Route::put('/whychinmaya-cards/update/{id}', [AboutUsController::class, 'CardsUpdate'])->name('cards.update');
    Route::delete('/whychinmaya-cards/delete/{id}', [AboutUsController::class, 'CardsDelete'])->name('cards.delete');

    // AboutUS - > Management
    Route::get('/management', [AboutUsController::class, 'ManagementIndex'])->name('management.index');
    Route::post('/homepage-management/store', [AboutUsController::class, 'ManagementStore'])->name('management.store');
    Route::put('/management/{id}', [AboutUsController::class, 'ManagementUpdate'])->name('management.update');
    Route::delete('/homepage-management/delete/{id}', [AboutUsController::class, 'ManagementDelete'])->name('management.delete');

    // AboutUS - > 
    Route::get('/quality_assurance', [AboutUsController::class, 'index'])->name('curriculam.index');
    Route::post('/quality_assurance/store', [AboutUsController::class, 'store'])->name('curriculam.store');
    Route::put('/quality_assurance/{id}', [AboutUsController::class, 'update'])->name('curriculam.update');
    Route::delete('/quality_assurance/delete/{id}', [AboutUsController::class, 'destroy'])->name('curriculam.delete');


    // Facilities
    Route::get('/facilities', [AboutUsController::class, 'facilitiesindex'])->name('facilities.index');
    Route::post('/homepage-facilities/store', [AboutUsController::class, 'facilitiesstore'])->name('facilities.store');
    Route::put('/homepage-facilities/update/{id}', [AboutUsController::class, 'facilitiesupdate'])->name('facilities.update');
    Route::delete('/homepage-facilities/delete/{id}', [AboutUsController::class, 'facilitiesdestroy'])->name('facilities.delete');


    // Faculty
    Route::get('/faculty-backend', [InfrastructureController::class, 'index'])->name('infrastructure.index');
    Route::post('/faculty-backend-main/store', [InfrastructureController::class, 'store'])->name('infrastructure.main.store');
    Route::put('/faculty-backend/{id}', [InfrastructureController::class, 'update'])->name('infrastructure.main.update');
    Route::delete('/faculty-backend/{id}', [InfrastructureController::class, 'destroy'])->name('infrastructure.main.destroy');

    // Detail
    Route::post('/infrastructure/store', [InfrastructureController::class, 'Detatilstore'])->name('infrastructure.store');
    Route::put('/infrastructure/update/{id}', [InfrastructureController::class, 'Detatilupdate'])->name('infrastructure.update');
    Route::delete('/infrastructure/destroy/{id}', [InfrastructureController::class, 'Detatildestroy'])->name('infrastructure.destroy');

    // Detail
    Route::post('/life-at-campus/cocurriculars/store', [CircularController::class, 'CoCuricularDetailstore'])->name('cocurricular.store');
    Route::put('/life-at-campus/cocurriculars/detail/update/{id}', [CircularController::class, 'CoCuricularDetailUpdate'])->name('cocurricular.detail.update');
    Route::delete('/life-at-campus/cocurriculars/detail/delete/{id}', [CircularController::class, 'CoCurricularDetailDelete'])->name('cocurricular.detail.delete');

    // Career 
    Route::get('/career', [CarrierController::class, 'careerindex'])->name('career.index');
    Route::post('/homepage-career/store', [CarrierController::class, 'careerstore'])->name('career.store');
    Route::put('/homepage-career/update/{id}', [CarrierController::class, 'careerupdate'])->name('career.update');
    Route::delete('/homepage-career/delete/{id}', [CarrierController::class, 'careerdestroy'])->name('career.delete');
    Route::post('/homepage-career/banner-store', [CarrierController::class, 'storeBanner'])->name('career.banner.store');

   // what_we_offer
    Route::get('/what_we_offer', [EditoriolController::class, 'OrganizationDetail'])->name('organization.detail');
    Route::put('/what_we_offer/detail/update/{id}', [EditoriolController::class, 'OrganizationDetailUpdate'])->name('organization.detail.update');
    Route::post('/what_we_offer/store', [EditoriolController::class, 'OrganizationStore'])->name('organization.store');
    Route::delete('/what_we_offer/detail/delete/{id}', [EditoriolController::class, 'OrganizationDetailDelete'])->name('organization.detail.delete');

    // Results
    Route::get('/our_products', [ResultController::class, 'index'])->name('results.index');
    Route::post('/our_products/store', [ResultController::class, 'store'])->name('results.main.store');
    Route::put('/our_products/{id}', [ResultController::class, 'update'])->name('results.main.update');
    Route::delete('/our_products/{id}', [ResultController::class, 'destroy'])->name('results.main.destroy');

    // Detail
    Route::put('/results/update/{id}', [ResultController::class, 'Detatilupdate'])->name('results.update');
    Route::post('/results/store', [ResultController::class, 'Detatilstore'])->name('results.store');
    Route::delete('/results/destroy/{id}', [ResultController::class, 'Detatildestroy'])->name('results.destroy');

   // Home Page -> About us
    Route::get('/abouts', [EditoriolController::class, 'Editoriolindex'])->name('abouts.index');
    Route::put('/abouts/update/{id}', [EditoriolController::class, 'Editoriolupdate'])->name('abouts.update');

   // Organization Title
    Route::get('/organization', [EditoriolController::class, 'OrganizationIndex'])->name('organization.index');
    Route::put('/organization/update/{id}', [EditoriolController::class, 'OrganizationUpdate'])->name('organization.update');

    // FAQ Title
    Route::get('/faqtitle', [EditoriolController::class, 'FAQTitleIndex'])->name('faqtitle.index');
    Route::put('/faqtitle/update/{id}', [EditoriolController::class, 'FAQTitleUpdate'])->name('faqtitle.update');

    // FAQ
    Route::get('/view_our_company_stats_throught_the_years', [EditoriolController::class, 'FAQIndex'])->name('faq.index');
    Route::post('/view_our_company_stats_throught_the_years', [EditoriolController::class, 'FaqUpdate'])->name('faq.store');
    Route::put('/view_our_company_stats_throught_the_years/update/{id?}', [EditoriolController::class, 'FaqUpdate'])->name('faq.update');

    // FAQ NEw
    Route::post('/faq', [SupplierController::class, 'FAQstore'])->name('faqnew.store');
    Route::put('/faq/{id}/update', [SupplierController::class, 'FAQupdate'])->name('faqnew.update');
    Route::delete('/faq/{id}/delete', [SupplierController::class, 'FAQdelete'])->name('faqnew.delete');


  // ============SUSTAINABILITY============//

    Route::get('/sustainability-backend', [SustainabilityController::class, 'BackendIndex'])->name('sustainability.backend');
    Route::post('/sustainability/store', [SustainabilityController::class, 'SustainStore'])->name('sustainability.store');
    Route::put('/sustainability/{id}', [SustainabilityController::class, 'SustainUpdate'])->name('sustainability.update');
    Route::delete('/sustainability/delete/{id}', [SustainabilityController::class, 'SustainDestroy'])->name('sustainability.destroy');  

    // Governance Routes::
    Route::get('/sustainability/governance',[SustainabilityController::class,'SustainabilityGovernanceIndex'])->name('sustainability.governance.index');
    Route::post('/sustainability/governance', [SustainabilityController::class, 'governanceStore'])->name('sustainability.governance.store');
    Route::put('/sustainability/governance/{id}', [SustainabilityController::class, 'governanceUpdate'])->name('sustainability.governance.update');
    Route::delete('/sustainability/governance/{id}', [SustainabilityController::class, 'governanceDestroy'])->name('sustainability.governance.destroy');

    Route::get('/sustainability/social', [SustainabilityController::class, 'SustainabilitySocialIndex'])->name('sustainability.social.index');
    Route::post('/sustainability/social', [SustainabilityController::class, 'SustainabilitySocialStore'])->name('sustainability.social.store');
    Route::put('/sustainability/social/{id}', [SustainabilityController::class, 'SustainabilitySocialUpdate'])->name('sustainability.social.update');
    Route::delete('/sustainability/social/{id}', [SustainabilityController::class, 'SustainabilitySocialDestroy'])->name('sustainability.social.destroy');

    Route::get('sustainability/certificates', [SustainabilityController::class, 'SustainabilityCertificatesIndex'])->name('sustainability.certificates.index');
    Route::post('sustainability/certificates', [SustainabilityController::class, 'SustainabilityCertificatesStore'])->name('sustainability.certificates.store');
    Route::put('sustainability/certificates/{id}', [SustainabilityController::class, 'SustainabilityCertificatesUpdate'])->name('sustainability.certificates.update');
    Route::delete('sustainability/certificates/{id}', [SustainabilityController::class, 'SustainabilityCertificatesDestroy'])->name('sustainability.certificates.destroy');

    // =============Sustainability Cert Title:
    Route::post('sustainability/certtitle', [SustainabilityController::class, 'SustainabilityCertTitleStoreOrUpdate'])->name('sustainability.certtitle.storeOrUpdate');

    // OUR SERVICE:
    Route::get('/our_service', [EditoriolController::class, 'SERVICEIndex'])->name('ourservice.index');
    Route::post('/our_service', [EditoriolController::class, 'OURSERVICEUpdate'])->name('ourservice.store');
    Route::put('/our_service/update/{id?}', [EditoriolController::class, 'OURSERVICEUpdate'])->name('ourservice.update');

    // Contact Us // Banner and Get in Touch!
    Route::get('/contactus_admin', [AboutUsController::class, 'contactusindex'])->name('contactussss.index');
    Route::post('/homepage-contactus/store', [AboutUsController::class, 'contactusstore'])->name('contactus.store');
    Route::put('/homepage-contactus/update/{id}', [AboutUsController::class, 'contactusupdate'])->name('contactus.update');
    Route::delete('/homepage-contactus/delete/{id}', [AboutUsController::class, 'contactusdestroy'])->name('contactus.delete');
   
    // Contact Us: Title:
    Route::get('/contactus_department', [ContactUsController::class, 'index'])->name('contactus_department.index');
    Route::post('/contactus_department/store', [ContactUsController::class, 'store'])->name('contactus_department.main.store');
    Route::put('/contactus_department/{id}', [ContactUsController::class, 'update'])->name('contactus_department.main.update');
    Route::delete('/contactus_department/{id}', [ContactUsController::class, 'destroy'])->name('contactus_department.main.destroy');

    // Detail
    Route::put('/contactus_department_detail/update/{id}', [ContactUsController::class, 'Detatilsupdate'])->name('contactus_department_detail.update');
    Route::post('/contactus_department_detail/store', [ContactUsController::class, 'Detatilsstore'])->name('contactus_department_detail.store');
    Route::delete('/contactus_department_detail/destroy/{id}', [ContactUsController::class, 'Detatilsdestroy'])->name('contactus_department_detail.destroy');

    // pressed_components Backend // Template 2: 
    Route::get('/pressed_components_backend', [PressedComponentController::class, 'Index'])->name('pressed_components_backend.index');
    Route::put('pressed_components_backend/{id}', [PressedComponentController::class, 'Update'])->name('pressed_components.update');
    Route::get('/pressed-components/template2-form', [PressedComponentController::class, 'loadTemplate2Form'])->name('pressed-components.template2-form');

    
    // Footer
    Route::get('/footer', [FooterController::class, 'index'])->name('pages.footer');
    Route::post('/useful_links', [FooterController::class, 'store'])->name('footer.links');
    Route::post('/useful_links/update/{id}', [FooterController::class, 'update'])->name('links.update');
    Route::delete('/useful_links/{id}', [FooterController::class, 'destroy'])->name('links.destroy');

    Route::post('/footer_contact', [FooterController::class, 'contactstore'])->name('footercontact.store');
    Route::post('/footercontact/update/{id}', [FooterController::class, 'contactupdate'])->name('footercontact.update');
    Route::delete('/footercontact/{id}', [FooterController::class, 'contactdelete'])->name('footercontact.destroy');

    Route::post('/downloads', [FooterController::class, 'downloadsstore'])->name('footerdownload.store');
    Route::post('/downloads/update/{id}', [FooterController::class, 'downloadupdate'])->name('footerdownload.update');
    Route::delete('/downloads/{id}', [FooterController::class, 'downloaddelete'])->name('footerdownload.destroy');

    Route::post('/Social_Links', [FooterController::class, 'socials'])->name('socials.store');
    Route::post('/footertext', [FooterController::class, 'textstore'])->name('footertext.store');

    // user Profile
    Route::get('/user-profile', function () {
        return view('profile.user-profile');
    });

    Route::get('profile', [CustomAuthController::class, 'profileIndex'])->name('profile.index');

    Route::post('profile/update', [CustomAuthController::class, 'update'])->name('profile.update');

    Route::get('users', [CustomAuthController::class, 'profileIndex'])->name('users.index');
    Route::get('users/create', [CustomAuthController::class, 'create'])->name('users.create');
    Route::post('users/store', [CustomAuthController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [CustomAuthController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [CustomAuthController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [CustomAuthController::class, 'destroy'])->name('users.destroy');
});

    Route::get('/', [CustomAuthController::class, 'home'])->name('home');
    Route::get('/admin', [CustomAuthController::class, 'index'])->name('login');
    Route::post('postlogin', [CustomAuthController::class, 'login'])->name('postlogin');