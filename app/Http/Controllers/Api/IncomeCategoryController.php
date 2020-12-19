<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeCategoryRequest;
use App\Http\Resources\IncomeCategoryResource;
use App\Models\IncomeCategory;
use Symfony\Component\HttpKernel\Exception\HttpException;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $incomeCategory = IncomeCategory::all();
        return IncomeCategoryResource::collection($incomeCategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IncomeCategoryRequest $request
     * @return IncomeCategoryResource
     */
    public function store(IncomeCategoryRequest $request)
    {
        try {
            $incomeCategory = new IncomeCategory();
            $incomeCategory->fill($request->validated())->save();
            return new IncomeCategoryResource($incomeCategory);

        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return IncomeCategoryResource
     */
    public function show($id)
    {
        $incomeCategory = IncomeCategory::findOrFail($id);
        return new IncomeCategoryResource($incomeCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param IncomeCategoryRequest $request
     * @param $id
     * @return IncomeCategoryResource
     */
    public function update(IncomeCategoryRequest $request, $id)
    {
        $incomeCategory = IncomeCategory::findOrFail($id);
        try {
            $incomeCategory->fill($request->validated())->save();
            return new IncomeCategoryResource($incomeCategory);

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
        $incomeCategory = IncomeCategory::findOrFail($id);
        $incomeCategory->delete();
        return response()->json(null, 204);
    }
}
