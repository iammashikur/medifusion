<?php

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;



// Active Menu Button

function MenuActive($segment, $match)
{
    if (request()->segment($match) == $segment) {
        return 'active';
    }
}


function MakeImage(Request $request, $fileName, $path)
{
    /**
     * Image resizing and saving in defined dirs
     */
    if ($request->hasFile($fileName)) {
        $image = $request->file($fileName);
        // Extension
        $imageExt = $image->extension();
        // Changing the file name
        $FullImageName = time() . '-' . uniqid() . '.' . $imageExt;
        // intervention Make image
        $imageResize = Image::make($image->getRealPath());
        // local store path
        $fullPath = $path . $FullImageName;
        // saving image
        $imageResize->save($fullPath);

        return $FullImageName;
    }
}



// Percentage
$percentToAmount = fn ($amount, $percent) => ($percent / 100) * $amount;

// Payment
$appointmentPay = function ($patient = null, $doctor = null, $agent = null) {
    // Percentage
    $percentToAmount = fn ($amount, $percent) => ($percent / 100) * $amount;

    // test var
    $appointmentFee = 1500;
    $patientDiscount  = 10;
    $medicCommission  = 50;
    $agentCommission  = 50;

    $q = ($appointmentFee * $medicCommission) / 10000;
    $x = ($patientDiscount * $q);
    $amountToPay = $appointmentFee - $x;

    $agentGets = $q * $agentCommission;
    $medicGets = $q * (100 - $patientDiscount - $agentCommission);
    $doctorGets  = $amountToPay - ($medicGets + $agentGets);


    echo
        'Payable    : ' . $amountToPay . '<br>' .
        'Doctor Gets: ' . $doctorGets . '<br>' .
        'Medic Gets : ' . $medicGets . '<br>' .
        'Agent Gets : ' . $agentGets;
};

//echo $appointmentPay();
