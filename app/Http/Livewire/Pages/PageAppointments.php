<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Schedsetting;
use App\Models\Appointment;
use App\Models\Patient;

use App\Models\Time;


use Illuminate\Support\Facades\Storage;


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

    public $searchAppt;

    public $appt = [
        'id'          => '',
        'pt_name'     => '',
        'pt_phone'    => '',
        'pt_addr'     => '',
        'pt_occ'      => '',
        'pt_date'     => '',
        'pt_time'     => '',
        'pt_status'   => '',
        'pt_avatar'   => '',
    ];

    public $modal=[
        'show'     => false,
        'add'      => false,
        'update'   => false,
    ];

    public $isUpdate = false, $isAdd = false, $addAppt = false;

    // public $editTime = false, $editTimeId = '';

    public $colName = 'appt_date', $direction = 'asc';

    public 
        $setAll_am, 
        $setAll_pm,
        
        $amStart,
        $pmEnd;


    public $day = false;


    // public $time = [
    //     'active'    => false,
    //     'am_from'   => '',
    //     'am_to'     => '',
    //     'pm_from'   => '',
    //     'pm_to'     => '',
    // ];

    public $apptStatus = [
        1 => "For Approval",
        2 => "Ongoing",
        3 => "Rescheduled",
        4 => "Missed",
        5 => "Fulfilled",
        6 => "Cancelled",
    ];

    public $delete = [
        'appt'  => false,
        'appts' => false,
    ];


    public $timeSched;

    public function myTab($value)
    {
        return $this->myTab = $value;
    }

    public function render()
    {
        $searchPatient = $this->searchPatient . '%';
        $pt = Patient::where('patient_fname' , 'like', $searchPatient)
                        ->orWhere('patient_lname', 'like', $searchPatient)
                        ->orWhere('patient_mname', 'like', $searchPatient)
                        ->get();

        $searchAppt = $this->searchAppt . '%';
        $appts = Appointment::with('patient')->orderBy($this->colName, $this->direction)->get();

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
        // $schedsetting = Schedsetting::find(2);
        // $this->amStart = $schedsetting->schedset_am;
        // $this->pmEnd = $schedsetting->schedset_pm;
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

    public function countFulfilledAppts() { return Appointment::where('appt_status', 'fu')->count(); }

    public function date($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    public function day($day) { return \Carbon\Carbon::parse($day)->format('l'); }

    public function time($time) { return isset($time) ? \Carbon\Carbon::parse($time)->format('g:i A') : ''; }

    public function orderBy($colName, $direction)
    {
        // $this->resetPage();

        $this->colName = $colName;
        $this->direction = $direction;
    }

    // public function statusColor($status)
    // {
    //     switch ($status) {
    //         case 'fa':
    //             return '#0275d8';
    //             break;
    //         case 'on':
    //             return '#5cb85c';
    //             break;
    //         case 're':
    //             return '#5bc0de';
    //             break;
    //         case 'fu':
    //             return '#292b2c';
    //             break;
    //         case 'mi':
    //             return '#d9534f';
    //             break;
    //     }
    // }


    public function statusColor($status)
    {
        switch ($status) {
            case 1: return '#0275d8'; break;
            case 2: return '#5cb85c'; break;
            case 3: return '#5bc0de'; break;
            case 4: return '#d9534f'; break;
            case 6: return '#f62681'; break;
            default:
        }
    }

    public function apptStatus($status)
    {
        switch ($status) {
            case 1: return $this->apptStatus[1]; break;
            case 2: return $this->apptStatus[2]; break;
            case 3: return $this->apptStatus[3]; break;
            case 4: return $this->apptStatus[4]; break;
            case 5: return $this->apptStatus[5]; break;
            case 6: return $this->apptStatus[6]; break;
            default:
        }
    }

    public function clearSearch()
    {
        return $this->reset([
            'searchPatient',
            'isFillSearch',
        ]);
    }

    public function autoCompleteSearch($id)
    {
        $patientFound = Patient::findOrFail($id);
        $this->searchPatient = $patientFound->patient_lname . ', ' . $patientFound->patient_fname . ' ' . $patientFound->patient_mname;
        $this->searchPatientId = $patientFound->id;
        $this->isFillSearch = true;
    }





  



    public function createAppt()
    {
        $findPt = Patient::findOrFail($this->searchPatient);
        $this->appt['pt_name'] = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
        $this->appt['pt_phone'] = $findPt->patient_mobile;
        $this->appt['pt_addr'] = $findPt->patient_address;
        $this->appt['pt_occ'] = $findPt->patient_occupation;
        $this->appt['pt_avatar'] = $findPt->patient_avatar;
        $this->appt['id'] = $findPt->id;

        $this->appt['pt_status'] = $this->apptStatus[2];
        $this->apptCreatedBy = 'dc';

        $this->modal['add'] = false;
        $this->modal['update'] = true;

        $this->reset([
            'isFillSearch',
            'searchPatient',
        ]);

        $this->dispatchBrowserEvent('form-modal');
    }

    public function updateAppt()
    {
        // dd($this->appt['id'] . ' ' . $this->apptCreatedBy);
        switch ($this->apptCreatedBy) {
            case 'dc':
                Appointment::create([
                    'patient_id' => $this->appt['id'],
                    'appt_date' => $this->appt['pt_date'],
                    'appt_time' => $this->appt['pt_time'],
                    'appt_status' => $this->appt['pt_status'],
                    'appt_confirmed' => true,
                ]);
                break;

            case 'pt':
                Appointment::where('id', $this->appt['id'])
                    ->update([
                        'appt_date' => $this->appt['pt_date'],
                        'appt_time' => $this->appt['pt_time'],
                        'appt_status' => $this->appt['pt_status'],
                    ]);
                break;
        }

        $this->apptCloseModal();
        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Updated Succesfully',
        ]);
    }


    public function deletingAppt($apptId)
    {
        $this->delete['appt'] = true;

        $this->appt['id'] = $apptId;

        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deletingAppts()
    {
        $this->delete['appts'] = true;
        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deleteAppt()
    {
        Appointment::destroy($this->appt['id']);

        $this->confirm_dialog_modal_close();

        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Deleted Succesfully',
        ]);
    }

    public function deleteAppts()
    {
        Appointment::query()
            ->whereIn('id', $this->selectedAppts)
            ->delete();
        $this->selectedAppts = [];

        $this->confirm_dialog_modal_close();

        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Deleted Succesfully',
        ]);
    }




    public function delete()
    {
        if ($this->delete['appt']) { $this->deleteAppt(); }
        if ($this->delete['appts']) { $this->deleteAppts(); }
    }






    public function appt_confirmed($id)
    {
        Appointment::where('id', $id)
            ->update(['appt_status' => 2]);
    }

    public function approveAppts()
    {
        Appointment::query()
            ->whereIn('id', $this->selectedAppts)
            ->update([
                'appt_status' => 2,
            ]);
        $this->selectedAppts = [];
    }







    
    public function apptShowModal($data, $id)
    {
        $this->reset(['appt', 'modal']);
        switch ($data) {
            case 'isAdd':
                $this->modal['add'] = true;
                break;

            case 'isUpdate':
                $apptId = Appointment::findOrFail($id);
                $findPt = Patient::findOrFail($apptId->patient_id);
                
                $this->appt['pt_name']      = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
                $this->appt['pt_phone']     = $findPt->patient_mobile;
                $this->appt['pt_addr']      = $findPt->patient_address;
                $this->appt['pt_occ']       = $findPt->patient_occupation;
                $this->appt['pt_avatar']    = $findPt->patient_avatar;

                $this->appt['id'] = $apptId->id;
                $this->appt['pt_date']      = $apptId->appt_date;
                $this->appt['pt_time']      = $apptId->appt_time;
                $this->appt['pt_status']    = $apptId->appt_status;

                $this->modal['update'] = true;
                $this->apptCreatedBy = 'pt';
                break;

            default:
        }
        $this->dispatchBrowserEvent('form-modal'); 
    }

    public function apptCloseModal()
    {
        $this->reset(['modal', 'appt']);

        $this->clearSearch(); 

        $this->dispatchBrowserEvent('confirm-dialog-close');
    }







    
    // public function editTime($id)
    // {
    //     $this->editTimeId = $id;
    //     $this->editTime = true;

    //     $schedsetting = Schedsetting::find($id);

    //     $this->time['am_from']  = $schedsetting->schedset_am_from;
    //     $this->time['am_to']    = $schedsetting->schedset_am_to;
    //     $this->time['pm_from']  = $schedsetting->schedset_pm_from;
    //     $this->time['pm_to']    = $schedsetting->schedset_pm_to;
    // }


    public function addTime()
    {
        $this->validate(
            ['timeSched' => 'required',], 
            ['timeSched.required' => '*Required']
        );

        $this->resetErrorBag();

        Time::create(['time' => $this->timeSched]);
        
        $this->timeSched = '';
    }

    public function deleteTime($id)
    {
        Time::destroy($id);
    }


    public function updateDay($status, $id)
    {
        $schedsetting = Schedsetting::find($id);

        $status == 1 
            ? $schedsetting->update(['schedset_checked' => true])
            : $schedsetting->update(['schedset_checked' => false]);

            // $this->reset(['editTime', 'editTimeId']);
    }



    // public function updateSchedSettings($id)
    // {
    //     // dd($id . ' ' .  . ' ' . . ' ' .  . ' ' . ;
    //     Schedsetting::find($id)
    //         ->update([
    //             'schedset_am_from'  => $this->time['am_from'], 
    //             'schedset_am_to'    => $this->time['am_to'] , 
    //             'schedset_pm_from'  => $this->time['pm_from'],
    //             'schedset_pm_to'    => $this->time['pm_to'],
    //         ]);
    //     $this->reset(['editTime', 'editTimeId', 'time']);
    // }

    // public function cancelUpdateSchedSettings()
    // {
    //     $this->reset(['editTime', 'editTimeId', 'time']);
    // }

    public function updateSchedSettingsAll()
    {
        $updateSchedSettings = Schedsetting::where('schedset_type', 'schedsetting')->where('schedset_checked', true);
        $updateSchedSettings->update([
            'schedset_am_from'  => $this->time['am_from'], 
            'schedset_am_to'    => $this->time['am_to'] , 
            'schedset_pm_from'  => $this->time['pm_from'],
            'schedset_pm_to'    => $this->time['pm_to'],
        ]);
        $this->resetFields('updateSchedSettingsAll');
        $this->emit('mount');
    }

    public function storage($url) 
    {
        if (!empty($url) || ($url != null)) {
            return Storage::disk('avatars')->url($url); } 
        else {
            return Storage::disk('avatars')->url('default-user-avatar.png'); } 
    }

    public function confirm_dialog_modal_close() { $this->dispatchBrowserEvent('confirm-dialog-close'); }

}
