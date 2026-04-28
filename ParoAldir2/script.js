const USERS = [
  { id: 'u1', name: 'Demo Student',    email: 'student@demo.com',    role: 'student' },
  { id: 'u2', name: 'Demo Instructor', email: 'instructor@demo.com', role: 'instructor' },
];

const COURSES = [
  { id: 'c1', title: 'Advanced React Patterns',       category: 'Web Development', instructor: 'Demo Instructor', level: 'Advanced',     duration: '6 weeks',  spots: 50,  enrolled: 2   },
  { id: 'c2', title: 'Introduction to UI/UX Design',  category: 'Design',          instructor: 'Demo Instructor', level: 'Beginner',     duration: '4 weeks',  spots: 100, enrolled: 100 },
  { id: 'c3', title: 'Fullstack Next.js Masterclass', category: 'Web Development', instructor: 'Demo Instructor', level: 'Intermediate', duration: '6 weeks',  spots: 40,  enrolled: 0   },
  { id: 'c4', title: 'Python for Data Science',       category: 'Data Science',    instructor: 'Dr. Sarah Connor', level: 'Beginner',    duration: '10 weeks', spots: 200, enrolled: 150 },
];

const ENROLLMENTS = [];

// ── Render catalog ──

function renderCatalog() {
  var grid = document.getElementById('courses-grid');

  COURSES.forEach(function(course) {
    var article = document.createElement('article');
    article.className = 'card';

    var isFull = course.enrolled >= course.spots;

    var spotsHTML = isFull
      ? '<span class="badge badge-full">Course Full</span>'
      : '<span class="badge badge-available">' + (course.spots - course.enrolled) + ' spots left</span>';

    article.innerHTML =
      '<div style="display:flex; flex-direction:row; justify-content:space-between; align-items:center;">' +
        '<span class="badge badge-category">' + course.category + '</span>' +
        spotsHTML +
      '</div>' +
      '<h3>' + course.title + '</h3>' +
      '<p><i>by ' + course.instructor + '</i></p>' +
      '<small>Master this subject with a structured, hands-on curriculum designed for real-world applications.</small>' +
      '<hr>' +
      '<div class="card-meta">' +
        '<span>⏱ ' + course.duration + '</span>' +
        '<span>📶 ' + course.level + '</span>' +
        '<span>👥 ' + course.enrolled + '/' + course.spots + '</span>' +
      '</div>' +
      '<button class="btn btn-enroll"' + (isFull ? ' disabled' : '') + '>Enroll</button>';

    var enrollBtn = article.querySelector('.btn-enroll');
    if (!isFull) {
      enrollBtn.addEventListener('click', function() {
        alert('Funcionalidad próximamente');
      });
    }

    grid.appendChild(article);
  });
}

// ── Instructor table ──

function renderInstructorTable(instructorName) {
  var tbody = document.createElement('tbody');
  var total = 0;

  COURSES.forEach(function(c) {
    if (c.instructor === instructorName) {
      var tr = document.createElement('tr');
      tr.innerHTML =
        '<td>' + c.title + '</td>' +
        '<td>' + c.category + '</td>' +
        '<td>' + c.enrolled + ' / ' + c.spots + '</td>' +
        '<td>' + Date.now() + '</td>';
      tbody.appendChild(tr);
      total = total + c.enrolled;
    }
  });

  var table = document.createElement('table');
  table.innerHTML =
    '<thead><tr><th>Curso</th><th>Categoría</th><th>Inscritos</th><th>ID sesión</th></tr></thead>';

  var tfoot = document.createElement('tfoot');
  tfoot.innerHTML =
    '<tr><td colspan="2">Total inscritos</td><td>' + total + '</td><td></td></tr>';

  table.appendChild(tbody);
  table.appendChild(tfoot);

  document.getElementById('instructor-courses').innerHTML = '';
  document.getElementById('instructor-courses').appendChild(table);
}

// ── Session check on load ──

function checkSession() {
  var raw = sessionStorage.getItem('udemyUser');
  if (!raw) return;
  var user = JSON.parse(raw);

  if (user.role === 'instructor') {
    document.getElementById('instructor-section').style.display = 'block';
    document.getElementById('instructor-name').innerHTML =
      'Hola, <strong>' + user.name + '</strong>';
    renderInstructorTable(user.name);
  }
}

// ── Init ──

renderCatalog();
checkSession();
