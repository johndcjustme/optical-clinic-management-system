<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\Ordered_item;
use App\Models\Order_detail;
use App\Models\Patient;
use App\Models\Item;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;
use PDF;


use App\_Classes\NotificationClass;

 



class PageOrders extends Component
{
    use WithPagination;

        
    public $subPage = 1;

    public $selectedOrders = [];

    public $selectAll = false;

    public $orderPatientId;

    public $searchOrder;

    public $hasOrder = false;

    public $pageNumber = 10;

    public $description;

    public $page = 1;

    public $viewOrderPatientId = '', $viewOrderExamId = '';

    public $sendOrder = false;

    public $toName, $to, $subject, $body;


    


    // public $ordered_items = [];


    public $confirm = [
        'send_orders_to_supplier' => false,
        'valueOfStatusToChange' => '',
        'changeStatus' => false,
    ];

    public 
        $total    = 0,
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

        'viewOrder' => false,
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
        'page' => ['except' => ''],
        'subPage' => ['except' => ''],
        'searchOrder' => ['except' => ''],
        // 'modal',
        // 'orderPatientId' => ['except' => ''],
    ];

    public function render()
    {



        $render = [];



        // $this->total();

        $orders = Order_detail::with('patient');
        $orderDetail = Order_detail::with('patient')->with('exam');

        if (!empty($this->viewOrderPatientId) && !empty($this->viewOrderExamId))
            $orderDetail->where('patient_id', $this->viewOrderPatientId)->where('exam_id', $this->viewOrderExamId);
            

        switch ($this->subPage) {
            case 1: $orders = $orders->where('order_status', 1); break;
            case 2: $orders = $orders->where('order_status', 2); break;
            case 3: $orders = $orders->where('order_status', 3); break;
            case 4: $orders = $orders->where('order_status', 4); break;
            default;
        }

        return view('livewire.pages.page-orders', [
            'orders' => $orders->orderByDesc('created_at')->paginate($this->pageNumber),
            'orderDetails' => $orderDetail->orderByDesc('created_at')->get(),
            ])
            ->extends('layouts.app')
            ->section('content');



            // $pdf = PDF::loadView('livewire.pages.page-orders', $orders);
    
            // return $pdf->download('itsolutionstuff.pdf');
    }


    // public function pdf()
    // {

    //     return response()->streamDownload(function () {
    //         $pdf = App::make('dompdf.wrapper');
    //         $pdf->loadHTML('<h1>Test</h1>');
    //         echo $pdf->stream();
    //     }, 'test.pdf');

     
    //     // $pdf = PDF::loadView('livewire.pages.create-pdf',['title' => 'I am a title']);
     
    //     // return $pdf->download('tutsmake.pdf');
        

    // }


    // public function notify($title, $description)
    // {
    //     $notify = new NotificationClass();
    //     $notify->notify($title, $description);
    // }


    public function updatedSubPage()
    {
        $this->reset([
            'selectedOrders',
            'selectAll',
        ]);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedOrders = Order_detail::pluck('id')->map(function ($id) {
                return(string) $id;
            });
        } else {
            $this->selectedOrders = [];
        }
    }


    public function thispdf()
    {
        // Browsershot::html('<h1>Hello world!!</h1>')->save('example.pdf');
        $image = Browsershot::url('http://127.0.0.1:8000/orders') 
            ->setScreenshotType('jpeg', 100)
            ->save('this.png');
    }

    public function updatedDescription()
    {
        Order_detail::find($this->order['id'])->update(['order_desc' => $this->description]);
    }


    public function total($total) // called in render method
    {
        $this->total = $total;

        // $purchased_item =  Purchased_item::where('purchase_id', $this->latest_purchase['id'])->get();

        // foreach ($purchased_item as $pi) {
        //     $this->total += $pi->qty * $pi->item_price;
        // }


        $this->discount > 0 
            ? $this->discount > $this->total
                ? session()->flash('discount', 'error')
                : $this->total = $this->total - $this->discount
            : '';

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
            case 1: return Order_detail::where('order_status', $value)->count(); break;
            case 2: return Order_detail::where('order_status', $value)->count(); break;
            case 3: return Order_detail::where('order_status', $value)->count(); break;
            case 4: return Order_detail::where('order_status', $value)->count(); break;
            default:
        }
    }

    public function hasOrderStatus($orderStatus)
    {
        $orders = Order_detail::where('order_status', $orderStatus)->where('patient_id', '!=', NULL)->count();
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
        $order = Order_detail::create([
            'patient_id' => $patientId,
            'order_status' => 1,
        ]);
        $this->order['id'] = $order->id;
        $this->getPatient($patientId);
    }





    // public function addOrder()
    // {
    //     $order = Order_detail::create(['order_status' => 1]);
    //     $this->order['id'] = $order->id;
    //     $this->hasOrder = true;
    // }

    public function changeStatus($value) 
    {
        $this->confirm['changeStatus'] = true;
        $this->confirm['valueOfStatusToChange'] = $value;

        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Update Status',
            'content' => 'Change status to "' . $this->orderCategory($value) . '"?'
        ]);
    }


    public function statusChanged($statusValue)
    {
        // dd($statusValue);
        foreach($this->selectedOrders as $selectedOrder) {
            Order_detail::where('id', $selectedOrder)->update(['order_status' => $statusValue]);
        }
        $this->reset([
            'selectedOrders', 
            'selectAll'
        ]);
    }

    

    public function updateOrder()
    {
        Order_detail::find($order->id)->update([
            'patient_id' => $this->pt['id'],
        ]);

        dd('order updated');
    }

    public function deletingOrder($orderId)
    {
        $this->order['id'] = $orderId;
        $this->delete['order'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Are you sure?',
            'content' => 'This row will be deleted, continue?'
        ]);  
    }

    public function deleteOrder()
    {
        Order_detail::destroy($this->order['id']);

        $this->reset(['delete']);

        $this->dispatchBrowserEvent('confirm-dialog-close'); 

        $this->dispatchBrowserEvent('toast',[
            'title' => 'Success',
            'class' => 'success',
            'message' => 'Order has been successfully deleted.',
        ]);
    }

    public function deletingOrders()
    {
        $this->delete['orders'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Are you sure?',
            'content' => 'Selected row(s) will be removed!'
        ]);  
    }

    public function deleteOrders()
    {
        Order_detail::destroy($this->selectedOrders);

        $this->selectedOrders = [];

        $this->reset(['delete']);

        $this->dispatchBrowserEvent('confirm-dialog-close'); 

        $this->dispatchBrowserEvent('toast',[
            'title' => 'Success',
            'class' => 'success',
            'message' => 'Order(s) has been successfully deleted.',
        ]);
    }







    // public function previewOrder()
    // {
    //     // $data;
    //     $code = Str::random(8);

    //     foreach ($this->selectedOrders as $orderId) {
    //         Order_detail::where('id', $orderId)->update(['order_code' => $code]);
    //     }
    //     // dd($orderId);

    //     $order = Order_detail::find($orderId);
    //     $this->order['code'] = $order->order_code;

    //     $this->modal['previeworder'] = true;
    // }




    public function orderAddItem($itemId, $itemPrice)
    {
        // $this->ordered_items[] = $itemId;

        // $item = Item::find($itemId)->first();

        Ordered_item::create([
            'order_detail_id' => $this->order['id'],
            'item_id' => $itemId,
            'ordered_item_price' => $itemPrice,
            'ordered_item_qty' => 1,
        ]);

        $this->total += $itemPrice;
    }







    public function removeItem($itemId)
    {
        Ordered_item::destroy($itemId);
    }

    public function disableOn($itemId, $price, $valueToDisable, $action)
    {
        // $DB_RAW;
        $ordered_item = Ordered_item::findOrFail($itemId)->first();

        if ($action == 'inc') {
            $this->total += $price;
            $DB_RAW = 'ordered_item_qty + 1';
            $ordered_item->update(['ordered_item_qty' => DB::raw($DB_RAW)]);
        $itemId = '';

            // dd($valueToDisable + 1);
        }
        elseif ($action == 'dec') {
            $this->total -= $price;
            $DB_RAW = 'ordered_item_qty - 1';
            $ordered_item->update(['ordered_item_qty' => DB::raw($DB_RAW)]);
        $itemId = '';

            // dd($valueToDisable - 1);
        }


        // if ($valueToDisable == $valueToDisable) {
        //     // return false;
        // } else {
        //     // return true;
        // }

        // $ordered_item->update(['ordered_item_qty' => DB::raw($DB_RAW)]);
    }

    public function viewOrder($patientId, $examId)
    {
        $this->reset([
            'viewOrderPatientId',
            'viewOrderExamId',
        ]);
        $this->viewOrderPatientId = $patientId;
        $this->viewOrderExamId = $examId;
        $this->showModal('viewOrder', null);
    }


    public function showModal($action, $orderId)
    {
        switch ($action) {
            case 'add': 
                //
                $this->modal['add'] = true;
                break;

            case 'update': 
                $order = Order_detail::find($orderId);
                $this->order['id'] = $order->id;
                $this->description = $order->order_desc;

                $this->getPatient($order->patient_id);
                // $this->hasOrder = true;

                $this->total = Ordered_item::where('order_detail', $order->id)->sum('ordered_item_price');

                $this->modal['update'] = true;
                break;
            case 'viewOrder':
                $this->modal['viewOrder'] = true;
                break;
            default;
        }

        $this->modal['show'] = true;
    }

    public function closeModal()
    {
        $this->reset([
            'modal', 
            'order', 
            'orderPatientId', 
            'hasOrder', 
            'viewOrderPatientId', 
            'viewOrderExamId', 
            'sendOrder', 

            'to', 
            'subject', 
            'body',

            'confirm',
        ]);

        $this->resetErrorBag();
    }

    public function confirm()
    {
        $this->delete['order'] 
            ? $this->deleteOrder() 
            : NULL;
        $this->delete['orders'] 
            ? $this->deleteOrders() 
            : NULL;
        $this->confirm['send_orders_to_supplier']
            ? $this->sendMail()
            : NULL;
        $this->confirm['changeStatus']
            ? $this->statusChanged($this->confirm['valueOfStatusToChange'])
            : NULL;


        $this->dispatchBrowserEvent('confirm-dialog-close'); 
    }



    public function itemSum($orderId)
    {
        return Ordered_item::where('order_detail_id', $orderId)->sum('ordered_item_qty');
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
        // $this->getFullName($pt->patient_lname, $pt->patient_fname, $pt->patient_mname);
    }


    public function getFullName($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $this->pt['addr'] = $patient->patient_address;
        if (!empty($patientId)) {
            return $patient->patient_lname . ', ' . $patient->patient_fname . ' ' . $patient->patient_mname;
        } else {
            return '';
        }
    }




    public function downloadPdf()
    {
        date_default_timezone_set("Asia/Manila");

        $today = Str::replace('-', '_', getToday() . '_' . date('h:i:sa'));
        $filename = 'patient_orders_' . $today . '.pdf';

        // return $this->savePdf($filename);
        return response()->streamDownload(function () {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->convert_customer_data_to_html());
            echo $pdf->stream();
        }, $filename);
    }


    // public function savePdf($filename)
    // {
    //     return response()->streamDownload(function () {
    //         $pdf = \App::make('dompdf.wrapper');
    //         $pdf->loadHTML($this->convert_customer_data_to_html());
    //         echo $pdf->stream();
    //     }, $filename);
    // }

    public function confirmSendingEmail()
    {
        $this->confirm['send_orders_to_supplier'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Send Email',
            'content' => 'Order will be sent to ' . $this->to,
        ]);
    }

    public function sendMail()
    {
        $this->validate(
            [
                'to' => 'required'
            ],
            [
                'to.required' => 'Required'
            ]
        );

        $this->statusChanged(2);

        $data = [
            'email'     => 'johndecastro.604@gmail.com',
            'subject'   => $this->subject,
            'body'      => $this->body];

        $file = public_path('patient-orders.pdf');

        Browsershot::html($this->convert_customer_data_to_html())
            ->margins('1', '1', '1', '1', 'cm')
            ->format('letter')
            ->save($file);
  
        // Mail::send('send-patient-orders', $data, function($message) use ($data, $file) {
        //     $message->to($data["email"])
        //             ->subject($data["subject"])
        //             ->attach($file);});

        // unlink($file);


        $this->dispatchBrowserEvent('toast', [
            'class' => 'success',
            'title' => 'Sent!',
            'message' => 'Order was sent successfully.'
        ]);
    }



    public function convert_customer_data_to_html()
    {

        $html = '
            <style>
                html {
                    font-family: Arial, Helvetica, sans-serif;
                }
                table.table1 {
                    border: 2px solid rgb(175, 175, 175);
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
            <center style="margin-bottom:20px; font-size:20px;"><h3>DANGO OPTICAL CLINIC</h3></center>';

            foreach (Order_detail::with(['exam','patient'])->orderByDesc('created_at')->get() as $order) {
                foreach ($this->selectedOrders as $selected) {
                    if ($order->id == $selected) {
                        $html .= '
                        <div style="padding-bottom:30px">
                            <table class="table1" style="width:100%;">
                                <tr>
                                    <td colspan="5"><b>NAME: </b><span style="font-size:19px;">' . Str::title($order->patient->patient_lname . ', ' . $order->patient->patient_fname . ' ' . $order->patient->patient_mname) . '</span></td>
                                    <td colspan="2"><b>AGE: </b>' . $order->patient->patient_age . '</td>
                                </tr>
                                <tr>
                                    <td colspan="7"><b>ADDRESS: </b>' . $order->patient->patient_address . '</td>
                                </tr>
                                <tr>
                                    <th colspan="7" style="padding:12px 0"><center> <span class="ui header">REFRACTION</span></center></th>
                                </tr>
                                <tr>
                                    <th class="text-center">RX</th>
                                    <th class="text-center">SPH</th>
                                    <th class="text-center">CYL</th>
                                    <th class="text-center">AXIS</th>
                                    <th class="text-center">NVA</th>
                                    <th class="text-center">PH</th>
                                    <th class="text-center">CVA</th>
                                </tr>
                                <tr>
                                    <th class="text-center">OD</th>
                                    <td class="text-center">' . $order->exam->exam_OD_SPH . '</td>
                                    <td class="text-center">' . $order->exam->exam_OD_CYL . '</td>
                                    <td class="text-center">' . $order->exam->exam_OD_AXIS . '</td>
                                    <td class="text-center">' . $order->exam->exam_OD_NVA . '</td>
                                    <td class="text-center">' . $order->exam->exam_OD_PH . '</td>
                                    <td class="text-center">' . $order->exam->exam_OD_CVA . '</td>
                                </tr>
                                <tr>
                                    <th class="text-center">OS</th>
                                    <td class="text-center">' . $order->exam->exam_OS_SPH . '</td>
                                    <td class="text-center">' . $order->exam->exam_OS_CYL . '</td>
                                    <td class="text-center">' . $order->exam->exam_OS_AXIS . '</td>
                                    <td class="text-center">' . $order->exam->exam_OS_NVA . '</td>
                                    <td class="text-center">' . $order->exam->exam_OS_PH . '</td>
                                    <td class="text-center">' . $order->exam->exam_OS_CVA . '</td>
                                </tr>
                                <tr>
                                    <th class="text-center">ADD</th>
                                    <td colspan="2">' . $order->exam->exam_ADD . '</td>
                                    <th class="text-center">P. D.</th>
                                    <td colspan="3">' . $order->exam->exam_PD . '</td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-top:12px; padding-bottom:12px;"><b style="margin-right:8px;">REMARKS: </b>' . $order->exam->exam_remarks . '</td>
                                </tr>
                                <tr>
                                    <th class="text-center">LENSE</th>
                                    <td colspan="6" style="padding-top:12px; padding-bottom:12px;">' . $order->exam->exam_lense . '</td>
                                </tr>
                                <tr>
                                    <th class="text-center">FRAME</th>
                                    <td colspan="6" style="padding-top:12px; padding-bottom:12px;">' . $order->exam->exam_frame . '</td>
                                </tr>
                                <tr>
                                    <th class="text-center">TINT</th>
                                    <td colspan="6" style="padding-top:12px; padding-bottom:12px;">' . $order->exam->exam_tint . '</td>
                                </tr>
                            </table>
                        </div>';
                    }
                }
            }


        return $html;
    }

}
