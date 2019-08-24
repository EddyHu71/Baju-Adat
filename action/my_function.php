<?php
date_default_timezone_set('Asia/Jakarta');
$now=date("Y-m-d H:i:s");
include_once "action.php";
//include_once "recap.php";
$db=new Crud;
include_once "my_data_recap.php";



function img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
        $w = $h * $scale_ratio;
    }else {
        $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    imagealphablending( $tci, false );
    imagesavealpha( $tci, true );


    
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    if($ext=='png'){
        imagepng($tci, $newcopy, 9);
    }else{
        imagejpeg($tci, $newcopy, 80);
    }
    unlink($target);
}

function imguploadprocesswithreplace($oldpath,$x,$path,$newname){
    // echo "x : ".$x['name'].", divisi : $divisi, path : $path";
	$fileName=$newname.$x['name'];
	$fileTemp = $x["tmp_name"];
	$fileSize = $x["size"]; 
    $fileErrorMsg = $x["error"]; 
    $fileType = $x["type"]; 
    $fileSplit = explode(".", $fileName); 
    $fileExt = end($fileSplit); 
    $newfilename=$fileName;
	
	if($fileTemp){
       
        if (!preg_match("/.(gif||jpg||png||jpeg)$/i", $newfilename) ) {        
			 return "ext";
			 unlink($fileTemp); 
			 exit();		 
		}else if ($fileErrorMsg == 1) {
			return "err";
			exit();
		}
		$targetdirtmp=$path.'tmp'.$newfilename;
		$targetdir=$path.$newfilename;
		$moveResult = move_uploaded_file($fileTemp, $targetdirtmp);
		if ($moveResult != true) {
			return "err2";
			unlink($fileTemp); 
			exit();
		}else{
            if($oldpath!=''){
                if(file_exists($oldpath)){
                    unlink($oldpath);
                }
            }
            rename($targetdirtmp,$targetdir);
            return "ok";
        }
	}
}






function imguploadprocesswithresize($x,$path,$newname){
    // echo "x : ".$x['name'].", divisi : $divisi, path : $path";
	$fileName=$x['name'];
	$fileTemp = $x["tmp_name"];
	$fileSize = $x["size"]; 
    $fileErrorMsg = $x["error"]; 
    $fileType = $x["type"]; 
    $fileSplit = explode(".", $fileName); 
    $fileExt = end($fileSplit); 
    $newfilename=$newname.".".$fileExt;
	
	if($fileTemp){
        // return $fileTemp;
		if($fileSize > 2000000) {
			return "big";
			unlink($fileTemp); 
			exit();
		}else if (!preg_match("/.(gif||jpg||png||jpeg)$/i", $newfilename) ) {        
			 return "ext";
			 unlink($fileTemp); 
			 exit();		 
		}else if ($fileErrorMsg == 1) {
			return "err";
			exit();
		}
		$targetdir=$path.$newfilename;
		$moveResult = move_uploaded_file($fileTemp, $targetdir);
		if ($moveResult != true) {
			return "err2";
			unlink($fileTemp); 
			exit();
		}else{
            $target_file = $targetdir;
            $resized_file = $path."res-".$newfilename;
            $wmax = 150;
            $hmax = 150;
            $resizing=img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
            return "ok";
        }
	}
}
function imguploadprocesswithresizebig($x,$path,$newname){
    // echo "x : ".$x['name'].", divisi : $divisi, path : $path";
	$fileName=$newname."-".$x['name'];
	$fileTemp = $x["tmp_name"];
	$fileSize = $x["size"]; 
    $fileErrorMsg = $x["error"];
    $fileType = $x["type"]; 
    $fileSplit = explode(".", $fileName); 
    $fileExt = end($fileSplit); 
    $newfilename=$newname.".".$fileExt;
	
	if($fileTemp){
        // return $fileTemp;
		if($fileSize > 2000000) {
			return "big";
			unlink($fileTemp); 
			exit();
		}else if (!preg_match("/.(gif||jpg||png||jpeg)$/i", $newfilename) ) {        
			 return "ext";
			 unlink($fileTemp); 
			 exit();		 
		}else if ($fileErrorMsg == 1) {
			return "err";
			exit();
		}
		$targetdir=$path.$newfilename;
		$moveResult = move_uploaded_file($fileTemp, $targetdir);
		if ($moveResult != true) {
			return "err2";
			unlink($fileTemp); 
			exit();
		}else{
            $target_file = $targetdir;
            $resized_file = $path."resized-".$newfilename;
            $wmax = 500;
            $hmax = 500;
            $resizing=img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
            return "ok";
        }
	}
}
function imguploadprocess($x,$path,$newname){
    // echo "x : ".$x['name'].", divisi : $divisi, path : $path";
	$fileName=$newname."-".$x['name'];
	$fileTemp = $x["tmp_name"];
	$fileSize = $x["size"]; 
    $fileErrorMsg = $x["error"]; 
    $fileType = $x["type"]; 
    $fileSplit = explode(".", $fileName); 
    $fileExt = end($fileSplit); 
    $newfilename=$newname.".".$fileExt;
	
	if($fileTemp){
        // return $fileTemp;
		// if($fileSize > 2000000) {
		// 	return "big";
		// 	unlink($fileTemp); 
		// 	exit();
		// }else 
        if (!preg_match("/.(gif||jpg||png||jpeg)$/i", $newfilename) ) {        
			 return "ext";
			 unlink($fileTemp); 
			 exit();		 
		}else if ($fileErrorMsg == 1) {
			return "err";
			exit();
		}
		$targetdir=$path.$newfilename;
		$moveResult = move_uploaded_file($fileTemp, $targetdir);
		if ($moveResult != true) {
			return "err2";
			unlink($fileTemp); 
			exit();
		}else{
            return "ok";
        }
	}
}



////////////////////// member management /////////////////////////

if(isset($_POST['infoadm'])){
    $caid=$_POST['infoadm'];
    $aid=$_POST['aid'];

    $ca=$db->fetchwhere("admin","id='$caid'");
    foreach($ca as $caa){
        $caname=$caa['name'];
        $caemail=$caa['email'];
        $caphone=$caa['phone'];
        $caaddr=$caa['address'];
        $carole=$caa['role'];
        $castat=$caa['account_status'];
        $caregby=$caa['add_by'];
        $caregdt=date("d-m-Y, H:i",strtotime($caa['add_dt']));
        $callog=$caa['last_log'];


        if($callog=="0000-00-00 00:00:00"){
            $callogin="---";
        }else{
            $callogin=date("d-m-Y",strtotime($callog));
        }



        $sasel='';
        $asel='';
        $osel='';

        if($carole=='1'){
            $sasel="selected";
        }
        if($carole=='2'){
            $asel="selected";
        }
        if($carole=='3'){
            $osel="selected";
        }


        if($castat==1){
            $castat="Active";
        }
        if($castat==2){
            $castat="Blocked";
        }
        if($castat==3){
            $castat="Deleted";
        }
    
      
    }

    echo "
        <div class='row'>
            <div class='col-4'>
                <label>Email</label>
            </div>
            <div class='col'>
                $caemail
            </div>     
        </div>
        

        <div class='row'>                        
            <div class='col-4'>
                <label>Added Date</label>
            </div>
            <div class='col'>
                $caregdt
            </div>
        </div>
        <div class='row'>        
            <div class='col-4'>
                <label>Added By</label>
            </div>
            <div class='col'>
                $caregby
            </div>
        </div>

        <div class='row'>                        
            <div class='col-4'>
                <label>Last Login</label>
            </div>
            <div class='col'>
                $callogin
            </div>
        </div>
        <div class='row'>        
            <div class='col-4'>
                <label>Status</label>
            </div>
            <div class='col'>
                $castat
            </div>
        </div>
        <div class='row mb-2'>
            <div class='col-4 align-self-center'>
                Name
            </div>
            <div class='col'>
                <input type='text' id='editname' value='$caname' class='form-control' placeholder='Admin Name' onfocus='empty(\"adderrmsg\")'>
            </div>
        </div>
        <div class='row mb-2'>
            <div class='col-4 align-self-center'>
                Phone
            </div>
            <div class='col'>
                <input type='text' id='editphone' value='$caphone' class='form-control' placeholder='Phone Number' onfocus='empty(\"adderrmsg\")'>
            </div>
        </div>
        <div class='row mb-2'>
            <div class='col-4 align-self-center'>
                Address
            </div>
            <div class='col'>
                <textarea rows='5' style='height:95%;' class='form-control' id='editaddr' placeholder='Address' onfocus='empty(\"adderrmsg\")'>$caaddr</textarea>
            </div>
        </div>
        <div class='row mb-2'>
            <div class='col-4 align-self-center'>
                Role
            </div>
            <div class='col'>
                <select id='editrole' class='form-control' onfocus='empty(\"adderrmsg\")'>
                    <option value = ''>--- Select Admin Role ---</option>
                    <option value = '1' $sasel>Super Admin</option>
                    <option value = '2' $asel>Admin</option>
                    <option value = '3' $osel>Operator</option>
                </select>
            </div>
        </div>
       
        
        
       

        <div class='row'>
            <div class='col'>
                <div id='editerrmsg' class='errormsg text-center'></div>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                <div class='btnplaceholder' id='btneditadm'>
                    <button type='button' class='btn btn-block btn-primary' onclick=\"manageuser('adm','edit','$caid','$aid')\">
                        Edit Admin
                    </button>
                </div>
            </div>
        </div>
    ";

}

if(isset($_POST['admaction'])){
    $act=$_POST['admaction'];
    $table=$_POST['table'];
    $uid=$_POST['uid'];
    $aid=$_POST['aid'];
    $acta=true;
    $actl=true;
    $now2=$now;

//     if($act!='add'){
//         $ceku=$db->fetchwhere($table,"id='$uid'");
//         foreach($ceku as $cu){
//         }
// }
    

    $ceka=$db->fetchwhere("admin","id='$aid'");
    foreach($ceka as $ca){
        $aemail=$ca['email'];
        $aname=$ca['name'];
    }
    
    if($act=='editmember'){
        $cufname=$_POST['cufname'];
        $culname=$_POST['culname'];
        $cuphone=$_POST['cuphone'];
        $cbankname=$_POST['cbankname'];
        $cbanknumber=$_POST['cbanknumber'];
        $cbankacc=$_POST['cbankacc'];

        $whereuser=array('id'=>$uid);
        $updateuser=array(
            'fname'=>$cufname,
            'lname'=>$culname,
            'phone'=>$cuphone,
            'bank_name'=>$cbankname,
            'bank_number'=>$cbanknumber,
            'bank_account'=>$cbankacc,
        );
        $acta=$db->update("user",$whereuser,$updateuser);
        $wherel=array(
            "admin_id"=>$aid,
            "user_id"=>$uid,
            "datetime"=>$now2,
            "relevance"=>"mengubah data user $uid",

        );
    
        $actl=$db->insert("log",$wherel);    
    }

    // echo "afulname : $afullname";

    if($act=='edit'){

        $editphone=$_POST['editphone'];
        $editname=$_POST['editname'];
        $editaddr=$_POST['editaddr'];
        $editrole=$_POST['editrole'];
        

        $wheretable=array("id"=>$uid);
        $updatetable=array(
            "phone"=>$_POST['editphone'],
            "name"=>$_POST['editname'],
            "address"=>$_POST['editaddr'],
            "role"=>$_POST['editrole'],
            "mod_by"=>$aid,
            "mod_dt"=>$now,
        );
        $acta=$db->update($table,$wheretable,$updatetable);


        $wherel=array(
            "admin_id"=>$aid,
            "user_id"=>$uid,
            "datetime"=>$now,
            "relevance"=>"edit $table",
        );
    
        $actl=$db->insert("log",$wherel);    
    }
    // if($act=='eligible'){
    //      $whereu=array("id"=>$uid);
    //      $updateu=array("eligible"=>1);
    //     $acta=$db->update("user",$whereu,$updateu);
        
    //     $insl=array(
    //         "admin_id"=>$aid,
    //         "user_id"=>$uid,
    //         "datetime"=>$now,
    //         "relevance"=>$table,
    //     );
    //     $actl=$db->insert("log",$insl);  
    // }
    // if($act=='ineligible'){
    //     $whereu=array("id"=>$uid);
    //      $updateu=array("eligible"=>0);
    //     $acta=$db->update("user",$whereu,$updateu);
        
    //     $insl=array(
    //         "actor"=>$afullname,        
    //         "actor_id"=>$aid,
    //         "actor_email"=>$aemail,
    //         "datetime"=>$now,
    //         "isadmin"=>1,
    //     );
    //      $actl=$db->insert("log",$insl);  
    // }

    if($act=='block' || $act=='unblock'){
        if($act=='block'){
            $targetstatus=2;
            $targetinfo="Blocking";
        }else{
            $targetstatus=1;
            $targetinfo="Unblocking";
        }
        $whereu=array("id"=>$uid);
        $updateu=array("account_status"=>$targetstatus,"mod_by"=>$aid,"mod_dt"=>$now2);
        $acta=$db->update($table,$whereu,$updateu);
        $wherel=array(
            "admin_id"=>$aid,
            "user_id"=>$uid,
            "datetime"=>$now,
            "relevance"=>$targetinfo." ".$table,
        );
        $actl=$db->insert("log",$wherel);    
    }    

    if($act=='del'){       
        $whereu=array("id"=>$uid);
        $updateu=array("account_status"=>3);
        $acta=$db->update($table,$whereu,$updateu);
        // if($table=='member'){
        $acta=$db->update($table,$whereu,$updateu);
        $wherel=array(
            "admin_id"=>$aid,
            "user_id"=>$uid,
            "datetime"=>$now,
            "relevance"=>"delete $table",
        );
        $actl=$db->insert("log",$wherel);    
            
        // }else if($table=='subscriber'){
        //     $acta=$db->update("subscriber",$whereu,$updateu);
        //     $wheredel=array(
        //         "actor"=>$afullname,        
        //         "actor_id"=>$aid,
        //         "actor_email"=>$aemail,
        //         "datetime"=>$now,
        //         "isadmin"=>1,
        //     );
        //     $actl=$db->insert("log",$wheredel); 
        
        // }else{
        //     $acta=$db->update("admin",$whereu,$updateu);
        //     $wheredel=array(
        //         "admin_id"=>$aid,
        //         "user_id"=>$uid,
        //         "datetime"=>$now,
        //         "relevance"=>"delete $table",
        //     );
        //     $actl=$db->insert("log",$wheredel);  
        // }

         
    }

    if($act=='add'){
        $addemail=$_POST['addemail'];
        $addphone=$_POST['addphone'];
        $addpass=$_POST['addpass'];
        $addname=$_POST['addname'];
        $addaddr=$_POST['addaddr'];
        $addrole=$_POST['addrole'];

        $x=$db->fetchwhere($table,"email ='$addemail'");
        if(count($x)>0){
            echo "$table already existed";
            exit();
        }

        $insertadm=array(
            "name"=>$addname,
            "email"=>$addemail,
            "password"=>hash('sha256',$addpass),
            "phone"=>$addphone,
            "address"=>$addaddr,
            "role"=>$addrole,
            "account_status"=>1,
            "add_by"=>$aid,
            "add_dt"=>$now,
        );
        $acta=$db->insert($table,$insertadm);

        $whereadm=array(
            "admin_id"=>$aid,
            "user_id"=>$uid,
            "datetime"=>$now,
            "relevance"=>"add $table",
        );
        $actl=$db->insert("log",$whereadm);  
    }

    if($acta && $actl){
        echo "ok";
    }else{
        echo "Failed Updating User, Please Try Again";
        exit();
    }

    // echo $afullname, $aemail;

}

if(isset($_POST['seeinfoproduct'])){
    $pid=$_POST['checkid'];
    $aid=$_POST['aid'];
    $cekproduk=$db->fetchwhere("product","id='$pid'");
    foreach($cekproduk as $cp){
        $prodmerk=$cp['product_brand'];
        $prodnama=$cp['product_name'];
        $prodkode=$cp['product_code'];
        $prodcat=$cp['category'];
        $proddesc=$cp['description'];
        $prodhrgmodal=$cp['harga_modal'];
        $prodhrgdealer=$cp['harga_dealer'];
        $prodhrgumum=$cp['harga_umum'];
        $prodhrgpasang=$cp['harga_pasang'];
        $prodimg=$cp['img'];
        $produsupplier=$cp['supplier'];
        $prodgrade=$cp['grade'];
        $prodnegara=$cp['negara_pembuat'];
        $prodsatuan=$cp['satuan'];
        $prodpart=$cp['no_part'];
        $prodaddby=$cp['add_by'];
        $prodadddt=date('d-m-Y',strtotime($cp['add_dt']));
        $modby=$cp['mod_by'];
        $moddt=$cp['mod_dt'];
    }

    $prodimgexp=explode("||",$prodimg);
    $mainimg=$prodimgexp[0];
    if($prodaddby==0){
        $prodaddby=1;
    }

    $cekpembuat=$db->fetchwhere("admin","id='$prodaddby'");
    foreach($cekpembuat as $cp){
        $emailpembuat=$cp['email'];
    }

    $moded='';
    if($modby!=0){
        
        $cekmod=$db->fetchwhere("admin","id='$modby'");
        foreach($cekmod as $cm){
            $emailmod=$cm['email'];
        }
        $moddt=date('d-m-Y',strtotime($moddt));

        $moded="
            <div class='row mb-3'>
                <div class='col'>
                     Direvisi Oleh
                    <span class='pull-right'>
                        :
                    </span>
                </div>
                <div class='col'>
                    $emailmod<br/>$moddt
                </div>
            </div>
           
        ";
    }

    echo "
        <div class='modal-header'>
            <h4 class='modal-title'>
                Info Produk ".ucwords($prodmerk)." ".ucwords($prodnama)."
            </h4>
            <button type='button' class='close' data-dismiss='modal'>&times;</button>
        </div>

        <div class='modal-body'>     
            <div class='row mb-3'>
                <div class='col'>    
                    <div class='row mb-3'>           
                        <div class='col'>
                            Name
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $prodnama
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col'>
                            Merk
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $prodmerk
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col'>
                            Kode
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $prodkode
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col'>
                            Category
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $prodcat
                        </div>
                    </div>
                   
                    <div class='row mb-3'>
                        <div class='col'>
                            Pembuat
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $emailpembuat<br/>$prodadddt
                        </div>
                    </div>
                    $moded
                </div>
                <div class='col text-center'>
                    <img src='$mainimg' class='imgfit'>
                </div>
            </div>
            <div class='row mb-3'>
                <div class='col text-center'>
                    <div class='errormsg' id='errormsgproduct'></div>
                </div>
            </div>
            <hr/>
            <div class='row mb-3'>
                <div class='col'>
                    <a href='produk_ubah.php?pid=$pid'>
                        <button class='btn btn-primary'>
                            Ubah Produk
                        </button>
                    </a>
                </div>
                <div class='col text-right'>
                    <button class='btn btn-danger' onclick=\"managedata('delete','product','$pid','$aid')\">
                        Hapus Produk
                    </button>
                </div>
            </div>
            
        </div>
    ";
}
if(isset($_POST['seeinfopromo'])){
    $pid=$_POST['checkid'];
    $aid=$_POST['aid'];
    $cekpromo=$db->fetchwhere("promotion","id='$pid'");
    foreach($cekpromo as $cp){
        $code=$cp['code'];
        $title=$cp['title'];
        $description=$cp['description'];
        $terms=nl2br($cp['terms']);
        $discount=$cp['discount'];
        $discount_type=$cp['discount_type'];
        $discount_max=$cp['discount_max'];
        $min_purchase=$cp['min_purchase'];
        $peruntukan=$cp['peruntukan'];
        $produk=$cp['produk'];
        $img=$cp['img'];
        $kuota=$cp['kuota'];
        $promo_start=date('d-m-Y H:i',strtotime($cp['promo_start']));
        $promo_end=date('d-m-Y H:i',strtotime($cp['promo_end']));
        $data_status=$cp['data_status'];
        $add_by=$cp['add_by'];
        $add_dt=date('d-m-Y',strtotime($cp['add_dt']));       
    }

    if($code==''){
        $code='---';
    }
    if($terms==''){
        $terms='---';
    }

    if($min_purchase==0){
        $min_purchase='---';
    }else{
        $min_purchase="Rp. $min_purchase";
    }
    if($discount_max==0){
        $discount_max='---';
    }else{
        $discount_max="Rp. $discount_max";
    }

    if($peruntukan==1){
        $peruntukan="Semua Anggota";
    }else if($peruntukan==2){
        $peruntukan="Anggota Silver";
    }else if($peruntukan==3){
        $peruntukan="Anggota Gold";
    }else if($peruntukan==4){
        $peruntukan="Anggota Platinum";
    }else{
        $peruntukan="---";
    }

    if($data_status==0){
        $data_status="Aktif";
    }else if($data_status==1){
        $data_status="Aktif";
    }else{
        $data_status="Selesai";
    }

    if($add_by==0){
        $add_by=1;
    }
    $cekpembuat=$db->fetchwhere("admin","id='$add_by'");
    foreach($cekpembuat as $cpp){
        $namapembuat=$cpp['name'];
        $emailpembuat=$cpp['email'];
    }

    $nilaipotongan='';
    if($discount_type=='persen'){
        $nilaipotongan=$discount." %";
    }else{
        $nilaipotongan="Rp. $discount";
    }
    echo "
        <div class='modal-header'>
            <h4 class='modal-title'>
                Info Promo
            </h4>
            <button type='button' class='close' data-dismiss='modal'>&times;</button>
        </div>

        <div class='modal-body'>     
            <div class='row mb-3'>
                <div class='col'>    
                    <div class='row mb-3'>           
                        <div class='col text-center'>
                            <img src='$img' class='imgfitsmall'>
                        </div>
                    </div>
                    <div class='row mb-3'>           
                        <div class='col-4'>
                            Kode
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $code
                        </div>
                    </div>
                    <div class='row mb-3'>           
                        <div class='col-4'>
                            Kuota
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $kuota
                        </div>
                    </div>
                    <div class='row mb-3'>           
                        <div class='col-4'>
                            Judul
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $title
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-4'>
                            Keterangan
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $description
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-4'>
                            Syarat Ketentuan
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $terms
                        </div>
                    </div>


                    <div class='row mb-3'>
                        <div class='col-4'>
                            Potongan
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $nilaipotongan
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-4'>
                            Min Belanja
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $min_purchase
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-4'>
                            Max Potongan
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $discount_max
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-4'>
                            Periode
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $promo_start - $promo_end
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-4'>
                            Status
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $data_status
                        </div>
                    </div>


       
     
            
                   
                    <div class='row mb-3'>
                        <div class='col-4'>
                            Peruntukan
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $peruntukan
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-4'>
                            Dibuat Oleh 
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $namapembuat($emailpembuat)<br/>
                            $add_dt
                        </div>
                    </div>
                </div>
               
            </div>
            <div class='row mb-3'>
                <div class='col text-center'>
                    <div class='errormsg' id='errormsgproduct'></div>
                </div>
            </div>
            <hr/>
            <div class='row mb-3'>
                <div class='col'>
                    <a href='produk_ubah.php?pid=$pid'>
                        <button class='btn btn-primary'>
                            Ubah Produk
                        </button>
                    </a>
                </div>
                <div class='col text-right'>
                    <button class='btn btn-danger' onclick=\"managedata('delete','product','$pid','$aid')\">
                        Hapus Produk
                    </button>
                </div>
            </div>
            
        </div>
    ";
    // echo "wow";
}
if(isset($_POST['seeinfoflash'])){
    $fid=$_POST['checkid'];
    $aid=$_POST['aid'];
    $cekflash=$db->fetchwhere("flash","id='$fid'");
    $dataprodukflash='';
    foreach($cekflash as $cf){
        $title=$cf['title'];
        $description=$cf['description'];
        $terms=nl2br($cf['terms']);
        $img=$cf['img'];
        $promo_start=date('d-m-Y H:i',strtotime($cf['promo_start']));
        $promo_end=date('d-m-Y H:i',strtotime($cf['promo_end']));
        $data_status=$cf['data_status'];
        $add_by=$cf['add_by'];
        $add_dt=date('d-m-Y',strtotime($cf['add_dt']));       

    }
    $cekprodukflash=$db->fetchwhere("flash_product","promo_id='$fid'");
    foreach($cekprodukflash as $cpf){
        $produknya=$cpf['product_id'];
        $produknyaexp=explode(",",$produknya);
        $kuotaflash=$cpf['kuota'];
        $hargaflash=$cpf['flash_price'];
        foreach($produknyaexp as $pexp){
            $cekdataproduk=$db->fetchwhere("product","id='$pexp'");
            foreach($cekdataproduk as $cdp){
                $pimg=$cdp['img'];
                $pimgexp=explode("||",$pimg);
                $prodimg=$pimgexp[0];
                $prodbrand=$cdp['product_brand'];
                $prodname=$cdp['product_name'];
                $prodprice=$cdp['harga_umum'];
            }
            $dataprodukflash.="
                <hr/>
                <div class='row mb-2'>
                    <div class='col-3'>
                        <img src='$prodimg' class='imgfitsmall'>
                    </div>
                    <div class='col'>
                        <div class='row'>
                            <div class='col'>
                                Produk : $prodbrand $prodname
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                Harga Normal : Rp. $prodprice,-
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                Harga Flash Sale : Rp. $hargaflash,-
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                Kuota : $kuotaflash
                            </div>
                        </div>
                    </div>
                   
                </div>
            ";
        }
    }

    

    if($data_status==0){
        $data_status="Aktif";
    }else if($data_status==1){
        $data_status="Aktif";
    }else{
        $data_status="Selesai";
    }

    if($add_by==0){
        $add_by=1;
    }
    $cekpembuat=$db->fetchwhere("admin","id='$add_by'");
    foreach($cekpembuat as $cpp){
        $namapembuat=$cpp['name'];
        $emailpembuat=$cpp['email'];
    }

    // $nilaipotongan='';
    // if($discount_type=='persen'){
    //     $nilaipotongan=$discount." %";
    // }else{
    //     $nilaipotongan="Rp. $discount";
    // }
    echo "
        <div class='modal-header'>
            <h4 class='modal-title'>
                Info Flash Sale
            </h4>
            <button type='button' class='close' data-dismiss='modal'>&times;</button>
        </div>

        <div class='modal-body'>     
            <div class='row mb-3'>
                <div class='col'>    
                    <div class='row mb-3'>           
                        <div class='col text-center'>
                            <img src='$img' class='imgfitsmall'>
                        </div>
                    </div>
                    <div class='row mb-1'>           
                        <div class='col-4'>
                            Judul
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $title
                        </div>
                    </div>
                    <div class='row mb-1'>
                        <div class='col-4'>
                            Keterangan
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $description
                        </div>
                    </div>
                    <div class='row mb-1'>
                        <div class='col-4'>
                            Syarat Ketentuan
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $terms
                        </div>
                    </div>

                    <div class='row mb-1'>
                        <div class='col-4'>
                            Mulai
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $promo_start
                        </div>
                    </div>
                    <div class='row mb-1'>
                        <div class='col-4'>
                            Selesai
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $promo_end
                        </div>
                    </div>
                    <div class='row mb-1'>
                        <div class='col-4'>
                            Dibuat Oleh 
                            <span class='pull-right'>
                                :
                            </span>
                        </div>
                        <div class='col'>
                            $namapembuat($emailpembuat)<br/>
                            $add_dt
                        </div>
                    </div>
                    <hr/>
                    <div class='row mb-1'>
                        <div class='col'>
                            Daftar Produk Flash Sale
                        </div>
                    </div>
                    $dataprodukflash
                </div>
               
            </div>
            
            
        </div>
    ";
    // echo "wow";
}

if(isset($_POST['seeinfo'])){
    $table=$_POST['seeinfo'];
    $checkid=$_POST['checkid'];
    $aid=$_POST['aid'];

    $ca=$db->fetchwhere($table,"id='$checkid'");
    foreach($ca as $caa){
        $caname=$caa['name'];
        $caemail=$caa['email'];
        $caphone=$caa['phone'];
        $caaddr=$caa['address'];
        $carole=$caa['role'];
        $castat=$caa['account_status'];
        $caregby=$caa['add_by'];
        $caregdt=date("d-m-Y, H:i",strtotime($caa['add_dt']));
        $callog=$caa['last_log'];
        $camodby=$caa['mod_by'];
        $camoddt=$caa['mod_dt'];

        if($camoddt=="0000-00-00 00:00:00"){
            $camoddt="---";
            $camodby="---";
        }else{
            $camoddt=date("d-m-Y, H:i",strtotime($camoddt));
            $cekaa=$db->fetchwhere("admin","id='$camodby'");
            foreach($cekaa as $caa){
                $camodby=$caa['name'];
                $camodbyemail=$caa['email'];
            }
        }

        $cekab=$db->fetchwhere("admin","id='$caregby'");
        foreach($cekab as $cab){
            $caregby=$cab['name'];
            $caregbyemail=$cab['email'];
        }

        if($callog=="0000-00-00 00:00:00"){
            $callogin="---";
        }else{
            $callogin=date("d-m-Y, H:i",strtotime($callog));
        }

        $sel1='';
        $sel2='';
        $sel3='';


        if($table=='supplier'){
            if($carole=='1'){
                $catype="Supply To HQ";
            }else{
                $catype="Direct To Customer";
            }
        }
        if($table=='admin'){
            if($carole=='1'){
                $catype="Super Admin";
            }else if($carole=='2'){
                $catype="Admin";
            }else{
                $catype="Admin";
            }
        }else{
            $catype="Tipe $carole";
        }


        if($carole=='1'){
            $sel1="selected";
        }
        if($carole=='2'){
            $sel2="selected";
        }
        if($carole=='3'){
            $sel3="selected";
        }


        if($castat==1){
            $castat="Active";
        }
        if($castat==2){
            $castat="Blocked";
        }
        if($castat==3){
            $castat="Deleted";
        }
    
        
    }

    $roleoptions='';

    if($table=='admin'){
        $roleoptions="
            <option value = ''>--- Select Admin Role ---</option>
            <option value = '1' $sel1>Super Admin</option>
            <option value = '2' $sel2>Admin</option>
            <option value = '3' $sel3>Operator</option>
        ";
    }else if($table=='supplier'){
        $roleoptions="
            <option value = ''>--- Select Supplier Type ---</option>
            <option value = '1' $sel1>Supply To HQ</option>
            <option value = '2' $sel2>Direct To Customer</option>
        ";
    }else{
        $roleoptions="
            <option value = ''>--- Select ".ucwords($table)." Type ---</option>
            <option value = '1' $sel1>Type 1</option>
            <option value = '2' $sel2>Type 2</option>
            <option value = '3' $sel2>Type 3</option>
        ";
    }


    echo "
        <div class='row'>
            <div class='col-4'>
                <label>Name</label>
            </div>
            <div class='col'>
                $caname
            </div>   
        </div>
        <div class='row'>  
            <div class='col-4'>
                <label>Email</label>
            </div>
            <div class='col'>
                $caemail
            </div>     
        </div>
        <div class='row'>  
            <div class='col-4'>
                <label>Phone</label>
            </div>
            <div class='col'>
                $caphone
            </div>     
        </div>
        <div class='row'>  
            <div class='col-4'>
                <label>Address</label>
            </div>
            <div class='col'>
                ".nl2br($caaddr)."
            </div>     
        </div>
        <div class='row'>  
            <div class='col-4'>
                <label>Type</label>
            </div>
            <div class='col'>
                $catype
            </div>     
        </div>
        

        <div class='row'>                        
            <div class='col-4'>
                <label>Last Login</label>
            </div>
            <div class='col'>
                $callogin
            </div>
        </div>
        <div class='row'>        
            <div class='col-4'>
                <label>Status</label>
            </div>
            <div class='col'>
                $castat
            </div>
        </div>

        <div class='row'>        
            <div class='col-4'>
                <label>Added By</label>
            </div>
            <div class='col'>
                $caregby
            </div>
        </div>
        <div class='row'>                        
            <div class='col-4'>
                <label>Added Date</label>
            </div>
            <div class='col'>
                $caregdt
            </div>
        </div>

        <div class='row'>        
            <div class='col-4'>
                <label>Last Modified By</label>
            </div>
            <div class='col'>
                $camodby
            </div>
        </div>
        <div class='row'>                        
            <div class='col-4'>
                <label>Last Modified Date</label>
            </div>
            <div class='col'>
                $camoddt
            </div>
        </div>


       
    ";

}


if(isset($_POST['editdetail'])){
    $table=$_POST['editdetail'];
    $checkid=$_POST['checkid'];
    $aid=$_POST['aid'];

    $ca=$db->fetchwhere($table,"id='$checkid'");
    foreach($ca as $caa){
        $caname=$caa['name'];
        $caphone=$caa['phone'];
        $caaddr=$caa['address'];
        $carole=$caa['role'];


        $sel1='';
        $sel2='';
        $sel3='';



        if($carole=='1'){
            $sel1="selected";
        }
        if($carole=='2'){
            $sel2="selected";
        }
        if($carole=='3'){
            $sel3="selected";
        }

    }

    $roleoptions='';

    if($table=='admin'){
        
        $roleoptions="
            <option value = ''>--- Select Admin Type ---</option>
            <option value = '1' $sel1>Super Admin</option>
            <option value = '2' $sel2>Admin</option>
            <option value = '3' $sel3>Operator</option>
        ";

        $btnedituser="
            <button type='button' class='btn btn-block btn-primary' onclick=\"manageuser('admin','edit','$checkid','$aid')\">
                Edit Admin
            </button>
        ";
    }else if($table=='supplier'){
        $roleoptions="
            <option value = ''>--- Select Supplier Type ---</option>
            <option value = '1' $sel1>Supply To HQ</option>
            <option value = '2' $sel2>Direct To Customer</option>
        ";
        $btnedituser="
            <button type='button' class='btn btn-block btn-primary' onclick=\"manageuser('supplier','edit','$checkid','$aid')\">
                Edit Supplier
            </button>
        ";
    }else{
        $roleoptions="
            <option value = '1' $sel1>Tipe 1</option>
            <option value = '2' $sel2>Tipe 2</option>
            <option value = '3' $sel3>Tipe 3</option>
        ";
        $btnedituser="
            <button type='button' class='btn btn-block btn-primary' onclick=\"manageuser('$table','edit','$checkid','$aid')\">
                Edit ".ucwords($table)."
            </button>
        ";

    }


    echo "        
        <div class='row mb-2'>
            <div class='col-4 align-self-center'>
                Name
            </div>
            <div class='col'>
                <input type='text' id='editname' value='$caname' class='form-control' placeholder='Admin Name' onfocus='empty(\"adderrmsg\")'>
            </div>
        </div>
        <div class='row mb-2'>
            <div class='col-4 align-self-center'>
                Phone
            </div>
            <div class='col'>
                <input type='text' id='editphone' value='$caphone' class='form-control' placeholder='Phone Number' onfocus='empty(\"adderrmsg\")'>
            </div>
        </div>
        <div class='row mb-2'>
            <div class='col-4 align-self-center'>
                Address
            </div>
            <div class='col'>
                <textarea rows='5' style='height:95%;' class='form-control' id='editaddr' placeholder='Address' onfocus='empty(\"adderrmsg\")'>$caaddr</textarea>
            </div>
        </div>
        <div class='row mb-2'>
            <div class='col-4 align-self-center'>
                Role
            </div>
            <div class='col'>
                <select id='editrole' class='form-control' onfocus='empty(\"adderrmsg\")'>
                    $roleoptions                   
                </select>
            </div>
        </div>
       
        
        
       

        <div class='row'>
            <div class='col'>
                <div id='editerrmsg' class='errormsg text-center'></div>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                <div class='btnplaceholder' id='btnedituser'>
                    $btnedituser
                </div>
            </div>
        </div>
    ";

}


//category management

if(isset($_POST['managecategory'])){
    $now2=$now;
    $go=true;
    $act=$_POST['managecategory'];
    $related=$_POST['related'];
    $aid=$_POST['aid'];
    $crrtype=0;
    if($related!=0){
        $cekrelated=$db->fetchwhere("category","id='$related'");
        foreach($cekrelated as $crr){
            $crrtype=$crr['type'];
        }
    }

    $addedarray2=array();

    if($related==0){
        $what='Main Category';
        $addedarray2=array("type"=>0);
    }else{
        $what='Sub Category';
        $addedarray2=array("type"=>$crrtype+1,"related"=>$related);
    }

    $val='';
    if(isset($_POST['val'])){
        $val=$_POST['val'];
    }
    $img='';
    $proofpath='';
    $addedupdate=array();
    if(isset($_FILES['img'])){
        $img=$_FILES['img'];
        $dir="../images/category/";       
    }

    if($act=='add'){
        $adaproduk=false;
        $addedtype=$crrtype+1;
        $cekcat=$db->fetchwhere("category","name='$val' and data_status!=2 and related='$related' and type=$addedtype");
        if(count($cekcat)>0){
            echo ucwords($what)." <u>$val</u> Already Existed";
            $go=false;
        }else{
            $cekprod=$db->fetch("product");
            foreach($cekprod as $cprod){
                $cprcat=$cprod['category'];
                // echo " cprcat : $cprcat ";
                $cprcatexp=explode(",",$cprcat);
                $jmlcprcat=count($cprcatexp);

                // echo " jumlah kat : ".count($cprcatexp);
                for($i=0;$i<$jmlcprcat;$i++){
                    // echo " kat satuan : ".$cprcatexp[$i];
                    if($cprcatexp[$i]==$related){
                        $adaproduk=true;
                        break;
                    }
                }
            
            }
        
            if($adaproduk){
                echo "Kategori ini memiliki produk didalamnya, hapus produk di kategori ini terlebih dahulu sebelum menambahkan sub kategori";
                $go=false;
            }
        }
    }
    // echo"wo";
    // $go=false;
    $cdrel=0;
    
    if($act=='delete'){
        $cekdown=$db->fetchwhere("category","id='$related'");
        foreach($cekdown as $cdd){
            $cdrel=$cdd['related'];
            $cdlas=$cdd['last_sub'];
        }

        $adaproduk=false;
        $abc='';
        $hasil='false';



        $cekprod=$db->fetch("product");
        foreach($cekprod as $cprod){
            $cprcat=$cprod['category'];
            // echo " cprcat : $cprcat ";
            $cprcatexp=explode(",",$cprcat);
            $jmlcprcat=count($cprcatexp);

            for($i=0;$i<$jmlcprcat;$i++){
                if($cprcatexp[$i]==$related){
                    $adaproduk=true;
                    break;
                }
            }
           
        }
      
        if($adaproduk){
            echo "Tidak bisa menghapus kategori yang memiliki produk didalamnya";
            $go=false;
        }else{
            if($cdlas!=1){
                echo "Tidak bisa menghapus kategori yang memiliki sub kategori";
                $go=false;
            }
        }

    }

    
   
    if($go){            
        if($img!=''){
            $oriname=$img['name'];
            $fileSplit = explode(".", $oriname); 
            $fileExt = end($fileSplit); 
            $newname="cat-$val";
            // echo 
            $uploadimg=imguploadprocesswithresize($img,$dir,$newname); //../img/cat/cat-otomotif.png
            if($uploadimg=='big'){
                echo "ERROR: Image size is more then 2 MB.";
            }else if($uploadimg=='ext'){
                echo "ERROR: file is not JPG or PNG.";
            }else if($uploadimg=='err'){
                echo "ERROR: An error occured while processing file. Try again.";
            }else if($uploadimg=='err2'){
                echo "ERROR: File not uploaded. Try again.";
            }else if($uploadimg=='ok'){
                $proofpath=$dir."res-".$newname.".".$fileExt;
            }
            $addedupdate=array("img"=>$proofpath);
        }
    
        // echo "proofpath=$proofpath";
    

        if($act=='delete'){
            //cari id related nya (supcat nya)

            // echo "cdrel : $cdrel";
            

            //cari apakah supcatnya itu masih puya subkategori lain atau ga
            //kalo uda ga ada, supcatnya itu diubah lastsubnya jadi 1
            if($cdrel!=0){
                $ceksup=$db->fetchwhere("category","related='$cdrel'");
                if(count($ceksup)==1){
                    $wheresup=array("id"=>$cdrel);
                    $updsup=array("last_sub"=>1);
                    $db->update("category",$wheresup,$updsup);
                }
            }
            



            $wherecat=array(
                "id"=>$related,
            );
            // $updatecat=array(
            //     "data_status"=>2,
            //     "mod_by"=>$aid,
            //     "mod_dt"=>$now2,
            // );
            $acta=$db->delete("category",$wherecat);

            // $updatecat=array_merge($updatecat,$addedupdate);
            // $acta=$db->update("category",$wherecat,$updatecat);
        }
    
        if($act=='add'){
            $insc=array(                
                "name"=>$val, 
                "img"=>$proofpath, 
                "last_sub"=>1,
                "add_by"=>$aid,
                "add_dt"=>$now2,           
            );

            $insc=array_merge($insc,$addedarray2);
            $acta=$db->insert("category",$insc);

            $wheresup=array("id"=>$related);
            $updsup=array("last_sub"=>0);

            $db->update("category",$wheresup,$updsup);
        }
        if($act=='edit'){
            // echo "related : $related";
            $wherecat=array(
                "id"=>$related,
            );
            $updatecat=array(
                "name"=>$val,
                "mod_by"=>$aid,
                "mod_dt"=>$now2,
            );

            $updatecat=array_merge($updatecat,$addedupdate);
            $acta=$db->update("category",$wherecat,$updatecat);
        }
    
        $insl=array(
            "admin_id"=>$aid,
            // "user_id"=>$uid,
            "datetime"=>$now2,
            "relevance"=>ucwords($act)." ".ucwords($what),

        );
        $actl=$db->insert("log",$insl);
    
        if($acta && $actl){
            echo "ok";
        }else{
            echo "Failed ".ucwords($act)." Category, please try again later";
        }

    }

}

//product management 

if(isset($_POST['tambahkandetil'])){
    $namadata=$_POST['tambahkandetil'];
    $isidata=$_POST['isidata'];
    $indexlanjutan=$_POST['indexlanjutan'];
    $opsilanjutan=$_POST['opsilanjutan'];
    $judullanjutan=$_POST['judullanjutan'];
    $namalanjutan=$_POST['namalanjutan'];
    $jenisdatalanjutan=$_POST['jenisdatalanjutan'];
    $contohlanjutan=$_POST['contohlanjutan'];
    $indexselanjutnya=$indexlanjutan+1;
    $listtambahan='';

    // if($indexlanjutan<9){
        $a=$db->fetchwheredistinct("kendaraan","$namadata='$isidata'",$namalanjutan);   

        //select distinct merk from kendaraan where merk='data'


        if(count($a)>0){
            foreach($a as $as){
                $listtambahan.="<option>".$as[$namalanjutan]."</option>";
            }        
            echo "
                <div class='row mb-3'>
                    <div class='col'>
                        <select class='form-control' id='$opsilanjutan' onchange=\"tambahkandetil('$namalanjutan',this,$indexselanjutnya)\" onfocus=\"empty('errmsgkendaraan')\">
                            <option value=''>--- $judullanjutan ---</option>
                            $listtambahan
                        </select>
                    </div>
                    <div class='col-1'>
                        <button class='btn btn-primary' onclick=\"tambahdata('$opsilanjutan','".ucwords($namalanjutan)."','$jenisdatalanjutan','$contohlanjutan',$indexselanjutnya)\">
                            <i class='fa fa-plus'></i>
                        </button>
                    </div>
                </div>    
            ";
        }else{
            echo "
                <div class='row mb-3'>
                    <div class='col'>
                        <select class='form-control' id='$opsilanjutan' onchange=\"tambahkandetil('$namalanjutan',this,'$indexselanjutnya')\" onfocus=\"empty('errmsgkendaraan')\">
                            <option value=''>--- ".ucwords($namalanjutan)." ---</option>                            
                        </select>
                    </div>
                    <div class='col-1'>
                        <button class='btn btn-primary' onclick=\"tambahdata('$opsilanjutan','".ucwords($namalanjutan)."','$jenisdatalanjutan','$contohlanjutan','$indexselanjutnya')\">
                            <i class='fa fa-plus'></i>
                        </button>
                    </div>
                </div>
            ";
        }        
    // }else{

    // }

    // echo $listmerk;

    // echo "ihihi";
}

if(isset($_POST['tambahdatakendaraan'])){
    $aid=$_POST['tambahdatakendaraan'];
    $jenis=$_POST['jenis'];
    $merk=$_POST['merk'];
    $model=$_POST['model'];
    $submodel=$_POST['submodel'];
    $silinder=$_POST['silinder'];
    $mesin=$_POST['mesin'];
    $transmisi=$_POST['transmisi'];
    $tawal=intval($_POST['tawal']);
    $tahir=intval($_POST['tahir']);
    $now2=$now;



    $cekdt=$db->fetchwhere("kendaraan","
        jenis='$jenis' and 
        merk='$merk' and 
        model='$model' and 
        submodel='$submodel' and 
        silinder='$silinder' and 
        mesin='$mesin' and 
        transmisi='$transmisi' and 
        tawal='$tawal' and 
        tahir='$tahir' 
    ");

    if(count($cekdt)>0){
        echo "Jenis kendaraan sudah ada di dalam database";
    }else{
        $insdata=array(
            "jenis"=>$jenis,
            "merk"=>$merk,
            "model"=>$model,
            "submodel"=>$submodel,
            "transmisi"=>$transmisi,
            "silinder"=>$silinder,
            "mesin"=>$mesin,
            "tawal"=>$tawal,
            "tahir"=>$tahir,
            "aid"=>$aid,
            "waktu"=>$now2,
        );
    
        $inslog=array(
            "action"=>"Menambah Data Kendaraan",
            "admin_id"=>$aid,
            "datetime"=>$now2,
            "relevance"=>"data_kendaraan",

        );
    
    
        $acta=$db->insert("kendaraan",$insdata);
        $actl=$db->insert("log",$inslog);
    
      
        if($acta && $actl){
            echo "ok";
        }else{
            echo "Gagal menambah data kendaraan, mohon coba lagi";
        }
  
    }


}

if(isset($_POST['transit'])){
    echo "ok";
}

if(isset($_POST['seeinfocategory'])){
    $table=$_POST['seeinfocategory'];
    $checkid=$_POST['checkid'];
    $aid=$_POST['aid'];

    $ca=$db->fetchwhere($table,"id='$checkid'");
    foreach($ca as $caa){
        $ctype=$caa['type'];
        if($ctype=='0'){
            $cctype="Main Category";
        }else{
            $cctype="Sub Category";
        }
        $crelated=$caa['related'];
        $cname=$caa['name'];
        $img=$caa['img'];
    }
    echo "
        <div class='row mb-3'>
            <div class='col'>
                <h4>".ucwords($cctype)." Names</h4>
                <input type='text' id='editcatname' value='$cname' class='form-control' placeholder='Edit ".ucwords($cctype)." Name' onfocus='empty(\"editerrcat\")'>
            </div>                        
                
        </div>
        <div class='row mb-3'>
            <div class='col'>
                <h4>".ucwords($cctype)." Icon</h4>
                <img src='$img'>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col'>
                <input type='file' id='editcatimg' class='form-control' onfocus='empty(\"editerrcat\")'>
            </div>                                                  
        </div>
        <div class='row mb-3'>
            <div class='col'>
                <div id='editerrcat' class='errormsg text-center'></div>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                <div class='btnplaceholder' id='btneditcat'>
                    <button type='button' class='btn btn-block btn-success' onclick='managecategory(\"edit\",\"$checkid\",\"$aid\")'>
                        Edit ".ucwords($cctype)."
                    </button>
                </div>
            </div>
        </div>
    ";

}



if(isset($_POST['tambahkanproduk'])){

   

    $aid=$_POST['tambahkanproduk'];
    $daftarkat=$_POST['daftarkat'];
    $sup=$_POST['sup'];
    $grade=$_POST['grade'];
    $negara=$_POST['negara'];
    $satuan=$_POST['satuan'];
    $merkprod=$_POST['merkprod'];
    $namaprod=$_POST['namaprod'];
    $kodeprod=$_POST['kodeprod'];
    $ketprod=$_POST['ketprod'];
    $nopart=$_POST['nopart'];
    $merkpart=$_POST['merkpart'];
    $harga0=$_POST['harga0'];
    $harga1=$_POST['harga1'];
    $harga2=$_POST['harga2'];
    $panjang=$_POST['panjang'];
    $lebar=$_POST['lebar'];
    $tinggi=$_POST['tinggi'];
    $berat=$_POST['berat'];
    $hargapasang=$_POST['hargapasang'];
    $kendaraanpengguna=$_POST['kendaraanpengguna'];
    $daftarsubstitusi=$_POST['daftarsubstitusi'];
  

    $cekcode=$db->fetchwhere("product","product_code='$kodeprod'");
    if(count($cekcode)>0){
        echo "Kode Produk Sudah Terdaftar";
        exit();
    }


    $imgpath='';
    $mainimg=$_FILES['mainimg'];
    $dir="../images/product/";
    $orimainimgname=$mainimg['name'];
    $fileSplit = explode(".", $orimainimgname); 
    $fileExt = end($fileSplit); 
    $newname="prod-$kodeprod";
    $uploadimg=imguploadprocesswithresize($mainimg,$dir,$newname); 
    if($uploadimg=='big'){
        echo "ERROR: Image size is more then 2 MB.";
        exit();
    }else if($uploadimg=='ext'){
        echo "ERROR: file is not JPG or PNG.";
        exit();
    }else if($uploadimg=='err'){
        echo "ERROR: An error occured while processing file. Try again.";
        exit();
    }else if($uploadimg=='err2'){
        echo "ERROR: File not uploaded. Try again.";
        exit();
    }else if($uploadimg=='ok'){
        $imgpath=$dir."res-".$newname.".".$fileExt;
    }

    $sekarang=$now;


    $imgpathadd='';
    $x='';
    
    $newaddname="add-$kodeprod";
    $addimg=$_FILES['addedimg'];
    $coadded=count($addimg['name']);
    $uu=0;

    for($i=0;$i<$coadded;$i++){
        $uu++;
        $filenamei[$i]=$addimg['name'][$i];
        $fileTempi[$i] = $addimg["tmp_name"][$i];
        $fileSizei[$i] = $addimg["size"][$i]; 
        $fileErrorMsgi[$i] = $addimg["error"][$i]; 
        $fileTypei[$i] = $addimg["type"][$i]; 
        $fileSpliti[$i] = explode(".", $filenamei[$i]); 
        $fileExti[$i] = end($fileSpliti[$i]); 
        
        $newfilenamei[$i]=$newaddname."-$kodeprod-$uu.".$fileExti[$i];

        if($fileTempi[$i]){
            if($fileSizei[$i] > 2000000) {
                echo "ERROR: Ukuran file melebihi batas 2 MB.";
                unlink($fileTempi[$i]); 
                exit();
            }else if (!preg_match("/.(gif||jpg||png||jpeg)$/i", $newfilenamei[$i]) ) {        
                echo "ERROR: File harus dalam format JPG or PNG.";
                    unlink($fileTempi[$i]); 
                    exit();		 
            }else if ($fileErrorMsgi[$i] == 1) {
                echo "ERROR: Gagal memproses penambahan data, mohon coba lagi.";
                exit();
            }
        }

        $targetdir[$i]=$dir.$newfilenamei[$i];
		$moveResult[$i] = move_uploaded_file($fileTempi[$i], $targetdir[$i]);
		if ($moveResult[$i] != true) {
			echo "ERROR: File not uploaded. Try again.";
			unlink($fileTempi[$i]); 
			exit();
		}else{
            $target_file[$i] = $targetdir[$i];
            $resized_file[$i] = $dir."resized-".$newfilenamei[$i];
            $wmax = 150;
            $hmax = 150;
            $resizing[$i]=img_resize($target_file[$i], $resized_file[$i], $wmax, $hmax, $fileExti[$i]);
            
        }

        $x.="||".$targetdir[$i];
        $imgpath.="||".$dir."resized-".$newfilenamei[$i];

        

    }

    $insprod=array(
        "product_brand"=>$merkprod,
        "product_substitute"=>$daftarsubstitusi,
        "product_name"=>$namaprod,
        "product_code"=>$kodeprod,
        "category"=>$daftarkat,
        "description"=>$ketprod,
        "harga_modal"=>$harga0,
        "harga_dealer"=>$harga1,
        "harga_umum"=>$harga2,
        "harga_pasang"=>$hargapasang,
        "panjang"=>$panjang,
        "lebar"=>$lebar,
        "tinggi"=>$tinggi,
        "berat"=>$berat,
        "img"=>$imgpath,
        "supplier"=>$sup,
        "grade"=>$grade,
        "negara_pembuat"=>$negara,
        "satuan"=>$satuan,
        "no_part"=>$nopart,
        "merk_part"=>$merkpart,
        "kendaraan_pengguna"=>$kendaraanpengguna,
        "add_by"=>$aid,
        "add_dt"=>$sekarang,
    );

    $acta=$db->insert("product",$insprod);


    $inslog=array(
         "admin_id"=>$aid,
        // "user_id"=>$uid,
        "datetime"=>$now,
        "relevance"=>"menambah Data Produk $namaprod ($kodeprod)",
    );
    $actl=$db->insert("log",$inslog);

    if($acta && $actl){
        echo "ok";
    }else{
        echo "Gagal memproses penambahan produk, mohon coba lagi";
    }


}

if(isset($_POST['populateselect'])){
    $ubah=$_POST['ubah'];
    $tingkat=$_POST['populateselect'];
    $targetval=$_POST['targetval'];
    $populated='';
    $divempty='';

    if($ubah=='ubah'){
        $divempty='errmsgubahprod';
    }else{
        $divempty='errmsgaddprod';
    }

    $tklnjt=$tingkat+1;

    // echo "ubah = $ubah";

    $cek=$db->fetchwhere("category","related='$targetval' and data_status=0");
    if(count($cek)>0){
        foreach($cek as $cekk){
            $rid=$cekk['id'];
            $populated.="<option value='$rid'>".ucwords($cekk['name'])."</option>";
        }
        echo "
            <div class='row mb-3'>
                <div class='col-md-3 col-sm-12 align-self-center'>
                    Sub Kategori
                </div>
                <div class='col'>
                    <div class='input-group'>
                        <select class='form-control categoryselected' id='selectcategory$tklnjt' onchange='populateselect(this,\"$tklnjt\",\"$ubah\")' onfocus=\"empty('$divempty')\">
                            <option value=''>-----</option>
                            $populated
                        </select>
                    </div>
                </div>
            </div>
        ";
    }else{
        echo "done";
    }
    
}



if(isset($_POST['formtype'])){
    $type=$_POST['formtype'];
    $table=$_POST['table'];
    

    if($type=='checkrefdef'){
        $e=$_POST['refemail'];
        if($e==''){
            echo "none";
        }else{
            $ceke=$db->fetchwhere("user","email='$e'");
            if(count($ceke)<1){
                echo "nodb";
            }else{
                // echo "ok";
                foreach($ceke as $ce){
                    $fn=$ce['fname'];
                    $ln=$ce['lname'];
                    $full=ucwords($fn).' '.ucwords($ln);
                }
                echo "<span class='badge badge-primary'>$full</span>";
            }
        }

       
        

    }
    if($type=='editadmin'){
        $aid=$_POST['aid'];
        $fn=$_POST['afname'];
        $ln=$_POST['alname'];
        $af=$_POST['afon'];
        $aemail=$_POST['aemail'];
        $whereu=array("id"=>$aid);
        // echo "aid : $aid, fn : $fn, ln : $ln, af : $af";
        $updateu=array(
            "fname"=>$fn,
            "lname"=>$ln,
            "phone"=>$af,
        );
        $a=$db->update("adm",$whereu,$updateu);

        $insertb=array(
            "action"=>"Change Profile",
            "actor"=>ucwords($fn)." ".ucwords($ln),        
            "actor_id"=>$aid,
            "actor_email"=>$aemail,
            "datetime"=>$now,
            "isadmin"=>1,
        );
        $c=$db->insert("log",$insertb);


        if($a){
            echo "ok";
        }else{
            echo "Failed changing profile, plese try again";
        }
    }
    if($type=='editpass'){
        $aid=$_POST['aid'];
        $cp=$_POST['curpas'];
        $np=$_POST['newpas'];

        // $pass='';
        $a=$db->fetchwhere("adm","id='$aid'");
        foreach($a as $as){
            $passdb=$as['password'];
            $fnamedb=$as['fname'];
            $lnamedb=$as['lname'];
        }
        $hashcp=hash('sha256',$cp);
        $hashnp=hash('sha256',$np);
        if($hashcp != $passdb){
            echo "Wrong Current Password";
        }else{
            // echo "passdb : $passdb, aid : $aid, cp : $cp, np : $np";
            // echo "pass : $passdb, cp : $cp, hashcp : $hashcp";

            
            $whereb=array("id"=>$aid);
            $updateb=array("password"=>$hashnp);
            $b=$db->update("adm",$whereb,$updateb);

            $insertb=array(
                "action"=>"Change Password",
                "actor"=>ucwords($fnamedb)." ".ucwords($lnamedb),
                "actor_id"=>$aid,
                "datetime"=>$now,
                "isadmin"=>1,
            );
            $c=$db->insert("log",$insertb);
            if($b){
                echo "ok";
            }else{
                echo "Failed changing password, please try again";
            }
        }
    }
    if($type=='reg'){
        $default_ref='';
        $default_refcode='';
        $cektesconf=$db->fetch("config");
        $confdb=$db->fetchorderlimit("config","id desc",1);
        foreach($confdb as $abc){
            $default_ref=$abc['default_ref'];	
        }

        $e=$_POST['email'];
        if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format"; 
            exit();
        }

        $fn=$_POST['fn'];
        $ln=$_POST['ln'];
        $p=$_POST['p'];
        $re=$_POST['re'];
        $idc=$_POST['idc'];
        $cre='';
        
        if($re==''){
            $referee='default'; // ini bagusnya ganti jadi default nih 
            //$referee=$default_ref; // ini bagusnya ganti jadi default nih 
        }else{
            $cre=$db->fetchwhere("user","email='$re'");
            if(count($cre)<1){
                $referee='default'; // harusnya juga jadi defaul aja ya
                //$referee=$default_ref; // harusnya juga jadi defaul aja ya
            }else{
                foreach($cre as $cer){
                    $referee=$cer['reference'];
                }
            }
        }        
        $refcode=hash('sha256',$now.$e);
        $cemail=$db->fetchwhere("user","email='$e'");
        if(count($cemail)>0){
            echo "Email <u>$e</u> Already Registered";
        }else{
            $masukan=array(
                "email"=>$e,
                "fname"=>$fn,
                "lname"=>$ln,
                "password"=>hash('sha256',$p),
                "referee"=>$referee,
                "reference"=>$refcode,
                "join_time"=>$now,
            );
            
            $insertmember=$db->insert("user",$masukan);


            $updatelog=array(
                // "admin_id"=>$aid,
                "user_id"=>$uid,
                "datetime"=>$now,
                "relevance"=>"$table $e registering",

            );
            $db->insert("log",$updatelog);

            //level 1 cari tabel user yg reference code nya sama dengan referee dari yg daftar ini, masukin ke referal 1
            $cekreferee1=$db->fetchwhere("user","reference='$referee'");
            // echo "count ref 1 : $cekreferee1";
            if(count($cekreferee1)>0){
                foreach($cekreferee1 as $cr1){
                    $refid1=$cr1['id'];
                    $referee1=$cr1['referee'];
                    $referal1=$cr1['referal'];
                }
                //update referee nya
                $where=array("id"=>$refid1);
                if($referal1!=''){
                    $updatean1=array("referal"=>$referal1.",".$e);
                }else{
                    $updatean1=array("referal"=>$e);
                }
                $db->update("user",$where,$updatean1);

              
            }
            
            // if($insertmember){

                
            //     $mailsubject="GIC Trade Account Activation";
            //     $mailname="GIC Trade Support";                
            //     $mailfromwho="GIC Trade Support";
            //     $failmsg='Registration Failed, please try again';
            //     $mailbody.=mailtemplateheader();
            //     $mailbody.="<p>Halo <b>".ucwords($fn)." ".ucwords($ln)."</b> Terima kasih telah mendaftar pada program       GIC Trade</p><br/>
            //             <p>Kami segenap Tim GIC Trade menyambut hangat dan mengucapkan Selamat datang kepada anda yang telah melakukan langkah cerdas, meraih peluang sukses bersama GIC Trade<p>
            //             <p>Mohon klik tautan berikut untuk mengaktifkan akun Anda</p>
            //             <hr/>
            //             <h4><a href='http://gictrade.io/privatesale/activation.php?e=".$refcode."'>Account Activation</a></h4>
            //             <hr/>
            //             <p>Anda dapat menggunakan link referal yang telah kami siapkan di dalam akun untuk mengundang teman dan kerabat Anda</p>
            //             <p>Untuk mendapatkan informasi eksklusif mengenai promo, kompetisi, dan update proyek kami, silahkan join di Facebook Group dan Telegram Group GIC Trade !<p>
            //             <br/>
                        
            //             <h4>Telegram Group : </h4>
            //             <a href='http://t.me/GicTrade'>
            //                 http://t.me/GicTrade
            //             </a>
            //             <h4>Facebook Group : </h4>
            //             <a href='http://Www.facebook.com/gictradeio/'>
            //                 http://Www.facebook.com/gictradeio/
            //             </a>
            //             <br/>
            //             </p>Terima kasih atas dukungannya</p>
            //             <br/><br/>
            //             <p>Salam sukses bersama,<br/>
            //             Tim GICTrade</p>";
            //     $mailbody.=mailtemplatefooter();
                        

            //     $mailbodyalt="Terima kasih telah mendaftar pada program GIC Trade

            //             Kami segenap Tim GIC Trade menyambut hangat dan mengucapkan Selamat datang kepada anda yang telah melakukan langkah cerdas, meraih peluang sukses bersama GIC Trade 

            //             Mohon klik tautan berikut untuk mengaktifkan akun Anda.
            //             http://gictrade.io/privatesale/activation.php?e=".$refcode."
                        
            //             Anda dapat menggunakan link referal yang telah kami siapkan di dalam akun untuk mengundang teman dan kerabat Anda.
                        
            //             Untuk mendapatkan informasi eksklusive mengenai promo, kompetisi, dan update proyek kami, silahkan join di Facebook Group dan Telegram Group GIC Trade !
                        
            //             Telegram Group : 
            //                 http://t.me/GicTrade
                            
            //             Facebook Group : 
            //                 http://Www.facebook.com/gictradeio/
                        
            //             Terima kasih atas dukungannya,
                        
            //             Salam sukses bersama,
            //             Tim GICTrade
                
            //             ";

            //     $sending=sendmailto($e,$fn, $mailsubject,$mailname,$mailfromwho,$mailbody,$mailbodyalt);
            
            //     if(!$sending) {
            //         echo $failmsg;                
            //     } else {
            //         echo 'ok';
            //     }
            // }else{
            //     echo $failmsg;
            // }
        }
    }
    
    if($type=='log'){
        $e=$_POST['e'];
        $p=$_POST['p'];
        
        // $fa=$_POST['fa'];

        // echo "tabel : $table, e : $e, p : $p";
       
        if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid Email Format"; 
            exit();
        }

        $cek=$db->fetchwhere($table,"email='$e'");
        $itung=count($cek);
        
        // $lanjut='';            
        if($itung<1){
            echo "Email <u>$e</u> Not Registered";        
        }else{
            foreach($cek as $ceks){
                $uid=$ceks['id'];
                $passworddb=$ceks['password'];
                // $facode=$ceks['fa'];
                $accstat=$ceks['account_status'];
            }
            // echo "fa : $fa";
            if(hash('sha256',$p) != $passworddb){
                echo "Incorrect Password";                
            }else{
                if($accstat=='0'){
                    echo "Account Not Activated";
                }else if($accstat=='2'){
                    echo "Account Blocked";
                }else{
                    // if($facode!=''){
                    //     if($fa==''){
                    //         echo "2FA Code is empty";
                    //     }else{
                    //         $cek=$auth->verifyCode($facode,$fa,2);
                    //         if($cek){
                    //             $lanjut='ok';
                    //         }else{
                    //             echo "Wrong FA Code";
                    //         }
                    //     }
                    // }else{
                    //     $lanjut='ok';
                    // }
    
                    // if($lanjut=='ok'){
                        $whereus=array("id"=>$uid);
                        $updateus=array("last_log"=>$now);
                        $db->update($table,$whereus,$updateus);
        
                        $wherelog=array(
                            "user_id"=>$uid,
                            "datetime"=>$now,
                            "relevance"=>"$table $e logging in",
                        );
                        $db->insert("log",$wherelog);
        
                        SESSION_START();
                        if($table=='admin'){
                            $_SESSION['aid']=$uid;
                        }else if($table=='cabang'){
                            $_SESSION['cbgid']=$uid;                            
                        }else{
                            $_SESSION['penjid']=$uid;                            
                        }
                        echo "ok";        
                    // }
                }
            }           

        }
    }

    if($type=='changeref'){
       


        $newref=$_POST['newref'];
        $uid=$_POST['uid'];
        $aid=$_POST['aid'];
        $jmlold="ga ada";
        $updatelama=true;
        $updatebaru=true;
        $updatedewek=true;


        if($newref==''){
            echo "Referrer Email Is Empty";
        }else{
            $cu=$db->fetchwhere("user","id='$uid'");
            foreach($cu as $cus){
                $oldref=$cus['referee'];
                $myemail=$cus['email'];
            }



            // $myemail='abcde';

            if($oldref!=''){
                $cuoldref=$db->fetchwhere("user","reference='$oldref'");
                $jmlold=count($cuoldref);
               
                if($jmlold>0){
                    foreach($cuoldref as $co){
                        $oldrefs=$co['referal'];
                    }
                    $oldrefsex=explode(',',$oldrefs);

                    $target=in_array($myemail,$oldrefsex);
                    if($target){
                        $s=array_search($myemail,$oldrefsex);
                        unset($oldrefsex[$s]);
                        $newrefsex=implode(",",$oldrefsex);
                        $whereuu=array("reference"=>$oldref);
                        $updateuu=array("referal"=>$newrefsex);
                        $updatelama=$db->update("user",$whereuu,$updateuu);
                    }                   
                }
            }

            //giliran ref baru
            // echo "newref : $newref";
            $cunewref=$db->fetchwhere("user","email='$newref'");
            foreach($cunewref as $cn){
                $newrefs=$cn['referal'];
                $newrefcode=$cn['reference'];
            }

            if($newrefs!=''){
                $newrefupdate=$newrefs.",".$myemail;
                //tambahin dengan ,
            }else{
                //ga usah pake koma
                $newrefupdate=$myemail;
            }
            $whereuuu=array("email"=>$newref);
            $updateuuu=array("referal"=>$newrefupdate);
            $updatebaru=$db->update("user",$whereuuu,$updateuuu);


            $whereu=array("id"=>$uid);
            $updateu=array("referee"=>$newrefcode);
            $udpatedewek=$db->update("user",$whereu,$updateu);

            if($updatebaru && $updatelama && $updatedewek){

                $cadm=$db->fetchwhere("adm","id='$aid'");
                foreach($cadm as $ca){
                    $admemail=$ca['email'];
                    $admfname=$ca['fname'];
                    $admlname=$ca['lname'];
                }

                $masukanl=array(
                    "action"=>"Edit Referrer of $myemail",
                    "actor"=>ucwords($admfname)." ".ucwords($admlname),
                    "actor_id"=>$aid,
                    "actor_email"=>$admemail,
                    "isadmin"=>1,
                    "datetime"=>$now,
                );
                $db->insert("log",$masukanl);
                echo "ok";
            }

            // echo "newrefs : $newrefs";



            //dia nya sendiri nanti referee nya ganti dengan kode ref dari newref ini

        //     // $cup=$db->fetchwhere("user","reference='$curref'");
        //     // foreach($cup as $cups){
        //     //     $curupref=$cu['referal'];
        //     //     echo "curupref : $curupref";
        //     // }
        }
        // echo "ok";
    }

    if($type=='checkrefemail'){
        $refemail=$_POST['refemail'];
        $userid=$_POST['uid'];
        $cref=$db->fetchwhere("user","email='$refemail'");
        $cu=$db->fetchwhere("user","id='$userid'");
        if(count($cref)<1){
            echo "none";
        }else{
            foreach($cref as $crs){
                $reffname=$crs['fname'];
                $reflname=$crs['lname'];
                $refreferee=$crs['referee'];
            }
            foreach($cu as $cus){
                $refcode=$cus['reference'];
                $cuemail=$cus['email'];
            }
            // echo "refcode : $refcode, refreferee : $refreferee";

            if($refcode == $refreferee){
                echo "invalid";
            }else if($cuemail==$refemail) {
                echo "same";
            }else{
                echo ucwords("<a class='text-primary'>".ucwords($reffname)." ".ucwords($reflname)."</a>");
            }
            // echo "ref code this user : $refcode, referee that user : $refreferee";

            

            //kalo refemail nya ada punyra referee nya akun ini, maka harusnya ga bisa

            // echo "This email is the referral of this account";


        }
    }

    if($type=='forgot'){
        $e=$_POST['e'];
        $cu=$db->fetchwhere("user","email = '$e'");
        $ccu=count($cu);
        if($ccu<1){
            echo "Email Not Registered";
        }else{
            $r=randomPassword(10);
            $fn='';
            // $r='asdf';
            $rsha=hash('sha256',$r);
            $whereu=array("email"=>$e);
            $updateu=array("password"=>$rsha);
            $upu=$db->update("user",$whereu,$updateu);
            if($upu){
                $mailsubject="GIC Trade Password Generator";
                $mailname="GIC Trade Support";                
                $mailfromwho="GIC Trade Support";
                $failmsg='Generating Password Failed, try again';
                $mailbody.=mailtemplateheader();
                $mailbody.="<h4>Forgot Your Password ?</h4>
                            <p>Hello There, Here is the new generated password you can use to log in to GIC Trade account</p>
                            <hr/>
                            <h3>$r</h3>
                            <hr/>
                            <p>Upon logging in you can change it in the security settings to your custom password</p>
                            <br/>
                        
                            <h4>Telegram Group : </h4>
                            <a href='http://t.me/GicTrade'>
                                http://t.me/GicTrade
                            </a>
                            <h4>Facebook Group : </h4>
                            <a href='http://Www.facebook.com/gictradeio/'>
                                http://Www.facebook.com/gictradeio/
                            </a>
                            <br/>
                            </p>Terima kasih atas dukungannya</p>
                            <br/><br/>
                            <p>Salam sukses bersama,<br/>
                            Tim GICTrade</p>";
                $mailbody.=mailtemplatefooter();
                        

                $mailbodyalt="Forgot Your Passwordd ? 
                            <p>Hello There, Here is the new generated password you can use to log in to GIC Trade account
                            
                            $rsha
                            
                            Upon logging in you can change it in the security settings to your custom password
                            
                        
                            Telegram Group :
                                http://t.me/GicTrade
                            
                            Facebook Group :
                                http://Www.facebook.com/gictradeio/
                            
                            Terima kasih atas dukungannya
                            
                            Salam sukses bersama,
                            Tim GICTrade";



                $sending=sendmailto($e,$fn, $mailsubject,$mailname,$mailfromwho,$mailbody,$mailbodyalt);
            
                if(!$sending) {
                    echo $failmsg;                
                } else {
                    echo 'ok';
                }
            }else{
                echo $failmsg;
            }
        }
    }
}

if(isset($_FILES['dokumen'])){
    $what=$_POST['what'];
    $aid=$_POST['aid'];
    $dokumen=$_FILES['dokumen'];
    $sukses=true;

    $tmp=$_FILES['dokumen']['tmp_name'];
    $handle=fopen($tmp,"r");
    while(($isi=fgetcsv($handle,1000,";"))!==false){
        if($what=='cabang'){
            $name=$isi[0];
            $email=$isi[1];
            $password=$isi[2];
            $phone=$isi[3];
            $address=$isi[4];
            $role=$isi[5];
            $ins1=array(
                "name"=>$name,
                "email"=>$email,
                "password"=>$password,
                "phone"=>$phone,
                "address"=>$address,
                "role"=>$role,
            );
        }
        if($what=='product'){

//yg belum :
    //1. kategori
    //2. suplier 
    //3. img 
    //4. negara
    //5. satuan 
    //6. no part
    //7. merk part 
    //8. kendaraan pengguna
    //9. berat 
    //10. panjang
    //11. lebar 
    //12. tinggi

//yg perlu gw siapin :
    //1. daftar kategori
    //2. daftar suplier
    //3. daftar kendaraan

//bakalan nya ribet kalo misal kaya gini 
//mendingan gw siapin seadanya aja, biar dia 
//bisa ubah sendiri dari panel admin nya 


            $ins1=array(
                "product_name"=>$isi[0],
                "product_brand"=>$isi[1],
                "product_code"=>$isi[2],
                "description"=>$isi[3],
                "harga_modal"=>$isi[4],
                "harga_dealer"=>$isi[5],
                "harga_umum"=>$isi[6],
                "harga_pasang"=>$isi[7],
                "grade"=>$isi[8],
            );
        }


        $act1=$db->insert($what,$ins1);
        if(!$act1){
            $sukses=false;
            break;
        }

        // echo $isi[1];
        //echo "nama : $name, email : $email, password : $password, phone : $phone<br/>";
    }
    if($sukses){
        echo "ok";
    }else{
        echo "gagal";
    }

    // print_r($dokumen);


}
if(isset($_FILES['dokumenexcel'])){
    $what=$_POST['what'];
    $aid=$_POST['aid'];
    $dokumen=$_FILES['dokumenexcel'];
    $sukses=true;

    $tmp=$_FILES['dokumen']['tmp_name'];
    $handle=fopen($tmp,"r");
    while(($isi=fgetcsv($handle,1000,";"))!==false){
        if($what=='cabang'){
            $name=$isi[0];
            $email=$isi[1];
            $password=$isi[2];
            $phone=$isi[3];
            $address=$isi[4];
            $role=$isi[5];
            $ins1=array(
                "name"=>$name,
                "email"=>$email,
                "password"=>$password,
                "phone"=>$phone,
                "address"=>$address,
                "role"=>$role,
            );
        }
        if($what=='product'){
            $ins1=array(
                "product_name"=>$isi[0],
                "product_brand"=>$isi[1],
                "product_code"=>$isi[2],
                "description"=>$isi[3],
                "harga_modal"=>$isi[4],
                "harga_dealer"=>$isi[5],
                "harga_umum"=>$isi[6],
                "harga_pasang"=>$isi[7],
                "grade"=>$isi[8],
            );
        }


        $act1=$db->insert($what,$ins1);
        if(!$act1){
            $sukses=false;
            break;
        }

        // echo $isi[1];
        //echo "nama : $name, email : $email, password : $password, phone : $phone<br/>";
    }
    if($sukses){
        echo "ok";
    }else{
        echo "gagal";
    }

    // print_r($dokumen);


}

if(isset($_POST['ubahseting'])){
    // echo "abc";
    $aid=$_POST['ubahseting'];
    $np=$_POST['np'];
    $slogan=$_POST['slogan'];
    $logo='';
    $email=$_POST['email'];
    $telepon=$_POST['telepon'];
    $hp=$_POST['hp'];
    $alamat=$_POST['alamat'];
    $wa=$_POST['wa'];
    $insta=$_POST['insta'];
    $now2=$now;
    $insc0=array();

    // $uploadimg='wew';
    $confdb=$db->fetchorderlimit("configuration","id desc",1);
    if(count($confdb)>0){
        foreach($confdb as $abc){
            $oldpath=$abc['logo'];	
        }
    }else{
        $oldpath='';
    }
    $dir="../images/";
    $jam=date("His");
    $newname="logo";
    $insc0=[];
    if(isset($_FILES['logo'])){
        $logo=$_FILES['logo'];
        $orimainimgname=$logo['name'];
        $fileSplit = explode(".", $orimainimgname); 
        $fileExt = end($fileSplit); 
        $uploadimg=imguploadprocesswithreplace($oldpath,$logo,$dir,$newname); 
        if($uploadimg=='big'){
            echo "ERROR: Image size is more then 2 MB.";
            exit();
        }else if($uploadimg=='ext'){
            echo "ERROR: file is not JPG or PNG.";
            exit();
        }else if($uploadimg=='err'){
            echo "ERROR: An error occured while processing file. Try again.";
            exit();
        }else if($uploadimg=='err2'){
            echo "ERROR: File not uploaded. Try again.";
            exit();

        }else{
            $insc0=array("logo"=>$dir.$newname.'.'.$fileExt);
        }
    }

    // echo "woi";


    $insc=array(
        "namaperusahaan"=>$np,
        "slogan"=>$slogan,
        
        "alamat"=>$alamat,
        "email"=>$email,
        "telepon"=>$telepon,
        "hp"=>$hp,
        "wa"=>$wa,
        "insta"=>$insta,
        "add_by"=>$aid,
        "added_dt"=>$now2,
    );
    $insc=array_merge($insc0,$insc);
    $acta=$db->insert("configuration",$insc);

    $insl=array(
        "action"=>"Ubah Konfigurasi",
        "admin_id"=>$aid,
        "datetime"=>$now2,
        "relevance"=>"Konfigurasi",
    );
    $actl=$db->insert("log",$insl);

    if($acta && $actl){
        echo "ok";
    }else{
        echo "gagal";
    }
}

if(isset($_POST['managedata'])){
    $act=$_POST['managedata'];
    $table=$_POST['table'];
    $dataid=$_POST['dataid'];
    $aid=$_POST['aid'];
    $now2=$now;
    if($act=='delete'){
        if($table=='banner'){
            $cekimg=$db->fetchwhere("banner","id='$dataid'");
            foreach($cekimg as $ci){
                $ciimg=$ci['img'];
            }
            if($ciimg!=''){
                unlink($ciimg);
            }
        }
        $wherea=array("id"=>$dataid);
        $acta=$db->delete($table,$wherea);
        $insl=array(
            "action"=>"Hapus Data $table",
            "admin_id"=>$aid,
            "datetime"=>$now2,
            "relevance"=>"$table id $dataid",
        );
        $actl=$db->insert("log",$insl);
    }

    if($act=='block' || $act=='unblock'){
        if($act=='block'){
            $targetstatus=2;
            $targetinfo="Blocking";
        }else{
            $targetstatus=1;
            $targetinfo="Unblocking";
        }
        $whereu=array("id"=>$dataid);
        $updateu=array("data_status"=>$targetstatus,"mod_by"=>$aid,"mod_dt"=>$now2);
        $acta=$db->update($table,$whereu,$updateu);
        $wherel=array(
            "action"=>ucwords($act)." Data $table",
            "admin_id"=>$aid,
            "datetime"=>$now2,
            "relevance"=>"$table id $dataid",
        );
        $actl=$db->insert("log",$wherel);    
    } 

    if($acta && $actl){
        echo "ok";
    }else{
        echo "Proses Gagal";
    }
}

if(isset($_POST['tambahkandatabase'])){

    $aid=$_POST['tambahkandatabase'];
    $apa=$_POST['apa'];
    $judul=$_POST['judul'];
    $ket=$_POST['ket'];
    $promoid='';
    $now2=$now;

    $tipe='';
    $kode='';
    $potongan='';
    $mulai='';
    $ahir='';
    $arrproduk='';

    if($apa=='promo'){
        $peruntukan=$_POST['peruntukan'];
        $kode=$_POST['kode'];
        $potongan=$_POST['potongan'];
        $tipepotongan=$_POST['tipepotongan'];
        $kuota=$_POST['kuota'];
        $sk=$_POST['sk'];
        // $channel=$_POST['channel'];
        $maxpotongan=$_POST['maxpotongan'];
        $minbelanja=$_POST['minbelanja'];
        $mulai=$_POST['mulai'];
        $ahir=$_POST['ahir'];
        $arrproduk=$_POST['arrproduk'];
        
        //cekudaada kode belum
        $cp=$db->fetchwhere("promotion","code='$kode'");
        if(count($cp)>0){
            echo "Kode promo sudah ada";
            exit();
        }
    }

    if($apa=='flash'){
        $bisa=true;
        $sk=$_POST['sk'];
        $mulai=$_POST['mulai'];
        $ahir=$_POST['ahir'];
        $dataflash=$_POST['dataflash'];

        $cekmulai=$db->fetchwhere("flash","data_status<2");

        foreach($cekmulai as $cm){
            $dbmulai=$cm['promo_start'];
            $dbahir=$cm['promo_end'];
            if(($mulai>=$dbmulai) && ($mulai<$dbahir)){
                $bisa=false;
                echo "kondisi 1 gagal";
                break;
            }else{
                if($mulai<$dbmulai){
                    if($ahir>$dbmulai){
                        echo "ahir : $ahir, dbmulai : $dbmulai, === kondisi 2 gagal";
                        $bisa=false;
                        break;
                    }
                }
            }
        }
        if(!$bisa){
            echo "Sudah ada flash sale lain di periode ini";
            exit();
        }
    }


    $img='';
    $imgpath='';
    if(isset($_FILES['img'])){
        $img=$_FILES['img'];
   
        $dir="../images/$apa/";
        $oriimgname=$img['name'];
        $fileSplit = explode(".", $oriimgname); 
        $fileExt = end($fileSplit); 
        $jam=date("His");
        $newname="$apa-resbig-$jam";
        $uploadimg=imguploadprocesswithresizebig($img,$dir,$newname); 

        if($uploadimg=='big'){
            echo "ERROR: Image size is more then 2 MB.";
            exit();
        }else if($uploadimg=='ext'){
            echo "ERROR: file is not JPG or PNG.";
            exit();
        }else if($uploadimg=='err'){
            echo "ERROR: An error occured while processing file. Try again.";
            exit();
        }else if($uploadimg=='err2'){
            echo "ERROR: File not uploaded. Try again.";
            exit();
        }else if($uploadimg=='ok'){
            $imgpath=$dir.'resized-'.$newname.".".$fileExt;
        }
    }

    $tabledb=$apa;

    if($apa=='flash'){
        $insdata=array(
            "title"=>$judul,
            "description"=>$ket,
            "terms"=>$sk,
            "img"=>$imgpath,
            "promo_start"=>$mulai,
            "promo_end"=>$ahir,
            "add_by"=>$aid,
            "add_dt"=>$now2,
        );
    }else if($apa=='promo'){
        $tabledb='promotion';
        $insdata=array(
            "title"=>$judul,
            "code"=>$kode,
            "description"=>$ket,
            "discount"=>$potongan,
            "discount_type"=>$tipepotongan,
            "discount_max"=>$maxpotongan,
            "terms"=>$sk,
            "min_purchase"=>$minbelanja,
            "peruntukan"=>$peruntukan,
            "produk"=>$arrproduk,
            "img"=>$imgpath,
            "kuota"=>$kuota,
            "promo_start"=>$mulai,
            "promo_end"=>$ahir,
            "add_by"=>$aid,
            "add_dt"=>$now2,
        );

       

    }else{
        $insdata=array(
            "title"=>$judul,
            "img"=>$imgpath,
            "banner_status"=>1,
            "description"=>$ket,
            "promo_id"=>$promoid,
            "add_by"=>$aid,
            "add_dt"=>$now2,        
        );
    }

    // echo
    //     "title : ".$judul."<br/>".
    //     "code : ".$kode."<br/>".
    //     "description : ".$ket."<br/>".
    //     "discount : ".$potongan."<br/>".
    //     "produk : ".$arrproduk."<br/>".
    //     "img : ".$imgpath."<br/>".
    //     "type : ".$tipe."<br/>".
    //     // "promo_start".$mulai."<br/>".
    //     // "promo_end".$ahir."<br/>".
    //     "add_by : ".$aid."<br/>".
    //     "add_dt : ".$now2."<br/>"
    // ;


    if($apa=='flash'){
        $acta=$db->insertreturnid($tabledb,$insdata);
   

        $dataexp=explode(",",$dataflash);


        for($i=0;$i<count($dataexp);$i++){
            $ins2=[];
            $dataprod[$i]=$dataexp[$i];
            $dataprodexp[$i]=explode("||",$dataprod[$i]);
            $prodid[$i]=$dataprodexp[$i][0];
            $kuota[$i]=$dataprodexp[$i][1];
            $hargaflash[$i]=$dataprodexp[$i][2];
            
            
            $ins2=array(
                "promo_id"=>$acta,
                "product_id"=>$prodid[$i],
                "flash_price"=>$hargaflash[$i],
                "kuota"=>$kuota[$i],
                "add_by"=>$aid,
                "add_dt"=>$now2,
            );
            $acta2=$db->insert("flash_product",$ins2);
        }

    // if($acta){echo "wew";}else{ echo "wiw";};
    }else{
        $acta=$db->insert($tabledb,$insdata);
    }

    $inslog=array(
        "action"=>"Menambah Data ".ucwords($apa),
        "admin_id"=>$aid,
        "datetime"=>$now2,
        "relevance"=>$apa,
    );
    $actl=$db->insert("log",$inslog);

    if($apa=='flash'){
        $acta=true;
    }
    if($acta && $actl){
        echo "ok";
    }else{
        echo "Gagal memproses penambahan $apa, mohon coba lagi";
    }

}

if(isset($_POST['ubahproduk'])){    
    $aid=$_POST['ubahproduk'];
    $pid=$_POST['pid'];
    $table='product';
    
    $now2=$now;   
    // $namamitra=ucwords($_POST['namamitra']);
    $daftarkat=$_POST['daftarkat'];
    $sup=$_POST['sup'];
    $grade=$_POST['grade'];
    $negara=$_POST['negara'];
    $satuan=$_POST['satuan'];
    $merkprod=$_POST['merkprod'];
    $namaprod=$_POST['namaprod'];
    $kodeprod=$_POST['kodeprod'];
    $ketprod=$_POST['ketprod'];
    $nopart=$_POST['nopart'];
    $merkpart=$_POST['merkpart'];
    $harga0=$_POST['harga0'];
    $harga1=$_POST['harga1'];
    $harga2=$_POST['harga2'];
    $panjang=$_POST['panjang'];
    $lebar=$_POST['lebar'];
    $tinggi=$_POST['tinggi'];
    $berat=$_POST['berat'];
    $hargapasang=$_POST['hargapasang'];
    $kendaraanpengguna=$_POST['kendaraanpengguna'];
    $daftarsubstitusi=$_POST['daftarsubstitusi'];
    // $merkpart=$_POST['merkpart'];
    // $merkpart=$_POST['merkpart'];

    $dbmainimg='';
    $dbaddimg=[];

    $arrbaru='';
    $arruploadbaru='';


    $cekdatatabel=$db->fetchwhere("product","id='$pid'");
    foreach($cekdatatabel as $cdtid){
        $dbimg=$cdtid['img'];
    }
    if($dbimg!=''){
        $dbimgexp=explode("||",$dbimg);
        
        $dbmainimg=$dbimgexp[0];

        for($t=0;$t<count($dbimgexp);$t++){
            if($t==0){
                $dbmainimg=$dbimgexp[0];
            }else{
                array_push($dbaddimg,$dbimgexp[$t]);
            }
        }
    }




    // echo "db main img : $dbmainimg";
    
        
    $checkktp=$db->fetchwhere($table,"product_code='$kodeprod' and id!='$pid'");
    if(count($checkktp)>0){
        echo "Kode produk sudah terdaftar untuk produk lain";
        exit();
    }

   
    
    
    // $imgpath='';
    $dir="../images/product/";

    // // echo "data id : $dataid";
    
    $fotoygmauada=[];
    $fotoygmaudibuang=[];

    if(isset($_FILES['mainimg'])){
        $newname="res-prod-";
        $fotoutama=$_FILES['mainimg'];
        $orimainimgname=$fotoutama['name'];
        $fileSplit = explode(".", $orimainimgname); 
        $fileExt = end($fileSplit); 

        $uploadimg=imguploadprocesswithreplace($dbmainimg,$fotoutama,$dir,$newname); 
        if($uploadimg=='big'){
            echo "ERROR: Image size is more then 2 MB.";
            exit();
        }else if($uploadimg=='ext'){
            echo "ERROR: file is not JPG or PNG.";
            exit();
        }else if($uploadimg=='err'){
            echo "ERROR: An error occured while processing file. Try again.";
            exit();
        }else if($uploadimg=='err2'){
            echo "ERROR: File not uploaded. Try again.";
            exit();
        }else{
            // $fotoutamaarrnol
            // array_push($fotoutamaarrnol,$dir.$newname.$fotoutama['name']);
            $dbmainimg=$dir.$newname.$fotoutama['name'];
        }
    }

    // echo "dbmain img : $dbmainimg";

   
   
    $remainingimg=array();
    $expiredimg=array();

    $imgtersisa=[];
    if(isset($_POST['fotosudahada'])){
        $imgtersisa=$_POST['fotosudahada'];
    }


    $imgtersisaarr=[];
    // // echo "img tersisa : ".count($imgtersisa);
    for($t=0;$t<count($imgtersisa);$t++){
        $imgtersisa[$t]=explode("/",$imgtersisa[$t]);
        $splitcount[$t]=count($imgtersisa[$t]);
        $imgtersisadir[$t]="../".$imgtersisa[$t][$splitcount[$t]-3]."/".$imgtersisa[$t][$splitcount[$t]-2]."/".$imgtersisa[$t][$splitcount[$t]-1];
        array_push($imgtersisaarr,$imgtersisadir[$t]);
    }

    // print_r($addimg);

    if($dbaddimg!=''){
        foreach($dbaddimg as $dbiexp){
            if(in_array($dbiexp,$imgtersisaarr)){
                array_push($remainingimg,$dbiexp);
                $arrbaru.='||'.$dbiexp;
            }else{
                array_push($expiredimg,$dbiexp);
            }
        }
    }

    // echo "arrbaru : $dbmainimg.$arrbaru";

    

    // $expiredimgname=array();
    if(count($expiredimg)>0){
        for($t=0;$t<(count($expiredimg));$t++){
            if(file_exists($expiredimg[$t])){
                unlink($expiredimg[$t]);
            }
        }
    }

   
    // $indextambahanlanjutan=count($dbimgexistingexp);


    // // $addimg=array();
    // $newaddimg=[];
    if(isset($_FILES['addedimg'])){
        $addimg=$_FILES['addedimg'];
        $coadded=count($addimg['name']);
         $newaddname="resized-add-";
      
        for($i=0;$i<$coadded;$i++){
            $jam=date("His");
            $filenamei[$i]=$addimg['name'][$i];
            $fileTempi[$i] = $addimg["tmp_name"][$i];
            $fileSizei[$i] = $addimg["size"][$i]; 
            $fileErrorMsgi[$i] = $addimg["error"][$i]; 
            $fileTypei[$i] = $addimg["type"][$i]; 
            $fileSpliti[$i] = explode(".", $filenamei[$i]); 
            $fileExti[$i] = end($fileSpliti[$i]); 
            $newfilenamei[$i]=$newaddname.$jam.'-'.$i.'.'.$fileExti[$i];

            if($fileTempi[$i]){
                if (!preg_match("/.(gif||jpg||png||jpeg)$/i", $newfilenamei[$i]) ) {        
                    echo "ERROR: File harus dalam format JPG or PNG.";
                        unlink($fileTempi[$i]); 
                        exit();		 
                }else if ($fileErrorMsgi[$i] == 1) {
                    echo "ERROR: Gagal memproses penambahan data, mohon coba lagi.";
                    exit();
                }
            }

            $targetdir[$i]=$dir.$newfilenamei[$i];
            $moveResult[$i] = move_uploaded_file($fileTempi[$i], $targetdir[$i]);
            if ($moveResult[$i] != true) {
                echo "ERROR: File not uploaded. Try again.";
                unlink($fileTempi[$i]); 
                exit();
            }    
            // array_push($newaddimg,$targetdir[$i]);     
            $arruploadbaru.='||'.$targetdir[$i];

        }
    }

    $updr=array(
        "category"=>$daftarkat,
        "supplier"=>$sup,
        "product_brand"=>$merkprod,
        "product_substitute"=>$daftarsubstitusi,
        "product_name"=>$namaprod,
        "product_code"=>$kodeprod,
        "description"=>$ketprod,
        "harga_modal"=>$harga0,
        "harga_dealer"=>$harga1,
        "harga_umum"=>$harga2,
        "harga_pasang"=>$hargapasang,
        "panjang"=>$panjang,
        "lebar"=>$lebar,
        "tinggi"=>$tinggi,
        "berat"=>$berat,
        "img"=>$dbmainimg.$arrbaru.$arruploadbaru,
        "grade"=>$grade,
        "negara_pembuat"=>$negara,
        "satuan"=>$satuan,
        "no_part"=>$nopart,
        "merk_part"=>$merkpart,
        "kendaraan_pengguna"=>$kendaraanpengguna,
        "mod_by"=>$aid,
        "mod_dt"=>$now2,
    );   
    $wherer=array("id"=>$pid);
    $acta=$db->update($table,$wherer,$updr);

    $actl=false;

    $insl=array(
        "action"=>"Ubah $table $pid",
        "admin_id"=>$aid,
        "datetime"=>$now2,
        "relevance"=>"$table id $pid",
    );
    $actl=$db->insert("log",$insl);

    if($actl){
        echo "ok";
    }else{
        echo "gagal";
    }
}

//////////////////////////////// tambahan fungsi 29-6-19 //////////////////////////////////////
if(isset($_POST['tambahdatabase'])){
    $now2=$now;
    $act=$_POST['act'];
    $database=$_POST['database'];
    $aid=$_POST['aid'];
    $name=$_POST['name'];
    $gbr=$_FILES['gbr'];
    
    echo "TAMBAH MERK";
}

if(isset($_POST['lihatdb'])){
    $eco='';
    $jeniskendaraan='';
    $merkkendaraan='';
    $tipekendaraan='';
    $apa=$_POST['lihatdb'];
    $dataid=$_POST['dataid'];
    $aid=$_POST['aid'];
    $checkdb='';
    $data='';
    if($apa=='merk'){
        $checkdb=checkdbmerk($dataid);
    }else if($apa=='tipe'){
        $checkdb=checkdbtipe($dataid,0,0);
    }else if($apa=='model'){
        $checkdb=checkdbmodel($dataid);
    }else{
        $checkdb=checkdbjenis($dataid);
    }
    $data=json_decode($checkdb,true);
    $img='';
    if($apa!='model'){
        $img=$data[0]['img'];
        if($img==''){
            $img="../images/iconkosong.jpg";
        }
    }
    if($apa=='tipe'){
        $jeniskendaraan=$data[0]['jenis_id'];
        $merkkendaraan=$data[0]['merk_id'];
        $daftarjenis='';
        $checkdbjenis=checkdbjenis(0);
        $jsjenis=json_decode($checkdbjenis,true);
        foreach($jsjenis as $cjenis){
            if($jeniskendaraan==$cjenis['id']){
                $jenisselected="selected";
            }else{
                $jenisselected="";
            }
            $daftarjenis.="
                <option value='".$cjenis['id']."' $jenisselected>
                    ".$cjenis['name']."
                </option>
            ";
        }
        $daftarmerk='';
        $checkdbmerk=checkdbmerk(0);
        $jsmerk=json_decode($checkdbmerk,true);
        foreach($jsmerk as $cmerk){
            if($merkkendaraan==$cmerk['id']){
                $merkselected="selected";
            }else{
                $merkselected="";
            }
            $daftarmerk.="
                <option value='".$cmerk['id']."' $merkselected>
                    ".$cmerk['name']."
                </option>
            ";
        }
        $eco.="
            <div class='row mb-3'>
                <div class='col'>
                    Jenis<br/>
                    <select class='form-control' id='jenistipeubah' onfocus=\"empty('errmsgubahtipe')\">
                        <option value=''>--- Jenis Kendaraan --- </option>
                        $daftarjenis
                    </select>
                </div>
            </div>
            <div class='row mb-3'>
                <div class='col'>
                    Merk<br/>
                    <select class='form-control' id='merktipeubah' onfocus=\"empty('errmsgubahtipe')\">
                        <option value=''>--- Merk Kendaraan --- </option>
                        $daftarmerk
                    </select>
                </div>
            </div>
        ";
    }
    $eco.= "
        <div class='row mb-3'>
            <div class='col'>
                Nama ".ucwords($apa)."<br/>
                <input type='text' class='form-control' placeholder='".ucwords($apa)." Kendaraan' id='nama".$apa."ubah' onfocus=\"empty('errmsgubah$apa')\" value='".$data[0]['name']."'>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col'>
                Logo ".ucwords($apa)."<br/>
                <div><img class='imgplaceholder-l' src='$img'></div>
                <input type='file' id='gbr".$apa."ubah' onfocus=\"empty('errmsgubah".$apa."')\">
                <div class='text-danger text-small'>* Kosongkan jika tidak ingin mengubah gambar</div>
            </div>
        </div>

        <div class='row mb-2'>
            <div class='col text-center'>              
                <div id='errmsgubah".$apa."' class='errormsg'>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col' id='btnubah$apa'>
                <button class='btn btn-primary btn-block' onclick=\"aturdb('ubah','$apa','$dataid','$aid')\">
                    Ubah ".ucwords($apa)."
                </button>
            </div>
        </div> 
    ";

    if($apa=='model'){
        $tipename=$data[0]['name'];
        $jeniskendaraan=$data[0]['jenis_id'];
        $merkkendaraan=$data[0]['merk_id'];
        $tipekendaraan=$data[0]['tipe_id'];
        $mesin=$data[0]['mesin'];
        if($mesin=='bensin'){$bensinsel='selected';}else{$bensinsel='';}
        if($mesin=='diesel'){$dieselsel='selected';}else{$dieselsel='';}
        if($mesin=='hybrid'){$hybridsel='selected';}else{$hybridsel='';}
        if($mesin=='listrik'){$listriksel='selected';}else{$listriksel='';}
        $checkdbjenis=checkdbjenis($jeniskendaraan);
        $jsjenis=json_decode($checkdbjenis,true);
        foreach($jsjenis as $cjenis){
            $jenisname=ucwords($cjenis['name']);
        }
        $checkdbmerk=checkdbmerk($merkkendaraan);
        $jsmerk=json_decode($checkdbmerk,true);
        foreach($jsmerk as $cmerk){
            $merkname=ucwords($cmerk['name']);
        }
        $checkdbtipe=checkdbtipe($tipekendaraan,0,0);
        $jstipe=json_decode($checkdbtipe,true);
        foreach($jstipe as $ctipe){
            $tipename=ucwords($ctipe['name']);
        }
        $eco="
            <div class='row mb-3'>
                <div class='col'>
                    Tipe Kendaraan = <b>$jenisname $merkname $tipename</b>
                </div>
            </div>
            <div class='row mb-3'>
                <div class='col'>
                    Nama Model<br/>
                    <input type='text' class='form-control' placeholder='Model Kendaraan' value='$tipename' id='namamodelubah' onfocus=\"empty('errmsgubahmodel')\">
                </div>
            </div>
            <div class='row mb-3'>
            
            
                <div class='col-12 col-lg-4'>
                    Mesin<br/>
                    <select class='form-control 'id='mesinmodelubah' onfocus=\"empty('errmsgubahmodel')\">
                        <option value='bensin' $bensinsel>Bensin</option>
                        <option value='diesel' $dieselsel>Diesel</option>
                        <option value='hybrid' $hybridsel>Hybrid</option>
                        <option value='listrik' $listriksel>Listrik</option>
                    </select>
                </div>
                <div class='col-12 col-lg-4'>
                    Transmisi<br/>
                    <input type='text' class='form-control' placeholder='Contoh : 5 Speed M/T' value='".$data[0]['transmisi']."' id='transmisimodelubah' onfocus=\"empty('errmsgubahmodel')\">
                </div>
                <div class='col-12 col-lg-4'>
                    Silinder<br/>
                    <input type='text' class='form-control' placeholder='Contoh : 2.5L' value='".$data[0]['silinder']."' id='silindermodelubah' onfocus=\"empty('errmsgtubahmodel')\">
                </div>
            </div>
            <div class='row mb-3'>
                <div class='col-12 col-lg-6'>
                    Tahun Awal<br/>
                    <input type='number' class='form-control' placeholder='Contoh : 2003' value='".$data[0]['tahun_awal']."' id='tawalmodelubah' onfocus=\"empty('errmsgubahmodel')\">
                </div>
                <div class='col-12 col-lg-6'>
                    Tahun Akhir<br/>
                    <input type='number' class='form-control' placeholder='Contoh : 2008' value='".$data[0]['tahun_ahir']."' id='tahirmodelubah' onfocus=\"empty('errmsgubahmodel')\">
                    <p class='text-small text-danger'>* Isikan 0 jika model kendaraan terkini</p>
                </div>
            </div>
            <div class='row mb-2'>
                <div class='col text-center'>              
                    <div id='errmsgubahmodel' class='errormsg'>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col' id='btnubahmodel'>
                    <button class='btn btn-primary btn-block' onclick=\"aturdb('ubah','model','$dataid','$aid')\">
                        Ubah Model
                    </button>
                </div>
            </div> 
        ";
    }

    echo $eco;
   
    
    
}

if(isset($_POST['aturdb'])){
    $now2=$now;
    $table=$_POST['aturdb'];
    $nama=$_POST['nama'];
    $act=$_POST['act'];
    $apa=$_POST['apa'];
    $jenis=$_POST['jenis'];
    $merk=$_POST['merk'];
    $tipe=$_POST['tipe'];
    $transmisi=$_POST['transmisi'];
    $mesin=$_POST['mesin'];
    $silinder=$_POST['silinder'];
    $tawal=$_POST['tawal'];
    $tahir=$_POST['tahir'];
    $dataid=$_POST['dataid'];
    $aid=$_POST['aid'];
    $addarr=[];
    $addarr2=[];
    if(isset($_FILES['gbr'])){
        $gbr=$_FILES['gbr'];
        $oriname=$gbr['name'];
        $fileSplit = explode(".", $oriname); 
        $fileExt = end($fileSplit); 
        $newname="$apa-$nama";
        $dir="../images/$apa/";

        //target : ../images/merk/merk-apa.ext

        // echo 
        $uploadimg=imguploadprocesswithresize($gbr,$dir,$newname); //../img/cat/cat-otomotif.png
        if($uploadimg=='big'){
            echo "ERROR: Image size is more then 2 MB.";
            exit();
        }else if($uploadimg=='ext'){
            echo "ERROR: file is not JPG or PNG.";
            exit();
        }else if($uploadimg=='err'){
            echo "ERROR: An error occured while processing file. Try again.";
            exit();
        }else if($uploadimg=='err2'){
            echo "ERROR: File not uploaded. Try again.";
            exit();
        }else if($uploadimg=='ok'){
            $uploadpath=$dir."res-".$newname.".".$fileExt;
        }
        $addarr=array("img"=>$uploadpath);
    }


    if($apa=='tipe'){
        $addarr2=array(
            "jenis_id"=>$jenis,
            "merk_id"=>$merk,
        );  
    }
    if($apa=='model'){
        $addarr2=array(
            "jenis_id"=>$jenis,
            "merk_id"=>$merk,
            "tipe_id"=>$tipe,
            "transmisi"=>$transmisi,
            "mesin"=>$mesin,
            "silinder"=>$silinder,
            "tahun_awal"=>$tawal,
            "tahun_ahir"=>$tahir,
        );  
    }

    $acta=false;

    if($act=='tambah'){
        $arrtable=array(
            "name"=>$nama,
            "add_by"=>$aid,
            "add_dt"=>$now2,
        );
        
        $arrtable=array_merge($arrtable,$addarr);
        $arrtable=array_merge($arrtable,$addarr2);
        $acta=$db->insert($table,$arrtable);
    }
    if($act=='ubah'){
        $wheret=array("id"=>$dataid);
        $arrtable=array(
            "name"=>$nama,
            "mod_by"=>$aid,
            "mod_dt"=>$now2,
        );
        $arrtable=array_merge($arrtable,$addarr);
        $arrtable=array_merge($arrtable,$addarr2);
        $acta=$db->update($table,$wheret,$arrtable);
        
    }

    $insl=array(
        "action"=>ucwords($act)." ".$table." ".$nama,
        "admin_id"=>$aid,
        "datetime"=>$now2,
        "relevance"=>$table,
    );
    $actl=$db->insert("log",$insl);

    if($acta && $actl){
        echo "ok";
    }else{
        echo "Proses Gagal";
    }

}

if(isset($_POST['hapusdb'])){
    $table=$_POST['hapusdb'];
    $aid=$_POST['aid'];
    $dataid=$_POST['dataid'];
    $now2=$now;
    $wheret=array("id"=>$dataid);
    $updt=array(
        "data_status"=>3,
        "mod_by"=>$aid,
        "mod_dt"=>$now2
    );
    $acta=$db->update($table,$wheret,$updt);
    $insl=array(
        "action"=>"Hapus data ".$table." id ".$dataid,
        "admin_id"=>$aid,
        "datetime"=>$now2,
        "relevance"=>$table,
    );
    $actl=$db->insert("log",$insl);

    if($acta && $actl){
        echo "ok";
    }else{
        echo "Gagal hapus database";
    }
}