veterinaria
===========

Control de Cobros, Citas y Catalogo de una Veterinaria

Una veterinaria tiene una base de datos con la que registrar los cobros, 
y hacen citas las personas haciendo visita o por telefono y
ademas ncesita de una pagina en la el cliente pueda registrarse y 
hacer citas en linea y consultar su estado, tambien poder consultar
el catalogo y poder hacer pedido sobre productos que se han 
terminado o productos especiales como animales exoticos . 
Ademas la doctora quiere una cuenta  donde pueda consultar las 
ventas del dia de forma remota y tambien poder mover las citas y
registrar cuando terminan y una cuenta de empleado en la pueda 
tambien mover las citas y registrar cuando terminan.


Cuentas y Clientes

La veterinaria cuenta con varios clientes y cada cliente puede tener
al menos una cuenta en la cual pueda acceder a la informacion de
productos, asi como para realizar citas y consultar el estado de la cita
y estar al tanto si se ha retrazado, o cuando ha terminado.

Al crear una cuenta de usuario, los datos a proporcionar son:
nombre y apellidos, telefono, domicilio, etc, al cual se le
proporciona un id numero y contraseña. Con dicha cuenta podra acceder 
a la informacion principal de citas y catalogo de productos.

En cuanto a la cuenta de superusuario, es unicamente para el
encargado de la veterinaria y en la cual tiene acceso a toda la
informacion de las ventas del dia, asi como el registro de las citas
y el estado de los productos, tambien tiene acceso a cambiar la hora
de las citas o moverlas y registrar el inicio o fin de cada una, y la lista
de los productos que han sido agregados a lista de pedidos y actualizarlos,
asi el cliente puede consulta la lista de productos pendiente y ver cuando
ha sido surtido.

Cobros

El control de los gastos y cobros esta ligado a la informacion
del usuario pero, entrara en el sistema de notas de venta, el cual almacena
la informacion de las ventas del dia de forma remota para el dueño.

Servicios

Para llevar un control total de los diferentes servicios que 
proporcionará la veterinaria, se asignara un tiempo y una
descripcion de un servicio requerido por el cliente
asi como un precio, que tambien se ligara al sistema de 
notas de venta.



Reportes

consultas del cliente:
Estado de cuenta del cliente
Horario de Cita del cliente
Informacion del catalogo de prodcutos(existencia y precio)
Consultas encargado:
Horario de citas de todos los clientes
Control de ventas
Existencia de productos
actulizar productos
actualizar pedidos


Niveles de Usuario

Nivel = 0. Administrador.- dueño de la empresa, puede consultar las ventas del dia, ademas 
de lo que puede consultar el empleado y por ser el dueño y encargado puede borrar o editar todo.

Nivel = 1. Empleado.- puede consultar a los usuarios y pedidos pero no las ventas del dia
como el Administrador, no puede eliminar nada.

Nivel = 2. Cliente.-un cliente no puede consultar a los usuarios ni consultar los pedidos 
y se necesita estar log in para reservar productos, mas no para verlos. 



Superusuario:
control de informacion.



## Demo del desarrollo en alaturing

Url de acceso: http://alanturing.cucei.udg.mx/cc409/perrosygatos/

cuenta de acceso  
id=1 pass=1234  
id=6 pass=1234  


## Integrantes de Equipo


Hinojosa Valadez Juan Alejandro sección:D04

Navarro  Espinoza Francisco Fernando sección:D03
