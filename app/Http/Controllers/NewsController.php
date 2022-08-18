<?php

namespace App\Http\Controllers;

use App\Events\NewsCreated;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|ResponseFactory|Response
     */
    public function index()
    {
        $tasks = News::latest()->get();

        return response($tasks, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return Response
     */
    public function store(StoreNewsRequest $request)
    {
        $request->merge(['user_id' => $request->user()->id]);
        $news = News::create($request->all());

        NewsCreated::dispatch($news);

        return response($news, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return Response
     */
    public function show(News $news)
    {
        return response($news, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsRequest $request
     * @param News $news
     * @return Application|Response|ResponseFactory
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $news = $news->update($request->all());

        return response($news, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return response([], 204);
    }
}
