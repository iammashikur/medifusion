<?php

namespace App\DataTables;

use App\Models\Appointment;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AppointmentsDataTable extends DataTable
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
            ->addColumn('patient', function (Appointment $appointment) {

                return $appointment->getPatient->name;
            })
            ->addColumn('phone', function (Appointment $appointment) {

                return $appointment->getPatient->phone;
            })
            ->addColumn('doctor', function (Appointment $appointment) {
                return $appointment->getDoctor->name;
            })

            ->addColumn('serial', function (Appointment $appointment) {
                if ($appointment->serial == null) {
                    return 'pending';
                }
                return $appointment->serial;
            })

            ->addColumn('location', function ($query) {
                return $query->getLocation->name. '<br/>' . $query->getLocation->address;
            })

            ->addColumn('appointment_date', function (Appointment $appointment) {
                return Carbon::parse($appointment->appointment_date)->format('l jS \of F Y');
            })

            ->addColumn('appointment_time', function (Appointment $appointment) {
                return Carbon::parse($appointment->appointment_date)->format('h:i:s A');
            })

            ->addColumn('status', function (Appointment $appointment) {
                if ($appointment->status_id == 1) {
                    return '<button class="btn btn-warning btn-sm">' . $appointment->getStatus->status . '</button>';
                } else if ($appointment->status_id == 2) {
                    return '<button class="btn btn-primary btn-sm">' . $appointment->getStatus->status . '</button>';
                } else if ($appointment->status_id == 3) {
                    return '<button class="btn btn-success btn-sm">' . $appointment->getStatus->status . '</button>';
                } else {
                    return '<button class="btn btn-danger btn-sm">' . $appointment->getStatus->status . '</button>';
                }
            })


            ->addColumn('action', function ($action) {
                return '<a class="btn-sm btn-primary" href="' . route('appointment.edit', $action->id) . '"><i class="far fa-edit"></i> Edit</a>';
            })

            ->rawColumns(['patient', 'doctor', 'status', 'action', 'location']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Appointment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Appointment::where(['by_agent' => 0]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('appointments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('print')
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


            Column::make('id')->width('70'),
            Column::make('doctor')->width('70'),
            Column::make('patient')->width('70'),
            Column::make('phone')->width('70'),
            Column::make('location')->width('100'),
            Column::make('appointment_date')->width('70')->title('Date'),
            Column::make('appointment_time')->width('70')->title('Time'),
            Column::make('serial')->width('70')->title('Serial No.'),
            Column::make('status')->width('70'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')->width('70'),


        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Appointments_' . date('YmdHis');
    }
}
