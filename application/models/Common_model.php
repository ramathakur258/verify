<?php
class Common_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //Start echoLastQuery
    function echoLastQuery() {
          //$this->output->enable_profiler(TRUE); 
        echo $this->db->last_query();die;
    }
    //End echoLastQuery
    //-------------------------------------------------------
    //Start PreData
    public function preData($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        die;
    }
    //End PreData
    //-------------------------------------------------------
    //Start insert
    function insert($tableName,$insertArray) {	// print_r
        $datas=array();
        foreach ($insertArray as $key=>$value) {
            $datas[$key]=trim($value);
        }
         $this->db->insert($tableName,$datas);
         return $this->db->insert_id();
    }
    //End insert

    //-------------------------------------------------------

    //Start checkExistEmail
    public function checkExistEmail($table,$whereArr){
        $sql=$this->db->select('*')
                ->from($table)
                ->where($whereArr);
        $email=$this->db->get();
         $res= $email->num_rows();
         return $res;
     }
    //End checkExistEmail

//-------------------------------------------------------

    //Start changePassword
   public function changePassword($table,$updateArr,$whereArr){
        $this->db->where($whereArr);
        $query=$this->db->update($table,$updateArr);
        return $this->db->affected_rows();
     }
    //End changePassword

//-------------------------------------------------------

    //Start login
    function login($tableName,$select,$loginCondtion) {
        $datas=array();
        foreach ($loginCondtion as $key=>$value) {
            $loginCondtion[$key]=trim($value);
        }
        if(!empty($select))
        {
            $this->db->select($select);
        }
        if(!empty($loginCondtion))
        {
            $this->db->where($loginCondtion);
        }
         $query=$this->db->get($tableName ,true);
         return $query->result_array();
    }
    //End login

    //Start login with join
    public function joinLogin($tbl_1,$tbl_2,$email,$pass,$utype) {
        echo $pass;
        $sql="SELECT * FROM $tbl_1 a inner join $tbl_2 b ON a.U_ID=b.U_ID where a.
        `email`='$email' AND a.`password`='$pass' AND a.`utype`='$utype'
        AND a.`user_confirmation`='1'";

        $q=$this->db->query($sql);
        if($q->num_rows() > 0)
        {
            return $q->result_array();
        }
    }
    //End login with join


    //Start delete
    function delete($table, $where) {
        $query = $this->db->delete($table, $where);
        return $query;
    }
    //End delete

    //start deletein
    function deletein($table,$column,$condition)
    {
        $this->db->where_in($column, $condition);
        $this->db->delete($table);

    }
    //End deletein

    //start update
    function update($table, $data, $condition) {
        $datas=array();
        foreach ($data as $k=>$value) {
           $datas[$k]=trim($value);
        }
        $this->db->where($condition);
        $query = $this->db->update($table, $datas);
        return $query;
    }
    //End update

    //start getAllData
    function getAllData($table , $array_obj_type) {
        $sql=$this->db->get($table);
        if($array_obj_type) //$array_obj_type true or false
        {
            return $sql->result();
        }
        else
        {
        return $sql->result_array();
        }
    }
    //end getAllData

    //start getWhere
    function getWhere($table, $condition,$array_obj_type) {

        $q = $this->db->get_where($table, $condition);
        $que = $q->num_rows($q);
        if ($que > 0) {
            if(!empty($array_obj_type))
            {
                return $q->result_array();
            }else
            {
                return $q->result();
            }

        }
    }
    //End getWhere

				//start selectWhere
    function selectWhere($table, $where,$count=false) {
						$q = $this->db->select('*')
														->where($where)
														->get($table);
						if($count)
								return $q->num_rows();
						else
								return $q->result_array();
    }
    //End getWhere

				//Start code to get average value
				function getAverage($avgField,$tableName,$whr)	{
					$this->db->select_avg($avgField)
									->from($tableName)
									->where($whr);
					$q=$this->db->get();
					return $q->row_array();
				}
				//End code to get average value

				//Start code to get SUM value
				function	getSum($sumField,$tableName,$whr)	{
					$this->db->select_sum($sumField)
							->from($tableName)
							->where($whr);
					$q=$this->db->get();
					return $q->row_array()[$sumField];
				}
				//End code to get SUM value

				//Start getDataBetween
				function	getDataBetween($tblName,$fieldName,$val_1,$val_2)	{
					$this->db->select('*')
													->from($tblName)
													->where($fieldName.' >=',"$val_1")
													->where($fieldName.' <=',"$val_2");
					$q=$this->db->get();
					return $q->result();
				}
				//End getDataBetween

    //start getSingleRow
    function getSingleRow($tbleName,$conArray) {
        $que=$this->db->get_where($tbleName,$conArray);
        return $que->row_array();
    }
    //End getSingleRow
	
    //Start function to get data
    //$single true or false for single or multiple results
    function getDataWhere($tableName,$single,$select,$whereCondtion,$orderByField,$orderByValue,$per_page, $page) {
        if (!empty($select))
        {
            $this->db->select($select);
        }
        if(!empty($whereCondtion))
        {
            $this->db->where($whereCondtion);
        }
        if(!empty($orderByField) && !empty($orderByValue))
        {
            $this->db->order_by($orderByField,$orderByValue);
        }
        if(!empty($per_page) || !empty($page) )
        {
            $this->db->limit($per_page,$page);
        }
        $query=$this->db->get($tableName);
        if($query->num_rows() > 0)
        {
            $result=$query->result_array();
            if($single)
            {
                return $result[0];
            }
            else {
                return $result;
            }
        }
        else
        {
            return 0;
        }

    }
    //End function to get data

    //Start function to count all record
    function countData($table) {
        return $this->db->count_all($table);
    }
    //End function to all record

    //Start function to count all record
    function countWhere($table,$count,$where) {

         $q=$this->db->get_where($table,$where);
         //if $count is true return count of rows
         if($count)
         {
             return $q->num_rows();die;
         }

         if($q->num_rows() > 0)
         {
            return $q->result_array();
         }
         else
         {
             return 0;
         }
    }
    //End function to all record

    //start function record with limit
        public function get_data_with_limit($table, $per_page, $page) {
            // $data = array();

             //$s='select * from bb_products ';
             $s='select * from '.$table;
            if(!empty($page) or !empty($per_page))
            {
               $s.= ' limit ' . $page.','.$per_page;
            }
                $query=$this->db->query($s);
                if ($query->num_rows() > 0) {
//                foreach ($query->result() as $row) {
//                    $data[] = $row;
//                }
                 return   $query->result_array();
            }
           // return $data;
    }
    //End function record with limit

     //start function get_data_where_limit
        public function get_data_where_limit($table, $where ,$per_page, $page) {
             $data = array();
             $this->db->limit($per_page,$page);
             $q=  $this->db->get_where($table,$where);
             return $q->result_array();
    }
    //End function get_data_where_limit

    //start function where_in
    function where_in_limit($table,$field,$inArray,$per_page, $page) {
        $this->db->where_in($field,$inArray);
        if(!empty($per_page))
        {
            //$this->db->limit($page,$per_page);
            $this->db->limit($per_page,$page);
        }
        $q=$this->db->get($table);
        return $q->result_array();
    }
    //End function where_in


     //Start function to get pagination data
    public function pagination_data($pagination_url, $table, $count_leads, $per_page, $fix_uri_segment, $uri_segment, $pagination_data, $page_name) {
//pagination settings
        //print_r($pagination_data);
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings']=TRUE;
        $config['base_url'] = $pagination_url;
        $config['total_rows'] = $count_leads;
        $config['per_page'] = $per_page;
        $config["uri_segment"] = $fix_uri_segment;

        //$choice = $config["total_rows"] / $config["per_page"];
        $choice = '4';//$config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a disabled>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['page'] = $uri_segment;
        // get books list
		$data['all_records'] = $pagination_data;
        $data['pagination'] = $this->pagination->create_links();
        // pagination code end here
        $data['pages'] = $page_name;

        return $data;
    }
    //End function to get pagination data


    function getData_order_limit($tableName,$single,$select,$whereCondtion,$orderByField,$orderByValue,$per_page, $page) {
        if (!empty($select))
        {
            $this->db->select($select);
        }
        if(!empty($whereCondtion))
        {
            $this->db->where($whereCondtion);
        }
        if(!empty($orderByField) && !empty($orderByValue))
        {
            $this->db->order_by($orderByField,$orderByValue);
        }
        if(!empty($page) or !empty($per_page))
        {
           $this->db->limit($per_page,$page);
        }
        $query=$this->db->get($tableName);
        if($query->num_rows() > 0)
        {
            $result=$query->result_array();
            if($single)
            {
                return $result[0];
            }
            else {
                return $result;
            }
        }
        else
        {
            return 0;
        }

    }

    function getDataWhereObject($tableName,$single,$select,$whereCondtion,$orderByField,$orderByValue,$perPage,$page) {
        if (!empty($select))
        {
            $this->db->select($select);
        }
        if(!empty($whereCondtion))
        {
            $this->db->where($whereCondtion);
        }
        if(!empty($orderByField) && !empty($orderByValue))
        {
            $this->db->order_by($orderByField,$orderByValue);
        }
        if(!empty($perPage) || !empty($page) )
        {
            $this->db->limit($perPage,$page);
        }
        $query=$this->db->get($tableName);
        if($query->num_rows() > 0)
        {
           // $result=$query->result_array();
            $result=$query->result();
            if($single)
            {
                return $result[0];
            }
            else {
                return $result;
            }
        }
        else
        {
            return 0;
        }

    }


       public function get_records_by_id($table, $single, $data_condition, $select, $order_by_field, $order_by_value) {
        if (!empty($data_condition)) {
            $this->db->where($data_condition);
        }if (!empty($select)) {
            $this->db->select($select);
        }
        if (!empty($order_by_field) && !empty($order_by_value)) {
            $this->db->order_by($order_by_field, $order_by_value);
        }
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            if ($single) {
                return $result[0];
            } else {
                return $result;
            }
        } else {
            return 0;
        }
    }

    public function getDataLike($tableName,$likeField,$likeVal,$array_obj_status) {
        $sql=$this->db->select('*')
                ->from($tableName)
                ->Like($likeField,$likeVal);
        $q=$this->db->get();
       if($array_obj_status)
       {
           return $q->result_array();
       }else{
           return $q->result();
       }

    }

    public function minValue($tableName,$minField) {
        $sql="SELECT MIN(CAST($minField AS DECIMAL(10))) as $minField FROM ".$tableName;
        $q=$this->db->query($sql);
        $res=$q->result_array();
        //$this->preData($res);
        return $res[0][$minField];
        }
    public function maxValue($tableName,$maxField) {
        $sql="SELECT MAX(CAST($maxField AS DECIMAL(10))) as $maxField FROM ".$tableName;
        $q=$this->db->query($sql);
        $res=$q->result_array();
        //$this->preData($res);
        return $res[0][$maxField];
        }

        //Start code to find distance from 2 lat long
        function get_distance_lat_long($latitude1, $longitude1, $latitude2, $longitude2, $unit) {

    $theta = $longitude1 - $longitude2;
    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) +
                (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
                cos(deg2rad($theta)));
    //echo $distance;die;
    $distance = acos($distance);
    $distance = rad2deg($distance);
    $distance = $distance * 60 * 1.1515;

    switch($unit) {
        case 'Mile':
        case 'mile':
        case 'MILE':
            break;
        case 'Km' :
        case 'km' :
            $distance = $distance * 1.609344;
    }
    return (round($distance,2));
}
        //End code to find distance from 2 lat long

        //Start code to get data from curl_get_contents
        function curl_get_contents($url)
        {
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          $data = curl_exec($ch);
          curl_close($ch);
          return $data;
        }
        //End code to get data from curl_get_contents

        //Start code to get lat long from zip code
        function getLatLongFromZipcode($url)
        {
          //$url = 'https://maps.googleapis.com/maps/api/geocode/json?address=11050';
          $result = json_decode(curl_get_contents($url));
          echo $zipLat=$result->results[0]->geometry->location->lat;
          echo $zipLong=$result->results[0]->geometry->location->lng;
        }
        //End code to get lat long from zip code

        //Start function where_in
        function whereIn($tblName,$whrColum,$whrCondition,$arrObjtype) {
            $sql="SELECT * FROM $tblName WHERE $whrColum IN($whrCondition)";
            $rec=$this->db->query($sql);
            if($arrObjtype)
                 return $rec->result_array();
            else
                return $rec->result();
        }
        //End function where_in
								//image upload function start here!
		public function upload_single_image($lastid,$uploadPath,$tblName,$imageField) {
						if($_FILES['image']['name']!=''){
        $filename=$_FILES["image"]["name"];
        $_FILES["image"]["type"];
        $_FILES["image"]["size"];
        $_FILES["image"]["error"];
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
        $config['max_size']	= '10240000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['overwrite'] = true;
        $photo=explode('.',$filename);
        $ext = strtolower($photo[count($photo)-1]);
        if (!empty($_FILES['image']['name'])){
        $filename = md5(date('YmdHis').$lastid).".".$ext;
        }
        $config['file_name'] = $filename;
        $upload_config['remove_spaces'] = true;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
if($this->upload->do_upload('image'))
 {
       $update = array($imageField=>$filename);
       $this->db_general->update_data($tblName,$update,array('ID'=>$lastid));

   }else{
								print_r($this->upload->display_errors());
        $data['msg']=$this->upload->display_errors();
        }
}
}//image upload function end here!
 //Start code to uplaod multiple files,images
    public function multiple_photo_upload($imageName,$tblName,$origionalImgPath,$thumbImgPath,$lastid,$oldfile='') {
    $fName='';
    if($_FILES[$imageName]['name']!=''){
    $countFile=count($_FILES[$imageName]['name']);
    for($p=0;$p<$countFile;$p++)
    {
    $fileName=$_FILES['newPhotos']['name']=$_FILES[$imageName]['name'][$p];
    $fileType=$_FILES["newPhotos"]["type"]=$_FILES[$imageName]["type"][$p];
    $fileSize=$_FILES["newPhotos"]["size"]=$_FILES[$imageName]["size"][$p];
    $fileError=$_FILES["newPhotos"]["error"]=$_FILES[$imageName]["error"][$p];
    $fileTmpName=$_FILES["newPhotos"]["tmp_name"]=$_FILES[$imageName]["tmp_name"][$p];

    //$config['upload_path'] = PROJECT_PHOTO_PATH;
    $config['upload_path'] = $origionalImgPath;
//    $config['allowed_types'] = 'jpeg|jpg|png|';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|psd|csv|vcf|zip|docx|pdf|doc|xlsx|sql|ods|xls|rar|txt';
    $config['max_size']	= '10240000';
    $config['max_width']  = '10244';
    $config['max_height']  = '7684';
    $config['overwrite'] = true;
    $photo=explode('.',$fileName);
    $ext = strtolower($photo[count($photo)-1]);
    if (!empty($fileName)){
    $newDir=md5(microtime().$lastid);
    $filename=substr($newDir,0,-20);
    $filename=$filename.".".$ext;;
    }
	/*else
	{
		$fileName='';
	}*/

    $config['file_name'] = $filename;
    $upload_config['remove_spaces'] = true;
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    if($this->upload->do_upload('newPhotos'))
    {

    $fName.= ','.$filename;
    $fImages= ltrim($fName,',');
   
    //Start code to create thumb image or files
    $config['image_library'] = 'gd2';
    //$config['source_image']	= PROJECT_PHOTO_PATH.$config['file_name'];
    $config['source_image']	= $origionalImgPath.$config['file_name'];
    //$config['new_image'] = PROJECT_PHOTO_THUMBS_PATH.$config['file_name'];
    $config['new_image'] = $thumbImgPath.$config['file_name'];
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']	= 150;
    $config['height']	= 150;
    $config['quality'] = '80%';
    $config['thumb_marker'] = false;
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    if ( ! $this->image_lib->resize())
    {
    $data['msg'] = $this->image_lib->display_errors();
    }
    //End code to create thumb image or files

    }
    else
    {
    //echo '563';
   // print_r($this->upload->display_errors());
    }
    }
    return $fImages;
    // die;
    }
    else {
    die('Error');
    }
}//multiple_photo_upload function end here!
	function base64ImageUpload($imgName,$uploadPath) {
			if($_POST[$imgName]=='')
			{
			$files='';
			}
			else
			{
			//define('UPLOAD_DIR','images/');
			$img = $_POST[$imgName];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			//$file = APPUSERIMG . uniqid() . '.png';
			$file = $uploadPath . uniqid() . '.png';
			$success = file_put_contents($file, $data);
			//	$files='http://'.$_SERVER['HTTP_HOST'].'/'. $file;
			$files=	end(explode('/',	$file));$file;
			}
			return $files;
		//	$this->Common_model->preData($files);
	}

		//Start function sendSMS
	function	sendSMS($phone,$message)	{
		/*------------------------Send SMS using PHP------------------------------*/

    //Your authentication key
    $authKey = "135925AXurPpTFD586b5f94";

    //Multiple mobiles numbers separated by comma
    $mobileNumber = "$phone";

    //Sender ID,While using route4 sender id should be 6 characters long.
//    $senderId = "ABCDEF";
    $senderId = "GODISC";

    //Your message to send, Add URL encoding here.
    $message = urlencode("$message");

    //Define route
    $route = "4";
    //Prepare you post parameters
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route
    );

    //API URL
    $url="https://control.msg91.com/api/sendhttp.php";

    // init the resource
    $ch = curl_init();
								curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
        //,CURLOPT_FOLLOWLOCATION => true
    ));


    //Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


    //get response
    $output = curl_exec($ch);

    //Print error if any
    if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
    }

    curl_close($ch);
				return $output;
/*---------------------End Send SMS using PHP-------------------------*/
	}

	/* Send Mail Process */
	function send_mail($value) {
		
		$config['protocol']		='smtp';
		$config['smtp_host']	='ssl://smtp.googlemail.com';
		$config['smtp_port']	=465;
		$config['smtp_timeout']	=30;
		$config['smtp_user']	='deepak.shantiinfotech@gmail.com';
		$config['smtp_pass']	='deepaksingh12345';
		$config['charset']		='utf-8';  
		$config['newline']		="\r\n";
		$config['mailtype']     = 'html';
		
		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->from($value['from']);
		$this->email->to($value['to']); 
		$this->email->subject($value['subject']);
		$this->email->message($value['message']);  
		//~ $this->email->attach(base_url().'/assets/img/'.$value['fileDoc']);
		$send = $this->email->send();
//print_r($send);die();
		if($send) {
		  return 'Email sent.';    
		} else {
		  return $this->email->print_debugger();  
		}
	} 
	
	/* IMAGE UPLOAD WITHOUT RESIZE 	*/
	public function ImageUpload($filename, $name, $imagePath)
	{
		$temp = explode(".",$filename);		
		$extension = end($temp);
		$filenew =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.rand(). "." .$extension;  
		//print_r($filenew);die();
		$config['file_name'] = $filenew;
		$config['upload_path'] = $imagePath;
		$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png';
		$this->load->library('upload');
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('*');
		$this->upload->set_filename($config['upload_path'],$filenew);
		
		if (!$this->upload->do_upload($name)) 
		{
			$data = array('msg' => $this->upload->display_errors());
			//print_r($data);die();
		}		
		else 
		{ 
			$data = $this->upload->data();	
			
			$r_config['image_library'] = 'gd2';					
			$r_config['source_image'] = $data['full_path'];
			$r_config['new_image'] = $data['file_name'];
			$this->load->library('image_lib');
			$this->image_lib->initialize($r_config);
			 $this->load->library('upload', $config);
			$imageName = $r_config['new_image'];			
			return $imageName;
		}		
	}
}
