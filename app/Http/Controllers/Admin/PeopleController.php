<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\User;
use App\Models\ActivityType;
use App\Models\Source;
use App\Models\Competitor;
use App\Models\Industry;
use App\Models\Product;
use App\Models\Company;
use App\Models\Lead;
use App\Models\Tag;


class PeopleController extends Controller
{
    private function getSidebarStats()
    {
        $user = auth()->user();

        $peoples = People::with('company', 'tag', 'user')->get();
        $myPeopleCount = $peoples->where('user_id', $user->id)->count(); // no need to query again
        $totalPeoples = $peoples->count();
        $formattedTotalPeoples = number_format($totalPeoples / 1000, 1);

        return compact('myPeopleCount', 'totalPeoples', 'formattedTotalPeoples');
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $peoples = People::all();
        $query = People::with('company', 'tag', 'user');

        if ($request->ajax()) {
            // Search by lead name or people name
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('contact_name', 'like', "%$search%");
            }

            // Filter by people id / assigneed to
            if ($request->filled('marketing_status')) {
                $query->where('marketing_status', $request->marketing_status);
            }
        }

        $peoples = $query->get();

        $getSidebarStats = $this->getSidebarStats();

        if ($request->ajax()) {
            return view('admin.peoples.partials.people-table-row', compact('peoples'))->render();
        }

        return view('admin.peoples.index', array_merge(
            compact('peoples', 'peoples'),
            $getSidebarStats
        ));
    }


    public function my_peoples(Request $request, $id)
    {
        $user = auth()->user();
        $users = User::all();
        $query = People::with('company', 'tag', 'user')
            ->where('user_id', $id);

        if ($request->ajax()) {
            // Search by lead name or people name
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('contact_name', 'like', "%$search%");
            }

            // Filter by people id / assigneed to
            if ($request->filled('marketing_status')) {
                $query->where('marketing_status', $request->marketing_status);
            }
        }

        $peoples = $query->get();

        $getSidebarStats = $this->getSidebarStats();

        if ($request->ajax()) {
            return view('admin.peoples.partials.people-table-row', compact('peoples'))->render();
        }

        return view('admin.peoples.my-peoples', array_merge(
            compact('users', 'peoples'),
            $getSidebarStats
        ));


    }

    public function animal_care()
    {
        $user = auth()->user();
        $users = User::all();
        $peoples = People::with('company', 'tag', 'user')
            ->where('user_id', auth()->id())
            ->get();

        $getSidebarStats = $this->getSidebarStats();


        return view('admin.peoples.animal-care', array_merge(
            compact('users', 'peoples'),
            $getSidebarStats
        ));

    }


    public function marketing_contacts()
    {
        $user = auth()->user();
        $users = User::all();
        $peoples = People::with('company', 'tag', 'user')
            ->where('user_id', auth()->id())
            ->get();

        $getSidebarStats = $this->getSidebarStats();


        return view('admin.peoples.marketing-contacts', array_merge(
            compact('users', 'peoples'),
            $getSidebarStats
        ));

    }


    public function sequence_healthcare()
    {
        $user = auth()->user();
        $users = User::all();
        $peoples = People::with('company', 'tag', 'user')
            ->where('user_id', auth()->id())
            ->get();

        $getSidebarStats = $this->getSidebarStats();


        return view('admin.peoples.sequence-healthcare', array_merge(
            compact('users', 'peoples'),
            $getSidebarStats
        ));
    }

    public function show($id)
    {
        $peoples = People::with('company', 'user')->findOrFail($id);

        $activity_types = ActivityType::all(); // fetch all activities
        $sources = Source::all();
        $competitors = Competitor::all();
        $users = User::all();
        $industries = Industry::all();
        $persontags = Tag::where('tag_id', 3)->get();
        $allpeoples = People::all();
        $products = Product::all();
        $companies = Company::all();
        $leads = Lead::with('assignee', 'companies', 'products', 'peoples', 'sources', 'competitors')->get();

        return view('admin.peoples.edit', compact('peoples', 'leads', 'persontags', 'activity_types', 'sources', 'competitors', 'users', 'industries', 'allpeoples', 'products', 'companies'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'contact_name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'job_title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // $people = People::create(
        //     $validated
        // );
        $people = People::create(array_merge($validated, [
            'user_id' => auth()->id()
        ]));


        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'People added successfully.',
                'people' => $people
            ]);
        }

        return redirect()->back()->with('success', 'People added successfully.');

    }

    public function ajax_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'bio' => 'nullable|string',
            'url' => 'nullable|url',
            'address' => 'nullable',
            'user_id' => 'required',
            'tag_id' => 'required',
            'territory_id' => 'required',
            'company_id' => 'required',
        ]);

        $data = [
            'user_id' => $validated['user_id'],
            'contact_name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'company_id' => $validated['company_id'],
            'tag_id' => $validated['tag_id'],
            'territory_id' => $validated['territory_id'],
        ];

        // Conditionally add bio and url and address if they exist
        // doing this as are submitting add person inline form through this function as well
        if (!empty($validated['bio'])) {
            $data['bio'] = $validated['bio'];
        }

        if (!empty($validated['url'])) {
            $data['url'] = $validated['url'];
        }

        if (!empty($validated['address'])) {
            $data['address'] = $validated['address'];
        }

        $people = People::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'People added successfully.',
                'people' => $people
            ]);
        }

        return redirect()->back()->with('success', 'People added successfully.');
    }



    public function delete(Request $request)
    {
        People::where('id', $request->people_id)->delete();
        return redirect()->back();
    }
}
