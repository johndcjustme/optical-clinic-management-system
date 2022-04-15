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
use App\Models\Appointment;
use App\Models\Purchased_item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;





class PagePatient extends Component
{
    use WithPagination;
    use WithFileUploads;


    public $tab = 1;

    public $itemType, $searchLense, $searchItem;

    public $searchPatient = '';

    public $purchaseId, $purchasePatientId, $latestPurchase;

    public $showInPatient = 1;

    public $subPage = 1;

    public $historyPage = 0; 

    public $patientId;

    public $editExamHistory = false;

    public $pageNumber = 10;

    public $selectedPatients = [];

    public $previewAvatar;

    public 
        $filter = '',
        $filterResults = 0,
            $DATE_SINGLE,
            $DATE_RANGE,
                $date_from,
                $date_to;

    public 
        $colName = 'patient_lname',
        $direction = 'asc';

    public 
        $total,
        $discount = 0,
        $balance  = 0,
        $deposit  = 0,
        $cash     = 0,
        $change   = 0,
        $duedate;

    public $modal = [
        'show'                      => false,
        'patientShowModal'          => false,
            'isAddPatient'          => false,
            'isUpdatePatient'       => false,
            'isExamPurchase'        => false,
                'exam_purchase_tab' => 1,
    ];

    public $delete = [
        'exam' => false, 
        'purchase' => false,
        'patient' => false,
        'patients' => false,
    ];

    public $purchase = ['id'];

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
        'id'            => '',
        'avatar'        => '',
        'fullname'      => '',
        'fname'         => '',
        'lname'         => '',
        'mname'         => '',
        'addr'          => '',
        'age'           => '',
        'no'            => '',
        'gender'        => '',
        'occ'           => '',
        'email'         => '',
        'queue'         => false,
    ];

    public $exam = [
        'history'      => '',
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
        'exam_remarks' => '',
    ];

    protected $queryString = [
        'searchPatient' => ['except' => ''],
        'subPage'       => 1,
        'historyPage'   => ['except' => '', 'except' => 0],
        'patientId'     => ['except' => ''],
    ];

    protected $listeners = ['getLastExam'];

    public function mount()
    {
        $this->DATE_SINGLE = now();
    }

    public function render() 
    {        
        $this->total();



        $searchItem = '%' . $this->searchItem . '%';
        $items = Item::where('item_name', 'like', $searchItem)->get();

        $searchPatient = $this->searchPatient . '%';


        switch ($this->filter) {
            case 'DATE_RANGE':
                // $results = Patient::whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to);
                $results = Patient::whereBetween('created_at', [$this->date_from, $this->date_to]);
                $this->filterResults = $results->count();
                $pts = $results->orderBy($this->colName, $this->direction)->paginate($this->pageNumber);
                break;

            case 'DATE_SINGLE':
                $results = Patient::whereDate('created_at', $this->DATE_SINGLE);
                $this->filterResults = $results->count();
                $pts = $results->orderBy($this->colName, $this->direction)->paginate($this->pageNumber);
                break;

            default:
                $pts = Patient::where('patient_fname', 'like', $searchPatient)
                    ->orWhere('patient_lname', 'like', $searchPatient)
                    ->orWhere('patient_mname', 'like', $searchPatient)
                    ->orderBy($this->colName, $this->direction)
                    ->paginate($this->pageNumber);
        }


        

        $render = [
            'pts' => $pts,
            'selectedItems' => Purchased_item::with('item')->where('purchase_id', $this->latest_purchase['id'])->orderBy('id', 'desc')->get(),
            'items' => $items,
            'purchases' => Purchase::with('patient')->latest()->get(),
            'inqueue' => Patient::where('patient_queue', true)->orderByDesc('updated_at')->paginate($this->pageNumber),
        ];
        
        if ($this->subPage == 2) {
            $render += [
                'allPurchases' => Purchase::with('patient')->where('total', '>', 0)->orderBy('balance', 'desc')->get(),
            ];
        }

        if ($this->historyPage > 0) 


            $render += [
                'purchasesHistory' => Purchase::where('patient_id', $this->patientId)->latest()->get(),
                'examsHistory' => Exam::where('patient_id', $this->patientId)->latest()->get(),
            ];

        return view('livewire.pages.page-patient', $render)
            ->extends('layouts.app')
            ->section('content');
    }

    public function orderBy($colName, $direction)
    {
        $this->resetPage();

        $this->colName = $colName;
        $this->direction = $direction;
    }


    public function validatePatient()
    {
        return $this->validate(
            [
                'pt.fname' => 'required|max:100',
                'pt.lname' => 'required|max:100',
                'pt.age' => 'required|integer|max:150',
                'pt.mname' => 'nullable',
                'pt.no' => 'nullable',
                'pt.gender' => 'nullable',
                'pt.addr' => 'nullable',
                'pt.occ' => 'nullable',
                'pt.email' => 'nullable',
                'pt.queue' => 'nullable',
                'previewAvatar' => 'image|max:1024|nullable'
            ],
            [
                'pt.fname.required' => 'Required',  
                'pt.lname.required' => 'Required',
                'pt.age.required'   => 'Required',
                'previewAvatar.max' => 'Avatar must not be greater than 1024 kilobytes.',
            ]
        );
    }

    public function updatedSearchPatient()
    {
        $this->resetPage();
    }

    public function subPage($subPageNumber)
    {
        $this->reset([
            'selectedPatients',
            'searchPatient',
        ]);

        $this->subPage = $subPageNumber;
    }

    public function date($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    public function addToQueue($patientId)
    {
        $patientInQueue = Patient::findOrFail($patientId);
        $patientInQueue->update(['patient_queue' => true, 'patient_exam_status' => true]);
        $patientInQueue
            ? $this->dispatchBrowserEvent('toast',[
                'title'   => NULL,
                'class'   => 'success',
                'message' => $patientInQueue->patient_lname . ' in queue.'])
            : $this->dispatchBrowserEvent('toast',[
                'title'   => NULL,
                'class'   => 'error',
                'message' => 'Patient not added. an error has occured.']);
    }

    public function removeFromQueue($patientId)
    {
        $patientInQueue = Patient::findOrFail($patientId);
        $patientInQueue->update(['patient_queue' => false]);
        $patientInQueue
            ? $this->dispatchBrowserEvent('toast',[
                'title'   => NULL,
                'class'   => 'success',
                'message' => $patientInQueue->patient_lname . ' has been removed from queue.'])
            : $this->dispatchBrowserEvent('toast',[
                'title'   => NULL,
                'class'   => 'error',
                'message' => 'An error has occured.']);
    }

    public function batchRemoveFromQueue()
    {
        $patientInQueue = Patient::where('id', $this->selectedPatients)->update(['patient_queue' => false]);
    }

    public function doneExam($patientId)
    {
        Patient::where('id', $patientId)
            ->update(['patient_exam_status' => false]);
    }

    public function revertExam($patientId) {
        Patient::where('id', $patientId)
            ->update(['patient_exam_status' => true]);
    }

    public function total() // called in render method
    {
        $this->total = 0;

        $purchased_item =  Purchased_item::where('purchase_id', $this->latest_purchase['id'])->get();

        foreach ($purchased_item as $pi) {
            $this->total += $pi->qty * $pi->item_price;
        }

        $this->discount > 0 
            ? $this->discount > $this->total
                ? session()->flash('discount', 'error')
                : $this->total = $this->total - $this->discount
            : NULL;

        $this->deposit > 0
            ? $this->deposit > $this->total
                ? session()->flash('deposit', 'error')
                : $this->balance = $this->total - $this->deposit
            : $this->balance = 0;

        $this->cash > 0
            ? $this->cash < $this->total
                ? session()->flash('cash', 'error')
                : $this->change = $this->cash - $this->total
            : $this->change = 0;


        $this->discount == '' 
            ? $this->discount = 0 
            : NULL;
        $this->deposit == '' 
            ? $this->deposit = 0 
            : NULL;
        $this->cash == '' 
            ? $this->cash = 0 
            : NULL;
    }

    public function purchaseNewItem($ptId)
    {
        $purchasedId = Purchase::create(['patient_id' => $ptId]);

        if ($purchasedId) {
            $this->purchaseId = $purchasedId->id;
            $this->purchasePatientId = $purchasedId->patient_id;
            $this->exam_purchase_tab('purchase', $ptId);
        }
    }

    // public function FromHistory($id)
    // {
    //     Purchase::findOrFail($id)->delete();
    //     $this->exam_purchase_tab('purchase', $this->pt['id']);
    // }

    public function isScheduled($patientId)
    {
        $appt = Appointment::where('patient_id', $patientId)->where('appt_date' , date('Y-m-d'))->first();
        if ($appt) {
            return 'Scheduled';
        } else {
            return '';
        }
    }

    public function addItem($purchaseId, $itemId, $itemPrice)
    {
        Purchased_item::create([
            'purchase_id'  => $purchaseId, 
            'item_id'      => $itemId,
            'item_price'   => $itemPrice,
            'qty'          => '1',
        ]);
        $this->decrementItem($itemId, 1);

        $this->searchItem = '';
    }

    public function inc_dec_item($data, $itemId) 
    {
        $purchasedItem = Purchased_item::with('item')->where('id', $itemId)->first();

        if ($data == 'inc') {
            $DB_RAW = 'qty + 1';
            $this->decrementItem($purchasedItem->item_id, 1);}
        elseif ($data == 'dec') {
            $DB_RAW = 'qty - 1';
            $this->incrementItem($purchasedItem->item_id, 1);}

        $purchasedItem->update(['qty' => DB::raw($DB_RAW)]);
    }

    public function removeItem($itemId) 
    { 
        $purchasedItem = Purchased_item::with('item')->where('id', $itemId)->first();
        $this->incrementItem($purchasedItem->item_id, $purchasedItem->qty);
        $purchasedItem->delete();
    }

    public function decrementItem($itemId, $decrementValue)
    {
        $item = Item::findOrFail($itemId);

        if ($item->item_qty == $item->item_buffer) 
            $this->dispatchBrowserEvent('toast',[
                'title'   => 'Warning',
                'class'   => 'error',
                'message' => 'Running out of stocks. ' . $item->item_qty . ' items left',
            ]);

        if ($item->item_qty == 1) 
            $this->dispatchBrowserEvent('toast',[
                'title'   => 'Hey',
                'class'   => 'error',
                'message' => 'You run out of stocks.',
            ]);

        $DB_RAW = 'item_qty - ' . $decrementValue;
        $item->update(['item_qty' => DB::raw($DB_RAW)]);
    }

    public function incrementItem($itemId, $incrementValue)
    {
        $DB_RAW = 'item_qty + ' . $incrementValue;
        $item = Item::findOrFail($itemId);
        $item->update(['item_qty' => DB::raw($DB_RAW)]);
    }

    public function remainingItems($itemId)
    {
        $item = Item::find($itemId);

        if ($item->item_qty > $item->item_buffer)
            return 'Remaining: ' . ($item->item_qty - $item->item_buffer);
        else
            return 'Low stock remaining: ' . $item->item_qty;
    }

    public function checkItemQty($itemId) { return Item::find($itemId)->item_qty; }





    public function exam_purchase_tab($data, $patientId)
    {
        $findPt = Patient::findOrFail($patientId);
        $this->setPatient($findPt);
        
        switch ($data) {
            case 'exam':
                $this->exam['previous'] = Exam::where('patient_id', $patientId)->count();
                $this->getLastExam($patientId);
                $this->modal['exam_purchase_tab'] = 1;
                break;
            case 'purchase':
                $this->latestPurchase = $this->isPatientPurchased($patientId);
                $this->latest_purchase['id'] = $this->latestPurchase->id ?? NULL;
                $this->discount = $this->latestPurchase->discount ?? '0';
                $this->deposit = $this->latestPurchase->deposit ?? '0';
                $this->balance = $this->latestPurchase->balance ?? '0';
                $this->duedate = $this->latestPurchase->duedate ?? NULL;
                $this->latest_purchase['date'] = $this->latestPurchase->created_at ?? '';
                $this->modal['exam_purchase_tab'] = 2;
                break;
            case 'patient':
                $this->modal['exam_purchase_tab'] = 3;
                break;
            default:
        }
    }

    public function editExamHistory($examId)
    {
        $this->getAnyExam($examId);
        $this->modal['isExamPurchase'] = true;
        $this->modal['exam_purchase_tab'] = 1;
        $this->exam['last'] = true;
        $this->modal['show'] = true;
        $this->editExamHistory = true;
    }

    public function isPatientPurchased($patientId) { return Purchase::where('patient_id', $patientId)->latest()->first(); }

    public function purchaseDate($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    public function savePayment($purchaseId)
    {
        Purchase::where('id', $purchaseId)
            ->update([
                'total'     => $this->total,
                'deposit'   => $this->deposit ?? 0,
                'balance'   => $this->balance ?? 0,
                'discount'  => $this->discount ?? 0,
                'duedate'   => $this->duedate ?? NULL,
            ]);
        session()->flash('savedPayment', 'Saved');
    }


    // public function updateOrCreatePatient()
    // {
    //     $updateOrCreatePatient = [
    //         'patient_fname'       => $this->pt['fname']  ,
    //         'patient_mname'       => $this->pt['mname']  ,
    //         'patient_lname'       => $this->pt['lname']  ?? NULL,
    //         'patient_mobile'      => $this->pt['no']     ?? NULL,
    //         'patient_gender'      => $this->pt['gender'] ?? NULL, 
    //         'patient_address'     => $this->pt['addr']   ?? NULL, 
    //         'patient_occupation'  => $this->pt['occ']    ?? NULL, 
    //         'patient_email'       => $this->pt['email']  ?? NULL, 
    //         'patient_age'         => $this->pt['age']    ?? NULL, 
    //     ];

    //     return $updateOrCreatePatient;
    // }

    public function deletingPatient($patientId)
    {
        $this->delete['patient'] = true;
        $this->pt['id'] = $patientId;
        $this->dispatchBrowserEvent('confirm-dialog');
    }

    public function deletePatient()
    {
        $this->dispatchBrowserEvent('confirm-dialog-close');

        $deletePatient = Patient::destroy($this->pt['id']);
        
        if ($deletePatient) 
            $this->dispatchBrowserEvent('toast',[
                'title'   => NULL,
                'class'   => 'success',
                'message' => 'Deleted successfully.',
            ]);
    }

    public function deletingPatients()
    {
        $this->delete['patients'] = true;
        $this->dispatchBrowserEvent('confirm-dialog');
    }
    
    public function deletePatients()
    {
        $this->dispatchBrowserEvent('confirm-dialog-close');

        $deletePatient = Patient::destroy($this->selectedPatients);
        
        if ($deletePatient) 
            $this->dispatchBrowserEvent('toast',[
                'title'   => NULL,
                'class'   => 'success',
                'message' => 'Deleted successfully.',
            ]);

        $this->selectedPatients = [];
    }

    public function addPt()
    {
        $this->validatePatient();

        $newPatient = [
            'patient_fname'       => $this->pt['fname']  ,
            'patient_mname'       => $this->pt['mname']  ,
            'patient_lname'       => $this->pt['lname']  ?? NULL,
            'patient_mobile'      => $this->pt['no']     ?? NULL,
            'patient_gender'      => $this->pt['gender'] ?? NULL, 
            'patient_address'     => $this->pt['addr']   ?? NULL, 
            'patient_occupation'  => $this->pt['occ']    ?? NULL, 
            'patient_email'       => $this->pt['email']  ?? NULL, 
            'patient_age'         => $this->pt['age']    ?? NULL, 
            'patient_queue'       => $this->pt['queue']  ?? false,
        ];

        if ($this->pt['queue']) {
            $newPatient += [
                'patient_queue'       => $this->pt['queue']  ?? false,
                'patient_exam_status' => true,
            ];
        }

        if (!empty($this->previewAvatar)) {
            $newPatient += ['patient_avatar' => $this->previewAvatar->hashName()];
            $this->previewAvatar->store('/', 'avatars'); }
            
        Patient::create($newPatient);

        $this->closeModal();
        $this->dispatchBrowserEvent('toast',[
            'title'   => NULL,
            'class'   => 'success',
            'message' => 'Added successfully.',
        ]);
    }

    public function updatePt()
    {
        $this->validatePatient();

        $THIS_PATIENT = Patient::findOrFail($this->pt['id']);

        $updatePatient = [
            'patient_fname'       => $this->pt['fname']  ,
            'patient_mname'       => $this->pt['mname']  ,
            'patient_lname'       => $this->pt['lname']  ?? NULL,
            'patient_mobile'      => $this->pt['no']     ?? NULL,
            'patient_gender'      => $this->pt['gender'] ?? NULL, 
            'patient_address'     => $this->pt['addr']   ?? NULL, 
            'patient_occupation'  => $this->pt['occ']    ?? NULL, 
            'patient_email'       => $this->pt['email']  ?? NULL, 
            'patient_age'         => $this->pt['age']    ?? NULL, 
        ];
    

        if (!empty($this->previewAvatar) || ($this->previewAvatar != null)) {
            Storage::disk('avatars')->exists($THIS_PATIENT->patient_avatar)
                ? Storage::disk('avatars')->delete($THIS_PATIENT->patient_avatar) 
                : NULL;

            $updatePatient += ['patient_avatar' => $this->previewAvatar->hashName()];
            $this->previewAvatar->store('/', 'avatars');         
        }

        $THIS_PATIENT->update($updatePatient);

        $this->closeModal();
        $this->dispatchBrowserEvent('toast',[
            'title'   => NULL,
            'class'   => 'success',
            'message' => 'Updated successfully.',
        ]);
    }


    public function newExam($patientId)
    {
        Exam::create(['patient_id' => $patientId]);
        $this->getLastExam($patientId);
    }

    public function updateExam($examId)
    {
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
                'exam_PD'      => $this->exam['exam_PD'],
                'exam_remarks' => $this->exam['exam_remarks'],
            ]);

        session()->flash('savedExam', 'Saved');
    }

    public function deletingPurchase($purchaseId)
    {   
        $this->purchase['id'] = $purchaseId;
        $this->delete['purchase'] = true;
        $this->dispatchBrowserEvent('confirm-dialog');
    }

    public function deletingExam($examId)
    {
        $this->exam['id'] = $examId;
        $this->delete['exam'] = true;
        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deletePurchaseFromHistory()
    {
        Purchase::destroy($this->purchase['id']);
        $this->dispatchBrowserEvent('confirm-dialog-close');
        $this->dispatchBrowserEvent('toast',[
            'title'   => NULL,
            'class'   => 'success',
            'message' => 'Deleted successfully.',
        ]);
    }

    public function deletePurchase($purchaseId)
    {
        Purchase::destroy($purchaseId);
        $this->exam_purchase_tab('purchase', $this->pt['id']);
    }

    public function deleteExamFromHistoryPage()
    {
        Exam::destroy($this->exam['id']);
        $this->dispatchBrowserEvent('confirm-dialog-close');

        $this->dispatchBrowserEvent('toast',[
            'title'   => NULL,
            'class'   => 'success',
            'message' => 'Deleted successfully.',
        ]);
    }

    public function deleteExam($examId) 
    {
        Exam::findOrFail($examId)->delete();
        $this->getLastExam($this->pt['id']);
    }

    public function setExam($exam)
    {
        $this->exam['id']            = $exam->id;
        $this->exam['exam_OD_SPH']   = $exam->exam_OD_SPH;
        $this->exam['exam_OD_CYL']   = $exam->exam_OD_CYL;
        $this->exam['exam_OD_AXIS']  = $exam->exam_OD_AXIS;
        $this->exam['exam_OD_NVA']   = $exam->exam_OD_NVA;
        $this->exam['exam_OD_PH']    = $exam->exam_OD_PH;
        $this->exam['exam_OD_CVA']   = $exam->exam_OD_CVA;
        $this->exam['exam_OS_SPH']   = $exam->exam_OS_SPH;
        $this->exam['exam_OS_CYL']   = $exam->exam_OS_CYL;
        $this->exam['exam_OS_AXIS']  = $exam->exam_OS_AXIS;
        $this->exam['exam_OS_NVA']   = $exam->exam_OS_NVA;
        $this->exam['exam_OS_PH']    = $exam->exam_OS_PH;
        $this->exam['exam_OS_CVA']   = $exam->exam_OS_CVA;
        $this->exam['exam_ADD']      = $exam->exam_ADD;
        $this->exam['exam_PD']       = $exam->exam_PD;
        $this->exam['exam_remarks']  = $exam->exam_remarks;
    }

    public function getAnyExam($examId)
    {
        $exam = Exam::findOrFail($examId);

        $this->setExam($exam);
    }

    public function getLastExam($patientId)
    {
        $getExam = Exam::where('patient_id', $patientId)->latest()->first();
        if ($getExam) {
            $this->setExam($getExam);
            $this->exam['last'] = true;
            $this->exam['history'] = Exam::where('patient_id', $patientId)->count();
        } else { 
            $this->exam['last'] = false; 
        }
    }

    public function setPatient($patient)
    {
        $this->patientId        = $patient->id;
        $this->pt['id']         = $patient->id;
        $this->pt['avatar']     = $patient->patient_avatar;
        $this->pt['fname']      = $patient->patient_fname;
        $this->pt['lname']      = $patient->patient_lname;
        $this->pt['mname']      = $patient->patient_mname;
        $this->pt['addr']       = $patient->patient_address;
        $this->pt['no']         = $patient->patient_mobile;
        $this->pt['age']        = $patient->patient_age;
        $this->pt['gender']     = $patient->patient_gender;
        $this->pt['occ']        = $patient->patient_occupation;
        $this->pt['email']      = $patient->patient_email;
        $this->pt['fullname']   = $patient->patient_lname . ', ' . $patient->patient_fname . ' ' . $patient->patient_mname;
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
                $this->setPatient($findPt);
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
            default:
        }
        $this->modal['show'] = true;
        $this->dispatchBrowserEvent('form-modal'); 
    }

    public function closeModal()
    {
        $this->modal['show'] = false;
        $this->reset(['pt','modal', 'searchItem', 'previewAvatar']);
        $this->resetErrorBag();
    }

    public function storage($url) 
    {
        if (!empty($url) || ($url != NULL)) 
            return Storage::disk('avatars')->url($url); 
        else 
            return Storage::disk('avatars')->url('default-user-avatar.png'); 
    }
    
    public function history($historyPage, $patientId) 
    {
        $patient = $this->findPatient($patientId);
        $this->historyPage = $historyPage;
        $this->subPage = 3;
    }


    public function findPatient($patientId)
    {
        $this->patientId = $patientId;
        $findPt = Patient::findOrFail($this->patientId);
        
        $this->setPatient($findPt);
    }


    public function fullName($patientId)
    {
        $findPt = Patient::findOrFail($patientId);
        return $this->pt['fullname'] = $findPt->patient_lname . ', ' . $findPt->patient_fname . ' ' . $findPt->patient_mname;
    }

    public function AGE_ADDR($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return $patient->patient_age . ' • ' . $patient->patient_address;
    }

    public function confirm()
    {
        $this->delete['exam'] 
            ? $this->deleteExamFromHistoryPage() 
            : NULL;
        $this->delete['purchase'] 
            ? $this->deletePurchaseFromHistory() 
            : NULL;
        $this->delete['patient'] 
            ? $this->deletePatient() 
            : NULL;
        $this->delete['patients'] 
            ? $this->deletePatients() 
            : NULL;
    }

    public function patientTotal()
    {
        return Patient::all()->count();
    }

    public function countExam($patientId) { return Exam::where('patient_id', $patientId)->count(); }

    public function countPurchase($patientId) { return Purchase::where('patient_id', $patientId)->count(); }

    public function examListIndicator($patientId)
    {
        $indicator = Patient::where('id', $patientId)->where('patient_queue', true)->first();
        return $indicator ? '•' : '';
    }

    public function currentlyInPaientList($patientId)
    {
        return Patient::where('id', $patientId)->where('patient_queue', true)->first();
    }

    public function makeOrder()
    {
        $this->reset(['modal']);
        return redirect()->to('/orders?subPage=1&modal[show]=1&modal[add]=1&modal[update]=0&orderPatientId=' . $this->pt['id']);
    }
}