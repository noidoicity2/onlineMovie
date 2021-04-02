<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;
use function PHPUnit\Framework\isNull;

class AddMovieRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $img;
    /**
     * @var mixed
     */
    private $is_finished;

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
            'name'          =>    'required|max:50|min:2|unique:category',
            'slug'        =>      'max:50',
            'description'   =>      'required',
            'img' => [
                'required',


            ],



        ];
    }

    public function validationData()
    {
        if(!$this->request->has('is_movie18')) {
            $this->request->add(['is_movie18'=>0]);
        }else  $this->request->set('is_movie18' , 1);

        if(!$this->request->has('is_finished')) {
                $this->request->add(['is_finished'=>0]);
        } else $this->request->set('is_finished' , 1);

        if(!$this->request->has('is_movie_series')) {
            $this->request->add(['is_movie_series'=>0]);
        } else $this->request->set('is_movie_series' , 1);

        if(!$this->request->has('is_on_cinema')) {
            $this->request->add(['is_on_cinema'=>0]);
        } else $this->request->set('is_on_cinema' , 1);

        if(!$this->request->has('is_free')) {
            $this->request->add(['is_free'=>0]);
        } else $this->request->set('is_free' , 1);


        return $this->all();
    }
}
