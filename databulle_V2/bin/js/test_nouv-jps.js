if (navigator.geolocation)
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {enableHighAccuracy:true, maximumAge:300000} );
else
    alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
    
function successCallback(position){
    alert("Latitude : " + position.coords.latitude + ", longitude : " + position.coords.longitude);
}; 

function errorCallback(error){
    switch(error.code){
        case error.PERMISSION_DENIED:
            alert("L'utilisateur n'a pas autorisé l'accès à sa position");
            break;          
        case error.POSITION_UNAVAILABLE:
            alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
            break;
        case error.TIMEOUT:
            alert("Le service n'a pas répondu à temps");
            break;
        }
};

function stopWatch(){
    navigator.geolocation.clearWatch(watchId);
} 


/* moi sur databulle*/

function geo()
{			
	if(navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(function(position){
			enableHighAccuracy: true;
			latitude = position.coords.latitude;
			longitude = position.coords.longitude;
			precition = position.coords.accuracy;
			$.post("php/recup_log_adresse.php",{lat:latitude,lng:longitude,typrech:typch}, gestiondon,'json');
		});
	}
}

/* nouvel geolocalisation de databulle */
function geo()
{			
	if(navigator.geolocation)
	{
		 navigator.geolocation.getCurrentPosition(geosuccess, geoerror, {enableHighAccuracy:true, timeout:300000, maximumAge:0} );
	}
	else{
		/* ici texte pour erreur exemple: "Votre navigateur ne prend pas en compte la géolocalisation HTML5" */
	}
}
function geosuccess(position){
	latitude = position.coords.latitude;
	longitude = position.coords.longitude;
	precition = position.coords.accuracy;
	$.post("php/recup_log_adresse.php",{lat:latitude,lng:longitude,typrech:typch}, gestiondon,'json');
}

function erreurPosition(error) {
    var info = "Erreur lors de la géolocalisation : ";
    switch(error.code) {
		case error.TIMEOUT:
			info += "Le service n'a pas répondu à temps";
			break;
		case error.PERMISSION_DENIED:
			info += "Vous n’avez pas donné la permission";
			break;
		case error.POSITION_UNAVAILABLE:
			info += "La position n’a pu être déterminée";
		break;
		case error.UNKNOWN_ERROR:
			info += "Erreur inconnue";
		break;
		}
	/* afficher l'erreur */
}
		
		
		
		
		
		
