<?php

namespace App\Repositories;


use App\Filters\NewsFilter;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsRepository extends Controller implements BaseRepository {

	public $filter ;
	public $model ;

	public function __construct(News $news,NewsFilter $news_filter) {
		$this->model = $news;
		$this->filter = $news_filter;
	}

	public function all() {
		$this->validate(request(),
			[
				'date'=>'nullable|date_format:Y-m-d',
				'date_sign'=>'nullable|in:'.implode(',', $this->filter->dateAvailableSigns),
				'title_sign'=>'nullable|in:'.implode(',', $this->filter->titleAvailableSigns),
			]
		);

		$query = $this->filter->filter(request(),$this->model::query());
		return $this->output($query->get());
	}

	public function save( Request $request ) {
		$this->validate($request,
			[
				'title'=>'required',
				'description'=>'required',
				'text'=>'required',
				'date'=>'required|date_format:Y-m-d'
			]
		);

		$this->setData($request);

		$this->model->save();

		return $this->output($this->model,Response::HTTP_CREATED);
	}

	public function update( Request $request, $id ) {
		$this->validate(request(),
			[
				'date'=>'nullable|date_format:Y-m-d'
			]
		);

		if ($this->exists($id)) {
			$this->setData( $request );
			$this->model->update();
		}
		return $this->output( $this->model, Response::HTTP_OK );

	}

	public function delete( $id ) {
		$message = 'Already Deleted';
		if ($this->exists($id)) {
			$this->model->destroy( $id );
			$message = 'Deleted Successfully';
		}
		return $this->output($message,Response::HTTP_OK);
	}

	public function show( $id ) {

		$this->model = $this->model->find($id);

		return $this->output($this->model,Response::HTTP_FOUND);
	}

	public function setData(Request $request){
		if ($request->title)
			$this->model->title = $request->title;
		if ($request->text)
			$this->model->text = $request->text;
		if ($request->description)
			$this->model->description = $request->description;
		if ($request->date)
			$this->model->date = $request->date;
	}

	public function output( $data, $status = Response::HTTP_OK ) {
		return response()->json(['data'=>$data,'status'=>$status],$status);
	}

	public function exists($id){
		$this->model = $this->model->find($id);

		return $this->model ? true : false;
	}
}