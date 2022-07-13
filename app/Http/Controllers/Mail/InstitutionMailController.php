<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use Illuminate\Http\Request;
use Mail;

class InstitutionMailController extends Controller
{
    public function registerInstitution(InstitutionRequest $request) {

        $email = $request->institution_email;
        $name = $request->institution_name;

        $data = array('name'=>$name);
        Mail::send('mail.institution.register', $data, function($message) use ($email, $name){
            $message->to($email, $name)->subject
            ('Institution Register');
            $message->from('institution@vinco.digital','Vinco Education');
        });
    }
}
