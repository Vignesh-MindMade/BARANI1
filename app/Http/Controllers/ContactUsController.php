<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactus_department;
use App\Models\Contactus_department_title;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function FrontView(){
         
        $Contactus_titles = Contactus_department_title::with('departments')->get();
        return view('frontend.contactus.index', compact('Contactus_titles'));
    }


    public function sendMail(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Step 2: Store form data in database
        $contact = new ContactForm();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject ?? 'No Subject';
        $contact->message = $request->message;
        $contact->save();

        // Step 3: Prepare email data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject ?? 'No Subject',
            'body' => $request->message,
        ];

        // Step 4: Send email
        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('admin@bhipl.in', 'Admin')
                    ->subject('New Contact Form Message: ' . $data['subject']);
              // MUST match SMTP login
                $message->from(
                    config('mail.from.address'),
                    config('mail.from.name')  
                    );
        
    // User email goes here
    $message->replyTo($data['email'], $data['name']);
        });

        // Step 5: Return response
        return back()->with('success', 'Your message has been sent and stored successfully!');
    }


    public function index()
    {
        $Contactus_department_titles = Contactus_department_title::all();
        $Contactus_departments = Contactus_department::all();
        return view('Backend.contactus.contact_department', compact('Contactus_department_titles', 'Contactus_departments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Contactus_department_title::create($validatedData);
        return redirect()->back()->with('success', 'Data saved successfully!');
    }
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255|unique:contactus_department_titles,title,' . $id,
    ]);

    $dept = Contactus_department_title::findOrFail($id);
    $dept->update($request->only('title'));

    return redirect()->back()->with('success', 'Department title updated!');
}

public function destroy($id)
{
    $dept = Contactus_department_title::findOrFail($id);
    $dept->delete();

    return redirect()->back()->with('success', 'Department title deleted!');
}
    public function Detatilsstore(Request $request)
    {
        $validatedData = $request->validate([
            'contactus_department_title_id' => 'required|exists:contactus_department_titles,id',
            'contactus_department_subtitle' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'desgination' => 'nullable|string|max:255',
            'mail' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
           
        ]);
    $maxOrder = Contactus_department::where(
        'contactus_department_title_id',
        $validatedData['contactus_department_title_id']
    )->max('sort_order');
        $pdfPath = null;

        Contactus_department::create([
            'contactus_department_title_id' => $validatedData['contactus_department_title_id'],
            'contactus_department_subtitle' => $validatedData['contactus_department_subtitle'] ?? null,
            'desgination' => $validatedData['desgination'] ?? null,
            'name' => $validatedData['name'] ?? null,
            'mail' => $validatedData['mail'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
           'sort_order' => ($maxOrder ?? 0) + 1,
        ]);

        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function Detatilsupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'contactus_department_title_id' => 'required|exists:contactus_department_titles,id',
            'contactus_department_subtitle' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'desgination' => 'nullable|string|max:255',
            'mail' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
           'sort_order' => 'nullable|integer|min:1',

        ]);

        $Contactusdepartment = Contactus_department::findOrFail($id);
        $Contactusdepartment->contactus_department_title_id = $validatedData['contactus_department_title_id'];
        $Contactusdepartment->contactus_department_subtitle = $validatedData['contactus_department_subtitle'] ?? null;
        $Contactusdepartment->desgination = $validatedData['desgination'] ?? null;
        $Contactusdepartment->name = $validatedData['name'] ?? null;
        $Contactusdepartment->mail = $validatedData['mail'] ?? null;
        $Contactusdepartment->phone = $validatedData['phone'] ?? null;
        $Contactusdepartment->sort_order = $validatedData['sort_order'] ??$Contactusdepartment->sort_order;

        $Contactusdepartment->save();

         return redirect()->back()->with('success', 'Data saved successfully!');
    }


    public function Detatilsdestroy($id)
    {
        $Contactusdepartment = Contactus_department::findOrFail($id);
        $Contactusdepartment->delete();

        return redirect()->back()->with('success', 'Record deleted successfully!');
    }





}
