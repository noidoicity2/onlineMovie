<?php

namespace App\Http\Requests\Membership;

use Illuminate\Foundation\Http\FormRequest;

class AddMembershipRequest extends FormRequest
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
            //
        ];
    }
    public function validationData(){
        if(!$this->request->has('all_category')) {
            $this->request->add(['all_category'=>0]);
        } else $this->request->set('all_category' , 1);
        return $this->all();
    }
}
