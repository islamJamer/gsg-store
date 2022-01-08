<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Brian2694\Toastr\Facades\Toastr;

class CategoriesController extends Controller
{
    // CRUD: Create, Read, Update, Delete
    
    // 1. Read Action:
    public function index(){
        // SELECT * from categories
        // Return a collection 
        $title = 'Categories List';
        // $categories = Category::all(); 
        // dd($categories);
        // var_dump($categories);
        // dd($categories);

        // $categories= [
        //     'id' => 4,
        //     'name' => 'islam',
        //     'parent_id' => '123'
        // ];


        /* SELECT categories.*, parent.name as parent_name FROM `categories`
            LEFT JOIN `categories` as parent
            ON parent.id = categories.parent_id;
        */
        $categories = Category::leftJoin('categories as parent', 'parent.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parent.name as parent_name'
            ])
            ->orderBy('name') // ->dd() //it returns a sql query 
            ->get(); 

        return view('dashboard.categories.index', compact('title', 'categories'));
    }

    // 2. Delete Action:
    public function destroy($id){
        $category = Category::destroy($id);
        return redirect(route('dashboard.categories.index'));
    }

    // 3. Create Action:
    //   UI Form
    public function create(){
        $categories = Category::all();
        return view('dashboard.categories.create',[
            'parents' => $categories,
            'category' => new Category()
        ]);
    }

    //   Add to the table
    public function post(Request $request){
        // $categories = Category::create([
        //     'name' => $request->post('name'),
        //     'slug' => Str::slug($request->post('name')),
        //     'parent_id' => $request->post('parent_id'),
        //     'description' => $request->post('description')
        // ]);

        // $rule = [
        //     'name' => 'required|string|max:255',
        //     'parent_id' => 'nullable|int|exists:categories,id',
        //     'description' => 'nullable|string|min:5',
        //     'image' => 'nullable|image|mimes:jpg,png'
        // ];
        $rule = $this->getFormRules();
        $request->validate($rule);

        // $data = $request->all();
        // dd($data);
        // if(!$data['name']) abort('404');
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $categories = Category::create($request->all());
        // toastr()->success('Success Message');
        // Toastr::success('Post added successfully :)','Success');
        // $notification = array(
        //     'message' => 'Post created successfully!',
        //     'alert-type' => 'success'
        // );

        // PRG: Post redirect get.
        return redirect(route('dashboard.categories.index')); //->with($notification);
    }


    // 4. Update Action
    // UI Form
    public function edit($id){
        $category = Category::find($id);
        if(!$category)
            abort('404');

        // $parents = Category::all();
        $parents = Category::where('id', '<>', $id)->get();
        

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    // update table 
    public function update(Request $request, $id){
        // $request->merge([
        //     'slug' => Str::slug($request->post('name'))
        // ]);
        $request->validate($this->getFormRules());

        $category = Category::where('id', '=', $id)->update($request->except(['_token', '_method']));

        return redirect(route('dashboard.categories.index'));
    }


    public function getFormRules($id = 0){
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'parent_id' => 'nullable|int|exists:categories,id',
            'description' => 'nullable|string|min:5',
            'image' => 'nullable|image|mimes:jpg,png'
        ];
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                //'unique:categories,name,' . $id,
                // Rule::unique('categories', 'name')->ignore($id, 'id'),
                //(new Unique('categories', 'name'))->ignore($id)
            ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'description' => 'nullable|string|min:5',
            'image' => 'required|mimes:jpg,png|max:50|dimensions:min_width=150,min_height=150,max_width=300,max_height=300', // 50KB
        ];
    }

}
