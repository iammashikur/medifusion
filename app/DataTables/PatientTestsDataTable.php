<?php

namespace App\DataTables;

use App\Models\PatientTest;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PatientTestsDataTable extends DataTable
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
            ->addColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->format('l jS \of F Y h:i:s A');
            })
            ->addColumn('patient', function ($query) {
                return $query->getPatient->name;
            })

            ->addColumn('tests', function ($query) {

                $tests = [];

            foreach($query->getItems as $item)
            {
                $tests[] = $item->test_name;
            }

            return $tests;


            })

            ->addColumn('status', function ($query) {
                return $query->getStatus->status;
            })

            ->addColumn('action', function ($action) {
                return '<a class="btn-sm btn-primary" href="' . route('patient-test.edit', $action->id) . '"><i class="fas fa-eye    "></i> View</a>';
            })

            ->rawColumns(['created_at', 'status',  'patient',  'tests', 'action']);
    }



    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PatientTest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PatientTest $model)
    {
        return $model->where(['by_agent' => 0]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('patienttests-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(

                        Button::make('reset'),

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
            Column::make('patient'),
            Column::make('tests'),
            Column::make('test_uid'),
            Column::make('status'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PatientTests_' . date('YmdHis');
    }
}
