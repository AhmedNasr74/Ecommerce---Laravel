<?php
namespace App\DataTables;
use App\Model\Manufactures;
use Yajra\DataTables\Services\DataTable;

class ManuFactsDataTable extends DataTable {
	public function dataTable($query) {
		return datatables($query)
			->addColumn('checkbox', 'admin.manufactures.btn.checkbox')
			->addColumn('edit', 'admin.manufactures.btn.edit')
			->addColumn('delete', 'admin.manufactures.btn.delete')
			->rawColumns([
				'edit',
				'delete',
				'checkbox',
			]);
	}
	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query() {
		return Manufactures::query();
	}
	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
		            ->columns($this->getColumns())
			->minifiedAjax()
			->parameters([
				'dom'        => 'Blfrtip',
				'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, trans('admin.all_record')]],
				'buttons'    => [
					[
						'text' => '<i class="fa fa-plus"></i> '.trans('admin.add'), 'className' => 'btn btn-info', "action" => "function(){
							window.location.href = '".\URL::current()."/create';
						}"],
					['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"></i>'],
					['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"></i> '.trans('admin.ex_csv')],
					['extend' => 'excel', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-file"></i> '.trans('admin.ex_xlsx')],
					['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-refresh"></i>'],
					[
						'text' => '<i class="fa fa-trash"></i>', 'className' => 'btn btn-danger delBtn'],
				],
				'initComplete' => " function () {
		            this.api().columns([2,3,4,5]).every(function () {
		                var column = this;
		                var input = document.createElement(\"input\");
		                $(input).appendTo($(column.footer()).empty())
		                .on('keyup', function () {
		                    column.search($(this).val(), false, false, true).draw();
		                });
		            });
		        }",
				'language' => datatable_lang(),
			]);
	}
	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			[
				'name'       => 'checkbox',
				'data'       => 'checkbox',
				'title'      => '<input type="checkbox" class="check_all" onclick="check_all()" />',
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			], [
				'name'  => 'id',
				'data'  => 'id',
				'title' => '#',
			], [
				'name'  => 'name_ar',
				'data'  => 'name_ar',
				'title' => trans('admin.name_ar'),
			], [
				'name'  => 'name_en',
				'data'  => 'name_en',
				'title' => trans('admin.name_en'),
			], [
				'name'  => 'contact_name',
				'data'  => 'contact_name',
				'title' => trans('admin.contact_name'),
			],  [
				'name'  => 'mobile',
				'data'  => 'mobile',
				'title' => trans('admin.mobile'),
			], [
				'name'  => 'email',
				'data'  => 'email',
				'title' => trans('admin.email'),
			],[
				'name'  => 'created_at',
				'data'  => 'created_at',
				'title' => trans('admin.created_at'),
			], [
				'name'  => 'updated_at',
				'data'  => 'updated_at',
				'title' => trans('admin.updated_at'),
			], [
				'name'       => 'edit',
				'data'       => 'edit',
				'title'      => trans('admin.edit'),
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			], [
				'name'       => 'delete',
				'data'       => 'delete',
				'title'      => trans('admin.delete'),
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			],
		];
	}
	protected function filename() {
		return 'manufactures_'.date('YmdHis');
	}
}
