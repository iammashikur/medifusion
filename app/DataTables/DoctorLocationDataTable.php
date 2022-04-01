<?php

namespace App\DataTables;

use App\Models\DoctorLocation;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class DoctorLocationDataTable extends DataTable
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
            ->addColumn('doctor', function($query){
                return @$query->getDoctor->name;
              })

              ->addColumn('start_time', function($query){
                return Carbon::parse($query->start_time)->format('h:i:s A');
              })

              ->addColumn('end_time', function($query){
                return Carbon::parse($query->end_time)->format('h:i:s A');
              })

              ->addColumn('district', function ($created_at) {
                return $created_at->getDistrict->name;
            })

            ->addColumn('thana', function ($created_at) {
                return $created_at->getThana->name;
            })

              ->addColumn('address', function($query){
                return @$query->getHospital->name;
              })
              ->addColumn('action', function($query){
                return '<a class="btn-sm btn-primary" href="'.route('doctor-location.edit', $query->id).'"><i class="far fa-edit"></i></a>
                        <a class="btn-sm btn-danger delete" href="'.route('doctor-location.destroy', $query->id).'"><i class="far fa-trash-alt"></i></a>';
            })
            ->rawColumns(['doctor', 'address', 'action', 'start_time', 'end_time']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DoctorLocation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DoctorLocation $model)
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
                    ->setTableId('doctorlocation-table')
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
            Column::make('doctor'),
            Column::make('address'),
            Column::make('start_time'),
            Column::make('end_time'),
            Column::make('consultation_fee'),
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
        return 'DoctorLocation_' . date('YmdHis');
    }
}
