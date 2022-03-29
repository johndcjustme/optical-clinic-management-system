<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Time;



class PagePatientAppt extends Component
{

    public $appt = [
        'date' => '',
        'time' => '',
    ];
    
    public $pt = [
        'id' => '',
        'fname' => '',
        'lname' => '',
        'mname' => '',
        'gender' => '',
        'addr' => '',
        'occ' => '',
        'age' => '',
        'mobile' => '',
        'email' => '',
    ];

    public $apptStatus = [
        1 => "For Approval",
        2 => "Ongoing",
        3 => "Rescheduled",
        4 => "Missed",
        5 => "Fulfilled",
        6 => "Cancelled",
    ];

    public $step = 3;

    public $cancelAppt = false;

    protected $rules = [
        'pt.email'  => 'nullable|email',
        'pt.lname'  => 'Required',
        'pt.fname'  => 'Required',
        'pt.mobile' => 'Required',
        'pt.addr'   => 'Required',
    ];
 
    protected $messages = [
        'pt.email.email'        => 'Make sure it is a valid email',
        'pt.lname.required'     => 'Required',
        'pt.fname.required'     => 'Required',
        'pt.mobile.required'    => 'Required',
        'pt.addr.required'      => 'Required',
    ];

    protected $queryString = [
        'step' => '',
    ];


    public function render()
    {
        $patient = Patient::where('user_id', Auth::user()->id)->first();

        if ($this->step == 1) {
            if (isset($patient)) {
                $this->pt['fname']  = $patient->patient_fname; 
                $this->pt['lname']  = $patient->patient_lname;
                $this->pt['mname']  = $patient->patient_mname;
                $this->pt['gender'] = $patient->patient_gender;
                $this->pt['addr']   = $patient->patient_address;
                $this->pt['occ']    = $patient->patient_occupation;
                $this->pt['age']    = $patient->patient_age;
                $this->pt['mobile'] = $patient->patient_mobile;
                $this->pt['email']  = $patient->patient_email;
            }
        }


        if (!empty($patient->id)) {
            $myAppts = Appointment::with('patient')->where('patient_id', $patient->id)->orderByDesc('appt_date')->get();
            return view('livewire.pages.page-patient-appt', [
                'my_appts' => $myAppts,
            ])
                ->extends('layouts.app')
                ->section('content');
        } else {
            $this->step = 1;
            return view('livewire.pages.page-patient-appt')
                ->extends('layouts.app')
                ->section('content');
        }

    }

    public function date($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    public function created_at($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    public function day($day) { return \Carbon\Carbon::parse($day)->format('l'); }

    public function time($time) { return isset($time) ? \Carbon\Carbon::parse($time)->format('g:i A') : ''; }

    public function step($step)
    {
        $patient = Patient::where('user_id', Auth::user()->id)->first();

        switch ($step) {
            case 1: isset($patient) ? $this->step = 1 : $this->step = 1; break;
            case 2: 
                
                if (isset($patient)) {
                    $this->step = 2; 
                } else {
                    $this->step = 1;
                    $this->dispatchBrowserEvent('toast',[
                        'title' => null,
                        'class' => 'error',
                        'message' => 'Fill your information first.',
                    ]);    
                }
                break;
            case 3: 
                if (isset($patient)) {
                    $this->step = 3; 
                } else {
                    $this->step = 1;
                    $this->dispatchBrowserEvent('toast',[
                        'title' => null,
                        'class' => 'error',
                        'message' => 'Fill your information first.',
                    ]);   
                }
                break;
            default:
        }
    }

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



    public function newPatient()
    {
        $this->validate();

        // dd(
        //     $this->pt['fname'] . ' ' .
        //     $this->pt['lname'] . ' ' .
        //     $this->pt['mname'] . ' ' .
        //     $this->pt['gender'] . ' ' .
        //     $this->pt['addr'] . ' ' .
        //     $this->pt['occ'] . ' ' .
        //     $this->pt['age'] . ' ' .
        //     $this->pt['mobile'] . ' ' . 
        //     $this->pt['email'] . ' ' 
        // );
        $myId = Auth::user()->id;

        Patient::updateOrCreate(
            [
                'user_id' => $myId,
            ],
            [
                'patient_fname'         => $this->pt['fname'],
                'patient_lname'         => $this->pt['lname'],
                'patient_mname'         => $this->pt['mname'],
                'patient_gender'        => $this->pt['gender'],
                'patient_address'       => $this->pt['addr'],
                'patient_occupation'    => $this->pt['occ'],
                'patient_age'           => $this->pt['age'],
                'patient_mobile'        => $this->pt['mobile'],
                'patient_email'         => $this->pt['email'],
            ]
        );

        $this->resetErrorBag();

        $this->step = 2;

        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Your information saved.',
        ]);   



    }


    public function newAppt()
    {
        $this->validate(
            [   
                'appt.date' => 'Required',
                'appt.time' => 'Required',
            ],
            [
                'appt.date.required' => 'Required',
                'appt.time.required' => 'Required',   
            ],
        );


        $patient = Patient::where('user_id', Auth::user()->id)->first();

        if ($patient) {
            Appointment::create([
                'patient_id' => $patient->id,
                'appt_date' => $this->appt['date'],
                'appt_time' => $this->appt['time'],
                'appt_status' => 1,
            ]);
    
            $this->step = 3;

            $this->reset(['appt']); 
    
            $this->dispatchBrowserEvent('toast',[
                'title' => null,
                'class' => 'success',
                'message' => 'Done.',
            ]);   
        } else {
            $this->dispatchBrowserEvent('toast',[
                'title' => null,
                'class' => 'error',
                'message' => 'You need to fill your information first.',
            ]);  
        }
    }

    public function cancelingAppt($id)
    {
        $this->appt['id'] = $id;

        $this->cancelAppt = true;

        $this->dispatchBrowserEvent('confirm-dialog');
    }

    public function cancelAppt()
    {
        Appointment::find($this->appt['id'])->update([
            'appt_status' => 6,
        ]);
        $this->dispatchBrowserEvent('confirm-dialog-close');

        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Cancelled',
        ]);
    }

    public function confirm()
    {
        if ($this->cancelAppt) {
            $this->cancelAppt();
        }
    }

    // public function createAppt()
    // {
        // dd(
        //     $this->pt['fname'] . ' ' .
        //     $this->pt['lname'] . ' ' .
        //     $this->pt['mname'] . ' ' .
        //     $this->pt['gender'] . ' ' .
        //     $this->pt['addr'] . ' ' .
        //     $this->pt['occ'] . ' ' .

        //     $this->appt['date'] . ' ' .
        //     $this->appt['am'] . ' ' .
        //     $this->appt['pm'] . ' ' 
        // );

    //     $this->validate();
    //     $newPatient = Patient::create([
    //         'user_id'               => Auth::user()->id,
    //         'patient_fname'         => $this->pt['fname'],
    //         'patient_lname'         => $this->pt['lname'],
    //         'patient_mname'         => $this->pt['mname'],
    //         'patient_gender'        => $this->pt['gender'],
    //         'patient_address'       => $this->pt['addr'],
    //         'patient_occupation'    => $this->pt['occ'],
    //         'patient_age'           => $this->pt['age'],
    //         'patient_mobile'        => $this->pt['mobile'],
    //         'patient_email'         => $this->pt['email'],
    //     ]);

    //     $newAppointment = Appointment::create([
    //         'patient_id' => $newPatient->id,
    //         'appt_date' => $this->appt['date'],
    //         'appt_time' => $this->appt['time'],
    //         'appt_status' => 1,
    //     ]);



    //     dd('done');

    //     $this->resetErrorBag();
    //     // Appointment::create([
    //     //     date
    //     //     am
    //     //     pm
    //     // ]);
    // }
}
