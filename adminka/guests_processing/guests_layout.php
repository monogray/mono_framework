<?php
class GuestsLayot {
	public $user_data;
	public $db_con;
	
	public $mono_core_path = '';
	public $adminka_path = '';
	
	function GuestsLayot($_userData, $_dbConnect){
		$this->user_data = $_userData;
		
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

				<!-- elRTE -->
				<!-- jQuery and jQuery UI -->
				<script src="'.$this->adminka_path.'js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
				<link rel="stylesheet" href="'.$this->adminka_path.'css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">

				<!-- elRTE -->
				<script src="'.$this->adminka_path.'js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
				<link rel="stylesheet" href="'.$this->adminka_path.'css/elrte.min.css" type="text/css" media="screen" charset="utf-8">

				<!-- elRTE translation messages -->
				<script src="'.$this->adminka_path.'js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
			
				<script type="text/javascript" charset="utf-8">
					$().ready(function() {
						var opts = {
							cssClass : "el-rte",
							lang     : "ru",
							height   : 350,
							toolbar  : "maxi",
							cssfiles : ["css/elrte-inner.css"]
						}
						$(".elrte_editor").elrte(opts);
						
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
						//$('#info_window_container').hide(1000);
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
	
	function DrawMainArea() {
		echo'<div>Язык: || <a href="?chapter=too_ru" title="Произойдет возврат на главную страницу">RU</a> || <a href="?chapter=too_en" title="Произойдет возврат на главную страницу">EN</a> ||</div>';
		echo'<h1>Админка [Управление пользователями]</h1>';
		echo'<div><a href="index.php">&larr; Главная</a></div>';
		
		if(!isset($_SESSION['lang']))
			$_SESSION['lang'] = '1';
			
		$_SESSION['acces_from'] = 'adminka';
		
		/*if($_GET['chapter'] == '' || $_GET['chapter'] == null ){
			$this->DrawHomePage();
		}else if($_GET['chapter'] == 'too_ru'){
			$_SESSION['lang'] = '1';
			$this->DrawHomePage();
		}else if($_GET['chapter'] == 'too_en'){
			$_SESSION['lang'] = '2';
			$this->DrawHomePage();
		}*/
		if($_GET['guests_chapter'] == 'index'){
			$this->DrawHomePage();
		}
		// GUESTS
		else if($_GET['guests_chapter'] == 'guests'){
			$this->Draw_Guests_MainPage();
		}else if($_GET['guests_chapter'] == 'guests_edit_form'){
			$this->Draw_Guests_EditFormPage();
		}else if($_GET['guests_chapter'] == 'save_guests'){
			$this->Draw_Guests_SavePage();
		}else if($_GET['guests_chapter'] == 'main_menu_delete_img'){
			$this->DrawMainMenuDeleteImagePage();
		}else if($_GET['guests_chapter'] == 'guests_create_new'){
			$this->Draw_Guests_CreateNewPage();
		}else if($_GET['guests_chapter'] == 'guests_confirm_delete'){
			$this->Draw_Guests_ConfirmDeletePage();
		}else if($_GET['guests_chapter'] == 'guests_delete'){
			$this->Draw_Guests_DeletePage();
		}
	
		// GROUPS
		else if($_GET['guests_chapter'] == 'guests_groups'){
			$this->Draw_GuestsGroups_MainPage();
		}else if($_GET['guests_chapter'] == 'guests_groups_edit_form'){
			$this->Draw_GuestsGroups_EditFormPage();
		}else if($_GET['guests_chapter'] == 'save_guests_groups'){
			$this->Draw_GuestsGroups_SavePage();
		//}else if($_GET['guests_chapter'] == 'main_menu_delete_img'){
			//$this->DrawMainMenuDeleteImagePage();
		}else if($_GET['guests_chapter'] == 'guests_groups_create_new'){
			$this->Draw_GuestsGroups_CreateNewPage();
		}else if($_GET['guests_chapter'] == 'guests_groups_confirm_delete'){
			$this->Draw_GuestsGroups_ConfirmDeletePage();
		}else if($_GET['guests_chapter'] == 'guests_groups_delete'){
			$this->Draw_GuestsGroups_DeletePage();
		}
		
		// QR
		else if($_GET['guests_chapter'] == 'qr_500_list'){
			$this->Draw_QR500List_MainPage();
		}
		
		
		// ISSUE PROPERTIES
		//else if($_GET['guests_chapter'] == 'guests'){
			//$this->DrawIssuePropertiesPage();
		//}
		
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
		echo'<div><a href="?guests_chapter=guests">Список пользователей</a></div>';
		echo'<div><a href="?guests_chapter=guests_groups">Список групп</a></div>';
		//echo'<div><a href="?chapter=sub_issue">Управление под-записями сайта</a></div>';
		//echo'<div><a href="?chapter=file_storage">Файловое хранилище</a></div>';
		//echo'<div><a href="?chapter=audio_storage">Аудио</a></div>';
		
		//echo'<hr/>';
		//echo'<h2>Управление настройками (только для администратора)</h2>';
		//echo'<div><a href="?chapter=issue_properties">Свойства записей</a></div>';
		
		echo'<hr/>';
		echo'<h2>QR</h2>';
		echo'<div><a href="?guests_chapter=qr_500_list">Список 500 QR-кодов</a></div>';
	}
	
	// GUESTS
	function Draw_Guests_MainPage() {
		include_once $this->mono_core_path.'guests/guests.php';
		$mainMenu = new Guests();
		
		$mainMenu->GetTableItems('all');
		
		echo'<div><a href="?guests_chapter=index">&larr; Главная</a></div>';
		echo'<h2>Список разделов сайта</h2>';
		
		echo'<div class="create_new_bt"><a href="index.php?guests_chapter=guests_create_new">Создать новый раздел</a></div>';
		
		$this->DrawDivAreaBig();
		for ($j = 0; $j < $mainMenu->bd_table_len; $j++) {
			echo'<div class=""><a href="?guests_chapter=guests_edit_form&id='.$mainMenu->bd_table_content['id'][$j].'">'.$mainMenu->bd_table_content['id'][$j].'. '.$mainMenu->bd_table_content['surname'][$j].' '.$mainMenu->bd_table_content['name'][$j].' '.$mainMenu->bd_table_content['patronymic'][$j].' (id '.$mainMenu->bd_table_content['id'][$j].')</a>
		 		[<a href="?guests_chapter=guests_confirm_delete&id='.$mainMenu->bd_table_content['id'][$j].'">Удалить</a>]</div>';
		}
		$this->DrawDivAreaBigEnd();
		
		echo'<div class="create_new_bt"><a href="index.php?guests_chapter=guests_create_new">Создать новый раздел</a></div>';
	}
	
	function Draw_Guests_EditFormPage($id=null) {
		include_once $this->mono_core_path.'guests/guests.php';
		$mainMenu = new Guests();
		if($id == null)
			$id = $_GET['id'];
		$mainMenu->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="?guests_chapter=index">&larr; Главная</a> <a href="?guests_chapter=guests">&larr; Список разделов сайта</a></div>';
		echo'<h2>Редактирование пользователя id '.$mainMenu->bd_table_content['id'][0].' "'.$mainMenu->bd_table_content['surname'][0].' '.$mainMenu->bd_table_content['name'][0].'"</h2>';
		
		include_once $this->mono_core_path.'layouts/form_layouts.php';
		$form_layouts = new FormsLayot();

		$form_layouts->formHeader('?guests_chapter=save_guests&id='.$id);
		
		$form_layouts->formSubmit('Сохранить');
		$this->DrawSeparate();
		
		$this->DrawDivAreaBig();
		$form_layouts->inputText('Фамилия: ', 50, $mainMenu->bd_table_content['surname'][0], 'surname');
		$form_layouts->inputText('Имя: ', 50, $mainMenu->bd_table_content['name'][0], 'name');
		$form_layouts->inputText('Отчество: ', 50, $mainMenu->bd_table_content['patronymic'][0], 'patronymic');
		echo '<div>id '.$mainMenu->bd_table_content['id'][0].'. <img src="qr/500/saved_resource('.($mainMenu->bd_table_content['id'][0]-1).')" alt="QRCode"/></div>';
		$this->DrawDivAreaBigEnd();
		
		// Список Групп
		$this->DrawDivAreaBig();
		include_once $this->mono_core_path.'guests/guests_groups.php';
		$mainMenu_sub = new GuestsGroups();
		$mainMenu_sub->GetTableItems('all');
		$_id = $mainMenu_sub->bd_table_content['id'];
		$_name = $mainMenu_sub->bd_table_content['name'];
		$form_layouts->inputSelect('Группа: ', 'groups', $_id,  $mainMenu->bd_table_content['groups'][0], $_name);
		$this->DrawDivAreaBigEnd();
		
		// Свойства
		$this->DrawDivAreaBig();
		include_once $this->mono_core_path.'guests/guests_properties.php';
		$guests_prop = new GuestsProperties();
		$guests_prop->CreateIfNotExist($id);
		$guests_prop->GetTableItems('query_one', Array('guests_id'), Array($id));
		
		if($guests_prop->bd_table_content['main_registration'][0] == 1)
			$_main_registration = 'Да';
		else
			$_main_registration = 'Нет';
		echo '<div>Основная регистрация: '.$_main_registration.'</div>';
		echo '<div>Регистрация Ворк-Шоп 1: ----'.$_main_registration.'</div>';
		echo '<div>Регистрация Ворк-Шоп 2: ----'.$_main_registration.'</div>';
		$this->DrawDivAreaBigEnd();
		
		// Описание
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/description.png" /> Описание');
		$form_layouts->inputTextarea('', 80, 5, $mainMenu->bd_table_content['description'][0], 'description', '', 'elrte_editor');
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
		
		$form_layouts->formSubmit('Сохранить');
		$form_layouts->formFooter();
	}
	
	function Draw_Guests_SavePage() {
		include_once $this->mono_core_path.'guests/guests.php';
		$mainMenu = new Guests();
		$mainMenu->SaveFormData();
		
		$this->Draw_Guests_EditFormPage();
	}
	
	/*function DrawMainMenuDeleteImagePage() {
		include_once $this->mono_core_path.'main_menu.php';
		$mainMenu = new MainMenu();
		$mainMenu->DeleteImage($_GET['id'], $_GET['img']);
		
		$this->Draw_Guests_EditFormPage();
	}*/
	
	function Draw_Guests_CreateNewPage() {
		include_once $this->mono_core_path.'guests/guests.php';
		$mainMenu = new Guests();
		$mainMenu->CreateNew();
		$id = $mainMenu->ReturnLastInsertId();
		
		$this->Draw_Guests_EditFormPage($id);
	}
	
	function Draw_Guests_ConfirmDeletePage($id=null) {
		include_once $this->mono_core_path.'guests/guests.php';
		$mainMenu = new Guests();
		if($id == null)
			$id = $_GET['id'];
		$mainMenu->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php?guests_chapter=index">&larr; Главная</a> &larr; <a href="index.php?guests_chapter=guests">Список пользователей</a></div>';
		
		echo '<h2>Удалить запись: "'.$mainMenu->bd_table_content['name'][0].'"?</h2>';
		echo'<div class="confirm_delete_bt"><a href="?guests_chapter=guests_delete&id='.$id.'">Да</a></div>';
		echo'<div class="confirm_delete_bt"><a href="?guests_chapter=guests">Нет</a></div>';
	}
	
	function Draw_Guests_DeletePage() {
		include_once $this->mono_core_path.'guests/guests.php';
		$mainMenu = new Guests();
		$mainMenu->DeleteItem($_GET['id']);
		
		$this->Draw_Guests_MainPage();
	}
	// END GUESTS
	
	
	
	
	// GROUPS
	function Draw_GuestsGroups_MainPage() {
		include_once $this->mono_core_path.'guests/guests_groups.php';
		$mainMenu = new GuestsGroups();
		
		$mainMenu->GetTableItems('all');
		
		echo'<div><a href="?guests_chapter=index">&larr; Главная</a></div>';
		echo'<h2>Список разделов сайта</h2>';
		
		echo'<div class="create_new_bt"><a href="index.php?guests_chapter=guests_groups_create_new">Создать новый раздел</a></div>';
		
		$this->DrawDivAreaBig();
		for ($j = 0; $j < $mainMenu->bd_table_len; $j++) {
			echo'<div class=""><a href="?guests_chapter=guests_groups_edit_form&id='.$mainMenu->bd_table_content['id'][$j].'">'.($j+1).'. '.$mainMenu->bd_table_content['surname'][$j].' '.$mainMenu->bd_table_content['name'][$j].' '.$mainMenu->bd_table_content['patronymic'][$j].' (id '.$mainMenu->bd_table_content['id'][$j].')</a>
		 		[<a href="?guests_chapter=guests_confirm_delete&id='.$mainMenu->bd_table_content['id'][$j].'">Удалить</a>]</div>';
		}
		$this->DrawDivAreaBigEnd();
		
		echo'<div class="create_new_bt"><a href="index.php?guests_chapter=guests_groups_create_new">Создать новый раздел</a></div>';
	}
	
	function Draw_GuestsGroups_EditFormPage($id=null) {
		include_once $this->mono_core_path.'guests/guests_groups.php';
		$mainMenu = new GuestsGroups();
		if($id == null)
			$id = $_GET['id'];
		$mainMenu->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="?guests_chapter=index">&larr; Главная</a> <a href="?guests_chapter=guests_groups">&larr; Список разделов сайта</a></div>';
		echo'<h2>Редактирование раздела "'.$mainMenu->bd_table_content['name'][0].'"</h2>';
		
		include_once $this->mono_core_path.'layouts/form_layouts.php';
		$form_layouts = new FormsLayot();

		$form_layouts->formHeader('?guests_chapter=save_guests_groups&id='.$id);
		
		$form_layouts->formSubmit('Сохранить');
		$this->DrawSeparate();
		
		$this->DrawDivAreaBig();
		$form_layouts->inputText('Фамилия: ', 50, $mainMenu->bd_table_content['surname'][0], 'surname');
		$form_layouts->inputText('Имя: ', 50, $mainMenu->bd_table_content['name'][0], 'name');
		$form_layouts->inputText('Отчество: ', 50, $mainMenu->bd_table_content['patronymic'][0], 'patronymic');

		$this->DrawDivAreaBigEnd();
		
		$this->DrawDivAreaBig();
		$this->DrawDivAreaBigCaption('<img src="'.$this->adminka_path.'images/layout/description.png" /> Описание');
		$form_layouts->inputTextarea('', 80, 5, $mainMenu->bd_table_content['description'][0], 'description', '', 'elrte_editor');
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
		
		$form_layouts->formSubmit('Сохранить');
		$form_layouts->formFooter();
	}
	
	function Draw_GuestsGroups_SavePage() {
		include_once $this->mono_core_path.'guests/guests_groups.php';
		$mainMenu = new GuestsGroups();
		$mainMenu->SaveFormData();
		
		$this->Draw_GuestsGroups_EditFormPage();
	}
	
	function Draw_GuestsGroups_CreateNewPage() {
		include_once $this->mono_core_path.'guests/guests_groups.php';
		$mainMenu = new GuestsGroups();
		$mainMenu->CreateNew();
		$id = $mainMenu->ReturnLastInsertId();
		
		$this->Draw_GuestsGroups_EditFormPage($id);
	}
	
	function Draw_GuestsGroups_ConfirmDeletePage($id=null) {
		include_once $this->mono_core_path.'guests/guests_groups.php';
		$mainMenu = new GuestsGroups();
		if($id == null)
			$id = $_GET['id'];
		$mainMenu->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php?guests_chapter=index">&larr; Главная</a> &larr; <a href="index.php?guests_chapter=guests">Список пользователей</a></div>';
		
		echo '<h2>Удалить запись: "'.$mainMenu->bd_table_content['name'][0].'"?</h2>';
		echo'<div class="confirm_delete_bt"><a href="?guests_chapter=guests_delete&id='.$id.'">Да</a></div>';
		echo'<div class="confirm_delete_bt"><a href="?guests_chapter=guests">Нет</a></div>';
	}
	
	function Draw_GuestsGroups_DeletePage() {
		include_once $this->mono_core_path.'guests/guests.php';
		$mainMenu = new GuestsGroups();
		$mainMenu->DeleteItem($_GET['id']);
		
		$this->Draw_GuestsGroups_MainPage();
	}
	// END GROUPS
	
	// QR
	
	function Draw_QR500List_MainPage() {
		include_once $this->mono_core_path.'guests/guests_groups.php';
		$mainMenu = new GuestsGroups();
		
		$mainMenu->GetTableItems('all');
		
		echo'<div><a href="?guests_chapter=index">&larr; Главная</a></div>';
		echo'<h2>Список QR кодов</h2>';
		$this->DrawDivAreaBig();
		for ($j = 0; $j < 500; $j++) {
			//echo '<div>'.$j.'<img src="http://qr.kaywa.com/?s=8&d='.$j.'" alt="QRCode"/></div>';
			echo '<div>'.($j+1).'. <img src="qr/500/saved_resource('.$j.')" alt="QRCode"/></div>';
		}
		$this->DrawDivAreaBigEnd();
	}
	// END QR
	
	/*// ISSUE PROPERTIES
	function DrawIssuePropertiesPage() {
		include_once $this->mono_core_path.'db_processing/simple_db_table_form.php';
		$s_DB_TableForm = new Simple_DB_TableForm();
		
		//include_once $this->mono_core_path.'/issue_properties.php';
		//$issueProperties = new IssueProperties();
		
		include_once $this->mono_core_path.'guests/guests.php';
		$guests = new Guests();
		
		$s_DB_TableForm->init($guests, $this->mono_core_path);
		
		$s_DB_TableForm->MainDraw();
	}
	// END ISSUE PROPERTIES
	*/
	
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