# 🛒 Ecommerce Laravel — Mini Proyecto 4

Aplicación de comercio electrónico desarrollada con Laravel 13, con autenticación manual, roles de usuario (administrador, gerente, cliente), sistema de ventas con validación por gerente y autenticación de dos factores (2FA) por correo.

---

## 🚀 Tecnologías usadas

| Tecnología | Descripción |
|---|---|
| **Laravel 13** | Framework PHP principal |
| **PHP 8.3** | Lenguaje de programación |
| **SQLite** | Base de datos para pruebas y CI |
| **MySQL** | Base de datos para producción |
| **GitHub Actions** | Integración continua (CI/CD) |
| **Blade** | Motor de plantillas |
| **Tailwind CSS** | Estilos del frontend |

---

## ⚙️ Instalación local

### Prerrequisitos
- PHP 8.3+
- Composer
- Node.js y npm

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/TU_USUARIO/ecommerce-laravel.git
cd ecommerce-laravel

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JS
npm install && npm run build

# 4. Configurar variables de entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar base de datos en .env (ver sección Variables de entorno)

# 6. Ejecutar migraciones y seeders
php artisan migrate --seed

# 7. Levantar el servidor de desarrollo
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

### Credenciales de prueba (seeder)
| Rol | Correo | Clave |
|---|---|---|
| Administrador | test@example.com | 123 |

---

## 🧪 Ejecución de pruebas

```bash
php artisan test
```

Para ejecutar solo el archivo de pruebas del proyecto:

```bash
php artisan test tests/Feature/EcommerceTest.php
```

### Pruebas implementadas

| # | Prueba | Qué valida |
|---|---|---|
| 1 | `test_pagina_principal_responde_correctamente` | La ruta `/` devuelve status 200 y carga la vista `welcome` |
| 2 | `test_pagina_login_responde_correctamente` | La ruta `/login` devuelve status 200 y carga el formulario |
| 3 | `test_dashboard_requiere_autenticacion` | Un usuario no autenticado es redirigido al intentar entrar al dashboard |
| 4 | `test_login_incorrecto_muestra_error` | Credenciales incorrectas generan errores de validación en sesión |
| 5 | `test_usuario_autenticado_puede_acceder_al_dashboard` | Un usuario cliente con sesión activa obtiene status 200 en `/dashboard` |
| 6 | `test_producto_se_almacena_en_base_de_datos` | Al crear un producto, queda registrado correctamente en la tabla `productos` |
| 7 | `test_gerente_autenticado_es_redirigido_a_su_dashboard` | El rol gerente es redirigido a su vista específica |
| 8 | `test_administrador_autenticado_es_redirigido_a_usuarios` | El rol administrador es redirigido a gestión de usuarios |
| 9 | `test_panel_admin_requiere_autenticacion` | La ruta `/admin/usuarios` exige autenticación |
| 10 | `test_tabla_productos_refleja_correctamente_los_datos` | `assertDatabaseMissing` y `assertDatabaseHas` validan el estado real de la BD |

---

## 🔐 Variables de entorno

Las variables de entorno **nunca se suben al repositorio**. Se configuran directamente en la plataforma de despliegue o en un archivo `.env` local (ignorado por git).

Variables mínimas requeridas:

```env
APP_NAME=EcommerceLaravel
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://tu-url-publica.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=noreply@ecommerce.com
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🌐 URL pública del sistema

> [https://proyecto4-2p31.onrender.com](https://proyecto4-2p31.onrender.com)

*(Actualizar con la URL real una vez desplegado)*

---

## 🔄 Pipeline de CI/CD

El pipeline se ejecuta automáticamente en cada `push` o `pull request` a `main`.

**Flujo del pipeline:**

1. ✅ Clonar repositorio
2. ✅ Instalar PHP 8.3
3. ✅ Instalar dependencias Composer
4. ✅ Configurar archivo `.env`
5. ✅ Configurar SQLite para pruebas
6. ✅ Ejecutar migraciones
7. ✅ Ejecutar seeders
8. ✅ Ejecutar pruebas automáticas

Archivo del workflow: `.github/workflows/laravel.yml`

---

## 📁 Estructura del proyecto

```
ecommerce-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/LoginController.php     # Autenticación manual + 2FA
│   │   ├── Admin/UserController.php     # CRUD usuarios (administrador)
│   │   └── VentaController.php          # Gestión de ventas
│   ├── Models/
│   │   ├── Usuario.php                  # Modelo principal de usuarios
│   │   ├── Producto.php                 # Catálogo de productos
│   │   └── Venta.php                    # Registro de ventas
│   └── Mail/                            # Correos: 2FA, validación de venta
├── database/
│   ├── migrations/                      # Estructura de tablas
│   ├── seeders/DatabaseSeeder.php       # Datos iniciales
│   └── factories/UsuarioFactory.php     # Factory para pruebas
├── routes/
│   ├── web.php                          # Rutas principales
│   └── auth.php                         # Rutas de autenticación
├── tests/Feature/
│   └── EcommerceTest.php                # 10 pruebas automáticas
└── .github/workflows/
    └── laravel.yml                      # Pipeline CI/CD
```

---

## 👥 Equipo

- Integrante 1 — [usuario GitHub]
- Integrante 2 — [usuario GitHub]
- Integrante 3 — [usuario GitHub]
