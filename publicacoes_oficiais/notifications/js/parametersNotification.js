const CRM_KEY = '[N&Uacute;MERO CRM]';
const NOTIFIED_KEY = '[NOME M&Eacute;DICO]';
const GENRE_1_KEY = '[o/a]';
const GENRE_2_KEY = '[a]';
const PEP_KEY = '[N&Uacute;MERO PEP]';
const DOE_KEY = '[DATA DOE]';
const RESOLUTION_KEY = '[RESOLU&Ccedil;&Atilde;O]';
const ARTICLES_KEY = '[ARTIGOS]';
const UNITY_KEY = '[UNIDADE CREMESP]';
const ADDRESS_KEY = '[ENDERE&Ccedil;O]';
const DAY_KEY = '[DIA]';
const MONTH_KEY = '[M&Ecirc;S]';
const YEAR_KEY = '[ANO]';

function replaceParametersInNotification(editor, template) {
	
	let crm = $("#input-crm").val();
	let pep = $("#select-pep").val();
	let doe = $("#input-date").val();
	let day = getDay();
	let month = getMonth();
	let year = getYear();
	let resolution = $("#input-cfmResolution").val();
	let articles = $("#input-articles").val();
	let unity = getUnityWithoutInitials($("#select-unity option:selected").text());
	let address = $("#input-address").val();

	$.getJSON("getDoctorByCRM.php?crm=" + crm, (data) => {
		notified = data.name; 
		genre = data.genre;
	})
	.done(function () {
		
		let notification = template;
		
		notification = replaceParam(notification,CRM_KEY, crm);
		notification = replaceParam(notification,NOTIFIED_KEY , notified);
		notification = replaceParam(notification,GENRE_1_KEY , genre);
		notification = replaceParam(notification,GENRE_2_KEY , genre);		
		notification = replaceParam(notification,PEP_KEY, pep);
		notification = replaceParam(notification,DOE_KEY, doe);
		notification = replaceParam(notification,DAY_KEY, day);
		notification = replaceParam(notification,MONTH_KEY, month);
		notification = replaceParam(notification,YEAR_KEY, year);
		notification = replaceParam(notification,RESOLUTION_KEY, resolution);
		
		notification = replaceParam(notification,ARTICLES_KEY, removeLastComma(articles));
		notification = setArticlesToSingular(notification, articles);
		
		notification = replaceParam(notification,UNITY_KEY , unity);
		notification = replaceParam(notification,ADDRESS_KEY , address);
		
		if (template != notification) {
			editor.setData(notification);
			notifySuccess('Updated notification.');
		} else {
			notifyWarning("Notification wasn't updated because the parameters they were not found or have already been updated!");
		}		
		
	});

}

function getUnityWithoutInitials(unity){
	return unity.substring(0,unity.length - 8);
}

function removeLastComma(articles){
	 return articles.trim().replace(/,+$/, "");
}

function setArticlesToSingular(notification, articles){
	
	if (isValid(articles)){
		
		let commasQuantity = articles.split(",").length - 1;
		let eQuantity = articles.split("e").length - 1;
		
		if ((commasQuantity + eQuantity) < 1){
			notification = notification.replaceAll('aos artigos', 'ao artigo');
		}
		
	}

	return notification;
	
}

function replaceParam(notification, key, param){
	
	if (isValid(notification) && isValid(param)){
		
		param = String(param).trim();
		
		notification = notification.replaceAll("<span style='color:#e74c3c'>" + key + '</span>', key);
		
		if (param == 'M' && key == GENRE_2_KEY){
			notification = notification.replaceAll(key,"")
		}else if (param == 'M'){
			notification = notification.replaceAll(key,"o")
		}else if (param == 'F'){
			notification = notification.replaceAll(key,"a");
		} else{
			notification = notification.replace(key,param);
		}
		
	}
	
	return 	notification;
	
}

function getDay(){
	let date = new Date();
	return date.getDate();
}

function getMonth(){
	let date = new Date(); 
	let month = date.toLocaleString('pt-br', { month: 'long' });
	month = month.charAt(0).toUpperCase() + month.slice(1);
	return month;	
}

function getYear(){
	let date = new Date();
	return date.getFullYear();
}

function isValid(param){
	return (param != null && param != "" && param != "undefined"); 
}