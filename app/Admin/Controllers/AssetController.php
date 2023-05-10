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
        $grid->column('asset_type_id', __('Asset type id'));
        $grid->column('asset_model_id', __('Asset model id'));
        $grid->column('asset_configuration', __('Asset configuration'));
        $grid->column('asset_sn_number', __('Asset sn number'));
        $grid->column('department_id', __('Department id'));
        $grid->column('employee_id', __('Employee id'));
        $grid->column('assign_date', __('Assign date'));
        $grid->column('tagging_code', __('Tagging code'));
        $grid->column('asset_location_id', __('Asset location id'));
        $grid->column('vendor_id', __('Vendor id'));
        $grid->column('asset_transactions_id', __('Asset transactions id'));
        $grid->column('manufacturer_id', __('Manufacturer id'));
        $grid->column('servicing_date', __('Servicing date'));
        $grid->column('remarks', __('Remarks'));
        $grid->column('cd', __('Cd'));

        $grid->model()->orderBy('id', 'desc');

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
        $show->field('ub', __('Ub'));
        $show->field('ud', __('Ud'));

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

        $form->number('asset_type_id', __('Asset type id'));
        $form->number('asset_model_id', __('Asset model id'));
        $form->text('asset_configuration', __('Asset configuration'));
        $form->text('asset_sn_number', __('Asset sn number'));
        $form->number('department_id', __('Department id'));
        $form->number('employee_id', __('Employee id'));
        $form->date('assign_date', __('Assign date'))->default(date('Y-m-d'));
        $form->textarea('tagging_code', __('Tagging code'));
        $form->number('asset_location_id', __('Asset location id'));
        $form->number('vendor_id', __('Vendor id'));
        $form->number('asset_transactions_id', __('Asset transactions id'));
        $form->number('manufacturer_id', __('Manufacturer id'));
        $form->date('servicing_date', __('Servicing date'))->default(date('Y-m-d'));
        $form->text('remarks', __('Remarks'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
