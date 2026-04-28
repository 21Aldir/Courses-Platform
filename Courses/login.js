var USERS = [
  { id: 'u1', name: 'Demo Student',    email: 'student@demo.com',    role: 'student' },
  { id: 'u2', name: 'Demo Instructor', email: 'instructor@demo.com', role: 'instructor' },
];

document.getElementById('login-form')
  .addEventListener('submit', function(e) {
    e.preventDefault();

    var email    = document.getElementById('email').value.trim();
    var found    = null;

    USERS.forEach(function(u) {
      if (u.email === email) { found = u; }
    });

    var msg = document.getElementById('login-msg');

    if (found) {
      sessionStorage.setItem('udemyUser', JSON.stringify(found));
      alert('Bienvenido, ' + found.name + '!');
      window.location.href = 'index.html';
    } else {
      msg.innerHTML = '<span style="color:red">Usuario no encontrado.</span>';
    }
  });
