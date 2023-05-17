<?php

namespace App\Admin\Controllers;

use App\Models\Asset_Tracking;
use App\Models\Asset_Model;
use App\Models\Asset_Type;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
Use Encore\Admin\Admin;
use Illuminate\Http\Request;

class AssetTrackingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Asset Tracking';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Asset_Tracking());

        $grid->column('id', __('Id'));
        $grid->Departmentfk()->name('Department');
        $grid->Employeefk()->emp_id('Employee ID');
        $grid->Employeefk()->emp_name('Employee Name');

        $grid->SNNumberfk()->asset_sn_number('Asset SN Number');
        $grid->column('SNNumberfk.asset_model_id', 'Asset Model')->display(function ($asset_model_id)
        {
            $assetModel = Asset_Model::find($asset_model_id);
            $model_name = $assetModel->model_name??'N/A';
            $assetType = Asset_Type::find($assetModel->asset_type_id);
            $asset_type_name = $assetType->asset_type_name ??'N/A';

        $grid->SNNumberfk()->asset_sn_number('Asset SN');
        $grid->column('SNNumberfk.asset_model_id','Asset Model')->display(function ($asset_model_id ) {
            $assetModel=Asset_Model::find($asset_model_id);
             $model_name=$assetModel->model_name??'N/A';
             $assetType=Asset_Type::find($assetModel->asset_type_id);
            $asset_type_name =$assetType->asset_type_name ??'N/A';           

            
            return $model_name.' ( '.$asset_type_name.')';
        });

        $grid->addColumn('Department & Tagging')->display(function ()
        {
            $department = $this->Departmentfk->short_name;
            $taggingCode = $this->SNNumberfk->tagging_code;
            return $department . '-' . $taggingCode;
        });
    
        $grid->column('assign_date', __('Assign date'));
        
        $grid->addColumn('Department & Tagging', 'Department & Tagging Marge')->display(function ()
        {
            $department = $this->Departmentfk->short_name;
            $taggingCode = $this->SNNumberfk->tagging_code;
            return $department . '-' . $taggingCode;});
        
        $grid->AssetLocationfk()->asset_location('Asset Location');        
        $grid->column('assign_date', __('Assign date'));
        $grid->column('remarks', __('Remarks'));
        $grid->SNNumberfk()->mac_address('Mac Address');

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
        $show = new Show(Asset_Tracking::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('department_id', __('Department id'));
        $show->field('emp_id', __('Emp id'));
        $show->field('asset_id', __('Asset id'));
        $show->field('assign_date', __('Assign date'));
        $show->field('asset_location_id', __('Asset location id'));
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
        $form = new Form(new Asset_Tracking());

        $Department = \App\Models\Department_Name::pluck('name', 'id')->toArray();
        $form->select('department_id', __('Department Name'))->options($Department);

        $Emp = \App\Models\Employee::all()->map(function ($emp) {
            return [
                'id' => $emp->id,
                'label' => "{$emp->emp_id} - {$emp->emp_name}",
            ];
        })->pluck('label', 'id')->toArray();
        $form->select('emp_id', __('Employee ID & Name'))->options($Emp);

        $AssetTypes = \App\Models\Asset_Type::all();
        
        $Type = [];
        foreach ($AssetTypes as $assetType) {
            $Type[$assetType->id] = $assetType->asset_type_name;
        }
        
        $form->select('asset_type_id', __('Asset Type'))->options($Type)->load('asset_id', '/admin/get-sn');

        $SNNumber = [];
        $submittedSNNumbers = Asset_Tracking::pluck('asset_id')->toArray();
        
        $Assets = \App\Models\Asset::all();

        foreach ($Assets as $asset) {
            $SNNumber[$asset->id] = $asset->asset_sn_number . ' (' . $asset->AssetModelfk->model_name . ')';
        }
        $filteredSNNumber = array_diff_key($SNNumber, array_flip($submittedSNNumbers));

        $form->select('asset_id', __('SN Number'))->options($filteredSNNumber);

        $Loc = \App\Models\Asset_Location::pluck('asset_location', 'id')->toArray();
        $form->select('asset_location_id', __('Asset Location'))->options($Loc);

        $form->date('assign_date', __('Assign date'))->default(date('Y-m-d'));
      
        $form->text('remarks', __('Remarks'));

        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);
        $form->submitted(function (Form $form) {
            $form->ignore('asset_type_id');
        });

        return $form;
    }

    public function getSn(Request $request) {
        $assetTypeId = $request->get('q');
        $sns = \App\Models\Asset::where('asset_type_id', $assetTypeId)->get();
        // dd($sns);
        $SNNumber = [];
        $submittedSNNumbers = Asset_Tracking::pluck('asset_id')->toArray();
        foreach ($sns as $sn) {
            $SNNumber[$sn->id] = $sn->asset_sn_number . ' (' . $sn->AssetModelfk->model_name . ')';
        }
        $filteredSNNumber = array_diff_key($SNNumber, array_flip($submittedSNNumbers));
        $filteredSNNumber=$this->formatCascading($filteredSNNumber);
        return $filteredSNNumber;
    }

    public function formatCascading($data=[]){
        $response=[];
        foreach ($data as $key => $value) {
            $response[]=['id'=>$key,'text'=>$value];
        
        }

        return $response;
        
    }
}
