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
            return successResponse(__('messages.category.fetch_success'), $categories);
        } catch (Exception $e) {
            writeLog('error', 'Error fetching categories', ['exception' => $e->getMessage()]);
            return errorResponse(__('messages.category.fetch_error'), 500);
        }
    }

    public function find($id)
    {
        try {
            $category = parent::find($id);
            return successResponse(__('messages.category.fetch_success'), $category);
        } catch (ModelNotFoundException $e) {
            writeLog('warning', 'Category not found', ['id' => $id]);
            return notFoundResponse(__('messages.category.not_found'));
        } catch (Exception $e) {
            writeLog('error', 'Error fetching category', ['exception' => $e->getMessage(), 'id' => $id]);
            return errorResponse(__('messages.category.fetch_error'), 500);
        }
    }

    public function store(array $data)
    {
        try {
            $data['slug'] = Str::slug($data['name']);
            $category = parent::store($data);
            return successResponse(__('messages.category.create_success'), $category);
        } catch (Exception $e) {
            writeLog('error', 'Error creating category', ['exception' => $e->getMessage(), 'data' => $data]);
            return errorResponse(__('messages.category.create_error'), 500);
        }
    }

    public function update($id, array $data)
    {
        try {
            $category = parent::update($id, $data);
            return successResponse(__('messages.category.update_success'), $category);
        } catch (ModelNotFoundException $e) {
            writeLog('warning', 'Category not found for update', ['id' => $id]);
            return notFoundResponse(__('messages.category.not_found'));
        } catch (Exception $e) {
            writeLog('error', 'Error updating category', ['exception' => $e->getMessage(), 'id' => $id, 'data' => $data]);
            return errorResponse(__('messages.category.update_error'), 500);
        }
    }

    public function delete($id)
    {
        try {
            parent::delete($id);
            return successResponse(__('messages.category.delete_success'));
        } catch (ModelNotFoundException $e) {
            writeLog('warning', 'Category not found for deletion', ['id' => $id]);
            return notFoundResponse(__('messages.category.not_found'));
        } catch (Exception $e) {
            writeLog('error', 'Error deleting category', ['exception' => $e->getMessage(), 'id' => $id]);
            return errorResponse(__('messages.category.delete_error'), 500);
        }
    }
}
