<?php

namespace App\Http\Controllers\API;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Lesson as LessonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LessonController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50 ?  $request->input('limit') : 15;

        $lesson = LessonResource::collection(Lesson::paginate($limit));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = new LessonResource(Lesson::create($request->all()));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = new LessonResource(Lesson::findOrFail($id));
        return $lesson->response()->setStatusCode(200, 'lesson Returned Succefully')
            ->header('Addition Header', 'True');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idlesson = Lesson::findOrFail($id);
        $this->authorize('update', $idlesson);
        $lesson = new LessonResource(Lesson::findOrFail($id));
        $lesson->update($request->all());

        return $lesson->response()->setStatusCode(200, 'tag updated succefully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idlesson = Lesson::findOrFail($id);
        $this->authorize('delete', $idlesson);
        Lesson::find($id)->delete();
        return 204;
    }
}
