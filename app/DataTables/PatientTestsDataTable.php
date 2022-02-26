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
            ->addColumn('created_at', function (Appointment $appointment) {
                return Carbon::parse($appointment->appointment_date)->format('l jS \of F Y h:i:s A');
            })
            ->addColumn('action', function ($action) {
                return '<a class="btn-sm btn-primary" href="' . route('appointment.edit', $action->id) . '"><i class="far fa-edit"></i> Edit</a>';
            })
            ->rawColumns(['created_at', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PatientTest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PatientTest $model)
    {
        return $model->newQuery();
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
