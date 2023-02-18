<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'company_id' => 'required | numeric',
        'product_name' => 'required | string',
        'price' => 'required | numeric',
        'stock' => 'required | numeric',
        'img_path' => 'file | image',

      ];
    }

  public function attributes()
  {
    return[
      'company_id' => '会社名',
      'product_name' => '商品名',
      'price' => '価格',
      'stock' => '在庫数',
      'comment' => 'コメント',
      'img_path' => '商品画像',
    ];
  }

  public function messages()
  {
    return[
      'company_id.required' => ':attributeは必須項目です。',
      'company_id.numeric' => ':attributeは数値形式で入力してください。',
      'product_name.required' => ':attributeは必須項目です。',
      'price.required' => ':attributeは必須項目です。',
      'price.numeric' => ':attributeは数値形式で入力してください。',
      'stock.required' => ':attributeは必須項目です。',
      'stock.numeric' => ':attributeは数値形式で入力してください。',
      'img_path.image' => ':attributeは画像ファイルで入力してください。',
      // 'comment.max' => ':attributeは:max字以内で入力してください。',
    ];
  }
}
