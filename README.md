# motorleads-project

Ántes de comenzar, es necesario contar con XAMPP instalado en tu computadora, a continuación, te indicamos los pasos para configurarlo.

**Guía de Instalación de XAMPP para Windows**

**Descargar XAMPP**
- Visita la página oficial de XAMPP: apachefriends.org.
- Haz clic en "XAMPP para Windows" y descarga el instalador.

**Instalar XAMPP**
- Ejecuta el instalador que descargaste.
- Puede aparecer una advertencia de Control de cuentas de usuario, haz clic en "Sí" para continuar.
- Sigue las instrucciones del asistente de instalación. Asegúrate de seleccionar los componentes que necesitas (Apache, MySQL, PHP, etc.).
  
**Configurar el Firewall**
- Durante la instalación, se te puede solicitar permitir el acceso a través del firewall de Windows para Apache y MySQL. Asegúrate de permitir este - acceso.
  
**Iniciar los módulos**
- Después de la instalación, abre el Panel de Control de XAMPP.
- Inicia los módulos Apache y MySQL haciendo clic en los botones "Start".

**Verificar la instalación**
- Abre tu navegador y escribe http://localhost. Deberías ver la página de inicio de XAMPP, lo que indica que está funcionando correctamente.

---

**Guía de Instalación de XAMPP para macOS**

**Descargar XAMPP**
- Visita la página oficial de XAMPP y selecciona "XAMPP para macOS".
- Descarga el archivo DMG.

**Instalar XAMPP**
- Abre el archivo DMG que descargaste y arrastra el icono de XAMPP a tu carpeta de Aplicaciones.
- Sigue las instrucciones que aparecen en pantalla para completar la instalación.

**Permisos de Seguridad**
- Dependiendo de la versión de macOS, puede que necesites autorizar explícitamente el lanzamiento de los servidores Apache y MySQL. Esto se hace a través de las "Preferencias del Sistema" en "Seguridad y Privacidad".

**Iniciar los módulos**
- Abre el administrador de XAMPP desde tu carpeta de Aplicaciones.
- Inicia los módulos Apache y MySQL.

**Verificar la instalación**
En tu navegador, visita http://localhost para ver si XAMPP está funcionando correctamente.

---

Para que el proyecto funcione de manera correcta, se debe colocar la carpeta del reto dentro de la carpeta **htdocs** de XAMPP, a continuación, se muestra como realizar esto:

**Acceder a la Carpeta htdocs en XAMPP para Windows**
- Ubicación predeterminada
- La carpeta htdocs se encuentra generalmente en la ruta donde instalaste XAMPP. La ruta predeterminada suele ser:
- C:\xampp\htdocs
  
**Acceder usando el Explorador de Archivos**
- Abre el Explorador de Archivos de Windows.
- Navega a la unidad donde instalaste XAMPP y abre la carpeta xampp.
- Dentro de la carpeta xampp, encontrarás htdocs.
- Aquí se debe colocar la carpeta del reto.



**Acceder a la Carpeta htdocs en XAMPP para macOS**

**Ubicación predeterminada**
- En macOS, la carpeta htdocs se encuentra generalmente en:
- /Applications/XAMPP/htdocs

**Acceder usando Finder**
- Abre Finder.
- Utiliza la combinación de teclas Cmd + Shift + G para abrir la ventana de "Ir a la carpeta".
- Escribe la ruta /Applications/XAMPP/htdocs y presiona Enter.


**Crear y modificar archivos en ambos sistemas**
- Puedes agregar tus proyectos web directamente en la carpeta htdocs. Si agregas una carpeta llamada miSitio, puedes acceder a ella escribiendo http://localhost/miSitio en tu navegador.


---

**Inicio de sesion**

Para iniciar sesión, basta con abrir el archivo **index.html**, que te redireccionará hacia el sitio de inicio de sesión, por el momento, basta con ingresar una dirección de correo valida y una contraseña de entre 6-64 caracteres para poder avanzar. Es posible indicar si deseas que el sitio guarde tu contraseña, si la has olvidado o si deseas registrar una cuenta, aunque por el momento ninguno de estos campos tiene funcionalidad. Basta con llenar el primer campo de **usuario** con un texto que contenga el caracter '@' y para el campo de **contraseña** basta con llenar el campo con un mínimo de caracteres.

**Formulario**

Para recibir el formulario es necesario haber llenado correctamente los campos de **usuario** y **constraseña** y haber dado clic en el botón de "Iniciar sesión". 
En el formulario el usuario podrá seleccionar las especificaciones del auto que esté buscando desde su fabricante, su modelo, su año, entre otros. Cada uno de estos campos, al hacer clic sobre ellos, se desplegará una ventana de ayuda para conocer las posibles opciones que el usuario puede seleccionar, el único campo que no desplegará esta ventana de ayuda es el de kilometraje, en el cual el usuario podrá indicar el kilometraje del auto que desea encontrar. 

**Gráfica**

Para acceder a esta ventana es necesario llenar todos los campos del formulario, aquí el usuario podrá encontrar los datos históricos relacionados al auto el cual el usuario ha construido a partir del formulario en la ventana anterior. En esta ventana el usuario podrá encontrar distintos botones los cuales pueden aumentar o disminuir los datos históricos que se graficarán (botones **3M** para graficar histórico de 3 meses, **6M** para graficar histórico de 6 meses, **1A** para graficar históricos de 1 año y **2A** para graficar históricos de 2 años). Aquí la gráfica puede mostrar una pequeña ventana en caso de que el cursor del mouse este sobre alguno de los datos graficados, mostrando la información correspondiente para cada una de las lineas dibujadas. 

---
**Visualización**

**Login**

Al abrir la página, nos encontraremos con un inicio de sesión, el cual solo requiere de un correo válido y de una contraseña de entre 4 y 64 caracteres.

<img width="1511" alt="image" src="https://github.com/MrEstebato/motorleads-project/assets/133794187/22dcb509-9b6b-40d2-b616-e82a01e4fdb2">



**Formulario**

Despues de realizar el inicio de sesión, se muestra un formulario en el que hay distintos campos por rellenar de manera secuencial, con excepción del color y el kilometraje.
<img width="1495" alt="Captura de pantalla 2024-04-30 a la(s) 3 31 40 p m" src="https://github.com/MrEstebato/motorleads-project/assets/133794187/ba5002e7-6f75-4125-bb86-71de896b1130">



