<?php
	require_once "youtubeUserVideoClass.php";
	
	class Top100Video {
		public $title, $desc, $descrip, $time, $rate, $views, $id, $eDist, $commonKeywords, $thumbnail, $author;
		public $keywords = array();
		
		
		//Modified euclidean distance
		function euclidean($userVideo){
		    
		    //Scale this better, average distance ~15-20 atm    
		    $time= sqrt(pow(($userVideo->time/60 - $this->time/60),2));
		    
		    if($time<=.1)
		    {
		    $time=0;
		    }
		    elseif($time<=.2)
		    {
		    $time=.2;
		    }
		    elseif($time<=.4)
		    {
		    $time=.4;
		    }
		    elseif($time<=.6)
		    {
		    $time=.6;
		    }
		    elseif($time<=.8)
		    {
		    $time=.8;
		    }
		    elseif($time<=1)
		    {
		    $time=1;
		    }
		    elseif($time<=1.2)
		    {
		    $time=1.2;
		    }
		    elseif($time<=1.4)
		    {
		    $time=1.4;
		    }
		    elseif($time<=1.6)
		    {
		    $time=1.6;
		    }
		    elseif($time<=1.8)
		    {
		    $time=1.8;
		    }
		    elseif($time<=2)
		    {
		    $time=2;
		    }
		    elseif($time<=2.2)
		    {
		    $time=2.2;
		    }
		    elseif($time<=2.4)
		    {
		    $time=2.4;
		    }
		    elseif($time<=2.6)
		    {
		    $time=2.6;
		    }
		    elseif($time<=2.8)
		    {
		    $time=2.8;
		    }
		    elseif($time<=3)
		    {
		    $time=3;
		    }
		    elseif($time<=3.2)
		    {
		    $time=3.2;
		    }
		    elseif($time<=3.4)
		    {
		    $time=3.4;
		    }
		    elseif($time<=3.6)
		    {
		    $time=3.6;
		    }
		    elseif($time<=3.8)
		    {
		    $time=3.8;
		    }
		    else
		    {
		    $time=4;
		    }
		  
		    $Distance+= $time;	
		    	
		    $commonKeywords += pow(($this->commonKeywords),2);
		    
		    if($commonKeywords==0)
		    {
		    $commonKeywords=5;
		    }
		    elseif($commonKeywords==1)
		    {
		    $commonKeywords=3.5;
		    }
		    elseif($commonKeywords==2)
		    {
		    $commonKeywords=2.5;
		    }
		    elseif($commonKeywords==3)
		    {
		    $commonKeywords=1.5;
		    }
		    elseif($commonKeywords==4)
		    {
		    $commonKeywords=.5;
		    }
		    else
		    {
		    $commonKeywords=0;
		    }
		    
		    $Distance+= $commonKeywords;
		    
		    //Range possiblities. (0-15, 15-75, 75-125, 125-200, 200-1000)
		    $desc= sqrt(pow(($userVideo->desc - $this->desc),2));
		
		    if($desc<=10)
		    {
		    $desc=0;
		    }
		    elseif($desc<=30)
		    {
		    $desc=1;
		    }
		    elseif($desc<=50)
		    {
		    $desc=2;
		    }
		    elseif($desc<=75)
		    {
		    $desc=2.5;
		    }
		    elseif($desc<=100)
		    {
		    $desc=2;
		    }
		    elseif($desc<=125)
		    {
		    $desc=2.5;
		    }
		    elseif($desc<=150)
		    {
		    $desc=3;
		    }
		    elseif($desc<=200)
		    {
		    $desc=4;
		    }
		    else
		    {
		    $desc=5;
		    }
		    
		  
		    
		    $Distance += $desc;
		    return $Distance;
		}
	}
?>