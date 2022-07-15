<?php

namespace App\DataTables;

use App\Models\TestPrice;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestPricesDataTable extends DataTable
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

            ->addColumn('hospital', function($testPrice){
                return @$testPrice->getHospital->name;
              })
            ->addColumn('category', function($testPrice){
                return $testPrice->getParent->getParent->name;
            })

            ->filterColumn('test', function ($testPrice, $keywords) {
                $testPrice->with('getParent')->whereHas('getParent', function($q , $keywords){
                    $q->where('name', 'LIKE', "%$keywords%");
                })->get();
             })

            ->addColumn('test', function($testPrice){
                return $testPrice->getParent->name;
            })


            ->addColumn('action', function($action){
                return '<a class="btn-sm btn-primary" href="'.route('test-price.edit', $action->id).'"><i class="far fa-edit"></i></a>
                        <a class="btn-sm btn-danger delete" href="'.route('test-price.destroy', $action->id).'"><i class="far fa-trash-alt"></i></a>';
            })
            ->rawColumns(['action', 'category', 'hospital', 'test']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TestPrice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TestPrice $model)
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
                    ->setTableId('testprices-table')
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
            Column::make('hospital'),
            Column::make('category'),
            Column::make('test'),
            Column::make('price'),
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
        return 'TestPrices_' . date('YmdHis');
    }
}
