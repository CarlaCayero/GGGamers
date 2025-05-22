# 🎮 GGGamers

**GGGamers** es una plataforma web desarrollada con Laravel y Vue.js, diseñada para ofrecer una experiencia integral a los entusiastas de los videojuegos. La aplicación permite a los usuarios explorar, reseñar y gestionar información sobre videojuegos, brindando una interfaz amigable y funcionalidades avanzadas.

## 🚀 Tecnologías utilizadas

- **Backend:** Laravel (PHP)
- **Frontend:** Vue.js
- **Base de datos:** MySQL
- **Gestión de paquetes:** Composer, NPM
- **Servidor web:** Nginx
- **Control de versiones:** Git

## 📁 Estructura del proyecto

```
GGGamers/
├── app/                # Lógica de la aplicación (Controladores, Modelos, etc.)
├── bootstrap/          # Archivos de arranque de Laravel
├── config/             # Configuraciones de la aplicación
├── database/           # Migraciones y seeders
├── public/             # Archivos públicos (index.php, assets)
├── resources/          # Vistas Blade, archivos Vue.js, SASS, etc.
├── routes/             # Definición de rutas web y API
├── storage/            # Archivos generados y cachés
├── tests/              # Pruebas automatizadas
├── .env.example        # Archivo de ejemplo para variables de entorno
├── artisan             # Interfaz de línea de comandos de Laravel
├── composer.json       # Dependencias de PHP
├── package.json        # Dependencias de JavaScript
└── vite.config.js      # Configuración de Vite para compilación de assets
```

## ⚙️ Configuración del entorno de desarrollo

1. **Clonar el repositorio:**

   ```bash
   git clone https://github.com/cep-daw/GGGamers.git
   cd GGGamers
   ```

2. **Instalar dependencias de PHP y JavaScript:**

   ```bash
   composer install
   npm install
   ```

3. **Configurar variables de entorno:**

   Copia el archivo `.env.example` a `.env` y ajusta las variables según tu entorno:

   ```bash
   cp .env.example .env
   ```

4. **Generar la clave de la aplicación:**

   ```bash
   php artisan key:generate
   ```

5. **Configurar la base de datos:**

   - Crea una base de datos en MySQL o MariaDB.
   - Actualiza las credenciales en el archivo `.env`.

6. **Ejecutar migraciones y seeders:**

   ```bash
   php artisan migrate --seed
   ```

7. **Compilar assets:**

   ```bash
   npm run dev
   ```

8. **Iniciar el servidor de desarrollo:**

   ```bash
   php artisan serve
   ```

   La aplicación estará disponible en [http://localhost:8000](http://localhost:8000).

---

## 🧪 Pruebas

Para ejecutar las pruebas automatizadas:

```bash
php artisan test
```

---

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Si deseas colaborar:

1. Realiza un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -m 'Agregar nueva funcionalidad'`).
4. Sube tus cambios (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request detallando tus modificaciones.

---

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo LICENSE para más información.

---

## 📬 Contacto

Para consultas o sugerencias, por favor abre un Issue en el repositorio.

¡Gracias por visitar GGGamers! 🎮
