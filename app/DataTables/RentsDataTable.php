<?php

namespace App\DataTables;

use App\Models\Rent;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user', function (Rent $rent) {
                return $rent->user->name;
            })
            ->addColumn('car', function (Rent $rent) {
                return $rent->car->name; // Adjust this to the correct field in your Car model
            })
            ->addColumn('pj_satu', function (Rent $rent) {
                return $rent->pjSatu->name;
            })
            ->addColumn('pj_dua', function (Rent $rent) {
                return $rent->pjDua->name;
            })
            ->addColumn('status', function (Rent $rent) {
                if ($rent->status == 0) {
                    return '<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">Diproses</span>';
                }elseif ($rent->status == 1) {
                    return '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Menunggu Persetujuan</span>';
                }elseif ($rent->status == 4) {
                    return '<span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">Dikembalikan</span>';
                }elseif ($rent->status == 2) {
                    return '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Disetujui</span>';
                } else {
                    return '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Ditolak</span>';
                }
            })
            ->addColumn('action', 'rents.action')
            ->setRowId('id')
            ->rawColumns(['status', 'action']); // Add rawColumns to avoid escaping HTML
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Rent $model): QueryBuilder
    {
        return $model->newQuery()->with(['user', 'car', 'pjSatu', 'pjDua']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('rents-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['copy', 'csv', 'excel', 'pdf', 'print'],
            ])
            ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('user')->title('Driver'),
            Column::make('car')->title('Car'),
            Column::make('pj_satu')->title('PJ Satu'),
            Column::make('pj_dua')->title('PJ Dua'),
            Column::make('start_date')->title('Start Date'),
            Column::make('end_date')->title('End Date'),
            Column::make('status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Rents_' . date('YmdHis');
    }
}
