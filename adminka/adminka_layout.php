<?php
class AdminkaLayot {
	public $user_data;
	public $db_con;
	
	public $mono_core_path = '';
	public $adminka_path = '';
	
	function AdminkaLayot($_userData, $_dbConnect){
		$this->user_data = $_userData;
		$this->mono_core_path  = $_mono_core_path;
		
		$this->db_con = $_dbConnect;
		
		$this->mono_core_path  = $this->db_con->mono_core_path_for_adminka;
		$this->adminka_path  = $this->db_con->adminka_path_for_adminka;
	}
	
	// Draw Html Header
	function DrawHtmlHeader() {
		echo'<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=Windows-1251" />
				<meta name="description" content="" />
				<meta name="keywords" http-equiv="keywords" content=""/>
				
				<link rel="stylesheet" type="text/css" href="'.$this->adminka_path.'css/index_style.css" />
				<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
						
						
				<!-- TinyMCE -->
			<script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript">
				tinyMCE.init({
					// General options
					mode : "textareas",
					//mode : "exact",
       				//elements : "elrte_editor",
					theme : "advanced",
					plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
				
					// Theme options
					theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
					theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
					theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
					theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
				
					// Example content CSS (should be your site CSS)
					content_css : "css/content.css",
				
					// Drop lists for link/image/media/template dialogs
					template_external_list_url : "lists/template_list.js",
					external_link_list_url : "lists/link_list.js",
					external_image_list_url : "lists/image_list.js",
					media_external_list_url : "lists/media_list.js",
				
					// Style formats
					style_formats : [
					{title : "Bold text", inline : "b"},
					{title : "Red text", inline : "span", styles : {color : "#ff0000"}},
					{title : "Red header", block : "h1", styles : {color : "#ff0000"}},
					{title : "Example 1", inline : "span", classes : "example1"},
					{title : "Example 2", inline : "span", classes : "example2"},
					{title : "Table styles"},
					{title : "Table row 1", selector : "tr", classes : "tablerow1"}
					],
				
					// Replace values for the template plugin
					template_replace_values : {
						username : "Some User",
						staffid : "991234"
					}
				});
			</script>
			<!-- /TinyMCE -->

			<!-- jQuery UI -->
			<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" type="text/javascript" charset="utf-8"></script>
			<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" type="text/css" media="screen" charset="utf-8">
						
			
				<script type="text/javascript" charset="utf-8">
					$().ready(function() {
						// Verstka
						$(".div_area_big").hover(
							function () {
								$(this).children(".info_field").css("color", "#5f4c13");
							}, 
							function () {
								$(this).children(".info_field").css("color", "#434343");
							}
						);
					})
				</script>
			
			</head>
			
			<body>';
	}
	
	function DrawHtmlFooter() {
		echo'</body>
		</html>';
	}
	
	// Всплывающее окно оповещения о изменениях
	function DrawInfoWindow() {
		if( isset($_SESSION['message']) && $_SESSION['message'] != '' ){
			echo "<div id='info_window_container'>
				".$_SESSION['message']."
			</div>";		// info_window_container
			$_SESSION['message'] = '';
			echo "<script type='text/javascript'>
				var is_hide_window = false;
				$(document).ready(function() {
					$('#info_window_container').css('opacity', '.8');
					$('#info_window_container').hide();
					$('#info_window_container').show(1000);
					setTimeout('hideInfoMessage()', 10000);
					
					$('#info_window_container').click(function() {
						hideInfoMessage();
					});
				});
				function hideInfoMessage() {
					is_hide_window = !is_hide_window;
					if(is_hide_window){
						$('#info_window_container').animate({
							marginLeft: -15,
						}, {duration: 800, queue: false}, function() {
							// Animation complete.
						});
					}else{
						$('#info_window_container').animate({
							marginLeft: -365,
						}, {duration: 800, queue: false}, function() {
							// Animation complete.
						});
					}
				}
			</script>";
		}
		
		echo'<div id="up"><div class="pPageScroll">Вверх</div></div>
		<div id="down"><div class="pPageScroll">Вниз</div></div>';

		echo'<script type="text/javascript">
			$(document).ready(function() {
				$("#down").click(function(){
					//Необходимо прокрутить в конец страницы 
					var height=$("body").height(); 
					
					$("body").animate({
						scrollTop: height
					}, {duration: 500, queue: false}, function() {
						// Animation complete.
					});
				});
				
				$("#up").click(function(){
					//Необходимо прокрутить в начало страницы 
					$("body").animate({
						scrollTop: 0
					}, {duration: 500, queue: false}, function() {
						// Animation complete.
					});
				});
			});
		</script>';
	}
	
	// Draw Login Form
	function LoginProcess() {
		if( isset($_POST["login"]) && isset($_POST["pass"]) ){
			//include_once $this->adminka_path.'login.php';
			//$userData = new UserData($this->db_con);
			$this->user_data->loginIn($_POST["login"], $_POST["pass"]);
		}else{
			if($_GET["var"] == "forgot_pass"){
				// Send to mail
				if( isset($_POST["mail"]) ){
					//$userData = new UserData($this->db_con);
					$this->user_data->sendPasToMail($_POST["mail"]);
				}
			}
		}
	}
	
	function DrawLoginForm() {
		echo '<div id="main_login_form_container">';
		if(!isset($_GET['forgot_pass'])){
			//echo '<form action="'.$this->adminka_path.'set_settings.php?var=login" method="post" enctype="multipart/form-data"> 
			echo '<form action="" method="post" enctype="multipart/form-data"> 	
				<div>Логин</div><div><input type="text" size="20" name="login" value=""/></div>
				<div>Пароль</div><div><input type="password" size="20" name="pass" value=""/></div>
				<div><input type="submit" value="Войти" /></div>
			</form>';
			echo '<div class="forgot_pass"><a href="?forgot_pass=true">Забыли пароль?</a></div>';
		}else if($_GET['forgot_pass'] == 'true'){
			echo '<form action="'.$this->adminka_path.'set_settings.php?var=forgot_pass" method="post" enctype="multipart/form-data"> 
				<div>Адрес электронной почты</div><div><input type="text" size="20" name="mail" value=""/></div>
				<div><input type="submit" value="Выслать пароль" /></div>
			</form>';
		}
		echo '</div>';	// main_login_form_container
	}
	
	function DrawMainArea() {
		echo'<div><a href="?chapter=logout">logout</a></div>';
		echo'<div>Язык: || <a href="?chapter=too_ru" title="Произойдет возврат на главную страницу">RU</a> || <a href="?chapter=too_en" title="Произойдет возврат на главную страницу">EN</a> ||</div>';
		echo'<h1>Админка</h1>';
		
		if(!isset($_SESSION['lang']))
			$_SESSION['lang'] = '1';
		
		if($_GET['chapter'] == '' || $_GET['chapter'] == null ){
			$this->DrawHomePage();
		}else if($_GET['chapter'] == 'too_ru'){
			$_SESSION['lang'] = '1';
			$this->DrawHomePage();
		}else if($_GET['chapter'] == 'too_en'){
			$_SESSION['lang'] = '2';
			$this->DrawHomePage();
		}
		// MAIN MENU
		else if($_GET['chapter'] == 'main_menu'){
			$this->DrawMainMenuPage();
		}else if($_GET['chapter'] == 'main_menu_edit_form'){
			$this->DrawMainMenuEditFormPage();
		}else if($_GET['chapter'] == 'save_main_menu'){
			$this->DrawMainMenuSavePage();
		}else if($_GET['chapter'] == 'main_menu_delete_img'){
			$this->DrawMainMenuDeleteImagePage();
		}else if($_GET['chapter'] == 'main_menu_create_new'){
			$this->DrawMainMenuCreateNewPage();
		}else if($_GET['chapter'] == 'main_menu_confirm_delete'){
			$this->DrawMainMenuConfirmDeletePage();
		}else if($_GET['chapter'] == 'main_menu_delete'){
			$this->DrawMainMenuDeletePage();
		}
		// ISSUE
		else if($_GET['chapter'] == 'issue'){
			$this->DrawIssuePage();
		}else if($_GET['chapter'] == 'issue_create_new'){
			$this->DrawIssueCreateNewPage();
		}else if($_GET['chapter'] == 'issue_edit_form'){
			$this->DrawIssueEditFormPage();
		}else if($_GET['chapter'] == 'save_issue'){
			$this->DrawIssueSavePage();
		}else if($_GET['chapter'] == 'issue_confirm_delete'){
			$this->DrawIssueConfirmDeletePage();
		}else if($_GET['chapter'] == 'issue_delete'){
			$this->DrawIssueDeletePage();
		}else if($_GET['chapter'] == 'issue_delete_img'){
			$this->DrawIssueDeleteImagePage();
		}else if($_GET['chapter'] == 'issue_order_img'){
			$this->DrawIssueChangeImagesOrderPage();
		}
		// SUB ISSUE
		else if($_GET['chapter'] == 'sub_issue'){
			$this->DrawIssuePage('sub_issue');
		}else if($_GET['chapter'] == 'sub_issue_create_new'){
			$this->DrawIssueCreateNewPage('sub_issue');
		}else if($_GET['chapter'] == 'sub_issue_edit_form'){
			$this->DrawIssueEditFormPage(null, 'sub_issue');
		}else if($_GET['chapter'] == 'save_sub_issue'){
			$this->DrawIssueSavePage('sub_issue');
		}else if($_GET['chapter'] == 'sub_issue_confirm_delete'){
			$this->DrawIssueConfirmDeletePage(null, 'sub_issue');
		}else if($_GET['chapter'] == 'sub_issue_delete'){
			$this->DrawIssueDeletePage('sub_issue');
		}else if($_GET['chapter'] == 'sub_issue_delete_img'){
			$this->DrawIssueDeleteImagePage('sub_issue');
		}
		// FILE STORAGE
		else if($_GET['chapter'] == 'file_storage'){
			$this->DrawFileStoragePage();
		}else if($_GET['chapter'] == 'save_file_storage'){
			$this->DrawSaveFileStoragePage();
		}else if($_GET['chapter'] == 'file_storage_confirm_delete'){
			$this->DrawFileStarageConfirmDeletePage();
		}else if($_GET['chapter'] == 'file_storage_delete'){
			$this->DrawFileStarageDeletePage();
		}
		
		// AUDIO STORAGE
		else if($_GET['chapter'] == 'audio_storage'){
			$this->DrawAudioStoragePage();
		}else if($_GET['chapter'] == 'save_audio_storage'){
			$this->DrawSaveAudioStoragePage();
		}else if($_GET['chapter'] == 'audio_storage_confirm_delete'){
			$this->DrawAudioStarageConfirmDeletePage();
		}else if($_GET['chapter'] == 'audio_storage_delete'){
			$this->DrawAudioStarageDeletePage();
		}
		
		// ISSUE PROPERTIES
		else if($_GET['chapter'] == 'issue_properties'){
			$this->DrawIssuePropertiesPage();
		}
		// END ISSUE PROPERTIES
		
		
		// 404
		else{
			$this->Draw404Page();
		}
		
		$this->DrawInfoWindow();
	}
	
	function Draw404Page() {
		$this->DrawDivAreaBig();
		echo'<h1>404 - Запрашиваемая страница не найдена</h1>';
		$this->DrawDivAreaBigEnd();
		$this->DrawHomePage();
	}
	
	function DrawHomePage() {
		echo'<hr/>';
		echo'<h2>Управление контентом сайта</h2>';
		echo'<div><a href="?chapter=main_menu">Управление главными разделами сайта</a></div>';
		echo'<div><a href="?chapter=issue">Управление записями сайта</a></div>';
		echo'<div><a href="?chapter=sub_issue">Управление под-записями сайта</a></div>';
		echo'<div><a href="?chapter=file_storage">Файловое хранилище</a></div>';
		echo'<div><a href="?chapter=audio_storage">Аудио</a></div>';
		
		echo'<hr/>';
		echo'<h2>Управление пользователями (только для администратора)</h2>';
		echo'<div><a href="?guests_chapter=index">Список пользователей</a></div>';
		
		echo'<hr/>';
		echo'<h2>Управление настройками (только для администратора)</h2>';
		echo'<div><a href="?chapter=issue_properties">Свойства записей</a></div>';
	}
	
	
	// MAIN MENU
	function DrawMainMenuPage() {
		include_once $this->mono_core_path.'main_menu.php';
		
		$mainMenu = new MainMenu();
		
		//$mainMenu->GetTableItems( 'query_all', Array('lang'), Array($_SESSION['lang']), Array('ORDER BY'=>'order_by') );
		$mainMenu->GetTableItems('query_all', Array('lang', 'is_sub_menu'), Array($_SESSION['lang'], '-1'));
		
		echo'<div><a href="index.php">&larr; Главная</a></div>';
		echo'<h2>Список разделов сайта</h2>';
		
		echo'<div class="create_new_bt"><a href="index.php?chapter=main_menu_create_new">Создать новый раздел</a></div>';
		
		$this->DrawDivAreaBig();
		for ($j = 0; $j < $mainMenu->bd_table_len; $j++) {
			if($mainMenu->bd_table_content['is_visible'][$j] == 1)
				$_is_visible_class = 'visible_list_class';
			else
				$_is_visible_class = 'hidden_list_class';
			echo'<div class="'.$_is_visible_class.'"><a href="?chapter=main_menu_edit_form&id='.$mainMenu->bd_table_content['id'][$j].'">'.($j+1).'. '.$mainMenu->bd_table_content['name'][$j].' (id '.$mainMenu->bd_table_content['id'][$j].'; order: '.$mainMenu->bd_table_content['order_by'][$j].'; chapter = <b>'.$mainMenu->bd_table_content['chapter'][$j].'</b>)</a>
		 		[<a href="?chapter=main_menu_confirm_delete&id='.$mainMenu->bd_table_content['id'][$j].'">Удалить</a>]</div>';
			
			$mainMenu_sub = new MainMenu();
			$mainMenu_sub->GetTableItems('query_all', Array('lang', 'is_sub_menu'), Array($_SESSION['lang'], $mainMenu->bd_table_content['id'][$j]));
			for ($i = 0; $i < $mainMenu_sub->bd_table_len; $i++) {
				if($mainMenu_sub->bd_table_content['is_visible'][$i] == 1)
					$_is_visible_class = 'visible_list_class_sub';
				else
					$_is_visible_class = 'hidden_list_class_sub';
			echo'<div class="'.$_is_visible_class.'"><a href="?chapter=main_menu_edit_form&id='.$mainMenu_sub->bd_table_content['id'][$i].'">'.($i+1).'. '.$mainMenu_sub->bd_table_content['name'][$i].' (id '.$mainMenu_sub->bd_table_content['id'][$i].'; chapter = <b>'.$mainMenu_sub->bd_table_content['chapter'][$i].'</b>)</a>
		 		[<a href="?chapter=main_menu_confirm_delete&id='.$mainMenu_sub->bd_table_content['id'][$i].'">Удалить</a>]</div>';
			
			}
		}
		$this->DrawDivAreaBigEnd();
		
		echo'<div class="create_new_bt"><a href="index.php?chapter=main_menu_create_new">Создать новый раздел</a></div>';
	}
	
	function DrawMainMenuEditFormPage($id=null) {
		include_once $this->mono_core_path.'main_menu.php';
		$mainMenu = new MainMenu();
		if($id == null)
			$id = $_GET['id'];
		$mainMenu->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php">&larr; Главная</a> &larr; <a href="?chapter=main_menu">Список разделов сайта</a></div>';
		echo'<h2>Редактирование раздела "'.$mainMenu->bd_table_content['name'][0].'"</h2>';
		
		include_once $this->mono_core_path.'layouts/form_layouts.php';
		$form_layouts = new FormsLayot();

		$form_layouts->formHeader('?chapter=save_main_menu&id='.$id);
		
		$form_layouts->formSubmit('Сохранить');
		$this->DrawSeparate();
		
		$this->DrawDivAreaBig();
		$form_layouts->inputText('Название: ', 30, $mainMenu->bd_table_content['name'][0], 'name');
		$form_layouts->inputSelect('Отображается ли на сайте:', 'is_visible', Array(1,0),  $mainMenu->bd_table_content['is_visible'][0], Array('Отображается','Не отображается'));		
		$form_layouts->inputText('Последовательность отображения: ', 20, $mainMenu->bd_table_content['order_by'][0], 'order_by');
		
		// Список выбора Подменю
		$mainMenu_sub = new MainMenu();
		$mainMenu_sub->GetTableItems('all');
		$_id = $mainMenu_sub->bd_table_content['id'];
		array_unshift($_id, -1);
		$_name = $mainMenu_sub->bd_table_content['name'];
		array_unshift($_name, 'Не является подменю');
		$form_layouts->inputSelect('Является ли подменю: ', 'is_sub_menu', $_id,  $mainMenu->bd_table_content['is_sub_menu'][0], $_name);
		
		$this->DrawDivAreaBigEnd();
		
		$this->DrawDivAreaBig();
		$form_layouts->inputText('Раздел сайта (English): ', 30, $mainMenu->bd_table_content['chapter'][0], 'chapter');
		$this->DrawDivAreaBigEnd();
		
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/description.png" /> Описание');
		$form_layouts->inputTextarea('', 80, 5, $mainMenu->bd_table_content['description'][0], 'description', '', 'elrte_editor');
		$this->DrawDivAreaBigEnd();
		
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/settings.png" /> Настройки');
		$form_layouts->inputText('Meta keywords: ', 100, $mainMenu->bd_table_content['meta_keywords'][0], 'meta_keywords');
		$this->DrawInfo('* Список ключевых слов должен быть небольшим — до 20 слов, содержать только те слова, которые на самом деле используются на странице или в ссылках на нее, слова не должны повторяться, должны быть перечислены через запятую. В теге meta keywords лучше написать мало или не заполнить его вообще, чем написать лишние слова, поэтому выберите только основные слова для этого тега.');
		
		$form_layouts->inputText('Meta description: ', 100, $mainMenu->bd_table_content['meta_description'][0], 'meta_description');
		$this->DrawInfo('* Тег meta description обязательно нужно правильно заполнить, он предназначен для того, чтобы указать поисковой системе краткое описание страницы, используемое в выдаче поисковика.<br/>Заполните его с ключевыми словами, но так, чтобы оно нормально читалось людьми, хорошо, если описание перекликается с каким-либо предложением на странице, например рекламного характера, характеризующим продукт точной, емкой и понятной фразой. Если же meta description заполнен не точной фразой из основного текста, а произвольно, учтите — то, что написано в meta description проверяется на релевантность, то есть должно содержать те же ключевые слова, что и остальной текст. Тег meta description должен быть небольшим, порядка 200 символов.');
	
		$form_layouts->inputText('HTML Title: ', 100, $mainMenu->bd_table_content['html_title'][0], 'html_title');
		$this->DrawInfo('* Обязательно пишите ключевые слова в тег title. Поисковые системы придают большое значение словам находящимся в этом теге. Наиболее важные ключи должны быть ближе к началу тега. Не стоит делать в title просто перечень ключевых слов. Это ведь лицо вашего сайта (страницы), старайтесь вписать все нужные ключевые слова, но делайте title хорошо читаемым и привлекательным.');
		
		$this->DrawDivAreaBigEnd();
		
		// IMG 1
		$this->DrawDivAreaBig();
		if($mainMenu->bd_table_content['img_1'][0] != ''){
			$this->DrawDivAreaBig();
			echo '<div><a href="'.$mainMenu->bd_table_content['img_1'][0].'" target="_blank"><img src="'.$mainMenu->bd_table_content['img_1'][0].'" height="150px" /></a></div>';
			echo '<div>'.$this->db_con->site_adminka_url.$mainMenu->bd_table_content['img_1'][0].'</div>';
			echo '<div><a href="?chapter=main_menu_delete_img&img=img_1&id='.$mainMenu->bd_table_content['id'][0].'">Удалить</a></div>';
			$this->DrawDivAreaBigEnd();
		}
		
		$form_layouts->inputFile('Фоновое изображение 1: ', 'img_1');
		$this->DrawDivAreaBigEnd();
		
		// IMG 2
		$this->DrawDivAreaBig();
		if($mainMenu->bd_table_content['img_2'][0] != ''){
			$this->DrawDivAreaBig();
			echo '<div><a href="'.$mainMenu->bd_table_content['img_2'][0].'" target="_blank"><img src="'.$mainMenu->bd_table_content['img_2'][0].'" height="150px" /></a></div>';
			echo '<div>'.$this->db_con->site_adminka_url.$mainMenu->bd_table_content['img_2'][0].'</div>';
			echo '<div><a href="?chapter=main_menu_delete_img&img=img_2&id='.$mainMenu->bd_table_content['id'][0].'">Удалить</a></div>';
			$this->DrawDivAreaBigEnd();
		}
		
		$form_layouts->inputFile('Фоновое изображение 2: ', 'img_2');
		$this->DrawDivAreaBigEnd();
		
		$form_layouts->formSubmit('Сохранить');
		$form_layouts->formFooter();
	}
	
	function DrawMainMenuSavePage() {
		include_once $this->mono_core_path.'main_menu.php';
		$mainMenu = new MainMenu();
		$mainMenu->SaveFormData();
		
		$this->DrawMainMenuEditFormPage();
	}
	
	function DrawMainMenuDeleteImagePage() {
		include_once $this->mono_core_path.'main_menu.php';
		$mainMenu = new MainMenu();
		$mainMenu->DeleteImage($_GET['id'], $_GET['img']);
		
		$this->DrawMainMenuEditFormPage();
	}
	
	function DrawMainMenuCreateNewPage() {
		include_once $this->mono_core_path.'main_menu.php';
		$mainMenu = new MainMenu();
		$mainMenu->CreateNew();
		$id = $mainMenu->ReturnLastInsertId();
		
		$this->DrawMainMenuEditFormPage($id);
	}
	
	function DrawMainMenuConfirmDeletePage($id=null) {
		include_once $this->mono_core_path.'main_menu.php';
		$mainMenu = new MainMenu();
		if($id == null)
			$id = $_GET['id'];
		$mainMenu->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php">&larr; Главная</a> &larr; <a href="index.php?chapter=main_menu">Список разделов сайта</a></div>';
		
		echo '<h2>Удалить запись: "'.$mainMenu->bd_table_content['name'][0].'"?</h2>';
		echo'<div class="confirm_delete_bt"><a href="?chapter=main_menu_delete&id='.$id.'">Да</a></div>';
		echo'<div class="confirm_delete_bt"><a href="?chapter=main_menu">Нет</a></div>';
	}
	
	function DrawMainMenuDeletePage() {
		include_once $this->mono_core_path.'main_menu.php';
		$mainMenu = new MainMenu();
		$mainMenu->DeleteItem($_GET['id']);
		
		$this->DrawMainMenuPage();
	}
	// END MAIN MENU
	
	
	
	// ISSUE
	function DrawIssuePage($_type='issue') {
		echo'<div><a href="index.php">&larr; Главная</a></div>';
		echo'<h2>Список записей сайта</h2>';
		
		if($_type == 'issue')
			echo'<div class="create_new_bt"><a href="index.php?chapter=issue_create_new">+ Создать новую запись</a></div>';
		else if($_type == 'sub_issue')
			echo'<div class="create_new_bt"><a href="index.php?chapter=sub_issue_create_new">+ Создать новую запись</a></div>';
		$this->DrawSeparate();
		
		if($_type == 'issue'){
			include_once $this->mono_core_path.'main_menu.php';
			$mainMenu = new MainMenu();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'issue.php';
			$mainMenu = new Issue();
			
			include_once $this->mono_core_path.'main_menu.php';
			$mainMenuTrue = new MainMenu();
			$mainMenuTrue->GetTableItems( 'query_all', Array('lang'), Array($_SESSION['lang']) );
		}
		$mainMenu->GetTableItems( 'query_all', Array('lang'), Array($_SESSION['lang']) );
		
		
		$_edit_link = 'issue_edit_form';
		$_delete_link = 'issue_confirm_delete';
		if($_type == 'issue'){
			include_once $this->mono_core_path.'issue.php';
			$issue= new Issue();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'sub_issue.php';
			$issue= new SubIssue();
			$_edit_link = 'sub_issue_edit_form';
			$_delete_link = 'sub_issue_confirm_delete';
		}
		
		if( isset($mainMenuTrue->bd_table_len) )
			$_menu_len = $mainMenuTrue->bd_table_len;
		else 
			$_menu_len = 1;

		for ($k = 0; $k < $_menu_len; $k++) {						// Enumeration of the Main Menu
			if($_menu_len != 1){
				$this->DrawDivAreaBig();
				$mainMenu->GetTableItems( 'query_all', Array('lang', 'menu'), Array($_SESSION['lang'], $mainMenuTrue->bd_table_content['id'][$k]) );
				echo'<div><b>'.($k+1).'. '.$mainMenuTrue->bd_table_content['name'][$k].'</b></div>';
			}
		
			for ($i = 0; $i < $mainMenu->bd_table_len; $i++) {		// Enumeration of Issues
				$this->DrawDivAreaBig();
				$issue->GetTableItems( 'query_all', Array('lang', 'menu'), Array($_SESSION['lang'], $mainMenu->bd_table_content['id'][$i]) );
				
				echo'<div><b><a href="?chapter=main_menu_edit_form&id='.$mainMenu->bd_table_content['id'][$i].'">'.($i+1).'. '.$mainMenu->bd_table_content['name'][$i].' (id '.$mainMenu->bd_table_content['id'][$i].')</a></b></div>';
				
				for ($j = 0; $j < $issue->bd_table_len; $j++) {		// Enumeration of SubIssues
					$this->DrawDivAreaBig2();
					echo'<div><a href="?chapter='.$_edit_link.'&id='.$issue->bd_table_content['id'][$j].'">'.($i+1).'.'.($j+1).'. '.$issue->bd_table_content['name'][$j].' (id '.$issue->bd_table_content['id'][$j].')</a>
					 [<a href="?chapter='.$_delete_link.'&id='.$issue->bd_table_content['id'][$j].'">Удалить</a>]</div>';
					
					echo'<div class="menu_img_preview">';
					if($issue->bd_table_content['img_1'][$j] != '')
						echo'<img src="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_1'][$j].'" height="40px"/>';
					if($issue->bd_table_content['img_2'][$j] != '')
						echo'<img src="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_2'][$j].'" height="40px"/>';
					if($issue->bd_table_content['img_3'][$j] != '')
						echo'<img src="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_3'][$j].'" height="40px"/>';
					echo'</div>';
					$this->DrawDivAreaBig2End();
				}
				$this->DrawDivAreaBigEnd();
			}
			
			if($_menu_len != 1)
				$this->DrawDivAreaBigEnd();
		}
		
		$issue->GetTableItems( 'query_all', Array('lang', 'menu'), Array($_SESSION['lang'], 0) );
		$this->DrawDivAreaBig();
		
		echo'<div><b>'.($i+1).'. Не разобранные</b></div>';
		for ($j = 0; $j < $issue->bd_table_len; $j++) {
			$this->DrawDivAreaBig2();
			echo'<div><a href="?chapter='.$_edit_link.'&id='.$issue->bd_table_content['id'][$j].'">'.($i+1).'.'.($j+1).'. '.$issue->bd_table_content['name'][$j].'</a>
			 [<a href="?chapter='.$_delete_link.'&id='.$issue->bd_table_content['id'][$j].'">Удалить</a>]
			 </div>';
			$this->DrawDivAreaBig2End();
		}
		
		$this->DrawDivAreaBigEnd();
		
		if($_type == 'issue')
			echo'<div class="create_new_bt"><a href="index.php?chapter=issue_create_new">+ Создать новую запись</a></div>';
		else if($_type == 'sub_issue')
			echo'<div class="create_new_bt"><a href="index.php?chapter=sub_issue_create_new">+ Создать новую запись</a></div>';
	}
	
	function DrawIssueCreateNewPage($_type='issue') {
		if($_type == 'issue'){
			include_once $this->mono_core_path.'issue.php';
			$issue= new Issue();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'sub_issue.php';
			$issue= new SubIssue();
		}
		$issue->CreateNew();
		$id = $issue->ReturnLastInsertId();
		
		$this->DrawIssueEditFormPage($id, $_type);
	}
	
	function DrawIssueEditFormPage($id=null, $_type='issue') {
		$_link = 'save_issue';
		$_link_back = 'issue';
		$_link_delete_image = 'issue_delete_img';
		$_link_top_image = 'issue_order_img';
		
		if($_type == 'issue'){
			include_once $this->mono_core_path.'issue.php';
			$issue = new Issue();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'sub_issue.php';
			$issue = new SubIssue();
			
			$_link = 'save_sub_issue';
			$_link_back = 'sub_issue';
			$_link_delete_image = 'sub_issue_delete_img';
			$_link_top_image = 'sub_issue_order_img';
		}

		if($id == null)
			$id = $_GET['id'];
		$issue->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php">&larr; Главная</a> &larr; <a href="?chapter='.$_link_back.'">Список записей</a></div>';
		echo'<h2>Редактирование записи "'.$issue->bd_table_content['name'][0].'" (id '.$issue->bd_table_content['id'][0].')</h2>';
		
		include_once $this->mono_core_path.'layouts/form_layouts.php';
		$form_layouts = new FormsLayot();
		
		$form_layouts->formHeader('?chapter='.$_link.'&id='.$id);

		$form_layouts->formSubmit('Сохранить');
		$this->DrawSeparate();
		
		echo '<div class="div_area_big">';
		$form_layouts->inputText('Название: ', 30, $issue->bd_table_content['name'][0], 'name');
		echo '</div>';
		
		if($_type == 'issue'){
			include_once $this->mono_core_path.'main_menu.php';
			$mainMenu = new MainMenu();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'issue.php';
			$mainMenu = new Issue();
		}
		$mainMenu->GetTableItems( 'query_all', Array('lang'), Array($_SESSION['lang']) );
		
		echo '<div class="div_area_big">';
		
		$_values = $mainMenu->bd_table_content['id'];
		array_unshift($_values, 0);
		$_value_text = $mainMenu->bd_table_content['name'];
		array_unshift($_value_text, 'Не разобранные');
		
		$form_layouts->inputSelect('Раздел меню:', 'menu', $_values,  $issue->bd_table_content['menu'][0], $_value_text);
		$this->DrawInfo('Раздел главного меню, к которому относится данная запись');
		echo '</div>';
		
		echo '<div class="div_area_big">';
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/description.png" /> Краткое описание');
		$form_layouts->inputTextarea('', 80, 5, htmlspecialchars_decode($issue->bd_table_content['summary'][0]), 'summary', '', 'elrte_editor');
		$this->DrawSeparate();
		$this->DrawInfo('*Для раздела ПОРТФОЛИО<br/>Описание, которое отображается на странице Портфолио, как всплывающий текст внизу окна');
		$this->DrawInfo('*Для остальных Разделов<br/>Основное описание записи, отображаемое на главной странице');
		echo '</div>';
		
		echo '<div class="div_area_big">';
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/description.png" /> Полное описание');
		$form_layouts->inputTextarea('', 80, 5, htmlspecialchars_decode($issue->bd_table_content['description'][0]), 'description', '', 'elrte_editor');
		$this->DrawSeparate();
		$this->DrawInfo('*Для раздела ПОРТФОЛИО<br/>Основное описание данного раздела портфолио. Сюда вставляется код вставки видео с YouTube для записей с видео-контентом.');
		$this->DrawInfo('*Для остальных Разделов<br/>Не используется');
		echo '</div>';
		
		echo '<div class="div_area_big">';
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/description.png" /> Дополнительное описание');
		$form_layouts->inputTextarea('', 80, 5, htmlspecialchars_decode($issue->bd_table_content['description_2'][0]), 'description_2', '', 'elrte_editor');
		$this->DrawSeparate();
		$this->DrawInfo('*Для раздела ПОРТФОЛИО<br/>Комментарии к записи портфолио. Отображается в окне просмотра записи Портфолио в нижней области (подвал).');
		$this->DrawInfo('*Для остальных Разделов<br/>Не используется');
		echo '</div>';
		
		// ISSUE PROPERTIES
		echo '<div class="div_area_big">';
			$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/properties.png" /> Свойства');
			include_once $this->mono_core_path.'issue_properties.php';
			$issueProp = new IssueProperties();
			$issueProp->GetTableItems('all');
			
			$_issue_prop = explode(";", $issue->bd_table_content['properties'][0]);
			for ($j = 0; $j < $issueProp->bd_table_len; $j++) {
				$_issue_prop_val = explode("=", $_issue_prop[$j]);
				
				if($issueProp->bd_table_content['type'][$j] == 'text'){
					$form_layouts->inputText($issueProp->bd_table_content['name'][$j].': ', 100, $_issue_prop_val[1], $issueProp->bd_table_content['field_name'][$j]);
				}else if($issueProp->bd_table_content['type'][$j] == 'tag'){
					$_value_arr = explode(",", $issueProp->bd_table_content['value'][$j]);
					$form_layouts->inputSelect($issueProp->bd_table_content['name'][$j].': ', $issueProp->bd_table_content['field_name'][$j], $_value_arr,  $_issue_prop_val[1], $_value_arr);
				}else if($issueProp->bd_table_content['type'][$j] == 'link_to_table'){
					$_issue_prop_type_2 = explode(";", $issueProp->bd_table_content['value'][$j]);
					
					$_link_to_table = explode("=", $_issue_prop_type_2[0]);
					$_table_field = explode("=", $_issue_prop_type_2[1]);
					
					if($_link_to_table[1] == 'issue')
						$issue_list = new Issue();
					else 
						$issue_list = new Issue();		// Other Tables Need
					$issue_list->GetTableItems('query_all_by_sql_sintax', Array(), Array(), Array(), 'menu >= 31 AND menu <= 35');

					$form_layouts->inputSelect($issueProp->bd_table_content['name'][$j].': ', $issueProp->bd_table_content['field_name'][$j], $issue_list->bd_table_content['id'],  $_issue_prop_val[1], $issue_list->bd_table_content['name']);
				}
			}
		echo '</div>';
		// END ISSUE PROPERTIES
		
		// PHP SCRIPTS ARRAY
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/script.png" /> Файлы скриптов');
		if($issue->bd_table_content['php_file'][0] != ''){
			$_php_arr = explode(",", $issue->bd_table_content['php_file'][0]);
			$_len = count($_php_arr);
			
			$this->DrawDivAreaBig();
			for ($j = 0; $j < $_len; $j++) {
				echo '<div>'.($j+1).'. <a href="'.$_php_arr[$j].'" target="_blank">'.$this->db_con->site_adminka_url.$_php_arr[$j].'</a></div>';
				echo '<div><a href="?chapter='.$_link_delete_image.'&id='.$issue->bd_table_content['id'][0].'&img=php_file&img_id='.$j.'">Удалить</a></div>';
				echo '<hr/>';
			}
			$this->DrawDivAreaBigEnd();
		}
		$form_layouts->inputFile('Файл скрипта: ', 'php_file');
		$this->DrawInfo('*Для всех разделов<br/>Определяет файлы скриптов, выполняемых на странице');
		$this->DrawDivAreaBigEnd();
		
		// IMG 1
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/img.png" /> Изображение 1');
		if($issue->bd_table_content['img_1'][0] != ''){
			$this->DrawDivAreaBig();
			echo '<div><a href="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_1'][0].'" target="_blank"><img src="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_1'][0].'" height="150px" /></a></div>';
			echo '<div>'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_1'][0].'</div>';
			echo '<div><a href="?chapter='.$_link_delete_image.'&id='.$issue->bd_table_content['id'][0].'&img=img_1">Удалить</a></div>';
			$this->DrawDivAreaBigEnd();
		}
		$form_layouts->inputFile('Изображение: ', 'img_1');
		$this->DrawInfo('*Для раздела ПОРТФОЛИО<br/>Превью в разделе Портфолио<br/>Размер: 193х130<br/>Формат: JPG, PNG, BMP');
		$this->DrawInfo('*Для остальных Разделов<br/>Не используется');
		$this->DrawDivAreaBigEnd();
		
		// IMG 2
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/img.png" /> Изображение 2');
		if($issue->bd_table_content['img_2'][0] != ''){
			$this->DrawDivAreaBig();
			echo '<div><a href="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_2'][0].'" target="_blank"><img src="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_2'][0].'" height="150px" /></a></div>';
			echo '<div>'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_2'][0].'</div>';
			echo '<div><a href="?chapter='.$_link_delete_image.'&id='.$issue->bd_table_content['id'][0].'&img=img_2">Удалить</a></div>';
			$this->DrawDivAreaBigEnd();
		}
		$form_layouts->inputFile('Изображение: ', 'img_2');
		$this->DrawInfo('*Для раздела ПОРТФОЛИО<br/>Не используется');
		$this->DrawInfo('*Для остальных Разделов<br/>Не используется');
		$this->DrawDivAreaBigEnd();
		
		// IMG 3
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/img.png" /> Изображение 3');
		if($issue->bd_table_content['img_3'][0] != ''){
			$this->DrawDivAreaBig();
			echo '<div><a href="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_3'][0].'" target="_blank"><img src="'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_3'][0].'" height="150px" /></a></div>';
			echo '<div>'.$this->db_con->site_adminka_url.$issue->bd_table_content['img_3'][0].'</div>';
			echo '<div><a href="?chapter='.$_link_delete_image.'&id='.$issue->bd_table_content['id'][0].'&img=img_3">Удалить</a></div>';
			$this->DrawDivAreaBigEnd();
		}
		$form_layouts->inputFile('Изображение: ', 'img_3');
		$this->DrawInfo('*Для раздела ПОРТФОЛИО<br/>Не используется');
		$this->DrawInfo('*Для остальных Разделов<br/>Не используется');
		$this->DrawDivAreaBigEnd();
		
		// IMG ARRAY
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/img_arr.png" /> Массив Изображений');
		if($issue->bd_table_content['img_arr'][0] != ''){
			$_img_arr = explode(",", $issue->bd_table_content['img_arr'][0]);
			$_len = count($_img_arr);
			
			$this->DrawDivAreaBig();
			for ($j = 0; $j < $_len; $j++) {
				echo '<div class="img_arr_prewiev">['.($j+1).'] <a href="'.$_img_arr[$j].'" target="_blank"><img src="'.$this->db_con->site_adminka_url.$_img_arr[$j].'" height="50px" /></a></div>';
				echo '<div>'.$this->db_con->site_adminka_url.$_img_arr[$j].'</div>';
				echo '<div><a href="?chapter='.$_link_top_image.'&id='.$issue->bd_table_content['id'][0].'&img=img_arr&img_id='.$j.'&order=top">&uarr; Вверх</a>';
				echo '&nbsp;&nbsp;&nbsp;<a href="?chapter='.$_link_top_image.'&id='.$issue->bd_table_content['id'][0].'&img=img_arr&img_id='.$j.'&order=bottom">&darr; Вниз</a></div>';
				echo '<div><a href="?chapter='.$_link_delete_image.'&id='.$issue->bd_table_content['id'][0].'&img=img_arr&img_id='.$j.'">Удалить</a></div>';
				echo '<hr/>';
			}
			$this->DrawDivAreaBigEnd();
		}
		$form_layouts->inputFile('Изображение: ', 'img_arr[]', true);
		$this->DrawInfo('*Для раздела ПОРТФОЛИО<br/>Изображения для слайдшоу записи Портфолио<br/>Ширина не менее: 717пк (желательно использовать изображения шириной именно 717пк)<br/>Высота не менее: 480пк (желательно использовать изображения высотой именно 480пк)');
		$this->DrawInfo('*Для остальных Разделов<br/>Не используется');
		$this->DrawDivAreaBigEnd();
		
		// FILES ARRAY
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/file_arr.png" /> Массив вспомогательных файлов');
		if($issue->bd_table_content['file_arr'][0] != ''){
			$_file_arr = explode(",", $issue->bd_table_content['file_arr'][0]);
			$_len = count($_file_arr);
			
			$this->DrawDivAreaBig();
			for ($j = 0; $j < $_len; $j++) {
				echo '<div>'.($j+1).'. <a href="'.$_file_arr[$j].'" target="_blank">'.$this->db_con->site_adminka_url.$_file_arr[$j].'</a></div>';
				echo '<div><a href="?chapter='.$_link_delete_image.'&id='.$issue->bd_table_content['id'][0].'&img=file_arr&img_id='.$j.'">Удалить</a></div>';
				echo '<hr/>';
			}
			$this->DrawDivAreaBigEnd();
		}
		$form_layouts->inputFile('Файл: ', 'file_arr[]', true);
		$this->DrawInfo('*Для раздела ПОРТФОЛИО<br/>Массив аудио файлов, сопровождающих слайдшоу.');
		$this->DrawInfo('*Для остальных Разделов<br/>Не используется');
		$this->DrawDivAreaBigEnd();
		
		
		$form_layouts->formSubmit('Сохранить');
		$form_layouts->formFooter();
		
		$this->DrawSeparate();
		echo'<div><a href="index.php">&larr; Главная</a> &larr; <a href="?chapter='.$_link_back.'">Список записей</a></div>';
		$this->DrawSeparate();
	}
	
	function DrawIssueSavePage($_type='issue') {
		if($_type == 'issue'){
			include_once $this->mono_core_path.'issue.php';
			$issue= new Issue();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'sub_issue.php';
			$issue= new SubIssue();
		}
		$issue->SaveFormData();
		
		$this->DrawIssueEditFormPage(null, $_type);
	}
	
	function DrawIssueConfirmDeletePage($id=null, $_type='issue') {
		$_link = 'issue_delete';
		$_link_back = 'issue';
		if($_type == 'issue'){
			include_once $this->mono_core_path.'issue.php';
			$issue= new Issue();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'sub_issue.php';
			$issue= new SubIssue();
			$_link = 'sub_issue_delete';
			$_link_back = 'sub_issue';
		}
		
		if($id == null)
			$id = $_GET['id'];
		$issue->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php">&larr; Главная</a> &larr; <a href="?chapter='.$_link_back.'">Список записей</a></div>';
		
		echo '<h2>Удалить запись: "'.$issue->bd_table_content['name'][0].'"?</h2>';
		echo'<div class="confirm_delete_bt"><a href="?chapter='.$_link.'&id='.$id.'">Да</a></div>';
		echo'<div class="confirm_delete_bt"><a href="?chapter='.$_link_back.'">Нет</a></div>';
	}
	
	function DrawIssueDeletePage($_type='issue') {
		if($_type == 'issue'){
			include_once $this->mono_core_path.'issue.php';
			$issue= new Issue();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'sub_issue.php';
			$issue= new SubIssue();
			$_link = 'sub_issue_delete';
			$_link_back = 'sub_issue';
		}
		$issue->DeleteItem($_GET['id']);
		
		$this->DrawIssuePage($_type);
	}
	
	function DrawIssueDeleteImagePage($_type='issue') {
		if($_type == 'issue'){
			include_once $this->mono_core_path.'issue.php';
			$issue= new Issue();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'sub_issue.php';
			$issue= new SubIssue();
		}
		$issue->DeleteImgItem($_GET['id'], $_GET['img']);
		
		$this->DrawIssueEditFormPage(null, $_type);
	}
	
	function DrawIssueChangeImagesOrderPage($_type='issue') {
		if($_type == 'issue'){
			include_once $this->mono_core_path.'issue.php';
			$issue= new Issue();
		}
		else if($_type == 'sub_issue'){
			include_once $this->mono_core_path.'sub_issue.php';
			$issue= new SubIssue();
		}
		$issue->ChangeImagesOrder($_GET['id'], $_GET['img'], $_GET['order']);
		
		$this->DrawIssueEditFormPage(null, $_type);
	}
	// END ISSUE
	
	
	
	// FILE STORAGE
	function DrawFileStoragePage() {
		echo'<div><a href="index.php">&larr; Главная</a></div>';
		echo'<h2>Файловое хранилище</h2>';
		
		include_once $this->mono_core_path.'layouts/form_layouts.php';
		$form_layouts = new FormsLayot();
		
		$form_layouts->formHeader('?chapter=save_file_storage');
		$this->DrawDivAreaBig();
		$form_layouts->inputFile('Добавить файл: ', 'file_link');
		$this->DrawDivAreaBigEnd();
		$form_layouts->formSubmit('Сохранить');
		$this->DrawSeparate();
		$form_layouts->formFooter();
		
		include_once $this->mono_core_path.'file_storage.php';
		$fileStorage = new FileStorage();
		$fileStorage->GetTableItems();
		
		echo '<table class="file_storage_table"><tr><td>id</td><td>Изображение</td><td>Ссылка</td><td>Дата</td><td>Удалить</td></tr>';
		for ($j = 0; $j < $fileStorage->bd_table_len; $j++) {
			echo '<tr>
			<td>'.$fileStorage->bd_table_content['id'][$j].'</td>
			<td><a href="'.$fileStorage->bd_table_content['file_link'][$j].'" target="_blank"><img src="'.$this->db_con->site_adminka_url.$fileStorage->bd_table_content['file_link'][$j].'" width="80px"/></a></td>
			<td>'.$this->db_con->site_adminka_url.$fileStorage->bd_table_content['file_link'][$j].'</td>
			<td>'.$fileStorage->bd_table_content['date'][$j].'</td>
			<td><a href="?chapter=file_storage_confirm_delete&id='.$fileStorage->bd_table_content['id'][$j].'">Удалить</a></td>
			</tr>';
		}
		echo '</table>';
	}

	function DrawSaveFileStoragePage() {
		include_once $this->mono_core_path.'file_storage.php';
		$fileStorage = new FileStorage();
		$fileStorage->CreateNew();
		
		$this->DrawFileStoragePage();
	}
	
	function DrawFileStarageConfirmDeletePage($id=null) {
		include_once $this->mono_core_path.'file_storage.php';
		$fileStorage = new FileStorage();
		if($id == null)
			$id = $_GET['id'];
		$fileStorage->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php">&larr; Главная</a> &larr; <a href="?chapter=file_storage">Файловое хранилище</a></div>';
		
		echo '<h2>Удалить файл: "'.$fileStorage->bd_table_content['file_link'][0].'"?</h2>';
		echo'<div class="confirm_delete_bt"><a href="?chapter=file_storage_delete&id='.$id.'&link='.$fileStorage->bd_table_content['file_link'][0].'">Да</a></div>';
		echo'<div class="confirm_delete_bt"><a href="?chapter=file_storage">Нет</a></div>';
	}
	
	function DrawFileStarageDeletePage() {
		include_once $this->mono_core_path.'file_storage.php';
		$fileStorage = new FileStorage();
		$fileStorage->DeleteItem($_GET['id'], $_GET['link']);
		
		$this->DrawFileStoragePage();
	}
	// END FILE STORAGE
	
	
	
	
	// AUDIO STORAGE
	function DrawAudioStoragePage() {
		echo'<div><a href="index.php">&larr; Главная</a></div>';
		echo'<h2>Аудио хранилище</h2>';
		
		include_once $this->mono_core_path.'layouts/form_layouts.php';
		$form_layouts = new FormsLayot();
		
		$form_layouts->formHeader('?chapter=save_audio_storage');
		$this->DrawDivAreaBig();
		$form_layouts->inputFile('Добавить файл: ', 'file_link');
		$this->DrawDivAreaBigEnd();
		$form_layouts->formSubmit('Сохранить');
		$this->DrawSeparate();
		$form_layouts->formFooter();
		
		
		include_once $this->mono_core_path.'audio_storage.php';
		$audioStorage = new AudioStorage();
		$audioStorage->GetTableItems();
		
		echo '<table class="file_storage_table"><tr><td>id</td><td>Ссылка</td><td>Дата</td><td>Удалить</td></tr>';
		for ($j = 0; $j < $audioStorage->bd_table_len; $j++) {
			echo '<tr>
			<td>'.$audioStorage->bd_table_content['id'][$j].'</td>
			<td>'.$this->db_con->site_adminka_url.$audioStorage->bd_table_content['file_link'][$j].'</td>
			<td>'.$audioStorage->bd_table_content['date'][$j].'</td>
			<td><a href="?chapter=audio_storage_confirm_delete&id='.$audioStorage->bd_table_content['id'][$j].'">Удалить</a></td>
			</tr>';
		}
		echo '</table>';
	}

	function DrawSaveAudioStoragePage() {
		include_once $this->mono_core_path.'audio_storage.php';
		$audioStorage = new AudioStorage();
		$audioStorage->CreateNew();
		
		$this->DrawAudioStoragePage();
	}
	
	function DrawAudioStarageConfirmDeletePage($id=null) {
		include_once $this->mono_core_path.'audio_storage.php';
		$audioStorage = new AudioStorage();
		if($id == null)
			$id = $_GET['id'];
		$audioStorage->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php">&larr; Главная</a> &larr; <a href="?chapter=file_storage">Файловое хранилище</a></div>';
		
		echo '<h2>Удалить файл: "'.$audioStorage->bd_table_content['file_link'][0].'"?</h2>';
		echo'<div class="confirm_delete_bt"><a href="?chapter=audio_storage_delete&id='.$id.'&link='.$audioStorage->bd_table_content['file_link'][0].'">Да</a></div>';
		echo'<div class="confirm_delete_bt"><a href="?chapter=audio_storage">Нет</a></div>';
	}
	
	function DrawAudioStarageDeletePage() {
		include_once $this->mono_core_path.'audio_storage.php';
		$audioStorage = new AudioStorage();
		$audioStorage->DeleteItem($_GET['id'], $_GET['link']);
		
		$this->DrawAudioStoragePage();
	}
	// END AUDIO STORAGE
	
	
	
	
	// ISSUE PROPERTIES
	function DrawIssuePropertiesPage() {
		include_once $this->mono_core_path.'db_processing/simple_db_table_form.php';
		$s_DB_TableForm = new Simple_DB_TableForm();
		
		include_once $this->mono_core_path.'/issue_properties.php';
		$issueProperties = new IssueProperties();
		
		//include_once $this->mono_core_path.'main_menu.php';
		//$mainMenu = new MainMenu();
		
		$s_DB_TableForm->init($issueProperties, $this->mono_core_path);
		
		$s_DB_TableForm->MainDraw();
	}
	// END ISSUE PROPERTIES
	
	
	
	
	// HELPER
	function DrawDivAreaBig() {
		echo '<div class="div_area_big">';
	}
	function DrawDivAreaBigEnd() {
		echo '</div>';
	}
	function DrawDivAreaBigCaption($_caption) {
		echo '<h2>'.$_caption.'</h2>';
	}
	function DrawDivAreaBig2() {
		echo '<div class="div_area_big_2">';
	}
	function DrawDivAreaBig2End() {
		echo '</div>';
	}
	function DrawInfo($_info) {
		echo '<div class="info_field">'.$_info.'</div>';
	}
	function DrawSeparate() {
		echo '<div class="separate_1"></div>';
	}
	// END HELPER
}
?>