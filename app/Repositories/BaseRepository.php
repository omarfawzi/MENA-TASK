<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 16-Jul-18
 * Time: 9:12 PM
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface BaseRepository {
	public function all();

	public function save(Request $request);

	public function update(Request $request, $id);

	public function delete($id);

	public function show($id);

	public function output($data,$response);
}