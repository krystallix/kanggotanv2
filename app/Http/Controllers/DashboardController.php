<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }
    public function HaulMassalStore(){
        return view('dashboard.haulmassal.store');
    }
    public function HaulMassalShow(){
        return view('dashboard.haulmassal.show');
    }
    public function ajaxRequest(){
        if(isset($_POST['data'], $_POST['token'])){
            $arr = json_decode(stripslashes($_POST['data']),true);
            $arwah=array();
            $token = $_POST['token'];
            $arwah_type="";
            $arwah_name="";
            $arwah_address="";
            for($i=0;$i<count($arr);$i++){
                if($arr[$i]['name']=="name"){
                    $arr_final_json['name']=$arr[$i]['value'];
                    continue;
                } 
                if($arr[$i]['name']=="phone"){
                    $arr_final_json['phone']=$arr[$i]['value'];
                    continue;
                }     
                if($arr[$i]['name']=="address"){
                    $arr_final_json['address']=$arr[$i]['value'];
                    continue;
                }   
                if($arr[$i]['name']=="arwah_type[]"){
                    $arwah_type=$arr[$i]['value'];
                }
                
                if($arr[$i]['name']=="arwah_name[]"){
                    $arwah_name=$arr[$i]['value'];
                }
                
                if($arr[$i]['name']=="arwah_address[]"){
                    $arwah_address=$arr[$i]['value'];
                }
                
                if($arwah_type!="" && $arwah_name!="" && $arwah_address!==""){
                    $dum_arwah['arwah_name']=$arwah_name;
                    $dum_arwah['arwah_address']=$arwah_address;
                    $dum_arwah['arwah_type']=$arwah_type;
                    $arwah[]=$dum_arwah;
                    $arwah_name="";
                    $arwah_type="";
                    $arwah_address="";
                }
            }
            
            $arr_final_json['data']=$arwah;
            $arr_fin['data']=$arr_final_json;
            $arr_final_json=$arr_fin;
            $arr = json_encode($arr_final_json,true);
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://api.kanggotan.id/api/nyadran/store',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $arr,
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: Bearer ' .$token
                    )
                ));
                $response = curl_exec($curl);
                
                curl_close($curl);
                echo $response;
                
                
            }
        }
        public function ajaxRequestAdd(){
            if(isset($_POST['data'], $_POST['token'])){
                $arr = json_decode(stripslashes($_POST['data']),true);
                $arwah=array();
                $token = $_POST['token'];
                $id_sender = $_POST['id_sender'];
                $arwah_type="";
                $arwah_name="";
                $arwah_address="";
                for($i=0;$i<count($arr);$i++){
                    if($arr[$i]['name']=="arwah_type[]"){
                        $arwah_type=$arr[$i]['value'];
                    }
                    
                    if($arr[$i]['name']=="arwah_name[]"){
                        $arwah_name=$arr[$i]['value'];
                    }
                    
                    if($arr[$i]['name']=="arwah_address[]"){
                        $arwah_address=$arr[$i]['value'];
                    }
                    
                    if($arwah_type!="" && $arwah_name!="" && $arwah_address!==""){
                        $dum_arwah['arwah_name']=$arwah_name;
                        $dum_arwah['arwah_address']=$arwah_address;
                        $dum_arwah['arwah_type']=$arwah_type;
                        $arwah[]=$dum_arwah;
                        $arwah_name="";
                        $arwah_type="";
                        $arwah_address="";
                    }
                }
                
                $arr_final_json=$arwah;
                $arr = json_encode($arr_final_json,true);
                
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://api.kanggotan.id/api/nyadran/arwah/'.$id_sender.'/new',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $arr,
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Content-Type: application/json',
                        'Authorization: Bearer ' .$token
                        )
                    ));
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
                    echo $response;
                    
                    
                }
            }
        
    }