<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'account_id' => $this->account_id,
            'amount' => $this->amount,
            'expense_id' => $this->expense_id,
            'income_id' => $this->income_id
        ];
    }
}
