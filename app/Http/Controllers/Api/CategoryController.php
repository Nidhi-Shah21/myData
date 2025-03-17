<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return $this->categoryRepository->getAll();
    }

    public function store(Request $request)
    {
        return $this->categoryRepository->store($request->all());
    }

    public function show($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->categoryRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
