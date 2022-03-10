<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Schedsetting;
use App\Models\Appointment;
use App\Models\Patient;

class PageAppointments extends Component
{

    public Patient $pt;
    public $name, $checked1;
    public $myTab = 1;
    public $shedsettings_isOpen = false;
    public $apptCreatedBy;

    public $selectedAppts = [];

    public $searchPatient, $isFillSearch = false, $searchPatientId;

    protected $listeners = ['mount'];

    public $appt = [
        'id' => '',
        'pt_name' => '',
        'pt_phone' => '',
        'pt_addr' => '',
        'pt_occ' => '',
        'pt_date' => '',
        'pt_time' => '',
        'pt_status' => '',
    ];


    public $apptShowModal = false,
            $isUpdate = false,
            $isAdd = false,
                $addAppt = false;


    public 
        $setAll_am, 
        $setAll_pm,
        
        $amStart,
        $pmEnd;


    public $time = [
        'active' => false,
        'am_from' => '',
        'am_to' => '',
        'pm_from' => '',
        'pm_to' => '',
    ];

    public $apptStatus = [
        1 => "For Approval",
        2 => "Ongoing",
        3 => "Rescheduled",
        4 => "Missed",
    ];

    public function myTab($value)
    {
        return $this->myTab = $value;
    }

    public function render()
    {
        $searchPatient = '%' . $this->searchPatient . '%';
        $pt = Patient::where('patient_fname' , 'like', $searchPatient)
                        ->orWhere('patient_lname', 'like', $searchPatient)
                        ->orWhere('patient_mname', 'like', $searchPatient)
                        ->get();

        $appts = Appointment::with('patient')->get();

        return view('livewire.pages.page-appointments', 
            [
                'schedsettings' => Schedsetting::all(), 
                'appts' => $appts,
                'patients' => $pt,
            ])
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


    public function countApprovedAppts() { return Appointment::where('appt_confirmed', true)->count(); }

    public function countForApprovalAppts() { return Appointment::where('appt_confirmed', null)->count(); }

    public function date($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    public function day($day) { return \Carbon\Carbon::parse($day)->format('l'); }

    public function time($time) { return isset($time) ? \Carbon\Carbon::parse($time)->format('g:i A') : ''; }


    public function clearSearch()
    {
        return $this->reset([
            'searchPatient',
            'isFillSearch',
        ]);
    }

    public function autoCompleteSearch($id)
    {
        // dd($id);
        $patientFound = Patient::findOrFail($id);
        $this->searchPatient = $patientFound->patient_lname . ', ' . $patientFound->patient_fname . ' ' . $patientFound->patient_mname;
        $this->searchPatientId = $patientFound->id;
        $this->isFillSearch = true;
    }

    public function createAppt($id)
    {

        $findPt = Patient::findOrFail($id);
        $this->appt['pt_name'] = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
        $this->appt['pt_phone'] = $findPt->patient_mobile;
        $this->appt['pt_addr'] = $findPt->patient_address;
        $this->appt['pt_occ'] = $findPt->patient_occupation;
        $this->appt['id'] = $findPt->id;

        $this->appt['pt_status'] = $this->apptStatus['2'];
        $this->apptCreatedBy = 'dc';

        $this->isAdd = false;
        $this->isUpdate = true;
        $this->apptShowModal = true;

        $this->reset([
            'isFillSearch',
            'searchPatient',
        ]);

        // $this->appt['pt_date'] = $apptId->appt_date;
        // $this->appt['pt_time'] = $apptId->appt_time;
    }


    // public function confirm_appt($id) { return $this->confirm_appt = $id; }

    public function appt_confirmed($id)
    {
        Appointment::where('id', $id)
            ->update(['appt_confirmed' => true]);
    }


    public function updateAppt($createdBy, $id)
    {
        switch ($createdBy) {
            case 'dc':
                Appointment::create([
                    'patient_id' => $this->appt['id'],
                    'appt_date' => $this->appt['pt_date'],
                    'appt_time' => $this->appt['pt_time'],
                    'appt_status' => $this->appt['pt_status'],
                    'appt_confirmed' => true,
                ]);
                session()->flash('message', 'Successfully udpated');
                break;

            case 'pt':
                Appointment::where('id', $id)
                    ->update([
                        'appt_date' => $this->appt['pt_date'],
                        'appt_time' => $this->appt['pt_time'],
                        'appt_status' => $this->appt['pt_status'],
                    ]);
                
                session()->flash('message', 'Successfully udpated');
                break;
        }
        $this->apptCloseModal();
    }


    public function approveAppts()
    {
        Appointment::query()
            ->whereIn('id', $this->selectedAppts)
            ->update([
                'appt_confirmed' => true,
            ]);
        $this->selectedAppts = [];
    }


    public function deleteAppts()
    {
        Appointment::query()
            ->whereIn('id', $this->selectedAppts)
            ->delete();
        $this->selectedAppts = [];
    }




    public function apptShowModal($data, $id)
    {

        switch ($data) {
            case 'isAdd':
                $this->isAdd = true;
                break;
            case 'isUpdate':
                $apptId = Appointment::findOrFail($id);
                $findPt = Patient::findOrFail($apptId->patient_id);
                $this->appt['pt_name'] = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
                $this->appt['pt_phone'] = $findPt->patient_mobile;
                $this->appt['pt_addr'] = $findPt->patient_address;
                $this->appt['pt_occ'] = $findPt->patient_occupation;

                $this->appt['id'] = $apptId->id;
                $this->appt['pt_date'] = $apptId->appt_date;
                $this->appt['pt_time'] = $apptId->appt_time;
                $this->appt['pt_status'] = $apptId->appt_status;

                $this->isUpdate = true;
                $this->apptCreatedBy = 'pt';
                break;
        }
        $this->apptShowModal = true;
    }

    public function apptCloseModal()
    {
        $this->reset([
            'apptShowModal',
            'isAdd',
            'isUpdate',
        ]);
        $this->clearSearch(); 
        $this->reset(['appt']);
    }



    // public function apptStatus()
    // {
    //     switch ($data) {
    //         case '1':
    //             return "For Approval";
    //             break;
    //         case '2':
    //             return "Ongoing";
    //             break;
    //         case '2':
    //             return "Rescheduled";
    //             break;
    //         case '2':
    //             return "Missed";
    //             break;
    //     }
    // }









    public function updateSchedSettings($id)
    {
        dd($id . ' ' . $this->time['am_from'] . ' ' . $this->time['am_to'] . ' ' . $this->time['pm_from'] . ' ' . $this->time['pm_to']);
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
