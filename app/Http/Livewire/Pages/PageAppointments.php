<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Schedsetting;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Setting;
use App\Models\Day;
use App\Models\Year;
use App\Models\Appointment_category as Ac;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use Illuminate\Support\Str;
use Nexmo\Laravel\Facade\Nexmo;



use App\Models\Time;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Storage;


class PageAppointments extends Component
{
    use WithPagination;




    public Patient $pt;

    // public $confirmDialogTitle = 'Confirm?';

    // public $confirmDialogMessage = 'Confirm Delete?';
    
    public $name, $checked1;

    public $myTab = 1;

    public $shedsettings_isOpen = false;

    public $apptSettings = false, $apptSettings2 = false;

    public $apptSettingsTabs = 1;

    public $createAppt;

    public $selectedAppts = [];

    public $searchPatient, $isFillSearch = false, $searchPatientId;

    public $searchAppt;

    public $pageNumber = 10;

    public $deletingApptCat = false;

    public $apptCatColor;

    public $activeMenu = 'all';

    public $confirmStatusUpdate = false, $apptId, $statusId;

    public $day = false;

    public $timeSched, $yearSched;

    public 
        $isUpdate = false, 
        $isAdd = false, 
        $addAppt = false;

    public $colName = 'appt_status', $direction = 'asc';

    public 
        $setAll_am, 
        $setAll_pm,
        
        $amStart,
        $pmEnd;




    protected $listeners = ['mount'];

    public $apptCat = [
        'status' => false,
        'title' => '',
        'desc' => '',
        'message' => '',
        'color' => '',
    ];

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
        'show'      => false,
        'add'       => false,
        'update'    => false,
        'settings'  => false,
        'settings2' => false,
        'settings3' => false,
        'notification_settings' => false,
    ];


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
        'activeMenu'
    ];

    public function myTab($value)
    {
        return $this->myTab = $value;
    }

    public function render()
    {

        $this->apptSettings2 
            ? $this->apptSettings = false 
            : $this->apptSettings = true;

        $searchPatient = $this->searchPatient . '%';
        $pt = Patient::where('patient_fname' , 'like', $searchPatient)
                        ->orWhere('patient_lname', 'like', $searchPatient)
                        ->orWhere('patient_mname', 'like', $searchPatient)
                        ->get();

        $searchAppt = $this->searchAppt . '%';

        if ($this->activeMenu != 'all') 
            $appts = Appointment::with('patient')->with('appointment_category')->where('appointment_category_id', $this->activeMenu)->orderBy($this->colName, $this->direction)->paginate($this->pageNumber);
        else
            $appts = Appointment::with('patient')->with('appointment_category')->orderBy($this->colName, $this->direction)->paginate($this->pageNumber);


        return view('livewire.pages.page-appointments', 
            [
                'schedsettings' => Schedsetting::all(), 
                'categories' => Ac::all(),
                'appts' => $appts,
                'patients' => $pt,
            ])
            ->extends('layouts.app')
            ->section('content');
    }

    public function mount()
    {
        // $appts = Appointment::with('patient')->where('appt_date', tomorrow())->get();
        // if ($appts->count() > 0) {
        //     foreach ($appts as $appt) {
        //         sendSMS(
        //             $number = $appt->patient->patient_mobile,
        //             $message = 'Hello ' . $appt->patient->patient_fname . ', you have an appointment tommorow ' . humanReadableDate($appt->appt_date) . ' at ' . humanReadableTime($appt->appt_time) . '. See you tomorrow and have a Great Day!'
        //         );
        //     }
        // }
    }

    public function updatedCategory()
    {
        $this->resetPage();
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


    public function categoryName($id)
    {
        if ($id == 'all') return 'All';
        else return Ac::find($id)->title;
    }


    public function categoryDesc($value)
    {
        if ($value == 'all') 
            return Appointment::count();
        else 
            return Appointment::where('appointment_category_id', $value)->count();
    }

    public function categoryCount($value)
    {
        if ($value == 'all') 
            return Appointment::count();
        else 
            return Appointment::where('appointment_category_id', $value)->count();
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

    // public function date($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    // public function day($day) { return \Carbon\Carbon::parse($day)->format('l'); }

    public function time($time) { return isset($time) ? \Carbon\Carbon::parse($time)->format('g:i A') : ''; }

    public function orderBy($colName, $direction)
    {
        $this->colName = $colName;
        $this->direction = $direction;
    }

    // public function statusColor($status)
    // {
    //     switch ($status) {
    //         case 1: return '#0275d8'; break;
    //         case 2: return '#5cb85c'; break;
    //         case 3: return '#5bc0de'; break;
    //         case 4: return '#d9534f'; break;
    //         case 6: return '#f62681'; break;
    //         default:
    //     }
    // }

    // public function apptStatus($status)
    // {
    //     switch ($status) {
    //         case 1: return $this->apptStatus[1]; break;
    //         case 2: return $this->apptStatus[2]; break;
    //         case 3: return $this->apptStatus[3]; break;
    //         case 4: return $this->apptStatus[4]; break;
    //         case 5: return $this->apptStatus[5]; break;
    //         case 6: return $this->apptStatus[6]; break;
    //         default:
    //     }
    // }

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

    // public function clearSearch()
    // {
    //     return $this->reset([
    //         'searchPatient',
    //         'isFillSearch',
    //     ]);
    // }

    public function autoCompleteSearch($id)
    {
        $patientFound = Patient::findOrFail($id);
        $this->searchPatient = $patientFound->patient_lname . ', ' . $patientFound->patient_fname . ' ' . $patientFound->patient_mname;
        $this->searchPatientId = $patientFound->id;
        $this->isFillSearch = true;
    }


    public function setColor($acId, $cvalue, $cname)
    {
        Ac::find($acId)->update(['color' => $cvalue, 'cname' => $cname]);
    }


    public function notfifyUserOnAppointmentStatusUpdate($userId) 
    {
        $userIdToSendNotification = Patient::findOrFail($userId)->user_id;

        notify('createdAppt', 'Appointment update', 'Your appointment status was updated.', '', $userIdToSendNotification);
    }

    public function updateApptStatus($statusId, $apptId)
    {
        $this->confirmStatusUpdate = true;
        $this->statusId = $statusId;
        $this->apptId = $apptId;
        $title = Ac::find($statusId)->title;
        // $this->confirmDialogMessage= 'Status will be changed as ' . $title . '. Do you want to proceed?';
        $this->dispatchBrowserEvent('confirm-dialog',[
            'title' => 'Are you sure?',
            'content' => 'Status will be changed as "' . $title . '". Do you want to proceed?'
        ]); 
    }

    public function updateStatus() 
    {
        $this->dispatchBrowserEvent('confirm-dialog-close');
        $appt = Appointment::findOrFail($this->apptId);
        $appt->update(['appointment_category_id' => $this->statusId]);
        if ($appt) {

            $this->notfifyUserOnAppointmentStatusUpdate($appt->patient_id); 
            // $userIdToSendNotification = Patient::findOrFail($appt->patient_id)->user_id;
            // notify('createdAppt', 'Appointment update', 'Your appointment status was updated.', '', $userIdToSendNotification);

            $this->notify($appt->patient_id, $appt->appointment_category_id);
            $this->dispatchBrowserEvent('toast',[
                'title' => null,
                'class' => 'success',
                'message' => 'Status has changed succesfully.',
            ]);
        } else {
            $this->dispatchBrowserEvent('toast',[
                'title' => null,
                'class' => 'error',
                'message' => 'Unable to make changes. Please try again.',
            ]);
        }
    }    



    public function createAppt($patientId)
    {
        $findPt = Patient::findOrFail($patientId);
        $this->appt['pt_name'] = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
        $this->appt['pt_phone'] = $findPt->patient_mobile;
        $this->appt['pt_addr'] = $findPt->patient_address;
        $this->appt['pt_occ'] = $findPt->patient_occupation;
        $this->appt['pt_avatar'] = $findPt->patient_avatar;
        $this->appt['id'] = $findPt->id;

        $this->appt['pt_status'] = $this->apptStatus[2];
        $this->createAppt = 'toCreate';

        $this->modal['add'] = false;
        $this->modal['update'] = true;

        $this->reset([
            'isFillSearch',
            'searchPatient',
        ]);
    }

    public function updateAppt()
    {

        $this->validate(
            [
                'appt.pt_date'   => 'required',
                'appt.pt_status' => 'required|integer',
            ],
            [
                'appt.pt_date.required' => 'Required',
                'appt.pt_status.required' => 'Required',
                'appt.pt_status.integer' => 'Required',
            ]
        );

        switch ($this->createAppt) {
            case 'toCreate':
                $appt = Appointment::create([
                    'patient_id' => $this->appt['id'],
                    'appt_date' => $this->appt['pt_date'],
                    'appt_time' => $this->appt['pt_time'],
                    'appointment_category_id' => $this->appt['pt_status'],
                ]);

                if ($this->appt['pt_date'] < date('Y-m-d')) {
                    $this->dispatchBrowserEvent('toast',[
                        'title' => null,
                        'class' => 'error',
                        'message' => 'Over Due',
                    ]);
                } else {
                    $this->notify($appt->patient_id, $this->appt['pt_status']);
                    $this->dispatchBrowserEvent('toast',[
                        'title' => null,
                        'class' => 'success',
                        'message' => 'Added Succesfully',
                    ]);
                }

                break;

            case 'updateCreated':
                $appt = Appointment::find($this->appt['id']);
                $appt->update([
                    'appt_date' => $this->appt['pt_date'],
                    'appt_time' => $this->appt['pt_time'],
                    'appt_status' => $this->appt['pt_status']
                ]);


                if ($this->appt['pt_date'] < date('Y-m-d')) {
                    $this->dispatchBrowserEvent('toast',[
                        'title' => null,
                        'class' => 'error',
                        'message' => 'Over Due',
                    ]);
                } else {
                    $this->notfifyUserOnAppointmentStatusUpdate($appt->patient_id);
                    $this->notify($appt->patient_id, $this->appt['pt_status']);
                    $this->dispatchBrowserEvent('toast',[
                        'title' => null,
                        'class' => 'success',
                        'message' => 'Updated Succesfully',
                    ]);
                }
                break;
            }
            
        $this->closeModal();
        $this->resetErrorBag();
      
    }

    public function notify($patientId, $apptStatusId)
    {
        // get text message
        $notify = Ac::find($apptStatusId);
        //find [date] string and replace by the actual date
        $text = Str::replace('[date]', humanReadableDate($this->appt['pt_date']), $notify->notify);
        //get patient number
        $pt_mobile = Patient::find($patientId)->patient_mobile;
        //send message

        try {
            return sendSMS($pt_mobile, $text);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast',[
                'title' => null,
                'class' => 'error',
                'message' => 'Sorry, unable to send a message. Please check phone number.',
            ]);
        }
    }


    public function deletingAppt($apptId)
    {
        $this->confirm['appt'] = true;
        $this->appt['id'] = $apptId;


        $appt = Appointment::find($apptId)->with('patient')->first();
        $pt = Str::title($appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname);
        $apptDate = humanReadableDate($appt->appt_date);

        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Delete Appointment', 
            'content' => 'Appointment will be deleted. Do you want to proceed?',
        ]); 
    }

    public function deletingAppts()
    {
        $this->confirm['appts'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Delete Appointments',
            'content' => 'Are you sure you want to delete this appointments?'
        ]);
    }

    public function deleteAppt()
    {
        Appointment::destroy($this->appt['id']);
        $this->resetPage();
        $this->dispatchBrowserEvent('confirm-dialog-close');
        $this->dispatchBrowserEvent('toast',[
            'title' => 'Deleted',
            'class' => 'success',
            'message' => 'Deleted Succesfully',
        ]);
    }

    public function deleteAppts()
    {
        Appointment::destroy($this->selectedAppts);

        $this->selectedAppts = [];
        $this->resetPage();
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
        $this->confirmDialogMessage = 'Approve Appointment?';
        $this->dispatchBrowserEvent('confirm-dialog');
    }

    // public function approveAppt()
    // {
    //     $appt = Appointment::findOrFail($this->appt['id'])->first();

    //     if ($appt->appt_status == 1) {

    //         $appt->update(['appt_status' => 2]);

    //         $this->confirm_dialog_modal_close();
    //         $this->dispatchBrowserEvent('toast',[
    //             'title'   => 'Ongoing',
    //             'class'   => 'success',
    //             'message' => 'Appointment Ongoing.']);

    //     } elseif ($appt->appt_status == 2) {
    //         $this->confirm_dialog_modal_close();
    //         $this->dispatchBrowserEvent('toast',[
    //             'title'   => 'Approved',
    //             'class'   => 'success',
    //             'message' => 'This appointment has already been approved.']);

    //     } else {
    //         $this->confirm_dialog_modal_close();
    //         $this->dispatchBrowserEvent('toast',[
    //             'title'   => null,
    //             'class'   => 'error',
    //             'message' => 'Unable to make changes.']);
    //     }
    //     $this->reset(['confirm', 'appt']);
    // }

    public function cancelingAppt($apptId)
    {
        $this->confirm['cancel'] = true;
        $this->appt['id'] = $apptId;
        $this->confirmDialogMessage = 'Do you want to Cancel this Appointment?';
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
        $this->reset(['modal', 'appt']);

        switch ($data) {
            // case 'isAdd':
            //     $this->modal['add'] = true;
            //     break;

            case 'isUpdate':
                if ($id == null) {
                    $this->modal['update'] = true;
                } else {
                    $apptId = Appointment::findOrFail($id);
                    $findPt = Patient::findOrFail($apptId->patient_id);
                    
                    $this->appt['pt_name']      = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
                    $this->appt['pt_phone']     = $findPt->patient_mobile;
                    $this->appt['pt_addr']      = $findPt->patient_address;
                    $this->appt['pt_occ']       = $findPt->patient_occupation;
                    $this->appt['pt_avatar']    = $findPt->patient_avatar;
    
                    $this->appt['id']           = $apptId->id ?? '';
                    $this->appt['pt_date']      = $apptId->appt_date ?? '';
                    $this->appt['pt_time']      = $apptId->appt_time ?? '';
                    $this->appt['pt_status']    = $apptId->appointment_category_id;
    
                    $this->modal['update'] = true;
                    $this->createAppt = 'updateCreated';

                }
                break;
            case 'settings':  
                $this->modal['settings'] = true; 
                break;
            case 'settings3': 
                $this->modal['settings3'] = true; 
                break;
            default:
        }
        $this->modal['show'] = true;
        // $this->dispatchBrowserEvent('form-modal'); 
    }

    public function closeModal()
    {
        $this->reset(['modal', 'appt', 'apptSettings', 'apptSettings2', 'deletingApptCat']);
        $this->resetErrorBag();
        // $this->clearSearch(); 
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
        $day = Day::find($dayId);

        $day->status 
            ? $day->update(['status' => false])
            : $day->update(['status' => true]);
    }

    public function selectedApptCategory($apptCategoryId)
    {
        $apptCategory = Ac::find($apptCategoryId);

        $apptCategory->status
            ? $apptCategory->update(['status' => false])
            : $apptCategory->update(['status' => true]); 
    }

    
    public function addApptColor($id)
    {
        Ac::find($id)->update(['color' => $this->apptCat['color']]);
        $this->apptCat['color'] = '';
    }


    public function addApptCategory()
    {
        $this->validate([
            'apptCat.title' => 'required|max:20|unique:appointment_categories,title',
        ]);

        Ac::create([
            'status' => true,
            'title' => $this->apptCat['title'],
        ]);

        $this->reset(['apptCat']);
        $this->resetErrorBag();
    }

    public function deleteApptCategory($id) { Ac::destroy($id); }

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

    public function deleteTime($id) { Time::destroy($id); }

    public function deleteYear($id) { Year::destroy($id); }


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
        if ($setting->status) return true;
        else return false;
    }


    public function updateDay($status, $id)
    {
        $schedsetting = Schedsetting::find($id);

        $status == 1 
            ? $schedsetting->update(['schedset_checked' => true])
            : $schedsetting->update(['schedset_checked' => false]);
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






    public function confirmed()
    {
        $this->confirm['appt']
            ? $this->deleteAppt()
            : NULL;
        $this->confirm['appts']
            ? $this->deleteAppts()
            : NULL;
        // $this->confirm['approve']
        //     ? $this->approveAppt()
        //     : NULL;
        $this->confirm['cancel']
            ? $this->cancelAppt()
            : NULL;
        $this->confirmStatusUpdate
            ? $this->updateStatus()
            : NULL;
    } 
}
