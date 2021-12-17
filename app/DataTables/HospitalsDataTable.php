<?php

namespace App\DataTables;

use App\Models\Hospital;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HospitalsDataTable extends DataTable
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
            ->addColumn('action', function ($action) {
                return '<a class="btn-sm btn-primary" href="' . route('hospital.edit', $action->id) . '"><i class="far fa-edit"></i></a>
                        <a class="btn-sm btn-danger delete" href="' . route('hospital.destroy', $action->id) . '"><i class="far fa-trash-alt"></i></a>';
            })

            ->addColumn('created_at', function ($created_at) {
                return Carbon::parse($created_at->created_at)->format('Y-m-d  H:i a');
            })

            ->rawColumns(['action', 'hospitals', 'created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hospital $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Hospital $model)
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
            ->setTableId('hospitals-table')
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
            Column::make('name')->title('Hospital Name'),
            Column::make('address'),
            Column::make('phone'),
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
        return 'Hospitals_' . date('YmdHis');
    }
}
