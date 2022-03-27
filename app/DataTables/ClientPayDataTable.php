<?php

namespace App\DataTables;

use App\Models\Appointment;
use App\Models\ClientPay;
use App\Models\Patient;
use App\Models\PatientTest;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class ClientPayDataTable extends DataTable
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

            ->addColumn('balance', function ($action) {
                return '৳ '.currentBalance('patient' , $action->id);
            })

            ->addColumn('alltime_balance', function ($action) {
                return '৳ '.alltimeBalance('patient' , $action->id);
            })

            ->addColumn('withdraw_balance', function ($action) {
                return '৳ '.withdrawBalance('patient' , $action->id);
            })

            ->addColumn('action', function ($action) {
                return '';
            })

            ->addColumn('appointments', function ($action) {
                return Appointment::where(['patient_id' => $action->id, 'status_id' => 5])->count();
            })

            ->addColumn('tests', function ($action) {
                return PatientTest::where(['patient_id' => $action->id, 'status_id' => 2])->count();
            })

            ->rawColumns([ 'action', 'balance','tests','appointments']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ClientPay $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Patient $model)
    {
        return Patient::whereNull('referred_by_id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('clientpay-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(

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

            Column::make('id')->width(50),
            Column::make('name'),


            Column::make('alltime_balance')->title('All-time Balance'),
            Column::make('withdraw_balance'),
            Column::make('balance')->title('Current Balance'),


            Column::make('appointments'),
            Column::make('tests'),
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(100)
            //       ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ClientPay_' . date('YmdHis');
    }
}
