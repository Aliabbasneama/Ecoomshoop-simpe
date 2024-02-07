<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SiteController extends Controller
{
    public function index(){
        $data['getcatgory']=$this->getCategory();
        $data['browseByCategory']=$this->browseByCategory();
       // dd($data);
        return view('fn.home',$data);
    }
    public function category($x=null){
        $data['getcatgory']=$this->getCategory();
        $data['browseByCategory']=$this->browseByCategory();
        return view('fn.category',$data);
    }

public function getCategory(){
    $d=DB::select("SELECT * FROM `tbl_category` WHERE status=1");
    $str='  <ul class="mainmenu">
    <li><a href="'.url('/').'">Home</a></li>';
    foreach($d as $v){
        $str.=' <li class="menu-item-has-children">
        <a href="#">Computers</a>
        <ul class="axil-submenu">';

$subcat=DB::select("SELECT * FROM `tbl_category` WHERE status=2 and qid=".$v->id);
foreach($subcat as $vv){
    $str.='<li><a href="'.url('category',$vv->id).'">'.$vv->title.'</a></li>';
}
        $str.='</ul>
        </li>';
    }
    $str.='<li><a href="">Contact</a></li>';
    $str.='</ul>
    </nav>';
    return $str;
}

   public function browseByCategory(){
    $d=DB::select("select s.* from tbl_category c
    inner join tbl_category s on c.id=s.qid and s.status=2
    where c.status=1 ");
    $str='';
    foreach($d as $v){
    $str.='    <div class="slick-single-layout">
    <div class="categrie-product" data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500">
        <a href="'.url('category',$v->id).'">
            <img class="img-fluid" src="'.asset('fontend').'/images/cat/'.$v->icone.'" alt="product categorie">
            <h6 class="cat-title">Desktop</h6>
        </a>
    </div>
   
</div>';
    }
    return $str;
   }

}


