<?php

namespace App\Http\Livewire\Pages;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Exam;
use App\Models\Lense;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Purchased_item;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;





class PagePatient extends Component
{
    use WithPagination;


    public $tab = 1;

    // public $purchase_select_item = 1;

    public $itemType, $searchLense, $searchItem;

    public $searchPatient = '';

    public $purchaseId, $purchasePatientId, $latestPurchase;

    public $showInPatient = 1;

    public $subPage = 1;

    public $historyPage;

    public $patientId;

    public $pageNumber = 10;

    public 
        $total = 0,
        $discount = 0,
        $balance = 0,
        $deposit = 0;


    public $modal = [
        'show' => false,
        'patientShowModal'     => false,
            'isAddPatient'      => false,
            'isUpdatePatient'   => false,
            'isExamPurchase'    => false,
                'exam_purchase_tab' => 1,
    ];

    public 
        $selectOption, 
        $addToQueue = false,
        $purchaseDirectly = false;

    public $status = [
        '1' => 'Queue',
        '2' => 'Recently Examined',
        '3' => '',
    ];

    public $statusColor = [
        '1' => 'orange',
        '2' => 'green',
        '3' => 'blue',
    ];

    public $latest_purchase = [
        'id'        => '',
        'discount'  => 0,
        'deposit'   => 0,
        'balance'   => 0,
        'total'     => 0,
        'date'      => '',
    ];

    public $pt = [
        'id'      => '',
        'avatar'  => '',
        'fullname'   => '',
        'fname'   => '',
        'lname'   => '',
        'mname'   => '',
        'addr'    => '',
        'age'    => '',
        'no'      => '',
        'gender'  => '',
        'occ'     => '',
        'email'   => '',
    ];

    public $exam = [
        'history'     => '',
        'last'         => false,
        'id'           => '',
        'patient_id'   => '',
        'exam_OD_SPH'  => '',
        'exam_OD_CYL'  => '',
        'exam_OD_AXIS' => '',
        'exam_OD_NVA'  => '',
        'exam_OD_PH'   => '',
        'exam_OD_CVA'  => '',
        'exam_OS_SPH'  => '',
        'exam_OS_CYL'  => '',
        'exam_OS_AXIS' => '',
        'exam_OS_NVA'  => '',
        'exam_OS_PH'   => '',
        'exam_OS_CVA'  => '',
        'exam_ADD'     => '',
        'created_at'   => '',
        'updated_at'   => '',
        'exam_PD'      => '',
        'exam_remarks'      => '',
    ];

    // protected $rules = [
    //     'pt.fname' => 'required',
    //     'pt.lname' => 'required',
    // ];

    // protected $messages = [
    //     'pt.fname.required' => 'Required',
    //     'pt.lname.required' => 'Required',
    // ];

    protected $queryString = [
        'searchPatient' => ['except' => ''],
        'subPage' => 1,
        'historyPage' => 1,
        'patientId' => ['except' => ''],
    ];

    protected $listeners = ['getLastExam'];

    public function render() 
    {
   
        $this->total();

        // $purchased_item->item->item_price->
        
        number_format($this->total, 2);



        $searchItem = '%' . $this->searchItem . '%';
        $items = Item::where('item_name', 'like', $searchItem)->get();

        $searchPatient = $this->searchPatient . '%';
        $pts = Patient::where('patient_fname', 'like', $searchPatient)
                ->orWhere('patient_lname', 'like', $searchPatient)
                ->orWhere('patient_mname', 'like', $searchPatient)
                ->paginate($this->pageNumber);

        return view('livewire.pages.page-patient',[
                'pts' => $pts,
                'selectedItems' => Purchased_item::with('item')->where('purchase_id', $this->latest_purchase['id'])->orderBy('id', 'desc')->get(),
                'items' => $items,
                'purchases' => Purchase::with('patient')->get(),
            ])
            ->extends('layouts.app')
            ->section('content');
    }


    public function date($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }


    public function total()
    {
        $this->total = 0;

        $purchase_item =  Purchased_item::where('purchase_id', $this->latest_purchase['id'])->get();

        foreach ($purchase_item as $pi) {
            $this->total += $pi->qty * $pi->item_price;
        }

        !empty($this->discount) && ($this->discount > 0)
            ? $this->total = $this->total - $this->discount
            : NULL;

        $this->deposit > 0
            ? $this->balance = $this->total - $this->deposit
            : $this->balance = 0;
    }

    public function purchaseNewItem($ptId)
    {
        $purchasedId = Purchase::create([
            'patient_id' => $ptId,
        ]);
        if ($purchasedId) {
            $this->purchaseId = $purchasedId->id;
            $this->purchasePatientId = $purchasedId->patient_id;
            $this->exam_purchase_tab('purchase', $ptId);
        }
    }

    public function deletePurchase($id)
    {
        Purchase::findOrFail($id)->delete();
        //call the puchase tab
        $this->exam_purchase_tab('purchase', $this->pt['id']);
    }

    public function addItem($purchaseId, $itemId, $itemPrice)
    {
        Purchased_item::create([
            'purchase_id' => $purchaseId, 
            'item_id' => $itemId,
            'item_price' => $itemPrice,
            'qty' => '1',
        ]);

        $this->searchItem = '';
    }

    public function inc_dec_item($data, $itemId) 
    {

        $data == 'inc' ? $dbRaw = 'qty + 1' : NULL;
        $data == 'dec' ? $dbRaw = 'qty - 1' : NULL;

        Purchased_item::findOrFail($itemId)
            ->update(['qty' => DB::raw($dbRaw)]);
    }

    public function removeItem($itemId) { Purchased_item::findOrFail($itemId)->delete(); }

    public function exam_purchase_tab($data, $patientId)
    {
        $findPt = Patient::findOrFail($patientId);
        $this->pt['avatar']     = $findPt->patient_avatar;
        $this->pt['id']         = $findPt->id;
        $this->pt['fullname']   = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
        $this->pt['addr']       = $findPt->patient_address;
        $this->pt['gender']     = $findPt->patient_gender;
        $this->pt['occ']        = $findPt->patient_occupation;
        $this->pt['age']      = $findPt->patient_age;
        $this->pt['no']         = $findPt->patient_mobile;
        $this->pt['email']      = $findPt->patient_email;

        switch ($data) {
            case 'exam':
                $this->exam['previous'] = Exam::where('patient_id', $patientId)->count();
                $this->getLastExam($patientId);
                $this->modal['exam_purchase_tab'] = 1;
                break;
            case 'purchase':
                $this->latestPurchase = $this->isPatientPurchased($patientId);
                $this->latest_purchase['id'] = $this->latestPurchase->id ?? null;
                $this->discount = $this->latestPurchase->discount ?? '0';
                $this->deposit = $this->latestPurchase->deposit ?? '0';
                $this->balance = $this->latestPurchase->balance ?? '0';
                $this->latest_purchase['date'] = $this->latestPurchase->created_at ?? '';
                $this->modal['exam_purchase_tab'] = 2;
                break;
            case 'patient':

                $this->modal['exam_purchase_tab'] = 3;
                break;
        }
    }

    public function isPatientPurchased($patientId) { return Purchase::where('patient_id', $patientId)->latest()->first(); }

    public function purchaseDate($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    public function savePayment($purchaseId)
    {
        // dd($this->total . ', ' . $this->balance . ', ' . $this->deposit . ', ' . $this->discount);
        Purchase::where('id', $purchaseId)
            ->update([
                'total' => $this->total,
                'deposit' => $this->deposit,
                'balance' => $this->balance,
                'discount' => $this->discount,
            ]);

        session()->flash('savedPayment', 'Saved');
    }

    public function addPt()
    {
        $this->validate(
            [
                'pt.fname' => 'required|max:100',
                'pt.lname' => 'required|max:100',
            ],
            [
                'pt.fname.required' => 'Required',  
                'pt.lname.required' => 'Required',
            ]
        );

        Patient::create([
            'patient_fname' => $this->pt['fname'],
            'patient_mname' => $this->pt['mname'],
            'patient_lname' => $this->pt['lname'],
            'patient_mobile' => $this->pt['no'],
            'patient_gender' => $this->pt['gender'], 
            'patient_address' => $this->pt['addr'], 
            'patient_occupation' => $this->pt['occ'], 
            'patient_email' => $this->pt['email'], 
        ]);
        $this->closeModal();
        session()->flash('message', 'Patient added successfully.');
    }

    public function updatePt()
    {
        $this->validate();
        $updatePt = Patient::findOrFail($this->pt['id']);
        $updatePt->update([
           'patient_fname'      => $this->pt['fname'],
           'patient_mname'      => $this->pt['mname'],
           'patient_lname'      => $this->pt['lname'],
           'patient_mobile'     => $this->pt['no'],
           'patient_gender'     => $this->pt['gender'], 
           'patient_address'    => $this->pt['addr'], 
           'patient_occupation' => $this->pt['occ'], 
           'patient_email'      => $this->pt['email'], 
        ]);
        if ($updatePt) {
            session()->flash('message', 'Updated successfully.');
        } else {
            // an error has occured
            dd('error');
        }
        $this->closeModal();
    }

    public function addToQueue($patientId)
    {
        // dd($patientId);
        Patient::where('id', $patientId)
            ->update([
                'patient_status' => 1,
            ]);
        session()->flash('message', 'Patient added.');
    }

    public function newExam($patientId)
    {
        Exam::create([
            'patient_id' => $patientId,
        ]);
        $this->getLastExam($patientId);
    }

    public function updateExam($examId)
    {
        // dd($examId);
        Exam::findOrFail($examId)
            ->update([
                'exam_OD_SPH'  => $this->exam['exam_OD_SPH'],
                'exam_OD_CYL'  => $this->exam['exam_OD_CYL'],
                'exam_OD_AXIS' => $this->exam['exam_OD_AXIS'],
                'exam_OD_NVA'  => $this->exam['exam_OD_NVA'],
                'exam_OD_PH'   => $this->exam['exam_OD_PH'],
                'exam_OD_CVA'  => $this->exam['exam_OD_CVA'],
                'exam_OS_SPH'  => $this->exam['exam_OS_SPH'],
                'exam_OS_CYL'  => $this->exam['exam_OS_CYL'],
                'exam_OS_AXIS' => $this->exam['exam_OS_AXIS'],
                'exam_OS_NVA'  => $this->exam['exam_OS_NVA'],
                'exam_OS_PH'   => $this->exam['exam_OS_PH'],
                'exam_OS_CVA'  => $this->exam['exam_OS_CVA'],
                'exam_ADD'     => $this->exam['exam_ADD'],
                'exam_PD'     => $this->exam['exam_PD'],
                'exam_remarks'     => $this->exam['exam_remarks'],
            ]);
        session()->flash('savedExam', 'Saved');
    }

    public function deleteExam($examId) 
    {
        Exam::findOrFail($examId)->delete();
        $this->getLastExam($this->pt['id']);
    }

    public function getLastExam($patientId)
    {
        $getExam = Exam::where('patient_id', $patientId)->latest()->first();
        if ($getExam) {
            $this->exam['id']   = $getExam->id;
            $this->exam['exam_OD_SPH']   = $getExam->exam_OD_SPH;
            $this->exam['exam_OD_CYL']   = $getExam->exam_OD_CYL;
            $this->exam['exam_OD_AXIS']  = $getExam->exam_OD_AXIS;
            $this->exam['exam_OD_NVA']   = $getExam->exam_OD_NVA;
            $this->exam['exam_OD_PH']    = $getExam->exam_OD_PH;
            $this->exam['exam_OD_CVA']   = $getExam->exam_OD_CVA;
            $this->exam['exam_OS_SPH']   = $getExam->exam_OS_SPH;
            $this->exam['exam_OS_CYL']   = $getExam->exam_OS_CYL;
            $this->exam['exam_OS_AXIS']  = $getExam->exam_OS_AXIS;
            $this->exam['exam_OS_NVA']   = $getExam->exam_OS_NVA;
            $this->exam['exam_OS_PH']    = $getExam->exam_OS_PH;
            $this->exam['exam_OS_CVA']   = $getExam->exam_OS_CVA;
            $this->exam['exam_ADD']      = $getExam->exam_ADD;
            $this->exam['exam_PD']      = $getExam->exam_PD;
            $this->exam['exam_remarks']      = $getExam->exam_remarks;

            $this->exam['last'] = true;

            $this->exam['history'] = Exam::where('patient_id', $patientId)->count();
        } else {
            $this->exam['last'] = false;
        }
    }


    public function patientShowModal($data, $patientId)
    {
        $this->resetErrorBag();

        switch ($data) {
            case 'isAdd':
                $this->modal['isAddPatient'] = true;
                break;
            case 'isUpdate':
                $findPt = Patient::findOrFail($patientId);
                $this->pt['id'] = $findPt->id;
                $this->pt['avatar'] = $findPt->patient_avatar;
                $this->pt['fname'] = $findPt->patient_fname;
                $this->pt['lname'] = $findPt->patient_lname;
                $this->pt['mname'] = $findPt->patient_mname;
                $this->pt['addr'] = $findPt->patient_address;
                $this->pt['no'] = $findPt->patient_mobile;
                $this->pt['gender'] = $findPt->patient_gender;
                $this->pt['occ'] = $findPt->patient_occupation;
                $this->pt['email'] = $findPt->patient_email;
                $this->modal['isUpdatePatient'] = true;
                break;
            case 'isExam':
                $this->exam_purchase_tab('exam', $patientId);
                $this->modal['isExamPurchase'] = true;
                break;
            case 'isPurchase':
                $this->exam_purchase_tab('purchase', $patientId);
                $this->modal['isExamPurchase'] = true;
                $this->modal['exam_purchase_tab'] = 2;
                break;
        }
        $this->modal['show'] = true;
        $this->dispatchBrowserEvent('form-modal'); 
    }

    public function closeModal()
    {
        $this->modal['show'] = false;
        $this->reset(['pt','modal', 'searchItem']);
        $this->resetErrorBag();
    }

    public function storage($url) 
    {
        if (!empty($url) || ($url != null)) {
            return Storage::disk('avatars')->url($url); } 
        else {
            return Storage::disk('avatars')->url('default-user-avatar.png'); } 
    }
    
    public function history($historyPage, $patientId) 
    {
        $this->findPatient($patientId);

        $this->patientId = $patientId;

        switch ($historyPage) {
            case 1: $this->historyPage = 1; break;
            case 2: $this->historyPage = 2; break;
            default:
        }
        $this->subPage = 3;
    }


    public function findPatient($patientId)
    {
        $this->patientId = $patientId;
        $findPt = Patient::findOrFail($this->patientId);
        $this->pt['avatar']     = $findPt->patient_avatar;
        $this->patientId         = $findPt->id;
        $this->pt['fullname']   = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
        $this->pt['addr']       = $findPt->patient_address;
        $this->pt['gender']     = $findPt->patient_gender;
        $this->pt['occ']        = $findPt->patient_occupation;
        $this->pt['age']      = $findPt->patient_age;
        $this->pt['no']         = $findPt->patient_mobile;
        $this->pt['email']      = $findPt->patient_email;
    }


    public function fullName($patientId)
    {
        $findPt = Patient::findOrFail($patientId);
        return $this->pt['fullname']   = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
    }

    public function AGE_ADDR($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return $patient->patient_age . ' • ' . $patient->patient_address;
    }

    public function countExam($patientId)
    {
        return Exam::where('patient_id', $patientId)->count();
    }

    public function countPurchase($patientId)
    {
        return Purchase::where('patient_id', $patientId)->count();
    }



    // // declaration for sorting patient list 
    // public 
    //     $patient_fname, 
    //     $sortPatient = 'created_at', 
    //     $sortMethod = 'desc',
    //     $exams;

    // // resetInputFieldsDeclarations 
    // public 
    //     $new_patient_fname, 
    //     $new_patient_lname,
    //     $new_patient_mname,
    //     $new_patient_age,
    //     $new_patient_gender,
    //     $new_patient_occupation,
    //     $new_patient_address,
    //     $new_patient_email,
    //     $new_patient_mobile;

    // // searchPatientDeclarations 
    // public $searchPatient, $patients;

    // // modalWindow
    // public 
    //     $viewPatientProfile = false,
    //     $modalPatientShow = false,
    //     $modalPatientAdd = false,
    //     $modalPatientUpdate = false;

    // public $purchaseViewItem = 'lens';

    // public function resetInputFields()
    // {
    //     $this->id = '';
    //     $this->new_patient_fname = '';
    //     $this->new_patient_lname = '';
    //     $this->new_patient_mname = '';
    //     $this->new_patient_age = '';
    //     $this->new_patient_gender = '';
    //     $this->new_patient_occupation = '';
    //     $this->new_patient_address = '';
    //     $this->new_patient_email = '';
    //     $this->new_patient_mobile = '';
    // }

    // public function render() 
    // {
    //     $searchPatient = '%' . $this->searchPatient . '%';
    //     $this->patients = Patient::where('patient_fname', 'like', $searchPatient)
    //         ->orWhere('patient_lname', 'like', $searchPatient)
    //         ->orderBy($this->sortPatient, $this->sortMethod)
    //         ->get();
     
    //     return view('livewire.pages.page-patient')
    //         ->extends('layouts.app')
    //         ->section('content');
    // }
    
    // public function addPatient()
    // {
    //     $this->modalPatientShow = true;
    //     $this->modalPatientAdd = true;

    //     $validateData = $this->validate([
    //         'new_patient_fname' => 'required',
    //         'new_patient_lname' => 'required',
    //     ]);

    //     $patientLastId = Patient::create([
    //         'patient_fname' => $this->new_patient_fname,
    //         'patient_lname' => $this->new_patient_lname,
    //         'patient_mname' => $this->new_patient_mname,
    //         'patient_age' => $this->new_patient_age,
    //         'patient_gender' => $this->new_patient_gender,
    //         'patient_occupation' => $this->new_patient_occupation,
    //         'patient_address' => $this->new_patient_address,
    //         'patient_email' => $this->new_patient_email,
    //         'patient_mobile' => $this->new_patient_mobile,
    //     ]);

    //     Exam::create([
    //         'patient_id' => $patientLastId->id,
    //     ]);

    //     $this->modalPatientAdd = false;
    //     $this->modalPatientShow = false;

    //     $this->resetInputFields();

    //     session()->flash('message','Patient added successfully.');
    // }

    // public function showPatient($id) 
    // {
    //     $patient = Patient::findOrFail($id);
    //         $this->patient_id = $id;
    //         $this->patient_fname = Str::title($patient->patient_fname);
    //         $this->patient_lname = Str::title($patient->patient_lname);
    //         $this->patient_mname = Str::title($patient->patient_mname);
    //         $this->patient_age = Str::title($patient->patient_age);
    //         $this->patient_gender = Str::title($patient->patient_gender);
    //         $this->patient_occupation = Str::title($patient->patient_occupation);
    //         $this->patient_address = Str::title($patient->patient_address);
    //         $this->patient_email = Str::title($patient->patient_email);
    //         $this->patient_mobile = Str::title($patient->patient_mobile);
    //         $this->patient_created = Str::title($patient->created_at);      


    //     $this->viewPatientProfile = true;
    // }

    // public function updatePatient($id)
    // {
    //     $validateData = $this->validate([
    //         'patient_fname' => 'required',
    //         'patient_lname' => 'required'
    //     ]);

    //     $patient = Patient::find($id);

    //     $patient->update([
    //         'patient_fname' => $this->update_patient_fname,
    //         'patient_lname' => $this->update_patient_lname,
    //         'patient_mname' => $this->update_patient_mname,
    //         'patient_age' => $this->update_patient_age,
    //         'patient_gender' => $this->update_patient_gender,
    //         'patient_occupation' => $this->update_patient_occupation,
    //         'patient_address' => $this->update_patient_address,
    //         'patient_email' => $this->update_patient_email,
    //         'patient_mobile' => $this->update_patient_mobile,
    //     ]);


    //     $this->modalPatientUpdate = false;
    //     $this->modalPatientShow = false;

    //     // call function to display/view current updated patient 
    //     $this->showPatient($id);

    //     session()->flash('message','Patient updated successfully.');
    // }


    // public function showUpdatePatientModal($id)
    // {
    //     $this->modalPatientShow = true;
    //     $this->modalPatientUpdate = true;

    //     $patient = Patient::find($id);
    //         $this->update_patient_id = $patient->id;
    //         $this->update_patient_fname = Str::title($patient->patient_fname);
    //         $this->update_patient_lname = Str::title($patient->patient_lname);
    //         $this->update_patient_mname = Str::title($patient->patient_mname);
    //         $this->update_patient_age = Str::title($patient->patient_age);
    //         $this->update_patient_gender = Str::title($patient->patient_gender);
    //         $this->update_patient_occupation = Str::title($patient->patient_occupation);
    //         $this->update_patient_address = Str::title($patient->patient_address);
    //         $this->update_patient_email = Str::title($patient->patient_email);
    //         $this->update_patient_mobile = Str::title($patient->patient_mobile);
    //         $this->update_patient_created = Str::title($patient->created_at);
    // }

    // public function showAddPatientModal($action)
    // {
    //     if($action == 'addPatient') {
    //         $this->modalPatientShow = true;
    //         $this->modalPatientAdd = true;
    //     }

    //     elseif ($action == 'closeModal') {
    //         $this->resetInputFields();  
    //         $this->modalPatientShow = false;
    //         $this->modalPatientAdd = false;
    //         $this->modalPatientUpdate = false;
    //     }
    // }

    // public function purchaseViewItem($item) {
    //     if($item === $item) { $this->purchaseViewItem = $item; }
    // }
}