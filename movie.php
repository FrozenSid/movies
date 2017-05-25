<!DOCTYPE html>
<!-- ALEX HW3 Movie Review PHP format -->
<html>
<head>
		<title>Rancid Tomatoes</title>
		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
        <!-- Code to add favicon -->
		<link href="rotten.gif"  rel="favicon"  type="image/gif" />
</head>

<body>
	<!--Banner Center and Background Banner in CSS file-->
    <div id="Banner">
	<img src="banner.png" alt="Rancid Tomatoes" />
	</div>
		
    
	<!-- Request file form www directory in HW3 movie folders to get info.text-->
		<?php
			$movie = $_GET["film"]; /*get the desired movie with the query parameter film (EXAMPLE)--> movie.php?film=princessbride*/
			$fline = file("{$movie}/info.txt"); /*read file lines from info.txt and return them as an array*/
			$fline[1] = trim($fline[1]); /* trim removes whitespace at the start/end of a string -- gets rid of stray spaces in output*/
		?>

	<h1 id="MovieNameYear"> <?php print "$fline[0]"; /*fline[0] returns the TITLE of the movie*/
								  print "({$fline[1]})"; /*fline[1] returns the YEAR of the movie*/ ?>
	</h1>
		

<div id="ContentBox" >
		
		
		<!-- Overview Banner on right side of website-->
        <div id="Overview">
		<div>
			<?php
			echo "<img src='$movie/overview.png' alt='general overview'>" 
			// get the overview image for each movie stored in the movie folders
			?>
		</div>
		
        <div id="TextMain">
		<!--Section of Overview for the list of names, authors, directors, publications...-->

		<!-- Split string by string " : " so that heading can be seperated from the descriptions -->
	    <?php 
			$TextMain = file("{$movie}/overview.txt"); //get the info about the movie from overview.txt in the movie folder
				foreach($TextMain as $Text)   //for each overview of a movie 
					{
						$Heading = explode(":", $Text, 2); //split the lines in 2 after : symbol
		?>
		<dt><?php print "$Heading[0]"; ?></dt> <!--heading for the data term-->
		<dd><?php print "$Heading[1]"; ?></dd> <!--heading for the data description-->
		<?php } ?>
		
		</div> <!--End of TextMain-->
	    </div> <!--End of Overview-->

		
		
		
		
<div id="CommentsSection">
		
		<!-- Title for Rotten depending on rating -->
        <div id="Rotten33">
				<?php
					if($fline[2] < 60) /* if rating is less than 60 then image will change accordingly 
					                      either to freshbig.png (Tomato) or rottenbig.png (Splash) */
					{
				?>
		<img src="rottenbig.png" alt="Rotten">	<!--Show Rotten Image if rating is below 60-->
				<?php
					}
					else
					{
				?>
		<img src="freshbig.png" alt="Fresh">	<!--Show Fresh Image if rating is above 60-->
				<?php 
					} 
				print "{$fline[2]}%"; /* print the rating of the movie */
				?>
		</div> <!--End of Rotten rating title-->

		
		
	<!--FIRST COLUMN OF COMMENTS-->
	<div class="ReviewColumn">
			<?php 
				$reviewCount = glob($movie . "/review*.txt"); /*returns an array of matching file names beginning with review*/
				$countReviews = count($reviewCount); /*returns the number of elements in an array*/
				
				for($a = 0; $a <= ceil(($countReviews/2)-1); $a++){ 
			?>
				
			<p class="Review">
            <!--unpacks an array into a set of variables; useful for dealing with fixed-size arrays of data-->
            <?php 
				list($comment, $image, $author, $publication) = file($reviewCount[$a]); /*unpacks the array into variables*/
            	$comment = trim($comment); /*remove the white spaces for content*/
            	$image = trim($image); /*remove the white spaces for image*/
            ?>

			<img src = <?php 
							if($image == "ROTTEN")
						{
							echo "rotten.gif";

						}
						else
						{
						   echo "fresh.gif";
						}
						?> <!--Displays the image of the comment depending wheter good or bad comment is made-->
					
	        <q><?php echo $comment; ?></q> <!--Displays the comment-->
	        </p>

	        <p class = "ReviewerInfo">
	            	<img src = "critic.gif" alt = "critic" />
	            	<span><?php print $author; ?></span> <!--Displays author of comment-->
	            	<lt><?php echo $publication; ?></lt> <!--Displays publication of comment-->

	        </p>

	            <?php } ?>
	            
	</div> <!--END OF FIRST COLUMN-->
		
		
		
    <!-- SECOND COLUMN OF COMMENTS-->
	<!--Do the same thing like with the first column-->
	<div class="Reviewcolumn">
			
			<?php 
				$reviewCount = glob($movie . "/review*.txt");
				$countReviews = count($reviewCount);
			
				for($a = ceil(($countReviews/2)); $a < $countReviews; $a++){ ?>
				<p class="Review">
            			<?php 
						list($comment, $image, $author, $publication) = file($reviewCount[$a]);
            			$comment = trim($comment);
            			$image = trim($image);	
						?>

						<img src = <?php 
						if($image == "ROTTEN")
						{
							echo "rotten.gif";
						}
						else
						{
							echo "fresh.gif";
						} ?>
		
	            <q><?php echo $comment; ?></q>
	            </p>
               
	            <p class = "ReviewerInfo">
	            	<img src = "critic.gif" alt = "critic" />
	            	<span><?php print $author; ?> </span>
	            	<lt><?php echo $publication; ?></lt>

	            </p><?php } ?>
	    </div>
		
		
</div> <!--End of CommentsSection-->

		<p id="ReviewCounts">
		<?php echo "(1-$countReviews) of $countReviews"; ?> 
		<!--* print the total # of displayed reviews-->
		</p>
        
		
</div>  <!--End of ContentBox ID-->
		

<!--HTML AND CSS Validators-->
<div id="ValidatorHTMLCSS">
<p> 
<span>
<a href="https://webster.cs.washington.edu/validate-html.php">
<p class="Validator"> <img src="w3c-xhtml.png" alt="Valid HTML5" /> </p>
</a> </span>  <!--END OF HTML Validator-->

<span>
<a href="https://webster.cs.washington.edu/validate-css.php">
<p class="Validator"> <img src="w3c-css.png" alt="Valid CSS" /> </p>
</a> </span>  <!--END OF CSS Validator-->
</p>
</div> 
		

</body>
</html>
