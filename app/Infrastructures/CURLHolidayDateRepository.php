<?php

namespace App\Infrastructures;

use App\Repositories\HolidayDateRepository;

class CURLHolidayDateRepository implements HolidayDateRepository {

    public function get_current_month() {
        $curl = curl_init();

        $month = date('m');
        $year = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-harilibur.vercel.app/api?month='.$month.'&year='.$year,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $arr = json_decode($response, true);
        for($i = 0; $i < count($arr); $i++) {
            $arr[$i]['holiday_date'] = date('d-m-Y', strtotime($arr[$i]['holiday_date']));
        }
        return $arr;
    }

    private function filter_by_current_day($value)
    {
        $today = date('d-m-Y');
        return $today == $value;
    }

    public function get_current_day() {
        $curl = curl_init();

        $month = date('m');
        $year = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-harilibur.vercel.app/api?month='.$month.'&year='.$year,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $arr = json_decode($response, true);
        for($i = 0; $i < count($arr); $i++) {
            $arr[$i]['holiday_date'] = date('d-m-Y', strtotime($arr[$i]['holiday_date']));
        }
        return array_values($arr, $this->filter_by_current_day);
    }
}
