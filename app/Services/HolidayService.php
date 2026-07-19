<?php

namespace App\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;

class HolidayService
{
    public function getNextHoliday($country = 'BD')
    {
        $client = new Client();

        $year = now()->year;

        $response = $client->get(
            "https://date.nager.at/api/v3/PublicHolidays/$year/$country"
        );

        $holidays = json_decode($response->getBody(), true);

        $today = Carbon::today();

        foreach ($holidays as $holiday) {

            $date = Carbon::parse($holiday['date']);

            if ($date->greaterThanOrEqualTo($today)) {

                return [
                    'name'      => $holiday['name'],
                    'localName' => $holiday['localName'],
                    'date'      => $date->format('F d, Y'),
                    'days_left' => $today->diffInDays($date),
                ];
            }
        }

        return null;
    }
}