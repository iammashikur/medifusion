<?php

namespace App\DataTables;

use App\Models\Agent;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\PatientTest;
use App\Models\Transaction;
use App\Models\Wallet;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class TransactionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('user_type', function ($query) {
                return $query->user_type;
            })

            ->filterColumn('account_holder_name', function ($query, $keywords) {

                switch ($query->user_type) {
                    case 'medic':
                        return 'Medic';
                        break;
                    case 'hospital':
                        $query->with('getHospital')->whereHas('getHospital', function($q) use($keywords){
                            $q->where('name', 'LIKE', "%$keywords%");
                        })->get();
                        break;
                    case 'patient':
                        $query->with('getUser')->whereHas('getUser', function($q) use($keywords){
                            $q->where('name', 'LIKE', "%$keywords%");
                        })->get();
                        break;
                    case 'agent':
                        $query->with('getAgent')->whereHas('getAgent', function($q) use($keywords){
                            $q->where('name', 'LIKE', "%$keywords%");
                        })->get();
                        break;
                    case 'doctor':
                        $query->with('getDoctor')->whereHas('getDoctor', function($q) use($keywords){
                            $q->where('name', 'LIKE', "%$keywords%");
                        })->get();
                        break;

                    default:
                        # code...
                        break;
                }



            })

            ->addColumn('account_holder_name', function ($query) {
                switch ($query->user_type) {
                    case 'medic':
                        return 'Medic';
                        break;
                    case 'hospital':
                        return @Hospital::find($query->user_id)->name;
                        break;
                    case 'patient':
                        return @Patient::find($query->user_id)->name;
                        break;
                    case 'agent':
                        return @Agent::find($query->user_id)->name;
                        break;
                    case 'doctor':
                        return @Doctor::find($query->user_id)->name;
                        break;

                    default:
                        # code...
                        break;
                }
            })

            ->addColumn('source', function ($query){
                if ($query->appointment_id) {
                    if (Appointment::find($query->appointment_id)->by_agent) {
                        return 'Agent Appointment: '.$query->appointment_id;
                    }
                    return 'Appointment: '.$query->appointment_id;
                }else if ($query->test_id) {
                    if (PatientTest::find($query->test_id)->by_agent) {
                        return 'Agent Test: '.$query->test_id;
                    }
                    return 'Test: '.$query->test_id;
                }else{
                    return 'Agent Withdraw';
                }
            })

            ->addColumn('transaction_type', function ($query) {
                return $query->transaction_type == '-' ? 'Debit' : 'Credit';
            })

            ->rawColumns(['user_type', 'account_holder_name', 'transaction_type']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Wallet $model)
    {
        return Wallet::where(['status' => 1]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('transaction-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('user_type'),
            Column::make('account_holder_name'),
            Column::make('transaction_type'),
            Column::make('amount'),
            Column::make('source'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Transaction_' . date('YmdHis');
    }
}
