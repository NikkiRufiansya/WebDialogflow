<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

Use App\data_trainingModel;

use File;

use Redirect;

use Response;
class FirebaseController extends Controller

{

//

public function index(Request $request){

    $request->validate([
        'name' => 'required',
        'responses' => 'required',
        'phrases' => 'required'

    ]);
    // dd($request->all());
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }


    $json = '{
        "id": "ee9a5b64-f196-4759-b67b-dca363668560",
        "name": "'.$request->name.'",
        "auto": true,
        "contexts": [],
        "responses": [
          {
            
            "resetContexts": false,
            "affectedContexts": [],
            "parameters": [],
            "messages": [
              {
                "type": 0,
                "condition": "",
                "speech": "'.$request->responses.'"
              }
            ],
            "defaultResponsePlatforms": {},
            "speech": []
          }
        ],
        "priority": 500000,
        "webhookUsed": false,
        "webhookForSlotFilling": false,
        "fallbackIntent": false,
        "events": [],
        "userSays": [
          {
            "id": "0dcf65e0-1f7d-440d-a8e8-6ad8eaa5a5f2",
            "data": [
              {
                "text": "'.$request->phrases.'",
                "userDefined": false
              }
            ],
            "isTemplate": false,
            "count": 0,
            "updated": 0,
            "isAuto": false
          }
          
        ],
        "followUpIntents": [],
        "liveAgentHandoff": false,
        "endInteraction": false,
        "conditionalResponses": [],
        "condition": "",
        "conditionalFollowupEvents": [],
        "templates": []
      }';
      $nama_file = $request->name.'_'.$randomString.'.json';
     
      Storage::put('public/'.$nama_file,$json); 
     
      $path = storage_path().'/'.'app'.'/public'.'/'.$nama_file;

      data_trainingModel::create([
        'intent' => $request->name,
        'url_file' => $path,
        'json' =>  $json,
        'nama_file' => $nama_file
      ]);


      if (file_exists($path)) {
        return Response::download($path);
      }else{
       // echo "file tidak ada";
      }
      
      
      return redirect('/pertanyaan');
}



}

?>