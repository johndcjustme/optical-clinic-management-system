<?php

namespace App\Http\Livewire\Pages;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\User;
use App\Models\Patient;
use App\Models\Item;
use App\Models\Category;
use App\Models\In_out_of_item as Out_item;
use App\Models\Appointment;
use App\Models\Order_detail;
use App\Models\Appointment_category as Ac;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Livewire\WithPagination;
use Dompdf\Dompdf;

use PDF;

class PageDashboard extends Component
{
    use WithPagination;
    // public $mysession;
    // public $mysessionid;
    public $patient;

    public $year, $weeklyPatients = 0;

    public $monthlyPatients;

    public $days = [];

    public $recentSubscribers = 556;

    public $pageNumber = 7;

    public $count = 0;

    public $mar;

    public $countLowStocks;

    public $stat = 'patients';

    public $product = 'top';

    public $productYearlyDemand = 2022;

    public $months = [
        'JAN',
        'FEB',
        'MAR',
        'APR',
        'MAY',
        'JUN',
        'JUL',
        'AUG',
        'SEPT',
        'OCT',
        'NOV',
        'DEC',
    ];

    public $value = 1;

    public $monthValues;


    protected $queryString = [
        'stat' => ['except' => 'empty'],
        'product' => ['except' => 'empty'],
        'weeklyPatients' => ['except' => ''],
        'monthlyPatients' => ['except' => ''],

        
    ];

    
    public function mount()
    {
        $this->year = date('Y');
        $this->monthlyPatients = Str::upper(date('M'));

        $this->days = collect(range(13,24))->map(function ($number) {
            return 'Jan' . $number;
        });
    }
    
    public function render()
    {
        // $this->getMonth(4);

        $countLowStocksArray = [];

        $columnChartModel = (new ColumnChartModel());
            $columnChartModel->addColumn('Week 1', $this->weeklyPatients($this->weeklyPatients), '#21ba45');
            $columnChartModel->addColumn('Week 2', $this->weeklyPatients($this->weeklyPatients + 1), '#21ba45');
            $columnChartModel->addColumn('Week 3', $this->weeklyPatients($this->weeklyPatients + 2), '#21ba45');
            $columnChartModel->addColumn('Week 4', $this->weeklyPatients($this->weeklyPatients + 3), '#21ba45');

            // foreach (Category::select(['name', 'id', 'cvalue'])->get() as $category) {
            //     $columnChartModel->addColumn($category->name, $this->totalOfItems($category->id), $category->cvalue);}

        $itemsColumnChartModel = (new ColumnChartModel());
            for ($i = 1; $i <= 12; $i++) {
                $itemsColumnChartModel->addColumn(date('M', mktime(0, 0, 0, $i, 1, $this->productYearlyDemand)), $this->getMonthlyItemSales($i), '#2185d0');}

        $pieChartModel = (new PieChartModel());
            foreach (Category::select(['name', 'id', 'cvalue'])->get() as $category) {
                $pieChartModel->addSlice($category->name, $this->totalOfItems($category->id), $category->cvalue); }
              


        $areaChartModel = (new AreaChartModel());
            for ($i = 1; $i <= 12; $i++) {
                $areaChartModel->addPoint(date('M', mktime(0, 0, 0, $i, 1, $this->year)), $this->getMonth($i)); }


        $outStocks = Item::whereColumn('item_qty', '<=', 'item_buffer')->get();

        if ($outStocks) {
            foreach ($outStocks as $countLowStock) {
                $countLowStocksArray[] = $countLowStock; }
    
            $this->countLowStocks = count($countLowStocksArray);
        }



           
        return view('livewire.pages.page-dashboard', [
                'columnChartModel' => $columnChartModel->withoutLegend()->setHorizontal(true)->setAnimated(true),
                'pieChartModel' => $pieChartModel->withDataLabels()->setAnimated(true),
                'areaChartModel' => $areaChartModel->setAnimated(true),
                'itemsColumnChartModel' => $itemsColumnChartModel->withoutLegend()->setAnimated(true),
                // 'patients' => Patient::all(),
                'items' => Item::select(['id', 'item_name', 'item_desc', 'item_price'])->with('category')->paginate($this->pageNumber),
                'outStocks' => $outStocks,
            ])
            ->extends('layouts.app')
            ->section('content');


         
    }



    // public function fetchData()
    // {
    //     // $this->recentSubscribers += 10;
    //     $subscribers = array_replace($this->subscribers, [10 => $this->recentSubscribers += 10]);

    //     $this->emit('refreshChart', ['seriesData' => $subscribers]);
    // }

    public function getMonthlyItemSales($monthValue)
    {
        $countItem = 0;
        $totalDaysOfMonth = date('t', mktime(0, 0, 0, $monthValue, 1, $this->year));

        $out_items = Out_item::select(['qty'])
                        ->whereMonth('created_at', $monthValue)
                        ->whereYear('created_at', $this->productYearlyDemand)
                        ->get();

        foreach ($out_items as $out_item) {
            $countItem += $out_item->qty;
        }
    
        return $countItem;
    }


    public function setMonthlyPatients($firstWeekValue, $ofMonth)
    {
        $this->weeklyPatients = $firstWeekValue;
        $this->monthlyPatients = $ofMonth;
    }

    public function weeklyPatients($weekValue)
    {
    
        $date = Carbon::now();

        $date->setISODate($this->year,$weekValue);

        return $patients = Patient::select(['id'])
                        ->whereBetween('created_at', [
                            $date->startOfWeek()->format('Y-m-d'), 
                            $date->endOfWeek()->format('Y-m-d')
                        ])->count();
    }

    public function getMonth($monthValue)
    {
        $count = [];
        $totalDaysOfMonth = date('t', mktime(0, 0, 0, $monthValue, 1, $this->year));

        foreach (Patient::select(['id'])->whereMonth('created_at', $monthValue)->whereYear('created_at', $this->year)->get() as $pt) {
            $count[] = $pt->id; 
        }

        return count($count);
    }

    public function totalOfPatients($kind)
    {
        switch ($kind) {
            case 'all':
                return Patient::select(['id'])->count() ?? 0;
                break;
            case 'today':
                return Patient::select(['id'])->whereDate('created_at', date('Y-m-d'))->count() ?? 0;
                break;
            case 'yesterday':
                return Patient::select(['id'])->whereDate('created_at', getYesterday())->count() ?? 0;
                break;
            case 'thisWeek':
                return Patient::select(['id'])->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count() ?? 0;
                break;
            default:
        }
    }

    public function yearlyPatients($year)
    {
        return Patient::select(['id'])->whereYear('created_at', $year)->count();
    }

    public function totalOfItems($categoryId)
    {
        return Item::select(['id'])->where('category_id', $categoryId)->count();
    }






    public function appointmentStats($value)
    {

        switch ($value) {
            case 'today':
                return Appointment::select(['id'])->whereDate('appt_date', getToday())->count() ?? 0;
                break;
            case 'tomorrow':
                return Appointment::select(['id'])->whereDate('appt_date', getTomorrow())->count() ?? 0;
                break;
            case 'forApproval':
                // $ac = Ac::where('status', true)->first();
                return Appointment::select(['id'])->where('appointment_category_id', 22)->count() ?? 0;
                break;
            case 'ongoing':
                return Appointment::select(['id'])->where('appointment_category_id', 33)->count() ?? 0;
                return 0;
                break;
            default;
        }

    }


    public function orderStats($status)
    {
        return Order_detail::select(['order_status'])->where('order_status', $status)->count();
    }
}
