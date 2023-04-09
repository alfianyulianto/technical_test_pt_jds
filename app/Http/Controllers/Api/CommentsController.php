<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class CommentsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $value = Cache::remember('comment', 1, function () {
      return Comment::where('user_id', Auth::id())->orderBy('news_id', 'desc')->paginate(2);
    });
    
    $news = (CommentResource::collection($value))->additional(['meta' => ['success' => true, 'message' => 'success get all data']]);
    return $news;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validated = Validator::make(
      $request->all(),
      [
        'comment' => ['required'],
        'news_id' => ['required'],
      ],
      [
        'comment' => [
          'required' => 'Commment must be filled',
        ],
        'news_id' => [
          'required' => 'Id news must be filled',
        ],
      ]
    );

    if ($validated->fails()) {
      return $this->errorAuthenticated('error data. make sure data filled.', $validated->errors());
    }

    // insert
    $data = [
      'user_id' => Auth::id(),
      'user_name' => Auth::user()->name,
      'news_id' => $request->news_id,
      'news_title' => News::find($request->news_id)->title,
      'comment' => $request->comment,
    ];


    Cache::remember('comment', 1, function () use($data) {
      return Comment::create($data);
    });

    return $this->sendResponse($data, 'success add one news');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $value = Cache::remember('comment', 1, function () use ($id) {
      return Comment::find($id);
    });
    if ($value) {
      return (new CommentResource($value))->additional(['meta' => ['success' => true, 'message' => 'success get data id ' . $id]]);
    }

    return $this->errorResponse('Not found data id ' . $id);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Comment $comment)
  {
    $validated = Validator::make(
      $request->all(),
      [
        'comment' => ['required'],
        'news_id' => ['required'],
      ],
      [
        'comment' => [
          'required' => 'Commment must be filled',
        ],
        'news_id' => [
          'required' => 'Id news must be filled',
        ],
      ]
    );

    if ($validated->fails()) {
      return $this->errorAuthenticated('error data. make sure data filled.', $validated->errors());
    }

    // insert
    $data = [
      'user_id' => Auth::id(),
      'user_name' => Auth::user()->name,
      'news_id' => $request->news_id,
      'news_title' => News::find($request->news_id)->title,
      'comment' => $request->comment,
    ];

    $comment->update($data);

    return $this->sendResponse($data, 'success add one news');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comment $comment)
  {
    // delete
    $id = $comment->id;
    if ($comment->delete()) {
      return $this->sendResponse([], 'success delete comment with id ' . $id);
    }
  }
}