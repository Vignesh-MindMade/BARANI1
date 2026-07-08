<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Section;
use App\Models\PsgIaq;
use App\Models\ContentSection;
use App\Models\TrusteMessage;
use App\Models\SonsandCharities;
use App\Models\GoverningCouncil;
use App\Models\StatutoryCommittee;
use App\Models\CommitteeName;
use App\Models\CouncilMembers;
use App\Models\FactsandFigure;
use App\Models\OrganizationSchedule;
use App\Models\PrincipalMessage;
use App\Models\Corefaculty;
use App\Models\Visitingfaculty;
use App\Models\DesignChair;
use App\Models\AlliedFaculty;
use App\Models\ChiefAdvisor;
use App\Models\ExpertMember;
use App\Models\AdministrativeChiefAdvisor;
use App\Models\AdministrativeExpertmembers;
use App\Models\OurPrograms;
use App\Models\Pedagogy;
use App\Models\Syllabus;
use App\Models\AcademicCalendar;
use App\Models\AcademicTimetable;
use App\Models\MonthlyLectureSeries;
use App\Models\SiteFieldVisits;
use App\Models\StudyTour;
use App\Models\Nasa;
use App\Models\Symposium;
use App\Models\EcamcellSections;
use App\Models\ExamcellContents;
use App\Models\LabsSections;
use App\Models\LabContent;
use App\Models\Library;
use App\Models\LibraySections;
use App\Models\CommitteeMember;
use App\Models\Clubs;
use App\Models\ClubsHeding;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


class PageController extends Controller
{
        public function index()
        {
        $menus = Menu::all();
        return view('pages.index',compact('menus'));
    }
    
        public function showSubmenus($id)
        {
            $menu = Menu::findOrFail($id);
           $submenus = Submenu::where('menu_id', $id)
                   ->with('menu')
                   ->orderBy('sort_id', 'asc')
                   ->get();
        //   info($submenus);
            $psgiaq = PsgIaq::all();
            $sections = Section::all();
            $contents = ContentSection::all(); 
            $trustee = TrusteMessage::all();
            $sons = SonsandCharities::all();
            $councils = GoverningCouncil::all();
            $committees = StatutoryCommittee::all();
            $committeenames = CommitteeName::all();
            $councilmembers = CouncilMembers::all();
            $factsandfigures = FactsandFigure::all();
            $organizations = OrganizationSchedule::all();
            $messages = PrincipalMessage::all();
            $faculties = Corefaculty::all();
            $visitors = Visitingfaculty::all();
            $Designchair = DesignChair::all();
            $allied = AlliedFaculty::all();
            $chiefadvisor = ChiefAdvisor::all();
            $expertmembers = ExpertMember::all();
            $adminchiefadvisors = AdministrativeChiefAdvisor::all();
            $adminexpmembers = AdministrativeExpertmembers::all();
            $programs = OurPrograms::all();
            $Pedagogys = Pedagogy::all();
            $syllabus = Syllabus::all();
            $calendars = AcademicCalendar::all();
            $timetable = AcademicTimetable::all();
            $lectureseries = MonthlyLectureSeries::all();
            $sitefieldvisit = SiteFieldVisits::all();
            $studytour = StudyTour::all();
            $nasas = Nasa::all();
            $Symposium = Symposium::all();
            $exams = EcamcellSections::all();
            $examcontents = ExamcellContents::all();
            $labs = LabsSections::all();
            $labcontents = LabContent::all();
            $library = Library::all();
            $Clubs = Clubs::all();
            $ClubsHedings = ClubsHeding::all();
            return view('pages.submenus', compact('menu', 'submenus', 'psgiaq', 'sections', 'contents','trustee','sons','councils','committees','committeenames','councilmembers','factsandfigures','organizations',
            'messages','faculties','visitors','Designchair','allied','chiefadvisor','expertmembers','adminchiefadvisors','adminexpmembers','programs','Pedagogys','syllabus','calendars','timetable',
            'lectureseries','sitefieldvisit','studytour','nasas','Clubs','ClubsHedings','Symposium','exams','examcontents','labs','labcontents','library'));
    }
    
  
    
                 public function sectionsstore(Request $request)
            {
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                ]);
            
                $core = new Section;
                $core->name = $validatedData['name'];
                $core->save();
            
                return redirect()->back()->with('success', 'Created Successfully.');
            }
            
            public function updateSection(Request $request, $id)
            {
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                ]);
            
                $core = Section::findOrFail($id);
                $core->name = $validatedData['name'];
                $core->save();
            
                return redirect()->back()->with('success', 'Created Successfully.');
            }
            
            public function deleteSection($id)
            {
                $core = Section::find($id);
                if ($core) {
                    $core->delete();
                    return redirect()->back()->with('success', ' Deleted Successfully');
                } else {
                    return response()->json(['error' => 'Section not found'], 404);
                }
            }
            
            public function iaqcontent(Request $request)
            {
                $validatedData = $request->validate([
                    'section_id' => 'required|exists:sections,id',
                    'text' => 'required|array',
                    'text.*' => 'required|string',
                ]);
            
                foreach ($validatedData['text'] as $description) {
                    $core = new ContentSection;
                    $core->section_id = $validatedData['section_id'];
                    $core->text = $description;
                    $core->save();
                }
            
                return redirect()->back()->with('success', ' Created Successfully.');
            }
            
            public function updateiaqcontent(Request $request, $id)
            {
                $validatedData = $request->validate([
                    'section_id' => 'required|exists:sections,id',
                    'text' => 'required|array',
                    'text.*' => 'required|string',
                ]);
            
                // Delete old descriptions for the section
                ContentSection::where('section_id', $id)->delete();
            
                // Save the updated descriptions
                foreach ($validatedData['text'] as $description) {
                    $core = new ContentSection;
                    $core->section_id = $validatedData['section_id'];
                    $core->text = $description;
                    $core->save();
                }
            
                return redirect()->back()->with('success', 'Updated Successfully.');
            }
            
            public function getDescriptions(Request $request)
            {
                $sectionId = $request->input('section_id');
                $descriptions = ContentSection::where('section_id', $sectionId)->pluck('text');
            
                return response()->json($descriptions);
}


        public function psgiaqindex()
        {
            $psgiaq = PsgIaq::all();
            return view('pages.submenus', compact('psgiaq'));
        }
    
        public function PsgIaq(Request $request)
        {
           
            $validatedData = $request->validate([
                'content' => 'required|string',
            ]);
        
         
            $existingContent = PsgIaq::first(); 
        
            if ($existingContent) {
                $existingContent->content = $validatedData['content'];
                $existingContent->save();
            } else {
                PsgIaq::create($validatedData);
            }
            return redirect()->back()->with('success', ' Created Successfully.');
        }
        
        
        public function Trustee(Request $request)
        {
                $validatedData = $request->validate([
                    'name' => 'required|string',
                    'position' => 'required|string',
                    'mobile' => 'required|string',
                    'email' => 'required|email',
                    'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048', 
                    'bg_image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048', 
                    'message' => 'required|string|max:1000000',
                    'author' => 'required|string',
                    'link' => 'required|string',
                    'quote' => 'required|string|max:1000',
                ]);
            
                $trust = TrusteMessage::first();
            
                // Handle image upload
                $validatedData['image'] = $this->handleImageUpload($request, 'image', $trust ? $trust->image : null);
                $validatedData['bg_image'] = $this->handleImageUpload($request, 'bg_image', $trust ? $trust->bg_image : null);
            
                if ($trust) {
                    $trust->update($validatedData);
                } else {
                    TrusteMessage::create($validatedData);
                }
            
                return redirect()->back()->with('success', 'Created Successfully.');
            }
     
        private function handleImageUpload(Request $request, $fieldName, $default = null)
        {
                if ($request->hasFile($fieldName)) {
                    $image = $request->file($fieldName);
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    return $imageName;
                } else {
                    return $default;
                }
            }
            
        public function GoverningCouncil(Request $request)
        {
                $validatedData = $request->validate([
                    'name' => 'required|string',
                    'position' => 'required|string',
                    'mobile' => 'required|string',
                    'email' => 'required|email',
                    'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048', 
                    'message' => 'required|string',
                ]);
            
                $trust = GoverningCouncil::first();
            
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $validatedData['image'] = $imageName;
                } else {
                    if ($trust) {
                        $validatedData['image'] = $trust->image;
                    }
                }
            
                if ($trust) {
                    $trust->update($validatedData);
                } else {
                    GoverningCouncil::create($validatedData);
                }
            
                return redirect()->back()->with('success', 'Created Successfully.');
            }
            
        public function SonsandCharities(Request $request)
        {
           
            $validatedData = $request->validate([
                'link' => 'required|string',
            ]);
        
         
            $links = SonsandCharities::first(); 
        
            if ($links) {
                $links->link = $validatedData['link'];
                $links->save();
            } else {
                SonsandCharities::create($validatedData);
            }
            return redirect()->back()->with('success', 'Created Successfully.');
        }
        
        public function statutorycommittee(Request $request)
        {
           
            $validatedData = $request->validate([
                'committee_content' => 'required|string',
            ]);
        
         
            $committee = StatutoryCommittee::first(); 
        
            if ($committee) {
                $committee->committee_content = $validatedData['committee_content'];
                $committee->save();
            } else {
                StatutoryCommittee::create($validatedData);
            }
            return redirect()->back()->with('success', 'Created Successfully.');
        }
        
        
        public function councilmembers(Request $request)
        {
        
            $validatedData = $request->validate([
                'member_name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'Committee' => 'required|string|max:255',
                'SortId' => 'required|string|max:255',
                

            ]);
        
            $council = new CouncilMembers();
            $council->member_name = $request->input('member_name');
            $council->designation = $request->input('designation');
            $council->Committee = $request->input('Committee');
            $council->SortId = $request->input('SortId');
            $council->save();
        
            return redirect()->back()->with('success', 'Created Successfully.');
        }
        
        public function councilmembersupdate(Request $request, $id)
        {
                $validatedData = $request->validate([
                    'member_name' => 'nullable|string|max:255',
                    'designation' => 'nullable|string|max:255',
                    'Committee' => 'nullable|string|max:255',
                    'SortId' => 'nullable|string|max:255',
                ]);
            
                $council = CouncilMembers::findOrFail($id);
                $council->member_name = $request->input('member_name');
                $council->designation = $request->input('designation');
                $council->Committee = $request->input('Committee');
                $council->SortId = $request->input('SortId');
                $council->save();
            
                return redirect()->back()->with('success', 'Created Successfully.');
            }


        public function councilmembersdestroy($id)
        {
        $council = CouncilMembers::find($id);
        if ($council) {
            $council->delete();
            return redirect()->back()->with('success' , ' Deleted Successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
   
        public function factsandfigures(Request $request)
        {
                $validatedData = $request->validate([
                    'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048', 
                ]);
            
                $facts = FactsandFigure::first();
            
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $validatedData['image'] = $imageName;
                } else {
                    if ($facts) {
                        $validatedData['image'] = $facts->image;
                    }
                }
            
                if ($facts) {
                    $facts->update($validatedData);
                } else {
                    FactsandFigure::create($validatedData);
                }
            
                return redirect()->back()->with('success', 'Created Successfully.');
            }
            
        public function organizationschedule(Request $request)
        {
        
            $validatedData = $request->validate([
                'org_member' => 'required|string|max:255',
                'member_designation' => 'required|string|max:255',
                'member_committee' => 'required|string|max:255',

            ]);
        
            $organizationmember = new OrganizationSchedule();
            $organizationmember->org_member = $request->input('org_member');
            $organizationmember->member_designation = $request->input('member_designation');
            $organizationmember->member_committee = $request->input('member_committee');
            $organizationmember->save();
        
            return redirect()->back()->with('success', 'Section created successfully.');
        }
        
        public function organizationscheduleupdate(Request $request, $id)
        {
                $validatedData = $request->validate([
                'org_member' => 'required|string|max:255',
                'member_designation' => 'required|string|max:255',
                'member_committee' => 'nullable|string|max:255',
                ]);
            
                $organizationmember = OrganizationSchedule::findOrFail($id);
                $organizationmember->org_member = $request->input('org_member');
                $organizationmember->member_designation = $request->input('member_designation');
                $organizationmember->member_committee = $request->input('member_committee');
                $organizationmember->save();
            
                return redirect()->back()->with('success', 'Created Successfully.');
            }
            
        public function organizationscheduledestroy($id)
        {
        $schedule = OrganizationSchedule::find($id);
        if ($schedule) {
            $schedule->delete();
            return redirect()->back()->with('success' , ' Deleted Successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
       
        public function principalmessage(Request $request)
        {
                $validatedData = $request->validate([
                    'name' => 'required|string',
                    'number' => 'required|string',
                    'mail' => 'required|string',
                    'file' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2000048', 
                    'description' => 'required|string',
                    'quotes' => 'required|string',
                    'author' => 'required|string',
                    'team_iap_title' => 'required|string',
                    'team_iap_name' => 'required|string',
                    'team_iap_description' => 'required|string',
                    'team_iap_file' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2000048', 
                    
                ]);
            
                $trust = PrincipalMessage::first();
            
                $validatedData['file'] = $this->handleImageUpload($request, 'file', $trust ? $trust->file : null);
                $validatedData['team_iap_file'] = $this->handleImageUpload($request, 'team_iap_file', $trust ? $trust->team_iap_file : null);
                
            
                if ($trust) {
                    $trust->update($validatedData);
                } else {
                    PrincipalMessage::create($validatedData);
                }
            
                return redirect()->back()->with('success', 'Created Successfully.');
        }
        public function corefaculty(Request $request)
        {
            $validatedData = $request->validate([
                'staff_name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'staff_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = new Corefaculty;
            $core->staff_name = $validatedData['staff_name'];
            $core->designation = $validatedData['designation'];
            $core->description = $validatedData['description'];
        
            if ($request->hasFile('staff_image')) {
                $image = $request->file('staff_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->staff_image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        public function updateCorefaculty(Request $request, $id)
        {
            $validatedData = $request->validate([
                'staff_name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'staff_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = Corefaculty::findOrFail($id);
            $core->staff_name = $validatedData['staff_name'];
            $core->designation = $validatedData['designation'];
            $core->description = $validatedData['description'];
        
            if ($request->hasFile('staff_image')) {
                if ($core->staff_image && file_exists(public_path('faculty/' . $core->staff_image))) {
                    unlink(public_path('faculty/' . $core->staff_image));
                }
                
                $image = $request->file('staff_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->staff_image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated Successfully.');
        }
        
        public function deleteCorefaculty($id)
        {
        $core = Corefaculty::find($id);
        if ($core) {
            $core->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
       
        public function visitingfaculty(Request $request)
        {
            $validatedData = $request->validate([
                'staff_name_1' => 'required|string|max:255',
                'designation_1' => 'required|string|max:255',
                'staff_image_1' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = new Visitingfaculty;
            $core->name = $validatedData['staff_name_1'];
            $core->designation = $validatedData['designation_1'];
        
            if ($request->hasFile('staff_image_1')) {
                $image = $request->file('staff_image_1');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        public function updatevisitingfaculty(Request $request, $id)
        {
            $validatedData = $request->validate([
                'staff_name_1' => 'required|string|max:255',
                'designation_1' => 'required|string|max:255',
                'staff_image_1' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = Visitingfaculty::findOrFail($id);
            $core->name = $validatedData['staff_name_1'];
            $core->designation = $validatedData['designation_1'];
        
            if ($request->hasFile('staff_image_1')) {
                if ($core->image && file_exists(public_path('faculty/' . $core->image))) {
                    unlink(public_path('faculty/' . $core->image));
                }
                
                $image = $request->file('staff_image_1');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        public function deletevisitingfaculty($id)
        {
        $core = Visitingfaculty::find($id);
        if ($core) {
            $core->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
       
        public function designchair(Request $request)
        {
            $validatedData = $request->validate([
                'chair_name' => 'required|string',
                'contact_info' => 'required|string',
                'chair_email' => 'required|string',
                'chair_image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048', 
                'chair_content' => 'required|string',
                'chair_quote' => 'required|string',
                'chair_quote_author' => 'required|string',
            ]);
        
            $trust = DesignChair::first();
        
            // Handle image upload
            $validatedData['chair_image'] = $this->handleImageUpload($request, 'chair_image', $trust ? $trust->chair_image : null);
            
        
            if ($trust) {
                $trust->update($validatedData);
            } else {
                DesignChair::create($validatedData);
            }
        
            return redirect()->back()->with('success', 'Content saved successfully.');
            }
            
            
        public function alliedfaculty(Request $request)
        {
            $validatedData = $request->validate([
                'allfac_name' => 'required|string|max:255',
                'allfac_designation' => 'required|string|max:255',
                'allfac_description' => 'required|string|max:10000',
                'allfac_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = new AlliedFaculty;
            $core->name = $validatedData['allfac_name'];
            $core->designation = $validatedData['allfac_designation'];
            $core->description = $validatedData['allfac_description'];
        
            if ($request->hasFile('allfac_image')) {
                $image = $request->file('allfac_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        public function updatealliedfaculty(Request $request, $id)
        {
            $validatedData = $request->validate([
                'allfac_name' => 'required|string|max:255',
                'allfac_designation' => 'required|string|max:255',
                'allfac_description' => 'required|string|max:10000',
                'allfac_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = AlliedFaculty::findOrFail($id);
            $core->name = $validatedData['allfac_name'];
            $core->designation = $validatedData['allfac_designation'];
            $core->description = $validatedData['allfac_description'];
        
            if ($request->hasFile('allfac_image')) {
                if ($core->image && file_exists(public_path('faculty/' . $core->image))) {
                    unlink(public_path('faculty/' . $core->image));
                }
                
                $image = $request->file('allfac_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
        public function deletealliedfaculty($id)
        {
        $core = AlliedFaculty::find($id);
        if ($core) {
            $core->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
       
       
       public function chiefadvisor(Request $request)
        {
            $validatedData = $request->validate([
                'advisor_name' => 'required|string|max:255',
                'advisor_designation' => 'required|string|max:255',
                'advisor_description' => 'required|string|max:10000',
                'advisor_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = new ChiefAdvisor;
            $core->name = $validatedData['advisor_name'];
            $core->designation = $validatedData['advisor_designation'];
            $core->description = $validatedData['advisor_description'];
        
            if ($request->hasFile('advisor_image')) {
                $image = $request->file('advisor_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        public function updatechiefadvisor(Request $request, $id)
        {
            $validatedData = $request->validate([
                'advisor_name' => 'required|string|max:255',
                'advisor_designation' => 'required|string|max:255',
                'advisor_description' => 'required|string|max:10000',
                'advisor_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = ChiefAdvisor::findOrFail($id);
            $core->name = $validatedData['advisor_name'];
            $core->designation = $validatedData['advisor_designation'];
            $core->description = $validatedData['advisor_description'];
        
            if ($request->hasFile('advisor_image')) {
                if ($core->image && file_exists(public_path('faculty/' . $core->image))) {
                    unlink(public_path('faculty/' . $core->image));
                }
                
                $image = $request->file('advisor_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
        public function deletechiefadvisor($id)
        {
        $core = ChiefAdvisor::find($id);
        if ($core) {
            $core->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }
       
       
       public function expertmember(Request $request)
        {
            $validatedData = $request->validate([
                'expert_member_name' => 'required|string|max:255',
                'expert_member_designation' => 'required|string|max:255',
                'expert_member_description' => 'nullable|string|max:10000',
                'expert_member_Committee' => 'required|string|max:10000',
                'expert_member_image' => 'image|mimes:jpeg,webp,jpg,gif|max:3048',
            ]);
        
            $core = new ExpertMember;
            $core->name = $validatedData['expert_member_name'];
            $core->designation = $validatedData['expert_member_designation'];
            $core->description = $validatedData['expert_member_description'];
            $core->committee = $validatedData['expert_member_Committee'];
        
            if ($request->hasFile('expert_member_image')) {
                $image = $request->file('expert_member_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        
        public function updateexpertmember(Request $request, $id)
        {
            $validatedData = $request->validate([
                'expert_member_name' => 'required|string|max:255',
                'expert_member_designation' => 'required|string|max:255',
                'expert_member_description' => 'nullable|string|max:10000',
                'expert_member_Committee' => 'required|string|max:10000',
                'expert_member_image' => 'image|mimes:jpeg,webp,jpg,gif|max:3048',
            ]);
        
            $core = ExpertMember::findOrFail($id);
            $core->name = $validatedData['expert_member_name'];
            $core->designation = $validatedData['expert_member_designation'];
            $core->description = $validatedData['expert_member_description'];
            $core->committee = $validatedData['expert_member_Committee'];
        
            if ($request->hasFile('expert_member_image')) {
                if ($core->image && file_exists(public_path('faculty/' . $core->image))) {
                    unlink(public_path('faculty/' . $core->image));
                }
                
                $image = $request->file('expert_member_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        public function destroyexpertmember($id)
        {
        $section = ExpertMember::find($id);
        if ($section) {
            $section->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    }
    
    
       public function adminstaffchiefadvisor(Request $request)
        {
            $validatedData = $request->validate([
                'advisor_name_1' => 'required|string|max:255',
                'advisor_designation_1' => 'required|string|max:255',
                'advisor_image_1' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = new AdministrativeChiefAdvisor;
            $core->name = $validatedData['advisor_name_1'];
            $core->designation = $validatedData['advisor_designation_1'];
        
            if ($request->hasFile('advisor_image_1')) {
                $image = $request->file('advisor_image_1');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        
         public function updateadminstaffchiefadvisor(Request $request, $id)
        {
            $validatedData = $request->validate([
                'advisor_name_1' => 'required|string|max:255',
                'advisor_designation_1' => 'required|string|max:255',
                'advisor_image_1' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = AdministrativeChiefAdvisor::findOrFail($id);
            $core->name = $validatedData['advisor_name_1'];
            $core->designation = $validatedData['advisor_designation_1'];
        
            if ($request->hasFile('advisor_image_1')) {
                if ($core->image && file_exists(public_path('faculty/' . $core->image))) {
                    unlink(public_path('faculty/' . $core->image));
                }
                
                $image = $request->file('advisor_image_1');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
          
          
          public function destroyadminstaffchiefadvisor($id)
        {
        $section = AdministrativeChiefAdvisor::find($id);
        if ($section) {
            $section->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    }
    
    
    
    public function adminexpertmember(Request $request)
        {
            $validatedData = $request->validate([
                'admin_expert_member_name' => 'required|string|max:255',
                'admin_expert_member_designation' => 'required|string|max:255',
                'admin_expert_member_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = new AdministrativeExpertmembers;
            $core->name = $validatedData['admin_expert_member_name'];
            $core->designation = $validatedData['admin_expert_member_designation'];
        
            if ($request->hasFile('admin_expert_member_image')) {
                $image = $request->file('admin_expert_member_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        
         public function updateadminexpertmember(Request $request, $id)
        {
            $validatedData = $request->validate([
                'admin_expert_member_name' => 'required|string|max:255',
                'admin_expert_member_designation' => 'required|string|max:255',
                'admin_expert_member_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = AdministrativeExpertmembers::findOrFail($id);
            $core->name = $validatedData['admin_expert_member_name'];
            $core->designation = $validatedData['admin_expert_member_designation'];
        
            if ($request->hasFile('admin_expert_member_image')) {
                if ($core->image && file_exists(public_path('faculty/' . $core->image))) {
                    unlink(public_path('faculty/' . $core->image));
                }
                
                $image = $request->file('admin_expert_member_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('faculty'), $imageName);
                $core->image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
         public function destroyadminexpertmember($id)
        {
            try {
                $expertMember = AdministrativeExpertmembers::findOrFail($id);
                
                // Optional: Delete associated image file if needed
                if ($expertMember->image && file_exists(public_path('faculty/' . $expertMember->image))) {
                    unlink(public_path('faculty/' . $expertMember->image));
                }
                
                $expertMember->delete();
                
                return redirect()->back()->with('success', 'Expert member deleted successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to delete expert member');
            }
        }
    
    
       public function ourprograms(Request $request)
        {
            $validatedData = $request->validate([
                'program' => 'required|string',
            ]);
        
            $committee = OurPrograms::first(); 
        
            if ($committee) {
                $committee->program = $validatedData['program'];
                $committee->save();
            } else {
                OurPrograms::create($validatedData);
            }
            return redirect()->back()->with('success', 'Content saved successfully.');
        }
        
        public function pedagogy(Request $request)
        {
            $validatedData = $request->validate([
                'prog_name' => 'required|string',
                'prog_content' => 'required|string|max:10000', 
                'prog_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
            $core = new Pedagogy;
            $core->prog_name = $validatedData['prog_name'];
            $core->prog_content = $validatedData['prog_content'];
        
            if ($request->hasFile('prog_image')) {
                $image = $request->file('prog_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $core->prog_image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        
        
         public function updatepedagogy(Request $request, $id)
        {
            $validatedData = $request->validate([
                'prog_name' => 'required|string',
                 'prog_content' => 'required|string|max:10000', 
                'prog_image' => 'image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
        
        
            $core = Pedagogy::findOrFail($id);
            $core->prog_name = $validatedData['prog_name'];
            $core->prog_content = $validatedData['prog_content'];
        
            if ($request->hasFile('prog_image')) {
                if ($core->prog_image && file_exists(public_path('images/' . $core->prog_image))) {
                    unlink(public_path('images/' . $core->prog_image));
                }
                
                $image = $request->file('prog_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $core->prog_image = $imageName;
            }
        
            $core->save();
        
            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }
        
        
        
        public function destroypedagogy($id)
        {
        $section = Pedagogy::find($id);
        if ($section) {
            $section->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    }
    
    
    
        public function syllabus(Request $request)
        
            {
        $validatedData = $request->validate([
            'syllabus' => 'required|string',
            'pdf' => 'file|mimes:pdf|max:2048',
        ]);
    
        $downloads = new Syllabus();
        $downloads->syllabus = $request->input('syllabus');
    
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
            $pdfPath = $pdfName;
            $pdf->move(public_path('pdfs'), $pdfName);
            $downloads->pdf = $pdfPath;
        }
    
        $downloads->save();
    
        return redirect()->back()->with('success', 'Section created successfully.');
        }
        
        
        public function syllabusupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'syllabus' => 'required|string',
            'pdf' => 'file|mimes:pdf|max:2048',
        ]);
    
        $download = Syllabus::findOrFail($id);
        $download->syllabus = $request->input('syllabus');
    
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
            $pdfPath = $pdfName;
            $pdf->move(public_path('pdfs'), $pdfName);
            $download->pdf = $pdfPath;
        }
    
        $download->save();
    
        return redirect()->back()->with('success', 'Download updated successfully.');
    }
    
    public function syllabusdelete($id)
    {
        $download = Syllabus::findOrFail($id);
        $download->delete();

        return redirect()->back()->with('success', 'TopBar deleted successfully.');
    }
    
    
    public function academicevent(Request $request)
        {
            $validatedData = $request->validate([
                'event' => 'required|string',
                'date' => 'required|string',
            ]);
        
            $core = new AcademicCalendar;
            $core->event = $validatedData['event'];
            $core->date = $validatedData['date'];
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        
        public function getEvents()
        {
            $calendars = AcademicCalendar::all();
            return response()->json($calendars);
        }


    

    public function timetable(Request $request)
{
    $request->validate([
        'year_from' => 'required|integer',
        'year_to' => 'required|integer',
        'year_1_odd_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_1_even_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_2_odd_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_2_even_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_3_odd_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_3_even_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_4_odd_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_4_even_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_5_odd_pdf' => 'nullable|file|mimes:pdf|max:15000',
        'year_5_even_pdf' => 'nullable|file|mimes:pdf|max:15000',
    ]);

    $timetable = new AcademicTimetable();
    $timetable->year_from = $request->input('year_from');
    $timetable->year_to = $request->input('year_to');

    for ($i = 1; $i <= 5; $i++) {
        if ($request->hasFile("year_{$i}_odd_pdf")) {
            $file = $request->file("year_{$i}_odd_pdf");
            $filename = time() . '_year_' . $i . '_odd.' . $file->getClientOriginalExtension();
            $file->move(public_path('timetables'), $filename);
            $timetable->{"year_{$i}_odd_pdf"} = $filename;
        }

        if ($request->hasFile("year_{$i}_even_pdf")) {
            $file = $request->file("year_{$i}_even_pdf");
            $filename = time() . '_year_' . $i . '_even.' . $file->getClientOriginalExtension();
            $file->move(public_path('timetables'), $filename);
            $timetable->{"year_{$i}_even_pdf"} = $filename;
        }
    }

    $timetable->save();

    return redirect()->back()->with('success', 'Timetable added successfully!');
}

    
    public function updatetimetable(Request $request, $id)
    {
        $timetable = AcademicTimetable::findOrFail($id);
        
        $timetable->year_from = $request->input('year_from');
        $timetable->year_to = $request->input('year_to');
    
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("year_{$i}_odd_pdf")) {
                if ($timetable->{"year_{$i}_odd_pdf"} && file_exists(public_path('timetables/' . $timetable->{"year_{$i}_odd_pdf"}))) {
                    unlink(public_path('timetables/' . $timetable->{"year_{$i}_odd_pdf"}));
                }
                $file = $request->file("year_{$i}_odd_pdf");
                $filename = time() . '_year_' . $i . '_odd.' . $file->getClientOriginalExtension();
                $file->move(public_path('timetables'), $filename);
                $timetable->{"year_{$i}_odd_pdf"} = $filename;
            }
            if ($request->hasFile("year_{$i}_even_pdf")) {
                if ($timetable->{"year_{$i}_even_pdf"} && file_exists(public_path('timetables/' . $timetable->{"year_{$i}_even_pdf"}))) {
                    unlink(public_path('timetables/' . $timetable->{"year_{$i}_even_pdf"}));
                }
                $file = $request->file("year_{$i}_even_pdf");
                $filename = time() . '_year_' . $i . '_even.' . $file->getClientOriginalExtension();
                $file->move(public_path('timetables'), $filename);
                $timetable->{"year_{$i}_even_pdf"} = $filename;
            }
        }
    
        $timetable->save();
    
        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    
    
    public function timetabledelete($id)
    {
        $download = AcademicTimetable::findOrFail($id);
        $download->delete();

        return redirect()->back()->with('success', 'TopBar deleted successfully.');
    }
    
    
     
    public function academiceventupdate(Request $request , $id)
        {
            $validatedData = $request->validate([
                'event' => 'required|string',
                'date' => 'required|string',
            ]);
        
            $core = AcademicCalendar::findOrFail($id);
            $core->event = $validatedData['event'];
            $core->date = $validatedData['date'];
            $core->save();
        
            return redirect()->back()->with('success', 'Menu created successfully.');
        }
        
        
        public function academiceventdelete($id)
    {
        $download = AcademicCalendar::findOrFail($id);
        $download->delete();

        return redirect()->back()->with('success', 'TopBar deleted successfully.');
    }
    
    
        

        
        public function destroysitefieldvisit($id)
        {
        $section = SiteFieldVisits::find($id);
        if ($section) {
            $section->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    }
    
    
    public function monthlylectureseries(Request $request)
    {
        try {
         
            $validatedData = $request->validate([
                'thumbnail' => 'nullable|image|mimes:jpeg,webp,jpg,gif|max:2048',
                'description' => 'required|string',
            ]);
    
            // Additional validation for dynamic image fields
            foreach($request->files as $key => $file) {
                if (preg_match('/^image\d+$/', $key)) {
                    $request->validate([
                        $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                    ]);
                }
            }
    
            $core = new MonthlyLectureSeries();
            $core->description = $validatedData['description'];
    
            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('images'), $thumbnailName);
                $core->thumbnail = $thumbnailName;
            }
    
            // Handle multiple image uploads
            $filesProcessed = [];
            foreach ($request->files as $key => $file) {
                if (preg_match('/^image(\d+)$/', $key, $matches)) {
                    $imageNumber = $matches[1];
                    $image = $request->file($key);
                    $imageName = 'image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $core->{"image" . $imageNumber} = $imageName;
                    $filesProcessed[] = $key;
                }
            }
    
            $core->save();
    
            return redirect()->back()->with('success', 'Monthly Lecture Series created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error in monthlylectureseries: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating Monthly Lecture Series: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    public function updateMonthlyLectureSeries(Request $request, $id)
    {
        try {
            // Validate the base fields
            $validatedData = $request->validate([
                'description' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,webp,jpg,gif|max:2048',
            ]);
    
            // Additional validation for dynamic image fields
            foreach($request->files as $key => $file) {
                if (preg_match('/^image\d+$/', $key)) {
                    $request->validate([
                        $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                    ]);
                }
            }
    
            $series = MonthlyLectureSeries::findOrFail($id);
            $series->description = $validatedData['description'];
    
            // Handle thumbnail
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail if exists
                if ($series->thumbnail && file_exists(public_path('images/' . $series->thumbnail))) {
                    unlink(public_path('images/' . $series->thumbnail));
                }
                
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('images'), $thumbnailName);
                $series->thumbnail = $thumbnailName;
            }
    
            // Handle remove thumbnail
            if ($request->has('remove_thumbnail')) {
                if ($series->thumbnail && file_exists(public_path('images/' . $series->thumbnail))) {
                    unlink(public_path('images/' . $series->thumbnail));
                }
                $series->thumbnail = null;
            }
    
            // Handle multiple images
            foreach ($request->files as $key => $file) {
                if (preg_match('/^image(\d+)$/', $key, $matches)) {
                    $imageNumber = $matches[1];
                    $imageKey = "image" . $imageNumber;
                    
                    // Delete old image if exists
                    if ($series->$imageKey && file_exists(public_path('images/' . $series->$imageKey))) {
                        unlink(public_path('images/' . $series->$imageKey));
                    }
    
                    $image = $request->file($key);
                    $imageName = 'image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $series->$imageKey = $imageName;
                }
            }
    
            // Handle image removals
            for ($i = 1; $i <= 30; $i++) {
                $removeKey = 'remove_image' . $i;
                if ($request->has($removeKey)) {
                    $imageKey = 'image' . $i;
                    if ($series->$imageKey && file_exists(public_path('images/' . $series->$imageKey))) {
                        unlink(public_path('images/' . $series->$imageKey));
                    }
                    $series->$imageKey = null;
                }
            }
    
            $series->save();
    
            return redirect()->back()->with('success', 'Monthly Lecture Series updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error in updateMonthlyLectureSeries: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating Monthly Lecture Series: ' . $e->getMessage())
                ->withInput();
        }

    }
    
    
    public function destroymonthlylectureseries($id)
    {
        $section = MonthlyLectureSeries::find($id);
        if ($section) {

            if ($section->thumbnail && file_exists(public_path('images/' . $section->thumbnail))) {
                unlink(public_path('images/' . $section->thumbnail));
            }
            
            for ($i = 1; $i <= 30; $i++) {
                $imageKey = 'image' . $i;
                if ($section->$imageKey && file_exists(public_path('images/' . $section->$imageKey))) {
                    unlink(public_path('images/' . $section->$imageKey));
                }
            }
            
            $section->delete();
            return redirect()->back()->with('success', 'Section deleted successfully');
        }
        
        return response()->json(['error' => 'Section not found'], 404);
    }
    

            
    
        public function studytour(Request $request)
        {
            try {
                \Log::info('StudyTour request data:', $request->all());
                
                // Validate the request
                $validatedData = $request->validate([
                    'thumbnail' => 'required|image|mimes:jpeg,webp,jpg,gif|max:2048',
                    'description' => 'required|string',
                ]);
        
                // Validate additional images dynamically
                foreach ($request->files as $key => $file) {
                    if (preg_match('/^image\d+$/', $key)) {
                        $request->validate([
                            $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                        ]);
                    }
                }
        
                // Create new StudyTour instance
                $studytour = new StudyTour();
                $studytour->description = $validatedData['description'];
        
                // Handle thumbnail upload
                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $request->file('thumbnail');
                    $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                    $thumbnail->move(public_path('images'), $thumbnailName);
                    $studytour->thumbnail = $thumbnailName;
                }
        
                // Handle multiple image uploads
                foreach ($request->files as $key => $file) {
                    if (preg_match('/^image(\d+)$/', $key, $matches)) {
                        $imageNumber = $matches[1];
                        $image = $request->file($key);
                        $imageName = 'study_tour_image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $imageName);
                        $studytour->{"image" . $imageNumber} = $imageName;
                    }
                }
        
                // Save study tour
                $studytour->save();
        
                return redirect()->back()->with('success', 'Study Tour created successfully.');
            } catch (\Exception $e) {
                \Log::error('Error in studytour: ' . $e->getMessage());
                \Log::error('Stack trace: ' . $e->getTraceAsString());
                return redirect()->back()
                    ->with('error', 'Error creating Study Tour: ' . $e->getMessage())
                    ->withInput();
            }
        }
        
        
        public function sitefieldvisit(Request $request)
        {
                    try {
                        \Log::info('SiteFieldVisit request data:', $request->all());
            
                        // Validate the request
                        $validatedData = $request->validate([
                            'thumbnail' => 'required|image|mimes:jpeg,webp,jpg,gif|max:2048',
                            'description' => 'required|string',
                        ]);
            
                        // Validate additional images dynamically
                        foreach ($request->files as $key => $file) {
                            if (preg_match('/^image\d+$/', $key)) {
                                $request->validate([
                                    $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                                ]);
                            }
                        }
            
                        // Create new SiteFieldVisit instance
                        $sitefieldvisit = new SiteFieldVisits();
                        $sitefieldvisit->description = $validatedData['description'];
            
                        // Handle thumbnail upload
                        if ($request->hasFile('thumbnail')) {
                            $thumbnail = $request->file('thumbnail');
                            $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                            $thumbnail->move(public_path('images'), $thumbnailName);
                            $sitefieldvisit->thumbnail = $thumbnailName;
                        }
            
                        // Handle multiple image uploads dynamically (image1, image2, etc.)
                        foreach ($request->files as $key => $file) {
                            if (preg_match('/^image(\d+)$/', $key, $matches)) {
                                $imageNumber = $matches[1];
                                $image = $request->file($key);
                                $imageName = 'site_field_visit_image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                                $image->move(public_path('images'), $imageName);
                                $sitefieldvisit->{"image" . $imageNumber} = $imageName;
                            }
                        }
            
                        // Save SiteFieldVisit instance
                        $sitefieldvisit->save();
            
                        return redirect()->back()->with('success', 'Site Field Visit created successfully.');
                    } catch (\Exception $e) {
                        \Log::error('Error in sitefieldvisit: ' . $e->getMessage());
                        \Log::error('Stack trace: ' . $e->getTraceAsString());
            
                        return redirect()->back()
                            ->with('error', 'Error creating Site Field Visit: ' . $e->getMessage())
                            ->withInput();
                    }
                }

        public function updatesitefieldvisit(Request $request, $id)
        {
            try {
           
                $validatedData = $request->validate([
                    'description' => 'required|string',
                    'thumbnail' => 'nullable|image|mimes:jpeg,webp,jpg,gif|max:2048',
                ]);
        
                // Additional validation for dynamic image fields
                foreach($request->files as $key => $file) {
                    if (preg_match('/^image\d+$/', $key)) {
                        $request->validate([
                            $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                        ]);
                    }
                }
        
                $sitefieldvisit = SiteFieldVisits::findOrFail($id);
                $sitefieldvisit->description = $validatedData['description'];
        
                // Handle thumbnail
                if ($request->hasFile('thumbnail')) {
                    // Delete old thumbnail if exists
                    if ($sitefieldvisit->thumbnail && file_exists(public_path('images/' . $sitefieldvisit->thumbnail))) {
                        unlink(public_path('images/' . $sitefieldvisit->thumbnail));
                    }
        
                    $thumbnail = $request->file('thumbnail');
                    $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                    $thumbnail->move(public_path('images'), $thumbnailName);
                    $sitefieldvisit->thumbnail = $thumbnailName;
                }
        
                // Handle remove thumbnail
                if ($request->has('remove_thumbnail')) {
                    if ($sitefieldvisit->thumbnail && file_exists(public_path('images/' . $sitefieldvisit->thumbnail))) {
                        unlink(public_path('images/' . $sitefieldvisit->thumbnail));
                    }
                    $sitefieldvisit->thumbnail = null;
                }
        
                // Handle multiple images
                foreach ($request->files as $key => $file) {
                    if (preg_match('/^image(\d+)$/', $key, $matches)) {
                        $imageNumber = $matches[1];
                        $imageKey = "image" . $imageNumber;
        
                        // Delete old image if exists
                        if ($sitefieldvisit->$imageKey && file_exists(public_path('images/' . $sitefieldvisit->$imageKey))) {
                            unlink(public_path('images/' . $sitefieldvisit->$imageKey));
                        }
        
                        $image = $request->file($key);
                        $imageName = 'image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $imageName);
                        $sitefieldvisit->$imageKey = $imageName;
                    }
                }
        
                // Handle image removals
                for ($i = 1; $i <= 30; $i++) {
                    $removeKey = 'remove_image' . $i;
                    if ($request->has($removeKey)) {
                        $imageKey = 'image' . $i;
                        if ($sitefieldvisit->$imageKey && file_exists(public_path('images/' . $sitefieldvisit->$imageKey))) {
                            unlink(public_path('images/' . $sitefieldvisit->$imageKey));
                        }
                        $sitefieldvisit->$imageKey = null;
                    }
                }
        
                // Save the SiteFieldVisit
                $sitefieldvisit->save();
        
                return redirect()->back()->with('success', 'Site Field Visit updated successfully.');
            } catch (\Exception $e) {
                \Log::error('Error in updateSiteFieldVisit: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Error updating Site Field Visit: ' . $e->getMessage())
                    ->withInput();
            }
        }


        


    
    
        public function updatestudytour(Request $request, $id)
            {
                    try {
                        // Validate the base fields
                        $validatedData = $request->validate([
                            'description' => 'required|string',
                            'thumbnail' => 'nullable|image|mimes:jpeg,webp,jpg,gif|max:2048',
                        ]);
                
                        // Additional validation for dynamic image fields
                        foreach($request->files as $key => $file) {
                            if (preg_match('/^image\d+$/', $key)) {
                                $request->validate([
                                    $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                                ]);
                            }
                        }
                
                        $series = StudyTour::findOrFail($id);
                        $series->description = $validatedData['description'];
                
                        // Handle thumbnail
                        if ($request->hasFile('thumbnail')) {
                            // Delete old thumbnail if exists
                            if ($series->thumbnail && file_exists(public_path('images/' . $series->thumbnail))) {
                                unlink(public_path('images/' . $series->thumbnail));
                            }
                            
                            $thumbnail = $request->file('thumbnail');
                            $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                            $thumbnail->move(public_path('images'), $thumbnailName);
                            $series->thumbnail = $thumbnailName;
                        }
                
                        // Handle remove thumbnail
                        if ($request->has('remove_thumbnail')) {
                            if ($series->thumbnail && file_exists(public_path('images/' . $series->thumbnail))) {
                                unlink(public_path('images/' . $series->thumbnail));
                            }
                            $series->thumbnail = null;
                        }
                
                        // Handle multiple images
                        foreach ($request->files as $key => $file) {
                            if (preg_match('/^image(\d+)$/', $key, $matches)) {
                                $imageNumber = $matches[1];
                                $imageKey = "image" . $imageNumber;
                                
                                // Delete old image if exists
                                if ($series->$imageKey && file_exists(public_path('images/' . $series->$imageKey))) {
                                    unlink(public_path('images/' . $series->$imageKey));
                                }
                
                                $image = $request->file($key);
                                $imageName = 'image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                                $image->move(public_path('images'), $imageName);
                                $series->$imageKey = $imageName;
                            }
                        }
                
                        // Handle image removals
                        for ($i = 1; $i <= 30; $i++) {
                            $removeKey = 'remove_image' . $i;
                            if ($request->has($removeKey)) {
                                $imageKey = 'image' . $i;
                                if ($series->$imageKey && file_exists(public_path('images/' . $series->$imageKey))) {
                                    unlink(public_path('images/' . $series->$imageKey));
                                }
                                $series->$imageKey = null;
                            }
                        }
                
                        $series->save();
                
                        return redirect()->back()->with('success', 'Monthly Lecture Series updated successfully.');
                    } catch (\Exception $e) {
                        \Log::error('Error in updateMonthlyLectureSeries: ' . $e->getMessage());
                        return redirect()->back()
                            ->with('error', 'Error updating Monthly Lecture Series: ' . $e->getMessage())
                            ->withInput();
                    }
            
                }
    

        
        public function destroystudytour($id)
        {
        $section = StudyTour::find($id);
        if ($section) {
            $section->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    }
    
        public function nasan(Request $request)
    {
        try {
            \Log::info('StudyTour request data:', $request->all());
            

            $validatedData = $request->validate([
                'thumbnail' => 'required|image|mimes:jpeg,webp,jpg,gif|max:2048',
                'description' => 'required|string',
            ]);

            foreach ($request->files as $key => $file) {
                if (preg_match('/^image\d+$/', $key)) {
                    $request->validate([
                        $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                    ]);
                }
            }
    
            $nasa = new Nasa();
            $nasa->description = $validatedData['description'];
    
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('images'), $thumbnailName);
                $nasa->thumbnail = $thumbnailName;
            }

            foreach ($request->files as $key => $file) {
                if (preg_match('/^image(\d+)$/', $key, $matches)) {
                    $imageNumber = $matches[1];
                    $image = $request->file($key);
                    $imageName = 'study_tour_image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $nasa->{"image" . $imageNumber} = $imageName;
                }
            }

            $nasa->save();
    
            return redirect()->back()->with('success', 'Study Tour created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error in studytour: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->with('error', 'Error creating Study Tour: ' . $e->getMessage())
                ->withInput();
        }
    }
    

    public function updateNasa(Request $request, $id)
    {
            try {
    
                $validatedData = $request->validate([
                    'description' => 'required|string',
                    'thumbnail' => 'nullable|image|mimes:jpeg,webp,jpg,gif|max:2048',
                ]);
        
                // Additional validation for dynamic image fields
                foreach($request->files as $key => $file) {
                    if (preg_match('/^image\d+$/', $key)) {
                        $request->validate([
                            $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                        ]);
                    }
                }
        
                $nasa = Nasa::findOrFail($id);
                $nasa->description = $validatedData['description'];
        
                // Handle thumbnail
                if ($request->hasFile('thumbnail')) {
                    // Delete old thumbnail if exists
                    if ($nasa->thumbnail && file_exists(public_path('images/' . $nasa->thumbnail))) {
                        unlink(public_path('images/' . $nasa->thumbnail));
                    }
                    
                    $thumbnail = $request->file('thumbnail');
                    $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                    $thumbnail->move(public_path('images'), $thumbnailName);
                    $nasa->thumbnail = $thumbnailName;
                }
        
                // Handle remove thumbnail
                if ($request->has('remove_thumbnail')) {
                    if ($nasa->thumbnail && file_exists(public_path('images/' . $nasa->thumbnail))) {
                        unlink(public_path('images/' . $nasa->thumbnail));
                    }
                    $nasa->thumbnail = null;
                }
        
                // Handle multiple images
                foreach ($request->files as $key => $file) {
                    if (preg_match('/^image(\d+)$/', $key, $matches)) {
                        $imageNumber = $matches[1];
                        $imageKey = "image" . $imageNumber;
                        
                        // Delete old image if exists
                        if ($nasa->$imageKey && file_exists(public_path('images/' . $nasa->$imageKey))) {
                            unlink(public_path('images/' . $nasa->$imageKey));
                        }
        
                        $image = $request->file($key);
                        $imageName = 'image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $imageName);
                        $nasa->$imageKey = $imageName;
                    }
                }
        
                // Handle image removals
                for ($i = 1; $i <= 30; $i++) {
                    $removeKey = 'remove_image' . $i;
                    if ($request->has($removeKey)) {
                        $imageKey = 'image' . $i;
                        if ($nasa->$imageKey && file_exists(public_path('images/' . $nasa->$imageKey))) {
                            unlink(public_path('images/' . $nasa->$imageKey));
                        }
                        $nasa->$imageKey = null;
                    }
                }
        
                $nasa->save();
        
                return redirect()->back()->with('success', 'Monthly Lecture Series updated successfully.');
            } catch (\Exception $e) {
                \Log::error('Error in updateMonthlyLectureSeries: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Error updating Monthly Lecture Series: ' . $e->getMessage())
                    ->withInput();
            }
    
        }

        public function destroynasa($id)
            {
            $nasa = Nasa::find($id);
            if ($nasa) {
                $nasa->delete();
                return redirect()->back()->with('success' , 'Section deleted successfully');
            } else {
                return response()->json(['error' => 'Section not found'], 404);
            }
        }
  
        
   
        
        public function Symposium(Request $request)
        {
            try {
                \Log::info('StudyTour request data:', $request->all());
                
    
                $validatedData = $request->validate([
                    'thumbnail' => 'required|image|mimes:jpeg,webp,jpg,gif|max:2048',
                    'description' => 'required|string',
                ]);
    
                foreach ($request->files as $key => $file) {
                    if (preg_match('/^image\d+$/', $key)) {
                        $request->validate([
                            $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                        ]);
                    }
                }
        
                $symposium = new Symposium();
                $symposium->description = $validatedData['description'];
        
                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $request->file('thumbnail');
                    $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                    $thumbnail->move(public_path('images'), $thumbnailName);
                    $symposium->thumbnail = $thumbnailName;
                }
    
                foreach ($request->files as $key => $file) {
                    if (preg_match('/^image(\d+)$/', $key, $matches)) {
                        $imageNumber = $matches[1];
                        $image = $request->file($key);
                        $imageName = 'study_tour_image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $imageName);
                        $symposium->{"image" . $imageNumber} = $imageName;
                    }
                }
    
                $symposium->save();
        
                return redirect()->back()->with('success', 'Study Tour created successfully.');
            } catch (\Exception $e) {
                \Log::error('Error in studytour: ' . $e->getMessage());
                \Log::error('Stack trace: ' . $e->getTraceAsString());
                return redirect()->back()
                    ->with('error', 'Error creating Study Tour: ' . $e->getMessage())
                    ->withInput();
            }
        }


        public function updateSymposium(Request $request, $id){

            try {
    
                $validatedData = $request->validate([
                    'description' => 'required|string',
                    'thumbnail' => 'nullable|image|mimes:jpeg,webp,jpg,gif|max:2048',
                ]);
        
                foreach($request->files as $key => $file) {
                    if (preg_match('/^image\d+$/', $key)) {
                        $request->validate([
                            $key => 'image|mimes:jpeg,webp,jpg,gif|max:2048'
                        ]);
                    }
                }
        
                $symposium = Symposium::findOrFail($id);
                $symposium->description = $validatedData['description'];
        
                if ($request->hasFile('thumbnail')) {
            
                    if ($symposium->thumbnail && file_exists(public_path('images/' . $symposium->thumbnail))) {
                        unlink(public_path('images/' . $symposium->thumbnail));
                    }
                    
                    $thumbnail = $request->file('thumbnail');
                    $thumbnailName = 'thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                    $thumbnail->move(public_path('images'), $thumbnailName);
                    $symposium->thumbnail = $thumbnailName;
                }
        

                if ($request->has('remove_thumbnail')) {
                    if ($symposium->thumbnail && file_exists(public_path('images/' . $symposium->thumbnail))) {
                        unlink(public_path('images/' . $symposium->thumbnail));
                    }
                    $symposium->thumbnail = null;
                }
        
                foreach ($request->files as $key => $file) {
                    if (preg_match('/^image(\d+)$/', $key, $matches)) {
                        $imageNumber = $matches[1];
                        $imageKey = "image" . $imageNumber;
                        
                        if ($symposium->$imageKey && file_exists(public_path('images/' . $symposium->$imageKey))) {
                            unlink(public_path('images/' . $symposium->$imageKey));
                        }
        
                        $image = $request->file($key);
                        $imageName = 'image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $imageName);
                        $symposium->$imageKey = $imageName;
                    }
                }
        
                for ($i = 1; $i <= 30; $i++) {
                    $removeKey = 'remove_image' . $i;
                    if ($request->has($removeKey)) {
                        $imageKey = 'image' . $i;
                        if ($symposium->$imageKey && file_exists(public_path('images/' . $symposium->$imageKey))) {
                            unlink(public_path('images/' . $symposium->$imageKey));
                        }
                        $symposium->$imageKey = null;
                    }
                }
        
                $symposium->save();
        
                return redirect()->back()->with('success', 'Monthly Lecture Series updated successfully.');
            } catch (\Exception $e) {
                \Log::error('Error in updateMonthlyLectureSeries: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Error updating Monthly Lecture Series: ' . $e->getMessage())
                    ->withInput();
            }
    
        }


        public function destroySymposium($id)
            {
            $symposium = Symposium::find($id);
            if ($symposium) {
                $symposium->delete();
                return redirect()->back()->with('success' , 'Section deleted successfully');
            } else {
                return response()->json(['error' => 'Section not found'], 404);
            }
        }

    
    
    
    public function examsectionsstore(Request $request)
            {
                $validatedData = $request->validate([
                    'exam_name' => 'required|string|max:255',
                ]);
            
                $core = new EcamcellSections;
                $core->exam_name = $validatedData['exam_name'];
                $core->save();
            
                return redirect()->back()->with('success', 'Menu created successfully.');
            }
            
            public function updateexamSection(Request $request, $id)
            {
                $validatedData = $request->validate([
                    'exam_name' => 'required|string|max:255',
                ]);
            
                $core = EcamcellSections::findOrFail($id);
                $core->exam_name = $validatedData['exam_name'];
                $core->save();
            
                return redirect()->back()->with('success', 'Core faculty updated successfully.');
            }
            
            public function deleteexamSection($id)
            {
                $core = EcamcellSections::find($id);
                if ($core) {
                    $core->delete();
                    return redirect()->back()->with('success', 'Section deleted successfully');
                } else {
                    return response()->json(['error' => 'Section not found'], 404);
                }
            }
            
            public function examcontent(Request $request)
            {
                $validatedData = $request->validate([
                    'exam_id' => 'required|exists:examcell_sections,id',
                    'text' => 'required|array',
                    'text.*' => 'required|string',
                ]);
            
                foreach ($validatedData['text'] as $description) {
                    $core = new ExamcellContents;
                    $core->exam_id = $validatedData['exam_id'];
                    $core->text = $description;
                    $core->save();
                }
            
                return redirect()->back()->with('success', 'Menu created successfully.');
            }
            
            public function updateexamcontent(Request $request, $id)
            {
                $validatedData = $request->validate([
                    'exam_id' => 'required|exists:examcell_sections,id',
                    'text' => 'required|array',
                    'text.*' => 'required|string',
                ]);
            
                // Delete old descriptions for the section
                ExamcellContents::where('exam_id', $id)->delete();
            
                // Save the updated descriptions
                foreach ($validatedData['text'] as $description) {
                    $core = new ExamcellContents;
                    $core->exam_id = $validatedData['exam_id'];
                    $core->text = $description;
                    $core->save();
                }
            
                return redirect()->back()->with('success', 'Section updated successfully.');
            }
            
            public function getexamDescriptions(Request $request)
            {
                $sectionId = $request->input('exam_id');
                $descriptions = ExamcellContents::where('exam_id', $sectionId)->pluck('text');
            
                return response()->json($descriptions);
}


    public function labssectionsstore(Request $request)
            {
                $validatedData = $request->validate([
                    'lab_name' => 'required|string|max:255',
                ]);
            
                $core = new LabsSections;
                $core->lab_name = $validatedData['lab_name'];
                $core->save();
            
                return redirect()->back()->with('success', 'Menu created successfully.');
            }
            
            public function updatelabsSection(Request $request, $id)
            {
                $validatedData = $request->validate([
                    'lab_name' => 'required|string|max:255',
                ]);
            
                $core = LabsSections::findOrFail($id);
                $core->lab_name = $validatedData['lab_name'];
                $core->save();
            
                return redirect()->back()->with('success', 'Core faculty updated successfully.');
            }
            
            public function deletelabsSection($id)
            {
                $core = LabsSections::find($id);
                if ($core) {
                    $core->delete();
                    return redirect()->back()->with('success', 'Section deleted successfully');
                } else {
                    return response()->json(['error' => 'Section not found'], 404);
                }
            }
            
            public function labscontent(Request $request)
            {
                $validatedData = $request->validate([
                    'lab_id' => 'required|exists:labs_sections,id',
                    'description' => 'required|array',
                    'description.*' => 'required|string',
                ]);
            
                foreach ($validatedData['description'] as $description) {
                    $core = new LabContent;
                    $core->lab_id = $validatedData['lab_id'];
                    $core->description = $description;
                    $core->save();
                }
            
                return redirect()->back()->with('success', 'Menu created successfully.');
            }
            
            public function updatelabscontent(Request $request, $id)
            {
                $validatedData = $request->validate([
                    'exam_id' => 'required|exists:labs_sections,id',
                    'description' => 'required|array',
                    'description.*' => 'required|string',
                ]);
            
                // Delete old descriptions for the section
                LabContent::where('lab_id', $id)->delete();
            
                // Save the updated descriptions
                foreach ($validatedData['description'] as $description) {
                    $core = new LabContent;
                    $core->lab_id = $validatedData['lab_id'];
                    $core->description = $description;
                    $core->save();
                }
            
                return redirect()->back()->with('success', 'Section updated successfully.');
            }
            
            public function getlabsDescriptions(Request $request)
                {
                    $sectionId = $request->input('lab_id');
                    $descriptions = LabContent::where('lab_id', $sectionId)->pluck('description');
                
                    return response()->json($descriptions);
                }
                
                
        public function library_store(Request $request)
            {
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                ]);
    
                $core = new Library;
                $core->name = $validatedData['name'];
                $core->save();
    
                return redirect()->back()->with('success', 'Menu created successfully.');
            }
    

        public function  library_update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $core = Library::findOrFail($id);
            $core->name = $validatedData['name'];
            $core->save();

            return redirect()->back()->with('success', 'Core faculty updated successfully.');
        }


        public function library_delete($id)
        {
        $core = Library::find($id);
        if ($core) {
            $core->delete();
            return redirect()->back()->with('success' , 'Section deleted successfully');
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
       }

       public function library_content(Request $request)
       {
           $validatedData = $request->validate([
               'section_id' => 'required|exists:library,id',
               'description' => 'required|array',
               'description.*' => 'required|string',
           ]);

           foreach ($validatedData['description'] as $description) {
               $core = new libraysections;
               $core->section_id = $validatedData['section_id'];
               $core->description = $description;
               $core->save();
           }

           return redirect()->back()->with('success', 'Descriptions saved successfully.');
       }


public function updateiqaccontent(Request $request, $id)
{
    $validatedData = $request->validate([
        'section_id' => 'required|exists:library,id',
        'description' => 'required|array|min:1',
        'description.*' => 'required|string|distinct', // Enforce unique descriptions in request
    ]);

    // Delete previous descriptions
    libraysections::where('section_id', $id)->delete();

    foreach (array_unique($validatedData['description']) as $description) {
        libraysections::create([
            'section_id' => $validatedData['section_id'],
            'description' => $description,
        ]);
    }

    return redirect()->back()->with('success', 'Section updated successfully.');
}

       public function getSectionDescriptions(Request $request)
       {
           $sectionId = $request->input('section_id');
           $descriptions = libraysections::where('section_id', $sectionId)->pluck('description');
           return response()->json($descriptions);
       }


    
  
        //   public function committeename(Request $request)
        // {
        //     $request->validate([
        //         'committee_name' => 'required|string|max:255',
        //         'member_name.*' => 'required|string|max:255',
        //         'designation.*' => 'required|string|max:255',
        //         'committee.*' => 'required|string|max:255',
        //         'email.*' => 'nullable|string|max:255',
        //         'phone.*' => 'nullable|string|max:255',
        //         'pdf' => 'nullable|file|mimes:webp|max:5000',
        //     ]);
        
        //     $pdfPath = null;
        
        //     if ($request->hasFile('pdf')) {
        //         $pdf = $request->file('pdf');
        //         $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
        //         $pdfPath = $pdfName; 
        //         $pdf->move(public_path('images'), $pdfName); 
        //     }
        
        //     // Create the committee
        //     $committee = CommitteeName::create([
        //         'committee_name' => $request->committee_name,
        //         'pdf' => $pdfPath,
        //     ]);
        
        //     // Loop through members and create CommitteeMember entries
        //     foreach ($request->member_name as $index => $memberName) {
        //         CommitteeMember::create([
        //             'committee_id' => $committee->id,
        //             'member_name' => $memberName,
        //             'designation' => $request->designation[$index],
        //             'committee' => $request->committee[$index],
        //         ]);
        //     }
        
        //     return redirect()->back()->with('success', 'Committee and members added successfully!');
        // }

        public function committeename(Request $request)
{
    $validatedData = $request->validate([
        'committee_name' => 'required|string|max:255',
        'member_name' => 'required|array',
        'designation' => 'required|array',
        'committee' => 'required|array',
        'member_name.*' => 'required|string|max:255',
        'designation.*' => 'required|string|max:255',
        'committee.*' => 'required|string|max:255',
        'email.*' => 'nullable|string|max:255',
        'phone.*' => 'nullable|string|max:255',
        'pdf' => 'nullable|file|mimes:webp|max:5000',
    ]);

    // Ensure all member-related fields have the same number of entries
    if (
        count($request->member_name) !== count($request->designation) ||
        count($request->member_name) !== count($request->committee)
    ) {
        return redirect()->back()->withErrors(['error' => 'All member-related fields must have the same number of entries.']);
    }

    // Create a new committee
    $committee = new CommitteeName();
    $committee->committee_name = $request->input('committee_name');

    // Handle PDF upload if provided
    if ($request->hasFile('pdf')) {
        $pdfName = time() . '.' . $request->file('pdf')->getClientOriginalExtension();
        $request->file('pdf')->move(public_path('images'), $pdfName);
        $committee->pdf = $pdfName;
    }
    $committee->save();

    // Store committee members
    foreach ($request->member_name as $index => $memberName) {
        if (!isset($request->designation[$index]) || !isset($request->committee[$index])) {
            continue; 
        }

        $member = new CommitteeMember();
        $member->committee_id = $committee->id;
        $member->member_name = $memberName;
        $member->designation = $request->designation[$index];
        $member->committee = $request->committee[$index];
        $member->email = $request->email[$index] ?? null;
        $member->phone = $request->phone[$index] ?? null;
        $member->save();
    }

    return redirect()->back()->with('success', 'Committee and members added successfully!');
}

        
        public function committeenameupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'committee_name' => 'required|string|max:255',
            'member_name' => 'required|array',
            'designation' => 'required|array',
            'committee' => 'required|array',
            'member_ids' => 'nullable|array',
            'member_name.*' => 'required|string|max:255',
            'designation.*' => 'required|string|max:255',
            'committee.*' => 'required|string|max:255',
            'email.*' => 'nullable|string|max:255',
            'phone.*' => 'nullable|string|max:255',
            'pdf' => 'nullable|file|mimes:webp|max:5000',
            'deleted_members' => 'nullable|array', // Add this for deleted members
        ]);
    
        // Ensure all fields have the same number of entries
        if (
            count($request->member_name) !== count($request->designation) ||
            count($request->member_name) !== count($request->committee)
        ) {
            return redirect()->back()->withErrors(['error' => 'All member-related fields must have the same number of entries.']);
        }
    
        // Find and update the committee
        $committee = CommitteeName::findOrFail($id);
        $committee->committee_name = $request->input('committee_name');
    
        // Handle PDF upload and replace if exists
        if ($request->hasFile('pdf')) {
            if ($committee->pdf && file_exists(public_path('images/' . $committee->pdf))) {
                unlink(public_path('images/' . $committee->pdf));
            }
    
            $pdfName = time() . '.' . $request->file('pdf')->getClientOriginalExtension();
            $request->file('pdf')->move(public_path('images'), $pdfName);
            $committee->pdf = $pdfName;
        }
        $committee->save();
    
        // **Handle Deleted Members**
        if ($request->has('deleted_members')) {
            CommitteeMember::whereIn('id', $request->deleted_members)->delete(); // Permanently delete members
        }
    
        // **Update or Add Members**
        foreach ($request->member_name as $index => $memberName) {
            if (!isset($request->designation[$index]) || !isset($request->committee[$index])) {
                continue;
            }
    
            $member = isset($request->member_ids[$index])
                ? CommitteeMember::find($request->member_ids[$index])
                : new CommitteeMember();
    
            if (!$member) {
                $member = new CommitteeMember();
            }
    
            $member->committee_id = $committee->id;
            $member->member_name = $memberName;
            $member->designation = $request->designation[$index];
            $member->committee = $request->committee[$index];
            $member->email = $request->email[$index] ?? null;
            $member->phone = $request->phone[$index] ?? null;
            $member->save();
        }
    
        return redirect()->back()->with('success', 'Committee and members updated successfully!');
    }

        
        public function committeenamedestroy($id)
        {
            $committee = CommitteeName::find($id);
        
            if ($committee) {
              
                if ($committee->pdf && file_exists(public_path($committee->pdf))) {
                    unlink(public_path($committee->pdf));
                }
        
            
                $committee->members()->delete();
        
                $committee->delete();
        
                return redirect()->back()->with('success', 'Committee deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Committee not found.');
            }
        }
        
        
        
        
public function deleteMember($id)
{
    $member = CommitteeMember::find($id);

    if (!$member) {
        return response()->json(['success' => false, 'message' => 'Member not found'], 404);
    }

    $member->delete();

    return response()->json(['success' => true, 'message' => 'Member deleted successfully']);
}
        

    
        public function clubs(Request $request)
        {
     
            $validatedData = $request->validate([
                'clubs_id' => 'required|exists:clubs_heading,id',
                'thumbnail' => 'nullable|image|mimes:jpeg,webp|max:2048',
                'description' => 'required|string',
            ]);
        
 
            foreach ($request->files as $key => $file) {
                if (preg_match('/^image\d+$/', $key)) {
                    $request->validate([
                        $key => 'image|mimes:jpeg,webp|max:3048',
                    ]);
                }
            }
        
            $club = new Clubs();
            $club->description = $validatedData['description'];
            $club->clubs_id = $validatedData['clubs_id'];
        
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'club_thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('images/'), $thumbnailName);
                $club->thumbnail = $thumbnailName;
            }
        
            foreach ($request->files as $key => $file) {
                if (preg_match('/^image(\d+)$/', $key, $matches)) {
                    $imageNumber = $matches[1]; // Extract the image number from the key
                    $imageName = 'club_image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/'), $imageName);
                    $club->{"image" . $imageNumber} = $imageName; // Dynamically set the column name
                }
            }
        
            $club->save();
                return redirect()->back()->with('success', 'Club created successfully.');
        }
        

        public function updateClub(Request $request, $id)
        {
            $validatedData = $request->validate([
                'clubs_id' => 'required|exists:clubs_heading,id',
                'thumbnail' => 'nullable|image|mimes:jpeg,webp|max:2048',
                'description' => 'required|string',
            ]);
        
            $club = Clubs::findOrFail($id);
            $club->description = $validatedData['description'];
            $club->clubs_id = $validatedData['clubs_id'];
        
            if ($request->hasFile('thumbnail')) {
                if ($club->thumbnail && file_exists(public_path('images/' . $club->thumbnail))) {
                    unlink(public_path('images/' . $club->thumbnail));
                }
        
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'club_thumbnail_' . time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('images/'), $thumbnailName);
                $club->thumbnail = $thumbnailName;
            }
        
            foreach ($request->files as $key => $file) {
                if (preg_match('/^image\d+$/', $key)) {
                    $request->validate([
                        $key => 'image|mimes:jpeg,webp|max:3048',
                    ]);
                }
            }

            foreach ($request->files as $key => $file) {
                if (preg_match('/^image(\d+)$/', $key, $matches)) {
                    $imageNumber = $matches[1];
        
                    $oldImageColumn = "image" . $imageNumber;
                    if ($club->{$oldImageColumn} && file_exists(public_path('images/' . $club->{$oldImageColumn}))) {
                        unlink(public_path('images/' . $club->{$oldImageColumn}));
                    }
        
                    $imageName = 'club_image_' . time() . '_' . uniqid() . '_' . $imageNumber . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/'), $imageName);
                    $club->{$oldImageColumn} = $imageName;
                }
            }
        
            $club->save();
            return redirect()->back()->with('success', 'Club updated successfully.');
        }
        
        
        public function destroyclubs($id){

            $club = Clubs::find($id);
            if ($club) {
                if ($club->thumbnail && file_exists(public_path('images/clubs/' . $club->thumbnail))) {
                    unlink(public_path('images/clubs/' . $club->thumbnail));
                }
                
                for ($i = 1; $i <= 30; $i++) {
                    $imageKey = 'image' . $i;
                    if ($club->$imageKey && file_exists(public_path('images/clubs/' . $club->$imageKey))) {
                        unlink(public_path('images/clubs/' . $club->$imageKey));
                    }
                }
                
                $club->delete();
                return redirect()->back()->with('success', 'Club deleted successfully');
            }
            
            return response()->json(['error' => 'Club not found'], 404);
        }

    

        public function HeadingClubs(Request $request)
        {
          
                $validatedData = $request->validate([
                    'title' => 'required|string',
                ]);
        
                $clubheading = new ClubsHeding();
                $clubheading->title = $validatedData['title'];
        
                $clubheading->save();
        
                return redirect()->back()->with('success', 'Club created successfully.');
        } 


            public function updateHeadingClub(Request $request, $id)
            {

                $validatedData = $request->validate([
                    'title' => 'required|string',
                ]);
                $clubheading = ClubsHeding::findOrFail($id);

                $clubheading->title = $validatedData['title'];
                $clubheading->save();

                return redirect()->back()->with('success', 'Club updated successfully.');
            }


            public function deleteHeadingClub($id)
            {
                $clubheading = ClubsHeding::findOrFail($id);
                $clubheading->delete();

                return redirect()->back()->with('success', 'Club deleted successfully.');
            }


    
}

