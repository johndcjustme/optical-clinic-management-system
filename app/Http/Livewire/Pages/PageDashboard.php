<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\User;
use App\Models\Patient;

class PageDashboard extends Component
{

    // public $mysession;
    // public $mysessionid;
    public $patient;

    public $year = 2022;

    public $month = [
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
    
    public function mount()
    {
        // $this->currentUser = new User();
        // if(session()->has('curr_user_id')) {
            
        //     $this->mysession_name = session()->get('curr_user_name');
        //     $this->mysession_id = session()->get('curr_user_id');
        //     $this->mysession_avatar = session()->get('curr_user_avatar');
        //     $this->mysession_role = session()->get('curr_user_role');
        //     $this->mysession_email = session()->get('curr_user_email');
        //     $this->mysession_passcode = session()->get('curr_user_passcode');

        // } else {
        //     $this->mysession = 'nothig';
        // }
    }
    
    public function render()
    {
        

        $this->chart->pieChart()
            ->setTitle('Top 3 scorers of the team.')
            ->setSubtitle('Season 2021.')
            ->addData([40, 50, 30])
            ->setLabels(['Player 7', 'Player 10', 'Player 9']);


        $this->month['JAN'] = Patient::whereYear('created_at', $this->year)
            ->whereMonth('created_at', 01)
            ->count();
        
        $this->month['FEB'] = Patient::whereYear('created_at', $this->year)
            ->whereMonth('created_at', 02)
            ->count();

        $this->month['MAR'] = Patient::whereYear('created_at', $this->year)
            ->whereMonth('created_at', 03)
            ->count();

        $this->month['APR'] = Patient::whereYear('created_at', $this->year)
            ->whereMonth('created_at', 04)
            ->count();

        $this->month['MAY'] = Patient::whereYear('created_at', $this->year)
            ->whereMonth('created_at', 05)
            ->count();

        $this->month['JUN'] = Patient::whereYear('created_at', $this->year)
            ->whereMonth('created_at', 06)
            ->count();

        $this->month['JUL'] = Patient::whereYear('created_at', $this->year)
            ->whereMonth('created_at', 07)
            ->count();

        // $this->month['AUG'] = Patient::whereYear('created_at', 2022)
        //     ->whereMonth('created_at', 08)
        //     ->count();

        // $this->month['SEP'] = Patient::whereYear('created_at', 2022)
        //     ->whereMonth('created_at', 09)
        //     ->count();

        // $this->month['OCT'] = Patient::whereYear('created_at', 2022)
        //     ->whereMonth('created_at', 10)
        //     ->count();

        // $this->month['NOV'] = Patient::whereYear('created_at', 2022)
        //     ->whereMonth('created_at', 11)
        //     ->count();

        // $this->month['DEC'] = Patient::whereYear('created_at', 2022)
        //     ->whereMonth('created_at', 12)
        //     ->count();


        // foreach ($patients as $pt) {
        //     $this->patient .= $pt->created_at->year;
        // }
        
           
        return view('livewire.pages.page-dashboard', ['chart' => $chart->build()])
            ->extends('layouts.app')
            ->section('content');
    }
}
