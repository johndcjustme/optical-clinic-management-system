<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\User;
use App\Models\Patient;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class PageDashboard extends Component
{

    // public $mysession;
    // public $mysessionid;
    public $patient;

    public $year = 2022;


    public $days = [];

    public $subscribers = [30,36,42,78,88,109,205,325,349,480,556];

    public $recentSubscribers = 556;

    public $mar;

    public $months = [
        'JAN',
        'FEB',
        'MAR',
        'APR',
        'MAY',
        'JUN',
        'JUL',
        'AUG',
        'SEPT',
        'OCT',
        'NOV',
        'DEC',
    ];

    public $value = 1;

    public $monthValues;
    
    public function mount()
    {
        $this->days = collect(range(13,24))->map(function ($number) {
            return 'Jan' . $number;
        });
    }
    
    public function render()
    {


        $columnChartModel = 
            (new ColumnChartModel())
                ->setTitle('Expenses by Type')
                ->addColumn('Food', 100, '#f6ad55')
                ->addColumn('Shopping', 200, '#fc8181')
                ->addColumn('Travel', 300, '#90cdf4')
            ;

        foreach ($this->months as $month) {
            // echo $this->value++;
            // echo $month;
           $this->monthValues .= Patient::whereYear('created_at', $this->year)->whereMonth('created_at', $this->value++)->count() . ", ";
        }

        $this->mar = Patient::whereYear('created_at', $this->year)->whereMonth('created_at', 3)->count();
        
               
           
        return view('livewire.pages.page-dashboard')
            ->extends('layouts.app')
            ->section('content');
    }



    public function fetchData()
    {
        // $this->recentSubscribers += 10;
        $subscribers = array_replace($this->subscribers, [10 => $this->recentSubscribers += 10]);

        $this->emit('refreshChart', ['seriesData' => $subscribers]);
    }
}
