<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\User;

class LevelDistributionWithFindSponsor
{
    public function level_distribution($unique_code)
    {
        for($i = 0 ; $i < 100 && $unique_code!=null; $i++)
        //if($unique_code!=null)
        {
            $next_id = $this->find_sponser_id($unique_code);
            $unique_code = $next_id;
        }
    }

    function find_sponser_id($unique_code)
    {
       
        $currentUser = User::where('unique_code',$unique_code)->first();
        $sponser_code = $currentUser->sponser_code;
        if($currentUser->sponser_code==null){
            $parentUser = User::where('unique_code',$unique_code)->first();
            $parentUser->total_group =  $parentUser->total_group+1;
            $parentUser->save();
        }
        return $sponser_code;
    }
}
