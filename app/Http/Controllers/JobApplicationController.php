<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applicationsWithPostAndUser = null;
        $company = auth()->user()->company;

        if ($company) {
            $ids =  $company->posts()->pluck('id');
            $applications = JobApplication::whereIn('post_id', $ids);
            $applicationsWithPostAndUser = $applications->with('user', 'post')->latest()->paginate(10);
        }
        // dd($applicationsWithPostAndUser);

        return view('job-application.index')->with([
            'applications' => $applicationsWithPostAndUser,
        ]);
    }
    public function show($id)
    {
        // dd($id);
        $application = JobApplication::find($id);

        $post = $application->post()->first();
        $userId = $application->user_id;
        $applicant = User::find($userId);
        // dd($application);
        $company = $post->company()->first();
        return view('job-application.show')->with([
            'applicant' => $applicant,
            'post' => $post,
            'company' => $company,
            'application' => $application
        ]);
    }
    public function destroy(Request $request)
    {
        $application = JobApplication::find($request->application_id);
        $application->delete();
        Alert::toast('Application deleleted', 'warning');
        return redirect()->route('jobApplication.index');
    }

    public function downloadCV($id)
    {
        $application = JobApplication::find($id);
        $file = public_path('storage\applocationCV\\'). $application->cv_file;
        // $file = "C:\\xampp\\htdocs\\fyp implementaion\\public\\storage\\applocationCV\\".$application->cv_file;
        Alert::toast('Cv Download successfull', 'success');
        return response()->download($file, $application->cv_file);
    }
}
