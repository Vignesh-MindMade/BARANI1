<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\ApiController;
use App\Models\Section;
use App\Models\PsgIaq;
use App\Models\ContentSection;
use App\Models\TrusteMessage;
use App\Models\SonsandCharities;
use App\Models\GoverningCouncil;
use App\Models\CouncilMembers;
use App\Models\CommitteeName;
use App\Models\OrganizationSchedule;
use App\Models\FactsandFigure;
use App\Models\StatutoryCommittee;
use App\Models\DesignChair;
use App\Models\PrincipalMessage;
use App\Models\Corefaculty;
use App\Models\Visitingfaculty;
use App\Models\AlliedFaculty;
use App\Models\ChiefAdvisor;
use App\Models\ExpertMember;
use App\Models\AdministrativeChiefAdvisor;
use App\Models\AdministrativeExpertmembers;
use App\Models\Pedagogy;
use App\Models\OurPrograms;
use App\Models\Syllabus;
use App\Models\AcademicCalendar;
use App\Models\AcademicTimetable;
use App\Models\SocialLinks;
use App\Models\FooterContact;
use App\Models\MonthlyLectureSeries;
use App\Models\SiteFieldVisits;
use App\Models\StudyTour;
use App\Models\Nasa;
use App\Models\Symposium;
use App\Models\LifeatcampusCategory;
use App\Models\LifeatCampus;
use App\Models\IqacSections;
use App\Models\Iqac;
use App\Models\AdmissionSections;
use App\Models\Admission;
use App\Models\AdmissionContent;
use App\Models\WorkwithusContent;
use App\Models\WorkWithUs;
use App\Models\EcamcellSections;
use App\Models\ExamcellContents;
use App\Models\LabsSections;
use App\Models\LabContent;
use App\Models\LibraySections;
use App\Models\EditoriolSections;
use App\Models\Editoriol;
use App\Models\Library;
use App\Models\ExamCellAbout;
use App\Models\ExamCellCirculars;
use App\Models\Curricular;
use App\Models\CurricularMain;
use App\Models\CocurricularFront;
use App\Models\CocurricularDetail;
use App\Models\ExtraCurricularFront;
use App\Models\ExtraCurricularDetail;

use App\Models\CollabrationDetail;
use App\Models\CollabrationFront;

use App\Models\Infrastructure_front;
use App\Models\Infrastructure_Detatil;
use App\Models\Infrastrcture_subfolders;
use App\Models\Latestvideo;
use App\Models\LatestVideosHeading;
use App\Models\Clubs;
use App\Models\ClubsHeding;

use Illuminate\Http\Request;

class PageController extends ApiController
{
    
     public function psgiaq()
     {
    $psgiaq = PsgIaq::all();
    $sections = ContentSection::with('section')->orderBy('section_id', 'asc')->get();

    
    $groupedSections = [];

  
    foreach ($sections as $section) {
        if ($section) {
            $groupedSections[$section->section_id][] = [
                'section_content' => $section->text,
            ];
        }
    }

    $formattedMenus = [];

    foreach ($groupedSections as $sectionId => $contents) {
        $sectionName = $sections->firstWhere('section_id', $sectionId)->section->name;
        $formattedMenu = [
            'section' => [
                'section_id' => $sectionId,
                'section_name' => $sectionName,
            ],
            'contents' => $contents,
        ];

        $formattedMenus[] = $formattedMenu;
    }

    return response()->json(['psgiaq' => $psgiaq, 'sections' => $formattedMenus]);
}

  
        public function trust()
        {
            $trusts = TrusteMessage::all();
        
            $trusts->transform(function ($trust) {
                $trust->image = $this->getImagePath($trust->image); 
                $trust->bg_image = $this->getImagePath($trust->bg_image); 
                return $trust;
            });
        
            return response()->json($trusts);
        }
        
        
        
        public function sonsandcharities()
        {
            $sons = SonsandCharities::all();
            return response()->json($sons);
        }
        
        
        
        public function secreateryinfo()
        {
            $governingcouncils = GoverningCouncil::all();
            
             $governingcouncils->transform(function ($governingcouncil) {
                $governingcouncil->image = $this->getImagePath($governingcouncil->image); 
                return $governingcouncil;
            });
            return response()->json($governingcouncils);
        }
        
        
        
        public function Councilmembers()
        {
            $councilmembers = CouncilMembers::all();
            return response()->json($councilmembers);
        }
        
        
        
        public function Organizational_schedule()
        {
            $organization = OrganizationSchedule::all();
            return response()->json($organization);
        }
        
        
        
        public function institutionalcommittee()
        {
            
            $test = StatutoryCommittee::all();
            $committees = CommitteeName::all();
            
             $committees->transform(function ($committee) {
                $committee->pdf = $this->getImagePath($committee->pdf); 
                return $committee;
            });
            return response()->json(['statutory_committee'=> $test , 'committee'=>$committees]);
        }
        
        
        
        
        public function factsandfigures()
        {
            $facts = FactsandFigure::all();
        
            $facts->transform(function ($fact) {
                $fact->image = $this->getImagePath($fact->image); 
                return $fact;
            });
        
            return response()->json($facts);
        }
        
        
        
        public function designchair()
        {
            $facts = DesignChair::all();
        
            $facts->transform(function ($fact) {
                $fact->chair_image = $this->getImagePath($fact->chair_image); 
                return $fact;
            });
        
            return response()->json($facts);
        }
        
        
        
        public function principalmessage()
        {
            $messages = PrincipalMessage::all();
        
            $messages->transform(function ($message) {
                $message->file = $this->getImagePath($message->file); 
                return $message;
            });
        
            return response()->json($messages);
        }
        
        
        
        public function corefaculty()
        {
            $cores = Corefaculty::all();
        
            $cores->transform(function ($core) {
                $core->staff_image = $this->getfacultyImagePath($core->staff_image); 
                return $core;
            });
        
            return response()->json($cores);
        }
        
        
        
        public function visitingfaculty()
        {
            $faculties = Visitingfaculty::all();
        
            $faculties->transform(function ($facultie) {
                $facultie->image = $this->getfacultyImagePath($facultie->image); 
                return $facultie;
            });
        
            return response()->json($faculties);
        }
        
        
        public function alliedfaculty()
        {
            $faculties = AlliedFaculty::all();
        
            $faculties->transform(function ($facultie) {
                $facultie->image = $this->getfacultyImagePath($facultie->image); 
                return $facultie;
            });
        
            return response()->json($faculties);
        }
        
        
        public function chiefadvisor()
        {
            $faculties = ChiefAdvisor::all();
        
            $faculties->transform(function ($facultie) {
                $facultie->image = $this->getfacultyImagePath($facultie->image); 
                return $facultie;
            });
        
            return response()->json($faculties);
        }
        
        
        public function expertmember()
        {
            $faculties = ExpertMember::all();
        
            $faculties->transform(function ($facultie) {
                $facultie->image = $this->getfacultyImagePath($facultie->image); 
                return $facultie;
            });
        
            return response()->json($faculties);
        }
        
        
        public function Administrativechiefadvisor()
        {
            $faculties = AdministrativeChiefAdvisor::all();
        
            $faculties->transform(function ($facultie) {
                $facultie->image = $this->getfacultyImagePath($facultie->image); 
                return $facultie;
            });
        
            return response()->json($faculties);
        }
        
        
        public function Administrativeexpertmember()
        {
            $faculties = AdministrativeExpertmembers::all();
        
            $faculties->transform(function ($facultie) {
                $facultie->image = $this->getfacultyImagePath($facultie->image); 
                return $facultie;
            });
        
            return response()->json($faculties);
        }
        
        
        
        public function ourprograms()
        {
            
            $test = OurPrograms::all();
            $committees = Pedagogy::all();
            
             $committees->transform(function ($committee) {
                $committee->prog_image = $this->getImagePath($committee->prog_image); 
                return $committee;
            });
            return response()->json(['pedagogy'=> $test , 'our_programs'=>$committees]);
        }
        
        
        
        
        public function syllabus()
        {
          
            $committees = Syllabus::all();
            
             $committees->transform(function ($committee) {
                $committee->pdf = $this->getpdfPath($committee->pdf); 
                return $committee;
            });
            return response()->json(['syllabus'=>$committees]);
        }
        



       public function academiccalendar()
        {
            $sons = AcademicCalendar::all();
            return response()->json($sons);
        }
        
        
        
    public function timetable($year)
{
    // Retrieve the timetable data for the provided year
    $committees = AcademicTimetable::where('year_from', substr($year, 0, 4))
                                  ->where('year_to', substr($year, 5, 4))
                                  ->get();

    // Check if there's any data for the given year
    if ($committees->isEmpty()) {
        return response()->json(['message' => 'Year mismatch or no data available for the given year.'], 404);
    }

    // Process the timetable data
    $committees->transform(function ($committee) {
        $committee->year = $committee->year_from . '-' . $committee->year_to;

        $committee->year_1_odd_pdf = $this->gettimetablepdfPath($committee->year_1_odd_pdf); 
        $committee->year_1_even_pdf = $this->gettimetablepdfPath($committee->year_1_even_pdf); 
        $committee->year_2_odd_pdf = $this->gettimetablepdfPath($committee->year_2_odd_pdf); 
        $committee->year_2_even_pdf = $this->gettimetablepdfPath($committee->year_2_even_pdf); 
        $committee->year_3_odd_pdf = $this->gettimetablepdfPath($committee->year_3_odd_pdf); 
        $committee->year_3_even_pdf = $this->gettimetablepdfPath($committee->year_3_even_pdf); 
        $committee->year_4_odd_pdf = $this->gettimetablepdfPath($committee->year_4_odd_pdf); 
        $committee->year_4_even_pdf = $this->gettimetablepdfPath($committee->year_4_even_pdf); 
        $committee->year_5_odd_pdf = $this->gettimetablepdfPath($committee->year_5_odd_pdf); 
        $committee->year_5_even_pdf = $this->gettimetablepdfPath($committee->year_5_even_pdf); 
        
        // Remove the original 'year_from' and 'year_to' if not needed
        unset($committee->year_from);
        unset($committee->year_to);

        return $committee;
    });

    return response()->json(['academic_timetable' => $committees]);
}

        
         public function connect()
        {
        
        $contact = FooterContact::all();
        $socials = SocialLinks::all();
        return response()->json(['contact' => $contact,'Social_links' => $socials]);
        }
        
        
        public function MonthlyLectureSeries()
        {
            // Fetch all records ordered by created_at in ascending order
            $messages = MonthlyLectureSeries::orderBy('created_at', 'asc')->get();
        
            $messages->transform(function ($message) {
                if ($message->thumbnail) {
                    $message->thumbnail = $this->getImagePath($message->thumbnail); 
                }
        
                for ($i = 1; $i <= 30; $i++) {
                    $imageKey = "image$i";
                    if ($message->$imageKey) {
                        $message->$imageKey = $this->getImagePath($message->$imageKey);
                    }
                }
        
                return $message;
            });
        
            return response()->json($messages);
        }
        
        public function StudyTour()
        {
           
            $messages = StudyTour::orderBy('created_at', 'asc')->get();
        
            $messages->transform(function ($message) {
                if ($message->thumbnail) {
                    $message->thumbnail = $this->getImagePath($message->thumbnail); 
                }
        
                for ($i = 1; $i <= 30; $i++) {
                    $imageKey = "image$i";
                    if ($message->$imageKey) {
                        $message->$imageKey = $this->getImagePath($message->$imageKey);
                    }
                }
        
                return $message;
            });
        
            return response()->json($messages);
        }

        
    
    public function SiteFieldVisits()
        {
            // Fetch all records ordered by created_at in ascending order
            $messages = SiteFieldVisits::orderBy('created_at', 'asc')->get();
        
            $messages->transform(function ($message) {
                if ($message->thumbnail) {
                    $message->thumbnail = $this->getImagePath($message->thumbnail); 
                }
        
                for ($i = 1; $i <= 30; $i++) {
                    $imageKey = "image$i";
                    if ($message->$imageKey) {
                        $message->$imageKey = $this->getImagePath($message->$imageKey);
                    }
                }
        
                return $message;
            });
        
            return response()->json($messages);
        }
   
   
 
        public function Symposium(Request $request)
        {
           
            $messages = Symposium::orderBy('created_at', 'asc')->get();
        
            $messages->transform(function ($message) {
                if ($message->thumbnail) {
                    $message->thumbnail = $this->getImagePath($message->thumbnail); 
                }
        
                for ($i = 1; $i <= 30; $i++) {
                    $imageKey = "image$i";
                    if ($message->$imageKey) {
                        $message->$imageKey = $this->getImagePath($message->$imageKey);
                    }
                }
        
                return $message;
            });
        
            return response()->json($messages);
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

        
        
        public function Clubs()
        {
           
            $messages = Clubs::orderBy('created_at', 'asc')->get();
        
            $messages->transform(function ($message) {
                if ($message->thumbnail) {
                    $message->thumbnail = $this->getImagePath($message->thumbnail); 
                }
        
                for ($i = 1; $i <= 30; $i++) {
                    $imageKey = "image$i";
                    if ($message->$imageKey) {
                        $message->$imageKey = $this->getImagePath($message->$imageKey);
                    }
                }
        
                return $message;
            });
        
            return response()->json($messages);
        }

        
             public function Nasa()
        {
           
            $messages = Nasa::orderBy('created_at', 'asc')->get();
        
            $messages->transform(function ($message) {
                if ($message->thumbnail) {
                    $message->thumbnail = $this->getImagePath($message->thumbnail); 
                }
        
                for ($i = 1; $i <= 30; $i++) {
                    $imageKey = "image$i";
                    if ($message->$imageKey) {
                        $message->$imageKey = $this->getImagePath($message->$imageKey);
                    }
                }
        
                return $message;
            });
        
            return response()->json($messages);
        }

        public function lifeatcampus()
        {
            $menus = LifeatCampus::with('category')->get();
        
            $formattedMenus = [];
        
            foreach ($menus as $menu) {
                $formattedMenu = [
                    
                        'image' => $this->getImagePath($menu->image),
                        'category' => $menu->category->name,
                        'description' => $menu->description,
                
                ];
        
                $formattedMenus[] = $formattedMenu;
            }
        
            return response()->json($formattedMenus);
        }
        
        
        
        
        public function iqac()
        {
                    $sections = Iqac::with('section')->orderBy('section_id', 'asc')->get();
                
                    
                    $groupedSections = [];
                
                  
                    foreach ($sections as $section) {
                        if ($section) {
                            $groupedSections[$section->section_id][] = [
                                'iqac_content' => $section->description,
                            ];
                        }
                    }
                
                    $formattedMenus = [];
                
                    foreach ($groupedSections as $sectionId => $contents) {
                        $sectionName = $sections->firstWhere('section_id', $sectionId)->section->name;
                        $formattedMenu = [
                            'section' => [
                                'section_id' => $sectionId,
                                'section_name' => $sectionName,
                            ],
                            'contents' => $contents,
                        ];
                
                        $formattedMenus[] = $formattedMenu;
                    }
                
                    return response()->json(['sections' => $formattedMenus]);
                }
                
        public function admission()
        
        {
            $test = AdmissionContent::all();
            $sections = Admission::with('section')->orderBy('section_id', 'asc')->get();
        
            
            $groupedSections = [];
        
          
            foreach ($sections as $section) {
                if ($section) {
                    $groupedSections[$section->section_id][] = [
                        'Admission' => $section->description,
                    ];
                }
            }
        
            $formattedMenus = [];
        
            foreach ($groupedSections as $sectionId => $contents) {
                $sectionName = $sections->firstWhere('section_id', $sectionId)->section->name;
                $formattedMenu = [
                    'Admission' => [
                        'section_id' => $sectionId,
                        'section_name' => $sectionName,
                    ],
                    'description' => $contents,
                ];
        
                $formattedMenus[] = $formattedMenu;
            }
        
            return response()->json(['admission-content' => $test ,'admission' => $formattedMenus]);
        }
        
        
        
        public function workwithus()
        {
            
            $test = WorkwithusContent::all();
            $committees = WorkWithUs::all();
            
             $committees->transform(function ($committee) {
                $committee->image = $this->getImagePath($committee->image); 
                return $committee;
            });
            return response()->json(['description'=> $test , 'work-with-us'=>$committees]);
        }
        
        
         public function examcell()
        {
                    $sections = ExamcellContents::with('exam')->orderBy('exam_id', 'asc')->get();
                
                    
                    $groupedSections = [];
                
                  
                    foreach ($sections as $section) {
                        if ($section) {
                            $groupedSections[$section->exam_id][] = [
                                'ExamCell_Content' => $section->text,
                            ];
                        }
                    }
                
                    $formattedMenus = [];
                
                    foreach ($groupedSections as $sectionId => $contents) {
                        $sectionName = $sections->firstWhere('exam_id', $sectionId)->exam->exam_name;
                        $formattedMenu = [
                            'section' => [
                                'exam_id' => $sectionId,
                                'exam_name' => $sectionName,
                            ],
                            'contents' => $contents,
                        ];
                
                        $formattedMenus[] = $formattedMenu;
                    }
                
                    return response()->json(['Examcell' => $formattedMenus]);
                }
                
                
                
         public function labs()
        {
                    $sections = LabContent::with('Lab')->orderBy('lab_id', 'asc')->get();
                
                    
                    $groupedSections = [];
                
                  
                    foreach ($sections as $section) {
                        if ($section) {
                            $groupedSections[$section->lab_id][] = [
                                'Lab_Content' => $section->description,
                            ];
                        }
                    }
                
                    $formattedMenus = [];
                
                    foreach ($groupedSections as $sectionId => $contents) {
                        $sectionName = $sections->firstWhere('lab_id', $sectionId)->Lab->lab_name;
                        $formattedMenu = [
                            'section' => [
                                'lab_id' => $sectionId,
                                'name' => $sectionName,
                            ],
                            'contents' => $contents,
                        ];
                
                        $formattedMenus[] = $formattedMenu;
                    }
                
                    return response()->json(['Labs' => $formattedMenus]);
                }
                
                
                
         public function library()
        {
                    $sections = LibraySections::with('section')->orderBy('section_id', 'asc')->get();
                
                    
                    $groupedSections = [];
                
                  
                    foreach ($sections as $section) {
                        if ($section) {
                            $groupedSections[$section->section_id][] = [
                                'Library_Content' => $section->description,
                            ];
                        }
                    }
                
                    $formattedMenus = [];
                
                    foreach ($groupedSections as $sectionId => $contents) {
                        $sectionName = $sections->firstWhere('section_id', $sectionId)->section->name;
                        $formattedMenu = [
                            'section' => [
                                'library_id' => $sectionId,
                                'name' => $sectionName,
                            ],
                            'contents' => $contents,
                        ];
                
                        $formattedMenus[] = $formattedMenu;
                    }
                
                    return response()->json(['Library' => $formattedMenus]);
                }
                
                
                
            
        private function getImagePath($imageName) {
            
            $domain = config('app.url');
            
            $basePath = env('IMAGE_BASE_PATH', '/admin/public/images/');
            
            return $domain . $basePath . $imageName;
        }
        
        
        private function getfacultyImagePath($imageName) {
            $domain = config('app.url');
            
            $basePath = env('IMAGE_BASE_PATH', '/admin/public/faculty/');
            
            return $domain . $basePath . $imageName;
        }
        
        
        private function getpdfPath($pdfName) {
            $domain = config('app.url');
            
            $basePath = env('IMAGE_BASE_PATH', '/admin/public/pdfs/');
            
            return $domain . $basePath . $pdfName;
        }
        
        private function gettimetablepdfPath($pdfName) {
            $domain = config('app.url');
            
            $basePath = env('IMAGE_BASE_PATH', '/admin/public/timetables/');
            
            return $domain . $basePath . $pdfName;
        }


        public function Editoriolindex()
        {
            $editoriolsections = EditoriolSections::all();
            return response()->json([
                'status' => 'success',
                'data' => $editoriolsections
            ], 200);
        }
        
        public function indexApi()
        {
            $EdtMenu = Editoriol::all();
            // Return the data as a JSON response
            return response()->json([
                'success' => true,
                'data' => $EdtMenu
            ]);
        }
        
        
         
        public function getCommittees()
        {
            $committees = CommitteeName::with('members')->get();
        
            $response = $committees->map(function ($committee) {
                return [
                    'committee_name' => $committee->committee_name,
                    'members' => $committee->members->map(function ($member) {
                        return [
                            'member_name' => $member->member_name,
                            'designation' => $member->designation,
                            'committee' => $member->committee,
                            'email' => $member->email,
                            'phone' => $member->phone,
                        ];
                    }),
                ];
            });
        
            return response()->json($response);
        }
 
        public function index()
    {
       
        $points = ExamCellAbout::all();
        
     
        return response()->json($points);
    }
    
        public function getCircularsTest(){
            
            try {
        
                $circularsTest = CurricularMain::all();
    
                return response()->json([
                    'success' => true,
                    'data' => $circularsTest,
                ], 200);
            } catch (\Exception $e) {
                
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch data.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        
        }
        
public function getCircularsData()
{
    try {
        // Fetch the data
        $Curriculars_FirstPage = CurricularMain::select('id', 'catagory_name', 'catagory_image')->get();
        $curriculars_DetatilPage = Curricular::all();

        // Ensure curricular_id is cast to int and format image URL for FirstPage
        $Curriculars_FirstPage = $Curriculars_FirstPage->map(function ($item) {
            $item->id = (int) $item->id; // Ensure id is an integer
            $item->catagory_image = $this->getImagePath($item->catagory_image); // Get full image path for FirstPage
            return $item;
        });

        // Ensure curricular_id is cast to int and format image URL for DetailPage
        $curriculars_DetatilPage = $curriculars_DetatilPage->map(function ($item) {
            $item->curricular_id = (int) $item->curricular_id; // Ensure curricular_id is an integer
            $item->image = $this->getImagePath($item->image); // Get full image path for DetailPage
            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => [
                'Curriculars_FirstPage' => $Curriculars_FirstPage,
                'curriculars_DetatilPage' => $curriculars_DetatilPage,
            ],
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch data.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


        
        
        
public function getCoCurricularData()
{
    try {
        $CocurricularFront = CocurricularFront::select('id', 'catagory_name', 'catagory_image')->get();
        $CocurricularDetail = CocurricularDetail::all();

        $CocurricularFront = $CocurricularFront->map(function ($item) {
            $item->id = (int) $item->id; // Ensure id is an integer
            
            // Append full image path
            if ($item->catagory_image) {
                $item->catagory_image = $this->getImagePath($item->catagory_image);
            }

            return $item;
        });

        // Ensure cocurricular_id is cast to int and add image path
        $CocurricularDetail = $CocurricularDetail->map(function ($item) {
            $item->cocurricular_id = (int) $item->cocurricular_id; // Ensure cocurricular_id is an integer
            
            // Check if image field exists and append the full path
            if ($item->image) {
                $item->imagePath = $this->getImagePath($item->image);
            }

            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => [
                'CocurricularFront' => $CocurricularFront,
                'CocurricularDetail' => $CocurricularDetail,
            ],
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch data.',
            'error' => $e->getMessage(),
        ], 500);
    }
}




  public function ExtraCurricularIndexs()
{
    try {
        // Fetch the data
        $ExtraCurricularFronts = ExtraCurricularFront::select('id', 'catagory_name', 'catagory_image')->get();
        $ExtraCurricularDetails = ExtraCurricularDetail::all();

     
     
        $ExtraCurricularFronts = $ExtraCurricularFronts->map(function ($item) {
        $item->id = (int) $item->id; 
            
        
         if ($item->catagory_image) {
             $item->catagory_image = $this->getImagePath($item->catagory_image);
        }

            return $item;
        });

         $ExtraCurricularDetails = $ExtraCurricularDetails->map(function ($item) {
         $item->extra_curricullar_id = (int) $item->extra_curricullar_id;
        
            if ($item->image) {
                $item->imagePath = $this->getImagePath($item->image);
            }

            return $item;
        });


        return response()->json([
            'success' => true,
            'data' => [
                'ExtraCurricularFronts' => $ExtraCurricularFronts,
                'ExtraCurricularDetails' => $ExtraCurricularDetails,
            ],
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch data.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

          
        public function CollabrationIndex()
        {
            try {
                // Fetch the data
                $CollabrationFronts = CollabrationFront::select('id', 'catagory_name', 'catagory_image')->get();
                $CollabrationDetails = CollabrationDetail::all();
        
                // Ensure id and image path for CollabrationFronts
                $CollabrationFronts = $CollabrationFronts->map(function ($item) {
                    $item->id = (int) $item->id; // Ensure id is an integer
                    $item->catagory_image = $this->getImagePath($item->catagory_image); // Convert image to full path
                    return $item;
                });
        
                // Ensure collaboration_id is cast to int and image path for CollabrationDetails
                $CollabrationDetails = $CollabrationDetails->map(function ($item) {
                    $item->collaboration_id = (int) $item->collaboration_id;
                    $item->image = $this->getImagePath($item->image); // Convert image to full path
                    return $item;
                });
        
                return response()->json([
                    'success' => true,
                    'data' => [
                        'CollabrationFronts' => $CollabrationFronts,
                        'CollabrationDetails' => $CollabrationDetails,
                    ],
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch data.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }


        
            public function GetInfrastrcture()
        {
            try {
                // Fetch the data
                $Infrastructure_fronts = Infrastructure_front::select('id', 'title')->get();
                $Infrastructure_Detatils = Infrastructure_Detatil::all();
        
                // Ensure curricular_id is cast to int
                 $Infrastructure_fronts = $Infrastructure_fronts->map(function ($item) {
                    $item->id = (int) $item->id; // Ensure id is an integer
                    return $item;
                });
        
                $Infrastructure_Detatils = $Infrastructure_Detatils->map(function ($item) {
                    $item->Infrastructure_id = (int) $item->Infrastructure_id; // Ensure curricular_id is an integer
                    return $item;
                });
        
                return response()->json([
                    'success' => true,
                    'data' => [
                        'Infrastructure_fronts' => $Infrastructure_fronts,
                        'Infrastructure_Detatils' => $Infrastructure_Detatils,
                    ],
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch data.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
        
        
    public function getAllDatainfrastructureFronts(){
        $infrastructureFronts = Infrastructure_front::all();
    
        return response()->json([
            'success' => true,
            'data' => [
                'infrastructure_fronts' => $infrastructureFronts,
            ],
        ]);
    }
    
    
        public function getInfrastructureFront($id)
        {
            $infrastructureFront = Infrastructure_front::find($id);
            if (!$infrastructureFront) {
                return response()->json(['message' => 'Infrastructure Front not found'], 404);
            }
            return response()->json($infrastructureFront);
        }
        
        public function getAllSubfolders($infrastructure_id)
        {
            $infrastructureDetails = Infrastructure_Detatil::where('Infrastructure_id', $infrastructure_id)->get();
        
            if ($infrastructureDetails->isEmpty()) {
                return response()->json(['message' => 'No details found for this Infrastructure'], 404);
            }
        
            $subfolders = Infrastrcture_subfolders::whereIn('Infrastructure_detatil_id', $infrastructureDetails->pluck('id'))->get();
        
            $infrastructureDetails->transform(function ($infrastructure) use ($subfolders) {
                // Rename 'image' field to 'list_image'
                $infrastructure->list_image = $infrastructure->image ? $this->getImagePath($infrastructure->image) : null;
        
                // Rename 'infrastructure_thumbnail' field as is
                $infrastructure->infrastructure_thumbnail = $infrastructure->infrastructure_thumbnail 
                    ? $this->getImagePath($infrastructure->infrastructure_thumbnail) 
                    : null;
        
                // Filter subfolders related to this infrastructure detail
                $relatedSubfolders = $subfolders->where('Infrastructure_detatil_id', $infrastructure->id);
        
                $infrastructure->subfolders = $relatedSubfolders->map(function ($subfolder) {
                    $subfolder->Infrastructure_detatil_id = (int) $subfolder->Infrastructure_detatil_id;
        
                    // Rename 'image' field in subfolder to 'subfolder_image'
                    $subfolder->subfolder_image = $subfolder->image ? $this->getImagePath($subfolder->image) : null;
        
                    // Remove 'image' field from subfolder
                    unset($subfolder->image);
        
                    return $subfolder;
                });
        
                // Ensure the subfolders are returned as an array, not an object
                $infrastructure->subfolders = $infrastructure->subfolders->values()->all();
        
                $infrastructure->id = (int) $infrastructure->id;
                $infrastructure->Infrastructure_id = (int) $infrastructure->Infrastructure_id;
        
                // Remove 'image' field from infrastructure
                unset($infrastructure->image);
        
                return $infrastructure;
            });
        
            return response()->json([
                'infrastructure_details' => $infrastructureDetails,
            ]);
        }

        
        public function latest_videos()
        {
            $videos = Latestvideo::orderBy('sort_id', 'asc')->get();
            
            $headings = LatestVideosHeading::all();
    
            foreach ($videos as $video) {
                $video->image2_url = $this->getImagePath($video->image2);
            }
            $headings = $headings->map(function ($heading) {
                return [
                    'id' => $heading->id,
                    'heading' => $heading->heading,
                ];
            });
        
            $response = [
                'headings' => $headings,
                'latest_videos' => $videos,
            ];
        
            return response()->json($response, 200);
        }

                        public function listTitles()
        {
            $titles = EditoriolSections::all(['id', 'title']); 
            return response()->json([
                'success' => true,
                'data' => $titles,
            ]);
        }


        public function getEditoriolByTitle(Request $request, $id)
        {
            $section = EditoriolSections::find($id);
            if (!$section) {
                return response()->json([
                    'success' => false,
                    'message' => 'Title not found',
                ], 404);
            }
        
            $editoriols = Editoriol::where('editoriol_id', $id)->get()->map(function ($editoriol) {
                return [
                    'id' => $editoriol->id,
                    'editoriol_id' => $editoriol->editoriol_id,
                    'posted_by' => $editoriol->posted_by,
                    'posted_on' => $editoriol->posted_on,
                    'pdf' => $editoriol->pdf ? $this->getpdfPath($editoriol->pdf) : null, // Use getpdfPath
                    'image' => $editoriol->image ? $this->getImagePath($editoriol->image) : null, // Use getImagePath
                ];
            });
        
            return response()->json([
                'success' => true,
                'data' => $editoriols,
            ]);
        }
   
        public function listClubHeadings()
        {

            $headings = ClubsHeding::select('id', 'title')->get();
        
            // Return response
            return response()->json([
                'status' => 'success',
                'data' => $headings,
            ]);
        }



      public function getClubById(Request $request, $id)
        {
            // Get clubs data based on the provided ID
            $clubs = Clubs::where('clubs_id', $id)->get();
            
            // Check if any clubs exist for the given ID
            if ($clubs->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No clubs found for the given ID.',
                ], 404);
            }
        
            // Format the clubs data
            $formattedClubs = $clubs->map(function ($club) {
                $data = [
                    'id' => $club->id,
                    'description' => $club->description,
                    // 'thumbnail' => $club->thumbnail ? $this->getImagePath($club->thumbnail) : null,
                ];
        
                for ($i = 1; $i <= 30; $i++) {
                    $imageField = "image$i";
                    if (!empty($club->$imageField)) {
                        $data[$imageField] = $this->getImagePath($club->$imageField);
                    }
                }
        
                return $data;
            });
        
            // Return the formatted clubs data
            return response()->json([
                'status' => 'success',
                'clubs' => $formattedClubs,
            ]);
        }
        
        public function getAdmissionTitle()
        {
            $sections = AdmissionSections::all(['id', 'name']); 
            return response()->json($sections);
        }
        
public function getAdmission($id)
{
    $section = AdmissionSections::find($id);
    if (!$section) {
        return response()->json([
            'success' => false,
            'message' => 'Section not found.'
        ], 404); 
    }

    $admissions = Admission::where('section_id', $id)->get();

    if ($admissions->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No admission records found for this section.'
        ], 404);
    }

    // Update admissions with full PDF path
    $admissionsWithPdf = $admissions->map(function ($admission) {
        return [
            'id' => $admission->id,
            'section_id' => $admission->section_id,
            'description' => $admission->description,
            'pdf' => $admission->pdf ? asset('public/pdfs/' . $admission->pdf) : null, // Full PDF path
            'description1' => $admission->description1, // Correct field assignment
            'pdf1' => $admission->pdf1 ? asset('public/pdfs/' . $admission->pdf1) : null, // Correct PDF path
            'description2' => $admission->description2, // Correct field assignment
            'pdf2' => $admission->pdf2 ? asset('public/pdfs/' . $admission->pdf2) : null, // Correct PDF path
            'content' => $admission->content,
            'created_at' => $admission->created_at,
            'updated_at' => $admission->updated_at,
        ];
    });

    return response()->json([
        'success' => true,
        'admissions' => $admissionsWithPdf,
    ], 200);
}

    

}
