<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competitor;
use App\Models\Product;
use App\Models\CompanyAddress;
use App\Models\CompanyEmail;
use App\Models\CompanyPeople;
use App\Models\CompanyPhone;
use App\Models\CompanyTask;
use App\Models\CompanyUrl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\People;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\ActivityType;
use App\Models\Industry;
use App\Models\Tag;
use Carbon\Carbon;
use App\Models\Source;
use App\Models\Activity;
use App\Models\CompanyType;

class CompanyController extends Controller
{
    public function getSidebarStats()
    {
        $currentUser = auth()->user();
        $companies = Company::with('user', 'companyType', 'tag', 'peoples')->get();
        $myCompanies = $companies->where('user_id', $currentUser->id);
        $myCompaniesCount = $myCompanies->count();
        $totalCompanies = $companies->count();
        $formattedTotalCompanies = number_format($totalCompanies / 1000, 1);

        return compact('myCompaniesCount', 'totalCompanies', 'formattedTotalCompanies');
    }

    // public function index(Request $request)
    // {
    //     $query = Company::with('user', 'companyType', 'tag', 'person');
    //     $peoples = People::all();
    //     $company_types = CompanyType::all();

    //     if ($request->ajax()) {
    //         // Search by lead name or people name
    //         if ($request->filled('search')) {
    //             $search = $request->search;
    //             $query->where('name', 'like', "%$search%");
    //         }

    //         // Filter by people id / assigneed to
    //         if ($request->filled('people_id')) {
    //             $query->where('people_id', $request->people_id);
    //         }

    //         // Filter by company type
    //         if ($request->filled('company_type_id')) {
    //             $query->where('company_type_id', $request->company_type_id);
    //         }
    //     }

    //     $companies = $query->get();

    //     $sidebarStats = $this->getSidebarStats();

    //     if ($request->ajax()) {
    //         return view('admin.company.partials.company-table-rows', compact('companies'))->render();
    //     }

    //     return view('admin.company.index', array_merge(
    //         compact('companies', 'peoples', 'company_types'),
    //         $sidebarStats
    //     ));
    // }

    public function index(Request $request)
    {
        $query = Company::with([
            'user',
            'companyType',
            'tag',
            'peoples',       // <-- updated from "person"
            'companyEmail',
            'companyPhone',
            'companyAddress',
            'companyUrl'
        ]);

        $peoples = People::all();
        $company_types = CompanyType::all();

        if ($request->ajax()) {
            // Search by company name
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('name', 'like', "%$search%");
            }

            // Filter by people id (using pivot table)
            if ($request->filled('people_id')) {
                $query->whereHas('peoples', function ($q) use ($request) {
                    $q->where('people_id', $request->people_id);
                });
            }

            // Filter by company type
            if ($request->filled('company_type_id')) {
                $query->where('company_type_id', $request->company_type_id);
            }
        }

        $companies = $query->get();

        $sidebarStats = $this->getSidebarStats();

        if ($request->ajax()) {
            return view('admin.company.partials.company-table-rows', compact('companies'))->render();
        }

        return view('admin.company.index', array_merge(
            compact('companies', 'peoples', 'company_types'),
            $sidebarStats
        ));
    }

    // public function my_companies(Request $request, $id)
    // {
    //     $query = Company::with('user', 'companyType', 'tag', 'person')
    //         ->where('user_id', $id);

    //     $peoples = People::all();
    //     $company_types = CompanyType::all();

    //     if ($request->ajax()) {
    //         // Search by lead name or people name
    //         if ($request->filled('search')) {
    //             $search = $request->search;
    //             $query->where('name', 'like', "%$search%");
    //         }

    //         // Filter by people id / assigneed to
    //         if ($request->filled('people_id')) {
    //             $query->where('people_id', $request->people_id);
    //         }

    //         // Filter by company type
    //         if ($request->filled('company_type_id')) {
    //             $query->where('company_type_id', $request->company_type_id);
    //         }
    //     }

    //     $companies = $query->get();

    //     $sidebarStats = $this->getSidebarStats();

    //     if ($request->ajax()) {
    //         return view('admin.company.partials.company-table-rows', compact('companies'))->render();
    //     }

    //     return view('admin.company.my-companies', array_merge(
    //         compact('companies', 'peoples', 'company_types'),
    //         $sidebarStats
    //     ));
    // }

    // public function store(Request $request)
    // {

    //     Company::create([
    //         'user_id' => $request->user_id,
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'address' => $request->address,
    //         'people_id' => $request->people_id,
    //         'url' => $request->url,
    //         'tag_id' => $request->tag_id,
    //         'company_type_id' => $request->company_type_id,
    //         'industry_id' => $request->industry_id,
    //         'territory_id' => $request->territory_id,
    //     ]);
    //     return redirect()->back()->with('success', 'Company created successfully!');
    // }


    public function my_companies(Request $request, $id)
    {
        // Load companies owned by given user with all relations
        $query = Company::with([
            'user',
            'companyType',
            'tag',
            'peoples',        // <-- pivot relation
            'companyEmail',
            'companyPhone',
            'companyAddress',
            'companyUrl'
        ])->where('user_id', $id);

        $peoples = People::all();
        $company_types = CompanyType::all();

        if ($request->ajax()) {
            // Search by company name
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('name', 'like', "%{$search}%");
            }

            // Filter by people id (pivot relation)
            if ($request->filled('people_id')) {
                $query->whereHas('peoples', function ($q) use ($request) {
                    $q->where('people.id', $request->people_id);
                });
            }

            // Filter by company type
            if ($request->filled('company_type_id')) {
                $query->where('company_type_id', $request->company_type_id);
            }
        }

        $companies = $query->get();
        $sidebarStats = $this->getSidebarStats();

        if ($request->ajax()) {
            return view('admin.company.partials.company-table-rows', compact('companies'))->render();
        }

        return view('admin.company.my-companies', array_merge(
            compact('companies', 'peoples', 'company_types'),
            $sidebarStats
        ));
    }


    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            // Step 1: Create company
            $company = Company::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'description' => $request->description,
                'tag_id' => $request->tag_id,
                'company_type_id' => $request->company_type_id,
                'industry_id' => $request->industry_id,
                'territory_id' => $request->territory_id,
            ]);

            // Step 2: Store emails
            if ($request->email) {
                CompanyEmail::create([
                    'company_id' => $company->id,
                    'email' => $request->email,
                ]);
            }

            // Step 3: Store phones
            if ($request->phone) {
                CompanyPhone::create([
                    'company_id' => $company->id,
                    'phone' => $request->phone,
                ]);
            }

            // Step 4: Store addresses
            if ($request->address) {
                CompanyAddress::create([
                    'company_id' => $company->id,
                    'address' => $request->address,
                ]);
            }

            // Step 5: Store URLs
            if ($request->url) {
                CompanyUrl::create([
                    'company_id' => $company->id,
                    'url' => $request->url,
                ]);
            }

            // Step 6: Store people
            if ($request->people_id) {
                CompanyPeople::create([
                    'company_id' => $company->id,
                    'people_id' => $request->people_id,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Company created successfully!');
    }


    // public function ajax_store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required',
    //         'address' => 'required',
    //     ]);

    //     $data = [
    //         'name' => $validated['name'],
    //         'description' => $validated['description'] ?? null,
    //         'address' => $validated['address'] ?? null,
    //         'user_id' => auth()->id(),
    //     ];

    //     if (!empty($request->phone)) {
    //         $data['phone'] = $request->phone;
    //     }

    //     if (!empty($request->email)) {
    //         $data['email'] = $request->email;
    //     }

    //     if (!empty($request->url)) {
    //         $data['url'] = $request->url;
    //     }

    //     $company = Company::create($data);

    //     if ($request->ajax()) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Company added successfully.',
    //             'company' => $company
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Company added successfully.');
    // }


    public function ajax_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'url' => 'nullable|url',
            'people_id' => 'nullable|exists:people,id',
            'company_type_id' => 'nullable|exists:company_types,id',
            'tag_id' => 'nullable|exists:tags,id',
            'industry_id' => 'nullable|exists:industries,id',
            'territory_id' => 'nullable|exists:territories,id',
        ]);

        DB::transaction(function () use ($request, &$company) {
            // Create base company
            $company = Company::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'description' => $request->description,
                'tag_id' => $request->tag_id,
                'company_type_id' => $request->company_type_id,
                'industry_id' => $request->industry_id,
                'territory_id' => $request->territory_id,
            ]);

            // Store email
            if ($request->filled('email')) {
                CompanyEmail::create([
                    'company_id' => $company->id,
                    'email' => $request->email,
                ]);
            }

            // Store phone
            if ($request->filled('phone')) {
                CompanyPhone::create([
                    'company_id' => $company->id,
                    'phone' => $request->phone,
                ]);
            }

            // Store address
            if ($request->filled('address')) {
                CompanyAddress::create([
                    'company_id' => $company->id,
                    'address' => $request->address,
                ]);
            }

            // Store URL
            if ($request->filled('url')) {
                CompanyUrl::create([
                    'company_id' => $company->id,
                    'url' => $request->url,
                ]);
            }

            // Store related person (only one for now)
            if ($request->filled('people_id')) {
                CompanyPeople::create([
                    'company_id' => $company->id,
                    'people_id' => $request->people_id,
                ]);
            }
        });

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Company added successfully.',
                'company' => $company->load([
                    'companyEmail',
                    'companyPhone',
                    'companyAddress',
                    'companyUrl',
                    'peoples'
                ])
            ]);
        }

        return redirect()->back()->with('success', 'Company added successfully.');
    }

    // public function show($id)
    // {
    //     $activity_types = ActivityType::all(); // fetch all activities
    //     $products = Product::all();
    //     $company = Company::with('user', 'companyType', 'industry')->findOrFail($id);
    //     $companies = Company::all();
    //     $users = User::all();
    //     $companytags = Tag::where('tag_id', 2)->get();
    //     $competitors = Competitor::all();
    //     $sources = Source::all();
    //     $company_types = CompanyType::all();
    //     $industries = Industry::all();
    //     $peoples = People::where('company_id', $id)->get();
    //     $allpeoples = People::all();

    //     return view('admin.company.edit', compact('company', 'users', 'company_types', 'companytags', 'activity_types', 'competitors', 'sources', 'companies', 'products', 'peoples', 'allpeoples', 'industries'));
    // }

    // public function activity_store(Request $request)
    // {


    //     $data = [
    //         'title' => $request->title,
    //         'activity_type_id' => $request->activity_type_id,
    //         'date' => $request->date,
    //         'start_time' => Carbon::parse($request->start_time)->format('H:i:s'),
    //         'end_time' => Carbon::parse($request->end_time)->format('H:i:s'),
    //         'all_day' => $request->all_day ?? 0,
    //         'location' => $request->location,
    //         'agenda' => $request->agenda,
    //     ];


    //     $activity = Activity::create($data);

    //     if ($request->ajax()) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Activity added successfully.',
    //             'people' => $activity
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Activity added successfully.');

    // }


    public function show($id)
    {
        $activity_types = ActivityType::all();
        $products = Product::all();

        // Load company with all relations
        $company = Company::with([
            'user',
            'companyType',
            'industry',
            'tag',
            'companyEmail',
            'companyPhone',
            'companyAddress',
            'companyUrl',
            'peoples' // <-- fetch related people via pivot
        ])->findOrFail($id);

        $companies = Company::all();
        $users = User::all();
        $companytags = Tag::where('tag_id', 2)->get();
        $competitors = Competitor::all();
        $sources = Source::all();
        $company_types = CompanyType::all();
        $industries = Industry::all();
        // Already coming from pivot relation, so no need for where('company_id', $id)
        $peoples = $company->peoples;
        $allpeoples = People::all();


        $emailTypes = [
            'email' => 'Email',
            'personal_email' => 'Personal Email',
            'support_email' => 'Support Email',
            'work_email' => 'Work Email',
        ];

        $emails = [];

        foreach ($company->companyEmail as $emailRecord) {
            foreach ($emailTypes as $field => $label) {
                if (!empty($emailRecord->$field)) {
                    $emails[] = [
                        'selected' => $field,   // which option should be selected
                        'value' => $emailRecord->$field,
                    ];
                }
            }
        }

        $addressTypes = [
            'address' => 'Address',
            'main_address' => 'Main Address',
            'work_address' => 'Work Address',
            'home_address' => 'Home Address',
            'billing_address' => 'Billing Address',
            'mailing_address' => 'Mailing Address',
        ];

        $addresses = [];

        foreach ($company->companyAddress as $addressRecord) {
            foreach ($addressTypes as $field => $label) {
                if (!empty($addressRecord->$field)) {
                    $addresses[] = [
                        'selected' => $field,   // which option should be selected
                        'value' => $addressRecord->$field,
                    ];
                }
            }
        }

        $phoneTypes = [
            'phone' => 'Phone',
            'home_phones' => 'Home Phone',
            'mobile_phones' => 'Mobile Phone',
            'work_phones' => 'Work Phone',
            'fax_phones' => 'Fax Phone',
        ];

        $phones = [];

        foreach ($company->companyPhone as $phoneRecord) {
            foreach ($phoneTypes as $field => $label) {
                if (!empty($phoneRecord->$field)) {
                    $phones[] = [
                        'selected' => $field,   // which option should be selected
                        'value' => $phoneRecord->$field,
                    ];
                }
            }
        }

        $urlTypes = [
            'url' => 'URL',
            'blog_url' => 'Blog URL',
            'twitter_url' => 'Twitter URL',
        ];

        $urls = [];

        foreach ($company->companyUrl as $urlRecord) {
            foreach ($urlTypes as $field => $label) {
                if (!empty($urlRecord->$field)) {
                    $urls[] = [
                        'selected' => $field, // which option should be selected
                        'value' => $urlRecord->$field,
                    ];
                }
            }
        }



        return view('admin.company.edit', compact(
            'company',
            'users',
            'company_types',
            'companytags',
            'activity_types',
            'competitors',
            'sources',
            'companies',
            'products',
            'peoples',
            'allpeoples',
            'industries',
            'emails',
            'emailTypes',
            'addresses',
            'addressTypes',
            'phones',
            'phoneTypes',
            'urls',
            'urlTypes'
        ));
    }

    public function activity_store(Request $request)
    {

        $data = [
            'title' => $request->title,
            'activity_type_id' => $request->activity_type_id,
            'date' => $request->date,
            'start_time' => Carbon::parse($request->start_time)->format('H:i:s'),
            'end_time' => Carbon::parse($request->end_time)->format('H:i:s'),
            'all_day' => $request->all_day ?? 0,
            'location' => $request->location,
            'agenda' => $request->agenda,
        ];

        $inserted = [];

        foreach ($request->participant_id as $participantId) {
            $newData = $data;
            $newData['participant_id'] = $participantId;
            $activity = Activity::create($newData);
            $inserted[] = $activity;
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Activities added successfully.',
                'activities' => $inserted,
            ]);
        }

        return redirect()->back()->with('success', 'Activities added successfully.');
    }

    public function login_activity(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'activity_type' => 'required|exists:activity_types,id',
            'participant_id' => 'required',
        ]);

        Activity::create([
            'title' => $validated['title'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'activity_type_id' => $validated['activity_type'],
            'date' => Carbon::today(), // adds current date
            'participant_id' => $validated['participant_id'],
        ]);


        return redirect()->back()->with('success', 'Login Activity Added Successfully.');

    }




}
