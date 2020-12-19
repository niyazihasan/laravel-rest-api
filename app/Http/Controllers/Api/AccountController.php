<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $accounts = Account::all();
        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccountRequest $request
     * @return AccountResource
     */
    public function store(AccountRequest $request)
    {
        try {
            $account = new Account();
            $account->fill($request->validated())->save();
            return new AccountResource($account);

        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return AccountResource
     */
    public function show($id)
    {
        $account = Account::findOrFail($id);
        return new AccountResource($account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AccountRequest $request
     * @param $id
     * @return AccountResource
     */
    public function update(AccountRequest $request, $id)
    {
        $account = Account::findOrFail($id);
        try {
            $account->fill($request->validated())->save();
            return new AccountResource($account);

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
        $account = Account::findOrfail($id);
        $account->delete();
        return response()->json(null, 204);
    }
}
