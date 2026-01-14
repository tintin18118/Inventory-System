<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supplierId = $this->route('supplier') ? $this->route('supplier')->id : null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $supplierId,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ];
    }
}