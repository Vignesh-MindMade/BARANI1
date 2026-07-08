<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\ApiController;
use App\Models\FooterText;
use App\Models\UsefulLinks;
use App\Models\FooterContact;
use App\Models\Downloads;
use App\Models\SocialLinks;
use App\Models\AnnualReportTitle;
use App\Models\AnnualReport;
use App\Models\InternalCirculars;
use App\Models\AnnaUniversity;
use Illuminate\Http\Request;

class FooterController extends ApiController
{
      public function footer()
     {
        $aboutus = FooterText::all();
        $links = UsefulLinks::all();
        $downloads = Downloads::all();
        
            $downloads->transform(function ($download) {
                $download->pdf = $this->getpdfPath($download->pdf); 
                return $download;
            });
        
            $links->transform(function ($link) {
                $link->pdf = $this->getpdfPath($link->pdf); 
                return $link;
            });
        
        $contact = FooterContact::all();
        $socials = SocialLinks::all();
        return response()->json(['About-us' => $aboutus, 'links' => $links ,'downloads' => $downloads,'contact' => $contact,'Social_links' => $socials]);
}


        private function getImagePath($imageName) {
            $domain = config('app.url');
            
            $basePath = env('IMAGE_BASE_PATH', '/admin/public/images/');
            
            return $domain . $basePath . $imageName;
        }
        
        
        private function getpdfPath($pdfName) {
            $domain = config('app.url');
            
            $basePath = env('IMAGE_BASE_PATH', '/admin/public/pdfs/');
            
            return $domain . $basePath . $pdfName;
        }


     public function getAllTitles()
        {
            $annualReportTitles = AnnualReportTitle::all();
        
            return response()->json([
                'success' => true,
                'data' => $annualReportTitles,
            ], 200);
        }
        
      public function getReportsByTitle($titleId)
    {
        $annualReports = AnnualReport::where('annual_report_id', $titleId)->get();
    
        if ($annualReports->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No reports found for this title.',
            ], 404);
        }
    
        $annualReports = $annualReports->map(function ($report) {
            $report->pdf_1 = $report->pdf_1 ? $this->getPdfPath($report->pdf_1) : null;
            $report->pdf_2 = $report->pdf_2 ? $this->getPdfPath($report->pdf_2) : null;
            $report->pdf_3 = $report->pdf_3 ? $this->getPdfPath($report->pdf_3) : null;
            return $report;
        });
    
        return response()->json([
            'success' => true,
            'data' => $annualReports,
        ], 200);
    }
    
    
public function getCircularsByYear($yearRange)
{
    // Validate the year range format
    if (!preg_match('/^\d{4}-\d{4}$/', $yearRange)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid year range format. Please use YYYY-YYYY format.',
        ], 400);
    }

    // Fetch circulars matching the provided year range
    $circulars = InternalCirculars::where('Year', $yearRange)->get();

    if ($circulars->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => "No circulars found for the year range $yearRange.",
        ], 404);
    }

    // Modify and restructure the circulars
    $circulars->transform(function ($circular) {
        // Split the Year into start and end year
        [$startYear, $endYear] = explode('-', $circular->Year);

        $formattedCircular = [
            'id'    => $circular->id,
            'Year'  => (int) $startYear . '-' . (int) $endYear, // Format Year as integers
            'title' => $circular->title,
            'semesters' => [],
        ];

        // Iterate through semester-related attributes
        for ($sem = 1; $sem <= 10; $sem++) {
            $semesterKey = "semester_$sem";
            if (!empty($circular->{$semesterKey})) {
                $semesterData = [
                    'semester' => $circular->{$semesterKey},
                    'internals' => [],
                ];

                // Collect internal-related data for the semester
                for ($internal = 1; $internal <= 3; $internal++) {
                    $internalKey = "sem{$sem}_internal_$internal";
                    $pdfKey = "sem{$sem}_internal_pdf_$internal";

                    if (!empty($circular->{$internalKey}) || !empty($circular->{$pdfKey})) {
                        $semesterData['internals'][] = [
                            'name' => $circular->{$internalKey} ?? null,
                            'pdf'  => !empty($circular->{$pdfKey}) ? $this->getPdfPath($circular->{$pdfKey}) : null,
                        ];
                    }
                }

                $formattedCircular['semesters'][] = $semesterData;
            }
        }

        return $formattedCircular;
    });

    // Return the data as a JSON response
    return response()->json([
        'success' => true,
        'data' => $circulars,
    ], 200);
}



public function getAnnaUniversity($yearRange)
{
    // Validate the year range format (e.g., "2023-2024")
    if (!preg_match('/^\d{4}-\d{4}$/', $yearRange)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid year range format. Please use YYYY-YYYY format.',
        ], 400);
    }

    // Extract the start and end years from the range
    [$startYear, $endYear] = explode('-', $yearRange);

    // Fetch records for the specified year range
    $annaUniversityRecords = AnnaUniversity::where('year', $yearRange)->get();

    // Check if any records exist
    if ($annaUniversityRecords->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => "No records found for the year range $yearRange.",
        ], 404);
    }

    // Transform the data
    $transformedData = $annaUniversityRecords->map(function ($item) {
        $formattedRecord = [
            'id'         => $item->id,
            'title'      => $item->title,
            'year'       => $item->year,
            'circulars' => [
                [
                    'circular_title_1' => $item->circular_1,
                    'circular_pdf_1'   => $this->getPdfPath($item->circular_1_pdf),
                ],
                [
                    'circular_title_2' => $item->circular_2,
                    'circular_pdf_2'   => $this->getPdfPath($item->circular_4_pdf),
                ],
                [
                    'circular_title_3' => $item->circular_3,
                    'circular_pdf_3'   => $this->getPdfPath($item->circular_3_pdf),
                ]
            ]
        ];

        return $formattedRecord;
    });

    // Return the transformed data as a JSON response
    return response()->json([
        'success' => true,
        'data' => $transformedData,
    ], 200);
}


}
