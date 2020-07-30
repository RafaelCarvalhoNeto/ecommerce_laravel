let btn = document.getElementById('btn-fade');
let noir = document.querySelector('.noir');
btn.addEventListener('click', function(event){

  if(event.target.getAttribute('aria-expanded')=='false'){
    noir.classList.add('active-noir')
    btn.style.zIndex = 100
  }else{
    noir.classList.remove('active-noir')
  }
})

document.addEventListener('click', function(){
  if(btn.getAttribute('aria-expanded')=='true')
    noir.classList.remove('active-noir')
})