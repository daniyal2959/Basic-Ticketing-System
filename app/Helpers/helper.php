<?php

use App\Models\Ticket;
use App\Models\TicketStatus;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Get all tickets with specific status
 *
 * @param TicketStatus|int|null $ticketStatus
 *
 */
if( !function_exists('getTickets') ){
    function getTickets($ticketStatus = null){
        if ( !($ticketStatus instanceof TicketStatus) and !is_int($ticketStatus) and !is_null($ticketStatus) )
            throw new TypeError('The parameter must be instance of TicketStatus or integer number');

        /**
         * Get all tickets that refers to current user
         */
        if ( is_null($ticketStatus) )
            return Auth::user()->tickets()->paginate(7);

        /**
         * Get all tickets that refers to current user with chosen status
         */
        return Auth::user()->tickets()->where('TSID', is_int($ticketStatus) ? $ticketStatus : $ticketStatus->id)->paginate(7);
    }
}

/**
 * Set all parameters that will be passed to view
 *
 * @return array
 */
if( !function_exists('setParametersForView') ){
    function setParametersForView()
    {
        $parameter = [];
        $settings = Config::get('settings');

        $parameter['data'][] = [
            'title' => 'All Tickets',
            'icon' => 'ni ni-tag',
            'url' => route('dashboard.tickets.index'),
            'items' => getTickets(),
        ];

        foreach ($settings['dashboard']['cards'] as $ticketStatusName){
            $ticketStatus = TicketStatus::where('name', $ticketStatusName)->first();

            $parameter['data'][$ticketStatusName] = [
                'title' => $ticketStatus->title,
                'icon' => $ticketStatus->icon_name,
                'background' => $ticketStatus->icon_background_color,
                'url' => route('statusArchive', ['status' => $ticketStatus->name]),
                'items' => getTickets($ticketStatus->id),
                'asTable' => true
            ];
        }

        $parameter['data'][] = [
            'title' => 'Answered Rate',
            'icon' => 'ni ni-chart-bar-32',
            'count' => Ticket::rate($settings['tickets']['rate']) . '%'
        ];

        $parameter['colors'] = $settings['colors']['cards'];

        $parameter['tables'] = $settings['dashboard']['cards'];

        return $parameter;
    }
}

/**
 * Get chart values
 *
 * @param $monthCount
 * @param $barChart
 * @return array
 */
if( !function_exists('chartValues') ){
    function chartValues($monthCount, $barChart = true){
        $nowMonth = Carbon::now()->month;
        $nowYear = Carbon::now()->year;
        $month = [];
        $year = [];
        $ticketCount = [];
        $result = [];

        for ($i = 0; $i<$monthCount; $i++){
            $month[] = $nowMonth;
            $year[] = $nowYear;

            if( $barChart ) {
                $ticketCount[] = Ticket::where([
                    [DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', $nowYear],
                    [DB::raw("DATE_FORMAT(created_at, '%c')"), '=', $nowMonth],
                    ['UID', '=', Auth::user()->id],
                ])->count();
            }
            else{
                $ticketCount[] = Ticket::where([
                    [DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', $nowYear],
                    [DB::raw("DATE_FORMAT(created_at, '%c')"), '=', $nowMonth],
                    ['UID', '=', Auth::user()->id],
                    ['TSID', '<>', 3],
                ])->count();
            }

            $nowMonth -= 1;
            if( $nowMonth <= 0 ){
                $nowMonth = 12;
                $nowYear -= 1;
            }
        }

        array_push($result, $month,$ticketCount);
        return $result;

    }
}


if( !function_exists('addExcerptToCompanies') ){
    function addExcerptToCompanies(Collection $companies){
        $companies->map(function ($company){
            $spices = preg_split('/(?=[A-Z])/',$company->name);
            foreach ($spices as $spice)
                $company->excerpt .= Str::upper(substr($spice,0,1));
            return $company;
        });
    }
}
