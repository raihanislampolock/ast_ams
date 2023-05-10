<?php

namespace App\Admin\Controllers;

use App\Models\Vendor;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VendorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Vendor';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Vendor());

        $grid->column('id', __('Id'));
        $grid->column('company_name', __('Company name'));
        $grid->column('company_address', __('Company address'));
        $grid->column('poc_name', __('Poc name'));
        $grid->column('poc_number', __('Poc number'));
        $grid->column('poc_email', __('Poc email'));
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
        $show = new Show(Vendor::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_name', __('Company name'));
        $show->field('company_address', __('Company address'));
        $show->field('poc_name', __('Poc name'));
        $show->field('poc_number', __('Poc number'));
        $show->field('poc_email', __('Poc email'));
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
        $form = new Form(new Vendor());

        $form->text('company_name', __('Company name'));
        $form->text('company_address', __('Company address'));
        $form->text('poc_name', __('Poc name'));
        $form->text('poc_number', __('Poc number'));
        $form->text('poc_email', __('Poc email'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);
        
        return $form;
    }
}
