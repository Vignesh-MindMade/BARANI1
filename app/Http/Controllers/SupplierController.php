<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\FAQNew;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupplierRegistrationMail;
use App\Models\SupplierRegistration;
use Illuminate\Support\Facades\Log;
use App\Rules\Recaptcha;

class SupplierController extends Controller
{

    public function RediectIndex()
    {
        return view('frontend.supplier.view');
    }

    public function Index()
    {
        $heading = Supplier::all();
        $faq = FAQNew::all();
        view()->share('Suppliers', $heading);

        return view('Backend.supplier.index', compact('heading', 'faq'));
    }

    public function update(Request $request, $id)
    {
        $heading = Supplier::findOrFail($id);

        $validated = $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
            'description' => 'required|string|max:30000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hydraulic_press_manufacturing' => 'required|string|max:30000',
            'custom_automation_solutions' => 'required|string|max:30000',
        ]);

        $data = [
            'description' => $request->description,
            'hydraulic_press_manufacturing' => $request->hydraulic_press_manufacturing,
            'custom_automation_solutions' => $request->custom_automation_solutions,
        ];

        foreach (['banner_image', 'image',] as $field) {
            if ($request->hasFile($field)) {

                if ($heading->$field && file_exists(public_path('images/' . $heading->$field))) {
                    unlink(public_path('images/' . $heading->$field));
                }

                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $data[$field] = $filename;
            }
        }

        $heading->update($data);

        return redirect()->back()->with('success', 'About Us section updated successfully.');
    }

    public function FAQstore(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'order_id' => 'nullable|string|max:255',
        ]);

        $faq = new FAQNew;
        $faq->question = $validatedData['question'];
        $faq->answer = $validatedData['answer'];

        if (isset($validatedData['order_id'])) {
            $faq->order_id = $validatedData['order_id'];
        }

        $faq->save();

        return redirect()->back()->with('success', 'faq created successfully.');
    }

    public function FAQupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'order_id' => 'nullable|string|max:255',
        ]);

        $faq = FAQNew::findOrFail($id);
        $faq->question = $validatedData['question'];
        $faq->answer = $validatedData['answer'];

        if (isset($validatedData['order_id'])) {
            $faq->order_id = $validatedData['order_id'];
        }

        $faq->save();

        return redirect()->route('supplier_space.index');
    }

    public function FAQdelete($id)
    {
        $faq = FAQNew::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'faq deleted successfully.');
    }

    public function RegistrationfORM(Request $request, $id = null)
    {
        try {

            $validatedData = $request->validate([
                'g-recaptcha-response' => ['required', new Recaptcha],
                'unit' => 'required|string',
                'company_name' => 'required|string|max:255',
                'company_website' => 'nullable|url|max:255',
                'company_address' => 'required|string',
                'year_established' => 'nullable|integer|min:1800|max:' . date('Y'),
                'business_type' => 'nullable|string|max:100',
                'contact_name' => 'required|string|max:255',
                'job_title' => 'nullable|string|max:255',
                'contact_email' => 'required|email|max:255',
                'contact_phone' => 'required|string|max:50',
                'product_category' => 'required|string|max:255',
                'product_description' => 'required|string',
                'brochure' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
                'certifications' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',

            ]);
            $data = $validatedData;
            $to_reciver_body = "Mail has been submitted";


            $unitEmails = [
                'Press Manufacturing Division' => 'purchase@bhipl.in',
                'Pressed Components and Sub-Assembly' => 'purchase@bhipl.in',
                'Foundry Division' => 'purchase@bhipl.in',
            ];

            $to_email = $unitEmails[$validatedData['unit']] ?? 'purchase@bhipl.in';

            Log::info('Selected email for unit: ' . $validatedData['unit'] . ' is ' . $to_email);
            $admin_email = "vigneshnathan@mindmade.in";

            foreach (['brochure', 'certifications'] as $field) {
                if ($request->hasFile($field)) {
                    if ($id) {
                        $existing = SupplierRegistration::find($id);
                        if ($existing && $existing->$field) {
                            $oldFilePath = public_path('boucher/' . $existing->$field);
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                    }

                    $file = $request->file($field);
                    $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('boucher'), $filename);
                    $data[$field] = $filename;
                }
            }

            if ($id) {
                $supplier = SupplierRegistration::findOrFail($id);
                $supplier->update($data);
                $message = 'Supplier registration updated successfully!';
                $isUpdate = true;
            } else {
                $supplier = SupplierRegistration::create($data);
                $message = 'Supplier registered successfully!';
                $isUpdate = false;
            }

            Log::info('Supplier registration saved successfully', ['id' => $supplier->id]);

            $emailSent = false;
            $emailError = '';

            try {
                $adminEmail = $to_email; // manojkumar@mindmade.in
                $supplierEmail = $data['contact_email'];
                $admin_supplier = $admin_email;

                Log::info('Attempting to send email...', [
                    'to_admin' => $adminEmail,
                    'to_supplier' => $supplierEmail,
                    'admin' => $admin_supplier
                ]);


                Mail::to($adminEmail)->send(
                    new SupplierRegistrationMail($data, $isUpdate)
                );
                Log::info('Email sent to admin successfully');


                Mail::to($supplierEmail)->send(
                    new SupplierRegistrationMail($data, $isUpdate)
                );
                Log::info('Email sent to supplier successfully');

                Mail::to($admin_supplier)->send(
                    new SupplierRegistrationMail($data, $isUpdate)
                );
                Log::info('Email sent to supplier successfully');

                $emailSent = true;
                $message .= ' Email notifications sent successfully.';

            } catch (\Swift_TransportException $e) {
                $emailError = 'SMTP Error: ' . $e->getMessage();
                Log::error($emailError);
                Log::error($e->getTraceAsString());

            } catch (\Exception $e) {
                $emailError = 'Email Error: ' . $e->getMessage();
                Log::error($emailError);
                Log::error($e->getTraceAsString());
            }


            return redirect()->back()->with('success', $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Registration failed: ' . $e->getMessage())->withInput();
        }
    }
}











































