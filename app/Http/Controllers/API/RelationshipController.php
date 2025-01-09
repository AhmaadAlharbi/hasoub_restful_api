<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RelationshipController extends Controller
{
    public function userLessons($id)
    {

        $user = User::findOrFail($id)->lessons;
        $fields = array();
        $filtered = array();
        foreach ($user as $lesson) {
            $fields['Title'] = $lesson->title;
            $fields['content'] = $lesson->body;
            $filtered[] = $fields;
        }
        return Response::json([
            'data' => $filtered
        ], 200);
    }

    public function lessonTags($id)
    {
        $lesson = Lesson::find($id)->tags;
        $fields = array();
        $filtered = array();
        foreach ($lesson as $tag) {
            $fields['Tag'] = $tag->name;
            $filtered[] = $fields;
        }
        return Response::json([
            'data' => $filtered
        ], 200);
    }
    public function tagLesson($id)
    {
        $tag = Tag::find($id)->lessons;
        $fields = array();
        $filtered = array();
        foreach ($tag as $lesson) {
            $fields['Title'] = $lesson->title;
            $fields['Content'] = $lesson->body;
            $filtered[] = $fields;
        }
        return Response::json([
            'data' => $filtered
        ], 200);
    }
}