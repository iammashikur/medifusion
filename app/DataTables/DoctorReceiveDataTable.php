<?php

namespace App\DataTables;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorReceive;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class DoctorReceiveDataTable extends DataTable
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
            ->addColumn('pending_balance', function ($action) {
                return  '৳ '.currentBalance('medic' , $action->id);
            })

            ->addColumn('action', function ($action) {
                return '';
            })

            ->addColumn('appointments_by_agent', function ($action) {


                $count = Appointment::where(['doctor_id' => $action->id, 'status_id' => 3, 'by_agent' => 1])->count();

                return $count;

            })

            ->addColumn('user_appointments', function ($action) {


                $count = Appointment::where(['doctor_id' => $action->id, 'status_id' => 3, 'by_agent' => 0])->count();

                return $count;

            })


            ->rawColumns([ 'action', 'pending_balance','user_appointments', 'appointments_by_agent']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DoctorReceive $model
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
                    ->setTableId('doctorreceive-table')
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
            Column::make('name'),
            Column::make('pending_balance'),
            Column::make('user_appointments'),
            Column::make('appointments_by_agent'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DoctorReceive_' . date('YmdHis');
    }
}
