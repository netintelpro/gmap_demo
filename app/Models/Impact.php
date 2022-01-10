<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impact extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @param null $startDate
     * @param null $endDate
     * @param null $address
     * @return mixed
     */
    public static function locations($params)
    {
        //dd($params);
        $events = Event::where(function (Builder $query) use ($params) {
            if ($params['start_date']) {
                $query->whereDate('start_date_time', '>=',
                    Carbon::createFromFormat('Y-m-d', $params['start_date'])
                        ->format('Y-m-d'));

            }

            if ($params['end_date']) {
                // Dont confuse db column end_date_time with form end_date search parameter
                $query->whereDate('start_date_time', '<=',
                    Carbon::createFromFormat('Y-m-d',  $params['end_date'])
                        ->format('Y-m-d'));
            }

            /*if ($params['start_date'] || $params['end_date']) {
                $query->whereBetween('start_date_time',
                    [
                        Carbon::createFromFormat('Y-m-d', $params['start_date']),
                        Carbon::createFromFormat('Y-m-d',  $params['end_date'])
                    ]);

            }*/


            if ($params['address']) {
                $query->where('address1', 'like', "%".$params['address']."%");
            }

        })->take(40)->get(['latitude', 'longitude', 'title' ]);

        $locations = $events->map(function ($event) {
            return (object)[
                'lat' => $event->latitude,
                'lng' => $event->longitude,
                'title' => $event->title,
            ];
        })->unique();

        dd($locations);

        return $locations;

    }
}
