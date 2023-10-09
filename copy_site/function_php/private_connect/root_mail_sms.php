<?php


class root_mail_sms{

    public function cssmail($contenumail,$pmail,$pform,$psujet,$ptitle,$piedpage, $pdonnearray, $commentmail){
	
        /*
        $contenumail: contenu html tu mail
        $pmail: du desintaire 
        $pform: le mail qui envois
        $psujet: le sujet du mail 
        $title: title du documents
        $piedpage: contenu pied de page
        */
    
                $versionphp = phpversion();// version php
                $cssmail = $pmail;
                $frommail =  'Harouna HAROUNA <'.$pform.'>'; 
                $sujetmail = $psujet; 
                $message = $ptitle;
                $message.=$commentmail; 
                $message.=$contenumail; 
    
                $headers  = 'From: Harouna HAROUNA <'.$pform.'>'."\r\n";
                $headers .= 'Bcc: hharouna@resumehharouna.net';
                $headers .= 'MIME-Version: 1.0'."\r\n";
                $headers .= 'X-Mailer: PHP/'.$versionphp."\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
                $headers .= 'X-Confirm-Reading-To: Harouna HAROUNA<'.$pform.'>'."\r\n";
                $headers .= 'X-Priority: 3'."\r\n";
                $headers .= 'Priority: urgent'."\r\n";

                 $arraymail = array($cssmail,$frommail,$message,$headers);
                 //$arraymail = array($mail,$frommail,$message,$headers); 
                 
                 if(mail($cssmail,$sujetmail ,$message,$headers)){
                    
                       return json_encode($pdonnearray); 
                    }
                else{
                    return "Error Envois mail."; 
                }
        }










}




?>
