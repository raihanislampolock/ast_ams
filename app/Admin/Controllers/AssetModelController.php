<?php

namespace App\Admin\Controllers;

use App\Models\Asset_Model;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AssetModelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Asset_Model';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Asset_Model());

        $grid->column('id', __('Id'));
        $grid->AssetTypefk()->asset_type_name('Asset Type');
        $grid->Manufacturerfk()->name('Manufacturer Name');
        $grid->Vendorfk()->company_name('Vendor Name');
        $grid->column('model_name', __('Model name'));
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
        $show = new Show(Asset_Model::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('asset_type_id', __('Asset type id'));
        $show->field('manufacturer_id', __('Manufacturer id'));
        $show->field('vendor_id', __('Vendor id'));
        $show->field('model_name', __('Model name'));
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
        $form = new Form(new Asset_Model());

        $Type = \App\Models\Asset_Type::pluck('asset_type_name', 'id')->toArray();
        $form->select('asset_type_id', __('Asset Type'))->options($Type);

        $Manuf = \App\Models\Manufacturer::pluck('name', 'id')->toArray();
        $form->select('manufacturer_id', __('Manufacturer'))->options($Manuf);

        $Vendor = \App\Models\Vendor::pluck('company_name', 'id')->toArray();
        $form->select('vendor_id', __('Vendor'))->options($Vendor);

        $form->text('model_name', __('Model name'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
