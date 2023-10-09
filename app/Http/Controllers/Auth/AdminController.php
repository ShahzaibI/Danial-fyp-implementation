<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyCategory;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Skill;
use App\Models\User;
use App\Models\ClUser;
use App\Models\Clreceiver;
use App\Models\UserDetail;
use App\Models\Company;
use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
        $authors = User::role('author')->with('company')->paginate(30);
        $roles = Role::all()->pluck('name');
        $permissions = Permission::all()->pluck('name');
        $rolesHavePermissions = Role::with('permissions')->get();

        $dashCount = [];
        $dashCount['author'] = User::role('author')->count();
        $dashCount['user'] = User::role('user')->count();
        $dashCount['post'] = Post::count();
        $dashCount['livePost'] = Post::where('deadline', '>', Carbon::now())->count();

        return view('account.dashboard')->with([
            'companyCategories' => CompanyCategory::all(),
            'dashCount' => $dashCount,
            'recentAuthors' => $authors,
            'roles' => $roles,
            'permissions' => $permissions,
            'rolesHavePermissions' => $rolesHavePermissions,
        ]);
    }
    public function viewAllUsers()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->latest()->paginate(30);
        return view('account.view-all-users')->with([
            'users' => $users
        ]);
    }

    public function destroyUser(Request $request)
    {
        // Company
        $company = Company::where('user_id', $request->user_id)->first();
        if($company != null)
        {
            $company_id = $company->id;
            $company->delete();
            $post = Post::where('company_id', $company_id)->get();
            $post->each->delete();
        }

        //Application deleted
        $applications = JobApplication::where('user_id', $request->user_id)->get();
        $applications->each->delete();

        // Cover letter delete
        $clUser = Cluser::where('user_id', $request->user_id)->get();
        $clReceiver = Clreceiver::where('user_id', $request->user_id)->get();
        $clUser->each->delete();
        $clReceiver->each->delete();
        //cv delete
        $educations = Education::where('user_id', $request->user_id)->get();
        $experiences = Experience::where('user_id', $request->user_id)->get();
        $skills = Skill::where('user_id', $request->user_id)->get();
        $userDetail = UserDetail::where('user_id', $request->user_id)->get();
        $educations->each->delete();
        $experiences->each->delete();
        $skills->each->delete();
        $userDetail->each->delete();
        $user = User::findOrFail($request->user_id);
        if ($user->delete()) {
            Alert::toast('Deleted Successfully!', 'danger');
            return redirect()->route('account.viewAllUsers');
        } else {
            return redirect()->intented('account.viewAllUsers');
        }
    }
}
