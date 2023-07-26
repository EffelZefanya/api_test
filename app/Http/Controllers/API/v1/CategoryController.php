<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\Category as ResourcesCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resourc+e.
     */
    public function index(): JsonResponse
    {
        $category = Category::all();

        return $this->sendResponse(ResourcesCategory::collection($category), 'Category retrieved successfully.');
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
    public function store(StoreCategoryRequest $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255|unique:categories',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $category = Category::create($input);

        return $this->sendResponse(new ResourcesCategory($category), 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return $this->sendError('category not found.');
        }

        return $this->sendResponse(new ResourcesCategory($category), 'Category retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255|unique:categories',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category->name = $input['name'];
        $category->save();

        return $this->sendResponse(new ResourcesCategory($category), 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->sendResponse([], 'Category deleted successfully.');
    }
}
