<?php

namespace App\DataTables;

use App\Models\Agent;
use App\Models\AgentWithdraw;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class AgentWithdrawDataTable extends DataTable
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

            ->addColumn('action', 'agentwithdraw.action')






            ->addColumn('agent_name', function ($query) {
                return @Agent::find($query->agent_id)->name;
            })

            ->addColumn('action', function ($action) {
                return '<a class="btn-sm btn-primary" href="' . route('agent-withdraw.edit', $action->id) . '"><i class="far fa-edit"></i></a>';
            })

            ->addColumn('status', function ($query) {
                switch ($query->status) {
                    case 1:
                        return 'Pending';
                        break;

                    case 2:
                        return 'Denied';
                        break;

                    case 3:
                        return 'Completed';
                        break;

                    case 4:
                        return 'Cancelled';
                        break;

                    default:
                        # code...
                        break;
                }
            })

            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AgentWithdraw $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AgentWithdraw $model)
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
            ->setTableId('agentwithdraw-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(


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
            Column::make('agent_name'),
            Column::make('withdraw_method'),
            Column::make('account_details'),
            Column::make('amount')->title('Requested Amount'),
            Column::make('trx_id'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'AgentWithdraw_' . date('YmdHis');
    }
}
