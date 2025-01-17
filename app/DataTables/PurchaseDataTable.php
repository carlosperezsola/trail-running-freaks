<?php

namespace App\DataTables;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PurchaseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $showBtn = "<a href='" . route('admin_user.purchase.show', $query->id) . "' class='btn btn-primary'><i class='far fa-eye'></i></a>";
                $deleteBtn = "<a href='" . route('admin_user.purchase.destroy', $query->id) . "' class='btn btn-danger ml-2 mr-2 delete-item'><i class='far fa-trash-alt'></i></a>";

                return $showBtn . $deleteBtn;
            })
            ->addColumn('customer', function ($query) {
                return $query->user->name;
            })
            ->addColumn('amount', function ($query) {
                return $query->currency_icon . $query->amount;
            })
            ->addColumn('date', function ($query) {
                return date('d-M-Y', strtotime($query->created_at));
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status === 1) {
                    return "<span class='badge bg-success text-white'>Complete</span>";
                } else {
                    return "<span class='badge bg-warning text-white'>Pending</span>";
                }
            })
            ->addColumn('purchase_status', function ($query) {
                switch ($query->purchase_status) {
                    case 'pending':
                        return "<span class='badge bg-warning text-white'>Pending</span>";
                        break;
                    case 'processed_and_ready_to_ship':
                        return "<span class='badge bg-info text-white'>Processed</span>";
                        break;
                    case 'dropped_off':
                        return "<span class='badge bg-info text-white'>Dropped off</span>";
                        break;
                    case 'shipped':
                        return "<span class='badge bg-info text-white'>Shipped</span>";
                        break;
                    case 'out_for_delivery':
                        return "<span class='badge bg-primary text-white'>Out for delivery</span>";
                        break;
                    case 'delivered':
                        return "<span class='badge bg-success text-white'>Delivered</span>";
                        break;
                    case 'canceled':
                        return "<span class='badge bg-danger text-white'>Canceled</span>";
                        break;
                    default:
                        break;
                }
            })
            ->rawColumns(['purchase_status', 'action', 'payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Purchase $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('purchase-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])

            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('invoice_id'),
            Column::make('customer'),
            Column::make('date'),
            Column::make('product_qty'),
            Column::make('amount'),
            Column::make('purchase_status'),
            Column::make('payment_status'),
            Column::make('payment_method'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Purchase_' . date('YmdHis');
    }
}
