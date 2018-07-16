<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 16-Jul-18
 * Time: 9:46 PM
 */

namespace App\Filters;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsFilter implements FilterInterface {

	public $filterFields = [ 'date', 'title' ];

	public $dateAvailableSigns = [ '=', '<', '>', '<=', '>=' ];

	public $titleAvailableSigns = [ 'LIKE' ];

	public $orderBy = [ 'asc', 'desc' ];

	public function filter( Request $request, $query ) {

		if ( $request->has( 'date' ) ) {
			if ( $request->has( 'date_sign' ) && ! in_array( $request->date_sign, $this->dateAvailableSigns ) ) {
				response()->json( 'Invalid Date Sign , Available : ' . implode( ' , ', $this->dateAvailableSigns ), Response::HTTP_NOT_ACCEPTABLE )->send();
				exit;
			} else if ( $request->has( 'date_sign' ) && in_array( $request->date_sign, $this->dateAvailableSigns ) ) {
				$query->whereDate( 'date', $request->date_sign, $request->date );
			} else {
				$query->where( 'date', $request->date );
			}
		}

		if ( $request->has( 'title' ) ) {
			if ( $request->has( 'title_sign' ) && ! in_array( $request->title_sign, $this->titleAvailableSigns ) ) {
				response()->json( 'Invalid Title Sign , Available :  ' . implode( $this->titleAvailableSigns ), Response::HTTP_NOT_ACCEPTABLE )->send();
				exit;
			} else if ( $request->has( 'title_sign' ) && in_array( $request->title_sign, $this->titleAvailableSigns ) ) {
				$query->where( 'title', $request->title_sign, '%' . $request->title . '%' );
			} else {
				$query->where( 'title', $request->title );
			}
		}

		if ( $request->has( 'paginate' ) ) {
			$query->paginate( $request->paginate );
		}

//		if ($request->has('limit')){
//			$query->limit($request->limit);
//		}

		if ( $request->has( 'orderBy' ) && in_array( strtolower( $request->orderBy ), $this->orderBy ) ) {
			$query->orderBy( 'date', $request->orderBy );
		}

		return $query;
	}
}