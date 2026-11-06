# 🌍 Agencia de Viajes - Sistema de Gestión y Reservas

Sistema web para la administración de paquetes turísticos, control de usuarios y gestión de reservas en línea, desarrollado como proyecto formativo individual para el programa **Tecnólogo en Análisis y Desarrollo de Software (ADSO) - SENA**[cite: 1].

---

## 🚀 Tecnologías Utilizadas

- **Lenguaje:** PHP 8+ (Programación Orientada a Objetos y PDO)[cite: 1]
- **Base de Datos:** MySQL (Motor InnoDB con integridad referencial)[cite: 1, 4]
- **Arquitectura:** Modelo - Vista - Controlador (MVC nativo sin frameworks)[cite: 1]
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5 y Bootstrap Icons[cite: 1]
- **Servidor Local:** Apache (vía XAMPP)[cite: 1]
- **Control de Versiones:** Git y GitHub[cite: 1]

---

## 📂 Estructura del Proyecto

- `app/config/`: Conexión a la base de datos mediante la clase `Database.php` con patrón Singleton[cite: 1].
- `app/controllers/`: Controladores de la aplicación (`PaqueteController.php`)[cite: 1].
- `app/models/`: Modelos con sentencias preparadas PDO (`Paquete.php`)[cite: 1].
- `app/views/`: Vistas e interfaces en Bootstrap (`index.php`, `detalle.php`, `reservas.php`, `login.php`)[cite: 1].
- `database/`: Scripts SQL (`schema.sql` con 5 entidades y `consultas.sql` con agregaciones y filtros)[cite: 1, 3, 4].
- `docs/`: Documentación de soporte (`investigacion.docx`, `requisitos.docx`, `trazabilidad.docx`)[cite: 1, 5, 6, 7].
- `tests/`: Pruebas del sistema[cite: 1].
- `index.php`: Enrutador frontal (Front Controller)[cite: 1].
- `README.md`: Documentación técnica del repositorio[cite: 1].

---

## ⚙️ Módulos y Funcionalidades

1. **Autenticación y Sesiones:**
   - Manejo de sesiones nativas con `$_SESSION`.
   - Control de acceso que exige inicio de sesión para concretar reservas turísticas.

2. **Catálogo de Destinos y Paquetes:**
   - Listado responsivo con tarjetas informativas, imágenes, duración y tarifas base en pesos colombianos.
   - Vista de detalle con desglose de servicios incluidos y selector interactivo de fechas y personas.

3. **Gestión Completa de Reservas (CRUD):**
   - **Crear:** Cálculo automático del total liquidado (`cantidad_personas * precio_base`) asociado al ID del usuario en sesión[cite: 4].
   - **Leer:** Tabla general de reservas con insignias de estado (Pendiente, Confirmada, Cancelada)[cite: 4].
   - **Actualizar y Eliminar:** Funciones para cancelar reservas activas o eliminarlas del registro[cite: 3, 4].

---

## 🛠️ Instalación y Puesta en Marcha

1. **Clonación del repositorio:**
   Clonar dentro del directorio web local:
   `git clone https://github.com/carranzapinzon55/adso-agencia-viajes.git`[cite: 8]

2. **Configuración de Base de Datos:**
   - Activar los servicios de **Apache** y **MySQL** en XAMPP Control Panel[cite: 1].
   - Entrar al gestor en `http://localhost/phpmyadmin/`[cite: 1].
   - Importar el archivo `database/schema.sql` para construir la base de datos `agencia_viajes_db`[cite: 1, 4].
   - Ejecutar los datos de prueba desde `database/consultas.sql`[cite: 1, 3].

3. **Ejecución del aplicativo:**
   Abrir el navegador web e ingresar a:
   `http://localhost/agencia_viajes/`[cite: 1]

---

## 👨‍💻 Autor

- **Aprendiz:** Angel Carranza[cite: 1]
- **Programa:** Tecnólogo en Análisis y Desarrollo de Software (ADSO) - SENA
- **Proyecto Asignado:** Proyecto #22 - Agencia de viajes[cite: 1]