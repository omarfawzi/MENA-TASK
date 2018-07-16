<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 16-Jul-18
 * Time: 9:44 PM
 */

namespace App\Filters;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait FilterTrait {
	public function filter(Request $request, $query){

		foreach ( $this->filterFields as $field ) {
			if ( $request->has( $field ) ) {
				$sign = $field . '_sign';
				if ( $request->has( $sign ) && ! in_array( $request->$sign, $this->parentSigns[ $field ] ) ) {
					response()->json( [
						'data'   => 'Invalid Sign , Available : ' . implode( ' , ', $this->parentSigns[ $field ] ),
						'status' => Response::HTTP_NOT_ACCEPTABLE
					], Response::HTTP_NOT_ACCEPTABLE )->send();
					exit;
				} else if ( $request->has( $sign ) && in_array( $request->$sign, $this->parentSigns[ $field ] ) ) {
					$query->whereDate( $field, $request->$sign, $request->$field );
				} else {
					$query->where( $field, $request->$field );
				}
			}
			if ( $request->has( 'orderBy' ) && is_array( $request->orderBy ) && in_array( $field, $request->orderBy ) ) {
				$sort = in_array( strtolower( $request->sort ), $this->sort ) ? strtolower( $request->sort ) : 'asc';
				$query->orderBy( $field, $sort );
			}
		}

		if ( $request->has( 'paginate' ) ) {
			$query->paginate( $request->paginate );
		}

		return $query;
	}
}