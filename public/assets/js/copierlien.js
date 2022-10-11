let lien = document.getElementById('lien').textContent;

let copier = document.getElementById('copier');

let liencopier = copier.addEventListener("click", (e)=>{
    
    navigator.clipboard.writeText(lien);

    alert('Texte copié');
});