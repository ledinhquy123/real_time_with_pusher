import './bootstrap';

Echo.private('notifications').listen('UserSessionChanged', (e) => {
  const notiElement = document.getElementById('notofication')
  notiElement.innerText = e.message

  notiElement.classList.remove('alert-success')
  notiElement.classList.remove('alert-danger')
  notiElement.classList.add('alert-'+e.type)
})
