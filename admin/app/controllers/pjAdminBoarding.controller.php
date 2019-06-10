<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjAdminBoarding extends pjAdmin
{
	public function pjActionCreate()
	{
		
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
			if (isset($_POST['boarding_create']))
			{				
				
				
			$Boarding = NEW pjBoardingModel();
			$city_id=$_POST['city_id'];
			$boarding=$_POST['boarding'];
			$operator=$_POST['operator_id'];
			$addB=$Boarding->addBoarding($city_id,$boarding,$operator);
			
			if($addB['status']===true){
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminBoarding&action=pjActionIndex");
			}
			else{
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminBoarding&action=pjActionIndex&err=notadd");
			}
				
				
			} else {
				
				$locale_arr = pjLocaleModel::factory()->select('t1.*, t2.file')
					->join('pjLocaleLanguage', 't2.iso=t1.language_iso', 'left')
					->where('t2.file IS NOT NULL')
					->orderBy('t1.sort ASC')->findAll()->getData();
						
				$lp_arr = array();
				foreach ($locale_arr as $item)
				{
					$lp_arr[$item['id']."_"] = $item['file'];
				}

				$pjUserModel = pjUserModel::factory();	
			$pjUserModel->where('t1.status', 'T');
			$pjUserModel->where('t1.role_id', '2');
			$Users = array();
			$Users = $pjUserModel->select('t1.id, t1.name')->findAll()->getData();	
				

				$this->set('lp_arr', $locale_arr);
				$this->set('locale_str', pjAppController::jsonEncode($lp_arr));
				$this->set('isEditor', $this->isEditor());
				$this->set('Users', $Users);
				if(isset($_GET['id']))
				{
					$direction = 'ASC';
					if($_GET['type'] == 'reverse')
					{
						$direction = 'DESC';
					}
					$city_id_arr = pjRouteCityModel::factory()->getCity($_GET['id'], $direction);
					$this->set('city_id_arr', $city_id_arr);
				}
				
				$city_arr = pjCityModel::factory()
					->join('pjMultiLang', "t2.model='pjCity' AND t2.foreign_id=t1.id AND t2.field='name' AND t2.locale='".$this->getLocaleId()."'", 'left outer')
					->select('t1.*, t2.content as name')
					->where('status', 'T')
					->orderBy("name ASC")
					->findAll()
					->getData();
				$this->set('city_arr', $city_arr);
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('jquery.multilang.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
				$this->appendJs('jquery.tipsy.js', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendCss('jquery.tipsy.css', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendJs('pjAdminBoarding.js');
				$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionCreateSlide()
	{
		
		$this->checkLogin();
		
		if ($this->isEditor())
		{
			if (isset($_POST['slide_create']))
			{				
			$Boarding = NEW pjBoardingModel();
 if(!empty($_FILES['filepic']['name'])){
     $photoTmpPath = $_FILES['filepic']['tmp_name'];
     $check = getimagesize($_FILES["filepic"]["tmp_name"]);
        
             
  
    if($check !== false ) {


  
	  $ext = pathinfo($_FILES["filepic"]["name"], PATHINFO_EXTENSION);
		$filetype=strtolower($ext);
	  
		 $file3 = MYROOTPATH."img/slides/";
		

		  if (!is_dir($file3)) {
		mkdir($file3, 0777, true);
	  }
	   
	   
		$fn=time().".".$filetype;
		$filename = $file3.$fn;
	   move_uploaded_file($_FILES['filepic']['tmp_name'], $filename);
	   
	   $Op=$_POST['operator_id'];
	  if($Boarding->uploadSlide($Op,$fn)){
	 pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminBoarding&action=pjActionCreateSlide");
	}
	 else{
	   pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminBoarding&action=pjActionIndex&err=notadd");
	 }

		
		} else {
		   
			
		 pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminBoarding&action=pjActionIndex&err=wrong");
		  
	  }
	 }
	 else{
	 pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminBoarding&action=pjActionIndex&err=notselect");
	 }			
				
			
		
			
				
			} else {
				
				$Boarding = NEW pjBoardingModel();
				$getSlide=$Boarding->getSlide($_SESSION['admin_user']['id']);
				
				$this->set('slidearr', $getSlide);
			
				
				$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteRoute()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			
			if (pjRouteModel::factory()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
			{
				pjMultiLangModel::factory()->where('model', 'pjRoute')->where('foreign_id', $_GET['id'])->eraseAll();
				pjRouteDetailModel::factory()->where('route_id', $_GET['id'])->eraseAll();
				pjRouteCityModel::factory()->where('route_id', $_GET['id'])->eraseAll();
				
				$response['code'] = 200;
			} else {
				$response['code'] = 100;
			}
			
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteRouteBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjRouteModel::factory()->whereIn('id', $_POST['record'])->eraseAll();
				pjMultiLangModel::factory()->where('model', 'pjRoute')->whereIn('foreign_id', $_POST['record'])->eraseAll();
				pjRouteDetailModel::factory()->whereIn('route_id', $_POST['record'])->eraseAll();
				pjRouteCityModel::factory()->whereIn('route_id', $_POST['record'])->eraseAll();
			}
		}
		exit;
	}
	
	public function pjActionExportRoute()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjRouteModel::factory()	->select('t1.id, t2.content as title')
											->join('pjMultiLang', "t2.model='pjRoute' AND t2.foreign_id=t1.id AND t2.field='title' AND t2.locale='".$this->getLocaleId()."'", 'left outer')
											->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Routes-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetRoute()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjRouteModel = new pjBoardingModel();
			
	
			
		if($this->isAdmin()){
			$op=null;
		}
		else{
			$op=$_SESSION['admin_user']['id'];
		}
			
			$column = 'title';
			$direction = 'ASC';
			$total = $pjRouteModel->getBoardingTotal($op);
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}


			$data = $pjRouteModel->getBoarding($offset,$rowCount,$op);
					
						
			
			
			pjAppController::jsonResponse(compact('data', 'total', 'pages', 'page', 'rowCount', 'column', 'direction'));
		}
		exit;
	}
	
	public function pjActionIndex()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
			$this->appendJs('jquery.datagrid.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
			$this->appendJs('pjAdminBoarding.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveRoute()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjRouteModel = pjRouteModel::factory();
			if (!in_array($_POST['column'], $pjRouteModel->i18n))
			{
				$value = $_POST['value'];
				
				$pjRouteModel->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $value));
			} else {
				pjMultiLangModel::factory()->updateMultiLang(array($this->getLocaleId() => array($_POST['column'] => $_POST['value'])), $_GET['id'], 'pjRoute', 'data');
			}
		}
		exit;
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
				
			if (isset($_POST['bording_update']))
			{
				
			$Boarding = NEW pjBoardingModel();
			$city_id=$_POST['city_id'];
			$boarding=$_POST['boarding'];
			$operator=$_POST['operator_id'];

			$Delete=$Boarding->deleteBoardingByCityId($city_id,$operator);
			
			$addB=$Boarding->addBoarding($city_id,$boarding,$operator);
		
		
			
			
			if($addB['status']===true){
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminBoarding&action=pjActionUpdate&id=".$city_id."&op=".$operator);
			}
			else{
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminBoarding&action=pjActionUpdate&id=".$city_id."&op=".$operator."&err=notadd");
			}
				

			} else {
				if(empty($_GET['id'])){
					die('direct not allowed');
				}

				$locale_arr = pjLocaleModel::factory()->select('t1.*, t2.file')
					->join('pjLocaleLanguage', 't2.iso=t1.language_iso', 'left')
					->where('t2.file IS NOT NULL')
					->orderBy('t1.sort ASC')->findAll()->getData();
						
				$lp_arr = array();
				foreach ($locale_arr as $item)
				{
					$lp_arr[$item['id']."_"] = $item['file'];
				}
				$this->set('lp_arr', $locale_arr);
				$this->set('locale_str', pjAppController::jsonEncode($lp_arr));
				
				if(isset($_GET['id']))
				{
					$direction = 'ASC';
					
					$city_id_arr = pjRouteCityModel::factory()->getCity($_GET['id'], $direction);
					$this->set('city_id_arr', $city_id_arr);
				}
				
				$city_arr = pjCityModel::factory()
					->join('pjMultiLang', "t2.model='pjCity' AND t2.foreign_id=t1.id AND t2.field='name' AND t2.locale='".$this->getLocaleId()."'", 'left outer')
					->select('t1.*, t2.content as name')
					->where('status', 'T')
					->orderBy("name ASC")
					->findAll()
					->getData();
			$pjUserModel = pjUserModel::factory();	
			$pjUserModel->where('t1.status', 'T');
			$pjUserModel->where('t1.role_id', '2');
			$Users = array();
			$Users = $pjUserModel->select('t1.id, t1.name')->findAll()->getData();	
				
						
				$Boarding = NEW pjBoardingModel();
				$BoardingData = $Boarding->getBoardingByCityId($_GET['id'],$_GET['op']);
	

				$this->set('city_arr', $city_arr);
				$this->set('BoardingData', $BoardingData);
				$this->set('isEditor', $this->isEditor());
				$this->set('Users', $Users);
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('jquery.multilang.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
				$this->appendJs('jquery.tipsy.js', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendCss('jquery.tipsy.css', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendJs('pjAdminRoutes.js');
				$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
			}
		} else {
			$this->set('status', 2);
		}
	}
}
?>