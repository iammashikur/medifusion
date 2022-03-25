<?php

namespace App\DataTables;

use App\Models\Hospital;
use App\Models\HospitalReceive;
use App\Models\PatientTest;
use App\Models\PatientTestItem;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class HospitalReceiveDataTable extends DataTable
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
                return '৳ '.currentBalance('hospital_to_medic' , $action->id);
            })

            ->addColumn('tests', function ($action) {
                $data = PatientTestItem::where(['hospital_id' => $action->id])->get();
                $count = 0;
                foreach ($data as $value) {
                    $count += PatientTest::where(['id' => $value->patient_test_id, 'status_id' => 1])->count();
                }

                return $count;

            })



            ->rawColumns(['pending_balance','tests',]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HospitalReceive $model
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
                    ->setTableId('hospitalreceive-table')
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
            Column::make('tests'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'HospitalReceive_' . date('YmdHis');
    }
}
