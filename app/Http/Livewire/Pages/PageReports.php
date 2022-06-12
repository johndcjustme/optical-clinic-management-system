<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Item;

class PageReports extends Component
{
    public $i = 1;

    public $subPage = 1;

    public $filter = 'ALL';

    public $date_from = '', $date_to = '', $date = '';

    public $order = 'patient_lname';

    public $selectedItems = [];

    protected $queryString = [
        'date_from',
        'date_to',
        'date',
        'order',
        'subPage' => ['except' => ''],
        'filter' => ['except' => ''],
    ];

    public function render()
    {

        switch ($this->filter) {
            case 'DATE_RANGE':
                $patients = Patient::whereBetween('created_at', [$this->date_from, $this->date_to])->get();
                break;
            case 'SINGLE_DATE':
                $patients = Patient::whereDate('created_at', $this->date)->get();
                break;
            case 'ALL':
                $patients = Patient::all();
                break;
            default:
        }
        // $patients = Patient::whereDate('created_at', '2022-04-23')->get();


        switch ($this->subPage) {
            case 1: 
                $data = [
                    'patients' => $patients->sortBy($this->order)
                ]; break;
            case 2: 
                $data = [
                    'items' => Item::all()
                ]; break;
            case 2: break;
            default:
        }

        return view('livewire.pages.page-reports', $data)
        ->extends('layouts.app')
        ->section('content');
    }
    
    public function resetMe()
    {
        $this->reset(['date_from', 'date_to', 'date', 'order', 'filter']);
    }

    public function patientOrderBy($value)
    {
        switch ($value) {
            case 'patient_lname':
                return 'Name';
                break;
            case 'patient_age':
                return 'Age';
                break;
            case 'created_at':
                return 'Date Added';
                break;
            default:
        }
    }

    public function reportCategory($value)
    {
        switch ($value) {
            case 1:
                return 'Patient Report';
                break;
            case 2:
                return 'Item Report';
                break;
            case 3:
                return 'Order Report';
                break;
            default:
        }
    }

    public function subPage($value)
    {
        $this->resetMe();
        return $this->subPage = $value;
    }
}
