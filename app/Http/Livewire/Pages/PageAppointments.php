<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Schedsetting;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Setting;
use App\Models\Day;
use App\Models\Year;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use Illuminate\Support\Str;



use App\Models\Time;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Storage;


class PageAppointments extends Component
{
    use WithPagination;




    public Patient $pt;


    public $confirmationMessage = 'Confirm Delete?';
    
    public $name, $checked1;

    public $myTab = 1;

    public $shedsettings_isOpen = false;

    public $apptSettings = false;

    public $apptSettingsTabs = 1;

    public $apptCreatedBy;

    public $selectedAppts = [];

    public $searchPatient, $isFillSearch = false, $searchPatientId;

    protected $listeners = ['mount'];

    public $searchAppt;

    public $pageNumber = 10;

    public $category = 0;


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

    public $modal = [
        'show'     => false,
        'add'      => false,
        'update'   => false,
    ];

    public 
        $isUpdate = false, 
        $isAdd = false, 
        $addAppt = false;

    // public $editTime = false, $editTimeId = '';

    public $colName = 'appt_status', $direction = 'asc';

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

    public $confirm = [
        'appt'    => false,
        'appts'   => false,
        'cancel'  => false,
        'approve' => false,
    ];

    protected $queryString = [
        'category',
    ];


    public $timeSched, $yearSched;

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

        $appts = Appointment::with('patient');

        if ($this->category > 0) 
            $appts = Appointment::with('patient')->where('appt_status', $this->category)->orderBy($this->colName, $this->direction)->paginate($this->pageNumber);
        else
            $appts = Appointment::with('patient')->orderBy($this->colName, $this->direction)->paginate($this->pageNumber);


        // $appts = Search::new()
        //     ->add(Appointment::class, 'appt_date')
        //     ->add(Patient::class, 'patient_lname')
        //     ->beginWithWildcard()
        //     ->search('new');

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

        $updateStatus;
        

        // if overdue update status to missed
        Appointment::where('appt_date', '<', date('Y-m-d'))->where('appt_status', '!=', 5)->where('appt_status', '!=', 6)->update(['appt_status' => 4]);
    
        $appts = Appointment::all();
        $appts_duedate = $appts->where('appt_date', date('Y-m-d'))
                    ->where('appt_status', '!=', 1)
                    ->where('appt_status', '!=', 4)
                    ->where('appt_status', '!=', 5)
                    ->where('appt_status', '!=', 6);


        foreach ($appts_duedate as $duedate) {
            $duedate->appt_date == date('Y-m-d')
                ? $updateStatus = ['patient_queue' => true, 'patient_exam_status' => true]
                : $updateStatus = ['patient_queue' => false, 'patient_exam_status' => false];

            Patient::where('id', $duedate->patient_id)->update($updateStatus);
        }
    }

    public function updatedYearSched()
    {
        if (!empty($this->yearSched)) {
            if (Str::length($this->yearSched) <> 4) {
                if ($this->yearSched < date('Y')) {
                    $this->dispatchBrowserEvent('toast',[
                        'title'   => NULL,
                        'class'   => 'error',
                        'message' => 'Valid year is ' . date('Y') . ' and more than.',
                    ]);
                }
                session()->flash('yearMessage', 'error');
            } else {
                $year = Year::where('year', $this->yearSched)->first();
                if ($year) {
                    session()->flash('yearMessage', 'error');
                } else {
                    Year::create(['year' => $this->yearSched]);
                    $this->yearSched = '';
                }
            }
        }
    }

    public function updatedTimeSched()
    {
        $this->addTime();
    }


    public function category($value)
    {
        switch ($value) {
            case 0: return 'All';           break;
            case 1: return 'For Approval';  break;
            case 2: return 'Ongoing';       break;
            case 3: return 'Rescheduled';   break;
            case 4: return 'Missed';        break;
            case 5: return 'Fulfilled';     break;
            case 6: return 'Cancelled';     break;
            default:
        }
    }
    public function categoryDesc($value)
    {
        $appt = Appointment::all();
        switch ($value) {
            case 0: return $appt->count();                           break;
            case 1: return $appt->where('appt_status', 1)->count();  break;
            case 2: return $appt->where('appt_status', 2)->count();  break;
            case 3: return $appt->where('appt_status', 3)->count();  break;
            case 4: return $appt->where('appt_status', 4)->count();  break;
            case 5: return $appt->where('appt_status', 5)->count();  break;
            case 6: return $appt->where('appt_status', 6)->count();  break;
            default:
        }
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

    public function moreOption_disableApprove($apptId)
    {
        $appt = Appointment::findOrFail($apptId);
        if ($appt->appt_status != 1)
            return true;
        else
            return false;
    }

    public function moreOption_disableCancel($apptId)
    {

        $appt = Appointment::findOrFail($apptId);
        if ($appt->appt_status == 4 || $appt->appt_status == 5 || $appt->appt_status == 6)
            return true;
        else
            return false;
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
        $this->validate([
            'appt.pt_date'   => 'required',
            'appt.pt_status' => 'required|integer',
        ]);


        switch ($this->apptCreatedBy) {
            case 'dc':
                Appointment::create([
                    'patient_id' => $this->appt['id'],
                    'appt_date' => $this->appt['pt_date'],
                    'appt_time' => $this->appt['pt_time'],
                    'appt_status' => $this->appt['pt_status'],
                ]);
                break;

            case 'pt':
                Appointment::where('id', $this->appt['id'])
                    ->update([
                        'appt_date' => $this->appt['pt_date'],
                        'appt_time' => $this->appt['pt_time'],
                        'appt_status' => $this->appt['pt_status']
                    ]);
                break;
        }

        $this->closeModal();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Updated Succesfully',
        ]);
    }


    public function deletingAppt($apptId)
    {
        $this->confirm['appt'] = true;

        $this->appt['id'] = $apptId;

        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deletingAppts()
    {
        $this->confirm['appts'] = true;
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
        Appointment::destroy($this->selectedAppts);

        $this->selectedAppts = [];

        $this->confirm_dialog_modal_close();

        $this->dispatchBrowserEvent('toast',[
            'title' => 'Deleted',
            'class' => 'success',
            'message' => 'Deleted Succesfully',
        ]);
    }



    public function approvingAppt($apptId) {
        $this->appt['id'] = $apptId;
        $this->confirm['approve'] = true;
        $this->confirmationMessage = 'Approve Appointment?';
        $this->dispatchBrowserEvent('confirm-dialog');
    }

    public function approveAppt()
    {
        $appt = Appointment::findOrFail($this->appt['id'])->first();

        if ($appt->appt_status == 1) {

            $appt->update(['appt_status' => 2]);

            $this->confirm_dialog_modal_close();
            $this->dispatchBrowserEvent('toast',[
                'title'   => 'Ongoing',
                'class'   => 'success',
                'message' => 'Appointment Ongoing.']);

        } elseif ($appt->appt_status == 2) {
            $this->confirm_dialog_modal_close();
            $this->dispatchBrowserEvent('toast',[
                'title'   => 'Approved',
                'class'   => 'success',
                'message' => 'This appointment has already been approved.']);

        } else {
            $this->confirm_dialog_modal_close();
            $this->dispatchBrowserEvent('toast',[
                'title'   => null,
                'class'   => 'error',
                'message' => 'Unable to make changes.']);
        }
        $this->reset(['confirm', 'appt']);
    }

    public function cancelingAppt($apptId)
    {
        $this->confirm['cancel'] = true;
        $this->appt['id'] = $apptId;
        $this->confirmationMessage = 'Do you want to Cancel this Appointment?';
        $this->dispatchBrowserEvent('confirm-dialog');
    }

    public function cancelAppt()
    {
        $appt = Appointment::findOrFail($this->appt['id'])->first();

        if ($appt->appt_status == 6) {
            $this->confirm_dialog_modal_close();
            $this->dispatchBrowserEvent('toast',[
                'title'   => null,
                'class'   => 'error',
                'message' => 'Cancelled Already']);
        } elseif ($appt->appt_status == 5 || $appt->appt_status == 4) {
            $this->confirm_dialog_modal_close();
            $this->dispatchBrowserEvent('toast',[
                'title'   => null,
                'class'   => 'error',
                'message' => 'Unable to cancel appointment.']);
        } else {
            $appt->update(['appt_status' => 6]);
            $this->confirm_dialog_modal_close();
            $this->dispatchBrowserEvent('toast',[
                'title'   => 'Cancelled',
                'class'   => 'success',
                'message' => 'Cancelled Succesfully']);
        }
        $this->reset(['confirm', 'appt']);
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
            case 'settings':
                $this->apptSettings = true;
                break;

            default:
        }
        $this->modal['show'] = true;
        $this->dispatchBrowserEvent('form-modal'); 
    }

    public function closeModal()
    {
        $this->reset(['modal', 'appt', 'apptSettings']);

        $this->clearSearch(); 

        $this->dispatchBrowserEvent('confirm-dialog-close');
    }








    // public function daysTimeTab()
    // {
    //     if ($this->days)
    //         $this->time = false;
    //     if ($this->time)
    //         $this->days = false;
    // }


    
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


    public function selectedDay($dayId)
    {
        // dd($dayId);
        $day = Day::find($dayId);

        $day->status 
            ? $day->update(['status' => false])
            : $day->update(['status' => true]);
    }


    public function addTime()
    {
        $this->validate(
            ['timeSched' => 'required',], 
            ['timeSched.required' => 'Required']
        );

        Time::create(['time' => $this->timeSched]);        

        $this->timeSched = '';
        
        $this->resetErrorBag();

    }

    public function deleteTime($id)
    {
        Time::destroy($id);
    }

    public function deleteYear($id)
    {
        Year::destroy($id);
    }

    public function enableScheduling()
    {
        $setting = Setting::where('code', 11)->first();

        $setting->status
            ? $setting->update(['status' => false])
            : $setting->update(['status' => true]);
    }

    public function enableSchedulingStatus($code)
    {
        $setting = Setting::where('code', $code)->first();
        if ($setting->status)
            return true;
        else 
            return false;
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






    public function confirm()
    {
        $this->confirm['appt']
            ? $this->deleteAppt()
            : NULL;
        $this->confirm['appts']
            ? $this->deleteAppts()
            : NULL;
        $this->confirm['approve']
            ? $this->approveAppt()
            : NULL;
        $this->confirm['cancel']
            ? $this->cancelAppt()
            : NULL;
    }
}
