const form = document.querySelector('.contact__form');

form.addEventListener('submit', function(e){
    e.preventDefault();
    //lorsque je soumet le formulaire j'évite le comportement par defaut
    //je récupere les data du formulaire
    //je soumet le formulaire
    //je récupére la réponse 
    //si statut ok afficher un message de success à l'utilisateur
    //sinn capturer l'erreur et informer l'utilisateur de l'erreur

    const data = new FormData(this);

    fetch('php/adduser.php', {
        method: 'POST',
        body: data
    })
    .then(response => {
        if(response.ok){
            return response.json();
        }else{
            console.log('Une erreur est survenue');
        }
    })
    .then(data => {
        if(data.successMsg != ''){
            alert(data.successMsg);
            form.querySelectorAll('input').forEach(input => {
                input.value = '';
            })
            form.querySelector('textarea').value = '';
        }else{
            alert(data.errorMsg);
        }
    })

})