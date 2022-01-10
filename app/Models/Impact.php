<?php

namespace App\Models;

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

        $events = Event::where(function (Builder $query) use ($params) {
            if ($params['start_date']) {
                $query->where('start_date_time', '>=', $params['start_date']);
            }

            if ($params['end_date']) {
                $query->where('end_date_time', '<=', $params['end_date']);
            }

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
