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


class PagePatient extends Component
{

    public $tab = 1;

    public $purchase_select_item = 1;

    public $itemType, $searchLense, $searchItem;

    public $purchaseId, $purchasePatientId;

    // public 
    //     $patientShowModal = false;
    //         $isAddPatient = false,
    //         $isUpdatePatient = false;
    public $modal = [
        'patientShowModal' => false,
            'isAddPatient' => false,
            'isUpdatePatient' => false,
            'isExamPurchase' => false,
                'exam_purchase_tab' => 1,
    ];

    public 
        $selectOption = false, 
        $addToQueue = false,
        $purchaseDirectly = false;

    public $pt = [
        'id' => '',
        'avatar' => '',
        'fname' => '',
        'lname' => '',
        'mname' => '',
        'addr' => '',
        'no' => '',
        'gender' => '',
        'occ' => '',
        'email' => '',
    ];

    public $exam = [
        'previous' => '',
    ];

    protected $rules = [
        'pt.fname' => 'required',
        'pt.lname' => 'required',
        'pt.email' => 'email',
    ];

    protected $messages = [
        'pt.fname.required' => 'Required',
        'pt.lname.required' => 'Required',
        'pt.email.email' => 'Enter valid email',
    ];

    public function render() 
    {
        if ($this->purchase_select_item == 1) {
            $this->itemType = 'le';
        } elseif ($this->purchase_select_item == 2) {
            $this->itemType = 'fr';
        } elseif ($this->purchase_select_item == 3) {
            $this->itemType = 'ac';
        } 

        $searchItem = '%' . $this->searchItem . '%';
        $items = Item::where('item_name', 'like', $searchItem)
            // ->orWhere('item_desc', 'like', $searchItem)
            ->where('item_type', $this->itemType)
            ->get();

        // $searchLense = '%' . $this->searchLense . '%';
        // $lense = Lense::where('lense_name', 'like', $searchLense)
        //     ->orWhere('lense_desc', 'like', $searchLense)
        //     ->get();

        return view('livewire.pages.page-patient',[
                'pts' => Patient::all(),
                'selectedItems' => Purchased_item::with('item')->where('purchase_id', $this->purchaseId)->get(),
                // 'selectedItems' => Purchase::with('purchased_item')->where('id', $this->purchaseId)->get(),
                'items' => $items,
            ])
            ->extends('layouts.app')
            ->section('content');
    }

    public function purchaseNewItem($ptId)
    {
        $purchasedId = Purchase::create([
            'patient_id' => $ptId,
        ]);

        // dd(
        //     $purchasedId->id . ' ' .
        //     $purchasedId->patient_id
        // );
        $this->purchaseId = $purchasedId->id;
        $this->purchasePatientId = $purchasedId->patient_id;
    }

    public function addItem($itemType, $price, $id)
    {

        // dd (
        //     $item . ', ' . 
        //     $this->pt['id'] . ', ' . 
        //     $id . ', ' . 
        //     $price . ', '

        // );
        Purchase::create([
            'patient_id' => $this->pt['id'], 
            'item_id' => $id,
            'item_type' => $itemType,
            'qty' => 1, 
            'total' => $price, 
        ]);
        $this->searchItem = '';
        // switch ($item) {
        //     case 'le':
        //         dd('lense added');
        //         break;
        //     case 'fr':
        //         dd('frame added');
        //         break;
        //     case 'ac':
        //         dd('ac added');
        //         break;
        // }
    }

    public function exam_purchase_tab($data, $id)
    {
        $findPt = Patient::findOrFail($id);
        $this->pt['id'] = $findPt->id;
        $this->pt['fname'] = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
        $this->pt['addr'] = $findPt->patient_address;

        switch ($data) {
            case 'exam':
                $this->exam['previous'] = Exam::where('patient_id', $id)->count();
                $this->modal['exam_purchase_tab'] = 1;
                break;
            case 'purchase':
                $this->purchaseId = Purchase::where('patient_id', $this->pt['id'])->first();
                $this->modal['exam_purchase_tab'] = 2;
                break;
        }
    }

    public function addPt()
    {
        $this->validate();

        dd(
            $this->pt['fname'] . ', ' .
            $this->pt['lname']
        );
    }

    public function updatePt()
    {
        // dd($this->pt['id']);
        $this->validate();
        $updatePt = Patient::findOrFail($this->pt['id']);
        $updatePt->update([
           'patient_fname' => $this->pt['fname'],
           'patient_mname' => $this->pt['mname'],
           'patient_lname' => $this->pt['lname'],
           'patient_mobile' => $this->pt['no'],
           'patient_gender' => $this->pt['gender'], 
           'patient_address' => $this->pt['addr'], 
           'patient_occupation' => $this->pt['occ'], 
           'patient_email' => $this->pt['email'], 
        ]);
        if ($updatePt) {
            session()->flash('message', 'Updated successfully.');
        } else {
            // an error has occured
            dd('error');
        }
        $this->closeModal();
    }


    public function patientShowModal($data, $id)
    {
        switch ($data) {
            case 'isAdd':
                $this->modal['isAddPatient'] = true;
                break;

            case 'isUpdate':
                   $findPt = Patient::findOrFail($id);
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
                $this->exam_purchase_tab('exam', $id);
                $this->modal['isExamPurchase'] = true;
                break;
            case 'isPurchase':
                $this->exam_purchase_tab('purchase', $id);

                $this->modal['isExamPurchase'] = true;
                $this->modal['exam_purchase_tab'] = 2;
                break;
        }
        $this->modal['patientShowModal'] = true;
    }

    public function closeModal()
    {
        // $this->resetInputFields('onCloseModal');
        $this->reset(['pt','modal', 'searchItem']);
        $this->resetErrorBag();

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