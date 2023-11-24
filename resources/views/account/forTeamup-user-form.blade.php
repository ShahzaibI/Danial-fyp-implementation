@extends('layouts.account')

@section('content')
  <div class="account-layout  border">
    <div class="account-hdr bg-primary text-white border">
      Set Your Profile
    </div>
    <div class="account-bdy p-3">
      <form action="{{route('account.storeProfileData')}}" id="storeProfileData" method="POST">
        @csrf
            <div class="row ">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="textFNAM">First Name <span style="color:red; font-weight:bold;">*</span></label>
                        <input type="text" name="first_name" placeholder="First Name" class="form-control word-check" id="textFNAM" value="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label " for="textLNAM">Surname <span style="color:red; font-weight:bold;">*</span></label>
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control" id="textLNAM" value="">
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
                <div class="col-6 field-1">
                    <div class="form-group">
                        <label class="control-label " for="city">City <span style="color:red; font-weight:bold;">*</span></label>
                        <input type="text" name="city" placeholder="Lahore" maxlength="100" class="form-control" id="city" value="">
                    </div>
                </div>
                <div class="col-6 field-2">
                    <div class="form-group">
                        <label class="control-label" for="profile">Profile Photo <span style="color:red; font-weight:bold;">*</span></label>
                        <input type="file" name="profile_image" maxlength="50" class="form-control" id="profile" value="" accept="image/*">
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
                        <input type="text" name="email_address" placeholder="abc123@gmail.com" maxlength="50" class="form-control" id="EMAI" value="">
                    </div>
                </div>
            </div>
            <label class="control-label" for="summar">Summary</label><br/>
            <div class="input-group">
                <textarea class="form-control mb-3" name="SUMMARY" aria-label="With textarea" id="summar" rows="5"></textarea>
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
