<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\ApiController;
use App\Models\Topbar;
use App\Models\Banner;
use App\Models\Menu;
use App\Models\Latestvideo;
use App\Models\Submenu;
use App\Models\Bgbanner;
use App\Models\PrincipalMessage;
use App\Models\NewsandEvents;
use App\Models\NewsEventsHeadings;
use App\Models\Testimonial;
use App\Models\StudentPortfolio;
use App\Models\StudentPortfolioHeading;
use App\Models\Portfoliofilters;
use App\Models\PortfolioBanner;
use App\Models\Archigazette;
use App\Models\ExamCellPeople;
use App\Models\ExamCellUniversity;
use App\Models\ExamCellUsefullLinks;
use App\Models\Circular;
use App\Models\Cocirculars;
use App\Models\ExtraCurricular;
use App\Models\ExamCellContactUs;
use App\Models\Collaboration;
use App\Models\ArchigazteHeading;
use App\Models\ExamCellPeopleTitle;

use Illuminate\Http\Request;

class HomepageController extends ApiController
{
   public function topbar()
{
    $topbarData = Topbar::orderBy('sort_id', 'asc')->get();
    return response()->json($topbarData);
}

public function banner()
{
    $banners = Banner::orderBy('sort_id', 'asc')->get();

    $banners->transform(function ($banner) {
        $banner->file = $this->getImagePath($banner->file); 
        return $banner;
    });

    return response()->json($banners);
}

   public function mainmenu()
{
    $mainmenu = Menu::all();
    return response()->json($mainmenu);
}


//   public function latest_videos()
// {
//     $videos = Latestvideo::all();
//     return response()->json($videos);
// }


public function testimonials()
{
    $testimonials = Testimonial::orderBy('sort_id', 'asc')->get();

    $testimonials->transform(function ($testimonial) {
        $testimonial->file = $this->getImagePath($testimonial->file); 
        if (!is_null($testimonial->thumbnailFile)) {
            $testimonial->thumbnailFile = $this->getImagePath($testimonial->thumbnailFile); 
        }
        
        return $testimonial;
    });

    return response()->json($testimonials);
}




public function bg_banner()
{
    $bgbanners = Bgbanner::orderBy('sort_id', 'asc')->get();

    $bgbanners->transform(function ($bgbanner) {
        $bgbanner->image = $this->getImagePath($bgbanner->image); 
        return $bgbanner;
    });

    return response()->json($bgbanners);
}




public function principal_message()
{
    $messages = PrincipalMessage::all();

    $messages->transform(function ($message) {
        $message->file = $this->getImagePath($message->file); 
        $message->team_iap_file = $this->getImagePath($message->team_iap_file); 
        return $message;

    });

    return response()->json($messages);
}



// public function newsandevents()
// {
//     $newsevents = newsandevents::orderBy('sort_id', 'asc')->get();

//     $formattedData = [];

//     foreach ($newsevents as $newsevent) {
//         $images = [];
//         $contents = [];

//         for ($i = 1; $i <= 8; $i++) {
//             $imageField = 'image' . $i;
//             $contentField = 'content' . $i;

//             if (!is_null($newsevent->$imageField) && !is_null($newsevent->$contentField)) {
//             $images[] = $this->getImagePath($newsevent->$imageField);
//             $contents[] = $newsevent->$contentField;
//         }
//         }

//         $imageContentPairs = array_map(function ($image, $content) {
//             return ['image' => $image, 'content' => $content];
//         }, $images, $contents);

//         $formattedData[] = [
//              'id' => $newsevent->id,
//               'heading' => $newsevent->heading,
//             'thumbnail' => $this->getImagePath($newsevent->image),
//             'description' => $newsevent->description,
//             'title' => $newsevent->title,
//             'date' => $newsevent->event_date,
//             'images' => $imageContentPairs,
//         ];
//     }

//     return response()->json($formattedData);
// }



    // public function projects()
    // {
    //     $projects = StudentPortfolio::with('filter')->orderBy('sort_id', 'asc')->get();
    
    //     $formattedData = [];
    
    //     foreach ($projects as $project) {
    //         $images = [];
    //         $contents = [];
    
    //         for ($i = 1; $i <= 8; $i++) {
    //             $imageField = 'image' . $i;
    //             $contentField = 'content' . $i;
    
    //             $images[] = $this->getImagePath($project->$imageField);
    
    //             $contents[] = $project->$contentField;
    //         }
    
    //         $imageContentPairs = array_map(function ($image, $content) {
    //             return ['image' => $image, 'content' => $content];
    //         }, $images, $contents);
    
    //         $formattedData[] = [
    //             'id' => $project->id,
    //             'thumbnail' => $this->getImagePath($project->thumbnail),
    //             'studentname' => $project->student_name,
    //             'projectname' => $project->project_name,
    //             'category' => $project->filter->name,
    //             'description' => $project->description,
    //             'images' => $imageContentPairs,
    //         ];
    //     }
    
    //     return response()->json($formattedData);
    // }


public function projects()
{
    // Fetch projects and include related 'filter' information using eager loading
    $projects = StudentPortfolio::with('filter')->orderBy('sort_id', 'asc')->get();

    // Fetch headings
    $headings = StudentPortfolioHeading::all();

    // Initialize an array to hold formatted projects
    $formattedProjects = [];

    // Iterate over the projects to format the images and content fields
    foreach ($projects as $project) {
        $images = [];
        $contents = [];

        // Loop through the image and content fields
        for ($i = 1; $i <= 8; $i++) {
            $imageField = 'image' . $i;
            $contentField = 'content' . $i;

            // Collect images and content associated with the project
            $images[] = $this->getImagePath($project->$imageField);
            $contents[] = $project->$contentField;
        }

        // Pair images with their corresponding content
        $imageContentPairs = array_map(function ($image, $content) {
            return ['image' => $image, 'content' => $content];
        }, $images, $contents);

        // Prepare the project data in the required format
        $formattedProjects[] = [
            'id' => $project->id,
            'thumbnail' => $this->getImagePath($project->thumbnail),
            'studentname' => $project->student_name,
            'projectname' => $project->project_name,
            'category' => $project->filter->name,
            'description' => $project->description,
            'images' => $imageContentPairs,
        ];
    }

    // Format the headings to return them in the desired format
    $formattedHeadings = $headings->map(function ($heading) {
        return [
            'id' => $heading->id,
            'heading' => $heading->heading,
        ];
    });

    // Combine both formatted headings and projects into a response
    $response = [
        'headings' => $formattedHeadings,
        'projects' => $formattedProjects,
    ];

    // Return the formatted response as JSON
    return response()->json($response, 200);
}


public function newsandevents()
{

    $newsevents = newsandevents::orderBy('sort_id', 'asc')->get();
    
    $headings = NewsEventsHeadings::all();

    $formattedNewsEvents = [];

    foreach ($newsevents as $newsevent) {
        $images = [];
        $contents = [];

        for ($i = 1; $i <= 8; $i++) {
            $imageField = 'image' . $i;
            $contentField = 'content' . $i;

            if (!is_null($newsevent->$imageField) && !is_null($newsevent->$contentField)) {
                $images[] = $this->getImagePath($newsevent->$imageField);
                $contents[] = $newsevent->$contentField;
            }
        }

        $imageContentPairs = array_map(function ($image, $content) {
            return ['image' => $image, 'content' => $content];
        }, $images, $contents);

        $formattedNewsEvents[] = [
            'id' => $newsevent->id,
            'thumbnail' => $this->getImagePath($newsevent->image),
            'description' => $newsevent->description,
            'title' => $newsevent->title,
            'date' => $newsevent->event_date,
            'images' => $imageContentPairs,
        ];
    }

    $formattedHeadings = $headings->map(function ($heading) {
        return [
            'id' => $heading->id,
            'heading' => $heading->heading,
            
        ];
    });

    // Combine both data into a response
    $response = [
        'headings' => $formattedHeadings,
        'news_and_events' => $formattedNewsEvents,
    ];

    return response()->json($response, 200);
}




public function detailednews($id)
{
    $newsevent = NewsAndEvents::findOrFail($id);

    $images = [];
    $contents = [];

    for ($i = 1; $i <= 8; $i++) {
        $imageField = 'image' . $i;
        $contentField = 'content' . $i;

        if (!is_null($newsevent->$imageField) && !is_null($newsevent->$contentField)) {
            $images[] = $this->getImagePath($newsevent->$imageField);
            $contents[] = $newsevent->$contentField;
        }
    }

    $imageContentPairs = array_map(function ($image, $content) {
        return ['image' => $image, 'content' => $content];
    }, $images, $contents);

    $formattedData = [
        'id' => $newsevent->id,
        'title' => $newsevent->title,
        'thumbnail' => $this->getImagePath($newsevent->image),
        'description' => $newsevent->description,
        'date' => $newsevent->event_date,
        'images' => $imageContentPairs,
    ];

    return response()->json($formattedData);
}





public function detailedprojects($id)
{
    $project = StudentPortfolio::with('filter')->findOrFail($id);

    $images = [];
    $contents = [];

    for ($i = 1; $i <= 8; $i++) {
        $imageField = 'image' . $i;
        $contentField = 'content' . $i;

        $images[] = $this->getImagePath($project->$imageField);
        $contents[] = $project->$contentField;
    }

    $imageContentPairs = array_map(function ($image, $content) {
        return ['image' => $image, 'content' => $content];
    }, $images, $contents);

    $formattedData = [
        'id' => $project->id,
        'thumbnail' => $this->getImagePath($project->thumbnail),
        'studentname' => $project->student_name,
        'projectname' => $project->project_name,
        'category' => $project->filter->name,
        'description' => $project->description,
        'images' => $imageContentPairs,
    ];

    return response()->json($formattedData);
}




public function blog()
{
    $newsevents = NewsAndEvents::where('event_date', '<', now())->get();

    $formattedData = [];

    foreach ($newsevents as $newsevent) {
        $images = [];
        $contents = [];

        for ($i = 1; $i <= 8; $i++) {
            $imageField = 'image' . $i;
            $contentField = 'content' . $i;

            $images[] = $this->getImagePath($newsevent->$imageField);
            $contents[] = $newsevent->$contentField;
        }

        $imageContentPairs = array_map(function ($image, $content) {
            return ['image' => $image, 'content' => $content];
        }, $images, $contents);

        $formattedData[] = [
            'id' => $newsevent->id,
            'thumbnail' => $this->getImagePath($newsevent->image),
            'description' => $newsevent->description,
            'date' => $newsevent->event_date,
            'images' => $imageContentPairs,
        ];
    }

    return response()->json($formattedData);
}






public function portfolio_banner()
{
    $portfoliobanners = PortfolioBanner::all();

    $portfoliobanners->transform(function ($portfoliobanner) {
        $portfoliobanner->image = $this->getImagePath($portfoliobanner->image); 
        return $portfoliobanner;
    });

    return response()->json($portfoliobanners);
}



public function archigazette()
{

    $portfoliobanners = Archigazette::all();


    $formattedArchigazettes = $portfoliobanners->map(function ($portfoliobanner) {
        return [
            'id' => $portfoliobanner->id,
            'posted_by' => $portfoliobanner->posted_by,
            'title' => $portfoliobanner->title,
            'posted_on' => $portfoliobanner->posted_on,
            'image' => $this->getImagePath($portfoliobanner->image),
            'pdf' => $this->getpdfPath($portfoliobanner->pdf),
            
        ];
    });

    $headings = ArchigazteHeading::all();

    $formattedHeadings = $headings->map(function ($heading) {
        return [
            'id' => $heading->id,
            'heading' => $heading->heading,
        ];
    });

    $response = [
        'headings' => $formattedHeadings,
        'archigazettes' => $formattedArchigazettes,
    ];

    return response()->json($response, 200);
}




public function submenu()
{
    // Fetch menus and order them by 'sort_id'
    $menus = Menu::with(['submenus' => function($query) {
        $query->orderBy('sort_id', 'asc'); // Order submenus by sort_id
    }])->orderBy('sort_id', 'asc') // Order menus by sort_id
      ->get();
    
    $formattedMenus = [];

    foreach ($menus as $menu) {
        $formattedMenu = [
            'menu' => [
                'name' => $menu->name,
                'image' => $this->getImagePath($menu->image),
            ],
            'submenus' => $menu->submenus->pluck('submenu')
        ];

        $formattedMenus[] = $formattedMenu;
    }

    return response()->json($formattedMenus);
}



 

    // #this new Portfolio function:
    // public function getAllPortfolios(Request $request)
    // {
    //     // Get the base URL from config or environment
    //     $baseUrl = 'https://psg.mindmadetech.in';
    
    //     // Fetch all portfolios with related filters
    //     $portfolios = StudentPortfolio::with('filter')->get();
    
    //     // Structure the data for the API response
    //     $data = $portfolios->map(function ($portfolio) use ($baseUrl) {
    //         $images = [];
    //         for ($i = 1; $i <= 8; $i++) {
    //             $imagePath = $portfolio["image$i"];
    //             if (!empty($imagePath) && file_exists(public_path($imagePath))) {
    //                 // Construct full URL
    //                 $images[] = $baseUrl . '/admin/images/' . basename($imagePath);
    //             }
    //         }
    
    //         return [
    //             'id' => $portfolio->id,
    //             'student_name' => $portfolio->student_name,
    //             'project_name' => $portfolio->project_name,
    //             'description' => $portfolio->description,
    //             'thumbnail' => $portfolio->thumbnail && file_exists(public_path($portfolio->thumbnail))
    //                 ? $baseUrl . '/admin/images/' . basename($portfolio->thumbnail)
    //                 : null,
    //             'filter' => $portfolio->filter ? $portfolio->filter->name : null,
    //             'images' => $images,
    //             'contents' => collect(range(1, 8))->mapWithKeys(function ($i) use ($portfolio) {
    //                 return ["content$i" => $portfolio["content$i"]];
    //             }),
    //         ];
    //     });
    
    //     return response()->json([
    //         'success' => true,
    //         'portfolios' => $data,
    //     ]);
    // }



    public function getPeople()
    {
        
    $peoples = ExamCellPeople::all();
        $titles = ExamCellPeopleTitle::all();

        return response()->json([
            'titles' => $titles,
            'peoples' => $peoples
            
        ]);
    }

    
    public function getUniversityData()
    {
            
            
            $universities = ExamCellUniversity::all();

         $universities->transform(function ($University) {
        $University->pdf = $this->getpdfPath($University->pdf); 
        $University->pdf2 = $this->getpdfPath($University->pdf2); 
        return $University;
    });

    return response()->json($universities);
    }
   
public function getUsefullLinks()
{
    $usefulLinks = ExamCellUsefullLinks::all();

    $usefulLinksWithPdf = $usefulLinks->map(function($link) {
        // Retrieve and add PDF path for each pdf field (pdf_1, pdf_2, ..., pdf_10)
        for ($i = 1; $i <= 10; $i++) {
            $pdfKey = "pdf_$i";
            if (!empty($link->{$pdfKey})) {
                // Add a new property for the PDF path
                $link->{$pdfKey . '_path'} = asset('public/pdfs/' . $link->{$pdfKey});
            }
        }
        return $link;
    });

    return response()->json([
        'success' => true,
        'data' => $usefulLinksWithPdf,
    ]);
}

    
       private function getImagePath($imageName) {
        $domain = config('app.url');
        
        $basePath = env('IMAGE_BASE_PATH', '/admin/public/images/');
        
        return $domain . $basePath . $imageName;
    }
    
    
    private function getpdfPath($imageName) {
        $domain = config('app.url');
        
        $basePath = env('IMAGE_BASE_PATH', '/admin/public/pdfs/');
        
        return $domain . $basePath . $imageName;
    }

        public function getCirculars()
        {
          
            $circulars = Circular::all();

            $circulars->transform(function ($circular) {
                $circular->image = $this->getImagePath($circular->image); 
                return $circular;
            });
        
           
            return response()->json($circulars);
    
}


    public function getCocirculars()
    {
        $Cocirculars = Cocirculars::all();
        
         $Cocirculars->transform(function ($cocircular) {
                    $cocircular->image = $this->getImagePath($cocircular->image); 
                    return $cocircular;
                });
            
        
        return response()->json($Cocirculars);
    }
    
    
         public function getExtraCirculars()
        {
          
            $ExtraCurriculars = ExtraCurricular::all();

            $ExtraCurriculars->transform(function ($ExtraCurricular) {
                $ExtraCurricular->image = $this->getImagePath($ExtraCurricular->image); 
                return $ExtraCurricular;
            });
        
           
            return response()->json($ExtraCurriculars);
    
}
     public function getcollaboration()
        {
          
            $Collabrations = Collaboration::all();

            $Collabrations->transform(function ($Collabration) {
                $Collabration->image = $this->getImagePath($Collabration->image); 
                return $Collabration;
            });
        
            return response()->json($Collabrations);
    
        }    
       public function getContactUsData()
        {
    
            $contactus = ExamCellContactUs::all();
    
            return response()->json($contactus);
        }
        
    
    
}
