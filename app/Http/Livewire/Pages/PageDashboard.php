<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\User;
use App\Models\Patient;
use App\Models\Item;
use App\Models\Category;
use App\Models\Appointment;
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

    public $year = 2022;


    public $days = [];

    public $subscribers = [30,36,42,78,88,109,205,325,349,480,556];

    public $recentSubscribers = 556;

    public $pageNumber = 7;


    public $count = 0;

    public $mar;

    public $stat = 'patients';

    public $product = 'top';

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
    ];



    
    public function mount()
    {
        $this->days = collect(range(13,24))->map(function ($number) {
            return 'Jan' . $number;
        });
    }
    
    public function render()
    {
        $this->getMonth(4);
        $columnChartModel = (new ColumnChartModel());
            foreach (Category::all() as $category) {
                $columnChartModel->addColumn($category->name, $this->totalOfItems($category->id), $category->cvalue);
            }

        $pieChartModel = (new PieChartModel())
            ->setTitle('Inventory Items')
            ->addSlice('Lenses', $this->totalOfItems('le'), '#008080')
            ->addSlice('Frames', $this->totalOfItems('fr'), '#B413EC')
            ->addSlice('Accessories', $this->totalOfItems('ac'), '#FE9A76');


        $areaChartModel = (new AreaChartModel());
            for ($i = 1; $i <= 12; $i++)
                $areaChartModel->addPoint(date('M', mktime(0, 0, 0, $i, 1, $this->year)), $this->getMonth($i));

            
           
        return view('livewire.pages.page-dashboard', [
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                'areaChartModel' => $areaChartModel,
                'patients' => Patient::all(),
                'items' => Item::with('category')->paginate($this->pageNumber),
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


    public function getMonth($monthValue)
    {

        $count = 0;
        $totalDaysOfMonth = date('t', mktime(0, 0, 0, $monthValue, 1, $this->year));

        for ($i = 1; $i <= $totalDaysOfMonth; $i++) {
            $count += Patient::whereDate('created_at', date('Y-m-d', mktime(0, 0, 0, $monthValue, $i, $this->year)))->count();
        }

        return $this->count = $count;
        // echo date('t', mktime(0,0,0,2,1,2022));

        // return Patient::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }

    public function totalOfPatients($kind)
    {
        switch ($kind) {
            case 'all':
                return Patient::count() ?? 0;
                break;
            case 'today':
                return Patient::whereDate('created_at', date('Y-m-d'))->count() ?? 0;
                break;
            case 'yesterday':
                return Patient::whereDate('created_at', getYesterday())->count() ?? 0;
                break;
            case 'thisWeek':
                return Patient::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count() ?? 0;
                break;
            default:
        }
    }

    public function yearlyPatients($year)
    {
        return Patient::whereYear('created_at', $year)->count();
    }

    public function totalOfItems($categoryId)
    {
        return Item::where('category_id', $categoryId)->count();
    }






    public function appointmentStats($value)
    {

        switch ($value) {
            case 'today':
                return Appointment::whereDate('appt_date', getToday())->count() ?? 0;
                break;
            case 'tomorrow':
                return Appointment::whereDate('appt_date', getTomorrow())->count() ?? 0;
                break;
            case 'forApproval':
                $ac = Ac::where('status', true)->first();
                return Appointment::where('appointment_category_id', $ac->id)->count() ?? 0;
                break;
            case 'ongoing':
                return 0;
                break;
            default;
        }

    }



    public function topdf()
    {
        $pdfContent = PDF::loadView('view', ['patients' => Patient::all()])->output();
            return response()->streamDownload(
                fn () => print($pdfContent),
                "filename.pdf"
            );
    }




    public function pdf()
    {

        return response()->streamDownload(function () {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->convert_customer_data_to_html());
            echo $pdf->stream();
        }, 'test.pdf');




    //  return $pdf->stream();
    }




    
    function convert_customer_data_to_html()
    {
        $patients = Patient::all();
        $output = '
        <h3 align="center">Customer Data</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
                <th style="border: 1px solid; padding:12px;" width="20%">Name</th>
                <th style="border: 1px solid; padding:12px;" width="30%">Address</th>
                <th style="border: 1px solid; padding:12px;" width="15%">City</th>
                <th style="border: 1px solid; padding:12px;" width="15%">Postal Code</th>
                <th style="border: 1px solid; padding:12px;" width="20%">Country</th>
            </tr>
        ';  
        foreach($patients as $patient)
        {
            $output .= '
            <tr>
                <td style="border: 1px solid; padding:12px;">'.$patient->patient_fname.'</td>
                <td style="border: 1px solid; padding:12px;">'.$patient->patient_lname.'</td>
                <td style="border: 1px solid; padding:12px;">'.$patient->patient_address.'</td>
                <td style="border: 1px solid; padding:12px;">'.$patient->patient_age.'</td>
                <td style="border: 1px solid; padding:12px;">'.$patient->patient_mname.'</td>
            </tr>
            ';
        }
        $output .= '</table>';
        return $output;
    }












}
