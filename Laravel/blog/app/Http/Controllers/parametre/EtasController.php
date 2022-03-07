<?php
namespace App\Http\Controllers\parametre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\division;
use App\etat;
use App\action;
use Validator;

class EtasController extends Controller
{
    
     
    public function index()
    {
        
        if(request()->ajax())
        {
            return datatables()->of(etat::latest()->get())
                ->addColumn('action2', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id_etat.'" class="editEtatsBiens btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id_etat.'" class="deleteEtatsBiens btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action2'])
                ->make(true);
        }
         $etats = DB::table('etats')->get();
         return view('CRUD\Action')->with([
                                  'etats'  => $etats        
                               ]);
    }
    
    
     /**
     * Store a newly created resource in etats.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function store(Request $request)
    {
          
        $rules = array(
            
            'Etats_Biens'    =>  'required'  
        );
       $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        
        $form_data = array(
         'etat'        =>  $request->Etats_Biens
       
        ); 

        DB::table('etats')->insert($form_data);
        
        return response()->json(['success' => 'Action effectuée avec Succéss.']);

    }
    
    /**
     * Update resource in etats.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function update(Request $request)
    {
          
        $rules = array(
            
            'Etats_Biens'    =>  'required'  
        );
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $id_Etats_Biens=$request->id_Etats_Biens;
        
        $form_data = array(
            
         'etat'        =>  $request->Etats_Biens
       
        ); 

        
         $UpdatEtatsBiens = DB::table('etats')
              ->where('id_etat',$id_Etats_Biens)
              ->update(['etat' =>$request->Etats_Biens]);
      
         return response()->json(['success' => 'Action effectuée avec Succéss.']);

    }
    
    
    /**
     * Remove the specified resource from etats.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function delete($id)
    {
       
        DB::table('etats')->where('id_etat',$id)->delete();
    }
}
