<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostCommentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//每次生成后都要改为true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required',
            'discussion_id' => 'required'
        ];
    }
}
