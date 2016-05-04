<?php
/**
 * Created by PhpStorm.
 * User: Tii
 * Date: 02.05.16
 * Time: 18:23
 */

namespace App\Http\Controllers;


use App\Registration;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    function __construct() {

        $this->authorize('generate-lists');
    }

    function listRegistrations(Request $request, $workshop = null, $slots = '*') {

        $allRegistrations = Registration::whereWorkshop($workshop)->orderBy('created_at', 'asc')->get();

        if ($slots != "*") {
            // limit registrations and create waitinglist
            $registrations = $allRegistrations->slice(0, $slots);

            $waitinglist = $allRegistrations->slice($slots, $slots);
        } else {
            $registrations = $allRegistrations;

            $waitinglist = [];
        }

        $bccString = "";
        foreach ($registrations as $registration) {
            if ($registration->email) {
                $bccString .= $registration->name . " <" . $registration->email . ">, ";
            }
        }
        $bccString = substr($bccString, 0, -2);

        return view("list")->with(compact("registrations", "waitinglist", 'workshop', 'bccString'));

    }

}
