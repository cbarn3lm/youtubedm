<!DOCTYPE html 
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Listing most viewed videos</title>
    <style type="text/css">
    div.item {
      border-top: solid black 1px;      
      margin: 10px; 
      padding: 2px; 
      width: auto;
      padding-bottom: 20px;
    }
    span.thumbnail {
      float: left;
      margin-right: 20px;
      padding: 2px;
      border: solid silver 1px;  
      font-size: x-small; 
      text-align: center
    }    
    span.attr {
      font-weight: bolder;  
    }
    span.title {
      font-weight: bolder;  
      font-size: x-large
    }
    img {
      border: 0px;  
    }    
    a {
      color: brown; 
      text-decoration: none;  
    }
    </style>
  </head>
  <body>
    <?php
	
	$user = $_POST['upload'];
	$url = $_POST['URL'];
	$category = $_POST['category'];
	$country = $_POST['region'];
	
	$country1=$country;
	$category1=$category;
	
	//youtube video length
	$videoLength = 11;
	
	//The ID string starts after "v=", which is after 'youtube.com/watch?'
	$idStarts = strpos ($url, "?v=");
	
	//In case the "v=" is NOT right after the ?
	if($idStarts === FALSE)
		$idStarts = strpos($url, "&v=");
		
	//if still FALSE, url doesn't have a video id
	if($idStarts === FALSE)
		die("YouTube video ID not found. Please double-check your URL.");
		
	//Offset the start location to match the beginning of the ID string
	$idStarts +=3;
	
	//Get the ID string and return it
	$videoID = substr($url, $idStarts, $videoLength);
	
	if ($category=="Autos & Vehicles")
		$category="Autos";
		
	elseif ($category=="Film & Animation")
		$category="Film";
	elseif ($category=="Gaming")
		$category="Games";
	elseif ($category=="Howto & Style")
		$category="Howto";
	elseif ($category=="News & Politics")
		$category="News";
	elseif ($category=="Nonprofits & Activism")
		$category="Nonprofit";
	elseif ($category=="People & Blogs")
		$category="People";
	elseif ($category=="Pets & Animals")
		$category="Animals";
	elseif ($category=="Science & Technology")
		$category="Tech";
	elseif ($category=="Travel & Events")
		$category="Travel";
	elseif ($category=="Select YouTube Video Category")
		$category=FALSE;
	else
	{
	}
	
	if ($country=="Argentina")
		$country="AR";
		
	elseif ($country=="Australia")
		$country="AU";
	elseif ($country=="Brazil")
		$country="BR";
	elseif ($country=="Canada")
		$country="CA";
	elseif ($country=="Czech Republic")
		$country="CZ";
	elseif ($country=="France")
		$country="FR";
	elseif ($country=="Germany")
		$country="DE";
	elseif ($country=="Great Britain")
		$country="GB";
	elseif ($country=="Hong Kong")
		$country="HK";
	elseif ($country=="India")
		$country="IN";
	elseif ($country=="Ireland")
		$country="IE";
	elseif ($country=="Israel")
		$country="IL";
	elseif ($country=="Italy")
		$country="IT";
	elseif ($country=="Japan")
		$country="JP";
	elseif ($country=="Mexico")
		$country="MX";
	elseif ($country=="Netherlands")
		$country="NL";
	elseif ($country=="New Zealand")
		$country="NZ";
	elseif ($country=="Poland")
		$country="PL";
	elseif ($country=="Russia")
		$country="RU";
	elseif ($country=="South Africa")
		$country="ZA";
	elseif ($country=="South Korea")
		$country="KR";
	elseif ($country=="Spain")
		$country="ES";
	elseif ($country=="Sweden")
		$country="SE";
	elseif ($country=="Taiwan")
		$country="TW";
	elseif ($country=="United States")
		$country="US";
	elseif ($country=="Select Country to Compare With")
		$country=FALSE;
	else
	{
	}
	$max = 50;
	$start = 1;
	
	if($category === FALSE)
		die("A Video Category Was Not Selected");
	if($country === FALSE)
		die("A Country Was Not Selected");
		
	if($user === "Enter YouTube Username of the Uploaded Video")
		die("A YouTube Username Was Not Entered");

    ?>
	
    <h1><?php echo "User Video" ?></h1>
	<?php
	
	$feedURL = 'http://gdata.youtube.com/feeds/api/users/'.$user.'/uploads?v=2';
   // read feed into SimpleXML object
    $sxml = simplexml_load_file($feedURL);
    // iterate over entries in feed
    foreach ($sxml->entry as $entry) {
      // get nodes in media: namespace for media information
      $media = $entry->children('http://search.yahoo.com/mrss/');
      
      //get video player URL
      $attrs = $media->group->player->attributes();
      $watch = $attrs['url']; 
      
      // get video thumbnail
      $attrs = $media->group->thumbnail[0]->attributes();
      $thumbnail = $attrs['url']; 
	  
      // get <media:duration> node for video length
      $yt = $media->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->duration->attributes();
      $length = $attrs['seconds']; 
	  
	  // get <media:videoid> node for video length
      $yt = $media->children('http://gdata.youtube.com/schemas/2007');
      $video = $yt->videoid;
	  
      // get <yt:stats> node for viewer statistics
      $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->statistics->attributes();
      $viewCount = $attrs['viewCount']; 
      
      // get <gd:rating> node for video ratings
      $gd = $entry->children('http://schemas.google.com/g/2005'); 
      if ($gd->rating) {
        $attrs = $gd->rating->attributes();
        $rating = $attrs['average']; 
      } else {
        $rating = 0; 
      }
	  
	  if($videoID == $video)
	  {
		
      ?>
      <div class="item">
        <span class="title">
          <a href="<?php echo $watch; ?>"><?php echo $media->group->title; ?></a><br />
        </span>
        <p><?php echo $media->group->description; ?></p>
        <p>
          <span class="thumbnail">
            <a href="<?php echo $watch; ?>"><img src="<?php echo $thumbnail;?>" /></a>
            <br/>click to view
          </span> 
          <span class="attr">By:</span> <?php echo $entry->author->name; ?> <br/>
          <span class="attr">Duration:</span> <?php printf('%0.2f', $length/60); ?> 
          min. <br/>
          <span class="attr">Views:</span> <?php echo $viewCount; ?> <br/>
          <span class="attr">Rating:</span> <?php echo $rating; ?> <br />
		  <span class="attr">Keywords:</span> <?php echo $media->group->keywords; ?> <br />
		  <span class="attr">Video ID:</span> <?php echo $video; ?> 
        </p>
      </div>      
    <?php
     }
	 else
	 {
	 }
	 }
    ?>
	
	
      <h1><?php echo "Top 100 Most Viewed $category1 Videos in $country1" ?></h1>
    <?php
	for($start; $start<=100; $start+=50)
	{
	if($country=="All Countries")
	$feedURL = 'http://gdata.youtube.com/feeds/api/standardfeeds/most_viewed_'.$category.'?&max-results='.$max.'&start-index='.$start.'';
	else
	$feedURL = 'http://gdata.youtube.com/feeds/api/standardfeeds/'.$country.'/most_viewed_'.$category.'?&max-results='.$max.'&start-index='.$start.'';
    
    // read feed into SimpleXML object
    $sxml = simplexml_load_file($feedURL);
    // iterate over entries in feed
    foreach ($sxml->entry as $entry) {
      // get nodes in media: namespace for media information
      $media = $entry->children('http://search.yahoo.com/mrss/');
      
      // get video player URL
      $attrs = $media->group->player->attributes();
      $watch = $attrs['url']; 
      
      // get video thumbnail
      $attrs = $media->group->thumbnail[0]->attributes();
      $thumbnail = $attrs['url']; 
            
      // get <media:duration> node for video length
      $yt = $media->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->duration->attributes();
      $length = $attrs['seconds']; 
	  
      // get <yt:stats> node for viewer statistics
      $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->statistics->attributes();
      $viewCount = $attrs['viewCount']; 
      
      // get <gd:rating> node for video ratings
      $gd = $entry->children('http://schemas.google.com/g/2005'); 
      if ($gd->rating) {
        $attrs = $gd->rating->attributes();
        $rating = $attrs['average']; 
      } else {
        $rating = 0; 
      }
	  //get video upload date
	  $upload = $yt->uploaded;
	
      ?>
      <div class="item">
        <span class="title">
          <a href="<?php echo $watch; ?>"><?php echo $media->group->title; ?></a><br />
        </span>
        <p><?php echo $media->group->description; ?></p>
        <p>
          <span class="thumbnail">
            <a href="<?php echo $watch; ?>"><img src="<?php echo $thumbnail;?>" /></a>
            <br/>click to view
          </span> 
          <span class="attr">By:</span> <?php echo $entry->author->name; ?> <br/>
          <span class="attr">Duration:</span> <?php printf('%0.2f', $length/60); ?> 
          min. <br/>
          <span class="attr">Views:</span> <?php echo $viewCount; ?> <br/>
          <span class="attr">Rating:</span> <?php echo $rating; ?> <br />
		  <span class="attr">Keywords:</span> <?php echo $media->group->keywords; ?> <br />
		  <span class="attr">Video ID:</span> <?php echo $video; ?> 
        </p>
      </div>      
    <?php
    }
	}
    ?>
  </body>
</html>     
        