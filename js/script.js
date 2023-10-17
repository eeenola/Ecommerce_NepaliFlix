let userBox = document.querySelector('.header .header-2 .user-box');
document.querySelector('#user-btn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}
let navbar = document.querySelector('.header .header-2 .navbar');
document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}
window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header-2').classList.add('active');
   }else{
      document.querySelector('.header .header-2').classList.remove('active');
   }
}
let deleteButtons = document.querySelectorAll('.delete-btn');

deleteButtons.forEach(button => {
   button.addEventListener('click', function(event) {
      let confirmDeleteResult = confirm('Delete this message?');
      if (!confirmDeleteResult) {
         event.preventDefault();
      }
   });
});
