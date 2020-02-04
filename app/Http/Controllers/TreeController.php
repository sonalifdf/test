<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;


class TreeController extends Controller
{
		public function __construct()
		{
		 
		}
 
	
		var $TArray;
		var $numElem;        
		
		var $Elem;
		var $RightPointer;
		var $LeftPointer;
		var $Counter;
		var $SortedArray;
		
		var $SearchTerm;
		var $SearchIndex;
   
		public function clsBinaryTree($ArrayIn,$cntElem = 0) {            
			$this->TArray = $ArrayIn;
		  	//First Element must start from 1.
			if ($ArrayIn[0] != "") {
				
				for ($i = 1; $i < sizeof($ArrayIn) + 1; $i++) {
					$NewArray[$i] = $ArrayIn[$i - 1];
				}                                 
				
				$this->TArray = $NewArray;
				
			} else {
				
				$this->TArray = $ArrayIn;
				
			}                         
			  
			$this->numElem = $cntElem;     
			
			$this->ConstructBinaryTree();     
			
			$this->GenerateSorted();
			
		}                      
		

		public function ConstructBinaryTree() {
		
			$MAX = $this->numElem;  
	
			for ($i = 1; $i <= $MAX; $i++) {
			
				//global $Elem;
				
				$this->Elem = $i;
				$Root = 1;
				$this->FollowPointer($Root);
				
			}   

		}


		public function FollowPointer($Root) {     
		
			if ($this->TArray[$this->Elem] > $this->TArray[$Root]) {
             
				if ($this->RightPointer[$Root] == 0) {
					$this->RightPointer[$Root] = $this->Elem; 
				} else {
					$this->FollowPointer($this->RightPointer[$Root]);
				}
				
			}
			
			if ($this->TArray[$this->Elem] < $this->TArray[$Root]) {
				
				if ($this->LeftPointer[$Root] == 0) {
					$this->LeftPointer[$Root] = $this->Elem;
				} else {
					$this->FollowPointer($this->LeftPointer[$Root]);
				}
				
			}

		} 
		
		
		
		public function GenerateSorted() {    
		
			$this->Counter = 0;
			
			$this->InOrder(1);    

		}
		
		
		public function InOrder($Root) {
		 
			if (intval($this->LeftPointer[$Root]) != 0) $this->InOrder(intval($this->LeftPointer[$Root]));
			
			$this->Counter += 1;
			$this->SortedArray[$this->Counter] = $this->TArray[$Root];
			
			if (intval($this->RightPointer[$Root]) != 0) $this->InOrder(intval($this->RightPointer[$Root]));

		}
		
		
		public function Search($InTerm) {   
		
			$this->SearchTerm = $InTerm;
			
			$this->BTreeSearch(1);
			
			return $this->SearchIndex;
		
		}
   

		public function BTreeSearch($Root) {
	
				if ($this->SearchTerm > $this->TArray[$Root]) {
             
					if ($this->RightPointer[$Root] == 0) {
						$this->SearchIndex = 0; 
					} else {
						$this->BTreeSearch($this->RightPointer[$Root]);
					}
				
				}
			
				if ($this->SearchTerm < $this->TArray[$Root]) {
				
					if ($this->LeftPointer[$Root] == 0) {
						$this->SearchIndex = 0; 
					} else {
						$this->BTreeSearch($this->LeftPointer[$Root]);
					}
				
				}
	
				if ($this->SearchTerm == $this->TArray[$Root]) {
			
					$this->SearchIndex = $Root;
				
				}

		}
	

}
