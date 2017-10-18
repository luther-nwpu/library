<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Curl\Curl;

class ISBNController extends Controller
{
    public function getISBNInfo(Request $request){
        $curl = new Curl();
        $curl->get('http://www.example.com/');
        return $curl->response;
        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage;
        }
        else {
            echo $curl->response;
        }
    }
}
