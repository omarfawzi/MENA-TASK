<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function validate( $request, $validation_data ) {
		$validator = Validator::make( $request->all(), $validation_data );
		if ( $validator->fails() ) {
			response()->json( $validator->errors() )->send();
			exit;
		}
	}
}
