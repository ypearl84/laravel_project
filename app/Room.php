<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    //
    public function getAvailablerooms($start_date, $end_date)
    {

        $available_rooms = DB::table('rooms as r')
                                    ->select('r.id', 'r.name')
                                    ->whereRaw("
                                    r.id NOT IN(
                                        SELECT b.room_id FROM reservations b
                                        WHERE NOT(
                                            b.date_out < '2019-01-01' OR
                                            b.date_in > '2019-12-31'
                                        )
                                    )
                                    ")
                                    ->orderBy('r.id')
                                    ->get()
        ;

        return $available_rooms;
    }
}
