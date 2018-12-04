<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class PageController extends Controller {

	public function check_urls( Request $request ){
		return view('check-urls', [ 'urls'=> collect( explode( "\r\n", $request->urls ) )->map(function($url){
			return str_replace( "'", "", $url );
		})->toJson() ]);
	}
}
