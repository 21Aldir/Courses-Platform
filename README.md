# Udemy v2 — Plataforma de Cursos

Una plataforma web para que una institución educativa publique sus cursos, y para que estudiantes e instructores la usen de forma sencilla:

- Los **estudiantes** pueden explorar el catálogo de cursos, inscribirse, ver sus cursos y descargar un comprobante de inscripción en PDF.
- Los **instructores** pueden ver los cursos que les han asignado y cuántas personas se han inscrito.
- Los **administradores** controlan todo el catálogo: aprueban o rechazan cursos, los crean y editan, y administran los usuarios de la plataforma.

<!-- Screenshot: vista general de la página principal (catálogo de cursos) -->
> ![Vista principal]
<img width="2880" height="1683" alt="image" src="https://github.com/user-attachments/assets/2822fd7a-0fec-4752-8bbc-8c201dce4408" />

---

## Tabla de contenidos

- [Roles de usuario](#roles-de-usuario)
- [Cómo usar la plataforma](#cómo-usar-la-plataforma)
  - [1. Crear una cuenta](#1-crear-una-cuenta)
  - [2. Iniciar sesión](#2-iniciar-sesión)
  - [3. Explorar el catálogo de cursos](#3-explorar-el-catálogo-de-cursos)
  - [4. Panel del estudiante](#4-panel-del-estudiante)
  - [5. Panel del instructor](#5-panel-del-instructor)
  - [6. Panel del administrador](#6-panel-del-administrador)

---

## Roles de usuario

La plataforma maneja tres tipos de cuenta:

| Rol | Qué puede hacer |
|---|---|
| **Student** (Estudiante) | Explorar el catálogo, inscribirse o desinscribirse de cursos y descargar su comprobante de inscripción en PDF. |
| **Instructor** | Ver los cursos que el administrador le ha asignado y cuántos estudiantes se han inscrito en cada uno. |
| **Admin** (Administrador) | Aprobar o rechazar cursos, crear/editar/eliminar cursos y administrar las cuentas de usuario. |

> Cualquier persona puede registrarse como **Estudiante** o **Instructor** desde la página de registro. La cuenta de **Administrador** se asigna manualmente por el equipo encargado de la plataforma.

---

## Cómo usar la plataforma

### 1. Crear una cuenta

Desde la página principal, haz clic en **Sign up** (Registrarse).

<!-- Screenshot: página de registro con el formulario vacío -->
> ![Registro]
<img width="981" height="862" alt="image" src="https://github.com/user-attachments/assets/24f6e174-6a80-41e0-a83f-02a0dd4ceb27" />

Se solicita:

| Campo | Descripción |
|---|---|
| Nombre completo | Tu nombre |
| Correo electrónico | Un correo válido y único |
| Contraseña | Mínimo 8 caracteres |
| Confirmar contraseña | Repetir la contraseña |
| Tipo de cuenta | **Estudiante** (por defecto) o **Instructor** |

Al crear la cuenta, la sesión se inicia automáticamente y se te lleva directo a tu panel correspondiente.

---

### 2. Iniciar sesión

Haz clic en **Log in** (Iniciar sesión) e ingresa tu correo y contraseña.

<!-- Screenshot: página de login -->
> ![Login]
<img width="981" height="862" alt="image" src="https://github.com/user-attachments/assets/cec88369-1c2e-40c6-91c9-508a83a669ec" />


Según el tipo de cuenta, serás dirigido automáticamente a tu panel: catálogo de cursos (estudiantes), panel de instructor o panel de administrador.

> Si los datos no son correctos, se mostrará el mensaje: *"Credenciales incorrectas."*

---

### 3. Explorar el catálogo de cursos

La página principal muestra todos los cursos que han sido **aprobados** por el administrador.

<!-- Screenshot: catálogo con cursos visibles y filtros activos -->
> ![Catálogo de cursos]
<img width="794" height="518" alt="image" src="https://github.com/user-attachments/assets/550cb86f-8f23-45f1-97e9-a2621af57baf" />

Cada curso muestra su categoría, título, instructor, descripción, duración, nivel y los cupos disponibles. Si un curso ya está lleno, se muestra la etiqueta **Course Full**.

Los cursos pueden tener tres niveles de dificultad:

| Nivel | Descripción |
|---|---|
| Beginner (Principiante) | No requiere conocimientos previos |
| Intermediate (Intermedio) | Requiere bases del tema |
| Advanced (Avanzado) | Pensado para usuarios con experiencia |

Comportamiento según el tipo de visitante:

- **Sin cuenta**: se muestra el botón **"Log in to Enroll"**, que lleva a la página de inicio de sesión.
- **Estudiante**: puede inscribirse haciendo clic en **Enroll**, o cancelar su inscripción con **Unenroll**. Si el curso está lleno, el botón se desactiva.
- **Instructor / Administrador**: el botón de inscripción aparece desactivado, ya que solo los estudiantes pueden inscribirse.

---

### 4. Panel del estudiante

Aquí el estudiante ve todos los cursos en los que está inscrito.

<!-- Screenshot: panel del estudiante con cursos inscritos -->
> ![Panel del estudiante]
<img width="1497" height="785" alt="image" src="https://github.com/user-attachments/assets/c5922b6a-ec3d-40cd-a235-6923069be71b" />

Para cada curso puede:

<img width="1601" height="1576" alt="image" src="https://github.com/user-attachments/assets/2cc9b565-4526-43a8-9976-7801b3bffd6e" />

- **📄 Descargar PDF**: obtener un comprobante de inscripción.
- **Unenroll**: cancelar su inscripción (con confirmación previa).

Si aún no está inscrito en ningún curso, se le muestra un botón para explorar el catálogo.

---

### 5. Panel del instructor

Aquí el instructor ve la información de los cursos a su cargo.

<!-- Screenshot: panel de instructor con sus cursos asignados -->
> ![Panel de instructor](docs/images/instructor-dashboard.png)

Incluye dos secciones:

- **📚 Mis cursos**: los cursos que el administrador le ha asignado, con su categoría, nivel, número de inscritos y estado de aprobación (`Pending`, `Approved`, `Rejected`).
- **🌐 Cursos disponibles**: el catálogo completo de cursos aprobados; los propios aparecen marcados como **Tuyo**.

> Los instructores no crean ni editan cursos directamente — esto lo gestiona el administrador.

---

### 6. Panel del administrador

El panel de administración es el centro de control de la plataforma.

<!-- Screenshot: panel de administración -->
> ![Panel de administrador]
<img width="1603" height="1082" alt="image" src="https://github.com/user-attachments/assets/f0138a5c-4645-432a-895e-92b2a5b7b3f7" />

Desde aquí se puede:

- **Aprobar cursos pendientes**: revisar los cursos creados y aprobarlos (✓ Approve) o rechazarlos (✗ Reject).
- **Gestionar todos los cursos**: crear (`+ New Course`), editar o eliminar cualquier curso, definiendo su categoría, instructor asignado, título, descripción, nivel, duración, cupos y estado.
- **Gestionar usuarios**: ver todos los usuarios registrados y editar su nombre, correo, tipo de cuenta o contraseña, así como eliminarlos (no es posible eliminar la propia cuenta).

---

<p align="center">© 2026 Udemy v2 — Proyecto escolar</p>
