# MarsRobotMission

Un proyecto PHP que simula un robot explorador que se mueve en una cuadrícula de 200x200. Sigue comandos dados por el usuario, detecta obstáculos y detiene su movimiento si encuentra uno o sale del área.

---

##  Estructura basada en DDD + SOLID

```
MarsRobotMission/
├── index.php                        # Punto de entrada del programa
├── src/
│   ├── Domain/                      # Lógica de dominio pura
│   │   ├── Robot.php
│   │   ├── Position.php
│   │   └── Direction.php
│   ├── Application/                # Casos de uso
│   │   ├── CommandProcessor.php
│   │   └── RobotInitializer.php
│   ├── Infrastructure/             # Interacción con consola
│   │   └── ConsoleIO.php
│   └── Shared/
│       └── Exceptions/
│           ├── InvalidInputException.php
│           └── OutOfBoundsException.php
```

---

##  Cómo ejecutar el proyecto

1. Asegúrate de tener **PHP 8+** instalado.
2. Abre una terminal y ve a la carpeta raíz del proyecto:
   ```bash
   cd C:\xampp\htdocs\MarsRobotMission
   ```
3. Ejecuta el programa con:
   ```bash
   php index.php
   ```
4. Si no te reconoce php, ejecuta el programa con:
   ```bash
   C:\xampp\php\php.exe index.php #Es la ruta local utilizando XAMPP
   ```

---

##  Interacción por consola

- Al iniciar, se pide:
  - Posición X (0–199)
  - Posición Y (0–199)
  - Dirección inicial (NORTE, SUR, ESTE, OESTE)

- Luego puedes introducir comandos:
  - `f` → avanzar
  - `l` → moverse a la izquierda
  - `r` → moverse a la derecha
  - Escribe `salir` para terminar

---

##  Obstáculos y límites

- El robot se detiene automáticamente si:
  - Encuentra un obstáculo (definido en `Robot.php`)
  - Sale de los límites del área (más allá de 0–199)

---

##  Ejemplo de uso

```text
Indica la posición inicial X (0–199): 0
Indica la posición inicial Y (0–199): 0
Indica la orientación inicial (NORTE, SUR, ESTE, OESTE): NORTE
Introduce órdenes (ej: ffrlff). Escribe 'salir' para terminar.
Órdenes: ffrfl
Posición final: (1, 2)
🛑 Obstáculo detectado en (2, 2). El robot se ha detenido.
```

---

##  Validaciones y control de errores

###  Coordenadas iniciales (X, Y)
- Deben estar entre 0 y 199.
- Si introduces un valor no numérico o fuera de rango, el sistema te lo indicará y volverá a pedir el dato.
- Ejemplo de mensaje de error:
  ```
  ❌ Las coordenadas deben ser numéricas.
  ❌ La posición (250, -1) está fuera del área permitida (0-199).
  ```

###  Dirección inicial
- Debe ser una de estas: `NORTE`, `SUR`, `ESTE`, `OESTE`.
- Si introduces cualquier otro valor, se mostrará un error y se pedirá nuevamente.
- Ejemplo:
  ```
  ❌ Dirección inválida: NOR. Usa NORTE, SUR, ESTE u OESTE.
  ```

###  Comandos de movimiento
- El comando debe ser una palabra sin espacios compuesta solo por letras: `f`, `l`, `r` (mayúsculas o minúsculas).
- Si se incluye una letra no válida, se mostrará un mensaje de error y se pedirá nuevamente.
- Ejemplo:
  ```
  ❌ Comando inválido. Solo se permiten las letras 'f', 'l', 'r' (sin espacios ni otros caracteres).
  ```

###  Errores durante el movimiento
- El robot se detiene automáticamente si:
  - Se sale de los límites de 0 a 199.
  - Se encuentra con un obstáculo.
- El sistema muestra la posición final alcanzada y una notificación clara del motivo de la detención.

---

## Principios aplicados

- DDD (Domain-Driven Design)
- SOLID:
  - SRP: Cada clase tiene una sola responsabilidad.
  - OCP/DIP: Lógica del dominio separada de infraestructura.
