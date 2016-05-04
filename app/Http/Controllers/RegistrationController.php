<?php
/**
 * Created by PhpStorm.
 * User: Tii
 * Date: 02.05.16
 * Time: 15:37
 */

namespace App\Http\Controllers;


use App\Registration;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    protected $activationTime = null;

    function __construct() {
        $timeString = env("KIF_ACCESS_FROM");
        $this->activationTime = Carbon::createFromFormat("Y-m-d H:i:s", $timeString, "Europe/Berlin");
    }

    private function isRegistrationActive() {
        return $this->activationTime->isPast();
    }

    function index(Request $request)
    {
        $messages = $request->session()->get("messages") ?: [];

        $isActive = $this->isRegistrationActive();

        if (!$isActive) {
            $messages[] = $this->generateMessage("info:Du kannst dich erst ". $this->activationTime->formatLocalized("am %d.%m ab %H:%M Uhr") . " zu den Workshops anmelden.");
        }

        return view("registration")->with(compact("messages", "isActive"));

    }

    function participate(Request $request)
    {
        // Check for time
        if (!$this->isRegistrationActive()) {
            return redirect("/")->withInput();
        }

        $validator = \Validator::make($request->all(), [
            "name" => "required",
            "uni" => "required",
            "email" => "email",
            "workshops" => "required"
        ], [
            "name.required" => "Bitte gib deinen <strong>Nicknamen</strong> an.",
            "uni.required" => "Bitte gib deine <strong>Universität</strong> an, um Verwechslungen zu vermeiden.",
            "email.email" => "Bitte gib eine gültige <strong>E-Mail Adresse</strong> an unter der wir dich über Informationen benachrichtigen können. (Oder lass das Feld leer.)",
            "workshops.required" => "Bitte wähle mindestens einen <strong>Workshop</strong> aus."
        ]);
        
        if ($validator->fails()) {
            return redirect("/")->withErrors($validator)->withInput();
        }
        
        
        $name = $request->get("name");
        $uni = $request->get("uni");
        $email = $request->get("email");
        $workshops = $request->get("workshops");

        $messages = [];

        foreach ($workshops as $workshop) {
            try {
                $registration = Registration::create(compact("name", "uni", "email", "workshop"));
                $allRegistrations = Registration::whereWorkshop($workshop)->orderBy('created_at', 'asc')->get()->toArray();
                $num = 1;
                for (; $num <= count($allRegistrations); $num++) {
                    if ($allRegistrations[$num - 1]['id'] == $registration->id)
                        break;
                }

                $seats = env("KIF_" . strtoupper($workshop) . "_SEATS");

                $position_waitlist = $num - $seats;

                $mail_notice = !empty($email)
                    ? "Du wirst per E-Mail benachrichtigt, wenn spontan ein Platz frei wird."
                    : "";

                $seat_message = $num <= $seats
                    ? "Du hast einen garantierten Platz im Workshop. Wenn du aus irgendeinem Grund nicht kannst, melde dich bitte beim Orga vom Dienst in D120."
                    : "Du stehst auf Platz $position_waitlist der Warteliste. $mail_notice";

                $messages[] = "success:Du hast dich erfolgreich für '" . $this->getWorkshopName($workshop) . "' eingetragen.<br>
                $seat_message";
            } catch (QueryException $e) {

                if ($e->getCode() == 23000) { // Duplicate Entry
                    $messages[] = "info:Du bist bereits für '" . $this->getWorkshopName($workshop) . "' eingetragen.";

                } else {
                    $messages[] = "danger:Bei der Anmeldung von '". $this->getWorkshopName($workshop) ."' ist ein Fehler aufgetreten. <br>
                    <strong>Bitte kontaktiere den Orga vom Dienst in D120.</strong>";
                }
            }
        }

        $messages = $this->generateMessages($messages);

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

    private function generateMessage($message) {
        $obj = new \stdClass();
        $obj->class = strtok($message, ":");
        $obj->text = strtok("");
        return $obj;
    }

    private function generateMessages($messages)
    {
        $messageArray = [];
        foreach ($messages as $message) {
            $messageArray[] = $this->generateMessage($message);
        }

        return $messageArray;
    }

}
