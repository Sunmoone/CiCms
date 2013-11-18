<?php
class Tree {
	private $rows;
	public $tab = '------';
	private $tree = array();
	private $childs = array();

	public function setTree($rows) {
		$this->rows = $rows;
	}

	private function findChild(&$arr, $pid) {
		$childs = array();
		foreach ($arr as $k => $v) {
			if ($v['pid'] == $pid) {
				$childs[] = $v;
			}
		}

		return $childs;
	}

	public function buildTree($pid = 0) {
		$childs = $this->findChild($this->rows, $pid);
		if (empty($childs)) {
			return $childs;
		}

		foreach ($childs as $k => $v) {
			$resTree = $this->buildTree($v['id']);
			if ($resTree != null) {
				$childs[$k]['childs'] = $resTree;
			}
		}

		return $childs;
	}

	public function getTree($pid=0,$lv=0){
		$lv++;

   		foreach ($this->rows as $row){
	       	if ($row["pid"]==$pid){
	       		$row["lv"]=$lv;
	       		$row['tab'] = str_repeat($this->tab, $lv-1);
	       		$this->tree[]=$row;
	       		$this->getTree($row["id"],$lv);
	       	}
   		}
   		
   		return $this->tree;
	}

	public function breadcrumbs($id = 0) {
	    $cats = $this->getTree();
	    $cate = array();
	    foreach ($cats as $val) {
	    	$cate[$val['id']] = $val;
	    }

	    if($cate[$id]['pid'] > 0) {
	        return $this->breadcrumbs($cate[$id]['pid']) . " / ".anchor('category/'.$cate[$id]['slug'].'/'.$cate[$id]['pid'], $cate[$id]['name']);;
	    }
	    else {
	        return anchor('category/'.$cate[$id]['slug'], $cate[$id]['name']);
	    }
	}

	//返回所有的叶子节点
	public function scanNodeOfTree($pid=0,$lv=0){
		static $i=0; 
		$result = $this->rows;
		if((bool)$result){
			foreach($result as $value){
				if($value['pid']==$pid){
					$value['lv']=$lv;
					$this->childs[$i]=$value;
					
					$i++;
					$lv++;
					$this->scanNodeOfTree($value['id'],$lv--);
				}
			}
		}
		return $this->childs;
	} 
	//返回所有的上级节点
	public function getNodeOfTree($result,$id,$arr){
		if($id == 0){             
			return $arr;         
		}      
		foreach ($result as $items){     
			if($id == $items['ID']){             
				$arr[] = array($items['CateName'],$items['ID']);                    
				$return = $this->getNodeOfTree($result,$items['ParentId'],$arr);          
			}        
		}       
		return $return;   
	}     
}


?>