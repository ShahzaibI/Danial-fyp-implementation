<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <title>Template4</title>
</head>

<body>
    <div class="container p-0 shadow-lg h-full my-4" id="parent">
        <div class="px-4 pt-4 pb-2">
            <div class="style fw-bold fs-3 pb-0">{{ $clUserData->firstName }} {{ $clUserData->lastName }}</div>
            <div class="style pt-2">{{ $clUserData->profession }}</div>
            <div class="fw-bold pb-1 pt-3"><i class="fa-solid fa-square-phone"></i><span class="fw-light"> {{ $clUserData->phone }}</span></div>
            <div class="fw-bold"><i class="fa-sharp fa-solid fa-envelope"></i><span class="fw-light"> {{ $clUserData->email }}</span></div>
            <div class="fw-bold"><i class="fa-sharp fa-solid fa-location-dot"></i><span class="fw-light"> {{ $clUserData->city }}, {{ $clUserData->country }}, {{ $clUserData->zipCode }}</span></div>
        </div>
        <div class="pt-3 px-4 fw-bold">
            <div class="textColor font-11">{{ $clUserData->city }}, {{ $date }}</div>
            {{-- Recipient Information --}}
            @if($clRecipientData->firstName != null && $clRecipientData->lastName != null)
                <div class="font-14 mt-4">{{ $clRecipientData->firstName }} {{ $clRecipientData->lastName }}</div>
                <div class="textColor font-11 mt-1">{{ $clRecipientData->position }}</div>
            @endif
            <div class="font-11 mt-3 textColor">{{ $clRecipientData->companyName }}</div>
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
            <!-- Opening -->
            <div class="font-11 textColor fw-lighter lh-2" align="justify">{{ $clUserData->opening }}</div>
            <!-- Body -->
            <div class="font-11 textColor fw-lighter lh-2 mt-3" align="justify">{{ $clUserData->body }}</div>
            <!-- Closing -->
            <div class="font-11 textColor fw-lighter lh-2 mt-3" align="justify">{{ $clUserData->closing }}</div>
            <!-- Name of employeer -->
            <div class="font-11 textColor fw-lighter lh-2 mt-3">
                <span>Sincerely,</span>
                <br>
                <span class="fw-bold">
                    {{ $clUserData->firstName }} {{ $clUserData->lastName }}
                </span>
            </div>
        </div>
    </div>
    <input type='button' value='Download pdf' onclick='myApp.printDiv()'/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!--FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/51244a13a5.js" crossorigin="anonymous"></script>
</body>

</html>
