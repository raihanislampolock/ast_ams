<?php

namespace App\Admin\Controllers;

use App\Models\Asset_Transactions;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AssetTransactionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Asset_Transactions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Asset_Transactions());

        $grid->column('id', __('Id'));
        $grid->Modelfk()->model_name('Asset Model');
        $grid->column('asset_price', __('Asset price'));
        $grid->column('asset_purchase_date', __('Asset purchase date'));
        $grid->column('asset_purchase_order', __('Asset purchase order'));
        $grid->column('asset_warranty_date', __('Asset warranty date'));
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
        $show = new Show(Asset_Transactions::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('asset_model_id', __('Asset model id'));
        $show->field('asset_price', __('Asset price'));
        $show->field('asset_purchase_date', __('Asset purchase date'));
        $show->field('asset_purchase_order', __('Asset purchase order'));
        $show->field('asset_warranty_date', __('Asset warranty date'));
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
        $form = new Form(new Asset_Transactions());

        $Model = \App\Models\Asset_Model::pluck('model_name', 'id')->toArray();
        $form->select('asset_model_id', __('Asset Model Name'))->options($Model);
        $form->text('asset_price', __('Asset price'));
        $form->date('asset_purchase_date', __('Asset purchase date'))->default(date('Y-m-d'));
        $form->text('asset_purchase_order', __('Asset purchase order'));
        $form->date('asset_warranty_date', __('Asset warranty date'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
