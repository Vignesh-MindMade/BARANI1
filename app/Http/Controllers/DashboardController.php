<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
use App\Models\JobApplication;
use App\Models\SupplierRegistration;
use App\Models\BrochureLead;


class DashboardController extends Controller
{
    public function ContactView(){

        $ContactForms = ContactForm::all();
        $contactCount = ContactForm::count();
        return view('Backend.dashboard_views.contactus', compact('ContactForms','contactCount'));

    }

    public function CarrerView(){

        $JobApplications= JobApplication::all();
        $JobApplicationsCount = JobApplication::count();
        return view('Backend.dashboard_views.jobapplication',compact('JobApplications','JobApplicationsCount'));
    }
    
    public function SupplierView(){

        $SupplierRegistration = SupplierRegistration::all();
        $SupplierRegistrationCount = SupplierRegistration::count();
        return view('Backend.dashboard_views.supplier_form', compact('SupplierRegistration','SupplierRegistrationCount'));

    }

    public function BrochureLeadsView(){

        $BrochureLeads = BrochureLead::all();
        $BrochureLeadsCount = BrochureLead::count();
        return view('Backend.dashboard_views.brochure_leads', compact('BrochureLeads','BrochureLeadsCount'));

    }

    public function ExportBrochureLeads(){
        
        $BrochureLeads = BrochureLead::all();
        
        $filename = 'brochure_leads_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = array(
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        );
        
        $columns = array('ID', 'Name', 'Company Name', 'Email', 'Phone No', 'Country', 'Submitted Date');
        
        $callback = function() use($BrochureLeads, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach($BrochureLeads as $lead) {
                fputcsv($file, array(
                    $lead->id,
                    $lead->name,
                    $lead->company_name,
                    $lead->email,
                    $lead->phone_no,
                    $lead->country,
                    $lead->created_at->format('Y-m-d H:i:s')
                ));
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function Subpage(){

        return view('Backend.dashboard_views.subpage');
    }

}
