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

    function show(Request $request, $workshop = null, $slots = 30) {

        $mode = $request->get("mode") ?: "fcfs";

        $query = Registration::whereWorkshop($workshop);

        if ($mode == "fcfs") {
            $query = $query->orderBy('created_at', 'asc');
        } else if ($mode == "shuffle") {
            $query = $query->orderByRaw("RANDOM()");
        }

        $registrations = $query->take($slots)->get();

        return view("show")->with(compact("registrations"));

    }

}