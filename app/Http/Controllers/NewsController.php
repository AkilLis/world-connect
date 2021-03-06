<?php

namespace App\Http\Controllers;

use App\Contentable;
use App\Http\Controllers\PhotoController;
use App\News;
use Illuminate\Database\QueryBuilder;
use Illuminate\Database\Query\Builder;
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

    public function scholarship()
    {
        return view('scholarship')->with('menu', 'scholar');
    }

    public function scholarshipList()
    {
        $scholarships = News::where('type', 2)->paginate(10);

        return Response::json([
            'code' => 0,
            'result' => $scholarships,
        ]);
    }

    public function currentNews(News $news)
    {
        $news->visit_count = $news->visit_count + 1;
        $news->save();
        $news->info;
        return view('news')->with(compact('news'));
    }

    public function all(Request $request)
    {
        if(isset($request->type)) {
            if($request->type < 5)
                $query = News::where('type', $request->type)->latest();
            else {
                $query = News::where('is_pinned', 'Y')->orderBy('updated_at', 'ASC');
            }
        } 
        else $query = News::query();


        if(isset($request->search)) {
            $searchValue = trim($request->search);
            $query = $query->where('title', 'like', '%'. $request->search . '%');
        }

        $query = $query->paginate(10);
        
        return Response::json([
            'code' => 0,
            'result' => $query,
        ]);
    }

    public function related(News $news)
    {

        $query = News::with('info')->where('id', '<>', $news->id);

        if($this->countryLess($news)) {
            $query = $query->where('type', $news->type);
        } else {
            $query = $query->where('country_id', $news->country_id);
        }

        if($query->count() < 3) {

        }

        $related = $query->limit(3)->get();

        return Response::json([
            'code' => 0,
            'result' => $related,
        ]);
    }

    private function countryLess($news) {
        return $news->country_id == 0;
    }

    public function togglePin(News $news)
    {
        if($news->is_pinned == 'Y') {
            $news->is_pinned = 'N';
        } else {
            $news->is_pinned = 'Y';
        }

        $news->save();

        return Response::json([
            'code' => 0,
            'result' => $news->is_pinned,
            'message' => $news->is_pinned == 'Y' ? 'Онцлосон мэдээ болголоо' : 'Энгийн мэдээ болголоо',
        ]);
    }

    public function study(Request $request)
    {
        return view('study')->with('menu', 'study');
    }

    public function studies(Request $request)
    {
        $studies = News::where('type', 4)->paginate(3);

        return Response::json([
            'code' => 0,
            'result' => $studies,
        ]);
    }

    public function newsPage()
    {
        return view('/information')->with('menu', 'information');
    }

    public function information(Request $request)
    {
        $query = News::whereNotIn('type', [2, 4]);
        $query = $query->with('info')->latest();
        $query = $query->paginate(10);

        return Response::json([
            'code' => 0,
            'result' => $query
        ]);
    }

    public function news(Request $request)
    {
        if(isset($request->type)) {
            $type = $request->type;

            if($type == 'pinned') {
                $news = News::where('is_pinned', 'Y')
                    ->with('info')
                    ->orderBy('updated_at', 'ASC')
                    ->get();
            }

        } else {
            $news = News::with('info')->latest()->limit(4)->get();
        }

        return Response::json([
            'code' => 0,
            'result' => $news,
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
        $news = new News;
        $news->title = $request->title;
        $news->type = $request->type;
        $news->country_id = $request->country;
        $news->visit_count = 0;
        $news->is_pinned = 'N';
        $cover = $request->cover;

        $news->cover_url = PhotoController::savePhoto($cover, 'news');

        $news->save();

        $this->createContent($news, $request->news_info, $request->news_description);

        return Response::json([
            'code' => 0,
            'result' => $news,
            'message' => 'Амжилттай хадгаллаа.',
        ]);
    }

    public function createContent($news, $data, $description)
    {
        $content = new Contentable;
        $content->contentable_id = $news->id;
        $content->description = $description;
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
        $news = News::find($id);
        $news->title = $request->title;
        $news->type = $request->type;
        $news->country_id = $request->country;

        $cover = $request->cover;

        if($cover) {
            $news->cover_url = PhotoController::savePhoto($cover, 'news');
        }

        $news->save();

        DB::table('contentable')->where('contentable_id', $news->id)->where('contentable_type', 'App\\News')->delete();

        $this->createContent($news, $request->news_info, $request->news_description);

        return Response::json([
            'code' => 0,
            'result' => $news,
            'message' => 'Амжилттай засварлалаа.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @request  int  $id
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
