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
            Your Profile
        </div>
        <div class="account-bdy p-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="text-primary fs-3 fw-light pb-3 pt-3 ">
                        User Detail
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('account.editProfile') }}" class="btn primary-btn" title="click to send email">Edit</a>
                    <a href="{{ route('account.deleteProfileData', auth()->user()->id) }}" class="btn danger-btn" title="click to send email">Delete</a>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        @if ($user_detail->picture != NULL)
                            <div class="col-md-4 text-center order-md-2">
                                <img src="/storage/images/{{ $user_detail->picture}}" alt="" class="rounded-circle" height="200" width="200">
                            </div>
                        @endif
                        <div class="col-md-8 order-md-1">
                            <h2 class="text-primary card-text fw-light"><b>Name: </b>{{ $user_detail->firstname }} {{ $user_detail->surname }}</h2>
                            <p class="card-text fw-light"><b>Email: </b>{{ $user_detail->email }}</p>
                            <p class="card-text fw-light"><b>Phone: </b>{{ $user_detail->phone }}</p>
                            <p class="card-text fw-light"><b>Address: </b>{{ $user_detail->address }}</p>
                            <p class="card-text fw-light"><b>City: </b>{{ $user_detail->city }}</p>
                        </div>

                    </div>
                    <p class="card-text fw-light"><b>Summary: </b>{{ $user_detail->summary }}</p>
                </div>
            </div>

            <div class="text-primary fs-3 fw-light py-3">
                Education description
            </div>
            <div class="">

                @foreach ($educations as $education)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $education->degree }}: {{ $education->field_of_study }}</h5>
                        <p class="card-text fw-light"><b>School: </b>{{ $education->school_name }}</p>
                        <p class="card-text fw-light"><b>Location: </b>{{ $education->school_location }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-primary fs-3 fw-light pb-3 pt-3 ">
                Experience Detail
            </div>
            <div class="">
                @foreach ($experiences as $experience)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $experience->job_title }}</h5>
                        <p class="card-text fw-light"><b>Organization Name: </b>{{ $experience->company_name }}</p>
                        <p class="card-text fw-light"><b>Location: </b>{{ $experience->city }}, {{ $experience->country }}</p>
                        <p class="card-text fw-light"><b>Description: </b>{{ $experience->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-primary fs-3 fw-light pb-4 pt-2">
                Skills description
            </div>
            <div class="row">
                @foreach ($skills as $skill)
                <div class="col-md-6">

                    <div class="card mb-3">
                        <div class="card-body">
                            {{-- <h5 class="card-title text-primary">Yours Skills</h5> --}}
                            <p class="card-text fw-light"><b>Title: </b>{{ $skill->skill_name }}</p>
                            <p class="card-text fw-light"><b>Rating: </b>{{ $skill->skill_rating }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
