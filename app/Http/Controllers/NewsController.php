<?php

namespace App\Http\Controllers;

use App\Contentable;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.news.index');
    }

    public function list()
    {
        $news = News::latest()->paginate(10);
        return Response::json([
            'code' => 0,
            'result' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $param = json_decode($request->data);
        $news = new News;
        $news->title = $param->title;
        $news->type = $param->type;
        $news->country_id = $param->country;
        $news->visit_count = 0;
        $news->save();

        $this->createContent($news, $param->news_info);

        return Response::json([
            'code' => 0,
            'result' => $news,
            'message' => 'Амжилттай хадгаллаа.',
        ]);
    }

    public function createContent($news, $data)
    {
        $content = new Contentable;
        $content->contentable_id = $news->id;
        $content->contentable_type = get_class($news);
        $content->content = stripslashes($data); 

        $content->save();

        return $content;        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $news->info;
        $news->country;

        return Response::json([
            'code' => 0,
            'result' => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $param = json_decode($request->data);
        $news = News::find($id);
        $news->title = $param->title;
        $news->type = $param->type;
        $news->country_id = $param->country;
        $news->save();

        DB::table('contentable')->where('contentable_id', $news->id)->where('contentable_type', 'App\\News')->delete();

        $this->createContent($news, $param->news_info);

        return Response::json([
            'code' => 0,
            'result' => $news,
            'message' => 'Амжилттай засварлалаа.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('contentable')->where('contentable_id', $id)->where('contentable_type', 'App\\News')->delete();
        News::destroy($id);

        return Response::json([
            'code' => 0,
            'message' => 'Амжилттай устгалаа.'
        ]);
    }
}