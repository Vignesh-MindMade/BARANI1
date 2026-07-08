<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomepageController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\FooterController;
use App\Http\Controllers\Api\CircularController;
use App\Http\Controllers\Api\CocircularController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('topbar', [HomepageController::class, 'topbar']);
Route::get('banner', [HomepageController::class, 'banner']);
Route::get('mainmenu', [HomepageController::class, 'mainmenu']);
Route::get('submenu', [HomepageController::class, 'submenu']);
// Route::get('latest_videos', [HomepageController::class, 'latest_videos']);
Route::get('testimonials', [HomepageController::class, 'testimonials']);
Route::get('bg_banner', [HomepageController::class, 'bg_banner']);
Route::get('principal_message', [HomepageController::class, 'principal_message']);
Route::get('newsandevents', [HomepageController::class, 'newsandevents']);
Route::get('blog', [HomepageController::class, 'blog']);
Route::get('projects', [HomepageController::class, 'projects']);
Route::get('detailednews/{id}', [HomepageController::class, 'detailednews']);
Route::get('detailedprojects/{id}', [HomepageController::class, 'detailedprojects']);
Route::get('portfolio_banner', [HomepageController::class, 'portfolio_banner']);
Route::get('archigazette', [HomepageController::class, 'archigazette']);


Route::get('latest_videos', [PageController::class, 'latest_videos']);
Route::get('psg_iaq', [PageController::class, 'psgiaq']);
Route::get('trust', [PageController::class, 'trust']);
Route::get('SonsandCharities', [PageController::class, 'sonsandcharities']);
Route::get('Secreateryinfo', [PageController::class, 'secreateryinfo']);
Route::get('Councilmembers', [PageController::class, 'Councilmembers']);
Route::get('Organizational_schedule', [PageController::class, 'Organizational_schedule']);
Route::get('institutional_committee', [PageController::class, 'institutionalcommittee']);
Route::get('FactsandFigures', [PageController::class, 'factsandfigures']);


Route::get('design-chair', [PageController::class, 'designchair']);
Route::get('principal-message', [PageController::class, 'principalmessage']);
Route::get('core-faculty', [PageController::class, 'corefaculty']);
Route::get('visiting-faculty', [PageController::class, 'visitingfaculty']);
Route::get('allied-faculty', [PageController::class, 'alliedfaculty']);
Route::get('chief-advisor', [PageController::class, 'chiefadvisor']);
Route::get('expert-member', [PageController::class, 'expertmember']);
Route::get('administrative-chief-advisor', [PageController::class, 'Administrativechiefadvisor']);
Route::get('administrative-expert-member', [PageController::class, 'Administrativeexpertmember']);

Route::get('monthly-lecture-series', [PageController::class, 'MonthlyLectureSeries']);
Route::get('Site-Field-Visits', [PageController::class, 'SiteFieldVisits']);
Route::get('Study-Tour', [PageController::class, 'StudyTour']);
Route::get('Nasa', [PageController::class, 'Nasa']);
Route::get('Symposium', [PageController::class, 'Symposium']);
Route::get('Clubs', [PageController::class, 'Clubs']);


Route::get('life-at-campus', [PageController::class, 'lifeatcampus']);
Route::get('iqac', [PageController::class, 'iqac']);
Route::get('admission', [PageController::class, 'admission']);
Route::get('work-with-us', [PageController::class, 'workwithus']);

Route::get('ourprograms', [PageController::class, 'ourprograms']);
Route::get('syllabus', [PageController::class, 'syllabus']);
Route::get('academic_calendar', [PageController::class, 'academiccalendar']);

Route::get('academic_timetable/{year}', [PageController::class, 'timetable']);

Route::get('examcell', [PageController::class, 'examcell']);
Route::get('library', [PageController::class, 'library']);
Route::get('labs', [PageController::class, 'labs']);


Route::get('connect_with_us', [PageController::class, 'connect']);
Route::get('footer', [FooterController::class, 'footer']);


Route::middleware('auth:api')->group(function () {
    Route::apiResource('circulars', CircularController::class);
});

Route::get('/editoriol', [PageController::class, 'Editoriolindex']);

Route::get('/editoriol-menu', [PageController::class, 'indexApi']);

#this new Portfolio route:
Route::get('/portfolios', [HomepageController::class, 'getAllPortfolios']);


Route::get('/committees', [PageController::class, 'getCommittees']);


Route::get('/examcell-about', [PageController::class, 'index']);

Route::get('/examcell-people', [HomepageController::class, 'getPeople']);

Route::get('/universities', [HomepageController::class, 'getUniversityData']);

Route::get('/UsefullLinks', [HomepageController::class, 'getUsefullLinks']);

Route::get('/curricular', [HomepageController::class, 'getCirculars']);

Route::get('/cocurricular', [HomepageController::class, 'getCocirculars']);

Route::get('/collaboration', [HomepageController::class, 'getcollaboration']);

Route::get('/extracurricular', [HomepageController::class, 'getExtraCirculars']);

Route::get('/ContactUsData', [HomepageController::class, 'getContactUsData']);

Route::get('/getCurricularsData', [PageController::class, 'getCircularsData']);

Route::get('/getCocurricularData', [PageController::class, 'getCoCurricularData']);

Route::get('/ExtraCurricularIndex', [PageController::class, 'ExtraCurricularIndexs']);

Route::get('/getCollaboration', [PageController::class, 'CollabrationIndex']);

Route::get('/GetInfrastrcture', [PageController::class, 'GetInfrastrcture']); 

Route::get('/getAllDatainfrastructureFronts', [PageController::class, 'getAllDatainfrastructureFronts']);

Route::get('getAllSubfolders/{infrastructure_id}', [PageController::class, 'getAllSubfolders'])->name('api.getAllSubfolders');

Route::get('/titles', [PageController::class, 'listTitles']); 

Route::get('/editoriols/{id}', [PageController::class, 'getEditoriolByTitle']);

Route::get('/club-headings', [PageController::class, 'listClubHeadings']); 

Route::get('/clubs/{id}', [PageController::class, 'getClubById']); 

Route::get('/getAdmissionTitle', [PageController::class, 'getAdmissionTitle']);

Route::get('/getAdmission/{id}', [PageController::class, 'getAdmission']);

Route::get('/annual-report-titles', [FooterController::class, 'getAllTitles'])->name('api.get-titles');
Route::get('/annual-reports/{titleId}', [FooterController::class, 'getReportsByTitle'])->name('api.get-reports-by-title');

Route::get('internal-circulars/{yearRange}', [FooterController::class, 'getCircularsByYear']);

Route::get('anna-university/{yearsRange}', [FooterController::class, 'getAnnaUniversity']);

