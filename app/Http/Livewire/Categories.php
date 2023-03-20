<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $category_name, $selected_category_id, $updateCategoryMode = false;
    public $subcategory_name, $selected_subcategory_id, $parent_category = 0, $updateSubCategoryMode = false; 

    protected $listeners = [
        'resetModalForm',
        'deleteCategoryAction',
        'deleteSubCategoryAction',
        'updateCategoryOrdering',
        'updateSubCategoryOrdering'
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

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $this->dispatchBrowserEvent('deleteCategory', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>'.$category->category_name.'</b> category',
            'id' => $id,
        ]);
    }

    public function deleteCategoryAction($id)
    {
        $category = Category::where('id', $id)->first();
        $subcategories = SubCategory::where('parent_category', $category->id)->whereHas('posts')->with('posts')->get();

        if(!empty($subcategories) && count($subcategories) > 0) {
            $totalPosts = 0;

            foreach($subcategories as $subcat) {
                $totalPosts += Post::where('category_id', $subcat->id)->get()->count();
            }

            $this->dispatchBrowserEvent('error', ['message' => 'This category has ('.$totalPosts.') posts related to it, cannot be deleted']);

        } else {
            SubCategory::where('parent_category', $category->id)->delete();
            $category->delete();

            $this->dispatchBrowserEvent('success', ['message' => 'Category deleted succesfully.']);
        }
    }

    public function deleteSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        $this->dispatchBrowserEvent('deleteSubCategory', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>'.$subcategory->subcategory_name.'</b> subcategory',
            'id' => $id,
        ]);
    }

    public function deleteSubCategoryAction($id)
    {
        $subcategory = SubCategory::where('id', $id)->first();
        $posts = Post::where('category_id', $subcategory->id)->get()->toArray();

        if(!empty($posts) && count($posts) > 0) {
            $this->dispatchBrowserEvent('error', ['message' => 'This subcategory has ('.count($posts).') posts related to it, cannot be deleted']);
        } else {
            $subcategory->delete();
            $this->dispatchBrowserEvent('success', ['message' => 'SubCategory deleted succesfully.']);
        }
    }

    public function updateCategoryOrdering($positions)
    {
        // dd($positions);
        foreach($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            Category::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        $this->dispatchBrowserEvent('success', ['message' => 'Category ordering updated successfuly.']);
    }

    public function updateSubCategoryOrdering($positions)
    {
        // dd($positions);
        foreach($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            SubCategory::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        $this->dispatchBrowserEvent('success', ['message' => 'Sub Categories ordering updated successfuly.']);
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('ordering','asc')->get(),
            'subcategories' => SubCategory::orderBy('ordering', 'asc')->get()
        ]);
    }
}
