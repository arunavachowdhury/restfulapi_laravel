<?php 

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

Trait ApiResponser 
{
    protected function ShowAll(Collection $data, $code = 200)
    {
        if($data->isEmpty()){
            return response()->json(['data'=>$data,'code'=>$code]);
        }
        $transformer = $data->first()->transformer;
        $data = $this->sortData($data);
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

    protected function sortData(Collection $data)
    {
    if(request()->has('sort_by')){
        $attribute = request()->sort_by;
        $data = $data->sortBy->{$attribute};
    }
        return $data;
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }

}
