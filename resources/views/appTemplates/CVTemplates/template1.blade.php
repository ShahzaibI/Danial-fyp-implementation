<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href={{ asset('css/Templates_css/cvTemplates/template1.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link href={{asset('css/bootstrap-5.0.2-dist/css/bootstrap.min.css')}} rel="stylesheet"> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script> --}}
    <script>
        var myApp = new function () {
            this.printDiv = function () {
                // Store DIV contents in the variable.
                var div = document.getElementById('parent');

                // Create a window object.
                var win = window.open('', '', 'height=800px,width= 630px'); // Open the window. Its a popup window.
                win.document.write(div.outerHTML);     // Write contents in the new window.
                win.document.close();
                win.print();       // Finally, print the contents.
            }
        }
    </script>
    <title>Template1</title>
</head>

<body>
    <div class="container shadow-lg pb-4 h-full my-4" id="parent">
        <footer class="style">
            @if(isset($user_detail))
                <div class="d-flex justify-content-between">
                    <div class="fs-1 align-self-center">
                        <span class="{{$color}} fw-bold">
                            {{ $user_detail->firstname }} {{ $user_detail->surname }}
                        </span>
                    </div>
                    @if ($image == 'yes' && $user_detail->picture != NULL)
                        <div class="pt-2 pe-5">
                            {{-- <span><img class="rounded-circle" src="/storage/images/{{ $user_detail->picture}}" alt="" height="100" width="90"></span> --}}
                            <span><img class="rounded-circle" src="http://localhost/fyp%20implementaion/public/storage/images/{{ $user_detail->picture }}" alt="" height="100" width="90"></span>
                            {{-- <span><img class="rounded-circle" src="{{ asset('fyp%20implementaion/public/storage/images/'. $user_detail->picture) }}" alt="" height="100" width="90"></span> --}}
                        </div>
                    @endif
                </div>
                <div class="pt-2 font-11 height">
                    <p align="justify">{{ $user_detail->summary }}</p>
                </div>
            @endif
        </footer>
        <main>
            <div class="d-flex">
                <div class="w-25">
                    <div class="style">
                        @if(isset($user_detail))
                            <div class="border-bottom border-2">
                                <div class="{{$color}} style">
                                    <span class="fs-4"><i class="fa-solid fa-circle-user"></i></span>
                                    <span class="fs-5 fw-bold">Contact</span>
                                </div>
                            </div>
                            <div class="mt-4 font-11">
                                <div class="fw-bold">Address</div>
                                {{-- <div>Bhubhtian,Lahore,5100</div> --}}
                                <div>{{ $user_detail->city }}, {{ $user_detail->country }}, {{ $user_detail->postalcode }}</div>
                                <div class="fw-bold">Phone</div>
                                {{-- <div>+923056989967</div> --}}
                                <div>{{ $user_detail->phone }}</div>
                                <div class="fw-bold">Email</div>
                                {{-- <div>sg03056924122@gmail.com</div> --}}
                                <div>{{ $user_detail->email }}</div>
                            </div>
                        @endif
                    </div>
                    <div class="style mt-4">
                        @if(count($skill)!= 0)
                            <div class="border-bottom border-2">
                                <div class="{{$color}} style">
                                    <span class="fs-4"><i class="fa-solid fa-puzzle-piece"></i></span>
                                    <span class="fs-5 fw-bold">Skills</span>
                                </div>
                            </div>
                        @endif
                        <div class="mt-4 font-11">
                            {{-- <ul class="ps-4"> --}}
                                {{-- <li>Html</li>
                                <li>Css</li>
                                <li>Java</li>
                                <li>Flutter</li> --}}
                                @foreach ($skill as $skill_data)
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            {{ $skill_data->skillName }}
                                        </div>
                                        <div>
                                            {{ $skill_data->skillRating }}

                                        </div>
                                    </div>
                                @endforeach
                            {{-- </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="ps-5 w-75">
                    <div class="style">
                        @if(count($experience) != 0)
                            <div class="border-bottom border-2">
                                <div class="{{$color}} style">
                                    <span class="fs-4"><i class="fa-solid fa-briefcase"></i></span>
                                    <span class="fs-5 fw-bold">Work Experience</span>
                                </div>
                            </div>
                        @endif
                        <div class="mt-4">
                            @foreach ($experience as $exp_data)
                                <div class="d-flex style">
                                    <div class="w-60px font-14">
                                        <span>{{ $exp_data->start_year }}-{{ $exp_data->start_month }}</span>
                                        <span> - </span>
                                        @if ($exp_data->end_year == 'Current' && $exp_data->end_month == 'Current')
                                            <span>{{ $exp_data->end_year }}</span>
                                        @else
                                            <span>{{ $exp_data->end_year }}-{{ $exp_data->end_month }}</span>
                                        @endif
                                    </div>
                                    <div class="ps-4 w-345px">
                                        <div class="fw-bold font-14">
                                            {{-- Macro Mobile Solutions --}}
                                            {{ $exp_data->company_name }}
                                        </div>
                                        <div class="font-11">
                                            {{-- Gulbarg,Lahore City --}}
                                            {{ $exp_data->city }}, {{ $exp_data->country }}
                                        </div>
                                        <div>
                                            <ul class="font-11 ps-4">
                                                <li>
                                                    <p align="justify">{{ $exp_data->description }}</p>
                                                </li>
                                                {{-- <li>Improved and optimized main website’s UI for seamless customer experience.</li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="d-flex style">
                                <div class="w-25 font-14">
                                    <span>2021-03</span>
                                    <span> - </span>
                                    <span>2022-03</span>
                                </div>
                                <div class="ms-4">
                                    <div class="fw-bold font-14">
                                        Omega Mobile Co.
                                    </div>
                                    <div class="font-11">Valencia,Lahore City</div>
                                    <div>
                                        <ul class="font-11 ps-4">
                                            <li>Developed a highly functional set of applications for a large printing
                                                house’s equipment.</li>
                                            <li>Designed a sophisticated flight data analysis tool for a flight school
                                                using C++.</li>
                                            <li>Developed cross-platform compatible solutions.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="style">
                        @if(count($education) != 0)
                            <div class="border-bottom border-2">
                                <div class="{{$color}} style">
                                    <span class="fs-4"><i class="fa-sharp fa-solid fa-graduation-cap"></i></span>
                                    <span class="fs-5 fw-bold">Education</span>
                                </div>
                            </div>
                        @endif
                        <div class="mt-4">
                            <div class="ms-60 style">
                                @foreach ($education as $edu_data)
                                    <div class="mt-2">
                                        <div class="fw-bold font-14">
                                            <span>{{ $edu_data->degree }}: </span>
                                            <span>{{ $edu_data->field_of_study }}</span>
                                        </div>
                                        <div class="font-11 pt-1">
                                            {{ $edu_data->school_name }} - {{ $edu_data->school_location }}
                                        </div>
                                    </div>
                                    {{-- <div class="mt-2">
                                        <div class="fw-bold font-14">
                                            <span>Degree: </span>
                                            <span>Bachlor of Science in Computer Sceince BS(CS)</span>
                                        </div>
                                        <div class="font-11 pt-1">
                                            The University of Lahore (UOL) - Lahore city, Pakistan
                                        </div>
                                    </div> --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<input type='button' value='Download pdf' onclick='myApp.printDiv()'/>
{{-- https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!--FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/51244a13a5.js" crossorigin="anonymous"></script>
</body>

</html>
