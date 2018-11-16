<?php 

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

Trait ApiResponser 
{
    protected function ShowAll(Collection $data, $code = 200)
    {
        if($data->isEmpty()){
            return response()->json(['data'=>$data,'code'=>$code]);
        }
        $transformer = $data->first()->transformer;
        $data = $this->sortData($data, $transformer);
        $data = $this->paginate($data);
        $data = $this->transformData($data, $transformer);
        return response()->json([$data, $code]);
    }
    
    protected function ShowOne(Model $data, $code = 200){
        $transformer = $data->first()->transformer;
        $data = $this->transformData($data, $transformer);
        return response()->json([$data, $code]);
    }

    protected function Error($message, $code){
        return response()->json(['error'=>$message, 'code'=>$code]);
    }

    protected function ShowMessage($message, $code = 200)
    {
        return response()->json(['data' => $message, 'code'=> $code]);
    }

    protected function sortData(Collection $data, $transformer)
    {
    if(request()->has('sort_by')){
        $attribute = $transformer::originalAttribute(request()->sort_by);
        $data = $data->sortBy->{$attribute};
    }
        return $data;
    }

    protected function paginate(Collection $data)
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50'
        ];
        Validator::validate(request()->all(), $rules);
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        if(request()->has('per_page')){
            $perPage = (int)request()->per_page;
        }
        $results = $data->slice(($page -1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator($results, $data->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        $paginated->appends(request()->all());
        return $paginated;
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }

}
