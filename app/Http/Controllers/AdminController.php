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

        $mode = $request->get("mode") ?: "fcfs";

        $query = Registration::whereWorkshop($workshop);

        if ($mode == "fcfs") {
            $query = $query->orderBy('created_at', 'asc');
        } else if ($mode == "shuffle") {
            $query = $query->orderByRaw("RAND()");
        }

        if ($slots !== '*') {
            $query = $query->take($slots);
        }

        $registrations = $query->get();

        $bccString = "";
        foreach ($registrations as $registration) {
            if ($registration->email) {
                $bccString .= $registration->name . " <" . $registration->email . ">, ";
            }
        }
        $bccString = substr($bccString, 0, -2);

        return view("list")->with(compact("registrations", 'workshop', 'mode', 'bccString'));

    }

}
