<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Str;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function getAll()
    {
        try {
            $categories = parent::getAll();
            return successResponse('Categories fetched successfully', $categories);
        } catch (Exception $e) {
            writeLog('error', 'Error fetching categories', ['exception' => $e->getMessage()]);
            return errorResponse('Failed to fetch categories', 500);
        }
    }

    public function find($id)
    {
        try {
            $category = parent::find($id);
            return successResponse('Category found', $category);
        } catch (ModelNotFoundException $e) {
            writeLog('warning', 'Category not found', ['id' => $id]);
            return notFoundResponse('Category not found');
        } catch (Exception $e) {
            writeLog('error', 'Error fetching category', ['exception' => $e->getMessage(), 'id' => $id]);
            return errorResponse('Failed to fetch category', 500);
        }
    }

    public function store(array $data)
    {
        try {
            $data['slug'] = Str::slug($data['name']);
            $category = parent::store($data);
            return successResponse('Category created successfully', $category);
        } catch (Exception $e) {
            writeLog('error', 'Error creating category', ['exception' => $e->getMessage(), 'data' => $data]);
            return errorResponse('Failed to create category', 500);
        }
    }

    public function update($id, array $data)
    {
        try {
            $category = parent::update($id, $data);
            return successResponse('Category updated successfully', $category);
        } catch (ModelNotFoundException $e) {
            writeLog('warning', 'Category not found for update', ['id' => $id]);
            return notFoundResponse('Category not found');
        } catch (Exception $e) {
            writeLog('error', 'Error updating category', ['exception' => $e->getMessage(), 'id' => $id, 'data' => $data]);
            return errorResponse('Failed to update category', 500);
        }
    }

    public function delete($id)
    {
        try {
            parent::delete($id);
            return successResponse('Category deleted successfully');
        } catch (ModelNotFoundException $e) {
            writeLog('warning', 'Category not found for deletion', ['id' => $id]);
            return notFoundResponse('Category not found');
        } catch (Exception $e) {
            writeLog('error', 'Error deleting category', ['exception' => $e->getMessage(), 'id' => $id]);
            return errorResponse('Failed to delete category', 500);
        }
    }
}
