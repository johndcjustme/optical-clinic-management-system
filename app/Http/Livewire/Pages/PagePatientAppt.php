<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Time;
use App\Models\Day;
use App\Models\Year;



class PagePatientAppt extends Component
{


    public $month;
    
    public $day;

    public $year;

    public $filter = 'all';


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

    public $confirm = [
        'newAppt',
        'message' => 'Confirm Delete?',
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
        'filter' => ['except' => 'all'],
    ];


    public function render()
    {

        $month = date('m', mktime(0,0,0,$this->month,$this->day,$this->year));
        $day = date('d', mktime(0,0,0,$this->month,$this->day,$this->year));
        $year = date('Y', mktime(0,0,0,$this->month,$this->day,$this->year));

        $this->appt['date'] = $year . '-' . $month . '-' . $day;

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
            if ($this->filter == 'all') {
                $myAppts = Appointment::with('patient')->with('appointment_category')->orderByDesc('created_at')->where('patient_id', $patient->id)->get();
            } else {
                $myAppts = Appointment::with('patient')->with('appointment_category')->orderByDesc('created_at')->where('patient_id', $patient->id)->where('appt_status', $this->filter)->get();
            }
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

    public function mount()
    {
        $this->month = date('m');
        $this->day = date('d');
        $this->year = date('Y');
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

    // public function statusColor($status)
    // {
    //     switch ($status) {
    //         case 1: return 'blue'; break;
    //         case 2: return 'green'; break;
    //         case 3: return 'teal'; break;
    //         case 4: return 'red'; break;
    //         case 6: return 'orange'; break;
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

    public function confirmNewAppt()
    {
        $this->confirm['newAppt'] = true;
        $this->confirm['message'] = 'Confirm Appointment?';
        $this->dispatchBrowserEvent('confirm-dialog');
    }


    public function newAppt()
    {
        // $this->validate(
        //     [   
        //         'appt.date' => 'Required',
        //         'appt.time' => 'Required',
        //     ],
        //     [
        //         'appt.date.required' => 'Required',
        //         'appt.time.required' => 'Required',   
        //     ],
        // );


        $patient = Patient::where('user_id', Auth::user()->id)->first();

        if ($patient) {
            Appointment::create([
                'patient_id' => $patient->id,
                'appt_date' => $this->appt['date'],
                'appt_time' => $this->appt['time'],
                'appt_status' => 1,
            ]);
    
            $this->step = 3;

            $this->reset(['confirm', 'appt']);

            $this->dispatchBrowserEvent('confirm-dialog-close');
    
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
        $this->confirm['newAppt'] 
            ? $this->newAppt()
            : NULL;
    }


    public function findDay($day)
    {
        $days = Day::where('day', $day)->where('status', false)->first();
        if ($days) return true;
    }
    
    public function countAppts($status)
    {
        $this->pt['id'] = Patient::where('user_id', Auth::user()->id)->first()->id;
        if ($status == 'all')
            return Appointment::where('patient_id', $this->pt['id'])->count();
        else 
            return Appointment::where('patient_id', $this->pt['id'])->where('appt_status', $status)->count();

        // switch ($status) {
        //     case 1:
        //         break;
        //     default:
        //         return $appts->count();
        // }
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
