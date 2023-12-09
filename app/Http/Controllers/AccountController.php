<?php

namespace App\Http\Controllers;

use App\Models\CompanyCategory;
use App\Models\Education;
use App\Models\Experience;
use App\Models\JobApplication;
use App\Models\Post;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('account.user-account');
    }

    public function becomeEmployerView()
    {
        return view('account.become-employer');
    }

    public function becomeEmployer()
    {
        $user = User::find(auth()->user()->id);
        $user->removeRole('user');
        $user->assignRole('author');
        return redirect()->route('account.authorSection');
    }

    public function applyJobView(Request $request)
    {
        if ($this->hasApplied(auth()->user(), $request->post_id)) {
            Alert::toast('You have already applied for this job!', 'success');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        }else if(!auth()->user()->hasRole('user')){
            Alert::toast('You are a employer! You can\'t apply for the job! ', 'error');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        }

        $post = Post::find($request->post_id);
        $company = $post->company()->first();
        return view('account.apply-job', compact('post', 'company'));
    }

    public function applyJob(Request $request)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf'
        ]);
        // dd('ok');
        $application = new JobApplication;
        $user = User::find(auth()->user()->id);

        if ($this->hasApplied($user, $request->post_id)) {
            Alert::toast('You have already applied for this job!', 'success');
            return redirect()->route('post.show', ['job' => $request->post_id]);
        }
        $cv_file = $request->file('cv')->getClientOriginalName();
        $path = $request->file('cv')->storeAs('public/applocationCV', $cv_file);
        $application->cv_file = $cv_file;
        $application->user_id = auth()->user()->id;
        $application->post_id = $request->post_id;

        $application->save();
        Alert::toast('Thank you for applying! Wait for the company to respond!', 'success');
        return redirect()->route('post.show', ['job' => $request->post_id]);
    }

    public function changePasswordView()
    {
        return view('account.change-password');
    }

    public function changePassword(Request $request)
    {
        if (!auth()->user()) {
            Alert::toast('Not authenticated!', 'success');
            return redirect()->back();
        }

        //check if the password is valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8'
        ]);

        $authUser = auth()->user();
        $currentP = $request->current_password;
        $newP = $request->new_password;
        $confirmP = $request->confirm_password;

        if (Hash::check($currentP, $authUser->password)) {
            if (Str::of($newP)->exactly($confirmP)) {
                $user = User::find($authUser->id);
                $user->password = Hash::make($newP);
                if ($user->save()) {
                    Alert::toast('Password Changed!', 'success');
                    return redirect()->route('account.index');
                } else {
                    Alert::toast('Something went wrong!', 'warning');
                }
            } else {
                Alert::toast('Passwords do not match!', 'info');
            }
        } else {
            Alert::toast('Incorrect Password!', 'info');
        }
        return redirect()->back();
    }

    public function forTeamUpSetupForm(){
        if(UserDetail::where('user_id', auth()->user()->id)->exists()){
            $user_detail = auth()->user()->details;
            $educations = auth()->user()->education;
            $experiences = auth()->user()->experiences;
            $skills = auth()->user()->skills;
            // dd($user_detail, $education, $experience, $skill);
            return view('account.teamUp-profile', compact('user_detail', 'experiences', 'educations', 'skills'));
        }
        else{
            $job_categories = CompanyCategory::all();
            return view('account.forTeamup-user-form', compact('job_categories'));
        }
    }

    public function storeProfileData(Request $request){
        // dd($request->all());
        try {
            DB::beginTransaction();
            if(isset($request->profile_image))
            {
                $photo_name = $request->file('profile_image')->getClientOriginalName();
                $photo_path = $request->file('profile_image')->storeAs('public/images', $photo_name);
            }
            if(isset($request->resume))
            {
                $resume_name = $request->file('resume')->getClientOriginalName();
                $resume_path = $request->file('resume')->storeAs('public/resume', $resume_name);
            }
            $userDetail = UserDetail::create([
                'user_id' => auth()->user()->id,
                'firstname' => $request->input('first_name'),
                'surname' => $request->input('last_name'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'picture' => $photo_name,
                'resume' => $resume_name,
                'phone' => $request->input('phone'),
                'email' => $request->input('email_address'),
                'summary' => $request->input('SUMMARY'),
                'company_category_id' => $request->input('job_category'),
                'job_level' => $request->input('job_level'),
                'education' => $request->input('education_type'),
                'employment_type' => $request->input('employment_type'),
            ]);

            for($i = 0; $i < count($request->input('school_name')); $i++){
                $education = Education::create([
                    'user_id' => auth()->user()->id,
                    'school_name' => $request->input('school_name')[$i],
                    'school_location' => $request->input('school_location')[$i],
                    'degree' => $request->input('degree')[$i],
                    'field_of_study' => $request->input('study')[$i],
                ]);
            }

            for($i = 0; $i < count($request->input('job_title')); $i++){
                $experience = Experience::create([
                    'user_id' => auth()->user()->id,
                    'job_title' => $request->input('job_title')[$i],
                    'company_name' => $request->input('company_name')[$i],
                    'city' => $request->input('job_city')[$i],
                    'country' => $request->input('job_country')[$i],
                    'description' => $request->input('job_description')[$i],
                ]);
            }

            for($i = 0; $i < count($request->input('skill_name')); $i++){
                $skill = Skill::create([
                    'user_id' => auth()->user()->id,
                    'skill_name' => $request->input('skill_name')[$i],
                    'skill_rating' => $request->input('skill_rating')[$i],
                ]);
            }
            DB::commit();
            Alert::toast('Profile Created Successfully!', 'success');
            return redirect()->route('account.forTeamUpSetupForm');
        }
        catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['Message' => 'Unable to store data'.  $th]);
        }
    }

    public function deleteProfileData($id){
        try {
            DB::beginTransaction();
            Education::where('user_id', $id)->delete();
            Experience::where('user_id', $id)->delete();
            Skill::where('user_id', $id)->delete();
            UserDetail::where('user_id', $id)->delete();
            DB::commit();
            Alert::toast('Profile Delete Successfully!', 'success');
            return redirect()->back();
        }
        catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['Message' => 'Unable to store data'.  $th]);
        }
    }

    public function deactivateView()
    {
        return view('account.deactivate');
    }

    public function deleteAccount()
    {
        $user = User::find(auth()->user()->id);
        Auth::logout($user->id);
        if ($user->delete()) {
            Alert::toast('Your account was deleted successfully!', 'info');
            return redirect(route('post.index'));
        } else {
            return view('account.deactivate');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function hasApplied($user, $postId)
    {
        $applied = $user->applied()->where('post_id', $postId)->get();
        if ($applied->count()) {
            return true;
        } else {
            return false;
        }
    }
}
