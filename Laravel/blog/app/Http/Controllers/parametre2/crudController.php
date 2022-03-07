<?php

namespace App\Http\Controllers\parametre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\division;
use App\etat;
use App\categorie;
use App\materiel;
use App\action;
use Validator;

class crudController extends Controller
{
    
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(action::latest()->get())
                ->addColumn('action2', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id_action.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id_action.'" class="delete btn btn-danger btn-sm">Delete</button>';
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
            'action_check'    =>  'required'
         
        );
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        
    
        $form_data = array(
         'action'        =>  $request->action_check
       
        );
       
        DB::table('actions')->insert($form_data);
            
        return response()->json(['success' => 'Data Added successfully.']);
    }
    
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = action::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }
    
    
     /* Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {
       
        
        $rules = array(            
         'action_check'    =>  'required'     
        );
        
        $error = Validator::make($request->all(), $rules);
       
        if($error->fails())
        {
           return response()->json(['errors' => $error->errors()->all()]);
        }
        
      
        $id_action=$request->hidden_id;
        
        
         $affected = DB::table('actions')
              ->where('id_action',$id_action )
              ->update(['action' =>$request->action_check ]);
        return response()->json(['success' => 'Data is successfully updated']);
      
    }
    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('actions')->where('id_action',$id)->delete();
    }
        
}
