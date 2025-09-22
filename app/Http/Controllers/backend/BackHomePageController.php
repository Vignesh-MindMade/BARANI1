<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\BannerModel;
use App\Models\backend\AboutCompany;
use App\Models\backend\HomeCounts;
use App\Models\backend\Footer;
use App\Models\backend\Profile;
use App\Models\backend\Contact;
use App\Models\backend\HomeProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Models\Backend\Homepage\Topbar;

class BackHomePageController extends Controller
{

    public function TopbarIndex(){

        return view('backend.Homepage.Topbar.index');
    }

    public function TopbarStore(){

    }


    public function index()
    {
        $banners = BannerModel::latest()->paginate(10);
        return view('backend.home.banner', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner_description' => 'required|string|max:1000',
            'readmore_link' => 'required|url',
            'sort_id' => 'required|integer'

        ]);

        $imagePath = null;
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/banners'), $fileName);
            $imagePath = 'images/banners/' . $fileName;
        }

        BannerModel::create([
            'banner_title' => $request->input('banner_title'),
            'banner_image' => $imagePath,
            'banner_description' => $request->input('banner_description'),
            'readmore_link' => $request->input('readmore_link'),
            'sort_id' => $request->input('sort_id')
        ]);

        return redirect()->route('banner')->with('success', 'Banner created successfully!');
    }

    public function edit($id)
    {
        $banner = BannerModel::findOrFail($id);
        return view('backend.home.edit_banner', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner_description' => 'required|string|max:1000',
            'readmore_link' => 'required|url',
            'sort_id' => 'required|integer'
        ]);

        try {
            $banner = BannerModel::findOrFail($id);

            $updateData = [
                'banner_title' => $request->input('banner_title'),
                'banner_description' => $request->input('banner_description'),
                'readmore_link' => $request->input('readmore_link'),
                'sort_id' => $request->input('sort_id')
            ];

            if ($request->hasFile('banner_image')) {
                if ($banner->banner_image && File::exists(public_path($banner->banner_image))) {
                    File::delete(public_path($banner->banner_image));
                }

                $file = $request->file('banner_image');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                if (!File::exists(public_path('images/banners'))) {
                    File::makeDirectory(public_path('images/banners'), 0755, true);
                }
                
                $file->move(public_path('images/banners'), $fileName);
                $updateData['banner_image'] = 'images/banners/' . $fileName;
            }

            $banner->update($updateData);

            return redirect()->route('banner')->with('success', 'Banner updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('banner')->with('error', 'Error updating banner: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $banner = BannerModel::findOrFail($id);
        
            if ($banner->banner_image && File::exists(public_path($banner->banner_image))) {
                File::delete(public_path($banner->banner_image));
            }
            
            $banner->delete();

            return redirect()->route('banner')->with('success', 'Banner deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('banner')->with('error', 'Error deleting banner: ' . $e->getMessage());
        }
    }
public function AboutUsCompany()
{
    $aboutCompany = AboutCompany::first();
    return view('backend.home.about-us-company', compact('aboutCompany'));
}
    public function AboutUsCompanyStore(Request $request)
    {
        $validatedData = $request->validate([
            'years_working_experience' => 'required|integer',
            'content' => 'required|string',
            'textile_industry' => 'nullable|string',
            'textile_industry_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'food_processing_industry' => 'nullable|string',
            'food_processing_industry_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'oem_processing_industry' => 'nullable|string',
            'oem_processing_industry_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('textile_industry_image')) {
            $file = $request->file('textile_industry_image');
            $fileName = time() . '_textile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $validatedData['textile_industry_image'] = 'images/' . $fileName;
        }

        if ($request->hasFile('food_processing_industry_image')) {
            $file = $request->file('food_processing_industry_image');
            $fileName = time() . '_food_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $validatedData['food_processing_industry_image'] = 'images/' . $fileName;
        }

        if ($request->hasFile('oem_processing_industry_image')) {
            $file = $request->file('oem_processing_industry_image');
            $fileName = time() . '_food_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $validatedData['oem_processing_industry_image'] = 'images/' . $fileName;
        }

        // Save to DB
        AboutCompany::create($validatedData);

        return redirect()->back()->with('success', 'About Us Company information saved successfully!');
    }
    public function AboutUsCompanyUpdate(Request $request, $id)
    {
        $aboutCompany = AboutCompany::findOrFail($id);

        $validatedData = $request->validate([
            'years_working_experience' => 'required|integer',
            'content' => 'required|string',
            'textile_industry' => 'nullable|string',
            'textile_industry_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'food_processing_industry' => 'nullable|string',
            'food_processing_industry_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'oem_processing_industry' => 'nullable|string',
            'oem_processing_industry_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('textile_industry_image')) {
    
            if ($aboutCompany->textile_industry_image && File::exists(public_path($aboutCompany->textile_industry_image))) {
                File::delete(public_path($aboutCompany->textile_industry_image));
            }

            $file = $request->file('textile_industry_image');
            $fileName = time() . '_textile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $validatedData['textile_industry_image'] = 'images/' . $fileName;
        }

        if ($request->hasFile('food_processing_industry_image')) {
            if ($aboutCompany->food_processing_industry_image && File::exists(public_path($aboutCompany->food_processing_industry_image))) {
                File::delete(public_path($aboutCompany->food_processing_industry_image));
            }
            
            $file = $request->file('food_processing_industry_image');
            $fileName = time() . '_food_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $validatedData['food_processing_industry_image'] = 'images/' . $fileName;
        }

        if ($request->hasFile('oem_processing_industry_image')) {
        
            if ($aboutCompany->food_processing_industry_image && File::exists(public_path($aboutCompany->food_processing_industry_image))) {
                File::delete(public_path($aboutCompany->food_processing_industry_image));
            }
            
            $file = $request->file('oem_processing_industry_image');
            $fileName = time() . '_food_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $validatedData['oem_processing_industry_image'] = 'images/' . $fileName;
        }

        $aboutCompany->update($validatedData);

        return redirect()->back()->with('success', 'About Us Company information updated successfully!');
    }
    public function HomeCounts()
    {
        $homeCounts = HomeCounts::first(); 
        return view('backend.home.home_counts', compact('homeCounts'));
    }

    public function HomeCountsUpdate(Request $request, $id)
    {
        $homeCounts = HomeCounts::findOrFail($id);

        $validatedData = $request->validate([
            'product_count' => 'required|integer',
            'client_count' => 'required|integer',
            'Satisfaction_percentage' => 'required|integer',
            'years_of_experience_count' => 'required|integer',
            'brand_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'brand_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'brand_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'brand_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'brand_image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'youtube_link' => 'nullable|url'
        ]);

        $images = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("brand_image_$i")) {
                if ($homeCounts->{"brand_image_$i"} && File::exists(public_path($homeCounts->{"brand_image_$i"}))) {
                    File::delete(public_path($homeCounts->{"brand_image_$i"}));
                }
                $file = $request->file("brand_image_$i");
                $fileName = time() . "_brand_{$i}_" . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/brands'), $fileName);
                $images["brand_image_$i"] = 'images/brands/' . $fileName;
            }
        }

        if ($request->hasFile('thumbnail')) {
            if ($homeCounts->thumbnail && File::exists(public_path($homeCounts->thumbnail))) {
                File::delete(public_path($homeCounts->thumbnail));
            }
            $file = $request->file('thumbnail');
            $fileName = time() . '_thumbnail_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/thumbnails'), $fileName);
            $images['thumbnail'] = 'images/thumbnails/' . $fileName;
        }

        $homeCounts->update(array_merge($validatedData, $images));

        return redirect()->back()->with('success', 'Home Counts information updated successfully!');
    }

    public function FooterContent()
    {
            $footer = Footer::first(); 
            return view('backend.default.footer', compact('footer')); 
    }

    public function FooterContentStore(Request $request)
    {
            $request->validate([
                    'facebook_link'  => 'nullable|url|max:255',
                    'linkedin_link'  => 'nullable|url|max:255',
                    'youtube_link'   => 'nullable|url|max:255',
                    'address'        => 'nullable|string',
                    'prime_mail'     => 'nullable|email|max:255',
                    'optional_mail'  => 'nullable|email|max:255',
                    'mobile_number'  => 'nullable|string|max:50',
                    'description'    => 'nullable|string',
                    'copy_rigts'     => 'nullable|string|max:255',
                ]);

            Footer::create([
                    'facebook_link' => $request->input('facebook_link'),
                    'linkedin_link' => $request->input('linkedin_link'),
                    'youtube_link'  => $request->input('youtube_link'),
                    'address'      => $request->input('address'),
                    'prime_mail'   => $request->input('prime_mail'),
                    'optional_mail'=> $request->input('optional_mail'),
                    'mobile_number'=> $request->input('mobile_number'),
                    'description'  => $request->input('description'),
                    'copy_rigts'   => $request->input('copy_rigts'),
                    
            ]);

            return redirect()->back()->with('success', 'Footer content saved successfully!');

    }

    public function FooterContentUpdate(Request $request, $id)
    {
        $footer = Footer::findOrFail($id);

    $validatedData = $request->validate([
        'facebook_link'  => 'nullable|url|max:255',
        'linkedin_link'  => 'nullable|url|max:255',
        'youtube_link'   => 'nullable|url|max:255',
        'address'        => 'nullable|string',
        'prime_mail'     => 'nullable|email|max:255',
        'optional_mail'  => 'nullable|email|max:255',
        'mobile_number'  => 'nullable|string|max:50',
        'description'    => 'nullable|string',
        'copy_rigts'     => 'nullable|string|max:255',
        
        'sales_machines_mail'  => 'nullable|email|max:255',
        'sales_machines_mobile' => 'nullable|string|max:20',

        'sales_spares_mail'  => 'nullable|email|max:255',
        'sales_spares_mobile' => 'nullable|string|max:20',

        'installation_and_commissioning_mail' => 'nullable|email|max:255',
        'installation_and_commissioning_mobile' => 'nullable|string|max:20',

        'product_service_mail'  => 'nullable|email|max:255',
        'product_service_mobile' => 'nullable|string|max:20',

        'remote_support_for_field_complaints_mail' => 'nullable|email|max:255',
        'remote_support_for_field_complaints_mobile_1' => 'nullable|string|max:20',
        'remote_support_for_field_complaints_mobile_2' => 'nullable|string|max:20',

        'engineer_deputation_for_field_complaints_mail' => 'nullable|email|max:255',
        'engineer_deputation_for_field_complaints_mobile' => 'nullable|string|max:20',
    ]);

        $footer->update($validatedData);

        return redirect()->back()->with('success', 'Footer content updated successfully!');
    }
    
    public function ProfileContent()
    {
        $profiles = Profile::all();
        return view('backend.profile.index', compact('profiles'));
    }

    public function ProfileContentEdit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('backend.profile.edit', compact('profile'));
    }

    public function ProfileContentStore(Request $request)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'history_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'management_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'team_thumnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'team_video_link' => 'nullable|string|max:255',
            'about_us_description' => 'nullable|string',
            'textile_name' => 'nullable|string|max:255',
            'textile_work' => 'nullable|string|max:255',
            'textile_description' => 'nullable|string',
            'food_processing_name' => 'nullable|string|max:255',
            'food_processing_work' => 'nullable|string|max:255',
            'food_processing_description' => 'nullable|string',
            'history_description' => 'nullable|string',
            'mission_description' => 'nullable|string',
            'team_description' => 'nullable|string',
            'team_name' => 'nullable|string|max:255',
            'team_work' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'about_us_description', 'textile_name', 'textile_work', 'textile_description',
            'food_processing_name', 'food_processing_work', 'food_processing_description',
            'history_description', 'mission_description', 'team_description', 'team_name',
            'team_work', 'team_video_link'
        ]);

        $imageFields = ['banner_image', 'history_image', 'management_image', 'team_thumnail'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $field . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/profiles'), $fileName);
                $data[$field] = 'uploads/profiles/' . $fileName;
            }
        }
        // dd($data);

        Profile::create($data);

        return redirect()->route('profile')->with('success', 'Profile content saved successfully.');
    }

    // Update profile
    public function ProfileContentUpdate(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'history_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'management_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'team_thumnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'team_video_link' => 'nullable|string|max:255',
            'about_us_description' => 'nullable|string',
            'textile_name' => 'nullable|string|max:255',
            'textile_work' => 'nullable|string|max:255',
            'textile_description' => 'nullable|string',
            'food_processing_name' => 'nullable|string|max:255',
            'food_processing_work' => 'nullable|string|max:255',
            'food_processing_description' => 'nullable|string',
            'history_description' => 'nullable|string',
            'mission_description' => 'nullable|string',
            'team_description' => 'nullable|string',
            'team_name' => 'nullable|string|max:255',
            'team_work' => 'nullable|string|max:255',
        ]);

        $profile = Profile::findOrFail($id);
        $data = $request->only([
            'about_us_description', 'textile_name', 'textile_work', 'textile_description',
            'food_processing_name', 'food_processing_work', 'food_processing_description',
            'history_description', 'mission_description', 'team_description', 'team_name',
            'team_work', 'team_video_link'
        ]);

        $imageFields = ['banner_image', 'history_image', 'management_image', 'team_thumnail'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old image if exists
                if ($profile->$field && file_exists(public_path($profile->$field))) {
                    unlink(public_path($profile->$field));
                }
                $file = $request->file($field);
                $fileName = time() . '_' . $field . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('Uploads/profiles'), $fileName);
                $data[$field] = 'Uploads/profiles/' . $fileName;
            }
        }

        $profile->update($data);

        return redirect()->route('profile')->with('success', 'Profile content updated successfully.');
    }

    // Delete profile
    public function ProfileContentDestroy($id)
    {
        $profile = Profile::findOrFail($id);
        
        // Delete associated images
        $imageFields = ['banner_image', 'history_image', 'management_image', 'team_thumnail'];
        foreach ($imageFields as $field) {
            if ($profile->$field && file_exists(public_path($profile->$field))) {
                unlink(public_path($profile->$field));
            }
        }

        $profile->delete();

        return redirect()->route('profile')->with('success', 'Profile content deleted successfully.');
    }
    public function Contact(){

        return view('backend.contact.index');
    }
   
    public function ContactStore(Request $request)
{
    $request->validate([
        'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'contact_title' => 'nullable|string|max:255',
        'contact_description' => 'nullable|string',
    ]);

    $data = $request->only(['contact_title', 'contact_description']);

    if ($request->hasFile('banner_image')) {
        $file = $request->file('banner_image');
        $fileName = time() . '_banner_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/contact'), $fileName);
        $data['banner_image'] = 'uploads/contact/' . $fileName;
    }

    Contact::create($data);

    return redirect()->back()->with('success', 'Contact content saved successfully.');
}
    public function HomeProducts()
    {
        $homeProduct = HomeProduct::first(); // Fetch the first record
        return view('backend.home.our_products', compact('homeProduct'));
    }

    public function updateHomeProducts(Request $request, $id)
    {
        $homeProduct = HomeProduct::findOrFail($id);

        $request->validate([
            'our_description'     => 'nullable|string',
            'textile_heading'     => 'nullable|string|max:255',
            'textile_description' => 'nullable|string',
            'textile_image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'food_heading'        => 'nullable|string|max:255',
            'food_description'    => 'nullable|string',
            'food_image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'oem_image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'oem_description'     => 'nullable|string',
            'oem_heading'         => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'our_description',
            'textile_heading',
            'textile_description',
            'food_heading',
            'food_description',
            'oem_description',
            'oem_heading',
        ]);

        $imageFields = ['textile_image', 'food_image', 'oem_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old image if exists
                if ($homeProduct->$field && File::exists(public_path($homeProduct->$field))) {
                    File::delete(public_path($homeProduct->$field));
                }
                $file = $request->file($field);
                $fileName = time() . '_' . $field . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/home'), $fileName);
                $data[$field] = 'uploads/home/' . $fileName;
            }
        }

        $homeProduct->update($data);

        return redirect()->back()->with('success', 'Home products updated successfully!');
    }

}
