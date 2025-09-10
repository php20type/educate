<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\User;
use App\Models\ActivityType;
use App\Models\Source;
use App\Models\Competitor;
use App\Models\PeopleAddress;
use App\Models\PeopleEmail;
use App\Models\PeoplePhone;
use App\Models\PeopleCompany;
use App\Models\PeopleUrl;
use App\Models\Industry;
use App\Models\Product;
use App\Models\Company;
use App\Models\Lead;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;


class PeopleController extends Controller
{
    // private function getSidebarStats()
    // {
    //     $user = auth()->user();

    //     $peoples = People::with('company', 'tag', 'user')->get();
    //     $myPeopleCount = $peoples->where('user_id', $user->id)->count(); // no need to query again
    //     $totalPeoples = $peoples->count();
    //     $formattedTotalPeoples = number_format($totalPeoples / 1000, 1);

    //     return compact('myPeopleCount', 'totalPeoples', 'formattedTotalPeoples');
    // }

    private function getSidebarStats()
    {
        $user = auth()->user();

        $peoples = People::with(['companies', 'tag', 'user'])->get();
        $myPeopleCount = $peoples->where('user_id', $user->id)->count();
        $totalPeoples = $peoples->count();
        $formattedTotalPeoples = number_format($totalPeoples / 1000, 1);

        return compact('myPeopleCount', 'totalPeoples', 'formattedTotalPeoples');
    }

    // public function index(Request $request)
    // {
    //     $user = auth()->user();
    //     $peoples = People::all();
    //     $query = People::with('company', 'tag', 'user');

    //     if ($request->ajax()) {
    //         // Search by lead name or people name
    //         if ($request->filled('search')) {
    //             $search = $request->search;
    //             $query->where('name', 'like', "%$search%");
    //         }

    //         // Filter by people id / assigneed to
    //         if ($request->filled('marketing_status')) {
    //             $query->where('marketing_status', $request->marketing_status);
    //         }
    //     }

    //     $peoples = $query->get();

    //     $getSidebarStats = $this->getSidebarStats();

    //     if ($request->ajax()) {
    //         return view('admin.peoples.partials.people-table-row', compact('peoples'))->render();
    //     }

    //     return view('admin.peoples.index', array_merge(
    //         compact('peoples', 'peoples'),
    //         $getSidebarStats
    //     ));
    // }

    public function index(Request $request)
    {
        $user = auth()->user();
        $query = People::with(['companies', 'tag', 'user']);

        // AJAX filters
        if ($request->ajax()) {

            // Search by people name
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('name', 'like', "%{$search}%");
            }

            // Filter by marketing_status
            if ($request->filled('marketing_status')) {
                $query->where('marketing_status', $request->marketing_status);
            }

            // Optionally filter by assigned user
            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }
        }

        // Get filtered people
        $peoples = $query->get();

        // Sidebar stats
        $sidebarStats = $this->getSidebarStats();

        // Return partial for AJAX
        if ($request->ajax()) {
            return view('admin.peoples.partials.people-table-row', compact('peoples'))->render();
        }

        // Normal page load
        return view('admin.peoples.index', array_merge(
            compact('peoples'),
            $sidebarStats
        ));
    }

    // public function my_peoples(Request $request, $id)
    // {
    //     $user = auth()->user();
    //     $users = User::all();
    //     $query = People::with('company', 'tag', 'user')
    //         ->where('user_id', $id);

    //     if ($request->ajax()) {
    //         // Search by lead name or people name
    //         if ($request->filled('search')) {
    //             $search = $request->search;
    //             $query->where('name', 'like', "%$search%");
    //         }

    //         // Filter by people id / assigneed to
    //         if ($request->filled('marketing_status')) {
    //             $query->where('marketing_status', $request->marketing_status);
    //         }
    //     }

    //     $peoples = $query->get();

    //     $getSidebarStats = $this->getSidebarStats();

    //     if ($request->ajax()) {
    //         return view('admin.peoples.partials.people-table-row', compact('peoples'))->render();
    //     }

    //     return view('admin.peoples.my-peoples', array_merge(
    //         compact('users', 'peoples'),
    //         $getSidebarStats
    //     ));
    // }



    public function my_peoples(Request $request, $id)
    {
        $user = auth()->user();
        $users = User::all();

        // Base query: people assigned to the given user
        $query = People::with(['companies', 'tag', 'user'])
            ->where('user_id', $id);

        // AJAX filters
        if ($request->ajax()) {

            // Search by people name
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('name', 'like', "%{$search}%");
            }

            // Filter by marketing_status
            if ($request->filled('marketing_status')) {
                $query->where('marketing_status', $request->marketing_status);
            }
        }

        // Get filtered people
        $peoples = $query->get();

        // Sidebar stats
        $sidebarStats = $this->getSidebarStats();

        // Return partial for AJAX
        if ($request->ajax()) {
            return view('admin.peoples.partials.people-table-row', compact('peoples'))->render();
        }

        // Normal page load
        return view('admin.peoples.my-peoples', array_merge(
            compact('users', 'peoples'),
            $sidebarStats
        ));
    }

    // public function animal_care()
    // {
    //     $user = auth()->user();
    //     $users = User::all();
    //     $peoples = People::with('company', 'tag', 'user')
    //         ->where('user_id', auth()->id())
    //         ->get();

    //     $getSidebarStats = $this->getSidebarStats();


    //     return view('admin.peoples.animal-care', array_merge(
    //         compact('users', 'peoples'),
    //         $getSidebarStats
    //     ));

    // }

    public function animal_care()
    {
        $user = auth()->user();
        $users = User::all();

        // Fetch people assigned to current user with updated relationships
        $peoples = People::with(['companies', 'tag', 'user'])
            ->where('user_id', $user->id)
            ->get();

        // Sidebar stats
        $sidebarStats = $this->getSidebarStats();

        return view('admin.peoples.animal-care', array_merge(
            compact('users', 'peoples'),
            $sidebarStats
        ));
    }


    // public function marketing_contacts()
    // {
    //     $user = auth()->user();
    //     $users = User::all();
    //     $peoples = People::with('company', 'tag', 'user')
    //         ->where('user_id', auth()->id())
    //         ->get();

    //     $getSidebarStats = $this->getSidebarStats();


    //     return view('admin.peoples.marketing-contacts', array_merge(
    //         compact('users', 'peoples'),
    //         $getSidebarStats
    //     ));

    // }

    public function marketing_contacts()
    {
        $user = auth()->user();
        $users = User::all();

        // Fetch people assigned to current user with updated relationships
        $peoples = People::with(['companies', 'tag', 'user'])
            ->where('user_id', $user->id)
            ->get();

        // Sidebar stats
        $sidebarStats = $this->getSidebarStats();

        return view('admin.peoples.marketing-contacts', array_merge(
            compact('users', 'peoples'),
            $sidebarStats
        ));
    }

    // public function sequence_healthcare()
    // {
    //     $user = auth()->user();
    //     $users = User::all();
    //     $peoples = People::with('company', 'tag', 'user')
    //         ->where('user_id', auth()->id())
    //         ->get();

    //     $getSidebarStats = $this->getSidebarStats();


    //     return view('admin.peoples.sequence-healthcare', array_merge(
    //         compact('users', 'peoples'),
    //         $getSidebarStats
    //     ));
    // }

    public function sequence_healthcare()
    {
        $user = auth()->user();
        $users = User::all();

        // Fetch people assigned to current user with updated relationships
        $peoples = People::with(['companies', 'tag', 'user'])
            ->where('user_id', $user->id)
            ->get();

        // Sidebar stats
        $sidebarStats = $this->getSidebarStats();

        return view('admin.peoples.sequence-healthcare', array_merge(
            compact('users', 'peoples'),
            $sidebarStats
        ));
    }


    // public function show($id)
    // {
    //     $peoples = People::with('company', 'user')->findOrFail($id);

    //     $activity_types = ActivityType::all(); // fetch all activities
    //     $sources = Source::all();
    //     $competitors = Competitor::all();
    //     $users = User::all();
    //     $industries = Industry::all();
    //     $persontags = Tag::where('tag_id', 3)->get();
    //     $allpeoples = People::all();
    //     $products = Product::all();
    //     $companies = Company::all();
    //     $leads = Lead::with('assignee', 'companies', 'products', 'peoples', 'sources', 'competitors')->get();

    //     return view('admin.peoples.edit', compact('peoples', 'leads', 'persontags', 'activity_types', 'sources', 'competitors', 'users', 'industries', 'allpeoples', 'products', 'companies'));
    // }

    public function show($id)
    {
        // Fetch a single person with ALL its relations
        $peoples = People::with([
            'companies',
            'tag',
            'user',
            'country',
            'state',
            'city',
            'territory',
            'peopleEmail',
            'peopleAddress',
            'peoplePhone',
            'peopleUrl',
            'peopleTask',
            'peopleCompany',
            'companiesAlt',
            'activities',
            'leadPeople',
            'leads',
            'companyPeople',
            'companies'
        ])->findOrFail($id);

        // Fetch related data
        $activity_types = ActivityType::all();
        $sources = Source::all();
        $competitors = Competitor::all();
        $users = User::all();
        $industries = Industry::all();
        $persontags = Tag::where('tag_id', 3)->get();
        $allpeoples = People::all();
        $products = Product::all();
        $companies = Company::all();

        // Fetch all leads with their relations
        $leads = Lead::with([
            'assignee',
            'companies',
            'products',
            'peoples',
            'sources',
            'competitors'
        ])->get();

        $emailTypes = [
            'email' => 'Email',
            'personal_email' => 'Personal Email',
            'support_email' => 'Support Email',
        ];

        $emails = [];

        foreach ($peoples->peopleEmail as $emailRecord) {
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

        foreach ($peoples->peopleAddress as $addressRecord) {
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

        foreach ($peoples->peoplePhone as $phoneRecord) {
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

        foreach ($peoples->peopleUrl as $urlRecord) {
            foreach ($urlTypes as $field => $label) {
                if (!empty($urlRecord->$field)) {
                    $urls[] = [
                        'selected' => $field, // which option should be selected
                        'value' => $urlRecord->$field,
                    ];
                }
            }
        }


        return view('admin.peoples.edit', compact(
            'peoples',
            'leads',
            'persontags',
            'activity_types',
            'sources',
            'competitors',
            'users',
            'industries',
            'allpeoples',
            'products',
            'companies',
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


    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'company_id' => 'required|exists:companies,id',
    //         'name' => 'required|string|max:255',
    //         'phone' => 'nullable|string',
    //         'email' => 'nullable|email',
    //         'job_title' => 'nullable|string',
    //         'description' => 'nullable|string',
    //     ]);

    //     // $people = People::create(
    //     //     $validated
    //     // );
    //     $people = People::create(array_merge($validated, [
    //         'user_id' => auth()->id()
    //     ]));


    //     if ($request->ajax()) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'People added successfully.',
    //             'people' => $people
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'People added successfully.');

    // }

    // public function ajax_store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'user_id' => 'required',
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email',
    //         'phone' => 'required|string',
    //         'code' => 'required|string',
    //         // 'bio' => 'nullable|string',
    //         // 'tag_id' => 'required',
    //         // 'territory_id' => 'required',
    //         // 'company_id' => 'required',
    //     ]);

    //     $data = [
    //         'user_id' => $validated['user_id'],
    //         'name' => $validated['name'],
    //         'email' => $validated['email'] ?? null,
    //         'phone' => $validated['phone'] ?? null,
    //         // 'company_id' => $validated['company_id'],
    //         // 'tag_id' => $validated['tag_id'],
    //         // 'territory_id' => $validated['territory_id'],
    //     ];

    //     // Conditionally add bio and url and address if they exist
    //     // doing this as are submitting add person inline form through this function as well
    //     if (!empty($validated['bio'])) {
    //         $data['bio'] = $validated['bio'];
    //     }

    //     if (!empty($validated['url'])) {
    //         $data['url'] = $validated['url'];
    //     }

    //     if (!empty($validated['address'])) {
    //         $data['address'] = $validated['address'];
    //     }

    //     $people = People::create($data);

    //     if ($request->ajax()) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'People added successfully.',
    //             'people' => $people
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'People added successfully.');
    // }


    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            // Step 1: Create People record
            $people = People::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'bio' => $request->bio,
                'territory_id' => $request->territory_id,
                'tag_id' => $request->tag_id,
            ]);

            // Step 2: Store Emails
            if ($request->email) {
                PeopleEmail::create([
                    'people_id' => $people->id,
                    'email' => $request->email,
                ]);
            }

            // Step 3: Store Phones
            if ($request->phone) {
                PeoplePhone::create([
                    'people_id' => $people->id,
                    'phone' => $request->phone,
                ]);
            }

            // Step 4: Store Addresses
            if ($request->address) {
                PeopleAddress::create([
                    'people_id' => $people->id,
                    'address' => $request->address,
                ]);
            }

            // Step 5: Store URLs
            if ($request->url) {
                PeopleUrl::create([
                    'people_id' => $people->id,
                    'url' => $request->url,
                ]);
            }

            // Step 6: Store Pivot (People Company)
            if ($request->company_id) {
                PeopleCompany::create([
                    'people_id' => $people->id,
                    'company_id' => $request->company_id,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Person created successfully!');
    }

    public function ajax_store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'code' => 'nullable|string|max:50',
        ]);

        // Step 1: Create Person
        $people = People::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'postalCode' => $validated['code'] ?? null,
            'user_id' => auth()->id(),
        ]);

        // Step 2: Store Email in people_emails table
        if (!empty($validated['email'])) {
            DB::table('people_emails')->insert([
                'people_id' => $people->id,
                'email' => $validated['email'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Person added successfully!',
            'people' => $people,
        ]);
    }

    public function delete(Request $request)
    {
        People::where('id', $request->people_id)->delete();
        return redirect()->back();
    }
}
