@extends('layouts.account')

@section('content')
@php
    $parts = explode(' ', auth()->user()->name, 2); // Split into at most 2 parts based on space
    if (count($parts) == 1) {
        $parts[] = ''; // If only one part exists, add an empty string as the second part
    }
@endphp
    <div class="account-layout  border">
        <div class="account-hdr bg-primary text-white border">
        Set Your Profile
        </div>
        <div class="account-bdy p-3">
            <form action="{{route('account.storeProfileData')}}" id="storeProfileData" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="textFNAM">First Name <span style="color:red; font-weight:bold;">*</span></label>
                            <input type="text" name="first_name" placeholder="First Name" class="form-control word-check" id="textFNAM" value="{{ $parts[0] }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label " for="textLNAM">Surname <span style="color:red; font-weight:bold;">*</span></label>
                            <input type="text" name="last_name" placeholder="Last Name" class="form-control" id="textLNAM" value="{{ $parts[1] }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="textDCTL">Address <span style="color:red; font-weight:bold;">*</span></label>
                            <input type="text" name="address" placeholder="90 D Rizwan Block Awan Town" class="form-control" id="textDCTL" value="">
                            <div id="address-error" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 field-1">
                        <div class="form-group">
                            <label class="control-label " for="city">City <span style="color:red; font-weight:bold;">*</span></label>
                            <input type="text" name="city" placeholder="Lahore" maxlength="100" class="form-control" id="city" value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 field-2">
                        <div class="form-group">
                            <label class="control-label" for="profile">Profile Photo <span style="color:red; font-weight:bold;">*</span></label>
                            <input type="file" name="profile_image" maxlength="50" class="form-control" id="profile" value="" accept="image/*">
                        </div>
                    </div>
                    <div class="col-6 field-2">
                        <div class="form-group">
                            <label class="control-label" for="resume">Resume <span style="color:red; font-weight:bold;">*</span></label>
                            <input type="file" name="resume" maxlength="50" class="form-control" id="resume" value="" accept=".pdf,application/pdf">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="HPHN">Phone <span style="color:red; font-weight:bold;">*</span></label>
                            <input type="number" name="phone" placeholder="03056989967" maxlength="20" class="form-control" id="HPHN" value="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-email">
                        <div class="form-group">
                            <label class="control-label" for="EMAI">Email <span style="color:red; font-weight:bold;">*</span></label>
                            <input type="text" name="email_address" placeholder="abc123@gmail.com" maxlength="50" class="form-control" id="EMAI" value="{{ auth()->user()->email }}" readonly>
                        </div>
                    </div>
                </div>
                <label class="control-label" for="summar">Summary</label><br/>
                <div class="input-group">
                    <textarea class="form-control mb-3" name="SUMMARY" aria-label="With textarea" id="summar" rows="5"></textarea>
                </div>
                <div class="education-container">
                    <div class="text-primary fs-5 fw-light pb-3">
                        Tell us about your education
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school" class="control-label">School Name <span style="color:red; font-weight:bold;">*</span></label>
                                    <div role="combobox" class="autosuggest-container">
                                        <input type="text" class="form-control autosuggest" placeholder="(i.e). University Of Lahore" name="school_name[]" id="school" maxlength="50" spellcheck="true" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="SCLO" class="control-label">School Location <span style="color:red; font-weight:bold;">*</span></label>
                                    <div role="combobox" class="autosuggest-container">
                                        <input type="text" class="form-control autosuggest" placeholder="(i.e). Lahore city, Pakistan" name="school_location[]" id="SCLO" maxlength="50" autosuggesttype="googleplaces" spellcheck="true" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Education type <span style="color:red; font-weight:bold;">*</span></label>
                                    <select name="degree[]" class="form-select" id="degree">
                                        <option selected disabled>Not Selected</option>
                                        <option value="Degree">Degree</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Certification">Certification</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="STUY" class="control-label">Education <span style="color:red; font-weight:bold;">*</span></label>
                                    <div role="combobox" class="autosuggest-container">
                                        <input type="text" class="form-control autosuggest" placeholder="(i.e). Bachelor of science in Computer Science" name="study[]" id="STUY" maxlength="50" autosuggesttype="fieldofstudy" spellcheck="true" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="font-weight-bold another-class" id="add_new_degree"><i class="fas fa-plus-circle icon-add pe-2" aria-hidden="true"></i>Add Another Degree</p>
                </div>
                <div class="experience-section experience-container">
                    <div class="text-primary fs-5 fw-light py-3">
                        Tell us about your experience
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="position" class="control-label">Job Title <span style="color:red; font-weight:bold;">*</span></label>
                                    <input type="text" name="job_title[]" class="form-control" placeholder="(i.e). Software Engineer" id="position" maxlength="50" spellcheck="true" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="company">Company Name <span style="color:red; font-weight:bold;">*</span></label>
                                    <input type="text" name="company_name[]" placeholder="(i.e). Macro Mobile Solutions" maxlength="100" class="form-control" id="company" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-city col-sm-6">
                                <div class="form-group">
                                    <label class="control-label " for="jobcity">City <span style="color:red; font-weight:bold;">*</span></label>
                                    <input type="text" name="job_city[]" placeholder="(i.e). Lahore" maxlength="100" class="form-control" id="jobcity" autocomplete="address-level2" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="jobcountry">Country <span style="color:red; font-weight:bold;">*</span></label>
                                    <input type="text" name="job_country[]" placeholder="(i.e). Pakistan" maxlength="50" class="form-control" id="jobcountry" value="">
                                </div>
                            </div>
                        </div>
                        <label class="control-label" for="jobdescription">Description</label><br/>
                        <div class="input-group">
                            <textarea class="form-control mb-3" name="job_description[]" aria-label="With textarea" id="jobdescription" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="font-weight-bold another-class" id="add_new_experience"><i class="fas fa-plus-circle icon-add pe-2" aria-hidden="true"></i>Add Another Experience</p>
                </div>
                <div class="skills-container">
                    <div class="text-primary fs-5 fw-light py-3">
                        Write your skill here
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="skillname" class="control-label">Skill Name <span style="color:red; font-weight:bold;">*</span></label>
                                    <input type="text" name="skill_name[]" class="form-control" placeholder="(i.e). Android developer" id="skillname" maxlength="50" spellcheck="true" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="skillrating" class="control-label">Rating <span style="color:red; font-weight:bold;">*</span></label>
                                    <select id="rating" name="skill_rating[]" class="form-select">
                                        <option disabled selected value="">out of 10</option>
                                        <option value="10/10">10/10</option>
                                        <option value="09/10">09/10</option>
                                        <option value="08/10">08/10</option>
                                        <option value="07/10">07/10</option>
                                        <option value="06/10">06/10</option>
                                        <option value="05/10">05/10</option>
                                        <option value="04/10">04/10</option>
                                        <option value="03/10">03/10</option>
                                        <option value="02/10">02/10</option>
                                        <option value="01/10">01/10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="font-weight-bold another-class" id="add_new_skill"><i class="fas fa-plus-circle icon-add pe-2" aria-hidden="true"></i>Add Another Skill</p>
                </div>
                <div class="">
                    <div class="text-primary fs-5 fw-light py-3">
                        Refine Your Job
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="job_category" class="control-label">Job Category <span style="color:red; font-weight:bold;">*</span></label>
                                <select id="job_category" name="job_category" class="form-select">
                                    <option disabled selected value="">-- select an option --</option>
                                    @foreach ($job_categories as $job_category)
                                        <option value="{{ $job_category['id'] }}">{{ $job_category['category_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="job_level" class="control-label">Job Level <span style="color:red; font-weight:bold;">*</span></label>
                                <select id="job_level" name="job_level" class="form-select">
                                    <option disabled selected value="">-- select an option --</option>
                                    <option value="Senior level">Senior level</option>
                                    <option value="Mid level">Mid level</option>
                                    <option value="Top level">Top level</option>
                                    <option value="Entry level">Entry level</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="education_type" class="control-label">Education <span style="color:red; font-weight:bold;">*</span></label>
                                <select id="education_type" name="education_type" class="form-select">
                                    <option disabled selected value="">-- select an option --</option>
                                    <option value="Bachelors">Bachelors</option>
                                    <option value="High School">High School</option>
                                    <option value="Master">Master</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="employment_type" class="control-label">Employment Type <span style="color:red; font-weight:bold;">*</span></label>
                                <select id="employment_type" name="employment_type" class="form-select">
                                    <option disabled selected value="">-- select an option --</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-divider"></div>
                <div class="mt-3">
                    <button type="submit" class="btn primary-btn">Save</button>
                    <a href="{{ route('account.index') }}" class="btn primary-outline-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endSection

@push('css')
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        display: none;
    }
  </style>
@endpush
