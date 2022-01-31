<?php

namespace App\Http\Livewire\Pages;
use Illuminate\Support\Str;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Exam;


class PagePatient extends Component
{
    // declaration for sorting patient list 
    public 
        $patient_fname, 
        $sortPatient = 'created_at', 
        $sortMethod = 'desc';

    // resetInputFieldsDeclarations 
    public 
        $new_patient_fname, 
        $new_patient_lname,
        $new_patient_mname,
        $new_patient_age,
        $new_patient_gender,
        $new_patient_occupation,
        $new_patient_address,
        $new_patient_email,
        $new_patient_mobile;

    // searchPatientDeclarations 
    public $searchPatient, $patients;

    // modalWindow
    public 
        $viewPatientProfile = false,
        $modalPatientShow = false,
        $modalPatientAdd = false,
        $modalPatientUpdate = false;


    public function resetInputFields()
    {
        $this->id = '';
        $this->new_patient_fname = '';
        $this->new_patient_lname = '';
        $this->new_patient_mname = '';
        $this->new_patient_age = '';
        $this->new_patient_gender = '';
        $this->new_patient_occupation = '';
        $this->new_patient_address = '';
        $this->new_patient_email = '';
        $this->new_patient_mobile = '';
    }

    public function addPatient()
    {
        $this->modalPatientShow = true;
        $this->modalPatientAdd = true;

        $validateData = $this->validate([
            'new_patient_fname' => 'required',
            'new_patient_lname' => 'required',
        ]);

        $patientLastId = Patient::create([
            'patient_fname' => $this->new_patient_fname,
            'patient_lname' => $this->new_patient_lname,
            'patient_mname' => $this->new_patient_mname,
            'patient_age' => $this->new_patient_age,
            'patient_gender' => $this->new_patient_gender,
            'patient_occupation' => $this->new_patient_occupation,
            'patient_address' => $this->new_patient_address,
            'patient_email' => $this->new_patient_email,
            'patient_mobile' => $this->new_patient_mobile,
        ]);

        Exam::create([
            'patient_id' => $patientLastId->id,
        ]);

        $this->modalPatientAdd = false;
        $this->modalPatientShow = false;

        $this->resetInputFields();

        session()->flash('message','Patient added successfully.');
    }

    public function editPatient($id) 
    {
        $patient = Patient::findOrFail($id);
        $this->patient_id = $id;
        $this->patient_fname = Str::title($patient->patient_fname);
        $this->patient_lname = Str::title($patient->patient_lname);
        $this->patient_mname = Str::title($patient->patient_mname);
        $this->patient_age = Str::title($patient->patient_age);
        $this->patient_gender = Str::title($patient->patient_gender);
        $this->patient_occupation = Str::title($patient->patient_occupation);
        $this->patient_address = Str::title($patient->patient_address);
        $this->patient_email = Str::title($patient->patient_email);
        $this->patient_mobile = Str::title($patient->patient_mobile);
        $this->patient_created = Str::title($patient->created_at);      

        $this->viewPatientProfile = true;
    }

    public function updatePatient($id)
    {
        $validateData = $this->validate([
            'patient_fname' => 'required',
            'patient_lname' => 'required'
        ]);

        $patient = Patient::find($id);

        $patient->update([
            'patient_fname' => $this->update_patient_fname,
            'patient_lname' => $this->update_patient_lname,
            'patient_mname' => $this->update_patient_mname,
            'patient_age' => $this->update_patient_age,
            'patient_gender' => $this->update_patient_gender,
            'patient_occupation' => $this->update_patient_occupation,
            'patient_address' => $this->update_patient_address,
            'patient_email' => $this->update_patient_email,
            'patient_mobile' => $this->update_patient_mobile,
        ]);


        $this->modalPatientUpdate = false;
        $this->modalPatientShow = false;

        // call function to display/view current updated patient 
        $this->editPatient($id);

        session()->flash('message','Patient updated successfully.');
    }


    public function showUpdatePatientModal($id)
    {
        $this->modalPatientShow = true;
        $this->modalPatientUpdate = true;

        $patient = Patient::find($id);
        $this->update_patient_id = $patient->id;
        $this->update_patient_fname = Str::title($patient->patient_fname);
        $this->update_patient_lname = Str::title($patient->patient_lname);
        $this->update_patient_mname = Str::title($patient->patient_mname);
        $this->update_patient_age = Str::title($patient->patient_age);
        $this->update_patient_gender = Str::title($patient->patient_gender);
        $this->update_patient_occupation = Str::title($patient->patient_occupation);
        $this->update_patient_address = Str::title($patient->patient_address);
        $this->update_patient_email = Str::title($patient->patient_email);
        $this->update_patient_mobile = Str::title($patient->patient_mobile);
        $this->update_patient_created = Str::title($patient->created_at);
    }

    public function showAddPatientModal()
    {
        $this->modalPatientShow = true;
        $this->modalPatientAdd = true;
    }

    public function closePatientModal()
    {
        $this->resetInputFields();  
        $this->modalPatientUpdate = false;
        $this->modalPatientAdd = false;
        $this->modalPatientShow = false;
    }

    public function updateExam() 
    {
        
    }





    public function render()
    {
        $searchPatient = '%' . $this->searchPatient . '%';
        $this->patients = Patient::where('patient_fname', 'like', $searchPatient)
            ->orWhere('patient_lname', 'like', $searchPatient)
            ->orderBy($this->sortPatient, $this->sortMethod)
            ->get();
     
        return view('livewire.pages.page-patient')
            ->extends('layouts.app')
            ->section('content');
    }
}