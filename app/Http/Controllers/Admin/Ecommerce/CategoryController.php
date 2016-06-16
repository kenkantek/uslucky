<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ecommerce\CategoryCreateRequest;
use App\Http\Requests\Admin\Ecommerce\CategoryUpdateRequest;
use App\Models\Ecommerce\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.ecommerce.categories.index');
    }

    public function create()
    {
        return view('admin.ecommerce.categories.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        return $this->saveCategory(new Category, $request, 'Success');
    }

    public function edit(Category $category)
    {
        return view('admin.ecommerce.categories.edit', compact('category'));
    }
    //API
    public function show(Category $category)
    {
        return collect($category)->merge([
            'relationship' => [
                'key'   => $category->parent_id ? 1 : 0,
                'value' => $category->parent_id ? Category::find($category->parent_id) : null,
                'dirty' => [
                    'parent'   => !!$category->parent_id,
                    'children' => false,
                ],
            ],
        ]);
    }
    public function update(Category $category, CategoryUpdateRequest $request)
    {
        return $this->saveCategory($category, $request, 'Update success');
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }

    public function apiIndex()
    {
        return Category::oldest('position')->get();
    }

    public function autocompleteCategories(Request $request)
    {
        return Category::where($request->data ?: [])
            ->ignoreId($request->id)
            ->ignoreParent($request->parent_id)
            ->get();
    }

    private function saveCategory(Category $category, Request $request, $message = '')
    {
        $category->withName($request->name)
            ->withDisplay($request->display)
            ->withPosition($request->position);
        if ($request->relationship['key'] && $request->relationship['value']) {
            $category->withParentId($request->relationship['value']['id']);
        } else {
            $category->withParentId(0);
        }

        $category->publish();

        return response()->json([
            'redirect' => route('ecommerce.admin.ecommerce.category.index'),
            'message'  => $message,
        ]);
    }
}
