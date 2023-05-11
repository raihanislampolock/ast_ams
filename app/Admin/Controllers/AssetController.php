<?php

namespace App\Admin\Controllers;

use App\Models\Asset;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AssetController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Asset';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Asset());

        $grid->column('id', __('Id'));
        
        $grid->AssetTypefk()->asset_type_name('Asset Name');
        $grid->AssetModelfk()->model_name('Model');
        $grid->column('asset_configuration', __('Asset configuration'));
        $grid->column('asset_sn_number', __('Asset sn number'));
        $grid->Departmentfk()->name('Department Name');
        $grid->Employeefk()->emp_id('Employee ID');
        $grid->Employeefk()->emp_name('Employee Name');
        $grid->column('assign_date', __('Assign date'));
        $grid->column('tagging_code', __('Tagging code'));
        $grid->AssetLocationfk()->asset_location('Asset Location');
        $grid->Vendorfk()->company_name('Vendor Name');
        $grid->AssetTransactionsfk()->asset_price('Asset Price');
        $grid->Manufacturerfk()->name('Manufacturer Name');
        $grid->column('servicing_date', __('Servicing date'));
        $grid->column('remarks', __('Remarks'));
        $grid->column('cd', __('Cd'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Asset::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('asset_type_id', __('Asset type id'));
        $show->field('asset_model_id', __('Asset model id'));
        $show->field('asset_configuration', __('Asset configuration'));
        $show->field('asset_sn_number', __('Asset sn number'));
        $show->field('department_id', __('Department id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('assign_date', __('Assign date'));
        $show->field('tagging_code', __('Tagging code'));
        $show->field('asset_location_id', __('Asset location id'));
        $show->field('vendor_id', __('Vendor id'));
        $show->field('asset_transactions_id', __('Asset transactions id'));
        $show->field('manufacturer_id', __('Manufacturer id'));
        $show->field('servicing_date', __('Servicing date'));
        $show->field('remarks', __('Remarks'));
        $show->field('cb', __('Cb'));
        $show->field('cd', __('Cd'));
        $show->field('ub', __('ub'));
        $show->field('ud', __('ud'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Asset());

        $AssetType = \App\Models\Asset_Type::pluck('asset_type_name', 'id')->toArray();
        $form->select('asset_type_id', __('Asset Type'))->options($AssetType);
        
        $Model = \App\Models\Asset_Model::pluck('model_name', 'id')->toArray();
        $form->select('asset_model_id', __('Model Name'))->options($Model);
        
        $form->text('asset_configuration', __('Asset configuration'));
        $form->text('asset_sn_number', __('Asset sn number'));

        $Department = \App\Models\Department_Name::pluck('name', 'id')->toArray();
        $form->select('department_id', __('Department Name'))->options($Department);

        $Emp = \App\Models\Employee::all()->map(function ($emp) {
            return [
                'id' => $emp->id,
                'label' => "{$emp->emp_id} - {$emp->emp_name}",
            ];
        })->pluck('label', 'id')->toArray();
        $form->select('employee_id', __('Employee ID & Name'))->options($Emp);

        $form->date('assign_date', __('Assign date'))->default(date('Y-m-d'));
        $form->textarea('tagging_code', __('Tagging code'));

        $Loc = \App\Models\Asset_Location::pluck('asset_location', 'id')->toArray();
        $form->select('asset_location_id', __('Asset Location'))->options($Loc);

        $Vendor = \App\Models\Vendor::pluck('company_name', 'id')->toArray();
        $form->select('vendor_id', __('Vendor Name'))->options($Vendor);

        $tran = \App\Models\Asset_Transactions::pluck('asset_price', 'id')->toArray();
        $form->select('asset_transactions_id', __('Asset Price'))->options($tran);

        $Manu = \App\Models\Manufacturer::pluck('name', 'id')->toArray();
        $form->select('manufacturer_id', __('Manufacturer'))->options($Manu);
        $form->date('servicing_date', __('Servicing date'))->default(date('Y-m-d'));
        $form->text('remarks', __('Remarks'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
