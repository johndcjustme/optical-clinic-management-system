<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

use App\Models\Order;
use App\Models\Ordered_item;
use App\Models\Patient;
use App\Models\Item;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


use PDF;



class PageOrders extends Component
{
    use WithPagination;


    
    public $subPage = 1;

    public $selectedOrders = [];

    public $orderPatientId;

    public $searchOrder;

    public $hasOrder = false;

    public $pageNumber = 10;

    public $description;


    public 
        $total,
        $discount = 0,
        $balance  = 0,
        $deposit  = 0,
        $cash     = 0,
        $change   = 0,
        $duedate;

    public $pt = [
        'avatar' => '',
        'addr' => '',
    ];

    public $delete = [
        'order' => false,
        'orders' => false,
    ];

    public $modal = [
        'show' => false,
        'add' => false,
        'update' => false,
        'previeworder' => false,
        'sendorder' => false,
    ];

    public $order = [
        'id',
        'total' => 0,
        'code' => '',
    ];
    

    public $item = [
        'price' => [],
    ];


    protected $listeners = ['showModal', 'thisPatient'];

    protected $queryString = [
        'subPage' => ['except' => ''],
        'searchOrder' => ['except' => ''],
        'modal',
        'orderPatientId' => ['except' => ''],
    ];

    public function render()
    {

        $render = [];

        $this->total();

        $orders = Order::with('patient')->where('patient_id', '!=', NULL)->orderByDesc('created_at');

        switch ($this->subPage) {
            case 1: $orders = $orders->where('order_status', 1); break;
            case 2: $orders = $orders->where('order_status', 2); break;
            case 3: $orders = $orders->where('order_status', 3); break;
            case 4: $orders = $orders->where('order_status', 4); break;
            default;
        }

        return view('livewire.pages.page-orders', ['orders' => $orders->paginate($this->pageNumber)])
            ->extends('layouts.app')
            ->section('content');



            // $pdf = PDF::loadView('livewire.pages.page-orders', $orders);
    
            // return $pdf->download('itsolutionstuff.pdf');
    }


    public function pdf()
    {

        return response()->streamDownload(function () {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML('<h1>Test</h1>');
            echo $pdf->stream();
        }, 'test.pdf');

     
        // $pdf = PDF::loadView('livewire.pages.create-pdf',['title' => 'I am a title']);
     
        // return $pdf->download('tutsmake.pdf');
        

    }

    public function updatedDescription()
    {
        Order::find($this->order['id'])->update(['order_desc' => $this->description]);
    }

    public function total() // called in render method
    {
        $this->total = 1000;

        // $purchased_item =  Purchased_item::where('purchase_id', $this->latest_purchase['id'])->get();

        // foreach ($purchased_item as $pi) {
        //     $this->total += $pi->qty * $pi->item_price;
        // }


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


    public function orderCategory($value) 
    {
        switch ($value) {
            case 1: return 'To Order'; break;
            case 2: return 'Pending';  break;
            case 3: return 'Received'; break;
            case 4: return 'Claimed';  break;
            default:
        }
    }

    public function orderCategoryDesc($value) 
    {
        switch ($value) {
            case 1: return '2'; break;
            case 2: return '1';  break;
            case 3: return '7'; break;
            case 4: return '4';  break;
            default:
        }
    }

    public function hasOrderStatus($orderStatus)
    {
        $orders = Order::where('order_status', $orderStatus)->where('patient_id', '!=', NULL)->count();
        switch ($orderStatus) {
            case 1: 
                if ($orders > 0) 
                return true; break;
            case 2: 
                if ($orders > 0) 
                return true; break;
            case 3: 
                if ($orders > 0) 
                return true; break;
            case 4: 
                if ($orders > 0) 
                return true; break;
            default:
        }
    }

    public function orderAssignPatient($patientId)
    {
        Order::find($this->order['id'])->update(['patient_id' => $patientId]);
        $this->getPatient($patientId);
    }





    public function addOrder()
    {
        $order = Order::create(['order_status' => 1]);
        $this->order['id'] = $order->id;
        $this->hasOrder = true;
    }

    public function updateOrder()
    {
        Order::find($order->id)->update([
            'patient_id' => $this->pt['id'],
        ]);

        dd('order updated');
    }

    public function deletingOrder($orderId)
    {
        $this->order['id'] = $orderId;
        $this->delete['order'] = true;
        $this->dispatchBrowserEvent('confirm-dialog');  
    }

    public function deleteOrder()
    {
        Order::destroy($this->order['id']);

        $this->dispatchBrowserEvent('confirm-dialog-close'); 

        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Successfully Deleted',
        ]);
    }

    public function deletingOrders()
    {
        $this->delete['orders'] = true;
        $this->dispatchBrowserEvent('confirm-dialog');  
    }

    public function deleteOrders()
    {
        Order::destroy($this->selectedOrders);

        $this->selectedOrders = [];

        $this->dispatchBrowserEvent('confirm-dialog-close'); 

        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Successfully Deleted',
        ]);
    }







    public function previewOrder()
    {
        // $data;
        $code = Str::random(8);

        foreach ($this->selectedOrders as $orderId) {
            Order::where('id', $orderId)->update(['order_code' => $code]);
        }
        // dd($orderId);

        $order = Order::find($orderId);
        $this->order['code'] = $order->order_code;

        $this->modal['previeworder'] = true;
    }




    public function orderAddItem($itemId)
    {
        $item = Item::find($itemId)->first();

        Ordered_item::create([
            'order_id' => $this->order['id'],
            'item_id' => $itemId,
            'ordered_item_price' => $item->item_price,
            'ordered_item_qty' => 1,
        ]);
    }







    public function removeItem($itemId)
    {
        Ordered_item::destroy($itemId);
    }

    public function disableOn($itemId, $valueToDisable, $type)
    {
        $DB_RAW;
        $ordered_item = Ordered_item::find($itemId);

        if ($type == 'inc') {
            $DB_RAW = 'ordered_item_qty + 1';
            // dd($valueToDisable + 1);
        }
        elseif ($type == 'dec') {
            $DB_RAW = 'ordered_item_qty - 1';
            // dd($valueToDisable - 1);
        }

        if ($valueToDisable == $valueToDisable) {
            // return false;
        } else {
            // return true;
        }
        $ordered_item->update(['ordered_item_qty' => DB::raw($DB_RAW)]);
    }




    public function showModal($action, $orderId)
    {
        switch ($action) {
            case 'add': 
                //
                $this->modal['add'] = true;
                break;

            case 'update': 
                $order = Order::find($orderId);
                $this->order['id'] = $order->id;
                $this->description = $order->order_desc;

                $this->getPatient($order->patient_id);
                $this->hasOrder = true;
                $this->modal['update'] = true;
                break;
            default;
        }

        $this->modal['show'] = true;
    }

    public function closeModal()
    {
        $this->reset(['modal', 'orderPatientId', 'hasOrder']);
    }

    public function confirm()
    {
        $this->delete['order'] 
            ? $this->deleteOrder() 
            : NULL;
        $this->delete['orders'] 
            ? $this->deleteOrders() 
            : NULL;
    }



    public function itemSum($orderId)
    {
        return Ordered_item::where('order_id', $orderId)->sum('ordered_item_qty');
        // $count = 0;
        // foreach (Ordered_item::where('order_id', $orderId)->get() as $ordered_item) {
        //     $count = $ordered_item->order_item_qty + $ordered_item->order_item_qty;
        // }
        // return $count;
    }







    public function getPatient($patientId)
    {
        $pt = Patient::find($patientId);
        $this->orderPatientId = $pt->id;
        $this->pt['avatar'] = $pt->patient_avatar;
        $this->pt['addr'] = $pt->patient_address;

        // $this->updateOrder();
        $this->getFullName($patientId);
    }


    public function getFullName($patientId)
    {
        if (!empty($patientId)) {
            $patient = Patient::findOrFail($patientId);
            return $patient->patient_lname . ', ' . $patient->patient_fname . ' ' . $patient->patient_mname;
        } else {
            return 'Search Patient';
        }
    }

    public function storage($url) 
    {
        if (!empty($url) || ($url != null)) {
            return Storage::disk('avatars')->url($url); } 
        else {
            return Storage::disk('avatars')->url('default-user-avatar.png'); } 
    }
}
