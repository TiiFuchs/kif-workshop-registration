<?php
/**
 * Created by PhpStorm.
 * User: Tii
 * Date: 02.05.16
 * Time: 15:37
 */

namespace App\Http\Controllers;


use App\Registration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    function index(Request $request)
    {
        $messages = $request->session()->get("messages") ?: [];

        return view("registration")->with(compact("messages"));

    }

    function participate(Request $request)
    {

        $name = $request->get("name");
        $workshops = $request->get("workshops");

        $messages = [];

        // If no workshop was selected, return with info message
        if (count($workshops) == 0) {
            $messages[] = $this->generateMessage("Du hast keinen Workshop ausgewählt.", "info");
            return redirect("/")->with(compact("messages"))->withInput();
        }

        foreach ($workshops as $workshop) {
            try {
                Registration::create(compact("name", "workshop"));

                $messages[] = $this->generateMessage("Du wurdest für '" . $this->getWorkshopName($workshop) . "' erfolgreich angemeldet.", "success");
            } catch (QueryException $e) {
                if ($e->getCode() == 23000) { // Duplicate Entry
                    $messages[] = $this->generateMessage("Du bist bereits für '" . $this->getWorkshopName($workshop) . "' angemeldet.", "info");
                } else {
                    $messages[] = $this->generateMessage("Bei der Anmeldung von '" . $this->getWorkshopName($workshop) . "' ist ein Fehler aufgetreten. <br>
                        Bitte kontaktiere einen Orga deines Vertrauens.", "danger");
                }
            }
        }

        return redirect("/")->with(compact("messages"))->withInput();

    }

    /* Helper functions */

    protected $workshopNames = [
        "ebd" => "EBD Workshop",
        "theater" => "Theatervorführung"
    ];

    private function getWorkshopName($workshopId)
    {
        if (array_key_exists($workshopId, $this->workshopNames)) {
            return $this->workshopNames[$workshopId];
        } else {
            return $workshopId;
        }
    }

    private function generateMessage($text, $type = "success")
    {
        $obj = new \stdClass();
        $obj->text = $text;
        $obj->type = $type;

        return $obj;
    }

}
