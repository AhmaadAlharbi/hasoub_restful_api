<?php

use App\Models\Tag;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\RelationshipController;
use App\Http\Middleware\onceBasic;
use App\Http\Middleware\OnceBasic as MiddlewareOnceBasic;
use Illuminate\Support\Facades\Response;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('lessons', LessonController::class)->middleware(OnceBasic::class);
Route::apiResource('users', UserController::class);
Route::apiResource('tags', TagController::class);

Route::get('/users/{id}/lessons', [RelationshipController::class, 'userLessons']);
Route::get('/lessons/{id}/tags', [RelationshipController::class, 'lessonTags']);
Route::get('/tags/{id}/lessons', [RelationshipController::class, 'tagLesson']);
Route::any('lesson', function () {
    $message = 'Invalid URL. Please use /api/lessons for accessing the lessons API.';
    return Response::json($message, 404);
});
// Route::redirect('lesson', 'lessons');
Route::any('user', function () {
    return 'Invalid URL. Please use /api/users for accessing the users API.';
});
Route::redirect('user', 'users');
