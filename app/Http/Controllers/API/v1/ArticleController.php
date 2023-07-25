<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\Article as ResourcesArticle;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $article = Article::all();

        return $this->sendResponse(ResourcesArticle::collection($article), 'Articles retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
            'image' => 'mimes:jpg,jpeg,png',
            'category' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $image = $input['image']->file('image');
        $imageExtension = $image->getClientOriginalExtension();
        $fileNameImage = $input['image'] . '.' . $imageExtension;
        $input['image'] = $fileNameImage;

        $article = Article::create($input);

        Storage::putFileAs('public/images/', $image, $fileNameImage);

        return $this->sendResponse(new ResourcesArticle($article), 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::find($id);

        if (is_null($article)) {
            return $this->sendError('Article not found.');
        }

        return $this->sendResponse(new ResourcesArticle($article), 'Article retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        $input = $request->all();

    $validator = Validator::make($input, [
        'title' => 'required|max:255',
        'content' => 'required|max:65535',
        'image' => 'required|mimes:jpg,jpeg,png', // Update the validation rule for the image
        'category' => 'required'
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());
    }

    // Handle image upload if provided
    $image = $input['image']->file('image');
    $imageExtension = $image->getClientOriginalExtension();
    $fileNameImage = $input['image'] . '.' . $imageExtension;

    // Update the article attributes
    $article->title = $input['title'];
    $article->content = $input['content'];
    $article->category = $input['category'];
    $article->image = $fileNameImage;

    Storage::putFileAs('public/images/', $image, $fileNameImage);

    $article->save();

    return $this->sendResponse(new ResourcesArticle($article), 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): JsonResponse
    {
        $article->delete();

        return $this->sendResponse([], 'Article deleted successfully.');
    }
}
