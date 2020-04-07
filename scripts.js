let indice;
window.onload = function cargaBarras()
{
    let arrSlides = document.getElementsByClassName('Slide');
    document.getElementById("espacio").innerHTML += "<span onclick=\"posicionSlide("+1+")\" class=\"barra active\" </span>";
    for(i=1; i<arrSlides.length; i++)
    {
        document.getElementById("espacio").innerHTML += "<span onclick=\"posicionSlide("+(i+1)+")\" class=\"barra\" </span>";
        
    }
    indice = 1
    muestraSlides(indice);
    
}



function avanzaSlide(n){
    muestraSlides( indice+=n );
    
}

function posicionSlide(n){
    indice=n
    clearInterval(timer);
    
    muestraSlides(indice);
    timer = setInterval(function tiempo(){
        muestraSlides(indice+=1)
        
    },3000);
    
}
var timer = setInterval(function tiempo(){
    muestraSlides(indice+=1)
    
},3000);


function muestraSlides(n){
    let i;
    let slides = document.getElementsByClassName('Slide');
    let barras = document.getElementsByClassName('barra');

    if(n > slides.length){
        
        
        indice = 1;
    }
    if(n < 1){
        indice = slides.length;
    }
    for(i = 0; i < slides.length; i++){
        slides[i].style.display = 'none';
    }
    for(i = 0; i < barras.length; i++){
        barras[i].className = barras[i].className.replace(" active", "");
    }

    slides[indice-1].style.display = 'block';
    barras[indice-1].className += ' active';

}