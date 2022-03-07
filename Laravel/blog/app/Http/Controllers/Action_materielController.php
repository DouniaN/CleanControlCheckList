<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\division;
use App\etat;
use App\categorie;
use App\materiel;
use App\action;
use App\remarque;
use App\action_materiel;
use App\action_check;
use App\categorie_action;
use Illuminate\Support\MessageBag;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Validator;

/**
 
**/

class Action_materielController extends Controller
{
   
    
    function index(){
         
        return view('home');
         
    }
    
    
    /**
     ** formulaire checker List  (get les divisions/categories/Etats...)
    **/
    
    function add(){
        
        $divisions        = division::all();
        $etats            = etat::all();
        $categories       = categorie::all();
        $actions          = action::all();
        $remarques        =remarque::all();
        
        $checks = DB::table('checks')
        ->join('categories'  , 'checks.id_categorie'    ,  '=', 'categories.id_categorie')
        ->join('divisions'   , 'checks.id_division'     ,  '=', 'divisions.id_division')
        ->join('materiels'   , 'checks.id_materiel'     ,  '=', 'materiels.id_materiel')
        ->join('etats'       , 'checks.id_etat'         ,  '=', 'etats.id_etat')
        ->join('remarques'   , 'remarques.id_etat'  ,      '=', 'etats.id_etat')
        ->select('checks.*', 'divisions.division','categories.categorie','materiels.materiel','etats.etat')
        ->get();       
       
        return view('Checker_Division/checkerListe')->with([
                        'divisions'        =>$divisions,
                        'etats'            =>$etats,
                        'categories'       =>$categories,
                        'checks'           =>$checks,
                        'actions'          =>$actions,
                        'remarques'        =>$remarques
        ]); 
        
    }
    
    public function messages()
    {
        return [
            'id_division.required'  => 'Division Obligatoir',
            'id_categorie.required' => 'Categorie Obligaoir',
        ];
    }
    
    
    /**
      Insertion with images table checks [cette table permet de stocker les vérifications effectué pour chaque division et par date])
    **/
    
    function add_reclamation(Request $request){
        
        $action_materiel   = new action_materiel;
          
        $validator = Validator::make($request->all(), [
       
      //     'id_etat'       => 'required',
      //     'id_materiel'   => 'required|numeric',
             'id_division'  => 'required|numeric',
      //      'photo'         => 'required'
         ])->validate();
        
        $id_etat            = $request->input('id_etat');
        $id_division        = $request->input('id_division');
        $date_etat          = date('Y/m/d H:i:s');
        $id_materiel        = $request->input('id_materiel');
        $id_categorie       = $request->input('id_categorie');
        $commentaire        = $request->input('cmtr'); 
        $file               = $request->file('photo');
        $referenceBiens     = $request->input('referenceBiens');
        $referenceSalle     = $request->input('ReferenceSalle');
        $pricisions         = $request->input('pricision');
        $remarques          = $request->input('name_remarque');

                                              
        if ($request->has('photo'))
        {   
            //Handle File Upload
        
            $promotion_images = [];
            foreach ($request->file('photo') as $key => $file)
            {
                // Get FileName
                $filenameWithExt = $file->getClientOriginalName();
                //Get just filename
                $filename = pathinfo( $filenameWithExt, PATHINFO_FILENAME);
                //Get just extension
                $extension = $file->getClientOriginalExtension();
                //Filename to Store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Upload Image
                 $path = $file->move('uploads/materieles' , $fileNameToStore);
                 array_push($promotion_images, $fileNameToStore);
            }
        
        }
        
        else
        {
            $promotion_images='noimage.jpg';
        }
        
        
        $countRow=count($id_materiel);
        $nameEtat="type";
        $cofficients_Nettoiement=20;
        
        for($i=0;$i<$countRow;$i++){
            
            if($id_etat[$i]==2){
                $p=$i+1;
                $nameEtatPrp   = "$nameEtat".$p;
                $etat_propre   = $request->input("$nameEtatPrp");
            }
            else{
                $etat_propre=null;
            }
            
            if($id_etat[$i]==4||$id_etat[$i]==6||$id_etat[$i]==2){
                $cofficients_Nettoiement=$cofficients_Nettoiement-2;
            }
           
            if(empty($remarques[$i])){
                $remarques[$i]=3;
               
            }
            
            $commentaires  =self::replace_accents($commentaire[$i]);
           
            
                DB::insert("insert into checks(id_remarque,Pricision,Note_Nettoiement,ReferenceSalle,date_etat,image,id_etat,etat_propre,id_action,id_division,id_categorie,id_materiel,commentaire,designationBiens)
                     values($remarques[$i],'$pricisions[$i]',$cofficients_Nettoiement,'$referenceSalle[$i]','$date_etat','$promotion_images[$i]',$id_etat[$i],'$etat_propre',0,$id_division,$id_categorie[$i],$id_materiel[$i],'$commentaires','$referenceBiens[$i]')");
        }
    
          
           return redirect('checkerListe')->with('success','Action effectuée avec succéss');
          
         
    }
   
    

    /**
      get list de checks ->table checks
      parametre id_action=0 -> get check doesn't have action
      
    **/
    
    function get (){
        
        $divisions              = division::all();
        $etats                  = etat::all();
        $categories             = categorie::all();
        $actions                = action::all();
        $categorie_actions      = categorie_action::all();
       
        
        $checks = DB::table('checks')
        
        ->join('categories'  , 'checks.id_categorie' ,  '=', 'categories.id_categorie')
        ->join('divisions'   , 'checks.id_division'  ,  '=', 'divisions.id_division')
        ->join('materiels'   , 'checks.id_materiel'  ,  '=', 'materiels.id_materiel')
        ->join('etats'       , 'checks.id_etat'      ,  '=', 'etats.id_etat')
        ->join('remarques'   , 'checks.id_remarque'   ,  '=', 'remarques.id_remarque')
        
        ->select('checks.*', 'divisions.division','categories.categorie','materiels.materiel','etats.etat','remarques.remarque')
        ->where('id_action',0)
        ->get();       
     
        return view('Checker_Division/listeCheck')->with([
                                   'divisions'          =>$divisions,
                                   'etats'              =>$etats,
                                   'categories'         =>$categories,
                                   'checks'             =>$checks,
                                   'actions'            =>$actions,
                                   'categorie_actions'  =>$categorie_actions
                                ]); 
        
    }
    
    
     /**
     * Insertion table action_checks [Cette table permet de stocker les actions effectuées_vérifications ])
     * Update id_action to 1 (checks width actions)
     */
    
    
    function add_action_check(Request $request){
        
        $action_check              = new action_check ;
        $id_action                 = $request->input('actions_materiel');
        $id_action_check           = $request->input('id_check');
   
       
        $countAction = count($id_action);
      
        for($i=0; $i<$countAction; $i++){
     
            $id_actions              = $id_action[$i];
            $id_action_checks        = $id_action_check;
            $date_action             =date('Y/m/d H:i');
            DB::insert("insert into action_checks(id_action,id_check,Date_action) values($id_actions,$id_action_checks,'$date_action')");
            
        }
        
        
        DB::update("update checks set id_action=1 where id=$id_action_check ");
        return redirect('getChecks')->with('success','Action effectuée avec succés');
    
    }
    
    
    /**
        Update table checks ( action_check [ 0 (if action Non effectué) or 1 (if action effectuée ) ])
    **/
    
    function updatecheck(Request $request){
        
        $action_check              = new action_check ;
        $id_check_action           = $request->input('id_check_action');
        $cmtr_operateur            = $request->input('cmtr_operateur');
        $confirmation_operateur    = $request->input('confirmation_action');
        
        $id_check                  = $request->input('id_check');
        $date_action               = date('Y/m/d H:i:s');
        $countActions              = count($id_check_action);
        $id_check1                 = $id_check[0];
        
        for($i=0;$i<$countActions;$i++){
            
           DB::update("update action_checks set validation_operateur=$confirmation_operateur[$i],commentaire_operateur='$cmtr_operateur[$i]'
                      ,Date_action_operateur='$date_action'
                      where id=$id_check_action[$i]");
           
            if($confirmation_operateur[$i]==1 || $confirmation_operateur[$i]==2 ){
              DB::update("update checks set action_check=1 where id=$id_check1");
         
            }
            if($confirmation_operateur[$i]==0){
                DB::update("update checks set action_check=0 where id=$id_check1");  
            }
           
        }
        
       
       
        return redirect('getChecksAction')->with('success','Action effectuée avec succés');
    
    }
    
    
    /**
         Satisfaction Controlleur
    **/
    
    function stisfaction_controlleur(Request $request){
        
        $action_check                   = new action_check ;
        $id_check                       = $request->input('id_check');  
        $id_check_action                = $request->input('id_check_actions');
        $id_actions                     = $request->input('id_actions');
        $satisfaction_controleur        = $request->input('satisfaction_controlleur');
        $cmtr_controleur                = $request->input('cmtr_controlleur');
        $date_action                    = date('Y/m/d H:i:s');
        $id_check_satisfaction          = $id_check[0];
        
       
        $countActions=count($id_actions);
       
         for($i=0;$i<$countActions;$i++){
        
            DB::update("update action_checks set validation_controleur=$satisfaction_controleur[$i],commentaire_controlleur='$cmtr_controleur[$i]'
                       ,Date_Satisfaction_Controlleur='$date_action'
                       where id=$id_check_action[$i]");
            
            if($satisfaction_controleur[$i]==1||$satisfaction_controleur[$i]==2){
                
              DB::update("update checks set satisfaction_conservateur=1 where id=$id_check_satisfaction");
              
            }
            
            if($satisfaction_controleur[$i]==0){
                
                DB::update("update checks set satisfaction_conservateur=0 where id=$id_check_satisfaction");  
            }

        }
    
        return redirect('checks_2')->with('success','Action effectuée avec succés');
    
    }
    
    
    
    /**
       get Actions Check -->(Confirmation Operateur)
       
    **/

    
    function get_actions_check (Request $request){
        
        $ActionsChecks   =array();
        $id_check         = $request->get('id_check');
        $actions          = action::all();
        $action_check     = DB::table('action_checks')
        
        ->join('actions'             , 'action_checks.id_action' ,     '=', 'actions.id_action')
       
         ->select('action_checks.*', 'actions.action')
         ->where('id_check',$id_check)
         ->where('action_checks.validation_operateur',0)
         ->get();
         
        $output = '';
        $count_action_check=count($action_check);
        foreach($action_check as $row)
        {
          $output .= '<p>'.$row->action.'</p>';
        }
        
        $ActionsChecks=[
            
            'Actions'      =>$action_check,
            'countActions' =>$count_action_check
        ];
        return  $ActionsChecks;
        
    }
    
    
     /**
       get Actions Check -->(Confirmation Controlleur)
       
    **/

    
    function get_actions_check2 (Request $request){
        
        $ActionsChecks   =array();
        $id_check         = $request->get('id_check');
        $actions          = action::all();
        $action_check     = DB::table('action_checks')
        
         ->join('actions'             , 'action_checks.id_action' ,     '=', 'actions.id_action')
         ->select('action_checks.*', 'actions.action')
         ->where('id_check',$id_check)
         ->where('validation_controleur',0)
         ->get();
         
        $output = '';
        $count_action_check=count($action_check);
        foreach($action_check as $row)
        {
          $output .= '<p>'.$row->action.'</p>';
        }
        
        $ActionsChecks=[
            
            'Actions'      =>$action_check,
            'countActions' =>$count_action_check
        ];
        return  $ActionsChecks;
        
    }
    
    
    /**
        get Vérifications -> action(1)
        operateur Proproté    ->id_etat=2
        operateur Maintenance ->id_etat=3
        
    **/
    
    function get_checks (Request $request){
        
        
        $valueSession     = $request->session()->get('dataSession');
        $divisions        = division::all();
        $etats            = etat::all();
        $categories       = categorie::all();
        $actions          = action::all();
        $remarques        = remarque::all();
        $action_checks    = action_check::all();
       
        if($valueSession['name']=="operateurProprote"){
        
            $checks = DB::table('checks')
            ->join('categories'      , 'checks.id_categorie'  ,  '=', 'categories.id_categorie')
            ->join('divisions'       , 'checks.id_division'   ,  '=', 'divisions.id_division')
            ->join('materiels'       , 'checks.id_materiel'   ,  '=', 'materiels.id_materiel')
            ->join('etats'           , 'checks.id_etat'       ,  '=', 'etats.id_etat')
            ->join('remarques'       , 'checks.id_remarque'   ,  '=', 'remarques.id_remarque')
            

            ->select('checks.*', 'divisions.division','categories.categorie','materiels.materiel','etats.etat','remarques.remarque')
            ->where('checks.id_action', 1)
            ->where('checks.id_etat' ,2 )
            ->where('checks.action_check', 0)
            
            ->get();
        }
       
        else if($valueSession['name']=="operateurMaintenance"){
        
            $checks = DB::table('checks')
           ->join('categories'  , 'checks.id_categorie' ,  '=', 'categories.id_categorie')
           ->join('divisions'   , 'checks.id_division'  ,  '=', 'divisions.id_division')
           ->join('materiels'   , 'checks.id_materiel'  ,  '=', 'materiels.id_materiel')
           ->join('etats'       , 'checks.id_etat'      ,  '=', 'etats.id_etat')
           ->join('remarques'   , 'checks.id_remarque'   ,  '=', 'remarques.id_remarque')

           
           ->select('checks.*', 'divisions.division','categories.categorie','materiels.materiel','etats.etat','remarques.remarque')
           ->where('id_action', 1)
           ->where('action_check', 0)
           ->where('checks.id_etat',3)
           ->get();
        }
        
        else {
              
              $checks = DB::table('checks')
            ->join('categories'  , 'checks.id_categorie' ,  '=', 'categories.id_categorie')
            ->join('divisions'   , 'checks.id_division'  ,  '=', 'divisions.id_division')
            ->join('materiels'   , 'checks.id_materiel'  ,  '=', 'materiels.id_materiel')
            ->join('etats'       , 'checks.id_etat'      ,  '=', 'etats.id_etat')
            ->join('remarques'   , 'checks.id_remarque'  , '=', 'remarques.id_remarque')
            
            ->select('checks.*', 'divisions.division','categories.categorie','materiels.materiel','etats.etat','remarques.remarque')
            ->where('id_action', 1)->where('', 0)
            ->get();
            
        }
        
        return view('Checker_Division/listeChecksAction')->with([
                                 'divisions'        =>$divisions,
                                'etats'             =>$etats,
                                 'categories'       =>$categories,
                                 'checks'           =>$checks,
                                 'actions'          =>$actions
                              ]); 
        
    }
    
     
    /**
     *********************************************************** User Final********************************************************************* 
    **/
    function get_checks_userFinal (){
        
        $divisions        = division::all();
        $etats            = etat::all();
        $categories       = categorie::all();
        $actions          = action::all();
        
       
        $checks = DB::table('checks')
        ->join('categories'  , 'checks.id_categorie' ,  '=', 'categories.id_categorie')
        ->join('divisions'   , 'checks.id_division'  ,  '=', 'divisions.id_division')
        ->join('materiels'   , 'checks.id_materiel'  ,  '=', 'materiels.id_materiel')
        ->join('etats'       , 'checks.id_etat'      ,  '=', 'etats.id_etat')
       
        
        ->select('checks.*', 'divisions.division','categories.categorie','materiels.materiel','etats.etat')
        ->where('id_action', 1)
        ->where('action_check', 1)
        ->where('satisfaction_conservateur',0)
        ->get();       
        return view('Checker_Division/UserFinal')->with([
                                  'divisions'        =>$divisions,
                                  'etats'            =>$etats,
                                  'categories'       =>$categories,
                                  'checks'           =>$checks,
                                  'actions'          =>$actions
                               ]); 
        
    }
    
    
    /*get select materiel from select categorie*/
    
    function fetch(Request $request)
    {
       //$select = $request->get('select'); id_categorie  (get id select)
         $value = $request->get('id_categorie');            //  value id_categorie ( get value id select)
       // $dependent = $request->get('dependent');id_materiel (get  id materiel)
        $data = DB::table('materiels')   
          ->where('id_categorie', $value)
          ->get();
        $output = '<option value="">Selectionnez Biens</option>';
        foreach($data as $row)
        {
           $output .= '<option value="'.$row->id_materiel.'">'.$row->materiel.'</option>';
        }
        echo $output;
       
    }
    
        /*get select actions from select categorie*/
    
    function getActionsCategorie(Request $request)
    {
        $value = $request->get('id_categorie_Action');         

        $data = DB::table('actions')   
          ->where('id_categorie_action', $value)
          ->get();
        $output = '<option value="">Selectionnez Action</option>';
        foreach($data as $row)
        {
           $output .= '<option value="'.$row->id_action.'">'.$row->action.'</option>';
        }
        echo $output;
       
    }
    
    
    
    
    
    /**
     * replace all accent of data
     *
     * @uses replace_accents($string);
     * @access public
     *
     * @param string $string
     *  
     */
     function replaceAccents($string){
        $str= str_replace("'", '', $string);
        return $str;
     }
    
     /**
     * Delete all accent of data
     *
     * @uses replace_accents($string);
     * @access public
     *
     * @param string $string
     *  data to delete accent
     */
    function replace_accents($string)
    {
        $str = mb_strtolower($string, 'UTF-8');
        mb_regex_encoding('UTF-8');
 
        $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');     // Converts characters to HTML entities
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#','\1', $str);
          
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1',$str); // pour les ligatures e.g. '&oelig;'
          
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractéres
          
        $str = mb_ereg_replace("[^A-Za-z0-9\.\-]", " ", $str); // 
        
        $str = trim(preg_replace('/ +/', ' ', $str));


        return $str;
    }
   
    
    
}
