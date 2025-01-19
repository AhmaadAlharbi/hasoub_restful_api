<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50 ?  $request->input('limit') : 15;

        $tag = TagResource::collection(Tag::paginate($limit));
        return $tag->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);
        $tag = new TagResource(Tag::create($request->all()));
        return $tag->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tag = new TagResource(Tag::findOrFail($id));
        return $tag->response()->setStatusCode(200, 'tag Returned Succefully')
            ->header('Addition Header', 'True');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idtag = Tag::findOrFail($id);
        $this->authorize('update', $idtag);
        $tag = new TagResource(Tag::findOrFail($id));
        $tag->update($request->all());

        return $tag->response()->setStatusCode(200, 'tag updated succefully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idtag = Tag::findOrFail($id);
        $this->authorize('delete', $idtag);
        Tag::findOrFail($id)->delete();
        return 204;
    }
}
