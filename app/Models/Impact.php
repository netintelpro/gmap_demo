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
    public static function locations($startDate = null, $endDate = null, $address = null)
    {
        $impacts =  Impact::whereHas('event', function (Builder $query) use ($startDate, $endDate, $address) {
            if ($startDate) {
                $query->where('start_date_time', '>=', $startDate);
            }

            if ($endDate) {
                $query->where('end_date_time', '<=', $endDate);
            }

            if ($address) {
                $query->where('address1', 'like', "%$address%");
            }

        })->get();

        $locations = $impacts->map(function ($impact) {

            if (empty($impact->event_id)) {
                return (object)[
                    'lat' => $impact->user->latitude,
                    'lng' => $impact->user->longitude,
                    'title' => "$impact->user->first_name $impact->user->last_name",
                ];
            }
            $event = $impact->event()->first();

            return (object)[
                'lat' => $event->latitude,
                'lng' => $event->longitude,
                'title' => "$event->title - $event->id",
            ];
            /*$locationString = json_encode([
                'lat' => $event->latitude,
                'lng' => $event->longitude,
            ], JSON_NUMERIC_CHECK);*/

            /*$locationString = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:', $locationString);
            return json_encode($locationString);*/
        });

        return $locations->unique();

    }
}
