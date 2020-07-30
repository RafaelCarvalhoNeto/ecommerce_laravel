    let drop = document.getElementById('acesso');
    let dmenu = document.querySelector('#acessoOptions');
    let item = document.querySelectorAll('#acessoOptions .dropdown-item')[1]
    let nav = document.querySelector('.row')
    drop.addEventListener('mouseenter',function(){
      drop.classList.add('show')
      dmenu.classList.add('show')
    })
    nav.addEventListener('mouseenter',function(){
      drop.classList.remove('show')
      dmenu.classList.remove('show')
    })

    item.addEventListener('mouseout',function(){
      drop.classList.remove('show')
      dmenu.classList.remove('show')
    })