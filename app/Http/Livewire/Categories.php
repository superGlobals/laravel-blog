<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $category_name, $selected_category_id, $updateCategoryMode = false;
    public $subcategory_name, $selected_subcategory_id, $parent_category, $updateSubCategoryMode = false; 

    protected $liesteners = [
        'resetModalForm'
    ];  

    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->category_name = null;
        $this->subcategory_name = null;
        $this->parent_category = null;
        
    }

    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        $category = new Category();
        $category->category_name = $this->category_name;
        $save = $category->save();

        if($save) {
            $this->dispatchBrowserEvent('hideCategoriesModal');
            $this->category_name = null;
            $this->dispatchBrowserEvent('success', ['message' => 'Category added succesfully.']);
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Something went wrong.']);
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showCategoriesModal');
    }

    public function updateCategory()
    {
        if($this->selected_category_id) {
            $this->validate([
                'category_name' => 'required|unique:categories,category_name,'.$this->selected_category_id
            ]);

            $category = Category::findOrFail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $updated = $category->save();

            if($updated) {
                $this->dispatchBrowserEvent('hideCategoriesModal');
                $this->category_name = null;
                $this->updateCategoryMode = false;
                $this->dispatchBrowserEvent('success', ['message' => 'Category updated succesfully.']);
            } else {
                $this->dispatchBrowserEvent('error', ['message' => 'Something went wrong.']);
            }

        }
    }

    /**  */
    public function addSubCategory()
    {
        $this->validate([
            'parent_category' => 'required',
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name'
        ]);

        $subcategory =  new SubCategory();
        $subcategory->subcategory_name = $this->subcategory_name;
        $subcategory->slug = Str::slug($this->subcategory_name);
        $subcategory->parent_category = $this->parent_category;
        $save = $subcategory->save();

        if($save) {
            $this->dispatchBrowserEvent('hideSubCategoriesModal');
            $this->subcategory_name = null;
            $this->parent_category = null;
            $this->dispatchBrowserEvent('success', ['message' => 'SubCategory added succesfully.']);
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Something went wrong.']);
        }
    }

    public function editSubCategory($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $this->selected_subcategory_id = $subcategory->id;
        $this->parent_category = $subcategory->parent_category;
        $this->subcategory_name = $subcategory->subcategory_name;
        $this->updateSubCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showSubCategoriesModal');
    }

    public function updateSubCategory()
    {
        if($this->selected_subcategory_id) {
            $this->validate([
                'parent_category' => 'required',
                'subcategory_name' => 'required|unique:sub_categories,subcategory_name,'.$this->selected_subcategory_id
            ]);

            $subcategory = SubCategory::findOrFail($this->selected_subcategory_id);
            $subcategory->subcategory_name = $this->subcategory_name;
            $subcategory->slug = Str::slug($this->subcategory_name);
            $subcategory->parent_category = $this->parent_category;
            $update = $subcategory->save();

            if($update) {
                $this->dispatchBrowserEvent('hideSubCategoriesModal');
                $this->updateSubCategoryMode = false;
                $this->dispatchBrowserEvent('success', ['message' => 'SubCategory updated succesfully.']);
            } else {
                $this->dispatchBrowserEvent('error', ['message' => 'Something went wrong.']);
            }
        }
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('ordering','asc')->get(),
            'subcategories' => SubCategory::orderBy('ordering', 'asc')->get()
        ]);
    }
}
