<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\City;
use App\Province;

class PageController extends Controller
{
    public function getprovince(){
        $client = new Client();

        try {
            $response = $client->get('https://api.rajaongkir.com/starter/province',[
                'headers'=>['key'=> '65a3eec814ae429769a39324ca3c2b30']
            ]);
        } catch (RequestException $e) {
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json=$response->getBody()->getContents();
        
        $array_result= json_decode($json, true);
        // print_r($array_result);
        for ($i=0; $i < count($array_result["rajaongkir"]["results"]); $i++) { 
            $province=new\App\Province;
            $province->id=$array_result["rajaongkir"]["results"][$i]["province_id"];
            $province->name=$array_result["rajaongkir"]["results"][$i]["province"];
            $province->save();
        }

    }
    public function getcity(){
        $client = new Client();
        
        try {
            $city = $client->get('https://api.rajaongkir.com/starter/city',[
                'headers'=>['key'=> '65a3eec814ae429769a39324ca3c2b30']
            ]);
        } catch (RequestException $e) {
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $cityview=$city->getBody()->getContents();
        
       
        $array_result= json_decode($cityview, true);
        // // print_r($array_result['rajaongkir']['results']);
       /*  $send = $array_result['rajaongkir']['results']; */
        // return view('form',compact('send'));

        // print_r($array_result);
        for ($i=0; $i < count($array_result["rajaongkir"]["results"]); $i++) { 
            $province=new\App\City;
            $province->id=$array_result["rajaongkir"]["results"][$i]["city_id"];
            $province->name=$array_result["rajaongkir"]["results"][$i]["city_name"];
            $province->id_province=$array_result["rajaongkir"]["results"][$i]["province_id"];
            $province->save();
        }

        

        // foreach ($send as $value) {
        //     $city = new City();
        //     $city->id = $value['id'];
        //     $city->name = $value['city_name'];
        //     $city->province_id = $value['province_id'];
        //     $city->save(); 
        // }

        // foreach ($send as $value) {
        //     if ($value->findOrFail($id)) {
        //         $city = City::findOrFail($id);
        //         $city->id = $value['id'];
        //         $city->name = $value['city_name'];
        //         $city->province_id = $value['province_id'];
        //         $city->save(); 
        //     } else {
        //         $city = new City();
        //         $city->id = $value['id'];
        //         $city->name = $value['city_name'];
        //         $city->province_id = $value['province_id'];
        //         $city->save(); 
        //     }
        // }

        
        

        
        
    }
    public function checkShipping(){
        $title="Check";
       $city = City::get();

       return view('jne.check-shipping',compact('title','city'));
}

public function  processShipping(Request $request){
$title="Check Shipping";
$client= new Client();

try {
    $response= $client->request('POST','https://api.rajaongkir.com/starter/cost',[
        'body'=>'origin='.$request->origin.'&destination='.$request->destination.'&weight='.$request->weight.'&courier=jne'.$request->jne,
        // 'body'=>'origin=501&destination=114&weight=1700&courier=jne',
        'headers'=>[
            'key'=>'65a3eec814ae429769a39324ca3c2b30',
            'content-type'=>'application/x-www-form-urlencoded',
        ]
    ]);
} catch (RequestException $e) {
    var_dump($e->getResponse()->getBody()->getContents());
}
$json=$response->getBody()->getContents();

$array_result= json_decode($json,true);


$origin = $array_result["rajaongkir"]["origin_details"]["city_name"];
$destination = $array_result["rajaongkir"]["destination_details"]["city_name"];
return view('jne.check-shipping-result',compact('title','origin','destination','array_result'));
}
}

       
    
   


