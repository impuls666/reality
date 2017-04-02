<?php

namespace App\Http\Controllers;
use App\Marker;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class MarkerController extends Controller
{
    //
    public function index()
    {
        $markers = DB::table('markers')->get();
        //dd($markers[1]->name);
        /* $xml = new \SimpleXMLElement('<xml/>');
         $bla = $xml->addChild('bla');
         foreach ($markers as $marker) {
             $bla->addChild('name', $marker->name);
         }
         header('Content-type: text/xml');
         $vystup = $xml->asXML();

         return view('welcome',["xml"=>$vystup]);*/
        return response()->view('list', ["markers" => $markers])->header('Content-Type', 'text/xml');

        //return response()->view('pages.sitemap', compact('posts'))->header('Content-Type', 'text/xml');
    }

    public function store(Request $request)
    {
        $marker = new Marker;
        $marker->name = Input::get("name");
        $marker->type = Input::get("type");

        function getLatLong($address)
        {
            if (!empty($address)) {
                //Formatted address
                $formattedAddr = str_replace(' ', '+', $address);
                //Send request and receive json data by address
                $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddr . '&sensor=false');
                $output = json_decode($geocodeFromAddr);
                //Get latitude and longitute from json data
                $data['latitude'] = $output->results[0]->geometry->location->lat;
                $data['longitude'] = $output->results[0]->geometry->location->lng;
                //Return latitude and longitude of the given address
                if (!empty($data)) {
                    return $data;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        $address = Input::get("address");
        //$address = 'Justičná 2';
        $latLong = getLatLong($address);
        echo $latitude = $latLong['latitude']?$latLong['latitude']:'Not found';
        echo '<br>';
        echo $longitude = $latLong['longitude']?$latLong['longitude']:'Not found';

        $marker->address = $address;
        $marker->lat = $latitude;
        $marker->lng = $longitude;

        $marker->save();
        return redirect()->route('home')->with('status', 'Záznam pridaný');
    }

    public function showlatlongindex()
    {
        return view('latlng');
    }
}
