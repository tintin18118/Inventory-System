<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class StockOutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'quantity' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $product = Product::find($this->product_id);
                    if ($product && $value > $product->quantity) {
                        $fail('Quantity cannot exceed available stock (' . $product->quantity . ')');
                    }
                },
            ],
            'notes' => 'nullable|string',
        ];
    }
}