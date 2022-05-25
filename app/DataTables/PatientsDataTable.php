<?php

namespace App\DataTables;

use App\Models\Patient;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PatientsDataTable extends DataTable
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

            ->addColumn('birth_date', function ($created_at) {
                return Carbon::parse($created_at->birth_date)->format('Y-m-d');
            })

            ->addColumn('district', function ($created_at) {
                return $created_at->getDistrict->name;
            })


            ->addColumn('thana', function ($created_at) {
                return $created_at->getThana->name;
            })

            ->addColumn('status', function ($query) {
                $status = $query->status;
                if ($status == '0') {
                    return '<a href="'.route('user.unban',['id' => $query->id]).'" class="btn btn-danger btn-sm">  Banned </a>';
                }
                else{
                    return '<a href="'.route('user.ban',['id' => $query->id]).'" class="btn btn-success btn-sm">  Active </a>';
                }
            })

            ->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Patient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Patient $model)
    {
        return Patient::where('referred_by_id' , null);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('patients-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(

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
            Column::make('birth_date'),
            Column::make('phone'),
            Column::make('district'),
            Column::make('thana'),
            Column::make('blood_group'),
            Column::make('status'),
            Column::make('created_at')->title('Registration Date'),


        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Patients_' . date('YmdHis');
    }
}
