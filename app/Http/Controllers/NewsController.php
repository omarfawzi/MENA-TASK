<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
	public $news_repo;

	public function __construct(NewsRepository $news_repository) {
		$this->news_repo = $news_repository ;
	}

	/**
     * Display a listing of news.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
	    return $this->news_repo->all();
    }

    /**
     * Store a newly created news in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
	    return $this->news_repo->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
	    return $this->news_repo->show($id);

    }

    /**
     * Update the specified news in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
	    return $this->news_repo->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
	    return $this->news_repo->delete($id);
    }
}
