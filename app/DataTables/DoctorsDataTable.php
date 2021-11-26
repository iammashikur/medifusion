<?php

namespace App\DataTables;

use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DoctorsDataTable extends DataTable
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
            ->addColumn('image', function($image){

                $url=asset("/uploads/images/$image->avatar");
                return '<img src='.$url.' border="0" width="100" class="img-rounded" align="center" />';


            })
            ->addColumn('specialization', function(Doctor $doctor){
                return $doctor->getSpecialization->specialization;
            })


            ->addColumn('action', function($action){
                return '<a class="btn-sm btn-primary" href="'.route('doctor.edit', $action->id).'"><i class="far fa-edit"></i></a>
                        <a class="btn-sm btn-danger delete" href="'.route('doctor.destroy', $action->id).'"><i class="far fa-trash-alt"></i></a>';
            })

           ->rawColumns(['image', 'specialization', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Doctor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Doctor $model)
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
                    ->setTableId('doctors-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('print'),
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

            Column::make('id')->width('20'),

            Column::make('name')->width('100'),
            Column::make('specialization')->width('20'),
            Column::make('qualification')->width('20'),
            Column::make('image')->width('50'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(30)
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
        return 'Doctors_' . date('YmdHis');
    }
}
