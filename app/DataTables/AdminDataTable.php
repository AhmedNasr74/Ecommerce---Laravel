<?php

namespace App\DataTables;

use App\Admin;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.admins.btn.checkbox')
            ->addColumn('edit', 'admin.admins.btn.edit')
            ->addColumn('delete', 'admin.admins.btn.delete')
            ->rawColumns([
                'edit', 'delete', 'checkbox',
            ]);
    }

    public function query()
    {
        return Admin::query()->where(function($q){
            return $q->where('id', '!=' , Admin()->user()->id);
        });
    }
    public static function lang()
    {
        $lang =
            [
            "sProcessing" => trans("admin.sProcessing"),
            "sLengthMenu" => trans("admin.sLengthMenu"),
            "sZeroRecords" => trans("admin.sZeroRecords"),
            "sEmptyTable" => trans("admin.sEmptyTable"),
            "sInfo" => trans("admin.sInfo"),
            "sInfoEmpty" => trans("admin.sInfoEmpty"),
            "sInfoFiltered" => trans("admin.sInfoFiltered"),
            "sInfoPostFix" => trans("admin.sInfoPostFix"),
            "sSearch" => trans("admin.sSearch"),
            "sUrl" => trans("admin.sUrl"),
            "sInfoThousands" => trans("admin.sInfoThousands"),
            "sLoadingRecords" => trans("admin.sLoadingRecords"),
            "oPaginate" => [
                "sFirst" => trans("admin.sFirst"),
                "sLast" => trans("admin.sLast"),
                "sNext" => trans("admin.sNext"),
                "sPrevious" => trans("admin.sPrevious"),
            ],
            "oAria" => [
                "sSortAscending" => trans("admin.sSortAscending"),
                "sSortDescending" => trans("admin.sSortDescending"),
            ],
        ];
        return $lang;
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
        // ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters());
    }
    protected function getBuilderParameters()
    {
        return [
            'language' => self::lang(),
            'dom' => 'Blfrtip',
            'lenghtMenu' => [[10, 25, 50, 100], [10, 25, 50, trans('admin.all_record')]],
            'buttons' => self::buttons(),
            'initComplete' => "function () {
                this.api().columns([2,3,4,5]).every(function () {
                    var column = this;
                    var input = document.createElement(\"input\");
                    $(input).attr('placeholder','" . trans("admin.sSearch") . "')
                    $(input).css({'padding':'3px'})
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                        column.search(val ? val : '', true, false).draw();
                    });
                });
            }",
        ];
    }
    protected function buttons()
    {
        return [
            ['className' => 'btn bg-navy  margin', 'text' => '<i class="fa fa-plus"></i> ' . trans('admin.add'),
            "action" => "function(){
                window.location.href = '".\URL::current()."/create';
            }"
            ],


            ['extend' => 'print', 'className' => 'btn btn-primary margin', 'text' => '<i class="fa fa-print"></i> ' . trans('admin.print')],
            ['extend' => 'csv', 'className' => 'btn btn-info margin', 'text' => '<i class="fa fa-file-excel-o"></i> ' . trans('admin.ex_csv')],
            ['extend' => 'excel', 'className' => 'btn btn-success margin', 'text' => '<i class="fa fa-file-excel-o"></i> ' . trans('admin.ex_xlsx')],
            ['extend' => 'pdf', 'className' => 'btn btn-default margin', 'text' => '<i class="fa fa-file-pdf-o"></i> ' . trans('admin.ex_pdf')],
            ['extend' => 'reload', 'className' => 'btn bg-olive btn-flat margin', 'text' => '<i class="fa fa-refresh"></i>'],
            [ 'data-toggle'=>"modal", 'data-target'=>"#multipleDelete" , 'text' => '<i class="fa fa-trash"></i>' , 'className' => 'btn btn-danger  delBtn margin'],
        ];
    }
    protected function getColumns()
    {
        return [
            [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input type="checkbox" class="check_all" onclick="check_all()"/>',
                'exportable' => false,
                'sortable' => false,
                'orderable' => false,
                'printable' => false,
                'searchable' => false,
            ],
            [
                'name' => 'id',
                'data' => 'id',
                'title' => '#',
            ],
            [
                'name' => 'name',
                'data' => 'name',
                'title' => trans('admin.Name'),
            ],
            [
                'name' => 'email',
                'data' => 'email',
                'title' => trans('admin.E-Mail'),
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => trans('admin.Created at'),
            ],
            [
                'name' => 'updated_at',
                'data' => 'updated_at',
                'title' => trans('admin.Updated at'),
            ],
            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('admin.edit'),
                'exportable' => false,
                'sortable' => false,
                'orderable' => false,
                'printable' => false,
                'searchable' => false,

            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('admin.delete'),
                'exportable' => false,
                'sortable' => false,
                'orderable' => false,
                'printable' => false,
                'searchable' => false,

            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}
