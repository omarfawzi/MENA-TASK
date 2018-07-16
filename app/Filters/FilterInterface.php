<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 16-Jul-18
 * Time: 9:44 PM
 */

namespace App\Filters;


use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

interface FilterInterface {
	public function filter(Request $request, $query);
}