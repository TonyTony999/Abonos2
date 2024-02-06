function clearCookie(cname, cvalue, exdays) {
  const d = new Date();
  //d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  //let expires = "expires="+d.toUTCString();
  let expires = "Thu, 01 Jan 1970 00:00:00 UTC"
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function setLocalStorage() {
  //localStorage.setItem("email", email);
  let forms = document.forms
  console.log(forms)
}

/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
} 

function mensajeEnviado(){

  console.log("clicked")

  //console.log(e.target.id)
  //e.preventDefault()

  let body=document.getElementsByTagName("body")
  console.log(body)

  //alert("testing this")

  
  let popup=document.createElement("section")
  popup.className="card-large card-dark"
  //popup.id="locate"
  popup.id="sup-bird"
  popup.style.width="30vw"
  popup.style.height="10vh"
  popup.style.display="flex"
  popup.style.flexDirection="column"
  popup.style.justifyContent="center"
  popup.style.alignItems="center"
  /*popup.style.backgroundColor="red"*/
  popup.style.position="fixed"
  popup.style.left="35vw"
  popup.style.top="40vh";
  popup.style.zIndex=2000;
  popup.innerHTML="<h3>Gracias Por Contactarnos<h3/>"

  console.log(popup)

  body[0].appendChild(popup);

  setTimeout(function(){
    popup.style.display="none";

  },1500)
  
  //console.log(body)
  
  
}

function toggleMenu() {
  console.log("toggled")
  let x = document.getElementById("navigation-menu");
  //let navigationContainer = document.getElementById("navigation-container");
  if (x.className === "navigation-menu") {
    x.className += "-responsive";
    
  } else {

    x.className = "navigation-menu";
  }
} 

/******************************************************************CAROUSEL ************************************************************* */
