<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Schedsetting;
use App\Models\Appointment;

class PageAppointments extends Component
{

    public $name, $time, $checked1;
    public $myTab = 1;
    public $shedsettings_isOpen = false;


    protected $listeners = ['mount'];


    public 
        $setAll_am, 
        $setAll_pm,
        
        $amStart,
        $pmEnd;


    public $schedset_am;



    public function myTab($value)
    {
        return $this->myTab = $value;
    }

    public function render()
    {

        $schedsetting = Schedsetting::all();

        $appts = Appointment::with('patient')->get();

        return view('livewire.pages.page-appointments', ['schedsettings' => $schedsetting, 'appts' => $appts])
            ->extends('layouts.app')
            ->section('content');
    }

    public function mount()
    {
        $schedsetting = Schedsetting::find(1);
        $this->amStart = $schedsetting->schedset_am;
        $this->pmEnd = $schedsetting->schedset_pm;
    }

    public function resetFields($reset)
    {
        switch ($reset) {
            case 'updateSchedSettingsAll':
                $this->reset([
                    'setAll_am',
                    'setAll_pm',
                ]);
        }
    }

    public function updateSchedSettings($id)
    {
        dd($id);
    }

    public function updateSchedSettingsAll()
    {
        if(!empty($this->setAll_am) || !empty($this->setAll_am)) {
            $updateSchedSettings = Schedsetting::where('schedset_type', 'schedsetting')->where('schedset_checked', 1);
            $updateSchedSettings->update([
                'schedset_am' => $this->setAll_am,
                'schedset_pm' => $this->setAll_pm,
            ]);
            $this->resetFields('updateSchedSettingsAll');
            $this->emit('mount');
        } else {
            dd('empty');
        }
    }
}
