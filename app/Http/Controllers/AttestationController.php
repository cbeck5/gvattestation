<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mail;  // <<<<
use PDF;


class AttestationController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function send()
    {
        set_time_limit(700);
		date_default_timezone_set('Europe/Paris');
        $adherents = \App\Attestation::whereNull('statut')->get();
        foreach ($adherents as $unAdherent) 
        {
        	//OK
        	if (filter_var($unAdherent->mail, FILTER_VALIDATE_EMAIL)) 
        	{ 
	            $pdf = PDF::loadView('order_pdf', compact('unAdherent'));
	            $name = $unAdherent->nom . "_" . $unAdherent->prenom . "_FactureGV.pdf";
	            $to_name = $unAdherent->prenom . " " . $unAdherent->nom;
	            $to_email = $unAdherent->mail;
	            $data = array('name'=>"GV", "body" => "A test mail");
	            Mail::send('attestation.mail', $data, function($message) use ($to_name, $to_email, $pdf, $name) 
	            {
	                $message->to($to_email, $to_name)
	                ->subject('Facture Gymnastique Vitality Communay')
	                ->attachData($pdf->output(), $name);
	                $message->from('SENDER_EMAIL_ADDRESS','Gymnastique Vitality Communay');
	            });
				\App\Attestation::where('id', $unAdherent->id)->update(['statut' => 'OK']);
			} 
			else 
			{ 
				\App\Attestation::where('id', $unAdherent->id)->update(['statut' => 'KO']);
			}
        }
        return view('attestation.mail');
    }


     public function orderPdf()
     {
         $order= \App\Attestation::first();
         $pdf = PDF::loadView('order_pdf', compact('order'));
         $name = "commandeNo.pdf";
         return $pdf->download($name);
     }
 
}