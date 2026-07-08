<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Menu;
use App\Models\Topbar;
use App\Models\SocialLinks;
use App\Models\FooterContact;
use App\Models\FooterText;
use App\Models\UsefulLinks;
use App\Models\CurricularMain;
use App\Models\Latestvideo;
use App\Models\Facilties;
use App\Models\FaciltiesHeading;
use App\Models\StudentPortfolio;
use App\Models\StudentPortfolioHeading;
use App\Models\HomepageTestimoniols;
use App\Models\CocurricularFront;
use App\Models\CocurricularDetail;
use App\Models\Submenu;
use App\Models\Aboutus;
use App\Models\AboutusCard;
use App\Models\Management;
use App\Models\Curriculam;
use App\Models\FacilitiesatourCampus;
use App\Models\Contactus;
use App\Models\Infrastructure_Detatil;
use App\Models\Infrastructure_front;
use App\Models\Carrer;
use App\Models\Gallery;
use App\Models\Results_front;
use App\Models\Results_detail;
use App\Models\EditoriolSections;
use App\Models\Organization;
use App\Models\OrganizationDetatil;
use App\Models\FAQ;
use App\Models\FAQdetail;
use App\Models\OurService;
use App\Models\History;
use App\Models\ViewCertficate;
use App\Models\Team;
use App\Models\Contactus_department;
use App\Models\Contactus_department_title;
use App\Models\ContactForm;
use App\Models\JobApplication;
use App\Models\Supplier;
use App\Models\FAQNew;
use App\Models\SupplierRegistration;
use App\Models\ProductCatagory;
use App\Models\Products;
use App\Models\BaraniGroupSubmenu;
use App\Models\BaraniGroupSubmenuPage;
use App\Models\Pressed_Component;
use App\Models\CapabilitiesMenu;
use App\Models\JSR;
use App\Models\BrochureLead;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try{
        View::share('topbars', Topbar::all());
        View::share('HomepageTestimoniols', HomepageTestimoniols::all());
        // View::share('NewsEvents', StudentPortfolioHeading::all());
        // View::share('portfolios', StudentPortfolio::all());
        View::share('Facilties', Facilties::all());
        View::share('FaciltiesHeadings', FaciltiesHeading::all());
        View::share('videos', Latestvideo::all());
        View::share('circularsTests', CurricularMain::all());
        View::share('contacts', FooterContact::all());
        View::share('socials', SocialLinks::all());
        View::share('footertexts', FooterText::all());
        View::share('QuickAccess', UsefulLinks::all());
        View::share('Viewawards', History::all());
         View::share('ViewCertficates', ViewCertficate::with('title')->get()->sortByDesc(function($cert) {
            return $cert->title->sort_id ?? 0;
        }));
        // View::share('menus', Menu::all());
        // View::share('CocurricularFronts', CocurricularFront::all());
        // View::share('CocurricularDetails', CocurricularDetail::all());
        // View::share('submenus', Submenu::all());
        // View::share('Aboutus', Aboutus::all());
        // View::share('AboutusCards', AboutusCard::all());
        // View::share('managements', Management::all());
        View::share('curriculams', Curriculam::all());
        // View::share('FacilitiesatourCampus', FacilitiesatourCampus::all());
        View::share('Contactus', Contactus::all());
        // View::share('Infrastructurefronts', Infrastructure_front::all());
        // View::share('InfrastructureDetatils', Infrastructure_Detatil::all());
        View::share('Carrers', Carrer::all());
        // View::share('galleries', Gallery::all());
        // View::share('Results_fronts', Results_front::all());
              View::share('Results_fronts', Results_front::orderBy('sort_id','ASC')->get());
            View::share('Resultsdetails', Results_detail::orderBy('sort_id','ASC')->get());
          
        // View::share('EditorialSections', EditoriolSections::all());
        // View::share('Organizations', Organization::all());
        View::share('OrganizationDetatils', OrganizationDetatil::all());
        View::share('FAQs', FAQ::all());
        View::share('OurServices', OurService::all());
        View::share('Gallerys', Gallery::all());
        View::share('teams', Team::all());
        View::share('Contactus_titles', Contactus_department_title::with('departments')->get());
        View::share('Contactus_departments', Contactus_department::all());
        // View::share('FAQdetails', FAQdetail::all());
        View::share('Suppliers', Supplier::all());
        View::share('FAQNews', FAQNew::all());
        View::share('SupplierRegistrations', SupplierRegistration::all());
        View::share('Productss', Products::all());
        View::share('ProductCatagorys', ProductCatagory::orderBy('sort_id', 'ASC')->get());

        View::share('PressedComponents', Pressed_Component::all());
        View::share('contactCount', ContactForm::count());
        View::share('JobApplications', JobApplication::count());
        View::share('SupplierRegistrationcount', SupplierRegistration::count());
           // Eager-load pages so header can decide links based on per-page template
        View::share('BaraniSubmenus', BaraniGroupSubmenu::with('pages')->orderBy('sort_id')->get());
            View::share('CapabilitiesSubmenus', CapabilitiesMenu::with('pages')->orderBy('sort_id')->get());
    // Share first JSR record for menu name
        $jsrFirst = JSR::first();
        View::share('JSRMenu', $jsrFirst);

     View::composer('*', function ($view) {
        $view->with('brochureleads', BrochureLead::all());
    });
    }

    catch (\Exception $e) {
        // do nothing (prevents crash if DB fails)
    }
}
}