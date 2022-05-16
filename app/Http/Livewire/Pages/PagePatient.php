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
use App\Models\Order_detail;
use App\Models\Appointment;
use App\Models\In_out_of_item as Out_item;
use App\Models\Purchased_item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Dompdf\Dompdf;

use PDF;





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

    public $createOrder = false;

    public $orderButtonLabel;

    public $orderLense, $orderFrame, $orderTint, $orderOthers;

    public $showCreateOrderWindow = false;

    public $removeExam = false;
    public $removeOrder = false;








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


    public $modalTab;

    public $modal = [
        'tab_hasExam' => false,
        'tab_hasPurchase' => false,

        'show'                      => false,
        'patientShowModal'          => false,
            'isAddPatient'          => false,
            'isUpdatePatient'       => false,
            'tabs'        => false,
                'exam_purchase_tab' => 1,
    ];

    public $delete = [
        'exam' => false, 
        'purchase' => false,
        'patient' => false,
        'patients' => false,
    ];


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

    public $purchase = [
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

        'hasExam'      => false,

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
        // 'modal'         => ['except' => false],
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
            'selectedItems' => Purchased_item::with(['item'])->where('purchase_id', $this->purchase['id'])->orderBy('id', 'desc')->get(),
            'items' => $items,
            'purchases' => Purchase::with(['patient'])->latest('id')->get(),
            'inqueue' => Patient::where('patient_queue', true)->orderByDesc('updated_at')->paginate($this->pageNumber),
            'allPurchases' => Purchase::with(['patient'])->where('total', '>', 0)->orderBy('balance', 'desc')->get(),
        ];
        
        // if ($this->subPage == 2) {
        //     $render += [
        //         'allPurchases' => Purchase::with('patient')->where('total', '>', 0)->orderBy('balance', 'desc')->get(),
        //     ];
        // }

        if ($this->historyPage > 0) 
            $render += [
                'purchasesHistory' => Purchase::where('patient_id', $this->patientId)->latest('id')->get(),
                'examsHistory' => Exam::where('patient_id', $this->patientId)->latest('id')->get(),
            ];

        return view('livewire.pages.page-patient', $render)
            ->extends('layouts.app')
            ->section('content');
    }






    public function total() // called in render method
    {
        $this->total = 0;

        $purchased_item =  Purchased_item::where('purchase_id', $this->purchase['id'])->get();

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
                'previewAvatar' => 'image|mimes:jpeg,png,jpg|max:2048|nullable'
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

    // public function updatedSubPage()
    // {
    //     $this->reset([
    //         'selectedPatients',
    //         'searchPatient',
    //     ]);   
    // }

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

    public function revertExam($patientId) 
    {
        Patient::where('id', $patientId)
            ->update(['patient_exam_status' => true]);
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



    public function updateItemQty($itemId)
    {
        $newBalance = Out_item::where('item_id', $itemId)->latest()->first()->balance;
        DB::table('items')->where('id', $itemId)->update(['item_qty' => $newBalance]);
    }








    public function outItem($itemId, $purchaseItemId)
    {
        $lastBalance = Out_item::where('item_id', $itemId)->latest()->first()->balance;
        $newBalance = $lastBalance - 1;

        $this->updateItemQty($itemId);

        $out_item = Out_item::create([
            'purchased_item_id' => $purchaseItemId,
            'item_id' => $itemId,
            'status'  => false,
            'qty'     => 1,
            'balance' => $newBalance,
        ]);

    }

    public function outItemIncrementOrDecrementQuantity($action, $purchaseItemId)
    {
        $OUT_ITEM = Out_item::where('purchased_item_id', $purchaseItemId)->first();

        if ($action == 'increment') {
            $query = ['qty' => DB::raw('qty + 1'), 'balance' => DB::raw('balance - 1')];
            $this->updateItemQty($OUT_ITEM->item_id); } 
        else {
            $query = ['qty' => DB::raw('qty - 1'), 'balance' => DB::raw('balance + 1')];
            $this->updateItemQty($OUT_ITEM->item_id); }


        $OUT_ITEM->update($query);

    }

    public function outItemDelete($purchaseItemId)
    {
        if ($purchaseItemId != null) {
            $OUT_ITEMS = Out_item::where('purchased_item_id', $purchaseItemId)->get();
            foreach ($OUT_ITEMS as $OUT_ITEM) {
                $OUT_ITEM->delete();
            }
            $this->updateItemQty($OUT_ITEM->item_id);
        } else {}
    }

    public function outItemBatchDelete($purchaseId)
    {
        $purchased_items = Purchased_item::where('purchase_id', $purchaseId)->get();
        
        foreach ($purchased_items as $purchased_item) {
            Out_item::where('purchased_item_id', $purchased_item->id)->delete();
        }
    }









    public function addItem($purchaseId, $itemId, $itemPrice)
    {
        $purchased_item = Purchased_item::create([
            'purchase_id'  => $purchaseId, 
            'item_id'      => $itemId,
            'item_price'   => $itemPrice,
            'qty'          => '1',
        ]);    

        $this->outItem($itemId, $purchased_item->id);

        $this->decrementItem($itemId, 1);

        $this->searchItem = '';
    }

    public function inc_dec_item($data, $itemId) 
    {
        $purchasedItem = Purchased_item::with('item')->where('id', $itemId)->first();

        if ($data == 'inc') {
            $this->outItemIncrementOrDecrementQuantity('increment', $purchasedItem->id);

            $DB_RAW = 'qty + 1';
            $this->decrementItem($purchasedItem->item_id, 1);}
        elseif ($data == 'dec') {
            $this->outItemIncrementOrDecrementQuantity('decrement', $purchasedItem->id);

            $DB_RAW = 'qty - 1';
            $this->incrementItem($purchasedItem->item_id, 1);}

        $purchasedItem->update(['qty' => DB::raw($DB_RAW)]);
    }

    public function removeItem($itemId) 
    { 
        $purchasedItem = Purchased_item::with('item')->where('id', $itemId)->first();

        $this->incrementItem($purchasedItem->item_id, $purchasedItem->qty);

        $this->outItemDelete($purchasedItem->id);

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

    public function checkItemQty($itemId) { return Item::findOrFail($itemId)->item_qty; }





    // public function exam_purchase_tab($data, $patientId)
    // {
    //     $findPt = Patient::findOrFail($patientId);
    //     $this->setPatient($findPt);
        
    //     switch ($data) {
    //         case 'exam':
    //             $this->exam['previous'] = Exam::where('patient_id', $patientId)->count();
    //             $this->getLastExam($patientId);
    //             $this->modal['exam_purchase_tab'] = 1;
    //             break;
    //         case 'purchase':
    //             // $this->latestPurchase = $this->isPatientPurchased($patientId);
    //             // $this->purchase['id'] = $this->latestPurchase->id ?? NULL;
    //             // $this->discount = $this->latestPurchase->discount ?? '0';
    //             // $this->deposit = $this->latestPurchase->deposit ?? '0';
    //             // $this->balance = $this->latestPurchase->balance ?? '0';
    //             // $this->duedate = $this->latestPurchase->duedate ?? NULL;
    //             // $this->purchase['date'] = $this->latestPurchase->created_at ?? '';
    //             // $this->modal['exam_purchase_tab'] = 2;
    //             break;
    //         case 'patient':
    //             $this->modal['exam_purchase_tab'] = 3;
    //             break;
    //         default:
    //     }
    // }

    public function editExamHistory($examId)
    {
        $this->getAnyExam($examId);
        $this->modal['tabs'] = true;
        $this->modal['exam_purchase_tab'] = 1;
        $this->exam['last'] = true;
        $this->modal['show'] = true;
        $this->editExamHistory = true;
    }

    // public function isPatientPurchased($patientId) { return Purchase::where('patient_id', $patientId)->latest()->first(); }

    // public function purchaseDate($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

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
            $this->previewAvatar->store('/', 'avatars'); 
        }
            
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






    public function createOrder()
    {
        
        $createOrder = Order_detail::updateOrCreate(
        [
            'patient_id'    => $this->pt['id'],
            'exam_id'       => $this->exam ['id'],
        ],
        [
            // 'patient_id'    => $this->pt['id'], 
            // 'exam_id'       => $this->exam ['id'],
            'lense'         => $this->orderLense,
            'frames'        => $this->orderFrame,
            'tint'          => $this->orderTint,
            'others'        => $this->orderOthers,
            'order_status'  => 1,
        ]);

        if ($createOrder) {
            session()->flash('orderSave', 'Saved');
            $this->getOrder();
        }
    }

    public function removeOrder($examId)
    {
        $order = Order_detail::where('exam_id', $examId)->first();
        if ($order) {
            $order->delete();
            $this->orderButtonLabel = 'Order';

            $this->getOrder();

            $this->reset([
                'removeOrder',
                'showCreateOrderWindow'
            ]);
        }        
    }

    public function resetOrderField()
    {
        $this->reset([
            'orderLense',
            'orderFrame',
            'orderTint',
            'orderOthers',
        ]);
    }
    

    public function getOrder()
    {
        $hasOrder = Order_detail::where('patient_id', $this->pt['id'])->where('exam_id', $this->exam['id'])->first();
        if ($hasOrder) {
            $this->orderButtonLabel = 'View order';

            $this->orderLense   = $hasOrder->lense;
            $this->orderFrame   = $hasOrder->frames;
            $this->orderTint    = $hasOrder->tint;
            $this->orderOthers  = $hasOrder->others;
        } else {
            $this->orderButtonLabel = 'Order';

            $this->orderLense   = '';
            $this->orderFrame   = '';
            $this->orderTint    = '';
            $this->orderOthers  = '';

            $this->showCreateOrderWindow = false;
        }
    }






    public function createPurchase($ptId)
    {
        $PURCHASE = Purchase::create(['patient_id' => $ptId]);

        if ($PURCHASE) {
            $this->setPurchase($PURCHASE);
            $this->modal['tab_hasPurchase'] = true; } 
        else {
            $this->modal['tab_hasPurchase'] = false; }
    }

    public function deletePurchase()
    {
        $this->outItemBatchDelete($this->purchase['id']);

        Purchase::destroy($this->purchase['id']);

        $this->modal_purchase($this->patientId);
    }






    public function createExam($patientId)
    {
        Exam::create(['patient_id' => $patientId]);
        $this->modal_exam($patientId);

        $this->getOrder();
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

    public function deleteExam($examId) 
    {
        Exam::destroy($examId);
        $this->removeOrder($examId);
        $this->modal_exam($this->patientId);

        $this->reset(['removeExam']);
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








    private function setExam($exam)
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

    private function setPurchase($purchase) 
    {
        $this->purchase['id']        = $purchase->id;
        $this->purchase['discount']  = $purchase->discount;
        $this->purchase['deposit']   = $purchase->deposit;
        $this->purchase['balance']   = $purchase->balance;
        $this->purchase['total']     = $purchase->total;
        $this->purchase['date']      = $purchase->duedate;
    }







    public function getAnyExam($examId)
    {
        $exam = Exam::findOrFail($examId);

        $this->setExam($exam);
    }

    // public function getLastExam($patientId)
    // {
    //     $getExam = Exam::where('patient_id', $patientId)->latest()->first();
    //     if ($getExam) {
    //         $this->setExam($getExam);
    //         $this->exam['last'] = true;
    //         $this->exam['history'] = Exam::where('patient_id', $patientId)->count();
    //     } else { 
    //         $this->exam['last'] = false; 
    //     }
    // }

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

    public function patientShowModal($action, $patientId)
    {
        $this->resetErrorBag();

        if ($patientId != null) {
            $pt = Patient::findOrFail($patientId);
            $this->setPatient($pt);
        }

        switch ($action) {
            case 'isAdd':
                $this->modal['isAddPatient'] = true;
                break;
            case 'isUpdate':
                $this->modal['isUpdatePatient'] = true;
                break;
            case 'exam':
                $this->modal_tab(2, $patientId);
                $this->modal['tabs'] = true;
                break;
            case 'purchase':
                $this->modal_tab(3, $patientId);
                $this->modal['tabs'] = true;
                break;
            default:
        }
        $this->modal['show'] = true;
    }





    public function modal_tab($value, $patientId)
    {
        switch ($value) {
            case 1:
                $this->modalTab = 1; break;
            case 2:
                $this->modalTab = 2;
                $this->modal_exam($patientId); break;
            case 3:
                $this->modalTab = 3;
                $this->modal_purchase($patientId); break;
            default:
        }
    }


    public function modal_exam($patientId)
    {
        $LAST_EXAM = Exam::where('patient_id', $patientId)->latest()->first();
        if ($LAST_EXAM) {
            $this->setExam($LAST_EXAM);
            $this->modal['tab_hasExam'] = true;
        } else { 
            $this->modal['tab_hasExam'] = false; 
        }

        //check if last exam has order, if there is, then view it.
        $this->getOrder();
    }

    public function modal_purchase($patientId)
    {
        $LAST_PURCHASE = Purchase::where('patient_id', $patientId)->latest()->first();

        if ($LAST_PURCHASE) {
            $this->setPurchase($LAST_PURCHASE);

            $this->discount = $LAST_PURCHASE->discount  ?? '0';
            $this->deposit  = $LAST_PURCHASE->deposit   ?? '0';
            $this->balance  = $LAST_PURCHASE->balance   ?? '0';
            $this->duedate  = $LAST_PURCHASE->duedate   ?? NULL;
            
            $this->modal['tab_hasPurchase'] = true;
        }
        else {
            $this->modal['tab_hasPurchase'] = false;
        }
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
        $patient = Patient::where('id', $patientId)->where('patient_queue', true)->first();
        return $patient ? true : false;
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

    public function downloadPrescription()
    {

        $date = Str::replace(' ', '_', date("Y-m-d h:i:sa"));
        $ptName = Str::title('john doe');
        $ptName = Str::replace(' ', '_', $ptName);


        // $pdfContent = PDF::loadView('livewire.pages.page-patient', ['purchases' => Purchase::with('patient')->latest()->get()])->output();

        // return response()->streamDownload(
        //     fn() => print($pdfContent),
        //     'file_name.pdf'
        // );

        return response()->streamDownload(function () {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->pdfExam());
            echo $pdf->stream();
        },  $ptName . '_' . $date . '.pdf');

        return $pdf->stream();
    }





    public function pdfExam()
    {
        $html = '
            <style>
                table.table1 {
                    border: 1px solid lightgray;
                    border-collapse: collapse;
                }
                .table1 th, .table1 td {
                    border: 1px solid lightgray;
                    padding: 7px 5px;
                }
                .bb {
                    border-bottom: 1px solid black;
                }
                .text-center {
                    text-align: center;
                }
                .text-right {
                    text-align: right;
                }

            </style>

            <div style="padding-bottom:30px">
                <center style="margin-bottom: 20px;"><h3>DANGO OPTICAL CLINIC</h3></center>
                <table class="table1" style="width:100%;">
                    <tr>
                        <td colspan="5"><b>NAME: </b>' . $this->pt['fullname'] . '</td>
                        <td colspan="2"><b>AGE: </b>' . $this->pt['age'] . '</td>
                    </tr>
                    <tr>
                        <td colspan="7"><b>ADDRESS: </b>' . $this->pt['addr'] . '</td>
                    </tr>
                    <tr>
                        <th colspan="7" style="padding:12px 0">REFRACTION</th>
                    </tr>
                    <tr>
                        <th>RX</th>
                        <th>SPH</th>
                        <th>CYL</th>
                        <th>AXIS</th>
                        <th>NVA</th>
                        <th>PH</th>
                        <th>CVA</th>
                    </tr>
                    <tr>
                        <th>OD</th>
                        <td class="text-center">' . $this->exam['exam_OD_SPH'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OD_CYL'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OD_AXIS'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OD_NVA'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OD_PH'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OD_CVA'] . '</td>
                    </tr>
                    <tr>
                        <th>OS</th>
                        <td class="text-center">' . $this->exam['exam_OS_SPH'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OS_CYL'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OS_AXIS'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OS_NVA'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OS_PH'] . '</td>
                        <td class="text-center">' . $this->exam['exam_OS_CVA'] . '</td>
                    </tr>
                    <tr>
                        <th>ADD</th>
                        <td colspan="2">' . $this->exam['exam_ADD'] . '</td>
                        <th>P.D</th>
                        <td colspan="3">' . $this->exam['exam_PD'] . '</td>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-top:12px; padding-bottom:12px;"><b style="margin-right:8px;">REMARKS: </b> ' . $this->exam['exam_remarks'] . '</td>
                    </tr>
                </table>
            </div>';

        return $html;
    }
}