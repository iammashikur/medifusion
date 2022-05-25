<?php

namespace App\DataTables;

use App\Models\user;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class userDataTable extends DataTable
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
            ->addColumn('role', function ($query) {
                $user = User::find($query->id);
                $userRole = $user->roles->pluck('name', 'name')->all();

                $badge = '';
                foreach ($userRole as $key => $value) {
                    $badge .= '<span class="badge badge-primary">' . $value . '</span>';
                }

                return $badge;
            })
            ->addColumn('action', function ($query) {
                return '<a class="btn-sm btn-primary" href="' . route('users.edit', $query->id) . '"><i class="far fa-edit"></i></a>
                        <a class="btn-sm btn-danger delete" href="' . route('users.destroy', $query->id) . '"><i class="far fa-trash-alt"></i></a>';
            })
            ->rawColumns(['role', 'created_at', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\user $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(user $model)
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
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('reset'),

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
            Column::make('role'),
            Column::make('created_at')->title('Registration Date'),
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
        return 'user_' . date('YmdHis');
    }
}
