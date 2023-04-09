<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function sendResponse($result, $message)
  {
    $response = [
      'data' => $result,
      'meta' => [
        'success' => true,
        'message' => $message,
      ]
    ];

    return response()->json($response, 200);
  }

  public function errorResponse($message)
  {
    $response = [
      'meta' => [
        'success' => false,
        'message' => $message
      ]
    ];

    return response()->json($response, 404);
  }

  public function successAuthenticated($result, $message, $token)
  {
    $response = [
      'data' => $result,
      'token' => $token,
      'meta' => [
        'success' => true,
        'message' => $message,
      ]
    ];

    return response()->json($response, 200);
  }


  public function errorAuthenticated($message, $errors)
  {
    $response = [
      'meta' => [
        'success' => false,
        'message' => $message,
        'errors' => $errors
      ]
    ];

    return response()->json($response, 401);
  }
}