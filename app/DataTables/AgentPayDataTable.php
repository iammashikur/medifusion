<?php

namespace App\DataTables;

use App\Models\Agent;
use App\Models\AgentAppointment;
use App\Models\AgentPay;
use App\Models\AgentTest;
use App\Models\Appointment;
use App\Models\PatientTest;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class AgentPayDataTable extends DataTable
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
                return currentBalance('agent' , $action->id). ' ৳';
            })

            ->addColumn('action', function ($action) {
                return '';
            })

            ->addColumn('appointments', function ($action) {

                $data =  AgentAppointment::where(['agent_id' => $action->id])->get();
                $count = 0;
                foreach ($data as $value) {
                    $count += Appointment::where(['id' => $value->id])->count();
                }

                return $count;

            })

            ->addColumn('tests', function ($action) {
                return AgentTest::where(['agent_id' => $action->id])->count();
            })

            ->rawColumns([ 'action', 'balance','tests','appointments']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AgentPay $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Agent $model)
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
                    ->setTableId('agentpay-table')
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
            Column::make('id')->width(50),
            Column::make('name'),
            Column::make('balance'),
            Column::make('appointments'),
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
        return 'AgentPay_' . date('YmdHis');
    }
}
