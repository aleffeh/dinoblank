<!DOCTYPE html>
<html lang="en">
<head>
    <title>Phantom - ТОП 30</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="PB eSports, Point Blank, eSports, SCHEDULE ">
    <meta name="description" content="PB eSports, Point Blank, eSports, SCHEDULE ">
    <script type="text/javascript">
        if(screen.width < 768 && location.pathname.indexOf('/mobile') == -1) location.href = '/mobile' + location.pathname;
    </script>
    <link type="text/css" rel="stylesheet" href="library/reset.css" />
    <link type="text/css" rel="stylesheet" href="library/bxslides/jquery.bxslider.css">
    <link type="text/css" rel="stylesheet" href="css/common.css" />

        <link rel="apple-touch-icon" sizes="57x57" href="fps-pb.com/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://fps-pb.com/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://fps-pb.com/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://fps-pb.com/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://fps-pb.com/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://fps-pb.com/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://fps-pb.com/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://fps-pb.com/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://fps-pb.com/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="http://fps-pb.com/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://fps-pb.com/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="http://fps-pb.com/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://fps-pb.com/favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="http://fps-pb.com/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
        <link type="text/css" rel="stylesheet" href="css/schedule/schedule.css">
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/library/html5shiv.js"></script>
    <![endif]-->
<?php
include ('functions.php');
$host        = "host=localhost";
$port        = "port=5432";
$dbname      = "dbname=pointblank";
$credentials = "user=postgres password=1233210";
$db = pg_connect( "$host $port $dbname $credentials"  );
if(!$db)
{
      echo "Error : Db error\n";
}

if(!isset($_GET['page'])){
  $p = 1;
}
else{
  $p = addslashes(strip_tags(trim($_GET['page'])));
  if($p < 1) $p = 1;
}
$num_elements = 30;
$total1 = pg_result(("SELECT COUNT(*) FROM accounts WHERE money > 1100"),0,0); 
$num_pages = ceil($total1 / $num_elements);
if ($p > $num_pages) $p = $num_pages;
$start = ($p - 1) * $num_elements; 
$sel = pg_query("SELECT * FROM accounts WHERE money > 1100 ".$start.", ".$num_elements);
$result = pg_fetch_assoc($sel);


//
?>

</head>
<body>
    <div id="wrap">
        <header>
	<div class="header-container">
		<h1 class="logo">
			<a href="index.html"><img src="images/ppb.png" alt="PBWC"></a>
		</h1>
		 <!--<p class="pbwc">
			<a href="index.html"><img src="images/ppb.png" alt="PBWC"></a>
		</p>-->
		<div class="gnb">
			<nav>
				<ul>
					<li class="dep01-1">
						<a href="http://www.xemunetwork.pro/network/my.php"><h2>МОЙ ЛК</h2></a>
					</li>
					<li class="dep01-2">
						<a href=""><h2>LIVE</h2></a>
						<div class="dep02"></div>
						<ul>
							<li><a href=""><h3>СТРИМЫ</h3></a></li>
							<li><a href=""><h3>ВИДЕО</h3></a></li>
													</ul>
					</li>
					<li class="dep01-3">
						<a href="tournament.html"><h2>ТУРНИРЫ</h2></a>
					</li>
					<li class="dep01-4">
						<a href=""><h2>ТОП</h2></a>
						<div class="dep02"></div>
						<ul>
							
							<li><a href="http://www.xemunetwork.pro/pointblank/top.php"><h3>ТОП РЕЙТИНГА</h3></a></li>
							<li><a href="http://www.xemunetwork.pro/pointblank/top-clans.php"><h3>ТОП КЛАНОВ</h3></a></li>
						</ul>
					</li>
					<li class="dep01-5">
						<a href=""><h2>О ПРОЕКТЕ</h2></a>
						<div class="dep02"></div>
						<ul>
							<li><a href="history.html"><h3>ЧТО ЭТО ЗА ПБ?</h3></a></li>
							
						</ul>
					</li>
				</ul>
			</nav>
		</div>
		<div class="sns">
			<ul>
				<li><a class="facebook" href="https://www.facebook.com/groups/193381824624282/" target="_blank">facebook</a></li>
				<li><a class="twitter" href="" target="_blank">twitter</a></li>
				<li><a class="youtube" href="" target="_blank">youtube</a></li>
			</ul>
		</div>
	</div>
	</div>
	
	<div class="live-on">
					</div>
    </header>

            <div id="container" class="sub-container schedule-list-container">
        <div class="sub-tit">
       
    </div>
        <div class="sub-content detail-content schedule-content">
            <div class="schedule-sel">
                <div class="year">
                    <button type="button" class="prev" onclick="yearPrev()"></button>
                    <strong class="year-count"></strong>
                    <button type="button" class="next" onclick="yearNext()"></button>
                </div>
               
                <div class="month">
                    <ul id="searchMonth">
                       
                      
                        <li class="odd"><button type="button" onclick="changeSearchDate(3);">
                            <span>MAR</span>
                        </button></li>
                        <li class="even"><button type="button" onclick="changeSearchDate(4);">
                            <span>APR</span>
                        </button></li>
						
                        <li class="odd"><button type="button" onclick="changeSearchDate(5);">
                            <span>MAY</span>
                        </button></li>
						
                        <li class="even"><button type="button" onclick="changeSearchDate(6);">
                            <span>JUN</span>
                        </button></li>
                        <li class="odd"><button type="button" onclick="changeSearchDate(7);">
                            <span>JUL</span>
                        </button></li>
                        <li class="even"><button type="button" onclick="changeSearchDate(8);">
                            <span>AUG</span>
                        </button></li>
                        <li class="odd"><button type="button" onclick="changeSearchDate(9);">
                            <span>SEB</span>
                        </button></li>
                        <li class="even"><button type="button" onclick="changeSearchDate(10);">
                            <span>OCT</span>
                        </button></li>
                        <li class="odd"><button type="button" onclick="changeSearchDate(11);">
                            <span>NOV</span>
                        </button></li>
                        <li class="even"><button type="button" onclick="changeSearchDate(12);">
                            <span>DEC</span>
                        </button></li>
						 <li class="odd"><button type="button" onclick="changeSearchDate(1);">
                            <span>JAN</span>
                        </button></li>
						  <li class="even"><button type="button" onclick="changeSearchDate(2);">
                            <span>FEB</span>
                        </button></li>
                    </ul>
                </div>
            </div>
            <div class="schedule-tbl">
                <table>
                   
                    <tbody>
					 <tr>
                                <td colspan="6">Данный ТОП - 30 ПО Рейтингу, обновление каждый день! В Таблицу попадают люди со 1100 Рейтинга.</td>
								<br>
								<td colspan="6">с 00 : 00 - 06:00 МСК</td>
								<div id="wrap"> 
	<!--Всего записей: <?//echo $total1;?>-->
	<table class="simple-little-table" cellspacing='0'>
	
		<tr>
		   <!-- <center><img src="1.jpg"></center>
			<!--<th width="7%" height="16" class="s_top" align="center"><b>ID</b></th>-->
			<th width="25%" height="16" class="s_top"><b>Ник</b></th>
			<th height="16" class="s_top" align="center"><b>Звание</b></th>
			<th width="10%" height="16" class="s_top" align="center"><b>ГП</b></th>
			<th width="10%" height="16" class="s_top" align="center"><b>Рейтинг</b></th>
		</tr>

<?php
$name_array = array('Кадет','Кадет','Ст. кадет ','Ст. кадет','Ст. кадет','Ст.сержант','Ст. кадет','Ст. кадет','Ст. кадет','Ст. кадет','Ст. кадет','Сержант 3-го ранга','Сержант 4-го ранга','Ст. сержант 1-го ранга ','Ст. сержант 2-го ранга','Ст. сержант 3-го ранга ','Ст. сержант 4-го ранга ','Ст. сержант 5-го ранга ','Мл. лейтенант 1-го ранга','Мл. лейтенант 2-го ранга ','Мл. лейтенант 3-го ранга ',' Рядовой солдат ',' Мл. лейтенант 4-го ранга ',' Лейтенант 1-го ранга ',
' Лейтенант 2-го ранга ','  Лейтенант 3-го ранга ',' Лейтенант 4-го ранга ',' Лейтенант 5-го ранга ',' Ст. лейтенант 1-го ранга ',' Ст. лейтенант 2-го ранга '
,' Ст. лейтенант 3-го ранга ',' Ст. лейтенант 4-го ранга ',' Ст. солдат',' Ст. лейтенант 5-го ранга ','  Майор 1-го ранга '
,' Майор 2-го ранга ',' Майор 3-го ранга ',' Майор 4-го ранга ',' Майор 5-го ранга ',' Подполковник 1-го ранга','Подполковник 2-го ранга','Подполковник 3-го ранга ','Подполковник 4-го ранга ','Ефрейтор ','Подполковник 5-го ранга ','Полковник 1-го ранга '
,'Полковник 2-го ранга','Полковник 3-го ранга ','Полковник 4-го ранга ',' Полковник 5-го ранга ','Подполковник ','Полковник ','Генерал-майор ','Генерал-лейтенант ','Генерал-полковник ','Герой'
,'Элита сервера 1-го ранга','Элита сервера 2-го ранга','Элита сервера 3-го ранга','Элита сервера 4-го ранга','Элита сервера 5-го ранга','Элита сервера 6-го ранга','Элита сервера 7-го ранга','Элита сервера 8-го ранга','Элита сервера 9-го ранга','Элита сервера 10-го ранга','ГМ');
if(pg_num_rows($result)>0)
{
	while($row = pg_fetch_array($result))
	{ 
			echo '<tr class="tbl_out" onmouseout="this.className=&#39;tbl_out&#39;" onmouseover="this.className=&#39;tbl_hover&#39;">';
			//echo '<td height="16" align="center" class="s_1">'.$row['player_id'].'</td>';
			echo '<td height="16" align="center" class="s_1"><div style="float:left;">&nbsp&nbsp'.$row['player_name'].'</div></td>';
			echo '<td height="16" class="s_1"><div style="float:left;">'.$name_array[$row['rank']].'</div></td>';
			echo '<td height="16" align="center">'.$row['gp'].'</td>';
			echo '<td height="16" align="center">'.$row['money'].'</td>';
			echo '</tr>';
	}
}
?>
		
	</table>
<br>
<span class="catPages1"><center>
<?php
echo GetNav($p, $num_pages);
?>


</center></span>
</div>
                            </tr>
                         <!--                                                       <tr class="odd">
                                                            <td class="flag"><img src="images/countries/europe/rus.png" alt="Russia"></td>
                                <td class="date"><span>25 May, 2019 ~ 26 May, 2019</span></td>
                                <td>Cyberspace, Moscow Russia</td>
                                                                    <td class="tournament"><span><a href="http://www.fps-pb.com/news/detail/747" target="_blank">PBWC 2019</a></span></td>
                                                                <td class="contents">
                                                                            <a href="-sz5drD-5fY" target="_blank">detail</a>
                                                                    </td>
                                <td class="last"><span class="pbwc"><img src="images/icon/sche-pbwc.png" alt="pbwc"></span></td>
                            </tr>
                                                                                <tr class="even">
                                                            <td class="flag"><img src="/images/countries/europe/rus.png" alt="Russia"></td>
                                <td class="date"><span>25 May, 2019 ~ 26 May, 2019</span></td>
                                <td>Cyberspace, Moscow Russia</td>
                                                                    <td class="tournament"><span>PBIWC 2019</span></td>
                                                                <td class="contents">
                                                                            <span class="no-vod"></span>
                                                                    </td>
                                <td class="last"><span class="pbiwc"><img src="images/icon/sche-pbiwc.png" alt="pbiwc"></span></td>
                            </tr>
                                                                                <tr class="odd">
                                                            <td class="flag"><img src="/images/countries/europe/rus.png" alt="Russia"></td>
                                <td class="date"><span>19 May, 2019 ~ 19 May, 2019</span></td>
                                <td>Cyberspace, Moscow Russia</td>
                                                                    <td class="tournament"><span>Arena [Season XI] - PBWC&#039;19 Qualifier</span></td>
                                                                <td class="contents">
                                                                            <span class="no-vod"></span>
                                                                    </td>
                                <td class="last"><span class="regional"><img src="images/icon/sche-regional.png" alt="regional"></span></td>
                            </tr>
                                                                                <tr class="even">
                                                            <td class="flag"><img src="images/countries/middleeast/tur.png" alt="Turkey"></td>
                                <td class="date"><span>05 May, 2019 ~ 05 May, 2019</span></td>
                                <td>Istanbul</td>
                                                                    <td class="tournament"><span><a href="https://esports.tamgame.com/html/Notice/NoticeView.php?noticeIDX=851" target="_blank">PBST 2019 Season 1 Grand Final</a></span></td>
                                                                <td class="contents">
                                                                            <span class="no-vod"></span>
                                                                    </td>
                                <td class="last"><span class="regional"><img src="images/icon/sche-regional.png" alt="regional"></span></td>
                            </tr>
                                                                                <tr class="odd">
                                                            <td class="flag"><img src="/images/countries/america/bra.png" alt="Brazil"></td>
                                <td class="date"><span>04 May, 2019 ~ 05 May, 2019</span></td>
                                <td>Galax Arena</td>
                                                                    <td class="tournament"><span><a href="https://esports.ongame.net/pbwc/noticias/partidas-pbwc-2019/" target="_blank">Seletiva PBWC 2019</a></span></td>
                                                                <td class="contents">
                                                                            <span class="no-vod"></span>
                                                                    </td>
                                <td class="last"><span class="regional"><img src="images/icon/sche-regional.png" alt="regional"></span></td>
                            </tr>
                        -->
                                            </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>

        <footer>
	
	
	<div class="foot-container">
		<div class="foot-add">
			
			<div class="foot-info">
				<img src="/images/foot-logo.png" alt="" class="foot-logo" />
				<p>XEMU Copy - All rights reserved.</p>
			</div>
		</div>
	
								<div class="ps">
			
					</div>
			</div>
</footer>
    </div>
    <script type="text/javascript" src="library/jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="library/respond.min.js"></script>
    <script type="text/javascript" src="library/bxslides/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script>
	$(function(){
		$(".first_nation select").on("change", function() {
			var nation = this.value;
			$(".second_nation > div").removeClass("on");
			$(".second_nation").find("." + nation).addClass("on");
		});
		$(".second_nation select").on("change", function() {
			var url = this.value;
			if(url == "sel" ){
			}else{
				window.open(url, "_blank");
			}
		});
	});


    //footer partners 슬라이드
    $('.slider-p').bxSlider({
        slideWidth: 75,
        minSlides: 2,
        maxSlides: 2,
        pager:false
    });

     //footer sponsors 슬라이드
    $('.slider-s').bxSlider({
        slideWidth: 75,
        minSlides: 2,
        maxSlides: 2,
        pager:false
    });
    </script>
        <script type="text/javascript">
        var _year;
        var _month;

        // 검색날짜 설정
        function setSearchDate(){
            _year = '2019';
            _month = '5';
            $(".year-count").text(_year);
            $('#searchMonth').children('li').eq(_month - 1).children('button').eq(0).addClass('active');
            $('#searchMonth').children('li').eq(_month - 1).children('button').eq(0).append('<span class="icon"><img src="images/sub-page/month-on.png" alt=""></span>');
        }

        // 검색날짜 변경
        function changeSearchDate(month){
        //    location.href = '/schedule/list/' + _year + '/' + month;
        }

        // 검색
        function search(){
            var searchWord = $('#searchWord').val();

            if(searchWord != '')
                location.href = '/schedule/list/' + _year + '/' + _month + '/' + encodeURI(searchWord);
            else
                location.href = '/schedule/list/' + _year + '/' + _month;
        }

        // 이전 년도로 변경
        function yearPrev(){
            _year--;
            _month = 1;
            $(".year-count").text(_year);
            $('#searchWord').val('');
            search();
        }

        // 다음 년도로 변경
        function yearNext(){
            _year++;
            _month = 1;
            $(".year-count").text(_year);
            $('#searchWord').val('');
            search();
        }

        // 초기설정
        function init(){
            setSearchDate();
            $("#searchWord").keydown(function (key) { if(key.keyCode == 13) search(); });
        }
        init();
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-31093876-1', 'auto');
        ga('send', 'pageview');
    </script>
            <script>
            // 라이브온 이미지 left 값
            function liveImgLeft(){
                var winWidth = $(window).width();
                var liveonImgLeft = (winWidth - 1280)/2;
                if(winWidth < 976){
                    $(".liveon-img").css({"left":"-150px"});
                }else if(winWidth < 1280){
                    $(".liveon-img").css({"left":liveonImgLeft+"px"});
                }else{
                    $(".liveon-img").css({"left":"0px"});
                }
            }

            liveImgLeft();
            $(window).resize(function(){
                liveImgLeft();
            });

            // live on 닫기
            $(".live-on .cls").click(function(){
                $(".live-on .bnr, .live-on .live-content").hide();
            });
            // live on 컨텐츠 open
            $(".click").click(function(){
                $(".live-content").slideDown();
            });
            // live on 컨텐츠 close
            $(".cls-content").click(function(){
                $(".live-content").slideUp();
            });

            //var locationHref = window.location.href;

            $(".dep01-2, .dep01-4, .dep01-5").each(function(idx, element) {
                var isVisible = $(".dep02:visible").length;
                $(this).hover(function() {
                    $(this).children("a").addClass("over");
                    // main, news, schedule 페이지에만 적용
					                }, function() {
                    $(this).children("a").removeClass("over");
                    // main, news, schedule 페이지에만 적용
					                });
            });
        </script>
    </body>
</html>