<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){

        $data = $request->all();
        $success = true;

        $validator = Validator::make($data,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ],[
            'name.required' => 'Il nome è un campo obbligatorio',
            'name.max' => 'Sono consentiti al massimo :max caratteri',
            'email.required' => 'L\'email è un campo obbligatorio',
            'email.email' => 'L\'inirizzo email non è corretto',
            'email.max' => 'Sono consentiti al massimo :max caratteri',
            'message.required' => 'Il messaggio è un campo obbligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // la funzione errors() della classe Validator resituisce un array
                // in cui la chiave è il campo soggetto a validazione
                // e il valore è un array di messaggi di errore
                'errors' => $validator->errors()
            ]);
        }

        // salviamo a db i dati inseriti nel form di contatto
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // inviamo la mail all'admin del sito, passando il nuovo oggetto Lead
        Mail::to('info@boolpress.com')->send(new NewContact($new_lead));

        return response()->json([
            'success' => true,
        ]);

    }
}
