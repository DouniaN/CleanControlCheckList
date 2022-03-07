<?php

namespace App\Http\Controllers\parametre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\categorie;
use Validator;

class CategorieController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(categorie::latest()->get())
                ->addColumn('action2', function($data){
                    $button = '<button type="button" name="editCateg" id="'.$data->id_categorie.'" class="editCateg btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="deleteCategorie" id="'.$data->id_categorie.'" class="deleteCategorie btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action2'])
                ->make(true);
        }
         $categories = DB::table('categories')->get();
         return view('CRUD\Action')->with([
                                  'categories'  => $categories        
                               ]);
    }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = array(
            'categorie'    =>  'required'
         
        );
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        
    
        $form_data = array(
         'categorie'        =>  $request->categorie
       
        );
       
        DB::table('categories')->insert($form_data);
            
        return response()->json(['success' => 'Data Added successfully.']);
    }
    
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
     public function update(Request $request)
    {
       
        
        $rules = array(            
         'categorie'    =>  'required'     
        );
        
        
       $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
           return response()->json(['errors' => $error->errors()->all()]);
        }
           
        $id_categorie=$request->hidden_id_categorie;
        
        
    $affected = DB::table('categories')
             ->where('id_categorie',$id_categorie)
           ->update(['categorie' =>$request->categorie ]);
      return response()->json(['success' => 'Categorie Bien Modifier']);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id_categorie',$id)->delete();
    }
    
    
}
