<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enc extends Model
{ 
    public static function encripter($s){
        
        $ciphering = "AES-128-CTR";
        $encryption_iv = '1234567891011121';
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_key = "pr0ntC3nt3rX";
         
        return openssl_encrypt($s, $ciphering,
                    $encryption_key, $options, $encryption_iv);

    }

    public static function decripter($h){

        $ciphering = "AES-128-CTR";
        $options = 0;       
        $decryption_iv = '1234567891011121';
        $decryption_key = "pr0ntC3nt3rX";
        $dec = openssl_decrypt ($h, $ciphering,
                $decryption_key, $options, $decryption_iv);
        $arr = explode(' - ', $dec);
        $msg = '';
        $codigo = '';

        if(is_array($arr)){
            if($arr[0] <> 'Prontcenterx_serial'){
                $msg = "Número da licença incorreto";
                $codigo = '0';
            } else{
                
                $hoje = new Datetime('now');
                $data = new DateTime($arr[1]);
                $dt = new DateTime($arr[1]);
                
                if($data < $hoje){
                    $dif = $hoje->diff($data);
                    $msg = "A licença expirou com ".$dif->format('%R%a dias');
                    $codigo = '0';
                }
                
                if($data > $hoje && $hoje >= $dt->sub(new DateInterval('P31D'))){
                    $dif = $hoje->diff($data);
                    $msg = "Faltam ".$dif->format('%R%a dias para a licença expirar');
                    $codigo = '1';
                }
            }

        }
        
        return [$msg, $codigo];                        
    }
}
