<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private Category $category;
    private array $categoryTree;

    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->categoryTree = [];
    }

    public function index()
    {
        $categories = $this->category->all();
        $categoryTree = $this->buildCategoryTree($categories);
        return view('admins.pages.categories.index', compact('categoryTree'));
    }

    public function create()
    {
        $categories = $this->category->all();
        $categoryTree = $this->buildCategoryTree($categories);
        return view('admins.pages.categories.create', compact('categoryTree'));
    }

    private function buildCategoryTree($categories, $parentId = 0, $prefix = '')
    {
        foreach ($categories as $key => $category)
        {
            if ($category['parent_id'] == $parentId)
            {
                $this->categoryTree[$category['id']]['id'] = $category['id'];
                $this->categoryTree[$category['id']]['name'] = $prefix.$category['name'];
                $this->buildCategoryTree($categories, $category['id'], $prefix.'----------------');
            }
        }

        return $this->categoryTree;
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Create category successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $category = $this->category->findOrFail($id);
        $categories = $this->category->all();
        $categoryTree = $this->buildCategoryTree($categories);
        return view('admins.pages.categories.edit', compact('category', 'categoryTree'));
    }

    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = $this->category->findOrFail($id);
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', 'Create category successfully!');
    }

    public function destroy(string $id)
    {
        if ($this->category->where('parent_id', $id)->exists())
        {
            return redirect()->route('admin.categories.index')->with('error', 'Please delete sub-category first!');
        }

        $this->category->destroy($id);
        return redirect()->route('admin.categories.index')->with('success', 'Delete category successfully!');
    }
}
