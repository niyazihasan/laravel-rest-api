<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseCategoryRequest;
use App\Http\Resources\ExpenseCategoryResource;
use App\Models\ExpenseCategory;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $expenseCategory = ExpenseCategory::all();
        return ExpenseCategoryResource::collection($expenseCategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ExpenseCategoryRequest $request
     * @return ExpenseCategoryResource
     */
    public function store(ExpenseCategoryRequest $request)
    {
        try {
            $expenseCategory = new ExpenseCategory();
            $expenseCategory->fill($request->validated())->save();
            return new ExpenseCategoryResource($expenseCategory);

        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return ExpenseCategoryResource
     */
    public function show($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        return new ExpenseCategoryResource($expenseCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExpenseCategoryRequest $request
     * @param $id
     * @return ExpenseCategoryResource
     */
    public function update(ExpenseCategoryRequest $request, $id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        try {
            $expenseCategory->fill($request->validated())->save();
            return new ExpenseCategoryResource($expenseCategory);

        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();
        return response()->json(null, 204);
    }
}
