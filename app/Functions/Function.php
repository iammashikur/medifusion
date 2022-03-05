<?php

use App\Models\Agent;
use App\Models\Doctor;
use App\Models\DoctorLocation;
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
function appointmentPay ($patient, $location, $agent = null) {


    if ($agent) {
        $agentCommission  = Agent::find($agent)->commission;
    } $agentCommission = 0;


    // test var
    $appointmentFee = DoctorLocation::find($location)->consultation_fee;
    $patientDiscount  = Doctor::find(DoctorLocation::find($location)->doctor_id)->discount;
    $medicCommission  = Doctor::find(DoctorLocation::find($location)->doctor_id)->commission;


    $q = ($appointmentFee * $medicCommission) / 10000;
    $x = ($patientDiscount * $q);
    $amountToPay = $appointmentFee - $x;

    $agentGets = $q * $agentCommission;
    $medicGets = $q * (100 - $patientDiscount - $agentCommission);
    $doctorGets  = $amountToPay - ($medicGets + $agentGets);


    return
        'Payable    : ' . $amountToPay . '<br>' .
        'Doctor Gets: ' . $doctorGets . '<br>' .
        'Medic Gets : ' . $medicGets . '<br>' .
        'Agent Gets : ' . $agentGets;
};

//echo $appointmentPay();
