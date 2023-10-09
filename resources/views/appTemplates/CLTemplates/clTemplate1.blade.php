<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="/Templates/template1.css" rel="stylesheet"> -->
    <link href={{asset('css/Templates_css/CoverLetterTemplates/clTemplate1.css')}} rel="stylesheet">
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
    <div class="container p-0 shadow-lg h-full my-4" id="parent">
        <div class="d-flex">
            <div class="w-250 bg-darkGray h-full">
                {{-- <div class="style fw-bold fs-3 p-3 pb-0">Haider Saeed Jutt</div> --}}
                <div class="style fw-bold fs-3 p-3 pb-0">{{ $clUserData->firstName }} {{ $clUserData->lastName }}</div>
                {{-- <div class="style fw-bold p-2 ps-3">Software Engineer</div> --}}
                <div class="style fw-bold p-2 ps-3">{{ $clUserData->profession }}</div>
                <div class="style pt-2">
                    <div class="style transparent">
                        <span class="fs-5 fw-bold ps-3">Personal Info</span>
                    </div>
                    <div class="mt-2 font-11 p-2 ps-3">
                        {{-- <div class="fw-bold">Phone</div>
                        <div class="pb-1">+923056989967</div>
                        <div class="fw-bold">Email</div>
                        <div class="pb-1">sg03056924122@gmail.com</div>
                        <div class="fw-bold">Address</div>
                        <div class="pb-1">Lahore, Pakistan, 54000</div> --}}
                        <div class="fw-bold">Phone</div>
                        <div class="pb-1">{{ $clUserData->phone }}</div>
                        <div class="fw-bold">Email</div>
                        <div class="pb-1">{{ $clUserData->email }}</div>
                        <div class="fw-bold">Address</div>
                        <div class="pb-1">{{ $clUserData->city }}, {{ $clUserData->country }}, {{ $clUserData->zipCode }}</div>
                    </div>
                </div>
            </div>
            <div class="px-3 pt-4 w-380 style fw-bold">
                {{-- <div class="textColor font-11">Lahore, 31/10/2022</div> --}}
                <div class="textColor font-11">{{ $clUserData->city }}, {{ $date }}</div>
                {{-- Recipient Information --}}
                {{-- <div class="font-14 mt-4 fw-bold">Mr. Danial Kaiser</div> --}}
                @if($clRecipientData->firstName != null && $clRecipientData->lastName != null)
                    <div class="font-14 mt-4 fw-bold">{{ $clRecipientData->firstName }} {{ $clRecipientData->lastName }}</div>
                    {{-- <div class="textColor font-11 mt-1">CEO of Software House</div> --}}
                    <div class="textColor font-11 mt-1">{{ $clRecipientData->position }}</div>
                @endif
                {{-- <div class="font-11 mt-3 textColor">Omega Mobile Co.</div> --}}
                <div class="font-11 mt-3 textColor">{{ $clRecipientData->companyName }}</div>
                {{-- <div class="font-11 textColor mt-1">Lahore, Pakistan 51000</div> --}}
                @if($clRecipientData->city != null && $clRecipientData->country != null && $clRecipientData->zipCode != null )
                    <div class="font-11 textColor mt-1">{{ $clRecipientData->city }}, {{ $clRecipientData->country }}, {{ $clRecipientData->zipCode }}</div>
                @endif
                <div class="font-11 textColor pt-3">
                    RE: {{ $clUserData->jobTitle }}
                </div>
                <div class="textColor font-11 my-3">
                    @if(@isset($clRecipientData->firstName) && @isset($clRecipientData->lastName))
                        Dear {{ $clRecipientData->firstName }},
                    @else
                        Dear Sir,
                    @endif
                </div>
                <!-- opening -->
                <div class="font-11 textColor fw-light lh-2" align="justify">{{ $clUserData->opening }}</div>
                <!-- Letter body -->
                <div class="font-11 textColor fw-light lh-2 mt-3" align="justify">{{ $clUserData->body }}</div>
                <!-- Call to action -->
                <div class="font-11 textColor fw-light lh-2 mt-3" align="justify">{{ $clUserData->closing }}</div>
                <!-- Name of employeer -->
                <div class="font-11 textColor fw-light lh-2 mt-3">
                    <span>Sincerely,</span>
                    <br>
                    <span class="fw-bold">
                        {{ $clUserData->firstName }} {{ $clUserData->lastName }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <input type='button' value='Download pdf' onclick='myApp.printDiv()'/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
