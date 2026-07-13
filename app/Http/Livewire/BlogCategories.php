<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BlogCategory;
use App\Models\BlogSubCategory;
use App\Models\Category;
use Illuminate\Support\Str;

class Categories extends Component
{
    //Category
    public $category_name;
    public $selected_category_id;
    public $updateCategoryMode = false;
    //Subcategory
    public $subcategory_name;
    public $parent_category;
    public $selected_subcategory_id;
    public $updatesubCategoryMode = false;

    protected $listeners = [
        'resetModalForms'
    ];
    public function resetModalForms()
    {
        $this->resetErrorBag();
        $this->parent_category = null;
        $this->subcategory_name = null;
            $this->category_name = null;
    }
    public function saveCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:blog_categories,category_name',
        ]);
        $category = new BlogCategory();
        $category->category_name = $this->category_name;
        $saved = $category->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideCategoryModal');
            $this->category_name = null;
            $this->showToaster('New Category Successfully Added', 'success');
        } else {
            $this->showToaster('Something went wrong', 'error');
        }
    }
    public function editcategory($id)
    {
        $category = BlogCategory::findOrfail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showEditCategoryModal');
    }
    public function updateCategory()
    {
        if ($this->selected_category_id) {
            $this->validate([
                'category_name' => 'required|unique:blog_categories,category_name,' . $this->selected_category_id,
            ]);
            $category = BlogCategory::findOrfail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $updated = $category->save();
            if ($updated) {
                $this->dispatchBrowserEvent('hideCategoryModal');
                $this->updateCategoryMode = false;
                $this->showToaster('Category has been updated Successfully', 'success');
            } else {
                $this->showToaster('Something went wrong', 'error');
            }
        }
    }
    //SubCategory
    public function saveSubCategory()
    {
        $this->validate([
            'parent_category' => 'required',
            'subcategory_name' => 'required|unique:blog_sub_categories,subcategory_name',
        ]);
        $subcategory = new BlogSubCategory();
        $subcategory->parent_category = $this->parent_category;
        $subcategory->subcategory_name = $this->subcategory_name;
        $subcategory->slug = Str::slug($this->subcategory_name);
        $saved = $subcategory->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideSubCategoryModal');
            $this->parent_category = null;
            $this->subcategory_name = null;
            $this->showToaster('New Subcategory Successfully Added', 'success');
        } else {
            $this->showToaster('Something went wrong', 'error');
        }
    }
    //editsubcategory
    public function editsubcategory($id)
    {
        $subcategory = BlogSubCategory::findOrfail($id);
        $this->selected_subcategory_id = $subcategory->id;
        $this->parent_category = $subcategory->parent_category;
        $this->subcategory_name = $subcategory->subcategory_name;
        $this->updatesubCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showEditSubCategoryModal');
    }
    //updateSubCategory
    public function updateSubCategory()
    {
        if ($this->selected_subcategory_id) {
            $this->validate([
                'parent_category' => 'required',
                'subcategory_name' => 'required|unique:blog_sub_categories,subcategory_name,' . $this->selected_subcategory_id,
            ]);
            $subcategory = BlogSubCategory::findOrfail($this->selected_subcategory_id);
            $subcategory->parent_category = $this->parent_category;
            $subcategory->subcategory_name = $this->subcategory_name;
            $updated = $subcategory->save();
            if ($updated) {
                $this->dispatchBrowserEvent('hideSubCategoryModal');
                $this->updatesubCategoryMode = false;
                $this->showToaster('Sub Category has been updated Successfully', 'success');
            } else {
                $this->showToaster('Something went wrong', 'error');
            }
        }
    }
    public function showToaster($message, $type)
    {
        return $this->dispatchBrowserEvent('showToaster', [
            'type' => $type,
            'message' => $message
        ]);
    }
    public function render()
    {
        return view('livewire.categories', [
            'categories' => BlogCategory::orderBy('ordering', 'asc')->get(),
            'subcategories' => BlogSubCategory::orderBy('ordering', 'asc')->get()
        ]);
    }
}
