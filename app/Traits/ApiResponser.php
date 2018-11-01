<?php 

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

Trait ApiResponser 
{
    protected function ShowAll(Collection $data, $code = 200){
        return response()->json(['data'=>$data,'code'=>$code]);
    }
    protected function ShowOne(Model $data, $code = 200){
        return response()->json(['data'=>$data,'code'=>$code]);
    }

    protected function Error($message, $code){
        return response()->json(['error'=>$message, 'code'=>$code]);
    }

}
