<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $news = NewsResource::collection(News::orderBy('id', 'desc')->paginate(2))->additional(['meta' => ['success' => true, 'message' => 'success get all data']]);
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
        'title' => ['required', 'unique:App\Models\News,title'],
        'body' => ['required'],
        'images' => ['required', 'mimes:jpg,jpeg,png']
      ],
      [
        'title' => [
          'required' => 'Title must be filled',
          'unique' => 'Title must be unique',
        ],
        'body' => [
          'required' => 'Body must be filled'
        ],
        'images' => [
          'required' => 'Image must be filled',
          'mimes' => 'File must be images with extension (JPG, JPEG, PNG)'
        ]
      ]
    );

    if ($validated->fails()) {
      return $this->errorAuthenticated('error data. make sure data filled.', $validated->errors());
    }

    // insert
    $data = [
      'user_id' => Auth::id(),
      'title' => $request->title,
      'slug' => Str::of($request->title)->slug('-'),
      'body' => $request->body,
      'images' => asset(url("storage") . "/" . $request->file('images')->store('images')),
    ];
    News::create($data);

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
    $news = News::find($id);
    if ($news) {
      return (new NewsResource($news))->additional(['meta' => ['success' => true, 'message'=> 'success get data id ' . $id]]);
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
  public function update(Request $request, News $news)
  {
    $role = [
      'title' => ['required'],
      'body' => ['required'],
    ];
    $messages = [
      'title' => [
        'required' => 'Title must be filled',
      ],
      'body' => [
        'required' => 'Body must be filled'
      ],
    ];

    if ($request->title != $news->title) {
      $role['title'] = ['required', 'unique:App\Models\News,title'];
      $messages['title'] = [
        'required' => 'Title must be filled',
        'unique' => 'Title must be unique',
      ];
    }

    $validated = Validator::make(
      $request->all(),
      $role,
      $messages
    );

    if ($validated->fails()) {
      return $this->errorAuthenticated('error data. make sure data filled.', $validated->errors());
    }

    // update
    $data = [
      'user_id' => Auth::id(),
      'title' => $request->title,
      'slug' => Str::of($request->title)->slug('-'),
      'body' => $request->body,
    ];
    $news->update($data);

    return $this->sendResponse($data, 'success update news');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, News $news)
  {
    // delete
    $id = $request->id;
    if($news->delete()){
      return $this->sendResponse([], 'success delete data id ' . $id);
    }
  }
}
